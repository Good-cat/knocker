<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Events;

use AppBundle\Entity\Tariff;
use Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\Entity\Service;

class BookingEvent extends Event
{
    const ERROR_SERVICES_EMPTY = 'services_empty';
    const ERROR_BAD_USER = 'bad_user';

    private $services;
    private $user;
    protected $tariff;
    private $errors;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->errors = new ArrayCollection();
    }

    /**
     * @param Service $service
     * @return $this
     */
    public function addService(Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * @return ArrayCollection
     */

    public function getServices()
    {
        return $this->services;
    }

    public function addError($name)
    {
        $this->errors[] = $name;

        return $this;
    }

    /**
     * @param Tariff $tariff
     * @return $this
     */
    public function setTariff(Tariff $tariff)
    {
        $this->tariff = $tariff;

        return $this;
    }

    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * @return ArrayCollection
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
} 