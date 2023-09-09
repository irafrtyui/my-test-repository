<?php

class ShoppingCart {
    public $name;
    public $quantity;
    public array $items = [];

    public function addItem($name, $quantity) {
        if ($quantity > 0) {
            $this->items[] = ['name' => $name, 'quantity' => $quantity];
        }
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['name']->price * $item['quantity'];
        }
        return $total;
    }
}

