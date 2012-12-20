<?php

namespace T42\DestinosBundle\Form\DataTransformer;

use \Symfony\Component\Form\DataTransformerInterface;

/**
 * T42\DestinosBundle\Form\Type\LinesToArrayDataTransformer
 *
 * Transform a string from the base to form and conversely.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class LinesToArrayDataTransformer implements DataTransformerInterface
{

    /**
     * Transforms a string separated by new line in a
     * string array.
     *
     * @param  String|null $lineServicios
     * @return Array
     */
    public function reverseTransform($lineServicios)
    {
        $arrayServicios = explode("\n", $lineServicios);
        $arrayServicios = array_map('trim', $arrayServicios);
        $arrayServicios = array_filter($arrayServicios, function($var) {
                    return strlen($var);
                }
        );
        
        return $arrayServicios;
    }

    /**
     * Transforms a string array in a string separated by
     * new line.
     *
     * @param  Array|null $serviciosArray
     * @return String
     */
    public function transform($serviciosArray)
    {
        if (!$serviciosArray) {
            return null;
        }

        return implode("\n", $serviciosArray);
    }

}