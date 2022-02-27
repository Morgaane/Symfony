<?php


namespace App\Form;

use App\Entity\Matiere;
use App\Entity\Intervenant;
use App\Controller\IntervenantController;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\Mapping as ORM;

class MatiereForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $list = $this->getDoctrine()
//            ->getRepository(Intervenant::class)->findAll();
//        $this->logger = $list;

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
