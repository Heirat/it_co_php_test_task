<?php
session_start();
require_once 'db.php';

$db = $_SESSION['db'];

// в msg сообщение из сессии, если оно задано, иначе пустая строка
$msg = $_SESSION['msg'] ?? '';

// Если пользователь авторизован в текущей сессии
if (isset($_SESSION['email_hash'], $_SESSION['password'])) {
	$msg = '';
	$is_logged = True;
}


?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Тестовое задание Червинский Артём</title>
	<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon">
	<link type="Image/x-icon" href="img/favicon.ico" rel="icon">
	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="styles/index.css">
</head>

<body>
<header class="header">
<?php if ($is_logged): ?>
		<img src="img/user.svg" title="Вы успешно авторизованы" class="login" alt="Вы успешно авторизованы">
<?php endif; ?>
	<ul class="nav">
		<li class="nav__item"><a href="" class="link">HOME</a></li>
		<li class="nav__item"><a href="" class="link">ABOUT</a></li>
		<li class="nav__item logo">
			<img src="img/logo-1.svg" alt="Logo" class="logo__img">
		</li>
		<li class="nav__item"><a href="" class="link">SERVICE</a></li>
		<li class="nav__item"><a href="" class="link">CONTACT</a></li>
	</ul>
	<div class="nav_mobile">
		<div class="logo"><img src="img/logo-1.svg" alt="Logo" class="logo__img"></div>
		<div class="menu">
			<div class="overlay invisible"></div>
			<input id="menu__toggle" type="checkbox"/>
			<label class="menu__btn" for="menu__toggle">
				<span></span>
			</label>
			<div class="menu__box">
				<ul>
					<a href="" class="link menu__item">HOME</a>
					<a href="" class="link menu__item">ABOUT</a>
					<a href="" class="link menu__item">SERVICE</a>
					<a href="" class="link menu__item">CONTACT</a>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="hero">
		<h1 class="hero__text">I am Open Sans 120px</h1>
	</div>
</header>

<main class="main">
	<h2 class="heading">I am open sans extra bold 48px</h2>
	<h3 class="subheading">Please follow all directions, make fonts the same size, respect margins and spacing.</h3>
	<section class="gallery">
		<img src="img/1.jpg" alt="" class="gallery__pic">
		<img src="img/2.jpg" alt="" class="gallery__pic">
		<img src="img/3.jpg" alt="" class="gallery__pic">
	</section>
</main>

<?php if (!$is_logged): ?>
<div class="info">
	<p class="msg"> <?= $msg ?></p>
	<form action="send_mail.php" method="post">
		<p><label> Email: <input type="email" name="email" required> </label></p>
		<p><input type="submit" value="Отправить письмо на почту" name="send"></p>
	</form>
</div>
<?php endif; ?>
</html>