<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function home(): Response
    {
        return $this->render('default/home.html.twig');
    }

    public function login(): Response
    {
        return $this->render('default/login.html.twig');
    }

    public function about(): Response
    {
        return $this->render('default/about.html.twig');
    }

    public function latestNews(): Response
    {
        return $this->render('default/latestNews.html.twig');
    }

    public function newsOne(): Response
    {
        return $this->render('default/newsOne.html.twig');
    }

    public function contacts(): Response
    {
        return $this->render('default/contacts.html.twig');
    }
}