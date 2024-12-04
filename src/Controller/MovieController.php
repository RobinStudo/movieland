<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movies', name: 'movie_')]
class MovieController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly MovieRepository $movieRepository
    ) {
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
    public function form(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($movie);
            $this->em->flush();

            return $this->redirectToRoute('movie_single', [
                'id' => $movie->getId(),
            ]);
        }

        return $this->render('movie/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
