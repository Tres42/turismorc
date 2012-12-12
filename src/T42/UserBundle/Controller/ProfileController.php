<?php

namespace T42\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseProfileController;
use JMS\SecurityExtraBundle\Annotation\Secure;

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
     *
     * @Secure(roles="ROLE_USUARIOS_VIEW")
     */
    public function listAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $entities = $userManager->findUsers();

        $paginator = $this->container->get('knp_paginator');

        $pagination = $paginator->paginate(
            $entities,
            $this->container->get('request')->query->get('page', 1),
            10
        );


        return $this->container->get('templating')->renderResponse('T42UserBundle:Profile:list.html.' . $this->container->getParameter('fos_user.template.engine'), array('pagination' => $pagination));
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

        $deleteForm = $this->createDeleteForm($id);

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.' . $this->container->getParameter('fos_user.template.engine'), array('user' => $user, 'delete_form'=>$deleteForm->createView()));
    }

    /**
     * Edit the user
     * @Secure(roles="ROLE_USUARIOS_EDIT")
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
        $deleteForm = $this->createDeleteForm($id);


        $process = $formHandler->process($user);
        if ($process) {
            $message = $this->trans('profile.flash.updated');
            $this->setFlash('success', $message);

            return new RedirectResponse($this->getRedirectionUrl($user));
        }

        return $this->container->get('templating')->renderResponse(
                        'FOSUserBundle:Profile:edit.html.' . $this->container->getParameter('fos_user.template.engine'), array('form' => $form->createView(), 'user' => $user, 'delete_form'=>$deleteForm->createView())
        );
    }

    /**
     * Delete the user
     * @Secure(roles="ROLE_USUARIOS_DELETE")
     */
    public function deleteAction(Request $request)
    {
        //Get the id of the form
        $form_request = $request->get('form');
        $id = $form_request['id'];

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if($form->isValid()){
            //Get the UserManager of FOSUserBundle
            $userManager = $this->container->get('fos_user.user_manager');

            //Get the user from database
            $user = $userManager->findUserBy(array('id' => $id));

            if (!$user) {
                //Error message
                $this->setFlash('error', 'El usuario que quiere eliminar no existe');
            } else {
                //Delete the user
                $userManager->deleteUser($user);
                //Succes message
                $this->setFlash('success', 'El usuario se ha eliminado correctamente');
            }
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

    /**
     *  Method that translates a message from the message as a parameter
     *  an array of values ​​and the dictionary used.
     *
     * @param String $key The message to be translated
     * @param Array $vars An array with the values ​​of the variables
     * @param String $dict The dictionary to use
     */
    private function trans($key, $vars = array(), $dict = 'FOSUserBundle')
    {
        return $this->container->get('translator')->trans($key, $vars, $dict);
    }

    /**
     * Create a new Package removal form.
     */
    private function createDeleteForm($id)
    {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
