<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace Application\Sonata\UserBundle\Admin;


use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends SonataUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
        ->tab('Услуги')
            ->with('Услуги')
                ->add('services', null, array(
                    'label' => 'Услуги',
                    'property' => 'slug'
                ))
            ->end()
        ->end()
    ;
    }
}