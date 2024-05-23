<?php


namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartProduct;
use App\Entity\Product;
use App\Form\CartForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $price = 0;
        foreach ($list as $item){
            $price = $price + ($item['product']->getPrice() * $item['qty']);
        }

        return $this->render('Cart/viewCart.html.twig', [
            'list' => $list,
            'price' => $price,
        ]);
    }

    public function addCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        $found = false;
        foreach ($list as &$item) {
            if ($item['product']->getId() == $product->getId()) {
                $item['qty'] = $item['qty'] + 1;
                $found = true;
            }
        }
        if (false === $found) {
            $list[] = ['product' => $product, 'qty' => 1];
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }

    public function delCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        foreach ($list as $i => $item) {
            if ($item['product']->getId() == $product->getId() && $item['qty'] > 0) {
                $item['qty'] = $item['qty'] - 1;
                $list[$i] = $item;

            }
            if ($item['qty'] == 0) {
                unset($list[$i]);

            }
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }

    public function deleteCart(Product $product, Session $session)
    {
        $list = $session->get('cart', []);

        foreach ($list as $i => $item) {
            if ($item['product']->getId() == $product->getId()) {
                unset($list[$i]);
            }
        }
        $session->set('cart', $list);
        return $this->redirectToRoute('cart_viewCart');
    }

    public function checkout(Request $request, Session $session, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CartForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $form->getData();


            $list = $session->get('cart', []);
            $price = 0;
            foreach ($list as $item) {
                $product = $entityManager->getRepository(Product::class)->find($item['product']->getId());
                $price += $product->getPrice() * $item['qty'];
            }
            $cart->setPrice($price);
            $cart->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($cart);
            $entityManager->flush();

            foreach ($list as $item) {
                $product = $entityManager->getRepository(Product::class)->find($item['product']->getId());
                $cartProduct = new CartProduct();
                $cartProduct->setProduct($product);
                $cartProduct->setCart($cart);
                $cartProduct->setQty($item['qty']);

                $entityManager->persist($cartProduct);
                $entityManager->flush();
            }

            $session->set('cart', []);
            $this->addFlash('success', 'Your order is successful');
            return $this->redirectToRoute('default_home');
        }
        return $this->render('Cart/checkout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}