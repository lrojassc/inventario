<?php

namespace App\Controller;

use App\Form\PurchaseInvoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoicesController extends AbstractController
{
    #[Route('/invoices/purchase', name: 'purchase_invoice', methods: ['GET', 'POST'])]
    public function createPurchaseInvoice(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PurchaseInvoiceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();
            $this->addFlash('success', 'Factura de compra creada con éxito');
            return $this->redirectToRoute('purchase_invoice');
        }
        return $this->render('invoices/purchase_invoice.html.twig', [
            'form_purchase_invoice' => $form->createView(),
        ]);
    }
}
