<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach($cats as $v): ?>
                <!--заполните этот список из массива категорий-->
                <li class="promo__item promo__item--boards">
                    <a class="promo__link" href="pages/all-lots.html"><?=out_secur($v)?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach($two_cats as $k=>$v): ?>
                <li class="lots__item lot" data-end="<?=out_secur($v['date_end'])?>">
                    <div class="lot__image">
                        <img src="<?=out_secur($v['img'])?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=out_secur($v['cat'])?></span>
                        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=out_secur($k)?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount"><?=out_secur($v['cost'])?></span>
                                <span class="lot__cost"><?=format_cost($v['cost'])?></span>
                            </div>
                            <div class="lot__timer timer">
                                12:23
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
