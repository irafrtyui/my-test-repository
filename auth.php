<?php

session_start();
if (false === array_key_exists('access', $_SESSION)) {
    header('Location: /login.php');
    die('Exit');
}
?>
<a href="logout.php">Logout</a>
