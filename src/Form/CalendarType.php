<?php


namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\Date;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('day', DateType::class, ['widget' => 'single_text'])
//            ->add('end', DateType::class, 'day')
            ->add('end', HiddenType::class, [
                'empty_data' => new \DateTime("0001-01-01 00:00:00"),
                'required'=> false,])
            ->add('position_journee', ChoiceType::class,
                [
                    'choices' => [
                        'Matin' => "3",
                        'Après-midi' => "4",
                    ]])
            ->add('description')
            ->add('background_color', ColorType::class, [
                'empty_data' => "#FFD5CB",
            ])
            ->add('text_color', ColorType::class, [
                'empty_data' => "#000000",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
