<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Booking;
use Application\Sonata\UserBundle\Entity\User;
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
        $diff = $this->getAvailableServices($this->getUser());

        return $this->render('ApplicationSonataUserBundle:Profile:services.html.twig', ['services' => $diff]);
    }

    public function getAvailableServices(User $user)
    {
        $services = $this->get('doctrine')->getRepository('AppBundle:Service')->findAll();
        $bookingServices = $user->getServices();

        $diff = array_diff($services, $bookingServices);

        return $diff;
    }

    /**
     * @Route("/bookings", name="profile_bookings")
     */
    public function bookingsAction()
    {
        $bookings = $this->getUser()->getBookings();
        return $this->render('ApplicationSonataUserBundle:Profile:bookings.html.twig', ['bookings' => $bookings]);
    }

    /**
     * @Route("/booking/create", name="create_booking")
     */
    public function createBookingAction()
    {
        $booking = new Booking();
        $form = $this->createForm('booking_form', $booking);
        return $this->render('AppBundle:Booking:form.html.twig', ['form' => $form->createView()]);
    }
} 