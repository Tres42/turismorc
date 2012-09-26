<?php

namespace T42\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use T42\UserBundle\Entity\Invitation;
use T42\UserBundle\Form\Type\InvitationFormType;

/**
 * T42\UserBundle\Controller;
 * 
 * Controller invitations.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @Route("/admin/invitation")
 */
class InvitationController extends Controller
{

    /**
     * Displays the form to generate a new invitation
     *
     * @Route("/new", name="invitation_new")
     * @Template()
     */
    public function newAction(Request $request){

        $invitation = new Invitation();

        $form = $this->createFormBuilder($invitation)
                ->add('code', 'hidden')
                ->add('email', 'email', array('label'=>'E-Mail'))
                ->getForm();

        return array(
            'entity' => $invitation,
            'form' => $form->createView(),
        );
    }

}
