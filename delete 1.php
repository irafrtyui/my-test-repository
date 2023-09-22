<?php
include 'ShoppingCart.php';
$shoppingcart = unserialize(file_get_contents('cart.txt'));


if (array_key_exists('delete', $_GET) && strlen($_GET['delete']) > 0) {
    $c = $_GET['delete'];
    foreach ($shoppingcart->items as $p) {
        if ($c === $p['name']) {
            //
        } else {
            unset ($p);
        }
    }
}

//$s = serialize($shoppingcart->items);
//file_put_contents('cart.txt', $s);
