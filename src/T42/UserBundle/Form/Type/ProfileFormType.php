<?php

namespace T42\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;

/**
 * T42\UserBundle\Entity\User
 * 
 * Class overwritten to add fields to the user form.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 */
class ProfileFormType extends BaseProfileFormType
{


    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', null, array('label' => 'Apellido', 'translation_domain' => 'FOSUserBundle'))
            ->add('name', null, array('label' => 'Nombre', 'translation_domain' => 'FOSUserBundle'))
            ->add('address', null, array('label' => 'Direccion', 'translation_domain' => 'FOSUserBundle'))
            ->add('phone_number', null, array('label' => 'Numero de Telefono', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
        ;
    }
}
