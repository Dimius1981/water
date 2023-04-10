-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2023 г., 15:51
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `water`
--

-- --------------------------------------------------------

--
-- Структура таблицы `level_rashod`
--

CREATE TABLE `level_rashod` (
  `id` int NOT NULL,
  `sensor_id` int NOT NULL,
  `level` float NOT NULL,
  `rashod` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `level_rashod`
--

INSERT INTO `level_rashod` (`id`, `sensor_id`, `level`, `rashod`) VALUES
(34, 1, 1, 1.5),
(35, 1, 2, 2.5),
(36, 1, 3, 3.5),
(37, 1, 4, 4.5),
(38, 1, 6, 6.5),
(39, 1, 7, 7.5),
(40, 1, 8, 8.5),
(41, 1, 9, 9.5),
(42, 1, 10, 10.5),
(43, 2, 1.1, 10.1),
(44, 2, 2.2, 20.2),
(45, 2, 3.3, 30.3),
(46, 2, 4.4, 40.4),
(47, 2, 5.5, 50.5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `level_rashod`
--
ALTER TABLE `level_rashod`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `level_rashod`
--
ALTER TABLE `level_rashod`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
