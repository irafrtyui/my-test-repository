<?php

include 'autoload.php';

//$product = file_get_contents('prod.txt');
//$products = unserialize($product);
$sql = 'SELECT * FROM product ';

/**
 * @burm
 ***************************************************
 * начиная от сюда
 * эта часть вся должна быть ДО вызова запроса, а у тебя была после
 *
 * ты сначала формируешь запрос, чтобы его вызвать и в зависимости от запроса
 * ты получишь тот или иной результат.
 *
 * а у тебя было, что ты вызвала запрос SELECT * FROM product ORDER BY price
 * получила результат,
 * и потом дописывается $sql переменную добавляя WHERE и LIMIT..
 * но результат к этому моменту уже получен, поэтому все что ты там конкатенировала уже ни на что не влияет
 */
if (array_key_exists('keywords', $_GET) && strlen($_GET['keywords']) > 0) {
    $q = addslashes($_GET['keywords']);
    $sql = $sql . 'WHERE name = "' . addslashes($q) . '"';
}

$sql .= ' ORDER BY price ';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
    if (isset($_COOKIE['page'])) {
        $page = $_COOKIE['page'];
    } else {
        $page = 1;
    }
}

setcookie('page', $page);
$NotesOnPage = 3;
$from = ($page-1) * $NotesOnPage;
$sql = $sql . 'LIMIT ' . $from . ',' . $NotesOnPage;
/**
 * @burm
 ***************************************************
 * заканчивая тут
 */


$result = $pdo->query($sql);
$prod = [];
foreach ($result as $item){
    $product = Product\Product::create($item['image'], $item['name'], $item['price'],$item['weight'], $item['vegan'], $item['property']);
    $prod[] = $product;
}




// сортировка по возрастанию
/*function sortarray($array){
    for ($i = 1; $i < count($array) - 1; $i++) {
        for ($j = 0; $j < count($array) - 1; $j++) {
            if (($array[$j]->price) > ($array[$j + 1]->price)) {
                $x = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $x;
            }
        }
    }
    return $array;
}
$prod = sortarray($products);
*/

// GET - запрос
/*if (array_key_exists('keywords', $_GET) && strlen($_GET['keywords']) > 0) {
    $q = $_GET['keywords'];
    foreach ($prod as $i => $v) {
        if (false !== strpos($v->name, $q)) {
//echo $v['name'];
        } else {
            unset($prod[$i]);
        }
    }
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

//$page = $_GET['page'];
//$page = 1;
$NotesOnPage = 2;
$from = ($page-1) * $NotesOnPage;
$count = count($prod);
$PagesCount = ceil($count / $NotesOnPage);

$pro = array_splice($prod, $from, $NotesOnPage);
//var_dump($product);
*/
?>


<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>
<form method="get">
    <label> Search:
        <input type="text" name="keywords" value="<?php echo htmlspecialchars($_GET['keywords']) ?? '' ?>" placeholder="ex. milk">
    </label>
    <button type="submit">SEARCH</button>
    <script src="jquery-3.7.1.min.js"></script>

    <a href="create1.php">Create a new record</a>
    <br/>
    <br/>
    <a href="cart1.php"><b>View Cart</b></a>

</form>
<div  id="content">
<table width="500px" border="1" cellpadding="5">
    <tr>
        <td><b></b></td><td><b>Name</b></td><td><b>Price</b></td><td><b>Weight</b></td><td><b>Vegan|Property</b></td><td><b>Add to cart</b></td>
    </tr>
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
    <?php function sum($array){
        $sum = 0;
        foreach ($array as $v) {
            $sum += $v->price;
        }
        return $sum;
    }
    ?>
    <tr>
        <td colspan="6">Total price = <?php echo sum($prod);?></td>
    </tr>
<table/>
<div/>
<?php
$sq = 'SELECT COUNT(*) FROM product';
$st = $pdo->prepare($sq);
$st->execute();
$count = $st->fetchColumn();
//$count = count($prod);
$PagesCount = ceil($count / $NotesOnPage);
for($k = 1; $k <= $NotesOnPage; $k++){
    echo "<a href=\"?page=$k\">$k </a>";
}
?>
    <script>
        $('input').on('input', function() {
            $.ajax({
                url:'ajax.php?keywords=' + $(this).val(),
                success: function(response) {
                    $('#content').html(response);

                }

            });
        })
    </script>
