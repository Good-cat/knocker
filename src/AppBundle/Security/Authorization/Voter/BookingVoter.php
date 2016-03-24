<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Application\Sonata\UserBundle\Entity\User as User;

class BookingVoter extends AbstractVoter{
    const DELETE = 'delete';
    const EDIT = 'edit';

    protected function getSupportedAttributes()
    {
        return array(self::DELETE, self::EDIT);
    }

    protected function getSupportedClasses()
    {
        return array('AppBundle\Entity\Booking');
    }

    protected function isGranted($attribute, $booking, $user = null)
    {

        if (!$user instanceof User) {
            return false;
        }

        switch($attribute) {
            case self::DELETE:
                if ($user->getId() === $booking->getUser()->getId()) {
                    return true;
                }
                break;
            case self::EDIT:
                if ($user->getId() === $booking->getUser()->getId()) {
                    return true;
                }
                break;
        }

        return false;
    }
} 