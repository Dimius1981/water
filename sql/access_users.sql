-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 11 2022 г., 15:43
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
-- Структура таблицы `access_users`
--

CREATE TABLE `access_users` (
  `id` int NOT NULL,
  `level_id` int NOT NULL,
  `func_id` int NOT NULL,
  `state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `access_users`
--

INSERT INTO `access_users` (`id`, `level_id`, `func_id`, `state`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 2, 1, 0),
(9, 2, 2, 1),
(10, 2, 3, 0),
(11, 2, 4, 1),
(12, 2, 5, 1),
(13, 2, 6, 1),
(14, 2, 7, 0),
(15, 3, 1, 0),
(16, 3, 2, 0),
(17, 3, 3, 0),
(18, 3, 4, 1),
(19, 3, 5, 0),
(20, 3, 6, 0),
(21, 3, 7, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access_users`
--
ALTER TABLE `access_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `func_id` (`func_id`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `access_users`
--
ALTER TABLE `access_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `access_users`
--
ALTER TABLE `access_users`
  ADD CONSTRAINT `access_users_ibfk_1` FOREIGN KEY (`func_id`) REFERENCES `functions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `access_users_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `user_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
