<?php

namespace App\Controller;

use App\Form\CustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer/create', name: 'create_customer', methods: ['GET', 'POST'])]
    public function createCustomer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Cliente creado con éxito');
            return $this->redirectToRoute('create_customer');
        }
        return $this->render('customer/create_customer.html.twig', [
            'form_create_customer' => $form->createView()
        ]);
    }

}
