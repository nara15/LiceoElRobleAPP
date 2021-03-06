-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2017 a las 05:38:12
-- Versión del servidor: 5.5.54-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c9`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`josegarita`@`%` PROCEDURE `Contrasenia`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('usuario',sha1(pDetalle)) ON DUPLICATE KEY UPDATE  contenido = sha1(pDetalle);



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `crearServicios`(IN `pNombre` VARCHAR(100) CHARSET utf8, IN `pImagen` VARCHAR(450) CHARSET utf8, IN `pDetalle` VARCHAR(4500) CHARSET utf8, IN `pDetalle_imagen` VARCHAR(450) CHARSET utf8)
    NO SQL
IF EXISTS (SELECT 1 FROM `c9`.`servicios` WHERE `nombre`=pNombre) then
	BEGIN
		select 'Servicio ya creado, no se pudo agregar' as 'Mensaje';
	END;
ELSE
	BEGIN

	INSERT INTO `c9`.`servicios`
	(`nombre`,
	`imagen`,
	`detalle`,
	`detalle_imagen`)
	VALUES
	(pNombre,
	pImagen,
	pDetalle,
	pDetalle_imagen);
    

	select 'Servicio creado' as 'Mensaje';
	END;

END IF$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `eliminarNoticasTI`(IN `pNoticia` VARCHAR(100))
    NO SQL
DELETE FROM `c9`.`noticiasxseccion`
WHERE noticia = (select idnoticias from noticias where titulo = pNoticia)$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `eliminarSecciones`()
BEGIN

delete from seccion;

END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `Filosofia`(IN `pDetalle` VARCHAR(4500))
BEGIN

insert INTO `c9`.`informacion`
(`detalle`,`contenido`)
VALUES
('filosofia',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `Historia`(IN `pDetalle` VARCHAR(4500))
BEGIN

insert INTO `c9`.`informacion`
(`detalle`,`contenido`)
VALUES
('historia',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `insertarFotografia`(pDireccion varchar(450), pDetalle varchar(45))
BEGIN

INSERT INTO `centroelroble`.`galeria`
(
`direccion`,
`detalle`)
VALUES
(pDireccion,
pDetalle);



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `insertarGaleria`(pDireccion varchar(450), pDetalle varchar(45))
BEGIN

INSERT INTO `centroelroble`.`galeria`
(
`direccion`,
`detalle`)
VALUES
(pDireccion,
pDetalle);



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `insertarNoticias`(IN `pLink` VARCHAR(450), IN `pDescripcion` VARCHAR(4500), IN `pFecha` VARCHAR(450), IN `pPathImagen` VARCHAR(450), IN `pTitulo` VARCHAR(200))
    NO SQL
IF EXISTS (SELECT 1 FROM `c9`.`noticias` WHERE `titulo`=pTitulo) then
	BEGIN
		select 'Servicio ya creado' as 'Mensaje';
	END;
ELSE
	BEGIN

	INSERT INTO `c9`.`noticias`
	(`titulo`,
	`link`,
	`descripcion`,
	`fecha`,
	`pathImagen`)
		VALUES
	(pTitulo,
	pLink,
	pDescripcion,
	pFecha,
	pPathImagen);
  

	END;

END IF$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `insertarNoticiasXSeccion`(IN `pNoticia` VARCHAR(100), IN `pSeccion` VARCHAR(100))
    NO SQL
INSERT INTO c9.noticiasxseccion (noticia,seccion) values 
(
(select idnoticias from noticias where titulo = pNoticia),(
select idseccion from seccion where seccion = pSeccion)
)$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `insertarSeccion`(IN `pSeccion` VARCHAR(4500))
BEGIN

INSERT INTO `c9`.`seccion`
(
`seccion`)
VALUES
(
pSeccion);


END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `Mision`(IN `pDetalle` VARCHAR(4500))
BEGIN

insert INTO `c9`.`informacion`
(`detalle`,`contenido`)
VALUES
('mision',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `Usuario`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('usuario',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END$$

CREATE DEFINER=`josegarita`@`%` PROCEDURE `Vision`(IN `pDetalle` VARCHAR(4500))
BEGIN

insert INTO `c9`.`informacion`
(`detalle`,`contenido`)
VALUES
('vision',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE IF NOT EXISTS `galeria` (
  `idgaleria` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(450) DEFAULT NULL,
  `detalle` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`idgaleria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`idgaleria`, `direccion`, `detalle`) VALUES
(1, '../Images/gallery/Jellyfish.jpg', 'Una medusa'),
(2, '../Images/gallery/Koala.jpg', 'Un koala australiano, tomando una rama de eucalipto'),
(3, '../Images/gallery/Tulips.jpg', 'Unos tulipanes; foto tomanda en los PaÃ­ses Bajos'),
(4, '../Images/gallery/Chrysanthemum.jpg', 'Un hermoso faro en las costas de Finlandia'),
(5, '../Images/gallery/Lighthouse.jpg', 'Una flor cualquiera'),
(6, '../Images/gallery/megaRaichu.jpg', 'Un mega Raichu'),
(7, '../Images/gallery/lago-bonito.jpg', 'Un lago '),
(8, 'unbirthday.jpg', ''),
(9, 'fuego.jpg', ''),
(10, '../Images/gallery/luna.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion`
--

CREATE TABLE IF NOT EXISTS `informacion` (
  `idinformacion` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) DEFAULT NULL,
  `contenido` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`idinformacion`),
  UNIQUE KEY `detalle_UNIQUE` (`detalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `informacion`
--

INSERT INTO `informacion` (`idinformacion`, `detalle`, `contenido`) VALUES
(1, 'mision', 'mision'),
(2, 'vision', 'vision'),
(3, 'historia', 'El Consejo de Docentes del Liceo El Roble acuerda presentar ante las autoridades educativas superiores, padres, madres de familia y alumnos, el presente documento que comprende la Normativa Interna de la institución, como lo solicita el Reglamento de Evaluación de los Aprendizajes. Este documento establece las funciones que le compete al director, los administrativos, docentes administrativos, docentes, padres de familia y estudiantes. Regulará los derechos y obligaciones de todos los que componen la comunidad educativa. Dicho documento será una guía de consulta obligatoria, tanto para alumnos regulares, como para todos aquellos que en un futuro deseen ingresar a esta institución. En este documento se norman todos aquellos aspectos que enmarcan y caracterizan a los estudiantes que cursan los estudios de Primero, Segundo y Tercer Ciclo de la Educación General Básica, Educación Diversificada y Plan Nacional de III y IV Ciclo Diversificado Vocacional..'),
(4, 'filosofia', 'Este Liceo toma como base la filosofía democrática de la educación, en la cual la  labor que se realiza está fundamentada en el trabajo cooperativo, donde el docente,  los alumnos, padres de familia y comunidad en general tengan plena conciencia de  los beneficios que trae consigo el trabajo conjunto. Todo lo anterior dentro de un  ambiente de sanas y nobles relaciones humanas. De ahí se desprenden los  derechos y deberes, el respeto a la personalidad y la satisfacción de necesidades  que contribuya a ese ambiente social y ejemplar donde los estudiantes puedan  crecer, superarse y desarrollarse integralmente de acuerdo con los lineamientos  propuestos por el Ministerio de Educación Pública.(M.E.P.).');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idnoticias` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) DEFAULT NULL,
  `link` varchar(450) DEFAULT NULL,
  `descripcion` varchar(4500) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `pathImagen` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idnoticias`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticias`, `titulo`, `link`, `descripcion`, `fecha`, `pathImagen`) VALUES
(3, 'titulo', 'link', 'descripcion', '12-15-18', 'DetalleImagen'),
(4, 'titulo2', 'link', 'descripcion', '12-15-18', 'DetalleImagen'),
(5, 'titulo33', 'link', 'descripcion', '12-15-18', 'DetalleImagen'),
(6, 'tituldxcvo', 'link', 'descripcion', '12-15-18', 'DetalleImagen'),
(7, 'titufgslo', 'link', 'descripcion', '12-15-18', 'DetalleImagen'),
(17, 'Jose', ' www.google.com', '<p>Time: Mon Mar 27 2017 23:28:05 GMT-0600 (Central Standard Time)</p>', '2017-03-27', 'No hay'),
(21, 'Jose22', ' www.google.com', '<p>Time: Mon Mar 27 2017 23:33:11 GMT-0600 (Central Standard Time)</p>', '2017-03-27', 'No hay'),
(23, 'Noticias para setimos', ' www.google.com', '<p>Time: Tue Mar 28 2017 10:49:57 GMT-0600 (Central Standard Time)</p>', '2017-03-28', 'No hay'),
(24, 'Nueva nueva noticia', ' www.google.com', '<p>Time: Wed Mar 29 2017 19:41:07 GMT-0600 (Central Standard Time)</p>', '2017-03-29', 'No hay'),
(26, 'Nueva Noticia agregadasdfsdfasdf', ' www.facebook.com', '<p>Time: Wed Mar 29 2017 19:54:35 GMT-0600 (Central Standard Time)</p>', '2017-03-29', 'No hay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticiasxseccion`
--

CREATE TABLE IF NOT EXISTS `noticiasxseccion` (
  `idnoticiasxSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `noticia` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  PRIMARY KEY (`idnoticiasxSeccion`),
  KEY `fkNoticia_idx` (`noticia`),
  KEY `fkseccion_idx` (`seccion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `noticiasxseccion`
--

INSERT INTO `noticiasxseccion` (`idnoticiasxSeccion`, `noticia`, `seccion`) VALUES
(1, 3, 1),
(5, 17, 1),
(6, 17, 13),
(7, 23, 1),
(8, 23, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `idseccion` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idseccion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`idseccion`, `seccion`) VALUES
(1, '7-1'),
(13, ' 10-5'),
(15, ' 10-3'),
(16, ' 7-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `idservicios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(4500) NOT NULL,
  `detalle` varchar(4500) DEFAULT NULL,
  `detalle_imagen` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idservicios`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idservicios`, `nombre`, `imagen`, `detalle`, `detalle_imagen`) VALUES
(2, 'Biblioteca', 'Nueva Imagen', 'Detalle', 'Detalle imagen'),
(3, ' Soda', 'No hay', '<p>Time: Wed <em>Mar</em> 29 <span style="text-decoration: underline;">2017</span> 19:56:26 GMT-0600 (<strong>Central</strong> Standard Time)</p>', 'No hay mÃ¡s detalles'),
(4, ' GuÃ­a educativas en el bosque', '[object File]', '<p>Gu', 'No hay mÃ¡s detalles');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticiasxseccion`
--
ALTER TABLE `noticiasxseccion`
  ADD CONSTRAINT `fkNoticia` FOREIGN KEY (`noticia`) REFERENCES `noticias` (`idnoticias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkseccion` FOREIGN KEY (`seccion`) REFERENCES `seccion` (`idseccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
