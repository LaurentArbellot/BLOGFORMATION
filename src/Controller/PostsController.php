<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/articles')]
class PostsController extends AbstractController
{
    #[Route('/', name: 'app_posts_index', methods: ['GET'])]
    public function index(PostsRepository $postsRepository): Response
    {
        return $this->render('posts/index.html.twig', [
            'posts' => $postsRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_AUTHOR')]
    #[Route('/nouveau', name: 'app_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PostsRepository $postsRepository): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // L'auteur est enregistré avec l'utilisateur connecté
            $post->setAuthor($this->getUser());
            // sauvegarde l'article en bdd
           
            $postsRepository->save($post, true);

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_USER')] 
    #[Route('/{slug}', name: 'app_posts_show', methods: ['GET'])]
    public function show(Posts $post): Response
    {
        return $this->render('posts/show.html.twig', [
            'post' => $post,
        ]);
    }
    #[IsGranted('ROLE_AUTHOR')]
    #[Route('/{slug}/modifier', name: 'app_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Posts $post, PostsRepository $postsRepository): Response
    {
        if($post->getAuthor() === $this->getUser()){
            $form = $this->createForm(PostsType::class, $post);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $postsRepository->save($post, true);

                return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
            }

            return $this->render('posts/edit.html.twig', [
                'post' => $post,
                'form' => $form,
            ]);

            }else{
            $this->addFlash('warning',' Seul l\auteur peut modifier cette publication');
            return $this->redirectToRoute('app_posts_index');
        }

        
    }

    #[Route('/{slug}', name: 'app_posts_delete', methods: ['POST'])]
    public function delete(Request $request, Posts $post, PostsRepository $postsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postsRepository->remove($post, true);
        }

        return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
