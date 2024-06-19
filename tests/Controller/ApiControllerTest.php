<?php

namespace App\Tests\Controller;

use App\Entity\Drugs;
use App\Controller\ApiController;
use App\Repository\DrugsRepository;
use App\Repository\PatientRepository;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class ApiControllerTest extends WebTestCase
{
    /**
     * Teste la méthode getPatients de ApiController
     */
    public function testGetPatients(): void
    {
        // Créer des mocks pour les dépendances nécessaires
        $request = $this->createMock(Request::class);
        $serializer = $this->createMock(SerializerInterface::class);
        $calendarRepository = $this->createMock(CalendarRepository::class);

        // Définir le comportement attendu des mocks
        $request->method('get')->willReturn(1); // Exemple de valeur pour $id

        $apiController = new ApiController();
        $response = $apiController->getPatients($request, $serializer, $calendarRepository);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
    /**
     * Teste la méthode getDrugs de ApiController
     */
    public function testGetDrugs(): void
    {
        // Création du client pour simuler une requête HTTP
        $client = static::createClient();

        // Exemple de données simulées pour les médicaments
        $mockedDrugs = [
            new Drugs(1, 'Drug 1'),
            new Drugs(2, 'Drug 2'),
            new Drugs(3, 'Drug 3'),
        ];

        // Création d'un mock pour DrugsRepository
        $drugsRepository = $this->getMockBuilder(DrugsRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Appel de la méthode avec le client et le mock de DrugsRepository
        $client->request('GET', '/api/getDrugs');

        // Récupération de la réponse
        $response = $client->getResponse();

        // Assertions sur la réponse obtenue
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        // Assertions sur les données retournées
        $this->assertCount(6, $responseData); // Vérifie qu'il y a 3 médicaments retournés
        $this->assertArrayHasKey('id', $responseData[0]); // Vérifie que chaque médicament a un champ 'id'
        $this->assertArrayHasKey('name', $responseData[0]); // Vérifie que chaque médicament a un champ 'name'
        $this->assertEquals(1, $responseData[0]['id']); // Exemple d'assertion sur l'ID du premier médicament
        $this->assertEquals('Doliprane', $responseData[0]['name']);
    }
    public function testGetInfoPatientNotFound()
    {
        $client = static::createClient();

        // Mock du PatientRepository
        $patientRepo = $this->createMock(PatientRepository::class);
        $patientRepo->method('find')->willReturn(null);

        // Mock du Serializer (non utilisé dans ce cas)
        $serializer = $this->createMock(SerializerInterface::class);

        // Création de la requête
        $request = new Request([], [], ['id' => 1]);

        // Appel de l'action
        $controller = new ApiController();
        $response = $controller->getInfoPatient($request, $serializer, $patientRepo);

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'error' => 'Aucun utilisateur trouvé pour l\'identifiant 1',
            ]),
            $response->getContent()
        );
    }
    public function testGetInfoPatientException()
    {
        $client = static::createClient();

        // Mock du PatientRepository pour lancer une exception
        $patientRepo = $this->createMock(PatientRepository::class);
        $patientRepo->method('find')->will($this->throwException(new \Exception('Database error')));

        // Mock du Serializer (non utilisé dans ce cas)
        $serializer = $this->createMock(SerializerInterface::class);

        // Création de la requête
        $request = new Request([], [], ['id' => 1]);

        // Appel de l'action
        $controller = new ApiController();
        $response = $controller->getInfoPatient($request, $serializer, $patientRepo);

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'error' => '[getInfoPatient 1] Une erreur s\'est produite : Database error',
            ]),
            $response->getContent()
        );
    }
    public function testGetAllPatientsOfDayException()
    {
        $client = static::createClient();

        // Mock du CalendarRepository pour lancer une exception
        $calendarRepo = $this->createMock(CalendarRepository::class);
        $calendarRepo->method('findAllPatientsOfToday')->will($this->throwException(new \Exception('Database error')));

        // Mock du Serializer (non utilisé dans ce cas)
        $serializer = $this->createMock(SerializerInterface::class);

        // Appel de l'action
        $controller = new ApiController();
        $response = $controller->getAllPatientsOfDay($serializer, $calendarRepo);

        // Assertions
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'error' => 'Une erreur s\'est produite : Database error',
            ]),
            $response->getContent()
        );
    }
    // Ajouter d'autres tests pour les autres méthodes d'ApiController

    // public function testGetAllPatientsOfDay() { ... }
    // public function testGetInfoPatient() { ... }
    // public function testGetPrescriptionPatient() { ... }
    // public function testSetPrescriptionDateEnd() { ... }
    // public function testAddPrescription() { ... }
    // public function testGetOpinionsPatient() { ... }
    // public function testAddOpinion() { ... }
}
