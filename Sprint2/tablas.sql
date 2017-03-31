CREATE TABLE `galeria` (
  `idgaleria` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(450) DEFAULT NULL,
  `detalle` varchar(4500) DEFAULT NULL,
  PRIMARY KEY (`idgaleria`)
) ;

CREATE TABLE `informacion` (
  `idinformacion` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) DEFAULT NULL,
  `contenido` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idinformacion`),
  UNIQUE KEY `detalle_UNIQUE` (`detalle`)
);


CREATE TABLE `seccion` (
  `idseccion` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idseccion`)
);

CREATE TABLE `noticias` (
  `idnoticias` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(450) DEFAULT NULL,
  `seccionfk` int(11) DEFAULT NULL,
  `link` varchar(450) DEFAULT NULL,
  `descripcion` varchar(4500) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `pathImagen` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`idnoticias`),
  KEY `seccionfknot_idx` (`seccionfk`),
  CONSTRAINT `seccionfknot` FOREIGN KEY (`seccionfk`) REFERENCES `seccion` (`idseccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ;