<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach($cats as $v): ?>
                <!--заполните этот список из массива категорий-->
                <li class="promo__item promo__item--<?=$v['code']?>">
                    <a class="promo__link" href="pages/all-lots.html"><?=out_secur($v['name'])?></a>
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
            <?php foreach($two_cats as $k=>$v) {
                $end_time = format_time_lost($v['date_end']);
                ?>
                <li class="lots__item lot" data-end="<?=out_secur($v['date_end'])?>">
                    <div class="lot__image">
                        <img src="<?=out_secur($v['img'])?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=out_secur($v['CAT_NAME'])?></span>
                        <h3 class="lot__title"><a class="text-link" href="/lot/<?=$v['id']?>"><?=out_secur($v['name'])?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount"><?=format_cost($v['begin_cost'])?></span>
                                <span class="lot__cost"><?=format_cost($v['cost'])?></span>
                            </div>
                            <div class="lot__timer timer <?php if((int)$end_time[0] < 1) { echo 'timer--finishing'; } ?>">
                                <?php if((int)$end_time[0] < 24) { ?>
                                <?=str_pad($end_time[0], 2, "0", STR_PAD_LEFT).':'.str_pad($end_time[1], 2, "0", STR_PAD_LEFT)?>
                                <?php } else { ?>
                                > <?=floor($end_time[0]/24)?> сут.
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </section>
</main>
