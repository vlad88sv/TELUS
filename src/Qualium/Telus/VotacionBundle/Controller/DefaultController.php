<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Qualium\Telus\VotacionBundle\Entity\Contador;


class DefaultController extends Controller
{
    private function ejecutarContadorVisitas()
    {
        
        $securityContext = $this->container->get('security.context');
        $session = $this->getRequest()->getSession();
        
        if (empty($session->get('VisitaRegistrada'))) {
            $session->set('VisitaRegistrada', microtime(true));
            
            $contador = new Contador;
            $contador->setFecha(new \DateTime());
            $contador->setIp($_SERVER['REMOTE_ADDR']);

            if( $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') ){
                $contador->setIdCandidato($this->getUser()->getGuardUser()->getId());
            } else  {
                $contador->setIdCandidato(0);
            }
            
            $em = $this->getDoctrine()->getManager()->persist($contador);
            $em->flush();
        }

        
    }
    
    private function mostrarContadorVisitas() {
        // SELECT DATE(fecha), COUNT(*) FROM Contador GROUP BY DATE(fecha) LIMIT 20;
        $manager = $this->getDoctrine()->getManager();
        $conn = $manager->getConnection();
        $result = $conn->query('SELECT DATE(fecha) AS dia, COUNT(*) AS total FROM Contador GROUP BY DATE(fecha) LIMIT 20')->fetchAll();
        return $result;
    }
    
    public function indexAction()
    {
        $this->ejecutarContadorVisitas();
        
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('ROLE_ADMIN') ){
            return $this->render('QualiumTelusVotacionBundle:Default:index.admin.html.twig');        
        }
        
        $visitas = $this->mostrarContadorVisitas();
        return $this->render('QualiumTelusVotacionBundle:Default:index.html.twig', array('visitas' => $visitas));        
    }
}
