-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 25 2023 г., 16:46
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cinema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actors`
--

CREATE TABLE `actors` (
  `id` int(11) NOT NULL,
  `name_actor` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `actors`
--

INSERT INTO `actors` (`id`, `name_actor`) VALUES
(1, 'Агния Кузнецова'),
(2, 'Алексей Полуян'),
(3, 'Леонид Громов'),
(4, 'Алексей Серебряков'),
(5, 'Киллиан Мерфи'),
(6, 'Эмили Блант'),
(7, 'Мэтт Дэймон'),
(8, 'Роберт Дауни мл.'),
(9, 'Леонардо Дикаприо'),
(10, 'Лариса Гузеева'),
(11, 'Гарик Харламов'),
(12, 'Кумелен Санс'),
(13, 'Матина Гарелло'),
(14, 'Елена Валюшкина'),
(15, 'Галина Польских'),
(16, 'Адам Драйвер'),
(17, 'Пенелопа Крус'),
(18, 'Шейлин Вудли'),
(19, 'Конни Нильсен'),
(20, 'Кейли Куоко'),
(21, 'Билл Найи');

-- --------------------------------------------------------

--
-- Структура таблицы `actors film`
--

CREATE TABLE `actors film` (
  `id` int(11) NOT NULL,
  `Id_actor` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `actors film`
--

INSERT INTO `actors film` (`id`, `Id_actor`, `id_film`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(50, 15, 34),
(51, 14, 34),
(55, 18, 36),
(56, 17, 36),
(57, 16, 36),
(58, 21, 37),
(59, 20, 37),
(60, 19, 37);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Россия'),
(2, 'США'),
(3, 'Корея'),
(4, 'Англия'),
(5, 'Германия'),
(6, 'Китай'),
(7, 'Африка'),
(8, 'Аргентина');

-- --------------------------------------------------------

--
-- Структура таблицы `directors`
--

CREATE TABLE `directors` (
  `id` int(11) NOT NULL,
  `name_director` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `directors`
--

INSERT INTO `directors` (`id`, `name_director`) VALUES
(1, 'Кристофер Нолан'),
(2, 'Алексей Балабанов'),
(3, 'Квентин Тарантино'),
(4, 'Дэвид Финчер'),
(5, 'Ридли Скотт'),
(6, 'Грани кино'),
(7, 'Аскар Узабаев'),
(8, 'Тамаэ Гаратеги'),
(9, 'Дамир Мифтахов'),
(10, 'Иван Чехов'),
(11, 'Майкл Манн'),
(12, 'Тома Венсан');

-- --------------------------------------------------------

--
-- Структура таблицы `directors film`
--

CREATE TABLE `directors film` (
  `id` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `directors film`
--

INSERT INTO `directors film` (`id`, `id_film`, `id_director`) VALUES
(1, 1, 2),
(2, 2, 1),
(33, 34, 9),
(34, 34, 10),
(36, 36, 11),
(37, 37, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Детектив'),
(2, 'Ужасы'),
(3, 'Триллер'),
(4, 'Комедия'),
(5, 'Драма'),
(6, 'Романтика'),
(7, 'фентези'),
(8, 'фантастика'),
(9, 'Документальный'),
(10, 'путешествие'),
(11, 'Биография'),
(12, 'Экшн');

-- --------------------------------------------------------

--
-- Структура таблицы `genres film`
--

CREATE TABLE `genres film` (
  `id` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genres film`
--

INSERT INTO `genres film` (`id`, `id_film`, `id_genre`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 2),
(4, 34, 1),
(5, 34, 6),
(8, 36, 11),
(9, 36, 5),
(10, 37, 12),
(11, 37, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `halls`
--

CREATE TABLE `halls` (
  `id` int(11) NOT NULL,
  `title_hall` varchar(300) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `row number` int(11) NOT NULL,
  `number of seats in a row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `halls`
--

INSERT INTO `halls` (`id`, `title_hall`, `description`, `row number`, `number of seats in a row`) VALUES
(1, 'Малый', 'Малый,приятный,красивый,уютный,не воняет', 12, 7),
(2, 'Большой', '', 20, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `information about the cinema`
--

CREATE TABLE `information about the cinema` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tel` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `work_schedule` varchar(300) NOT NULL,
  `driving_directions` varchar(300) NOT NULL,
  `photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title_movie` varchar(300) NOT NULL,
  `id_country` int(11) NOT NULL,
  `year of release` varchar(1000) NOT NULL,
  `timing` varchar(300) NOT NULL,
  `rental start date` date NOT NULL,
  `rental end date` date NOT NULL,
  `id_rental company` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `ageLimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `movies`
--

INSERT INTO `movies` (`id`, `title_movie`, `id_country`, `year of release`, `timing`, `rental start date`, `rental end date`, `id_rental company`, `description`, `ageLimit`) VALUES
(1, 'Груз 200', 1, '2013', '140', '2013-01-01', '2014-01-01', 1, 'Груз 200. 2007 Триллеры 1 ч 25 мин 18+. Неизвестные похищают дочь секретаря райкома КПСС. Социальный хоррор в окрестностях маленького городка. Одиннадцатый и самый провокационный фильм культового российского режиссера Алексея Балабанова. Страшное и жестокое высказывание о сущности России. Основанный на реальных событиях, «Груз 200» Алексея Балабанова рассказывает историю жизни простых людей в СССР 1984 года.', 12),
(2, 'Опенгеймер', 2, '2023', '250', '2023-04-01', '2023-12-01', 1, '«Оппенгеймер» рассказывает о жизни «отца атомной бомбы», научного руководителя «Манхэттенского проекта» Роберта Оппенгеймера. Сюжет картины охватывает четыре десятилетия из жизни ученого и касается всех самых важных событий в его биографии, в том числе первых испытаний бомбы на полигоне в Лос-Аламосе и закрытых сенатских слушаний, на которых физика обвинили в симпатиях коммунистам и лишили секретного допуска к американской ядерной программе.', 18),
(34, 'Елки 10', 1, '2023', '90', '2023-12-25', '2023-12-31', 2, 'В новогоднюю ночь всегда есть место чуду, даже если ты вдруг перестал в него верить. Геннадьич, коротающий свой век в доме престарелых под Санкт-Петербургом, обретёт свою настоящую семью. Начинающей блогерше Ларисе из Тюмени предстоит узнать, на что ради своих близких готов решиться её супруг. Марине из Татарстана — научиться любить то, что действительно важно для её мужа. А девушка-геймерша по имени Таня из Нижнего Новгорода поймёт, что настоящая любовь — это совсем не игра. Ведь в самую волшебную ночь года каждый имеет шанс обрести своё персональное счастье.', 12),
(36, 'Феррари', 2, '2023', '130', '2023-12-26', '2024-01-05', 3, 'Об автомобилях Ferrari мечтают миллионы, а имеют единицы. Это символ роскошной жизни, известный во всем мире. Но блестящий фасад скрывает трагическую историю основателя компании Энцо Феррари. Семейные проблемы, финансовый кризис, ужасные аварии и даже гнев Ватикана – все это в свое время преодолел гениальный конструктор и бизнесмен, чтобы вписать свое имя в историю автопрома навсегда.', 18),
(37, 'Моя жена — киллер', 2, '2023', '140', '2023-12-30', '2024-01-07', 3, 'Размеренная жизнь обычной супружеской пары переворачивается с ног на голову, когда заботливый и любящий муж узнаёт, что его жена — первоклассная наёмница, на которую открыли охоту лучшие киллеры мира. Чтобы выжить, супругам предстоит заново познакомиться друг с другом и действовать сообща. Не такие ролевые игры они планировали на годовщину своего брака…', 18);

-- --------------------------------------------------------

--
-- Структура таблицы `photos film`
--

CREATE TABLE `photos film` (
  `id` int(11) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `photos film`
--

INSERT INTO `photos film` (`id`, `photo`, `id_film`) VALUES
(1, 'maxresdefault.jpg', 1),
(2, 'openg.jpg', 2),
(12, 'cba4e57f-6d4d-46a3-b465-cc9001d5682e.jpeg', 34),
(14, '3c73d3d7-d395-4d06-871b-6e02b8f4512d.jpeg', 36),
(15, 'f0e4526c-cdfd-4f9a-8de1-4250e8a38a94.jpeg', 37);

-- --------------------------------------------------------

--
-- Структура таблицы `promotions and discounts`
--

CREATE TABLE `promotions and discounts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `number_tickets_month` int(11) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `is_real` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rental companies`
--

CREATE TABLE `rental companies` (
  `id_rental company` int(11) NOT NULL,
  `rental company` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rental companies`
--

INSERT INTO `rental companies` (`id_rental company`, `rental company`) VALUES
(1, 'СТВ'),
(2, 'Грани кино'),
(3, 'Starz');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_of_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Пользователь'),
(2, 'Администатора');

-- --------------------------------------------------------

--
-- Структура таблицы `seats and rows`
--

CREATE TABLE `seats and rows` (
  `id` int(11) NOT NULL,
  `id_hall` int(11) NOT NULL,
  `№row` int(11) NOT NULL,
  `№seat` int(11) NOT NULL,
  `is_free` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `id_hall` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  `id_price` int(11) NOT NULL,
  `movieFormat` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `datetime`, `id_hall`, `id_film`, `id_price`, `movieFormat`) VALUES
(1, '2023-12-24 12:00:00', 1, 1, 1, '2D'),
(2, '2023-12-21 20:00:21', 1, 2, 1, '3D'),
(3, '2023-12-24 18:00:01', 1, 2, 1, '3D'),
(5, '2023-12-23 15:47:39', 1, 2, 1, '2D'),
(17, '2023-12-27 11:21:00', 2, 34, 2, '2D'),
(19, '2023-12-25 18:35:00', 1, 34, 1, '2D'),
(22, '2023-12-25 20:15:00', 1, 34, 1, '3D'),
(26, '2023-12-27 21:20:00', 2, 34, 1, '2D'),
(27, '2023-12-27 21:21:00', 1, 34, 1, '2D'),
(42, '2023-12-31 21:49:00', 2, 34, 2, '2D'),
(43, '2023-12-26 14:50:00', 2, 36, 1, '2D'),
(44, '2023-12-29 14:50:00', 2, 36, 1, '2D'),
(45, '2023-12-28 20:50:00', 2, 36, 1, '2D'),
(46, '2024-01-04 20:50:00', 2, 36, 1, '2D'),
(47, '2023-12-27 19:00:00', 1, 36, 1, '2D'),
(48, '2023-12-28 15:49:00', 1, 36, 1, '2D'),
(49, '2024-01-01 17:30:00', 2, 37, 3, '3D'),
(50, '2024-01-01 17:30:00', 1, 37, 3, '3D'),
(51, '2024-01-25 17:30:00', 1, 37, 3, '3D'),
(52, '2023-12-26 20:30:00', 1, 37, 1, '2D');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket prices`
--

CREATE TABLE `ticket prices` (
  `id` int(11) NOT NULL,
  `price` float NOT NULL,
  `timestamp_price` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `ticket prices`
--

INSERT INTO `ticket prices` (`id`, `price`, `timestamp_price`) VALUES
(1, 250, '2023-12-18'),
(2, 150, '2023-12-24'),
(3, 140, '2023-12-25');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `release date` date NOT NULL,
  `paid/booked` varchar(300) NOT NULL,
  `id_seat_hall` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `trailers`
--

CREATE TABLE `trailers` (
  `id` int(11) NOT NULL,
  `trailer` varchar(300) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dateOfReg` date NOT NULL,
  `autToken` varchar(1000) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `phone`, `password`, `dateOfReg`, `autToken`, `idRole`) VALUES
(1, 'fsdf', 'ed.lav.00@mail.ru', 'fsdfsdf', '$2y$10$nvtx40pC/uXlx7QrTjkhK.iSGpEF3vGDqck73Nw0qxynzlUVGH0Q6', '2023-12-20', '41de2c6eb3a152bb685d8915ae8db71065854900', 1),
(3, 'Admin', 'admin@gmail.com', '7777777777777', '$2y$10$VKikuNg.y9nIeU/gYqcgvu7UW9v0zwlvA4ydqpoeWJ6BLZAY75KSS', '2023-12-20', '802a2712ddc3fd7682eedc0c6d201da50a59c5b4', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `actors film`
--
ALTER TABLE `actors film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `directors film`
--
ALTER TABLE `directors film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_director` (`id_director`),
  ADD KEY `id_film` (`id_film`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genres film`
--
ALTER TABLE `genres film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Индексы таблицы `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `information about the cinema`
--
ALTER TABLE `information about the cinema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_country` (`id_country`),
  ADD KEY `id_rental company` (`id_rental company`);

--
-- Индексы таблицы `photos film`
--
ALTER TABLE `photos film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`);

--
-- Индексы таблицы `promotions and discounts`
--
ALTER TABLE `promotions and discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `rental companies`
--
ALTER TABLE `rental companies`
  ADD PRIMARY KEY (`id_rental company`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seats and rows`
--
ALTER TABLE `seats and rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hall` (`id_hall`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_price` (`id_price`),
  ADD KEY `id_hall` (`id_hall`);

--
-- Индексы таблицы `ticket prices`
--
ALTER TABLE `ticket prices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seat_hall` (`id_seat_hall`),
  ADD KEY `id_session` (`id_session`);

--
-- Индексы таблицы `trailers`
--
ALTER TABLE `trailers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`idRole`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `actors film`
--
ALTER TABLE `actors film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `directors film`
--
ALTER TABLE `directors film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `genres film`
--
ALTER TABLE `genres film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `halls`
--
ALTER TABLE `halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `information about the cinema`
--
ALTER TABLE `information about the cinema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `photos film`
--
ALTER TABLE `photos film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `promotions and discounts`
--
ALTER TABLE `promotions and discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rental companies`
--
ALTER TABLE `rental companies`
  MODIFY `id_rental company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `seats and rows`
--
ALTER TABLE `seats and rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `ticket prices`
--
ALTER TABLE `ticket prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `trailers`
--
ALTER TABLE `trailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `actors film`
--
ALTER TABLE `actors film`
  ADD CONSTRAINT `actors film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `directors film`
--
ALTER TABLE `directors film`
  ADD CONSTRAINT `directors film_ibfk_1` FOREIGN KEY (`id_director`) REFERENCES `directors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `directors film_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `genres film`
--
ALTER TABLE `genres film`
  ADD CONSTRAINT `genres film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `genres film_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `information about the cinema`
--
ALTER TABLE `information about the cinema`
  ADD CONSTRAINT `information about the cinema_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_3` FOREIGN KEY (`id_rental company`) REFERENCES `rental companies` (`id_rental company`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `photos film`
--
ALTER TABLE `photos film`
  ADD CONSTRAINT `photos film_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `promotions and discounts`
--
ALTER TABLE `promotions and discounts`
  ADD CONSTRAINT `promotions and discounts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `seats and rows`
--
ALTER TABLE `seats and rows`
  ADD CONSTRAINT `seats and rows_ibfk_1` FOREIGN KEY (`id_hall`) REFERENCES `halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`id_price`) REFERENCES `ticket prices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessions_ibfk_3` FOREIGN KEY (`id_hall`) REFERENCES `halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`id_seat_hall`) REFERENCES `seats and rows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `trailers`
--
ALTER TABLE `trailers`
  ADD CONSTRAINT `trailers_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
