-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-02-2014 a las 19:14:04
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
  `ip` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint(7) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `cat` varchar(5) NOT NULL DEFAULT 'games',
  `url` text,
  `thumb` text,
  `points` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `cat`, `url`, `thumb`, `points`, `downloads`) VALUES
(1, 'GMOD 11', 'Descarga GMOD 11 Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOZ4Lw7hrq7c0xPJ5XtlsKgy+4i5lVZEzhpSEAhtig2Af9/AjxTbTJqnHsKlV0R+rCHFuWsV9wQgY8Cd/y4eH4ZdD29TFAq25BY0gqMeoGDV8vQzL/uG5p9gKq8R+GlKiNwj99Bv3f3MyXmcq7oXHjSp3aPdrXPDhObDvYlqYU0gMcHf4ZycGp6WI6PUyFJ/AvMjw7lHSW3kIv5Q3jc0L4flxYSY/pWZIdB6THFctolnMLDI7+ZWGsKWGHLOl6XuyX/xZJilQ6wr8bx/5xdnYi0B+GqQG00WKIsl3T657jhkqL8ChhRNOwQG3SX+n3PzORrqNlfwQimkvNhVI5S/8A6zXNlOXpEA3jz2bzeR8a5O9ZTl8ReE4+4MlBAFiMyKYYA8lCR6GhR5JFY5lbTbQKChLeXtJrCsMV8WyBfpv2JbvQ423ujNamIlZIn10DflyjNsDqpXG5pvYUx+oLWnIHyCyHxppnIy3/UI8ohV/1lE1Dwurr9BXdHn5UocfAgbEMCJXc48x05/tSB9kICZv9RaNQb2rl/0ql7MrYceqUX69JKXa+7JPqifmZN1QQBAVd67H2loye6XOTTYOBOohFrDAVNQVdU3ei31zGmS0u6H2E0mlII2B14poUHhM/40NNFKplIUK+lHHJCCoj7FxwUEUVsmsEJL0v58tDIME1OAkfODlp0E32E1pv6RPePkIQUYQBRxoANIebPA0bU+lJVY=', 'http://tinyurl.com/o3odc5r', 15, 0),
(2, 'GTA IV', 'Descarga GTA IV Gratis', 'games', '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', 'http://tinyurl.com/q5k75xd', 35, 0),
(3, 'FlatOut 2', 'Descarga FlatOut 2 Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOWTs9BO63L53Hvnr/mBbNOY3y1qsO2DQaOEK38bfCeJLkYFpWveDXfOxDCRyxnzCV0JBruxEfNPw+f8D7Ip7odSxq+u725rri921swjqVWXAi5YSUG3QOzyY5in9x7MgsQWLF37W5Lol+rZCzAgpVOtCG4CjvrPuKHhC0A9MeKYtllzvNN2LQ230OF8SZFh2wfmsvIbNAlxhwU+G0PSTFzaw+MOO2qw+NAP6qHaJx9AjBAXvfA9xXMxPoQRyjJQRoK/xFWU5X6tQoXIVjKZiWmiNfNSGjtnV4m3cwL/AMtCz5bpHKrv+faterY4FcmPfQZADHqly1gI4t1oRObi5YipxUIRDIHGlW0OvM6HzAtFwyttvuqT30gIaOy9Z3+EbufqB7Kp5If5R3SqHSbq0ljbYXitKzYVMBpblvKDP5Q6QeWE9QvKj3vaTQi4s9qUE3NrXM7kp+H1uuM0SmqULTmfrLv6h+96TFT03SjqGARiuIewMh7iiBBzzupLK4xcDBX74VgN3La0jy+mCyQjWGVn0xN8TXjkEYdUcSUdbw0L9H8D5YeHL4FUK97pO0YhkzYwKrsg7+1UcPcZI1LaYOdobqsVOcq/l40tLcQvJGZuIMUMET41oUtgXX52bH0aU8AXyhjzsIUQ04yBf0ewbHNhuUA2vvcpsOswv17K8gy6M6Ohbgw4gCerDAF5/1fPa7sJfOTwQAp5wFImYyt9FlacehwbvA1zMxS1XGFJJHFYy/KeS2Ymw22ScIplvIbz/JzUST7kHKqC7vuQNmz6vWVAQKN0VHuDX5l0anyNlhVY9z7fRwxzMB4dqbSwVz0LKljEbWIOntcsJT0bI3wHVrOI4X78YTPZMVcqK1j12GN0Femu++4cz1sDxJJD+MVAegg==', 'http://tinyurl.com/npwbgq7', 10, 0),
(4, 'Killing Floor', 'Descarga Killing Floor Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bORiIS6cUzonbB9/KvfB2P+PMQg8ypkK9ULgTvMeBIh5D8LJAiDVrdo6f0wqha4Zl99d2Ydn2qYB0vvUq/fTBAtPM3yX3dK8ctIC6uOEzJClpyQXxBIHM/XFElnU53V8JIQP0kwCu79VtuD6ifa83c/Oh8p8Yh1D+1VRkn8yhP+exbS9mvwTKY8pYhv0LliXV0mieGxGiD0pWJZYaVfnyW4QD0LE+040QeuFxnzPqPx0fbxvhXMeZtyQ8HCv6FUcT9D8/dG40uB9diNIFNvJXYHuTSNP7nh+5ESEYBaSmCOS56pa/q4WB/CR3LDeAiDvigUgbzpFBw681dYlIxigl+Mhe0WAtPgtItjjhbyvGhJLxvXPPzDrJvrfUsEJE50uH9QH0B+mW6fypAQvrxcfjKwzz/4Cum40j02RgcYwc5ajyLaOtgRM7FNsbeO3bmbEYi59V+/Z02WoQTrfWzF/yCTTtEE8IaGYZ0hUA22+ZQ9faRQDtQuwrcTsCh/jg5Mt0/mXL9hO+W7BPf9f/qrXutlo8M7LwxJWkvCCpaPvO1t6dOigscP6YTqB8TlXLDXTh6iFIMBvwZ0d0XYvDofo79MDNbHbdUj7kbpLItvE4solV2U28p/BfMFW6rvm60mmdMIbYFO6bIVCc66hBdamzY1P2JHj7Bl60uGzIX5C8cMQGD7p1B+fmFsC3PtPiAX5TPKIzEPk8nED82/ShpmYL291tgV5XRvnxCOI2VaAKuYR2y77dtIVlp/czfC7aji66yPfVpW96aQxZU3TMM6f3XMNNNR+gpwxb3GMcgwWws3EaHd83W+jJ+EovQCtBvOWAwRrWLyAQL0+tjQozgeu6gISsj4tPFqpnTLUh9u+4zl/HH7gjhzIvImBvoif73FTuc9zvbGio2jUd6awLdC112fm0elpQhGS7fRqp6D8oBLE6s5mVu6/d9/hTAAvnCsIjzXagZRpE6Sxm1JL334YHDfTFBjnWnULwzIu5MhlKHHYDU+KPIGpkfsThKVlSA4cT5CaXFRYs6hMq0f82YeHzQOCMME1XRUDX84xaxkDCjzQ6CD0Fn4GC8xvydD0gM0OHIDbUjirxpkp3qnsSB4dXN+OVjJzbLNar37Ox6xgtPw9vqDN0Kpj+2cmpb3mW5He4YrIK4rqnF7jjImSai5Ou0DZm0czjNA8LDiqeIKydoTYeSs5UxIk976y5Tzr39MVXhRpuPsF7xgHVdXVm7m+QOIk=', 'http://tinyurl.com/nw3cnql', 20, 0),
(5, 'GTA San Andreas', 'Descarga GTA SA Gratis', 'games', 'rx5GFbIvZGJVEYNHIg9bOd+n4PtDCvyTi0138FMS9T9LXEoVN6ovlO16dXvoH58etIlLt5N+4um7nxhB4wnmPfs4W2k6ohnpe0yRTeDTgtoENYQrdXPAwAyVbB0CoaOd9LjoViuYUalyoU0YUuuxSj2cC5qbwqQfrBpV4tK7xNA=', 'http://tinyurl.com/o9cqg8d', 20, 1),
(6, 'Call Of Duty 4', 'Descarga COD4 Gratis', 'games', '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', 'http://tinyurl.com/ptb5s9y', 25, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refer_id` int(25) NOT NULL DEFAULT '0',
  `points` bigint(20) NOT NULL DEFAULT '0',
  `money` bigint(20) NOT NULL DEFAULT '0',
  `lvl` int(11) NOT NULL DEFAULT '0',
  `exp` bigint(20) NOT NULL DEFAULT '0',
  `acc_type` varchar(4) NOT NULL DEFAULT 'free',
  `password` text,
  `email` text,
  `activation` longtext,
  `ip_address` varchar(30) DEFAULT NULL,
  `user_agent` varchar(50) DEFAULT NULL,
  `datetime` int(11) NOT NULL DEFAULT '0',
  `lastconn` int(11) NOT NULL DEFAULT '0',
  `visitarray` longtext,
  `remainingvisits` int(11) NOT NULL DEFAULT '3',
  `multiplier` int(11) NOT NULL DEFAULT '1',
  `discount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `refer_id`, `points`, `money`, `lvl`, `exp`, `acc_type`, `password`, `email`, `activation`, `ip_address`, `user_agent`, `datetime`, `lastconn`, `visitarray`, `remainingvisits`, `multiplier`, `discount`) VALUES
(1, 0, 912332433, 0, 998, 8500000000, 'free', '3d0771e2546a1c422fe1b33fc25da81c', NULL, 'c3cd68d5ff9ba0c156fa3ba3bebcdbb3', '81.38.88.61', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391176225, 1391908364, 'a:1:{i:3;i:1391296975;}', 9, 199, 0),
(2, 0, 183, 0, 0, 0, 'free', '4d186321c1a7f0f354b297e8914ab240', 'cacamax', '0', '186.14.234.161', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391184813, 1391184813, NULL, 3, 1, 0),
(3, 0, 39, 0, 3, 23, 'free', NULL, NULL, '0', '201.212.232.188', 'Mozilla/5.0 (Windows NT 5.1; rv:26.0) Gecko/201001', 1391184834, 1391184834, NULL, 3, 1, 0),
(4, 0, 94, 0, 3, 22, 'free', NULL, NULL, '0', '79.144.28.40', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391205156, 1391205156, NULL, 3, 7, 0),
(5, 0, 127, 0, 4, 26, 'free', NULL, NULL, '0', '85.51.29.68', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391205190, 1391623349, NULL, 3, 1, 0),
(6, 0, 10, 0, 1, 6, 'free', NULL, NULL, '0', '188.78.21.85', 'Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388', 1391205217, 1391205217, NULL, 3, 3, 0),
(7, 0, 3, 0, 1, 4, 'free', NULL, NULL, '0', '87.111.9.138', 'Mozilla/5.0 (Linux; Android 4.1.2; C5303 Build/12.', 1391205301, 1391205301, NULL, 3, 2, 0),
(8, 0, 4, 0, 1, 5, 'free', NULL, NULL, '0', '79.148.220.54', 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/201001', 1391212734, 1391212734, NULL, 3, 3, 0),
(9, 0, 2, 0, 1, 4, 'free', NULL, NULL, '0', '66.249.93.199', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391218761, 1391303644, 'a:1:{i:3;i:1391303644;}', 5, 1, 0),
(10, 0, 0, 0, 0, 0, 'free', NULL, NULL, '0', '83.100.189.111', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391289646, 1391289646, NULL, 3, 1, 0),
(11, 3, 0, 0, 0, 0, 'free', NULL, NULL, '0', '50.7.54.18', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391303733, 1391303733, NULL, 3, 1, 0),
(12, 0, 0, 0, 0, 0, 'free', NULL, NULL, '0', '213.97.79.52', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391304494, 1391304494, NULL, 3, 1, 0),
(13, 0, 0, 0, 0, 0, 'free', NULL, NULL, NULL, '81.202.232.205', 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:26.0) Gecko', 1391355238, 1391803145, NULL, 3, 1, 0),
(14, 0, 0, 0, 0, 0, 'free', NULL, NULL, NULL, '88.191.192.25', 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/201001', 1391366715, 1391366715, NULL, 3, 1, 0),
(15, 0, 0, 0, 0, 0, 'free', NULL, NULL, NULL, '79.158.211.46', 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/201001', 1391368576, 1391368576, NULL, 3, 1, 0),
(16, 0, 0, 0, 0, 0, 'free', NULL, NULL, NULL, '217.12.20.253', 'Mozilla/5.0 (X11; Linux i686; rv:12.0) Gecko/20100', 1391684143, 1391684143, NULL, 3, 1, 0),
(17, 0, 0, 0, 0, 0, 'free', NULL, NULL, NULL, '88.16.192.208', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1391704633, 1391704633, NULL, 3, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
