<?php

namespace App\Controller;

use App\Form\ProviderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    #[Route('/provider/create', name: 'create_provider', methods: ['GET', 'POST'])]
    public function createCustomer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProviderType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Proveedor creado con éxito');
            return $this->redirectToRoute('create_provider');
        }
        return $this->render('provider/create_provider.html.twig', [
            'form_create_provider' => $form->createView()
        ]);
    }

}
