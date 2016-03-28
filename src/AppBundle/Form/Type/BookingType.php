<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookingType extends AbstractType{

    protected $tokenStorage;
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('post')
            ->add('tariff', 'entity', array(
                'class' => 'AppBundle:Tariff',
                'label' => 'Тариф',
                'attr' => array(
                    'class' => 'form-control',
                    'style' => 'width: 100%'
                )
            ))
            ->add('urlPre', null, [
                'label' => 'url.pre'
            ])
            ->add('urlPost', null, [
                'label' => 'url.post'
            ])
            ->add('services', 'entity', array(
                'class' => 'AppBundle:Service',
                'choice_label' => 'name',
                'choice_attr' => function($val, $key, $index) {
                        return ['class' => 'knocker'];
                    },
                'translation_domain' => 'KnockerDomain',
                'expanded' => false,
                'multiple' => true,
                'attr' => ['style' => 'width: 100%']
            ))
            ->add('currency', 'entity', array(
                'class' => 'AppBundle:Currency',
                'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->leftJoin('c.regions', 'r')
                            ->andWhere('r.id = :region')
                            ->setParameter('region', $this->tokenStorage->getToken()->getUser()->getRegion())
                            ;
                    },
                'expanded' => false,
                'multiple' => false,
                'attr' => ['style' => 'width: 100%']
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Booking',
            'translation_domain' => 'KnockerDomain'
        ));
    }

    public function getName()
    {
        return 'booking_form';
    }
} 