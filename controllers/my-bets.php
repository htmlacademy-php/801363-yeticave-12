<?php
$ask = q("
SELECT rates.*, users.id AS ID_USER, lotes.id AS ID_LOTES, lotes.name, lotes.cat, lotes.img, lotes.text, lotes.date_end, lotes.id_winer, lotes.id_parent, lotes.sended, categorys.id AS ID_CAT, categorys.name AS CAT_NAME  FROM `rates`
LEFT JOIN `users` ON rates.id_user = users.id
LEFT JOIN `lotes` ON rates.id_lot = lotes.id
LEFT JOIN `categorys` ON lotes.cat = categorys.id
WHERE rates.id_user = ".(int)$_SESSION['user']['id']." ORDER BY lotes.date_end DESC
");

if($ask->num_rows) {
    while($row = $ask->fetch_assoc()) {
        $arr[] = $row;
        $id_arr[$row['id']] = ' `id` = '.$row['id_parent'];
    }
}

if(isset($id_arr, $arr)) {
    $ask = q("
    SELECT users.id, users.descr FROM `users` WHERE ".implode(' OR ', $id_arr)."
    ");
    if($ask->num_rows) {
        while($row = $ask->fetch_assoc()) {
            $descr[$row['id']] = $row['descr'];
        }
        foreach($arr as $k=>$v) {
            $arr[$k]['address'] = $descr[$v['id_parent']];
        }
    }
}

