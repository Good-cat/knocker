<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Factory;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Service;
use Doctrine\ORM\EntityManager;
use BookingBundle\Entity\BookingManager;

class Factory {

    protected $em;
    protected $bookingManager;

    public function __construct(BookingManager $bookingManager, EntityManager $entityManager)
    {
        $this->bookingManager = $bookingManager;
        $this->em = $entityManager;
    }

    /**
     * @param null $id
     * @return Booking
     * @throws \Exception
     */
    public function getBooking($id = null)
    {
        if ($id) {
            try{
                return $this->bookingManager->getBooking($id);
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }

        return new Booking();
    }

    public function getService($id = null)
    {
        if ($id) {
            $service = $this->em->getRepository('AppBundle:Service')->find($id);
            if ($service) {
                return $service;
            } else {
                throw new \Exception('Услуга с идентификатором ' . $id . ' отсутствует в базе.');
            }
        }

        return new Service();
    }
} 