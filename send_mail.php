<?php
session_start();
require_once 'db.php';

$db = $_SESSION['db'];

// Проверяем нажата ли кнопка отправки формы
if (isset($_POST['send'])) {
	$msg = '';
	// Проверка есть ли email
	if (!$_POST['email']) {
		$msg = 'Введите email';
	}

	// Если ошибок нет, то происходит регистрация
	if (!$msg) {
		$email = $_POST['email'];
        $email_hash = md5($email . time());
        $result = mysqli_query($db, "SELECT `id` FROM `users` WHERE `email`='" . $email . "'");
        if ($result->num_rows === 0) {


            // Переменная $headers нужна для Email заголовка
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "To: <$email>\r\n";
            $headers .= "From: <mail@it-co.com>\r\n";
            // Сообщение для Email
            $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Чтобы закончить процедуру регистрации, перейдите по <a href="it-co/registration.php?email_hash=' . $email_hash . '">ссылка</a></p>
                </body>
                </html>
                ';

            // Добавление пользователя в БД
            mysqli_query($db, "INSERT INTO `users` (`email`, `password`, `email_hash`, `confirmed_email`) VALUES ('" . $email . "', 'NULL', '" . $email_hash . "', 1)");
            // проверяет отправилась ли почта
            if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
                // Если да, то выводит сообщение
                $msg = 'Перейдите по ссылке из письма, отправленного на почту.';
                //debug
                //$msg = "it-co/registration.php?email_hash=" . $email_hash;
            }
        }
        else {
            $msg = "На этот email уже отправлено письмо для подтверждения.";
        }
	}
	$_SESSION['msg'] = $msg;
    header("Location: index.php");
}
