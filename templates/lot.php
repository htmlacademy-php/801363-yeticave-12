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
          <div class="lot-item__state" <?php if((int)$end_time[0] < 0 || empty($_SESSION['user'])) { echo 'style="pointer-events: none; opacity: 0.4;"'; } ?>>
            <div class="lot-item__timer timer <?php if((int)$end_time[0] < 0) { echo 'timer--end'; } elseif((int)$end_time[0] < 1) { echo 'timer--finishing'; } ?>">
                <?php if((int)$end_time[0] < 0) { echo 'Торги окончены'; } elseif((int)$end_time[0] < 24) { ?>
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
              <div class="lot-item__min-cost">Мин. ставка +<span><?=format_cost($two_cats['cost'])?></span>
              </div>
            </div>
            <form class="lot-item__form" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?php if(isset($errors)) { echo 'form__item--invalid'; } ?>"> <!--  form__item--invalid --!>
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" value="<?=!empty($_POST['cost'] ? (int)$_POST['cost'] : '')?>" placeholder="<?=format_cost_count(((int)$two_cats['cost']+(int)$two_cats['begin_cost']))?>">
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
                        <td class="history__time"><?=format_old_time($v['datatime'])?></td>
                      </tr>
                    <?php endforeach; ?>
                </table>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>

<script src="../rbs.js"></script>

