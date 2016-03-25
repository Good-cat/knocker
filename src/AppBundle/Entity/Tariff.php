<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="tariff", options={"comment":"Тариф"})
 */
class Tariff {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название тарифа"})
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UsingFact", inversedBy="tariffs")
     * @ORM\JoinColumn(name="using_fact_id", referencedColumnName="id")
     */
    protected $usingFact;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Period", inversedBy="tariffs")
     * @ORM\JoinColumn(name="period_id", referencedColumnName="id")
     */
    protected $period;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Booking", mappedBy="tariff")
     */
    protected $bookings;

    protected $region;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"comment":"Признак действия тарифа для каждой услуги в заказе, если false - то тариф применяется к заказу целиком (например, при списывании абонентской платы), если true - то тариф умножается на количество услуг с учетом коэффициента"})
     */
    protected $forEachService;

    public function __construct() {
        $this->usingFacts = new ArrayCollection();
        $this->periods = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tariff
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set forEachService
     *
     * @param boolean $forEachService
     *
     * @return Tariff
     */
    public function setForEachService($forEachService)
    {
        $this->forEachService = $forEachService;

        return $this;
    }

    /**
     * Get forEachService
     *
     * @return boolean
     */
    public function getForEachService()
    {
        return $this->forEachService;
    }

    /**
     * Add booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Tariff
     */
    public function addBooking(\AppBundle\Entity\Booking $booking)
    {
        $this->bookings[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \AppBundle\Entity\Booking $booking
     */
    public function removeBooking(\AppBundle\Entity\Booking $booking)
    {
        $this->bookings->removeElement($booking);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * Set usingFact
     *
     * @param \AppBundle\Entity\UsingFact $usingFact
     *
     * @return Tariff
     */
    public function setUsingFact(\AppBundle\Entity\UsingFact $usingFact = null)
    {
        $this->usingFact = $usingFact;

        return $this;
    }

    /**
     * Get usingFact
     *
     * @return \AppBundle\Entity\UsingFact
     */
    public function getUsingFact()
    {
        return $this->usingFact;
    }

    /**
     * Set period
     *
     * @param \AppBundle\Entity\Period $period
     *
     * @return Tariff
     */
    public function setPeriod(\AppBundle\Entity\Period $period = null)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return \AppBundle\Entity\Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    public function __toString()
    {
        return $this->name;
    }
}
