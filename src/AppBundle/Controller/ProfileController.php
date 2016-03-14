<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
        $bookingServices = $this->getUser()->getServices();

        $diff = array_diff($services, $bookingServices);

        return $this->render('ApplicationSonataUserBundle:Profile:services.html.twig', ['services' => $diff]);
    }

    /**
     * @Route("/bookings", name="profile_bookings")
     */
    public function bookingsAction()
    {
        $bookings = $this->getUser()->getBookings();
        return $this->render('ApplicationSonataUserBundle:Profile:bookings.html.twig', ['bookings' => $bookings]);
    }
} 