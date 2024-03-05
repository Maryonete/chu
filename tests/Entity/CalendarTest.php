<?php

namespace App\Tests\Entity;

use App\Entity\Calendar;
use App\Entity\Medecin;
use App\Entity\Stay;
use App\Entity\User;
use DateTime;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * Class CalendarTest.
 *
 * @covers \App\Entity\Calendar
 */
final class CalendarTest extends TestCase
{
    private Calendar $calendar;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->calendar = new Calendar();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->calendar);
    }

    public function testToArray(): void
    {
        $color = $this->calendar->getStay() ? "" : "#378006";
        $this->calendar->setStart(new DateTime());
        $this->calendar->setEnd(new DateTime());
        $tabTest = [
            "id"    => $this->calendar->getId(),
            "start" => $this->calendar->getStart()->format('Y-m-d H:i:s'),
            "end"   => $this->calendar->getEnd()->format('Y-m-d H:i:s'),
            "title" => $this->calendar->getTitle(),
            // "url"   => "/admin/calendar/" . $this->getId() . "/edit/",
            "backgroundColor" => $color,
        ];
        self::assertSame($tabTest, $this->calendar->toArray());
    }

    public function testGetId(): void
    {
        $expected = 42;
        $property = (new ReflectionClass(Calendar::class))
            ->getProperty('id');
        $property->setValue($this->calendar, $expected);
        self::assertSame($expected, $this->calendar->getId());
    }

    public function testGetAndSetStart(): void
    {
        $date = new DateTime();
        $this->calendar->setStart($date);
        self::assertSame($date, $this->calendar->getStart());
    }
    public function wrongDateProvider()
    {
        return [
            ['2024-01-01'], ['0000-01-22'], ['11'], [1]
        ];
    }
    /**
     * @dataProvider wrongDateProvider
     */
    public function testSetWrongStart($badDate): void
    {
        $this->expectException(TypeError::class);
        $this->calendar->setStart($badDate);
    }

    public function testGetAndSetEnd(): void
    {
        $date = new DateTime();
        $this->calendar->setEnd($date);
        self::assertSame($date, $this->calendar->getEnd());
    }
    /**
     * @dataProvider wrongDateProvider
     */
    public function testSetWrongEnd($badDate): void
    {
        $this->expectException(TypeError::class);
        $this->calendar->setEnd($badDate);
    }

    public function testGetAndSetTitle(): void
    {
        $title = 'patient appointment';
        $this->calendar->setTitle($title);
        self::assertSame($title, $this->calendar->getTitle());
    }

    public function testGetAndSetDescription(): void
    {
        $desc = 'a short description of the appointment with a patient';
        $this->calendar->setDescription($desc);
        self::assertSame($desc, $this->calendar->getDescription());
    }

    public function testGetAndSetMedecin(): void
    {
        $medecin = $this->createMock(Medecin::class);
        $this->calendar->setMedecin($medecin);
        self::assertSame($medecin, $this->calendar->getMedecin());
    }

    public function testSetWrongMedecin(): void
    {
        $this->expectException(TypeError::class);
        $user = $this->createMock(User::class);
        $this->calendar->setMedecin($user);
    }

    public function testGetAndSetStay(): void
    {
        $stay = $this->createMock(Stay::class);
        $this->calendar->setStay($stay);
        self::assertSame($stay, $this->calendar->getStay());
    }
}
