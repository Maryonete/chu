<?php

namespace App\Controller;

use App\Repository\MedecinRepository;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    // public function index(
    //     SpecialityRepository $speRepo,
    //     MedecinRepository $medecinRepo
    // ): Response {
    //     if ($this->getUser()) {

    //         if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
    //             return $this->redirectToRoute('admin');
    //         } else {
    //             return $this->redirectToRoute('app_home_patient');
    //         }
    //     }
    //     return $this->render('pages/home.html.twig', [
    //         'specialites'   =>  $speRepo->findBy([], ['name' => 'ASC']),
    //         'medecins'      =>  $medecinRepo->findAll(),
    //     ]);
    // }
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(SpecialityRepository $speRepo): Response
    {
        if ($this->getUser()) {

            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                // return $this->redirectToRoute('admin');
            } else {
                return $this->redirectToRoute('app_home_patient');
            }
        }
        return $this->render('pages/home.html.twig', [
            'specialites'   =>  $speRepo->findBy([], ['name' => 'ASC']),

        ]);
    }
    #[Route('/speciality', name: 'app_speciality_list')]
    public function speciality_list(SpecialityRepository $speRepo): Response
    {
        return $this->render('pages/speciality_list.html.twig', [
            'specialites' => $speRepo->findBy([], ['name' => 'ASC']),
        ]);
    }
    /** pages statiques */
    #[Route('/mentions_legales', name: 'app_mentions_legales', methods: ['GET', 'POST'])]
    public function mentions_legales(): Response
    {
        return $this->render('pages/static/mentions_legales.html.twig',);
    }
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(): Response
    {
        return $this->render('pages/static/contact.html.twig',);
    }
    #[Route('/tarifs', name: 'app_tarifs', methods: ['GET', 'POST'])]
    public function tarifs(): Response
    {
        return $this->render('pages/static/tarifs.html.twig',);
    }
    #[Route('/faqs', name: 'app_faqs', methods: ['GET', 'POST'])]
    public function faqs(): Response
    {
        return $this->render('pages/static/faqs.html.twig',);
    }
    #[Route('/droitspatients', name: 'app_droits_patients', methods: ['GET', 'POST'])]
    public function droitspatients(): Response
    {
        return $this->render('pages/static/droits_patients.html.twig',);
    }
}
