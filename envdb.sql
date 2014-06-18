-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2013 a las 19:20:47
-- Versión del servidor: 5.5.25
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `envdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulation`
--

CREATE TABLE `simulation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'awaiting',
  `user` int(11) NOT NULL,
  `added` int(11) NOT NULL,
  `started` int(11) DEFAULT NULL,
  `period` int(11) NOT NULL,
  `daysCount` int(11) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `simulation`
--

INSERT INTO `simulation` (`id`, `name`, `short_description`, `status`, `user`, `added`, `started`, `period`, `daysCount`, `active`) VALUES
(2, 'Ardilla', 'troll', 'launched', 1, 0, 1370259480, 172800, 2, 'y'),
(3, 'Panta al limÃ³n', '', 'launched', 9, 0, 1370342085, 345600, 0, ''),
(4, 'Test del color', 'ComprobaciÃ³n de como afecta el color a los ojos', 'launched', 9, 0, 1370353553, 864000, 10, ''),
(5, 'oiobiouboib', 'h jjb', 'launched', 9, 1370354523, 1370354523, 259200, 3, ''),
(6, 'jkiuiuv', 'jhvhvhvvjhvhj', 'launched', 9, 1370355800, 1370355800, 864000, 10, ''),
(7, 'uiubbobui', 'hhv', 'launched', 9, 1370355848, 1370355848, 864000, 10, ''),
(8, 'Pedorreta', 'Me cago en mi puta madre', 'launched', 1, 1370356070, 1370356070, 172800, 2, 'y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulation_click`
--

CREATE TABLE `simulation_click` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `simulation` int(11) NOT NULL,
  `conditions` int(11) unsigned NOT NULL,
  `day` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `simulation_click`
--

INSERT INTO `simulation_click` (`id`, `simulation`, `conditions`, `day`) VALUES
(1, 2, 1, 0),
(2, 2, 1, 0),
(3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulation_condition`
--

CREATE TABLE `simulation_condition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `vpc` decimal(10,2) NOT NULL,
  `limitUp` int(11) NOT NULL,
  `limitDown` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `simulation_condition`
--

INSERT INTO `simulation_condition` (`id`, `name`, `value`, `vpc`, `limitUp`, `limitDown`) VALUES
(1, 'Beber', 100.00, 10.00, 150, 80),
(2, '', 1000.00, 0.00, 9800, 10),
(3, 'ihihihih', 122.00, 0.00, 123, 10),
(4, 'rojo', 0.00, 0.00, 0, 0),
(5, 'rojo', 1001.00, 0.00, 11111, 90),
(6, 'azul', 1000.00, 0.00, 200, 900),
(7, 'Fokar', 100.00, 0.00, 120, 90),
(8, 'Correrme en las gafas del CEO de Bihoop', 9999.00, 10.00, 10000, 9998);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulation_condition_rel`
--

CREATE TABLE `simulation_condition_rel` (
  `simulation` int(11) unsigned NOT NULL,
  `conditions` int(11) NOT NULL,
  UNIQUE KEY `project` (`simulation`,`conditions`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `simulation_condition_rel`
--

INSERT INTO `simulation_condition_rel` (`simulation`, `conditions`) VALUES
(2, 1),
(6, 4),
(7, 5),
(7, 6),
(8, 7),
(8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `url`
--

CREATE TABLE `url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT '',
  `controller` varchar(64) DEFAULT '',
  `template` varchar(64) NOT NULL DEFAULT '',
  `language` int(11) DEFAULT '0',
  `queue` int(11) NOT NULL DEFAULT '0',
  `enabled` varchar(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Volcado de datos para la tabla `url`
--

INSERT INTO `url` (`id`, `url`, `controller`, `template`, `language`, `queue`, `enabled`) VALUES
(1, '/', 'landing', '', 0, 999, 'y'),
(2, '/404/', '404', '', 0, 999, 'y'),
(4, '/login/', 'login', '', 0, 0, 'y'),
(5, '/logout/', 'logout', '', 0, 0, 'y'),
(6, '/register/', 'register', '', 0, 0, 'y'),
(56, '/envpanel/([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?([a-zA-Z0-9-_]+)?[/]?', 'envpanel', '', 0, 0, 'y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` varchar(1) NOT NULL DEFAULT 'y',
  `level` varchar(8) NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `surname` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(16) NOT NULL DEFAULT '',
  `phone` varchar(16) DEFAULT '',
  `id_number` varchar(16) DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `timezone` varchar(32) NOT NULL DEFAULT '',
  `biography` text,
  `registered` int(11) DEFAULT NULL,
  `last_login` int(11) DEFAULT NULL,
  `last_activity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `active`, `level`, `email`, `password`, `name`, `surname`, `type`, `phone`, `id_number`, `avatar`, `address`, `city`, `timezone`, `biography`, `registered`, `last_login`, `last_activity`) VALUES
(1, 'y', 'admin', 'admin@admin.com', 'd108ab0281f6af687c9d4610a048f7ef4beca54c', 'Administrador', '', '', '', '', '', '', '', '', '', 0, 1370251281, 1370366024),
(9, 'y', 'user', 'alberto@abelabs.com', '1922009e1924404a59f88faface25dbff79afca0', 'Alberto', '', '', '', '', '', '', '', '', '', 1370353355, 1370366035, 1370366038);
