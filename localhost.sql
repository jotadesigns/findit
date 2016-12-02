-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2016 at 07:29 PM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id87169_comosocial`
--
CREATE DATABASE IF NOT EXISTS `id87169_comosocial` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id87169_comosocial`;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id_menu`, `id_restaurante`) VALUES
(1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk'),
(3, 'ChIJ4UVD1XwsQg0RXCJ3G2nYNns');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_10_15_180823_create_restaurante_and_menu_and_plato_tables', 1),
(4, '2016_10_23_190023_create_social_accounts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(10) UNSIGNED NOT NULL,
  `id_menu` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `precio` double(8,2) NOT NULL DEFAULT '0.00',
  `estrella` tinyint(1) NOT NULL DEFAULT '0',
  `icono` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'icono11.png',
  `categoria_plato` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female` int(255) NOT NULL DEFAULT '1',
  `male` int(255) NOT NULL DEFAULT '1',
  `menor_edad` int(255) NOT NULL DEFAULT '1',
  `mayor_edad` int(255) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `platos`
--

INSERT INTO `platos` (`id_plato`, `id_menu`, `nombre`, `precio`, `estrella`, `icono`, `categoria_plato`, `female`, `male`, `menor_edad`, `mayor_edad`) VALUES
(2, 1, 'pizza', 9.00, 0, 'icono3.png', 'pizzas', 3, 8, 3, 8),
(5, 1, 'pizza hot', 2.00, 0, 'icono3.png', 'pizzas', 6, 8, 0, 2),
(6, 1, 'pizza car', 50.00, 0, 'icono3.png', 'pizzas car', 6, 8, 0, 2),
(7, 3, 'pizzahawao', 2.00, 0, 'icono8.png', 'pizzas', 7, 8, 0, 2),
(8, 3, 'pizzabacon', 55.00, 0, 'icono8.png', 'pizzas', 7, 8, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lat` double(8,2) NOT NULL DEFAULT '0.00',
  `lng` double(8,2) NOT NULL DEFAULT '0.00',
  `tipo` int(11) NOT NULL DEFAULT '0',
  `domicilio` tinyint(1) NOT NULL DEFAULT '0',
  `terraza` tinyint(1) NOT NULL DEFAULT '0',
  `parking` tinyint(1) NOT NULL DEFAULT '0',
  `eventos_deportivos` tinyint(1) NOT NULL DEFAULT '0',
  `nombre_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `lat`, `lng`, `tipo`, `domicilio`, `terraza`, `parking`, `eventos_deportivos`, `nombre_restaurante`) VALUES
('ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 40.54, -3.63, 0, 0, 0, 0, 0, 'Zagros Sports La Moraleja'),
('ChIJ4UVD1XwsQg0RXCJ3G2nYNns', 40.52, -3.64, 0, 0, 0, 0, 0, 'El Galpon de Jose Luis');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_accounts`
--

INSERT INTO `social_accounts` (`user_id`, `provider_user_id`, `provider`, `created_at`, `updated_at`) VALUES
(7, '118958215239678', 'facebook', '2016-10-28 20:09:28', '2016-10-28 20:09:28'),
(8, '1335222639831031', 'facebook', '2016-10-28 20:22:32', '2016-10-28 20:22:32'),
(4, '1811940489088686', 'facebook', '2016-10-29 03:10:23', '2016-10-29 03:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, NULL, 'Beringola a', '118958215239679', '', 'AvF0unLuQbtAIrWvRvnd7pW1C3Q8XkpP6kBBgkzW6qqxzPTYcXahl9ax8dUK', '2016-10-28 20:09:28', '2016-10-29 17:58:57'),
(4, NULL, 'jota', 'jotacheca@gmail.com', '$2y$10$kehrr1X2aiypxvmLnVSk6OqtvA7cCssRWSMXVcX5CAwBzuqH/oGGS', 'YHKHSPpCABvAHvCf4RlcL0QInZCeOpBcGk1zD3qm1MuRTMQQ1o4MwmHSpgk1', '2016-10-28 19:07:17', '2016-10-28 19:40:02'),
(8, NULL, 'Jorge Checa Stefler', 'newjorge_george@hotmail.com', '', 'xz41qS7CVAIvhUdn4mYkZ0EwZOdkL2YHgPPpDw41WnnhcUBdWfHDZmLf4Z4p', '2016-10-28 20:22:32', '2016-10-28 20:25:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menus_id_restaurante_foreign` (`id_restaurante`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`),
  ADD KEY `platos_id_menu_foreign` (`id_menu`);

--
-- Indexes for table `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
