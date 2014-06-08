<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $securityContext = $this->container->get('security.context');
        if( $securityContext->isGranted('ROLE_ADMIN') ){
            return $this->render('QualiumTelusVotacionBundle:Default:index.admin.html.twig');        
        }
        
        return $this->render('QualiumTelusVotacionBundle:Default:index.html.twig');        
    }
}
