<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <form class="form form--add-lot container <?php if(isset($errors)) { echo 'form--invalid'; } ?>" enctype="multipart/form-data" action="/add" method="post"> <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item <?php if(isset($errors['lot-name'])) { echo 'form__item--invalid'; } ?>"> <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" value="<?=@$_POST['lot-name']?>" placeholder="Введите наименование лота">
                <span class="form__error">Введите наименование лота</span>
            </div>
            <div class="form__item <?php if(isset($errors['category'])) { echo 'form__item--invalid'; } ?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="-1">Выберите категорию</option>
                    <?php foreach($cats as $v):?>
                    <option value="<?=(int)$v['id']?>" <?php if(isset($_POST['category']) && $_POST['category'] === $v['id']) { echo 'selected'; } ?>><?=$v['name']?></option>
                    <?php endforeach; ?>
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>
        <div class="form__item form__item--wide <?php if(isset($errors['message'])) { echo 'form__item--invalid'; } ?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите описание лота"><?=@$_POST['message']?></textarea>
            <span class="form__error">Напишите описание лота</span>
        </div>
        <div class="form__item form__item--file <?php if(isset($errors['lot-img'])) { echo 'form__item--invalid'; } ?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" accept="image/jpeg,image/png" name="lot-img" id="lot-img" value="">
                <label for="lot-img">
                    Добавить
                </label>
            </div>
            <span class="form__error">Загрузите изображение лота</span>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small <?php if(isset($errors['lot-rate'])) { echo 'form__item--invalid'; } ?>">
                <label for="lot-rate">Начальная цена <sup>*</sup></label>
                <input id="lot-rate" type="text" name="lot-rate" value="<?=@$_POST['lot-rate']?>" placeholder="0">
                <span class="form__error">Введите начальную цену</span>
            </div>
            <div class="form__item form__item--small <?php if(isset($errors['lot-step'])) { echo 'form__item--invalid'; } ?>">
                <label for="lot-step">Шаг ставки <sup>*</sup></label>
                <input id="lot-step" type="text" name="lot-step" value="<?=@$_POST['lot-step']?>" placeholder="0">
                <span class="form__error">Введите шаг ставки</span>
            </div>
            <div class="form__item <?php if(isset($errors['lot-date'])) { echo 'form__item--invalid'; } ?>">
                <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="lot-date" type="text" name="lot-date" value="<?=@$_POST['lot-date']?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                <span class="form__error">Введите дату завершения торгов</span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" name="submit-lot" class="button">Добавить лот</button>
    </form>
</main>
