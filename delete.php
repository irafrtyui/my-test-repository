<?php
include 'autoload.php';
$shoppingcart = unserialize(file_get_contents('cart.txt'));

if (array_key_exists('delete', $_GET) && strlen($_GET['delete']) >= 0) {
    $c = $_GET['delete'];
    foreach ($shoppingcart->items as $i => &$p) {
        if ($c === $p['name'] && $p['quantity'] > 0) {
            $p['quantity']--;
        }
        if ($p['quantity'] == 0) {
            unset($shoppingcart->items[$i]);
        }
    }
}
    $s = serialize($shoppingcart);
    file_put_contents('cart.txt', $s);


header('Location: /cart1.php');