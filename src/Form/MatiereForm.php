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

class MatiereForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_Matiere')
            ->add('Total_Heures')
            ->add('Id_Intervenant',
                EntityType::class, [
                                'class' => Intervenant::class,

                'choice_label'=>"Nom",
            ])
//                ,  EntityType::class, [
//                'class' => Intervenant::class,
////                    'choice_label' => function(Intervenant $user) {
////                        return sprintf('(%d) %s', $user->getNom());
////                    },
//                'choice_label'=>'Nom',
//                    'required' => true,
//
////            'constraints' => new NotBlank(['message'=> 'Veuillez choisir un intervenant, vous pourrez le modifier plus tard.'])
////                'choice_label'=>'id',
////                'query_builder' =>   function (IntervenantRepository $rep){
////                    return $rep->createQueryBuilder('intervenant');
////                },
////                'choice_label'  =>   function ($inter){
////                return $inter->getNom();
////                }
////                    'Nom'/*[
//                   /*=> 'id',*/
////                    'Yes' => true,
////                    'No' => false,
//                ]
//        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
