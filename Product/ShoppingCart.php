<?php
namespace Product;
class ShoppingCart
{
    public array $items = [];
    public $name;


    public function addItem($product, $price, $quantity)
    {
        $this->items[] = ['name' => $product, 'price' => $price, 'quantity' => $quantity];

        foreach ($this->items as $item) {
            if ($item['name'] == $product) {
                $item['quantity']++;
            }
        }
    }

  //  public function getTotal()
   // {
    //    static $total = null;
    //    foreach ($this->items as $item) {
     //       if ($total == null) {
        //        $total = $total + $item['price'] * $item['quantity'];
     //       } elseif ($total != null) {
               //     return $total;
      //          }

     //       }
     //   }

    public function getTotal()
    {
       static $total = null;
       $total = 0;
       if ($total != null) {
           return $total;
       }
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }





        //     static $total = 0;
    //    if ($total = 0) {
     //       foreach ($this->items as $item) {
     //          $total = $total + $item['price'] * $item['quantity'];}
     //           if ($total > 0) {
     //               return $total;
         //       }
    //        }
  //  }
}

