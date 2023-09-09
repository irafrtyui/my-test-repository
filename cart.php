<?php
include 'classcart.php';
$ShoppingCart = unserialize(file_get_contents('cart.txt'));
 ?>
</form>
<table width="500px" border="1" cellpadding="5">
    <tr>
       <td><b>Name</b></td><td><b>Quantity</b></td>
    </tr>
<?php foreach ($ShoppingCart as $product): ?>
    <tr>
        <td><?php echo $product->name ?></td>
        <td><?php echo $product->quantity?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="6">Total price</td>
    </tr>
</table>
    <a href="program.php">Back</a>
