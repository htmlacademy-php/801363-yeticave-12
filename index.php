<?php
include_once './libs/default.php';
include_once './helpers.php';

$page_name = 'Главная';
$is_auth = rand(0, 1);
$user_name = 'Олег'; // укажите здесь ваше имя
$cats = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$two_cats = [
    '2014 Rossignol District Snowboard' => [
        'cat'  => $cats[0],
        'cost' => '10999',
        'img'  => 'img/lot-1.jpg'
    ],
    'DC Ply Mens 2016/2017 Snowboard' => [
        'cat'  => $cats[0],
        'cost' => '159999',
        'img'  => 'img/lot-2.jpg'
    ],
    'Крепления Union Contact Pro 2015 года размер L/XL' => [
        'cat'  => $cats[1],
        'cost' => '8000',
        'img'  => 'img/lot-3.jpg'
    ],
    'Ботинки для сноуборда DC Mutiny Charocal' => [
        'cat'  => $cats[2],
        'cost' => '10999',
        'img'  => 'img/lot-4.jpg'
    ],
    'Куртка для сноуборда DC Mutiny Charocal' => [
        'cat'  => $cats[3],
        'cost' => '7500',
        'img'  => 'img/lot-5.jpg'
    ],
    'Маска Oakley Canopy' => [
        'cat'  => $cats[4],
        'cost' => '5400',
        'img'  => 'img/lot-6.jpg'
    ]
];

echo include_template('layout.php', ['page_name'=>$page_name, 'is_auth'=>$is_auth, 'cats'=>$cats, 'two_cats'=>$two_cats]);
