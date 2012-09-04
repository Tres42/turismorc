<?php

namespace T42\TestimoniosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestimonioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('organizacion')
            ->add('comentario')
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
