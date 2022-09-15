-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 15 2022 г., 20:03
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
-- Структура таблицы `records`
--

CREATE TABLE `records` (
  `id` int NOT NULL,
  `sensor_id` int NOT NULL,
  `level` int NOT NULL,
  `bat` int NOT NULL,
  `rashod` int NOT NULL,
  `date_insert` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `records`
--

INSERT INTO `records` (`id`, `sensor_id`, `level`, `bat`, `rashod`, `date_insert`) VALUES
(1, 1, 100, 100, 0, '2022-09-15 18:31:25'),
(2, 1, 99, 100, 0, '2022-09-15 18:55:20'),
(3, 1, 98, 100, 0, '2022-09-15 18:57:55'),
(4, 1, 101, 100, 0, '2022-09-15 19:40:46'),
(5, 1, 102, 100, 0, '2022-09-15 19:41:40'),
(6, 1, 100, 100, 0, '2022-09-15 19:53:46');

-- --------------------------------------------------------

--
-- Структура таблицы `sensors`
--

CREATE TABLE `sensors` (
  `id` int NOT NULL,
  `factorynumber` int NOT NULL,
  `name` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastindication` int NOT NULL,
  `date` date NOT NULL,
  `sum` int NOT NULL,
  `description` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `high` int NOT NULL,
  `gsmnum` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sensors`
--

INSERT INTO `sensors` (`id`, `factorynumber`, `name`, `lastindication`, `date`, `sum`, `description`, `model`, `high`, `gsmnum`) VALUES
(1, 1, 'Sensor 1', 0, '2022-09-15', 0, 'Sensor model MSD1', 'MSD1', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `level_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pass` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_login` datetime DEFAULT NULL,
  `email` varchar(20) NOT NULL,
  `enabled` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `level_id`, `name`, `login`, `pass`, `date_login`, `email`, `enabled`) VALUES
(1, 1, 'Админ Юзерович', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-09-15 19:55:57', 'admin@uvrcloud,kz', 1),
(2, 2, 'Управ Магазович', 'uprav', 'a71966001fabf935b3f3867e5a648973ff2f87f6', '2022-03-26 15:00:58', 'uprav@uvrcloud,kz', 1),
(3, 3, 'Менеджер 1', 'manager1', 'a5c297c15e40ac3881db51277613aea3731b673a', '2022-05-30 17:57:34', 'manager1@uvrcloud,kz', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_levels`
--

CREATE TABLE `user_levels` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user_levels`
--

INSERT INTO `user_levels` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Управляющий'),
(3, 'Менеджер'),
(4, 'Покупатель');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`level_id`);

--
-- Индексы таблицы `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `records`
--
ALTER TABLE `records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `user_levels` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
