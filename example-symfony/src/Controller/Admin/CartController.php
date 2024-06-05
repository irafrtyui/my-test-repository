<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Form\CartType;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_admin_cart_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        return $this->render('admin/cart/index.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_cart_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/cart/new.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cart_show', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager, Cart $cart): Response
    {
        $cartProducts = $entityManager->getRepository(CartProduct::class)->findBy([
            'cart' => $id]);

        return $this->render('admin/cart/show.html.twig', [
            'cart' => $cart,
            'cartProducts' => $cartProducts,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_cart_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_cart_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_cart_delete', methods: ['POST'])]
    public function delete(Request $request, Cart $cart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_cart_index', [], Response::HTTP_SEE_OTHER);
    }
}
