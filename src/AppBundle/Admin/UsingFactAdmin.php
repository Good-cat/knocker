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

class UsingFactAdmin extends  Admin
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
            ->add('code', null, array(
                'label' => 'Шифр',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
            ->add('cost', null, array(
                'label' => 'Стоимость',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->add('code', null, array('label' => 'Шифр', 'editable' => true))
            ->add('cost', 'number', array('editable' => true))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, array('label' => 'Название'))
//            ->add('slug', null, array('label' => 'Шифр'))
        ;
    }
} 