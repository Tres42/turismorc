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
     * @Assert\File(maxSize="6000000")
     */
    private $imageFile;

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
     * Set titulo
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
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
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
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set path
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
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile($file)
    {
        $this->imageFile = $file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    /**
     * Retorna el camino absoluto adonde se guarda la imagen.
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Retorna el directorio adonde se almacenan las imagenes.
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
            $this->path = $this->getUploadDir() . '/' . $filename . '.' . $this->imageFile->guessExtension();
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

        $this->resizeImage();

        unset($this->imageFile);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Realiza el procesamiento de la imagen utilizando la libreria
     * imagine.
     */
    private function resizeImage()
    {
        //Obtenemos el ancho y alto de la imagen subida
        list($width, $height) = getimagesize($this->imageFile);

        $imagine = new Imagine();
        $imageOpen = $imagine->open($this->imageFile->getRealPath());
        if ($width>$height) {
            $image = $imageOpen
                    ->getSize()
                    ->widen($height);

        } else {
            $image = $imageOpen
                    ->getSize()
                    ->heighten($width);
        }
        $imageOpen->resize($image);
        $imageOpen->save($this->path);
    }

}
