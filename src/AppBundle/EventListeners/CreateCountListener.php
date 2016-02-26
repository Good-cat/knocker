<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\EventListeners;


use AppBundle\Entity\Count;
use AppBundle\Events\CountEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class CreateCountListener {



    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onCountCreate(CountEvent $event)
    {
        $services = $event->getServices();
        if ($services->count()) {
            $count = new Count();

            $count->setUser($event->getUser());

            foreach($services as $service) {
                $count->addService($service);
            }

            $this->em->persist($count);
            $this->em->flush();

        } else {
            $event->addError($event::ERROR_SERVICES_EMPTY);
        }
    }
} 