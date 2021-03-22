<main>
    <nav class="nav">
        <?=include_template('listCats.php', ['cats'=>$cats])?>
    </nav>
    <section class="rates container">
        <h2>Мои ставки</h2>
        <?php if(isset($arr)) { ?>
        <table class="rates__list">
            <?php foreach($arr as $v) {
                $end_time = format_time_lost($v['date_end']);
                $end_time[0] = str_pad($end_time[0], 2, "0", STR_PAD_LEFT);
                $end_time[1] = str_pad($end_time[1], 2, "0", STR_PAD_LEFT);
                ?>
            <tr class="rates__item <?php if((int)$v['id_winer'] === (int)$v['id']) { echo 'rates__item--win'; } elseif((int)$end_time[0] < 0) { echo 'rates__item--end'; } ?>">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="../<?=$v['img']?>" width="54" height="40" alt="<?=$v['name']?>">
                    </div>
                    <div>
                        <h3 class="rates__title"><a href="/lot/<?=(int)$v['ID_LOTES']?>"><?=$v['name']?></a></h3>
                        <?php if((int)$v['id_winer'] === (int)$v['id']) { echo '<p>'.$v['address'].'</p>'; } ?>
                    </div>
                </td>
                <td class="rates__category">
                    <?=$v['CAT_NAME']?>
                </td>
                <td class="rates__timer">
                    <?php if((int)$v['id_winer'] === (int)$v['id']) {
                        echo '<div class="timer timer--win">Ставка выиграла</div>';
                    } else { ?>
                    <div class="timer <?php if($end_time[0] < 0) { echo 'timer--end'; } elseif((int)$end_time[0] === 0) { echo 'timer--finishing'; } ?>">
                        <?php
                        if($end_time[0] < 0) {
                            echo 'Торги окончены';
                        } elseif((int)$end_time[0] < 24) {
                            echo $end_time[0].':'.$end_time[1];
                        } else {
                            echo '> '.floor($end_time[0]/24).' сут.';
                        }
                        ?>
                    </div>
                    <?php } ?>
                </td>
                <td class="rates__price">
                    <?=format_cost($v['lot_cost'])?>
                </td>
                <td class="rates__time">
                    <?=format_old_time($v['datatime'])?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } else { echo '<p style="font-size: 1.5em; color: red;">У Вас пока нет ставок...</p>'; } ?>
    </section>
</main>

