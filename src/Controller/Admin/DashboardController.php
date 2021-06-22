<?php

namespace App\Controller\Admin;

use App\Entity\RecipeCategories;
use App\Entity\Recipes;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(RecipeCategoriesCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Culinary');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to Website', 'fa fa-home','homepage');
        yield MenuItem::linkToCrud('Recipe Categories', 'fas fa-list', RecipeCategories::class);
        yield MenuItem::linkToCrud('Recipes', 'fas fa-list', Recipes::class);
        
    }
}
