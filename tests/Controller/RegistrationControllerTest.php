<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{

    public function testAccesToRegistrationPage(): void
    {
        $client = static::createClient();

        // Simuler la requête HTTP
        $client->request('GET', '/inscription');

        $this->assertResponseIsSuccessful();

        // Récupérer le token CSRF pour le formulaire
        $crawler = $client->getCrawler();
        $csrfToken = $crawler->filter('input[name="registration_form[_token]"]')->attr('value');

        // Sélectionner le formulaire
        $form = $crawler->selectButton('S\'enregistrer')->form();
        $form['registration_form[email]']               = "newuser@studi.fr";
        $form['registration_form[password][first]']     = 'T1!estpassword';
        $form['registration_form[password][second]']    = 'T1!estpassword';
        $form['registration_form[firstname]']           = "Jeanne";
        $form['registration_form[lastname]']            = "Dupont";
        $form['registration_form[patient][adlibelle]']  = "1 rue du four";
        $form['registration_form[patient][adcp]']       = "34000";
        $form['registration_form[patient][adcity]']     = "Montpellier";
        $form['registration_form[patient][adcountry]']  = "FR";
        $form['registration_form[_token]']              = $csrfToken;

        // Soumettre le formulaire
        $client->submit($form);

        //     // Vérifier la redirection après soumission
        //     // $this->assertResponseRedirects('/patient/home');

        // Suivre la redirection
        $client->followRedirect();

        // Vérifier que l'utilisateur a été authentifié et qu'un message flash de succès est affiché
        $this->assertSelectorExists('.alert-success', 'Votre compte patient est créé');
    }
}
