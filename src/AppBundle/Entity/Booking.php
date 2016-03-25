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
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @ORM\Entity
 * @ORM\Table(name="booking", options={"comment":"Заказ. Содержит в себе набор доступных услуг, надлежащих оплате"})
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"urlPre", "urlPost"})
 */
class Booking {

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"Номер заказа"})
     */
    private $number;

    /**
     * @ORM\ManyToMany(targetEntity="Service", inversedBy="bookings")
     * @ORM\JoinTable(name="bookings_services")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", nullable=true,  options={"comment":"Сумма заказа"})
     */
    private $total;

    /**
     * @ORM\Column(type="boolean", nullable=true,  options={"comment":"Признак того, что счет оплачен"})
     */
    private $paid;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tariff", inversedBy="bookings")
     * @ORM\JoinColumn(name="tariff_id", referencedColumnName="id")
     */
    protected $tariff;

    /**
     * @ORM\Column(type="string",  options={"comment":"URL до"})
     */
    protected $urlPre;

    /**
     * @ORM\Column(type="string", nullable=true,  options={"comment":"URL после"})
     */
    protected $urlPost;

    /**
     * @ORM\Column(type="datetime", options={"comment":"Дата создания"})
     */
    private $cteatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, options={"comment":"Дата оплаты"})
     */
    private $paidAt;

    /**
     * Add service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return Booking
     */
    public function addService(\AppBundle\Entity\Service $service)
    {
        $service->addBooking($this);
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\Service $service
     */
    public function removeService(\AppBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Booking
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Booking
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Booking
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return Booking
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean
     */
    public function getPaid()
    {
        return $this->paid;
    }

    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * Set cteatedAt
     * @ORM\PrePersist
     */
    public function setCteatedAt()
    {
        $this->cteatedAt = new \DateTime();

        return $this;
    }

    /**
     * Get cteatedAt
     *
     * @return \DateTime
     */
    public function getCteatedAt()
    {
        return $this->cteatedAt;
    }

    /**
     * Set paidAt
     *
     * @param \DateTime $paidAt
     *
     * @return Booking
     */
    public function setPaidAt($paidAt)
    {
        $this->paidAt = $paidAt;

        return $this;
    }

    /**
     * Get paidAt
     *
     * @return \DateTime
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }

    public function isValid()
    {
        return true;
    }

    /**
     * Set tariff
     *
     * @param \AppBundle\Entity\Tariff $tariff
     *
     * @return Booking
     */
    public function setTariff(\AppBundle\Entity\Tariff $tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return \AppBundle\Entity\Tariff
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * Set urlPre
     *
     * @param string $urlPre
     *
     * @return Booking
     */
    public function setUrlPre($urlPre)
    {
        $this->urlPre = $urlPre;

        return $this;
    }

    /**
     * Get urlPre
     *
     * @return string
     */
    public function getUrlPre()
    {
        return $this->urlPre;
    }

    /**
     * Set urlPost
     *
     * @param string $urlPost
     *
     * @return Booking
     */
    public function setUrlPost($urlPost)
    {
        $this->urlPost = $urlPost;

        return $this;
    }

    /**
     * Get urlPost
     *
     * @return string
     */
    public function getUrlPost()
    {
        return $this->urlPost;
    }

    /**
     * @ORM\PreFlush()
     */
    public function prePersist()
    {
        var_dump('ok');
    }
}
