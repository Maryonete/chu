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
    private StayRepository $stayRepo;
    private MedecinRepository $medecinRepo;

    public function __construct(
        StayRepository $stayRepo,
        MedecinRepository $medecinRepo
    ) {
        $this->stayRepo = $stayRepo;
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
        $listeStayWait = $this->stayRepo->findBy(['validate' => 0], ['start_date' => 'ASC']);
        $listeMedecin = $this->medecinRepo->findAll();
        return $this->render('admin/index.html.twig', [
            'listeStayWait' =>  $listeStayWait,
            'listeMedecin'  =>  $listeMedecin,
        ]);
    }


    /**
     * Gestion Agenda des medecins + ajout nouveau rdv
     *
     * @return Response
     */
    #[Route('/{id<\d+>}/calendarMedecin', name: 'app_admin_medecin_calendar')]
    public function calendarMedecin(
        Medecin $medecin,
        Request $request,
        EntityManagerInterface $em,
        StayRepository $stayRepo,
        ParameterBagInterface $parameterBagInterface
    ): Response {

        // nouveau rdv
        // $form = $this->createForm(CalendarType::class);
        // $form->add('save', SubmitType::class, [
        //     'label' => 'Enregistrer',
        //     'attr' => [
        //         'class' => 'btn btn-primary',
        //     ],
        // ]);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {

        //     /** @var Calendar $calendar */
        //     $calendar = $form->getData();
        //     $calendar->setStart(new DateTime($request->get('start') . ' ' . $request->get('startHeure')));
        //     $calendar->setEnd(new DateTime($request->get('end') . ' ' . $request->get('endHeure')));
        //     $calendar->setMedecin($medecin);

        //     // Calendrier relié a un séjour patient
        //     if ($request->get('stay') !== null) {
        //         /** @var Stay $stay */
        //         $stay = $stayRepo->find($request->get('stay'));
        //         $stay->setValidate(true);
        //         $em->persist($stay);
        //         $calendar->setStay($stay);
        //     }

        //     $em->persist($calendar);
        //     $em->flush();
        //     return $this->redirectToRoute(
        //         'app_admin_medecin_calendar',
        //         ['id' => $medecin->getId()],
        //         Response::HTTP_SEE_OTHER
        //     );
        // }
        // // rdv en attente
        // $listeStayWait = $this->stayRepo->findBy(['validate' => 0, 'medecin' => $medecin], ['start_date' => 'ASC']);

        // return $this->render('admin/calendar_medecin.html.twig', [
        //     'medecin'       =>  $medecin,
        //     'listeStayWait' =>  $listeStayWait,
        //     'form'          =>  $form,
        //     'medecin_event_limit_day' => $parameterBagInterface->get('medecin_event_limit_day'),
        // ]);
        $listeStayWait = $this->stayRepo->findBy(['validate' => 0], ['start_date' => 'ASC']);
        $listeMedecin = $this->medecinRepo->findAll();
        return $this->render('admin/index.html.twig', [
            'listeStayWait' =>  $listeStayWait,
            'listeMedecin'  =>  $listeMedecin,
        ]);
    }
    /**
     * liste calendrier en fonction du médecin
     * return JSON
     */
    #[Route('/{id<\d+>}/calendarMedecinjson', name: 'app_admin_medecin_calendar_json')]
    public function calendarMedecinJson(Medecin $medecin): Response|JsonResponse
    {
        // liste des rendez-vous du medecin
        // $calendar = $medecin->getCalendars();
        $arrayRDV = [];
        // foreach ($calendar as $rdv) {
        //     $arrayRDV[] = $rdv->toArray();
        // }
        return $this->json($arrayRDV);
    }
    /**
     * liste sejours patients
     * retourne JSon
     */
    #[Route('/{id<\d+>}/stay', name: 'app_stay_json')]
    public function stayJson(Stay $stay): Response|JsonResponse
    {
        return $this->json([$stay->toArray()]);
    }
    /**
     * Create Medecin
     */
    #[Route('/medecin/new', name: 'app_medecin_new', methods: ['GET', 'POST'])]
    public function newMedecin(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinNewType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $medecin->getUser()->setPassword(
                $userPasswordHasher->hashPassword(
                    $medecin->getUser(),
                    $form->get('plainPassword')->getData()
                )
            );
            $medecin->getUser()->setRoles(['ROLE_MEDECIN']);


            $entityManager->persist($medecin);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Création effectuée avec succès !'
            );
            return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/medecin/new.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
    /**
     * Update Medecin
     */
    #[Route('/medecin/{id<\d+>}/edit', name: 'app_medecin_edit', methods: ['GET', 'POST'])]
    public function editMedecin(
        Request $request,
        EntityManagerInterface $entityManager,
        ?Medecin $medecin = null
    ): Response {

        if (!$medecin) {
            throw $this->createNotFoundException('Médecin non trouvé');
        }
        $user = $medecin->getUser();
        $form = $this->createForm(MedecinEditType::class, [
            'user'       => $user,
            'speciality' => $medecin->getSpeciality(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Mise à jour effectuée avec succès !'
            );
            return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form,
        ]);
    }
}
