<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class TariffAdmin extends Admin
{

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                'label' => 'Название',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
            ->add('period', 'entity', array(
                'class' => 'AppBundle:Period',
                'required' => false
            ))
            ->add('usingFact', 'entity', array(
                'class' => 'AppBundle:UsingFact',
                'required' => false
            ))
            ->add('forEachService', null)
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array())
        ;
    }
} 