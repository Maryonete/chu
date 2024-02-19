<?php

namespace App\Tests;

use App\Entity\Medecin;
use App\Entity\Speciality;
use App\Entity\User;
use App\Entity\Stay;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    private KernelBrowser|null $client = null;

    public function setUp(): void
    {
        // simule le navigateur
        $this->client = static::createClient();

        // Admin connecté
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        $user = $userRepo->findOneByEmail('admin@studi.fr');
        $this->client->loginUser($user);
    }
    /**
     * Save a rdv in medecin calendar
     */
    public function testCalendarMedecin(): void
    {
        $medecinRepo = $this->getContainer()->get("doctrine")->getRepository(Medecin::class);
        /** @var Medecin $medecin */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);

        $crawler = $this->client->request('GET', '/admin/' . $medecin->getId() . '/calendarMedecin');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Agenda du médecin');

        $stayRepo = $this->getContainer()->get("doctrine")->getRepository(Stay::class);
        $stay = $stayRepo->staysAVenirParMedecin($medecin->getId(), 1);

        $form = $crawler->selectButton('Enregistrer')->form([
            'start'             => '2024-06-01',
            'end'               => '2024-07-01',
            'startHeure'        => '08:30',
            'endHeure'          => '14:30',
            'calendar[title]'   => '[Test] RDV with Patient',
            'stay'              =>  $stay[0]->getId(),
            'calendar[description]' => 'Description du rdv',
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects('/admin/' . $medecin->getId() . '/calendarMedecin');
    }

    /**
     * liste des rdv d'un medecin passé en paramétre
     * return json 
     */
    public function testCalendarMedecinJson(): void
    {
        $medecinRepo = $this->getContainer()->get("doctrine")->getRepository(Medecin::class);
        /** @var Medecin $medecin */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);

        $this->client->request('GET', '/admin/' . $medecin->getId() . '/calendarMedecinjson');
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }
    /**
     * Infos d'un séjour passé en paramétre
     * return json 
     */
    public function testStayJson(): void
    {
        $stayRepo = $this->getContainer()->get("doctrine")->getRepository(Stay::class);
        /** @var Stay $stay */
        $stay = $stayRepo->findOneBy([], ['id' => 'DESC'], 1);

        $this->client->request('GET', '/admin/' . $stay->getId() . '/stay');
        $response = $this->client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    /**
     * Edit a medecin
     */
    public function testEditMedecin(): void
    {
        $medecinRepo = $this->getContainer()->get("doctrine")->getRepository(Medecin::class);
        /** @var Medecin $medecin */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);

        $crawler = $this->client->request('GET', '/admin/medecin/' . $medecin->getId() . '/edit');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Mise à jour du médecin');

        $newMedecinEmail = 'medecin_jane@studi.com';

        $form = $crawler->selectButton('Enregistrer')->form([
            'medecin_edit[user][email]'     => $newMedecinEmail,
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects('/admin/', Response::HTTP_SEE_OTHER);

        // verifie maj adresse email
        $medecin = $medecinRepo->find($medecin->getId());
        $this->assertEquals($newMedecinEmail, $medecin->getUser()->getEmail());
    }
    /**
     * Create a medecin
     */
    public function testNewMedecin(): void
    {
        $crawler = $this->client->request('GET', '/admin/medecin/new');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Création d\'un nouveau Médecin');

        $newMedecinEmail = 'medecin_test@studi.com';

        $form = $crawler->selectButton('Enregistrer')->form();

        $form['medecin_new[user][lastname]']    =  'Zetofre';
        $form['medecin_new[user][firstname]']   =  'Melanie';
        $form['medecin_new[user][email]']       =  $newMedecinEmail;
        $form['medecin_new[plainPassword]']     =  'password';
        $form['medecin_new[speciality][0]']     =  '1';

        $this->client->submit($form);
        $this->assertResponseRedirects('/admin/', Response::HTTP_SEE_OTHER);

        // vérifie si le médecin a été créé avec succès
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        $newMedecin = $userRepo->findOneByEmail($newMedecinEmail);

        $this->assertNotNull($newMedecin);
    }
}
