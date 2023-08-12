<?php

$content = file_get_contents('prod.txt');
$p = unserialize($content);
if (count($_POST) > 0) {
    $p[] = ['name' => $_POST['name'],
            'price' => $_POST['price'],
            'weight' => $_POST['weight'],
            'vegan' => $_POST['vegan'],
            'property' => $_POST['property'] ?? []];
    file_put_contents('prod.txt', serialize($p));

    header('Location: index.php');
}
//var_dump($_FILES);
if (count($_FILES) > 0) {
    move_uploaded_file($_FILES['image']['tmp_name'], 'cards/' . $_FILES['image']['name'] );
}
?>

<form method="post">
    <br/>
    <label>Name:
        <input name= "name" />
    </label>
    <label>Price:
        <input name= "price" />
    </label>
    <label>Weight:
        <input name="weight" />
    </label>
    <a href="index.php">Back</a>

    <br/>
    <br/>
    <select name="vegan">
        <option>Vegan</option>
        <option>Non-vegan</option>
    </select>
    <br/>
    <br/>
    <input type="checkbox" name="property[]" value="vegetables"/> Vegetables
    <br/>
    <input type="checkbox" name="property[]" value="fruits"/> Fruits
    <br/>
    <input type="checkbox" name="property[]" value="dairy"/> Dairy
    <br/>
    <input type="checkbox" name="property[]" value="cereals"/> Cereals
    <br/>
    <input type="checkbox" name="property[]" value="water"/> Water
    <br/>
    <input type="checkbox" name="property[]" value="sweets"/> Sweets
    <br/>
    <br/>
<h>Enter your details</h>
    <br/>
    <br/>
    <label>Data
    <input type="text" name="data" value="" placeholder="ex. Ivan Petrov">
    </label>
    <br/>
    <br/>
    <label>E-mail
        <input type="email" name="email" value="" placeholder="ex. ivanpetrov@gmail.com">
    </label>
    <br/>
    <br/>
    <label>Your phone number
        <input type="tel" name="number" value="" placeholder="ex. +380508888888">
    </label>
    <br/>
    <br/>
    Gender
    <input type="radio">Male
    <input type="radio">Female
    <br/>
    <br/>
    <button type="submit">SAVE</button>
</form>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" />
    <button type="submit">Send!</button>
</form>