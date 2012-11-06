<?php

namespace T42\TestimoniosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\SecurityExtraBundle\Annotation\Secure;
use T42\TestimoniosBundle\Form\TestimonioType;
use T42\TestimoniosBundle\Entity\Testimonio;

/**
 * T42\TestimoniosBundle\Controller\BackendController
 * 
 * Controlador que administra ABM de Testimonios.
 *
 * @author Cristian Tosco
 * 
 * @Route("/admin/testimonios") 
 */
class BackendController extends Controller
{
    
    /**
     * Lists all Testimonio entities.
     *
     * @Route("/")
     * @Template()
     * @Secure(roles="ROLE_TESTIMONIOS_VIEW")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('T42TestimoniosBundle:Testimonio')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Testimonio entity.
     *
     * @Route("/{id}/show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42TestimoniosBundle:Testimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Testimonio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Testimonio entity.
     *
     * @Route("/new")
     * @Template()
     * @Secure(roles="ROLE_TESTIMONIOS_ADD")
     */
    public function newAction()
    {
        $entity = new Testimonio();
        $form   = $this->createForm(new TestimonioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Testimonio entity.
     *
     * @Route("/create")
     * @Method("POST")
     * @Template("T42TestimoniosBundle:Backend:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Testimonio();
        $form = $this->createForm(new TestimonioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            
            $this->get('session')->getFlashBag()->add('success', 'El testimonio fue guardado correctamente');
            
            return $this->redirect($this->generateUrl('t42_testimonios_backend_index', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Testimonio entity.
     *
     * @Route("/{id}/edit")
     * @Template()
     * @Secure(roles="ROLE_TESTIMONIOS_EDIT")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42TestimoniosBundle:Testimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Testimonio entity.');
        }

        $editForm = $this->createForm(new TestimonioType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Testimonio entity.
     *
     * @Route("/{id}/update")
     * @Method("POST")
     * @Template("T42TestimoniosBundle:Backend:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('T42TestimoniosBundle:Testimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Testimonio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TestimonioType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Los cambios fueron guardados correctamente');

            return $this->redirect($this->generateUrl('t42_testimonios_backend_index', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Testimonio entity.
     *
     * @Route("/{id}/delete")
     * @Method("GET")
     * @Secure(roles="ROLE_TESTIMONIOS_DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $referer = $request->headers->get('referer');
        
        if ($referer !== $this->generateUrl('t42_testimonios_backend_index', array(), true)
            && $referer !== $this->generateUrl('t42_testimonios_backend_edit', array('id' => $id), true)) {
            throw $this->createNotFoundException('Unable to delete Testimonio from your referer.');
        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('T42TestimoniosBundle:Testimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Testimonio entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'El testimonio fue eliminado correctamente');

        return $this->redirect($this->generateUrl('t42_testimonios_backend_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
}
