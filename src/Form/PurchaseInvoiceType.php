<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Provider;
use App\Entity\PurchaseInvoice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PurchaseInvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('provider', EntityType::class, [
                'label' => 'Proveedor',
                'class' => Provider::class,
                'choice_label' => 'description',
            ])
            ->add('tests', CollectionType::class, [
                'label' => 'Agregar productos',
                'entry_type' => AddProductType::class,
                'entry_options' => [
                    'label' => FALSE
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PurchaseInvoice::class,
        ]);
    }
}
