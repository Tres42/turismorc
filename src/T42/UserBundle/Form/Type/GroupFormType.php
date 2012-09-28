<?php

namespace T42\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\GroupFormType as BaseGroupFormType;

/**
 * Class that inherits from GroupFormType.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar> 
 */
class GroupFormType extends BaseGroupFormType
{
    
    public function getName()
    {
        return 't42_user_group';
    }
    
}
