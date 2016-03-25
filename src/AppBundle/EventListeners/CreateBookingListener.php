<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\EventListeners;


use AppBundle\Entity\Booking;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Response;

class CreateBookingListener {

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onBookingCreate(GenericEvent $event)
    {
        $booking = $event->getSubject();
        if ($booking instanceof Booking) {
            $services = $this->em->getRepository('AppBundle:Service')->findAll();
            foreach ($services as $service) {
                $booking->addService($service);
            }
        }
    }
} 