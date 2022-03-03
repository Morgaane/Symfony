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
            isset($donnets->NomMatiere) && !empty($donnee->NomMatiere) &&
            isset($donnets->Debut) && !empty($donnee->Debut) &&
            isset($donnets->Description) && !empty($donnee->Description) &&
            isset($donnets->CouleurDeFond) && !empty($donnee->CouleurDeFond) &&
            isset($donnets->CouleurDuTexte) && !empty($donnee->CouleurDuTexte)
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
            $calendar->setNomMatiere($donnees->NomMatiere);
            $calendar->setDebut(new DateTime($donnees->Debut));
            $calendar->setDescription($donnees->Description);
            $calendar->setFin((new DateTime($donnees->Fin)));
            $calendar->setCouleurDeFond($donnees->CouleurDeFond);
            $calendar->setCouleurDuTexte($donnees->CouleurDuTexte);

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