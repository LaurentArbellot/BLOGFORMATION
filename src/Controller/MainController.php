<?php

namespace App\Controller;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/', name: 'app_main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(PostsRepository $postsRepository ): Response
    {
       
        return $this->render('main/home.html.twig', [
            'posts' => $postsRepository->findAll(),
        ]);
    }



    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('main/home.html.twig', [
            'controller_name' => 'Contact',
        ]);
    }
}