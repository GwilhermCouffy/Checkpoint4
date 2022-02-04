<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeerFixtures extends Fixture implements DependentFixtureInterface
{

    public const BEERS = [
        ["Leffe Blonde", "Blonde", "Belgique", 6.6, "/build/images/leffe_blonde.jpg"],
        ["Cuvée des Trolls", "Blonde", "Belgique", 7.5, "/build/images/cuvee_des_trolls.jpg"],
        ["Chouffe", "Blonde", "Belgique", 8, "/build/images/chouffe.jpg"],
        ["Grimbergen", "Rouge", "Belgique", 5.5, "/build/images/grimbergen_ruby.jpg"],
        ["Goudale", "Blonde", "France", 7.2, "/build/images/goudale.jpg"],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach(SELF::BEERS as $beerInfos) {
            $beer = new Beer();
            $beer->setName($beerInfos[0]);
            $beer->setType($beerInfos[1]);
            $beer->setCountry($beerInfos[2]);
            $beer->setAlcoholLevel($beerInfos[3]);
            $beer->setPicture($beerInfos[4]);
            $beer->addUser($this->getReference("Gwilherm"));
            $manager->persist($beer);
        }
        $beer = new Beer();
            $beer->setName("Pilsner Urquell");
            $beer->setType("Blonde");
            $beer->setCountry("Tcheque");
            $beer->setAlcoholLevel("15.6");
            $beer->setPicture("/build/images/goudale.jpg");
            $beer->addUser($this->getReference("Richard"));
            $manager->persist($beer);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
