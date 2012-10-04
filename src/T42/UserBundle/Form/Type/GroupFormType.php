<?php

namespace T42\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\GroupFormType as BaseGroupFormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class that inherits from GroupFormType.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar> 
 */
class GroupFormType extends BaseGroupFormType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('roles', 'choice', array(
            'label' => 'Roles',
            'multiple' => true,
            'choices' => array('ROLE_ADMIN' => 'Administrador',
                               'ROLE_USER' => 'Usuario')
        ));
    }
    
    public function getName()
    {
        return 't42_user_group';
    }
    
}
