<?php
include 'autoload.php';

$milk = Product\Product::create('milk', 40,2000, 'vegan', 'dairy');
$milk->image = 'milk.png';


$bread = Product\Product::create('bread', 15, 3000,'vegan', 'cereals');
$bread->image = 'bread.jpeg';


$chocolate = Product\Product::create('chocolate',35, 400, 'non-vegan', 'sweets');
$chocolate->image = 'chocolate.jpg';


$chicken = Product\Product::create('chicken',50, 4000, 'non-vegan', 'meat');
$chicken->image = 'chiken.jpg';


 $p = [$milk, $bread, $chocolate, $chicken];


file_put_contents('prod.txt',serialize($p));
