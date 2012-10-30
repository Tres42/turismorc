<?php

namespace T42\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;

/**
 * T42\UserBundle\Form\Type
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
        $attr = array('class' => 'span10');
        
        $this->buildCustomUserForm($builder, $options, $attr);
        
        $builder->add('current_password', 'password', array(
                    'label' => 'form.current_password',
                    'translation_domain' => 'FOSUserBundle',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                    'attr'=> $attr
                ))
                ->add('lastname', null, array('label' => 'Apellido', 'attr'=>$attr))
                ->add('firstname', null, array('label' => 'Nombre', 'attr'=>$attr))
                ->add('address', null, array('label' => 'Direccion', 'attr'=>$attr))
                ->add('phoneNumber', null, array('label' => 'Numero de Telefono', 'attr'=>$attr))
                ->add('groups', null, array('label'=>'Grupos', 'attr'=>$attr))
        ;
        
    }

    public function getName()
    {
        return 't42_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildCustomUserForm(FormBuilderInterface $builder, array $options, $attr)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'attr'=>$attr))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'attr'=>$attr))
        ;
    }
    
}