<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        CategoryRepository $categoryRepository,
        MovieRepository $movieRepository,
        PersonRepository $personRepository,
    ): Response {
        return $this->render('main/index.html.twig', [
            'countMovies' => $movieRepository->count(),
            'latestDirectorMovie' => $personRepository->findLatestDirectorMovie(),
            'mostPopularCategory' => $categoryRepository->findMostPopular(),
            'randomMovie' => $movieRepository->findRandom(),
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return new Response('A propos');
    }
}
