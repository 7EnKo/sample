<?php
    $user = 'root';
    $bd = 'dumpbd';
    $pass = '';
    $host = 'localhost';
    $dsn = 'mysql:host=' . $host . ';dbname=' . $bd;
    $pdo = new PDO($dsn, $user, $pass);
?>