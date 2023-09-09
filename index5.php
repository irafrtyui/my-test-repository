<?php
include 'cards/class0.php';
//include 'C:\Users\HP\PhpstormProjects\my-test-repository\cards\class0.php';
$milk = new Product('milk', 40,2000, 'vegan', 'dairy');
$milk->image = 'milk.png';


$bread = new Product('bread', 15, 3000,'vegan', 'cereals');
$bread->image = 'bread.jpeg';


$chocolate = new Product('chocolate',35, 400, 'non-vegan', 'sweets');
$chocolate->image = 'chocolate.jpg';


$chicken = new Product('chicken',50, 4000, 'non-vegan', 'meat');
$chicken->image = 'chiken.jpg';


 $p = [$milk, $bread, $chocolate, $chicken];


file_put_contents('prod.txt',serialize($p));
