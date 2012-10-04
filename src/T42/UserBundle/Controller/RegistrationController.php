<?php

namespace T42\UserBundle\Controller;

use T42\UserBundle\Form\DataTransformer\InvitationToCodeTransformer;
use FOS\UserBundle\Controller\RegistrationController as BaseRegistrationController;

/**
 * Controller managing the registration
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>* 
 */
class RegistrationController extends BaseRegistrationController
{

    public function registerWithCodeAction($code) {
        $form = $this->container->get('fos_user.registration.form');
       
        //Add the user to the invite code
        $em = $this->container->get('doctrine')->getManager();
        $invitation = $em->getRepository('T42UserBundle:Invitation')->findOneByCode($code);
        $form->get('invitation')->setData($invitation);
        

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
                ));
    }

}
