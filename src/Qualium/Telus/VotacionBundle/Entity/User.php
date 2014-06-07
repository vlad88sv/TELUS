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
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
