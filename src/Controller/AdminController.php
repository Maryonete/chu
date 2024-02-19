<?php

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Entity\Stay;
use App\Entity\User;
use App\Form\CalendarType;
use App\Form\MedecinEditType;
use App\Form\MedecinNewType;
use App\Repository\MedecinRepository;
use App\Repository\StayRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin')]
class AdminController extends AbstractController
{

    private MedecinRepository $medecinRepo;

    public function __construct(
        MedecinRepository $medecinRepo
    ) {
        $this->medecinRepo = $medecinRepo;
    }
    /**
     * Accueil interface administrateur
     *
     * @return Response
     */
    #[Route('/', name: 'admin')]
    public function index(): Response
    {


        $listeMedecin = $this->medecinRepo->findAll();
        return $this->render('admin/index.html.twig', [
            'listeMedecin'  =>  $listeMedecin,
        ]);
    }
}
