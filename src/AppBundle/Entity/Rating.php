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
 * @ORM\Table(name="rating", options={"comment":"Способы тарификации."})
 */
class Rating {

    const DAY_KEY = 'D';
    const MONTH_KEY = 'M';
    const YEAR_KEY = 'Y';

    const DAY_VALUE = "День";
    const MONTH_VALUE = "Месяц";
    const YEAR_VALUE = "Год";

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", options={"comment":"Название способа тарификации"})
     */
    private $name;
    /**
     * @ORM\Column(type="integer", options={"comment":"Тип тарификации. Всего два, определенных в константах класса"})
     */
    private $type;

    public function getAvailableTypes()
    {
        return [
            static::FACT_KEY => static::FACT_VALUE,
            static::PERIOD_KEY => static::PERIOD_VALUE
        ];
    }

} 