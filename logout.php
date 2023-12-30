<?php
session_start();

//$name = $_SESSION['user']['login'];

session_destroy();
echo 'Bye';
?>

<br/>
<br/>
<a href="program.php">View products</a>