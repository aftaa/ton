<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Color;
use App\Entity\Customer;
use App\Entity\Design;
use App\Entity\Label;
use App\Entity\News;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Page;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Type;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(OrderCrudController::class)->generateUrl();
        return $this->redirect($url);
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Trip-o-nation')
            //            ->setFaviconPath('favicon.ico')
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Админка', 'fa fa-home');
        yield MenuItem::linkToCrud('Orders', 'fa fa-list', Order::class);
        yield MenuItem::linkToCrud('Order details', 'fa fa-list', OrderDetail::class);
        yield MenuItem::linkToCrud('Designs', 'fa fa-list', Design::class);
        yield MenuItem::linkToCrud('Types', 'fa fa-list', Type::class);
        yield MenuItem::linkToCrud('Labels', 'fa fa-list', Label::class);
        yield MenuItem::linkToCrud('Products', 'fa fa-list', Product::class);
        yield MenuItem::linkToCrud('Sizes', 'fa fa-tags', Size::class);
        yield MenuItem::linkToCrud('Colors', 'fa fa-tags', Color::class);
        yield MenuItem::linkToCrud('News', 'fa fa-file-text', News::class);
        yield MenuItem::linkToCrud('Articles', 'fa fa-file-text', Article::class);
        yield MenuItem::linkToCrud('Pages', 'fa fa-file-text', Page::class);
        yield MenuItem::linkToCrud('Customers', 'fa fa-user', Customer::class);
        yield MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
}
