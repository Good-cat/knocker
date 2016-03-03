<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
} 