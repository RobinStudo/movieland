<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function findRandom(): Movie
    {
        $qb = $this->createQueryBuilder('m');

        $qb->orderBy('RAND()');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }
}
