<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\EventListeners\Doctrine;

use AppBundle\Entity\Service;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Booking;
use Doctrine\ORM\Events;

class BookingTotalDoctrineEventSubscriber implements EventSubscriber{
    public function getSubscribedEvents()
    {
        return array(
            Events::prePersist,
            Events::preUpdate,
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->setTotal($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->setTotal($args);
    }

    public function setTotal(LifecycleEventArgs $args)
    {
        $booking = $args->getEntity();

        if (!$booking instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $tariff = $booking->getTariff();
        $cost = 0;
        if ($tariff) {
            if ($period = $tariff->getPeriod()) {
                $periodCost = $period->getCost();
                if ($tariff->getForEachService()) {
                    foreach ($booking->getServices() as $service) {
                        if ($service instanceof Service) {
                            $cost += $service->getCostCoefficient() * $periodCost;
                        }
                    }
                } else {
                    $cost += $periodCost;
                }
            }
            if ($usingFact = $tariff->getUsingFact()) {
                $cost += $usingFact->getCost();
            }
        }
        $booking->setTotal($cost);
    }
} 