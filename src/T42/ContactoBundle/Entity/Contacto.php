<?php

namespace T42\ContactoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T42\ContactoBundle\Entity\Contacto
 * 
 * Clase que representa los datos del formulario de contacto
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="contacto")
 */
class Contacto 
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
    private $apellido;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $domicilio;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $provincia;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $destinos;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $mensaje;


    /**
     * Retorna el id de contacto
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el nombre de contacto
     *
     * @param string $nombre
     * @return Contacto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Retorna el nombre del contacto.
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Asigna el apellido del contacto.
     *
     * @param string $apellido
     * @return Contacto
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Retorna el apellido del contacto
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Asigna el domicilio del contacto.
     *
     * @param string $domicilio
     * @return Contacto
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    
        return $this;
    }

    /**
     * Retorna el domicilio del contacto.
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Asigna la localidad del contacto.
     *
     * @param string $localidad
     * @return Contacto
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Retorna la localidad del contacto.
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Asigna la provincia del contacto.
     *
     * @param string $provincia
     * @return Contacto
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Retorna la provincia del contacto.
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Asigna el telefono del contacto.
     *
     * @param string $telefono
     * @return Contacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Retorna el telefono del contacto.
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Asigna los destinos de los cuales se desea recibir 
     * informacion.
     *
     * @param string $destinos
     * @return Contacto
     */
    public function setDestinos($destinos)
    {
        $this->destinos = $destinos;
    
        return $this;
    }

    /**
     * Retorna los destinos de los cuales se desea recibir 
     * informacion.
     *
     * @return string 
     */
    public function getDestinos()
    {
        return $this->destinos;
    }

    /**
     * Asigna el email del contacto.
     *
     * @param string $email
     * @return Contacto
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Retorna el email del contacto.
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Asigna el mensaje del contacto.
     *
     * @param string $mensaje
     * @return Contacto
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    
        return $this;
    }

    /**
     * Retorna el mensaje del contacto.
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }
}