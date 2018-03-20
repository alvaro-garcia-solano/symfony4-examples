<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //create 20 products
        for($i=0;$i<20;$i++)
        {

            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('Prueba dummy data');
            $manager->persist($product);
        }

        $manager->flush();
    }
}

