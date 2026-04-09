<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destinationId', HiddenType::class, [
                'required' => false,
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
