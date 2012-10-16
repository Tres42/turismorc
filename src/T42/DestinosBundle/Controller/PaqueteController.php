<?php

namespace T42\DestinosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use T42\DestinosBundle\Entity\Paquete;
use T42\DestinosBundle\Form\PaqueteType;

/**
 * T42\DestinosBundle\Controller\PaqueteController
 * 
 * Controlador de paquete.
 * 
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 * @Route("admin/destinos")
 */
class PaqueteController extends Controller
{

    /**
     * Lista todas las entidades de paquetes.
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('T42DestinosBundle:Paquete')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Encuentra y muestra una entidad Paquete.
     *
     * @Route("/{id}/show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42DestinosBundle:Paquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Muestra el formulario para crear una nueva entidad de tipo Paquete.
     *
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paquete();
        $form = $this->createForm(new PaqueteType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Crea un nueva entidad Paquete.
     *
     * @Route("/create")
     * @Method("POST")
     * @Template("T42DestinosBundle:Paquete:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Paquete();
        $form = $this->createForm(new PaqueteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'El destino fue guardado correctamente');
            
            return $this->redirect($this->generateUrl('t42_destinos_paquete_index', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Muestra un formulario para editar un Paquete.
     *
     * @Route("/{id}/edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42DestinosBundle:Paquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paquete entity.');
        }

        $editForm = $this->createForm(new PaqueteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edita una entidad de tipo Paquete.
     *
     * @Route("/{id}/update")
     * @Method("POST")
     * @Template("T42DestinosBundle:Paquete:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42DestinosBundle:Paquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PaqueteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Los cambios fueron guardados correctamente');
            
            return $this->redirect($this->generateUrl('t42_destinos_paquete_index', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Borra un Paquete.
     *
     * @Route("/{id}/delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('T42DestinosBundle:Paquete')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paquete entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'El destino fue eliminado correctamente');
        }

        return $this->redirect($this->generateUrl('t42_destinos_paquete_index'));
    }

    /**
     * Imprime los detalles del destino
     *
     * @Route("/{id}/print")
     */
    public function printAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42DestinosBundle:Paquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paquete entity.');
        }
                
        $html = $this->renderView('T42DestinosBundle:Paquete:print.html.twig', array(
            'entity' => $entity
                ));

        return new Response(
                        $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                        200,
                        array(
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="Destinos.pdf"'
                        )
        );
    }

    /**
     * Crea un nuevo formulario de eliminacion de Paquete.
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}