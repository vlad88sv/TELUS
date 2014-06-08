<?php
namespace Qualium\Telus\VotacionBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller {
    public function verCandidatosAction($idCommite) 
    {
        
        if (empty ($idCommite))
        {
            return new \Symfony\Component\HttpFoundation\Response('Invalid request',403);
        }
        
        // Se envián en formato JSON para que jQuery los procese       
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('ROLE_USER') ){
            // Si esta registrado se le muestran todos los de su país, pero random
            $usr = $this->get('security.context')->getToken()->getUser();
            $sql = 'SELECT `id`, `name`, `surnames`, `votes`, (FLOOR(RAND() * (8)) + 1) AS "image", IF((SELECT COUNT(*) FROM Votos WHERE idUser= '. $usr->getId().' AND idCandidato=`Candidatos`.id),1,0) AS "votado" FROM `Candidatos` WHERE `Candidatos`.`idCountry` = '. $usr->getIdCountry()->getId().' AND `idCommitee` = :idCommitee ORDER BY RAND()';
        } else {
            // Si es anónimo se muestran todos, pero igual no puede votar
            $sql = 'SELECT `id`, `name`, `surnames`, `votes`, (FLOOR(RAND() * (8)) + 1) AS "image" FROM `Candidatos` WHERE `idCommitee` = :idCommitee ORDER BY RAND()';
        }
        
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->bindValue('idCommitee', (int) $idCommite, \PDO::PARAM_INT);
        
        $stmt->execute();
        $candidatos = $stmt->fetchAll();
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($candidatos);
    }
    
    public function verComitesAction() {
        // Nota: Solo se muestran comites con candidatos   
        $sql = 'SELECT `Comites`.`id`, `Comites`.`nombre`, COALESCE((SELECT SUM(votes) FROM `Candidatos` WHERE `Candidatos`.`idCommitee` = `Comites`.`id`),0) AS totalVotes, COALESCE((SELECT COUNT(*) FROM `Candidatos` WHERE `Candidatos`.`idCommitee` = `Comites`.`id`),0) AS totalCandidatos FROM `Comites` WHERE 1';
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){        
            // A los registrados se les muestra solo comites con candidatos de su país
            $usr= $this->get('security.context')->getToken()->getUser();
            $sql .= ' AND `Comites`.`id` IN (SELECT `Candidatos`.`idCommitee` FROM `Candidatos` WHERE `Candidatos`.`idCountry` = '.$usr->getIdCountry()->getId().') HAVING totalCandidatos > 0 ORDER BY RAND() ';
        } else {
            // A las personas no regitradas se les mostaran solo 12 comites.
            $sql .= ' HAVING totalCandidatos > 0 ORDER BY RAND() LIMIT 12';
        }
        
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        // Obtengamos unos 4 candidatos de este comite - respetando la restricción de páis
        foreach($results as $index => $result) {
            $sql = 'SELECT `name`, `surnames`, `votes`, (FLOOR(RAND() * (8)) + 1) AS "image" FROM `Candidatos` WHERE `idCommitee` = '. $result['id'] . ' ORDER BY RAND() LIMIT 4';
            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $stmt->execute();
            $candidatos = $stmt->fetchAll();
            $results[$index]['candidatos'] = $candidatos;            
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($results);
    }
    
    public function votarCandidatoAction($idCandidato) {
        
        if (empty ($idCandidato))
        {
            return new \Symfony\Component\HttpFoundation\Response('Invalid request',403);
        }
        
// El Firewall nos protege de que no voten sin iniciar sesión
        
        $usr= $this->get('security.context')->getToken()->getUser();
        
        // Primero verificamos que el voto sea posible
        $sql = 'SELECT COUNT(*) AS totalVotos FROM `Votos` WHERE `idUser` = :idUser AND `idCandidato` IN (SELECT id FROM Candidatos WHERE idCommitee IN (SELECT idCommitee FROM Candidatos WHERE id = :idCandidato))';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->bindValue('idCandidato', (int) $idCandidato, \PDO::PARAM_INT);
        $stmt->bindValue('idUser', (int) $usr->getId(), \PDO::PARAM_INT);
        $stmt->execute();
        $candidatos = $stmt->fetchAll();
        
        if ($candidatos[0]['totalVotos'] != '0') {
            return new \Symfony\Component\HttpFoundation\JsonResponse(array('voteAction' => 'alreadyVoted'));
        }
        
        // Guardamos el voto en el historial para poder hacer recuentos/verificación
        $sql = 'INSERT INTO `Votos` (fechaVoto, idCandidato, idUser) VALUES(NOW(),:idCandidato, :idUser)';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->bindValue('idCandidato', (int) $idCandidato, \PDO::PARAM_INT);
        $stmt->bindValue('idUser', (int) $usr->getId(), \PDO::PARAM_INT);
        $stmt->execute();

        // Somamos el voto en el cache de votos
        $sql = 'UPDATE `Candidatos` SET `votes` =  (`votes`+1) WHERE id = :idCandidato';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->bindValue('idCandidato', (int) $idCandidato, \PDO::PARAM_INT);
        $stmt->execute();
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array('voteAction' => 'complete'));
    }
}
