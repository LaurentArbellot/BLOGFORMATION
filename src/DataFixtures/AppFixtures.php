<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;
use App\Entity\Posts;
use App\Entity\Comments;
// FAKER
use Faker;


class AppFixtures extends Fixture
{
    private const MAX_USER = 20;
    private const MAX_POSTS_ADMIN = 10;
    private const MAX_POSTS_AUTHOR = 20;

    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    { 

        $faker = \Faker\Factory::create('fr_FR');
       


        // creation d'un compte admin
        $admin = new Users();
        $admin
            ->setUsername('admine')
            ->setEmail('a@a.fr')
            ->setPassword( $this->hasher->hashPassword($admin, 'Madlib91!'))
            ->setIsverified(TRUE)
            ->setRoles(["ROLE_ADMIN"]);

       

        $manager->persist($admin);
       

        $author = new Users();
        $author
            ->setUsername('admini')
            ->setEmail('ab@a.fr')
            ->setPassword( $this->hasher->hashPassword($author, 'Madlib91!'))
            ->setIsverified(TRUE)
            ->setRoles(["ROLE_AUTHOR"]);

       

        $manager->persist($author);
        // creation de MAX_USER comptes  avec le role MAX_USER
        for($i=0; $i<self::MAX_USER; $i++){
        $user = new Users();
        $user
            ->setUsername( $faker->userName())
            ->setEmail($faker->email())
            ->setPassword( $this->hasher->hashPassword($user, $faker->password(2, 8)))
            ->setIsverified(TRUE)
            ->setRoles([]);       

        $manager->persist($user);
    }
      
    // creation de MAX-POSTS_ADMIN articles le compte admin
    for($i=0; $i < self::MAX_POSTS_ADMIN; $i++){
        $post = new Posts();
        $post
            ->setTitle( $faker->realText($maxNbChars=100))
            ->setContent($faker->realText($maxNbChars=2000))
            ->setAuthor($admin );
            

        $manager->persist($post);
    }

    for($i=0; $i < self::MAX_POSTS_AUTHOR; $i++){
        $post = new Posts();
        $post
            ->setTitle( $faker->realText($maxNbChars=100))
            ->setContent($faker->realText($maxNbChars=2000))
            ->setAuthor($author );
            

        $manager->persist($post);
    }



        $manager->flush();
        
     
    }
}
