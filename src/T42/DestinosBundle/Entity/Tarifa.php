<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use T42\DestinosBundle\Entity\Paquete;

/**
 * T42\DestinosBundle\Entity\Tarifa
 * 
 * Representa una tarifa de un paquete de viaje, la misma posee una
 * descripcion y el precio de la misma.
 *  
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="tarifa")
 */
class Tarifa {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="T42\DestinosBundle\Entity\Paquete", inversedBy="tarifas")
     * @ORM\JoinColumn()
     */
    private $paquete;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tarifa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param float $precio
     * @return Tarifa
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set paquete
     *
     * @param \T42\DestinosBundle\Entity\Paquete $paquete
     * @return Tarifa
     */
    public function setPaquete(\T42\DestinosBundle\Entity\Paquete $paquete = null)
    {
        $this->paquete = $paquete;
    
        return $this;
    }

    /**
     * Get paquete
     *
     * @return \T42\DestinosBundle\Entity\Paquete 
     */
    public function getPaquete()
    {
        return $this->paquete;
    }
}