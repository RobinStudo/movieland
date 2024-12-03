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

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/{id:movie}', name: 'single', requirements: ['id' => '\d+'])]
    public function single(Movie $movie): Response
    {
        return $this->render('movie/single.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function form(): Response
    {
        return new Response('Formulaire de film');
    }
}
