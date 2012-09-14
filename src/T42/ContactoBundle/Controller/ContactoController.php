<?php

namespace T42\ContactoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use T42\ContactoBundle\Entity\Contacto;
use \T42\ContactoBundle\Form\ContactoType;

/**
 * T42\ContactoBundle\Controller\ContactoController
 * 
 * Controlador de contacto.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @Route("/contacto")
 */
class ContactoController extends Controller 
{

    /**
     * @Route("/", name="contacto")
     * @Template()
     */
    public function contactAction() {
        $contacto = new Contacto();
        $form = $this->createForm(new ContactoType(), $contacto);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                // Enviamos el correo electrónico
                $mensaje = \Swift_Message::newInstance()
                        ->setSubject('Contacto enviado desde Turismo Rio Cuarto')
                        ->setFrom('ctosco@tres42.com.ar')
                        ->setTo($this->container->getParameter('turismorc.emails.email_contacto'))
                        ->setBody($this->renderView('ContactoBundle:Contacto:emailContacto.txt.twig', array('contacto' => $contacto)));
                
                $this->get('mailer')->send($mensaje);
                
                $this->get('session')->setFlash('Turismo Rio Cuarto', 'Tu mensaje de contacto ha sido enviado, Gracias...');
                
                // Redirige - Si se actualiza la pagina
                return $this->redirect($this->generateUrl('contacto'));
            }
        }

        return $this->render('ContactoBundle:Contacto:contacto.html.twig', array(
                    'form' => $form->createView()
                ));
    }

}
