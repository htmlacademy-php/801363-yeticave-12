INSERT INTO `users` (`id`, `login`, `pass`, `descr`) VALUES (NULL, 'robin', 'none', 'админ');
INSERT INTO `users` (`id`, `login`, `pass`, `descr`) VALUES (NULL, 'user', 'none', 'новый пользователь');

INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Доски и лыжи');
INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Крепления');
INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Ботинки');
INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Одежда');
INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Инструменты');
INSERT INTO `categorys` (`id`, `name`) VALUES (NULL, 'Разное');

INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `cost`, `img`, `date_end`) VALUES (NULL, '0', '2014 Rossignol District Snowboard', '0', '10999', 'img/lot-1.jpg', '2021-03-09 10:00:00'), (NULL, '0', 'DC Ply Mens 2016/2017 Snowboard', '0', '159999', 'img/lot-2.jpg', '2021-03-11 12:20:00');
INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `cost`, `img`, `date_end`) VALUES (NULL, '1', 'Крепления Union Contact Pro 2015 года размер L/XL', '1', '8000', 'img/lot-3.jpg', '2021-03-07 09:20:00'), (NULL, '1', 'Ботинки для сноуборда DC Mutiny Charocal', '2', '10999', 'img/lot-4.jpg', '2021-03-11 22:30:00');
INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `cost`, `img`, `date_end`) VALUES (NULL, '1', 'Куртка для сноуборда DC Mutiny Charocal', '3', '7500', 'img/lot-5.jpg', '2021-03-15 00:00:00'), (NULL, '1', 'Маска Oakley Canopy', '4', '5400', 'img/lot-6.jpg', '2021-03-15 00:00:00');


