-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 03:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mobile', '2021-02-11 09:31:23', '2021-02-11 09:31:23'),
(2, 'Desktop', '2021-02-11 09:33:53', '2021-02-11 09:33:53'),
(5, 'Laptop', '2021-02-11 09:39:15', '2021-02-11 09:39:15'),
(6, 'Tv', '2021-02-11 09:52:34', '2021-02-11 09:52:34'),
(7, 'Refrigerator', '2021-02-11 11:40:56', '2021-02-11 11:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Tallulah Wilcox', '01783456651', 'hyge@mailinator.com', 'Fugiat est laborum', '2021-02-11 08:15:57', '2021-02-11 08:31:22'),
(2, 'Tatum Cash', '01729272321', 'kipaw@mailinator.com', 'Tempor saepe quos au', '2021-02-11 08:28:12', '2021-02-11 08:31:52'),
(4, 'Ori Goff', '0172726217', 'pebaj@mailinator.com', 'Consectetur minim si', '2021-02-11 08:36:02', '2021-02-11 08:36:02'),
(5, 'Jade Graves', '0162615212', 'jade@gmail.com', 'Ex unde dolore lorem', '2021-02-11 08:36:17', '2021-02-13 12:11:55'),
(6, 'Charissa Brady', '017382728121', 'xela@mailinator.com', 'Accusantium veniam', '2021-02-11 08:36:47', '2021-02-11 08:36:47'),
(7, 'Tucker Acosta', '0182718291', NULL, 'Ea elit consequatur', '2021-02-11 08:37:01', '2021-02-11 08:37:01'),
(15, 'Root', '0172626172', NULL, 'Dhaka Banglase', '2021-02-13 11:04:01', '2021-02-13 11:38:15'),
(16, 'John Dou', '018272828', NULL, 'Nilphamari', '2021-02-13 12:47:27', '2021-02-13 12:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(10, '1', '2021-02-13', NULL, 1, '2021-02-13 12:49:11', '2021-02-13 12:49:35'),
(11, '2', '2021-02-13', NULL, 1, '2021-02-13 12:51:18', '2021-02-13 12:51:34'),
(12, '3', '2021-02-13', NULL, 1, '2021-02-13 12:52:17', '2021-02-13 12:52:25'),
(13, '4', '2021-02-14', NULL, 1, '2021-02-13 22:32:52', '2021-02-13 22:33:50'),
(16, '5', '2021-02-14', NULL, 1, '2021-02-13 23:20:37', '2021-02-13 23:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `selling_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `category_id`, `product_id`, `selling_qty`, `unit_price`, `selling_price`, `status`, `created_at`, `updated_at`) VALUES
(18, '2021-02-13', 10, 1, 3, 1, 6000, 6000, 1, '2021-02-13 12:49:11', '2021-02-13 12:49:11'),
(19, '2021-02-13', 10, 6, 5, 1, 8500, 8500, 1, '2021-02-13 12:49:11', '2021-02-13 12:49:11'),
(20, '2021-02-13', 11, 7, 7, 1, 21000, 21000, 1, '2021-02-13 12:51:18', '2021-02-13 12:51:18'),
(21, '2021-02-13', 12, 5, 2, 1, 35000, 35000, 1, '2021-02-13 12:52:17', '2021-02-13 12:52:17'),
(22, '2021-02-14', 13, 6, 5, 2, 8500, 17000, 1, '2021-02-13 22:32:52', '2021-02-13 22:32:52'),
(23, '2021-02-14', 13, 2, 1, 2, 6700, 13400, 1, '2021-02-13 22:32:52', '2021-02-13 22:32:52'),
(26, '2021-02-14', 16, 1, 3, 2, 6000, 12000, 1, '2021-02-13 23:20:37', '2021-02-13 23:21:08'),
(27, '2021-02-14', 16, 5, 2, 1, 32000, 32000, 1, '2021-02-13 23:20:37', '2021-02-13 23:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_11_095817_create_suppliers_table', 1),
(5, '2021_02_11_135328_create_customers_table', 2),
(6, '2021_02_11_144230_create_units_table', 3),
(7, '2021_02_11_150730_create_categories_table', 4),
(8, '2021_02_11_160012_create_products_table', 5),
(9, '2021_02_12_123655_create_purchases_table', 6),
(10, '2021_02_13_135948_create_invoices_table', 7),
(11, '2021_02_13_140115_create_invoice_details_table', 7),
(12, '2021_02_13_141312_create_payments_table', 8),
(13, '2021_02_13_141333_create_payment_details_table', 8),
(14, '2021_02_14_171920_create_shop_details_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `paid_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(10, 10, 16, 'full_paid', 14200, 0, 14200, 300, '2021-02-13 12:49:11', '2021-02-14 08:41:07'),
(11, 11, 15, 'full_paid', 21000, 0, 21000, NULL, '2021-02-13 12:51:18', '2021-02-14 08:28:27'),
(12, 12, 2, 'full_paid', 34000, 0, 34000, 1000, '2021-02-13 12:52:17', '2021-02-13 12:52:17'),
(13, 13, 1, 'partial_paid', 25000, 5200, 30200, 200, '2021-02-13 22:32:52', '2021-02-13 22:32:52'),
(16, 16, 15, 'partial_paid', 35000, 7500, 42500, 1500, '2021-02-13 23:20:37', '2021-02-13 23:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `invoice_id`, `current_paid_amount`, `date`, `created_at`, `updated_at`) VALUES
(10, 10, 11500, '2021-02-13', '2021-02-13 12:49:11', '2021-02-13 12:49:11'),
(11, 11, 0, '2021-02-13', '2021-02-13 12:51:18', '2021-02-13 12:51:18'),
(12, 12, 34000, '2021-02-13', '2021-02-13 12:52:17', '2021-02-13 12:52:17'),
(13, 13, 25000, '2021-02-14', '2021-02-13 22:32:52', '2021-02-13 22:32:52'),
(16, 16, 35000, '2021-02-14', '2021-02-13 23:20:37', '2021-02-13 23:20:37'),
(17, 10, 700, '2021-02-14', '2021-02-14 08:00:50', '2021-02-14 08:00:50'),
(18, 11, 16500, '2021-02-14', '2021-02-14 08:26:09', '2021-02-14 08:26:09'),
(19, 11, 4500, '2021-02-14', '2021-02-14 08:28:27', '2021-02-14 08:28:27'),
(20, 10, 500, '2021-02-14', '2021-02-14 08:40:17', '2021-02-14 08:40:17'),
(21, 10, 1500, '2021-02-14', '2021-02-14 08:41:07', '2021-02-14 08:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `unit_id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 2, 'Esonic Desktop', 8, NULL, '2021-02-13 22:33:50'),
(2, 5, 2, 2, 'Dell Inspiron 5420', 14, '2021-02-11 11:04:50', '2021-02-14 07:39:22'),
(3, 1, 1, 2, 'Huawei y3ii', 5, '2021-02-11 11:08:15', '2021-02-14 07:40:33'),
(5, 6, 1, 2, 'Bosundhara LED  Tv', 11, '2021-02-11 11:19:41', '2021-02-14 07:40:33'),
(7, 7, 5, 2, 'GL-B252VPGY 240', 8, '2021-02-11 11:42:30', '2021-02-14 07:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `category_id`, `supplier_id`, `product_id`, `purchase_no`, `date`, `buying_qty`, `unit_price`, `buying_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '1', '2021-02-12', 1, 6000, 6000, 1, '2021-02-12 10:59:45', '2021-02-12 10:59:45'),
(3, 5, 2, 2, '2', '2021-02-12', 3, 30000, 90000, 1, '2021-02-12 11:01:31', '2021-02-12 11:01:31'),
(7, 7, 5, 7, '3', '2021-02-13', 10, 19000, 190000, 1, '2021-02-13 09:09:52', '2021-02-13 09:09:52'),
(9, 6, 1, 5, '4', '2021-02-13', 15, 7000, 105000, 1, '2021-02-13 12:44:02', '2021-02-13 12:44:02'),
(10, 1, 1, 3, '5', '2021-02-13', 10, 6000, 60000, 1, '2021-02-13 12:45:10', '2021-02-13 12:45:10'),
(11, 2, 2, 1, '6', '2021-02-14', 10, 5000, 50000, 1, '2021-02-13 22:33:28', '2021-02-13 22:33:28'),
(12, 5, 2, 2, '7', '2021-02-14', 14, 25000, 350000, 1, '2021-02-13 23:22:16', '2021-02-13 23:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `shop_details`
--

CREATE TABLE `shop_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_details`
--

INSERT INTO `shop_details` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'The Shops at Columbus Circle', 'Dhaka Bangladesh', '2021-02-14 17:23:03', '2021-02-14 22:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Bosundhara LTD', '0179270132', 'geno@mailinator.com', 'Domar Nilphamari', '2021-02-11 04:02:47', '2021-02-11 11:07:44'),
(2, 'Computer House', '018372717', 'chouse@gmail.com', 'Chilahati, Nilphamari', '2021-02-11 04:03:13', '2021-02-11 11:06:21'),
(5, 'Vision', '0172628271', 'vision@gmail.com', 'Dhaka Bangladesh', '2021-02-11 11:38:22', '2021-02-11 11:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'KG', '2021-02-11 08:58:15', '2021-02-11 08:58:15'),
(2, 'PCS', '2021-02-11 08:58:41', '2021-02-11 09:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `address`, `gender`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rony Islam', 'rony.rng@gmail.com', NULL, '$2y$10$FHBITZQM//5NdeH0mtf8guw4ffbInr9XH3l3IrNFv6FP3PmJ5WMMa', '01722718234', 'Dhaka Bangladesh', 'Male', 'public/backend/upload/users/1694560504052990.gif', 'cmlvKyoWdBV3iMIkygwDGhmQCM9oIpxEql2KN1KybIRsSsjUQA6WU9esAEEO', NULL, '2021-03-18 03:13:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_details_category_id_foreign` (`category_id`),
  ADD KEY `invoice_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`),
  ADD KEY `payments_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_details_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_category_id_foreign` (`category_id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchases_product_id_foreign` (`product_id`);

--
-- Indexes for table `shop_details`
--
ALTER TABLE `shop_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shop_details`
--
ALTER TABLE `shop_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
