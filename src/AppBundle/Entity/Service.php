<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity
 * @ORM\Table(name="service", options={"comment":"Услуга"})
 * @UniqueEntity("slug", message="Такое значение уже используется")
 */
class Service {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название услуги, как его будет видеть пользователь"})
     */
    private $name;
    /**
     * @ORM\Column(type="string", options={"comment":"Шифр услуги, на основании которого будет формироваться роль"})
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Booking", mappedBy="services")
     */
    private $bookings;

    /**
     * @ORM\Column(type="boolean", options={"comment":"Является ли услуга активной"})
     */
    protected $isActive = true;

    /**
     * @ORM\Column(type="float", options={"comment":"Коэффициент стоимости относительно тарифа, примененного к пакету"})
     * Например, тариф за пакет 10 условных единиц в месяц с применением к каждой услуги, входящей в пакет, если у услуги коэффициент стоимости
     * 1.1, то она войдет в формулу с суммой 11 условных единиц
     */
    protected $costCoefficient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Service
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Service
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
 
    /**
     * Add booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Service
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

    public function __toString()
    {
        return $this->getSlug();
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Service
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set costCoefficient
     *
     * @param float $costCoefficient
     *
     * @return Service
     */
    public function setCostCoefficient($costCoefficient)
    {
        $this->costCoefficient = $costCoefficient;

        return $this;
    }

    /**
     * Get costCoefficient
     *
     * @return float
     */
    public function getCostCoefficient()
    {
        return $this->costCoefficient;
    }
}
