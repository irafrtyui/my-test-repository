<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController
{
    public function show($id, $page): Response
    {
        return new Response('show products' . $id . $page);
    }

    public function sort($id): Response
    {
        return new Response('Sort Products' . $id);
    }

    public function add(): Response
    {

    return new Response('Add');
    }

    public function search($keywords): Response
    {
        return new Response('Search Product' . $keywords);
    }

    public function viewing($id): Response
    {
        return new Response('Viewing Product' . $id);
    }




}