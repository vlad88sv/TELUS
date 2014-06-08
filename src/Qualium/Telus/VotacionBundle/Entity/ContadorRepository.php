<?php

namespace Qualium\Telus\VotacionBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ContadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ContadorRepository extends EntityRepository
{
    public function agruparVisitasDesdeHace($dias)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT SUBSTRING(p.fecha, 6, 2), COUNT(p) FROM QualiumTelusVotacionBundle:Contador p GROUP BY p.fecha'
            )
            ->getResult();
    }
}
