<?php


namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    public function cart(Session $session): Response
    {
        $list = $session->get('cart');
        return $this->render('Cart/cart.html.twig', [
            'list' => $list,
        ]);
    }

    public function viewCart(Session $session): Response
    {
        $list = $session->get('cart');

        return $this->render('Cart/viewCart.html.twig', [
            'list' => $list,
        ]);
    }

    public function addCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        $found = false;
        foreach($list as &$item) {
            if($item['product']->getId() == $product->getId()) {
                $item['qty'] = $item['qty'] + 1;
                $found = true;
            }
        }
        if(false === $found) {
            $list[] = ['product' => $product, 'qty' => 1];
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }

    public function delCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        foreach($list as &$item) {
            if($item['product']->getId() == $product->getId() && $item['qty'] > 0) {
                $item['qty'] = $item['qty'] - 1;

            }
            if($item['qty'] == 0) {
                unset($item);

            }
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }

    public function deleteCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        foreach($list as &$item) {
            if($item['product']->getId() == $product->getId()) {
                unset($item);
            }
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }
}