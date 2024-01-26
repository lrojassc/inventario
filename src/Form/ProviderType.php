<?php

namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
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
            ->add('nit', TextType::class, [
                'label' => 'Nit',
                'required' => TRUE
            ])
            ->add('phone', TextType::class, [
                'label' => 'Teléfono',
                'required' => TRUE
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo',
                'required' => FALSE
            ])
            ->add('address', TextType::class, [
                'label' => 'Dirección',
                'required' => FALSE
            ])
            ->add('city', TextType::class, [
                'label' => 'Ciudad',
                'required' => FALSE
            ])
            ->add('discount', TextType::class, [
                'label' => 'Descuento Aplicado en Ventas',
                'required' => FALSE
            ])
            ->add('credit_limit', TextType::class, [
                'label' => 'Limite de Crédito',
                'required' => FALSE
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Activo' => 'ACTIVO',
                    'Inactivo' => 'INACTIVO'
                ],
                'label' => 'Estado',
                'required' => TRUE
            ])
            ->add('creation_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Creación',
                'data' => \DateTime::createFromFormat('d-m-Y', date('d-m-Y'))
            ])
            ->add('update_date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de Actualización'
            ])
            ->add('Crear', SubmitType::class, [
                'attr' => ['class' => 'btn btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
