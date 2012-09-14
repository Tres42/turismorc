<?php

namespace T42\ContactoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * T42\ContactoBundle\Form\PaqueteType
 * 
 * Form de contacto.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 */
class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('domicilio', 'text', array('required' => false))
            ->add('localidad', 'text', array('required' => false))
            ->add('provincia', 'text', array('required' => false))
            ->add('telefono', 'text', array('required' => false))
            ->add('destinos', 'text', array('required' => false))
            ->add('email', 'email')
            ->add('mensaje', 'textarea')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\ContactoBundle\Entity\Contacto'
        ));
    }

    public function getName()
    {
        return 't42_contactobundle_contactotype';
    }
}
