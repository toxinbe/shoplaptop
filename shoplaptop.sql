-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2025 at 10:43 AM
-- Server version: 9.1.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoplaptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `id_bill` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_customer` int UNSIGNED NOT NULL,
  `date_order` date DEFAULT NULL,
  `order_code` varchar(50) NOT NULL,
  `total` float DEFAULT NULL COMMENT 'tổng tiền',
  `payment` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT 'hình thức thanh toán',
  `status_bill` int NOT NULL,
  PRIMARY KEY (`id_bill`),
  KEY `bills_ibfk_1` (`id_customer`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id_bill`, `id_customer`, `date_order`, `order_code`, `total`, `payment`, `status_bill`) VALUES
(173, 186, '2022-03-21', '90097', 19000000, 'COD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

DROP TABLE IF EXISTS `bill_detail`;
CREATE TABLE IF NOT EXISTS `bill_detail` (
  `id_bill_detail` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_bill` int UNSIGNED NOT NULL,
  `id_post_bill_detail` int NOT NULL,
  `id_product` int UNSIGNED NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `quantity` int DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bill_detail`),
  KEY `bill_detail_ibfk_2` (`id_product`),
  KEY `id_bill` (`id_bill`),
  KEY `id_post_bill_detail` (`id_post_bill_detail`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`id_bill_detail`, `id_bill`, `id_post_bill_detail`, `id_product`, `order_code`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(115, 173, 10, 95, '90097', 1, 19000000, '2022-03-21 04:11:52', '2022-03-21 04:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `coupon_id` int NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_qty` int NOT NULL,
  `coupon_number` int NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_condition` int NOT NULL,
  `coupon_date_start` varchar(50) NOT NULL,
  `coupon_date_end` varchar(50) NOT NULL,
  `coupon_status` int NOT NULL,
  `coupon_used` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `email`, `address`, `phone_number`, `note`, `created_at`, `updated_at`) VALUES
(186, 'tu dinh ngu', 'nam', 'dsadsa123@gmail.com', 'dsadsa', '0123', NULL, '2022-03-21 04:11:52', '2022-03-21 04:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id_payment` int NOT NULL AUTO_INCREMENT,
  `id_post_payment` int NOT NULL,
  `id_customer` int UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `code_bank` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `id_customer` (`id_customer`,`id_post_payment`),
  KEY `id_post_payment` (`id_post_payment`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `sp_vi` varchar(255) NOT NULL,
  `sp_en` varchar(255) NOT NULL,
  `description_vi` text,
  `description_en` text,
  `product_slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `sp_vi`, `sp_en`, `description_vi`, `description_en`, `product_slug`) VALUES
(1, 'Sản Phẩm 1', 'Product 1', '<p>D&ograve;ng m&aacute;y Thinkpad T460S thiết kế sang trọng v&agrave; cứng c&aacute;p</p>\r\n\r\n<p>CPU: Intel Core i3-10210U (thế hệ thứ 10).</p>\r\n\r\n<p>RAM: DDR4 8 GB&nbsp;(On board 4 GB +1 khe 4 GB).</p>\r\n\r\n<p>Ổ cứng: SSD 120GB M.2 PCIe, hỗ trợ khe cắm HDD SATA.</p>\r\n\r\n<p>Card đồ họa rời:&nbsp;NVIDIA GeForce MX250 2 GB.</p>', '<p>description 1</p>', 'san-pham-1'),
(2, 'Sản Phẩm 2', 'Product 2', '<p>CPU: Intel Core i5-10210U (thế hệ thứ 10).</p>\r\n\r\n<p>RAM: DDR4 8 GB&nbsp;(On board 4 GB +1 khe 4 GB).</p>\r\n\r\n<p>Ổ cứng: SSD 512 GB M.2 PCIe, hỗ trợ khe cắm HDD SATA.</p>\r\n\r\n<p>Card đồ họa rời:&nbsp;NVIDIA GeForce MX250 2 GB.</p>', '<p>description 2</p>', 'san-pham-2'),
(3, 'Sản Phẩm 3', 'Product 3', '<p>D&ograve;ng sản phẩm: MacBook</p>  <p>Tốc độ CPU: 2.0GHz</p>  <p>Bộ xử l&yacute; đồ họa (GPU): NVIDIA GeForce 9400M</p>  <p>Độ lớn m&agrave;n h&igrave;nh (inch): 13.3 inch</p>  <p>Ổ cứng (HDD): 160GB</p>  <p>Loại bộ vi xử l&yacute; (CPU): Intel Core 2 Duo</p>  <p>Dung lượng bộ nhớ ch&iacute;nh (RAM): 2.0GB</p>', 'description 3', 'san-pham-3'),
(4, 'Sản Phẩm 4', 'Product 4', '<p>CPU: Intel Core i7 720QM 4 nh&acirc;n x 1,6Ghz, Turboboost 2,8Ghz.</p>  <p>RAM: 2GB x 2 DD3 8500 1066Mhz.<br /> Card đồ họa: nVidia GTX260, 1GB VRAM<br /> Ổ cứng: 2 x 500GB, 7200 v&ograve;ng.<br /> Ổ đĩa: đọc Bluray, đọc + ghi DVD/CD.<br /> Giao tiếp: 4 cổng USB, ng&otilde; nhập/xuất audio, microphone, khe đọc thẻ SD/MMC/MS, Express Card 54, HDMI, eSata, mini-FireWire, cổng VGA.<br /> Pin: 6 cell, 4800mAh</p>', 'description 4', 'san-pham-4'),
(5, 'Sản Phẩm 5', 'Product 5', '<p>CPU: Intel Core i7 2630QM, 2.00 GHz<br />\r\nBộ nhớ: DDR3, 8 GB.<br />\r\nỔ đĩa 750GB 7200Rpm<br />\r\nM&agrave;n h&igrave;nh: 15.6 inch Led HD 1366- 768<br />\r\nĐồ họa: NVIDIA GeForce GTX 460M, 1.5 GB Uptu 3GB 192Bit&nbsp;<br />\r\n&Acirc;m thanh 2.1 C&ocirc;ng nghệ EAX Advanced HD 5.0, THX TruStudio Pro</p>', 'description 5', 'san-pham-5'),
(6, 'Sản Phẩm 6', 'Product 6', '<p>CPU: Intel Core i7 2630QM, 2.00 GHz<br /> Bộ nhớ: DDR3, 8 GB.<br /> Ổ đĩa 750GB 7200Rpm<br /> M&agrave;n h&igrave;nh: 15.6 inch Led HD 1366- 768<br /> Đồ họa: NVIDIA GeForce GTX 460M, 1.5 GB Uptu 3GB 192Bit&nbsp;<br /> &Acirc;m thanh 2.1 C&ocirc;ng nghệ EAX Advanced HD 5.0, THX TruStudio Pro</p>', 'description 6', 'san-pham-6'),
(7, 'Sản Phẩm 7', 'Product 7', '<p>CPU: Intel Core i5-10210U (thế hệ thứ 10).</p>\r\n\r\n<p>RAM: DDR4 8 GB&nbsp;(On board 4 GB +1 khe 4 GB).</p>\r\n\r\n<p>Ổ cứng: SSD 512 GB M.2 PCIe, hỗ trợ khe cắm HDD SATA.</p>\r\n\r\n<p>Card đồ họa rời:&nbsp;NVIDIA GeForce MX250 2 GB.</p>', 'description 7', 'san-pham-7'),
(8, 'Sản Phẩm 8', 'Product 8', '<p>bgfbgf</p>', 'description 8', 'san-pham-8'),
(9, 'Sản Phẩm 9', 'Product 9', '<p>Dell XPS 13 7390 I5 10210U 8GB 256SS 13.3FHD W10 Finger Silver</p>', 'description 9', 'san-pham-9'),
(10, 'Sản Phẩm 10', 'Product 10', 'frferwfrwferfe', 'description 10', 'san-pham-10'),
(11, 'Sản Phẩm 11', 'Product 11', '<p>HP Envy 13 ba1027TU i5 1135G7/8GB/256GB/Office H&amp;S2019/Win10 (2K0B1PA)</p>', 'description 11', 'san-pham-11'),
(13, 'Sản Phẩm 12', 'Product 12', 'Lenovo Thinkpad T490s', 'description 12', 'san-pham-12'),
(14, 'Sản Phẩm 13', 'Product 13', '<p>ssssssssssss</p>', 'description 13', 'san-pham-13'),
(15, 'Sản Phẩm 14', 'Product 14', '<p>CPU: Intel&reg;&nbsp; Core&trade; i3-7130U</p>  <p>RAM: 4GB DDR44</p>  <p>M&agrave;n h&igrave;nh:&nbsp;14&Prime; FHD IPS LCD with glass</p>  <p>Cổng kết nối:&nbsp;1 x USB 3.1 Type C Gen 1 5Gbps, 2 x USB 3.0 ( One with off-line charger), 1 x USB 2.0, 1 x SD Card Reader, 1 x HDMI (v1.4), 1 x DC-In, 1 x Headphone Jack, 1 x K-lock, Fingerprint reader.</p>', 'description 14', 'san-pham-14'),
(16, 'Sản Phẩm 15', 'Product 15', '<p>THE NEW RAZER BLADE 15 ADVANCE 2020</p>', 'description 15', 'san-pham-15'),
(17, 'Sản Phẩm 16', 'Product 16', '<p><em><strong>xcdcdc</strong></em></p>', 'description 16', 'san-pham-16'),
(18, 'Sản phẩm 17', 'Product 17', '<p>CPU: Intel Core i7-10210U (thế hệ thứ 10).</p>', 'description 17', 'san-pham-17'),
(19, 'Sản Phẩm 18', 'Product 18', '<p>Sản Phẩm 18</p>', 'description 18', 'san-pham-18'),
(24, 'Sản Phẩm 19', 'Product 19', '<p>Sản Phẩm 19</p>', 'description 19', 'san-pham-19'),
(25, 'Sản Phẩm 20', 'Product 20', '<p>Sản Phẩm 20</p>', 'description 20', 'san-pham-20'),
(26, 'Sản Phẩm 21', 'Product 21', '<p>Sản Phẩm 21</p>', 'description 21', 'san-pham-21'),
(27, 'Sản Phẩm 22', 'Product 22', '<p>22222222222222</p>', 'description 22', 'san-pham-22'),
(28, 'Sản Phẩm 23', 'Product 23', '<p>Sản Phẩm 23</p>', '<p>Product 23</p>', 'san-pham-23'),
(29, 'dsadsa', 'dsadsa', '<p>dsadsadsa</p>', '<p>dsadsa</p>', 'dsadsa');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_type` int UNSIGNED NOT NULL,
  `id_post` int NOT NULL,
  `product_quantity` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_soid` int NOT NULL,
  `unit_price` int NOT NULL,
  `promotion_price` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sub_image` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `new` tinyint NOT NULL DEFAULT '0',
  `date_sale` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hours_sale` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  KEY `zazaza` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_type`, `id_post`, `product_quantity`, `product_soid`, `unit_price`, `promotion_price`, `image`, `sub_image`, `new`, `date_sale`, `hours_sale`, `created_at`, `updated_at`) VALUES
(75, 3, 3, '3', 2, 19000000, 17000000, '1619762517.macbook 13inch63.jpg', '', 0, '2021/04/20', '19:28:30', '2020-11-22 02:28:07', '2021-03-13 11:37:33'),
(87, 4, 9, '9', 1, 29000000, 0, '1619762061.637436514731163376_dell-inspiron-n5406-xam-145.png', '', 1, NULL, '12:53:21', '2020-11-23 13:44:10', '2020-12-08 08:19:24'),
(89, 5, 13, '4', 0, 16000000, 14000000, '1606791910.lenovo48.jpg', '', 1, '2021/04/12 ', '19:28:30', '2020-11-23 14:04:28', '2020-12-01 03:05:10'),
(91, 4, 15, '3', 0, 12000000, 11000000, '1619760916.70899.jpg', NULL, 1, '2021/05/23', '14:06:30', '2021-02-28 10:53:04', '2021-03-06 11:23:19'),
(95, 6, 10, '9', 1, 20000000, 19000000, '1615638903.razer-book91.jpg', NULL, 0, NULL, NULL, '2021-02-28 11:10:39', '2021-03-13 12:35:03'),
(96, 3, 8, '8', 1, 10000000, 0, '1619762534.12472_laptop_apple_macbook_air_mvfn2sa_gold_cpu_i5_132.jpg', NULL, 1, NULL, '13:01:58', '2021-02-28 11:29:20', '2021-03-13 12:40:52'),
(98, 4, 19, '10', 0, 32000000, 0, '1619762082.unnamed92.jpg', NULL, 1, NULL, '12:54:21', '2021-03-06 11:06:33', '2021-03-12 13:29:38'),
(99, 6, 27, '10', 0, 20000000, 0, '1615638734.shopping (1)69.png', NULL, 0, NULL, '13:08:09', '2021-03-06 11:07:12', '2021-03-13 12:35:34'),
(101, 5, 25, '2', 0, 10000000, 0, '1619761264.lenovo-ideapad-l34028.png', NULL, 0, NULL, '12:37:43', '2021-04-03 05:20:51', '2021-04-03 05:20:51'),
(102, 5, 26, '2', 0, 20000000, 10000000, '1619761280.66603-511057-product_original-laptop-lenovo-legion-5-15arh05-82b500agpb-16gb-1tbssd-ryzen-7-4800h-156fhd-16gb-512ssd-1000ssd-gtx1650-noos54.jpg', NULL, 1, '2021/05/09', '22:11:36', NULL, NULL),
(103, 15, 28, '10', 0, 50000000, 0, '1620389257.Microsoft-Surface-Pro-7-PVR-00021-1237.jpg', NULL, 1, '2021/05/08', '1:6:59', NULL, NULL),
(104, 15, 29, '12', 0, 321321321, 3213213, '1647911413.4445645656pdf41749.png', NULL, 1, '2022/03/23', '1:1:1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int UNSIGNED NOT NULL,
  `rating_number` int NOT NULL,
  PRIMARY KEY (`rating_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `product_id`, `rating_number`) VALUES
(6, 91, 4),
(7, 91, 3),
(8, 91, 3),
(9, 91, 3),
(10, 91, 4),
(11, 91, 4),
(12, 91, 4),
(13, 91, 3),
(14, 91, 2),
(15, 91, 1),
(16, 91, 1),
(17, 91, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE IF NOT EXISTS `slide` (
  `id` int NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `status_slide` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`, `status_slide`) VALUES
(18, NULL, '1620138936.dell_pro_hpb___web_banner30.jpg', 0),
(19, 'http://hiepsiit.com/', '1620177863.banner00361.jpg', 0),
(20, NULL, '1606225287.banner-web-laptop-1199.png', 1),
(22, 'http://hiepsiit.com/', '1606225797.banner417.jpg', 0),
(23, 'http://localhost:8081/shoplaptop_1/public/chi-tiet-san-pham/74', '1606791963.banner399.jpg', 1),
(24, NULL, '1615196388.gs75-20190107-152.jpg', 0),
(25, NULL, '1615556266.banner-la-gi48.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
CREATE TABLE IF NOT EXISTS `social` (
  `social_id` int NOT NULL AUTO_INCREMENT,
  `provider_user_id` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `user` int UNSIGNED NOT NULL,
  PRIMARY KEY (`social_id`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistical`
--

DROP TABLE IF EXISTS `statistical`;
CREATE TABLE IF NOT EXISTS `statistical` (
  `id_statistic` int NOT NULL AUTO_INCREMENT,
  `order_date` varchar(255) NOT NULL,
  `sales` varchar(255) NOT NULL,
  `profit` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `total_order` int NOT NULL,
  PRIMARY KEY (`id_statistic`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `statistical`
--

INSERT INTO `statistical` (`id_statistic`, `order_date`, `sales`, `profit`, `quantity`, `total_order`) VALUES
(1, '2021-03-06', '10000000', '9999000', 1, 1),
(2, '2021-03-05', '30000000', '29999000', 2, 1),
(3, '2021-03-27', '29000000', '28999000', 2, 1),
(4, '2021-03-03', '29000000', '28998000', 2, 2),
(5, '2021-03-09', '14500000', '14499000', 1, 1),
(6, '2021-03-11', '14500000', '14499000', 1, 1),
(7, '2021-03-13', '43500000', '43498000', 2, 2),
(8, '2021-04-01', '22000000', '21999000', 1, 1),
(9, '2021-04-02', '19000000', '18999000', 1, 1),
(10, '2021-05-03', '19000000', '18999000', 1, 1),
(11, '2021-05-01', '1500000', '1499000', 1, 1),
(12, '2021-05-02', '15000000', '14999000', 1, 1),
(13, '2021-04-30', '14500000', '14499000', 1, 1),
(14, '2021-04-15', '30000000', '29999000', 2, 1),
(15, '2021-05-13', '19000000', '18999000', 1, 1),
(16, '2022-03-21', '20000000', '19999000', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_products`
--

DROP TABLE IF EXISTS `type_products`;
CREATE TABLE IF NOT EXISTS `type_products` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `type_products`
--

INSERT INTO `type_products` (`id`, `name_type`, `image`) VALUES
(3, 'Apple', '37150-apple-logo-icon-vector-icon-vector-eps.png'),
(4, 'Dell', 'dell-4-569248.png'),
(5, 'Lenovo', 'lenovo-226431.png'),
(6, 'Razer', 'razer-1-285174.png'),
(13, 'MSI', 'msi-1-286075.png'),
(14, 'Toshiba', 'toshiba-1-282829.png'),
(15, 'Microsoft', 'microsoft-26-722716.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_token` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `level` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `user_token`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$vNXM.9DrRohdYQsE3bZ5nuOEtIVXG0MjcvvaOcJuYf/iCrhkM0bBe', '0123456789', 'tp.HCM', NULL, NULL, 1, NULL, '2025-01-18 10:23:02'),
(37, 'tu dinh ngu', 'dsadsa123@gmail.com', '$2y$10$AeWD76o8T8wv4qqyGfuMHubeF8/x5qto8rAjfhbFpzHpTgfwZY1HK', '0123', 'dsadsa', NULL, NULL, 2, '2022-03-21 04:10:46', '2022-03-21 04:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `id_visitors` int NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `date_visitor` varchar(255) NOT NULL,
  PRIMARY KEY (`id_visitors`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id_visitors`, `ip_address`, `date_visitor`) VALUES
(1, '192.168.2.1', '2021-01-03'),
(2, '192.168.1.1', '2021-03-11'),
(3, '::1', '2021-03-30'),
(4, '127.0.0.1', '2021-05-12');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_post_payment`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_products` (`id`),
  ADD CONSTRAINT `zazaza` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social`
--
ALTER TABLE `social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
