<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\CategoriesCrudController; 
use App\Entity\Categories;
use App\Entity\Produits;
use App\Entity\Commandes;
use App\Entity\Fournisseurs;
use App\Entity\User;
use App\Entity\Factures;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class AdminDashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // return parent::index();

      
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Village Green');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Categories::class);
        yield MenuItem::linkToCrud('Produits', 'fa fa-box', Produits::class);
        yield MenuItem::linkToCrud('Commandes', 'fa fa-shopping-cart', Commandes::class);
        yield MenuItem::linkToCrud('Fournisseurs', 'fa fa-truck', Fournisseurs::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Factures', 'fa fa-file-invoice', Factures::class);
    }
}
