<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="region", options={"comment":"Регион"})
 */
class Region {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название валюты"})
     */
    protected $name;
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Currency", inversedBy="regions")
     * @ORM\JoinTable(name="region_currency")
     */
    protected $currencies;

    /**
     * @ORM\OneToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", mappedBy="region")
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->currencies = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Region
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
     * Add currency
     *
     * @param \AppBundle\Entity\Currency $currency
     *
     * @return Region
     */
    public function addCurrency(\AppBundle\Entity\Currency $currency)
    {
        $currency->addRegion($this);
        $this->currencies[] = $currency;

        return $this;
    }

    /**
     * Remove currency
     *
     * @param \AppBundle\Entity\Currency $currency
     */
    public function removeCurrency(\AppBundle\Entity\Currency $currency)
    {
        $this->currencies->removeElement($currency);
    }

    /**
     * Get currencies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Add user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     *
     * @return Region
     */
    public function addUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     */
    public function removeUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
