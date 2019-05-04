-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 04 2019 г., 15:15
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geek_brains`
--
CREATE DATABASE IF NOT EXISTS `geek_brains` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `geek_brains`;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `url`, `views`, `title`, `size`) VALUES
(1, 'img/1.jpg', 34, 'Картинка 1', 0),
(2, 'img/2.jpg', 8, 'Картинка 2', 0),
(3, 'img/3.jpg', 11, 'Картинка 3', 0),
(4, 'img/4.jpg', 12, 'Картинка 4', 0),
(5, 'img/5.jpg', 6, 'Картинка 5', 0),
(6, 'img/6.jpg', 49, 'Картинка 6', 0),
(7, 'img/7.jpg', 12, 'Картинка 7', 0),
(8, 'img/8.jpg', 38, 'Картинка 8', 0),
(9, 'img/img9.jpg', 4, 'нет такой картинки', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp(),
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date_create`, `url`) VALUES
(1, 'первая новость', 'добавлена таблица news', '2019-05-04 11:02:42', ''),
(2, 'вторая новость', 'таблица News работает!', '2019-05-04 11:03:04', ''),
(3, 'и вот она третья новость', 'добавлено поле хранения картинки', '2019-05-04 11:05:32', 'img/1.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
