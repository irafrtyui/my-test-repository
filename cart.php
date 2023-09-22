
<?php

include 'Product\Product.php';
$products = file_get_contents('prod.txt');
$pr = unserialize($products);
include 'Product/ShoppingCart.php';

$shopcart = file_get_contents('cart.txt');
$shoppingcart = unserialize($shopcart);
if ($shoppingcart == false) {
    $shoppingcart = new Product\ShoppingCart();
}

if (array_key_exists('products', $_GET) && strlen($_GET['products']) > 0) {
    $c = $_GET['products'];
    foreach ($pr as $p) {
        if ($c === $p->name) {
            $shoppingcart->addItem($c, $p->price, 1);
        }
    }
}
file_put_contents('cart.txt',serialize($shoppingcart));

header('Location: program.php');

