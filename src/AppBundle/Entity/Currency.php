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
 * @ORM\Table(name="currency", options={"comment":"Валюта"})
 */
class Currency {

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
     * @ORM\Column(type="decimal", precision=18, scale=2, options={"comment":"Курс по отношению к системной единице"})
     */
    protected $rate;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Region", mappedBy="currencies")
     */
    protected $regions;

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
     * @return Currency
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
     * Set rate
     *
     * @param string $rate
     *
     * @return Currency
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add region
     *
     * @param \AppBundle\Entity\Region $region
     *
     * @return Currency
     */
    public function addRegion(\AppBundle\Entity\Region $region)
    {
        $region->addCurrency($this);
        $this->regions[] = $region;

        return $this;
    }

    /**
     * Remove region
     *
     * @param \AppBundle\Entity\Region $region
     */
    public function removeRegion(\AppBundle\Entity\Region $region)
    {
        $region->removeCurrency($this);
        $this->regions->removeElement($region);
    }

    /**
     * Get regions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegions()
    {
        return $this->regions;
    }

    public function __toString()
    {
        return $this->name;
    }
}
