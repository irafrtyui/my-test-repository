<?php

class ShoppingCart {
    public array $items = [];


    public function addItem($product, $quantity) {
            $this->items[] = ['name' => $product, 'quantity' => $quantity];

            foreach($this->items as $item){
                if ($item['name'] == $product) {
                    $item['quantity']++;
                }
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




