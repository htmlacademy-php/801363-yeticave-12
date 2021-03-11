<?php
if(isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

if(isset($_POST['submit-login'])) {
    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { $errors['email'] = 'Введите коректный e-mail'; }
    $ask = q("
    SELECT * FROM `users` WHERE `email` = '".db_secur($_POST['email'])."' LIMIT 1
    ");
    if($ask->num_rows) { $errors['email'] = 'Такой E-mail уже зарегистрирован в системе'; }
    if(empty($_POST['password']) || strlen($_POST['password']) <= 4) { $errors['password'] = true; }
    if(empty($_POST['name']) || strlen($_POST['name']) <= 2) { $errors['name'] = true; }
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
?>

<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <form class="form container <?php if(isset($errors)) { echo 'form--invalid'; }?>" method="post" autocomplete="off"> <!-- form
    --invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?php if(isset($errors['email'])) { echo 'form__item--invalid'; } ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" value="<?=@$_POST['email']?>" placeholder="Введите e-mail">
            <span class="form__error"><?=@$errors['email']?></span>
        </div>
        <div class="form__item <?php if(isset($errors['password'])) { echo 'form__item--invalid'; } ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" value="<?=@$_POST['password']?>" placeholder="Введите пароль">
            <span class="form__error">Пароль должен содержать 5 и более символов</span>
        </div>
        <div class="form__item <?php if(isset($errors['name'])) { echo 'form__item--invalid'; } ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="name" value="<?=@$_POST['name']?>" placeholder="Введите имя">
            <span class="form__error">Имя должно содержать 2 и более символов</span>
        </div>
        <div class="form__item <?php if(isset($errors['message'])) { echo 'form__item--invalid'; } ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=@$_POST['message']?></textarea>
            <span class="form__error">Напишите как с вами связаться</span>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button" name="submit-login">Зарегистрироваться</button>
        <a class="text-link" href="login">Уже есть аккаунт</a>
    </form>
</main>
