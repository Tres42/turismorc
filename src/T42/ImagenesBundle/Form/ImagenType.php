<?php

namespace T42\ImagenesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImagenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', null, array(
                'required'=>false)
            )
            ->add('descripcion')
            ->add('imageFile')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\ImagenesBundle\Entity\Imagen'
        ));
    }

    public function getName()
    {
        return 't42_imagenbundle_imagentype';
    }
}
