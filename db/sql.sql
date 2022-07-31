/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.22-MariaDB : Database - cs_laboratorio
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cs_laboratorio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `cs_laboratorio`;

/*Table structure for table `analisis` */

DROP TABLE IF EXISTS `analisis`;

CREATE TABLE `analisis` (
  `analisis_id` int(11) NOT NULL AUTO_INCREMENT,
  `analisis_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `analisis_fregistro` date DEFAULT NULL,
  `analisis_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`analisis_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `analisis` */

insert  into `analisis`(`analisis_id`,`analisis_nombre`,`analisis_fregistro`,`analisis_estatus`) values (4,'Analisis de SANGRE','2022-06-19','INACTIVO'),(6,'BIOQUIMICA','2022-06-19','ACTIVO'),(7,'HEMATOLOGIA','2022-06-19','ACTIVO');

/*Table structure for table `especialidad` */

DROP TABLE IF EXISTS `especialidad`;

CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidad_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `especialidad_fregistro` date DEFAULT NULL,
  `especialidad_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`especialidad_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `especialidad` */

insert  into `especialidad`(`especialidad_id`,`especialidad_nombre`,`especialidad_fregistro`,`especialidad_estatus`) values (2,'MEDICO GENERAL','2022-07-12','ACTIVO'),(3,'MEDICO INTERNISTA','2022-07-13','INACTIVO'),(4,'OPTOMETRIA Y OTROS','2022-07-16','ACTIVO');

/*Table structure for table `examen` */

DROP TABLE IF EXISTS `examen`;

CREATE TABLE `examen` (
  `examen_id` int(11) NOT NULL AUTO_INCREMENT,
  `examen_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `examen_fregistro` date DEFAULT NULL,
  `analisis_id` int(11) DEFAULT NULL,
  `examen_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`examen_id`) USING BTREE,
  KEY `analisis_id` (`analisis_id`) USING BTREE,
  CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`analisis_id`) REFERENCES `analisis` (`analisis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `examen` */

insert  into `examen`(`examen_id`,`examen_nombre`,`examen_fregistro`,`analisis_id`,`examen_estatus`) values (3,'GENERAL','2022-06-20',4,'ACTIVO'),(4,'SANGRE',NULL,7,'ACTIVO');

/*Table structure for table `medico` */

DROP TABLE IF EXISTS `medico`;

CREATE TABLE `medico` (
  `medico_id` int(11) NOT NULL AUTO_INCREMENT,
  `medico_nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medico_apepat` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medico_apemat` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medico_direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medico_movil` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `medico_fenac` date DEFAULT NULL,
  `medico_nrodocumento` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fregistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estatus` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVO',
  PRIMARY KEY (`medico_id`) USING BTREE,
  KEY `especialidad_id` (`especialidad_id`) USING BTREE,
  KEY `usuario_id` (`usuario_id`) USING BTREE,
  CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`),
  CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `medico` */

insert  into `medico`(`medico_id`,`medico_nombre`,`medico_apepat`,`medico_apemat`,`medico_direccion`,`medico_movil`,`medico_fenac`,`medico_nrodocumento`,`especialidad_id`,`usuario_id`,`fregistro`,`estatus`) values (3,'KAREN','HERNANDEZ','TORRES','EL CARMEN','3012555','1987-02-12','10473873',2,NULL,'2022-07-16 08:26:18','ACTIVO'),(4,'','3434','434','434','erer','0000-00-00','54545',2,20014,'2022-07-17 20:15:49','ACTIVO'),(5,'UNITEC','PRUEBA','FLECHA','RETRTE','654656','2022-07-17','565656',2,20015,'2022-07-17 20:41:00','ACTIVO'),(6,'KAREN','VEGA','TORRES','EL CARMEN DE BOLIVAR','1321312','2022-07-24','10473783',2,20016,'2022-07-24 12:14:55','ACTIVO');

/*Table structure for table `paciente` */

DROP TABLE IF EXISTS `paciente`;

CREATE TABLE `paciente` (
  `paciente_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_nombres` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_apepaterno` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_apematerno` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_dni` char(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_celular` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_edad` int(11) DEFAULT NULL,
  `paciente_edadtipo` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_sexo` char(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `paciente_estatus` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'ACTIVO',
  `paciente_fregistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`paciente_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `paciente` */

insert  into `paciente`(`paciente_id`,`paciente_nombres`,`paciente_apepaterno`,`paciente_apematerno`,`paciente_dni`,`paciente_celular`,`paciente_edad`,`paciente_edadtipo`,`paciente_sexo`,`paciente_estatus`,`paciente_fregistro`) values (17,'JERSON','BATISTA','VEGA','31213213','346546546',33,'AÑOS','MASCULINO','ACTIVO','2022-06-27 19:54:56'),(18,'KAREN','HERNANDEZ','TORRES','1313232','132132132',33,'AÑOS','FEMENINO','ACTIVO','2022-07-09 12:10:20'),(19,'DSDS','EWEWE','EWEW','343434','56456',9,'AÑOS','MASCULINO','ACTIVO','2022-07-09 16:23:28');

/*Table structure for table `realizar_examen` */

DROP TABLE IF EXISTS `realizar_examen`;

CREATE TABLE `realizar_examen` (
  `realizarexamen_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `realizarexamen_estatus` enum('PENDIENTE','FINALIZADO') COLLATE utf8_spanish_ci DEFAULT NULL,
  `realizarexamen_indica` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `realizarexamen_nomindica` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `realizarexamen_fregistro` date DEFAULT NULL,
  PRIMARY KEY (`realizarexamen_id`) USING BTREE,
  KEY `paciente_id` (`paciente_id`) USING BTREE,
  KEY `usuario_id` (`usuario_id`) USING BTREE,
  CONSTRAINT `realizar_examen_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`),
  CONSTRAINT `realizar_examen_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `realizar_examen` */

/*Table structure for table `realizar_examen_detalle` */

DROP TABLE IF EXISTS `realizar_examen_detalle`;

CREATE TABLE `realizar_examen_detalle` (
  `rdetalle_id` int(11) NOT NULL AUTO_INCREMENT,
  `examen_id` int(11) DEFAULT NULL,
  `analisis_id` int(11) DEFAULT NULL,
  `realizarexamen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rdetalle_id`) USING BTREE,
  KEY `examen_id` (`examen_id`) USING BTREE,
  KEY `analisis_id` (`analisis_id`) USING BTREE,
  KEY `realizarexamen_id` (`realizarexamen_id`) USING BTREE,
  CONSTRAINT `realizar_examen_detalle_ibfk_1` FOREIGN KEY (`examen_id`) REFERENCES `examen` (`examen_id`),
  CONSTRAINT `realizar_examen_detalle_ibfk_2` FOREIGN KEY (`analisis_id`) REFERENCES `analisis` (`analisis_id`),
  CONSTRAINT `realizar_examen_detalle_ibfk_3` FOREIGN KEY (`realizarexamen_id`) REFERENCES `realizar_examen` (`realizarexamen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `realizar_examen_detalle` */

/*Table structure for table `resultado` */

DROP TABLE IF EXISTS `resultado`;

CREATE TABLE `resultado` (
  `resultado_id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `resultado_fregistro` date DEFAULT NULL,
  `resultado_estatus` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`resultado_id`) USING BTREE,
  KEY `paciente_id` (`paciente_id`) USING BTREE,
  KEY `usuario_id` (`usuario_id`) USING BTREE,
  CONSTRAINT `resultado_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`),
  CONSTRAINT `resultado_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `resultado` */

/*Table structure for table `resultado_detalle` */

DROP TABLE IF EXISTS `resultado_detalle`;

CREATE TABLE `resultado_detalle` (
  `resuldetalle_id` int(11) NOT NULL AUTO_INCREMENT,
  `resultado_id` int(11) DEFAULT NULL,
  `resuldetalle_archivo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `rdetalle_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`resuldetalle_id`) USING BTREE,
  KEY `resultado_id` (`resultado_id`) USING BTREE,
  KEY `rdetalle_id` (`rdetalle_id`) USING BTREE,
  CONSTRAINT `resultado_detalle_ibfk_2` FOREIGN KEY (`resultado_id`) REFERENCES `resultado` (`resultado_id`),
  CONSTRAINT `resultado_detalle_ibfk_3` FOREIGN KEY (`rdetalle_id`) REFERENCES `realizar_examen_detalle` (`rdetalle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `resultado_detalle` */

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_fregistro` date DEFAULT NULL,
  `rol_estatus` enum('ACTIVO','INACTIVO') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rol_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `rol` */

insert  into `rol`(`rol_id`,`rol_nombre`,`rol_fregistro`,`rol_estatus`) values (4,'Administrador','2022-06-04','ACTIVO'),(5,'Medico','2022-06-04','ACTIVO'),(6,'Paciente','2022-06-04','ACTIVO'),(7,'Empleado','2022-06-18','INACTIVO'),(8,'Invitado',NULL,'ACTIVO');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `usu_status` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `usu_foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`usu_id`) USING BTREE,
  KEY `rol_id` (`rol_id`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20017 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `usuario` */

insert  into `usuario`(`usu_id`,`usu_nombre`,`usu_contrasena`,`rol_id`,`usu_status`,`usu_email`,`usu_foto`) values (20008,'admin','$2y$10$fOzxHlPbYqs3qcEoOAtI6.dM2o8AJVfTOhOWyXxbNZINPXCzCruNS',4,'ACTIVO','jerson2@gmail.com','controller/usuario/img/IMG146202221549.png'),(20013,'juanito','$2y$10$6BgfD.Q.AOfoPCS1AgjC/e3kLPIAsj5sxOCSiW7erK4GYl4aGoRUS',5,'ACTIVO','juanito@gmail.com','controller/usuario/img/avatar.png'),(20014,'trtr','trtr',4,'ACTIVO','445',''),(20015,'prueba123@gmail.com','$2y$10$fLWObLgLE3r3k3Ny29gEFuezWxDTRvKu8GplQr0kbxEYSyy20AKr.',5,'ACTIVO','prueba123@gmail.com','controller/usuario/img/avatar.png'),(20016,'karen123','$2y$10$3SBSGchMo.G7R3UlcmgEVuyqlPwlzfRakxy.iAXezB2IUTGQzmsIi',5,'ACTIVO','kren123@gmail.com','controller/usuario/img/avatar.png');

/* Procedure structure for procedure `LLENARDATA` */

/*!50003 DROP PROCEDURE IF EXISTS  `LLENARDATA` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `LLENARDATA`()
BEGIN 
DECLARE CONTADOR INT;
SET @CONTADOR =1;
WHILE 20000 > @CONTADOR DO 
INSERT INTO usuario(usu_nombre,usu_contrasena,rol_id,usu_status,usu_email)
VALUES (CONCAT_WS('','admin',@CONTADOR),'$2y$10$xy9fblkAg1Lz9a1hnUHeo.1Or/f.7zcST/NptiAYk0Tph6D594a3y','4',
'ACTIVO',CONCAT_WS('','ingjerson',@CONTADOR,'@gmail.com'));
SET @CONTADOR:=@CONTADOR+1;

END WHILE;


END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_ANALISIS` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_ANALISIS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ANALISIS`(IN `ID` INT, IN `ANALISIS_ACTUAL` VARCHAR(250), IN `ANALISIS_NUEVO` VARCHAR(250), IN `ESTATUS` VARCHAR(15))
BEGIN
DECLARE CANTIDAD INT;
IF ANALISIS_ACTUAL = ANALISIS_NUEVO THEN
	UPDATE analisis SET
	analisis_estatus=ESTATUS
	WHERE analisis_id = ID;
SELECT 1;
ELSE 
SET @CANTIDAD:=(SELECT COUNT(*) FROM analisis WHERE analisis_nombre=ANALISIS_NUEVO);
IF  @CANTIDAD = 0 THEN
UPDATE analisis SET
analisis_estatus=ESTATUS,
analisis_nombre=ANALISIS_NUEVO
WHERE analisis_id = ID;
SELECT 1;
ELSE 
SELECT 2;
END IF;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_ESPECIALIDAD` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_ESPECIALIDAD` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESPECIALIDAD`(IN `ID` INT, IN `ESPECIALIDAD_ACTUAL` VARCHAR(250), IN `ESPECIALIDAD_NUEVO` VARCHAR(250), IN `ESTATUS` VARCHAR(15))
BEGIN
DECLARE CANTIDAD INT;
IF ESPECIALIDAD_ACTUAL = ESPECIALIDAD_NUEVO THEN
    UPDATE especialidad SET
    especialidad_estatus=ESTATUS
    WHERE especialidad_id = ID;
SELECT 1;
ELSE 
SET @CANTIDAD:=(SELECT COUNT(*) FROM especialidad WHERE especialidad_nombre=ESPECIALIDAD_NUEVO);
IF  @CANTIDAD = 0 THEN
UPDATE especialidad SET
especialidad_estatus=ESTATUS,
especialidad_nombre=ESPECIALIDAD_NUEVO
WHERE especialidad_id = ID;
SELECT 1;
ELSE 
SELECT 2;
END IF;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_ESTATUS` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_ESTATUS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESTATUS`(IN ID INT, IN ESTATUS VARCHAR(20))
UPDATE usuario set
usu_status =ESTATUS
where usu_id =ID */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_ESTATUS_ROL` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_ESTATUS_ROL` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ESTATUS_ROL`(IN `ID` INT, IN `ESTATUS` VARCHAR(20))
UPDATE rol set
rol_estatus =ESTATUS
where rol_id =ID */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_FOTO_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_FOTO_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_FOTO_USUARIO`(IN ID INT, IN RUTA VARCHAR(255))
UPDATE usuario SET
`usu_foto` =RUTA
WHERE usu_id =ID */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_ROL` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_ROL` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_ROL`(IN `ID` INT, IN `ROL_ACTUAL` VARCHAR(250), IN `ROL_NUEVO` VARCHAR(250), IN `ESTATUS` VARCHAR(15))
BEGIN
DECLARE CANTIDAD INT;
IF ROL_ACTUAL = ROL_NUEVO THEN
	UPDATE rol SET
	rol_estatus=ESTATUS
	WHERE rol_id = ID;
SELECT 1;
ELSE 
SET @CANTIDAD:=(SELECT COUNT(*) FROM rol WHERE rol_nombre=ROL_NUEVO);
IF  @CANTIDAD = 0 THEN
UPDATE rol SET
rol_estatus=ESTATUS,
rol_nombre=ROL_NUEVO
WHERE rol_id = ID;
SELECT 1;
ELSE 
SELECT 2;
END IF;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_MODIFICAR_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_MODIFICAR_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MODIFICAR_USUARIO`(IN ID INT, IN IDROL INT,
IN CORREO VARCHAR(255))
update usuario set
`rol_id` =IDROL,
usu_email =CORREO
where usu_id =ID */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_ANALISIS` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_ANALISIS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ANALISIS`(IN `nombre` VARCHAR(30))
BEGIN 
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM analisis WHERE analisis_nombre =nombre);
IF @CANTIDAD = 0 THEN
INSERT INTO analisis (`analisis_nombre`,analisis_fregistro, analisis_estatus)
VALUES (nombre,CURDATE(),'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_ESPECIALIDAD` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_ESPECIALIDAD` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ESPECIALIDAD`(IN `nombre` VARCHAR(30))
BEGIN 
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM especialidad WHERE especialidad_nombre =nombre);
IF @CANTIDAD = 0 THEN
INSERT INTO especialidad (`especialidad_nombre`,especialidad_fregistro, especialidad_estatus)
VALUES (nombre,CURDATE(),'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_EXAMEN` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_EXAMEN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_EXAMEN`(IN NOMBRE_EXAMEN VARCHAR(50),
   IN IDANALISIS INT )
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM examen WHERE examen_nombre=NOMBRE_EXAMEN);
IF @CANTIDAD= 0 THEN 
INSERT INTO examen(examen_nombre,analisis_id, examen_estatus)
VALUES (NOMBRE_EXAMEN,IDANALISIS,'ACTIVO');
SELECT 1;
 ELSE 
 SELECT 2;
 END IF;

END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_MEDICO` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_MEDICO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MEDICO`(IN `NOMBRE` VARCHAR(100), IN `APELLIDO_PAT` VARCHAR(100), IN `APELLIDO_MAT` VARCHAR(100), IN `DIRECCION` VARCHAR(100), IN `CEL` VARCHAR(50), IN `FNAC` DATE, IN `DOCUMENTO` VARCHAR(15), IN `IDESPECIALIDAD` INT, IN `USUARIO` VARCHAR(100), IN `CONTRA` VARCHAR(255), IN `IDROL` INT, IN `CORREO` VARCHAR(100), IN `RUTA` VARCHAR(512))
BEGIN

DECLARE CANTIDADUSER INT;
DECLARE CANTIDADMEDICO INT;
SET @CANTIDADUSER:=(SELECT COUNT(*) FROM usuario WHERE usu_nombre =USUARIO);
IF @CANTIDADUSER = 0 THEN
 SET @CANTIDADMEDICO:=(SELECT COUNT(*) FROM medico WHERE `medico_nrodocumento` =DOCUMENTO);
 IF @CANTIDADMEDICO = 0 THEN
 INSERT INTO usuario(usu_nombre,usu_contrasena,rol_id,usu_status,usu_email,usu_foto)
	VALUE(USUARIO,CONTRA,IDROL,'ACTIVO',CORREO,RUTA);
INSERT INTO medico(`medico_nombre`,`medico_apepat`,medico_apemat,`medico_direccion`,
`medico_movil`,`medico_fenac`,`medico_nrodocumento`,`especialidad_id`,`usuario_id`)
VALUE(NOMBRE,APELLIDO_PAT,APELLIDO_MAT,DIRECCION,CEL,FNAC,DOCUMENTO,IDESPECIALIDAD,
(SELECT MAX(usu_id) FROM usuario));
SELECT 1;
 ELSE 
 SELECT 2;
 END IF;
	
ELSE
SELECT 3;
END IF;

END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_PACIENTE` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_PACIENTE` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PACIENTE`(IN NOMBRES VARCHAR(100),IN APEPAT VARCHAR(100),IN APEMAT VARCHAR(100),IN DNI CHAR(10),IN CELULAR VARCHAR(12),IN EDAD INT,IN TIPO CHAR(10),IN SEXO CHAR(12))
BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM paciente where paciente_dni=DNI);
IF @CANTIDAD = 0 THEN
    INSERT INTO paciente(paciente_nombres,paciente_apepaterno,paciente_apematerno,paciente_dni,paciente_celular,paciente_edad,paciente_edadtipo,paciente_sexo)VALUES(NOMBRES,APEPAT,APEMAT,DNI,CELULAR,EDAD,TIPO,SEXO);
    SELECT 1;
ELSE
    SELECT 2;
END IF;

END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_ROL` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_ROL` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_ROL`(IN `ROL` VARCHAR(30))
BEGIN 
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM rol WHERE rol.`rol_nombre` =ROL);
IF @CANTIDAD = 0 THEN
INSERT INTO rol (`rol_nombre`, rol.`rol_estatus`)
VALUES (ROL,'ACTIVO');
SELECT 1;
ELSE
SELECT 2;
END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_REGISTRAR_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_REGISTRAR_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_USUARIO`(IN USUARIO VARCHAR(50), IN CONTRA VARCHAR(255),
IN IDROL INT,IN EMAIL VARCHAR(255), IN RUTA VARCHAR(255))
BEGIN
DECLARE CANTIDAD INT;

SET @CANTIDAD:=(SELECT COUNT(*) FROM usuario where usu_nombre =BINARY USUARIO);
IF @CANTIDAD = 0 THEN 
INSERT INTO usuario(usu_nombre,usu_contrasena,rol_id,usu_status,usu_email,usu_foto)
VALUE(USUARIO,CONTRA,IDROL,'ACTIVO',EMAIL,RUTA);
SELECT 1;
ELSE
SELECT 2;

END IF;

END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_VERIFICAR_USUARIO` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_VERIFICAR_USUARIO` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICAR_USUARIO`(IN USUARIO VARCHAR(250))
SELECT
    `u`.`usu_id`
    , `u`.`usu_nombre`
    , `u`.`usu_contrasena`
    , `u`.`rol_id`
    , `u`.`usu_status`
    , `u`.`usu_email`
    , `u`.`usu_foto`
    , `r`.`rol_nombre`
FROM
    `usuario` AS `u`
    INNER JOIN `rol` AS `r` 
        ON (`u`.`rol_id` = `r`.`rol_id`)
        where  usu_nombre =BINARY USUARIO */$$
DELIMITER ;

/*Table structure for table `view_listar_paciente` */

DROP TABLE IF EXISTS `view_listar_paciente`;

/*!50001 DROP VIEW IF EXISTS `view_listar_paciente` */;
/*!50001 DROP TABLE IF EXISTS `view_listar_paciente` */;

/*!50001 CREATE TABLE  `view_listar_paciente`(
 `paciente_id` int(11) ,
 `paciente_nombres` varchar(100) ,
 `paciente_apepaterno` varchar(100) ,
 `paciente_apematerno` varchar(100) ,
 `paciente_dni` char(8) ,
 `paciente_celular` varchar(12) ,
 `paciente_edad` int(11) ,
 `paciente_edadtipo` char(10) ,
 `paciente_sexo` char(12) ,
 `paciente_estatus` enum('ACTIVO','INACTIVO') ,
 `paciente_fregistro` timestamp ,
 `paciente` varchar(302) ,
 `edadcon` varchar(22) 
)*/;

/*Table structure for table `view_listar_usuario` */

DROP TABLE IF EXISTS `view_listar_usuario`;

/*!50001 DROP VIEW IF EXISTS `view_listar_usuario` */;
/*!50001 DROP TABLE IF EXISTS `view_listar_usuario` */;

/*!50001 CREATE TABLE  `view_listar_usuario`(
 `usu_id` int(11) ,
 `usu_nombre` varchar(20) ,
 `usu_contrasena` varchar(255) ,
 `rol_id` int(11) ,
 `usu_status` enum('ACTIVO','INACTIVO') ,
 `usu_email` varchar(255) ,
 `usu_foto` varchar(255) ,
 `rol_nombre` varchar(30) 
)*/;

/*View structure for view view_listar_paciente */

/*!50001 DROP TABLE IF EXISTS `view_listar_paciente` */;
/*!50001 DROP VIEW IF EXISTS `view_listar_paciente` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_paciente` AS (select `paciente`.`paciente_id` AS `paciente_id`,`paciente`.`paciente_nombres` AS `paciente_nombres`,`paciente`.`paciente_apepaterno` AS `paciente_apepaterno`,`paciente`.`paciente_apematerno` AS `paciente_apematerno`,`paciente`.`paciente_dni` AS `paciente_dni`,`paciente`.`paciente_celular` AS `paciente_celular`,`paciente`.`paciente_edad` AS `paciente_edad`,`paciente`.`paciente_edadtipo` AS `paciente_edadtipo`,`paciente`.`paciente_sexo` AS `paciente_sexo`,`paciente`.`paciente_estatus` AS `paciente_estatus`,`paciente`.`paciente_fregistro` AS `paciente_fregistro`,concat_ws(' ',`paciente`.`paciente_nombres`,`paciente`.`paciente_apepaterno`,`paciente`.`paciente_apematerno`) AS `paciente`,concat(' ',`paciente`.`paciente_edad`,`paciente`.`paciente_edadtipo`) AS `edadcon` from `paciente`) */;

/*View structure for view view_listar_usuario */

/*!50001 DROP TABLE IF EXISTS `view_listar_usuario` */;
/*!50001 DROP VIEW IF EXISTS `view_listar_usuario` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_listar_usuario` AS (select `usuario`.`usu_id` AS `usu_id`,`usuario`.`usu_nombre` AS `usu_nombre`,`usuario`.`usu_contrasena` AS `usu_contrasena`,`usuario`.`rol_id` AS `rol_id`,`usuario`.`usu_status` AS `usu_status`,`usuario`.`usu_email` AS `usu_email`,`usuario`.`usu_foto` AS `usu_foto`,`rol`.`rol_nombre` AS `rol_nombre` from (`usuario` join `rol` on(`usuario`.`rol_id` = `rol`.`rol_id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
