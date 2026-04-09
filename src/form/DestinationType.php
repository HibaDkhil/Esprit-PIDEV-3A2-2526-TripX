<?php

namespace App\form;

use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => false])
            ->add('country', TextType::class, ['required' => false])
            ->add('city', TextType::class, ['required' => false])
            ->add('type', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'City' => 'city',
                    'Beach' => 'beach',
                    'Mountain' => 'mountain',
                    'Countryside' => 'countryside',
                    'Desert' => 'desert',
                    'Island' => 'island',
                    'Forest' => 'forest',
                    'Cruise' => 'cruise',
                    'Other' => 'other',
                ]
            ])
            ->add('bestSeason', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Spring' => 'spring',
                    'Summer' => 'summer',
                    'Autumn' => 'autumn',
                    'Winter' => 'winter',
                    'All year' => 'all_year',
                ]
            ])
            ->add('estimatedBudget', NumberType::class, [
                'required' => false,
                'scale' => 2,
            ])
            ->add('imageUrl', TextType::class, ['required' => false])
            ->add('latitude', NumberType::class, [
                'required' => false,
                'scale' => 8,
            ])
            ->add('longitude', NumberType::class, [
                'required' => false,
                'scale' => 8,
            ])
            ->add('description', TextareaType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destination::class,
        ]);
    }
}
