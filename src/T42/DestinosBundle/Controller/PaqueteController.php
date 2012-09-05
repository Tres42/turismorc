<?php

namespace T42\DestinosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use T42\DestinosBundle\Entity\Paquete;
use T42\DestinosBundle\Form\PaqueteType;

/**
 * Paquete controller.
 *
 * @Route("admin/destinos")
 */
class PaqueteController extends Controller
{
    /**
     * Lists all Paquete entities.
     *
     * @Route("/", name="destinos")
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
     * Finds and displays a Paquete entity.
     *
     * @Route("/{id}/show", name="destinos_show")
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
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Paquete entity.
     *
     * @Route("/new", name="destinos_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paquete();
        $form   = $this->createForm(new PaqueteType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Paquete entity.
     *
     * @Route("/create", name="destinos_create")
     * @Method("POST")
     * @Template("T42DestinosBundle:Paquete:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Paquete();
        $form = $this->createForm(new PaqueteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('destinos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Paquete entity.
     *
     * @Route("/{id}/edit", name="destinos_edit")
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
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Paquete entity.
     *
     * @Route("/{id}/update", name="destinos_update")
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

            return $this->redirect($this->generateUrl('destinos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Paquete entity.
     *
     * @Route("/{id}/delete", name="destinos_delete")
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
        }

        return $this->redirect($this->generateUrl('destinos'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
                
}