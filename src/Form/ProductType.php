<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'label' => 'Código',
                'required' => TRUE
            ])
            ->add('description', TextType::class, [
                'label' => 'Descripción',
                'required' => TRUE
            ])
            ->add('unit', ChoiceType::class, [
                'choices' => [
                    'UNIDAD' => 'Unidad',
                    'BULTO' => 'Bulto',
                    'KILO' => 'Kilogramo',
                    'LITRO' => 'Litro',
                    'METRO' => 'Metro',
                    'ROLLO' => 'Rollo'
                ],
                'label' => 'Unidad de Medida',
                'required' => TRUE
            ])
            ->add('size', ChoiceType::class, [
                'choices' => [
                    'PEQUEÑO' => 'Pequeño',
                    'MEDIANO' => 'Mediano',
                    'GRANDE' => 'Grande'
                ],
                'label' => 'Tamaño del Producto',
                'required' => TRUE
            ])
            ->add('iva', TextType::class, [
                'label' => 'Porcentaje de IVA',
                'required' => FALSE,
                'data' => 0
            ])
            ->add('creation_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Creación',
                'data' => \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))
            ])
            /*
            ->add('update_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Actualización'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Activo' => 'ACTIVO',
                    'Inactivo' => 'INACTIVO'
                ],
                'label' => 'Estado'
            ])
            */
            ->add('Crear', SubmitType::class, [
                'attr' => ['class' => 'btn btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
