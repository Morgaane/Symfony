<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/', name: 'planning')]
    public function index(CalendarRepository $calendar): Response
    {
        $events  = $calendar ->findAll();
        $rdvs = [];
        foreach ($events as $event){
            $rdvs[] = [
                'id' => $event->getId(),
                'day' => $event->getDay()->format('Y-m-d'),
                'position_journee' => $event->getPositionJournee(),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
            ];
        }
        $data = json_encode($rdvs );
        return $this->render('planning/index.html.twig', compact('data'));
            }
}
