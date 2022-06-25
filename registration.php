<?php
session_start();
require_once 'db.php';
$db = $_SESSION['db'];

if (isset($_GET['passw_conf'])) {
	header("Refresh: 1 URL=http://it-co/index.php");
} else {
    require_once 'confirm_email.php';
}
// Сообщение над формой
$reg_msg = $_SESSION['reg_msg'];
// Флаг показа формы
$show_form = $_SESSION['show_form'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация</title>
	<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon">
	<link type="Image/x-icon" href="img/favicon.ico" rel="icon">
	<link rel="stylesheet" href="styles/registration.css">
</head>
<body>

<div class="info">
	<p class="msg"><?= $reg_msg ?></p>
    <?php if ($show_form): ?>
		<form action="reg_submit.php" method="post" class="registration">
			<p>
				<label>Пароль <input type="text" name="password" placeholder="Введите пароль" required
				                     minlength="4"></label>
			</p>
			<p>
				<input type="submit" value="Зарегистрироваться" name="reg">
			</p>
		</form>
    <?php endif; ?>
</div>
</body>
