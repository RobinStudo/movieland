<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findMostPopular(): Category
    {
        $qb = $this->createQueryBuilder('c');

        $qb->leftJoin(Movie::class, 'm', 'WITH', 'm.category = c');
        $qb->orderBy('COUNT(m.id)', 'DESC');
        $qb->groupBy('c.id');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }
}
