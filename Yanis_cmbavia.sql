-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 08 2022 г., 16:56
-- Версия сервера: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Yanis_cmbavia`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `flight_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`id`, `flight_id`, `user_id`, `flight_data`) VALUES
(2, 3, 7, '1970-01-01');

-- --------------------------------------------------------

--
-- Структура таблицы `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `FlightFrom` varchar(255) NOT NULL,
  `FlightTo` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `timestart` time DEFAULT NULL,
  `timefinish` time DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `flight`
--

INSERT INTO `flight` (`id`, `code`, `FlightFrom`, `FlightTo`, `count`, `timestart`, `timefinish`, `status`) VALUES
(3, 'db206', 'Moscow', 'Paris', 250, '14:32:00', '15:32:00', 'pass');

-- --------------------------------------------------------

--
-- Структура таблицы `Test`
--

CREATE TABLE `Test` (
  `1` int(11) NOT NULL,
  `2` int(11) NOT NULL,
  `3` int(11) NOT NULL,
  `4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Test`
--

INSERT INTO `Test` (`1`, `2`, `3`, `4`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` int(20) DEFAULT NULL,
  `document_number` int(20) DEFAULT NULL,
  `token` varchar(512) DEFAULT NULL,
  `subscription` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `first_name`, `last_name`, `phone`, `document_number`, `token`, `subscription`) VALUES
(7, 'Vanya2', '$2y$13$senKjQ5FX0UyMFM2JJYKu.JCfqTwKHpG2cjcInMscUdssDDTWFKAm', 'Иван2', 'Петров2', 890012345, 12245678, 'xuhy91CUwm9VT6vaBXIV0vD5-MJzbl5w', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Test`
--
ALTER TABLE `Test`
  ADD PRIMARY KEY (`1`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Test`
--
ALTER TABLE `Test`
  MODIFY `1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
