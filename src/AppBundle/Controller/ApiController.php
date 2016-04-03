<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Booking;
use AppBundle\Entity\Service;
use Application\Sonata\UserBundle\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route("/{apiKey}/api")
 */
class ApiController extends FOSRestController{

    /**
     * @param $userKey
     * @param $bookingId
     * @return mixed|void
     * @Route("/user/{userKey}/{bookingId}")
     * $result = array ('userId', 'redirectUrl', 'services', 'eventCode')
     */
    public function getKnockerUser($userKey, $bookingId)
    {

        $user = $this->get('doctrine')->getRepository('ApplicationSonataUserBundle:User')->findOneBy(['userKey' => $userKey]);
        if (
            $user instanceof User &&
            $user->isAccountNonExpired() &&
            $user->isAccountNonLocked() &&
            $user->isEnabled() &&
            $user->isCredentialsNonExpired()
        ) {
            $result = array();
            $result['userKey'] = $user->getUserKey();
            $bookingManager = $this->get('booking.manager');
            $booking = $bookingManager->getBooking($bookingId);
            if ($booking && in_array($booking, $user->getBookings()->toArray())  && $booking instanceof Booking && $this->get('booking.manager')->isValidBooking($bookingId)) {
                $result['redirectUrl'] = $booking->getUrlPre() . '%articleNumber%' . $booking->getUrlPost();
                if (is_object($booking->getTariff()->getUsingFact())) {
                    $result['eventCode'] = $booking->getTariff()->getUsingFact()->getCode();
                }
                foreach ($booking->getServices() as $service) {
                    if ($service instanceof Service) {
                        $result['services'][] = $service->getSlug();
                    }
                }

            }
            $view = $this
                ->view($result, 200)
                ->setFormat('json');
        } else {
            $view = $this->view();
        };

        return $this->handleView($view);
    }
} 