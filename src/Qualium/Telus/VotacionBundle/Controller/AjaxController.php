<?php
namespace Qualium\Telus\VotacionBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller {
    public function verCandidatosAction() 
    {
        // Se envián en formato JSON para que jQuery los procese       
        
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('ROLE_USER') ){
            // Si esta registrado se le muestran todos los de su país, pero random
        } else {
            // Si es anónimo solo se le muestran 20 aleatorios
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array('name' => 'nombre'));
    }
    
    public function verComitesAction() {
        // Nota: Solo se muestran comites con candidatos
        
        $usr= $this->get('security.context')->getToken()->getUser();
        
        $sql = 'SELECT `Comites`.`id`, `Comites`.`nombre`, COALESCE((SELECT SUM(votes) FROM `Candidatos` WHERE `Candidatos`.`idCommitee` = `Comites`.`id`),0) AS totalVotes, COALESCE((SELECT COUNT(*) FROM `Candidatos` WHERE `Candidatos`.`idCommitee` = `Comites`.`id`),0) AS totalCandidatos FROM `Comites` WHERE 1';
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){        
            // A los registrados se les muestra solo comites con candidatos de su país
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
            $sql = 'SELECT `name`, `surnames`, `votes`, (FLOOR(RAND() * (8)) + 1) AS "image" FROM `Candidatos` WHERE `idCommitee` = '. $result['id'] . ' LIMIT 4';
            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $stmt->execute();
            $candidatos = $stmt->fetchAll();
            $results[$index]['candidatos'] = $candidatos;            
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($results);
    }
}
