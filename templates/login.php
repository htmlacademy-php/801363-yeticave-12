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
