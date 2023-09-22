<?php

include 'Product\ShoppingCart.php';
$shopcart = file_get_contents('cart.txt');
$cart = unserialize($shopcart);
?>
    <table width="500px" border="1" cellpadding="5">
    <tr>
        <td><b>Name</b></td><td><b>Price</b></td><td><b>Quantity</b></td>
    </tr>
<?php foreach ($cart->items as $item): ?>
    <tr>
            <td><?php echo $item['name'] ?></td>
        <td><?php echo $item['price'] ?></td>
            <td><?php echo $item['quantity'] ?></td>
        <td><a href="delete.php?delete=<?php echo $item['name']?>" <b>Delete</b></a></td>
    </tr>
<?php endforeach; ?>

        <tr>
            <td colspan="6">Total price = <?php echo $total = $cart->getTotal(); ?></td>
        </tr>



        <a href="program.php">Come back</a>
        <br/>
        <br/>
