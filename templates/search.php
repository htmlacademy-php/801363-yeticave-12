<?php
if(!empty($_GET['find']) && !empty($_GET['search'])) {
    $ask = q("
    SELECT lotes.*, categorys.id AS CAT_ID, categorys.name AS CAT_NAME FROM `lotes`
    LEFT JOIN `categorys`
    ON lotes.cat = categorys.id
    WHERE MATCH(lotes.name, lotes.text) AGAINST ('".db_secur($_GET['search'])."')
    ");
    if($ask->num_rows) {
        while($row = $ask->fetch_assoc()) {
            $arr[] = $row;
        }
    }
} else {
    header('Location: /');
    exit;
}
?>

<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <div class="container">
        <section class="lots">
            <h2>Результаты поиска по запросу «<span><?=@$_GET['search']?></span>»</h2>
            <?php if(isset($arr)) { ?>
            <ul class="lots__list">
                <?php foreach($arr as $v) {
                    $end_time = format_time_lost($v['date_end']);
                    $end_time[0] = str_pad($end_time[0], 2, "0", STR_PAD_LEFT);
                    $end_time[1] = str_pad($end_time[1], 2, "0", STR_PAD_LEFT);
                    ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="../<?=$v['img']?>" width="350" height="260" alt="<?=$v['name']?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=$v['CAT_NAME']?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot/<?=(int)$v['id']?>"><?=$v['name']?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=format_cost($v['cost'])?></span>
                            </div>
                            <div class="lot__timer timer <?php if((int)$end_time[0] < 1) { echo 'timer--finishing'; } ?>">
                                <?php if((int)$end_time[0] < 24) { ?>
                                    <?=$end_time[0].':'.$end_time[1]?>
                                <?php } else { ?>
                                    > <?=floor($end_time[0]/24)?> сут.
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <p style="color: red; font-size: 1.5em;">Ничего не найдено по вашему запросу... :(</p>
            <?php } ?>
        </section>
        <ul class="pagination-list">
            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
            <li class="pagination-item pagination-item-active"><a>1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a href="#">3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
    </div>
</main>
