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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tariff", mappedBy="usingFacts")
     */
    protected $tariff;
} 