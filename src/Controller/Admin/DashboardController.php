<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use App\Entity\Science;
use App\Entity\Tag1;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Corpus Humanum');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Le site', 'fa fa-laptop-code', '/');
        
        yield MenuItem::section('Science', 'fas fa-book-open');
        yield MenuItem::subMenu('Science', 'fas fa-ellipsis')->setSubItems([
            MenuItem::linkToCrud('Créer', 'fas fa-plus ', Science::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Afficher', 'fas fa-eye', Science::class)
        ]);

        yield MenuItem::subMenu('Tags', 'fas fa-ellipsis')->setSubItems([
            MenuItem::linkToCrud('Créer', 'fas fa-plus ', Tag1::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Afficher', 'fas fa-eye', Tag1::class)
        ]);
    }
}
