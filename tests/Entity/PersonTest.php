<?php

namespace App\Tests\Entity;

use App\Entity\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testPersonDisplay(): void
    {
        $person = new Person();
        $person->setFirstname('John');
        $person->setLastname('Doe');

        $this->assertEquals('John Doe', (string) $person);
    }
}
