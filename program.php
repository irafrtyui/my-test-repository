<?php
// чтение из файла, преобразование в массив продуктов
//$product = file_get_contents('prod.txt');
include 'C:\Users\HP\PhpstormProjects\my-test-repository\cards\class0.php';
$product = file_get_contents('prod.txt');
$products = unserialize($product);

// сортировка по возрастанию
function sortarray($array){
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


// GET - запрос
if (array_key_exists('keywords', $_GET) && strlen($_GET['keywords']) > 0) {
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

?>


<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>
<form method="get">
    <label> Search:
        <input type="text" name="keywords" value="" placeholder="ex. milk">
    </label>
    <button type="submit">SEARCH</button>
    <a href="create1.php">Create a new record</a>
</form>
<table width="500px" border="1" cellpadding="5">
    <tr>
        <td><b></b></td><td><b>Name</b></td><td><b>Price</b></td><td><b>Weight</b></td><td><b>Vegan</b></td><td><b>Property</b></td>
    </tr>
    <?php foreach ($pro as $v): ?>
        <tr>
            <td><img src="cards/<?php echo $v->image ?>" width="100px"</td><td><?php echo $v->name ?></td><td><?php echo '$' . $v->price ?></td><td><?php echo $v->weight?></td><td><?php echo $v->vegan?></td><td><?php echo $v->property?></td>
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
        <td colspan="6"><?php echo 'Total price = ' . sum($pro);?></td>
    </tr>
</table>

<?php for($k = 1; $k <= $PagesCount; $k++){
    echo "<a href=\"?page=$k\">$k </a>";
}
?>
