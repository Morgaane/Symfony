<?php

namespace App\Controller;

use App\Entity\Calendar;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="GestionRepository")
 */

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
    public function majEvent(?Gestion $gestion, Request $request,ManagerRegistry $doctrine): Response
    {
        //On récupère les données
        $donnees =json_decode($request->getContent());
        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){

            //les données sont complètes
            $code = 200;
            //On vérifie si l'id existe
            if(!$gestion){

                //On instance un rendez-vous
                $gestion = new Gestion;

                //On change le code
                $code =201;

            }
            $gestion->setTitle($donnees->title);
            $gestion->setStart(new DateTime($donnees->start));
            $gestion->setDescription($donnees->description);
            $gestion->setEnd((new DateTime($donnees->end)));
            $gestion->setBackgroundColor($donnees->backgroundColor);
            $gestion->setTextColor($donnees->textColor);

            $em = $doctrine->getManager();
            $em->persist($gestion);
            $em->flush();

            return new Response('OK',$code);
        }else{
            //Les données sont incomplètes

            return new Response('Données incomplètes', 404);
        }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
