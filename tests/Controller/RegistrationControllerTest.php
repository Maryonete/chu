<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RegistrationControllerTest extends PantherTestCase
{
    private Client $client;
    private ?ContainerInterface $container = null;

    protected function setUp(): void
    {
        // Configure Panther to use Symfony's session
        self::bootKernel();

        //$this->client = static::createPantherClient(['browser' => static::FIREFOX]);
        $this->client = static::createPantherClient();

        // Récupérer le conteneur de services
        $this->container = $this->getContainer();
    }

    public function testAccesToRegistrationPage(): void
    {
        $this->client->request('GET', '/inscription');
        // Vérifie le contenu de la page
        $this->assertSelectorTextContains('h1', "Création d'un compte patient");
    }

    // public function testRegisterUser(): void
    // {
    //     //     $this->assertTrue(true);
    //     //     // #TODO impossible erreur : Symfony\Component\HttpFoundation\Exception\SessionNotFoundException: There is currently no session available.
    //     $this->client->request('GET', '/inscription');
    //     $crawler = $this->client->waitFor('.card');
    //     $this->assertSelectorTextContains('h1', "Création d'un compte patient");
    //     //     // Initialiser le gestionnaire de jetons CSRF
    //     //     // $csrfToken = $this->container->get(CsrfTokenManagerInterface::class)
    //     //     //     ->getToken('registration_form')
    //     //     //     ->getValue();


    //     //     // $csrfToken = $this->container->get('security.csrf.token_manager')->getToken('authenticate');
    //     //     // dump('TOKEN : ' . $csrfToken);

    //     //     // wait for the button to appear!
    //     //     $this->client->waitForVisibility('button[name="createAccount"]');
    //     //     $this->assertSelectorExists('button[name="createAccount"]');

    //     $form = $crawler->filter('form[name="registration_form"]')->form();
    //     $form['registration_form[email]']              = "newuser@studi.fr";
    //     $form['registration_form[plainPassword]']      = "password";
    //     $form['registration_form[firstname]']          = "Jeanne";
    //     $form['registration_form[lastname]']           = "Dupont";
    //     $form['registration_form[patient][adlibelle]'] = "1 rue du four";
    //     $form['registration_form[patient][adcp]']      = "34000";
    //     $form['registration_form[patient][adcity]']    = "Montpellier";
    //     $form['registration_form[patient][adcountry]'] = "FR";
    //     //     // $form['registration_form[_token]'] = $csrfToken;
    //     $this->client->submit($form);
    //     //     // dump($this->client->getCurrentURL());

    //     //     $this->assertSelectorTextContains('.alert', "Votre compte patient est créé");
    // }
}
