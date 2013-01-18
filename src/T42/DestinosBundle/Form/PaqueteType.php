<?php

namespace T42\DestinosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use T42\DestinosBundle\Form\FechaDeSalidaType;
use T42\DestinosBundle\Form\Type\TarifaType;
use T42\DestinosBundle\Form\Type\LinesToArrayFieldType;

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
            ->add('titulo', null, array('attr'=> $attr))
            ->add('segmento', null, array('attr'=> $attr))
            ->add('lugares', null, array('attr'=> $attr))
            ->add('resumen', 'textarea', array('attr'=> $attr))
            ->add('fechasDeSalida', 'collection', array(
                    'label'=>'Fechas de Salida',
                    'type' => 'fecha_de_salida',
                    'options' => array(
                        'label' => 'Fecha',
                        'required' => false,
                        'widget' => 'single_text',
                        'format' => 'dd/MM/y'
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                )
            )
            ->add('imagenes', null, array('attr'=> $attr, 'required'=>false))
            ->add('esGrupal', null, array('label'=>'Viaje Grupal'))
            ->add('esDestacado', null, array('label'=>'Viaje Destacado'))
            ->add('observaciones', null, array('attr'=> $attr))
            ->add('tarifas', 'collection', array(
                    'label'=>'Tarifas',
                    'type' => new TarifaType(),
                    'options' => array(
                        'label' => 'Tarifa',
                    ),
                    'required' => false,
                    'allow_add' => true,
                    'allow_delete' => true
                )
             )
            ->add('serviciosIncluidos', new LinesToArrayFieldType(), array('label'=>'Servicios Incluidos', 'attr'=> $attr))
            ->add('serviciosNoIncluidos', new LinesToArrayFieldType(), array('label'=>'Servicios No Incluidos', 'attr'=> $attr))
            ->add('itinerario', 'ckeditor')
            ->add('desactivar', null, array('label'=>'Desactivar'))
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
