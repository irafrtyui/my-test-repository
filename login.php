
<html>
<body>
<form method="post" action="login.php">
    Login: <input type="text" name="login">
    Password: <input type="text" name="Password">

    <button type="submit" >Enter</button>

</form>
</body>
</html>
<?php
session_start();
if (array_key_exists('login', $_POST) && array_key_exists('password', $_POST)){
    $user = 'SELECT * FROM user';
    $user = $user . 'WHERE login = "' . $_POST['login'] . '"';
    $user = $user . 'WHERE password = "' . $_POST['password'] . '"';
    $_SESSION['access'] = 'ОК!';
    $_SESSION['user'] = $user;

    header('Location: /create1.php');
    exit();
}
?>