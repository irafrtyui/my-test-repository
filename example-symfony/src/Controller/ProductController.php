<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function show(): Response
    {
        return $this->render('Product/show.html.twig');
    }

    public function sort(): Response
    {
        return $this->render('Product/sort.html.twig');
    }

    public function add(): Response
    {

        return $this->render('Product/add.html.twig');
    }

    public function search(): Response
    {
        return $this->render('Product/search.html.twig');
    }

    public function viewing(): Response
    {
        return $this->render('Product/viewing.html.twig');
    }

    public function login(): Response
    {
        return $this->render('Product/login.html.twig');
    }

    public function about(): Response
    {
        return $this->render('Product/about.html.twig');
    }

    public function cart(): Response
    {
        return $this->render('Product/cart.html.twig');
    }

}