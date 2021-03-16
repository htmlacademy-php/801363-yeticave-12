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

