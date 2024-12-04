<?php

namespace App\Tests\Repository;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    public function testFindMostPopular(): void
    {
        self::bootKernel();

        $categoryRepository = static::getContainer()->get(CategoryRepository::class);

        $this->assertEquals('Action', $categoryRepository->findMostPopular()->getLabel());
    }
}
