<?php

namespace App\Form;

use App\Entity\Competance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('language',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('niveau',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('logo',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('submit',SubmitType::class , ['attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competance::class,
        ]);
    }
}
