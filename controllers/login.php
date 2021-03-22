<?php
if(isset($_POST['submit-auth'])) {
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = true;
    } elseif(empty($_POST['password']) || strlen($_POST['password']) <= 4) {
        $errors['password'] = 'Пароль должен содержать 5 и более символов';
    } else {
        $ask = q("
        SELECT * FROM `users` WHERE
        `email` = '".db_secur($_POST['email'])."' AND
        `pass`  = '".password_hash($_POST['password'], PASSWORD_DEFAULT, ['salt'=>Core::$SALT])."'
        LIMIT 1
        ");

        if($ask->num_rows) {
            $_SESSION['user'] = $ask->fetch_assoc();

            header('Location: /');
            exit;
        } else {
            $errors['password'] = 'Такой связки ПОЧТА и ПАРОЛЬ - не найдены!..';
        }
    }
}
