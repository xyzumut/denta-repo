-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 23 Oca 2024, 18:41:12
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `denta_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) NOT NULL,
  `page_count` int NOT NULL,
  `release_date` date NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `book`
--

INSERT INTO `book` (`id`, `book_name`, `page_count`, `release_date`, `category_id`) VALUES
(1, 'Cesur Yeni Dünya', 23, '2024-01-17', 1),
(2, 'Yeniden Yaşasaydım', 341, '2017-01-11', 3),
(3, 'İki Şehrin Hikayesi\r\n', 836, '2014-01-16', 5),
(4, 'Teksas Postası – Red Kit 7\r\n', 78, '2016-01-05', 2),
(5, 'Ustam ve Ben\r\n', 2165, '2024-01-11', 3),
(6, 'Cumhuriyet Çınarı\r\n', 891, '2018-01-17', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Aşk'),
(2, 'Edebiyat'),
(3, 'Ansiklopedi'),
(4, 'Dedektiflik'),
(5, 'Macera');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
