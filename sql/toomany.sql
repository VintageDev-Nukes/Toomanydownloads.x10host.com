-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2020 a las 01:05:55
-- Versión del servidor: 8.0.22
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `toomany`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bannedips`
--

CREATE TABLE `bannedips` (
  `id` bigint NOT NULL,
  `ip` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE `faq` (
  `id` bigint NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL DEFAULT '0',
  `mensaje` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gamedata`
--

CREATE TABLE `gamedata` (
  `id` bigint NOT NULL,
  `item_id` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `gamedesc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `platform` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dev` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distributor` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `genre` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `players` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `lang` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `age` int NOT NULL DEFAULT '0',
  `release` int NOT NULL DEFAULT '0',
  `media_img` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `media_video` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `req` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `custom_post` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cat` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'games',
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `thumb` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `points` int NOT NULL DEFAULT '0',
  `downloads` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `sended_by` bigint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `id` bigint NOT NULL,
  `noticia` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report`
--

CREATE TABLE `report` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int NOT NULL DEFAULT '0',
  `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

CREATE TABLE `stats` (
  `id` int NOT NULL,
  `new_users` int NOT NULL,
  `new_items` int NOT NULL,
  `new_downs` int NOT NULL,
  `new_visits` int NOT NULL,
  `users_online` int NOT NULL,
  `new_money` int NOT NULL,
  `new_tickets` int NOT NULL,
  `new_reports` int NOT NULL,
  `new_points` int NOT NULL,
  `new_refers` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL DEFAULT '0',
  `titulo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int DEFAULT NULL,
  `state` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` bigint NOT NULL,
  `ticket_id` bigint NOT NULL DEFAULT '0',
  `user_id` bigint DEFAULT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nickname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `refer_id` int NOT NULL DEFAULT '0',
  `points` bigint NOT NULL DEFAULT '0',
  `money` bigint NOT NULL DEFAULT '0',
  `lvl` int NOT NULL DEFAULT '0',
  `exp` bigint NOT NULL DEFAULT '0',
  `numvsts` bigint NOT NULL DEFAULT '0',
  `acc_prior` int NOT NULL DEFAULT '0',
  `acc_type` text,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `activation` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ip_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `datetime` int NOT NULL DEFAULT '0',
  `lastconn` int NOT NULL DEFAULT '0',
  `lastclaim` int DEFAULT NULL,
  `visitarray` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `remainingvisits` int NOT NULL DEFAULT '3',
  `multiplier` int NOT NULL DEFAULT '1',
  `discount` int NOT NULL DEFAULT '0',
  `realname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `personal_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gender` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `birthdate` int NOT NULL DEFAULT '0',
  `website_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `skype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time_format` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `about_me` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `time_offset` float NOT NULL DEFAULT '0',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `buddy_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ignore_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `badge_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `header_banner` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `notifications` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `banned_duration` int DEFAULT NULL,
  `banned_time` int DEFAULT NULL,
  `banned_reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_report`
--

CREATE TABLE `user_report` (
  `id` bigint NOT NULL,
  `reported_by` bigint NOT NULL,
  `reported_user` bigint NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `creation` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bannedips`
--
ALTER TABLE `bannedips`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `faq`
--
ALTER TABLE `faq`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `gamedata`
--
ALTER TABLE `gamedata`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `report`
--
ALTER TABLE `report`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bannedips`
--
ALTER TABLE `bannedips`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gamedata`
--
ALTER TABLE `gamedata`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `report`
--
ALTER TABLE `report`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_report`
--
ALTER TABLE `user_report`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
