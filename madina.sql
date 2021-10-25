-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 25 2021 г., 05:17
-- Версия сервера: 8.0.18
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `madina`
--

-- --------------------------------------------------------

--
-- Структура таблицы `money`
--

CREATE TABLE `money` (
  `id` int(11) UNSIGNED NOT NULL,
  `date_take` datetime DEFAULT NULL,
  `amount_money` int(11) UNSIGNED DEFAULT NULL,
  `people_name` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `money`
--

INSERT INTO `money` (`id`, `date_take`, `amount_money`, `people_name`) VALUES
(1, '2021-10-24 18:14:04', 500, 'Ilez'),
(2, '2021-10-24 18:14:10', 1000, 'Madina');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `sell_price` int(11) UNSIGNED DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `article` int(11) UNSIGNED DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product_name`, `purchase_price`, `sell_price`, `quantity`, `article`, `img`) VALUES
(1, 'Ручка шариковая синяя brauberg', '5.52', 7, 20, 142409, 'e40304ed0fa6d91d5a9ea761756c0e67dc79c03cpen.jpg'),
(2, 'Карандаш с резинкой brauberg', '10.43', 12, 5, 180609, '65936e6476d352041738e3eac25b48ed4eab9684pencil.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `sell`
--

CREATE TABLE `sell` (
  `id` int(11) UNSIGNED NOT NULL,
  `sale_date` datetime DEFAULT NULL,
  `count_products` int(11) UNSIGNED DEFAULT NULL,
  `products_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `sell`
--

INSERT INTO `sell` (`id`, `sale_date`, `count_products`, `products_id`) VALUES
(1, '2021-10-24 17:45:25', NULL, 1),
(2, '2021-10-24 18:14:40', NULL, 1),
(3, '2021-10-24 18:15:01', NULL, 1),
(4, '2021-10-24 18:19:42', NULL, 1),
(5, '2021-10-24 18:19:42', NULL, 2),
(6, '2021-10-24 18:21:29', NULL, 1),
(7, '2021-10-24 18:21:29', NULL, 2),
(8, '2021-10-24 18:23:48', NULL, 1),
(9, '2021-10-24 18:23:48', NULL, 2),
(10, '2021-10-24 18:28:45', 3, 1),
(11, '2021-10-24 18:28:45', 2, 2),
(12, '2021-10-24 18:28:48', 3, 2),
(13, '2021-10-24 18:28:55', 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'madina_ilez_adamo_00_sunzha', '$2y$10$Tx5QcE7u/bScsgSUOug1h.YBy.Hg1Ap2YAYt.eKjMWy.vlf4Re9kK'),
(2, 'seller_chancellery', '$2y$10$YJXvjp4e7RaVPbYgTOcIteHPQ0fFFok2098q6ZRC/4Vrf0SaNcoE6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_sell_products` (`products_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `money`
--
ALTER TABLE `money`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `c_fk_sell_products_id` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
