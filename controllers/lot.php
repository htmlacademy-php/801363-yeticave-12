<?php
if(isset($_POST['create-rate'], $_SESSION['user'], $_POST['cost'], $two_cats)) {
    if($two_cats['date_end'] < date('Y-m-d H:i:s') || (int)$_POST['cost'] < (int)$two_cats['cost'] + (int)$two_cats['begin_cost']) {
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
