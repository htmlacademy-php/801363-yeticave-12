-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 21 2021 г., 20:00
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yeticave`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categorys`
--

CREATE TABLE `categorys` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-',
  `code` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `code`) VALUES
(1, 'Доски и лыжи', 'boards'),
(2, 'Крепления', 'attachment'),
(3, 'Ботинки', 'boots'),
(4, 'Одежда', 'clothing'),
(5, 'Инструменты', 'tools'),
(6, 'Разное', 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `lotes`
--

CREATE TABLE `lotes` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-',
  `cat` int(2) NOT NULL DEFAULT '5',
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `begin_cost` int(11) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '#',
  `date_end` datetime NOT NULL,
  `id_winer` int(11) NOT NULL DEFAULT '-1',
  `sended` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lotes`
--

INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `text`, `begin_cost`, `cost`, `img`, `date_end`, `id_winer`, `sended`) VALUES
(1, 2, '2014 Rossignol District Snowboard', 1, NULL, 11800, 200, 'img/lot-1.jpg', '2021-03-21 11:16:00', 26, 0),
(2, 1, 'DC Ply Mens 2016/2017 Snowboard', 1, NULL, 160100, 50, 'img/lot-2.jpg', '2021-03-22 07:16:00', 32, 0),
(3, 4, 'Крепления Union Contact Pro 2015 года размер L/XL', 2, NULL, 16250, 20, 'img/lot-3.jpg', '2021-03-23 08:13:00', 12, 0),
(4, 2, 'Ботинки для сноуборда DC Mutiny Charocal', 3, NULL, 44500, 100, 'img/lot-4.jpg', '2021-03-22 05:47:00', 33, 0),
(5, 1, 'Куртка для сноуборда DC Mutiny Charocal', 4, NULL, 7720, 110, 'img/lot-5.jpg', '2021-03-21 14:30:00', 28, 0),
(6, 6, 'Маска Oakley Canopy', 5, NULL, 5460, 10, 'img/lot-6.jpg', '2021-03-21 04:00:00', 20, 0),
(7, 2, 'Коньки супер-пупер Charocal', 6, NULL, 12180, 25, 'img/lot-7.jpg', '2021-03-23 22:28:00', 24, 0),
(12, 6, 'Велосипедные педали', 3, 'Что-то с чем-то', 54440, 20, 'img/20210309-145016_id-125245-641685.png', '2021-03-21 07:00:00', 31, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `datatime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lot_cost` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '-1',
  `id_lot` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rates`
--

INSERT INTO `rates` (`id`, `lot_cost`, `id_user`, `id_lot`) VALUES
(12, 16200, 2, 3),
(18, 5440, 3, 6),
(19, 5450, 4, 6),
(20, 5460, 1, 6),
(22, 11400, 1, 1),
(23, 11600, 3, 1),
(24, 12180, 3, 7),
(26, 11800, 6, 1),
(27, 7610, 1, 5),
(28, 7720, 6, 5),
(29, 44400, 6, 4),
(30, 54420, 6, 12),
(31, 54440, 1, 12),
(32, 160050, 6, 2),
(33, 44500, 1, 4),
(34, 160100, 1, 2),
(35, 16250, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-',
  `login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'none',
  `descr` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `pass`, `descr`) VALUES
(1, 'vohuanrok@mail.ru', 'robin', 'k4yKmL7Wmqoog', 'Заслонова 34 тел. 343-233-32'),
(2, 'user@mail.by', 'userminator', 'none', 'новый пользователь'),
(3, 'robinstone2011@gmail.com', 'Петрович', 'k4yKmL7Wmqoog', 'Я живу дома ))'),
(5, 'vohuanrok22@mail.ru', 'Олег Корнаухов', 'k4aAUo24kcXdk', 'вапвапвапвап'),
(6, 'masha@mail.ru', 'Маша', 'k4Q5OELL6plnE', 'Лом д44 кв 23 тел. 232-321-1'),
(10, 'vohuanrok11@mail.ru', 'Олег Корнаухов', 'k4yKmL7Wmqoog', 'efbdfbdfbdfbdf'),
(12, 'vohuanrok2342@mail.ru', 'Robin Stone', 'k4LDWVacxfYCw', 'кепукпукпу');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `lotes` ADD FULLTEXT KEY `ix_name2text` (`name`,`text`);

--
-- Индексы таблицы `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
