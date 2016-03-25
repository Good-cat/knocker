<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;

use AppBundle\AppEvents;
use AppBundle\Entity\Booking;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
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
        $diff = $this->getAvailableServices();

        return $this->render('ApplicationSonataUserBundle:Profile:services.html.twig', ['services' => $diff]);
    }

    public function getAvailableServices(Booking $booking = null)
    {
        $services = $this->get('doctrine')->getRepository('AppBundle:Service')->findAll();
        $diff = $services;

        if ($booking) {
            $bookingServices = $booking->getServices()->toArray();
            $diff = array_diff($services, $bookingServices);
        }

        return $diff;
    }

    /**
     * @Route("/bookings", name="profile_bookings")
     */
    public function bookingsAction()
    {
        $bookings = $this->getUser()->getBookings();
        $services = array();
        foreach ($bookings as $booking) {
            $services[$booking->getId()] = $this->getAvailableServices($booking);
        }
        return $this->render('ApplicationSonataUserBundle:Profile:bookings.html.twig', [
            'bookings' => $bookings,
            'services' => $services]);
    }

    /**
     * @Route("/booking/create", name="create_booking")
     */
    public function createBookingAction(Request $request)
    {
        $booking = $this->get('app.factory')->getBooking();
        $booking->setUser($this->getUser());

        $event = new GenericEvent($booking);
        $this->get('event_dispatcher')->dispatch(AppEvents::BOOKING_CREATE, $event);

        $form = $this->createForm('booking_form', $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('profile_bookings');
        }
        return $this->render('AppBundle:Booking:form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/booking/update/{id}", name="update_booking")
     */
    public function updateBookingAction(Request $request, $id)
    {
        try {
            $booking = $this->get('app.factory')->getBooking($id);
            $form = $this->createForm('booking_form', $booking);
        } catch (\Exception $e) {
            return new Response($e->getMessage());
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('profile_bookings');
        }
        return $this->render('AppBundle:Booking:form.html.twig', ['form' => $form->createView()]);
    }

} 