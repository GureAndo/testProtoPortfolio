<?php

namespace App\Form;

use App\Entity\Experiance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ExperianceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poste',TextType::class, ['attr' => ['class' => 'form-control mb-3']])
            ->add('date',BirthdayType::class, ['attr' => ['class' => '']])
            ->add('dateFin',BirthdayType::class, ['attr' => ['class' => '']])
            ->add('lieu',TextType::class, ['attr' => ['class' => 'form-control mb-3']])
            ->add('entreprise',TextType::class, ['attr' => ['class' => 'form-control mb-3']])
            ->add('description',TextareaType::class, ['attr' => ['class' => 'form-control mb-3']])
            ->add('submit',SubmitType::class , ['attr' => ['class' => 'btn btn-primary mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experiance::class,
        ]);
    }
}
