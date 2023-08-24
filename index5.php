<?php
include 'cards/class0.php';
//include 'C:\Users\HP\PhpstormProjects\my-test-repository\cards\class0.php';
$milk = new Product();
$milk->image = 'milk.png';
$milk->name = 'milk';
$milk->price = 40;
$milk->weight = 2000;
$milk->vegan = 'vegan';
$milk->property = 'dairy';

$bread = new Product();
$bread->image = 'bread.jpeg';
$bread->name = 'bread';
$bread->price = 15;
$bread->weight = 3000;
$bread->vegan = 'vegan';
$bread->property = 'cereals';

$chocolate = new Product();
$chocolate->image = 'chocolate.jpg';
$chocolate->name = 'chocolate';
$chocolate->price = 35;
$chocolate->weight = 400;
$chocolate->vegan = 'non-vegan';
$chocolate->property = 'sweets';

$chicken = new Product();
$chicken->image = 'chiken.jpg';
$chicken->name = 'chicken';
$chicken->price = 50;
$chicken->weight = 4000;
$chicken->vegan = 'non-vegan';
$chicken->property = 'meat';

 $p = [$milk, $bread, $chocolate, $chicken];
file_put_contents('prod.txt',serialize($p));