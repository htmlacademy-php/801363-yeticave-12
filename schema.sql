-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 10 2021 г., 22:41
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
  `date_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lotes`
--

INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `text`, `begin_cost`, `cost`, `img`, `date_end`) VALUES
(1, 2, '2014 Rossignol District Snowboard', 1, NULL, 10999, 200, 'img/lot-1.jpg', '2021-03-11 12:20:00'),
(2, 1, 'DC Ply Mens 2016/2017 Snowboard', 1, NULL, 159999, 50, 'img/lot-2.jpg', '2021-03-16 07:16:00'),
(3, 1, 'Крепления Union Contact Pro 2015 года размер L/XL', 2, NULL, 8000, 20, 'img/lot-3.jpg', '2021-03-12 21:22:00'),
(4, 2, 'Ботинки для сноуборда DC Mutiny Charocal', 3, NULL, 10999, 100, 'img/lot-4.jpg', '2021-03-11 09:47:00'),
(5, 1, 'Куртка для сноуборда DC Mutiny Charocal', 4, NULL, 7500, 110, 'img/lot-5.jpg', '2021-03-15 14:30:00'),
(6, 1, 'Маска Oakley Canopy', 5, NULL, 5400, 10, 'img/lot-6.jpg', '2021-03-15 21:12:00'),
(7, 2, 'Коньки супер-пупер Charocal', 6, NULL, 12000, 25, 'img/lot-7.jpg', '2021-03-11 22:28:00'),
(12, -1, 'Велосипедные педали', 3, 'Что-то с чем-то', 12000, 20, 'img/20210309-145016_id-125245-641685.png', '2021-03-12 00:00:00');

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

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '-',
  `login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `pass` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'none',
  `descr` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `pass`, `descr`) VALUES
(1, 'vohuanrok@mail.ru', 'robin', 'k4yKmL7Wmqoog', NULL),
(2, 'user@mail.by', 'user', 'none', 'новый пользователь'),
(3, 'robinstone2011@gmail.com', 'Robin', 'k4yKmL7Wmqoog', 'Я живу дома ))');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
