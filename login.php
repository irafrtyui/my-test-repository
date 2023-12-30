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
    $sql = 'SELECT * FROM user WHERE login = :login AND password = :password';
   // $sql = $sql . ' WHERE login = "' . addslashes($_POST['login']) . '"';
  //  $sql = $sql . ' AND password =  "' . MD5($_POST['password']) . '"';
$stm = $pdo->prepare($sql);
    $stm->bindValue(':login', $_POST['login']);
    $stm->bindValue(':password', md5($_POST['password']));
    $stm->execute();
    $user = $stm->fetch();
    foreach ($user as $item){
        $_SESSION['user'] = $item;
    }
    if (array_key_exists('user', $_SESSION)) {
        $_SESSION['access'] = 'ОК!';
    }


    header('Location: /create1.php');
    exit();
}
?>