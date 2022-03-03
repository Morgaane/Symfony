<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\GestionType;
use App\Form\GestionEditType;
use App\Repository\GestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use DateTime;


#[Route('/gestion')]
class GestionController extends AbstractController
{

    #[Route('/', name: 'calendar_index', methods: ['GET'])]
    public function index(GestionRepository $calendarRepository): Response
    {
        return $this->render('gestion/index.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'calendar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
//        $mysql =mysqli_connect("127.0.0.1:3306", "root", "");
//        mysqli_select_db($mysql,"calendear");
//
//
//        $feries=['01/11/2017 00:00:00',
//            '25/12/2017 00:00:00',
//            '01/01/2018 00:00:00',
//            '02/04/2018 00:00:00',
//            '08/05/2018 00:00:00',
//            '10/05/2018 00:00:00',
//            '21/05/2018 00:00:00',
//            '14/07/2018 00:00:00',
//            '15/08/2018 00:00:00',
//        ];
        $calendar = new Calendar();
        $form = $this->createForm(GestionType::class, $calendar);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

//            $donnees =$form['start']->getData();
////            $zedate = $donnees->format('d-m-Y h:m:s');
////
////            $sql="SELECT COUNT(*) FROM calendear WHERE start=".$zedate;
//            var_dump(date_format($donnees,"d-m-Y"));
//            var_dump($donnees);
//            if($donnees){
//                foreach ($feries as $ferie){
//                    $jourFerie=new DateTime($ferie);
//                    if($calendar->getStart()->format("d-m-Y")==$jourFerie){
//                        $this->addFlash('error',"L'évènement a été ajouté.");
//                        return $this->redirectToRoute('calendar_new', [], Response::HTTP_SEE_OTHER);
//
//                    }
//
//                }
//            }

            $entityManager->persist($calendar);
//            $entityManager->flush();

            $this->addFlash('success',"L'évènement a été ajouté.");
            return $this->redirectToRoute('calendar_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gestion/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'calendar_show', methods: ['GET'])]
    public function show(Calendar $calendar): Response
    {
        return $this->render('gestion/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    #[Route('/{id}/edit', name: 'calendar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GestionEditType::class, $calendar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gestion/edit.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'calendar_delete', methods: ['POST'])]
    public function delete(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$calendar->getId(), $request->request->get('_token'))) {
            $entityManager->remove($calendar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
    }
}
