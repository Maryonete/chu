<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use App\Repository\MedecinRepository;
use App\Repository\StayRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    /**
     * Page accueil interface admin
     *
     * @return Response
     */
    #[Route('/app/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', []);
    }
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Séjours', '', Stay::class);
        yield MenuItem::section('Médecin', 'fa-solid fa-user-nurse');
        yield MenuItem::linkToCrud('Nouveau', '', Medecin::class)->setAction('new');
        yield MenuItem::linkToCrud('Liste', '', Medecin::class)->setDefaultSort(['user.firstname' => 'ASC']);
        yield MenuItem::linkToCrud('Agenda', '', Calendar::class);
        yield MenuItem::section('Patient', 'fa-solid fa-head-side-cough');
        yield MenuItem::linkToCrud('Liste', '', Patient::class)->setDefaultSort(['user.firstname' => 'ASC']);
        yield MenuItem::section('Spécialités', 'fa-regular fa-hospital');
        yield MenuItem::linkToCrud('Création', '', Speciality::class)->setAction('new');
        yield MenuItem::linkToCrud('Liste', '', Speciality::class);
        yield MenuItem::section('Outils', 'fa-solid fa-gear');
        yield MenuItem::linkToLogout('Logout', 'fa-solid fa-right-from-bracket');
    }
}
