<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['placeholder' => 'Give your post a clear, catchy title…'],
            ])
            ->add('body', TextareaType::class, [
                'attr' => ['placeholder' => 'Tell your story, share your experience…'],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Inquiry' => 'inquiry',
                    'Story'   => 'story',
                    'Review'  => 'review',
                    'Advice'  => 'advice',
                    'Other'   => 'other',
                ],
                'placeholder' => 'Choose a type',
            ])
            // File upload — mapped: false so we handle it manually in the controller
            ->add('imageFile', FileType::class, [
                'label'    => 'Images (optional)',
                'mapped'   => false,
                'required' => false,
                'multiple' => true,
                'attr'     => [
                    'accept'   => 'image/*',
                    'multiple' => 'multiple',
                ],
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'maxSize' => '5M',
                            ]),
                        ],
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}