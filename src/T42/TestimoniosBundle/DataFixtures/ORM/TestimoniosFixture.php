<?php

namespace T42\TestimoniosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use T42\TestimoniosBundle\Entity\Testimonio;

/**
 * T42\TestimoniosBundle\DataFixtures\ORM\TestimoniosFixture
 * 
 * Clase fixture de carga de testimonios de prueba.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class TestimoniosFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $testimonio1 = new Testimonio();
        $testimonio1->setComentario('Muy bueno el viaje, espectacular el itinerario');
        $testimonio1->setNombre('Raul Perez');
        $testimonio1->setOrganizacion('Organizacion S.A.');

        $testimonio2 = new Testimonio();
        $testimonio2->setComentario('La pasamos muy bien');
        $testimonio2->setNombre('Guillermo Lopez');
        
        $testimonio3 = new Testimonio();
        $testimonio3->setComentario('Espero volver a viajar con esta empresa, muy bueno todo');
        $testimonio3->setNombre('Lautaro Larca');
        $testimonio3->setOrganizacion('Larca S.A');

        $testimonio4 = new Testimonio();
        $testimonio4->setComentario('Muy lindos lugares');
        $testimonio4->setNombre('Pepe Pepe');
        
        $manager->persist($testimonio1);
        $manager->persist($testimonio2);
        $manager->persist($testimonio3);
        $manager->persist($testimonio4);
        
        for ($i = 0; $i < 50; $i++) {
            $testimonio = new Testimonio();
            $testimonio->setComentario('Muy bueno el viaje '.$i);
            $testimonio->setNombre('Carlos '.$i);
            $testimonio->setOrganizacion('Organizacion'. $i);
            
            $manager->persist($testimonio);
        }
                
        $manager->flush();
    }
}
