<?php

namespace CD\TestimoniosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * CD\TestimoniosBundle\Controller\FrontendController
 * 
 * Controlador que maneja los textos de testimonios.
 *
 * @author Cristian Tosco
 */
class FrontendController extends Controller
{
    
    /**     
    * @Template()
    */
    public function indexAction()
    {        
        $repository = $this->getDoctrine()->getRepository('CDTestimoniosBundle:Testimonio');
        $testimonio = $repository->find(1);
                        
        return array('testimonio'=> $testimonio);
    }    
}

