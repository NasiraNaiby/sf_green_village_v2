<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Commandes;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_commande')
            ->add('quantité')
            ->add('unit_prix')
            ->add('total_prix')
            ->add('client', EntityType::class, [
                'class' => Clients::class,
                'choice_label' => 'id',
            ])
            ->add('id_produit', EntityType::class, [
                'class' => Produits::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
