INSERT INTO `users` (`id`, `login`, `pass`, `descr`) VALUES
(1, 'robin', 'none', NULL),
(2, 'user', 'none', 'новый пользователь');

INSERT INTO `categorys` (`id`, `name`, `code`) VALUES
(1, 'Доски и лыжи', 'boards'),
(2, 'Крепления', 'attachment'),
(3, 'Ботинки', 'boots'),
(4, 'Одежда', 'clothing'),
(5, 'Инструменты', 'tools'),
(6, 'Разное', 'other');

INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `begin_cost`, `cost`, `img`, `date_end`) VALUES
(1, 2, '2014 Rossignol District Snowboard', 1, 10999, 10999, 'img/lot-1.jpg', '2021-03-10 12:20:00'),
(2, 1, 'DC Ply Mens 2016/2017 Snowboard', 1, 159999, 159999, 'img/lot-2.jpg', '2021-03-16 07:16:00'),
(3, 1, 'Крепления Union Contact Pro 2015 года размер L/XL', 2, 8000, 8000, 'img/lot-3.jpg', '2021-03-07 21:22:00'),
(4, 2, 'Ботинки для сноуборда DC Mutiny Charocal', 3, 10999, 10999, 'img/lot-4.jpg', '2021-03-09 09:47:00'),
(5, 1, 'Куртка для сноуборда DC Mutiny Charocal', 4, 7500, 7500, 'img/lot-5.jpg', '2021-03-15 14:30:00'),
(6, 1, 'Маска Oakley Canopy', 5, 5400, 5400, 'img/lot-6.jpg', '2021-03-15 21:12:00');
