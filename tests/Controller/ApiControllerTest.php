<?php

namespace App\Tests\Controller;

use App\Entity\Medecin;
use App\Controller\ApiController;
use App\Entity\Drugs;
use App\Repository\UserRepository;
use App\Repository\DrugsRepository;
use App\Repository\MedecinRepository;
use App\Repository\CalendarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

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
        // $calendarRepository->method('findPatientsOfTodayByMedecin')->willReturn(...); // Définir le comportement du mock selon vos besoins
        // $serializer->method('serialize')->willReturn('{"mocked": "data"}'); // Définir le comportement du mock selon vos besoins

        $apiController = new ApiController();
        $response = $apiController->getPatients($request, $serializer, $calendarRepository);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        // Ajouter d'autres assertions selon le résultat attendu
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
        $this->assertEquals('Doliprane', $responseData[0]['name']); // Exemple d'assertion sur le nom du premier médicament
    }
    // Ajouter d'autres tests pour les autres méthodes d'ApiController

    // Exemple :
    // public function testGetAllPatientsOfDay() { ... }
    // public function testGetInfoPatient() { ... }
    // public function testGetPrescriptionPatient() { ... }
    // public function testSetPrescriptionDateEnd() { ... }
    // public function testAddPrescription() { ... }
    // public function testGetOpinionsPatient() { ... }
    // public function testAddOpinion() { ... }
}
