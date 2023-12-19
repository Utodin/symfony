<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
 use Faker;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hash;
    public function __construct(UserPasswordHasherInterface $pwd) {
        $this->hash = $pwd;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        //  $manager->persist($product);

         $faker = Faker\Factory::create('fr_FR');

        for ($i=1; $i <10 ; $i++) { 
        $user = new User();
        $user->setPrenom("Bart");
        $user->setNom("Simpson");
        $user->setEmail("Bart$i@test.fr");
        $password=$this->hash->hashPassword($user,"test123");
        $user->setPassword($password);

        $manager->persist($user); // Recupère les infos saisie par l'user
}
        $manager->flush();
    }
}
