<?php session_start(); ?>
<html>
<body>
<form method="post" action="login.php">
    Login: <input type="text" name="login">
    Password: <input type="text" name="password">

    <button type="submit" >Enter</button>

</form>
</body>
</html>
<?php
include 'autoload.php';
if (array_key_exists('login', $_POST) && array_key_exists('password', $_POST)){
    $sql = 'SELECT * FROM user ';
    $sql = $sql . ' WHERE login = "' . $_POST['login'] . '"';
    $sql = $sql . ' AND password =  "' . MD5($_POST['password']) . '"';
    $_SESSION['access'] = 'ОК!';

    $user = $pdo->query($sql);
    foreach ($user as $item){
        $_SESSION['user'] = $item;
    }


    header('Location: /create1.php');
    exit();
}
?>