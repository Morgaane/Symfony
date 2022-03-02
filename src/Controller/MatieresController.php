<?php

namespace App\Controller;

use App\Form\MatiereForm;
use App\Entity\Matiere;
use App\Entity\Intervenant;
use App\Repository\IntervenantRepository;
use App\Repository\MatiereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping as ORM;
use Psr\Log\LoggerInterface;

/**
 * @ORM\Entity(repositoryClass="IntervenantRepository")
 */

/**
 * @method Matiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
#[Route('/matieres')]


class MatieresController extends AbstractController
{

    #[Route('/', name: 'matieres_index', methods: ['GET'])]
    public function index(MatiereRepository $matiereRepository): Response
    {
        return $this->render('matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'matieres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,MatiereRepository $matiereRepository): Response
    {

        $matiere = new Matiere();

        $form = $this->createForm(MatiereForm::class, $matiere);
        $form->handleRequest($request);

//        $allMatiere=$matiereRepository->findAll();


        $ifExists=false;
////        foreach( $allMatiere as $item) {
//            foreach ($matiere as $mat){
////                $po=$item->getNomMatiere();
////                if($po===$mat){
////                    $ifExists=true;
////
////                }
//                var_dump($mat);
//
//            }
////       }
//        if($ifExists){
//            var_dump($ifExists);
//        }

        $matiere->setHeuresRestantes(0);
        if ($form->isSubmitted() && $form->isValid()) {
            if($ifExists==false){
                $entityManager->persist($matiere);
                $entityManager->flush();

                $this->addFlash('success','La matière a été ajouté.');

            }
            else{
                $this->addFlash('error','La matière existe déjà.');

            }
            return $this->redirectToRoute('matieres_new', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);


    }

    #[Route('/{id}', name: 'matieres_show', methods: ['GET'])]
    public function show(Matiere $matiere): Response
    {
        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'matieres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matiere $matiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MatiereForm::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('matieres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'matieres_delete', methods: ['POST'])]
    public function delete(Request $request, Matiere $matiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getId(), $request->request->get('_token'))) {
            $entityManager->remove($matiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('/', [], Response::HTTP_SEE_OTHER);
    }


}
