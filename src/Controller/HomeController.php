<?php

namespace App\Controller;

use App\Service\FiltreService;
use App\Repository\BeerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    // Dashboard de l'interne
    #[Route("/", name: "")]
    public function index(BeerRepository $beerRepository): Response
    {
        // Permet de rediriger immédiatement vers le login si pas connecté
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        return $this->render('beer/index.html.twig', [
            'beers' => $beerRepository->findAll(),
        ]);
    }
}
