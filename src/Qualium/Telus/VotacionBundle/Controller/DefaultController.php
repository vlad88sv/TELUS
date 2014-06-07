<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QualiumTelusVotacionBundle:Default:index.html.twig');
    }
}
