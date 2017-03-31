-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: centroelroble
-- ------------------------------------------------------
-- Server version	5.7.13-log


-- Dumping events for database 'centroelroble'
--

--
-- Dumping routines for database 'centroelroble'
--

DELIMITER ;;
CREATE  PROCEDURE `Contrasenia`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('usuario',sha1(pDetalle)) ON DUPLICATE KEY UPDATE  contenido = sha1(pDetalle);



END ;;

CREATE  PROCEDURE `eliminarSecciones`()
BEGIN

delete from seccion;

END ;;

CREATE  PROCEDURE `Filosofia`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('filosofia',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END ;;
CREATE  PROCEDURE `Historia`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('historia',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END ;;
CREATE  PROCEDURE `insertarFotografia`(pDireccion varchar(450), pDetalle varchar(45))
BEGIN

INSERT INTO `centroelroble`.`galeria`
(
`direccion`,
`detalle`)
VALUES
(pDireccion,
pDetalle);



END ;;

CREATE  PROCEDURE `insertarGaleria`(pDireccion varchar(450), pDetalle varchar(45))
BEGIN

INSERT INTO `centroelroble`.`galeria`
(
`direccion`,
`detalle`)
VALUES
(pDireccion,
pDetalle);



END ;;


CREATE  PROCEDURE `insertarNoticias`(pTitulo varchar(450),
pSeccion varchar(450),
pLink varchar(450),
pDescripcion varchar(4500),
pFecha varchar(450),
pPathImagen varchar(450))
BEGIN


INSERT INTO `centroelroble`.`noticias`
(`titulo`,
`seccionfk`,
`link`,
`descripcion`,
`fecha`,
`pathImagen`)
VALUES
(pTitulo,
( 
SELECT `seccion`.`idseccion`
FROM `centroelroble`.`seccion` where seccion = pSeccion),
pLink,
pDescripcion,
pFecha,
pPathImagen);



END ;;


CREATE PROCEDURE `insertarSeccion`(pSeccion varchar(4500))
BEGIN

INSERT INTO `centroelroble`.`seccion`
(
`seccion`)
VALUES
(
pSeccion);


END ;;


CREATE  PROCEDURE `Mision`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('mision',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END ;;


CREATE  PROCEDURE `Usuario`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('usuario',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END ;;
CREATE  PROCEDURE `Vision`(pDetalle varchar(4500))
BEGIN

insert INTO `centroelroble`.`informacion`
(`detalle`,`contenido`)
VALUES
('vision',pDetalle) ON DUPLICATE KEY UPDATE  contenido = pDetalle;



END ;;
-- Dump completed on 2017-03-06 21:13:45
