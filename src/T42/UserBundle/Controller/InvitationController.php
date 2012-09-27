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
                ->add('code', 'hidden')
                ->add('email', 'email', array('label' => 'E-Mail'))
                ->getForm();
        $form->bind($request);

        if ($form->isValid()) {
            $data = $form->getData();

            // Enviamos el correo electrónico
            $mensaje = \Swift_Message::newInstance()
                    ->setSubject('Contacto enviado desde Turismo Rio Cuarto')
                    ->setFrom('ctosco@tres42.com.ar')
                    ->setTo($this->container->getParameter('turismorc.emails.email_contacto'))
                    ->setBody($this->renderView('T42ContactoBundle:Contacto:emailContacto.txt.twig', array('contacto' => $contacto)));

            $this->get('mailer')->send($mensaje);

            $this->get('session')->setFlash('Turismo Rio Cuarto', 'El codigo ha sido enviado');

            // Redirige - Si se actualiza la pagina
            return $this->redirect($this->generateUrl('contacto'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

}
