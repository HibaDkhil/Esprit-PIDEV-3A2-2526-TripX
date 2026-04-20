<?php

namespace App\form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    '⭐ 1 — Poor'        => 1,
                    '⭐⭐ 2 — Fair'       => 2,
                    '⭐⭐⭐ 3 — Good'     => 3,
                    '⭐⭐⭐⭐ 4 — Great'   => 4,
                    '⭐⭐⭐⭐⭐ 5 — Excellent' => 5,
                ],
                'placeholder' => 'Select your rating',
                'label' => 'Your Rating',
                'required' => true,
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Your Review',
                'attr' => [
                    'placeholder' => 'Share your experience at this destination (min. 10 characters)...',
                    'rows' => 4,
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
