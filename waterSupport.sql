-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 09:41 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supportticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gwarimpa', NULL, NULL),
(2, 'Kubwa', NULL, NULL),
(3, 'Lifecamp', NULL, NULL),
(4, 'Lugbe', NULL, NULL),
(5, 'Maitama', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ticket_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Phone number is 08027573121', '2020-05-27 06:25:17', '2020-05-27 06:25:17'),
(2, 6, 1, 'Name is client is Adedeji kadri with phone number 08027573121', '2020-06-03 23:55:58', '2020-06-03 23:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `zone`, `address`) VALUES
(1, 'Adedeji Nasir Kadri', '08027573121', 4, 'Plot 999 Asba Street, Lifecamp'),
(2, 'Farida Lawal', '08073541536', 1, 'Plot 999 Asba Street, Lifecamp'),
(3, 'Rukayat Mustapha', '07037369280', 3, 'Plot 999 Asba Street, Lifecamp'),
(4, 'Habeeb Adedokun', '0803456789', 4, '123 Abc Street, Airport Road.');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_25_091542_create_tickets_table', 1),
('2016_06_25_102115_create_categories_table', 1),
('2016_07_02_160300_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_qty` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `reduced_price` decimal(10,2) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_qty`, `price`, `reduced_price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Bag of Water', 5110, '100.00', '80.00', 'Bag contains 20 sachets', '2020-06-02 19:14:04', '2020-06-05 10:14:10'),
(2, 'Bottles of Water', 2877, '1000.00', '850.00', 'Pack contains 12 bottles', '2020-06-02 19:16:47', '2020-06-04 00:53:15'),
(4, 'Dispenser Water', 400, '1500.00', '1200.00', '', '2020-06-04 00:06:08', '2020-06-04 00:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `priority` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `category_id`, `ticket_id`, `customer_name`, `phone`, `title`, `qty`, `price`, `priority`, `message`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 2, 'BNYS6RGUJN', 'Adedeji Kadri', '08027573121', 'Bottle of Water', 30, '7000', 'medium', 'Plot 4B, Lifecamp ABuja', 'Closed', '2020-06-02 20:09:53', '2020-06-12 19:53:32'),
(6, 1, 4, 'RXS5QZ5GK5', 'Farida Lawal', '07037369280', 'Dispenser Water', 3, '15000', 'high', 'Federal Housing Lugbe', 'Closed', '2020-06-03 23:06:57', '2020-06-03 23:54:26'),
(7, 1, 2, 'XATPG0ZQHF', 'Adedeji Kadri', '08033446315', 'Dispenser Water', 18, '28000', 'medium', 'Kubwa Roundabout', 'Closed', '2020-06-03 23:17:39', '2020-06-12 19:53:02'),
(8, 1, 2, 'OSQFS8MVD4', 'Farida Lawal', '08034256265', 'Bag of Water', 90, '40000', 'high', 'Kubwa Roundabout', 'Closed', '2020-06-05 09:15:55', '2020-06-14 12:50:29'),
(10, 1, 4, '8NPJ53SCZ1', 'Farida Lawal', '08056153080', 'Dispenser Water', 9, '2000', 'medium', 'Penthouse', 'Closed', '2020-06-12 19:40:59', '2020-06-16 13:29:26'),
(11, 1, 2, 'D5PAYFLECM', 'Abass Ayinde', '08022233344', 'Bottles of Water', 3, '3600', '', 'Kubwa Express Way.', 'Open', '2020-06-14 11:38:40', '2020-06-14 11:38:40'),
(12, 1, 4, '9N9U0LOS66', 'Rabiu Taofeek', '08022345421', 'Dispenser Water', 30, '45000', '', 'Federal Housing Lugbe', 'Open', '2020-06-14 12:49:38', '2020-06-14 12:49:38'),
(13, 1, 4, '38OJPME9YD', 'Habeeb Adedokun', '0803456789', 'Dispenser Water', 20, '30000', '', '123 Abc Street, Airport Road.', 'Open', '2020-06-16 17:59:12', '2020-06-16 17:59:12'),
(14, 1, 4, 'PZS4TPRGZ2', 'Adedeji Nasir Kadri', '08027573121', 'Bottles of Water', 90, '90000', '', '10, Ogunfunmi street, Lugbe', 'Open', '2020-06-16 18:09:32', '2020-06-16 18:09:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adedeji Kadri', 'kadri_adedeji@yahoo.com', '$2y$10$Lpo1/ajatqYsL7oADm/7CulF86mRWfgk.eVdStIXh3stFQFKZT5aa', 1, 'ZGsBH2kske5RbuWbdnkjHVT29atWR5lJ3udwIcdPUpFCq2CP2LmaYZATxKxI', '2020-05-26 09:14:12', '2020-06-14 13:52:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_id_unique` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
