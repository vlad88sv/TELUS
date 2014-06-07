<?php

namespace Qualium\Telus\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Votos
 */
class Votos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var integer
     */
    private $idCandidato;

    /**
     * @var integer
     */
    private $fechaVoto;

    /**
     * @var integer
     */
    private $flagEliminado;

    /**
     * @var string
     */
    private $razonEliminado;


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
     * Set idUser
     *
     * @param integer $idUser
     * @return Votos
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idCandidato
     *
     * @param integer $idCandidato
     * @return Votos
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
     * Set fechaVoto
     *
     * @param integer $fechaVoto
     * @return Votos
     */
    public function setFechaVoto($fechaVoto)
    {
        $this->fechaVoto = $fechaVoto;

        return $this;
    }

    /**
     * Get fechaVoto
     *
     * @return integer 
     */
    public function getFechaVoto()
    {
        return $this->fechaVoto;
    }

    /**
     * Set flagEliminado
     *
     * @param integer $flagEliminado
     * @return Votos
     */
    public function setFlagEliminado($flagEliminado)
    {
        $this->flagEliminado = $flagEliminado;

        return $this;
    }

    /**
     * Get flagEliminado
     *
     * @return integer 
     */
    public function getFlagEliminado()
    {
        return $this->flagEliminado;
    }

    /**
     * Set razonEliminado
     *
     * @param string $razonEliminado
     * @return Votos
     */
    public function setRazonEliminado($razonEliminado)
    {
        $this->razonEliminado = $razonEliminado;

        return $this;
    }

    /**
     * Get razonEliminado
     *
     * @return string 
     */
    public function getRazonEliminado()
    {
        return $this->razonEliminado;
    }
}
