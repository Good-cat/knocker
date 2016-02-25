<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileController
 * @package AppBundle\Controller
 * @Route("/profile")
 */
class ProfileController extends Controller
{
    /**
     * @Route("/services", name="profile_services")
     */
    public function servicesAction()
    {
        $services = $this->get('doctrine')->getRepository('AppBundle:Service')->findAll();

        return $this->render('ApplicationSonataUserBundle:Profile:services.html.twig', ['services' => $services]);
    }
} 