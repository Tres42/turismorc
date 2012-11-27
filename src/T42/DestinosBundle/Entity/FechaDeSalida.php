<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T42\DestinosBundle\Entity\FechaDeSalida
 * 
 * Representa las fechas de salida que contienen los 
 * paquetes de viaje.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="fecha_salida")
 */
class FechaDeSalida
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="date", unique=true)
     */    
    private $fecha;
    
    /**
     * @ORM\ManyToMany(targetEntity="T42\DestinosBundle\Entity\Paquete", mappedBy="fechasDeSalida")
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return FechaDeSalida
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Add paquetes
     *
     * @param T42\DestinosBundle\Entity\Paquete $paquetes
     * @return FechaDeSalida
     */
    public function addPaquete(\T42\DestinosBundle\Entity\Paquete $paquetes)
    {
        $this->paquetes[] = $paquetes;
    
        return $this;
    }

    /**
     * Remove paquetes
     *
     * @param T42\DestinosBundle\Entity\Paquete $paquetes
     */
    public function removePaquete(\T42\DestinosBundle\Entity\Paquete $paquetes)
    {
        $this->paquetes->removeElement($paquetes);
    }

    /**
     * Get paquetes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPaquetes()
    {
        return $this->paquetes;
    }
}