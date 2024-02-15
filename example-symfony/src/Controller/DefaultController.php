<?php


namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsForm;
use App\Services\Export;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Posts;


class DefaultController extends AbstractController
{
    public function home(): Response
    {
        return $this->render('Default/home.html.twig');
    }

    public function login(): Response
    {
        return $this->render('Default/login.html.twig');
    }

    public function about(): Response
    {
        return $this->render('Default/about.html.twig');
    }

    public function latestNews(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Posts::class)->findAll();
        return $this->render('Default/latestNews.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function newsList(Request $request, EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Posts::class)->GetNewsList();
        return $this->render('Default/newsList.html.twig', [
            'list' => $list,
        ]);
    }


    public function newsOne(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = $entityManager->getRepository(Posts::class)->find($id);

        $form = $this->createForm(CommentsForm::class);
        $form->handleRequest($request);

        $isSubmitted = false;
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Comments $comment */
        $comment = $form->getData();
        $comment->setDate(new \DateTime());
        $comment->setPost($post);

        $entityManager->persist($comment);
        $entityManager->flush();

        $isSubmitted = true;
        $form = $this->createForm(CommentsForm::class);
        }
        return $this->render('Default/newsOne.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'isSubmitted' => $isSubmitted,
        ]);
    }



    public function contacts(): Response
    {
        return $this->render('Default/contacts.html.twig');
    }

    public function exportList(Export $export, EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Posts::class)->GetNewsList();
        $file = $export->exportNews($list);

        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-type', 'text/csv');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'export-data.csv'
        );
        return $response;
    }
}