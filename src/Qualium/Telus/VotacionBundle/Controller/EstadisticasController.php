<?php
namespace Qualium\Telus\VotacionBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EstadisticasController extends Controller {
    
    private function getGlobalNumberOfVotes () {
        $sql = 'SELECT SUM(`votes`) AS total FROM Candidatos';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results[0]['total'];
    }

    private function getGlobalNumberOfCandidates () {
        $sql = 'SELECT COUNT(*) AS total FROM Candidatos';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results[0]['total'];
    }

    private function getGlobalNumberOfCommittess () {
        $sql = 'SELECT COUNT(*) AS total FROM Comites';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results[0]['total'];
    }

    private function getGlobalNumberOfUsers () {
        $sql = 'SELECT COUNT(*) AS total FROM fos_user';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results[0]['total'];
    }

    private function getTopCandidates () {
        $sql = 'SELECT id, surnames, name, votes FROM Candidatos ORDER BY votes DESC';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results;
    }
    

    private function getTopCommittess () {
        $sql = 'SELECT Comites.nombre, COALESCE(SUM(votes),0) AS total FROM Comites LEFT JOIN Candidatos ON Comites.id = Candidatos.idCommitee GROUP BY Comites.id ORDER BY total DESC';
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        
        $results = $stmt->fetchAll();
        
        return $results;
    }
    
    
    
    public function votosAction() 
    {
        $stats['global_number_of_votes'] = $this->getGlobalNumberOfVotes();
        $stats['global_number_of_candidates'] = $this->getGlobalNumberOfCandidates();
        $stats['global_number_of_committess'] = $this->getGlobalNumberOfCommittess();
        $stats['global_number_of_users'] = $this->getGlobalNumberOfUsers();
        $stats['global_top_candidates'] = $this->getTopCandidates();
        $stats['global_top_committess'] = $this->getTopCommittess();
        return $this->render('QualiumTelusVotacionBundle:Reportes:votos.html.twig',$stats);        
    }
}
