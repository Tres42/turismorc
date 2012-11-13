<?php
namespace T42\DestinosBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use T42\DestinosBundle\Entity\FechaDeSalida;

class FechaDeSalidaToDateTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (fechaDeSalida) to a DateTime (date).
     *
     * @param  FechaDeSalida|null $fechaDeSalida
     * @return \DateTime
     */
    public function transform($fechaDeSalida)
    {
        if ($fechaDeSalida && $fechaDeSalida->getFecha())
            return $fechaDeSalida->getFecha();

//        return $fechaDeSalida && $fechaDeSalida->getFecha() ? $fechaDeSalida->getFecha() : new \DateTime();
    }

    /**
     * Transforms a DateTime (date) to an object (fechaDeSalida).
     *
     * @param  \DateTime $date
     * @return FechaDeSalida|null
     */
    public function reverseTransform($date)
    {
        if (!$date) {
            return null;
        }

//        $datetime = new \DateTime($date);

        $fechaDeSalida = $this->om
            ->getRepository('T42DestinosBundle:FechaDeSalida')
            ->findOneBy(array('fecha' => $date))
        ;

        if (!$fechaDeSalida) {
            $fechaDeSalida = new FechaDeSalida();
            $fechaDeSalida->setFecha($date);
        }

        return $fechaDeSalida;
    }
}