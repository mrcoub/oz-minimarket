-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 07 2017 г., 16:23
-- Версия сервера: 5.7.18-16-beget-5.7.18-16-2-1-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mrcoubm1_market`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--
-- Создание: Ноя 06 2017 г., 16:48
-- Последнее обновление: Ноя 06 2017 г., 16:48
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `sort` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort`) VALUES
(1, 'Планшеты', 2),
(2, 'Смартфоны', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_user`
--
-- Создание: Ноя 07 2017 г., 13:11
-- Последнее обновление: Ноя 07 2017 г., 13:21
--

DROP TABLE IF EXISTS `order_user`;
CREATE TABLE `order_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(3) NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_user`
--

INSERT INTO `order_user` (`id`, `user_id`, `product_id`, `count`, `date_update`) VALUES
(1, 1, 24, 3, '2017-11-07 16:16:54'),
(2, 1, 23, 4, '2017-11-07 16:16:59'),
(3, 4, 29, 4, '2017-11-07 16:16:22'),
(4, 4, 28, 2, '2017-11-07 16:13:00'),
(5, 4, 26, 6, '2017-11-07 16:18:00');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--
-- Создание: Ноя 06 2017 г., 18:26
-- Последнее обновление: Ноя 07 2017 г., 13:21
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `price` float NOT NULL,
  `quantity` int(3) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `date_create`, `date_update`, `price`, `quantity`, `description`, `user_id`) VALUES
(2, 2, 'Телефон', '2017-11-06 07:05:12', '2017-11-06 00:00:00', 50, 0, 'Описание', 1),
(18, 2, 'Смартфон Apple iPhone X 64GB (серый космос)', '2017-11-07 10:59:49', '2017-11-07 10:59:49', 2990, 6, 'Apple iOS, экран 5.8\" AMOLED (1125x2436), ОЗУ 3 ГБ, флэш-память 64 ГБ, камера 12 Мп, аккумулятор 2716 мАч, 1 SIM, цвет темно-серый', 1),
(19, 2, 'Смартфон Xiaomi Redmi 4X 16GB Black', '2017-11-07 11:00:43', '2017-11-07 11:00:43', 275, 30, 'Android, экран 5\" IPS (720x1280), ОЗУ 2 ГБ, флэш-память 16 ГБ, карты памяти, камера 13 Мп, аккумулятор 4100 мАч, 2 SIM, цвет черный', 1),
(20, 2, 'Смартфон Apple iPhone 7 32GB Black', '2017-11-07 11:01:40', '2017-11-07 11:01:40', 1324, 12, 'Apple iOS, экран 4.7\" IPS (750x1334), ОЗУ 2 ГБ, флэш-память 32 ГБ, камера 12 Мп, аккумулятор 1960 мАч, 1 SIM, цвет черный', 1),
(21, 2, 'Смартфон Apple iPhone 8 64GB (серый космос)', '2017-11-07 11:02:25', '2017-11-07 11:02:25', 1730, 32, 'Apple iOS, экран 4.7\" IPS (750x1334), ОЗУ 2 ГБ, флэш-память 64 ГБ, камера 12 Мп, 1 SIM, цвет темно-серый', 1),
(22, 2, 'Смартфон Samsung Galaxy S8 Dual SIM 64GB (черный бриллиант) [G950FD]', '2017-11-07 11:03:16', '2017-11-07 11:03:16', 1450, 2, 'Android, экран 5.8\" AMOLED (1440x2960), ОЗУ 4 ГБ, флэш-память 64 ГБ, карты памяти, камера 12 Мп, аккумулятор 3000 мАч, 2 SIM, цвет черный', 1),
(23, 1, 'Планшет Samsung Galaxy Tab A (2016) 16GB Black [SM-T580]', '2017-11-07 11:56:25', '2017-11-07 16:16:59', 464, 21, '10.1\" (1920x1200), Android, ОЗУ 2 ГБ, флэш-память 16 ГБ, цвет черный', 4),
(24, 1, 'Планшет Apple iPad 32GB Silver', '2017-11-07 11:58:18', '2017-11-07 16:16:54', 790, 6, '9.7\" IPS (2048x1536), iOS, флэш-память 32 ГБ, цвет белый/серебристый', 4),
(25, 2, 'Смартфон Xiaomi Redmi Note 4X 3GB/32GB (черный) [2016101]', '2017-11-07 12:13:09', '2017-11-07 12:13:09', 370, 50, 'Android, экран 5.5\" IPS (1080x1920), ОЗУ 3 ГБ, флэш-память 32 ГБ, карты памяти, камера 13 Мп, аккумулятор 4100 мАч, 2 SIM, цвет черный', 1),
(26, 2, 'Смартфон Xiaomi Mi A1 (черный)', '2017-11-07 12:14:10', '2017-11-07 16:18:00', 569, 58, 'Android, экран 5.5\" IPS (1080x1920), ОЗУ 4 ГБ, флэш-память 64 ГБ, карты памяти, камера 12 Мп, аккумулятор 3080 мАч, 2 SIM, цвет черный', 1),
(27, 2, 'Смартфон Samsung Galaxy J7 (2017) Dual SIM (черный) [SM-J730FM/DS]', '2017-11-07 12:15:00', '2017-11-07 12:15:00', 549, 57, 'Android, экран 5.5\" AMOLED (1080x1920), ОЗУ 3 ГБ, флэш-память 16 ГБ, карты памяти, камера 13 Мп, аккумулятор 3600 мАч, 2 SIM, цвет черный', 1),
(28, 2, 'Смартфон Samsung Galaxy Note8 Dual SIM 64GB (черный бриллиант)', '2017-11-07 12:16:46', '2017-11-07 16:13:00', 2080, 22, 'Android, экран 6.3\" AMOLED (1440x2960), ОЗУ 6 ГБ, флэш-память 64 ГБ, карты памяти, камера 12 Мп, аккумулятор 3300 мАч, 2 SIM, цвет черный', 1),
(29, 2, 'Смартфон Huawei P10 Lite 3GB/32GB (черный) [WAS-LX1]', '2017-11-07 12:18:08', '2017-11-07 16:16:22', 509, 48, 'Android, экран 5.2\" IPS (1080x1920), ОЗУ 3 ГБ, флэш-память 32 ГБ, карты памяти, камера 12 Мп, аккумулятор 3000 мАч, 2 SIM, цвет черный', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--
-- Создание: Ноя 07 2017 г., 13:20
-- Последнее обновление: Ноя 07 2017 г., 13:20
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fio` varchar(150) NOT NULL,
  `phone` varchar(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fio`, `phone`) VALUES
(1, 'mr.coub@gmail.com', '$2y$10$1.yxMVqiLGNfSqcIAtkuluoRlJ5v2WF6Lsxknw2a7bzWtQK0vf8cO', 'Alexey Sukach Sergeevich2', '+375(29)123-45-60'),
(2, 'admin@admin.com', '$2y$10$deT84CdOEPTV0QfKmPiOZ.6t/vyKsSJFaYZosM0hDI20aynkvb1v.', 'Alexey Sukach Sergeevich', '+375(29)123-45-67'),
(3, 're@ru.nu', '$2y$10$aXUnaPakr3V8vUCVcgCTYenMjpM06PuO9frfuP//Bo9TI77dlWyWi', 'Alexey Sukach Sergeevich', ''),
(4, 'admin@admin.ru', '$2y$10$hA9Z0bRxuYA7hZqCqYvBM.Bsl5zYbI55DMH.gWHsdzQZuPRtzJx1O', 'ADMIN ADMIN ADMIN', '+375(33)111-11-11');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_user`
--
ALTER TABLE `order_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order_user`
--
ALTER TABLE `order_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
