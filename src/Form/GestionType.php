<?php


namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomMatiere', EntityType::class, [
                'class'=> Matiere::class,
                'choice_label'=>'NomMatiere',
                'placeholder'=> 'Choix de la matière'
            ])
            ->add('Debut', DateTimeType::class, array( 'widget' => 'single_text'))
            ->add('Fin', DateTimeType::class,  array( 'widget' => 'single_text'))
            ->add('Description')
            ->add('CouleurDeFond', ColorType::class, )
            ->add('CouleurDuTexte', ColorType::class, )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
