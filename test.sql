-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 08 2024 г., 15:30
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE `mail` (
  `ID-mail` int(11) NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `E-mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Message` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `mail`
--

INSERT INTO `mail` (`ID-mail`, `Name`, `E-mail`, `Message`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '123', '123', '123'),
(4, 'Петр', '123@nvhv', '123'),
(5, 'Петр', '123@nvhv', 'Прошу уточнить, какие риелторы работают в офисе на Черкасова 25');

-- --------------------------------------------------------

--
-- Структура таблицы `квартиры`
--

CREATE TABLE `квартиры` (
  `ID-квартиры` int(11) NOT NULL,
  `Название ЖК` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Адрес` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Площадь` int(11) NOT NULL,
  `Количество комнат` int(11) NOT NULL,
  `Этаж` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `квартиры`
--

INSERT INTO `квартиры` (`ID-квартиры`, `Название ЖК`, `Адрес`, `Площадь`, `Количество комнат`, `Этаж`) VALUES
(1, 'Ласточка', 'Санкт-Петербург, Комсомольская 5, 24', 35, 1, 1),
(2, 'Теремок', 'Санкт-Петербург, Коломенская 4, 45', 56, 2, 1),
(3, 'Радуга', 'Санкт-Петербург, Спасская 34, 1', 21, 1, 1),
(4, 'Ласточка', 'Санкт-Петербург, Комсомольская 5, 56', 67, 3, 7),
(5, 'Облако', 'Санкт-Петербург, Уральская 5, 6', 42, 2, 3),
(6, 'Теремок', 'Санкт-Петербург, Коломенская 6, 78', 42, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `клиенты`
--

CREATE TABLE `клиенты` (
  `ID-клиента` int(11) NOT NULL,
  `ФИО` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Телефон` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Дата рождения` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Паспортные данные` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Пароль` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `клиенты`
--

INSERT INTO `клиенты` (`ID-клиента`, `ФИО`, `Телефон`, `Дата рождения`, `Паспортные данные`, `Пароль`) VALUES
(1, 'Петрова Анастасия Петровна', '9515647691', '23.05.1987', '4256789635', '1'),
(2, 'Ромашов Дмитрий Эдуардович', '9000001122', '04.11.2003', '5372918239', '2'),
(3, 'Пашуто Марина Олеговна', '9458279388', '06.07.2001', '5869456971', '3'),
(4, 'Марков Даниил Олегович', '9352333282', '11.11.1984', '4672329383', '4'),
(5, 'Иван', '9778563214', '02.12.1986', '5588963258', '123'),
(6, 'Petr Petrovich', '6', '12.12.1990', '6', '6'),
(7, 'Смирнов Егор Александрович', '9995554466', '12.05.2002', '7895456321', '1236'),
(8, 'Владимир', '9003336655', '14.11.1995', '1122123456', '4568');

-- --------------------------------------------------------

--
-- Структура таблицы `запросы`
--

CREATE TABLE `запросы` (
  `ID` int(11) NOT NULL,
  `ID_клиента` int(11) DEFAULT NULL,
  `Время_запроса` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_квартиры` int(11) DEFAULT NULL,
  `Статус` enum('В обработке','Выполнен') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `запросы`
--

INSERT INTO `запросы` (`ID`, `ID_клиента`, `Время_запроса`, `ID_квартиры`, `Статус`) VALUES
(1, 1, '2024-04-07 13:36:19', 4, 'В обработке');

-- --------------------------------------------------------

--
-- Структура таблицы `сделки`
--

CREATE TABLE `сделки` (
  `Код сделки` int(11) NOT NULL,
  `Сумма` int(11) NOT NULL,
  `Дата` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Статус` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Тип` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID-клиента` int(11) NOT NULL,
  `ID-сотрудника` int(11) NOT NULL,
  `ID-квартиры` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `сделки`
--

INSERT INTO `сделки` (`Код сделки`, `Сумма`, `Дата`, `Статус`, `Тип`, `ID-клиента`, `ID-сотрудника`, `ID-квартиры`) VALUES
(1, 3840000, '12.03.2005', 'Завершена', 'Продажа', 2, 3, 2),
(2, 2640000, '23.09.2009', 'В процессе', 'Аренда', 2, 2, 1),
(3, 8679000, '05.06.2019', 'Неудача', 'Покупка', 3, 1, 4),
(4, 4279000, '19.12.2012', 'Завершена', 'Продажа', 4, 5, 5),
(5, 5600000, '24.07.2008', 'В процессе', 'Покупка', 1, 1, 3),
(14, 555000, '24.05.2024', 'В процессе', 'Аренда', 1, 2, 5),
(15, 12345, '17.09.2005', 'В процессе', 'Аренда', 1, 4, 5),
(16, 50023, '17.10.2010', 'Завершена', 'Покупка', 1, 2, 5),
(17, 20000, '12.05.2023', 'В процессе', 'Аренда', 1, 3, 5),
(18, 3500000, '16.05.2024', 'Завершена', 'Покупка', 7, 8, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `сотрудники`
--

CREATE TABLE `сотрудники` (
  `ID-сотрудника` int(11) NOT NULL,
  `ФИО` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Телефон` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Должность` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID-филиала` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `сотрудники`
--

INSERT INTO `сотрудники` (`ID-сотрудника`, `ФИО`, `Телефон`, `Должность`, `ID-филиала`) VALUES
(1, 'Цветаева Марина Ивановна', '8169110101', 'Риелтор', 1),
(2, 'Бунин Иван Алексеевич', '8169110102', 'Риелтор', 2),
(3, 'Есенин Сергей Александрович', '8169110201', 'Юрист', 3),
(4, 'Ахматова Анна Андреевна', '8169110000', 'Оператор', 2),
(5, 'Гумилёв Николай Степанович', '8169110222', 'Юрист', 2),
(7, 'Петров', '1112', 'Юрист', 2),
(8, 'Грушницкий Александр', '89568541232', 'Риелтор', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `филиалы`
--

CREATE TABLE `филиалы` (
  `ID-филиала` int(11) NOT NULL,
  `Адрес` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `филиалы`
--

INSERT INTO `филиалы` (`ID-филиала`, `Адрес`) VALUES
(1, 'Санкт-Петербург, Лиговский проспект, 27'),
(2, 'Санкт-Петербург, Красного курсанта, 21'),
(3, 'Санкт-Петербург, Черкасова, 25');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`ID-mail`);

--
-- Индексы таблицы `квартиры`
--
ALTER TABLE `квартиры`
  ADD PRIMARY KEY (`ID-квартиры`);

--
-- Индексы таблицы `клиенты`
--
ALTER TABLE `клиенты`
  ADD PRIMARY KEY (`ID-клиента`);

--
-- Индексы таблицы `запросы`
--
ALTER TABLE `запросы`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `сделки`
--
ALTER TABLE `сделки`
  ADD PRIMARY KEY (`Код сделки`);

--
-- Индексы таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD PRIMARY KEY (`ID-сотрудника`);

--
-- Индексы таблицы `филиалы`
--
ALTER TABLE `филиалы`
  ADD PRIMARY KEY (`ID-филиала`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
  MODIFY `ID-mail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `квартиры`
--
ALTER TABLE `квартиры`
  MODIFY `ID-квартиры` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `клиенты`
--
ALTER TABLE `клиенты`
  MODIFY `ID-клиента` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `запросы`
--
ALTER TABLE `запросы`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `сделки`
--
ALTER TABLE `сделки`
  MODIFY `Код сделки` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  MODIFY `ID-сотрудника` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `филиалы`
--
ALTER TABLE `филиалы`
  MODIFY `ID-филиала` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
