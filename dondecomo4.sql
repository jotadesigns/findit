-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2016 a las 15:08:42
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dondecomo4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_plato` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `id_restaurante`, `id_plato`, `created_at`, `updated_at`) VALUES
(1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_menu`, `id_restaurante`) VALUES
(1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_10_15_180823_create_restaurante_and_menu_and_plato_tables', 1),
(4, '2016_10_23_190023_create_social_accounts_table', 1),
(5, '2016_10_29_190023_create_likes_table', 1),
(6, '2016_10_31_190023_create_peticiones_empresas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones_empresas`
--

CREATE TABLE `peticiones_empresas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_admin` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mensaje` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `peticiones_empresas`
--

INSERT INTO `peticiones_empresas` (`id`, `id_admin`, `id_restaurante`, `mensaje`, `created_at`, `updated_at`, `activado`) VALUES
(5, 1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 'yuyu', '2016-11-01 02:55:14', '2016-11-01 02:55:14', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id_plato` int(10) UNSIGNED NOT NULL,
  `id_menu` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `precio` double(8,2) NOT NULL DEFAULT '0.00',
  `estrella` tinyint(1) NOT NULL DEFAULT '0',
  `icono` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'icono11.png',
  `categoria_plato` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `female` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `male` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `menor_edad` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `mayor_edad` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id_plato`, `id_menu`, `nombre`, `precio`, `estrella`, `icono`, `categoria_plato`, `updated_at`, `female`, `male`, `menor_edad`, `mayor_edad`) VALUES
(1, 1, 'pizza', 8.50, 1, 'icono8.png', 'pizzas', '', 1, 1, 1, 1),
(2, 1, 'pizzas hit', 10.99, 0, 'icono8.png', 'pizzas', '', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
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
  `nombre_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_admin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indice_foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `franquicia` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `lat`, `lng`, `tipo`, `domicilio`, `terraza`, `parking`, `eventos_deportivos`, `nombre_restaurante`, `id_admin`, `updated_at`, `indice_foto`, `franquicia`) VALUES
('ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 40.54, -3.63, 0, 0, 0, 0, 0, 'Zagros Sports La Moraleja', '1', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_accounts`
--

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rango` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `conf_modonav` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'walking',
  `conf_destacados` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `rango`, `conf_modonav`, `conf_destacados`) VALUES
(1, 'jota', 'jotacheca@gmail.com', '$2y$10$6MplaP5qn3.JhJ9it8J/gOtAbVrbJUBqbM7MHF0iP0BEgIMFtwkEa', 'Jo1H9Z6LjjXToxzWieX7VQxXcd8eZRcsZOYo4EwrBM9s46QuCcS66CxiCo4V', '2016-11-01 01:35:32', '2016-11-01 01:36:31', 'A', 'bicycling', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD KEY `likes_id_foreign` (`id`),
  ADD KEY `likes_id_restaurante_foreign` (`id_restaurante`),
  ADD KEY `likes_id_plato_foreign` (`id_plato`);

--
-- Indices de la tabla `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menus_id_restaurante_foreign` (`id_restaurante`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `peticiones_empresas`
--
ALTER TABLE `peticiones_empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peticiones_empresas_id_admin_foreign` (`id_admin`),
  ADD KEY `peticiones_empresas_id_restaurante_foreign` (`id_restaurante`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id_plato`),
  ADD KEY `platos_id_menu_foreign` (`id_menu`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id_restaurante`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `peticiones_empresas`
--
ALTER TABLE `peticiones_empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
