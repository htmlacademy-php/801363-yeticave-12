<?php
if(!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
}
//wtf($_POST);
if(isset($_POST['submit-lot'])) {
    if(empty($_POST['lot-name'])) { $errors['lot-name'] = true; }
    if(empty($_POST['category']) || (int)$_POST['category'] == -1) { $errors['category'] = true; }
    if(empty($_POST['message'])) { $errors['message'] = true; }
    if(empty($_POST['lot-rate']) || (int)$_POST['lot-rate'] == 0) { $errors['lot-rate'] = true; }
    if(empty($_POST['lot-step']) || (int)$_POST['lot-step'] == 0) { $errors['lot-step'] = true; }
    if(empty($_POST['lot-date']) || $_POST['lot-date'] <= date('Y-m-d')) { $errors['lot-date'] = true; }

    $accept = ['image/jpeg', 'image/jpg', 'image/png'];

    if(!isset($_FILES) || $_FILES['lot-img']['error'] !== 0 || !in_array(mime_content_type($_FILES['lot-img']['tmp_name']), $accept)) {
        $errors['lot-img'] = true;
    }

    if(!isset($errors)) {
        $exp = explode('/', mime_content_type($_FILES['lot-img']['tmp_name']))[1];
        $id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : rand(100000, 999999);  // тянем id если есть
        $name = date('Ymd-His') . '_id-' . $id . '-' . rand(100000, 999999) . '.' . mb_strtolower($exp);

        if(move_uploaded_file($_FILES['lot-img']['tmp_name'], './img/'.$name)) {
            q("
            INSERT INTO `lotes` SET
            `id_parent`            = -1,
            `name`                 = '".db_secur($_POST['lot-name'])."',
            `cat`                  = ".(int)$_POST['category'].",
            `text`                 = '".db_secur($_POST['message'])."',
            `begin_cost`           = '".db_secur($_POST['lot-rate'])."',
            `cost`                 = '".db_secur($_POST['lot-step'])."',
            `date_end`             = '".db_secur($_POST['lot-date'])."',
            `img`                  = 'img/".$name."'
            ");

            $id = (int)DB::_()->insert_id;  // последний запрос последний id
            header('Location: /lot/'.$id);
            exit;
        }
    }
}

