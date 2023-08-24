<?php
class Product {
    public $image;
    public $name;
    public $price;
    public $weight;
    public $vegan;
    public $property;

    public function GetVeganAndProperty() {
        return $this->vegan . '|' . $this->property;
    }
}