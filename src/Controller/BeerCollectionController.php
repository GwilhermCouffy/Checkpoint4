<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\User;
use App\Form\BeerType;
use App\Service\BeerService;
use App\Repository\BeerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user/beer')]
class BeerCollectionController extends AbstractController
{
    #[Route('/', name: 'beerCollection_index', methods: ['GET'])]
    public function index(
        Request $request,
        BeerService $beerService,
        BeerRepository $beerRepository,
        ): Response
    {
        $beerService->nonDrinkBeers($beerRepository);
        return $this->render('beerCollection/index.html.twig', [
            'Userbeers' => $this->getUser()->getBeers(),
            'beersConsumedNumber' => count($this->getUser()->getBeers()),
            // 'otherBeers' => $beerRepository->nonDrinkBeers($this->getUser()->getId()),
        ]);
    }

    // public function

}