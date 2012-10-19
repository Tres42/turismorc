<?php
namespace T42\BackendBundle\Twig;

class T42BackendExtension extends \Twig_Extension
{
    private $globals;

    public function __construct($globals = array())
    {
        $this->globals = $globals;
    }

    public function getGlobals()
    {
        return array(
            't42_backend' => $this->globals
        );
    }

    public function getName()
    {
        return 't42_backend_extension';
    }
}