<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * T42\DestinosBundle\Entity\Ciudad
 * 
 * Representa una ciudad en el paquete de viajes.
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
     * Retorna el id de la Ciudad.
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el nombre de la ciudad.
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
     * Retorna el nombre de la ciudad.
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Asigna el nombre de la provincia a la cual pertenece la ciudad.
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
     * Retorna el nombre de la provincia a la cual pertenece la ciudad.
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Asigna el pais al cual pertenece la ciudad.
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
     * Retorna el pais al cual pertenece la ciudad.
     *
     * @return T42\DestinosBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }
    
    /**
     * Metodo magico que retorna el nombre para la coleccion de ciudades.
     */
    public function __toString() {
        return $this->nombre;
    }
}