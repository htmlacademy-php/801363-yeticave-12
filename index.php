<?php
include_once './libs/default.php';
include_once './helpers.php';

$page_name = 'Главная';
$is_auth = rand(0, 1);
$user_name = 'Олег'; // укажите здесь ваше имя
$cats = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$oldDate = date('Y-m-d H:i:s');
$two_cats = [
    '2014 Rossignol District Snowboard' => [
        'cat'       => $cats[0],
        'cost'      => '10999',
        'img'       => 'img/lot-1.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 15 hours')),
    ],
    'DC Ply Mens 2016/2017 Snowboard' => [
        'cat'       => $cats[0],
        'cost'      => '159999',
        'img'       => 'img/lot-2.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 62 minutes')),
    ],
    'Крепления Union Contact Pro 2015 года размер L/XL' => [
        'cat'       => $cats[1],
        'cost'      => '8000',
        'img'       => 'img/lot-3.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 3 hours')),
    ],
    'Ботинки для сноуборда DC Mutiny Charocal' => [
        'cat'       => $cats[2],
        'cost'      => '10999',
        'img'       => 'img/lot-4.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 2 hours')),
    ],
    'Куртка для сноуборда DC Mutiny Charocal' => [
        'cat'       => $cats[3],
        'cost'      => '7500',
        'img'       => 'img/lot-5.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 10 minutes')),
    ],
    'Маска Oakley Canopy' => [
        'cat'       => $cats[4],
        'cost'      => '5400',
        'img'       => 'img/lot-6.jpg',
        'date_end'  => date("Y-m-d H:i:s", strtotime($oldDate.'+ 50 minutes')),
    ]
];

foreach($two_cats as $k=>$v) {
    if(strtotime($v['date_end']) < strtotime(date('Y-m-d H:i:s'))) {
        unset($two_cats[$k]);
    }
}


echo include_template('layout.php', ['page_name'=>$page_name, 'user_name'=>$user_name, 'is_auth'=>$is_auth, 'cats'=>$cats, 'two_cats'=>$two_cats]);
