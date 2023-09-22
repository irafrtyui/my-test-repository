<?php
include 'Product/ShoppingCart.php';
$shoppingcart = unserialize(file_get_contents('cart.txt'));

//var_dump($shoppingcart);


if (array_key_exists('delete', $_GET) && strlen($_GET['delete']) > 0) {
    $c = $_GET['delete'];
    foreach ($shoppingcart->items as $p) {
        if ($c === $p['name']) {
            //
        } else {
            unset ($p['name']);
        }
}
}


$s = serialize($shoppingcart->items);
file_put_contents('cart.txt', $s);

header('Location: cart1.php');