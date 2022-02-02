<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public const USERS = [
        ["Gwilherm", "prout", ['ROLE_ADMIN']]
    ];
    
    public function load(ObjectManager $manager): void
    {
        foreach(self::USERS as $userInfos) {
            $user = new User();
            $user->setUsername($userInfos[0]);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $userInfos[1]
            );
            $user->setPassword($hashedPassword);
            $user->setRoles($userInfos[2]);
            $this->addReference($userInfos[0], $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
