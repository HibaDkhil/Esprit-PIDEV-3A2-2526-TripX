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
                ],
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Activity Name',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('category', ChoiceType::class, [
                'required' => true,
                'label' => 'Category *',
                'placeholder' => 'Select a category',
                'choices' => [
                    'Tour' => 'tour',
                    'Adventure' => 'adventure',
                    'Cultural' => 'cultural',
                    'Food' => 'food',
                    'Relaxation' => 'relaxation',
                    'Nightlife' => 'nightlife',
                    'Sports' => 'sports',
                    'Wellness' => 'wellness',
                    'Other' => 'other',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('price', NumberType::class, [
                'required' => true,
                'scale' => 2,
                'label' => 'Price',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('currency', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'GBP' => 'GBP',
                    'TND' => 'TND',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('durationMinutes', IntegerType::class, [
                'required' => true,
                'label' => 'Duration (minutes)',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('capacity', IntegerType::class, [
                'required' => true,
                'label' => 'Capacity',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
                'attr' => ['class' => 'form-control', 'rows' => 5],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}