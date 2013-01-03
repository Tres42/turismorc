<?php

namespace T42\ImagenesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use T42\ImagenesBundle\Entity\Imagen;
use T42\ImagenesBundle\Form\ImagenType;

/**
 * Imagen controller.
 *
 * @Route("/admin/imagenes")
 */
class BackendController extends Controller
{
    /**
     * Lists all Imagen entities.
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('T42ImagenesBundle:Imagen')->findAll();

        $paginator = $this->container->get('knp_paginator');

        $pagination = $paginator->paginate(
                $entities, $this->container->get('request')->query->get('page', 1), 10
        );

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Finds and displays a Imagen entity.
     *
     * @Route("/{id}/show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42ImagenesBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Imagen entity.
     *
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Imagen();
        $form   = $this->createForm(new ImagenType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Imagen entity.
     *
     * @Route("/create")
     * @Method("POST")
     * @Template("T42ImagenesBundle:Backend:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Imagen();
        $form = $this->createForm(new ImagenType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'La imagen fue guardada correctamente');

            return $this->redirect($this->generateUrl('t42_imagenes_backend_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Imagen entity.
     *
     * @Route("/{id}/edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42ImagenesBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

        $editForm = $this->createForm(new ImagenType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Imagen entity.
     *
     * @Route("/{id}/update")
     * @Method("POST")
     * @Template("T42ImagenesBundle:Backend:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42ImagenesBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ImagenType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Los cambios fueron guardados correctamente');

            return $this->redirect($this->generateUrl('t42_imagenes_backend_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Imagen entity.
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
            $entity = $em->getRepository('T42ImagenesBundle:Imagen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Imagen entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'La imagen fue eliminada correctamente');
        }

        return $this->redirect($this->generateUrl('t42_imagenes_backend_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
