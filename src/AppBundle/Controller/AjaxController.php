<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;

use AppBundle\AppEvents;
use AppBundle\Events\BookingEvent;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends Controller
{
     /**
     * @Route("/detach_service_from_booking", name="detach_service_from_booking")
     */
    public function detachServiceFromBookingAction(Request $request)
    {
        $booking_id = $request->get('booking_id');
        $service_id = $request->get('service_id');
        if ($booking_id) {
            try {
                $booking = $this->get('app.factory')->getBooking($booking_id);
                if ($service_id) {
                    try {
                        $service = $this->get('app.factory')->getService($service_id);
                        $booking->removeService($service);
                        $this->getDoctrine()->getManager()->flush();
                    } catch (\Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
            } catch (\Exception $e)
            {
                echo $e->getMessage();
            }
        }

        return new Response();
    }

    /**
     * @Route("/attach_services_to_booking", name="attach_services_to_booking")
     */
    public function attachServiceToBooking(Request $request)
    {
        $booking_id = $request->get('booking_id');
        $service_ids = $request->get('service_ids');
        if ($booking_id) {
            try {
                $booking = $this->get('app.factory')->getBooking($booking_id);
                if ($service_ids) {
                    foreach($service_ids as $service_id) {
                        try {
                            $service = $this->get('app.factory')->getService($service_id);
                            $booking->addService($service);
                            $this->getDoctrine()->getManager()->flush();
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        return new Response();
    }

    /**
     * @Route("/remove_booking", name="remove_booking")
     */
    public function removeBookingAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $booking_id = $request->get('booking_id');
            if ($booking_id) {
                try {
                    $booking = $this->get('app.factory')->getBooking($booking_id);
                    if ($this->isGranted('delete', $booking)) {
                        $em = $this->getDoctrine()->getManager();
                        $em->remove($booking);
                        $em->flush();
                        return new Response('ok');
                    }
                } catch (\Exception $e) {
                    return new Response($e->getMessage());
                }
                return new Response('accessDenied');
            }
            return new Response('bookingAbsent');
        }
        return new Response();
    }
} 