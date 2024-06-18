<?php

namespace App\Controller;

use App\Repository\MedecinRepository;
use App\Repository\SpecialityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Contrôleur de la page d'accueil de l'application.
     * 
     * Cette fonction gère les requêtes GET pour la route "/".
     * 
     * - Si l'utilisateur est connecté :
     *   - Si l'utilisateur a le rôle d'administrateur, il est redirigé vers la page d'administration.
     *   - Sinon, l'utilisateur est redirigé vers la page d'accueil patient.
     * - Si l'utilisateur n'est pas connecté, la fonction récupère la liste des spécialités et des médecins
     *   depuis les dépôts respectifs et les passe à la vue pour affichage.
     * 
     * @param SpecialityRepository $speRepo Le dépôt des spécialités.
     * @param MedecinRepository $medecinRepo Le dépôt des médecins.
     * @return Response La réponse HTTP contenant la vue de la page d'accueil.
     */
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(
        SpecialityRepository $speRepo,
        MedecinRepository $medecinRepo
    ): Response {
        if ($this->getUser()) {

            if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
                return $this->redirectToRoute('admin');
            } else {
                return $this->redirectToRoute('app_home_patient');
            }
        }
        return $this->render('pages/home.html.twig', [
            'specialites'   =>  $speRepo->findBy([], ['name' => 'ASC']),
            'medecins'      =>  $medecinRepo->findAll(),
        ]);
    }
    #[Route('/speciality', name: 'app_speciality_list')]
    /**
     * Liste des spécialités
     *
     * Cette fonction renvoie la liste de toutes les spécialités, triées par ordre croissant de nom.
 
     *
     * @param SpecialityRepository $speRepo
     * @return Response
     */
    public function speciality_list(SpecialityRepository $speRepo): Response
    {
        return $this->render('pages/speciality_list.html.twig', [
            'specialites' => $speRepo->findBy([], ['name' => 'ASC']),
        ]);
    }
    #[Route('/mentions_legales', name: 'app_mentions_legales', methods: ['GET'])]
    /**
     * Affiche la page des mentions légales de l'application.
     * page statique
     *
     * @return Response
     */
    public function static_mentions_legales(): Response
    {
        return $this->render('pages/static/mentions_legales.html.twig');
    }
    #[Route('/contact', name: 'app_contact', methods: ['GET'])]
    public function contact(): Response
    {
        return $this->render('pages/static/contact.html.twig',);
    }
    #[Route('/tarifs', name: 'app_tarifs', methods: ['GET'])]
    public function tarifs(): Response
    {
        return $this->render('pages/static/tarifs.html.twig',);
    }
    #[Route('/faqs', name: 'app_faqs', methods: ['GET'])]
    public function faqs(): Response
    {
        return $this->render('pages/static/faqs.html.twig',);
    }
    #[Route('/droitspatients', name: 'app_droits_patients', methods: ['GET'])]
    public function droitspatients(): Response
    {
        return $this->render('pages/static/droits_patients.html.twig',);
    }
    #[Route('/privacy', name: 'privacy', methods: ['GET'])]
    public function privacy(): Response
    {
        return $this->render('pages/static/privacy.html.twig',);
    }
}
