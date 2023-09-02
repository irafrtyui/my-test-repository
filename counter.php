<?php
class Counter {
    public $value;



 public function __construct($value) {
     $this->value = $value;
 }

 public function increment() {
     $this->value += 1;
 }

    public function decrement() {
        $this->value -= 1;
    }

    private function getValue()
    {
        return $this->value;
    }
}

$value = new Counter(0);


$value->increment();
$value->increment();
$value->increment();
echo $value->getValue;
