<?php
if(isset($_POST['submit-lot'])) {
    if(empty($_POST['lot-name'])) { $errors['lot-name'] = true; }
    if(empty($_POST['category']) || $_POST['category'] === 'Выберите категорию') { $errors['category'] = true; }
    if(empty($_POST['message'])) { $errors['message'] = true; }
    if(empty($_POST['lot-img'])) { $errors['lot-img'] = true; }
    if(empty($_POST['lot-rate']) || (int)$_POST['lot-rate'] == 0) { $errors['lot-rate'] = true; }
    if(empty($_POST['lot-step']) || (int)$_POST['lot-step'] == 0) { $errors['lot-step'] = true; }
    if(empty($_POST['lot-date']) || $_POST['lot-date'] <= date('Y-m-d')) { $errors['lot-date'] = true; }

}
?>

<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php foreach($cats as $v): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=$v['name']?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <form class="form form--add-lot container <?php if(isset($errors)) { echo 'form--invalid'; } ?>" action="/add" method="post"> <!-- form--invalid -->
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
                    <option>Выберите категорию</option>
                    <?php foreach($cats as $v):?>
                    <option <?php if(isset($_POST['category']) && $_POST['category'] === $v['name']) { echo 'selected'; } ?>><?=$v['name']?></option>
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
