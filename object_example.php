<?php

class products {
    public $name;
    public $price;
    public $weight;
}

$milk = new products();
$milk->name = 'milk';
$milk->price = 40;
$milk->weight = 2000;

$bread = new products();
$bread->name = 'bread';
$bread->price = 15;
$bread->weight = 3000;

$chocolate = new products();
$chocolate->name = 'chocolate';
$chocolate->price = 35;
$chocolate->weight = 400;

$chicken = new products();
$chicken->name = 'chicken';
$chicken->price = 50;
$chicken->weight = 4000;

function ShowProducts (Products $a) {
    echo 'name = ' . $a->name . ', price = ' . $a->price . ', weight = ' . $a->weight . "\n";
}

ShowProducts($milk);
ShowProducts($bread);
ShowProducts($chocolate);
ShowProducts($chicken);