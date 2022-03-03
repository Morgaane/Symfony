<?php


namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Intervenant;
use App\Repository\IntervenantRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType ;

class MatiereForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

            $builder
                ->add('NomMatiere')
                ->add('TotalHeures', IntegerType::class)
                ->add('NomIntervenant',
                    EntityType::class, [
                        'class' => Intervenant::class,
                        'choice_label'=>"Nom",
                        'placeholder'=>"Choix de l'intervenant"
                    ]);
        }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
