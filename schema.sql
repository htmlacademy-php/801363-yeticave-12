-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 06 2021 г., 19:08
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
  `begin_cost` int(11) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '#',
  `date_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lotes`
--

INSERT INTO `lotes` (`id`, `id_parent`, `name`, `cat`, `begin_cost`, `cost`, `img`, `date_end`) VALUES
(1, 2, '2014 Rossignol District Snowboard', 1, 10999, 10999, 'img/lot-1.jpg', '2021-03-10 12:20:00'),
(2, 1, 'DC Ply Mens 2016/2017 Snowboard', 1, 159999, 159999, 'img/lot-2.jpg', '2021-03-16 07:16:00'),
(3, 1, 'Крепления Union Contact Pro 2015 года размер L/XL', 2, 8000, 8000, 'img/lot-3.jpg', '2021-03-07 21:22:00'),
(4, 2, 'Ботинки для сноуборда DC Mutiny Charocal', 3, 10999, 10999, 'img/lot-4.jpg', '2021-03-09 09:47:00'),
(5, 1, 'Куртка для сноуборда DC Mutiny Charocal', 4, 7500, 7500, 'img/lot-5.jpg', '2021-03-15 14:30:00'),
(6, 1, 'Маска Oakley Canopy', 5, 5400, 5400, 'img/lot-6.jpg', '2021-03-15 21:12:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `pass` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'none',
  `descr` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `descr`) VALUES
(1, 'robin', 'none', NULL),
(2, 'user', 'none', 'новый пользователь');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
