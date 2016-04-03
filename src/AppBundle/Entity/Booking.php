<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Entity;
use BookingBundle\Entity\Booking as BaseBooking;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="booking", options={"comment":"Заказ. Содержит в себе набор доступных услуг, надлежащих оплате"})
 */
class Booking extends BaseBooking
{
}
