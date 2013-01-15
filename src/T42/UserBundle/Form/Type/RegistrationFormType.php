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
        $attr = array('class' => 'span10');
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr' => $attr))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr' => $attr))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle', 'attr' => $attr,),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('lastname', null, array('label' => 'Apellido', 'attr' => $attr,))
            ->add('firstname', null, array('label' => 'Nombre', 'attr' => $attr,))
            ->add('birthDate', 'date', array('label' => 'Fecha de Nacimiento', 'widget' => 'single_text', 'format' => 'dd/MM/y'))
            ->add('address', null, array('label' => 'Dirección', 'attr' => $attr,))
            ->add('phoneNumber', null, array('label' => 'Numero de Telefono', 'attr' => $attr,))
            ->add('alternativeEmail', 'email', array('label' => 'Email Alternativo', 'attr' => $attr, 'required' => False))
            ->add('invitation', 't42_invitation_type')
        ;
        
    }

    public function getName()
    {
        return 't42_user_registration';
    }
}
