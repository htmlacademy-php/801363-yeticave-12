<?php
session_start();
require('vendor/autoload.php');

include_once './config.php';
include_once './libs/default.php';
include_once './helpers.php';
include_once './getwinner.php';

if(isset($_GET['route'])) {
    $arr = explode('/', $_GET['route']);
    if(is_array($arr)) {
        $i = 0;
        foreach($arr as $k=>$v) {
            if(empty($v)) {
                unset($arr[$k]);
            } else {
                if($i === 0) {
                    $_GET['module'] = $v;
                } elseif($i === 1) {
                    $_GET['page'] = $v;
                } else {
                    $_GET['key_'.$i] = $v;
                }
                ++$i;
            }
        }
    } else {
        $_GET[] = $arr;
    }
    unset($_GET['route']);
}

if(empty($_GET['module'])) {
    $_GET['module'] = 'main';
}
if(empty($_GET['page'])) {
    $_GET['page'] = 'main';
}

//wtf($_SESSION);

$page_name = 'Главная';

if(isset($_SESSION['user'])) {
    $is_auth = 1;
    $user_name = $_SESSION['user']['login']; // укажите здесь ваше имя
} else {
    $user_name = '';
    $is_auth = 0;
}


$cats = [];
$ask = q("
SELECT * FROM `categorys`
");
if($ask->num_rows) {
    while($row = $ask->fetch_assoc()) {
        $cats[] = $row;
    }
}

$two_cats = [];

switch($_GET['module']) {
    case 'main':
        $ask = q("SELECT lotes.id, lotes.name, lotes.img, lotes.id_parent, lotes.cat, lotes.begin_cost, lotes.cost, lotes.date_end, categorys.id AS CAT_ID, categorys.name AS CAT_NAME FROM `lotes`
        LEFT JOIN `categorys`
            ON lotes.cat = categorys.id
            WHERE lotes.date_end >= '".date('Y-m-d H:i:s')."'
            ORDER BY lotes.date_end ASC
        ");

        if($ask->num_rows) {
            while($row = $ask->fetch_assoc())  {
                $two_cats[] = $row;
            }
        }
        break;
    case 'lot':
        $ask = q("SELECT lotes.id, lotes.name, lotes.img, lotes.id_parent, lotes.cat, lotes.begin_cost, lotes.cost, lotes.date_end, categorys.id AS CAT_ID, categorys.name AS CAT_NAME FROM `lotes`
        LEFT JOIN `categorys`
            ON lotes.cat = categorys.id
            WHERE lotes.id = ".(int)$_GET['page']."
            LIMIT 1
        ");
        if($ask->num_rows) {
            $two_cats = $ask->fetch_assoc();
        } else {
            header('HTTP/1.0 404 Not Found');
            header('Location: /404');
            exit;
        }
        break;
}


echo include_template('layout.php', ['content'=>$_GET['module'], 'page_name'=>$page_name, 'user_name'=>$user_name, 'is_auth'=>$is_auth, 'cats'=>$cats, 'two_cats'=>$two_cats]);
