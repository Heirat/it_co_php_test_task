<?php
session_start();
$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'registration_itco';
 
$db = new mysqli($server, $user, $password, $db_name);
 
if ($db->connect_error) {
    echo "Не удается подключиться к серверу базы данных!";
    exit;
}

$_SESSION['db'] = $db;