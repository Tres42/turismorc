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
            'choices' => array(
                            'ROLE_ADMIN' => 'Administrador',
                            'ROLE_TESTIMONIOS' => 'Administrar testimonios',
                            'ROLE_TESTIMONIOS_VIEW' => 'Ver testimonios',
                            'ROLE_TESTIMONIOS_ADD' => 'Agregar testimonios',
                            'ROLE_TESTIMONIOS_DELETE' => 'Eliminar testimonios',
                            'ROLE_TESTIMONIOS_EDIT' => 'Editar testimonios',
                            'ROLE_PAQUETES' => 'Administrar paquetes',
                            'ROLE_PAQUETES_VIEW' => 'Ver paquetes',
                            'ROLE_PAQUETES_ADD' => 'Agregar paquetes',
                            'ROLE_PAQUETES_DELETE' => 'Eliminar paquetes',
                            'ROLE_PAQUETES_EDIT' => 'Editar paquetes',
                            'ROLE_USUARIOS' => 'Administrar usuarios',
                            'ROLE_USUARIOS_VIEW' => 'Ver usuarios',
                            'ROLE_USUARIOS_ADD' => 'Agregar usuarios',
                            'ROLE_USUARIOS_DELETE' => 'Eliminar usuarios',
                            'ROLE_USUARIOS_EDIT' => 'Editar usuarios',
                            'ROLE_USER' => 'Usuario'
                        )
        ));
    }
    
    public function getName()
    {
        return 't42_user_group';
    }
    
}
