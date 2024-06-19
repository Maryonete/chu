<?php

namespace App\Tests\Entity;

use App\Entity\{User, Medecin, Patient};
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use PHPUnit\Metadata\Covers;

#[Covers(User::class)]
final class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->user);
    }
    public function test__toString(): void
    {
        $this->user->setFirstname('John')->setLastname('Do');
        $expected =  "John  Do";
        self::assertSame($expected, $this->user->__toString());
    }
    public function testToArray(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(User::class))
            ->getProperty('id');
        $property->setValue($this->user, $expected);

        $this->user->setFirstname('John')->setLastname('Do');

        $tabTest =  [
            "id" => 42,
            "name" => "Do  John",
        ];
        self::assertSame($tabTest, $this->user->toArray());
    }
    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(User::class))
            ->getProperty('id');
        $property->setValue($this->user, $expected);
        self::assertSame($expected, $this->user->getId());
    }
    public function testGetUserIdentifier(): void
    {
        $this->user->setEmail('mail@test.fr');
        $expected =  "mail@test.fr";
        self::assertSame($expected, $this->user->getUserIdentifier());
    }

    public function testGetAndSetEmail(): void
    {

        self::assertNull($this->user->getEmail());
        $email = 'test@studi.fr';
        $this->user->setEmail($email);
        self::assertSame($email, $this->user->getEmail());
    }

    public function testSetEmail(): void
    {
        $email = 'test@studi.fr';
        $this->user->setEmail($email);
        self::assertSame($email, filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public function testSetBadEmail()
    {
        $this->expectException(\TypeError::class);
        $expected = 'teststudi.fr';
        $this->user->setEmail($expected);
    }
    public function testRoles(): void
    {
        // Test setRoles and getRoles
        $roles = ['ROLE_ADMIN'];
        $this->user->setRoles($roles);
        self::assertSame($roles, $this->user->getRoles());

        // Test adding roles
        $additionalRoles = ['ROLE_MANAGER', 'ROLE_EDITOR'];
        $expectedRoles = array_merge($roles, $additionalRoles, ['ROLE_USER']);
        $this->user->setRoles($expectedRoles);
        self::assertSame($expectedRoles, $this->user->getRoles());
    }

    public function testIsAdmin(): void
    {
        $roles = ['ROLE_ADMIN', 'ROLE_MANAGER', 'ROLE_EDITOR'];
        $roleAdmin = 'ROLE_ADMIN';
        $this->user->setRoles($roles);
        self::assertContains($roleAdmin, $this->user->getRoles());

        $roles = ['ROLE_USER', 'ROLE_MANAGER', 'ROLE_EDITOR'];
        $this->user->setRoles($roles);
        self::assertFalse(in_array($roleAdmin, $this->user->getRoles()));
    }
    public function testIsNotAdmin(): void
    {
        $expected = ['ROLE_MEDECIN', 'ROLE_MANAGER', 'ROLE_EDITOR'];
        $roleAdmin = 'ROLE_ADMIN';
        $this->user->setRoles($expected);
        self::assertFalse(in_array($roleAdmin, $this->user->getRoles()));
    }

    public function testIsUser(): void
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER', 'ROLE_EDITOR'];
        $roleUser = 'ROLE_USER';
        $this->user->setRoles($roles);
        self::assertContains($roleUser, $this->user->getRoles());
    }

    public function testGetAndGetPassword(): void
    {
        $pwd = '123456';
        $this->user->setPassword($pwd);
        self::assertSame($pwd, $this->user->getPassword());
    }

    public function testGetAndSetFirstname(): void
    {
        $name = 'John';
        $this->user->setFirstname($name);
        self::assertSame($name, $this->user->getFirstname());
    }

    public function testGetAndSetLastname(): void
    {
        $name = 'Do';
        $this->user->setLastname($name);
        self::assertSame($name, $this->user->getLastname());
    }

    public function testGetPatient(): void
    {
        $patient = $this->createMock(Patient::class);
        $property = (new ReflectionClass(User::class))
            ->getProperty('patient');
        $property->setValue($this->user, $patient);
        self::assertSame($patient, $this->user->getPatient());
    }

    public function testSetPatient(): void
    {
        $expected = $this->createMock(Patient::class);
        $property = (new ReflectionClass(User::class))
            ->getProperty('patient');
        $this->user->setPatient($expected);
        self::assertSame($expected, $property->getValue($this->user));
    }

    public function testGetAndSetMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $this->user->setMedecin($medecin);
        self::assertSame($medecin, $this->user->getMedecin());
    }

    public function testIsAdminWithAdminRole()
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $this->assertTrue($admin->isAdmin());
    }

    public function testIsAdminWithoutAdminRole()
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $this->assertFalse($user->isAdmin());
    }

    public function testIsUserWithUserRole()
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $this->assertTrue($user->isUser());
    }

    public function testIsUserWithoutUserRole()
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertFalse($user->isUser());
    }
}
