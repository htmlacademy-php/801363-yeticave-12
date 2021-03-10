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
        `pass`  = '".crypter($_POST['password'])."'
        LIMIT 1
        ");

        if($ask->num_rows) {
            session_start();
            $_SESSION['user'] = $ask->fetch_assoc();

//            wtf($_SESSION);
            header('Location: /');
            exit;
        } else {
            $errors['password'] = 'Такой связки ПОЧТА и ПАРОЛЬ - не найдены!..';
        }
    }

}
?>

<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <form class="form container <?php if(isset($errors)) { echo 'form--invalid'; } ?>" method="post"> <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?php if(isset($errors['email'])) { echo 'form__item--invalid'; } ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" value="<?=@$_POST['email']?>" placeholder="Введите e-mail">
            <span class="form__error">Введите e-mail</span>
        </div>
        <div class="form__item form__item--last <?php if(isset($errors['password'])) { echo 'form__item--invalid'; } ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" value="<?=@$_POST['password']?>" placeholder="Введите пароль">
            <span class="form__error"><?=$errors['password']?></span>
        </div>
        <button type="submit" name="submit-auth" class="button">Войти</button>
    </form>
</main>
