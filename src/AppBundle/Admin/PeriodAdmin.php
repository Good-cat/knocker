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
use AppBundle\Entity\Period;

class PeriodAdmin extends  Admin
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
            ->add('unitsNumber', null, array(
                'label' => 'Количество',
                'attr' => array(
                    'title' => 'Обязательное поле'
                )
            ))
            ->add('unit', 'choice', array(
                'choices' => Period::getAvailablePeriods(),
                'choice_translation_domain' => $this->getTranslationDomain()
            ))
            ->add('perDay', null)
            ->add('cost', null)
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Название'))
            ->add('unitsNumber', null, array('label' => 'Количество', 'editable' => true))
            ->add('unit', 'choice', array(
                'choices'=>Period::getAvailablePeriods(),
                'catalogue' => $this->getTranslationDomain()))
            ->add('perDay', null, array('editable' => true))
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