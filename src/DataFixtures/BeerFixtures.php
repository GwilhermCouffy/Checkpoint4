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
        ["Leffe", "Blonde", "Belgique", 6.6, "assets/images/leffe_blonde.jpg"],
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
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
