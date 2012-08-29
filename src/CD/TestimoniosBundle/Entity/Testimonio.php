<?php

namespace CD\TestimoniosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CD\TestimoniosBundle\Entity\Testimonio
 * 
 * Representa el testimonio de un viajante.
 *
 * @author Cristian Tosco
 *
 * 
 * @ORM\Entity
 * @ORM\Table(name="testimonio")
 */
class Testimonio 
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
    private $organizacion;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comentario;
            

    
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
     * @return Testimonio
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
     * Set organizacion
     *
     * @param string $organizacion
     * @return Testimonio
     */
    public function setOrganizacion($organizacion)
    {
        $this->organizacion = $organizacion;
    
        return $this;
    }

    /**
     * Get organizacion
     *
     * @return string 
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Testimonio
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }
}