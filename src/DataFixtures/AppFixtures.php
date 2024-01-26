<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 30 products
        for ($i = 0; $i < 30; $i++) {
            $product = new Product();
            $product->setCode(000 . $i);
            $product->setDescription('product' . mt_rand(10, 100));
            $product->setUnit('Unidad');
            $product->setSize('Mediano');
            $product->setIva('19');
            $product->setCreationDate(\DateTime::createFromFormat('d-m-Y', '25-01-2024'));
            $product->setUpdateDate(\DateTime::createFromFormat('d-m-Y', '25-01-2024'));
            $product->setStatus('ACTIVO');
            $manager->persist($product);
        }

        $manager->flush();
    }
}
