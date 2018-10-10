-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 10, 2018 lúc 08:32 AM
-- Phiên bản máy phục vụ: 5.7.21
-- Phiên bản PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mobile`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

DROP TABLE IF EXISTS `manufactures`;
CREATE TABLE IF NOT EXISTS `manufactures` (
  `manu_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã hãng',
  `manu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên hãng',
  `manu_img` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hình ảnh hãng',
  PRIMARY KEY (`manu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`manu_ID`, `manu_name`, `manu_img`) VALUES
(1, 'Apple', 'manu_img1.png'),
(2, 'Oppo', 'manu_img2.png'),
(3, 'Samsung', 'manu_img3.png'),
(4, 'Xiaomi', 'manu_img4.png'),
(5, 'Nokia', 'manu_img5.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên sản phẩm',
  `image` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'hình sản phẩm',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'mô tả sản phẩm',
  `manu_ID` int(11) NOT NULL COMMENT 'mã hãng sản xuất của sản phẩm',
  `type_ID` int(11) NOT NULL COMMENT 'mã loại sản phẩm',
  `price` int(11) DEFAULT NULL COMMENT 'giá sản phẩm',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=314 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `name`, `image`, `description`, `manu_ID`, `type_ID`, `price`) VALUES
(1, 'product1', 'img1.png', 'Day la 1 cu lua', 1, 1, 2000),
(2, 'product2', 'img2.png', 'Cu lua 1', 1, 1, 1000),
(3, 'product3', 'img3.png', 'Cu lua 2', 1, 1, 2000),
(4, 'product4', 'img4.png', 'Cu lua 3', 1, 1, 3000),
(5, 'product5', 'img5.png', 'Cu lua 4', 1, 1, 4000),
(6, 'product6', 'img6.png', 'Cu lua 5', 2, 2, 5000),
(7, 'product7', 'img7.png', 'iphone1.png', 2, 2, 6000),
(8, 'product8', 'img8.png', 'iphone1.png', 2, 2, 7),
(9, 'product9', 'img9.png', 'iphone1.png', 2, 2, 8),
(10, 'product10', 'img10.png', 'iphone1.png', 2, 2, 9),
(11, 'product11', 'img11.png', 'iphone1.png', 3, 3, 10),
(12, 'product12', 'img12.png', '11', 3, 3, 11),
(13, 'product13', 'img13.png', 'iphone1.png', 3, 3, 12),
(14, 'product14', 'img14.png', 'iphone1.png', 3, 3, 13),
(15, 'product15', 'img15.png', 'iphone1.png', 3, 3, 14),
(16, 'product16', 'img16.png', 'iphone1.png', 4, 4, 15),
(17, 'product17', 'img17.png', 'iphone1.png', 4, 4, 16),
(18, 'product18', 'img18.png', 'iphone1.png', 4, 4, 17),
(19, 'product19', 'img19.png', 'iphone1.png', 4, 4, 18),
(20, 'product20', 'img20.png', 'Cu lua 2', 4, 4, 2000),
(21, 'product21', 'img21.png', 'iphone1.png', 5, 5, 16),
(22, 'product22', 'img22.png', 'iphone1.png', 5, 5, 17),
(23, 'product23', 'img23.png', 'iphone1.png', 5, 5, 18),
(24, 'product24', 'img24.png', 'Cu lua 2', 5, 5, 2000),
(25, 'product25', 'img25.png', 'Cu lua 3', 5, 5, 3000),
(313, 'asdadad', 'select-files-to-copy.png', 'eqwe', 1, 1, 23123);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `protypes`
--

DROP TABLE IF EXISTS `protypes`;
CREATE TABLE IF NOT EXISTS `protypes` (
  `type_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại',
  `type_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên loại',
  `type_img` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'hình ảnh loại sản phẩm',
  PRIMARY KEY (`type_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `protypes`
--

INSERT INTO `protypes` (`type_ID`, `type_name`, `type_img`) VALUES
(1, 'màu đen', 'type_img1.png'),
(2, 'màu trắng', 'type_img2.png'),
(3, 'màu vàng', 'type_img3.png'),
(4, 'màu hồng', 'type_img4.png'),
(5, 'màu xanh dương', 'type_img5.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã user',
  `user_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên user',
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'mật khẩu',
  PRIMARY KEY (`user_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_ID`, `user_name`, `user_password`) VALUES
(1, 'admin', '123456'),
(2, 'guest', '789132');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
