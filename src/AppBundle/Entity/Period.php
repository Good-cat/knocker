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

    const PERIOD_DAY_KEY = D;
    const PERIOD_MONTH_KEY = M;
    const PERIOD_YEAR_KEY = Y;

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
     * @ORM\Column(type="decimal", precision=18, scale=4, options={"comment":"Стоимость периода во внутренних единицах"})
     */
    protected $cost;

    /**
     * @ORM\Column(type="boolean", options={"comment":"Признак ежедневного списания равными долями"})
     */
    protected $perDay;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Tariff", mappedBy="periods")
     */
    protected $tariff;

    public function getAvailablePeriods()
    {
        return [
            self::PERIOD_DAY_KEY    => self::PERIOD_DAY_VALUE,
            self::PERIOD_MONTH_KEY  => self::PERIOD_MONTH_VALUE,
            self::PERIOD_YEAR_KEY   => self::PERIOD_YEAR_VALUE
        ];
    }

} 