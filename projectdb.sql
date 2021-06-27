-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Haz 2021, 00:43:08
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `projectdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`user_id`, `name`, `lastname`, `email`, `password`) VALUES
(1, 'gizem', 'pesen', 'gizempesen@gmail.com', '123456'),
(2, 'gizem', 'pesen', 'pesenzuhal2@gmail.com', '$2y$10$.Aj2HeDI11UD4kLJ7iE/Tektae/UfIwnL1cWpDakPPYo2MQAptgZG'),
(3, 'Gizemcart', 'cart', 'pesenzuh@gmail.com', '$2y$10$1Y8cGedhhhlYbYg4yB0xbud8PSPtVWL8DllPcEz3aWS8vrzlpbK3y');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'n95'),
(2, 'black mask'),
(3, 'anime mask'),
(4, 'couple mask'),
(5, 'special mask');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `creditcard`
--

CREATE TABLE `creditcard` (
  `card_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `cardnumber` varchar(40) NOT NULL,
  `cardholdername` varchar(40) NOT NULL,
  `date` varchar(40) NOT NULL,
  `cvv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `creditcard`
--

INSERT INTO `creditcard` (`card_id`, `address`, `cardnumber`, `cardholdername`, `date`, `cvv`) VALUES
(1, 'dffsfs', '34324', 'lgö?l', '34', 243),
(2, 'bahçe mahallesi', '23578478645', 'Gizem Pesen', '07/09', 234),
(3, 'bahçe mahallesi', '23578478645', 'Gizem Pesen', '07/09', 234),
(4, 'bahçe mahallesi', '93749384', 'Gizem Pesen', '07/21', 234);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`user_id`, `name`, `lastname`, `email`, `password`) VALUES
(1, 'Jake', 'Peralta', 'jakeperalta@example.com', '$2y$10$CTj/xva6IZPkVrz9lDzDnO1xrIMPLQ22238ooiHak8ngUqm9MDYye'),
(2, 'gizem', 'kurnaz', 'gizemkurnaz25399@gmail.com', '$2y$10$EUQeL3FUJzcMGDy90eDijOXUfvmZNS3SFKWY.2OSSFCIoLE5nWBc6'),
(3, 'Gizem', 'Pesen', 'pesengizem@gmail.com', '$2y$10$.Aj2HeDI11UD4kLJ7iE/Tektae/UfIwnL1cWpDakPPYo2MQAptgZG'),
(4, 'Gizem', 'Pesen', 'pesenzuhal2@gmail.com', '$2y$10$GTH5io6Pn1pDtVNCgdnh4.z.C/iCJR.Fv3WQs.iDDpQkyw8np2e1C');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` tinyint(4) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `description`, `image`, `price`) VALUES
(4, 3, 'Anime Mask 1', 'Mask with cute face', 'anime_1.jpg', 15),
(5, 3, 'Anime Mask 2', 'it is a packet that have 6 mask', 'anime_2.jpg', 25),
(6, 2, 'Black Mask 1', 'This mask is 3-layer and protective.', 'black_1.jpg', 33),
(7, 2, 'Black Mask 2', 'This mask is black and synthetic.', 'black_2.jpg', 12),
(8, 2, 'Black Mask 3', 'This mask belongs to a famous brand.', 'black_3.jpg', 21),
(9, 1, 'N95 Mask 1', 'N95 is one of the most protective masks.', 'n95_1.jpg', 23),
(10, 1, 'N95 Mask 2', 'This is a version of n95 that allows more oxygen to pass through.', 'n95_2.jpg', 15),
(11, 2, 'Black Mask 4', 'With this mask type, you can show a certain brand on your mask.', 'black_4.jpg', 12),
(12, 1, 'N95 Mask 3', 'Niosh n95 mask series', 'n95_3.jpg', 13),
(13, 4, 'Mr and Mrs Mask', 'With this mask, you can feel close with your lover during corona days.', 'couple_1.jpg', 10),
(14, 4, 'Couple Mask', 'It is the most preferred couple mask.', 'couple_2.jpeg', 25),
(15, 5, 'Fancy Mask', 'This mask is very different from the masks we know.', 'special_mask_1.png', 30),
(16, 5, 'Horror Mask', 'You can scare your friends with this mask.', 'special_mask_2.png', 23),
(36, 3, 'Naruto Mask', 'The Naruto mask is one of the most purchased items by otaku.', 'anime_3.jpg', 42),
(43, 1, 'Ege Mask', 'Ege 700 Ffp3 N95 Ventilsiz Maske 25\'li', 'ege.jpg', 60),
(44, 1, '3M N95', '3M N95 9152E Ffp2 Vflex Solunum Maskesi', '3mn95.jpg', 10),
(45, 1, 'Musk N95', 'Musk Ffp2 N95 Koruyucu Maske - 10 Adet', 'musk.jpg', 33);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wire`
--

CREATE TABLE `wire` (
  `wire_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `accountname` varchar(50) NOT NULL,
  `accountnumber` int(50) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `iban` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `wire`
--

INSERT INTO `wire` (`wire_id`, `address`, `accountname`, `accountnumber`, `bankname`, `iban`) VALUES
(1, 'bahçe mahallesi', 'gizem pesen', 83246873, 'ziraat', 928309384),
(2, 'ççek mah', 'gizem pesen2', 238273, 'ziraat', 2832973),
(3, 'çilek mah', 'gizem pesen2', 8372974, 'ziraat', 823789247),
(4, 'çilek mah', 'gizem pesen2', 8372974, 'ziraat', 823789247),
(5, 'çilek mah', 'gizem pesen2', 8372974, 'ziraat', 823789247),
(6, 'çilek mah', 'gizem pesen2', 8372974, 'ziraat', 823789247);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`card_id`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `wire`
--
ALTER TABLE `wire`
  ADD PRIMARY KEY (`wire_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `wire`
--
ALTER TABLE `wire`
  MODIFY `wire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
