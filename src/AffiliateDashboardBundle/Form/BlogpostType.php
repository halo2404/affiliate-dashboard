<?php

namespace AffiliateDashboardBundle\Form;

use AffiliateDashboardBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogpostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('publishedAt', DatetimeType::class)
            ->add('url')
            ->add('affiliateTag')
            ->add(
                'user',
                EntityType::class,
                array(
                    'class' => User::class,
                    'choice_label' => 'name',
                    'expanded' => true,
                    'multiple' => true
                )
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AffiliateDashboardBundle\Entity\Blogpost'
        ));
    }
}
