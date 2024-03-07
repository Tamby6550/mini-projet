<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use App\Entity\Users;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('Admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MiniAppSymfony4');
    }

    public function configureMenuItems(): iterable
    {
        //
        yield MenuItem::section('Mon companies');
        yield MenuItem::linkToCrud('Companies', 'fa fa-building', Company::class);
        //Users
        yield MenuItem::section('Mon associés');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', Users::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }


    // public function configureAssets(): Assets
    // {
    //     return Assets::new()
    //         ->addCssFile('css/admin.css')
    //         ->addJsFile('js/jquery-3.7.0.min.js')
    //         ->addJsFile('js/admin.js')
    //         ->addHtmlContentToBody('Template/Admin/fields/modal_convert_currency.html.twig');
    // }
}
