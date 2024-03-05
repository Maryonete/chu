<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use App\Form\PatientEditType;
use App\Form\StayType;
use App\Repository\CalendarRepository;
use App\Repository\PatientRepository;
use App\Repository\StayRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class PatientController extends AbstractController
{
    /**
     * HomePage Patient
     *
     * @param PatientRepository $patienRepo
     * @param StayRepository $sejourRepo
     * @param Security $security
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/home', name: 'app_home_patient', methods: 'GET|POST')]
    public function index(
        PatientRepository $patienRepo,
        StayRepository $sejourRepo,
        Security $security,
        Request $request
    ): Response {

        if ($this->getUser() and in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('admin');
        }

        // $patient    = $patienRepo->findByUser($security->getUser());
        $patient    = $patienRepo->findOneBy(['user' => $security->getUser()]);
        $etat       = $request->get('etat');
        $sejours    = $sejourRepo->findByPatient($patient->getId(), $etat);
        $countSejourAll    = $sejourRepo->countStayByPatient($patient->getId());

        $sejourValidate = [];
        $sejourNoValidate = [];

        foreach ($sejours as $sejour) {
            /** @var Stay $sejour */
            if ($sejour->isValidate()) {
                $sejourValidate[] = $sejour;
            } else {
                $sejourNoValidate[] = $sejour;
            }
        }
        return $this->render('pages/patient/index.html.twig', [
            'sejourValidate'    =>  $sejourValidate,
            'sejourNoValidate'  =>  $sejourNoValidate,
            'etat'              =>  $etat,
            'countSejourAll'    =>  $countSejourAll,
        ]);
    }
    /**
     * User account Edition
     *  @return Response
     */
    #[Route('/patient/edition', name: 'app_patient_edit', methods: 'GET|POST')]
    public function edit(
        #[CurrentUser] User $user,
        Request $request,
        EntityManagerInterface $manager
    ): Response {

        $form = $this->createForm(PatientEditType::class, $user->getPatient());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Vos données sont actualisées');
            return $this->redirectToRoute('app_home_patient', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/patient/edit.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
    #[Route('/sejour_new', name: 'app_sejour_new', methods: 'GET|POST')]
    /**
     * Save a new Stay
     */
    public function sejour_new(
        Request $request,
        EntityManagerInterface $manager,
        UserRepository $userRepo,
        SessionInterface $session,
        #[CurrentUser] ?User $user
    ): Response {
        // garde en memoire la page si user non connecté
        $session->set('previous_url', $request->getUri());

        $form = $this->createForm(StayType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Stay $stay */
            $stay = $form->getData();

            /** @var Patient $patient */
            $patient = $user->getPatient();
            $stay->setpatient($patient);

            $manager->persist($stay);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre séjour est enregistré, nous vous tiendrons informé de la suite !'
            );
            return $this->redirectToRoute('app_home_patient', [], Response::HTTP_SEE_OTHER);
        }
        $date = new DateTime();
        return $this->render('pages/patient/stay_new.html.twig', [
            'form'      => $form->createView(),
            'medecins'  => $userRepo->findAll(),
            'demain'    =>  $date->format('Y-m-d'),
            'apdemain'  =>  $date->modify('+1 day')->format('Y-m-d'),
            'unan'      =>  $date->modify('+1 year')->format('Y-m-d'),
        ]);
    }
    /**
     * Show Stay Details
     */
    #[Route('/sejour_show/{id<\d+>}', name: 'app_sejour_show', methods: 'GET|POST')]
    public function showDetailStay(Stay $stay, CalendarRepository $calendarRepo): Response
    {
        return $this->render('pages/patient/stay_show.html.twig', [
            'stay'      => $stay,
            'calendar'  => $calendarRepo->findBy(['stay' => $stay]),
        ]);
    }

    /**
     * liste medecin en fonction de leur specialite
     * retourne JSon
     */
    #[Route('{id<\d+>}/medecins', name: 'read_medecin')]
    public function listMedecinParSpe(Speciality $spe): Response|JsonResponse
    {
        $arrayOfMedecins = [];
        foreach ($spe->getMedecins() as $medecin) {

            $arrayOfMedecins[] = $medecin->toArray();
        }
        $columns = array_column($arrayOfMedecins, 'name');
        array_multisort($columns, SORT_ASC, $arrayOfMedecins);



        return $this->json($arrayOfMedecins);
    }

    #[Route('/{id<\d+>}/notMedecinjson', name: 'dispo_medecin')]
    public function busyMedecin(
        Medecin $medecin,
        // CalendarRepository $calendarRepo
    ): Response|JsonResponse {
        $arrayOfDays = [];
        // foreach ($calendarRepo->getDaysBusy($medecin) as $day) {
        //     $arrayOfDays[] = $day;
        // }
        return $this->json($arrayOfDays);
    }
}
