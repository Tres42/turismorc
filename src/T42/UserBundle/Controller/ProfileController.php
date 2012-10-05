<?php

namespace T42\UserBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseProfileController;

/**
 * T42\UserBundle\Controller\ProfileController
 * 
 * Profile controller.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>* 
 */
class ProfileController extends BaseProfileController
{

    /**
     * Lists all User.
     */
    public function listAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $entities = $userManager->findUsers();

        return $this->container->get('templating')->renderResponse('T42UserBundle:Profile:list.html.' . $this->container->getParameter('fos_user.template.engine'), array('entities' => $entities));
    }

    /**
     * Show the user
     */
    public function showAction($id = 0)
    {
        if (!$id) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        } else {
            //Buscar el usuario de la base           
            $user = $this->container->get('fos_user.user_manager')->findUserBy(array('id' => $id));
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.' . $this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }

    /**
     * Edit the user
     */
    public function editAction($id = 0)
    {
        if (!$id) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        } else {
            //The user is obtained from the base
            $user = $this->container->get('fos_user.user_manager')->findUserBy(array('id' => $id));
        }

        $form = $this->container->get('fos_user.profile.form');
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->getRedirectionUrl($user));
        }

        return $this->container->get('templating')->renderResponse(
                        'FOSUserBundle:Profile:edit.html.' . $this->container->getParameter('fos_user.template.engine'), array('form' => $form->createView(), 'user' => $user)
        );
    }

    /**
     * Delete the user
     */
    public function deleteAction($id = 0)
    {
        //Get the UserManager of FOSUserBundle
        $userManager = $this->container->get('fos_user.user_manager');
        
        //Get the user from database
        $user = $userManager->findUserBy(array('id' => $id));

        if (!$user) {
            //Error message
            $this->container->get('session')->getFlashBag()->add('error', 'El usuario que quiere eliminar no existe');
        } else {

            //Delete the user
            $userManager->deleteUser($user);
            //Succes message
            $this->container->get('session')->getFlashBag()->add('succes', 'El usuario se ha eliminado correctamente');
        }
        return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_list'));
    }

    /**
     * Generate the redirection url when editing is completed.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getRedirectionUrl(UserInterface $user)
    {
        return $this->container->get('router')->generate('fos_user_profile_show', array('id' => $user->getId()));
    }

}
