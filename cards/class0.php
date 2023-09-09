<?php
class Product {
    public $image;
    public $name;
    public $price;
    public $weight;
    public $vegan;
    public $property;

    public function __construct($name, $price, $weight, $vegan, $property)
    {
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
        $this->vegan = $vegan;
        $this->property = $property;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function GetVeganAndProperty() {
        return $this->vegan . '|' . $this->property;
    }
}

