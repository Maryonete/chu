<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use App\Repository\DrugsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MedecinRepository;
use App\Repository\PatientRepository;
use App\Repository\PrescriptionRepository;
use App\Repository\StayRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    #[Route('/api/getInfoMedecin', name: 'api_medecin', methods: ['GET', 'POST'])]
    public function MedecinApi(
        Request $request,
        MedecinRepository $medecinRepository,
        UserRepository $userRepo,
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? null;

        $user = $userRepo->findOneBy(['email' => $email]);
        /** var Medecin $medecin */
        $medecin = $medecinRepository->findByUser($user);
        // dump($medecin);
        return new JsonResponse([
            'user_id'   =>  $medecin[0]->getId(),
            'firstName' =>  $medecin[0]->getUser()->getFirstName(),
            'lastName'  =>  $medecin[0]->getUser()->getLastName()
        ]);
    }
    /**
     * Liste des patients du docteurs
     */
    #[Route('/api/getPatients/{id<\d+>}', name: 'api_get_patients', methods: ['GET', 'POST'])]
    public function getPatients(
        Request $request,
        SerializerInterface $serializer,
        CalendarRepository $calendarRepo
    ): JsonResponse {

        $id = $request->get('id');

        try {
            $calendars = $calendarRepo->findPatientsOfTodayByMedecin($id);
            $flatArray = [];
            foreach ($calendars as $calendar) {
                $flatArray[] = [
                    'id'            => $calendar->getId(),
                    'title'         => $calendar->getTitle(),
                    'patient_id'       =>  $calendar->getStay()->getPatient()->getId(),
                    'speciality'    => $calendar->getStay()->getSpeciality()->getName(),
                    'reason'        => $calendar->getStay()->getReason(),
                    'start'         => $calendar->getStart()->format('Y-m-d H:i:s'), // Formatage de la date de début
                    'end'           => $calendar->getEnd()->format('Y-m-d H:i:s'), // Formatage de la date de fin
                    'description'   => $calendar->getDescription(),
                    'medecin_id'    => $calendar->getMedecin()->getId(),
                ];
            }
            // dd($flatArray);
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     *retourne les infos d'un patient
     */
    #[Route('/api/getInfoPatient/{id<\d+>}', name: 'api_get_info_patient', methods: ['GET', 'POST'])]
    public function getInfoPatient(
        Request $request,
        SerializerInterface $serializer,
        PatientRepository $patientRepo
    ): JsonResponse {
        $id = $request->get('id');

        try {
            $patient = $patientRepo->find($id);
            if ($patient) {
                $flatArray = [
                    'firstName' =>  $patient->getUser()->getFirstName(),
                    'lastName'  =>  $patient->getUser()->getLastName(),
                    'email'     =>  $patient->getUser()->getEmail(),
                ];
                $jsonList = $serializer->serialize(
                    $flatArray,
                    'json'
                );

                return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
            } else {
                return new JsonResponse(['error' => 'Aucun utilisateur trouvé pour l\'identifiant ' . $id], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => '[getInfoPatient ' . $id . '] Une erreur s\'est produite : ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Liste des patients du docteurs
     */
    #[Route('/api/getPrescriptionPatients/{id<\d+>}', name: 'api_get_prescription_patient', methods: ['GET', 'POST'])]
    public function getPrescriptionPatient(
        Request $request,
        SerializerInterface $serializer,
        PrescriptionRepository $prescriptionRepo
    ): JsonResponse {

        $id = $request->get('id');

        try {
            $prescriptions = $prescriptionRepo->findAllPrescriptionByPatient($id);
            $flatArray = [];

            foreach ($prescriptions as $prescription) {
                $medicationsInfo = [];

                foreach ($prescription->getMedications() as $medication) {
                    $medicationsInfo[] = [
                        'dosage'    => $medication->getDosage(),
                        'drug'      => $medication->getDrug()->getName(),
                    ];
                }
                $flatArray[] = [
                    'id'    => $prescription->getId(),
                    'start' => $prescription->getStartDate()->format('Y-m-d'),
                    'end'   => $prescription->getEndDate()->format('Y-m-d'),
                    'medications' => $medicationsInfo,
                ];
            }

            // dd($flatArray);
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => '[getPrescriptionPatient ' . $id . '] Une erreur s\'est produite : ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Liste des medicaments 
     */
    #[Route('/api/getDrugs', name: 'api_get_drugs', methods: ['GET', 'POST'])]
    public function getDrugs(
        SerializerInterface $serializer,
        DrugsRepository $drugRepo
    ): JsonResponse {
        $drugs = $drugRepo->findAll();
        $flatArray = [];
        try {
            foreach ($drugs as $drug) {
                $flatArray[] = [
                    'id'    =>  $drug->getId(),
                    'name'  =>  $drug->getName(),
                ];
            }
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => '[getDrugs] Une erreur s\'est produite : ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Maj de la date de fin de la prescription
     */
    #[Route('/api/setPrescriptionDateEnd', name: 'api_set_prescription', methods: ['POST'])]
    public function setPrescriptionDateEnd(
        Request $request,
        PrescriptionRepository $prescriptionRepo,
        EntityManagerInterface $manager
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);
        $prescriptionId = $data['prescriptionId'] ?? null;

        $prescription = $prescriptionRepo->find($prescriptionId);
        if (!$prescription) {
            throw new Error('Prescription invalide');
        }
        $newEndDateString = $data['newEndDate'] ?? null;
        if (!$newEndDateString) {
            throw new Error('Date invalide');
        }
        $newEndDate = new DateTime($newEndDateString);
        $prescription->setEndDate($newEndDate);
        $manager->persist($prescription);
        $manager->flush();

        return new JsonResponse('', Response::HTTP_OK, [], true);
    }
}
