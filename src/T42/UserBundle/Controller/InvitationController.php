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
    public function newAction(Request $request) {

        $invitation = new Invitation();

        $form = $this->createFormBuilder($invitation)
                ->add('email', 'email', array('label' => 'E-Mail'))
                ->getForm();

        return array(
            'entity' => $invitation,
            'form' => $form->createView(),
        );
    }

    /**
     * Method the sending of the invitation
     * 
     * @Route("/", name="invitation_send")
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
            //Obtenemos los datos del email del form
            $email = $form->get('email')->getData();

            //Guardamos el objeto invitation
            $invitation->setEmail($email);

            //Hacemos persistente el objeto
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();


            // Enviamos el correo electrónico
            $mensaje = \Swift_Message::newInstance()
                    ->setSubject('Invitacion de registración de usuario')
                    ->setFrom('ctosco@tres42.com.ar')
                    ->setTo($email)
                    ->setBody($this->renderView('T42UserBundle:Invitation:invitation.txt.twig', array('invitation' => $invitation)));

            $this->get('mailer')->send($mensaje);

            $this->get('session')->getFlashBag()->add('succes', 'El mensaje fue enviado!');

//          // Redirige - Si se actualiza la pagina
            return $this->redirect($this->generateUrl('invitation_new'));
        }

        return array(
            'entity' => $invitation,
            'form' => $form->createView(),
        );
    }

}
