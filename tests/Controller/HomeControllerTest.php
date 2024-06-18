<?php

namespace App\Tests\Controller;

use App\Entity\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HomeControllerTest extends WebTestCase
{
    private KernelBrowser|null $client = null;

    public function setUp(): void
    {
        // simule le navigateur
        $this->client = static::createClient();
    }
    public function testIsNotLogged()
    {
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Connexion');
    }
    public function testLogAsAdmin(): void
    {
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        $user = $userRepo->findOneByEmail('admin@studi.fr');
        $this->client->loginUser($user);

        $this->client->request('GET', '/');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Interface d\'administration du CHU SoigneMoi');
    }
    public function testLogAsUser(): void
    {
        /** @var UserRepository $userRepository */
        $userRepo = $this->getContainer()->get("doctrine")->getRepository(User::class);
        /** @var User $user */
        $user = $userRepo->findOneByEmail('john.do@test.fr');

        $this->client->loginUser($user);

        $this->client->request('GET', '/');
        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Espace patient CHU SoigneMoi');
    }
    #[DataProvider('getPublicUrls')]
    public function testPublicUrls(string $url): void
    {
        $this->client->request('GET', $url);

        $this->assertResponseIsSuccessful(sprintf('The %s public URL loads correctly.', $url));
    }
    public static function getPublicUrls(): \Generator
    {
        yield ['/'];
        yield ['/mentions_legales'];
        yield ['/contact'];
        yield ['/tarifs'];
        yield ['/faqs'];
        yield ['/droitspatients'];
        yield ['/speciality'];
    }
}
