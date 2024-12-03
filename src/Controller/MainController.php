<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'countMovies' => $movieRepository->count(),
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return new Response('A propos');
    }
}
