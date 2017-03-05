-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2014 a las 11:21:19
-- Versión del servidor: 5.1.71
-- Versión de PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `toomanyd_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bannedips`
--

CREATE TABLE IF NOT EXISTS `bannedips` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `ip` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(7) NOT NULL DEFAULT '0',
  `mensaje` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `mensaje`, `creation`, `approved`) VALUES
(1, 1, '', 1393011181, 1),
(2, 1, '', 1393016249, -1),
(3, 1, 'tetstetes', 1393016385, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gamedata`
--

CREATE TABLE IF NOT EXISTS `gamedata` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `gamedesc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `platform` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dev` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `distributor` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `genre` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `players` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `lang` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `age` int(11) NOT NULL DEFAULT '0',
  `release` int(11) NOT NULL DEFAULT '0',
  `media_img` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `media_video` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `req` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `custom_post` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `gamedata`
--

INSERT INTO `gamedata` (`id`, `item_id`, `name`, `gamedesc`, `platform`, `dev`, `distributor`, `genre`, `players`, `lang`, `age`, `release`, `media_img`, `media_video`, `req`, `custom_post`) VALUES
(1, 'games_2', 'GTA IV', 'La popular saga GTA llega a las plataformas de nueva generaciÃ³n con esta cuarta entrega. Una nueva historia protagonizada por Niko Bellic, un gangster de Europa del Este que acude a Estados Unidos en busca el sueÃ±o americano.', 'PC, Xbox 360, PS3', 'RockStar Games', 'Take 2', 'AcciÃ³n, Aventura, Shooter', '1, 2-32 (online) (Competitivo: 2-16 / Cooperativo: 2-8)', 'Manual: EspaÃ±ol, Textos: EspaÃ±ol, Voces: InglÃ©s', 18, 1228284000, 'a:4:{i:0;s:57:"http://media.gtanet.com/images/4498-gta-iv-screenshot.jpg";i:1;s:57:"http://media.gtanet.com/images/4590-gta-iv-screenshot.jpg";i:2;s:57:"http://media.gtanet.com/images/4499-gta-iv-screenshot.jpg";i:3;s:82:"http://www.thegtaplace.com/images/gta4/screenshots/pc/gta-iv-pc-screenshot_045.jpg";}', 'a:1:{i:0;s:42:"http://www.youtube.com/watch?v=Fh2egiqQY8A";}', 'a:3:{i:0;s:250:"Sistema Operativo: Windows Vista SP1 / Windows XP SP3\nProcesador: Intel Core 2 Duo 1.8 Ghz, AMD Athlon X2 64 2.4 Ghz\nMemoria: 1.5GB Windows Vista / 1GB Windows XP\nEspacio en Disco: 16GB libres\nGrÃ¡fica: 256MB NVIDIA 7900 / 256MB ATI X1900";i:1;s:281:"Sistema Operativo: Windows Vista SP1 / Windows XP SP3\nMicroProcesador: Intel Core 2 Quad 2.4Ghz, AMD Phenom X3 2.1Ghz\nRAM: 2.5GB Windows Vista / 2.5GB Windows XP\nEspacio en Disco: 18GB libres\nGrÃ¡fica: 512 MB NVIDIA 8600 / 512MB ATI 3870\nOtros: DVD-ROM de doble capa";i:2;s:0:"";}', NULL),
(2, 'games_7', 'Terraria', 'Terraria es un "sandbox" en 2D al estilo de Minecraft, que nos concede una gran libertad de acciÃ³n para sobrevivir a los peligros que se ocultan tras este colorista universo. ExploraciÃ³n, recolecciÃ³n de recursos, construcciÃ³n y elaboraciÃ³n de objetos mediante recetas forman parte del encanto de este tÃ­tulo independiente.', 'PC, Xbox 360, PS3, Vita, iPhone, iPad, Android', 'Re-Logic', 'Steam', 'AcciÃ³n, Aventura, Plataformas (FantasÃ­a)', '1-8 (Competitivo: 8 / Cooperativo: 8)', 'Textos: InglÃ©s, Voces: lnglÃ©s', 12, 1305522000, 'a:3:{i:0;s:64:"http://www.terrariaonline.com/attachments/aero-slopes-png.90325/";i:1;s:78:"http://www.terrariaonline.com/attachments/rudoboy-half-tiles-upward-png.90323/";i:2;s:71:"http://www.terrariaonline.com/attachments/suweekadeathlaser2-png.90327/";}', 'a:1:{i:0;s:42:"http://www.youtube.com/watch?v=E0scnF8pXfU";}', 'a:3:{i:0;s:13:"Desconocidos.";i:1;s:356:"Sistema Operativo: Windows XP/Vista/7\r\nProcesador: Intel Pentium 4 @ 1.6 GHz / AMD Athlon XP 1600+\r\nRAM: 512 Mb\r\nEspacio en Disco: 200 Mb free\r\nTarjeta GrÃ¡fica RAM: 128 Mb\r\nTarjeta GrÃ¡fica: nVidia GeForce FX 5200 / ATI Radeon 9600\r\nTarjeta de Sonido: DirectX Compatible\r\nRed: 56K Internet Connection for Online Multiplayer\r\nDirect X: 9.0c";i:2;s:13:"Desconocidos.";}', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cat` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'games',
  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `thumb` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `points` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `discount` int(3) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `sended_by` bigint(7) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `cat`, `url`, `thumb`, `points`, `downloads`, `discount`, `approved`, `sended_by`) VALUES
(1, 'GMOD 11', 'Descarga GMOD 11 Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOZ4Lw7hrq7c0xPJ5XtlsKgy+4i5lVZEzhpSEAhtig2Af9/AjxTbTJqnHsKlV0R+rCHFuWsV9wQgY8Cd/y4eH4ZdD29TFAq25BY0gqMeoGDV8vQzL/uG5p9gKq8R+GlKiNwj99Bv3f3MyXmcq7oXHjSp3aPdrXPDhObDvYlqYU0gMcHf4ZycGp6WI6PUyFJ/AvMjw7lHSW3kIv5Q3jc0L4flxYSY/pWZIdB6THFctolnMLDI7+ZWGsKWGHLOl6XuyX/xZJilQ6wr8bx/5xdnYi0B+GqQG00WKIsl3T657jhkqL8ChhRNOwQG3SX+n3PzORrqNlfwQimkvNhVI5S/8A6zXNlOXpEA3jz2bzeR8a5O9ZTl8ReE4+4MlBAFiMyKYYA8lCR6GhR5JFY5lbTbQKChLeXtJrCsMV8WyBfpv2JbvQ423ujNamIlZIn10DflyjNsDqpXG5pvYUx+oLWnIHyCyHxppnIy3/UI8ohV/1lE1Dwurr9BXdHn5UocfAgbEMCJXc48x05/tSB9kICZv9RaNQb2rl/0ql7MrYceqUX69JKXa+7JPqifmZN1QQBAVd67H2loye6XOTTYOBOohFrDAVNQVdU3ei31zGmS0u6H2E0mlII2B14poUHhM/40NNFKplIUK+lHHJCCoj7FxwUEUVsmsEJL0v58tDIME1OAkfODlp0E32E1pv6RPePkIQUYQBRxoANIebPA0bU+lJVY=', 'http://tinyurl.com/o3odc5r', 15, 0, 0, 1, 0),
(2, 'GTA IV', 'Descarga GTA IV Gratis', 'games', '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', 'http://tinyurl.com/q5k75xd', 35, 0, 0, 1, 0),
(3, 'FlatOut 2', 'Descarga FlatOut 2 Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOWTs9BO63L53Hvnr/mBbNOY3y1qsO2DQaOEK38bfCeJLkYFpWveDXfOxDCRyxnzCV0JBruxEfNPw+f8D7Ip7odSxq+u725rri921swjqVWXAi5YSUG3QOzyY5in9x7MgsQWLF37W5Lol+rZCzAgpVOtCG4CjvrPuKHhC0A9MeKYtllzvNN2LQ230OF8SZFh2wfmsvIbNAlxhwU+G0PSTFzaw+MOO2qw+NAP6qHaJx9AjBAXvfA9xXMxPoQRyjJQRoK/xFWU5X6tQoXIVjKZiWmiNfNSGjtnV4m3cwL/AMtCz5bpHKrv+faterY4FcmPfQZADHqly1gI4t1oRObi5YipxUIRDIHGlW0OvM6HzAtFwyttvuqT30gIaOy9Z3+EbufqB7Kp5If5R3SqHSbq0ljbYXitKzYVMBpblvKDP5Q6QeWE9QvKj3vaTQi4s9qUE3NrXM7kp+H1uuM0SmqULTmfrLv6h+96TFT03SjqGARiuIewMh7iiBBzzupLK4xcDBX74VgN3La0jy+mCyQjWGVn0xN8TXjkEYdUcSUdbw0L9H8D5YeHL4FUK97pO0YhkzYwKrsg7+1UcPcZI1LaYOdobqsVOcq/l40tLcQvJGZuIMUMET41oUtgXX52bH0aU8AXyhjzsIUQ04yBf0ewbHNhuUA2vvcpsOswv17K8gy6M6Ohbgw4gCerDAF5/1fPa7sJfOTwQAp5wFImYyt9FlacehwbvA1zMxS1XGFJJHFYy/KeS2Ymw22ScIplvIbz/JzUST7kHKqC7vuQNmz6vWVAQKN0VHuDX5l0anyNlhVY9z7fRwxzMB4dqbSwVz0LKljEbWIOntcsJT0bI3wHVrOI4X78YTPZMVcqK1j12GN0Femu++4cz1sDxJJD+MVAegg==', 'http://tinyurl.com/npwbgq7', 10, 1, 0, 1, 0),
(4, 'Killing Floor', 'Descarga Killing Floor Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bORiIS6cUzonbB9/KvfB2P+PMQg8ypkK9ULgTvMeBIh5D8LJAiDVrdo6f0wqha4Zl99d2Ydn2qYB0vvUq/fTBAtPM3yX3dK8ctIC6uOEzJClpyQXxBIHM/XFElnU53V8JIQP0kwCu79VtuD6ifa83c/Oh8p8Yh1D+1VRkn8yhP+exbS9mvwTKY8pYhv0LliXV0mieGxGiD0pWJZYaVfnyW4QD0LE+040QeuFxnzPqPx0fbxvhXMeZtyQ8HCv6FUcT9D8/dG40uB9diNIFNvJXYHuTSNP7nh+5ESEYBaSmCOS56pa/q4WB/CR3LDeAiDvigUgbzpFBw681dYlIxigl+Mhe0WAtPgtItjjhbyvGhJLxvXPPzDrJvrfUsEJE50uH9QH0B+mW6fypAQvrxcfjKwzz/4Cum40j02RgcYwc5ajyLaOtgRM7FNsbeO3bmbEYi59V+/Z02WoQTrfWzF/yCTTtEE8IaGYZ0hUA22+ZQ9faRQDtQuwrcTsCh/jg5Mt0/mXL9hO+W7BPf9f/qrXutlo8M7LwxJWkvCCpaPvO1t6dOigscP6YTqB8TlXLDXTh6iFIMBvwZ0d0XYvDofo79MDNbHbdUj7kbpLItvE4solV2U28p/BfMFW6rvm60mmdMIbYFO6bIVCc66hBdamzY1P2JHj7Bl60uGzIX5C8cMQGD7p1B+fmFsC3PtPiAX5TPKIzEPk8nED82/ShpmYL291tgV5XRvnxCOI2VaAKuYR2y77dtIVlp/czfC7aji66yPfVpW96aQxZU3TMM6f3XMNNNR+gpwxb3GMcgwWws3EaHd83W+jJ+EovQCtBvOWAwRrWLyAQL0+tjQozgeu6gISsj4tPFqpnTLUh9u+4zl/HH7gjhzIvImBvoif73FTuc9zvbGio2jUd6awLdC112fm0elpQhGS7fRqp6D8oBLE6s5mVu6/d9/hTAAvnCsIjzXagZRpE6Sxm1JL334YHDfTFBjnWnULwzIu5MhlKHHYDU+KPIGpkfsThKVlSA4cT5CaXFRYs6hMq0f82YeHzQOCMME1XRUDX84xaxkDCjzQ6CD0Fn4GC8xvydD0gM0OHIDbUjirxpkp3qnsSB4dXN+OVjJzbLNar37Ox6xgtPw9vqDN0Kpj+2cmpb3mW5He4YrIK4rqnF7jjImSai5Ou0DZm0czjNA8LDiqeIKydoTYeSs5UxIk976y5Tzr39MVXhRpuPsF7xgHVdXVm7m+QOIk=', 'http://tinyurl.com/nw3cnql', 20, 0, 0, 1, 0),
(5, 'GTA San Andreas', 'Descarga GTA SA Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOd+n4PtDCvyTi0138FMS9T9LXEoVN6ovlO16dXvoH58etIlLt5N+4um7nxhB4wnmPfs4W2k6ohnpe0yRTeDTgtoENYQrdXPAwAyVbB0CoaOd9LjoViuYUalyoU0YUuuxSj2cC5qbwqQfrBpV4tK7xNA=', 'http://tinyurl.com/o9cqg8d', 20, 1, 0, 1, 0),
(6, 'Call Of Duty 4', 'Descarga COD4 Gratis', 'games', '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', 'http://tinyurl.com/ptb5s9y', 25, 0, 0, 1, 0),
(7, 'Terraria', 'Descarga Terraria Gratis', 'games', 'a:1:{i:0;s:73:"https://mega.co.nz/#!H4pyib6I!X7ab6Zje_tDMTs6-jyEF6qqVATnaeWGftXe5f8goqDE";}', 'http://tinyurl.com/lal8b6v', 0, 32, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `noticia` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `news`
--

INSERT INTO `news` (`id`, `noticia`) VALUES
(1, '<b>¿Quieres ganar 5$ y 2k de puntos sólo compartiendo el enlace de un juego?</b> <a href="http://toomanydownloads.x10host.com/index.php?action=share">Entra aquí.</a>'),
(2, '<b>¿Algún link caido?</b> <a href="http://toomanydownloads.x10host.com/index.php?action=ticket&go=create">Crea un ticket para informarnos.</a>'),
(3, '<b>¿Te gusta esta página y quisieras dar tu opinión?</b> <a href="http://toomanydownloads.x10host.com/index.php?action=feedback">Aquí puedes darla.</a>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(7) NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int(11) NOT NULL DEFAULT '0',
  `type` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `new_users` int(11) NOT NULL,
  `new_items` int(11) NOT NULL,
  `new_downs` int(11) NOT NULL,
  `new_visits` int(11) NOT NULL,
  `users_online` int(11) NOT NULL,
  `new_money` int(11) NOT NULL,
  `new_tickets` int(11) NOT NULL,
  `new_reports` int(11) NOT NULL,
  `new_points` int(11) NOT NULL,
  `new_refers` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(7) NOT NULL DEFAULT '0',
  `titulo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int(11) DEFAULT NULL,
  `state` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `user_id`, `titulo`, `contenido`, `creation`, `state`) VALUES
(1, 1, 'yosy', 'yesy', 1, 'closed'),
(3, 1, 'ñllaoa', 'laaol', 1392431599, 'erased'),
(4, 1, 'ñañañañ', 'ñañaña', 1392561279, 'opened');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_comments`
--

CREATE TABLE IF NOT EXISTS `ticket_comments` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(7) NOT NULL DEFAULT '0',
  `user_id` bigint(7) DEFAULT NULL,
  `contenido` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation` int(11) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ticket_comments`
--

INSERT INTO `ticket_comments` (`id`, `ticket_id`, `user_id`, `contenido`, `creation`) VALUES
(1, 2, 1, 'test2', NULL),
(2, 2, 1, 'testeando', 1392407579),
(3, 2, 41, 'http://0xefro.blogspot.com', 1392408366),
(4, 4, 1, 'ñañaña', 1392561290);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `refer_id` int(25) NOT NULL DEFAULT '0',
  `points` bigint(20) NOT NULL DEFAULT '0',
  `money` bigint(20) NOT NULL DEFAULT '0',
  `lvl` int(11) NOT NULL DEFAULT '0',
  `exp` bigint(20) NOT NULL DEFAULT '0',
  `numvsts` bigint(20) NOT NULL DEFAULT '0',
  `acc_prior` int(11) NOT NULL DEFAULT '0',
  `acc_type` text,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `activation` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ip_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `datetime` int(11) NOT NULL DEFAULT '0',
  `lastconn` int(11) NOT NULL DEFAULT '0',
  `lastclaim` int(11) DEFAULT NULL,
  `visitarray` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `remainingvisits` int(11) NOT NULL DEFAULT '3',
  `multiplier` int(11) NOT NULL DEFAULT '1',
  `discount` int(11) NOT NULL DEFAULT '0',
  `realname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `personal_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `gender` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `birthdate` int(11) NOT NULL DEFAULT '0',
  `website_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `skype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time_format` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `about_me` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_offset` float NOT NULL DEFAULT '0',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `buddy_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ignore_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `badge_list` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `header_banner` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `notifications` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `banned_duration` int(11) NOT NULL,
  `banned_time` int(11) DEFAULT NULL,
  `banned_reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nickname`, `refer_id`, `points`, `money`, `lvl`, `exp`, `numvsts`, `acc_prior`, `acc_type`, `password`, `email`, `activation`, `ip_address`, `user_agent`, `datetime`, `lastconn`, `lastclaim`, `visitarray`, `remainingvisits`, `multiplier`, `discount`, `realname`, `personal_text`, `gender`, `birthdate`, `website_title`, `website_url`, `location`, `mail`, `skype`, `time_format`, `about_me`, `time_offset`, `avatar`, `buddy_list`, `ignore_list`, `badge_list`, `header_banner`, `notifications`, `banned_duration`, `banned_time`, `banned_reason`) VALUES
(1, 'Ikillnukes', 0, 16421982012, 0, 999, 8500005194, 1, 7, NULL, '3d0771e2546a1c422fe1b33fc25da81c', 'laoal', '1fe9fa7418aeda634b0d3901639a0c3b', '79.154.240.87', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391176225, 1393347606, 0, 'a:7:{i:2;i:1392927957;i:3;i:1392927959;i:4;i:1392927962;i:5;i:1392927967;i:6;i:1392927971;i:7;i:1392927974;i:147;i:1393346791;}', 599, 200, 0, 'Ãlvaro RodrÃ­guez GarcÃ­a', 'Comiendo hormigÃ³n. :B', 1, 900738000, 'Too Many Downloads! - Descargue aquÃ­ todos sus juegos', 'toomanydownloads.x10host.com', 'EspaÃ±a', 'ikillnukes1@gmail.com', 'ikillnukes', '', '', 0, 'http://ayudawordpress.com/wp-content/uploads/2009/02/muerte.jpg', '', '', '', 'http://img-fotki.yandex.ru/get/6413/137106206.152/0_9464d_c33f15da_orig.jpg', 'a:3:{i:0;b:0;s:8:"ticket_4";b:1;s:8:"report_2";b:1;}', 0, NULL, ''),
(2, NULL, 0, 186, 0, 0, 3, 3, 0, NULL, '4d186321c1a7f0f354b297e8914ab240', 'cacamax', '0', '186.14.234.161', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391184813, 1391184813, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(3, NULL, 0, 76, 0, 3, 26, 3, 0, NULL, NULL, NULL, '0', '201.212.232.188', 'Mozilla/5.0 (Windows NT 5.1; rv:26.0) Gecko/201001', 1391184834, 1392035520, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(4, NULL, 0, 138, 0, 3, 32, 4, 0, NULL, NULL, NULL, '0', '79.144.28.40', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391205156, 1392750669, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(5, NULL, 0, 163, 0, 3, 28, 2, 0, NULL, NULL, NULL, '0', '85.51.29.68', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391205190, 1391623349, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(6, NULL, 0, 14, 0, 2, 10, 2, 0, NULL, NULL, NULL, '0', '188.78.21.85', 'Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388', 1391205217, 1391205217, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(7, NULL, 0, 6, 0, 1, 7, 2, 0, NULL, NULL, NULL, '0', '87.111.9.138', 'Mozilla/5.0 (Linux; Android 4.1.2; C5303 Build/12.', 1391205301, 1391205301, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(8, NULL, 0, 4, 0, 1, 5, 0, 0, NULL, NULL, NULL, '0', '79.148.220.54', 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/201001', 1391212734, 1391212734, 0, NULL, 3, 3, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(9, NULL, 0, 2, 0, 1, 4, 0, 0, NULL, NULL, NULL, '0', '66.249.93.199', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391218761, 1392234584, 0, 'a:1:{i:3;i:1391303644;}', 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(10, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, '0', '83.100.189.111', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391289646, 1391289646, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(11, NULL, 3, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, '0', '50.7.54.18', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391303733, 1392234727, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(12, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, '0', '213.97.79.52', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391304494, 1391304494, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(13, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '81.202.232.205', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:26.0) Gecko', 1391355238, 1392419409, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(14, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '88.191.192.25', 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/201001', 1391366715, 1391366715, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(15, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '79.158.211.46', 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/201001', 1391368576, 1391368576, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(16, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '217.12.20.253', 'Mozilla/5.0 (X11; Linux i686; rv:12.0) Gecko/20100', 1391684143, 1391684143, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(17, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '88.16.192.208', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391704633, 1391704633, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(18, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '83.33.123.124', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391946588, 1391946588, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(19, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '178.119.93.172', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391947718, 1391947718, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(20, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '80.103.150.99', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391947796, 1391948853, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(21, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '80.39.195.146', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1391966148, 1391967122, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(22, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '23.20.217.206', 'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefo', 1391972413, 1391972413, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(23, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '96.47.226.22', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1;', 1391972467, 1391972467, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(24, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '176.195.58.48', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;', 1391972675, 1391987535, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(25, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '128.69.9.172', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;', 1391976401, 1391980072, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(26, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '37.59.24.7', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1;', 1391979081, 1391979081, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(27, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '81.169.174.178', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2;', 1391980679, 1391980679, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(28, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '46.188.5.220', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;', 1391983762, 1391991337, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(29, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '62.99.77.165', 'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0;', 1391984387, 1391984387, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(30, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '209.139.197.125', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1;', 1392017099, 1392017099, 0, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(32, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '195.159.140.216', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv', 1392148400, 1392148400, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(37, NULL, 0, 250, 0, 0, 0, 0, 6, NULL, 'b59c67bf196a4758191e42f76670ceba', 'lalal', 'a6a5d285bf13c8990bf312821c92c51a', '217.127.156.218', 'Mozilla/5.0 (X11; Linux i686; rv:12.0) Gecko/20100', 1392290547, 1393327145, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(31, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '46.188.52.204', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1;', 1392043193, 1392063893, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(33, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2.138.67.14', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392213119, 1392321815, NULL, NULL, 600, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(34, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '80.24.14.143', 'Mozilla/5.0 (Linux; U; Android 4.1.1; es-es; HUAWE', 1392234335, 1392242592, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(35, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '50.7.66.34', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392234756, 1392747629, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(36, NULL, 0, 16, 0, 1, 5, 5, 0, NULL, NULL, NULL, NULL, '50.7.78.50', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392234802, 1392748047, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(38, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '193.71.68.2', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1;', 1392361114, 1392361114, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(39, NULL, 0, 0, 0, 0, 0, 0, -3, NULL, NULL, NULL, NULL, '79.154.240.87', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392397743, 1393347606, NULL, NULL, 600, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(40, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '173.252.100.115', 'facebookexternalhit/1.1 (+http://www.facebook.com/', 1392406046, 1392406046, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(41, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '85.48.247.158', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392408283, 1392457012, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(42, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '88.22.144.245', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1392413086, 1392417399, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(43, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '85.57.24.51', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392417578, 1392417578, NULL, NULL, 3, 1, 0, NULL, '', 0, 1, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(44, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.8.123.122', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392575831, 1392575831, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(45, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '209.222.25.60', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392747580, 1392747697, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(46, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '31.6.45.213', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1;', 1392753716, 1392753716, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(47, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '187.210.186.201', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1392754110, 1392754539, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(48, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '199.116.169.254', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1;', 1392754110, 1392754157, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(49, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '85.55.193.146', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1392755285, 1392755360, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(50, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.203.97.239', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1392759540, 1392759558, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(51, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '212.183.206.12', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1392803124, 1392803127, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(52, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.105.142.108', 'Mozilla/5.0 (Windows NT 5.1; rv:27.0) Gecko/201001', 1392852166, 1392852193, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, ''),
(53, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '46.236.24.52', 'Mozilla/5.0 (compatible; TweetmemeBot/3.0; +http:/', 1392962140, 1392962140, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(54, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '83.24.112.5', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;', 1393015692, 1393016380, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(55, NULL, 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, '85.84.156.26', 'Mozilla/5.0 (Windows NT 5.1; rv:27.0) Gecko/201001', 1393088016, 1393088631, NULL, 'a:1:{i:1;i:1393088475;}', 2, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(56, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.159.71.190', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393134495, 1393134700, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(57, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.51.220.90', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393186537, 1393186579, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(58, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.199.202.105', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393186747, 1393186760, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(59, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.164.60.184', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393187226, 1393187244, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(60, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.125.191.189', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393188608, 1393188641, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(61, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.72.159.113', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393188641, 1393188641, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(62, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.47.151.22', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393188643, 1393188643, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(63, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.74.198.62', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393188662, 1393188662, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(64, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.135.169.60', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393189088, 1393189105, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(65, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.212.198.106', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393190008, 1393190019, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(66, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.86.217.69', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393190104, 1393190113, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(67, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.81.106.36', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393190942, 1393191009, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(68, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.167.120.54', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393191513, 1393191513, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(69, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.177.146.216', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393191654, 1393191679, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(70, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '179.37.168.80', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393193115, 1393193133, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(71, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.254.239.225', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393193874, 1393193881, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(72, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '187.144.223.212', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393193907, 1393193921, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(73, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.201.174.196', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393193917, 1393194143, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(74, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '79.118.112.234', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393194502, 1393194513, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(75, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '77.225.119.24', 'Mozilla/5.0 (Windows NT 5.1; rv:27.0) Gecko/201001', 1393194652, 1393194670, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(76, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.118.15.166', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393195469, 1393195477, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(77, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.66.157.122', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393199979, 1393200066, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(78, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.215.19.188', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393200801, 1393200997, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(79, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.228.78.194', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393200885, 1393200893, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(80, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '179.52.52.228', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393201848, 1393201862, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(81, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.251.7.178', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393202229, 1393202239, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(82, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '24.232.156.176', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2', 1393202307, 1393202307, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(83, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '71.68.198.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_1) App', 1393202433, 1393202437, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(84, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.139.192.51', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393202434, 1393202458, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(85, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.251.236.97', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393202902, 1393202909, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(86, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.160.18.45', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393203745, 1393203785, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(87, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '179.9.21.138', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393204675, 1393204719, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(88, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.176.125.93', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393204989, 1393204989, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(89, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.75.178.180', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko', 1393204993, 1393205132, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(90, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.166.14.204', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393205380, 1393205410, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(91, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.159.80.195', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393205424, 1393205433, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(92, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.234.120.163', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393205472, 1393205472, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(93, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '187.135.146.87', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393205684, 1393205704, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(94, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.225.172.68', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393205858, 1393205895, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(95, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.72.12.17', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393207077, 1393207109, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(96, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.120.132.155', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393207719, 1393207725, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(97, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '88.26.17.213', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393207796, 1393207815, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(98, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '89.145.95.42', 'Mozilla/5.0 (compatible; GrapeshotCrawler/2.0; +ht', 1393207931, 1393207931, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(99, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '187.148.173.183', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393208156, 1393208193, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(100, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.100.197.247', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393208255, 1393208296, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(101, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.10.3.136', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393208422, 1393208859, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(102, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.78.37.128', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393208776, 1393208882, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(103, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.166.113.49', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393210716, 1393210742, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(104, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.34.112.112', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393214339, 1393214346, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(105, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.64.202.187', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393215123, 1393215171, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(106, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.125.4.71', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393218481, 1393218606, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(107, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.173.200.150', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393221109, 1393221126, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(108, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.100.88.219', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393222083, 1393222134, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(109, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.58.28.85', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393257649, 1393257649, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(110, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '62.83.19.121', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.8 (KH', 1393264941, 1393264941, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(111, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.58.134.120', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393268493, 1393268493, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(112, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.173.218.26', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393270394, 1393270394, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(113, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.209.78.96', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393271071, 1393271071, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(114, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.160.161.137', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393271957, 1393271957, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(115, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.87.110.184', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393272548, 1393272548, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(116, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.172.139.11', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393273783, 1393273783, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(117, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.106.19.207', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393276175, 1393276175, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(118, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.87.217.10', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393276239, 1393276239, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(119, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.161.177.137', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393276587, 1393276587, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(120, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.157.6.49', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (K', 1393277229, 1393277229, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(121, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.114.208.25', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393279177, 1393279177, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(122, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.95.232.249', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393279192, 1393279192, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(123, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.67.17.219', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393280286, 1393280473, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(124, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '177.236.156.46', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393280406, 1393280406, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(125, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.158.213.99', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1393281663, 1393281663, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(126, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.122.137.48', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393282107, 1393282304, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(127, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '50.97.37.202', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393282184, 1393282184, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(128, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '54.81.11.253', 'Mozilla/5.0 (compatible; proximic; +http://www.pro', 1393282188, 1393282188, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(129, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.215.87.52', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393282519, 1393282519, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(130, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.18.138.237', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/201001', 1393282877, 1393282877, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(131, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '98.137.206.40', 'Mozilla/5.0 (YahooYSMcm/3.0.0; http://help.yahoo.c', 1393283120, 1393283120, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(132, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.208.160.123', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393284406, 1393284406, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(133, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '162.239.77.9', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393285046, 1393285046, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(134, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '181.16.23.159', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393287025, 1393287025, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(135, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.166.85.67', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1393287748, 1393287748, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(136, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.231.100.193', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393290460, 1393290460, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(137, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '200.93.121.45', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393292335, 1393292335, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(138, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.106.183.63', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393298830, 1393298830, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(139, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.176.134.85', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393302108, 1393302733, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(140, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '189.153.163.217', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1393305319, 1393305731, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(141, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '201.212.128.145', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1393327185, 1393327237, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(142, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '75.98.9.251', 'Mozilla/5.0 (compatible; NetSeer crawler/2.0; +htt', 1393327257, 1393327257, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(143, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.52.237.76', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1393335632, 1393335632, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(144, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '186.176.241.129', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393342752, 1393342752, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(145, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '187.34.139.94', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393344410, 1393344410, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(146, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '190.230.13.178', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393345702, 1393345702, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(147, NULL, 0, 1, 0, 0, 1, 1, 0, NULL, NULL, NULL, NULL, '186.0.212.146', 'Mozilla/5.0 (Windows NT 6.1; rv:27.0) Gecko/20100101 Firefox/27.0', 1393346338, 1393347938, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(148, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '79.153.100.204', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393346781, 1393346781, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(149, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '69.22.169.46', 'Mozilla/5.0 (Windows NT 6.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.117 Safari/537.36', 1393347052, 1393347052, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(150, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '62.75.254.51', 'ADmantX Platform Semantic Analyzer - ADmantX Inc. - www.admantx.com - support@admantx.com', 1393347102, 1393347102, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(151, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '0.0.0.0', NULL, 0, 0, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL),
(152, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '0.0.0.1', NULL, 0, 0, NULL, NULL, 3, 1, 0, NULL, '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_report`
--

CREATE TABLE IF NOT EXISTS `user_report` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `reported_by` bigint(7) NOT NULL,
  `reported_user` bigint(7) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `creation` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_report`
--

INSERT INTO `user_report` (`id`, `reported_by`, `reported_user`, `message`, `creation`) VALUES
(1, 1, 1, 'Toca mucho los huevos.', 1392657308),
(2, 1, 1213, '11212', 1392657449);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
