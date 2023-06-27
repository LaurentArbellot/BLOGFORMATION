<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;
use App\Entity\Posts;
use App\Entity\Comments;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    { 
        // creation d'un compte admin
        $admin = new Users();
        $admin
            ->setUsername('admin')
            ->setEmail('a@a.fr')
            ->setPassword( $this->hasher->hashPassword($admin, 'Madlib91!'))
            ->setIsverified(TRUE)
            ->setRoles(["ROLE_ADMIN"]);

       

        $manager->persist($admin);
        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

     
    }
}
