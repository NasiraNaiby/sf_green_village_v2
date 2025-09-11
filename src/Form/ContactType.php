<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre Nom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Email'
                ]
            ])
            ->add('number', TelType::class, [
                'label' => 'Votre Numéro',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Numéro de téléphone'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre Message',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre Message',
                    'rows' => 5
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           
        ]);
    }
}
