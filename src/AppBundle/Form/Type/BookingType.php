<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookingType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction('javascript:void();')
            ->setMethod('post')
            ->add('tariff', 'entity', array(
                'class' => 'AppBundle:Tariff',
                'label' => 'Тариф',
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
        ;
    }

    public function getName()
    {
        return 'booking_form';
    }
} 