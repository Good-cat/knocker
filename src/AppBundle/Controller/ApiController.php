<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;


use Application\Sonata\UserBundle\Document\User;
use FOS\RestBundle\Controller\FOSRestController;
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
        $user = new User();
        $user->setUsername($userKey);
        $view = $this
            ->view($user, 200)
            ->setFormat('json');

        return $this->handleView($view);
    }
} 