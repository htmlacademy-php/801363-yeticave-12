<?php
$ask = q("
SELECT * FROM `lotes` WHERE `date_end` < NOW()
");
if($ask->num_rows) {
    $wins = [];
    while($row = $ask->fetch_assoc()) {
        $wins[] = $row;
    }

    wtf($wins);
}
