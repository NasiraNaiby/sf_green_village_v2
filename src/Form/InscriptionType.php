<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ClientDataType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_name', TextType::class, [
                'label' => 'votre Nom et Prénom: ',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Addresse mail: ',
                'required' => true 
            ])
            ->add('password', PasswordType::class,  [
                'label' => 'Mot de passe : ',
                'required' => true ] )
            ->add('client', ClientDataType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
