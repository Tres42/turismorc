<?php

namespace CD\TestimoniosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * CD\TestimoniosBundle\Controller\BackendController
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
     * @Route("/")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
}
