<?php

namespace T42\ContactoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * T42\ContactoBundle\Entity\Contacto
 * 
 * Clase que representa los datos del formulario de contacto
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 */
class Contacto 
{

    /**
     * El nombre de la persona que envia el mensaje.
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * El apellido de la persona que envia el mensaje.
     * @Assert\NotBlank()
     */
    private $apellido;

    /**
     * El domicilio de la persona que envia el mensaje.
     */
    private $domicilio;

    /**
     * La localidad de la persona que envia el mensaje.
     */
    private $localidad;

    /**
     * La provincia de la persona que envia el mensaje.
     */
    private $provincia;

    /**
     * El numero de telefono de la persona que envia el mensaje.
     */
    private $telefono;

    /**
     * Los destinos de los cuales desea obtener informacion al mail.
     */
    private $destinos;

    /**
     * El mail de la persona que completa el formulario de contacto
     * @Assert\NotBlank()
     * @Assert\Email(checkMX = true)     
     */
    private $email;

    /**
     * El mensaje de la persona que completa el formulario de contacto
     * @Assert\NotBlank()
     * @Assert\MaxLength(500)
     */
    private $mensaje;


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