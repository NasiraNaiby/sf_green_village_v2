<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Client type select
            ->add('typeClient', ChoiceType::class, [
                'choices' => [
                    'Client privé' => 'Client privé',
                    'Clients professionnels' => 'Clients professionnels',
                ],
                'placeholder' => 'Sélectionnez votre type',
                'required' => true,
                'attr' => ['class' => 'form-select'],
            ])
            // Condition paiement
            ->add('conditionPaiement', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            // Addresses
            ->add('adresseFacturation', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('codePostalFacturation', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('adresseLivraison', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('codePostalLivraison', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            // Email & phone
            ->add('client_email', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('client_phone', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            // User name (unmapped)
            ->add('user_name', TextType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'data' => $options['data']->getUser() ? $options['data']->getUser()->getUserName() : '',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
