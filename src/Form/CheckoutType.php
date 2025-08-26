<?php

namespace App\Form;

use App\Entity\Commandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $clientData = $options['client_data'];

        $builder
            ->add('quantite', HiddenType::class)
            ->add('prixTotal', HiddenType::class)

            ->add('client_email', EmailType::class, [
                'mapped' => false,
                'required' => !$clientData['email'],
                'label' => 'Email',
                'data' => $clientData['email']
            ])
            ->add('client_phone', TelType::class, [
                'mapped' => false,
                'required' => !$clientData['phone'],
                'label' => 'Phone Number',
                'data' => $clientData['phone']
            ])
            ->add('adresseLivraison', TextType::class, [
                'mapped' => false,
                'required' => !$clientData['adresse'],
                'label' => 'Delivery Address',
                'data' => $clientData['adresse']
            ])
            ->add('codePostalLivraison', TextType::class, [
                'mapped' => false,
                'required' => !$clientData['postal'],
                'label' => 'Postal Code',
                'data' => $clientData['postal']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
            'client_data' => [
                'email' => null,
                'phone' => null,
                'adresse' => null,
                'postal' => null,
            ]
        ]);
    }
}
