<?php

namespace App\Form;

use App\Entity\TxtContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TxtContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('creatAt')
            ->add('updateAt')
            ->add('language')
            ->add('block')
            ->add('page')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TxtContent::class,
        ]);
    }
}
