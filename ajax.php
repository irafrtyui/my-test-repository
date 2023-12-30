<?php
include 'autoload.php';
$sql = 'SELECT * FROM product ';
if (array_key_exists('keywords', $_GET) && strlen($_GET['keywords']) > 0) {
    $q = $_GET['keywords'];
    $sql = $sql . 'WHERE name = "' . addslashes($q) . '"';
    }

$result = $pdo->query($sql);
$prod = [];
foreach ($result as $item){
    $product = Product\Product::create($item['image'], $item['name'], $item['price'],$item['weight'], $item['vegan'], $item['property']);
    $prod[] = $product;
}


?>
<table width="500px" border="1" cellpadding="5">

    <?php foreach ($prod as $v): ?>
        <tr>
            <td><?php if(strlen($v->image) > 0): ?> <img src="cards/<?php echo $v->image ?>" width="100px"/></td> <?php endif; ?>
            <td><?php echo $v ?></td>
            <td>$<?php echo $v->price ?></td>
            <td><?php echo $v->weight?></td>
            <td><?php echo $v->GetVeganAndProperty()?></td>
            <td><a href="/cart.php?products=<?php echo $v ?>" <b>Add</b></a></td>
        </tr>
    <?php endforeach; ?>
    <table/>

