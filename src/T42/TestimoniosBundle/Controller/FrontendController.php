<?php

namespace T42\TestimoniosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * T42\TestimoniosBundle\Controller\FrontendController
 * 
 * Controlador que maneja el frontend de testimonios.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class FrontendController extends Controller
{
    
    /**     
    * @Route("/")
    * @Template()
    */
    public function indexAction()
    {        
        $repository = $this->getDoctrine()->getRepository('T42TestimoniosBundle:Testimonio');
        
        // Buscamos un testimonio aleatoriamente
        $testimonio = $repository->findOneRandom();
                        
        return array('testimonio'=> $testimonio);
    }    
}

