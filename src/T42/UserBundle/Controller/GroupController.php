<?php

namespace T42\UserBundle\Controller;

use \FOS\UserBundle\Controller\GroupController as BaseGroupController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * T42\UserBundle\Controller\GroupController
 * 
 * Description of GroupController
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>* 
 */
class GroupController extends BaseGroupController
{
    
    /**
     * List all groups
     */
    public function listAction()
    {
        $groups = $this->container->get('fos_user.group_manager')->findGroups();

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Group:list.html.' . $this->getEngine(), array('groups' => $groups));
    }

    /**
     * Show the new form
     */
    public function newAction()
    {
        $form = $this->container->get('fos_user.group.form');
        $formHandler = $this->container->get('fos_user.group.form.handler');

        $process = $formHandler->process();
        if ($process) {
            $message = $this->container->get('translator')->trans('group.flash.created', array(), 'FOSUserBundle');
            $this->setFlash('success', $message);

            $url = $this->container->get('router')->generate('fos_user_group_list');

            return new RedirectResponse($url);
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Group:new.html.' . $this->getEngine(), array(
                    'form' => $form->createview(),
                ));
    }

    /**
     * Edit one group, show the edit form
     */
    public function editAction($groupname)
    {
        $group = $this->findGroupBy('name', $groupname);
        $form = $this->container->get('fos_user.group.form');
        $formHandler = $this->container->get('fos_user.group.form.handler');

        $process = $formHandler->process($group);
        if ($process) {
            $message = $this->container->get('translator')->trans('group.flash.updated', array(), 'FOSUserBundle');
            $this->setFlash('success', $message);
            $groupUrl = $this->container->get('router')->generate('fos_user_group_list');

            return new RedirectResponse($groupUrl);
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Group:edit.html.' . $this->getEngine(), array(
                    'form' => $form->createview(),
                    'groupname' => $group->getName(),
                ));
    }

    /**
     * Delete one group
     */
    public function deleteAction($groupname)
    {
        $group = $this->findGroupBy('name', $groupname);
        $this->container->get('fos_user.group_manager')->deleteGroup($group);

        $message = $this->container->get('translator')->trans('group.flash.deleted', array(), 'FOSUserBundle');

        $this->setFlash('success', $message);

        return new RedirectResponse($this->container->get('router')->generate('fos_user_group_list'));
    }

}