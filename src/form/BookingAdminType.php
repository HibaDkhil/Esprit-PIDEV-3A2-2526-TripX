<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookingAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Pending' => 'pending',
                    'Confirmed' => 'confirmed',
                    'Cancelled' => 'cancelled',
                ]
            ])
            ->add('paymentStatus', ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'Unpaid' => 'unpaid',
                    'Paid' => 'paid',
                    'Refunded' => 'refunded',
                ]
            ])
            ->add('numGuests', IntegerType::class, ['required' => false])
            ->add('notes', TextareaType::class, ['required' => false])
            ->add('totalAmount', NumberType::class, [
                'required' => false,
                'scale' => 2,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
