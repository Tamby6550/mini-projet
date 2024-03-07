<?php

namespace App\Form;

use App\Entity\UsersStandard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserStandardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $rolesChoice = [
            'Lire seulement' => '1',
            'Lire et ecrire' => '2',
        ];
        $builder
            ->add('name')
            ->add('age')
            ->add('acces_role', ChoiceType::class, [
                'label' => 'Roles',
                'choices' => $rolesChoice,
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UsersStandard::class,
        ]);
    }
}
