<?php
$ask = q("
SELECT lotes.*, rates.id AS ID_RATES, rates.datatime, rates.lot_cost, rates.id_user, rates.id_lot, users.id AS ID_LOT_WIN_USER, users.email, users.login FROM `lotes`
LEFT JOIN `rates` ON lotes.id = rates.id_lot
LEFT JOIN `users` ON rates.id_user = users.id
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
            $mess = mail_creator(['login'=>$row['login'], 'lot_id'=>(int)$row['id_lot'], 'lot_name'=>$row['name'], 'cash'=>(int)$row['lot_cost']]);

            Mail::$to = $row['email'];
            Mail::$headers = 'Ваша ставка победила';
            Mail::send($mess);

//            // Конфигурация траспорта
//            $transport = new Swift_SmtpTransport('smtp.phpdemo.ru', 25);
//
//            // Формирование сообщения
//            $message = new Swift_Message("Ваша ставка победила");
//            $message->setTo([$row['email'] => $row['login']]);
//            $message->setBody($mess);
//            $message->setFrom("keks@phpdemo.ru", "keks@phpdemo.ru");
//
//            // Отправка сообщения
//            $mailer = new Swift_Mailer($transport);
//            $mailer->send($message);

            q("
            UPDATE `lotes` SET `id_winer` = ".(int)$row['ID_RATES']." WHERE `id` = ".(int)$row['id_lot']."
            ");
        }
    }

//    wtf($wins);
}
