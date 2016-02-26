<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="count", options={"comment":"Счет. Счет не создается в админке, только динамически"})
 * @ORM\HasLifecycleCallbacks()
 */
class Count {

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
     * @ORM\Column(type="string", nullable=true, options={"comment":"Номер счета"})
     */
    private $number;

    /**
     * @ORM\ManyToMany(targetEntity="Service", inversedBy="counts")
     * @ORM\JoinTable(name="counts_services")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="counts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", nullable=true,  options={"comment":"Сумма счета"})
     */
    private $total;

    /**
     * @ORM\Column(type="boolean", nullable=true,  options={"comment":"Признак того, что счет оплачен"})
     */
    private $paid;

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
     * @return Count
     */
    public function addService(\AppBundle\Entity\Service $service)
    {
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
     * @return Count
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
     * @return Count
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
     * @return Count
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
     * @return Count
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
     * @return Count
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
}
