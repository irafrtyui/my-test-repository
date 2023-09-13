<?php

include 'classcart.php';
$shopcart = file_get_contents('cart.txt');
$cart = unserialize($shopcart);



?>
    <table width="500px" border="1" cellpadding="5">
    <tr>
<td><b>Name</b></td><td><b>Quantity</b></td>
    </tr>
<?php foreach ($cart->items as $item): ?>
    <tr>
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['quantity'] ?></td>
    </tr>
<?php endforeach; ?>