<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


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
    public function majEvent(?Calendar $calendar, Request $request,ManagerRegistry $doctrine): Response
    {

        //On récupère les données
        $donnees =json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){

            //les données sont complètes
            $code = 200;
            //On vérifie si l'id existe
            if(!$calendar){

                //On instance un rendez-vous
                $calendar = new Calendar;

                //On change le code
                $code =201;

            }
            $calendar->setTitle($donnees->title);
            $calendar->setStart(new DateTime($donnees->start));
            $calendar->setDescription($donnees->description);
            $calendar->setEnd((new DateTime($donnees->end)));
            $calendar->setBackgroundColor($donnees->backgroundColor);
            $calendar->setTextColor($donnees->textColor);

            $em = $doctrine->getManager();
            $em->persist($calendar);
            $em->flush();

            return new Response('OK',$code);
        }else{
            //Les données sont incomplètes

            return new Response('Données incomplète', 404);
        }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
