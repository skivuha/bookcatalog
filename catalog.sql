-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2015 г., 01:00
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Blake Crouch'),
(2, 'Harlan Coben'),
(3, 'Lisa Gardner'),
(4, 'Blake Crouch');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `img`, `price`) VALUES
(1, 'Seveneves', 'From the #1 New York Times bestselling author of Anathem, Reamde, and Cryptonomicon comes an exciting and thought-provoking science fiction epic—a grand story of annihilation and survival spanning five thousand years.', 'seveneves.jpg', 20),
(2, 'Queen of the Trailer Park', 'What would you do if you suddenly had all the money you could ever need? It’s a universal fantasy, especially when times are tight. At the opening of Queen of the Trailer Park, Rosie Maldonne’s kids stumble upon an envelope full of cash in a McDonald’s tr', 'queen.jpg', 15),
(4, 'The Girl on the Train', 'Like its train, the story blasts through the stagnation of these lives in suburban London and the reader cannot help but turn pages', 'novel.jpg', 10),
(5, 'Pines', 'The international runaway bestseller is now a Major Television Event from executive producer M. Night Shyamalan, starring Matt Dillon Thursdays on FOX or catch up on Amazon Instant Video.', 'pines.jpg', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `book_author`
--

INSERT INTO `book_author` (`id`, `book`, `author`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 4, 3),
(5, 5, 2),
(7, 5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `book_genre`
--

CREATE TABLE IF NOT EXISTS `book_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `book_genre`
--

INSERT INTO `book_genre` (`id`, `book`, `genre`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 4, 2),
(5, 5, 2),
(7, 5, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Drama'),
(2, 'Detective'),
(3, 'Action');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
