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
     * @ORM\Column(type="text", length=255)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="array")
     */
    private $tarifas;

    /**
     * @ORM\Column(type="text", length=255, name="servicios_incluidos")
     */
    private $serviciosIncluidos;

    /**
     * @ORM\Column(type="text", name="servicios_no_incluidos")
     */
    private $serviciosNoIncluidos;

    /**
     * @ORM\Column(type="text", name="itinerario")
     */
    private $itinerario;

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
     * Constructor
     */
    public function __construct() {
        // Creamos el objeto tarifas el cual posee conceptos y sus respectivas tarifas
        $this->tarifas = new Object();
        $this->ciudad = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set serviciosIncluidos
     *
     * @param string $serviciosIncluidos
     * @return Paquete
     */
    public function setServiciosIncluidos($serviciosIncluidos) {
        $this->serviciosIncluidos = $serviciosIncluidos;

        return $this;
    }

    /**
     * Get serviciosIncluidos
     *
     * @return string 
     */
    public function getServiciosIncluidos() {
        return $this->serviciosIncluidos;
    }

    /**
     * Set serviciosNoIncluidos
     *
     * @param string $serviciosNoIncluidos
     * @return Paquete
     */
    public function setServiciosNoIncluidos($serviciosNoIncluidos) {
        $this->serviciosNoIncluidos = $serviciosNoIncluidos;

        return $this;
    }

    /**
     * Get serviciosNoIncluidos
     *
     * @return string 
     */
    public function getServiciosNoIncluidos() {
        return $this->serviciosNoIncluidos;
    }

    /**
     * Set itinerario
     *
     * @param string $itinerario
     * @return Paquete
     */
    public function setItinerario($itinerario) {
        $this->itinerario = $itinerario;

        return $this;
    }

    /**
     * Get itinerario
     *
     * @return string 
     */
    public function getItinerario() {
        return $this->itinerario;
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
     * Add ciudad
     *
     * @param T42\DestinosBundle\Entity\Ciudad $ciudad
     * @return Paquete
     */
    public function addCiudad(\T42\DestinosBundle\Entity\Ciudad $ciudad) {
        $this->ciudad[] = $ciudad;

        return $this;
    }

    /**
     * Remove ciudad
     *
     * @param T42\DestinosBundle\Entity\Ciudad $ciudad
     */
    public function removeCiudad(\T42\DestinosBundle\Entity\Ciudad $ciudad) {
        $this->ciudad->removeElement($ciudad);
    }

    /**
     * Get ciudad
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCiudad() {
        return $this->ciudad;
    }

    public function addTarifa(Tarifa $tarifa) {
        $this->tarifas = array($tarifa->identificador => $tarifa);
    }

    public function removeTarifa(Tarifa $tarifa) {
        if (false !== $key = array_search($tarifa->identificador, $this->tarifas, true)) {
            unset($this->tarifas[$key]);
            $this->tarifas = array_values($this->tarifas);
        }
    }

}

/**
 * Clase que representa una tarifa, posee dos atributos el concepto y el monto de 
 * la tarifa.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 */
class Tarifa {

    /**
     * Identificador interno unico de tarifas
     */
    public $identificador;

    /*
     * El concepto que maneja la empresa
     * 
     * Ej: SINGLE, DOUBLE o TRIPLE
     */
    public $concepto;

    /*
     *  El monto en dolares o pesos.
     */
    public $monto;

    /**
     * Constructor que inicializa el valor del identificador.
     */
    public function __construct() {
        $this->identificador = 0;
    }

}