<?php


namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Intervenant;
use App\Controller\MatieresController;
use App\Repository\IntervenantRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatiereForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $intervenants = $this->findId();
//
//        $this->logger = $intervenants;

        $builder
            ->add('Nom_Matiere')
            ->add('Total_Heures')
            ->add('ID_Intervenant',  ChoiceType::class, [
                'choices'  => [
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
