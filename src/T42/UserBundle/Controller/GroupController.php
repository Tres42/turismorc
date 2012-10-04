<?php

namespace T42\UserBundle\Controller;

use \FOS\UserBundle\Controller\GroupController as BaseGroupController;

/**
 * Description of GroupController
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>* 
 */
class GroupController extends BaseGroupController
{
    
    public function listAction() {
        $groups = $this->container->get('fos_user.group_manager')->findGroups();

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Group:list.html.'.$this->getEngine(), array('groups' => $groups));        
    }
}