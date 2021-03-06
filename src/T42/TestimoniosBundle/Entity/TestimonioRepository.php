<?php

namespace T42\TestimoniosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * T42\TestimoniosBundle\Entity\TestimonioRepository
 * 
 * Respositorio de Testimonio
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class TestimonioRepository extends EntityRepository
{
    
    /**
     * Metodo que obtiene un testimonio aleatoriamente.
     * 
     * @return Testimonio Un objeto Testimonio aleatoriamente
     */
    public function findOneRandom() {
        $em = $this->getEntityManager();
        $max = $em->createQuery('SELECT MAX(t.id) FROM T42TestimoniosBundle:Testimonio t')
                  ->getSingleScalarResult();
         
        $max = intval($max);
        
        return $em->createQuery('SELECT t FROM T42TestimoniosBundle:Testimonio t
                    WHERE t.id >= :rand ORDER BY t.id ASC')
                    ->setParameter('rand', rand(0, $max))
                    ->setMaxResults(1)
                    ->getSingleResult();                
    }

}
