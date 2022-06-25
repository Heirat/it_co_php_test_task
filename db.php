<?php
session_start();
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'registration_itco';
 
$db = mysqli_connect($server, $user, $password, $db);
 
if (!$db) {
    echo "Не удается подключиться к серверу базы данных!";
    exit;
}

$_SESSION['db'] = $db;