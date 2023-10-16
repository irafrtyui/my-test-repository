<?php
$login = 'root';
$password = '';
$pdo = new PDO('mysql:host=localhost;dbname=project', $login, $password);

//PS C:\Users\HP\PhpstormProjects\Ira P> php .\autoload.php - тут файл
//PS C:\Users\HP\PhpstormProjects\my-test-repository>  - тут ты его пробовала запускать
spl_autoload_register(function($class){
    include $class . '.php';

});