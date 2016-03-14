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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\UsingFact", inversedBy="tariffs")
     * @ORM\JoinTable(name="using_facts_tariffs")
     */
    protected $usingFacts;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Period", inversedBy="tariffs")
     * @ORM\JoinTable(name="periods_tariffs")
     */
    protected $periods;

    protected $region;

    /**
     * @ORM\Column(type="boolean", options={"comment":"Признак действия тарифа для каждой услуги в заказе, если false - то"})
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
     * Add usingFact
     *
     * @param \AppBundle\Entity\UsingFact $usingFact
     *
     * @return Tariff
     */
    public function addUsingFact(\AppBundle\Entity\UsingFact $usingFact)
    {
        $this->usingFacts[] = $usingFact;

        return $this;
    }

    /**
     * Remove usingFact
     *
     * @param \AppBundle\Entity\UsingFact $usingFact
     */
    public function removeUsingFact(\AppBundle\Entity\UsingFact $usingFact)
    {
        $this->usingFacts->removeElement($usingFact);
    }

    /**
     * Get usingFacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsingFacts()
    {
        return $this->usingFacts;
    }

    /**
     * Add period
     *
     * @param \AppBundle\Entity\Period $period
     *
     * @return Tariff
     */
    public function addPeriod(\AppBundle\Entity\Period $period)
    {
        $this->periods[] = $period;

        return $this;
    }

    /**
     * Remove period
     *
     * @param \AppBundle\Entity\Period $period
     */
    public function removePeriod(\AppBundle\Entity\Period $period)
    {
        $this->periods->removeElement($period);
    }

    /**
     * Get periods
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeriods()
    {
        return $this->periods;
    }
}
