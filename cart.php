<?php
include 'cards\class0.php';
$products = file_get_contents('prod.txt');
$pr = unserialize($products);
include 'classcart.php';
$cart = new ShoppingCart();
$q = 1;
if (array_key_exists('products', $_GET) && strlen($_GET['products']) > 0) {
    $c = $_GET['products'];
    foreach ($pr as $p) {
        if ($c === $p->name) {
            $cart->addItem($c, $q++);
        }
    }
}
file_put_contents('cart.txt',serialize($cart));

