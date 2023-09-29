<?php
namespace Product;

class Product {
    public $image;
    public $name;
    public $price;
    public $weight;
    public $vegan;
    public $property;


    public function __construct($image, $name, $price, $weight, $vegan, $property)
    {
        $this->image = $image;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
        $this->vegan = $vegan;
        $this->property = $property;
    }
    public static function create($image, $name, $price, $weight, $vegan, $property)
    {
       return new Product($image, $name, $price, $weight, $vegan, $property);
    }
    public function __toString():string
    {
        return $this->name;
    }

    public function GetVeganAndProperty() {
        return $this->vegan . '|' . $this->property;
    }
}

