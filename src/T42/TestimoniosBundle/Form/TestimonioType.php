<?php

namespace T42\TestimoniosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestimonioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attr = array('class' => 'span10');
        $builder
            ->add('nombre', null, array('attr' => $attr))
            ->add('organizacion', null, array('attr' => $attr))
            ->add('comentario', 'textarea', array('attr' => $attr))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\TestimoniosBundle\Entity\Testimonio'
        ));
    }

    public function getName()
    {
        return 't42_testimoniosbundle_testimoniotype';
    }
}
