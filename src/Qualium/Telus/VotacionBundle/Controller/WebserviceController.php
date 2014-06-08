<?php
namespace Qualium\Telus\VotacionBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebserviceController extends Controller {
   
    public function jsonCandidatesAction($idCandidato) {
    
    if (!is_numeric ($idCandidato))
    {
        return new \Symfony\Component\HttpFoundation\Response('Invalid request',403);
    }
     
    
    $FILTER = '';
    
    if ($idCandidato) {
        $FILTER = "AND `Candidatos`.`id` = $idCandidato";
    }
        
    $sql = 'SELECT `Candidatos`.`id`,
    `Candidatos`.`surnames`,
    `Candidatos`.`name`,
    `Candidatos`.`email`,
    `Candidatos`.`documentType`,
    `Candidatos`.`documentNumber`,
    `Candidatos`.`idCountry`,
    `Candidatos`.`department`,
    `Candidatos`.`idCommitee` AS "idCommittee",
    `Comites`.`nombre` AS "nameCommitte",
    `Candidatos`.`registerDate`,
    `Candidatos`.`updateDate`,
    `Candidatos`.`votes`
    FROM `Candidatos` LEFT JOIN `Comites` ON `Candidatos`.idCommitee = `Comites`.`id`
    WHERE 1 '.$FILTER. ' ORDER BY `id` ASC';
        
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        
        $stmt->execute();
        $candidatos = $stmt->fetchAll();
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($candidatos);

    }
    
}
