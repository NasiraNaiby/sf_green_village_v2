<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ClientDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('nom_client', TextType::class)
            ->add('type_client', ChoiceType::class, [
                'choices'=>[
                    'Client privé' => 'Client privé',
                    'Clients professionnels' =>  'Clients professionnels' 
                ],
                'attr' => [
                'class' => 'form-control',
               
                ]
            ])
            ->add('adresseFacturation', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    ]
                    ])
            ->add('codePostalFacturation', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    ]
                    ])
            ->add('adresseLivraison', TextType::class, [
                 'required' => true,
                 'attr' =>[
                    'class' => 'form-control',
                    'placeholder' => 'Votre address complet '
                 ]
            ])
            ->add('codePostalLivraison', TextType::class, [
                'required' => true,
                    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
