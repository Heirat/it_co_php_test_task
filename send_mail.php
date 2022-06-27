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

    // Если ошибок нет, то отправляем письмо
    if (!$msg) {
        $email = $db->real_escape_string($_POST['email']);
        $email_hash = $db->real_escape_string(md5($email . time()));

        // Проверяем, что такой email не был добавлен в бд ранее
        $result = $db->query("SELECT `id` FROM `users` WHERE `email`='" . $email . "'");
        if ($result->num_rows === 0) {
            // Переменная $headers нужна для Email заголовка
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "To: <$email>\r\n";
            $headers .= "From: <mail@it-co.com>\r\n";
            // Сообщение для Email
            $message = '
                <html lang="ru">
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Чтобы закончить регистрацию, перейдите по <a href="it-co/registration.php?email_hash=' . $email_hash . '">ссылкe</a></p>
                </body>
                </html>
                ';

            // Добавление пользователя в БД
            $db_insert = $db->query("INSERT INTO `users` (`email`, `password`, `email_hash`, `confirmed_email`) VALUES ('" . $email . "', 'NULL', '" . $email_hash . "', 1)");
            if ($db_insert) {
                if (mail($email, "Подтвердите Email на it-co", $message, $headers)) {
                    $msg = 'Перейдите по ссылке из письма, отправленного на почту.';
                    //$msg = "it-co/registration.php?email_hash=" . $email_hash;
                }
            } else {
                $msg = "Ошибка: Не удалось добавить email в базу данных.";
            }
        } else {
            $msg = "На этот email уже отправлено письмо для подтверждения.";
        }
    }
    $_SESSION['msg'] = $msg;
    header("Location: index.php");
}
