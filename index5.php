<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'autoload.php';

$milk = Product\Product::create('milk.png', 'milk', 40,2000, 'vegan', 'dairy');

$bread = Product\Product::create('bread.jpeg','bread', 15, 3000,'vegan', 'cereals');

$chocolate = Product\Product::create('chocolate.jpg', 'chocolate',35, 400, 'non-vegan', 'sweets');

$chicken = Product\Product::create('chiken.jpg','chicken',50, 4000, 'non-vegan', 'meat');

 $p = [$milk, $bread, $chocolate, $chicken];

file_put_contents('prod.txt',serialize($p));
