<?php

namespace T42\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * T42\UserBundle\Entity\User
 * 
 * Clase que representa un usuario para loguearse al sistema.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>

 * @ORM\Entity
 * @ORM\Table(name="t42_user") 
 *  
 */
class User extends BaseUser 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="T42\UserBundle\Entity\Group")
     */
    protected $groups;

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