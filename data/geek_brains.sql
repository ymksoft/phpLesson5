-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 27 2019 г., 03:03
-- Версия сервера: 5.6.43
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
-- База данных: `geek_brains`
--
CREATE DATABASE IF NOT EXISTS `geek_brains` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `geek_brains`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateChange` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `parentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `dateCreate`, `dateChange`, `name`, `isActive`, `parentId`) VALUES
(1, '2019-03-29 10:29:41', NULL, 'Интернет магазин', 1, NULL),
(2, '2019-03-29 10:29:57', NULL, 'Ноутбуки', 1, 1),
(3, '2019-03-29 10:29:57', NULL, 'Мобилки', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `url`, `views`, `title`, `size`) VALUES
(1, 'img/1.jpg', 34, 'Картинка 1', 0),
(2, 'img/2.jpg', 8, 'Картинка 2', 0),
(3, 'img/3.jpg', 12, 'Картинка 3', 0),
(4, 'img/4.jpg', 12, 'Картинка 4', 0),
(5, 'img/5.jpg', 57, 'Картинка 5', 0),
(6, 'img/6.jpg', 50, 'Картинка 6', 0),
(7, 'img/7.jpg', 12, 'Картинка 7', 0),
(8, 'img/8.jpg', 60, 'Картинка 8', 0),
(9, 'img/img9.jpg', 5, 'нет такой картинки', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date_create`, `url`) VALUES
(1, 'первая новость', 'добавлена таблица news', '2019-05-04 11:02:42', ''),
(2, 'вторая новость', 'таблица News работает!', '2019-05-04 11:03:04', ''),
(3, 'и вот она третья новость', 'добавлено поле хранения картинки', '2019-05-04 11:05:32', 'img/1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orderproducts`
--

DROP TABLE IF EXISTS `orderproducts`;
CREATE TABLE `orderproducts` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `dateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateChange` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderproducts`
--

INSERT INTO `orderproducts` (`id`, `orderId`, `productId`, `price`, `dateCreate`, `dateChange`, `amount`) VALUES
(19, 1, 1, '100.00', '2019-05-27 02:26:19', NULL, '7.00'),
(20, 1, 2, '123.00', '2019-05-27 02:26:19', NULL, '5.00'),
(21, 1, 3, '25.00', '2019-05-27 02:26:19', NULL, '1.00'),
(22, 1, 6, '100.00', '2019-05-27 02:26:19', NULL, '1.00'),
(23, 1, 9, '100.00', '2019-05-27 02:26:19', NULL, '1.00'),
(24, 1, 11, '55.55', '2019-05-27 02:26:19', NULL, '3.00'),
(25, 4, 1, '100.00', '2019-05-27 02:37:56', NULL, '1.00'),
(26, 4, 2, '123.00', '2019-05-27 02:37:56', NULL, '1.00');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateChange` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 - не обработан, 2 - в работе, 3 - выполнен, 4 - отменен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `userId`, `address`, `dateCreate`, `dateChange`, `status`) VALUES
(1, 5, 'ddd', '2019-05-26 23:14:45', '2019-05-26 23:14:45', 1),
(4, 5, 'qqqqq', '2019-05-26 23:37:56', '2019-05-26 23:37:56', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(11,2) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'img/no-image.jpeg',
  `dateCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateChange` timestamp NULL DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `dateCreate`, `dateChange`, `isActive`, `categoryId`) VALUES
(1, 'товарчик1', 'из модели1', '100.00', 'img/1.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 1),
(2, 'чайник', 'отличный белый чайник', '123.00', 'img/2.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 1),
(3, 'шапка', 'мономаха', '25.00', 'img/3.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 1),
(4, 'облака', 'светлое облако', '200.00', 'img/4.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 2),
(5, 'товар', 'из модели', '100.00', 'img/5.jpg', '2019-03-29 06:40:16', NULL, 1, 2),
(6, 'товар', 'из модели', '100.00', 'img/6.jpg', '2019-03-29 06:40:16', NULL, 1, 2),
(7, 'товар', 'из модели', '100.00', 'img/8.jpg', '2019-03-29 06:40:16', NULL, 1, 2),
(8, 'товар', 'из модели', '100.00', 'img/1.jpg', '2019-03-29 06:40:16', NULL, 1, 2),
(9, 'товар', 'из модели', '100.00', 'img/2.jpg', '2019-03-29 06:40:16', NULL, 1, 3),
(10, 'очки', 'модельный очко', '555.00', 'img/3.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 3),
(11, 'чумадан', 'без ручки', '55.55', 'img/4.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 1, 3),
(12, 'товар', 'из модели', '100.00', 'img/5.jpg', '2019-03-29 06:40:16', NULL, 1, 3),
(13, 'Новый товаришка', 'из модели', '100.00', 'img/6.jpg', '2019-03-29 06:40:16', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `author`, `text`) VALUES
(1, 'Олег Олегович 1', 'Олег такой Олег Ага Ога 1'),
(2, 'Петр', 'Могло быть и лучше'),
(3, 'Имя', 'Отзыв'),
(4, 'Света', 'Нужно больше розового'),
(5, 'Света', 'Нужно больше розового'),
(6, 'Наденька', 'Все чики-пуки'),
(7, 'Ренат', 'Мой комментарий важнее'),
(8, 'Ренат', 'Я все еще тут'),
(9, 'gdfgd', 'dfgdfgdf'),
(10, 'qwerty', 'test'),
(11, 'Юра', 'Добавил Юра'),
(12, '111', '1111111');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `pass`) VALUES
(1, 'yuri', 'test@test.ru', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'test', 'test', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, '123', '123', '202cb962ac59075b964b07152d234b70'),
(5, '444', '444', '550a141f12de6341fba65b0ad0433500'),
(6, 'qwerty', 'mymail@mail.me', '202cb962ac59075b964b07152d234b70'),
(7, '555', '555', '15de21c670ae7c3f6f3f1f37029303c9');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isActive` (`isActive`),
  ADD KEY `parentId` (`parentId`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isActive` (`isActive`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginpass` (`login`,`pass`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
