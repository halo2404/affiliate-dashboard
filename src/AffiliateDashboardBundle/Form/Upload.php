<?php

namespace AffiliateDashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class Upload extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'data',
            FileType::class,
            array('label' => 'Report data (XML file)')
        );

        $builder->add(
            'save',
            SubmitType::class,
            array('label' => 'Upload file')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AffiliateDashboardBundle\Service\Xmlfile',
            )
        );
    }
}