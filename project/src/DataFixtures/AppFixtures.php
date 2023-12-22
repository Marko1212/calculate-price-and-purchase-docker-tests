<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('IPhone');
        $product1->setPrice(100);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Earphones');
        $product2->setPrice(20);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Case');
        $product3->setPrice(10);
        $manager->persist($product3);

        $manager->flush();
    }
}
