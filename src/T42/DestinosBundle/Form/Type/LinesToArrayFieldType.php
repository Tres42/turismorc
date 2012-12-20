<?php
namespace T42\DestinosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use T42\DestinosBundle\Form\DataTransformer\LinesToArrayDataTransformer;

/**
 * T42\DestinosBundle\Form\Type\LinesToArrayFieldType
 *
 * Class used to customize the fields included
 * and excluded services.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 *
 */
class LinesToArrayFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new LinesToArrayDataTransformer();
        $builder->addModelTransformer($transformer);
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'lines_to_array';
    }

}