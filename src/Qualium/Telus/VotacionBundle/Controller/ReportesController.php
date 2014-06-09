<?php

namespace Qualium\Telus\VotacionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Qualium\Telus\VotacionBundle\Entity\Contador;


class ReportesController extends Controller
{
    
    public function visitorsAction()
    {
        return $this->render('QualiumTelusVotacionBundle:Reportes:visitas.html.twig');        
    }
    
    public function generateVisitorReportsAction($days)
    {
        

        $sql = 'SELECT DATE(fecha) AS dia, COUNT(*) AS total FROM Contador GROUP BY DATE(fecha) ORDER BY fecha DESC';
        if ($days !== '0') {
            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql.' LIMIT :plimit');
            $stmt->bindValue('plimit', (int) $days, \PDO::PARAM_INT);
        } else {
            $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        }

        
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        $buffer = '';
        foreach($results as $result) {
            $buffer .= $result['dia'] .'|'. $result['total']. "\r\n";
        }
        
        $response = new \Symfony\Component\HttpFoundation\Response($buffer);
        
        $response->headers->set('Content-Description', 'File Transfer');
        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Content-Disposition', 'attachment; filename="Visitor report created on '.date('Y-m-d H:m:i').'.txt"');
        $response->headers->set('Content-Transfer-Encoding', 'binary');
        $response->headers->set('Connection', 'Keep-Alive');
        $response->headers->set('Expires', '0');
        $response->headers->set('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Content-Length', strlen($buffer));
        
        return $response;
    }
}
