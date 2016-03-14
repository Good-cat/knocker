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
     * @Route("/createBooking", name="createBooking")
     */
    public function createBooking(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $serviceIds = [];
            $parameters = $request->get('parameters');
            foreach ($parameters as $item) {
                $serviceIds[] = $item['value'];
            }
            if ($serviceIds) {

                $event = new BookingEvent();

                $user = $this->getUser();

                if ($user instanceof User) {
                    $event->setUser($user);

                } else {
                    return new Response(BookingEvent::ERROR_BAD_USER);
                }

                foreach ($serviceIds as $id) {
                    $event->addService($this->get('doctrine')->getRepository('AppBundle:Service')->find($id));
                }

                $this->get('event_dispatcher')->dispatch(AppEvents::BOOKING_CREATE, $event);

                if ($errors = $event->getErrors()) {
                    return new Response($errors[0]);
                } else {
                    return new Response('ok');
                }
            } else {
                return new Response(BookingEvent::ERROR_SERVICES_EMPTY);
            }
        }
        return new Response();
    }
} 