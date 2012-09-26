<?php


namespace T42\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use T42\UserBundle\Entity\User;

/**
 * T42\UserBundle\Entity\Invitation
 * 
 * Entity that represents an invitation which 
 * is received by the users of web admin.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @ORM\Entity
 * @ORM\Table(name="invitation")
 */
class Invitation
{
    /** 
     * @ORM\Id 
     * @ORM\Column(type="string", length=6) 
     */
    protected $code;

    /** 
     * @ORM\Column(type="string", length=256) 
     */
    protected $email;

    /**
     * When sending invitation be sure to set this value to `true`
     *
     * It can prevent invitations from being sent twice
     *
     * @ORM\Column(type="boolean")
     */
    protected $sent = false;

    /** 
     * @ORM\OneToOne(targetEntity="T42\UserBundle\Entity\User", mappedBy="invitation", cascade={"persist", "merge"}) 
     */
    protected $user;

    
    /**
     * Constructor that generates the code to be sent 
     * for the invitation.
     */
    public function __construct()
    {
        // generate identifier only once, here a 6 characters length code
        $this->code = substr(md5(uniqid(rand(), true)), 0, 6);
    }

    /**
     * Get code
     * 
     * @return string Constructor generated code
     */
    public function getCode()
    {
        return $this->code;
    }
    
    /**
     * Get email
     * 
     * @return string Mail of user.
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set email
     * 
     * @param string $email Mail of user.
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns true if the invitation was sent.
     * 
     * @return boolean 
     */
    public function isSent()
    {
        return $this->sent;
    }
    
    /**
     * Assigns true to send the invitation
     */
    public function send()
    {
        $this->sent = true;
    }
    
    /**
     * Gets the user they underwent the sending 
     * invitation.
     * 
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Sets the user they underwent the sending 
     * invitation.
     * 
     * @param User $name Description
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}