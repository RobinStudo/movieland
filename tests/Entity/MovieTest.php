<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use DateTime;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    /**
     * @dataProvider dateProvider
     */
    public function testRelativeRelease($expected, $relativeTime): void
    {
        $movie = new Movie();

        $movie->setReleasedAt(new DateTime($relativeTime));
        $this->assertEquals($expected, $movie->relativeRelease());
    }

    protected function dateProvider(): array
    {
        return [
            ['18', '-18 years'],
            ['17', '-18 years 10 months 28 days'],
            ['0', '-3 months'],
        ];
    }
}
