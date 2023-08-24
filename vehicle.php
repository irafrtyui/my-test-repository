<?php
class Vehicle {
    public $brand;
    public $model;
    public $year;

    public function GetInformation() {
        echo $this->brand . ',' . $this->model . ',' . $this->year . "\n";
    }
}

class Car extends Vehicle{
    public $NDoors;
    public $engine;

    public function GetInformation() {
        echo $this->brand . ',' . $this->model . ',' . $this->year . ',' . $this->NDoors . ',' . $this->engine . "\n";
    }
}

class Bicycle extends Vehicle{
    public $type;
    public $NSpeeds;

    public function GetInformation() {
        echo $this->brand . ',' . $this->model . ',' . $this->year . ',' . $this->type . ',' . $this->NSpeeds . "\n";
    }
}


$mercedes = new Car();
$mercedes->brand = 'mercedes';
$mercedes->model = 'S-class';
$mercedes->year = 2021;
$mercedes->NDoors = 4;
$mercedes->engine = 'petrol';

$chevrolet = new Car();
$chevrolet->brand = 'chevrolet';
$chevrolet->model = 'Cruze';
$chevrolet->year = 2022;
$chevrolet->NDoors = 4;
$chevrolet->engine = 'diesel';

$BicycleOne = new Bicycle();
$BicycleOne->brand = 'Trek';
$BicycleOne->model = 'Bicycle';
$BicycleOne->year = 2023;
$BicycleOne->type = 'mountain';
$BicycleOne->NSpeeds = 8;

$mercedes->GetInformation();
$chevrolet->GetInformation();
$BicycleOne->GetInformation();
