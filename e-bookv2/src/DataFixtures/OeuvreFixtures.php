<?php

namespace App\DataFixtures;

use App\Controller\OeuvreController;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ebookv2;

class OeuvreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 3;$i++){
            $category = new Category();
            $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());
            $manager->persist($category);

            for($j =1; $j < 10; $j++){
                $concepts = new Ebookv2();
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>'). '</p>';
                $concepts->setTitre($faker->sentence())
                    ->setDescription($content)
                    ->setAuteur("Tiffanie")
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);
                $manager->persist($concepts);
            }

        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
