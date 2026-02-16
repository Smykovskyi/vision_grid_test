<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class CalculationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carrier', TextType::class, [
                'label' => 'Shipping carriers',
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 1, 'max' => 100]),
                    new Type(type: 'string'),
                    new Regex([
                        'pattern' => '/^[\p{L}]+$/u',
                        'message' => 'Carrier company Name can only contain letters',
                    ]),
                ]
            ])
            ->add('weight', IntegerType::class, [
                'label' => 'Shipping weight',
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new PositiveOrZero()
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
