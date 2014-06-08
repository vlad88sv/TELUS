<?php

namespace Qualium\Telus\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidatos
 */
class Candidatos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $surnames;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $documentType;

    /**
     * @var string
     */
    private $documentNumber;

    /**
     * @var integer
     */
    private $idCountry;

    /**
     * @var string
     */
    private $department;

    /**
     * @var integer
     */
    private $idCommitee;

    /**
     * @var integer
     */
    private $votes;

    
    /**
     * @var \DateTime
     */
    private $registerDate;

    /**
     * @var \DateTime
     */
    private $updateDate;

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
     * Set surnames
     *
     * @param string $surnames
     * @return Candidatos
     */
    public function setSurnames($surnames)
    {
        $this->surnames = $surnames;

        return $this;
    }

    /**
     * Get surnames
     *
     * @return string 
     */
    public function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Candidatos
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Candidatos
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set documentType
     *
     * @param integer $documentType
     * @return Candidatos
     */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * Get documentType
     *
     * @return integer 
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * Set documentNumber
     *
     * @param string $documentNumber
     * @return Candidatos
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    /**
     * Get documentNumber
     *
     * @return string 
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Set idCountry
     *
     * @param integer $idCountry
     * @return Candidatos
     */
    public function setIdCountry($idCountry)
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * Get idCountry
     *
     * @return integer 
     */
    public function getIdCountry()
    {
        return $this->idCountry;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return Candidatos
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set idCommitee
     *
     * @param integer $idCommitee
     * @return Candidatos
     */
    public function setIdCommitee($idCommitee)
    {
        $this->idCommitee = $idCommitee;

        return $this;
    }

    /**
     * Get idCommitee
     *
     * @return integer 
     */
    public function getIdCommitee()
    {
        return $this->idCommitee;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return Candidatos
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime 
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return Candidatos
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }
    
    /**
     * Set votes
     *
     * @param integer $votes
     * @return Candidatos
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Get votes
     *
     * @return integer 
     */
    public function getVotes()
    {
        return $this->votes;
    }

}
