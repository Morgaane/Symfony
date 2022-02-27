<?php

namespace App\Controller;

use App\Repository\GestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/', name: 'planning')]
    public function index(GestionRepository $calendar): Response
    {
        $events  = $calendar ->findAll();
        $rdvs = [];
foreach ($events as $event){
$rdvs[] = [
    'id' => $event->getId(),
    'start' => $event->getStart()->format('d-m-Y H:i:s'),
    'end' => $event->getEnd()->format('d-m-Y H:i:s'),
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
