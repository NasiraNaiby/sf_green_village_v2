<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom_produit', 'Nom du produit'),
            TextEditorField::new('desc_produit', 'Description'),
            MoneyField::new('vent_prix', 'Prix de vente')->setCurrency('EUR'),
            IntegerField::new('stock', 'Quantité en stock'),
            ImageField::new('photo', 'Photo')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setRequired(false),
            AssociationField::new('categorie', 'Catégorie'),
            AssociationField::new('fournisseur', 'Fournisseur'),
        ];
    }
}
