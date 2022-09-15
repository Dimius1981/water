-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 15 2022 г., 16:38
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
-- База данных: `myshop_db`
--

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
(1, 1, 'Админ Юзерович', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2022-06-07 20:54:56', 'admin@myshop,kz', 1),
(2, 2, 'Управ Магазович', 'uprav', 'a71966001fabf935b3f3867e5a648973ff2f87f6', '2022-03-26 15:00:58', 'uprav@myshop,kz', 1),
(3, 3, 'Менеджер 1', 'manager1', 'a5c297c15e40ac3881db51277613aea3731b673a', '2022-05-30 17:57:34', 'manager1@myshop,kz', 1),
(4, 4, 'Покупатель 1', 'shoper1', '5ac360c8a8459e2d53a432f8bfced4f95752c2b3', '2022-03-26 15:02:39', 'shoper1@myshop,kz', 1),
(5, 4, 'Покупатель 2', 'shoper2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2022-06-07 11:44:13', 'shoper2@myshop.kz', 1),
(6, 4, 'Покупатель 3-2', 'shoper3', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2022-06-07 15:41:29', 'shoper3@myshop.kz', 1),
(7, 4, 'Покупатель 4-1', 'shoper4', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, 'shoper4@myshop.kz', 0),
(8, 4, 'Покупатель 5-1', 'shoper5', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, 'shoper5@myshop.kz', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`level_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `user_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
