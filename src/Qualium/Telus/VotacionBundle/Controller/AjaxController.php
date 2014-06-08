<?php
namespace Qualium\Telus\VotacionBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller {
    public function verCandidatosAction() 
    {
        // Se envián en formato JSON para que jQuery los procese       
        
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('ROLE_USER') ){
            // Si esta registrado se le muestran todos los de su país
        } else {
            // Si es anónimo solo se le muestran 20 aleatorios
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse(array('name' => 'nombre'));
    }
}
