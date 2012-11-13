<?php

namespace T42\DestinosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use T42\DestinosBundle\Form\DataTransformer\FechaDeSalidaToDateTransformer;


class FechaDeSalidaType extends AbstractType
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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new FechaDeSalidaToDateTransformer($this->om);
        $builder->addModelTransformer($transformer);
    }

    public function getParent()
    {
        return 'date';
    }
    
    public function getName()
    {
       return 'fecha_de_salida';
    }
}