<?php

$p = [['image' => 'milk.png', 'name' => 'milk', 'price' => 40, 'weight' => 2000, 'vegan' => 'non-vegan', 'property' => ['dairy']],
    ['image' => 'bread.jpeg', 'name' => 'bread', 'price' => 15, 'weight' => 3000, 'vegan' => 'vegan', 'property' => ['cereals']],
    ['image' => 'chocolate.jpg', 'name' => 'chocolate', 'price' => 35, 'weight' => 400, 'vegan' => 'non-vegan', 'property' => ['sweets']],
    ['image' => 'chiken.jpg', 'name' => 'chicken', 'price' => 50, 'weight' => 4000, 'vegan' => 'non-vegan', 'property' => ['meat']]];
file_put_contents('prod.txt',serialize($p));