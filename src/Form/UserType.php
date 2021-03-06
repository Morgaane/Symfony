<?php

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Total_Heure',NumberType::class, [
                'label' => false,
            ])
            ->add('Total_Restantes',NumberType::class, [
                'label' => false,
            ])
            ->add('prenom',TextType::class, [
                'label' => false,
            ])
            ->add('nom',TextType::class, [
                'label' => false,
            ])
            ->add('username',TextType::class, [
                'label' => false,
            ])
            ->add('mail', EmailType::class,
                [
                    'label'     => false,
                    'required'  => true,
                ]
            )
            ->add('password', RepeatedType::class, [
                'type'      => PasswordType::class,
                'required'  => true,
                'invalid_message' => 'Les mots de passe ne sont pas correspondants.',
                'first_options' => ['label' => false],
                'second_options' => ['label' => false]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}