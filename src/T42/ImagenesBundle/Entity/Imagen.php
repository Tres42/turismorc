<?php

namespace T42\ImagenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Imagine\Gd\Imagine;

/**
 * T42\ImagenesBundle\Entity\Imagen
 *
 * Clase que representa una imagen de un destino.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @ORM\Entity
 * @ORM\Table(name="imagen")
 * @ORM\HasLifecycleCallbacks
 */
class Imagen
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize="10M")
     */
    private $imageFile;

    /**
     * Constante que representa el ancho y alto maximo de pixels.
     */
    const MAX_PIXELS = 1600;

    /**
     * Constante que representa la accion de disminucion del
     * ancho de la imagen.
     */
    const WIDTH = 0;

    /**
     * Constante que representa la accion de disminucion del
     * alto de la imagen.
     */
    const HEIGHT = 1;

    /**
     * Constante que representa la accion de disminucion del
     * ancho y alto de la imagen.
     */
    const BOTH = 2;

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
     * Asigna el titulo de la imagen.
     *
     * @param  string $titulo
     * @return Imagen
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Retorna el titulo de la imagen.
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Asigna la descripcion de la imagen.
     *
     * @param  string $descripcion
     * @return Imagen
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Retorna la descripcion de la imagen.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Asigna el path o ubicacion de la imagen.
     *
     * @param  string $path
     * @return Imagen
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Retorna el path o ubicacion de la imagen.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Retorna el archivo de imagen subido en el
     * formulario.
     *
     * @return UploadedFile imageFile Archivo de imagen.
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Asigna el archivo de imagen.
     *
     * @param UploadedFile $file Archivo de imagen.
     */
    public function setImageFile($file)
    {
        $this->imageFile = $file;
    }

    /**
     * Retorna el camino absoluto incluyendo el nombre del archivo donde
     * se guarda la imagen.
     *
     * @return String
     */
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    /**
     * Retorna el nombre del directorio web donde se almacena la imagen
     * incluyendo el nombre del archivo.
     *
     * @return String
     */
    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    /**
     * Retorna el camino completo donde se guarda la imagen.
     *
     * @return String
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Retorna el nombre del directorio donde se almacenan
     * las imagenes.
     *
     * @return String
     */
    protected function getUploadDir()
    {
        return 'uploads/images';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->imageFile) {
            if (empty($this->titulo)) {
                //Asignamos el nombre original del archivo como titulo de la imagen.
                $this->titulo = $this->imageFile->getClientOriginalName();
            }
            // Genera un nombre unico al archivo
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename . '.' . $this->imageFile->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->imageFile) {
            return;
        }

        //Obtenemos el ancho y alto de la imagen subida
        list($width, $height) = getimagesize($this->imageFile);

        //Verificamos si el alto o el ancho son mayores a los maximos pixels permitidos.
        if ($width>Imagen::MAX_PIXELS && $height>Imagen::MAX_PIXELS) {
            $this->resizeAndSaveImage($this->imageFile, Imagen::BOTH, $this->imageFile->getRealPath());
        } elseif ($width>Imagen::MAX_PIXELS || $height>Imagen::MAX_PIXELS) {
            $accion = ($width>Imagen::MAX_PIXELS) ? Imagen::WIDTH : Imagen::HEIGHT;
            $this->resizeAndSaveImage($this->imageFile, $accion, $this->imageFile->getRealPath());
        } else {
            $this->imageFile->move($this->getUploadRootDir(), $this->path);
        }

        unset($this->imageFile);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * Realiza el procesamiento de la imagen utilizando la libreria
     * imagine y realiza el guardado de la imagen en el servidor.
     *
     * @param UploadedFile $imagen El archivo subido en el formulario.
     * @param int          $accion Numero de accion a realizar (Los valores son los definidos
     *                    por las constantes WIDTH, HEIGHT y BOTH)
     * @param String $tmpPath El camino absoluto al directorio temporario donde se guarda la
     *                        imagen al subirse en un formulario.
     */
    private function resizeAndSaveImage($imagen, $accion, $tmpPath)
    {
        $imagine = new Imagine();
        $imageOpen = $imagine->open($imagen);
        //Verificamos que accion aplicar
        switch ($accion) {
            case Imagen::WIDTH:
                $image = $imageOpen
                        ->getSize()
                        ->widen(Imagen::MAX_PIXELS);
                break;
            case Imagen::HEIGHT:
                $image = $imageOpen
                        ->getSize()
                        ->heighten(Imagen::MAX_PIXELS);
            case Imagen::BOTH:
                $image = $imageOpen
                        ->getSize()
                        ->widen(Imagen::MAX_PIXELS)
                        ->heighten(Imagen::MAX_PIXELS);
                break;
        }
        //Realiza el redimensionado de la imagen pasando como parametro el
        //objeto de tipo Box.
        $imageOpen->resize($image);
        $imageOpen->save($this->getAbsolutePath());
        unlink($tmpPath);
    }

    /**
     * Metodo necesario para mostrar el titulo de las imagenes
     * en el campo imagenes del form de paquetes.
     */
    public function __toString()
    {
        return $this->titulo;
    }
}
