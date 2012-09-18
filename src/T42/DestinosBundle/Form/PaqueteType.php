<?php

namespace T42\DestinosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * T42\DestinosBundle\Form\PaqueteType
 * 
 * Form de paquete.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 */
class PaqueteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('fechaSalida', null, array('widget' => 'single_text', 'label'=>'Fecha de Salida','format' => 'dd-MM-yyyy'))
            ->add('esGrupal', null, array('label'=>'Viaje Grupal'))
            ->add('esPromocion', null, array('label'=>'Viaje Promocional'))
            ->add('observaciones')
            ->add('tarifas')
            ->add('serviciosIncluidos', null, array('label'=>'Servicios Incluidos'))
            ->add('serviciosNoIncluidos', null, array('label'=>'Servicios No Incluidos'))
            ->add('itinerario')
            ->add('resumen')
            ->add('categoria')
            ->add('ciudades')
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
