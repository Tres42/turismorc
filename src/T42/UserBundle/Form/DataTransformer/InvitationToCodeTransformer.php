<?php

namespace T42\UserBundle\Form\DataTransformer;

use T42\UserBundle\Entity\Invitation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

/**
 * DataTransformerInterface class implementing that transforms a value 
 * between different representations.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class InvitationToCodeTransformer implements DataTransformerInterface 
{

    protected $entityManager;

    /**
     * Constructor
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    public function transform($value) {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof Invitation) {
            throw new UnexpectedTypeException($value, 'T42\UserBundle\Entity\Invitation');
        }

        return $value->getCode();
    }

    public function reverseTransform($value) {
        if (null === $value || '' === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        return $this->entityManager
                        ->getRepository('T42\UserBundle\Entity\Invitation')
                        ->findOneBy(array(
                            'code' => $value,
                            'user' => null,
                        ));
    }

}