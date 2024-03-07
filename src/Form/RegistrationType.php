<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Nom d\'utilisateur *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom d\'utilisateur.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'input-text']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer votre mot de passe.',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez confirmer votre mot de passe.',
                        ]),
                    ],
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Email *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse email.',
                    ]),
                    new Email([
                        'message' => 'Veuillez entrer une adresse email valide.',
                    ]),
                ],
            ])
            ->add('number_siret', TextType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Numéro SIRET',
                ],
                'required' => false,
            ])
            ->add('phone_number', IntegerType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Numéro de téléphone',
                ],
                'required' => false,
            ])
            ->add('name_company', TextType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Nom de l\'entreprise',
                ],
                'required' => false,
            ])
            ->add('company_phone_number', IntegerType::class, [
                'attr' => [
                    'class' => 'input-text',
                    'placeholder' => 'Numéro de téléphone de l\'entreprise',
                ],
                'required' => false,
            ])
            
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
}


}