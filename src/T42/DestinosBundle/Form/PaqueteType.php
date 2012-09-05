<?php

namespace T42\DestinosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaqueteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('fechaSalida')
            ->add('esGrupal')
            ->add('esPromocion')
            ->add('observaciones')
            ->add('tarifas')
            ->add('servicioIncluido')
            ->add('servicioNoIncluido')
            ->add('resumen')
            ->add('categoria')
            ->add('ciudad')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\DestinosBundle\Entity\Paquete'
        ));
    }

    public function getName()
    {
        return 't42_destinosbundle_paquetetype';
    }
}
