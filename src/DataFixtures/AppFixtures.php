<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();

            $product->setReference($i)
                    ->setName('Produit n°'. $i)
                    ->setPrice(rand(1, 200));
                    
            $manager->persist($product);
         }


        $manager->flush();
    }
}
