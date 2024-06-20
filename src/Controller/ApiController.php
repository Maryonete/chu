<?php

namespace App\Controller;

use App\Entity\{Medication, Opinions, Prescription};
use App\Repository\{
    CalendarRepository,
    DrugsRepository,
    MedecinRepository,
    OpinionsRepository,
    PatientRepository,
    PrescriptionRepository,
    UserRepository
};
use DateTime;
use Error;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Response, Request};
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
                    'patient_id'    => $calendar->getStay()->getPatient()->getId(),
                    'speciality'    => $calendar->getStay()->getSpeciality()->getName(),
                    'reason'        => $calendar->getStay()->getReason(),
                    'start'         => $calendar->getStart()->format('Y-m-d H:i:s'), // Formatage de la date de début
                    'end'           => $calendar->getEnd()->format('Y-m-d H:i:s'), // Formatage de la date de fin
                    'description'   => $calendar->getDescription(),
                    'medecin_id'    => $calendar->getMedecin()->getId(),
                ];
            }
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );
            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'error' =>
                    'Une erreur s\'est produite : ' .
                        $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * Liste des patients du jour : entrées + sorties
     */
    #[Route('/api/getAllPatientsOfDay', name: 'api_get_patients_today', methods: ['GET'])]
    public function getAllPatientsOfDay(
        SerializerInterface $serializer,
        CalendarRepository $calendarRepo
    ): JsonResponse {

        try {
            $calendars = $calendarRepo->findAllPatientsOfToday();

            $flatArray = [];
            foreach ($calendars as $calendar) {
                $flatArray[] = [
                    'id'            => $calendar->getId(),
                    'title'         => $calendar->getTitle(),
                    'patient_infos' => $calendar->getStay()->getPatient()->getAllInformation(),
                    'patient_id'    => $calendar->getStay()->getPatient()->getId(),
                    'speciality'    => $calendar->getStay()->getSpeciality()->getName(),
                    'reason'        => $calendar->getStay()->getReason(),
                    'start'         => $calendar->getStart()->format('Y-m-d H:i'),
                    'end'           => $calendar->getEnd()->format('Y-m-d H:i'),
                    'description'   => $calendar->getDescription(),
                    'medecin_id'    => $calendar->getMedecin()->getId(),
                ];
            }
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'error' =>
                    'Une erreur s\'est produite : ' .
                        $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
                return new JsonResponse([
                    'error' =>
                    'Aucun utilisateur trouvé pour l\'identifiant ' .
                        $id
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' =>
                '[getInfoPatient ' . $id . '] Une erreur s\'est produite : ' .
                    $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Liste des patients du docteurs
     */
    #[Route('/api/getPrescriptionPatients', name: 'api_get_prescription_patient', methods: ['GET', 'POST'])]
    public function getPrescriptionPatient(
        Request $request,
        SerializerInterface $serializer,
        MedecinRepository $medecinRepo,
        PatientRepository $patientRepo,
        PrescriptionRepository $prescriptionRepo
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        // Vérifier si les données sont valides
        if (!$data) {
            return new JsonResponse(['error' => 'données invalide'], 400);
        }
        if (!isset($data['medecin_id']) || !isset($data['patient_id'])) {
            return new JsonResponse(['error' => '[GET] Opinions data incompletes'], 400);
        }

        try {
            $prescriptions = $prescriptionRepo->findBy([
                'medecin' => $medecinRepo->find($data['medecin_id']),
                'patient' => $patientRepo->find($data['patient_id']),
            ]);

            $flatArray = [];

            foreach ($prescriptions as $prescription) {
                $medicationsInfo = [];
                $medications = $prescription->getMedications();

                /** @var Medication $medication */
                foreach ($medications as $medication) {

                    $medicationsInfo[] = [
                        'dosage'    => $medication->getDosage(),
                        'drug'      => $medication->getDrug()->getName(),
                    ];
                }

                $flatArray[] = [
                    'id'            => $prescription->getId(),
                    'start'         => $prescription->getStartDate()->format('Y-m-d'),
                    'end'           => $prescription->getEndDate()->format('Y-m-d'),
                    'medications'   => $medicationsInfo,
                ];
            }

            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' =>
                '[getPrescriptionPatient patient : ' .
                    $data['patient_id'] .
                    ' - medecin: ' . $data['medecin_id'] . '] Une erreur s est produite : ' .
                    $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    #[Route('/api/getDrugs', name: 'api_get_drugs', methods: ['GET', 'POST'])]
    /**
     *  Endpoint for retrieving a list of drugs.
     *
     * Retrieves a list of drugs from the database and serializes them into JSON format.
     *
     *
     * @param SerializerInterface $serializer
     * @param DrugsRepository $drugRepo
     * @return JsonResponse
     */
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
            return new JsonResponse(
                [
                    'error' =>
                    '[API getDrugs] Une erreur s\'est produite : ' .
                        $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
        if (!isset($data['prescriptionId'])) {
            return new JsonResponse(['error' => '[SET] Prescription end date incompletes'], 400);
        }
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
    /**
     * création d'une prescription
     */
    #[Route('/api/addPrescription', name: 'api_add_prescription', methods: ['POST'])]
    public function addPrescription(
        Request $request,
        EntityManagerInterface $manager,
        DrugsRepository $drugsRepository,
        MedecinRepository $medecinRepo,
        PatientRepository $patientRepo,
        PrescriptionRepository $prescriptionRepo,
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        // Vérifier si les données sont valides
        if (!$data) {
            return new JsonResponse(['error' => 'Prescription invalide'], 400);
        }
        if (!isset($data['medecin_id']) || !isset($data['patient_id'])) {
            return new JsonResponse(['error' => '[ADD] Prescription data incompletes'], 400);
        }
        // Vérifier si la prescription existe déjà
        $existingPrescription = $prescriptionRepo->findBy([
            'startDate' => new \DateTime($data['startDate']),
            'endDate' => new \DateTime($data['endDate']),
            'medecin' => $medecinRepo->find($data['medecin_id']),
            'patient' => $patientRepo->find($data['patient_id']),
        ]);

        if ($existingPrescription) {
            // Prescription déjà existante, renvoyer une erreur
            return new JsonResponse(['error' => 'Prescription already exists'], Response::HTTP_CONFLICT);
        }
        $prescription = new Prescription();
        $prescription->setStartDate(new \DateTime($data['startDate']));
        $prescription->setEndDate(new \DateTime($data['endDate']));
        $prescription->setMedecin($medecinRepo->find($data['medecin_id']));
        $prescription->setPatient($patientRepo->find($data['patient_id']));


        // Ajouter les médicaments à la prescription
        foreach ($data['medications'] as $medicationData) {
            // Créer une nouvelle entité Medication pour chaque médicament
            $medication = new Medication();
            $medication->setDrug($drugsRepository->find($medicationData['drugId']));
            $medication->setDosage(filter_var($medicationData['dosage'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            // Associer le médicament à la prescription
            $medication->setPrescription($prescription);

            // Ajouter le médicament à la collection de médicaments de la prescription
            $prescription->addMedication($medication);

            // Enregistrer le médicament en base de données
            $manager->persist($medication);
        }

        $manager->persist($prescription);
        $manager->flush();

        return new JsonResponse('', Response::HTTP_OK, [], true);
    }
    /**
     * Liste des avis sur un patients en fonction d'un docteur
     */
    #[Route('/api/getOpinionsPatient', name: 'api_get_opinions_patient', methods: ['GET', 'POST'])]
    public function getOpinionsPatient(
        Request $request,
        OpinionsRepository $opinionRepo,
        MedecinRepository $medecinRepo,
        PatientRepository $patientRepo,
        SerializerInterface $serializer
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        // Vérifier si les données sont valides
        if (!$data) {
            return new JsonResponse(['error' => 'données invalide'], 400);
        }

        if (!isset($data['medecin_id']) || !isset($data['patient_id'])) {
            return new JsonResponse(['error' => '[GET] Opinions data incompletes'], 400);
        }
        try {
            $opinions = $opinionRepo->findBy([
                'medecin' => $medecinRepo->find($data['medecin_id']),
                'patient' => $patientRepo->find($data['patient_id']),
            ]);
            $flatArray = [];

            foreach ($opinions as $opinion) {

                $flatArray[] = [
                    'id'            => $opinion->getId(),
                    'title'         => $opinion->getTitle(),
                    'description'   => $opinion->getDescription(),
                    'date'          => $opinion->getDate()->format('Y-m-d'),
                ];
            }
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['error' =>
                '[getOpinionsPatient ] Une erreur s\'est produite : ' .
                    $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return new JsonResponse([], Response::HTTP_OK, [], true);
    }

    /**
     * création d'un avis
     */
    #[Route('/api/addOpinion', name: 'api_add_opinion', methods: ['POST'])]
    public function addOpinion(
        Request $request,
        EntityManagerInterface $manager,
        OpinionsRepository $opinionRepo,
        MedecinRepository $medecinRepo,
        PatientRepository $patientRepo,
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);

        // Vérifier si les données sont valides
        if (!$data) {
            return new JsonResponse(['error' => 'Opinions data invalide'], 400);
        }
        // Validation des données (assurez-vous que les champs requis sont remplis)
        if (
            !isset($data['medecin_id']) ||
            !isset($data['patient_id']) ||
            !isset($data['description']) ||
            !isset($data['title'])
        ) {
            return new JsonResponse(['error' => 'Opinions data incompletes'], 400);
        }
        // Vérifier si l'avis existe déjà
        $existingOpinion = $opinionRepo->findBy([
            'date'      => new \DateTime($data['date']),
            'medecin'   => $medecinRepo->find($data['medecin_id']),
            'patient'   => $patientRepo->find($data['patient_id']),
            'title'     => $data['title'],
        ]);

        if ($existingOpinion) {
            // Prescription déjà existante, renvoyer une erreur
            return new JsonResponse(['error' => 'Opinion already exists'], Response::HTTP_CONFLICT);
        }
        $opinion = new Opinions();
        $opinion->setDate(new \DateTime($data['date']));
        $opinion->setDescription(filter_var($data['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $opinion->setTitle(filter_var($data['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $opinion->setMedecin($medecinRepo->find($data['medecin_id']));
        $opinion->setPatient($patientRepo->find($data['patient_id']));
        $manager->persist($opinion);
        $manager->flush();

        return new JsonResponse('', Response::HTTP_OK, [], true);
    }
}
