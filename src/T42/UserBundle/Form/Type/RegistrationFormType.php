<?php

namespace T42\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

/**
 * T42\UserBundle\Entity\User
 * 
 * Class overwritten to add fields to the user form.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 */
class RegistrationFormType extends BaseRegistrationFormType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('last_name', null, array('label' => 'Apellido'))
                ->add('name', null, array('label' => 'Nombre'))
                ->add('address', null, array('label' => 'Direccion'))
                ->add('phone_number', null, array('label' => 'Numero de Telefono'))
        ;
        
    }

    public function getName()
    {
        return 't42_user_registration';
    }
}
