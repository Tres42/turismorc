<?php
namespace T42\DestinosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of TarifaType
 *
 * @author cristian
 */
class TarifaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('precio')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'T42\DestinosBundle\Entity\Tarifa'
        ));
    }

    public function getName()
    {
        return 't42_destinosbundle_tarifatype';
    }
}

?>
