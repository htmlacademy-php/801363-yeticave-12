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
            WHERE
            categorys.code = '".db_secur($_GET['cat'])."' AND
            lotes.date_end > NOW()
        ");
if($ask->num_rows) {
    while($row = $ask->fetch_assoc()) {
        $arr[] = $row;
    }
}

