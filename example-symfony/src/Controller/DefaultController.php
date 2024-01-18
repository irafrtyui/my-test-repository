<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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

    public function newsList(EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Posts::class)->findAll();
        return $this->render('Default/newsList.html.twig', [
            'list' => $list,
        ]);
    }


    public function newsOne(int $id,EntityManagerInterface $entityManager): Response
    {
        $post = $entityManager->getRepository(Posts::class)->find($id);
        return $this->render('Default/newsOne.html.twig', [
            'post' => $post
        ]);
    }

    public function contacts(): Response
    {
        return $this->render('Default/contacts.html.twig');
    }
}