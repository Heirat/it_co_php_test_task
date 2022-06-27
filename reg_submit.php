<?php
session_start();
require_once 'db.php';
$db = $_SESSION['db'];

// Обработка отправки формы Зарегистрироваться
if (isset($_POST['password'])) {
	if (isset($_SESSION['email_hash'])) {
		$password = $db->real_escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT));

		$_SESSION['password'] = $password;

		$db->query("UPDATE `users` SET `password` = '". $password ."' WHERE `email_hash`='". $_SESSION['email_hash'] ."'");

		$reg_msg = "Вы успешно зарегистрированы!";		
	} else {
		$reg_msg = "Данные устарели. Перейдите по ссылке на почте ещё раз.";
	}
    $_SESSION['reg_msg'] = $reg_msg;
    $_SESSION['show_form'] = False;
    header("Location:http://it-co/registration.php?passw_conf=1");
}

