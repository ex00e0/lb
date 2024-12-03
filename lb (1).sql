-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 03 2024 г., 11:27
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('лекции','семинары','конференции') NOT NULL,
  `date` date NOT NULL,
  `people` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `name`, `type`, `date`, `people`) VALUES
(1, 'Лекция 1', 'лекции', '2023-11-02', 10),
(2, 'Семинар 1', 'семинары', '2024-11-01', 25),
(3, 'Семинар 2', 'семинары', '2024-08-10', 18),
(4, 'Лекция 2', 'лекции', '2024-11-29', 66),
(5, 'Конференция 1', 'конференции', '2024-12-01', 47),
(6, 'Конференция 66', 'конференции', '2024-11-08', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `average` decimal(8,2) NOT NULL,
  `marks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `average`, `marks`) VALUES
(1, 'Марина', '4.30', 8),
(2, 'София', '4.80', 15),
(3, 'Карина', '4.15', 8),
(4, 'Василий', '3.00', 18),
(5, 'Арсений', '2.60', 5),
(6, 'Яна', '2.10', 3),
(7, 'Иван', '4.19', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `test_id` int NOT NULL,
  `word_id` int NOT NULL,
  `is_correct` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `test_id`, `word_id`, `is_correct`) VALUES
(1, 1, 62, 'false'),
(2, 1, 58, 'false'),
(3, 1, 68, 'false'),
(4, 1, 48, 'false'),
(5, 1, 58, 'false'),
(6, 2, 62, 'false'),
(7, 2, 58, 'false'),
(8, 2, 68, 'false'),
(9, 2, 48, 'false'),
(10, 2, 58, 'false'),
(11, 3, 35, 'false'),
(12, 3, 38, 'false'),
(13, 3, 39, 'false'),
(14, 3, 15, 'false'),
(15, 3, 24, 'false'),
(16, 4, 35, 'false'),
(17, 4, 38, 'false'),
(18, 4, 39, 'false'),
(19, 4, 15, 'false'),
(20, 4, 24, 'false'),
(21, 5, 19, 'false'),
(22, 5, 60, 'false'),
(23, 5, 28, 'false'),
(24, 5, 55, 'false'),
(25, 5, 10, 'false'),
(26, 6, 19, 'false'),
(27, 6, 60, 'false'),
(28, 6, 28, 'false'),
(29, 6, 55, 'false'),
(30, 6, 10, 'false'),
(31, 7, 20, 'true'),
(32, 7, 61, 'true'),
(33, 7, 29, 'false'),
(34, 7, 56, 'false'),
(35, 7, 11, 'false'),
(36, 8, 20, 'true'),
(37, 8, 61, 'true'),
(38, 8, 29, 'true'),
(39, 8, 56, 'true'),
(40, 8, 11, 'true'),
(41, 9, 20, 'true'),
(42, 9, 61, 'true'),
(43, 9, 29, 'true'),
(44, 9, 56, 'true'),
(45, 9, 11, 'true'),
(46, 10, 20, 'true'),
(47, 10, 61, 'true'),
(48, 10, 29, 'true'),
(49, 10, 56, 'true'),
(50, 10, 11, 'true'),
(51, 11, 27, 'true'),
(52, 11, 32, 'true'),
(53, 11, 13, 'true'),
(54, 11, 3, 'true'),
(55, 11, 22, 'true'),
(56, 12, 45, 'true'),
(57, 12, 3, 'true'),
(58, 12, 33, 'true'),
(59, 12, 60, 'true'),
(60, 12, 38, 'true'),
(61, 13, 95, 'false'),
(62, 13, 74, 'false'),
(63, 13, 90, 'false'),
(64, 13, 78, 'false'),
(65, 13, 111, 'false'),
(66, 14, 75, 'false'),
(67, 14, 72, 'false'),
(68, 14, 75, 'false'),
(69, 14, 82, 'false'),
(70, 14, 80, 'false'),
(71, 15, 74, 'true'),
(72, 15, 71, 'false'),
(73, 15, 74, 'false'),
(74, 15, 81, 'false'),
(75, 15, 79, 'false'),
(76, 16, 73, 'true'),
(77, 16, 98, 'true'),
(78, 16, 99, 'false'),
(79, 16, 95, 'true'),
(80, 16, 73, 'false'),
(81, 17, 73, 'true'),
(82, 17, 98, 'true'),
(83, 17, 99, 'false'),
(84, 17, 95, 'true'),
(85, 17, 73, 'false');

-- --------------------------------------------------------

--
-- Структура таблицы `tests_main`
--

CREATE TABLE `tests_main` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `language` enum('английский','французский','немецкий') NOT NULL DEFAULT 'английский'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tests_main`
--

INSERT INTO `tests_main` (`id`, `date`, `language`) VALUES
(1, '2024-12-03', 'английский'),
(2, '2024-12-03', 'английский'),
(3, '2024-12-03', 'английский'),
(4, '2024-12-03', 'английский'),
(5, '2024-12-03', 'английский'),
(6, '2024-12-03', 'английский'),
(7, '2024-12-03', 'английский'),
(8, '2024-12-03', 'английский'),
(9, '2024-12-03', 'английский'),
(10, '2024-12-03', 'английский'),
(11, '2024-11-22', 'английский'),
(12, '2024-11-08', 'английский'),
(13, '2024-12-03', 'французский'),
(14, '2024-12-03', 'французский'),
(15, '2024-12-03', 'французский'),
(16, '2024-12-03', 'французский'),
(17, '2024-12-03', 'французский');

-- --------------------------------------------------------

--
-- Структура таблицы `words`
--

CREATE TABLE `words` (
  `id` int NOT NULL,
  `word` varchar(255) NOT NULL,
  `language` enum('английский','французский','немецкий') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'английский',
  `translation_ru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `words`
--

INSERT INTO `words` (`id`, `word`, `language`, `translation_ru`) VALUES
(1, 'apple', 'английский', 'яблоко'),
(2, 'banana', 'английский', 'банан'),
(3, 'car', 'английский', 'машина'),
(4, 'dog', 'английский', 'собака'),
(5, 'elephant', 'английский', 'слон'),
(6, 'flower', 'английский', 'цветок'),
(7, 'guitar', 'английский', 'гитара'),
(8, 'house', 'английский', 'дом'),
(9, 'island', 'английский', 'остров'),
(10, 'jacket', 'английский', 'куртка'),
(11, 'kite', 'английский', 'воздушный змей'),
(12, 'lamp', 'английский', 'лампа'),
(13, 'mountain', 'английский', 'гора'),
(14, 'notebook', 'английский', 'тетрадь'),
(15, 'orange', 'английский', 'апельсин'),
(16, 'pencil', 'английский', 'карандаш'),
(17, 'queen', 'английский', 'королева'),
(18, 'rabbit', 'английский', 'кролик'),
(19, 'sun', 'английский', 'солнце'),
(20, 'table', 'английский', 'стол'),
(21, 'umbrella', 'английский', 'зонт'),
(22, 'violin', 'английский', 'скрипка'),
(23, 'window', 'английский', 'окно'),
(24, 'xylophone', 'английский', 'ксилофон'),
(25, 'yellow', 'английский', 'желтый'),
(26, 'zebra', 'английский', 'зебра'),
(27, 'airplane', 'английский', 'самолет'),
(28, 'beach', 'английский', 'пляж'),
(29, 'chair', 'английский', 'стул'),
(30, 'desk', 'английский', 'письменный стол'),
(31, 'egg', 'английский', 'яйцо'),
(32, 'fish', 'английский', 'рыба'),
(33, 'grape', 'английский', 'виноград'),
(34, 'hat', 'английский', 'шляпа'),
(35, 'ice', 'английский', 'лед'),
(36, 'juice', 'английский', 'сок'),
(37, 'key', 'английский', 'ключ'),
(38, 'lemon', 'английский', 'лимон'),
(39, 'milk', 'английский', 'молоко'),
(40, 'nose', 'английский', 'нос'),
(41, 'ocean', 'английский', 'океан'),
(42, 'pen', 'английский', 'ручка'),
(43, 'quilt', 'английский', 'одеяло'),
(44, 'rain', 'английский', 'дождь'),
(45, 'sandwich', 'английский', 'сэндвич'),
(46, 'tree', 'английский', 'дерево'),
(47, 'umbrella', 'английский', 'зонт'),
(48, 'vase', 'английский', 'ваза'),
(49, 'water', 'английский', 'вода'),
(50, 'zebra', 'английский', 'зебра'),
(51, 'ant', 'английский', 'муравей'),
(52, 'bear', 'английский', 'медведь'),
(53, 'cat', 'английский', 'кот'),
(54, 'duck', 'английский', 'утка'),
(55, 'elephant', 'английский', 'слон'),
(56, 'frog', 'английский', 'лягушка'),
(57, 'goat', 'английский', 'коза'),
(58, 'horse', 'английский', 'лошадь'),
(59, 'iguana', 'английский', 'игуана'),
(60, 'jellyfish', 'английский', 'медуза'),
(61, 'kangaroo', 'английский', 'кенгуру'),
(62, 'lion', 'английский', 'лев'),
(63, 'monkey', 'английский', 'обезьяна'),
(64, 'newt', 'английский', 'тритон'),
(65, 'owl', 'английский', 'сова'),
(66, 'penguin', 'английский', 'пингвин'),
(67, 'quail', 'английский', 'перепел'),
(68, 'rabbit', 'английский', 'кролик'),
(69, 'snake', 'английский', 'змея'),
(70, 'fourmi', 'французский', 'муравей'),
(71, 'ours', 'французский', 'медведь'),
(72, 'chat', 'французский', 'кот'),
(73, 'canard', 'французский', 'утка'),
(74, 'éléphant', 'французский', 'слон'),
(75, 'grenouille', 'французский', 'лягушка'),
(76, 'chèvre', 'французский', 'коза'),
(77, 'cheval', 'французский', 'лошадь'),
(78, 'iguane', 'французский', 'игуана'),
(79, 'méduse', 'французский', 'медуза'),
(80, 'kangourou', 'французский', 'кенгуру'),
(81, 'lion', 'французский', 'лев'),
(82, 'singe', 'французский', 'обезьяна'),
(83, 'triton', 'французский', 'тритон'),
(84, 'hibou', 'французский', 'сова'),
(85, 'pingouin', 'французский', 'пингвин'),
(86, 'caille', 'французский', 'перепел'),
(87, 'lapin', 'французский', 'кролик'),
(88, 'serpent', 'французский', 'змея'),
(89, 'tigre', 'французский', 'тигр'),
(90, 'oursin', 'французский', 'морской еж'),
(91, 'vautour', 'французский', 'стервятник'),
(92, 'baleine', 'французский', 'кит'),
(93, 'xerus', 'французский', 'земляной белка'),
(94, 'yack', 'французский', 'як'),
(95, 'zebu', 'французский', 'зебу'),
(96, 'pomme', 'французский', 'яблоко'),
(97, 'banane', 'французский', 'банан'),
(98, 'carotte', 'французский', 'морковь'),
(99, 'datte', 'французский', 'финик'),
(100, 'aubergine', 'французский', 'баклажан'),
(101, 'figue', 'французский', 'инжир'),
(102, 'raisin', 'французский', 'виноград'),
(103, 'miel', 'французский', 'мёд'),
(104, 'glace', 'французский', 'мороженое'),
(105, 'confiture', 'французский', 'варенье'),
(106, 'kiwi', 'французский', 'киви'),
(107, 'citron', 'французский', 'лимон'),
(108, 'mangue', 'французский', 'манго'),
(109, 'nectarine', 'французский', 'нектарин'),
(110, 'orange', 'французский', 'апельсин'),
(111, 'pêche', 'французский', 'персик'),
(112, 'coing', 'французский', 'айва'),
(113, 'framboise', 'французский', 'малина'),
(114, 'fraise', 'французский', 'клубника'),
(115, 'tomate', 'французский', 'помидор'),
(116, 'fruit ugli', 'французский', 'угливый фрукт'),
(117, 'vanille', 'французский', 'ваниль'),
(118, 'pastèque', 'французский', 'арбуз'),
(119, 'xigua', 'французский', 'китайский арбуз'),
(120, 'pastèque jaune', 'французский', 'желтый арбуз'),
(121, 'courgette', 'французский', 'кабачок');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `word_id` (`word_id`);

--
-- Индексы таблицы `tests_main`
--
ALTER TABLE `tests_main`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT для таблицы `tests_main`
--
ALTER TABLE `tests_main`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `words`
--
ALTER TABLE `words`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests_main` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
