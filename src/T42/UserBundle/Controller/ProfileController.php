<?php

namespace T42\UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseProfileController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

/**
 * Profile controller.
 *
 */
class ProfileController extends BaseProfileController {

    /**
     * Lists all User.
     */
    public function listAction() {
        $userManager = $this->container->get('fos_user.user_manager');

        $entities = $userManager->findUsers();

        return $this->container->get('templating')->renderResponse('T42UserBundle:Profile:list.html.' . $this->container->getParameter('fos_user.template.engine'), array('entities' => $entities));
    }

    /**
     * Show the user
     */
    public function showAction($id=0) {
        if (!$id) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }else{
            //Buscar el usuario de la base           
            $user = $this->container->get('fos_user.user_manager')->findUserBy(array('id'=>$id));            
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.' . $this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }

}
