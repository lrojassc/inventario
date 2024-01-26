<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/create', name: 'create_product', methods: ['GET', 'POST'])]
    public function createProduct(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $product->setUpdateDate(\DateTime::createFromFormat('d-m-Y', date('d-m-Y')));
        $product->setStatus('ACTIVO');

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Producto creado con éxito');
            return $this->redirectToRoute('create_product');
        }
        return $this->render('product/create_product.html.twig', [
            'form_create_product' => $form->createView(),
        ]);
    }

    #[Route('/product/{code}/update', name: 'update_product', methods: ['GET', 'POST'])]
    public function updateProduct(Product $product, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Producto actualizado con éxito');
            return $this->redirectToRoute('update_product', [
                'code' => $product->getCode()
            ]);
        }
        return $this->render('product/update_product.html.twig', [
            'form_update_product' => $form->createView(),
            'code' => $product->getCode()
        ]);
    }

}
