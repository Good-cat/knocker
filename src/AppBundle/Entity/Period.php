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
 * @ORM\Table(name="period", options={"comment":"Способы тарификации."})
 */
class Period {

    const PERIOD_DAY_KEY = "D";
    const PERIOD_MONTH_KEY = "M";
    const PERIOD_YEAR_KEY = "Y";

    const PERIOD_DAY_VALUE = 'knocker.period.day';
    const PERIOD_MONTH_VALUE = 'knocker.period.month';
    const PERIOD_YEAR_VALUE = 'knocker.period.year';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название периода"})
     */
    protected $name;
    /**
     * @ORM\Column(type="string", options={"comment":"Единица измерения периода: день, месяц, год"})
     */
    protected $unit;

    /**
     * @ORM\Column(type="string", options={"comment":"Количество единиц периода"})
     */
    protected $unitsNumber;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=2, options={"comment":"Стоимость периода во внутренних единицах"})
     */
    protected $cost;

    /**
     * @ORM\Column(type="boolean", options={"comment":"Признак ежедневного списания равными долями"})
     */
    protected $perDay;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tariff", mappedBy="period")
     */
    protected $tariffs;

    public static function getAvailablePeriods()
    {
        return [
            self::PERIOD_DAY_KEY    => self::PERIOD_DAY_VALUE,
            self::PERIOD_MONTH_KEY  => self::PERIOD_MONTH_VALUE,
            self::PERIOD_YEAR_KEY   => self::PERIOD_YEAR_VALUE
        ];
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tariff = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Period
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
     * Set unit
     *
     * @param string $unit
     *
     * @return Period
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set unitsNumber
     *
     * @param string $unitsNumber
     *
     * @return Period
     */
    public function setUnitsNumber($unitsNumber)
    {
        $this->unitsNumber = $unitsNumber;

        return $this;
    }

    /**
     * Get unitsNumber
     *
     * @return string
     */
    public function getUnitsNumber()
    {
        return $this->unitsNumber;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return Period
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set perDay
     *
     * @param boolean $perDay
     *
     * @return Period
     */
    public function setPerDay($perDay)
    {
        $this->perDay = $perDay;

        return $this;
    }

    /**
     * Get perDay
     *
     * @return boolean
     */
    public function getPerDay()
    {
        return $this->perDay;
    }

    /**
     * Add tariff
     *
     * @param \AppBundle\Entity\Tariff $tariff
     *
     * @return Period
     */
    public function addTariff(\AppBundle\Entity\Tariff $tariff)
    {
        $this->tariffs[] = $tariff;

        return $this;
    }

    /**
     * Remove tariff
     *
     * @param \AppBundle\Entity\Tariff $tariff
     */
    public function removeTariff(\AppBundle\Entity\Tariff $tariff)
    {
        $this->tariffs->removeElement($tariff);
    }

    /**
     * Get tariffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTariffs()
    {
        return $this->tariffs;
    }

    public function __toString()
    {
        return $this->name;
    }
}
