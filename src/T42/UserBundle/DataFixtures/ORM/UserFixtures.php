<?php

namespace T42\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use T42\UserBundle\Entity\Group;
use T42\UserBundle\Entity\User;

/**
 * Clase fixture de carga de usuarios de prueba.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class UserFixtures implements FixtureInterface, ContainerAwareInterface
{
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        // Get the UserManager from fos_user.group_manager service
        $groupManager = $this->container->get('fos_user.group_manager');
        
        $groupSuperAdmin = $groupManager->createGroup('Administradores');
        $groupSuperAdmin->addRole('ROLE_SUPER_ADMIN');
        
        $groupAdmin = $groupManager->createGroup('Usuarios Registrados');
        //$groupAdmin->addRole('ROLE_ADMIN');
        $groupAdmin->addRole('ROLE_USUARIOS_VIEW');
        
        // Get the UserManager from fos_user.user_manager service
        $userManager = $this->container->get('fos_user.user_manager');
        
        $user = $userManager->createUser();
        $user->setLastName('Gonzales');
        $user->setFirstname('Carlos');
        $user->setAddress('Ayacucho 122');
        $user->setPhoneNumber('0358-1254444');
        $user->addGroup($groupSuperAdmin);
        $user->setUsername('admin');
        $user->setEmail('cgonzales@gmail.com');
        $user->setEnabled(true);
        
        $user2 = $userManager->createUser();
        $user2->setLastName('Rodriguez');
        $user2->setFirstName('Jose');
        $user2->setAddress('Lamadrid 335');
        $user2->setPhoneNumber('0351-455544');
        $user2->addGroup($groupAdmin);
        $user2->setUserName('usuario');
        $user2->setEmail('jrodriguez@hotmail.com');
        $user2->setEnabled(true);
        
        // Get encoder factory
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword('admin', $user->getSalt());
        $user->setPassword($password);
        
        $encoder = $factory->getEncoder($user2);
        $password2 = $encoder->encodePassword('user', $user2->getSalt());
        $user2->setPassword($password2);
        
        $manager->persist($groupSuperAdmin);        
        $manager->persist($groupAdmin);
        $manager->persist($user);
        $manager->persist($user2);
        
        for ($i = 0; $i < 50; $i++) {
            $user3 = $userManager->createUser();
            $user3->setLastName('Apellido '.$i);
            $user3->setFirstName('Nombre '.$i);
            $user3->setAddress('Direccion '.$i);
            $user3->setPhoneNumber('0351-'.$i);
            $user3->addGroup($groupAdmin);
            $user3->setUserName('usuario'.$i);
            $user3->setEmail($i.'@hotmail.com');
            $user3->setEnabled(true);
            $user3->setPassword($password2);
            
            $manager->persist($user3);
        }        
        
        $manager->flush();
        
    }

}