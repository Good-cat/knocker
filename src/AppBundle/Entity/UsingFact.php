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
 * @ORM\Table(name="using_fact", options={"comment":"Фактическое событие использования услуги."})
 */
class UsingFact {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название фактического события"})
     */
    protected $name;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=4, options={"comment":"Стоимость фактического события во внутренних единицах стоимости"})
     */
    protected $cost;

    /**
     * @ORM\Column(type="string", options={"comment":"Шифр фактического события, по которому будет вызываться метод api по списанию средств"})
     */
    protected $code;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tariff", mappedBy="usingFact")
     */
    protected $tariffs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tariffs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return UsingFact
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
     * Set cost
     *
     * @param string $cost
     *
     * @return UsingFact
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return UsingFact
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add tariff
     *
     * @param \AppBundle\Entity\Tariff $tariff
     *
     * @return UsingFact
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
