<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * T42\DestinosBundle\Entity\Ciudad
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
     * @ORM\Column(type="string", length=100)
     */
    private $provincia;
    
    /** 
     * @ORM\ManyToOne(targetEntity="T42\DestinosBundle\Entity\Pais") 
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
     * Set provincia
     *
     * @param string $provincia
     * @return Ciudad
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set pais
     *
     * @param T42\DestinosBundle\Entity\Pais $pais
     * @return Ciudad
     */
    public function setPais(\T42\DestinosBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return T42\DestinosBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
    
    public function __toString() {
        return $this->nombre;
    }
}