<?php

namespace T42\UserBundle\Controller;

use T42\UserBundle\Form\DataTransformer\InvitationToCodeTransformer;
use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * T42\UserBundle\Controller\RegistrationController
 *
 * Controller managing the registration
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>*
 */
class RegistrationController extends BaseRegistrationController
{
    /**
     * Method that sets the invitation code to form Registration
     *
     * @param Invitation $code The invitation code
     */
    public function registerWithCodeAction($code)
    {
        $form = $this->container->get('fos_user.registration.form');

        //Add the user to the invite code
        $em = $this->container->get('doctrine')->getManager();
        $invitation = $em->getRepository('T42UserBundle:Invitation')->findOneByCode($code);
        $form->get('invitation')->setData($invitation);


        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
                ));
    }

    /**
     * Method that performs the user registration in the
     * system and displays a message when performing flash
     * Registration
     */
    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                // Change the path to t42_backend_dashboard_index
                $route = 't42_backend_dashboard_index';
            }

            $message = $this->container->get('translator')->trans('registration.flash.user_created', array(), 'FOSUserBundle');
            $this->setFlash('success', $message);
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
                ));
    }

}
