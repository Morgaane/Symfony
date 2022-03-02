<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Form\CalendarType;
use App\Repository\CalendarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateInterval;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'calendar_index', methods: ['GET'])]
    public function index(CalendarRepository $calendarRepository): Response
    {
        return $this->render('calendar/index.html.twig', [
            'calendars' => $calendarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'calendar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $calendar = new Calendar();
        $form = $this->createForm(CalendarType::class, $calendar);
        $form->handleRequest($request);

//        if($calendar){
//             if($calendar->getPositionJournee() =="3"){
//                 $calendar->setDay($calendar->getDay()->add(new DateInterval('PT09H')));
//                 $calendar->setEnd($calendar->getDay()->add(new DateInterval('PT03H')));
//             }
//             else {
//                 $calendar->setDay($calendar->getDay()->add(new DateInterval('PT013H')));
//                 $calendar->setEnd($calendar->getDay()->add(new DateInterval('PT04H')));
//             }
//
//    }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($calendar);
            $entityManager->flush();

            return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('calendar/new.html.twig', [
            'calendar' => $calendar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'calendar_show', methods: ['GET'])]
    public function show(Calendar $calendar): Response
    {

        return $this->render('calendar/show.html.twig', [
            'calendar' => $calendar,
        ]);
    }

    #[Route('/{id}/edit', name: 'calendar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Calendar $calendar, EntityManagerInterface $entityManager): Response
    {
//        var_dump($request);
        $form = $this->createForm(CalendarType::class, $calendar);
        if($calendar->getPositionJournee() =="3"){
            $calendar->setDay((string)$calendar->getDay()->add(new DateInterval('PT09H')));
            $calendar->setEnd((string)$calendar->getDay()->add(new DateInterval('PT03H')));
        }
        else {

            $calendar->setDay((string)date($calendar->getDay())->add(new DateInterval('PT013H')));
            $calendar->setEnd((string)date($calendar->getDay())->add(new DateInterval('PT04H')));
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('calendar_index', [], Response::HTTP_SEE_OTHER);
        }
        $form->handleRequest($request);

        return $this->renderForm('calendar/edit.html.twig', [
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
