<?php

namespace App\Controller;

use App\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class MatiereApiController extends AbstractController
{
    #[Route('/matiereapi', name: 'api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/matiereapi/{id}/edit', name: 'matiereapi_event_edit', methods:'PUT')]
    public function majEvent(?Matiere $matiere, Request $request,ManagerRegistry $doctrine): Response
    {

        //On récupère les données
        $donnees =json_decode($request->getContent());

        if(
            isset($donnees->NomMatiere) && !empty($donnees->NomMatiere) &&
            isset($donnees->NomIntervenant) && !empty($donnees->NomIntervenant) &&
            isset($donnees->TotalHeure) && !empty($donnees->TotalHeure)
        ){

            //les données sont complètes
            $code = 200;
            //On vérifie si l'id existe
            if(!$matiere){

                //On instance un rendez-vous
                $matiere = new Matiere;

                //On change le code
                $code =201;

            }
            $matiere->setNomMatiere($donnees->NomMatiere);
            $matiere->setNomIntervenant($donnees->setNomIntervenant);
            $matiere->setTotalHeures($donnees->TotalHeure);
            $matiere->setHeuresRestantes($donnees->TotalHeure);

            $em = $doctrine->getManager();
            $em->persist($matiere);
            $em->flush();

            return new Response('OK',$code);
        }else{
            //Les données sont incomplètes

            return new Response('Données incomplètes', 404);
        }
        return $this->render('matiereapi/index.html.twig', [
            'controller_name' => 'MatiereApiController',
        ]);
    }
}
