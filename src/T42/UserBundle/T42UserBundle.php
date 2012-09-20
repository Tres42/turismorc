<?php

namespace T42\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class T42UserBundle extends Bundle 
{
    
    /**
     * Sobreescribimos el metodo getParent para hacer que este bundle herede 
     * las propiedades del bundle FOSUserBundle.
     */
    public function getParent() {
        return 'FOSUserBundle';
    }

}
