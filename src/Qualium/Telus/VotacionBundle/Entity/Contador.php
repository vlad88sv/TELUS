<?php

namespace Qualium\Telus\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contador
 */
class Contador
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var integer
     */
    private $idCandidato;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Contador
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set idCandidato
     *
     * @param integer $idCandidato
     * @return Contador
     */
    public function setIdCandidato($idCandidato)
    {
        $this->idCandidato = $idCandidato;

        return $this;
    }

    /**
     * Get idCandidato
     *
     * @return integer 
     */
    public function getIdCandidato()
    {
        return $this->idCandidato;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Contador
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
