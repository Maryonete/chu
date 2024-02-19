<?php

namespace App\Tests\Controller;

use App\Entity\Medecin;
use App\Entity\Speciality;
use App\Entity\Stay;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PatientControllerTest extends WebTestCase
{
    private KernelBrowser|null $client = null;
    private $doctrine = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->doctrine = $this->getContainer()->get("doctrine");
    }

    public function testLogAsAdmin(): void
    {
        $userRepo = $this->doctrine->getRepository(User::class);
        $user = $userRepo->findOneByEmail('admin@studi.fr');
        $this->client->loginUser($user);

        $this->client->request('GET', '/patient/home');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Interface d\'administration du CHU SoigneMoi');
    }

    /**
     * Modifiaction profil User
     */
    public function testEditUser(): void
    {
        $userRepo = $this->doctrine->getRepository(User::class);
        $user = $userRepo->findOneByEmail('john.do@test.fr');
        /** @var User $user */
        $this->client->loginUser($user);

        $ancienUserEmail = $user->getEmail();
        $newUserEmail = 'jane_do@stest.fr';

        $this->client->request('GET', '/patient/edition');

        $this->client->submitForm('Enregistrer', [
            'patient_edit[user][email]' => $newUserEmail,
        ]);
        $this->assertResponseRedirects('/patient/home', Response::HTTP_SEE_OTHER);


        /** @var User $user */
        $user = $userRepo->findOneByEmail($newUserEmail);

        $this->assertNotNull($user);
        $this->assertSame($newUserEmail, $user->getEmail());

        // rétabli pour futurs tests : ne relance pas les fixtures..
        $this->client->request('GET', '/patient/edition');
        $this->client->submitForm('Enregistrer', [
            'patient_edit[user][email]' => $ancienUserEmail,
        ]);

        $this->assertTrue(true);
    }
    /**
     * Teste affichage détail d'un séjour patient
     */
    public function testShowDetailStay(): void
    {
        $stayRepo = $this->doctrine->getRepository(Stay::class);
        /** @var STAY $stay */
        $stay = $stayRepo->findOneBy([], ['id' => 'DESC'], 1);
        $this->client->request('GET', '/sejour_show/' . $stay->getId());
        $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Séjour');
    }
    /**
     * création d'un nouveau séjour
     */
    public function testNewSejour(): void
    {
        $userRepo = $this->doctrine->getRepository(User::class);
        $user = $userRepo->findOneByEmail('john.do@test.fr');
        /** @var User $user */
        $this->client->loginUser($user);

        $speRepo = $this->doctrine->getRepository(Speciality::class);
        /** @var Speciality $spe */
        $spe = $speRepo->findOneBy([], ['id' => 'DESC'], 1);

        $medecinRepo = $this->doctrine->getRepository(Medecin::class);
        /** @var Speciality $spe */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);

        $this->client->request('GET', '/sejour_new');

        $this->client->submitForm('Enregistrer', [
            'stay[speciality]'  =>  $spe->getId(),
            'stay[medecin]'     =>  $medecin->getId(),
            'stay[start_date]'  => (new \DateTime("01-03-2024"))->format('d/m/Y'),
            'stay[end_date]'    => (new \DateTime("02-04-2024"))->format('d/m/Y'),
            'stay[reason]'      =>  "reason to stay",
            'stay[description]' =>  "description of reason to stay",
        ]);
        $this->assertResponseRedirects('/patient/home', Response::HTTP_SEE_OTHER);
    }


    /**
     * return json liste des medecin de la specialité passée en paramétre
     */
    public function testListMedecinParSpe(): void
    {
        $speRepo = $this->getContainer()->get("doctrine")->getRepository(Speciality::class);

        /** @var Speciality $spe */
        $spe = $speRepo->findOneBy([], ['id' => 'DESC'], 1);
        $this->client->request('GET', $spe->getId() . '/medecins');
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }
    /**
     * Liste les jours ou le medecin n'est pas disponible
     */
    public function testBusyMedecin(): void
    {

        $medecinRepo = $this->doctrine->getRepository(Medecin::class);
        /** @var Speciality $spe */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);

        $this->client->request('GET', $medecin->getId() . '/notMedecinjson');
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }
}
