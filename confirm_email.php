<?php
session_start();
require_once 'db.php';
$db = $_SESSION['db'];

$show_form = False;

if ($_GET['email_hash']) {
    $email_hash = $db->real_escape_string($_GET['email_hash']);
    $_SESSION['email_hash'] = $email_hash;

    $db_email = $db->query("SELECT `id`, `password`, `confirmed_email` FROM `users` WHERE `email_hash`='" . $email_hash . "'");
    if ($db_email) {
        if ($db_email->num_rows === 0) {
            $reg_msg = "Такой email не зарегистрирован. Введите свой email на главной странице.";
            header("Refresh: 1; URL=http://it-co/index.php");
        } else {
            while ($row = $db_email->fetch_assoc()) {
                // Сообщение по-умолчанию
                $reg_msg = "Email подтверждён";
                $show_form = True;

                // Если email еще не подтвержден, то подтверждаем
                if ($row['confirmed_email'] == 1) {
                    $db->query("UPDATE `users` SET `confirmed_email` = 0 WHERE `id`=" . $row['id']);
                }

                // Если пароль был добавлен
                if ($row['password'] !== "NULL") {
                    $reg_msg = "Пользователь с этим email уже зарегистрирован.";
                    $show_form = False;
                    header("Refresh: 1; URL=http://it-co/index.php");
                }
            }
        }
    } else {
        $reg_msg = "Ошибка БД. Попробуйте еще раз.";
    }

} else {
    $reg_msg = "Некорректная ссылка. Перейдите по ссылке, отправленной на электронную почту.";
}

$_SESSION['reg_msg'] = $reg_msg;
$_SESSION['show_form'] = $show_form;

