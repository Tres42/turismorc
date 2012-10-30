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
            ->add('itinerario', 'ckeditor', array(
                    'transformers'           => array('strip_js', 'strip_css', 'strip_comments'),
                    'toolbar'                => array('clipboard','basicstyles', 'paragraph'),
                    'toolbar_groups'         => array(
                        'clipboard' => array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
                        'basicstyles' => array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
                        'paragraph' => array('NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft', 'JustifyCenter','JustifyRight','JustifyBlock')
                    ),
                    'ui_color'               => '#fff',
                    'startup_outline_blocks' => false,
                    'width'                  => '100%',
                    'height'                 => '320',
                    ))
            ->add('resumen', 'textarea')
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
