<?php
if(isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

if(isset($_POST['submit-login'])) {
    if(!isset($_POST['email']) || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) { $errors['email'] = 'Введите коректный e-mail'; }
    if(strlen($_POST['email']) > 45) { $errors['email'] = 'Длинна логина не может быть больше 45-ти символов'; }
    $ask = q("
    SELECT * FROM `users` WHERE `email` = '".db_secur($_POST['email'])."' LIMIT 1
    ");
    if($ask->num_rows) { $errors['email'] = 'Такой E-mail уже зарегистрирован в системе'; }
    if(empty($_POST['password']) || strlen($_POST['password']) <= 4 || strlen($_POST['password']) > 30) { $errors['password'] = true; }
    if(empty($_POST['name']) || strlen($_POST['name']) <= 2 || strlen($_POST['name']) > 30) { $errors['name'] = true; }
    if(empty($_POST['message'])) { $errors['message'] = true; }

    if(!isset($errors)) {
        q("
        INSERT INTO `users` SET
        `login`            = '".db_secur($_POST['name'])."',
        `pass`             = '".crypter($_POST['password'])."',
        `email`            = '".db_secur($_POST['email'])."',
        `descr`            = '".db_secur($_POST['message'])."'
        ");

        header('Location: /login');
        exit;
    }
}

