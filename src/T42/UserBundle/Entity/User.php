<?php

namespace T42\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * T42\UserBundle\Entity\User
 * 
 * Class representing a user to login to the system.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */    
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */    
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */    
    protected $address;
    
    /**
     * @ORM\Column(type="string", length=100, name="phone_number", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @ORM\ManyToMany(targetEntity="T42\UserBundle\Entity\Group")
     */
    protected $groups;
    
    /**
     * @ORM\OneToOne(targetEntity="T42\UserBundle\Entity\Invitation", inversedBy="user")
     * @ORM\JoinColumn(referencedColumnName="code")
     * @Assert\NotNull(message="Your invitation is wrong")
     */
    protected $invitation;    



    /**
     * Construct
     */
    public function __construct()
    {   
        parent::__construct();
        
        //Initialize groups
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    
    /**
     * Set invitation
     * 
     * @param Invitation $invitation Set the invitation for user.
     */
    public function setInvitation(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }
    
    /**
     * Get invitation
     * 
     * @return Invitation Get the invitation for user.
     */
    public function getInvitation()
    {
        return $this->invitation;
    }    
}