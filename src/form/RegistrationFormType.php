<?php

namespace App\form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'attr'  => ['id' => 'reg_first', 'autocomplete' => 'given-name'],
                'constraints' => [
                    new Assert\Length([
                        'min'        => 2,
                        'max'        => 50,
                        'minMessage' => 'First name must be at least {{ limit }} characters.',
                        'maxMessage' => 'First name cannot exceed {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'attr'  => ['id' => 'reg_last', 'autocomplete' => 'family-name'],
                'constraints' => [
                    new Assert\Length([
                        'min'        => 2,
                        'max'        => 50,
                        'minMessage' => 'Last name must be at least {{ limit }} characters.',
                        'maxMessage' => 'Last name cannot exceed {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr'  => ['id' => 'reg_email', 'autocomplete' => 'email'],
                'constraints' => [
                    new Assert\Email(['message' => 'Please enter a valid email address.']),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'          => PasswordType::class,
                'first_options' => [
                    'label' => 'Password',
                    'attr'  => ['id' => 'reg_password', 'autocomplete' => 'new-password'],
                    'constraints' => [
                        new Assert\Length([
                            'min'        => 8,
                            'minMessage' => 'Password must be at least {{ limit }} characters.',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirm Password',
                    'attr'  => ['id' => 'reg_confirm', 'autocomplete' => 'new-password'],
                ],
                'invalid_message' => 'Passwords do not match.',
            ])
            ->add('phoneNumber', TextType::class, [
                'label'    => 'Phone Number',
                'required' => false,
                'attr'     => ['id' => 'reg_phone'],
                'constraints' => [
                    new Assert\Length([
                        'max'        => 20,
                        'maxMessage' => 'Phone number cannot exceed {{ limit }} characters.',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create account',
                'attr'  => ['class' => 'btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'      => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id'   => 'register',
        ]);
    }
}
