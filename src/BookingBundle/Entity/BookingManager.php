<?php
/**
 * Created by PhpStorm.
 * User: misha
 * Date: 02.04.16
 * Time: 11:08
 */

namespace BookingBundle\Entity;

use Sonata\CoreBundle\Model\BaseEntityManager;

class BookingManager extends BaseEntityManager
{
    public function getBooking($id)
    {
        $booking = $this->getRepository()->find($id);
        if ($booking) {
            return $booking;
        } else {
            throw new \Exception('Заказ с идентификатором ' . $id . ' отсутствует в базе.');
        }
    }

    public function isValidBooking($id)
    {
        return true;
    }
}