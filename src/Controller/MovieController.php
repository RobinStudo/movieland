<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movies', name: 'movie_')]
class MovieController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        return new Response('Liste des films');
    }

    #[Route('/{id}', name: 'single', requirements: ['id' => '\d+'])]
    public function single(int $id): Response
    {
        return new Response('Film : ' . $id);
    }

    #[Route('/new', name: 'new')]
    public function form(): Response
    {
        return new Response('Formulaire de film');
    }
}
