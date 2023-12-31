<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAll(),
        ]);
    }

    #[Route('/micro-post/{id}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]

    public function add(Request $request, MicroPostRepository $posts): Response
    {
        // $micropost = new MicroPost();
        // $form = $this->createFormBuilder($micropost)
        //     ->add('title')
        //     ->add('text')
        //     ->getForm();
        $form = $this->createForm(MicroPostType::class, new MicroPost());
        //recevoir une requette
        $form->handleRequest($request);
        //verifier si le message est valide 
        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();
            $post->setCreated(new DateTime());
            //ajouter le post a la liste de post
            $posts->add($post, true);

            //ajouter un flash message
            $this->addFlash('success', 'Your post has been added');
            //rediriger vers une autre page
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render(
            'micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]

    public function edit(MicroPost $post, Request $request, MicroPostRepository $posts): Response
    {
        //modifier un post
        // $form = $this->createFormBuilder($post)
        //     ->add('title')
        //     ->add('text')
        //     ->getForm();
        $form = $this->createForm(MicroPostType::class, $post);
        //recevoir une requette
        $form->handleRequest($request);
        //verifier si le message est valide 
        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();
            //ajouter le post a la liste de post
            $posts->add($post, true);

            //ajouter un flash message
            $this->addFlash('success', 'Your post has been updated');
            //rediriger vers une autre page
            return $this->redirectToRoute('app_micro_post');
        }
        return $this->render(
            'micro_post/add.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
