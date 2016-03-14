<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\EventListeners;

use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Symfony\Component\Translation\DataCollectorTranslator as Translator;
use Symfony\Component\HttpFoundation\Request;

class AvanzuAdminLTEListener
{

    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    protected function getMenu(Request $request)
    {
        $rootItems = array(
            $billingGroup = new MenuItemModel('billing', 'Биллинг', '', [], 'fa fa-money'),
            $profileGroup = new MenuItemModel('profile-group', $this->translator->trans('sonata_profile_title', [], 'SonataUserBundle'), '', [], 'fa fa-user')
        );
        $profile = new MenuItemModel('profile', $this->translator->trans('sonata_profile_title', [], 'SonataUserBundle'), 'fos_user_profile_show', [], 'fa fa-user');
        $editProfile = new MenuItemModel('edit_profile', $this->translator->trans('link_edit_profile', [], 'SonataUserBundle'), 'fos_user_profile_edit', [], 'fa fa-edit');
        $profileGroup
            ->addChild($profile)
            ->addChild($editProfile);
        $services = new MenuItemModel('services', 'Услуги', 'profile_services', [], 'fa fa-list');
        $bookings = new MenuItemModel('bookings', 'Заказы', 'profile_bookings', [], 'fa fa-check-square-o');
        $billingGroup
            ->addChild($services)
            ->addChild($bookings);

        return $this->activateByRoute($request->get('_route'), $rootItems);
    }

    protected function activateByRoute($route, $items) {
        foreach($items as $item) { /** @var $item MenuItemModel */
            if($item->hasChildren()) {
                $isActive = false;
                foreach ($item->getChildren() as $childItem) {
                    if ($childItem->getRoute() == $route) {
                        $isActive = true;
                    }
                }
                $item->setIsActive($isActive);
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }
        return $items;
    }

    public function onThemeSidebarSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();
        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }
    }

} 