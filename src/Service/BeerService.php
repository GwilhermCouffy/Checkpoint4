<?php

namespace App\Service;

use App\Entity\Beer;
use App\Entity\User;
use App\Repository\BeerRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BeerService extends AbstractController {
    
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    
    public function isUserBeer(Beer $beer)
    {
        return ($beer != $this->security->getUser()->getBeers()) ;
    }
    
    public function nonDrinkBeers(BeerRepository $beerRepository) {

        // $criteria = new Criteria();
        // $criteria->where(Criteria::expr()->neq("users"->getId(), $this->getUser()));

        // return $beerRepository->matching($criteria);

        // $em = $this->getEntityManager();
        // $query = $em->createQuery("SELECT * FROM beer INNER JOIN beer_user ON beer_id = id WHERE user_id !=".$this->getUser()->getId());

        // dd($query->execute());

        // return $query->execute();

        // $userBeers = $this->security->getUser()->getBeers();

        $beers = $beerRepository->findAll();
        $nonConsumeBeers = array_filter($beers, "isUserBeer");
        // foreach($nonConsumeBeers as $beer) {
        //         array_push($nonConsumeBeers, $beer);
        //     }
        // }
        dd($nonConsumeBeers);
        return $nonConsumeBeers;
    }


}