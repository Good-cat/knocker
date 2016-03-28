<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Application\Sonata\UserBundle\Form\Type;

use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, array(
                'label'    => 'form.label_firstname',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('email', 'email', array(
                'label' => 'form.label_email',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('website', 'url', array(
                'label'    => 'form.label_website',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ))
            ->add('region', null)
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated Remove it when bumping requirements to Symfony 2.7+
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'application_sonata_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
