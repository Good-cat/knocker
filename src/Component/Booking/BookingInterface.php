<?php
/**
 * Created by PhpStorm.
 * User: misha
 * Date: 02.04.16
 * Time: 10:41
 */

namespace Component\Booking;


interface BookingInterface {

    const STATUS_NOT_PAID = 0;
    const STATUS_PAID = 1;
    const STATUS_ERROR = 2;
    const STATUS_IN_PROCESS = 3;

}