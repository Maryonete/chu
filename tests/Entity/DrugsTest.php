<?php

namespace App\Tests\Entity;

use App\Entity\Drugs;
use PHPUnit\Framework\TestCase;

class DrugsTest extends TestCase
{
    public function testGetId()
    {
        $drug = new Drugs();
        $this->assertNull($drug->getId(), 'Initial id should be null');
    }

    public function testGetName()
    {
        $drug = new Drugs();
        $this->assertNull($drug->getName(), 'Initial name should be null');

        $drug->setName('Aspirin');
        $this->assertEquals('Aspirin', $drug->getName(), 'Name should be Aspirin');
    }

    public function testSetName()
    {
        $drug = new Drugs();
        $this->assertInstanceOf(
            Drugs::class,
            $drug->setName('Paracetamol'),
            'setName should return the instance of Drugs'
        );
        $this->assertEquals('Paracetamol', $drug->getName(), 'Name should be Paracetamol');
    }
}
