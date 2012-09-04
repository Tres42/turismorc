<?php

namespace CD\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * CD\DestinosBundle\Entity\Ciudad
 * 
 * Representa una ciudad.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="ciudad")
 */
class Ciudad 
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /** 
     * @ORM\ManyToOne(targetEntity="CD\DestinosBundle\Entity\Pais") 
     */
    private $pais;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Ciudad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set pais
     *
     * @param CD\DestinosBundle\Entity\Pais $pais
     * @return Ciudad
     */
    public function setPais(\CD\DestinosBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return CD\DestinosBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
}