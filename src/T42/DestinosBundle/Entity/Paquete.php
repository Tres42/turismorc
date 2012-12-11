<?php

namespace T42\DestinosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use T42\DestinosBundle\Entity\FechaDeSalida;
use T42\DestinosBundle\Entity\Tarifa;
use T42\DestinosBundle\Entity\Segmento;

/**
 * T42\DestinosBundle\Entity\Paquete
 * 
 * Representa un paquete de viajes.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 * @ORM\Entity
 * @ORM\Table(name="paquete")
 * @ORM\HasLifecycleCallbacks()
 */
class Paquete
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $titulo;

    /**
     * @ORM\Column(type="boolean", length=100, name="es_grupal", nullable=true)
     */
    private $esGrupal;

    /**
     * @ORM\Column(type="boolean", length=100, name="es_promocion", nullable=true)
     */
    private $esPromocion;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\Column(type="text", length=255, name="servicios_incluidos", nullable=true)
     */
    private $serviciosIncluidos;

    /**
     * @ORM\Column(type="text", name="servicios_no_incluidos", nullable=true)
     */
    private $serviciosNoIncluidos;

    /**
     * @ORM\Column(type="text", name="itinerario", nullable=true)
     */
    private $itinerario;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $resumen;

    /**
     * @ORM\ManyToOne(targetEntity="T42\DestinosBundle\Entity\Segmento")
     * @ORM\JoinColumn()
     **/    
    private $segmento;

    /**
     * @ORM\ManyToMany(targetEntity="T42\DestinosBundle\Entity\FechaDeSalida", inversedBy="paquetes", cascade={"persist"})
     * @ORM\JoinTable(name="paquete_fecha")
     */
    private $fechasDeSalida;

    /**
     * @ORM\ManyToMany(targetEntity="T42\DestinosBundle\Entity\Lugar")
     * @ORM\JoinTable()
     */
    private $lugares;

    /**
     * @ORM\OneToMany(targetEntity="T42\DestinosBundle\Entity\Tarifa", mappedBy="paquete", cascade={"all"})
     */
    private $tarifas;

    /**
     * Constructor del objeto paquete de viajes.
     */
    public function __construct()
    {
        // Creamos el objeto tarifas el cual posee conceptos y sus respectivas tarifas
        $this->tarifas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ciudad = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fechasDeSalida = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Retorna el id del paquete.
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Asigna el titulo al paquete.
     *
     * @param string $titulo
     * @return Paquete
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Retorna el titulo del paquete.
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Asigna un valor de verdad si el paquete es o 
     * no grupal.
     *
     * @param boolean $esGrupal
     * @return Paquete
     */
    public function setEsGrupal($esGrupal)
    {
        $this->esGrupal = $esGrupal;

        return $this;
    }

    /**
     * Retorna un valor de verdad si el paquete es o 
     * no grupal.
     *
     * @return boolean 
     */
    public function getEsGrupal()
    {
        return $this->esGrupal;
    }

    /**
     * Asigna un valor de verdad si el paquete es una promocion.
     *
     * @param boolean $esPromocion
     * @return Paquete
     */
    public function setEsPromocion($esPromocion)
    {
        $this->esPromocion = $esPromocion;

        return $this;
    }

    /**
     * Retorna un valor de verdad si el paquete es una promocion.
     *
     * @return boolean 
     */
    public function getEsPromocion()
    {
        return $this->esPromocion;
    }

    /**
     * Asigna las observaciones del paquete de viajes.
     *
     * @param string $observaciones
     * @return Paquete
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Retorna las observaciones del paquete de viajes.
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Asigna las tarifas del paquete de viajes.
     *
     * @param \stdClass $tarifas
     * @return Paquete
     */
    public function setTarifas($tarifas)
    {
        $this->tarifas = $tarifas;

        return $this;
    }

    /**
     * Retorna las tarifas del paquete de viajes.
     *
     * @return \stdClass 
     */
    public function getTarifas()
    {
        return $this->tarifas;
    }

    /**
     * Add tarifa
     *
     * @param \T42\DestinosBundle\Entity\Tarifa $tarifa
     * @return Paquete
     */
    public function addTarifa(\T42\DestinosBundle\Entity\Tarifa $tarifa)
    {
        $this->tarifas[] = $tarifa;

        return $this;
    }

    /**
     * Remove tarifa
     *
     * @param \T42\DestinosBundle\Entity\Tarifa $tarifa
     */
    public function removeTarifa(\T42\DestinosBundle\Entity\Tarifa $tarifa)
    {
        $this->tarifas->removeElement($tarifa);
    }

    /**
     * Remove the null tarifas
     * 
     * @ORM\PrePersist
     */
    public function removeNullTarifas()
    {
        $this->tarifas = $this->tarifas->filter(
                function ($value) {
                    return (bool) $value;
                }
        );
    }

    /**
     * Removes the tarifas in parameter which are in the same and in the 
     * tarifas of the actual instance.
     *       
     * @param Array $originaltarifas 
     */
    public function toDeleteTarifas($originalTarifas)
    {
        foreach ($this->getTarifas() as $tarifa) {
            if (!$tarifa->getPrecio()) {
                $this->removeTarifa($tarifa);
                continue;
            }
            foreach ($originalTarifas as $key => $toDel) {
                if ($toDel->getId() === $tarifa->getId()) {
                    unset($originalTarifas[$key]);
                }
            }
        }
        return $originalTarifas;
    }

    /**
     * Retorna los servicios incluidos del paquete de viajes.
     *
     * @param string $serviciosIncluidos
     * @return Paquete
     */
    public function setServiciosIncluidos($serviciosIncluidos)
    {
        $this->serviciosIncluidos = $serviciosIncluidos;

        return $this;
    }

    /**
     * Retorna un string con los servicios que incluye el paquete de 
     * viajes.
     *
     * @return string 
     */
    public function getServiciosIncluidos()
    {
        return $this->serviciosIncluidos;
    }

    /**
     * Asigna un string con los servicios que no incluye el paquete de 
     * viajes.
     *
     * @param string $serviciosNoIncluidos
     * @return Paquete
     */
    public function setServiciosNoIncluidos($serviciosNoIncluidos)
    {
        $this->serviciosNoIncluidos = $serviciosNoIncluidos;

        return $this;
    }

    /**
     * Retorna un string con los servicios que no incluye el paquete de 
     * viajes.
     *
     * @return string 
     */
    public function getServiciosNoIncluidos()
    {
        return $this->serviciosNoIncluidos;
    }

    /**
     * Asigna el string con los itinerario del paquete.
     *
     * @param string $itinerario
     * @return Paquete
     */
    public function setItinerario($itinerario)
    {
        $this->itinerario = $itinerario;

        return $this;
    }

    /**
     * Retorna el string con el itinerario del paquete.
     *
     * @return string 
     */
    public function getItinerario()
    {
        return $this->itinerario;
    }

    /**
     * Set segmento
     *
     * @param \T42\DestinosBundle\Entity\Segmento $segmento
     * @return Paquete
     */
    public function setSegmento(\T42\DestinosBundle\Entity\Segmento $segmento = null)
    {
        $this->segmento = $segmento;
    
        return $this;
    }

    /**
     * Get segmento
     *
     * @return \T42\DestinosBundle\Entity\Segmento 
     */
    public function getSegmento()
    {
        return $this->segmento;
    }
    
    /**
     * Asigna el resumen del paquete.
     *
     * @param string $resumen
     * @return Paquete
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Retorna el resumen del paquete.
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Add fechasDeSalida
     *
     * @param T42\DestinosBundle\Entity\FechaDeSalida $fechasDeSalida
     * @return Paquete
     */
    public function addFechasDeSalida(\T42\DestinosBundle\Entity\FechaDeSalida $fechasDeSalida)
    {
        $this->fechasDeSalida[] = $fechasDeSalida;

        return $this;
    }

    /**
     * Remove fechasDeSalida
     *
     * @param T42\DestinosBundle\Entity\FechaDeSalida $fechasDeSalida
     */
    public function removeFechasDeSalida(\T42\DestinosBundle\Entity\FechaDeSalida $fechasDeSalida)
    {
        $this->fechasDeSalida->removeElement($fechasDeSalida);
    }

    /**
     * Get fechasDeSalida
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFechasDeSalida()
    {
        return $this->fechasDeSalida;
    }

    /**
     * Get fechasDeSalida
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function setFechasDeSalida($fechasDeSalida)
    {
        $this->fechasDeSalida = $fechasDeSalida;
    }

    /**
     * @ORM\PrePersist
     */
    public function removeNullFechasDeSalida()
    {
        $this->fechasDeSalida = $this->fechasDeSalida->filter(
                function ($value) {
                    return (bool) $value;
                }
        );
    }

    /**
     * Add lugar
     *
     * @param \T42\DestinosBundle\Entity\Lugar $lugares
     * @return Paquete
     */
    public function addLugar(\T42\DestinosBundle\Entity\Lugar $lugar)
    {
        $this->lugares[] = $lugar;
    
        return $this;
    }

    /**
     * Remove lugar
     *
     * @param \T42\DestinosBundle\Entity\Lugar $lugares
     */
    public function removeLugar(\T42\DestinosBundle\Entity\Lugar $lugar)
    {
        $this->lugares->removeElement($lugar);
    }

    /**
     * Get lugares
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLugares()
    {
        return $this->lugares;
    }
}