<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * T42\DestinosBundle\Entity\Pais
 * 
 * Representa un Pais en el paquete de viajes.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="pais")
 */
class Pais 
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
     * Retorna el id del pais.
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el nombre al pais
     *
     * @param string $nombre
     * @return Pais
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Retorna el nombre del pais.
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}