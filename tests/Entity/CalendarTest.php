<?php

use App\Entity\{User, Stay, Medecin, Calendar};
use PHPUnit\Metadata\Covers;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;


final class CalendarTest extends TestCase
{
    #[Covers(Calendar::class)]
    private static Calendar $calendar;

    public static function setUpBeforeClass(): void
    {
        self::$calendar = new Calendar();
    }

    public static function tearDownAfterClass(): void
    {
        self::$calendar = null;
    }

    public function testToArray(): void
    {
        $color = self::$calendar->getStay() ? "" : "#378006";
        self::$calendar->setStart(new DateTime());
        self::$calendar->setEnd(new DateTime());
        $tabTest = [
            "id" => self::$calendar->getId(),
            "start" => self::$calendar->getStart()->format('Y-m-d H:i:s'),
            "end" => self::$calendar->getEnd()->format('Y-m-d H:i:s'),
            "title" => self::$calendar->getTitle(),
            "backgroundColor" => $color,
        ];
        self::assertSame($tabTest, self::$calendar->toArray());
    }

    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Calendar::class))
            ->getProperty('id');
        $property->setAccessible(true);
        $property->setValue(self::$calendar, $expected);
        self::assertSame($expected, self::$calendar->getId());
    }

    public function testGetAndSetStart(): void
    {
        $date = new DateTime();
        self::$calendar->setStart($date);
        self::assertSame($date, self::$calendar->getStart());
    }

    public static function wrongDateProvider(): array
    {
        return [
            ['2024-01-01'], ['0000-01-22'], ['11'], [1]
        ];
    }

    #[DataProvider('wrongDateProvider')]
    public function testSetWrongStart($badDate): void
    {
        $this->expectException(TypeError::class);
        self::$calendar->setStart($badDate);
    }

    public function testGetAndSetEnd(): void
    {
        $date = new DateTime();
        self::$calendar->setEnd($date);
        self::assertSame($date, self::$calendar->getEnd());
    }

    #[DataProvider('wrongDateProvider')]
    public function testSetWrongEnd($badDate): void
    {
        $this->expectException(TypeError::class);
        self::$calendar->setEnd($badDate);
    }

    public function testGetAndSetTitle(): void
    {
        $title = 'patient appointment';
        self::$calendar->setTitle($title);
        self::assertSame($title, self::$calendar->getTitle());
    }

    public function testGetAndSetDescription(): void
    {
        $desc = 'a short description of the appointment with a patient';
        self::$calendar->setDescription($desc);
        self::assertSame($desc, self::$calendar->getDescription());
    }

    public function testGetAndSetMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        self::$calendar->setMedecin($medecin);
        self::assertSame($medecin, self::$calendar->getMedecin());
    }

    public function testSetWrongMedecin(): void
    {
        $this->expectException(TypeError::class);
        $medecin = $this->createMock(User::class);
        self::$calendar->setMedecin($medecin);
    }

    public function testGetAndSetStay(): void
    {
        $stay = $this->createMock(Stay::class);
        self::$calendar->setStay($stay);
        self::assertSame($stay, self::$calendar->getStay());
    }
}
