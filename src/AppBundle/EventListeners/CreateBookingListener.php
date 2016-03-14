<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\EventListeners;


use AppBundle\Entity\Booking;
use AppBundle\Events\BookingEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class CreateBookingListener {



    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onBookingCreate(BookingEvent $event)
    {
        $services = $event->getServices();
        if ($services->count()) {
            $booking = new Booking();

            $booking->setUser($event->getUser());

            foreach($services as $service) {
                $booking->addService($service);
            }

            $this->em->persist($booking);
            $this->em->flush();

        } else {
            $event->addError($event::ERROR_SERVICES_EMPTY);
        }
    }
} 