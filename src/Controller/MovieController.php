<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movies', name: 'movie_')]
class MovieController extends AbstractController
{
    public function __construct(private readonly MovieRepository $movieRepository)
    {
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        $movies = $this->movieRepository->findBy([], ['releasedAt' => 'DESC']);
        dd($movies);

        return new Response('Liste des films');
    }

    #[Route('/{id:movie}', name: 'single', requirements: ['id' => '\d+'])]
    public function single(Movie $movie): Response
    {
        return new Response('Film : ' . $movie->getTitle());
    }

    #[Route('/new', name: 'new')]
    public function form(): Response
    {
        return new Response('Formulaire de film');
    }
}
