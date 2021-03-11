<?php
if(isset($_POST['create-rate'], $_SESSION['user'], $_POST['cost'], $two_cats)) {
    if((int)$_POST['cost'] < (int)$two_cats['cost'] + (int)$two_cats['begin_cost']) {
        $errors['cost'] = true;
    } else {
        q("
        UPDATE `lotes` SET `begin_cost` = ".(int)$_POST['cost']." WHERE
        `id` = ".(int)$two_cats['id']."
        ");

        q("
        INSERT INTO `rates` SET
        `lot_cost`         = ".(int)$_POST['cost'].",
        `id_user`          = ".(int)$_SESSION['user']['id'].",
        `id_lot`           = ".(int)$two_cats['id']."
        ");

        unset($_POST);
        header('Location: /lot/'.$two_cats['id']);
        exit;
    }
}

$end_time = format_time_lost($two_cats['date_end']);
$end_time[0] = str_pad($end_time[0], 2, "0", STR_PAD_LEFT);
$end_time[1] = str_pad($end_time[1], 2, "0", STR_PAD_LEFT);

$ask = q("
SELECT rates.*, users.id AS USER_ID, users.login FROM `rates`
LEFT JOIN `users`
ON rates.id_user = users.id
WHERE `id_lot` = ".(int)$two_cats['id']." ORDER BY `datatime` DESC
");
if($ask->num_rows) {
    while($row = $ask->fetch_assoc()) {
        $arr[] = $row;
    }
}

?>
  <main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <section class="lot-item container">
      <h2><?=$two_cats['name']?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="../<?=$two_cats['img']?>" width="730" height="548" alt="<?=$two_cats['name']?>">
          </div>
          <p class="lot-item__category">Категория: <span><?=$two_cats['CAT_NAME']?></span></p>
          <p class="lot-item__description"><?=out_secur($two_cats['text'])?></p>
        </div>
        <div class="lot-item__right">
          <div class="lot-item__state">
            <div class="lot-item__timer timer <?php if((int)$end_time[0] < 1) { echo 'timer--finishing'; } ?>">
                <?php if((int)$end_time[0] < 24) { ?>
                <?=$end_time[0].':'.$end_time[1]?>
                <?php } else { ?>
                > <?=floor($end_time[0]/24)?> сут.
                <?php } ?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=format_cost($two_cats['begin_cost'])?></span>
              </div>
              <div class="lot-item__min-cost">Мин. ставка <span><?=format_cost($two_cats['cost'])?></span>
              </div>
            </div>
            <form class="lot-item__form" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?php if(isset($errors)) { echo 'form__item--invalid'; } ?>"> <!--  form__item--invalid --!>
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" value="<?=@$_POST['cost']?>" placeholder="<?=format_cost_count(((int)$two_cats['cost']+(int)$two_cats['begin_cost']))?>">
                <span class="form__error">Введите коректную ставку</span>
              </p>
              <button type="submit" name="create-rate" class="button">Сделать ставку</button>
            </form>
          </div>
          <div class="history">
            <h3>История ставок (<span><?=isset($arr) ? count($arr) : 0; ?></span>)</h3>
              <?php if(isset($arr)): ?>
                <table class="history__list">
                    <?php foreach($arr as $v): ?>
                      <tr class="history__item">
                        <td class="history__name"><?=out_secur($v['login'])?></td>
                        <td class="history__price"><?=format_cost((int)$v['lot_cost'])?></td>
                        <td class="history__time">только что</td>
                      </tr>
                    <?php endforeach; ?>
                </table>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>
