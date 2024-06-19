<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    private KernelBrowser|null $client = null;

    public function setUp(): void
    {
        // simule le navigateur
        $this->client = static::createClient();
    }
    public function testDisplayLogin(): void
    {
        $this->client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h1', 'Connexion');
        $this->assertSelectorNotExists('.alert.alert-danger');
    }
    public function testLoginWithBadCredential(): void
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form([
            'email'     =>  'jo@staudi.fr',
            'password'  =>  'fakepassword',
        ]);
        $this->client->submit($form);
        $this->assertResponseRedirects('/login');
        $this->client->followRedirect();
        $this->assertSelectorExists('.alert.alert-danger');
    }
    public function testSuccessfullLoginAsAdmin(): void
    {
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        $user = $userRepo->findOneByEmail('admin@studi.fr');
        $this->client->loginUser($user);

        $this->client->request('GET', '/login');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Interface d\'administration du CHU SoigneMoi');
    }
    public function testSuccessfullLoginAsUser(): void
    {
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        $user = $userRepo->findOneByEmail('john.do@test.fr');
        $this->client->loginUser($user);

        $this->client->request('GET', '/login');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Espace patient CHU SoigneMoi');
    }

    public function testLogOut(): void
    {
        $this->client->request('GET', '/logout');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'Accueil SoigneMoi');
    }
}
