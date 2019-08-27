-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-08-2019 a las 20:19:13
-- Versión del servidor: 5.6.39-83.1
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softengi_daniel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adm_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adm_pass` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adm_fa` date NOT NULL,
  `adm_rol` int(11) NOT NULL,
  `adm_est` int(11) NOT NULL,
  `adm_token` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `adm_foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`adm_id`),
  KEY `adm_rol` (`adm_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`adm_id`, `adm_nom`, `adm_email`, `adm_pass`, `adm_fa`, `adm_rol`, `adm_est`, `adm_token`, `adm_foto`) VALUES
(1, 'Daniel Parra', 'hidan.parra@gmail.com', '123456', '2019-07-09', 1, 1, '5d48f35b431', ''),
(2, 'Chalino Valentin 66', 'chalino66@prueba.com', '123456', '2019-07-09', 2, 2, '0', ''),
(3, 'Oliver Carrasco', 'xw_1745@hotmail.com', '123456', '2019-07-03', 1, 1, '5d3fc7781fd', ''),
(6, 'Morgan Gato', 'morgan@prueba.com', '123456', '2019-07-21', 2, 1, '0', ''),
(12, 'OVO', 'ovo@prueba.com', '123456', '2019-07-28', 2, 2, '0', ''),
(18, 'Abraham Pech', 'abraham_16_69@hotmail.com', '123456', '2019-07-30', 2, 1, '5d49988665c', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avance`
--

CREATE TABLE IF NOT EXISTS `avance` (
  `av_id` int(11) NOT NULL AUTO_INCREMENT,
  `av_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`av_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `avance`
--

INSERT INTO `avance` (`av_id`, `av_nom`) VALUES
(1, 'Firmado por Sistemas'),
(2, 'Firmado por Sistemas y Colaborador'),
(3, 'Firmas completas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cat_tip` int(11) NOT NULL,
  `cat_fa` date NOT NULL,
  PRIMARY KEY (`cat_id`),
  KEY `cat_tip` (`cat_tip`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`cat_id`, `cat_nom`, `cat_tip`, `cat_fa`) VALUES
(1, 'Salario', 1, '2019-07-12'),
(2, 'Freelance', 1, '2019-07-15'),
(3, 'Comidas', 2, '2019-07-10'),
(4, 'Fijos', 2, '2019-07-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cli_sw` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `cli_tel` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cli_pa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cli_reg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cli_fa` date NOT NULL,
  PRIMARY KEY (`cli_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `cli_nom`, `cli_sw`, `cli_tel`, `cli_pa`, `cli_reg`, `cli_fa`) VALUES
(1, 'Julian Casablancas', 'www.julianc.com', '9981132435', 'Mexico', 'Chiapas', '2019-08-15'),
(2, 'Margarita Perez', 'www.margaritas.com', '9982345678', 'Mexico', 'Queretaro', '2019-08-13'),
(3, 'Francisco Lopez', 'www.flopez.com', '9981234567', 'Mexico', 'Chihuahua', '2019-08-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `dpto_id` int(11) NOT NULL AUTO_INCREMENT,
  `dpto_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dpto_fa` date NOT NULL,
  PRIMARY KEY (`dpto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`dpto_id`, `dpto_nom`, `dpto_fa`) VALUES
(1, 'Sistemas', '2019-07-02'),
(2, 'Compras', '2019-07-09'),
(3, 'Ventas', '2019-07-07'),
(4, 'Contabilidad', '2019-07-09'),
(5, 'Mantenimiento', '2019-07-03'),
(6, 'Animación', '2019-07-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `epo_id` int(11) NOT NULL AUTO_INCREMENT,
  `epo_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `epo_sn` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `epo_fa` date NOT NULL,
  `epo_tip` int(11) NOT NULL,
  PRIMARY KEY (`epo_id`),
  KEY `epo_tip` (`epo_tip`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`epo_id`, `epo_nom`, `epo_sn`, `epo_fa`, `epo_tip`) VALUES
(1, 'HP ProBook 440 G5', '123456789', '2019-07-03', 2),
(2, 'HP ProBook 440 G3', '987654321', '2019-07-08', 3),
(3, 'BRIX GB-BACE 3150', '023456780', '2019-07-02', 4),
(7, 'SERVER HP', '00238145', '2019-07-19', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `est_fa` date NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`est_id`, `est_nom`, `est_fa`) VALUES
(1, 'Tiempo Vacio', '2019-08-16'),
(2, 'Tiempo Inicio', '2019-08-16'),
(3, 'Tiempo Final', '2019-08-16'),
(4, 'Tiempo Total', '2019-08-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
  `proy_id` int(11) NOT NULL AUTO_INCREMENT,
  `proy_cli` int(11) NOT NULL,
  `proy_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `proy_bh` int(11) NOT NULL,
  `proy_fa` date NOT NULL,
  `proy_fp` date NOT NULL,
  PRIMARY KEY (`proy_id`),
  KEY `proy_cli` (`proy_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`proy_id`, `proy_cli`, `proy_nom`, `proy_bh`, `proy_fa`, `proy_fp`) VALUES
(1, 1, 'Proyecto 1', 350, '2019-08-13', '2019-08-14'),
(2, 2, 'Proyectopolis', 34, '2019-08-02', '2019-08-03'),
(3, 1, 'Proyecto 21', 450, '2019-08-11', '2019-07-31'),
(4, 3, 'Hola Mundo', 15, '2019-08-17', '2019-08-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsivas`
--

CREATE TABLE IF NOT EXISTS `responsivas` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_fa` date NOT NULL,
  `res_per` int(11) NOT NULL,
  `res_dpto` int(11) NOT NULL,
  `res_epo` int(11) NOT NULL,
  `res_adm` int(11) NOT NULL,
  `res_av` int(11) NOT NULL,
  PRIMARY KEY (`res_id`),
  KEY `res_per` (`res_per`),
  KEY `res_dpto` (`res_dpto`),
  KEY `res_epo` (`res_epo`),
  KEY `res_adm` (`res_adm`),
  KEY `res_av` (`res_av`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `responsivas`
--

INSERT INTO `responsivas` (`res_id`, `res_fa`, `res_per`, `res_dpto`, `res_epo`, `res_adm`, `res_av`) VALUES
(1, '2019-07-10', 1, 2, 1, 1, 1),
(2, '2019-07-03', 2, 3, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rol_fa` date NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nom`, `rol_fa`) VALUES
(1, 'Administrador', '2019-07-10'),
(2, 'Usuario', '2019-07-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_cli` int(11) NOT NULL,
  `tar_pro` int(11) NOT NULL,
  `tar_des` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tar_ti` datetime NOT NULL,
  `tar_tf` datetime NOT NULL,
  `tar_tt` time NOT NULL,
  `tar_pago` int(11) NOT NULL,
  `tar_fa` date NOT NULL,
  `tar_est` int(11) NOT NULL,
  PRIMARY KEY (`tar_id`),
  KEY `tar_cli` (`tar_cli`),
  KEY `tar_pro` (`tar_pro`),
  KEY `tar_est` (`tar_est`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`tar_id`, `tar_cli`, `tar_pro`, `tar_des`, `tar_ti`, `tar_tf`, `tar_tt`, `tar_pago`, `tar_fa`, `tar_est`) VALUES
(1, 1, 3, 'Chido', '2019-08-17 22:18:24', '2019-08-18 00:37:07', '02:14:09', 900, '2019-08-14', 3),
(2, 2, 2, 'Yiiii', '2019-08-16 09:29:32', '2019-08-18 00:36:57', '04:11:05', 136, '2019-08-06', 3),
(62, 3, 3, 'prueba', '2019-08-24 08:05:37', '2019-08-24 08:06:11', '00:00:34', 450, '2019-08-24', 3),
(64, 2, 4, 'fg', '2019-08-24 08:18:22', '2019-08-24 08:18:39', '04:00:17', 60, '2019-08-24', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tip_fa` date NOT NULL,
  PRIMARY KEY (`tip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`tip_id`, `tip_nom`, `tip_fa`) VALUES
(1, 'Ingresos', '2019-07-05'),
(2, 'Gastos', '2019-07-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `tip_id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nom` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tip_fa` date NOT NULL,
  PRIMARY KEY (`tip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`tip_id`, `tip_nom`, `tip_fa`) VALUES
(1, 'Laptop', '2019-07-09'),
(2, 'PC', '2019-07-04'),
(3, 'Tableta', '2019-07-10'),
(4, 'Componente', '2019-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE IF NOT EXISTS `transacciones` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_tip` int(11) NOT NULL,
  `tra_cat` int(11) NOT NULL,
  `tra_nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tra_cant` int(11) NOT NULL,
  `tra_fa` date NOT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `tra_tip` (`tra_tip`),
  KEY `tra_cat` (`tra_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`tra_id`, `tra_tip`, `tra_cat`, `tra_nom`, `tra_cant`, `tra_fa`) VALUES
(2, 2, 3, 'Pago UT', 52, '2019-07-02'),
(3, 1, 1, 'Pago Oficina ', 70, '2019-07-03'),
(6, 1, 1, 'Pago UNID', 10, '2019-07-09'),
(7, 2, 3, 'Cena', 1, '2019-07-10'),
(8, 2, 4, 'Gasolina', 3, '2019-07-09'),
(9, 2, 4, 'Agua', 5, '2019-07-09'),
(10, 2, 4, 'Luz', 2, '2019-07-09'),
(14, 2, 3, 'Desayuno', 2, '2019-07-28'),
(16, 1, 2, 'Coffe Cake', 80, '2019-08-06'),
(18, 2, 3, 'tamal', 34, '2019-08-08');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_ibfk_1` FOREIGN KEY (`adm_rol`) REFERENCES `roles` (`rol_id`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`cat_tip`) REFERENCES `tipo` (`tip_id`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`epo_tip`) REFERENCES `tipos` (`tip_id`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`proy_cli`) REFERENCES `clientes` (`cli_id`);

--
-- Filtros para la tabla `responsivas`
--
ALTER TABLE `responsivas`
  ADD CONSTRAINT `responsivas_ibfk_1` FOREIGN KEY (`res_adm`) REFERENCES `administradores` (`adm_id`),
  ADD CONSTRAINT `responsivas_ibfk_2` FOREIGN KEY (`res_per`) REFERENCES `persona` (`per_id`),
  ADD CONSTRAINT `responsivas_ibfk_3` FOREIGN KEY (`res_dpto`) REFERENCES `departamentos` (`dpto_id`),
  ADD CONSTRAINT `responsivas_ibfk_4` FOREIGN KEY (`res_epo`) REFERENCES `equipos` (`epo_id`),
  ADD CONSTRAINT `responsivas_ibfk_5` FOREIGN KEY (`res_av`) REFERENCES `avance` (`av_id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`tar_pro`) REFERENCES `proyectos` (`proy_id`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`tar_cli`) REFERENCES `clientes` (`cli_id`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`tra_cat`) REFERENCES `categorias` (`cat_id`),
  ADD CONSTRAINT `transacciones_ibfk_2` FOREIGN KEY (`tra_tip`) REFERENCES `tipo` (`tip_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
