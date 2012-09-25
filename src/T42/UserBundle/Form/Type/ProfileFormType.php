<?php

namespace T42\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
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
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        parent::buildForm($builder, $options);
        $builder->add('lastname', null, array('label' => 'Apellido'))
                ->add('firstname', null, array('label' => 'Nombre'))
                ->add('address', null, array('label' => 'Direccion'))
                ->add('phoneNumber', null, array('label' => 'Numero de Telefono'))
        ;
        
    }

    public function getName()
    {
        return 't42_user_profile';
    }
    
}