<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;



class ProductController extends AbstractController
{
    public function show(Request $request, EntityManagerInterface $entityManager): Response
    {
        if($categoryId = $request->get('categoryId')){
        $products = $entityManager->getRepository(Product::class)->findBy([
            'category' => $categoryId
        ]);
        } else {
            $products = $entityManager->getRepository(Product::class)->findAll();
        }
        return $this->render('Product/show.html.twig', [
            'products' => $products
        ]);
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

    public function product_detail(int $id, EntityManagerInterface $entityManager): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);
        return $this->render('Product/product_detail.html.twig', [
            'product' => $product
        ]);
    }


    public function product_category(EntityManagerInterface $em): Response
    {
        //$categoryId = $request->get('categoryId');

        $category = $em->getRepository(Category::class)->findAll();
        return $this->render('Product/product_category.html.twig', [
            'category' => $category,
        ]);
    }

}
