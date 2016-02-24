<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;


use Application\Sonata\UserBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route("/{apiKey}/api")
 */
class ApiController extends FOSRestController{

    /**
     * @param $userKey
     * @return mixed|void
     * @Route("/user/{userKey}")
     */
    public function getKnockerUser($userKey)
    {

        $user = $this->get('doctrine')->getRepository('ApplicationSonataUserBundle:User')->findOneBy(['userKey' => $userKey]);
        if (
            $user &&
            $user->isAccountNonExpired() &&
            $user->isAccountNonLocked() &&
            $user->isEnabled() &&
            $user->isCredentialsNonExpired()
        ) {
            $user->setRoles($this->get('app.knocker_role_builder')->getKnockerRoles($user->getId()));
            $view = $this
                ->view($user, 200)
                ->setFormat('json');
        } else {
            $view = $this->view();
        };

        return $this->handleView($view);
    }
} 