<?php

namespace T42\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class for creating the invitation field
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class InvitationFormType extends AbstractType 
{

    protected $invitationTransformer;

    /**
     * Constructor
     * 
     * @param InvitationToCodeTransformer $invitationTransformer 
     */
    public function __construct(InvitationToCodeTransformer $invitationTransformer) {
        $this->invitationTransformer = $invitationTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->prependClientTransformer($this->invitationTransformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'class' => 'T42\UserBundle\Entity\Invitation',
            'required' => true,
        ));
    }

    public function getParent() {
        return 'text';
    }

    public function getName() {
        return 'T42_invitation_type';
    }

}