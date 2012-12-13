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
     * @Route("/new")
     * @Template()
     */
    public function newAction(Request $request) {

        $invitation = new Invitation();

        $form = $this->createFormBuilder($invitation)
                ->add('email', 'email', array('label' => 'E-Mail', 'attr'=>array('class' => 'span9')))
                ->getForm();

        return array(
            'entity' => $invitation,
            'form' => $form->createView(),
        );
    }

    /**
     * Method the sending of the invitation
     *
     * @Route("/")
     * @Method("POST")
     * @Template("T42UserBundle:Invitation:new.html.twig")
     */
    public function sendAction(Request $request) {
        $invitation = new Invitation();
        $form = $this->createFormBuilder($invitation)
                ->add('email', 'email', array('label' => 'E-Mail'))
                ->getForm();
        $form->bind($request);

        if ($form->isValid()) {
            //We obtain the form of email data
            $email = $form->get('email')->getData();

            //Save the object invitation
            $invitation->setEmail($email);

            //The object persist
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();

            //Send e-mail
            $mensaje = \Swift_Message::newInstance()
                    ->setSubject('Bienvenido a Turismo Rio Cuarto!')
                    ->setFrom('ctosco@tres42.com.ar')
                    ->setTo($email)
                    ->setBody($this->renderView('T42UserBundle:Invitation:invitation.txt.twig', array('invitation' => $invitation)));

            $this->get('mailer')->send($mensaje);

            $this->get('session')->getFlashBag()->add('success', 'La invitacion fue enviada correctamente');

            //Redirect the url
            return $this->redirect($this->generateUrl('fos_user_profile_list'));
        }

        return array(
            'entity' => $invitation,
            'form' => $form->createView(),
        );
    }

}
