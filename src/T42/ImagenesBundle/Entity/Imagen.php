<?php

namespace T42\ImagenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

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
     * @Assert\NotBlank
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
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
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
            // TODO Hacer el pre-procesamiento de la imagen
            $imagine = new Imagine();
            $image = $imagine->open($this->imageFile->getRealPath())
                        ->resize(new Box(1000, 500))
                        ->save($this->imageFile->getRealPath().'jpeg');
            //-------FIN TRATAMIENTO IMAGEN
            if (!empty($this->titulo)) {
                $this->path = $this->getUploadDir().'/'.$this->titulo.'.'.$this->imageFile->guessExtension();
            } else {
                // Genera un nombre unico al archivo
                $filename = sha1(uniqid(mt_rand(), true));
                $this->path = $this->getUploadDir().'/'.$filename.'.'.$this->imageFile->guessExtension();
            }
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

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->imageFile->move($this->getUploadRootDir(), $this->path);

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

}
