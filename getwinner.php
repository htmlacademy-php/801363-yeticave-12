<?php
$ask = q("
SELECT lotes.*, rates.id AS ID_RATES, rates.datatime, rates.lot_cost, rates.id_user, rates.id_lot FROM `lotes`
LEFT JOIN `rates` ON lotes.id = rates.id_lot
WHERE `date_end` < NOW() AND `id_winer` = -1
ORDER BY rates.datatime DESC
");
if($ask->num_rows) {
    $wins = [];
    while($row = $ask->fetch_assoc()) {
        $exist = false;
        foreach($wins as $v) {
            if($row['id'] === $v['id']) {
                $exist = true;
            }
        }
        if($exist === false) {
            $wins[] = $row;
            q("
            UPDATE `lotes` SET `id_winer` = ".(int)$row['ID_RATES']." WHERE `id` = ".(int)$row['id_lot']."
            ");
            //sendMail();
        }
    }

//    wtf($wins);
}
