<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MedecinRepository;
use App\Repository\StayRepository;
use App\Repository\UserRepository;
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
            $calendars = $calendarRepo->findCalendarsByMedecinToday($id);
            $flatArray = [];
            foreach ($calendars as $calendar) {
                $flatArray[] = [
                    'id'            => $calendar->getId(),
                    'title'         => $calendar->getTitle(),
                    'speciality'    => $calendar->getStay()->getSpeciality()->getName(),
                    'start'         => $calendar->getStart()->format('Y-m-d H:i:s'), // Formatage de la date de début
                    'end'           => $calendar->getEnd()->format('Y-m-d H:i:s'), // Formatage de la date de fin
                    'description'   => $calendar->getDescription(),
                    'medecin_id'    => $calendar->getMedecin()->getId(),
                ];
            }

            // dd($calendars);
            $jsonList = $serializer->serialize(
                $flatArray,
                'json'
            );

            return new JsonResponse($jsonList, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Une erreur s\'est produite : ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
