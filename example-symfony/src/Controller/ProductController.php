<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function show($id, $page): Response
    {
        return $this->render('Product/show.html.twig');
    }

    public function sort($id): Response
    {
        return $this->render('Product/sort.html.twig');
    }

    public function add(): Response
    {

        return $this->render('Product/add.html.twig');
    }

    public function search($keywords): Response
    {
        return $this->render('Product/search.html.twig');
    }

    public function viewing($id): Response
    {
        return $this->render('Product/viewing.html.twig');
    }




}