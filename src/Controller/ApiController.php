<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/api/{id}/edit', name: 'api_event_edit', methods:'PUT')]
    public function majEvent(?Calendar $calendar, Request $request): Response
    {
        $logger = $this->getContainer()->get('logger');

        //On récupère les donnéez
        $donnees =json_decode($request->getContent());

        if(
            isset($donnets->title) && !empty($donnee->title) &&
            isset($donnets->start) && !empty($donnee->start) &&
            isset($donnets->description) && !empty($donnee->description) &&
            isset($donnets->backgroundColor) && !empty($donnee->backgroundColor) &&
            isset($donnets->borderColor) && !empty($donnee->borderColor) &&
            isset($donnets->textColor) && !empty($donnee->textColor)
        ){

            $logger->info("OK");
            //les données sont complètes
            $code = 200;
            //On vérifie si l'id existe
            if(!$calendar){
                $logger->info("OK");

                //On instance un rendez-vous
                $calendar = new Calendar;

                //On change le code
                $code =201;

            }
            $calendar->setTitle($donnees->title);
            $calendar->setStart(new DateTime($donnees->start));
            $calendar->setDescription($donnees->description);
            if($donnees->allDay){
                $logger->info("OK");

                $calendar->setEnd((new DateTime($donnees->start)));
            }else{
                $logger->info("OK");

                $calendar->setEnd((new DateTime($donnees->end)));

            }
            $calendar->setAllDay($donnees->allDay);
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setBorderColor($donnees->borderColor);
            $calendar->setTextColor($donnees->textColor);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            return new Response('OK',$code);
        }else{
            //Les données sont incomplètes
            $logger->error("NAN");

            return new Response('Données incomplète', 404);
        }
//        return $this->render('api/index.html.twig', [
//            'controller_name' => 'ApiController',
//        ]);
    }
}
