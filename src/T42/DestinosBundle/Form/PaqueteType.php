<?php

namespace T42\DestinosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use T42\DestinosBundle\Form\FechaDeSalidaType;
use T42\DestinosBundle\Form\Type\TarifaType;

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
        $attr = array('class' => 'span10');
        $builder
            ->add('titulo')
            ->add('fechasDeSalida', 'collection', array(
                    'label'=>'Fechas de Salida',
                    'type' => 'fecha_de_salida',
                    'options' => array(
                        'label' => 'Fecha',
                        'required' => false,
                        'widget' => 'single_text',
                        'format' => 'd/M/y'
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
            )
            ->add('esGrupal', null, array('label'=>'Viaje Grupal'))
            ->add('esPromocion', null, array('label'=>'Viaje Promocional'))
            ->add('observaciones', null, array('attr'=> $attr))
            ->add('tarifas', 'collection', array(
                    'label'=>'Tarifas',
                    'type' => new TarifaType(),
                    'options' => array(
                        'label' => 'Tarifa',
                    ),
                    'required' => true,
                    'allow_add' => true,
                    'allow_delete' => true
                )
             )
            ->add('serviciosIncluidos', null, array('label'=>'Servicios Incluidos', 'attr'=> $attr))
            ->add('serviciosNoIncluidos', null, array('label'=>'Servicios No Incluidos', 'attr'=> $attr))
            ->add('itinerario', 'ckeditor')
            ->add('resumen', 'textarea', array('attr'=> $attr))
            ->add('categoria', null, array('attr'=> $attr))
            ->add('ciudades', null, array('attr'=> $attr))
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
