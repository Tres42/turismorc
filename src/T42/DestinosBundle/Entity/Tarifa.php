<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\ManyToMany(targetEntity="T42\DestinosBundle\Entity\Paquete", mappedBy="tarifas")
     */
    private $paquetes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paquetes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add paquetes
     *
     * @param \T42\DestinosBundle\Entity\Paquete $paquetes
     * @return Tarifa
     */
    public function addPaquete(\T42\DestinosBundle\Entity\Paquete $paquetes)
    {
        $this->paquetes[] = $paquetes;
    
        return $this;
    }

    /**
     * Remove paquetes
     *
     * @param \T42\DestinosBundle\Entity\Paquete $paquetes
     */
    public function removePaquete(\T42\DestinosBundle\Entity\Paquete $paquetes)
    {
        $this->paquetes->removeElement($paquetes);
    }

    /**
     * Get paquetes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaquetes()
    {
        return $this->paquetes;
    }
}