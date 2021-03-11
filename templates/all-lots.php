<?php
if(!isset($_GET['cat'])) {
    header('Location: /404');
    exit;
} else {
    $cat_name = findArray($cats, $_GET['cat'], ['name', 'code', 'id']);
    if(count($cat_name) === 0) {
        header('Location: /404');
        exit;
    }
}

$ask = q("SELECT lotes.id, lotes.name, lotes.img, lotes.id_parent, lotes.cat, lotes.begin_cost, lotes.cost, lotes.date_end, categorys.id AS CAT_ID, categorys.name AS CAT_NAME FROM `lotes`
        LEFT JOIN `categorys`
            ON lotes.cat = categorys.id
            WHERE categorys.code = '".db_secur($_GET['cat'])."'
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
    <div class="container">
        <section class="lots">
            <h2>Все лоты в категории <span>«<?=$cat_name[0]?>»</span></h2>
            <?php if(isset($arr)) { ?>
            <ul class="lots__list">
                <?php foreach($arr as $k=>$v) {
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
                                    <span class="lot__amount"><?=format_cost($v['cost'])?></span>
                                    <span class="lot__cost"><?=format_cost($v['begin_cost'])?></span>
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
            <?php } else { echo '<p style="font-size: 1.5em; color: red;">К сожалению ничего по этой категории нет... :(</p>'; } ?>
        </section>
        <?php if(isset($arr) && count($arr)>9): ?>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
        <?php endif; ?>
    </div>
</main>

