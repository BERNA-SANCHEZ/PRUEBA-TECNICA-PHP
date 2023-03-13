<?php

namespace App\Controller\Admin;

use App\Entity\Marca;
use App\Entity\Presentacion;
use App\Entity\Producto;
use App\Entity\Proveedor;
use App\Entity\User;
use App\Entity\Zona;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        $url = $this->adminUrlGenerator
            ->setController(ProductoCrudController::class)
            ->generateUrl();

      
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PRUEBA TECNICA – PHP');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('PRUEBA TECNICA – PHP', 'fa fa-home');
        //yield MenuItem::linkToCrud('Producto', 'fas fa-list', Producto::class);


        yield MenuItem::section('Productos');
        yield MenuItem::subMenu('Acciones','fas fa-bars')->setSubItems([
           MenuItem::linkToCrud('Agregar Producto','fas fa-plus',Producto::class)->setAction(Crud::PAGE_NEW), 
           MenuItem::linkToCrud('Mostrar Producto','fas fa-eye',Producto::class)
        ]);

        yield MenuItem::subMenu('Proveedor','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Agregar Proveedor','fas fa-plus',Proveedor::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Mostrar Proveedor','fas fa-eye',Proveedor::class)
        ]);

        yield MenuItem::subMenu('Marca','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Agregar Marca','fas fa-plus',Marca::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Mostrar Marca','fas fa-eye',Marca::class)
        ]);

        yield MenuItem::subMenu('Presentacion','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Agregar Presentacion','fas fa-plus',Presentacion::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Mostrar Presentacion','fas fa-eye',Presentacion::class)
        ]);

        yield MenuItem::subMenu('Zona','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Agregar Zona','fas fa-plus',Zona::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Mostrar Zona','fas fa-eye',Zona::class)
        ]);


        /*yield MenuItem::subMenu('Usuario','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Agregar Usuario','fas fa-plus',User::class)->setAction(Crud::PAGE_NEW), 
            MenuItem::linkToCrud('Mostrar Usuario','fas fa-eye',User::class)
        ]);*/

    }
}
