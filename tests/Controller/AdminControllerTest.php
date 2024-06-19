<?php

namespace App\Tests;

use DateTime;
use App\Entity\Stay;
use App\Entity\User;
use App\Entity\Medecin;
use App\Entity\Calendar;
use App\Entity\Speciality;
use Symfony\Component\VarDumper\VarDumper;
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

    public function testCalendarMedecin(): void
    {
        $medecinRepo = $this->getContainer()->get("doctrine")->getRepository(Medecin::class);

        /** @var Medecin $medecin */
        $medecin = $medecinRepo->findOneBy([], ['id' => 'DESC'], 1);
        $id = $medecin->getId();

        $crawler = $this->client->request('GET', '/admin/' . $id . '/calendarMedecin');

        // Vérifier que la requête a abouti avec succès (statut HTTP 200)
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Sélectionner le formulaire
        $form = $crawler->selectButton('Enregistrer')->form();

        // Remplir les champs du formulaire
        $form['start']       = '2024-06-25';
        $form['startHeure']  = '09:00:00';
        $form['end']         = '2024-06-28';
        $form['endHeure']    = '10:00:00';
        $form['calendar[title]']       = 'title rdv';
        $form['calendar[description]']       = 'description rdv';

        // Soumettre le formulaire
        $this->client->submit($form);

        // Vérifier la redirection après soumission
        $this->assertTrue($this->client->getResponse()->isRedirect());

        // Suivre la redirection
        $this->client->followRedirect();
        $this->assertEquals("/admin/$id/calendarMedecin", $this->client->getRequest()->getPathInfo());
    }
    public function testCalendarMedecinWithStay(): void
    {

        $stayRepo = $this->getContainer()->get("doctrine")->getRepository(Stay::class);
        /** @var Stay $stayWait */
        $results = $stayRepo->findAll();
        /** @var Stay $stayWait */
        $stayWait = null;
        $currentDate = new \DateTime();

        foreach ($results as $result) {
            if (
                $result->isValidate() == false &&
                $result->getStartDate() > $currentDate
            ) {
                $stayWait = $result;
                break;
            }
        }
        $idMedecin = $stayWait->getMedecin()->getId();
        $crawler = $this->client->request('GET', '/admin/' . $idMedecin . '/calendarMedecin');
        // Vérifier que la requête a abouti avec succès (statut HTTP 200)
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());


        // Sélectionner le formulaire
        $form = $crawler->selectButton('Enregistrer')->form();
        // Remplir les champs du formulaire
        $form['start']       = '2024-06-25';
        $form['startHeure']  = '09:00:00';
        $form['end']         = '2024-06-28';
        $form['endHeure']    = '10:00:00';
        $form['stay']        = (string) $stayWait->getId();
        $form['calendar[title]']       = $stayWait->getReason();
        $form['calendar[description]'] = $stayWait->getDescription();
        // Soumettre le formulaire
        $this->client->submit($form);

        // Vérifier la redirection après soumission
        $this->assertTrue($this->client->getResponse()->isRedirect());

        // Suivre la redirection
        $this->client->followRedirect();
        $this->assertEquals("/admin/$idMedecin/calendarMedecin", $this->client->getRequest()->getPathInfo());
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
