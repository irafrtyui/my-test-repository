<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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

    public function latestNews(): Response
    {
        return $this->render('Default/latestNews.html.twig');
    }

    public function newsOne(): Response
    {
        return $this->render('Default/newsOne.html.twig');
    }

    public function contacts(): Response
    {
        return $this->render('Default/contacts.html.twig');
    }
}