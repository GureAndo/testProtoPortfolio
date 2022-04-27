<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('lien',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('projet',TextType::class , ['attr' => ['class' => 'form-control mb-3']])
            ->add('img', FileType::class,[
                'required'=>false,
                'data_class'=>null,
                'attr'=>[
                    'class'=>'mt-3, mx-3'
                ]
            ])
            ->add('submit',SubmitType::class , ['attr' => ['class' => 'btn btn-primary mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
