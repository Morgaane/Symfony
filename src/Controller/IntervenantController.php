<?php

namespace App\Controller;

use App\Entity\Intervenant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IntervenantRepository")
 */
class IntervenantController extends AbstractController
{
    #[Route('/intervenants', name: 'intervenants')]
    public function index(): Response
    {
        return $this->render('intervenant/index.html.twig', [
            'controller_name' => 'IntervenantController',
        ]);
    }

    #[Route('/getIntervenants', name: 'getIntervenants')]
    public function getIntervenantsId(): Response
    {
        $list = $this->getDoctrine()
            ->getRepository(Intervenant::class)->findAll();
        return new Response($list);

    }


}
