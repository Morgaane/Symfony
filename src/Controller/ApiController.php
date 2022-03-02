<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use Psr\Log\LoggerInterface;

class ApiController extends AbstractController
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods:'PUT')]
    public function majEvent(?Calendar $calendar, Request $request,ManagerRegistry $doctrine): Response
    {
//        var_dump($request);

        //On récupère les données
        if($calendar){
            $events  = $calendar ->findAll();
            $rdvs = [];
            foreach ($events as $event){
                $rdvs[] = [
                    'start' => $event->getStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                ];
            }
        }
        $datas = json_encode($rdvs);
//        $dat=$datas;
        $donnees =json_decode($request->getContent());
        $ifExist = false;

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->day) && !empty($donnees->day) &&
            isset($donnees->position_journee) && !empty($donnees->position_journee) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
                foreach ($datas as $data){
                    if(isset($data->day) == isset($donnees->day)){
                        $ifExist = true;
                    }
                }
                $this->logger->info($ifExist);

            if(!$ifExist){

                    //les données sont complètes
                $code = 200;
                //On vérifie si l'id existe
                if(!$calendar){

                    //On instance un rendez-vous
                    $calendar = new Calendar;

                    //On change le code
                    $code =201;

                }
                $donnees->end=$donnees->day;
                if($donnees->position_journee =="3"){
                    $day=$calendar->getDay()->format('d-m-Y H:i:s')->add(new DateInterval('PT09H'));
                    $calendar->setDay($day);
                    $end=$calendar->getDay()->format('d-m-Y H:i:s')->add(new DateInterval('PT03H'));
                    $calendar->setEnd($end);
                }
                else {
                    $day=$calendar->getDay()->format('d-m-Y H:i:s')->add(new DateInterval('PT13H'));

                    $calendar->setDay($day);
                    $end=$calendar->getDay()->format('d-m-Y H:i:s')->add(new DateInterval('PT04H'));

                    $calendar->setEnd($end);
                }
                $calendar->setTitle($donnees->title);
//                $calendar->setStart(new DateTime($donnees->day));
                $calendar->setDescription($donnees->description);
                $calendar->setPositionJournee($donnees->position_journee);
                $calendar->setBackgroundColor($donnees->backgroundColor);
                $calendar->setTextColor($donnees->textColor);

                $em = $doctrine->getManager();
                $em->persist($calendar);
                $em->flush();

                return new Response('OK',$code);
                }
                else{
                    return new Response('Un évènement existe déjà sur ces dates.', 404);
                }
            }else{
                //Les données sont incomplètes

                return new Response('Données incomplète', 404);
            }

        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ], $oui);
    }
}
