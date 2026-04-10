<?php

namespace App\form;

use App\Entity\Activity;
use App\Entity\Destination;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a destination',
                'required' => true,
                'label' => 'Destination *',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'width:100%; padding:10px; border-radius:8px; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-primary);'
                ]
            ])
            ->add('name', TextType::class, ['required' => false])
            ->add('category', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Tour' => 'tour',
                    'Sport' => 'sport',
                    'Relax' => 'relax',
                    'Culture' => 'culture',
                    'Food' => 'food',
                    'Adventure' => 'adventure',
                    'Wellness' => 'wellness',
                    'Other' => 'other',
                ]
            ])
            ->add('price', NumberType::class, [
                'required' => false,
                'scale' => 2,
            ])
            ->add('currency', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'GBP' => 'GBP',
                    'TND' => 'TND',
                ]
            ])
            ->add('durationMinutes', IntegerType::class, ['required' => false])
            ->add('capacity', IntegerType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}