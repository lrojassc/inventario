<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsListController extends AbstractController
{

    #[Route('/list/products', name: 'list_products', methods: ['GET'])]
    public function getProducts(EntityManagerInterface $entityManager): Response
    {
        return $this->render('lists/products_list.html.twig', [
            'products' => $entityManager->getRepository(Product::class)->findAll()
        ]);
    }
}
