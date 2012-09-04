<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CD\TestimoniosBundle\Entity\Ciudad;

/**
 * T42\DestinosBundle\Entity\Paquete
 * 
 * Representa un paquete de viajes.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="paquete")
 */
class Paquete {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titulo;

    /**
     * @ORM\Column(type="date", name="fecha_salida")
     */
    private $fechaSalida;

    /**
     * @ORM\Column(type="boolean", length=100, name="es_grupal")
     */
    private $esGrupal;

    /**
     * @ORM\Column(type="boolean", length=100, name="es_promocion")
     */
    private $esPromocion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="object")
     */
    private $tarifas;

    /**
     * @ORM\Column(type="string", length=255, name="servicio_incluido")
     */
    private $servicioIncluido;

    /**
     * @ORM\Column(type="string", length=255, name="servicio_no_incluido")
     */
    private $servicioNoIncluido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resumen;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categoria;

    /**
     * @ORM\ManyToMany(targetEntity="T42\DestinosBundle\Entity\Ciudad")
     * @ORM\JoinTable()
     *      
     * */
    private $ciudad;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Paquete
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     * @return Paquete
     */
    public function setFechaSalida($fechaSalida) {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime 
     */
    public function getFechaSalida() {
        return $this->fechaSalida;
    }

    /**
     * Set esGrupal
     *
     * @param boolean $esGrupal
     * @return Paquete
     */
    public function setEsGrupal($esGrupal) {
        $this->esGrupal = $esGrupal;

        return $this;
    }

    /**
     * Get esGrupal
     *
     * @return boolean 
     */
    public function getEsGrupal() {
        return $this->esGrupal;
    }

    /**
     * Set esPromocion
     *
     * @param boolean $esPromocion
     * @return Paquete
     */
    public function setEsPromocion($esPromocion) {
        $this->esPromocion = $esPromocion;

        return $this;
    }

    /**
     * Get esPromocion
     *
     * @return boolean 
     */
    public function getEsPromocion() {
        return $this->esPromocion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Paquete
     */
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones() {
        return $this->observaciones;
    }

    /**
     * Set tarifas
     *
     * @param \stdClass $tarifas
     * @return Paquete
     */
    public function setTarifas($tarifas) {
        $this->tarifas = $tarifas;

        return $this;
    }

    /**
     * Get tarifas
     *
     * @return \stdClass 
     */
    public function getTarifas() {
        return $this->tarifas;
    }

    /**
     * Set servicioIncluido
     *
     * @param string $servicioIncluido
     * @return Paquete
     */
    public function setServicioIncluido($servicioIncluido) {
        $this->servicioIncluido = $servicioIncluido;

        return $this;
    }

    /**
     * Get servicioIncluido
     *
     * @return string 
     */
    public function getServicioIncluido() {
        return $this->servicioIncluido;
    }

    /**
     * Set servicioNoIncluido
     *
     * @param string $servicioNoIncluido
     * @return Paquete
     */
    public function setServicioNoIncluido($servicioNoIncluido) {
        $this->servicioNoIncluido = $servicioNoIncluido;

        return $this;
    }

    /**
     * Get servicioNoIncluido
     *
     * @return string 
     */
    public function getServicioNoIncluido() {
        return $this->servicioNoIncluido;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Paquete
     */
    public function setResumen($resumen) {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen() {
        return $this->resumen;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return Paquete
     */
    public function setCategoria($categoria) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ciudad = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add ciudad
     *
     * @param T42\DestinosBundle\Entity\Ciudad $ciudad
     * @return Paquete
     */
    public function addCiudad(\T42\DestinosBundle\Entity\Ciudad $ciudad)
    {
        $this->ciudad[] = $ciudad;
    
        return $this;
    }

    /**
     * Remove ciudad
     *
     * @param T42\DestinosBundle\Entity\Ciudad $ciudad
     */
    public function removeCiudad(\T42\DestinosBundle\Entity\Ciudad $ciudad)
    {
        $this->ciudad->removeElement($ciudad);
    }

    /**
     * Get ciudad
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }
}