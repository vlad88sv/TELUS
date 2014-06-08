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
            /*SELECT `Candidatos`.`id`,
    `Candidatos`.`surnames`,
    `Candidatos`.`name`,
    `Candidatos`.`email`,
    `Candidatos`.`documentType`,
    `Candidatos`.`documentNumber`,
    `Candidatos`.`idCountry`,
    `Candidatos`.`department`,
    `Candidatos`.`idCommitee`,
    `Candidatos`.`registerDate`,
    `Candidatos`.`updateDate`,
    `Candidatos`.`votes`
FROM `telus`.`Candidatos`
ORDER BY RAND() DESC LIMIT 20;
             */
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array('name' => 'nombre'));
    }
    
    public function verComitesAction() {
        // A las personas no regitradas se les mostaran solo 10 comites a la vez.
        $sql = 'SELECT `Comites`.`id`, `Comites`.`nombre` FROM `telus`.`Comites` ORDER BY RAND() ';
        $securityContext = $this->container->get('security.context');
        if( ! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
            $sql .= ' LIMIT 12';               
        }
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($results);
    }
}
