<?php

namespace T42\DestinosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form de Fechas de salidas necesario para crear el campo en 
 * el form de paquetes de viajes.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 * 
 */
class FechaDeSalidaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha');
    }    
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\DestinosBundle\Entity\FechaDeSalida'
        ));
    }
    
    public function getName()
    {
       return 'fechaDeSalida';  
    }
}