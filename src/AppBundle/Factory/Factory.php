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

class Factory {

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
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
            $booking = $this->em->getRepository('AppBundle:Booking')->find($id);
            if ($booking) {
                return $booking;
            } else {
                throw new \Exception('Заказ с идентификатором ' . $id . ' отсутствует в базе.');
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