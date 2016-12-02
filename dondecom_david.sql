-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2016 a las 22:16:19
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dondecom_david`
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
(1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 1, NULL, NULL),
(2, 'ChIJZxCnkO0sQg0RYhK04NE0z18', 33, NULL, NULL),
(1, 'ChIJfcd-A_ErQg0RThF_ZkHbEYk', 13, NULL, NULL),
(1, 'ChIJ_WCqJ1QsQg0RSI64TW3uNLA', 35, NULL, NULL),
(1, 'ChIJjy-zf3AsQg0RVbtrGEtAKWg', 38, NULL, NULL),
(1, 'ChIJjy-zf3AsQg0RVbtrGEtAKWg', 42, NULL, NULL),
(1, 'ChIJjy-zf3AsQg0RVbtrGEtAKWg', 43, NULL, NULL);

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
(1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk'),
(2, 'ChIJfcd-A_ErQg0RThF_ZkHbEYk'),
(3, 'ChIJe8y4CKAuQg0RC4YervOOVLg'),
(4, 'ChIJZZm6bP4rQg0RY-a5C4xH6Ys'),
(5, 'ChIJaxYp0fYrQg0RS0WRmRf_cZc'),
(6, 'ChIJn1QDu_orQg0RhpsWeE4J1Io'),
(7, 'ChIJyx1FA_ErQg0RSCwofO9GkB4'),
(8, 'ChIJ0y71Df4rQg0RM_ThNsqWrDs'),
(9, 'ChIJ5Xljg-8rQg0R6p8ylZ_roAQ'),
(10, 'ChIJkU9IvforQg0RNVyVrAlTxhI'),
(11, 'ChIJASzzWfsrQg0Rhln1dS_ross'),
(12, 'ChIJjy-zf3AsQg0RVbtrGEtAKWg'),
(13, 'ChIJ_WCqJ1QsQg0RSI64TW3uNLA'),
(14, 'ChIJVx5UfPcrQg0RaY3LHfoQYnc'),
(15, 'ChIJjcg5M_ErQg0RYJncMBeE0YQ'),
(16, 'ChIJsUftC1wsQg0RJhvmwdeO7w8'),
(17, 'ChIJZxCnkO0sQg0RYhK04NE0z18');

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
(5, 1, 'ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 'yuyu', '2016-11-01 02:55:14', '2016-12-01 01:51:24', 1),
(6, 1, 'ChIJ_WCqJ1QsQg0RSI64TW3uNLA', 'ok1', '2016-12-01 21:26:14', '2016-12-01 22:29:54', 1),
(7, 1, 'ChIJyx1FA_ErQg0RSCwofO9GkB4', 'asdf', '2016-12-01 22:36:28', '2016-12-01 22:37:49', 1);

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
(2, 1, 'pizzas hit', 10.99, 0, 'icono8.png', 'pizzas', '', 1, 1, 1, 1),
(11, 2, 'da', 2.00, 0, 'icono1.png', 'da', '', 1, 1, 1, 1),
(12, 2, 'prueba', 2.00, 0, 'icono1.png', 'hoka', '', 1, 1, 1, 1),
(9, 3, 'oru', 1.00, 0, 'icono1.png', 'Oru', '', 1, 1, 1, 1),
(6, 4, 'menucombi1', 1.00, 0, 'icono3.png', 'menuCombi', '', 1, 1, 1, 1),
(10, 2, 'da', 2.00, 0, 'icono1.png', 'da', '', 1, 1, 1, 1),
(8, 4, 'masivoMenu', 1.00, 0, 'icono6.png', 'masivoMenu', '', 1, 1, 1, 1),
(13, 2, 'pruebaaaa', 2.00, 0, 'icono1.png', 'hokaaa', '', 1, 1, 1, 1),
(14, 2, 'pruebaaaa', 2.00, 0, 'icono1.png', 'hokaaa', '', 1, 1, 1, 1),
(15, 3, 'sd', 0.00, 0, 'icono1.png', 'hokaaaa', '', 1, 1, 1, 1),
(16, 3, 'asf', 0.00, 0, 'icono1.png', 'hoka', '', 1, 1, 1, 1),
(17, 3, 'asf', 0.00, 0, 'icono1.png', 'hoka', '', 1, 1, 1, 1),
(18, 3, 'asdasd', 22.00, 0, 'icono1.png', 'hokaasdasd', '', 1, 1, 1, 1),
(19, 5, 'asd', 2.00, 0, 'icono1.png', 'adad', '', 1, 1, 1, 1),
(20, 8, 'jhk', 0.00, 0, 'icono2.png', 'xcdv', '', 1, 1, 1, 1),
(21, 9, 'asdasd', 0.00, 0, 'icono3.png', 'ads', '', 1, 1, 1, 1),
(22, 10, 'prueba', 11.00, 0, 'icono5.png', 'prueba', '', 1, 1, 1, 1),
(23, 11, 'pescado', 11.00, 0, 'icono2.png', 'class=\'form-control\'', '', 1, 1, 1, 1),
(24, 12, 'batido de fresa', 5.50, 0, 'icono1.png', 'postres', '', 1, 1, 1, 1),
(25, 13, 'batido de fresa', 5.50, 0, 'icono1.png', 'postres', '', 1, 1, 1, 1),
(26, 12, 'pepsi', 2.50, 0, 'icono3.png', 'bebidas', '', 1, 1, 1, 1),
(27, 13, 'pepsi', 2.50, 0, 'icono3.png', 'bebidas', '', 1, 1, 1, 1),
(28, 14, 'copas', 11.00, 0, 'icono13.png', 'class=\'form-control\'', '', 1, 1, 1, 1),
(29, 14, 'fritura', 22.00, 0, 'icono1.png', 'class=\'form-control\'', '', 1, 1, 1, 1),
(30, 15, 'zana', 11.00, 0, 'icono11.png', 'class=\'form-control\'', '', 1, 1, 1, 1),
(31, 15, 'otro', 21.00, 0, 'icono1.png', 'class=\'form-control\'', '', 1, 1, 1, 1),
(32, 16, 'pescado', 1000.00, 0, 'icono2.png', 'pescado', '', 1, 1, 1, 1),
(33, 17, 'pescado', 1000.00, 0, 'icono2.png', 'pescado', '', 1, 1, 1, 1),
(35, 13, 'prueba ajax', 1.00, 0, 'icono1.png', 'prueba', '', 1, 1, 1, 1),
(36, 12, 'prueba bufalo 1', 1.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(37, 12, 'prueba bufalo 2', 2.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(38, 12, 'prueba bufalo 3', 3.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(39, 12, 'prueba bufalo 4', 4.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(40, 12, 'prueba bufalo 5', 5.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(41, 12, 'prueba bufalo 6', 6.00, 0, 'icono2.png', 'pruebas', '', 1, 1, 1, 1),
(42, 12, 'prueba bufalo 7', 7.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(43, 12, 'prueba bufalo 8', 8.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(44, 12, 'prueba bufalo 9', 9.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1),
(45, 12, 'prueba bufalo 10', 10.00, 0, 'icono1.png', 'pruebas', '', 1, 1, 1, 1);

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
  `id_admin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indice_foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `franquicia` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id_restaurante`, `lat`, `lng`, `tipo`, `domicilio`, `terraza`, `parking`, `eventos_deportivos`, `nombre_restaurante`, `id_admin`, `updated_at`, `indice_foto`, `franquicia`) VALUES
('ChIJl62bvvgsQg0Rs7KV-dQ35Sk', 40.54, -3.63, 0, 0, 0, 0, 0, 'Zagros Sports La Moraleja', '1', '', '', 0),
('ChIJfcd-A_ErQg0RThF_ZkHbEYk', 40.51, -3.67, 0, 1, 1, 1, 1, 'Otro Jerezano Restaurant', '2', '', '', 0),
('ChIJe8y4CKAuQg0RC4YervOOVLg', 40.50, -3.67, 0, 1, 1, 0, 0, 'La Dehesa IV Restaurant', '2', '', '', 0),
('ChIJZZm6bP4rQg0RY-a5C4xH6Ys', 40.50, -3.67, 0, 0, 0, 1, 1, 'Restaurante Wok Passion', '2', '', '', 0),
('ChIJaxYp0fYrQg0RS0WRmRf_cZc', 40.51, -3.67, 0, 0, 0, 0, 0, 'Ochenta Grados', '2', '', '', 0),
('ChIJn1QDu_orQg0RhpsWeE4J1Io', 40.50, -3.67, 0, 0, 0, 0, 0, 'Antojos Araguaney Gourmet', '2', '', '', 0),
('ChIJyx1FA_ErQg0RSCwofO9GkB4', 40.50, -3.67, 0, 0, 0, 0, 0, 'Ginos Lafayette', NULL, '2016-12-01 23:37:49', '', 0),
('ChIJ0y71Df4rQg0RM_ThNsqWrDs', 40.50, -3.67, 0, 0, 0, 0, 0, 'Ginos', '2', '', '', 0),
('ChIJ5Xljg-8rQg0R6p8ylZ_roAQ', 40.51, -3.67, 0, 0, 0, 0, 0, 'Taberna Española La Lola', '2', '', '', 0),
('ChIJkU9IvforQg0RNVyVrAlTxhI', 40.50, -3.67, 0, 0, 0, 0, 0, 'Manolito por Dios', '2', '', '', 0),
('ChIJASzzWfsrQg0Rhln1dS_ross', 40.50, -3.67, 0, 0, 0, 0, 0, 'La Burla de Quevedo', '2', '', '', 0),
('ChIJjy-zf3AsQg0RVbtrGEtAKWg', 40.53, -3.65, 0, 0, 0, 1, 1, 'Buffalo Grill', '1', '', '', 0),
('ChIJ_WCqJ1QsQg0RSI64TW3uNLA', 40.53, -3.63, 0, 1, 1, 0, 0, 'La Mafia se sienta a la mesa', '1', '2016-12-01 23:29:54', '', 0),
('ChIJVx5UfPcrQg0RaY3LHfoQYnc', 40.51, -3.67, 0, 0, 0, 0, 0, 'Caprichos', '2', '', '', 0),
('ChIJjcg5M_ErQg0RYJncMBeE0YQ', 40.51, -3.67, 0, 0, 0, 0, 0, 'La Nicoletta Las Tablas', '2', '', '', 0),
('ChIJsUftC1wsQg0RJhvmwdeO7w8', 40.53, -3.64, 0, 0, 0, 0, 0, 'Vips', '2', '', '', 0),
('ChIJZxCnkO0sQg0RYhK04NE0z18', 40.55, -3.64, 0, 0, 0, 0, 0, 'Vips', '2', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante_pendientes`
--

CREATE TABLE `restaurante_pendientes` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `id_restaurante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `restaurante_pendientes`
--

INSERT INTO `restaurante_pendientes` (`id_menu`, `id_restaurante`, `id_admin`, `nombre`, `direccion`) VALUES
(16, 'ChIJQ_Nw8wUtQg0RyPDzRshjqag', 2, 'Vips', 'Calle de Anabel Segura, s/n, 28108 Alcobendas, Madrid, Spain'),
(9, 'ChIJVbGKKfYsQg0R88oAVasaYZw', 1, 'il Punto Ristorante', 'Bulevar de Salvador Allende, 10, Alcobendas'),
(19, 'ChIJ02qviXMsQg0RN8YkP4pEU3A', 2, 'Vips', 'Av. de Europa, 10, 28100 Alcobendas, Madrid, Spain'),
(20, 'ChIJDW5t8wUtQg0RXVux41Ef2WA', 2, 'Vips', 'Plaza del Comercio s/n, 28700 San Sebastián de los Reyes, Spain'),
(21, 'ChIJeWcNi3woQg0R0AehfKUYvb4', 2, 'Vips', 'Calle Gran Vía, 65, 28013 Madrid, Spain'),
(22, 'ChIJnRes_ukoQg0R3MLJVhHGv2Q', 2, 'Vips', 'Calle de Velázquez, 136, 28006 Madrid, Spain'),
(23, 'ChIJrSMK3IIoQg0RyxvyRTAMGwc', 2, 'VIPS', 'Plaza Cánovas del Castillo, 5, 28014 Madrid, Spain');

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
(1, 'jotadesign', 'jotacheca@gmail.com', '$2y$10$6MplaP5qn3.JhJ9it8J/gOtAbVrbJUBqbM7MHF0iP0BEgIMFtwkEa', 've0lvqxYQCiZzjKkmdaXXRAXIf702M0o4Eie2rr1K434QL4sCyVDRf8ou162', '2016-11-01 01:35:32', '2016-12-01 18:27:39', 'R', 'bicycling', 1),
(2, 'wicked kuja', '1@1.com', '$2y$10$cSSa7ahmgVZl08fv5woQD.pbNILNXpmFNn3PPO/VnIpWWnRu2dgZm', NULL, '2016-11-22 19:05:36', '2016-11-22 19:05:36', 'A', 'walking', 1);

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
-- Indices de la tabla `restaurante_pendientes`
--
ALTER TABLE `restaurante_pendientes`
  ADD PRIMARY KEY (`id_menu`);

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
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `peticiones_empresas`
--
ALTER TABLE `peticiones_empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id_plato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `restaurante_pendientes`
--
ALTER TABLE `restaurante_pendientes`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
