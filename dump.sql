-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.39-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных pizza
CREATE DATABASE IF NOT EXISTS `pizza` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `pizza`;

-- Дамп структуры для таблица pizza.pizza
CREATE TABLE IF NOT EXISTS `pizza` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы pizza.pizza: ~4 rows (приблизительно)
INSERT INTO `pizza` (`id`, `name`, `description`) VALUES
	(1, 'Pepperoni', 'Tasty peperoni'),
	(2, 'local', 'tasty local pizza'),
	(3, 'Hawaian', 'tasty'),
	(4, 'Mashroom', NULL);

-- Дамп структуры для таблица pizza.pizza_options
CREATE TABLE IF NOT EXISTS `pizza_options` (
  `id` int(10) unsigned NOT NULL,
  `pizza_id` int(10) unsigned NOT NULL,
  `price` float NOT NULL,
  `size` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pizza_id` (`pizza_id`),
  CONSTRAINT `FK_pizza_options_pizza` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы pizza.pizza_options: ~7 rows (приблизительно)
INSERT INTO `pizza_options` (`id`, `pizza_id`, `price`, `size`) VALUES
	(1, 1, 3, 21),
	(2, 1, 5, 26),
	(3, 1, 7, 31),
	(4, 2, 4, 26),
	(5, 2, 6, 31),
	(6, 3, 9, 31),
	(7, 4, 10, 31);

-- Дамп структуры для таблица pizza.sauces
CREATE TABLE IF NOT EXISTS `sauces` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Дамп данных таблицы pizza.sauces: ~4 rows (приблизительно)
INSERT INTO `sauces` (`id`, `name`) VALUES
	(1, 'Barbeq'),
	(2, 'sweet and sour'),
	(3, 'Chesse'),
	(4, 'garlicky');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
