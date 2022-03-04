<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\IntervenantType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use UserType;

#[Route('/intervenants')]
class IntervenantController extends AbstractController
{



    #[Route('/', name: 'intervenant_index',methods: ['GET'])]
    public function index(UserRepository $user): Response
    {
        if(!$this->isGranted('ROLE_USER') && !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('not allowed');
        }



        return $this->render('intervenant/index.html.twig', [
            'users' =>$user->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'intervenant_show', methods: ['GET'])]
    public function show(UserRepository $user,$id): Response
    {
        return $this->render('intervenant/show.html.twig', [
            'users' => $user->find($id),
        ]);
    }

    #[Route('/{id}/edit', name: 'intervenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager,$id): Response
    {
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('intervenant/edit.html.twig', [
            'users' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'intervenant_delete', methods: ['POST'])]
    public function delete(Request $request, User $calendar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($calendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('intervenants', [], Response::HTTP_SEE_OTHER);
    }


}

