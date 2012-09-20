<?php

namespace T42\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * T42\UserBundle\Entity\Group
 * 
 * Class representing a group to which users belong 
 * to which groups and roles permissions.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="t42_group") 
 *  
 */
class Group extends BaseGroup
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
     protected $id;         

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}