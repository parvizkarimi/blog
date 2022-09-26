<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Articles;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Factory::create();

    $users = [];
    for ($i = 1; $i <= 50; $i++) {
      $user = new Users();
      $user->setFirstname($faker->firstname())
        ->setLastname($faker->lastname())
        ->setEmail($faker->email())
        ->setPassword($faker->password())
        ->setCreatedAt(new \DateTimeImmutable());
      $manager->persist($user);
      $users[] = $user;
    }


    $categories = [];
    for ($i = 1; $i <= 15; $i++) {
      $category = new Categories();
      $category->setTitle($faker->word())
        ->setDescription($faker->realText(rand(100,2000)))
->setImage("https://picsum.photos/300/200?random=".$i+1);
      $manager->persist($category);
      $categories[] = $category;
    }

    for ($i = 1; $i <= 111; $i++) {
      $article = new Articles();
      $article->setTitle($faker->word())
        ->setContent($faker->realText(rand(100,6000)))
->setImage("https://picsum.photos/300/200?random=".$i+1)
        ->setCreatedAt(new \DateTimeImmutable())
        ->addCategory($categories[$faker->numberBetween(1, 14)])
        ->setUser($users[$faker->numberBetween(1, 49)]);
      $manager->persist($article);
      $articles[] = $article;
    }

    $manager->flush();
  }
}
