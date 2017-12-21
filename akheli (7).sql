-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2017 at 02:11 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akheli`
--

-- --------------------------------------------------------

--
-- Table structure for table `akh_add_product_details`
--

CREATE TABLE `akh_add_product_details` (
  `detail_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_value` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_add_product_details`
--

INSERT INTO `akh_add_product_details` (`detail_id`, `field_name`, `field_value`, `product_id`) VALUES
(1, 'afdsasdfadsfasdfasdfasdfdfa', 'fsadfasd', 5),
(2, 'fasdfasfasdf', 'fasdf', 5),
(3, 'adsf', 'asdf', 4),
(4, 'fasdfasfasdf', 'fasdfasd', 4);

-- --------------------------------------------------------

--
-- Table structure for table `akh_add_product_image`
--

CREATE TABLE `akh_add_product_image` (
  `image_id` int(11) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_add_product_image`
--

INSERT INTO `akh_add_product_image` (`image_id`, `product_image`, `product_id`) VALUES
(1, 'To6x3fiSH26eMzPlcU8i4hvqf.jpg', 4),
(2, '2mTGWZWGHCj4u7Uh2cnMshkxL.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `akh_chats`
--

CREATE TABLE `akh_chats` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_chats`
--

INSERT INTO `akh_chats` (`id`, `sender`, `receiver`, `message`, `send_date`) VALUES
(1, 15, 16, 'Test Message', '2017-08-31 16:17:12'),
(2, 16, 15, 'This is the message', '2017-08-31 17:00:32'),
(6, 15, 16, 'new message', '2017-08-31 17:33:30'),
(7, 15, 16, 'Testing', '2017-08-31 17:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `akh_clients`
--

CREATE TABLE `akh_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akh_clients`
--

INSERT INTO `akh_clients` (`id`, `name`, `last_name`, `phone_no`, `location`, `user_id`, `user_image`, `created_at`, `updated_at`) VALUES
(11, 'Buyer Name', 'Test Shop', '9861676916', 'Kathmandu', 15, 'RirfeKdHZxdb9CnZiFf5kWJpg.jpg', '2017-08-30 17:14:39', '2017-08-31 17:02:49'),
(12, 'Seller Name', 'Test Admin', '9861676916', 'Pokhara', 16, 'vF8kds10a4BaoXeTLQNeRS9Kc.jpg', '2017-08-30 17:47:27', '2017-08-31 17:02:57'),
(13, 'admin', 'admin', 'admin', 'admin', 23, 'test.jpg', '2017-08-30 18:48:33', '2017-08-30 18:48:33'),
(14, 'Ashish', 'ashish shop', '9860721568', 'Pokhara', 24, 'Hp63D6ff9VkXKf3kxixv1d8RI.jpg', '2017-11-29 06:27:28', '2017-11-29 06:27:28'),
(15, 'Ashish', 'askl', '9851239812', 'pokhara', 25, 'cDZTfww9CU17JXSI97EXASAUT.jpg', '2017-12-03 10:29:42', '2017-12-03 10:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `akh_delivery_location`
--

CREATE TABLE `akh_delivery_location` (
  `location_id` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `postal_code` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `akh_featured_products`
--

CREATE TABLE `akh_featured_products` (
  `featured_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_featured_products`
--

INSERT INTO `akh_featured_products` (`featured_id`, `product_id`) VALUES
(5, 4),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `akh_orders`
--

CREATE TABLE `akh_orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_orders`
--

INSERT INTO `akh_orders` (`id`, `description`, `size`, `color`, `quantity`, `user_id`, `status`, `created_at`, `updated_at`, `viewed`, `product_id`) VALUES
(1, 'Please do it ASAP.', 'M,L', 'Red,Black', '20', 15, 'REQUESTED', '2017-08-30 18:33:06', '2017-08-30 18:33:06', 0, 3),
(2, 'Please Deliver ', 'M,L', 'Red', '100', 15, 'REQUESTED', '2017-08-31 15:47:36', '2017-08-31 15:47:36', 0, 3),
(3, '', 'm', 'black', '22', 25, 'REQUESTED', '2017-12-03 10:30:32', '2017-12-03 10:30:32', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `akh_products`
--

CREATE TABLE `akh_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category` varchar(191) DEFAULT NULL,
  `description` text,
  `weight` varchar(191) DEFAULT NULL,
  `price` varchar(20) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_products`
--

INSERT INTO `akh_products` (`id`, `product_name`, `category`, `description`, `weight`, `price`, `image`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 'Kurta', 'Ladies', 'General Description.', '10', '200', 'wlISBXpP5mWQLmDWMxv1HCybg.jpg', '2017-08-30 18:08:11', '2017-08-30 18:08:11', 16),
(4, 'Gold star shoes', NULL, 'fasdfasdfasdf', '45', '25', '1CFLAjqhDTmfF9XH8Og3NzAWQ.jpg', '2017-11-29 06:37:57', '2017-12-03 08:29:20', 24),
(5, 'aklsdjflk', 'kaljfdk', 'faksldjflakd', '3', '22', '8IqZi1iPU8EJZM8ProjSaeWYS.jpg', '2017-11-29 06:46:08', '2017-11-29 06:46:08', 24),
(6, 'fasdf', 'fasdf', 'aksjdhfkajsdf', '2', '25', 'YB4Cd6oWB3FfXJtbeFyUvqC14.jpg', '2017-12-03 07:19:26', '2017-12-03 07:19:26', 24),
(7, 'afsdsdf', 'adfasdf', '', '3', '25', 'w4g4SDDWBkJYkv69rkaVknwrQ.jpg', '2017-12-03 08:27:31', '2017-12-03 08:41:10', 24),
(8, 'fafafsadfa', 'akljsdfklajsdf', 'fasdfasdf', '1', '22', 'rLWiNfJUBlZfaghe7YlGwyHzx.jpg', '2017-12-03 08:37:16', '2017-12-03 10:27:15', 24);

-- --------------------------------------------------------

--
-- Table structure for table `akh_product_details`
--

CREATE TABLE `akh_product_details` (
  `id` int(10) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akh_product_details`
--

INSERT INTO `akh_product_details` (`id`, `size`, `color`, `product_id`) VALUES
(9, 'M,L,S,XL', 'Red,Black', 3),
(11, 's,m,l', 'black,white', 5),
(12, 's,m', 'black,white', 6),
(15, 's,m,l', 'black,white', 4),
(26, 'm', 'black,white', 7),
(31, 'm,m', 'black,white', 8);

-- --------------------------------------------------------

--
-- Table structure for table `akh_users`
--

CREATE TABLE `akh_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akh_users`
--

INSERT INTO `akh_users` (`id`, `email`, `password`, `role`, `enabled`, `created_at`, `updated_at`) VALUES
(15, 'buyers@example.com', '0e0e53f7c8fca96819ad752bcf86c13ccad02efac0cd307982bf6821a74dcdc8', 'akheli_buyer', 1, '2017-08-30 17:14:39', '2017-08-30 18:17:53'),
(16, 'sellers@example.com', 'ac9689e2272427085e35b9d3e3e8bed88cb3434828b43b86fc0596cad4c6e270', 'akheli_seller', 1, '2017-08-30 17:47:27', '2017-08-30 18:08:50'),
(23, 'iamadmin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'akheli_admin', 1, '2017-08-30 18:48:33', '2017-08-30 18:48:33'),
(24, 'bikram.ashish@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'akheli_seller', 1, '2017-11-29 06:27:28', '2017-12-16 06:54:34'),
(25, 'bikram@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'akheli_buyer', 1, '2017-12-03 10:29:42', '2017-12-16 06:54:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akh_add_product_details`
--
ALTER TABLE `akh_add_product_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `akh_add_product_image`
--
ALTER TABLE `akh_add_product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `akh_chats`
--
ALTER TABLE `akh_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akh_clients`
--
ALTER TABLE `akh_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `akh_delivery_location`
--
ALTER TABLE `akh_delivery_location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `akh_featured_products`
--
ALTER TABLE `akh_featured_products`
  ADD PRIMARY KEY (`featured_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `akh_orders`
--
ALTER TABLE `akh_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `products_fk_2` (`product_id`);

--
-- Indexes for table `akh_products`
--
ALTER TABLE `akh_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akh_product_details`
--
ALTER TABLE `akh_product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `akh_users`
--
ALTER TABLE `akh_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akh_add_product_details`
--
ALTER TABLE `akh_add_product_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `akh_add_product_image`
--
ALTER TABLE `akh_add_product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `akh_chats`
--
ALTER TABLE `akh_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `akh_clients`
--
ALTER TABLE `akh_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `akh_delivery_location`
--
ALTER TABLE `akh_delivery_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `akh_featured_products`
--
ALTER TABLE `akh_featured_products`
  MODIFY `featured_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `akh_orders`
--
ALTER TABLE `akh_orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `akh_products`
--
ALTER TABLE `akh_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `akh_product_details`
--
ALTER TABLE `akh_product_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `akh_users`
--
ALTER TABLE `akh_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `akh_add_product_details`
--
ALTER TABLE `akh_add_product_details`
  ADD CONSTRAINT `akh_add_product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `akh_products` (`id`);

--
-- Constraints for table `akh_add_product_image`
--
ALTER TABLE `akh_add_product_image`
  ADD CONSTRAINT `akh_add_product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `akh_products` (`id`);

--
-- Constraints for table `akh_clients`
--
ALTER TABLE `akh_clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `akh_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `akh_delivery_location`
--
ALTER TABLE `akh_delivery_location`
  ADD CONSTRAINT `akh_delivery_location_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `akh_orders` (`id`);

--
-- Constraints for table `akh_featured_products`
--
ALTER TABLE `akh_featured_products`
  ADD CONSTRAINT `akh_featured_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `akh_products` (`id`);

--
-- Constraints for table `akh_orders`
--
ALTER TABLE `akh_orders`
  ADD CONSTRAINT `akh_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `akh_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_fk_2` FOREIGN KEY (`product_id`) REFERENCES `akh_products` (`id`);

--
-- Constraints for table `akh_product_details`
--
ALTER TABLE `akh_product_details`
  ADD CONSTRAINT `akh_product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `akh_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
