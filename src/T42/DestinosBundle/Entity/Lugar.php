<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T42\DestinosBundle\Entity\Lugar
 * 
 * Clase que representa los lugares(Ciudad, Provincia o Pais) en el cual 
 * se realizan los itinerarios. 
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="lugar")
 */
class Lugar
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
     * @ORM\OneToOne(targetEntity="T42\DestinosBundle\Entity\Lugar", cascade={"persist"})
     * @ORM\JoinColumn(name="pertenece_id", referencedColumnName="id" , unique=false)
     */
    private $pertenece;


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
     * @return Lugar
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
     * Set pertenece
     *
     * @param \T42\DestinosBundle\Entity\Lugar $pertenece
     * @return Lugar
     */
    public function setPertenece(\T42\DestinosBundle\Entity\Lugar $pertenece = null)
    {
        $this->pertenece = $pertenece;
    
        return $this;
    }

    /**
     * Get pertenece
     *
     * @return \T42\DestinosBundle\Entity\Lugar 
     */
    public function getPertenece()
    {
        return $this->pertenece;
    }
    
    public function __toString() {
        return $this->nombre;
    }
}