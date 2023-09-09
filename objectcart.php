<?php
include 'classcart.php';
$bag = new ShoppingCart();
$bag->name = 'bag';
$bag->quantity = '2';

$items = [$bag];
file_put_contents('cart.txt', serialize($items));