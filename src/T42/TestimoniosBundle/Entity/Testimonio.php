<?php

namespace T42\TestimoniosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * T42\TestimoniosBundle\Entity\Testimonio
 * 
 * Entidad que representa el testimonio de un viajante.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @ORM\Entity(repositoryClass="T42\TestimoniosBundle\Entity\TestimonioRepository")
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $organizacion;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comentario;
            

    
    /**
     * Retorna el id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el nombre
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
     * Retorna el nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Asigna la organizacion
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
     * Retorna la organizacion
     *
     * @return string 
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * Asigna el comentario
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
     * Retorna el comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }
}