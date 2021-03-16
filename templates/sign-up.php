<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <form class="form container <?php if(isset($errors)) { echo 'form--invalid'; }?>" method="post" autocomplete="off"> <!-- form
    --invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?php if(isset($errors['email'])) { echo 'form__item--invalid'; } ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" value="<?=!empty($_POST['email']) ? out_secur($_POST['email']) : ''?>" placeholder="Введите e-mail">
            <span class="form__error"><?=!empty($errors['email']) ? out_secur($errors['email']) : ''?></span>
        </div>
        <div class="form__item <?php if(isset($errors['password'])) { echo 'form__item--invalid'; } ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" value="<?=!empty($_POST['password']) ? out_secur($_POST['password']) : ''?>" placeholder="Введите пароль">
            <span class="form__error">Пароль должен содержать от 5-ти до 30-ти символов</span>
        </div>
        <div class="form__item <?php if(isset($errors['name'])) { echo 'form__item--invalid'; } ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="name" value="<?=!empty($_POST['name']) ? out_secur($_POST['name']) : ''?>" placeholder="Введите имя">
            <span class="form__error">Имя должно содержать от 2-ух до 30-ти символов</span>
        </div>
        <div class="form__item <?php if(isset($errors['message'])) { echo 'form__item--invalid'; } ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=!empty($_POST['message']) ? out_secur($_POST['message']) : ''?></textarea>
            <span class="form__error">Напишите как с вами связаться</span>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button" name="submit-login">Зарегистрироваться</button>
        <a class="text-link" href="login">Уже есть аккаунт</a>
    </form>
</main>
