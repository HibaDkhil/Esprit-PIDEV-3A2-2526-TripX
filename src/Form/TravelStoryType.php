<?php

namespace App\Form;

use App\Entity\TravelStory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// Field types
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

// Validation
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\All;

class TravelStoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $today = (new \DateTimeImmutable('today'))->format('Y-m-d');

        $builder

            // ───────── BASIC INFO ─────────
            ->add('title', TextType::class, [
                'required' => true,
            ])

            ->add('destination', TextType::class, [
                'required' => false,
            ])

            ->add('summary', TextareaType::class, [
                'required' => true,
            ])

            ->add('tips', TextareaType::class, [
                'required' => false,
            ])

            // ───────── TRAVEL INFO ─────────
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => 'story-date-input',
                    'max' => $today,
                ],
            ])

            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => [
                    'class' => 'story-date-input',
                    'max' => $today,
                ],
            ])

            ->add('travelType', ChoiceType::class, [
                'choices' => [
                    'Solo' => 'solo',
                    'Couple' => 'couple',
                    'Friends' => 'friends',
                    'Family' => 'family',
                    'Business' => 'business',
                ],
                'required' => false,
                'placeholder' => 'Select type',
            ])

            ->add('travelStyle', ChoiceType::class, [
                'choices' => [
                    'Budget' => 'budget',
                    'Standard' => 'standard',
                    'Luxury' => 'luxury',
                    'Backpacking' => 'backpacking',
                    'Adventure' => 'adventure',
                ],
                'required' => false,
                'placeholder' => 'Select style',
            ])

            // ───────── REVIEW ─────────
            ->add('overallRating', ChoiceType::class, [
                'choices' => [
                    '⭐ 1' => 1,
                    '⭐⭐ 2' => 2,
                    '⭐⭐⭐ 3' => 3,
                    '⭐⭐⭐⭐ 4' => 4,
                    '⭐⭐⭐⭐⭐ 5' => 5,
                ],
                'required' => false,
                'placeholder' => 'Rating',
            ])

            ->add('wouldRecommend', CheckboxType::class, [
                'required' => false,
            ])

            ->add('wouldGoAgain', CheckboxType::class, [
                'required' => false,
            ])

            // ───────── BUDGET ─────────
            ->add('currency', TextType::class, [
                'required' => false,
                'empty_data' => 'TND',
            ])

            ->add('totalBudget', NumberType::class, [
                'required' => false,
                'scale' => 2,
            ])

            // ───────── JSON FIELDS (TEXT INPUTS) ─────────
            ->add('tagsText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('favoritePlacesText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('mustVisitText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('mustDoText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('mustTryText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            ->add('budgetText', TextareaType::class, [
                'mapped' => false,
                'required' => false,
            ])

            // ───────── IMAGE UPLOAD (LIKE CREATE POST) ─────────
            ->add('imageFile', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'multiple' => true,
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'maxSize' => '5M',
                            ])
                        ]
                    ])
                ],
            ])
            // ───────── LEGACY FIELDS (KEPT FOR DB COMPATIBILITY) ─────────
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TravelStory::class,
        ]);
    }
}