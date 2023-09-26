<?php
namespace Product;
class ShoppingCart
{
    public array $items = [];
    public $name;


    public function addItem($product, $price, $quantity)
    {
    $found = false;
        foreach ($this->items as &$item) {
            if ($item['name'] == $product) {
                $item['quantity']++;
                $found = true;
            }
        }
        if ($found == false) {
            $this->items[] = ['name' => $product, 'price' => $price, 'quantity' => $quantity];
        }
    }


    public function getTotal()
    {
        static $total = null;
        if ($total != null) {
            return $total;
        }
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}





