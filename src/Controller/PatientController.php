<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PatientEditType;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class PatientController extends AbstractController
{
    #[Route('/patient', name: 'app_home_patient')]
    public function index(): Response
    {
        return $this->render('pages/patient/index.html.twig', []);
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
}
