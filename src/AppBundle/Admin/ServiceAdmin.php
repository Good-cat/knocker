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

class ServiceAdmin extends  Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array(
                'label' => 'Название',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
            ->add('slug', 'text', array(
                'label' => 'Шифр',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
            ->add('costCoefficient', null)
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->add('slug', null, array('label' => 'Шифр'))
            ->add('isActive', null, array('label' => 'Активна', 'editable' => true))
            ->add('costCoefficient', null, array('editable' => true))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Название'))
            ->add('slug', null, array('label' => 'Шифр'))
        ;
    }
} 