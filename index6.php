<?php

interface ShapeInterface {
    //public function __construct($name);
    public function Area(): int;
}

class Circle implements ShapeInterface {
    private $name = 'Circle';
    public $radius;

   // public function __construct($name) {
     //   $this->name = $name;
   // }
    public function Area(): int {
        return $this->radius * $this->radius * pi();
    }
}

class Rectangle implements ShapeInterface {
    private $name = 'Rectangle';
    public $lenght;
    public $width;


   // public function __construct($name) {
     //   $this->name = $name;
    //}
    public function Area(): int {
        return $this->lenght * $this->width;
    }
}

class Triangle implements ShapeInterface {
    private $name = 'Triangle';
    public $height;
    public $base;


   // public function __construct($name) {
    //    $this->name = $name;
    //}

    public function Area(): int {
    return (1/2) * $this->height * $this->base;
    }
}


$Circle = new Circle;
$Circle->radius = 16;

$Rectangle = new Rectangle;
$Rectangle->lenght = 10;
$Rectangle->width = 12;

$Triangle = new Triangle;
$Triangle->height = 9;
$Triangle->base = 8;

$Shape = [$Circle, $Rectangle, $Triangle];

    foreach ($Shape as $item) {
        if ($item instanceof ShapeInterface) {
            echo 'Type -' . $item->name . ', Area = ' .  $item->Area() . "\n";
}
    }




