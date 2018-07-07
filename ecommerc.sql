-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2018 at 09:05 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerc`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Nina\'s Moda'),
(2, 'Sport\'s Shirt'),
(3, 'Man\'s Shirt'),
(13, 'Doxa'),
(5, 'Polo'),
(9, 'Nike'),
(12, 'Levis'),
(8, 'Lacoste'),
(14, 'Stephanel Shoes'),
(15, 'Carrera'),
(16, 'Cotton');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`) VALUES
(32, '[{"id":"18","size":"37","quantity":"2"}]', '2017-07-08 17:10:57', 1),
(25, '[{"id":"20","size":"m","quantity":"2"},{"id":"18","size":"37","quantity":"1"}]', '2017-07-07 17:55:13', 1),
(26, '[{"id":"12","size":"37","quantity":"3"},{"id":"1","size":"36","quantity":"1"},{"id":"2","size":"44","quantity":"2"}]', '2017-07-07 17:57:35', 1),
(27, '[{"id":"12","size":"37","quantity":"2"},{"id":"2","size":"44","quantity":"2"}]', '2017-07-07 18:06:40', 1),
(28, '[{"id":"11","size":"N/A","quantity":"1"},{"id":"18","size":"37","quantity":"1"},{"id":"2","size":"42","quantity":"1"}]', '2017-07-07 18:08:29', 1),
(29, '[{"id":"3","size":"42","quantity":"1"}]', '2017-07-07 18:13:43', 1),
(30, '[{"id":"16","size":"N/A","quantity":"1"}]', '2017-07-08 17:05:08', 1),
(31, '[{"id":"2","size":"44","quantity":"2"}]', '2017-07-08 17:09:18', 1),
(23, '[{"id":"18","size":"37","quantity":"1"}]', '2017-07-05 00:02:14', 0),
(24, '[{"id":"16","size":"N/A","quantity":3},{"id":"11","size":"N/A","quantity":2}]', '2017-07-05 00:14:33', 1),
(33, '[{"id":"11","size":"N/A","quantity":"2"}]', '2017-07-08 17:12:47', 1),
(34, '[{"id":"3","size":"44","quantity":"1"}]', '2017-07-08 17:14:22', 1),
(35, '[{"id":"3","size":"46","quantity":"1"}]', '2017-07-08 22:59:01', 1),
(36, '[{"id":"12","size":"38","quantity":"1"}]', '2017-07-08 23:01:08', 1),
(37, '[{"id":"17","size":"N/A","quantity":"1"}]', '2017-07-08 23:03:08', 1),
(38, '[{"id":"2","size":"44","quantity":"1"}]', '2017-07-08 23:34:09', 1),
(39, '[{"id":"17","size":"N/A","quantity":"1"},{"id":"20","size":"m","quantity":"2"}]', '2017-07-09 01:23:34', 1),
(40, '[{"id":"17","size":"N/A","quantity":"1"},{"id":"20","size":"m","quantity":"2"}]', '2017-07-09 01:26:10', 1),
(41, '[{"id":"17","size":"N/A","quantity":"1"},{"id":"20","size":"m","quantity":"2"}]', '2017-07-09 01:28:35', 1),
(42, '[{"id":"2","size":"42","quantity":"1"},{"id":"11","size":"N/A","quantity":"2"}]', '2017-07-09 01:34:40', 1),
(43, '[{"id":"17","size":"N/A","quantity":"2"},{"id":"3","size":"42","quantity":"1"}]', '2017-07-09 01:37:29', 1),
(44, '[{"id":"17","size":"N/A","quantity":"2"},{"id":"2","size":"42","quantity":"1"}]', '2017-07-09 01:40:29', 1),
(45, '[{"id":"2","size":"46","quantity":"2"}]', '2017-07-09 01:46:38', 1),
(46, '[{"id":"3","size":"42","quantity":"1"}]', '2017-10-14 12:21:43', 1),
(47, '[{"id":"21","size":"56","quantity":"1"},{"id":"18","size":"37","quantity":"2"},{"id":"3","size":"44","quantity":"1"}]', '2017-11-14 08:24:33', 1),
(48, '[{"id":"3","size":"44","quantity":"1"},{"id":"18","size":"37","quantity":"1"}]', '2017-11-27 18:45:36', 1),
(49, '[{"id":"21","size":"56","quantity":"1"}]', '2018-04-11 17:22:35', 0),
(50, '[{"id":"21","size":"56","quantity":"1"}]', '2018-06-06 23:41:02', 1),
(51, '[{"id":"1","size":"36","quantity":"1"},{"id":"20","size":"m","quantity":"1"}]', '2018-08-04 21:09:25', 1),
(52, '[{"id":"1","size":"38","quantity":"1"}]', '2018-08-04 21:22:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Man', 0),
(2, 'Woman', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Shirts', 1),
(6, 'Pants', 1),
(10, 'Accessoires', 1),
(9, 'Shoes', 1),
(28, 'Accessiores', 2),
(47, 'Gifts', 0),
(48, 'Home Decor', 47),
(25, 'Shoes', 2),
(24, 'Pants', 2),
(23, 'Shirts', 2),
(22, 'Pants', 3),
(21, 'Shirts', 3),
(29, 'Shirts', 4),
(30, 'Dresses', 4),
(34, 'Dresses', 2),
(53, 'Shoes', 3),
(52, 'Flowers', 47),
(49, 'Make Up', 47),
(54, 'Hat', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Party Dresses', '1.00', '4.50', 1, '34', '/ecommerc/images/proizvod/f03a0a831fa176e85e38f498b70b20f3.jpg', 'This party dresses is amazing and wait for you!', 1, '36:0,38:2,40:1', 0),
(2, 'Sport&#039;s Shirt', '10.00', '20.00', 2, '5', '/ecommerc/images/proizvod/men.jpg', 'Shirt for every day', 1, '42:1,44:10,46:,', 0),
(3, 'Men\'s Shirt', '20.00', '40.00', 3, '5', '/ecommerc/images/proizvod/men1.jpg', 'Modern and light', 1, '42:0,44:0,46:4', 0),
(21, 'Man`s Hat', '99.00', '129.00', 16, '10', '/ecommerc/images/proizvod/71e1cd5e55108c21f5b3dbf01389018a.jpg', 'Remember, for most of the history of men&#039;s style, hats were functional articles of clothing. They needed to look good, but they also needed to keep off sun, rain, .', 1, '56:0,54:4,58:9,:', 0),
(20, 'Sport`s Pants', '54.00', '87.00', 9, '6', '/ecommerc/images/proizvod/521820f287b41bea46f848c6b55394c8.jpg', 'For every day', 1, 'm:1,l:5,:', 0),
(11, 'Modern Look', '35.00', '75.00', 13, '10', '/ecommerc/images/proizvod/9fc32d488749efc7e52b33c5dd4e7d32.jpg', 'For every day', 0, 'N/A:6,', 1),
(12, 'Elegant Shoes', '29.00', '99.00', 14, '25', '/ecommerc/images/proizvod/01775c49cc7386184447d0af86d05dba.jpg', 'You enjoy in moment ', 1, '37:4,38:6,40:4,', 0),
(19, 'Outdoor Pants', '44.00', '77.00', 11, '6', '/ecommerc/images/proizvod/1999e99e66a4314dd8b2672ffeac5b5e.jpg', 'For Hikink, Skiing, Long Walking', 1, 'm:2,l:2,', 0),
(18, 'Summer Shoes', '44.00', '66.00', 13, '25', '/ecommerc/images/proizvod/e737249e6f7c6878e3f7808527924950.jpg', 'Summer Shoes', 1, '37:0,38:1,:', 0),
(15, 'Outdoor Shoes', '49.00', '109.00', 11, '9', '/ecommerc/images/proizvod/c430c58853b3d039c21c8f3d45f82ca7.jpg', 'Grab the opportynity of soft step', 0, '42:5,44:5,45:2,', 1),
(16, 'Casual Style', '55.00', '99.00', 16, '10', '/ecommerc/images/proizvod/39f4996356e126457831412701e497b9.jpg', 'For every day and every occasion', 1, 'N/A:4,', 0),
(17, 'Leather Belt', '25.00', '45.00', 16, '10', '/ecommerc/images/proizvod/7161111f6cc356e952aabb6bcee1b807.jpg', 'Mens Retro First Layer Cowhide Leather Belt Pin Buckle Jeans Waistbands', 1, 'N/A:9,', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `ground_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `country`, `zip_code`, `sub_total`, `tax`, `ground_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'ch_1AS8L1AtR6ZH5urXqpj36qhB', 24, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '235.00', '20.45', '255.45', '5 items iz Boutique W', 'charge', '2017-06-07 19:53:04'),
(2, 'ch_1AS8O3AtR6ZH5urXnz7ioR1V', 25, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '152.00', '13.22', '165.22', '3 items iz Boutique W', 'charge', '2017-06-07 19:56:12'),
(3, 'ch_1AS8QGAtR6ZH5urXohXbT6lA', 26, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '108.00', '9.40', '117.40', '6 items iz Boutique W', 'charge', '2017-06-07 19:58:29'),
(4, 'ch_1AS8ZFAtR6ZH5urXAYdk2pG7', 27, 'slobodanka pilipovic', 'slobns@hotmail.com', '', '', '', '', '', '78.00', '6.79', '84.79', '4 items iz Boutique W', 'charge', '2017-06-07 20:07:46'),
(5, 'ch_1AS8diAtR6ZH5urXi12Q6JJQ', 28, 'Slobodanka pilipovic', 'slobns@hotmail.com', '', '', '', '', '', '89.00', '7.74', '96.74', '3 items iz Boutique W', 'charge', '2017-06-07 20:12:23'),
(6, 'ch_1AS8gCAtR6ZH5urXh63GLrJk', 29, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '1 item iz Boutique W', 'charge', '2017-06-07 20:14:57'),
(7, 'ch_1ASU5CAtR6ZH5urXTd6V6cTi', 30, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '55.00', '4.79', '59.79', '1 item iz Boutique W', 'charge', '2017-06-08 19:06:09'),
(8, 'ch_1ASU92AtR6ZH5urXL8ip9FcY', 31, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '2 items iz Boutique W', 'charge', '2017-06-08 19:10:10'),
(9, 'ch_1ASUArAtR6ZH5urXkK9cAwwP', 32, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '88.00', '7.66', '95.66', '2 items iz Boutique W', 'charge', '2017-06-08 19:12:04'),
(10, 'ch_1ASUCTAtR6ZH5urXH1lDKAjy', 33, 'sanja nikolic', 'slobns@hotmail.com', '', '', '', '', '', '70.00', '6.09', '76.09', '2 items iz Boutique W', 'charge', '2017-06-08 19:13:47'),
(11, 'ch_1ASUDmAtR6ZH5urXbUXgf8FF', 34, 'slobodanka', 'slobns@hotmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '1 item iz Boutique W', 'charge', '2017-06-08 19:15:09'),
(12, 'ch_1ASZbkAtR6ZH5urXMpWbjlwp', 35, 'dada', 'slobns@hotmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '1 item iz Boutique W', 'charge', '2017-06-09 01:00:15'),
(13, 'ch_1ASZdkAtR6ZH5urX1nuErTxJ', 36, 'sanja', 'slobns@hotmail.com', '', '', '', '', '', '29.00', '2.52', '31.52', '1 item iz Boutique W', 'charge', '2017-06-09 01:02:18'),
(14, 'ch_1ASZfOAtR6ZH5urXXBTAdYHM', 37, 'marko nikolic', 'slobns@hotmail.com', '', '', '', '', '', '25.00', '2.18', '27.18', '1 item iz Boutique W', 'charge', '2017-06-09 01:04:00'),
(15, 'ch_1ASa9VAtR6ZH5urXHX05yG9h', 38, 'ratimir', 'slobns@hotmail.com', '', '', '', '', '', '10.00', '0.87', '10.87', '1 item iz Boutique W', 'charge', '2017-06-09 01:35:08'),
(16, 'ch_1ASbrdAtR6ZH5urXkDdtXd6L', 39, 'marko markovic', 'marko@hotmail.com', '', '', '', '', '', '133.00', '11.57', '144.57', '3 items iz Boutique W', 'charge', '2017-06-09 03:24:47'),
(17, 'ch_1ASbu8AtR6ZH5urXseJdAAkP', 40, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '133.00', '11.57', '144.57', '3 items iz Boutique W', 'charge', '2017-06-09 03:27:22'),
(18, 'ch_1ASbwEAtR6ZH5urXjkUFnTdo', 41, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '133.00', '11.57', '144.57', '3 items iz Boutique W', 'charge', '2017-06-09 03:29:32'),
(19, 'ch_1ASc28AtR6ZH5urXuwZNCuHA', 42, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '80.00', '6.96', '86.96', '3 items iz Boutique W', 'charge', '2017-06-09 03:35:39'),
(20, 'ch_1ASc4wAtR6ZH5urXDRqPhfp5', 43, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '70.00', '6.09', '76.09', '3 items iz Boutique W', 'charge', '2017-06-09 03:38:33'),
(21, 'ch_1ASc7eAtR6ZH5urXrFJGGbjB', 44, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '60.00', '5.22', '65.22', '3 items iz Boutique W', 'charge', '2017-06-09 03:41:21'),
(22, 'ch_1AScDfAtR6ZH5urXtQFYTW7M', 45, 'marko markovic', 'slobns@hotmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '2 items iz Boutique W', 'charge', '2017-06-09 03:47:33'),
(23, 'ch_1B1wrBAtR6ZH5urXDb61UFec', 46, 'dragana tomic', 'dragana@gmail.com', '', '', '', '', '', '20.00', '1.74', '21.74', '1 item iz Boutique W', 'charge', '2017-09-14 14:54:16'),
(24, 'ch_1BD7UjAtR6ZH5urXJssBLXE5', 47, 'sanja sanja', 'slobodanka@hostjedi.com', '', '', '', '', '', '207.00', '18.01', '225.01', '4 items iz Boutique W', 'charge', '2017-10-15 10:29:17'),
(25, 'ch_1BHzKAAtR6ZH5urX36l1DaL2', 48, 'neko ime', 'slobns@hotmail.com', '', '', '', '', '', '64.00', '5.57', '69.57', '2 items iz Boutique W', 'charge', '2017-10-28 20:47:03'),
(26, 'ch_1CPIxCAtR6ZH5urXYFvG8PHM', 50, 'assdad', 'slobns@hotmail.com', '', '', '', '', '', '99.00', '8.61', '107.61', '1 item iz Boutique W', 'charge', '2018-05-08 01:42:26'),
(27, 'ch_1CkehsAtR6ZH5urXMV0rRC1f', 51, 'gdsg gsdgs', 'slobns@hotmail.com', '', '', '', '', '', '55.00', '4.79', '59.79', '2 items iz Boutique W', 'charge', '2018-07-05 23:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permessions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permessions`) VALUES
(7, 'miki maus', 'miki@hotmail.com', '$2y$10$nHIo8PJkSe605UqK5OGhVO9aaw25DESWVtIubpKehl7p.7ZA6l3Sy', '2017-06-01 00:36:52', '2018-07-04 14:41:28', 'editor'),
(3, 'Slobodanka Pilipovic', 'boba@gmail.com', 'bobaboba', '2017-05-29 00:21:43', '2017-06-10 16:35:03', 'admin,editor'),
(8, 'Marko Markovic', 'marko.markovic@hotmail.com', '$2y$10$rM4HslCikArQVbxui0AEXOco74WHWvohaQaGzfSHflEPCkL0P6Eh2', '2017-06-06 14:28:58', '2017-06-06 14:28:58', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
