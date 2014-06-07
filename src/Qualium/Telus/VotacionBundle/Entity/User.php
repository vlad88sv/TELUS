<?php
namespace Qualium\Telus\VotacionBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    private $idCountry;
    
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
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
