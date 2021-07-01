-- MySQL dump 10.9
--
-- Host: localhost    Database: ingenium
-- ------------------------------------------------------
-- Server version	4.1.18-nt

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accionproceso`
--

DROP TABLE IF EXISTS `accionproceso`;
CREATE TABLE `accionproceso` (
  `SERIAL_ACP` int(11) NOT NULL auto_increment,
  `SERIAL_PFL` int(11) default NULL,
  `SERIAL_PRC` int(11) default NULL,
  `INSERTAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `EDITAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `BUSCAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ELIMINAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ENVIOCORREO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `GRAFICAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `IMPRIMIR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `AYUDA_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ACERCADE_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `SALIR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `INICIO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `PRINCIPIO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ANTERIOR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `SIGUIENTE_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ULTIMO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ENVIOEXCEL_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ENVIOXML_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `FILTRAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `GUARDAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CANCELAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `NAVEGAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `APROBARDOCUMENTO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `APROBARCUPOPLAZO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ANULAR_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `REVERSARCOMPROBANTES_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CONSOLIDARCIERREPERIODO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `MAYORIZARPRESUPUESTO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ABRIRPRESUPUESTO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `PRESUPUESTOANUAL_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `PRESUPUESTOPERIODO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CERRARPRESUPUESTO_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `BAJAREXCEL_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `SUBIREXCEL_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `FICHAPERSONAL_ACP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `DEPOSITAR_ACP` char(2) collate latin1_spanish_ci default NULL,
  `EFECTIVIZAR_ACP` char(2) collate latin1_spanish_ci default NULL,
  `PROTESTAR_ACP` char(2) collate latin1_spanish_ci default NULL,
  `DEPOSITOEFECTIVO_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ANULARDOCUMENTO_ACP` char(2) collate latin1_spanish_ci default NULL,
  `CLIENTEMOROSO_ACP` char(2) collate latin1_spanish_ci default NULL,
  `IMPRIMIRCOMPROBANTE_ACP` char(2) collate latin1_spanish_ci default NULL,
  `IMPRIMIRCHEQUE_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ANULARCHEQUE_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ACCION11_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ACCION12_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ACCION13_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ACCION14_ACP` char(2) collate latin1_spanish_ci default NULL,
  `ACCION15_ACP` char(2) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ACP`),
  KEY `FK_PERFILACCIONPROCESO` (`SERIAL_PFL`),
  KEY `FK_PROCESOSACCIONPROCESO` (`SERIAL_PRC`),
  CONSTRAINT `FK_PERFILACCIONPROCESO` FOREIGN KEY (`SERIAL_PFL`) REFERENCES `perfil` (`SERIAL_PFL`),
  CONSTRAINT `FK_PROCESOSACCIONPROCESO` FOREIGN KEY (`SERIAL_PRC`) REFERENCES `procesos` (`SERIAL_PRC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `accionproceso`
--


/*!40000 ALTER TABLE `accionproceso` DISABLE KEYS */;
LOCK TABLES `accionproceso` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `accionproceso` ENABLE KEYS */;

--
-- Table structure for table `activosfijos`
--

DROP TABLE IF EXISTS `activosfijos`;
CREATE TABLE `activosfijos` (
  `SERIAL_ACF` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `SERIAL_DESC` int(11) default NULL,
  `SERIAL_TAF` int(11) default NULL,
  `CODIGO_ACF` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  `CODIGOBARRAS_ACF` varchar(13) collate latin1_spanish_ci default NULL,
  `NOMBRE_ACF` varchar(80) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_ACF` varchar(200) collate latin1_spanish_ci NOT NULL default '',
  `VALOR_ACF` decimal(16,2) NOT NULL default '0.00',
  `FECHA_ACF` date NOT NULL default '0000-00-00',
  `NUMEROFACTURACOMPRA_ACF` varchar(15) collate latin1_spanish_ci default NULL,
  `MARCA_ACF` varchar(40) collate latin1_spanish_ci NOT NULL default '',
  `MODELO_ACF` varchar(40) collate latin1_spanish_ci NOT NULL default '',
  `SERIE_ACF` varchar(40) collate latin1_spanish_ci NOT NULL default '',
  `FECHADEPRECIACION_ACF` date default NULL,
  `TANGIBLE_ACF` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CONTROL_ACF` char(2) collate latin1_spanish_ci default NULL,
  `FECHABAJAINVENTARIO_ACF` date default NULL,
  `VALORREEXPRESION_ACF` decimal(16,2) default NULL,
  `VALORREPOSICION_ACF` decimal(16,2) default NULL,
  `METROLOGIA_ACF` varchar(20) collate latin1_spanish_ci default NULL,
  `DEPRECIACIONACUMULADA_ACF` decimal(16,2) default NULL,
  `FECHADEPRECIACIONACUMULADA_ACF` date default NULL,
  `ESTADO_ACF` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  `VIDAUTIL_ACF` int(11) default NULL,
  `TIPODEPRECIACION_ACF` varchar(20) collate latin1_spanish_ci default NULL,
  `TIPO_ACF` varchar(20) collate latin1_spanish_ci default NULL,
  `ATRIBUTO1_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO2_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO3_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO4_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO5_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO6_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO7_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO8_ACF` varchar(50) collate latin1_spanish_ci default NULL,
  `FECHAREGISTRO_ACF` date default NULL,
  `DEPRECIACIONINICIAL_ACF` decimal(16,2) default NULL,
  `MOTIVOBAJA_ACF` varchar(30) collate latin1_spanish_ci default NULL,
  `OBSERVACIONES_ACF` varchar(255) collate latin1_spanish_ci default NULL,
  `TIEMPOUSO_ACF` int(11) default NULL,
  `TIEMPORESTANTE_ACF` int(11) default NULL,
  `SERIAL_COM` int(11) default NULL,
  `SERIAL_UBI` int(11) default NULL,
  `SERIAL_EPL` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_ACF`),
  KEY `AK_CODIGO_ACF_IDX` (`CODIGO_ACF`),
  KEY `AK_NOMBRE_ACF_IDX` (`NOMBRE_ACF`,`SERIE_ACF`),
  KEY `AK_CODIGOBARRAS_ACF_IDX` (`CODIGOBARRAS_ACF`),
  KEY `FK_PROVEEDORACTIVOFIJO` (`SERIAL_PVD`),
  KEY `FK_SUCURSALDEPARTAMENTOACTIVOFIJO` (`SERIAL_DESC`),
  KEY `FK_TIPOACTIVOFIJOACTIVOFIJO` (`SERIAL_TAF`),
  CONSTRAINT `FK_PROVEEDORACTIVOFIJO` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOACTIVOFIJO` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`),
  CONSTRAINT `FK_TIPOACTIVOFIJOACTIVOFIJO` FOREIGN KEY (`SERIAL_TAF`) REFERENCES `tipoactivofijo` (`SERIAL_TAF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `activosfijos`
--


/*!40000 ALTER TABLE `activosfijos` DISABLE KEYS */;
LOCK TABLES `activosfijos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `activosfijos` ENABLE KEYS */;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `serial_alu` int(11) NOT NULL auto_increment,
  `serial_nac` int(11) default NULL,
  `serial_col` int(11) default NULL,
  `serial_sex` int(11) default NULL,
  `serial_tra` int(11) default NULL,
  `serial_can` int(11) default NULL,
  `serial_pai` int(11) default NULL,
  `nombre_alu` char(30) collate latin1_spanish_ci NOT NULL default '',
  `apellido_alu` char(40) collate latin1_spanish_ci NOT NULL default '',
  `tipoIdentificacion_alu` char(1) collate latin1_spanish_ci default NULL,
  `codigoIdentificacion_alu` char(50) collate latin1_spanish_ci default NULL,
  `fecnac_alu` date default NULL,
  `direcc_alu` char(80) collate latin1_spanish_ci default NULL,
  `mail_alu` char(50) collate latin1_spanish_ci default NULL,
  `telefo_alu` char(50) collate latin1_spanish_ci default NULL,
  `busRetorno_alu` int(11) default NULL,
  `conQuienVive_alu` char(1) collate latin1_spanish_ci default NULL,
  `fechaIngreso_alu` date default NULL,
  `observacion_alu` char(255) collate latin1_spanish_ci default NULL,
  `fechaObs_alu` date default NULL,
  `foto_alu` char(255) collate latin1_spanish_ci default NULL,
  `estado_alu` char(1) collate latin1_spanish_ci default NULL,
  `paseObs_alu` char(255) collate latin1_spanish_ci default NULL,
  `cursoAprobado_alu` char(50) collate latin1_spanish_ci default NULL,
  `seccionAprobado_alu` char(50) collate latin1_spanish_ci default NULL,
  `id_alumno` char(15) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`serial_alu`),
  KEY `codigoIdentificacion_alu_idx` (`codigoIdentificacion_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `alumno`
--


/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
LOCK TABLES `alumno` WRITE;
INSERT INTO `alumno` VALUES (1,1,1,1,1,1013,1,'Fabián Alejandro','ABAD  ALMEIDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080001.JPG','A','A','1','1','20080001'),(2,1,1,1,1,1013,1,'Diego Gadiel','ANGULO  ERAZO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080002.JPG','A','A','1','1','20080002'),(3,1,1,1,1,1013,1,'José David','ALTAMIRANO  VILLACÍS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080003.JPG','A','A','1','1','20080003'),(4,1,1,1,1,1013,1,'Eduardo Miguel','ALCÍVAR  ZAMBRANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080004.JPG','A','A','1','1','20080004'),(5,1,1,1,1,1013,1,'Camilo David','ANDRADE  MARTÍNEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080005.JPG','A','A','1','1','20080005'),(6,1,1,1,1,1013,1,'Fabián André','ANDRADE  NAVAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080006.JPG','A','A','1','1','20080006'),(7,1,1,1,1,1013,1,'Luis Alejandro','ANDRADE  MITTE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080007.JPG','A','A','1','1','20080007'),(8,1,1,1,1,1013,1,'Cristopher Steven','ÁLVAREZ  VILLA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080008.JPG','A','A','1','1','20080008'),(9,1,1,1,1,1013,1,'Daniel Matías','ARAUJO  PÉREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080009.JPG','A','A','1','1','20080009'),(10,1,1,1,1,1013,1,'Gabriel Israel','ARCOS  PINTO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080010.JPG','A','A','1','1','20080010'),(11,1,1,1,1,1013,1,'Benjamín Ernesto','ARELLANO  IBARRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080011.JPG','A','A','1','1','20080011'),(12,1,1,1,1,1013,1,'Esteban Xavier','ARELLANO  MUÑOZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080012.JPG','A','A','1','1','20080012'),(13,1,1,1,1,1013,1,'Mateo David','ARIAS  VENEGAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080013.JPG','A','A','1','1','20080013'),(14,1,1,1,1,1013,1,'Esteban Santiago','ARMAS  CEPEDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080014.JPG','A','A','1','1','20080014'),(15,1,1,1,1,1013,1,'Teodoro Joel','BARROS  GUATO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080015.JPG','A','A','1','1','20080015'),(16,1,1,1,1,1013,1,'Guillermo Enrique','BARRAGÁN  MONTALVO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080016.JPG','A','A','1','1','20080016'),(17,1,1,1,1,1013,1,'Carlos Eduardo','BARZALLO  BRAVO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080017.JPG','A','A','1','1','20080017'),(18,1,1,1,1,1013,1,'Edwin Rolando','BASTIDAS  BASTIDAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080018.JPG','A','A','1','1','20080018'),(19,1,1,1,1,1013,1,'Byron Iván','BASANTES  HERRERA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080019.JPG','A','A','1','1','20080019'),(20,1,1,1,1,1013,1,'Edison David','BERMÚDEZ  SARAUZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080020.JPG','A','A','1','1','20080020'),(21,1,1,1,1,1013,1,'Marco Sebastián','BENAVIDES  ESTRELLA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080021.JPG','A','A','1','1','20080021'),(22,1,1,1,1,1013,1,'Luis Ricardo','BERNAL  HARO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080022.JPG','A','A','1','1','20080022'),(23,1,1,1,1,1013,1,'Byron Steevens','BONILLA  CAMACHO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080023.JPG','A','A','1','1','20080023'),(24,1,1,1,1,1013,1,'Mateo Alejandro','BONILLA  LAVA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080024.JPG','A','A','1','1','20080024'),(25,1,1,1,1,1013,1,'Sebastián Guillermo','CABRERA  CARVAJAL','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080025.JPG','A','A','1','1','20080025'),(26,1,1,1,1,1013,1,'Gustavo Paúl','CADENA  SÁNCHEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080026.JPG','A','A','1','1','20080026'),(27,1,1,1,1,1013,1,'Felipe David','CALDERÓN  SALAZAR','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080027.JPG','A','A','1','1','20080027'),(28,1,1,1,1,1013,1,'Sebastián Alejandro','CALVOPIÑA  ACOSTA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080028.JPG','A','A','1','1','20080028'),(29,1,1,1,1,1013,1,'Alejandro Xavier','CAMPOVERDE  SANI','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080029.JPG','A','A','1','1','20080029'),(30,1,1,1,1,1013,1,'Francis Iván','CASTRO  PALMA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080030.JPG','A','A','1','1','20080030'),(31,1,1,1,1,1013,1,'Christian Javier','CAO  ORMAZA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080031.JPG','A','A','1','1','20080031'),(32,1,1,1,1,1013,1,'Isaac Wladimir','CAZCO  LUNCH','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080032.JPG','A','A','1','1','20080032'),(33,1,1,1,1,1013,1,'Andrés Felipe','CEDILLO  BURBANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080033.JPG','A','A','1','1','20080033'),(34,1,1,1,1,1013,1,'Kevin Homero','CERÓN  JARA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080034.JPG','A','A','1','1','20080034'),(35,1,1,1,1,1013,1,'Juan Pablo','CEVALLOS  FONSECA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080035.JPG','A','A','1','1','20080035'),(36,1,1,1,1,1013,1,'Santiago Damián','CEVALLOS  JÁCOME','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080036.JPG','A','A','1','1','20080036'),(37,1,1,1,1,1013,1,'Jorge Francisco','CIFUENTES  ASTUDILLO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080037.JPG','A','A','1','1','20080037'),(38,1,1,1,1,1013,1,'Diego Esteban','CIFUENTES  VEGA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080038.JPG','A','A','1','1','20080038'),(39,1,1,1,1,1013,1,'Bryan Giovanni','COBA  GALLARDO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080039.JPG','A','A','1','1','20080039'),(40,1,1,1,1,1013,1,'Mateo Sebastián','CÓRDOVA  CRUZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080040.JPG','A','A','1','1','20080040'),(41,1,1,1,1,1013,1,'Jonathan Darío','CORO  MAILA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080041.JPG','A','A','1','1','20080041'),(42,1,1,1,1,1013,1,'Jerónimo Bernardo','CORRAL  DÁVALOS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080042.JPG','A','A','1','1','20080042'),(43,1,1,1,1,1013,1,'Daniel Alejandro','CORRAL  GUAMÁN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080043.JPG','A','A','1','1','20080043'),(44,1,1,1,1,1013,1,'César Rafael','CRUZ  ROSERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080044.JPG','A','A','1','1','20080044'),(45,1,1,1,1,1013,1,'Cristian David','CRUZ  SALAZAR','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080045.JPG','A','A','1','1','20080045'),(46,1,1,1,1,1013,1,'Cristhian René','CHACHA  CASTRO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080046.JPG','A','A','1','1','20080046'),(47,1,1,1,1,1013,1,'Gustavo Xavier','CHAFLA  HERNÁNDEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080047.JPG','A','A','1','1','20080047'),(48,1,1,1,1,1013,1,'Sebastián Martino','CHANGOLUISA  PERALVO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080048.JPG','A','A','1','1','20080048'),(49,1,1,1,1,1013,1,'Gonzalo Vladimiro','CHÁVEZ  ROMERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080049.JPG','A','A','1','1','20080049'),(50,1,1,1,1,1013,1,'Daniel Steven','CHÁVEZ  S.','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080050.JPG','A','A','1','1','20080050'),(51,1,1,1,1,1013,1,'Iván Alejandro','DÁVILA  ACOSTA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080051.JPG','A','A','1','1','20080051'),(52,1,1,1,1,1013,1,'Gustavo Andree','DEFAZ  MONTERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080052.JPG','A','A','1','1','20080052'),(53,1,1,1,1,1013,1,'Mauricio Sebastián','DUCHE  ESPÍN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080053.JPG','A','A','1','1','20080053'),(54,1,1,1,1,1013,1,'Milton David','ENRÍQUEZ  BRAVO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080054.JPG','A','A','1','1','20080054'),(55,1,1,1,1,1013,1,'Sebastián Eduardo','ESCUDERO  BASTIDAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080055.JPG','A','A','1','1','20080055'),(56,1,1,1,1,1013,1,'Esteban Aldhair','ESCUDERO  FREIRE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080056.JPG','A','A','1','1','20080056'),(57,1,1,1,1,1013,1,'Jorge Esteban','ESPÍN  SAMBACHE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080057.JPG','A','A','1','1','20080057'),(58,1,1,1,1,1013,1,'Mike Josue','ESPINOSA  CASTRO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080058.JPG','A','A','1','1','20080058'),(59,1,1,1,1,1013,1,'Jordie David','ESPINOZA  PACHECO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080059.JPG','A','A','1','1','20080059'),(60,1,1,1,1,1013,1,'Juan Sebastián','ESTRADA  CRUZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080060.JPG','A','A','1','1','20080060'),(61,1,1,1,1,1013,1,'Andrés','FAJARDO  CEPEDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080061.JPG','A','A','1','1','20080061'),(62,1,1,1,1,1013,1,'Brian Xavier','FIGUEROA  PROAÑO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080062.JPG','A','A','1','1','20080062'),(63,1,1,1,1,1013,1,'Christian Alejandro','FLORES  SALGADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080063.JPG','A','A','1','1','20080063'),(64,1,1,1,1,1013,1,'Karim Mijail','FRAGA  MANZANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080064.JPG','A','A','1','1','20080064'),(65,1,1,1,1,1013,1,'Adrián Esteban','FREIRE  ROMERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080065.JPG','A','A','1','1','20080065'),(66,1,1,1,1,1013,1,'Jefferson Alexander','FREIRE  TORRES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080066.JPG','A','A','1','1','20080066'),(67,1,1,1,1,1013,1,'Andrew Javier','GALLARDO  BRITO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080067.JPG','A','A','1','1','20080067'),(68,1,1,1,1,1013,1,'Francisco José','GALLARDO  CÁRDENAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080068.JPG','A','A','1','1','20080068'),(69,1,1,1,1,1013,1,'Juan Daniel','GALLO  ECHEVERRÍA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080069.JPG','A','A','1','1','20080069'),(70,1,1,1,1,1013,1,'José Gabriel','GARZÓN  VELASTEGUI','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080070.JPG','A','A','1','1','20080070'),(71,1,1,1,1,1013,1,'Iván Santiago','GORDILLO  CASTILLO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080071.JPG','A','A','1','1','20080071'),(72,1,1,1,1,1013,1,'Santiago Manuel','GUERRA  BALLADARES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080072.JPG','A','A','1','1','20080072'),(73,1,1,1,1,1013,1,'Juan Sebastián','GUERRA  VILLACÍS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080073.JPG','A','A','1','1','20080073'),(74,1,1,1,1,1013,1,'Alejandro Ricardo','GUERRERO  BAILÓN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080074.JPG','A','A','1','1','20080074'),(75,1,1,1,1,1013,1,'Diego Fernando','GUERRERO  MÉNDEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080075.JPG','A','A','1','1','20080075'),(76,1,1,1,1,1013,1,'Miguel Francois','GUERRERO  VILLA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080076.JPG','A','A','1','1','20080076'),(77,1,1,1,1,1013,1,'Jean Pierre','HERDOIZA  MONTERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080077.JPG','A','A','1','1','20080077'),(78,1,1,1,1,1013,1,'Cristian Francisco','HERNÁNDEZ  ZAMBRANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080078.JPG','A','A','1','1','20080078'),(79,1,1,1,1,1013,1,'Estéfano Alexander','HIDALGO  ONTANEDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080079.JPG','A','A','1','1','20080079'),(80,1,1,1,1,1013,1,'Gabriel Andrés','ILVAY  VELÁSQUEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080080.JPG','A','A','1','1','20080080'),(81,1,1,1,1,1013,1,'Diego Alexander','IMBAQUINGO  AMÁN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080081.JPG','A','A','1','1','20080081'),(82,1,1,1,1,1013,1,'Juan Francisco','JÁCOME  CHONGO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080082.JPG','A','A','1','1','20080082'),(83,1,1,1,1,1013,1,'Erick Sebastián','JÁCOME  JÁTIVA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080083.JPG','A','A','1','1','20080083'),(84,1,1,1,1,1013,1,'David Fernando','JÁCOME  PONCE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080084.JPG','A','A','1','1','20080084'),(85,1,1,1,1,1013,1,'Jorge Enrique','JARAMILLO  BUSTAMANTE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080085.JPG','A','A','1','1','20080085'),(86,1,1,1,1,1013,1,'Luis Domingo','JIBAJA  PRADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080086.JPG','A','A','1','1','20080086'),(87,1,1,1,1,1013,1,'Jorge Antonio','JIMÉNEZ  RIVADENEIRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080087.JPG','A','A','1','1','20080087'),(88,1,1,1,1,1013,1,'Kevin Andrés','JURADO  MARTÍNEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080088.JPG','A','A','1','1','20080088'),(89,1,1,1,1,1013,1,'Anderson Steve','LARA  PROAÑO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080089.JPG','A','A','1','1','20080089'),(90,1,1,1,1,1013,1,'Jesús Nicolás','LARCO  COLOMA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080090.JPG','A','A','1','1','20080090'),(91,1,1,1,1,1013,1,'Erick Santiago','LÓPEZ  CAMPAÑA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080091.JPG','A','A','1','1','20080091'),(92,1,1,1,1,1013,1,'José Alejandro','LÓPEZ  DÍAZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080092.JPG','A','A','1','1','20080092'),(93,1,1,1,1,1013,1,'Pablo Esteban','LÓPEZ  LÓPEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080093.JPG','A','A','1','1','20080093'),(94,1,1,1,1,1013,1,'Ricardo Daniel','LÓPEZ  MIER','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080094.JPG','A','A','1','1','20080094'),(95,1,1,1,1,1013,1,'José Francisco','LUNA  FLORES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080095.JPG','A','A','1','1','20080095'),(96,1,1,1,1,1013,1,'Hugo Andrés','LUZURIAGA  TAPIA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080096.JPG','A','A','1','1','20080096'),(97,1,1,1,1,1013,1,'Wladimir Humberto','MAFLA  QUEZADA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080097.JPG','A','A','1','1','20080097'),(98,1,1,1,1,1013,1,'Alfredo Esteban','MARCILLO  QUIÑONES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080098.JPG','A','A','1','1','20080098'),(99,1,1,1,1,1013,1,'Henry Santiago','MARTÍNEZ  ORTEGA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080099.JPG','A','A','1','1','20080099'),(100,1,1,1,1,1013,1,'Pablo Sebastián','MASACHE  HEREDIA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080100.JPG','A','A','1','1','20080100'),(101,1,1,1,1,1013,1,'Mauricio Sebastián','MAYORGA  GUERRERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080101.JPG','A','A','1','1','20080101'),(102,1,1,1,1,1013,1,'Miguel Enrique','MEJÍA  PAILLACHO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080102.JPG','A','A','1','1','20080102'),(103,1,1,1,1,1013,1,'Anthony Gonzalo','MÉNDEZ  CULQUI','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080103.JPG','A','A','1','1','20080103'),(104,1,1,1,1,1013,1,'José Enrique','MÉNDEZ  ZAMBRANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080104.JPG','A','A','1','1','20080104'),(105,1,1,1,1,1013,1,'Brisney David','MOLINA  COELLO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080105.JPG','A','A','1','1','20080105'),(106,1,1,1,1,1013,1,'Pedro Francisco','MONCAYO  TAPIA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080106.JPG','A','A','1','1','20080106'),(107,1,1,1,1,1013,1,'Alex Fernando','MONTENEGRO  ALMEIDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080107.JPG','A','A','1','1','20080107'),(108,1,1,1,1,1013,1,'James Sebastián','MONTENEGRO  GALLARDO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080108.JPG','A','A','1','1','20080108'),(109,1,1,1,1,1013,1,'Esteban Alejandro','MOSCOSO  PINTO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080109.JPG','A','A','1','1','20080109'),(110,1,1,1,1,1013,1,'Mateo Javier','MOSCOSO  VÁSCONEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080110.JPG','A','A','1','1','20080110'),(111,1,1,1,1,1013,1,'Héctor David','MOYA  LÓPEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080111.JPG','A','A','1','1','20080111'),(112,1,1,1,1,1013,1,'Diego José','MOYA  SOLEDISPA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080112.JPG','A','A','1','1','20080112'),(113,1,1,1,1,1013,1,'Gustavo Israel','MUÑOZ  TRUJILLO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080113.JPG','A','A','1','1','20080113'),(114,1,1,1,1,1013,1,'Juan Francisco','NARANJO  FIGUEROA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080114.JPG','A','A','1','1','20080114'),(115,1,1,1,1,1013,1,'Jorge Luis','NARANJO  SÁNCHEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080115.JPG','A','A','1','1','20080115'),(116,1,1,1,1,1013,1,'William Miguel','NINAHUALPA  ALMACHI','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080116.JPG','A','A','1','1','20080116'),(117,1,1,1,1,1013,1,'Andrés Sebastián','NOROÑA  ZAMBONINO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080117.JPG','A','A','1','1','20080117'),(118,1,1,1,1,1013,1,'Carlos David','OBANDO  SANIPATÍN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080118.JPG','A','A','1','1','20080118'),(119,1,1,1,1,1013,1,'Erick Sebastián','OCAÑA  MANZANO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080119.JPG','A','A','1','1','20080119'),(120,1,1,1,1,1013,1,'Erick Gabriel','ONTANEDA  LOZA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080120.JPG','A','A','1','1','20080120'),(121,1,1,1,1,1013,1,'Jossua David','ORELLANA  GUEVARA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080121.JPG','A','A','1','1','20080121'),(122,1,1,1,1,1013,1,'David Fabricio','OSORIO  OVIEDO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080122.JPG','A','A','1','1','20080122'),(123,1,1,1,1,1013,1,'Marco Alejandro','PACHECO  RIVERA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080123.JPG','A','A','1','1','20080123'),(124,1,1,1,1,1013,1,'Juan Pablo','PADRÓN  NICOLALDE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080124.JPG','A','A','1','1','20080124'),(125,1,1,1,1,1013,1,'Nicolás Ismael','PÁEZ  LÓPEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080125.JPG','A','A','1','1','20080125'),(126,1,1,1,1,1013,1,'Jonathan Fabricio','PAREDES  PAREDES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080126.JPG','A','A','1','1','20080126'),(127,1,1,1,1,1013,1,'Paúl Andrés','PAREDES  RODRÍGUEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080127.JPG','A','A','1','1','20080127'),(128,1,1,1,1,1013,1,'Carlos Gabriel','PAVÓN  PIEDRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080128.JPG','A','A','1','1','20080128'),(129,1,1,1,1,1013,1,'Patricio Gabriel','PAZ  BRAVO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080129.JPG','A','A','1','1','20080129'),(130,1,1,1,1,1013,1,'Santiago Daniel','PAZMIÑO  PÉREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080130.JPG','A','A','1','1','20080130'),(131,1,1,1,1,1013,1,'Sebastián Alejandro','PÉREZ  JARRÍN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080131.JPG','A','A','1','1','20080131'),(132,1,1,1,1,1013,1,'Bryan Alexander','PÉREZ  PINTADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080132.JPG','A','A','1','1','20080132'),(133,1,1,1,1,1013,1,'Josue Nicolás','PINTO  GUALPA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080133.JPG','A','A','1','1','20080133'),(134,1,1,1,1,1013,1,'Leandro Isaac','PONCE  CEVALLOS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080134.JPG','A','A','1','1','20080134'),(135,1,1,1,1,1013,1,'David Israel','POZO  PARRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080135.JPG','A','A','1','1','20080135'),(136,1,1,1,1,1013,1,'Alan David','PROCEL  MEDINA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080136.JPG','A','A','1','1','20080136'),(137,1,1,1,1,1013,1,'Santiago Gabriel','PROAÑO  MORA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080137.JPG','A','A','1','1','20080137'),(138,1,1,1,1,1013,1,'Brandon Arón','PUEBLA  TORRES','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080138.JPG','A','A','1','1','20080138'),(139,1,1,1,1,1013,1,'Kevin Santiago','PUENTE  VEGA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080139.JPG','A','A','1','1','20080139'),(140,1,1,1,1,1013,1,'Cristian Alexis','QUISILEMA  PULUPA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080140.JPG','A','A','1','1','20080140'),(141,1,1,1,1,1013,1,'José Reinaldo','RAMÍREZ  ALMEIDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080141.JPG','A','A','1','1','20080141'),(142,1,1,1,1,1013,1,'Luis Alberto','RENGIFO  VÁSCONEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080142.JPG','A','A','1','1','20080142'),(143,1,1,1,1,1013,1,'Jefferson Alfredo','REVELO  GUTIÉRREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080143.JPG','A','A','1','1','20080143'),(144,1,1,1,1,1013,1,'Josué','ROBALINO  ORTIZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080144.JPG','A','A','1','1','20080144'),(145,1,1,1,1,1013,1,'Mario Sebastián','RODRÍGUEZ  ÁLVAREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080145.JPG','A','A','1','1','20080145'),(146,1,1,1,1,1013,1,'Sebastián','RODRÍGUEZ  RAZA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080146.JPG','A','A','1','1','20080146'),(147,1,1,1,1,1013,1,'Juan Sebastián','RODRÍGUEZ  VILLAGÓMEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080147.JPG','A','A','1','1','20080147'),(148,1,1,1,1,1013,1,'Juan Francisco','RODRÍGUEZ  VIVAR','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080148.JPG','A','A','1','1','20080148'),(149,1,1,1,1,1013,1,'Sebastián Alejandro','ROJAS  FERNÁNDEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080149.JPG','A','A','1','1','20080149'),(150,1,1,1,1,1013,1,'Steve Alexander','ROJAS  PONCE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080150.JPG','A','A','1','1','20080150'),(151,1,1,1,1,1013,1,'Giani Paúl','RODRÍGUEZ  MORENO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080151.JPG','A','A','1','1','20080151'),(152,1,1,1,1,1013,1,'Jorge Francisco','ROMÁN  MEJÍA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080152.JPG','A','A','1','1','20080152'),(153,1,1,1,1,1013,1,'Jonathan Alejandro','ROMERO  ALDAZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080153.JPG','A','A','1','1','20080153'),(154,1,1,1,1,1013,1,'Jaime Andrés','ROMERO  CORONEL','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080154.JPG','A','A','1','1','20080154'),(155,1,1,1,1,1013,1,'Emilio José','ROMERO  GÓMEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080155.JPG','A','A','1','1','20080155'),(156,1,1,1,1,1013,1,'Mauricio Hernán','ROMERO  ROMERO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080156.JPG','A','A','1','1','20080156'),(157,1,1,1,1,1013,1,'Andrés Sebastián','ROSALES  RIVADENEIRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080157.JPG','A','A','1','1','20080157'),(158,1,1,1,1,1013,1,'Nicolás Alejandro','ROSERO  BASTIDAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080158.JPG','A','A','1','1','20080158'),(159,1,1,1,1,1013,1,'Andrés Eduardo','ROSERO  RAMÍREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080159.JPG','A','A','1','1','20080159'),(160,1,1,1,1,1013,1,'Fabio Danniel','RUIZ  PAZMIÑO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080160.JPG','A','A','1','1','20080160'),(161,1,1,1,1,1013,1,'Carlos Andrés','SÁENZ  PEÑAFIEL','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080161.JPG','A','A','1','1','20080161'),(162,1,1,1,1,1013,1,'Ronny Alejandro','SALAZAR  MARTÍNEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080162.JPG','A','A','1','1','20080162'),(163,1,1,1,1,1013,1,'Oscar Daniel','SÁNCHEZ  MALDONADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080163.JPG','A','A','1','1','20080163'),(164,1,1,1,1,1013,1,'Álvaro Steve','SANTACRUZ  ARMAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080164.JPG','A','A','1','1','20080164'),(165,1,1,1,1,1013,1,'Sebastián Alejandro','SARZOSA  SAMANIEGO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080165.JPG','A','A','1','1','20080165'),(166,1,1,1,1,1013,1,'Emilio Roberto','SHIVE  DELGADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080166.JPG','A','A','1','1','20080166'),(167,1,1,1,1,1013,1,'Jorge Luis','SIMBAÑA  BALSECA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080167.JPG','A','A','1','1','20080167'),(168,1,1,1,1,1013,1,'Bryan Roberto','SOLÍS  MINDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080168.JPG','A','A','1','1','20080168'),(169,1,1,1,1,1013,1,'Pablo Ricardo','SOSA  IRIARTE','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080169.JPG','A','A','1','1','20080169'),(170,1,1,1,1,1013,1,'Carlos David','SOSA  ZURITA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080170.JPG','A','A','1','1','20080170'),(171,1,1,1,1,1013,1,'Jonathan Fabricio','TAMAYO  VACA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080171.JPG','A','A','1','1','20080171'),(172,1,1,1,1,1013,1,'Kelvi Joao','TIPANTUÑA  QUEZADA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080172.JPG','A','A','1','1','20080172'),(173,1,1,1,1,1013,1,'Alejandro Sebastián','TOBAR  ULLAURI','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080173.JPG','A','A','1','1','20080173'),(174,1,1,1,1,1013,1,'Bryan Steve','TORRES  RIVERA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080174.JPG','A','A','1','1','20080174'),(175,1,1,1,1,1013,1,'Alex Mateo','TORRES  VEGA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080175.JPG','A','A','1','1','20080175'),(176,1,1,1,1,1013,1,'Danny Alejandro','TORRES  VERGARA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080176.JPG','A','A','1','1','20080176'),(177,1,1,1,1,1013,1,'Erick Sebastián','TULCANAZA  CAMACHO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080177.JPG','A','A','1','1','20080177'),(178,1,1,1,1,1013,1,'Juan Pablo','ULLOA  HURTADO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080178.JPG','A','A','1','1','20080178'),(179,1,1,1,1,1013,1,'Jonathan Marcelo','UNAPUCHA  PARDO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080179.JPG','A','A','1','1','20080179'),(180,1,1,1,1,1013,1,'Luis Andrés','URBINA  BASTIDAS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080180.JPG','A','A','1','1','20080180'),(181,1,1,1,1,1013,1,'Jorge David','VACA  HERNÁNDEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080181.JPG','A','A','1','1','20080181'),(182,1,1,1,1,1013,1,'Alan Martín','VACA  QUIGUANGO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080182.JPG','A','A','1','1','20080182'),(183,1,1,1,1,1013,1,'Víctor Manuel','VALDEZ  JÁCOME','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080183.JPG','A','A','1','1','20080183'),(184,1,1,1,1,1013,1,'Renato Oswaldo','VALDIVIESO  CASTILLO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080184.JPG','A','A','1','1','20080184'),(185,1,1,1,1,1013,1,'Luis Alejandro','VALENCIA  VILLACÍS','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080185.JPG','A','A','1','1','20080185'),(186,1,1,1,1,1013,1,'Anthony Sebastián','VALLEJO  GUERRA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080186.JPG','A','A','1','1','20080186'),(187,1,1,1,1,1013,1,'David Javier','VARGAS  VACA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080187.JPG','A','A','1','1','20080187'),(188,1,1,1,1,1013,1,'Kevin Santiago','VEGA  MIRANDA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080188.JPG','A','A','1','1','20080188'),(189,1,1,1,1,1013,1,'Bagner Israel','VILLACÍS  ÁLVAREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080189.JPG','A','A','1','1','20080189'),(190,1,1,1,1,1013,1,'Esteban Guillermo','VILLACRÉS  LOZADA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080190.JPG','A','A','1','1','20080190'),(191,1,1,1,1,1013,1,'David Alejandro','VILLAMARÍN  PAZMIÑO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080191.JPG','A','A','1','1','20080191'),(192,1,1,1,1,1013,1,'Bernardo Joseph','VILLEGAS  MORENO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080192.JPG','A','A','1','1','20080192'),(193,1,1,1,1,1013,1,'Nelson Andrés','VILLEGAS  PÉREZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080193.JPG','A','A','1','1','20080193'),(194,1,1,1,1,1013,1,'Benjamín Alexander','VITERI  MARTÍNEZ','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080194.JPG','A','A','1','1','20080194'),(195,1,1,1,1,1013,1,'Danilo Patricio','YAMBAY  TIPÁN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080195.JPG','A','A','1','1','20080195'),(196,1,1,1,1,1013,1,'Ariel Sebastián','YÁNEZ  CACUANGO','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080196.JPG','A','A','1','1','20080196'),(197,1,1,1,1,1013,1,'Juan Sebastián','ZAPATA  JARA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080197.JPG','A','A','1','1','20080197'),(198,1,1,1,1,1013,1,'Mario Esteban','ZAPATA  RAMÓN','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080198.JPG','A','A','1','1','20080198'),(199,1,1,1,1,1013,1,'Luis Alfredo','ZÚÑIGA  DAZA','C','','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20080199.JPG','A','A','1','1','20080199'),(200,1,1,1,1,1013,1,'Patricio Andrés','ACOSTA  CASCANTE','C','1720983467','0000-00-00','EMILIO ZOLA E8-32 Y SHYRIS','aaa@csgabriel.edu.ec','2444893',1,'P','0000-00-00','','0000-00-00','20070001.JPG','A','A','1','1','20070001'),(201,1,1,1,1,1013,1,'Emilio Xavier','AGUILAR  MEDINA','C','1720247368','0000-00-00','CONJ.BENALCAZAR ORIENTAL C-8. A.SIERRA Y V.CRUZ','aaa@csgabriel.edu.ec','3228565',1,'P','0000-00-00','','0000-00-00','20070002.JPG','A','A','1','1','20070002'),(202,1,1,1,1,1013,1,'César David','AGUIRRE  MONTES','C','1719088039','0000-00-00','URB.HERNANDO PARRA MZ-D.16 CARAPUNGO','aaa@csgabriel.edu.ec','2420554',1,'P','0000-00-00','','0000-00-00','20070003.JPG','A','A','1','1','20070003'),(203,1,1,1,1,1013,1,'Daniel Alejandro','AILLÓN  CALLE','C','1104554116','2035-06-01','AV. AMÉRICA N34-461 Y VERACRUZ','aaa@csgabriel.edu.ec','3319592',1,'P','0000-00-00','','0000-00-00','20070004.JPG','A','A','1','1','20070004'),(204,1,1,1,1,1013,1,'Jaime Andrés','ALDAZ  ALVARADO','C','1723790968','2035-01-04','SELVA ALEGRE OE 8107 Y NIETO POLO','aaa@csgabriel.edu.ec','2130351',1,'P','0000-00-00','','0000-00-00','20070005.JPG','A','A','1','1','20070005'),(205,1,1,1,1,1013,1,'Iván Mateo','ANDRADE  MERA','C','1722622584','0000-00-00','URB.LA COLINA LOJA 252. SAN RAFAEL','aaa@csgabriel.edu.ec','2338756',1,'P','0000-00-00','','0000-00-00','20070006.JPG','A','A','1','1','20070006'),(206,1,1,1,1,1013,1,'Miguel Alejandro','ARAUJO  NAVAS','C','1718171232','2035-00-03','PAS. B. E13-52 Y GUAYACANES. EL EDÉN','aaa@csgabriel.edu.ec','2411144',1,'P','0000-00-00','','0000-00-00','20070007.JPG','A','A','1','1','20070007'),(207,1,1,1,1,1013,1,'Cristhian Jaime','ARTEAGA  VALLES','C','1717224750','2035-03-08','CUICOCHA 640 Y SANTA TERESA','aaa@csgabriel.edu.ec','2599710',1,'P','0000-00-00','','0000-00-00','20070008.JPG','A','A','1','1','20070008'),(208,1,1,1,1,1013,1,'Carlos Andrés','BASTIDAS  BARAHONA','C','1722691209','0000-00-00','LOS ARUPOS 154 Y TULIPANES','aaa@csgabriel.edu.ec','2472490',1,'P','0000-00-00','','0000-00-00','20070009.JPG','A','A','1','1','20070009'),(209,1,1,1,1,1013,1,'David Estuardo','BAZANTE  DEL POZO','C','201577780','2035-00-02','JUAN ALZURO N50-185 Y ÁLAMOS','aaa@csgabriel.edu.ec','2402559',1,'P','0000-00-00','','0000-00-00','20070010.JPG','A','A','1','1','20070010'),(210,1,1,1,1,1013,1,'Pablo Andrés','BENALCÁZAR  ORBE','C','1719895896','0000-00-00','SIMÓN BOLÍVAR 857. GUAYLLABAMBA','aaa@csgabriel.edu.ec','2368142',1,'P','0000-00-00','','0000-00-00','20070011.JPG','A','A','1','1','20070011'),(211,1,1,1,1,1013,1,'Jorge Xavier','BENAVIDES  MARTÍNEZ','C','1721350450','0000-00-00','ANDAGOYA 126 Y MONTES','aaa@csgabriel.edu.ec','2558846',1,'P','0000-00-00','','0000-00-00','20070012.JPG','A','A','1','1','20070012'),(212,1,1,1,1,1013,1,'Steven Alejandro','BENÍTEZ  REASCOS','C','1719183491','0000-00-00','CARCELÉN. URB.MASTODONTES BL-14 D-3.B','aaa@csgabriel.edu.ec','3443757',1,'P','0000-00-00','','0000-00-00','20070013.JPG','A','A','1','1','20070013'),(213,1,1,1,1,1013,1,'Erick Francisco','BENÍTEZ  VARGAS','C','1724051949','0000-00-00','LOS CEDROS OE252 Y ORIANGA','aaa@csgabriel.edu.ec','2485142',1,'P','0000-00-00','','0000-00-00','20070014.JPG','A','A','1','1','20070014'),(214,1,1,1,1,1013,1,'Alfonso David','BONIFAZ  ZANAFRIA','C','1721597456','0000-00-00','HUACHI N64-65 Y JUAN FIGUEROA','aaa@csgabriel.edu.ec','2531712',1,'P','0000-00-00','','0000-00-00','20070015.JPG','A','A','1','1','20070015'),(215,1,1,1,1,1013,1,'Carl Emil','BRANDT  RAMÍREZ','C','1716647472','2035-04-05','AV.LOS CONQUISTADORES E15-6. LA FLORESTA','aaa@csgabriel.edu.ec','2560451',1,'P','0000-00-00','','0000-00-00','20070016.JPG','A','A','1','1','20070016'),(216,1,1,1,1,1013,1,'José Guillermo','BRAZZERO  PRÓCEL','C','502508799','0000-00-00','ATACAZO 424 Y OLMEDO. SANGOLQUÍ.','aaa@csgabriel.edu.ec','2400682',1,'P','0000-00-00','','0000-00-00','20070017.JPG','A','A','1','1','20070017'),(217,1,1,1,1,1013,1,'Mauricio Sebastián','BURBANO  TUMIPAMBA','C','1723792741','0000-00-00','CONJ. ARCOS NORTE #36. PANA. NORTE','aaa@csgabriel.edu.ec','2428920',1,'P','0000-00-00','','0000-00-00','20070018.JPG','A','A','1','1','20070018'),(218,1,1,1,1,1013,1,'Daniel Sebastián','BUSTOS  PAREDES','C','1722525308','0000-00-00','LA LUZ C-J D-26.FRANCISCO GUARDERAS Y BUSTAMANTE','aaa@csgabriel.edu.ec','2400482',1,'P','0000-00-00','','0000-00-00','20070019.JPG','A','A','1','1','20070019'),(219,1,1,1,1,1013,1,'Andrés Gerardo','CABRERA  VALENCIA','C','1716825243','0000-00-00','MACHALA N67-87 Y CUICOCHA','aaa@csgabriel.edu.ec','2537058',1,'P','0000-00-00','','0000-00-00','20070020.JPG','A','A','1','1','20070020'),(220,1,1,1,1,1013,1,'Xavier Alejandro','CÁCERES  SAGBAY','C','1723345847','0000-00-00','MIGUEL ÁNGEL 237 Y LEONARDO DAVINCE','aaa@csgabriel.edu.ec','2893230',1,'P','0000-00-00','','0000-00-00','20070021.JPG','A','A','1','1','20070021'),(221,1,1,1,1,1013,1,'Javier Ignacio','CADENA  ACOSTA','C','1716394323','2035-04-05','25 DE MAYO 299 Y DANIEL GARZÓN','aaa@csgabriel.edu.ec','2595484',1,'P','0000-00-00','','0000-00-00','20070022.JPG','A','A','1','1','20070022'),(222,1,1,1,1,1013,1,'Santiago André','CADENA  ULLAURI','C','1724221781','0000-00-00','URB. EL PORTAL. SAN JOSÉ # 1','aaa@csgabriel.edu.ec','2826607',1,'P','0000-00-00','','0000-00-00','20070023.JPG','A','A','1','1','20070023'),(223,1,1,1,1,1013,1,'Estéfano Andrés','CALDERÓN  BORJA','C','1715909220','0000-00-00','J.GONZÁLEZ 3576. ED.KAROLINA PLAZA D-35','aaa@csgabriel.edu.ec','2240255',1,'P','0000-00-00','','0000-00-00','20070024.JPG','A','A','1','1','20070024'),(224,1,1,1,1,1013,1,'Marcos Andrés','CÁRDENAS  BURBANO','C','1723906671','0000-00-00','AUTOP.RUMIÑAHUI PUENTE 6 CONJ.PANAM. C-11','aaa@csgabriel.edu.ec','22542206',1,'P','0000-00-00','','0000-00-00','20070025.JPG','A','A','1','1','20070025'),(225,1,1,1,1,1013,1,'Juan Francisco','CÁRDENAS  TRUJILLO','C','1723836571','0000-00-00','AV.JIPIJAPA S 11-63 Y M.RODRÍGUEZ','aaa@csgabriel.edu.ec','2649094',1,'P','0000-00-00','','0000-00-00','20070026.JPG','A','A','1','1','20070026'),(226,1,1,1,1,1013,1,'Juan Fernando','CARRILLO  PORTILLA','C','1717536682','0000-00-00','ENRIQUE RITTER Y BENJAMÍN CHÁVEZ OE9-128','aaa@csgabriel.edu.ec','2520267',1,'P','0000-00-00','','0000-00-00','20070027.JPG','A','A','1','1','20070027'),(227,1,1,1,1,1013,1,'Rodny Andrés','CARVAJAL  DE LA SOTA','C','1722069950','0000-00-00','PAS- 2 CASA N22-36 Y LUGO','aaa@csgabriel.edu.ec','3227458',1,'P','0000-00-00','','0000-00-00','20070028.JPG','A','A','1','1','20070028'),(228,1,1,1,1,1013,1,'Ángel Jonathan','CARVAJAL  ENDARA','C','1723738413','0000-00-00','CRISTOBAL SANDOVAL OE 4-44 Y BRASIL','aaa@csgabriel.edu.ec','2243089',1,'P','0000-00-00','','0000-00-00','20070029.JPG','A','A','1','1','20070029'),(229,1,1,1,1,1013,1,'Washington Wladimir','CASAMEN  NOLASCO','C','1723476832','0000-00-00','PORTOVIEJO OE1-29 Y 10 DE AGOSTO','aaa@csgabriel.edu.ec','2550324',1,'P','0000-00-00','','0000-00-00','20070030.JPG','A','A','1','1','20070030'),(230,1,1,1,1,1013,1,'José Andrés','CARTAGENOVA  NOVOA','C','1723925069','0000-00-00','URB.JARDINES DE AMAGASI C-33','aaa@csgabriel.edu.ec','3280105',1,'P','0000-00-00','','0000-00-00','20070031.JPG','A','A','1','1','20070031'),(231,1,1,1,1,1013,1,'Kevin Vicente','CAZCO  CHIRIBOGA','C','1716367410','0000-00-00','JORGE PIEDRA 1500 Y AV.OCCIDENTAL','aaa@csgabriel.edu.ec','2599000',1,'P','0000-00-00','','0000-00-00','20070032.JPG','A','A','1','1','20070032'),(232,1,1,1,1,1013,1,'Oscar David','CEDEÑO  DÍAZ','C','1722440730','0000-00-00','LOS NARANJOS N44-88 Y GRANADOS. EL BATÁN','aaa@csgabriel.edu.ec','3342172',1,'P','0000-00-00','','0000-00-00','20070033.JPG','A','A','1','1','20070033'),(233,1,1,1,1,1013,1,'Ricardo Daniel','CERVANTES  CHÁVEZ','C','1723961064','2035-08-05','CONJ.MIRADOR DEL BOSQUE. C-47. M.VALDEZ Y M.OCHOA','aaa@csgabriel.edu.ec','2541288',1,'P','0000-00-00','','0000-00-00','20070034.JPG','A','A','1','1','20070034'),(234,1,1,1,1,1013,1,'Walter Leonardo','CEVALLOS  BÉJAR','C','1717317430','0000-00-00','ARICA 313 Y ZAPOTAL','aaa@csgabriel.edu.ec','2842110',1,'P','0000-00-00','','0000-00-00','20070035.JPG','A','A','1','1','20070035'),(235,1,1,1,1,1013,1,'Andrés Paúl','CEVALLOS  CASTRO','C','1717773541','2035-00-01','DOS HEMISFERIOS MZ-4 C-18. PUSUQUÍ.','aaa@csgabriel.edu.ec','2351862',1,'P','0000-00-00','','0000-00-00','20070036.JPG','A','A','1','1','20070036'),(236,1,1,1,1,1013,1,'Ricardo David','CHÁVEZ  CASTILLO','C','1722124177','0000-00-00','QUITUMBE 6007 Y AV. DEL MAESTRO','aaa@csgabriel.edu.ec','2533251',1,'P','0000-00-00','','0000-00-00','20070037.JPG','A','A','1','1','20070037'),(237,1,1,1,1,1013,1,'Eduardo','CHÁVEZ  HEREDIA','C','1720759941','0000-00-00','MULTIF.SANTA ANITA BL.14 D-101','aaa@csgabriel.edu.ec','2665041',1,'P','0000-00-00','','0000-00-00','20070038.JPG','A','A','1','1','20070038'),(238,1,1,1,1,1013,1,'Sebastián Nicolás','CHICO  PROAÑO','C','1724079361','0000-00-00','AV.REAL AUDIENCIA 2969 Y AV. DEL MAESTRO','aaa@csgabriel.edu.ec','2591946',1,'P','0000-00-00','','0000-00-00','20070039.JPG','A','A','1','1','20070039'),(239,1,1,1,1,1013,1,'Edwin Alexis','CHISAGUANO  GARCÍA','C','1723300537','0000-00-00','JUAN FIGUEROA 2515 Y VALLEJO','aaa@csgabriel.edu.ec','2599031',1,'P','0000-00-00','','0000-00-00','20070040.JPG','A','A','1','1','20070040'),(240,1,1,1,1,1013,1,'Erick Leonardo','COLLAGUAZO  GUACHAMÍN','C','1724055213','0000-00-00','JOEL MONROY 605 Y ONTANEDA','aaa@csgabriel.edu.ec','2522763',1,'P','0000-00-00','','0000-00-00','20070041.JPG','A','A','1','1','20070041'),(241,1,1,1,1,1013,1,'Emilio Sebastián','CONDE  LUDEÑA','C','1719993105','0000-00-00','AV.LUIS CORDERO 697 Y L.MERCADO. SANGOLQUÍ','aaa@csgabriel.edu.ec','2334178',1,'P','0000-00-00','','0000-00-00','20070042.JPG','A','A','1','1','20070042'),(242,1,1,1,1,1013,1,'Álvaro Eduardo','CORREA  GALARZA','C','1717270399','0000-00-00','GREGORIO MUNGA N39-66. EL BATÁN','aaa@csgabriel.edu.ec','2437136',1,'P','0000-00-00','','0000-00-00','20070043.JPG','A','A','1','1','20070043'),(243,1,1,1,1,1013,1,'Felipe Andrés','DÍAZ  ESCOBAR','C','1721298170','0000-00-00','ZÁPAROS N 502-40 Y H.SALAS','aaa@csgabriel.edu.ec','2438862',1,'P','0000-00-00','','0000-00-00','20070044.JPG','A','A','1','1','20070044'),(244,1,1,1,1,1013,1,'Christian Alejandro','DÍAZ  FLORES','C','1722773254','0000-00-00','URB.SAN FRANCISCO PERÓN 129 CALLE J #106','aaa@csgabriel.edu.ec','2339908',1,'P','0000-00-00','','0000-00-00','20070045.JPG','A','A','1','1','20070045'),(245,1,1,1,1,1013,1,'Gonzalo Francisco','DOMÍNGUEZ  ROMÁN','C','1722557145','0000-00-00','BUSTAMANTE 450 Y MURIALDO','aaa@csgabriel.edu.ec','2403508',1,'P','0000-00-00','','0000-00-00','20070046.JPG','A','A','1','1','20070046'),(246,1,1,1,1,1013,1,'Alejandro','ENRÍQUEZ  AGUAYO','C','1724186273','2035-00-02','LAS CASAS OE8-20 Y D.ESPINAR','aaa@csgabriel.edu.ec','2232995',1,'P','0000-00-00','','0000-00-00','20070047.JPG','A','A','1','1','20070047'),(247,1,1,1,1,1013,1,'Diego Alberto','ERAZO  MEDINA','C','1718027327','0000-00-00','LAS CASAS OE1-102 Y MONTES','aaa@csgabriel.edu.ec','2236863',1,'P','0000-00-00','','0000-00-00','20070048.JPG','A','A','1','1','20070048'),(248,1,1,1,1,1013,1,'Pablo Daniel','ESPÍN  CASTRO','C','1724106925','2035-07-00','TURUBAMBA BAJO OE 2H-S26 D# 145','aaa@csgabriel.edu.ec','2672269',1,'P','0000-00-00','','0000-00-00','20070049.JPG','A','A','1','1','20070049'),(249,1,1,1,1,1013,1,'Renato Daniel','ESTRADA  HERNÁNDEZ','C','1716362346','2035-00-09','QUITUS 982. CALDERÓN','aaa@csgabriel.edu.ec','2825152',1,'P','0000-00-00','','0000-00-00','20070050.JPG','A','A','1','1','20070050'),(250,1,1,1,1,1013,1,'Luis Esteban','ESTRELLA  APOLO','C','1724152051','0000-00-00','URB. JARDINES DE CARCELÉN C-71','aaa@csgabriel.edu.ec','242225',1,'P','0000-00-00','','0000-00-00','20070051.JPG','A','A','1','1','20070051'),(251,1,1,1,1,1013,1,'Alexander Marcelo','FABARA  VIZCAINO','C','503058745','0000-00-00','IGNACIO ASÍN N5146 Y VICENTE HEREDIA','aaa@csgabriel.edu.ec','2272542',1,'P','0000-00-00','','0000-00-00','20070052.JPG','A','A','1','1','20070052'),(252,1,1,1,1,1013,1,'Anthony Fernando','FÉLIX  ROMERO','C','1724195902','2035-11-03','AVEJIRAS Y ANONAS. CONJ.COLINAS DEL EDEN C-13','aaa@csgabriel.edu.ec','3264239',1,'P','0000-00-00','','0000-00-00','20070053.JPG','A','A','1','1','20070053'),(253,1,1,1,1,1013,1,'David Alejandro','FLORES  MOROCHO','C','1723487813','0000-00-00','IZIDRO LOZA C-4 Y DAVID LEDESMA','aaa@csgabriel.edu.ec','2597871',1,'P','0000-00-00','','0000-00-00','20070054.JPG','A','A','1','1','20070054'),(254,1,1,1,1,1013,1,'Dimitry David','FLORES  SALGADO','C','1723476287','0000-00-00','AV. BRASIL Y ZAMORA PAS. C # 70','aaa@csgabriel.edu.ec','2276065',1,'P','0000-00-00','','0000-00-00','20070055.JPG','A','A','1','1','20070055'),(255,1,1,1,1,1013,1,'Andrés Fernando','FONSECA  GALLEGOS','C','1717357832','0000-00-00','URB.LOS ARRAYANEZ MZ-21 CASA S13-93','aaa@csgabriel.edu.ec','2662266',1,'P','0000-00-00','','0000-00-00','20070056.JPG','A','A','1','1','20070056'),(256,1,1,1,1,1013,1,'Anthony Javier','GARCÍA  MÉNDEZ','C','1722346010','0000-00-00','SARAGURO 408 Y PIMAMPIRO. SAN BARTOLO','aaa@csgabriel.edu.ec','2678887',1,'P','0000-00-00','','0000-00-00','20070057.JPG','A','A','1','1','20070057'),(257,1,1,1,1,1013,1,'Diego Francisco','GARZÓN  FREIRE','C','1721031191','0000-00-00','INÉS GANGOTENA L-2. VALLE DE LOS CHILLOS','aaa@csgabriel.edu.ec','2337115',1,'P','0000-00-00','','0000-00-00','20070058.JPG','A','A','1','1','20070058'),(258,1,1,1,1,1013,1,'Edgar Sebastián','GÓMEZ  HINOSTROZA','C','1717870644','0000-00-00','GONZALO PINTO N59-55','aaa@csgabriel.edu.ec','2534116',1,'P','0000-00-00','','0000-00-00','20070060.JPG','A','A','1','1','20070060'),(259,1,1,1,1,1013,1,'Juan José','GRANJA  MOREANO','C','1722441787','0000-00-00','ED.ALMAGRO DORAL 2 D-75 Y BULGARIA','aaa@csgabriel.edu.ec','2562130',1,'P','0000-00-00','','0000-00-00','20070061.JPG','A','A','1','1','20070061'),(260,1,1,1,1,1013,1,'Alexis Fabricio','GUERRA  NAVARRETE','C','1719344796','2035-02-04','FRANCELANA N58-57 Y LEONARDO MURIALDO','aaa@csgabriel.edu.ec','3280021',1,'P','0000-00-00','','0000-00-00','20070062.JPG','A','A','1','1','20070062'),(261,1,1,1,1,1013,1,'Christian Andrés','GUERRERO  ROJAS','C','1104888225','0000-00-00','MADROÑOS 570 Y DE LOS LAURELES','aaa@csgabriel.edu.ec','2435746',1,'P','0000-00-00','','0000-00-00','20070063.JPG','A','A','1','1','20070063'),(262,1,1,1,1,1013,1,'Kevin Alexander','HERRERA  GAVILANES','C','1719181107','0000-00-00','PEDRO COLLAZO 163 Y BARTOLOMÉ ALBEZ','aaa@csgabriel.edu.ec','2664086',1,'P','0000-00-00','','0000-00-00','20070064.JPG','A','A','1','1','20070064'),(263,1,1,1,1,1013,1,'Steven David','HERRERA  MEDRANO','C','1719992388','2035-11-00','CONJ.ESTANCIA DE LA ARMENIA C-13. GUANGOPOLO KM 12','aaa@csgabriel.edu.ec','2073061',1,'P','0000-00-00','','0000-00-00','20070065.JPG','A','A','1','1','20070065'),(264,1,1,1,1,1013,1,'Daniel Ricardo','HIDALGO  BELTRÁN','C','1724154263','0000-00-00','LA PAMPA II. CALLE I C-72','aaa@csgabriel.edu.ec','2355809',1,'P','0000-00-00','','0000-00-00','20070066.JPG','A','A','1','1','20070066'),(265,1,1,1,1,1013,1,'Eduardo Esteban','JÁCOME  CARRIÓN','C','1717464992','0000-00-00','CIUDAD DEL SOL 188 Y M.CÓRDOVA GALARZA','aaa@csgabriel.edu.ec','3300600',1,'P','0000-00-00','','0000-00-00','20070067.JPG','A','A','1','1','20070067'),(266,1,1,1,1,1013,1,'Carlos Efraín','JAQUE  SIGCHA','C','1715907109','2035-03-09','JULIO RAMOS 461 Y ALAMOR. URB. ELOISA','aaa@csgabriel.edu.ec','2420203',1,'P','0000-00-00','','0000-00-00','20070068.JPG','A','A','1','1','20070068'),(267,1,1,1,1,1013,1,'Pablo Wladimir','JARAMILLO  REINOSO','C','1722195102','0000-00-00','ANTONIO SIERRA N17-25 Y JOSÉ TOBAR','aaa@csgabriel.edu.ec','2524183',1,'P','0000-00-00','','0000-00-00','20070069.JPG','A','A','1','1','20070069'),(268,1,1,1,1,1013,1,'César Andrés','LARREA  WOJCIK','C','1720728623','0000-00-00','MAGALLANES 195 Y EL ORO','aaa@csgabriel.edu.ec','3214089',1,'P','0000-00-00','','0000-00-00','20070070.JPG','A','A','1','1','20070070'),(269,1,1,1,1,1013,1,'Eddy Patricio','LINCANGO  NARANJO','C','1721441077','2035-01-08','CALIFORNIA S12 Y LOS DUQUES','aaa@csgabriel.edu.ec','2416387',1,'P','0000-00-00','','0000-00-00','20070071.JPG','A','A','1','1','20070071'),(270,1,1,1,1,1013,1,'Diego Fernando','LLERENA  RENGEL','C','1722637806','0000-00-00','AV.OCCIDENTAL Y LEGARDA. URB.PALERMO C-B.9','aaa@csgabriel.edu.ec','2449323',1,'P','0000-00-00','','0000-00-00','20070072.JPG','A','A','1','1','20070072'),(271,1,1,1,1,1013,1,'Dennis Roberto','LOGROÑO  SARMIENTO','C','1718042250','0000-00-00','CONJ.PULULAHUA C-56. SAN A. DE PICHINCHA','aaa@csgabriel.edu.ec','2397086',1,'P','0000-00-00','','0000-00-00','20070073.JPG','A','A','1','1','20070073'),(272,1,1,1,1,1013,1,'David Germán','LÓPEZ  HERRERA','C','1716638026','0000-00-00','MIGUEL ALONSO S8-316 Y SIG SIG','aaa@csgabriel.edu.ec','2619943',1,'P','0000-00-00','','0000-00-00','20070074.JPG','A','A','1','1','20070074'),(273,1,1,1,1,1013,1,'Galo Rodrigo','LÓPEZ  PEÑA','C','1723768097','0000-00-00','CARLOS JARRÍN S7-182 Y ALAQUEZ.CDLA.J.ARTEAGA','aaa@csgabriel.edu.ec','2661747',1,'P','0000-00-00','','0000-00-00','20070075.JPG','A','A','1','1','20070075'),(274,1,1,1,1,1013,1,'Diego Danilo','LÓPEZ  PICO','C','1718404302','0000-00-00','RIO PUCUNA N74-165 Y RIO BIGAL','aaa@csgabriel.edu.ec','2496842',1,'P','0000-00-00','','0000-00-00','20070076.JPG','A','A','1','1','20070076'),(275,1,1,1,1,1013,1,'Stephano Josue','LOZA  ESPINOZA','C','1716176664','0000-00-00','SANTIAGO 549 Y AV.AMÉRICA','aaa@csgabriel.edu.ec','2567049',1,'P','0000-00-00','','0000-00-00','20070077.JPG','A','A','1','1','20070077'),(276,1,1,1,1,1013,1,'Marco Andrei','LOZANO  DELGADO','C','1724056773','0000-00-00','CONJ.BALCONES DEL RECREO C-21. EL RECREO','aaa@csgabriel.edu.ec','2648136',1,'P','0000-00-00','','0000-00-00','20070078.JPG','A','A','1','1','20070078'),(277,1,1,1,1,1013,1,'Anddy Xavier','MALES  IZURIETA','C','1723557821','2035-03-07','MATILDE HUERTA OE 963 Y J.ESTRELLA','aaa@csgabriel.edu.ec','2627042',1,'P','0000-00-00','','0000-00-00','20070080.JPG','A','A','1','1','20070080'),(278,1,1,1,1,1013,1,'Ran Aron','MALKA  BUITRÓN','C','1717546772','0000-00-00','GENERAL ENRIQUEZ S/N. ISLA RÁBIDA. URB.CAPELO','aaa@csgabriel.edu.ec','2862825',1,'P','0000-00-00','','0000-00-00','20070081.JPG','A','A','1','1','20070081'),(279,1,1,1,1,1013,1,'Edmundo Nicolás','MANTILLA  SUÁREZ','C','1722696091','0000-00-00','ISLA PINZÓN N43-194','aaa@csgabriel.edu.ec','2450048',1,'P','0000-00-00','','0000-00-00','20070082.JPG','A','A','1','1','20070082'),(280,1,1,1,1,1013,1,'José Enrique','MARROQUÍN  ITAS','C','1723471387','2035-05-02','COND. EL INCA BL-8 D-18','aaa@csgabriel.edu.ec','2431588',1,'P','0000-00-00','','0000-00-00','20070083.JPG','A','A','1','1','20070083'),(281,1,1,1,1,1013,1,'Ricardo Patricio','MASACHE  POVEDA','C','1722441738','2035-03-06','MANUEL CAÑOLA E10-32','aaa@csgabriel.edu.ec','2813192',1,'P','0000-00-00','','0000-00-00','20070084.JPG','A','A','1','1','20070084'),(282,1,1,1,1,1013,1,'Danny Francisco','MAYORGA  RODRÍGUEZ','C','1724227192','0000-00-00','RITTER N24-73 Y LA GASCA','aaa@csgabriel.edu.ec','92746369',1,'P','0000-00-00','','0000-00-00','20070085.JPG','A','A','1','1','20070085'),(283,1,1,1,1,1013,1,'Humberto Danilo','MEDINA  JARAMILLO','C','503072860','0000-00-00','CONJ. TERRAZAS EINSTEIN C-94. CARCELÉN','aaa@csgabriel.edu.ec','2481858',1,'P','0000-00-00','','0000-00-00','20070086.JPG','A','A','1','1','20070086'),(284,1,1,1,1,1013,1,'Wilson Paúl','MELO  CÁRDENAS','C','1723818611','0000-00-00','COOP. IESS-FUT SM-3 MZ-E CASA 12','aaa@csgabriel.edu.ec','2963736',1,'P','0000-00-00','','0000-00-00','20070087.JPG','A','A','1','1','20070087'),(285,1,1,1,1,1013,1,'Patricio Andrés','MIÑO  ARBOLEDA','C','1724194772','0000-00-00','CONJ. EL PINAR','aaa@csgabriel.edu.ec','2425329',1,'P','0000-00-00','','0000-00-00','20070088.JPG','A','A','1','1','20070088'),(286,1,1,1,1,1013,1,'Diego Fernando','MONTENEGRO  COELLO','C','1724077050','0000-00-00','ARROYO DEL RÍO 337 Y MANUEL M. SÁNCHEZ','aaa@csgabriel.edu.ec','2247893',1,'P','0000-00-00','','0000-00-00','20070089.JPG','A','A','1','1','20070089'),(287,1,1,1,1,1013,1,'Sebastián Alejandro','MONTOYA  AUZ','C','1723921654','2035-02-03','BERNAL N51-84 Y AV.LA FLORIDA. CDLA. LA FLORIDA','aaa@csgabriel.edu.ec','2243188',1,'P','0000-00-00','','0000-00-00','20070090.JPG','A','A','1','1','20070090'),(288,1,1,1,1,1013,1,'David Leonel','MONTOYA  SALAZAR','C','1721522710','0000-00-00','LA MANÁ 376 Y GUANANDO','aaa@csgabriel.edu.ec','2624582',1,'P','0000-00-00','','0000-00-00','20070091.JPG','A','A','1','1','20070091'),(289,1,1,1,1,1013,1,'Christopher Israel','MORALES  ARÉVALO','C','1718934159','2035-06-05','CARLOS FREILE 2117. CHILLOGALLO','aaa@csgabriel.edu.ec','2961301',1,'P','0000-00-00','','0000-00-00','20070092.JPG','A','A','1','1','20070092'),(290,1,1,1,1,1013,1,'Bryan Eduardo','MORALES  COLOMA','C','1721344958','0000-00-00','CONJ.MARIANAS C-3. VÍA MARIANAS','aaa@csgabriel.edu.ec','2065574',1,'P','0000-00-00','','0000-00-00','20070093.JPG','A','A','1','1','20070093'),(291,1,1,1,1,1013,1,'Jonathan Gabriel','NARANJO  CUICHÁN','C','1723980528','0000-00-00','PAS.JUAN DEL SALTO OE1-70 Y PERO ALFARO. VILLAFLOR','aaa@csgabriel.edu.ec','2614529',1,'P','0000-00-00','','0000-00-00','20070095.JPG','A','A','1','1','20070095'),(292,1,1,1,1,1013,1,'Carlos Alfredo','NARANJO  ROQUE','C','1717999211','2035-11-01','MIGUEL MORENO N67-94 Y RAMÓN CHIRIBOGA','aaa@csgabriel.edu.ec','2599073',1,'P','0000-00-00','','0000-00-00','20070096.JPG','A','A','1','1','20070096'),(293,1,1,1,1,1013,1,'Gino Daniel','NAVARRETE  BORJA','C','1723421960','0000-00-00','POLIT LASSO 171 Y SELVA ALEGRE','aaa@csgabriel.edu.ec','2567760',1,'P','0000-00-00','','0000-00-00','20070097.JPG','A','A','1','1','20070097'),(294,1,1,1,1,1013,1,'Pablo Andrés','ORBE  ECHEVERRÍA','C','1721399119','0000-00-00','ESMERALDAS OE61-48 Y COTOPAXI','aaa@csgabriel.edu.ec','2958993',1,'P','0000-00-00','','0000-00-00','20070098.JPG','A','A','1','1','20070098'),(295,1,1,1,1,1013,1,'Carlos Eduardo','ORTEGA  CALDERÓN','C','1723268460','0000-00-00','QUITUS 741. LA MAGDALENA','aaa@csgabriel.edu.ec','2665499',1,'P','0000-00-00','','0000-00-00','20070099.JPG','A','A','1','1','20070099'),(296,1,1,1,1,1013,1,'Diego Rodrigo','ORTIZ  ESPINOSA','C','1723300255','0000-00-00','MELCHOR TOAZA Y SABANILLA ED.JIMENA II D-402','aaa@csgabriel.edu.ec','2478889',1,'P','0000-00-00','','0000-00-00','20070100.JPG','A','A','1','1','20070100'),(297,1,1,1,1,1013,1,'Jonathan Sebastián','ORTIZ  LARA','C','1723841381','0000-00-00','AV.QUITUS 955 CONJ.LA FLORENCIA. CALDERÓN','aaa@csgabriel.edu.ec','2022789',1,'P','0000-00-00','','0000-00-00','20070101.JPG','A','A','1','1','20070101'),(298,1,1,1,1,1013,1,'Byron Gabriel','ORTIZ  PADILLA','C','1720990280','0000-00-00','CARAPUNGO SM-A.4 MZ-S CASA 97','aaa@csgabriel.edu.ec','2424144',1,'P','0000-00-00','','0000-00-00','20070102.JPG','A','A','1','1','20070102'),(299,1,1,1,1,1013,1,'Ricardo Sebastián','ORTIZ  ROSAS','C','1717631517','0000-00-00','ANTONIO DE VILLAVICENCIO N55-114 Y CARLOS V','aaa@csgabriel.edu.ec','92720448',1,'P','0000-00-00','','0000-00-00','20070103.JPG','A','A','1','1','20070103'),(300,1,1,1,1,1013,1,'Jasson Javier','OSCULLO  YÉPEZ','C','1720892148','2035-03-04','PICHINCHA 505. SANGOLQUÍ','aaa@csgabriel.edu.ec','2334510',1,'P','0000-00-00','','0000-00-00','20070104.JPG','A','A','1','1','20070104'),(301,1,1,1,1,1013,1,'Juan Andrés','OSPINA  BRAENDLY','C','1719988014','2035-06-00','SAN MATEO L-11 Y SAN CAMILO','aaa@csgabriel.edu.ec','2825325',1,'P','0000-00-00','','0000-00-00','20070105.JPG','A','A','1','1','20070105'),(302,1,1,1,1,1013,1,'Diego Mauricio','PADILLA  ORTIZ','C','1724230675','0000-00-00','MIGUEL ZAMBRANO N56-196','aaa@csgabriel.edu.ec','2417447',1,'P','0000-00-00','','0000-00-00','20070106.JPG','A','A','1','1','20070106'),(303,1,1,1,1,1013,1,'Ayrton Fernando','PAZMIÑO  LESCANO','C','1719033639','2035-05-06','URB.LA COLINA 112. SANGOLQUÍ.','aaa@csgabriel.edu.ec','2080684',1,'P','0000-00-00','','0000-00-00','20070107.JPG','A','A','1','1','20070107'),(304,1,1,1,1,1013,1,'Joshua Gabriel','PEÑA  CASTILLO','C','1721708509','2035-00-04','AV.TNTE. HUGO ORTIZ OE5-76','aaa@csgabriel.edu.ec','2659384',1,'P','0000-00-00','','0000-00-00','20070108.JPG','A','A','1','1','20070108'),(305,1,1,1,1,1013,1,'David Alejandro','PÉREZ  VALLEJO','C','1723795132','0000-00-00','VERDE CRUZ Y ANTONIO SIERRA CASA 40','aaa@csgabriel.edu.ec','3228023',1,'P','0000-00-00','','0000-00-00','20070109.JPG','A','A','1','1','20070109'),(306,1,1,1,1,1013,1,'Luis Fernando','PILATASIG  PÉREZ','C','1721863403','2035-00-06','JUAN ALLAZAR Y ANDRÉS PÉREZ S028','aaa@csgabriel.edu.ec','2644194',1,'P','0000-00-00','','0000-00-00','20070110.JPG','A','A','1','1','20070110'),(307,1,1,1,1,1013,1,'Ramiro Isaac','PONCE  SÁNCHEZ','C','1719568907','2035-04-06','MACHALA Y PAS. #3 OE5-233. SAN PEDRO KLAVER','aaa@csgabriel.edu.ec','2291810',1,'P','0000-00-00','','0000-00-00','20070111.JPG','A','A','1','1','20070111'),(308,1,1,1,1,1013,1,'Hernán Mauricio','POZO  ÁLVARO','C','1724055106','2035-03-02','FERNANDO TINAJERO OE7-253','aaa@csgabriel.edu.ec','2596473',1,'P','0000-00-00','','0000-00-00','20070112.JPG','A','A','1','1','20070112'),(309,1,1,1,1,1013,1,'Paúl Alejandro','PROAÑO  POZO','C','1721780862','0000-00-00','ACUÑA 770 Y AMÉRICA','aaa@csgabriel.edu.ec','2904968',1,'P','0000-00-00','','0000-00-00','20070113.JPG','A','A','1','1','20070113'),(310,1,1,1,1,1013,1,'Germán David','RACINES  BONILLA','C','1722116090','2035-01-01','RODRIGO DE CHÁVEZ 551 Y PEDRO DE ALFARO','aaa@csgabriel.edu.ec','2651713',1,'P','0000-00-00','','0000-00-00','20070115.JPG','A','A','1','1','20070115'),(311,1,1,1,1,1013,1,'Andrés Enrique','RAMOS  TRAVEZ','C','1719561225','2035-05-09','JOSÉ ARTETA L-108 Y MACHALA','aaa@csgabriel.edu.ec','2495321',1,'P','0000-00-00','','0000-00-00','20070116.JPG','A','A','1','1','20070116'),(312,1,1,1,1,1013,1,'Pablo Martín','REYES  ANDRADE','C','1723115232','0000-00-00','CUERO Y CAICEDO 1180','aaa@csgabriel.edu.ec','2236077',1,'P','0000-00-00','','0000-00-00','20070117.JPG','A','A','1','1','20070117'),(313,1,1,1,1,1013,1,'Kennet Patricio','REYES  ESPARZA','C','1003483904','2035-09-07','ASUNCIÓN OE 916 Y BOMBONA','aaa@csgabriel.edu.ec','2235927',1,'P','0000-00-00','','0000-00-00','20070118.JPG','A','A','1','1','20070118'),(314,1,1,1,1,1013,1,'Pablo Andrés','RIVAS  FRANCO','C','1716183627','0000-00-00','MADRID Y TOLEDO D-5.B. CASA MADRID','aaa@csgabriel.edu.ec','2509761',1,'P','0000-00-00','','0000-00-00','20070119.JPG','A','A','1','1','20070119'),(315,1,1,1,1,1013,1,'Pablo Esteban','RIVERA  NARVÁEZ','C','1717412280','2035-12-02','MODESTO CHÁVEZ Y A.EINSTEIN CONJ.SOLAQUA C-24','aaa@csgabriel.edu.ec','2804659',1,'P','0000-00-00','','0000-00-00','20070120.JPG','A','A','1','1','20070120'),(316,1,1,1,1,1013,1,'Carlos Santiago','ROBLES  ROMERO','C','1723926935','2035-01-00','INDEPENDENCIA 144 Y BOMBONÁ. SAN JUAN','aaa@csgabriel.edu.ec','2582204',1,'P','0000-00-00','','0000-00-00','20070121.JPG','A','A','1','1','20070121'),(317,1,1,1,1,1013,1,'Paulo Andree','RODRÍGUEZ  LUNA','C','2100669130','2035-10-03','ALCÍVAR Y AV.BRASIL. CONJ.CIUDAD REAL C-5','aaa@csgabriel.edu.ec','2449737',1,'P','0000-00-00','','0000-00-00','20070122.JPG','A','A','1','1','20070122'),(318,1,1,1,1,1013,1,'David Alejandro','RODRÍGUEZ  SARZOSA','C','1724193568','2035-00-08','JOSÉ LUCUMA E6-175 Y PEDRO CORNELIO','aaa@csgabriel.edu.ec','2244859',1,'P','0000-00-00','','0000-00-00','20070123.JPG','A','A','1','1','20070123'),(319,1,1,1,1,1013,1,'Daniel Alexander','ROJAS  GAONA','C','1722652821','0000-00-00','CALLE 2A Y AV.JAIME R.AGUILERA N86-326.URB.MASTODO','aaa@csgabriel.edu.ec','2483594',1,'P','0000-00-00','','0000-00-00','20070124.JPG','A','A','1','1','20070124'),(320,1,1,1,1,1013,1,'Jack Marco','ROJAS  LOOR','C','1723000830','0000-00-00','AV. 6 DE DICIEMBRE Y PALMERAS 44-59','aaa@csgabriel.edu.ec','3342948',1,'P','0000-00-00','','0000-00-00','20070125.JPG','A','A','1','1','20070125'),(321,1,1,1,1,1013,1,'Pablo David','ROJAS  MEDINA','C','1723927073','0000-00-00','MUNIVE 531 Y DOMINGO ESPINAR','aaa@csgabriel.edu.ec','3202020',1,'P','0000-00-00','','0000-00-00','20070126.JPG','A','A','1','1','20070126'),(322,1,1,1,1,1013,1,'Miguel Esteban','ROMERO  MENESES','C','1716825797','2035-04-04','ESPINOZA AD-67 Y CARLOS V','aaa@csgabriel.edu.ec','2591327',1,'P','0000-00-00','','0000-00-00','20070128.JPG','A','A','1','1','20070128'),(323,1,1,1,1,1013,1,'Daniel Alejandro','ROMERO  SALAZAR','C','1724070907','0000-00-00','OBRERO INDEPENDIENTE. KM. 4.5 AUTOP. LOS CHILLOS','aaa@csgabriel.edu.ec','2607476',1,'P','0000-00-00','','0000-00-00','20070129.JPG','A','A','1','1','20070129'),(324,1,1,1,1,1013,1,'Damian Fernando','ROSALES  AILLÓN','C','1720549532','0000-00-00','CONJ.BAVARIA C-6. SAN RAFAEL','aaa@csgabriel.edu.ec','2850077',1,'P','0000-00-00','','0000-00-00','20070130.JPG','A','A','1','1','20070130'),(325,1,1,1,1,1013,1,'Christian Alejandro','ROSALES  RÍOS','C','1724018096','2035-03-00','CONJ.CASALES GABRIELA D-42 A.2 SOLANO Y LA CONDAMI','aaa@csgabriel.edu.ec','2540086',1,'P','0000-00-00','','0000-00-00','20070131.JPG','A','A','1','1','20070131'),(326,1,1,1,1,1013,1,'Jayro Johao','ROSERO  PILLAJO','C','1717843526','2035-08-04','ZARUMA S10-286 Y JOSÉ EGUSQUIZA. LA MAGDALENA','aaa@csgabriel.edu.ec','3102506',1,'P','0000-00-00','','0000-00-00','20070132.JPG','A','A','1','1','20070132'),(327,1,1,1,1,1013,1,'Mateo Alejandro','SALAZAR  SALAZAR','C','1724191653','2035-08-04','ÁNGEL LUDEÑA 838','aaa@csgabriel.edu.ec','2595447',1,'P','0000-00-00','','0000-00-00','20070133.JPG','A','A','1','1','20070133'),(328,1,1,1,1,1013,1,'Andrés Patricio','SÁNCHEZ  RUIZ','C','1719734939','2035-03-06','EDMUNDO CHIRIBOGA 753 Y SALAZAR','aaa@csgabriel.edu.ec','2240052',1,'P','0000-00-00','','0000-00-00','20070134.JPG','A','A','1','1','20070134'),(329,1,1,1,1,1013,1,'Diego Andrés','SANTIANA  CÓRDOVA','C','1718080078','0000-00-00','ROCAFUERTE Y PAS.E.ALFARO L-8. YARUQUÍ','aaa@csgabriel.edu.ec','2777744',1,'P','0000-00-00','','0000-00-00','20070135.JPG','A','A','1','1','20070135'),(330,1,1,1,1,1013,1,'Galo Javier','SILVA  MENDOZA','C','1721239539','0000-00-00','JOSÉ ARTETA N70-66 Y MACHALA','aaa@csgabriel.edu.ec','2496789',1,'P','0000-00-00','','0000-00-00','20070136.JPG','A','A','1','1','20070136'),(331,1,1,1,1,1013,1,'Christian Eduardo','SILVA  SAMANIEGO','C','1724192099','0000-00-00','URB.JARDINES DE CARCELÉN B-98','aaa@csgabriel.edu.ec','2428705',1,'P','0000-00-00','','0000-00-00','20070137.JPG','A','A','1','1','20070137'),(332,1,1,1,1,1013,1,'Sebastián Riquelme','SOLÍS  FRÍAS','C','1723828552','0000-00-00','SERAPIO JAPERAVI 1444 Y PAS. A-14','aaa@csgabriel.edu.ec','2626544',1,'P','0000-00-00','','0000-00-00','20070139.JPG','A','A','1','1','20070139'),(333,1,1,1,1,1013,1,'Marcelo David','SOLÓRZANO  FRANCO','C','1720160835','0000-00-00','MAXIMILIANO RODRÍGUEZ 980 Y QUEVEDO','aaa@csgabriel.edu.ec','2613478',1,'P','0000-00-00','','0000-00-00','20070140.JPG','A','A','1','1','20070140'),(334,1,1,1,1,1013,1,'Cristian Iván','SOLÓRZANO  MAYA','C','1722103791','0000-00-00','VÍCTOR MIDEROS N53-83 Y PINOS','aaa@csgabriel.edu.ec','2810916',1,'P','0000-00-00','','0000-00-00','20070141.JPG','A','A','1','1','20070141'),(335,1,1,1,1,1013,1,'Antonio','STACEY  SOLÍS','C','1720622180','2035-06-03','GENERAL DUMA N47-72 Y MALVAS','aaa@csgabriel.edu.ec','3342982',1,'P','0000-00-00','','0000-00-00','20070142.JPG','A','A','1','1','20070142'),(336,1,1,1,1,1013,1,'Javier Guillermo','TAPIA  BENÍTEZ','C','1724222078','0000-00-00','BARTOLOMÉ ALVES 289. CINCO ESQUINAS.','aaa@csgabriel.edu.ec','2649394',1,'P','0000-00-00','','0000-00-00','20070143.JPG','A','A','1','1','20070143'),(337,1,1,1,1,1013,1,'Emilio Fernando','TAPIA  IMBAQUINGO','C','1719819888','2035-06-01','PEDRO BASÁN 6 Y MAÑOSCA','aaa@csgabriel.edu.ec','2435322',1,'P','0000-00-00','','0000-00-00','20070144.JPG','A','A','1','1','20070144'),(338,1,1,1,1,1013,1,'Erick Damián','TORRES  PEÑALOZA','C','1715786750','0000-00-00','CASALES GABRIELA BL-7 APARTAMENTO A-3','aaa@csgabriel.edu.ec','2553773',1,'P','0000-00-00','','0000-00-00','20070145.JPG','A','A','1','1','20070145'),(339,1,1,1,1,1013,1,'Nelson Daniel','TRONCOSO  ALDÁS','C','1721679841','0000-00-00','JAVIER LOYOLA Y S.BOLÍVAR. CONJ.CAROLINA DOS','aaa@csgabriel.edu.ec','2321003',1,'P','0000-00-00','','0000-00-00','20070146.JPG','A','A','1','1','20070146'),(340,1,1,1,1,1013,1,'Daniel Martín','TUFIÑO  CAÑAS','C','1716824576','2035-08-08','CONJ.BOSQUES DE CALDERÒN 1 CASA 6','aaa@csgabriel.edu.ec','2828544',1,'P','0000-00-00','','0000-00-00','20070147.JPG','A','A','1','1','20070147'),(341,1,1,1,1,1013,1,'Patricio Alejandro','ULLOA  RODRÍGUEZ','C','1724321293','0000-00-00','PAS. 2 CASA N22-24 Y LUGO','aaa@csgabriel.edu.ec','2549252',1,'P','0000-00-00','','0000-00-00','20070148.JPG','A','A','1','1','20070148'),(342,1,1,1,1,1013,1,'Esteban David','URBINA  PADILLA','C','1720944105','0000-00-00','AV.AMÉRICA 358 Y BOGOTÁ','aaa@csgabriel.edu.ec','2501162',1,'P','0000-00-00','','0000-00-00','20070149.JPG','A','A','1','1','20070149'),(343,1,1,1,1,1013,1,'Steven Patricio','UTRERAS  CEPEDA','C','1720741048','0000-00-00','BENJAMÍN LASTRA S8-461 Y ANDRÉS PÉREZ','aaa@csgabriel.edu.ec','2613326',1,'P','0000-00-00','','0000-00-00','20070150.JPG','A','A','1','1','20070150'),(344,1,1,1,1,1013,1,'Luis Rodrigo','UTRERAS  TORRES','C','1723086821','0000-00-00','IBARRA PAS OE 9B CASA S38-36','aaa@csgabriel.edu.ec','3042620',1,'P','0000-00-00','','0000-00-00','20070151.JPG','A','A','1','1','20070151'),(345,1,1,1,1,1013,1,'Luis Fernando','VALVERDE  LÓPEZ','C','1719088971','2035-03-04','CONJ. BRASILIA II CASA 75','aaa@csgabriel.edu.ec','2410797',1,'P','0000-00-00','','0000-00-00','20070153.JPG','A','A','1','1','20070153'),(346,1,1,1,1,1013,1,'Rafael Stéfano','VANEGAS  MONTERO','C','1724121965','0000-00-00','CARLOS DOSMAN 132 Y ANGEL LUDEÑA','aaa@csgabriel.edu.ec','2532290',1,'P','0000-00-00','','0000-00-00','20070154.JPG','A','A','1','1','20070154'),(347,1,1,1,1,1013,1,'Enrique Javier','VELASCO  JARAMILLO','C','1721102141','2035-03-09','GUARANDA N54-541 Y JORGE PIEDRA','aaa@csgabriel.edu.ec','3303650',1,'P','0000-00-00','','0000-00-00','20070156.JPG','A','A','1','1','20070156'),(348,1,1,1,1,1013,1,'Renato Alexis','VERDESOTO  YÉPEZ','C','1724220627','0000-00-00','OLMEDO 738 Y GUAYAQUIL','aaa@csgabriel.edu.ec','2956254',1,'P','0000-00-00','','0000-00-00','20070157.JPG','A','A','1','1','20070157'),(349,1,1,1,1,1013,1,'Camilo Martín','VILLALBA  ARIAS','C','1724232259','0000-00-00','EL UNIVERSO 360 Y AV.DE LOS SHYRIS','aaa@csgabriel.edu.ec','2457193',1,'P','0000-00-00','','0000-00-00','20070158.JPG','A','A','1','1','20070158'),(350,1,1,1,1,1013,1,'Juan Sebastián','VILLARREAL  GODOY','C','1722213558','0000-00-00','URB. LA GRANJA BL-35 D-32','aaa@csgabriel.edu.ec','2434000',1,'P','0000-00-00','','0000-00-00','20070159.JPG','A','A','1','1','20070159'),(351,1,1,1,1,1013,1,'Francisco Esteban','VITERI  LÓPEZ','C','1723920789','2035-10-00','LAS ANONAS 53-330 Y PEDRO GUERRERO','aaa@csgabriel.edu.ec','3280329',1,'P','0000-00-00','','0000-00-00','20070160.JPG','A','A','1','1','20070160'),(352,1,1,1,1,1013,1,'Javier Patricio','VIZCAINO  BERMÚDEZ','C','1723539522','0000-00-00','GEOVANY CALLES Y LA PIEDRA 29','aaa@csgabriel.edu.ec','2428881',1,'P','0000-00-00','','0000-00-00','20070161.JPG','A','A','1','1','20070161'),(353,1,1,1,1,1013,1,'Mauricio Andrés','ZULETA  CEVALLOS','C','1722784798','0000-00-00','MAGALLANES 128 Y SANTA ROSA','aaa@csgabriel.edu.ec','2905336',1,'P','0000-00-00','','0000-00-00','20070163.JPG','A','A','1','1','20070163'),(354,1,1,1,1,1013,1,'Miguel Mateo','ZUMÁRRAGA  BORJA','C','1717218729','0000-00-00','SELVA ALEGRE Y SOBRINO MINAYO. ED. CANAAN DOS','aaa@csgabriel.edu.ec','3203337',1,'P','0000-00-00','','0000-00-00','20070164.JPG','A','A','1','1','20070164'),(355,1,1,1,1,1013,1,'Luis Fernando','ZUMÁRRAGA  GUEVARA','C','1724013105','0000-00-00','NAZARETH OE2-262','aaa@csgabriel.edu.ec','2296901',1,'P','0000-00-00','','0000-00-00','20070165.JPG','A','A','1','1','20070165'),(356,1,1,1,1,1013,1,'Sebastián Antonio','ZUMÁRRAGA  MOLINA','C','1724017783','0000-00-00','JOSÉ M.GUERRERO Y MANTA. CONJ.LA RECOLETA D-201','aaa@csgabriel.edu.ec','2292552',1,'P','0000-00-00','','0000-00-00','20070166.JPG','A','A','1','1','20070166'),(357,1,1,1,1,1013,1,'Martín Alejandro','ACOSTA  LÓPEZ','C','1717723017','0000-00-00','VERACRUZ N35-01 Y AMÉRICA','aaa@csgabriel.edu.ec','3316379',1,'P','0000-00-00','','0000-00-00','20070167.JPG','A','A','1','1','20070167'),(358,1,1,1,1,1013,1,'José Francisco','AGUILAR  VARELA','C','1723797971','0000-00-00','ABELARDO MONTALVO E2-45 Y FCO.GUARDERAS','aaa@csgabriel.edu.ec','2400495',1,'P','0000-00-00','','0000-00-00','20070168.JPG','A','A','1','1','20070168'),(359,1,1,1,1,1013,1,'Diego Erick','AUZ  CHÁVEZ','C','1719534339','0000-00-00','FRANCISCO MONTALVO OE92-82 Y LORANTE','aaa@csgabriel.edu.ec','2276641',1,'P','0000-00-00','','0000-00-00','20070169.JPG','A','A','1','1','20070169'),(360,1,1,1,1,1013,1,'Paúl Alejandro','BRAVO  HERRERA','C','1720070513','0000-00-00','MONTEVIDEO OE 847 Y NICARAGUA','aaa@csgabriel.edu.ec','2951114',1,'P','0000-00-00','','0000-00-00','20070170.JPG','A','A','1','1','20070170'),(361,1,1,1,1,1013,1,'Jerson Sebastián','CANDO  TAPIA','C','1724222086','0000-00-00','PAS. S17-125 Y HUIGRA','aaa@csgabriel.edu.ec','2629119',1,'P','0000-00-00','','0000-00-00','20070171.JPG','A','A','1','1','20070171'),(362,1,1,1,1,1013,1,'Cristhofer Andrés','CAPITO  VILLACRÉS','C','1721351508','0000-00-00','MELCHOR DE VALDEZ Y MARTÍN OCHOA. CONJ.ALTALOMA','aaa@csgabriel.edu.ec','3402092',1,'P','0000-00-00','','0000-00-00','20070172.JPG','A','A','1','1','20070172'),(363,1,1,1,1,1013,1,'Juan Sebastián','CARRERA  CARRANCO','C','1720598984','2035-04-07','URB.ALTAMIRA PAS. 3 C-53','aaa@csgabriel.edu.ec','2803830',1,'P','0000-00-00','','0000-00-00','20070173.JPG','A','A','1','1','20070173'),(364,1,1,1,1,1013,1,'Sebastián Alexis','CARRERA  COSTA','C','1715482509','0000-00-00','GALINDEZ 111 Y 10 DE AGOSTO','aaa@csgabriel.edu.ec','2439202',1,'P','0000-00-00','','0000-00-00','20070174.JPG','A','A','1','1','20070174'),(365,1,1,1,1,1013,1,'Diego Nicolás','CARRILLO  RUIZ','C','1721644100','0000-00-00','DE LOS TRIGALES N532-22','aaa@csgabriel.edu.ec','2419988',1,'P','0000-00-00','','0000-00-00','20070175.JPG','A','A','1','1','20070175'),(366,1,1,1,1,1013,1,'Robert Sebastián','CHÁVEZ  MEJÍA','C','1724193360','0000-00-00','CONJ.PRADOS DE QUITUMBE I. MZ-C C-90. AV.QUITUMBE','aaa@csgabriel.edu.ec','2672191',1,'P','0000-00-00','','0000-00-00','20070176.JPG','A','A','1','1','20070176'),(367,1,1,1,1,1013,1,'Sebastián Alejandro','DIAZ  RIVADENEIRA','C','1715365399','0000-00-00','JOSÉ GUERRERO 70-13','aaa@csgabriel.edu.ec','2491587',1,'P','0000-00-00','','0000-00-00','20070177.JPG','A','A','1','1','20070177'),(368,1,1,1,1,1013,1,'Mario Santiago','DUQUE  DÁVILA','C','1721345831','0000-00-00','CALLE YARUQUIES 1695 Y SARAGURO. SAN BARTOLO','aaa@csgabriel.edu.ec','2676766',1,'P','0000-00-00','','0000-00-00','20070178.JPG','A','A','1','1','20070178'),(369,1,1,1,1,1013,1,'Daniel Sebastián','ELIZALDE  ASUNCIÓN','C','1724220619','0000-00-00','CDLA. AYMESA CALLE A 252. GUAJALO','aaa@csgabriel.edu.ec','2675018',1,'P','0000-00-00','','0000-00-00','20070179.JPG','A','A','1','1','20070179'),(370,1,1,1,1,1013,1,'Sergio Paúl','ELMIR  VALVERDE','C','1715113070','0000-00-00','CARVAJAL OE6-24 Y CALLE A. ED. HORUS PLAZA','aaa@csgabriel.edu.ec','3319332',1,'P','0000-00-00','','0000-00-00','20070180.JPG','A','A','1','1','20070180'),(371,1,1,1,1,1013,1,'Roberto Nicolás','ESCANDÓN  ARIAS','C','1723796536','0000-00-00','PANAMERICANA NORTE KM 9 1/2','aaa@csgabriel.edu.ec','2428867',1,'P','0000-00-00','','0000-00-00','20070181.JPG','A','A','1','1','20070181'),(372,1,1,1,1,1013,1,'Esteban Andrés','FERNÁNDEZ  DÁVALOS','C','1724018237','0000-00-00','ISLA ISABELA N41-21 E ISLA FLOREANA','aaa@csgabriel.edu.ec','2244176',1,'P','0000-00-00','','0000-00-00','20070182.JPG','A','A','1','1','20070182'),(373,1,1,1,1,1013,1,'Jorge Andrés','GARCÍA  CASTILLO','C','1723871479','2035-08-03','URB.MEDICOS DE PICHINCHA CALLE B L-7 CUMBAYA','aaa@csgabriel.edu.ec','6004813',1,'P','0000-00-00','','0000-00-00','20070183.JPG','A','A','1','1','20070183'),(374,1,1,1,1,1013,1,'Bryan Alejandro','GÓMEZ  MARTÍNEZ','C','1718802034','2035-11-09','SOLANDA','aaa@csgabriel.edu.ec','2686824',1,'P','0000-00-00','','0000-00-00','20070184.JPG','A','A','1','1','20070184'),(375,1,1,1,1,1013,1,'José Francisco','GUEVARA  PAREJA','C','1719040006','0000-00-00','CONJ.VILLARREAL C-65.B. URB.SAN BARTOLO','aaa@csgabriel.edu.ec','2689650',1,'P','0000-00-00','','0000-00-00','20070185.JPG','A','A','1','1','20070185'),(376,1,1,1,1,1013,1,'Dennis Omar','GUZMÁN  ORDÓÑEZ','C','1718548058','0000-00-00','SAN SALVADOR E780 Y PRADERA','aaa@csgabriel.edu.ec','2568104',1,'P','0000-00-00','','0000-00-00','20070186.JPG','A','A','1','1','20070186'),(377,1,1,1,1,1013,1,'Jefferson Stalin','MAILA  TIPANTIZA','C','1721538906','0000-00-00','JUAN VIZUETE. PIO XII','aaa@csgabriel.edu.ec','2604139',1,'P','0000-00-00','','0000-00-00','20070187.JPG','A','A','1','1','20070187'),(378,1,1,1,1,1013,1,'Esteban Romeo','MARÍN  MUÑOZ','C','1720882383','0000-00-00','ALEMANIA 1225 Y REPÚBLICA','aaa@csgabriel.edu.ec','2924056',1,'P','0000-00-00','','0000-00-00','20070189.JPG','A','A','1','1','20070189'),(379,1,1,1,1,1013,1,'Santiago Daniel','MARTÍNEZ  RUIZ','C','1722692165','0000-00-00','BOGOTA OE 5-110 Y EE.UU','aaa@csgabriel.edu.ec','2555731',1,'P','0000-00-00','','0000-00-00','20070190.JPG','A','A','1','1','20070190'),(380,1,1,1,1,1013,1,'Sebastián Patricio','MERA  ARIAS','C','1724050479','0000-00-00','BARTOLOMÉ ALVEZ S8-373 Y PEDRO CEPERO','aaa@csgabriel.edu.ec','2643872',1,'P','0000-00-00','','0000-00-00','20070191.JPG','A','A','1','1','20070191'),(381,1,1,1,1,1013,1,'Pablo Xavier','MONTENEGRO  RUBIO','C','1722374939','0000-00-00','FCO. NIETO N49-146. LA LUZ','aaa@csgabriel.edu.ec','2813183',1,'P','0000-00-00','','0000-00-00','20070192.JPG','A','A','1','1','20070192'),(382,1,1,1,1,1013,1,'Jorge Andrés','MORALES  REGALADO','C','1722243084','0000-00-00','UPANO Y PILAHUIN # 92','aaa@csgabriel.edu.ec','2669877',1,'P','0000-00-00','','0000-00-00','20070193.JPG','A','A','1','1','20070193'),(383,1,1,1,1,1013,1,'Josue Sebastián','MUÑOZ  DÍAZ','C','1724224140','0000-00-00','PEDRO DE ALFARO OE 225 Y DÍAZ DE PINEDA','aaa@csgabriel.edu.ec','2619721',1,'P','0000-00-00','','0000-00-00','20070194.JPG','A','A','1','1','20070194'),(384,1,1,1,1,1013,1,'Erik Sebastián','NAVAS  GUANOLUISA','C','1720960804','0000-00-00','JOSÉ EGUSQUIZA Y ANDRÉS SEGUROLA # 146','aaa@csgabriel.edu.ec','3102346',1,'P','0000-00-00','','0000-00-00','20070195.JPG','A','A','1','1','20070195'),(385,1,1,1,1,1013,1,'Martín','NOBOA  IZQUIERDO','C','1723826416','0000-00-00','URB. LA GRANJA C-257','aaa@csgabriel.edu.ec','2443785',1,'P','0000-00-00','','0000-00-00','20070196.JPG','A','A','1','1','20070196'),(386,1,1,1,1,1013,1,'Tomás','NOBOA  IZQUIERDO','C','1723826408','0000-00-00','URB.LA GRANJA C-257','aaa@csgabriel.edu.ec','2433785',1,'P','0000-00-00','','0000-00-00','20070197.JPG','A','A','1','1','20070197'),(387,1,1,1,1,1013,1,'Jacob Melquisedec','ORBE  PROAÑO','C','1724225022','0000-00-00','URB.SAN JOSÉ DEL VALLE','aaa@csgabriel.edu.ec','2348948',1,'P','0000-00-00','','0000-00-00','20070198.JPG','A','A','1','1','20070198'),(388,1,1,1,1,1013,1,'Fausto Andrés','RISUEÑO  VÁSQUEZ','C','1720692563','0000-00-00','MANUEL SEMBLANTES 354. SAN PEDRO CLAVERT','aaa@csgabriel.edu.ec','2531565',1,'P','0000-00-00','','0000-00-00','20070200.JPG','A','A','1','1','20070200'),(389,1,1,1,1,1013,1,'Alex','ROMERO  NIETO','C','1719897801','2035-10-05','FRANCISCO LONDOÑO 247 Y FCO. GÓMEZ','aaa@csgabriel.edu.ec','2661608',1,'P','0000-00-00','','0000-00-00','20070201.JPG','A','A','1','1','20070201'),(390,1,1,1,1,1013,1,'Darwin Alexander','SALVADOR  HIDROVO','C','1724066848','0000-00-00','CALLE G Y 6 # 534. CHILLOGALLO','aaa@csgabriel.edu.ec','2634663',1,'P','0000-00-00','','0000-00-00','20070202.JPG','A','A','1','1','20070202'),(391,1,1,1,1,1013,1,'Pablo David','TORO  PÉREZ','C','1724231327','0000-00-00','PAS. BORJA 265 Y ALDAMA','aaa@csgabriel.edu.ec','3202507',1,'P','0000-00-00','','0000-00-00','20070203.JPG','A','A','1','1','20070203'),(392,1,1,1,1,1013,1,'Mauricio Andrés','TORRES  CÁCERES','C','1722772611','0000-00-00','JÍBAROS 381 E INGAPIRCA','aaa@csgabriel.edu.ec','3300727',1,'P','0000-00-00','','0000-00-00','20070204.JPG','A','A','1','1','20070204'),(393,1,1,1,1,1013,1,'Juan Andrés','TRUJILLO  CÁRDENAS','C','1724196280','0000-00-00','PAS. 2 L-265 Y CALLE 4. BARRIO EL TRIGAL','aaa@csgabriel.edu.ec','3202374',1,'P','0000-00-00','','0000-00-00','20070205.JPG','A','A','1','1','20070205'),(394,1,1,1,1,1013,1,'David Israel','VALENZUELA  URRESTA','C','1722251418','0000-00-00','AV.REAL AUDIENCIA 49 Y NASACOLA PUENTO','aaa@csgabriel.edu.ec','2485070',1,'P','0000-00-00','','0000-00-00','20070207.JPG','A','A','1','1','20070207'),(395,1,1,1,1,1013,1,'Joffre Daniel','VÉLEZ  ZAMBRANO','C','1716636566','0000-00-00','EE.UU N14-53 Y RIOFRÍO','aaa@csgabriel.edu.ec','2500898',1,'P','0000-00-00','','0000-00-00','20070208.JPG','A','A','1','1','20070208'),(396,1,1,1,1,1013,1,'Mateo Sebastián','ZAMBRANO  GUERRERO','C','1722706965','0000-00-00','CONJ.JARDINES DEL BOSQUE C-4','aaa@csgabriel.edu.ec','3319597',1,'P','0000-00-00','','0000-00-00','20070209.JPG','A','A','1','1','20070209'),(397,1,1,1,1,1013,1,'Daniel Ricardo','ZUMÁRRAGA  MUÑOZ','C','1724232515','0000-00-00','MURIALDO 2332 Y AV. 10 DE AGOSTO','aaa@csgabriel.edu.ec','2411685',1,'P','0000-00-00','','0000-00-00','20070210.JPG','A','A','1','1','20070210'),(398,1,1,1,1,1013,1,'Eliecer Alexander','ZURITA  FONSECA','C','1715587653','0000-00-00','COOP. UNION Y JUSTICIA L-9','aaa@csgabriel.edu.ec','2625497',1,'P','0000-00-00','','0000-00-00','20070211.JPG','A','A','1','1','20070211'),(399,1,1,1,1,1013,1,'Javier Andrés','ALMEIDA  ARGUELLO','C','1720133568','0000-00-00','GRANDA CANTENO OE 4-270 Y CARANDOLET','aaa@csgabriel.edu.ec','2435866',1,'P','0000-00-00','','0000-00-00','20070213.JPG','A','A','1','1','20070213'),(400,1,1,1,1,1013,1,'José Ricardo','BÁEZ  CAZORLA','C','1722251442','0000-00-00','J.PINTO E4-342 Y AMAZONAS','aaa@csgabriel.edu.ec','2565724',1,'P','0000-00-00','','0000-00-00','20070214.JPG','A','A','1','1','20070214'),(401,1,1,1,1,1013,1,'Mauricio Alejandro','GONZÁLEZ  GÓMEZ','C','1718211822','0000-00-00','ANTONIO JÁTIVA 168','aaa@csgabriel.edu.ec','2640576',1,'P','0000-00-00','','0000-00-00','20070215.JPG','A','A','1','1','20070215'),(402,1,1,1,1,1013,1,'David Andrés','CAICEDO  ORTEGA','C','1717205759','0000-00-00','ZOILA DE UGARTE N52-110 Y CAP.R. BORJA','aaa@csgabriel.edu.ec','2415413',1,'P','0000-00-00','','0000-00-00','20070216.JPG','A','A','1','1','20070216'),(403,1,1,1,1,1013,1,'Rubén Eduardo','DÍAZ  GARCÉS','C','1721351474','2035-11-05','MARCHENA N42-138 Y GRANADOS','aaa@csgabriel.edu.ec','2264186',1,'P','0000-00-00','','0000-00-00','20070217.JPG','A','A','1','1','20070217'),(404,1,1,1,1,1013,1,'Jordy Wladimir','GUARANGO  MARIÑO','C','1722318878','0000-00-00','BARRIO COLLAS. CALDERÓN','aaa@csgabriel.edu.ec','2065645',1,'P','0000-00-00','','0000-00-00','20070218.JPG','A','A','1','1','20070218'),(405,1,1,1,1,1013,1,'David Alejandro','LEIVA  ANDRADE','C','1722856059','0000-00-00','ASTURIAS OE4-304 Y ALBERTO EINSTEIN','aaa@csgabriel.edu.ec','2801386',1,'P','0000-00-00','','0000-00-00','20070219.JPG','A','A','1','1','20070219'),(406,1,1,1,1,1013,1,'Jonathan Paúl','RODRÍGUEZ  FLORES','C','1715500656','0000-00-00','ANTONIO CONFORTE 225 Y CARLOS FREILE','aaa@csgabriel.edu.ec','2630912',1,'P','0000-00-00','','0000-00-00','20070221.JPG','A','A','1','1','20070221'),(407,1,1,1,1,1013,1,'Yury Ricardo','ROMERO  GÓMEZ','C','1724196322','2035-11-08','CONCEPCIÓN E5-75','aaa@csgabriel.edu.ec','2282238',1,'P','0000-00-00','','0000-00-00','20070222.JPG','A','A','1','1','20070222'),(408,1,1,1,1,1013,1,'Nicolás Alejandro','ORTIZ  HERDOIZA','C','1718367731','0000-00-00','MAÑOSCA Y OCCIDENTAL. CONJ.SANTA CRUZ D-22.B','aaa@csgabriel.edu.ec','2272365',1,'P','0000-00-00','','0000-00-00','20070252.JPG','A','A','1','1','20070252'),(409,1,1,1,1,1013,1,'Alejandro','BENAVIDES  SALAS','C','','0000-00-00','TOLEDO N24-243 Y LUIS CORDERO','aaa@csgabriel.edu.ec','2521014',1,'P','0000-00-00','','0000-00-00','20070254.JPG','A','A','1','1','20070254'),(410,1,1,1,1,1013,1,'Juan Pablo','LUZURIAGA  ANDRADE','C','106500374','0000-00-00','CALLE E Y SEGUNDA TRANSVERSAL 4821. PINAR ALTO','aaa@csgabriel.edu.ec','2437704',1,'P','0000-00-00','','0000-00-00','20070258.JPG','A','A','1','1','20070258'),(411,1,1,1,1,1013,1,'Darío Sebastián','PERALTA  LEÓN','C','1721345344','2034-06-02','LOS PEPINOS N47-52 ENTRE MADROÑOS Y MORTIÑOS','aaa@csgabriel.edu.ec','2451065',1,'P','0000-00-00','','0000-00-00','20050146.JPG','A','A','1','1','20050146'),(412,1,1,1,1,1013,1,'Hernán Felipe','PERNETT  PULLES','C','1722460795','2034-03-05','AV.REPÚBLICA Y P.BEDÓN 1-60','aaa@csgabriel.edu.ec','3317046',1,'P','0000-00-00','','0000-00-00','20050149.JPG','A','A','1','1','20050149'),(413,1,1,1,1,1013,1,'Santiago Fernando','ALBORNOZ  CALDERÓN','C','1721839616','0000-00-00','URB. MARISOL III N71-193. ESTADIO DE LIGA','aaa@csgabriel.edu.ec','2485938',1,'P','0000-00-00','','0000-00-00','20060001.JPG','A','A','1','1','20060001'),(414,1,1,1,1,1013,1,'Josue Sebastián','ALMEIDA  MOYA','C','1717127987','0000-00-00','FRANCISCO RUIZ OE3-289','aaa@csgabriel.edu.ec','2485014',1,'P','0000-00-00','','0000-00-00','20060003.JPG','A','A','1','1','20060003'),(415,1,1,1,1,1013,1,'Cristhian Andrés','ALTAMIRANO  PAZMIÑO','C','1722317292','0000-00-00','PAS.CÉSAR FRANK E359 E ISAAC ALBÉNIZ','aaa@csgabriel.edu.ec','2417300',1,'P','0000-00-00','','0000-00-00','20060004.JPG','A','A','1','1','20060004'),(416,1,1,1,1,1013,1,'Ramiro Paúl','ANDRADE  SÁNCHEZ','C','1722998695','0000-00-00','HERNANDO DE LA CRUZ 650','aaa@csgabriel.edu.ec','2450796',1,'P','0000-00-00','','0000-00-00','20060005.JPG','A','A','1','1','20060005'),(417,1,1,1,1,1013,1,'Andrés Sebastián','ARAGÓN  ACHIG','C','1722384540','0000-00-00','COOP.14 DE DICIEMBRE L-36. VALLE DE LOS CHILLOS','aaa@csgabriel.edu.ec','2322253',1,'P','0000-00-00','','0000-00-00','20060006.JPG','A','A','1','1','20060006'),(418,1,1,1,1,1013,1,'César Sebastián','ARCOS  LÓPEZ','C','1718166521','0000-00-00','TURREY 124 Y M. JOFRE','aaa@csgabriel.edu.ec','2264557',1,'P','0000-00-00','','0000-00-00','20060008.JPG','A','A','1','1','20060008'),(419,1,1,1,1,1013,1,'Juan Carlos','ARMAS  RUIZ','C','1720926938','0000-00-00','CONJ.AMARANTA D-105.D VIA A LOS CHILLOS.','aaa@csgabriel.edu.ec','2622667',1,'P','0000-00-00','','0000-00-00','20060009.JPG','A','A','1','1','20060009'),(420,1,1,1,1,1013,1,'Cristopher Daniel','ASTUDILLO  RIVADENEIRA','C','1720807120','0000-00-00','ISLA MARCHENA N41-31 Y GRANADOS','aaa@csgabriel.edu.ec','2259720',1,'P','0000-00-00','','0000-00-00','20060010.JPG','A','A','1','1','20060010'),(421,1,1,1,1,1013,1,'Cristhian Omar','AYALA  OBANDO','C','1723068639','0000-00-00','TOLEDO 10-51 Y MADRID D-801','aaa@csgabriel.edu.ec','2545306',1,'P','0000-00-00','','0000-00-00','20060011.JPG','A','A','1','1','20060011'),(422,1,1,1,1,1013,1,'Edgar Patricio','BALDEÓN  PEÑALOZA','C','1721155966','0000-00-00','LAS ANONAS 103.A Y CHOLANES','aaa@csgabriel.edu.ec','3283699',1,'P','0000-00-00','','0000-00-00','20060012.JPG','A','A','1','1','20060012'),(423,1,1,1,1,1013,1,'Luis Antonio','BARZALLO  BRAVO','C','1716632946','0000-00-00','APARICIO RIVADENEIRA E6-86','aaa@csgabriel.edu.ec','2410220',1,'P','0000-00-00','','0000-00-00','20060013.JPG','A','A','1','1','20060013'),(424,1,1,1,1,1013,1,'Josue Abraham','BARROS  VELÁSQUEZ','C','1722818927','0000-00-00','PABLO GUARDERAS 3RA. TRANS. S/N. MACHACHI','aaa@csgabriel.edu.ec','2316135',1,'P','0000-00-00','','0000-00-00','20060014.JPG','A','A','1','1','20060014'),(425,1,1,1,1,1013,1,'Diego Sebastián','BASTIDAS  BRIONES','C','1715463285','0000-00-00','J.F.KENNEDY Y P. RUBENS OE4-33','aaa@csgabriel.edu.ec','2491610',1,'P','0000-00-00','','0000-00-00','20060015.JPG','A','A','1','1','20060015'),(426,1,1,1,1,1013,1,'Safet Felipe','BEKTESEVIC  PÉREZ','C','1723340269','0000-00-00','MARTÍN UTRERAS 743','aaa@csgabriel.edu.ec','2266634',1,'P','0000-00-00','','0000-00-00','20060016.JPG','A','A','1','1','20060016'),(427,1,1,1,1,1013,1,'Santiago David','BONILLA  CHIMBO','C','1722899430','0000-00-00','AV.LA ECUATORIANA OE6-16','aaa@csgabriel.edu.ec','2694225',1,'P','0000-00-00','','0000-00-00','20060017.JPG','A','A','1','1','20060017'),(428,1,1,1,1,1013,1,'Daniel Sebastián','BRAVO  MONCAYO','C','1718901562','0000-00-00','FRANCISCO GUARDERAS C-01','aaa@csgabriel.edu.ec','2401618',1,'P','0000-00-00','','0000-00-00','20060018.JPG','A','A','1','1','20060018'),(429,1,1,1,1,1013,1,'Iván Andrés','BUITRÓN  TANDALLA','C','1720504487','0000-00-00','HOMERO SALAS OE3-157 Y BRASIL','aaa@csgabriel.edu.ec','3300992',1,'P','0000-00-00','','0000-00-00','20060019.JPG','A','A','1','1','20060019'),(430,1,1,1,1,1013,1,'José Antonio','BURNEO  CARRERA','C','1723297410','0000-00-00','VERDECRUZ 557 Y ANTONIO SIERRA','aaa@csgabriel.edu.ec','3228580',1,'P','0000-00-00','','0000-00-00','20060020.JPG','A','A','1','1','20060020'),(431,1,1,1,1,1013,1,'Adrian Alexander','CACHOTE  ROMERO','C','1723248199','0000-00-00','HORTENCIAS L-28 Y TORONJAS','aaa@csgabriel.edu.ec','3260691',1,'P','0000-00-00','','0000-00-00','20060023.JPG','A','A','1','1','20060023'),(432,1,1,1,1,1013,1,'Jeyson Fernando','CAICEDO  YÁNEZ','C','1723090328','0000-00-00','CALLE Y S28-130. TURUBAMBA','aaa@csgabriel.edu.ec','2672379',1,'P','0000-00-00','','0000-00-00','20060024.JPG','A','A','1','1','20060024'),(433,1,1,1,1,1013,1,'Byron Alejandro','CAJAS  REYES','C','1723131619','0000-00-00','URB.BILOXI CALLE H MEIVER S17-61','aaa@csgabriel.edu.ec','98506991',1,'P','0000-00-00','','0000-00-00','20060025.JPG','A','A','1','1','20060025'),(434,1,1,1,1,1013,1,'Bryan David','CALLE  ROSERO','C','1723060578','0000-00-00','MORLÁN 2239 Y CAPITÁN BORJA','aaa@csgabriel.edu.ec','2412479',1,'P','0000-00-00','','0000-00-00','20060026.JPG','A','A','1','1','20060026'),(435,1,1,1,1,1013,1,'Mirko Marcelo','CARRILLO  CISNEROS','C','1723306179','0000-00-00','PAS. DIEGO HERRERA 253','aaa@csgabriel.edu.ec','3215942',1,'P','0000-00-00','','0000-00-00','20060027.JPG','A','A','1','1','20060027'),(436,1,1,1,1,1013,1,'Jonathan Antonio','CASARES  CASTELLANOS','C','1721673778','0000-00-00','ANTONIO BAQUERIZO S8-62. LA MAGDALENA','aaa@csgabriel.edu.ec','2660375',1,'P','0000-00-00','','0000-00-00','20060028.JPG','A','A','1','1','20060028'),(437,1,1,1,1,1013,1,'Felipe Sebastián','CASTILLO  REALPE','C','1719754705','0000-00-00','URB. MARISOL CALLE 9 N68-82','aaa@csgabriel.edu.ec','2484701',1,'P','0000-00-00','','0000-00-00','20060029.JPG','A','A','1','1','20060029'),(438,1,1,1,1,1013,1,'Diego Eduardo','CEVALLOS  CARBAJAL','C','1718863978','0000-00-00','FLORENCIO ESPINOZA N56-71 Y CARLOS V.','aaa@csgabriel.edu.ec','2535096',1,'P','0000-00-00','','0000-00-00','20060030.JPG','A','A','1','1','20060030'),(439,1,1,1,1,1013,1,'Diego Nicolay','CHÁVEZ  CASTILLO','C','1717318024','0000-00-00','LEGARDA Y 4TA.TRANVERSAL N64-94','aaa@csgabriel.edu.ec','3411377',1,'P','0000-00-00','','0000-00-00','20060031.JPG','A','A','1','1','20060031'),(440,1,1,1,1,1013,1,'Cristian Andrés','CHÁVEZ  EGRED','C','1716025471','0000-00-00','LA FLORIDA OE3-74','aaa@csgabriel.edu.ec','2432970',1,'P','0000-00-00','','0000-00-00','20060032.JPG','A','A','1','1','20060032'),(441,1,1,1,1,1013,1,'Samuel Francisco','CHÁVEZ  ROMERO','C','1721402681','0000-00-00','5TA.TRANS. Y LEGARDA C-13. COTOCOLLAO','aaa@csgabriel.edu.ec','2292646',1,'P','0000-00-00','','0000-00-00','20060033.JPG','A','A','1','1','20060033'),(442,1,1,1,1,1013,1,'Juan Abel','CHERRES  IMBAQUINGO','C','1722385778','0000-00-00','LIBORIO MADERA L-8','aaa@csgabriel.edu.ec','3443418',1,'P','0000-00-00','','0000-00-00','20060034.JPG','A','A','1','1','20060034'),(443,1,1,1,1,1013,1,'Rubén Vinicio','CHIRIBOGA  SAMANIEGO','C','1718166596','0000-00-00','RITTER N19-211 Y AV.UNIVERSITARIA','aaa@csgabriel.edu.ec','2524989',1,'P','0000-00-00','','0000-00-00','20060035.JPG','A','A','1','1','20060035'),(444,1,1,1,1,1013,1,'José Gonzalo','CHIRIBOGA  SÁNCHEZ','C','1721230843','0000-00-00','SAN JOSÉ DEL CONDADO O4-403','aaa@csgabriel.edu.ec','2490961',1,'P','0000-00-00','','0000-00-00','20060036.JPG','A','A','1','1','20060036'),(445,1,1,1,1,1013,1,'Xavier Nicolás','CISNEROS  SÁNCHEZ','C','1717156697','0000-00-00','AV. DE LA PRENSA N63-262','aaa@csgabriel.edu.ec','2592737',1,'P','0000-00-00','','0000-00-00','20060038.JPG','A','A','1','1','20060038'),(446,1,1,1,1,1013,1,'Joe Lenin','CORREA  BASTIDAS','C','1722942743','0000-00-00','CONJ.ESTORIL D-B.22 BL.B. J.GARZÓN Y P.FREILE','aaa@csgabriel.edu.ec','2534344',1,'P','0000-00-00','','0000-00-00','20060039.JPG','A','A','1','1','20060039'),(447,1,1,1,1,1013,1,'Elhias Daniel','DE  LA TORRE GUZMÁN','C','1718161548','0000-00-00','ULLOA N31-67 Y SAN GABRIEL','aaa@csgabriel.edu.ec','2229134',1,'P','0000-00-00','','0000-00-00','20060040.JPG','A','A','1','1','20060040'),(448,1,1,1,1,1013,1,'Marcell Alejandro','DELGADO  FONSECA','C','1723152615','0000-00-00','URB. YAGUACHI L-23. SAN RAFAEL','aaa@csgabriel.edu.ec','2081078',1,'P','0000-00-00','','0000-00-00','20060041.JPG','A','A','1','1','20060041'),(449,1,1,1,1,1013,1,'Felipe Nicolás','DÍAZ  GRANDA','C','1721824371','0000-00-00','RAMÓN EGAS 250 E IQUIQUE','aaa@csgabriel.edu.ec','2223940',1,'P','0000-00-00','','0000-00-00','20060042.JPG','A','A','1','1','20060042'),(450,1,1,1,1,1013,1,'Juan Sebastián','DONOSO  LEMOS','C','1721994554','0000-00-00','MARÍA TIGSILEMA N60-106','aaa@csgabriel.edu.ec','2537941',1,'P','0000-00-00','','0000-00-00','20060043.JPG','A','A','1','1','20060043'),(451,1,1,1,1,1013,1,'Sebastián Arturo','ESPINOSA  QUEZADA','C','1716306517','0000-00-00','ELISIO FLOR N62-31 Y RIGOBERTO HEREDIA','aaa@csgabriel.edu.ec','2297891',1,'P','0000-00-00','','0000-00-00','20060044.JPG','A','A','1','1','20060044'),(452,1,1,1,1,1013,1,'Luis Daniel','ESPINOZA  PRADO','C','1720364429','0000-00-00','ABDÓN CALDERÓN Y STA. ROSA L-8. CONOCOTO','aaa@csgabriel.edu.ec','2345242',1,'P','0000-00-00','','0000-00-00','20060045.JPG','A','A','1','1','20060045'),(453,1,1,1,1,1013,1,'Rommel Ismael','ESPÍN  RUIZ','C','1718166141','0000-00-00','CHECA Y MANUEL LARREA OE2-82','aaa@csgabriel.edu.ec','2226212',1,'P','0000-00-00','','0000-00-00','20060046.JPG','A','A','1','1','20060046'),(454,1,1,1,1,1013,1,'Bryan Alexis','ERAZO  JARAMILLO','C','1721719266','0000-00-00','SABANILLA 419 Y GUALAQUIZA','aaa@csgabriel.edu.ec','2535162',1,'P','0000-00-00','','0000-00-00','20060047.JPG','A','A','1','1','20060047'),(455,1,1,1,1,1013,1,'Eddy Richard','ESTRELLA  PASPUEL','C','1723301956','0000-00-00','COND.NUEVO AMANECER BL-12.D D-404.D','aaa@csgabriel.edu.ec','2486144',1,'P','0000-00-00','','0000-00-00','20060048.JPG','A','A','1','1','20060048'),(456,1,1,1,1,1013,1,'Andrés Martín','FLORES  BALAREZO','C','1718587791','0000-00-00','LOS GUABOS CALLE C L-87','aaa@csgabriel.edu.ec','2895968',1,'P','0000-00-00','','0000-00-00','20060049.JPG','A','A','1','1','20060049'),(457,1,1,1,1,1013,1,'Juan Andrés','FREIRE  MANZANO','C','1717438145','0000-00-00','PAS.TORTUGA 725 Y AMAZONAS','aaa@csgabriel.edu.ec','2256477',1,'P','0000-00-00','','0000-00-00','20060051.JPG','A','A','1','1','20060051'),(458,1,1,1,1,1013,1,'Andrés Sebastián','GALARZA  TORRES','C','1723301402','0000-00-00','JUAN DE SELIS Y MARIANO POZO','aaa@csgabriel.edu.ec','2479296',1,'P','0000-00-00','','0000-00-00','20060052.JPG','A','A','1','1','20060052'),(459,1,1,1,1,1013,1,'David Sebastián','GARCÉS  CRUZ','C','1718165291','0000-00-00','MAÑOSCA 812 Y VASCO DE CONTRERAS. COND. PIZARRO','aaa@csgabriel.edu.ec','2246541',1,'P','0000-00-00','','0000-00-00','20060054.JPG','A','A','1','1','20060054'),(460,1,1,1,1,1013,1,'Esteban Eduardo','GARCÉS  VACA','C','1723251599','0000-00-00','CALLE D 49-129 Y MANUEL VALDIVIESO C-3. PINAR ALTO','aaa@csgabriel.edu.ec','2477035',1,'P','0000-00-00','','0000-00-00','20060055.JPG','A','A','1','1','20060055'),(461,1,1,1,1,1013,1,'José María','GÓMEZ  DE LA TORRE OQUENDO','C','1714508759','0000-00-00','MIGUEL ÁLVAREZ CORTEZ 343 Y JOSÉ GOLE','aaa@csgabriel.edu.ec','2405353',1,'P','0000-00-00','','0000-00-00','20060056.JPG','A','A','1','1','20060056'),(462,1,1,1,1,1013,1,'Alejandro David','GONZÁLEZ  MARCHÁN','C','1718165481','0000-00-00','CONJ.BALCÓN METROPOLITANO BL-C D-410. D.DE LA MADR','aaa@csgabriel.edu.ec','3201128',1,'P','0000-00-00','','0000-00-00','20060057.JPG','A','A','1','1','20060057'),(463,1,1,1,1,1013,1,'Michael Ricardo','GORDILLO  CALLE','C','1719536987','0000-00-00','RUDECINDO LESANA E7-55 Y LOS PINOS. KENNEDY','aaa@csgabriel.edu.ec','2811489',1,'P','0000-00-00','','0000-00-00','20060058.JPG','A','A','1','1','20060058'),(464,1,1,1,1,1013,1,'Luis Andrés','GUADALUPE  SALAS','C','1714554688','0000-00-00','COND.LA CORDILLERA C-56. SAN CARLOS','aaa@csgabriel.edu.ec','2597600',1,'P','0000-00-00','','0000-00-00','20060059.JPG','A','A','1','1','20060059'),(465,1,1,1,1,1013,1,'Martín Antonio','GUERRERO  SORIA','C','1723301618','0000-00-00','URB. SAN JOSÉ 153-B','aaa@csgabriel.edu.ec','2820225',1,'P','0000-00-00','','0000-00-00','20060061.JPG','A','A','1','1','20060061'),(466,1,1,1,1,1013,1,'César Gabriel','GUIJARRO  YÉPEZ','C','1723305569','0000-00-00','TAPI 258  Y GUATEMALA','aaa@csgabriel.edu.ec','2587346',1,'P','0000-00-00','','0000-00-00','20060062.JPG','A','A','1','1','20060062'),(467,1,1,1,1,1013,1,'Francisco Javier','HIDALGO  MORETA','C','1721391264','0000-00-00','AV. LA FLORIDA 843','aaa@csgabriel.edu.ec','2251688',1,'P','0000-00-00','','0000-00-00','20060063.JPG','A','A','1','1','20060063'),(468,1,1,1,1,1013,1,'Iván Alejandro','HINOJOSA  MORALES','C','1717313132','0000-00-00','PAS. 1 OE831 Y DOMINGO ESPINAR','aaa@csgabriel.edu.ec','3201173',1,'P','0000-00-00','','0000-00-00','20060064.JPG','A','A','1','1','20060064'),(469,1,1,1,1,1013,1,'Andrés Sebastián','LAGOS  ESTRELLA','C','1721202370','0000-00-00','PEDRO CAPIRO 646 Y LEXO BRUIS. URB.BARRIO NUEVO','aaa@csgabriel.edu.ec','2647228',1,'P','0000-00-00','','0000-00-00','20060067.JPG','A','A','1','1','20060067'),(470,1,1,1,1,1013,1,'Christian Alexander','LATORRE  TORRES','C','1722444062','0000-00-00','BARTOLOMÉ CARBO N78-41','aaa@csgabriel.edu.ec','2470460',1,'P','0000-00-00','','0000-00-00','20060068.JPG','A','A','1','1','20060068'),(471,1,1,1,1,1013,1,'Juan Martín','LOAYZA  ALARCÓN','C','1720623147','2034-06-08','AV. AMÉRICA N31-30 Y SAN GABRIEL','aaa@csgabriel.edu.ec','2234784',1,'P','0000-00-00','','0000-00-00','20060069.JPG','A','A','1','1','20060069'),(472,1,1,1,1,1013,1,'Carlos Andrés','LOAYZA  VÁSQUEZ','C','1720858461','0000-00-00','JOSÉ PERALTA S13-268','aaa@csgabriel.edu.ec','2652775',1,'P','0000-00-00','','0000-00-00','20060070.JPG','A','A','1','1','20060070'),(473,1,1,1,1,1013,1,'Edwin Andrés','LÓPEZ  CAMPAÑA','C','503384364','0000-00-00','EL CALZADO MZ-47 C-16','aaa@csgabriel.edu.ec','3112400',1,'P','0000-00-00','','0000-00-00','20060071.JPG','A','A','1','1','20060071'),(474,1,1,1,1,1013,1,'Andy Fabián','LÓPEZ  PÁEZ','C','1722466677','0000-00-00','JUAN DE ARGUELLO 509 Y P.DORADO','aaa@csgabriel.edu.ec','2652811',1,'P','0000-00-00','','0000-00-00','20060072.JPG','A','A','1','1','20060072'),(475,1,1,1,1,1013,1,'Felipe Sebastián','LÓPEZ  SERRANO','C','1723297691','0000-00-00','CONJ. LUIS A.VALENCIA SEC.1 D-5011. SOLANDA','aaa@csgabriel.edu.ec','2603316',1,'P','0000-00-00','','0000-00-00','20060073.JPG','A','A','1','1','20060073'),(476,1,1,1,1,1013,1,'Martín Alejandro','LÓPEZ  TRUJILLO','C','1718908757','0000-00-00','TERESA DE CEPEDA N34-246 Y REPÚBLICA','aaa@csgabriel.edu.ec','3317100',1,'P','0000-00-00','','0000-00-00','20060074.JPG','A','A','1','1','20060074'),(477,1,1,1,1,1013,1,'Pablo Antonio','LUNA  MONTERO','C','1723114805','0000-00-00','CERRO HERMOSO E2-179. CHIMBACALLE','aaa@csgabriel.edu.ec','2643164',1,'P','0000-00-00','','0000-00-00','20060075.JPG','A','A','1','1','20060075'),(478,1,1,1,1,1013,1,'Gustavo Isaías','MAFLA  ROCA','C','1716384787','0000-00-00','URB.ROBLE ANTIGUO 37.A.  SAN RAFAEL','aaa@csgabriel.edu.ec','2860263',1,'P','0000-00-00','','0000-00-00','20060076.JPG','A','A','1','1','20060076'),(479,1,1,1,1,1013,1,'Carlos Andrés','MANZANO  DE LA TORRE','C','1722703814','0000-00-00','CONJ. EL PINAR C-76','aaa@csgabriel.edu.ec','2297255',1,'P','0000-00-00','','0000-00-00','20060078.JPG','A','A','1','1','20060078'),(480,1,1,1,1,1013,1,'Jorge Stalin','MARTÍNEZ  ARMAS','C','1722044409','0000-00-00','JOSÉ BARREIRO E12-22 Y DE LOS ÁLAMOS','aaa@csgabriel.edu.ec','2418755',1,'P','0000-00-00','','0000-00-00','20060079.JPG','A','A','1','1','20060079'),(481,1,1,1,1,1013,1,'William Andrés','MARTÍNEZ  JARA','C','1722928114','0000-00-00','COND.LA ALHAMBRA TORRE 3 D-504. MACHALA Y SABANILL','aaa@csgabriel.edu.ec','3412634',1,'P','0000-00-00','','0000-00-00','20060080.JPG','A','A','1','1','20060080'),(482,1,1,1,1,1013,1,'Nelson Patricio','MEJÍA  ZAMBRANO','C','1717460065','0000-00-00','SAQUISILÍ 429. PÍO XII','aaa@csgabriel.edu.ec','2604030',1,'P','0000-00-00','','0000-00-00','20060082.JPG','A','A','1','1','20060082'),(483,1,1,1,1,1013,1,'Erik Edison','MENA  MARTÍNEZ','C','1716849078','0000-00-00','JULIAN ESTRELLA OE9-77. CHILLOGALLO','aaa@csgabriel.edu.ec','2630276',1,'P','0000-00-00','','0000-00-00','20060083.JPG','A','A','1','1','20060083'),(484,1,1,1,1,1013,1,'Felipe David','MERLO  CIFUENTES','C','1721158655','0000-00-00','AMESABA Y 10 DE AGOSTO. COND.NUEVO AMANECER','aaa@csgabriel.edu.ec','2481956',1,'P','0000-00-00','','0000-00-00','20060084.JPG','A','A','1','1','20060084'),(485,1,1,1,1,1013,1,'Bryan Andrés','MIRANDA  MORALES','C','1721190369','0000-00-00','POMASQUI 9141 Y PEDRO ANDRADE','aaa@csgabriel.edu.ec','2282625',1,'P','0000-00-00','','0000-00-00','20060085.JPG','A','A','1','1','20060085'),(486,1,1,1,1,1013,1,'Fredy Alejandro','MONTALVO  RIVADENEIRA','C','1723242499','0000-00-00','LULUNCOTO III ETAPA MZ-4 C-6','aaa@csgabriel.edu.ec','3131103',1,'P','0000-00-00','','0000-00-00','20060087.JPG','A','A','1','1','20060087'),(487,1,1,1,1,1013,1,'Alexis Eduardo','MORALES  SUÁREZ','C','1718164682','0000-00-00','ACUÑA 439 Y VERSALLES','aaa@csgabriel.edu.ec','2909646',1,'P','0000-00-00','','0000-00-00','20060088.JPG','A','A','1','1','20060088'),(488,1,1,1,1,1013,1,'Santiago Xavier','MOREJÓN  MALDONADO','C','1719007641','0000-00-00','VIÑEDOS Y VENEZUELA. TERRACOTA G. C-22','aaa@csgabriel.edu.ec','98125003',1,'P','0000-00-00','','0000-00-00','20060090.JPG','A','A','1','1','20060090'),(489,1,1,1,1,1013,1,'Carlos Paúl','MOSQUERA  SUQUILLO','C','1721730701','0000-00-00','SUCRE 268. SANGOLQUÍ','aaa@csgabriel.edu.ec','2336407',1,'P','0000-00-00','','0000-00-00','20060092.JPG','A','A','1','1','20060092'),(490,1,1,1,1,1013,1,'Mauricio José','MUÑOZ  ARGUELLO','C','918043399','0000-00-00','BORGROIS 359 Y TERESA CEPEDA','aaa@csgabriel.edu.ec','2271605',1,'P','0000-00-00','','0000-00-00','20060093.JPG','A','A','1','1','20060093'),(491,1,1,1,1,1013,1,'David Nicolás','MONTERO  NARVÁEZ','C','1722945282','0000-00-00','CALLE A #41 Y SAN GABRIEL','aaa@csgabriel.edu.ec','2263287',1,'P','0000-00-00','','0000-00-00','20060095.JPG','A','A','1','1','20060095'),(492,1,1,1,1,1013,1,'Diego Gonzalo','NARANJO  VARGAS','C','1717513780','0000-00-00','AV. MARISCAL SUCRE S12-52','aaa@csgabriel.edu.ec','2842103',1,'P','0000-00-00','','0000-00-00','20060096.JPG','A','A','1','1','20060096'),(493,1,1,1,1,1013,1,'Michael Alexander','NARVÁEZ  CAMPAÑA','C','1723245237','0000-00-00','GONZALO DE PINEDA 309','aaa@csgabriel.edu.ec','2660248',1,'P','0000-00-00','','0000-00-00','20060097.JPG','A','A','1','1','20060097'),(494,1,1,1,1,1013,1,'Maksym','NIZHELSKYI','C','1719013672','2034-12-08','SHYRIS 41-151 E ISLA FLOREANA','aaa@csgabriel.edu.ec','2274419',1,'P','0000-00-00','','0000-00-00','20060098.JPG','A','A','1','1','20060098'),(495,1,1,1,1,1013,1,'Francisco Javier','NOLIVOS  MANZANO','C','1723128086','0000-00-00','LA GASCA CALLE RITER 969','aaa@csgabriel.edu.ec','2529015',1,'P','0000-00-00','','0000-00-00','20060099.JPG','A','A','1','1','20060099'),(496,1,1,1,1,1013,1,'Esteban Andrés','ORELLANA  CORTEZ','C','1719225300','0000-00-00','SOLANO Y LA CONDAMINE TORRE 26 S-3. LA VICENTINA','aaa@csgabriel.edu.ec','3227988',1,'P','0000-00-00','','0000-00-00','20060101.JPG','A','A','1','1','20060101'),(497,1,1,1,1,1013,1,'Daniel Everli','ORELLANA  SALAZAR','C','1723352769','0000-00-00','GARCÍA MORENO 525. CUMBAYÁ','aaa@csgabriel.edu.ec','2893430',1,'P','0000-00-00','','0000-00-00','20060102.JPG','A','A','1','1','20060102'),(498,1,1,1,1,1013,1,'Kelvin Jordan','ORMAZA  CORONEL','C','1723285241','0000-00-00','HUALCOPO S8-523 Y HUSARES','aaa@csgabriel.edu.ec','2649371',1,'P','0000-00-00','','0000-00-00','20060103.JPG','A','A','1','1','20060103'),(499,1,1,1,1,1013,1,'Jorge Andrés','OROZCO  SÁNCHEZ','C','1716632409','0000-00-00','MULTI E5-62 Y JÁTIVA','aaa@csgabriel.edu.ec','2660376',1,'P','0000-00-00','','0000-00-00','20060104.JPG','A','A','1','1','20060104'),(500,1,1,1,1,1013,1,'Fernando David','OTERO  LASTRA','C','1718165408','0000-00-00','BOGOTÁ 720 Y VENEZUELA','aaa@csgabriel.edu.ec','2561861',1,'P','0000-00-00','','0000-00-00','20060105.JPG','A','A','1','1','20060105'),(501,1,1,1,1,1013,1,'Ángel Sebastián','PADILLA  TAPIA','C','1722110523','0000-00-00','CANELOS S11-12','aaa@csgabriel.edu.ec','2622517',1,'P','0000-00-00','','0000-00-00','20060106.JPG','A','A','1','1','20060106'),(502,1,1,1,1,1013,1,'Wagner Gonzalo','PARRA  PALADINES','C','1104213358','0000-00-00','CDLA.ORANGINE PAS.B. S15-96. SAN BARTOLO','aaa@csgabriel.edu.ec','2671582',1,'P','0000-00-00','','0000-00-00','20060109.JPG','A','A','1','1','20060109'),(503,1,1,1,1,1013,1,'Alex Roberto','PAZMIÑO  MUÑOZ','C','1719320689','0000-00-00','GONZALO MARÍN E2-128','aaa@csgabriel.edu.ec','2653083',1,'P','0000-00-00','','0000-00-00','20060110.JPG','A','A','1','1','20060110'),(504,1,1,1,1,1013,1,'Diego Javier','PÉREZ  SALAZAR','C','1719347237','0000-00-00','RITTER Y BENJAMÍN CHÁVEZ 1434','aaa@csgabriel.edu.ec','2223424',1,'P','0000-00-00','','0000-00-00','20060112.JPG','A','A','1','1','20060112'),(505,1,1,1,1,1013,1,'Pedro José','PIEDRA  MENA','C','1719218784','0000-00-00','ISLA GENOVESA N42-130','aaa@csgabriel.edu.ec','2953220',1,'P','0000-00-00','','0000-00-00','20060114.JPG','A','A','1','1','20060114'),(506,1,1,1,1,1013,1,'Darwing Israel','PIJAL  CÁRDENAS','C','1717716839','0000-00-00','MIGUEL DE TRUJILLO L-55 Y BOBONAZA','aaa@csgabriel.edu.ec','2613272',1,'P','0000-00-00','','0000-00-00','20060115.JPG','A','A','1','1','20060115'),(507,1,1,1,1,1013,1,'Pablo Mateo','PIÑAS  PEÑAFIEL','C','1723118871','0000-00-00','LAS ORQUIDEAS CALLE 4-3  C-1916','aaa@csgabriel.edu.ec','2602123',1,'P','0000-00-00','','0000-00-00','20060116.JPG','A','A','1','1','20060116'),(508,1,1,1,1,1013,1,'José Jair','PONCE  COELLO','C','1723302988','0000-00-00','INTEROCEÁNICA 2705 Y MANABÍ. CUMBAYÁ','aaa@csgabriel.edu.ec','2891780',1,'P','0000-00-00','','0000-00-00','20060117.JPG','A','A','1','1','20060117'),(509,1,1,1,1,1013,1,'Camilo Sebastián','PONCE  BENÍTEZ','C','1720645835','0000-00-00','URB. PUSUQUÍ. CEL 2-53','aaa@csgabriel.edu.ec','2354970',1,'P','0000-00-00','','0000-00-00','20060118.JPG','A','A','1','1','20060118'),(510,1,1,1,1,1013,1,'Sergio Patricio','PORTUGAL  RODRÍGUEZ','C','1718127960','0000-00-00','ELOY ALFARO N74-196','aaa@csgabriel.edu.ec','2482476',1,'P','0000-00-00','','0000-00-00','20060119.JPG','A','A','1','1','20060119'),(511,1,1,1,1,1013,1,'Oscar Daniel','POZO  ÁLVARO','C','1723122766','0000-00-00','FERNANDO TINAJERO OE7-253','aaa@csgabriel.edu.ec','2596473',1,'P','0000-00-00','','0000-00-00','20060120.JPG','A','A','1','1','20060120'),(512,1,1,1,1,1013,1,'Luis Miguel','PROAÑO  BACA','C','1720105038','0000-00-00','RIOFRÍO N16-34','aaa@csgabriel.edu.ec','2528307',1,'P','0000-00-00','','0000-00-00','20060121.JPG','A','A','1','1','20060121'),(513,1,1,1,1,1013,1,'Yandry André','PROCEL  LIMONES','C','1722216213','0000-00-00','CONJ. SHELTON. CARCELÉN','aaa@csgabriel.edu.ec','2498337',1,'P','0000-00-00','','0000-00-00','20060122.JPG','A','A','1','1','20060122'),(514,1,1,1,1,1013,1,'Alberto Reinerio','PUERTAS  SAMANIEGO','C','1720358926','0000-00-00','VALPARAISO N12-83 Y CASTRO','aaa@csgabriel.edu.ec','2525411',1,'P','0000-00-00','','0000-00-00','20060123.JPG','A','A','1','1','20060123'),(515,1,1,1,1,1013,1,'Santiago David','QUEZADA  CÁCERES','C','1721867123','0000-00-00','ACUÑA OE3-284 Y AMÉRICA','aaa@csgabriel.edu.ec','2527797',1,'P','0000-00-00','','0000-00-00','20060124.JPG','A','A','1','1','20060124'),(516,1,1,1,1,1013,1,'Daniel Alejandro','RAMOS  TRÁVEZ','C','1719561233','0000-00-00','JOSÉ M. ARTETA L-108','aaa@csgabriel.edu.ec','2495321',1,'P','0000-00-00','','0000-00-00','20060125.JPG','A','A','1','1','20060125'),(517,1,1,1,1,1013,1,'Andrés Patricio','RECALDE  MOSQUERA','C','1723262745','0000-00-00','CHIMBORAZO 170 Y AV.MARISCAL SUCRE','aaa@csgabriel.edu.ec','2952277',1,'P','0000-00-00','','0000-00-00','20060126.JPG','A','A','1','1','20060126'),(518,1,1,1,1,1013,1,'Eduardo Andrés','REYES  TORRES','C','1723124184','0000-00-00','LA PAMPA II # 193','aaa@csgabriel.edu.ec','2350061',1,'P','0000-00-00','','0000-00-00','20060127.JPG','A','A','1','1','20060127'),(519,1,1,1,1,1013,1,'Yenán Andrés','REYES  ROBLES','C','1722653431','0000-00-00','BOLIVIA 973 Y AV.UNIVERSITARIA','aaa@csgabriel.edu.ec','3215346',1,'P','0000-00-00','','0000-00-00','20060128.JPG','A','A','1','1','20060128'),(520,1,1,1,1,1013,1,'Juan José','REYES  VÉLEZ','C','1723296602','0000-00-00','AV. DEL MAESTRO','aaa@csgabriel.edu.ec','2295440',1,'P','0000-00-00','','0000-00-00','20060129.JPG','A','A','1','1','20060129'),(521,1,1,1,1,1013,1,'Carlos Fernando','RIVADENEIRA  ESCOBAR','C','1718166190','0000-00-00','URB.SAN FRANCISCO 525. SAN RAFAEL','aaa@csgabriel.edu.ec','2955103',1,'P','0000-00-00','','0000-00-00','20060130.JPG','A','A','1','1','20060130'),(522,1,1,1,1,1013,1,'Gabriel Agustín','ROMERO  CORTEZ','C','1722228226','0000-00-00','EL CONDE 3 C-116. SAN BARTOLO','aaa@csgabriel.edu.ec','2974977',1,'P','0000-00-00','','0000-00-00','20060131.JPG','A','A','1','1','20060131'),(523,1,1,1,1,1013,1,'Juan Andrés','ROMERO  VINUEZA','C','1722314554','0000-00-00','JUAN DE SELIS N76-176','aaa@csgabriel.edu.ec','99908421',1,'P','0000-00-00','','0000-00-00','20060132.JPG','A','A','1','1','20060132'),(524,1,1,1,1,1013,1,'Edison Ricardo','ROMO  ESTRADA','C','1718166489','0000-00-00','JOSÉ BUSTOS E13-47 Y GUAYACANES','aaa@csgabriel.edu.ec','3280045',1,'P','0000-00-00','','0000-00-00','20060133.JPG','A','A','1','1','20060133'),(525,1,1,1,1,1013,1,'Francisco Xavier','ROSERO  PEÑAFIEL','C','1720439742','0000-00-00','FCO. RUIZ OE3-19. CARCELÉN','aaa@csgabriel.edu.ec','2484790',1,'P','0000-00-00','','0000-00-00','20060135.JPG','A','A','1','1','20060135'),(526,1,1,1,1,1013,1,'Nicolás Emilio','RUIZ  BRAVO','C','1723203459','0000-00-00','AV. AMÉRICA 4285','aaa@csgabriel.edu.ec','2272203',1,'P','0000-00-00','','0000-00-00','20060136.JPG','A','A','1','1','20060136'),(527,1,1,1,1,1013,1,'Gian Carlo','RUZZI  VILLACRÉS','C','1723249403','0000-00-00','URB. BILOXI 116','aaa@csgabriel.edu.ec','2634156',1,'P','0000-00-00','','0000-00-00','20060137.JPG','A','A','1','1','20060137'),(528,1,1,1,1,1013,1,'Diego Oswaldo','SÁENZ  PEÑAFIEL','C','502436934','0000-00-00','AV. PICHINCHA 23-60. CONOCOTO','aaa@csgabriel.edu.ec','2072285',1,'P','0000-00-00','','0000-00-00','20060139.JPG','A','A','1','1','20060139'),(529,1,1,1,1,1013,1,'Ángel Eduardo','SALAZAR  DÍAZ','C','1721447504','0000-00-00','QUITUMBE 6048 Y AV. DEL MAESTRO','aaa@csgabriel.edu.ec','2537286',1,'P','0000-00-00','','0000-00-00','20060140.JPG','A','A','1','1','20060140'),(530,1,1,1,1,1013,1,'Juan Sebastián','SEGOVIA  MIÑO','C','1722252549','0000-00-00','EUSTORGIO SALGADO Y STA. ROSA','aaa@csgabriel.edu.ec','3215943',1,'P','0000-00-00','','0000-00-00','20060142.JPG','A','A','1','1','20060142'),(531,1,1,1,1,1013,1,'Diego Alejandro','SILVA  CEVALLOS','C','1718170473','0000-00-00','CONJ.SAN FELIPE DEL PINAR BL-6 D-104','aaa@csgabriel.edu.ec','3303083',1,'P','0000-00-00','','0000-00-00','20060143.JPG','A','A','1','1','20060143'),(532,1,1,1,1,1013,1,'Gerardo Alexander','SILVA  ORTIZ','C','1722622873','0000-00-00','CAÑARIS OE5-68 Y DUCHICELA','aaa@csgabriel.edu.ec','2664568',1,'P','0000-00-00','','0000-00-00','20060144.JPG','A','A','1','1','20060144'),(533,1,1,1,1,1013,1,'Johan Edison','SINGAÑA  GUAÑA','C','1720599578','0000-00-00','ORIENTE OE3-77 Y GUAYAQUIL','aaa@csgabriel.edu.ec','2958931',1,'P','0000-00-00','','0000-00-00','20060145.JPG','A','A','1','1','20060145'),(534,1,1,1,1,1013,1,'Kevin Ricardo','SOLÍS  FRÍAS','C','1723301154','0000-00-00','JARDINES DE CARCELÉN D-18','aaa@csgabriel.edu.ec','2429190',1,'P','0000-00-00','','0000-00-00','20060146.JPG','A','A','1','1','20060146'),(535,1,1,1,1,1013,1,'Ricardo Leonidas','SUBÍA  CARRERA','C','1718165077','0000-00-00','LORENZO ALDANA 157 Y AMÉRICA','aaa@csgabriel.edu.ec','2226337',1,'P','0000-00-00','','0000-00-00','20060147.JPG','A','A','1','1','20060147'),(536,1,1,1,1,1013,1,'Alexis Enrique','SUZA  HARO','C','1722214846','0000-00-00','CASALES BUENAVENTURA 2DA.ETAPA C-120','aaa@csgabriel.edu.ec','2822660',1,'P','0000-00-00','','0000-00-00','20060148.JPG','A','A','1','1','20060148'),(537,1,1,1,1,1013,1,'Andrés Sebastián','TERÁN  ZAVALA','C','1716392442','0000-00-00','BERRUTIETA OE9-98 Y RITTER','aaa@csgabriel.edu.ec','3200619',1,'P','0000-00-00','','0000-00-00','20060150.JPG','A','A','1','1','20060150'),(538,1,1,1,1,1013,1,'Carlos Andrés','TOBAR  LOJÁN','C','1723296669','0000-00-00','FRANCISCO SÁNCHEZ N78-134 Y COSME OSORIO. CARCELÉN','aaa@csgabriel.edu.ec','2471339',1,'P','0000-00-00','','0000-00-00','20060151.JPG','A','A','1','1','20060151'),(539,1,1,1,1,1013,1,'David Alejandro','TORO  GALÁRRAGA','C','1722465356','0000-00-00','SENIERGUES 228 Y SOLANO','aaa@csgabriel.edu.ec','2558898',1,'P','0000-00-00','','0000-00-00','20060152.JPG','A','A','1','1','20060152'),(540,1,1,1,1,1013,1,'Fernando Andrés','TORRES  LANDÁZURI','C','1717639403','0000-00-00','SEBASTIÁN BUARA N60-51 Y AV.DEL MAESTRO','aaa@csgabriel.edu.ec','2597074',1,'P','0000-00-00','','0000-00-00','20060153.JPG','A','A','1','1','20060153'),(541,1,1,1,1,1013,1,'Sergio René','TORRES  RENTERÍA','C','1719996942','0000-00-00','RITHER N23-67. LA GASCA','aaa@csgabriel.edu.ec','3202174',1,'P','0000-00-00','','0000-00-00','20060154.JPG','A','A','1','1','20060154'),(542,1,1,1,1,1013,1,'John Andrés','TRUJILLO  ESTRELLA','C','1723244495','0000-00-00','RAFAEL GARCÍA.CHILLOGALLO','aaa@csgabriel.edu.ec','2961282',1,'P','0000-00-00','','0000-00-00','20060155.JPG','A','A','1','1','20060155'),(543,1,1,1,1,1013,1,'Ronnie Sebastián','TRUJILLO  PABÓN','C','1723258321','0000-00-00','JOSÉ ENRIQUE GUERRERO 84','aaa@csgabriel.edu.ec','2471578',1,'P','0000-00-00','','0000-00-00','20060156.JPG','A','A','1','1','20060156'),(544,1,1,1,1,1013,1,'Washington Danilo','URBANO  VARGAS','C','1722406863','0000-00-00','CALLE OE2.B C-26. URB. QUITUMBE','aaa@csgabriel.edu.ec','2675031',1,'P','0000-00-00','','0000-00-00','20060157.JPG','A','A','1','1','20060157'),(545,1,1,1,1,1013,1,'Diego Oswaldo','URQUIA  BUENAÑO','C','1722373063','0000-00-00','COCHAPAMBA SUR','aaa@csgabriel.edu.ec','3316178',1,'P','0000-00-00','','0000-00-00','20060158.JPG','A','A','1','1','20060158'),(546,1,1,1,1,1013,1,'Francisco Javier','URRESTA  JÁTIVA','C','1716601339','0000-00-00','LLANGARIMA 667 Y TUFIÑO','aaa@csgabriel.edu.ec','2482613',1,'P','0000-00-00','','0000-00-00','20060159.JPG','A','A','1','1','20060159'),(547,1,1,1,1,1013,1,'Francisco Xavier','VACA  SIERRA','C','1716623259','0000-00-00','STA.TERESA N70-160 Y ALFONSO DEL HIERRO','aaa@csgabriel.edu.ec','2499997',1,'P','0000-00-00','','0000-00-00','20060160.JPG','A','A','1','1','20060160'),(548,1,1,1,1,1013,1,'Christian Bernardo','VALENCIA  ARAGÓN','C','1721253274','0000-00-00','PEDRO COLLAZOS S7-166 Y ALPAHUASI','aaa@csgabriel.edu.ec','2616669',1,'P','0000-00-00','','0000-00-00','20060162.JPG','A','A','1','1','20060162'),(549,1,1,1,1,1013,1,'Christian Alexander','VALENCIA  CAMPOVERDE','C','1722956818','0000-00-00','CDLA.EX-CEPE CALLE BR 1 L-184. CUMBAYÁ','aaa@csgabriel.edu.ec','2893241',1,'P','0000-00-00','','0000-00-00','20060163.JPG','A','A','1','1','20060163'),(550,1,1,1,1,1013,1,'Sebastián Alejandro','VALENCIA  PÉREZ','C','1718862210','0000-00-00','CONJ. LA JOYA #39','aaa@csgabriel.edu.ec','2354748',1,'P','0000-00-00','','0000-00-00','20060164.JPG','A','A','1','1','20060164'),(551,1,1,1,1,1013,1,'Néstor Hernán','VALENZUELA  SUASNAVAS','C','1723123491','0000-00-00','CALLE PULULAHUA 870. MITAD DEL MUNDO','aaa@csgabriel.edu.ec','2395984',1,'P','0000-00-00','','0000-00-00','20060165.JPG','A','A','1','1','20060165'),(552,1,1,1,1,1013,1,'Wilson Andrés','VALVERDE  BARRAGÁN','C','1720097698','0000-00-00','JUAN BORGOÑÓN S8-175 Y J. ALCÁZAR','aaa@csgabriel.edu.ec','2655038',1,'P','0000-00-00','','0000-00-00','20060168.JPG','A','A','1','1','20060168'),(553,1,1,1,1,1013,1,'Roberto Javier','VASCO  AGUILAR','C','1721593232','0000-00-00','URB.LA ARMENIA CALLE 1-10 #313','aaa@csgabriel.edu.ec','2341571',1,'P','0000-00-00','','0000-00-00','20060169.JPG','A','A','1','1','20060169'),(554,1,1,1,1,1013,1,'Andrés','VÁSCONEZ  GORDILLO','C','1723065338','0000-00-00','JUAN LAGOS OE639 Y PEDRO CAPIRO','aaa@csgabriel.edu.ec','2667804',1,'P','0000-00-00','','0000-00-00','20060170.JPG','A','A','1','1','20060170'),(555,1,1,1,1,1013,1,'Andrés Nicolás','VÁSCONEZ  JARAMILLO','C','201905932','0000-00-00','JUAN GALINDEZ 111 Y 10 DE AGOSTO','aaa@csgabriel.edu.ec','2439922',1,'P','0000-00-00','','0000-00-00','20060171.JPG','A','A','1','1','20060171'),(556,1,1,1,1,1013,1,'Ismael Enrique','VILLAGÓMEZ  PAREDES','C','1722976212','0000-00-00','JOSÉ MENDOZA OE5-53','aaa@csgabriel.edu.ec','2669712',1,'P','0000-00-00','','0000-00-00','20060172.JPG','A','A','1','1','20060172'),(557,1,1,1,1,1013,1,'Ricardo Xavier','YAJAMÍN  VILLAMARÍN','C','1721356978','0000-00-00','SANTA TERESA N65-110 Y LIBERTADORES. COTOCOLLAO','aaa@csgabriel.edu.ec','2536707',1,'P','0000-00-00','','0000-00-00','20060173.JPG','A','A','1','1','20060173'),(558,1,1,1,1,1013,1,'Bryan Fernando','YÁNEZ  HERMOZA','C','1718166562','0000-00-00','ANA PAREDES DE ALFARO S9-465','aaa@csgabriel.edu.ec','2641617',1,'P','0000-00-00','','0000-00-00','20060175.JPG','A','A','1','1','20060175'),(559,1,1,1,1,1013,1,'Mario Raid','YÁNEZ  TERÁN','C','1720409141','0000-00-00','SOLANDA.','aaa@csgabriel.edu.ec','2682809',1,'P','0000-00-00','','0000-00-00','20060176.JPG','A','A','1','1','20060176'),(560,1,1,1,1,1013,1,'Juan Pablo','YUNDA  DÍAZ','C','1720350006','0000-00-00','CAMPIÑAS DEL MADRIGAL L-4','aaa@csgabriel.edu.ec','3194758',1,'P','0000-00-00','','0000-00-00','20060177.JPG','A','A','1','1','20060177'),(561,1,1,1,1,1013,1,'Roberto Agustín','ZAMBRANO  VALENCIA','C','1716028145','0000-00-00','CALLE B L-25 C-5 Y CALLE A. PINAR ALTO','aaa@csgabriel.edu.ec','3571249',1,'P','0000-00-00','','0000-00-00','20060178.JPG','A','A','1','1','20060178'),(562,1,1,1,1,1013,1,'Bryan Andrés','ZURITA  GARCÍA','C','1721474680','0000-00-00','CDLA. EL CALZADO MZ-9 C-20','aaa@csgabriel.edu.ec','2669451',1,'P','0000-00-00','','0000-00-00','20060179.JPG','A','A','1','1','20060179'),(563,1,1,1,1,1013,1,'Stéfano José','MIRANDA  JIMÉNEZ','C','1718171844','0000-00-00','CONJ.FONTANA DEL SOL C-16. PONCIANO','aaa@csgabriel.edu.ec','2473754',1,'P','0000-00-00','','0000-00-00','20060180.JPG','A','A','1','1','20060180'),(564,1,1,1,1,1013,1,'Carlos Patricio','LLERENA  CABEZAS','C','1722002407','0000-00-00','CALLE C Y PUNÍN S/N. CALDERÓN','aaa@csgabriel.edu.ec','2821436',1,'P','0000-00-00','','0000-00-00','20060181.JPG','A','A','1','1','20060181'),(565,1,1,1,1,1013,1,'Francisco David','LUNA  AGUIRRE','C','1718321993','0000-00-00','COND.TERRAZAS DEL DORADO BL-6 D-505. AV.COLOMBIA Y','aaa@csgabriel.edu.ec','2223368',1,'P','0000-00-00','','0000-00-00','20060182.JPG','A','A','1','1','20060182'),(566,1,1,1,1,1013,1,'Carlos Eduardo','MARTÍNEZ  MURILLO','C','1723253710','0000-00-00','LAS MALVAS N45-135 E HIGUERAS','aaa@csgabriel.edu.ec','2443379',1,'P','0000-00-00','','0000-00-00','20060183.JPG','A','A','1','1','20060183'),(567,1,1,1,1,1013,1,'Juan Sebastián','TRÁVEZ  MOLINA','C','1717201170','0000-00-00','SOLANO E15-45 Y SÁENZ','aaa@csgabriel.edu.ec','3227844',1,'P','0000-00-00','','0000-00-00','20060185.JPG','A','A','1','1','20060185'),(568,1,1,1,1,1013,1,'Michael Antonio','PERALTA  CAIZALUISA','C','1719271296','0000-00-00','PÉREZ PAREJA 511 Y LUIS CORDERO. MACHACHI','aaa@csgabriel.edu.ec','2314202',1,'P','0000-00-00','','0000-00-00','20060190.JPG','A','A','1','1','20060190'),(569,1,1,1,1,1013,1,'Diego Sebastián','SANTANA  ALARCÓN','C','1723114813','0000-00-00','ARENILLAS 209 Y GRAL.PINTAG','aaa@csgabriel.edu.ec','2665944',1,'P','0000-00-00','','0000-00-00','20060200.JPG','A','A','1','1','20060200'),(570,1,1,1,1,1013,1,'Dario Vinicio','FREIRE  BARAHONA','C','1723120539','0000-00-00','GUAYACANES N55-29 Y LOS PINOS','aaa@csgabriel.edu.ec','2412871',1,'P','0000-00-00','','0000-00-00','20060202.JPG','A','A','1','1','20060202'),(571,1,1,1,1,1013,1,'Andrés Sebastián','SÁNCHEZ  PÁEZ','C','1714599600','0000-00-00','JAIME CHIRIBOGA 261','aaa@csgabriel.edu.ec','3300289',1,'P','0000-00-00','','0000-00-00','20060203.JPG','A','A','1','1','20060203'),(572,1,1,1,1,1013,1,'Isaac Andrés','MERCHÁN  QUITO','C','1719302331','0000-00-00','PORTOVIEJO OE3-367 Y AYACUCHO','aaa@csgabriel.edu.ec','3216790',1,'P','0000-00-00','','0000-00-00','20060204.JPG','A','A','1','1','20060204'),(573,1,1,1,1,1013,1,'Gabriel Andrés','BACA  SANDOVAL','C','1719253120','0000-00-00','TEGUCIGALPA 367 Y AGUILAR','aaa@csgabriel.edu.ec','2548655',1,'P','0000-00-00','','0000-00-00','20060205.JPG','A','A','1','1','20060205'),(574,1,1,1,1,1013,1,'Ricardo Xavier','BASTIDAS  SANTOS','C','1713922969','0000-00-00','YUMBOS N50-245 Y HOMERO SALAS','aaa@csgabriel.edu.ec','2462997',1,'P','0000-00-00','','0000-00-00','20060206.JPG','A','A','1','1','20060206'),(575,1,1,1,1,1013,1,'Juan Fernando','CARRIÓN  MONTOYA','C','1002772521','0000-00-00','VENEZUELA N13-111 Y ANTONIO ANTE','aaa@csgabriel.edu.ec','2956583',1,'P','0000-00-00','','0000-00-00','20060207.JPG','A','A','1','1','20060207'),(576,1,1,1,1,1013,1,'Bryan Kevin','LEDESMA  NARVÁEZ','C','1718165358','0000-00-00','MAÑOSCA 397 Y AV. REPÚBLICA','aaa@csgabriel.edu.ec','2240334',1,'P','0000-00-00','','0000-00-00','20060209.JPG','A','A','1','1','20060209'),(577,1,1,1,1,1013,1,'José Andrés','MARCILLO  ARBOLEDA','C','1721491650','0000-00-00','SUCRE 118 Y BOLÍVAR. SANGOLQUÍ.','aaa@csgabriel.edu.ec','2334385',1,'P','0000-00-00','','0000-00-00','20060210.JPG','A','A','1','1','20060210'),(578,1,1,1,1,1013,1,'Carlos Alejandro','MOLINA  LAYEDRA','C','1723245351','0000-00-00','JULIAN ESTRELLA 1766 Y LAUREANO DE LA CRUZ','aaa@csgabriel.edu.ec','2639685',1,'P','0000-00-00','','0000-00-00','20060211.JPG','A','A','1','1','20060211'),(579,1,1,1,1,1013,1,'David André','VILLAMIL  CARRILLO','C','1722946629','0000-00-00','ROBERTO PÁEZ N49-59. LA LUZ','aaa@csgabriel.edu.ec','2813415',1,'P','0000-00-00','','0000-00-00','20060212.JPG','A','A','1','1','20060212'),(580,1,1,1,1,1013,1,'Manuel Alejandro','VINUEZA  MORALES','C','1723134662','0000-00-00','CARACAS OE3-216 Y VENEZUELA','aaa@csgabriel.edu.ec','3217021',1,'P','0000-00-00','','0000-00-00','20060213.JPG','A','A','1','1','20060213'),(581,1,1,1,1,1013,1,'Harold Andree','VALVERDE  CARRERA','C','1718166471','0000-00-00','EUGENIO PEYRAMALE E12-14 Y A.ESPINOZA','aaa@csgabriel.edu.ec','3452203',1,'P','0000-00-00','','0000-00-00','20060214.JPG','A','A','1','1','20060214'),(582,1,1,1,1,1013,1,'Alejandro Augusto','PONCE  MARIÑO','C','1803673548','0000-00-00','TNT. HUGO ORTIZ S15-79','aaa@csgabriel.edu.ec','2627852',1,'P','0000-00-00','','0000-00-00','20060215.JPG','A','A','1','1','20060215'),(583,1,1,1,1,1013,1,'Víctor Alejandro','ACOSTA  ZURITA','C','1717344475','0000-00-00','URB. SAN PEDRO CLAVER BL. AD-66','aaa@csgabriel.edu.ec','2292290',1,'P','0000-00-00','','0000-00-00','20060218.JPG','A','A','1','1','20060218'),(584,1,1,1,1,1013,1,'Jonathan David','CARPIO  GÓMEZ','C','1722017322','0000-00-00','EDÉN DEL VALLE PAS.P E18-260','aaa@csgabriel.edu.ec','2320770',1,'P','0000-00-00','','0000-00-00','20060219.JPG','A','A','1','1','20060219'),(585,1,1,1,1,1013,1,'David Alejandro','CORONEL  ARGUELLO','C','1718165010','0000-00-00','EL VERGEL Y A.PÉREZ CONJ.EL PIONERO BL.9 D-5B','aaa@csgabriel.edu.ec','2425139',1,'P','0000-00-00','','0000-00-00','20060220.JPG','A','A','1','1','20060220'),(586,1,1,1,1,1013,1,'Jaime Augusto','MATA  VALLE','C','1723297295','0000-00-00','ESPEJO Y JIMÉNEZ CONJ.IESS','aaa@csgabriel.edu.ec','2282678',1,'P','0000-00-00','','0000-00-00','20060221.JPG','A','A','1','1','20060221'),(587,1,1,1,1,1013,1,'Jonathan David','MORENO  PALLO','C','1721537668','0000-00-00','PEDRO ZUMÁRRAGA 221','aaa@csgabriel.edu.ec','2951321',1,'P','0000-00-00','','0000-00-00','20060223.JPG','A','A','1','1','20060223'),(588,1,1,1,1,1013,1,'Diego Andrés','PÉREZ  MENA','C','1722773684','0000-00-00','DIÓGENES PAREDES Y ALGARROBOS 543','aaa@csgabriel.edu.ec','2407785',1,'P','0000-00-00','','0000-00-00','20060224.JPG','A','A','1','1','20060224'),(589,1,1,1,1,1013,1,'Santiago Alexander','PILLA  ALMEIDA','C','1723254049','0000-00-00','CONJ. DOS HEMISFERIOS.','aaa@csgabriel.edu.ec','2351149',1,'P','0000-00-00','','0000-00-00','20060225.JPG','A','A','1','1','20060225'),(590,1,1,1,1,1013,1,'Daniel Alejandro','SOLIZ  ALARCÓN','C','1717397697','0000-00-00','CARVAJAL 195 Y LA GASCA','aaa@csgabriel.edu.ec','2907561',1,'P','0000-00-00','','0000-00-00','20060226.JPG','A','A','1','1','20060226'),(591,1,1,1,1,1013,1,'Gabriel Sebastián','TRONCOSO  ALDAS','C','1721679858','0000-00-00','JAVIER LOYOLA Y S.BOLÍVAR. URB.CAROLINA 2','aaa@csgabriel.edu.ec','2321003',1,'P','0000-00-00','','0000-00-00','20060227.JPG','A','A','1','1','20060227'),(592,1,1,1,1,1013,1,'David Esteban','VELOZ  DÍAZ','C','604313593','0000-00-00','AV.OCCIDENTAL N70-455. EL CONDADO','aaa@csgabriel.edu.ec','2490890',1,'P','0000-00-00','','0000-00-00','20060229.JPG','A','A','1','1','20060229'),(593,1,1,1,1,1013,1,'Antony Paúl','VELOZ  MAURIZACA','C','1719507517','0000-00-00','FERNÁNDEZ DE RECALDE 2316','aaa@csgabriel.edu.ec','2553467',1,'P','0000-00-00','','0000-00-00','20060230.JPG','A','A','1','1','20060230'),(594,1,1,1,1,1013,1,'Pablo Sebastián','YANCHAPAXI  SILVA','C','1722905450','0000-00-00','RÍO DE JANEIRO 1048','aaa@csgabriel.edu.ec','2506690',1,'P','0000-00-00','','0000-00-00','20060231.JPG','A','A','1','1','20060231'),(595,1,1,1,1,1013,1,'Richard Abdiel','FLORES  SIMBA','C','1717484230','0000-00-00','NICOLÁS LÓPEZ N48-296 Y F.MIRANDA','aaa@csgabriel.edu.ec','2241016',1,'P','0000-00-00','','0000-00-00','20060232.JPG','A','A','1','1','20060232'),(596,1,1,1,1,1013,1,'Juan Diego','GORDÓN  CISNEROS','C','1716308455','0000-00-00','9 DE AGOSTO 860 Y FUNIN.CALDERÓN','aaa@csgabriel.edu.ec','2822411',1,'P','0000-00-00','','0000-00-00','20060233.JPG','A','A','1','1','20060233'),(597,1,1,1,1,1013,1,'Carlos Michael','MORENO  PIEDRA','C','1723189161','0000-00-00','HUIGRA L-10 Y AJAVÍ','aaa@csgabriel.edu.ec','2844428',1,'P','0000-00-00','','0000-00-00','20060234.JPG','A','A','1','1','20060234'),(598,1,1,1,1,1013,1,'Cristian Alexander','MUÑOZ  TOBAR','C','1717411746','0000-00-00','10 DE AGOSTO 9602 Y LOS PINOS','aaa@csgabriel.edu.ec','2400704',1,'P','0000-00-00','','0000-00-00','20060235.JPG','A','A','1','1','20060235'),(599,1,1,1,1,1013,1,'Mateo Sebastián','LLANO  ARTETA','C','1719435891','0000-00-00','ODISPO D. DE LA MADRID S/N','aaa@csgabriel.edu.ec','2548206',1,'P','0000-00-00','','0000-00-00','20060236.JPG','A','A','1','1','20060236'),(600,1,1,1,1,1013,1,'Juan Francisco','ALMACHE  ALBARRACÍN','C','1723268445','0000-00-00','ANTONIO DE HERERA 334','aaa@csgabriel.edu.ec','2663723',1,'P','0000-00-00','','0000-00-00','20060237.JPG','A','A','1','1','20060237'),(601,1,1,1,1,1013,1,'Jordan Gonzalo','LLERENA  VELASTEGUI','C','1717394397','0000-00-00','MOSQUERA NARVÁEZ 284 Y VERSALLES','aaa@csgabriel.edu.ec','2239044',1,'P','0000-00-00','','0000-00-00','20060239.JPG','A','A','1','1','20060239'),(602,1,1,1,1,1013,1,'Luis Miguel','MUÑOZ  FONSECA','C','1722241799','0000-00-00','URB.LAS CUADRAS BL-13 D-402. CHILLOGALLO','aaa@csgabriel.edu.ec','2633404',1,'P','0000-00-00','','0000-00-00','20060240.JPG','A','A','1','1','20060240'),(603,1,1,1,1,1013,1,'Bryan Alexander','PLAZARTE  MICHILENA','C','1723076814','0000-00-00','MATHIAS BIGO C-A.5 Y ANDRÉS SEGURA. LA MAGDALENA','aaa@csgabriel.edu.ec','2661929',1,'P','0000-00-00','','0000-00-00','20060242.JPG','A','A','1','1','20060242'),(604,1,1,1,1,1013,1,'Freddy Paúl','MORENO  BARAHONA','C','1718303090','0000-00-00','CONJ.GALES II C-2. LA ARMENIA','aaa@csgabriel.edu.ec','2520123',1,'P','0000-00-00','','0000-00-00','20060243.JPG','A','A','1','1','20060243'),(605,1,1,1,1,1013,1,'Emilio Nicolás','DE  LA TORRE RODRÍGUEZ','C','1722946603','0000-00-00','DE LAS PALMERAS N47-65 Y MADROÑOS.','aaa@csgabriel.edu.ec','3342922',1,'P','0000-00-00','','0000-00-00','20060244.JPG','A','A','1','1','20060244'),(606,1,1,1,1,1013,1,'Víctor Israel','BOHÓRQUEZ  YUNDA','C','1718166257','0000-00-00','PILAHUIN 350. CDLA. MÉXICO','aaa@csgabriel.edu.ec','2654222',1,'P','0000-00-00','','0000-00-00','20060245.JPG','A','A','1','1','20060245'),(607,1,1,1,1,1013,1,'Carlos Andrés','PASPUEL  CHIRIBOGA','C','1718165168','0000-00-00','MACHALA 2871 Y FLAVIO ALFARO','aaa@csgabriel.edu.ec','2596186',1,'P','0000-00-00','','0000-00-00','20060246.JPG','A','A','1','1','20060246'),(608,1,1,1,1,1013,1,'Mauricio David','ALMEIDA  FLORES','C','1724232952','0000-00-00','MODESTO CHÁVEZ Y ALBERTO EINSTEIN','aaa@csgabriel.edu.ec','2480239',1,'P','0000-00-00','','0000-00-00','20070223.JPG','A','A','1','1','20070223'),(609,1,1,1,1,1013,1,'Ramiro Andrés','ALTAMIRANO  ORDÓÑEZ','C','1723202790','0000-00-00','EMILIO BUSTAMANTE N70-99','aaa@csgabriel.edu.ec','2492647',1,'P','0000-00-00','','0000-00-00','20070224.JPG','A','A','1','1','20070224'),(610,1,1,1,1,1013,1,'José Andrés','ARGUELLO  MERA','C','603533456','0000-00-00','CALLE DE LOS OLIVOS Y 7MA. TRANSVERSAL','aaa@csgabriel.edu.ec','2416940',1,'P','0000-00-00','','0000-00-00','20070225.JPG','A','A','1','1','20070225'),(611,1,1,1,1,1013,1,'Pablo Martín','BOADA  SANDOVAL','C','1719340547','0000-00-00','CONJ. BRASILIA II CASA 265','aaa@csgabriel.edu.ec','2410950',1,'P','0000-00-00','','0000-00-00','20070226.JPG','A','A','1','1','20070226'),(612,1,1,1,1,1013,1,'Marcelo Eduardo','ESPÍN  GUERRA','C','1723121131','0000-00-00','ULLOA N31-124 Y MARIANA DE JESÚS','aaa@csgabriel.edu.ec','3260454',1,'P','0000-00-00','','0000-00-00','20070227.JPG','A','A','1','1','20070227'),(613,1,1,1,1,1013,1,'José Alejandro','TORRES  BALAREZO','C','1721713483','0000-00-00','ATACAMES 205 Y AV. LA GASCA','aaa@csgabriel.edu.ec','2551474',1,'P','0000-00-00','','0000-00-00','20070228.JPG','A','A','1','1','20070228'),(614,1,1,1,1,1013,1,'Mateo Alejandro','ZURITA  GRANJA','C','1720829843','0000-00-00','CONJ. CAROLINA II CASA 52','aaa@csgabriel.edu.ec','2320676',1,'P','0000-00-00','','0000-00-00','20070229.JPG','A','A','1','1','20070229'),(615,1,1,1,1,1013,1,'Ramiro Guillermo','SEGOVIA  VARGAS','C','1723129811','0000-00-00','ARMERO OE7-113','aaa@csgabriel.edu.ec','2548519',1,'P','0000-00-00','','0000-00-00','20070230.JPG','A','A','1','1','20070230'),(616,1,1,1,1,1013,1,'Marco René','CAMACHO  QUIJANO','C','1722260542','0000-00-00','CONJ.PALERMO MZ-61 C-11','aaa@csgabriel.edu.ec','3032195',1,'P','0000-00-00','','0000-00-00','20070231.JPG','A','A','1','1','20070231'),(617,1,1,1,1,1013,1,'Mario Sebastián','YEPEZ  ARRATA','C','1723509061','0000-00-00','BRACAMOROS 104','aaa@csgabriel.edu.ec','2267224',1,'P','0000-00-00','','0000-00-00','20070251.JPG','A','A','1','1','20070251'),(618,1,1,1,1,1013,1,'Luis Miguel','ACEVEDO  HEREDIA','C','1716592579','2034-08-05','AV.M.CÓRDOVA G. CONJ.LAGUNA AZUL C-59','aaa@csgabriel.edu.ec','96257952',1,'P','0000-00-00','','0000-00-00','20050001.JPG','A','A','1','1','20050001'),(619,1,1,1,1,1013,1,'Ronald Josue','AGUILERA  ANDRADE','C','1719113845','2034-07-08','SIMÓN CÁRDENAS 710 Y VACA DE CASTRO','aaa@csgabriel.edu.ec','2531080',1,'P','0000-00-00','','0000-00-00','20050002.JPG','A','A','1','1','20050002'),(620,1,1,1,1,1013,1,'Bernardo Antonio','AGUIRRE  FERNÁNDEZ','C','1722480074','0000-00-00','EL MORLAN N52-09 E ISAAC BARRERA','aaa@csgabriel.edu.ec','2811944',1,'P','0000-00-00','','0000-00-00','20050003.JPG','A','A','1','1','20050003'),(621,1,1,1,1,1013,1,'Diego Fernando','ALARCÓN  GARCÉS','C','1722105176','0000-00-00','URB.MONTESERRÍN. AMAPOLAS 46-26 Y ALONDRAS','aaa@csgabriel.edu.ec','2432994',1,'P','0000-00-00','','0000-00-00','20050004.JPG','A','A','1','1','20050004'),(622,1,1,1,1,1013,1,'Edison Adrián','ALBÁN  ALBÁN','C','1722313010','2034-10-01','BUENAVENTURA ETAPA II','aaa@csgabriel.edu.ec','2827614',1,'P','0000-00-00','','0000-00-00','20050005.JPG','A','A','1','1','20050005'),(623,1,1,1,1,1013,1,'Daniel','ALBÁN  ARAUJO','C','1714822390','0000-00-00','INCA 2887','aaa@csgabriel.edu.ec','2444936',1,'P','0000-00-00','','0000-00-00','20050006.JPG','A','A','1','1','20050006'),(624,1,1,1,1,1013,1,'Esteban Alexander','ALBÁN  BAJAÑA','C','1718291154','0000-00-00','SABANILLA C-32 Y HUACHI. QUITO NORTE. COND.OCCIDEN','aaa@csgabriel.edu.ec','2536599',1,'P','0000-00-00','','0000-00-00','20050007.JPG','A','A','1','1','20050007'),(625,1,1,1,1,1013,1,'Carlos Emilio','ALBARRACÍN  REVELO','C','1722304514','0000-00-00','URB.BILOXI CALLE 6-A # 200','aaa@csgabriel.edu.ec','2635467',1,'P','0000-00-00','','0000-00-00','20050008.JPG','A','A','1','1','20050008'),(626,1,1,1,1,1013,1,'Carlos Andrés','ALMEIDA  CEDEÑO','C','1719246025','0000-00-00','HERNÁNDEZ DE GIRÓN 765 Y PEDREGAL','aaa@csgabriel.edu.ec','2435735',1,'P','0000-00-00','','0000-00-00','20050009.JPG','A','A','1','1','20050009'),(627,1,1,1,1,1013,1,'Francisco Sebastián','ALMEIDA  VITERI','C','1721402590','2034-02-00','GEOVANNY CALLES 520 Y DUCHICELA','aaa@csgabriel.edu.ec','2828041',1,'P','0000-00-00','','0000-00-00','20050011.JPG','A','A','1','1','20050011'),(628,1,1,1,1,1013,1,'Javiv Fernando','AMAYA  BATALLAS','C','1722216148','0000-00-00','CARAPUNGO. AV.QUITO MZ.A-11 E-25','aaa@csgabriel.edu.ec','2010157',1,'P','0000-00-00','','0000-00-00','20050012.JPG','A','A','1','1','20050012'),(629,1,1,1,1,1013,1,'Andrés Marcelo','ANDRADE  PEÑAHERRERA','C','1721838876','0000-00-00','CONJ.SAN SEBASTIÁN DE CALDERÓN E1 C.B-16','aaa@csgabriel.edu.ec','2826146',1,'P','0000-00-00','','0000-00-00','20050013.JPG','A','A','1','1','20050013'),(630,1,1,1,1,1013,1,'Omar Alexander','ARGUELLO  PRADO','C','1718167545','0000-00-00','CONJ.LOYOLA  BL-44 D-22','aaa@csgabriel.edu.ec','2594438',1,'P','0000-00-00','','0000-00-00','20050014.JPG','A','A','1','1','20050014'),(631,1,1,1,1,1013,1,'Robinson David','ARÉVALO  JARAMILLO','C','1719836916','2034-07-06','VELASCO IBARRA S/N E ISIDRO AYORA C-13. CARCELÉN','aaa@csgabriel.edu.ec','2809026',1,'P','0000-00-00','','0000-00-00','20050015.JPG','A','A','1','1','20050015'),(632,1,1,1,1,1013,1,'Juan Sebastián','ARIAS  REVELO','C','1722242748','0000-00-00','RAMÓN VALAREZO N58-17','aaa@csgabriel.edu.ec','2294881',1,'P','0000-00-00','','0000-00-00','20050016.JPG','A','A','1','1','20050016'),(633,1,1,1,1,1013,1,'César Esteban','ARMAS  VALAREZO','C','1722463153','0000-00-00','ELIZALOE E6-52 E IQUIQUE','aaa@csgabriel.edu.ec','2586861',1,'P','0000-00-00','','0000-00-00','20050017.JPG','A','A','1','1','20050017'),(634,1,1,1,1,1013,1,'Leonardo Rafael','ARREGUI  CORONEL','C','1722212121','0000-00-00','LA PAMPA CALLE C 111','aaa@csgabriel.edu.ec','2352309',1,'P','0000-00-00','','0000-00-00','20050018.JPG','A','A','1','1','20050018'),(635,1,1,1,1,1013,1,'Esteban Fernando','ARTEAGA  BALDEÓN','C','1722379011','0000-00-00','CHANDUY N63-66 Y FÁTIMA','aaa@csgabriel.edu.ec','2471353',1,'P','0000-00-00','','0000-00-00','20050019.JPG','A','A','1','1','20050019'),(636,1,1,1,1,1013,1,'Josue David','ARTEAGA  TORRES','C','1721936688','2034-00-07','PASAJE B #55 Y ZAMORA','aaa@csgabriel.edu.ec','2459786',1,'P','0000-00-00','','0000-00-00','20050020.JPG','A','A','1','1','20050020'),(637,1,1,1,1,1013,1,'Juan Martín','AULESTIA  CALERO','C','1722389390','2034-09-09','JUAN SAMANO OE6-140','aaa@csgabriel.edu.ec','2533640',1,'P','0000-00-00','','0000-00-00','20050021.JPG','A','A','1','1','20050021'),(638,1,1,1,1,1013,1,'Danny Ricardo','AUZ  CHÁVEZ','C','1718164773','0000-00-00','FRANCISCO MONTALVO OE9-282 Y LORANTE','aaa@csgabriel.edu.ec','2276641',1,'P','0000-00-00','','0000-00-00','20050022.JPG','A','A','1','1','20050022'),(639,1,1,1,1,1013,1,'Christian Alejandro','AYALA  SUÁREZ','C','1722251186','0000-00-00','IGNACIO LOYOLA BL-43  D-22','aaa@csgabriel.edu.ec','2599809',1,'P','0000-00-00','','0000-00-00','20050024.JPG','A','A','1','1','20050024'),(640,1,1,1,1,1013,1,'Antonio Alberto','BÁEZ  CAZORLA','C','1722219712','2034-12-02','JOAQUÍN PINTO E4-342 Y AMAZONAS','aaa@csgabriel.edu.ec','2565724',1,'P','0000-00-00','','0000-00-00','20050025.JPG','A','A','1','1','20050025'),(641,1,1,1,1,1013,1,'David Javier','BALLAGÁN  ROMERO','C','1722305669','0000-00-00','COVI 520, MONJAS ALTO','aaa@csgabriel.edu.ec','3195285',1,'P','0000-00-00','','0000-00-00','20050026.JPG','A','A','1','1','20050026'),(642,1,1,1,1,1013,1,'Erick Patricio','BALLESTEROS  VALDIVIESO','C','1722379219','2034-10-03','URB. SANTA MARIANITA C-123','aaa@csgabriel.edu.ec','2035767',1,'P','0000-00-00','','0000-00-00','20050027.JPG','A','A','1','1','20050027'),(643,1,1,1,1,1013,1,'Andrés Alejandro','BANDA  GUILLÉN','C','1718164658','0000-00-00','SANTA TERESA N70-271 Y ALFONSO HIERRO','aaa@csgabriel.edu.ec','2956654',1,'P','0000-00-00','','0000-00-00','20050028.JPG','A','A','1','1','20050028'),(644,1,1,1,1,1013,1,'Diego Enrique','BARAHONA  SAQUICELA','C','1721543302','2034-02-00','MURIALDO E7-93 Y 6 DE DICEMBRE C-42','aaa@csgabriel.edu.ec','2534738',1,'P','0000-00-00','','0000-00-00','20050029.JPG','A','A','1','1','20050029'),(645,1,1,1,1,1013,1,'William Andrés','BARRAGÁN  FLORES','C','1717919367','2034-06-05','10 DE AGOSTO N35-19','aaa@csgabriel.edu.ec','2465236',1,'P','0000-00-00','','0000-00-00','20050030.JPG','A','A','1','1','20050030'),(646,1,1,1,1,1013,1,'Andrés Santiago','BASANTES  GORDILLO','C','1715566244','2034-04-03','PAS.BOLÍVAR E3-31 Y ZAPOTILLO','aaa@csgabriel.edu.ec','2614600',1,'P','0000-00-00','','0000-00-00','20050031.JPG','A','A','1','1','20050031'),(647,1,1,1,1,1013,1,'Vladimir Aleksey','BENAVIDES  JARA','C','1717320558','2034-05-04','EL MORLÁN N50-82 Y LOS ÁLAMOS','aaa@csgabriel.edu.ec','2811725',1,'P','0000-00-00','','0000-00-00','20050032.JPG','A','A','1','1','20050032'),(648,1,1,1,1,1013,1,'Wladimir Andrés','BERNYS  KAROLYS','C','1719672881','0000-00-00','PORFIRIO ROMERO OE163 Y 10 DE AGOSTO C-10','aaa@csgabriel.edu.ec','2409918',1,'P','0000-00-00','','0000-00-00','20050033.JPG','A','A','1','1','20050033'),(649,1,1,1,1,1013,1,'David Esteban','BRITO  MUCARCEL','C','1715920698','0000-00-00','BARTOLOME DÁVILA 161 Y PEDRO VALVERDE','aaa@csgabriel.edu.ec','2291462',1,'P','0000-00-00','','0000-00-00','20050034.JPG','A','A','1','1','20050034'),(650,1,1,1,1,1013,1,'Pablo Agustín','BUNCES  SUNTA','C','1718160979','2034-06-04','CHAMBO 193 Y CERRO HERMOSO','aaa@csgabriel.edu.ec','2653143',1,'P','0000-00-00','','0000-00-00','20050035.JPG','A','A','1','1','20050035'),(651,1,1,1,1,1013,1,'SALTO Christian Ricardo','BURNEO  DEL','C','1718753310','0000-00-00','FRA. ANGÉLICO 220 Y DEGOYA','aaa@csgabriel.edu.ec','2898191',1,'P','0000-00-00','','0000-00-00','20050036.JPG','A','A','1','1','20050036'),(652,1,1,1,1,1013,1,'Leonardo Miguel','CAISACHANA  GUEVARA','C','1722258249','2034-07-07','6 DE DICIEMBRE 6182 Y TOMAS DE BERLANGA D-85.B','aaa@csgabriel.edu.ec','2240452',1,'P','0000-00-00','','0000-00-00','20050038.JPG','A','A','1','1','20050038'),(653,1,1,1,1,1013,1,'Nicolás Alejandro','CAJAS  BECERRA','C','1718162108','0000-00-00','PAUTE S7-70 Y UPANO','aaa@csgabriel.edu.ec','2650654',1,'P','0000-00-00','','0000-00-00','20050039.JPG','A','A','1','1','20050039'),(654,1,1,1,1,1013,1,'Carlos','CALDERÓN  PINTO','C','1722305792','2034-04-01','HERNANDO PAREDES OE3-183','aaa@csgabriel.edu.ec','2474017',1,'P','0000-00-00','','0000-00-00','20050040.JPG','A','A','1','1','20050040'),(655,1,1,1,1,1013,1,'Roberto Daniel','CANDO  VITERI','C','1720930302','0000-00-00','LOS NEVEVADOS. WANDEMBERG E61-70','aaa@csgabriel.edu.ec','2404104',1,'P','0000-00-00','','0000-00-00','20050041.JPG','A','A','1','1','20050041'),(656,1,1,1,1,1013,1,'Gustavo Alejandro','CÁRDENAS  RUIZ','C','1722251095','0000-00-00','HERNÁNDEZ DE GIRÓN 510 Y PEDREGAL','aaa@csgabriel.edu.ec','2446887',1,'P','0000-00-00','','0000-00-00','20050042.JPG','A','A','1','1','20050042'),(657,1,1,1,1,1013,1,'David Alejandro','CARRERA  CARRANCO','C','1715902092','2034-02-05','MAÑOSCA Y PASAJE 3. CONJ. ALTAMIRA','aaa@csgabriel.edu.ec','2259859',1,'P','0000-00-00','','0000-00-00','20050043.JPG','A','A','1','1','20050043'),(658,1,1,1,1,1013,1,'Álvaro Mauricio','CARRERA  MONTALVO','C','1722219639','0000-00-00','EL TIEMPO 627 Y EL TELÉGRAFO','aaa@csgabriel.edu.ec','2467910',1,'P','0000-00-00','','0000-00-00','20050044.JPG','A','A','1','1','20050044'),(659,1,1,1,1,1013,1,'Byron Roberto','CARTAGENOVA  NOVOA','C','1714025101','2034-11-00','GUACAMAYOS Y CAP. RAMÓN BORJA','aaa@csgabriel.edu.ec','3280105',1,'P','0000-00-00','','0000-00-00','20050045.JPG','A','A','1','1','20050045'),(660,1,1,1,1,1013,1,'David Antonio','CEVALLOS  HERRERA','C','1714485677','2034-04-07','LA GRANJA. ACCESO 66 BL-237 D-41','aaa@csgabriel.edu.ec','2264167',1,'P','0000-00-00','','0000-00-00','20050046.JPG','A','A','1','1','20050046'),(661,1,1,1,1,1013,1,'Gabriel Nicolás','CEVALLOS  PIEDRA','C','1717527178','2034-08-07','HABANA OE6-42 Y CANADÁ','aaa@csgabriel.edu.ec','2953232',1,'P','0000-00-00','','0000-00-00','20050047.JPG','A','A','1','1','20050047'),(662,1,1,1,1,1013,1,'Andrés Eduardo','CHÁVEZ  PULLAS','C','1722240601','0000-00-00','PUEBLO BLANCO VALLE C-1 CASA 21. GUANGOPOLO','aaa@csgabriel.edu.ec','98356417',1,'P','0000-00-00','','0000-00-00','20050048.JPG','A','A','1','1','20050048'),(663,1,1,1,1,1013,1,'Ricardo Andrés','CHÁVEZ  VÁSCONEZ','C','1722305149','0000-00-00','AV.C.GALARZA 2 HEMISFERIOS PREDIO 3 MZ-4 C-13','aaa@csgabriel.edu.ec','2353068',1,'P','0000-00-00','','0000-00-00','20050049.JPG','A','A','1','1','20050049'),(664,1,1,1,1,1013,1,'Francisco Javier','CHECA  VACA','C','1721233359','0000-00-00','SIMÓN BOLÍVAR 151 Y PIZARRO. TUMBACO','aaa@csgabriel.edu.ec','2371789',1,'P','0000-00-00','','0000-00-00','20050050.JPG','A','A','1','1','20050050'),(665,1,1,1,1,1013,1,'Rodrigo Andrés','CHIRIBOGA  MOYA','C','1718161928','0000-00-00','COND.LOYOLA BL-59 D-42. COTOCOLLAO','aaa@csgabriel.edu.ec','2599807',1,'P','0000-00-00','','0000-00-00','20050051.JPG','A','A','1','1','20050051'),(666,1,1,1,1,1013,1,'Juan Andrés','CISNEROS  JÁCOME','C','1717431934','0000-00-00','AV. JUAN B. AGUIRRE 1155','aaa@csgabriel.edu.ec','2609982',1,'P','0000-00-00','','0000-00-00','20050053.JPG','A','A','1','1','20050053'),(667,1,1,1,1,1013,1,'Álvaro Sebastián','COBA  CISNEROS','C','1722040811','2034-07-06','MAÑOSCA 812 Y VASCO DE CONTRERAS','aaa@csgabriel.edu.ec','2246427',1,'P','0000-00-00','','0000-00-00','20050054.JPG','A','A','1','1','20050054'),(668,1,1,1,1,1013,1,'Steven Ramiro','CORONADO  TERÁN','C','1720983640','0000-00-00','BRASIL Y H.SALAS CONJ. NORTESOL','aaa@csgabriel.edu.ec','2270600',1,'P','0000-00-00','','0000-00-00','20050055.JPG','A','A','1','1','20050055'),(669,1,1,1,1,1013,1,'Juan Pablo','CORTEZ  MOSQUERA','C','1718162280','2034-02-06','SAN CARLOS BL-COTOPAXI D-502','aaa@csgabriel.edu.ec','2599663',1,'P','0000-00-00','','0000-00-00','20050056.JPG','A','A','1','1','20050056'),(670,1,1,1,1,1013,1,'Miguel Alejandro','CRIOLLO  GUALLASAMÍN','C','1720892155','0000-00-00','BARRIO SELVA ALEGRE. SANGOLQUÍ.','aaa@csgabriel.edu.ec','2870030',1,'P','0000-00-00','','0000-00-00','20050057.JPG','A','A','1','1','20050057'),(671,1,1,1,1,1013,1,'Marco Sebastián','CRUZ  ROSERO','C','1721024279','0000-00-00','CONJ. LOS CACTUS CASA 6. SANGOLQUÍ.','aaa@csgabriel.edu.ec','2331122',1,'P','0000-00-00','','0000-00-00','20050058.JPG','A','A','1','1','20050058'),(672,1,1,1,1,1013,1,'José Luiz','DÁVALOS  MONTEIRO','C','603096462','2034-10-06','PAS. 132 OE5D CASA 31-33 Y SAN GABRIEL. LA GRANJA','aaa@csgabriel.edu.ec','2432759',1,'P','0000-00-00','','0000-00-00','20050059.JPG','A','A','1','1','20050059'),(673,1,1,1,1,1013,1,'David Hernán','DÁVILA  SÁNCHEZ','C','1718164625','2034-11-07','MAÑOSCA OE 174 Y 10 DE AGOSTO','aaa@csgabriel.edu.ec','2268485',1,'P','0000-00-00','','0000-00-00','20050060.JPG','A','A','1','1','20050060'),(674,1,1,1,1,1013,1,'Bryan Nelson','DUEÑAS  ORMAZA','C','1720622552','0000-00-00','H. GIROIX 765 Y PEDREGAL','aaa@csgabriel.edu.ec','2463254',1,'P','0000-00-00','','0000-00-00','20050062.JPG','A','A','1','1','20050062'),(675,1,1,1,1,1013,1,'Ricardo Andrés','ERAZO  GUERRA','C','1720508686','2034-00-01','MARIANA DE JESÚS 725 Y ELOY ALFARO','aaa@csgabriel.edu.ec','2520181',1,'P','0000-00-00','','0000-00-00','20050063.JPG','A','A','1','1','20050063'),(676,1,1,1,1,1013,1,'Carlos Patricio','ESPINOSA  GAVILANES','C','1718382482','2034-10-09','LOS CEDROS Y R.AUDIENCIA. CONJ.SIERRA HERMOSA C-47','aaa@csgabriel.edu.ec','2534748',1,'P','0000-00-00','','0000-00-00','20050064.JPG','A','A','1','1','20050064'),(677,1,1,1,1,1013,1,'Esteban Alejandro','FLORES  MENA','C','1718164864','0000-00-00','AV.REAL A. DE QUITO PAS.G OE2-154','aaa@csgabriel.edu.ec','2415361',1,'P','0000-00-00','','0000-00-00','20050066.JPG','A','A','1','1','20050066'),(678,1,1,1,1,1013,1,'Pablo Esteban','GALLEGOS  CAJAS','C','1716751837','2034-01-04','JERÓNIMO BENZONI N58-142','aaa@csgabriel.edu.ec','3401475',1,'P','0000-00-00','','0000-00-00','20050069.JPG','A','A','1','1','20050069'),(679,1,1,1,1,1013,1,'José Alberto','GRANDA  JARAMILLO','C','1719712588','2034-00-03','BENANCIO ESTANDOQUE Y CARDENAL ESPÍNOLA C.S18-31','aaa@csgabriel.edu.ec','2680025',1,'P','0000-00-00','','0000-00-00','20050071.JPG','A','A','1','1','20050071'),(680,1,1,1,1,1013,1,'Franco Rafael','GRANDA  PEÑAHERRERA','C','1716083694','0000-00-00','PERALES L-3 Y ELOY ALFARO','aaa@csgabriel.edu.ec','2249032',1,'P','0000-00-00','','0000-00-00','20050072.JPG','A','A','1','1','20050072'),(681,1,1,1,1,1013,1,'Cristian Steve','GUAMÁN  MÉNDEZ','C','1722128749','0000-00-00','CARAPUNGO 2DA.ETAPA BL-014','aaa@csgabriel.edu.ec','2426364',1,'P','0000-00-00','','0000-00-00','20050073.JPG','A','A','1','1','20050073'),(682,1,1,1,1,1013,1,'Edison Fabricio','GUARANGO  MARIÑO','C','1718164633','0000-00-00','CONJ. CAPULIES 2 CASA 7. CALDERÓN','aaa@csgabriel.edu.ec','2826356',1,'P','0000-00-00','','0000-00-00','20050074.JPG','A','A','1','1','20050074'),(683,1,1,1,1,1013,1,'Marcelo David','GUERRA  BALLADARES','C','1722318688','0000-00-00','SOLANO E12-166 Y LA CONDAMINE','aaa@csgabriel.edu.ec','2903549',1,'P','0000-00-00','','0000-00-00','20050075.JPG','A','A','1','1','20050075'),(684,1,1,1,1,1013,1,'Byron Alejandro','GUERRA  VILLACÍS','C','1722440722','0000-00-00','ZARUMA S10-55 Y PASAJE','aaa@csgabriel.edu.ec','2649702',1,'P','0000-00-00','','0000-00-00','20050078.JPG','A','A','1','1','20050078'),(685,1,1,1,1,1013,1,'Christian Andrés','GUTIÉRREZ  MORILLO','C','1720870862','0000-00-00','ABELARDO MONCAYO 346 Y M. SÁENZ','aaa@csgabriel.edu.ec','3319056',1,'P','0000-00-00','','0000-00-00','20050079.JPG','A','A','1','1','20050079'),(686,1,1,1,1,1013,1,'Jaime Andrés','GUZMÁN  CAICEDO','C','1717436453','0000-00-00','REINA VICTORIA Y ROCA. RESTAURANT CASA DE J.','aaa@csgabriel.edu.ec','2225029',1,'P','0000-00-00','','0000-00-00','20050080.JPG','A','A','1','1','20050080'),(687,1,1,1,1,1013,1,'Jonathan Alejandro','HEREDIA  LÓPEZ','C','1717433542','2034-00-04','10 DE AGOSTO 38-46 Y MARIANA DE JESÚS','aaa@csgabriel.edu.ec','2547115',1,'P','0000-00-00','','0000-00-00','20050081.JPG','A','A','1','1','20050081'),(688,1,1,1,1,1013,1,'Rodrigo Xavier','HERRERA  CELA','C','1720016961','0000-00-00','BARTOLOMÉ ÁLVEZ E409 Y F.COBO','aaa@csgabriel.edu.ec','2614854',1,'P','0000-00-00','','0000-00-00','20050082.JPG','A','A','1','1','20050082'),(689,1,1,1,1,1013,1,'Christian Alfonso','HERRERA  MORALES','C','1722257803','2034-01-09','URB.BATALLÓN CHIMBORAZO CALLE H S13-408','aaa@csgabriel.edu.ec','2637797',1,'P','0000-00-00','','0000-00-00','20050083.JPG','A','A','1','1','20050083'),(690,1,1,1,1,1013,1,'Esteban Daniel','HERRERA  VALLEJOS','C','1722304597','0000-00-00','URB. 29 DE JULIO LOTE 38','aaa@csgabriel.edu.ec','2801667',1,'P','0000-00-00','','0000-00-00','20050084.JPG','A','A','1','1','20050084'),(691,1,1,1,1,1013,1,'Joffre Sebastián','HERRERA  YÁNEZ','C','1714154877','0000-00-00','INGLATERRA N30-152 Y VANCOUVER','aaa@csgabriel.edu.ec','2236854',1,'P','0000-00-00','','0000-00-00','20050085.JPG','A','A','1','1','20050085'),(692,1,1,1,1,1013,1,'Marcos David','IMBAGO  JÁCOME','C','1721983433','0000-00-00','ISAAC BARRERA E6-196','aaa@csgabriel.edu.ec','2403544',1,'P','0000-00-00','','0000-00-00','20050087.JPG','A','A','1','1','20050087'),(693,1,1,1,1,1013,1,'Francisco Javier','INFANTE  CASTILLO','C','1722253091','2034-04-03','PEDRO FREILE 2236 Y JUAN GARZÓN','aaa@csgabriel.edu.ec','2296937',1,'P','0000-00-00','','0000-00-00','20050088.JPG','A','A','1','1','20050088'),(694,1,1,1,1,1013,1,'Gilbert Gabriel','FREIRE  MENA','C','1721305603','0000-00-00','LAS AMAPOLAS N47-157','aaa@csgabriel.edu.ec','2461904',1,'P','0000-00-00','','0000-00-00','20050089.JPG','A','A','1','1','20050089'),(695,1,1,1,1,1013,1,'Jimmy Jocksan','JARA  ALVEAR','C','603947557','2034-05-08','PASAJE B Y VEINTIMILLA N56-25','aaa@csgabriel.edu.ec','2414109',1,'P','0000-00-00','','0000-00-00','20050092.JPG','A','A','1','1','20050092'),(696,1,1,1,1,1013,1,'Luis Fernando','JARA  FIGUEROA','C','1716169691','0000-00-00','URB. LA COLINA. EL ORO 371','aaa@csgabriel.edu.ec','2337486',1,'P','0000-00-00','','0000-00-00','20050093.JPG','A','A','1','1','20050093'),(697,1,1,1,1,1013,1,'Luis Eduardo','JARAMILLO  FLORES','C','1722213038','2034-02-08','DONOSO DE BARBA N15-10. LA VICENTINA','aaa@csgabriel.edu.ec','3227654',1,'P','0000-00-00','','0000-00-00','20050094.JPG','A','A','1','1','20050094'),(698,1,1,1,1,1013,1,'Esteban Javier','JARAMILLO  ROBAYO','C','1713906442','0000-00-00','URB.LA ARMENIA 1-7 #162','aaa@csgabriel.edu.ec','2348563',1,'P','0000-00-00','','0000-00-00','20050095.JPG','A','A','1','1','20050095'),(699,1,1,1,1,1013,1,'Diego Sebastián','JARAMILLO  SÁNCHEZ','C','1721988481','0000-00-00','FRANCISCO DALMAU Y CALLE 8. URB.MARISOL','aaa@csgabriel.edu.ec','95028786',1,'P','0000-00-00','','0000-00-00','20050096.JPG','A','A','1','1','20050096'),(700,1,1,1,1,1013,1,'Alex Andrés','JARRÍN  JURADO','C','1721606208','0000-00-00','AV.LA PRENSA N59-64 Y LUIS TUFIÑO','aaa@csgabriel.edu.ec','2595668',1,'P','0000-00-00','','0000-00-00','20050098.JPG','A','A','1','1','20050098'),(701,1,1,1,1,1013,1,'Daniel Nicolás','JIMÉNEZ  ARMAS','C','1722307319','2034-06-09','RAMÓN NAVA 740 Y NECOCHEA','aaa@csgabriel.edu.ec','2584229',1,'P','0000-00-00','','0000-00-00','20050099.JPG','A','A','1','1','20050099'),(702,1,1,1,1,1013,1,'Juan Carlos','JIMÉNEZ  GARCÉS','C','1722311865','0000-00-00','CÓNDOR 369 Y AV. BRASIL','aaa@csgabriel.edu.ec','2270410',1,'P','0000-00-00','','0000-00-00','20050100.JPG','A','A','1','1','20050100'),(703,1,1,1,1,1013,1,'Luis Felipe','LASCANO  VALAREZO','C','1714811880','2034-10-00','AUCAS N52-129 Y AV. LA FLORIDA','aaa@csgabriel.edu.ec','2433463',1,'P','0000-00-00','','0000-00-00','20050102.JPG','A','A','1','1','20050102'),(704,1,1,1,1,1013,1,'Andrés Fernando','LATORRE  TORRES','C','1722444013','0000-00-00','BARTOLOMÉ CARBO N78-41','aaa@csgabriel.edu.ec','2470460',1,'P','0000-00-00','','0000-00-00','20050103.JPG','A','A','1','1','20050103'),(705,1,1,1,1,1013,1,'Ronnie Steve','GARCÍA  VALLADARES','C','1718161597','0000-00-00','GERÓNIMO LEITON N23-133 Y AV.LA GASCA','aaa@csgabriel.edu.ec','2522670',1,'P','0000-00-00','','0000-00-00','20050104.JPG','A','A','1','1','20050104'),(706,1,1,1,1,1013,1,'Peter Saúl','LÓPEZ  LOAIZA','C','1721239240','2034-09-08','SAN FRANCISCO N42-93','aaa@csgabriel.edu.ec','2240529',1,'P','0000-00-00','','0000-00-00','20050105.JPG','A','A','1','1','20050105'),(707,1,1,1,1,1013,1,'Jorge Abraham','LUNA  VIVERO','C','1600345936','0000-00-00','SAN JOSÉ DE LA VIÑA 14','aaa@csgabriel.edu.ec','2374781',1,'P','0000-00-00','','0000-00-00','20050106.JPG','A','A','1','1','20050106'),(708,1,1,1,1,1013,1,'Mario Andrés','MALDONADO  GAIBOR','C','1722316013','0000-00-00','NICOLÁS ALBA N67-41 Y LEGARD','aaa@csgabriel.edu.ec','2595203',1,'P','0000-00-00','','0000-00-00','20050107.JPG','A','A','1','1','20050107'),(709,1,1,1,1,1013,1,'Santiago José','MALDONADO  MENESES','C','1721391165','0000-00-00','AV.COLÓN 1468 Y 9 DE OCTUBRE. EDIF.SOLAMAR OF.501','aaa@csgabriel.edu.ec','2602001',1,'P','0000-00-00','','0000-00-00','20050108.JPG','A','A','1','1','20050108'),(710,1,1,1,1,1013,1,'Jhonattan David','MANOSALVAS  MORA','C','1722255286','0000-00-00','MACHALA N64-105 Y J.GARZÓN','aaa@csgabriel.edu.ec','2591192',1,'P','0000-00-00','','0000-00-00','20050109.JPG','A','A','1','1','20050109'),(711,1,1,1,1,1013,1,'Roberto Alejandro','MASACHE  POVEDA','C','1722441720','0000-00-00','MANUEL CAÑOLA E10-32 Y J.SUMAITA','aaa@csgabriel.edu.ec','2813929',1,'P','0000-00-00','','0000-00-00','20050110.JPG','A','A','1','1','20050110'),(712,1,1,1,1,1013,1,'Ernesto Andrés','MEDIAVILLA  YANDÚN','C','1722317243','0000-00-00','URB.LOS ROSALES PAS.A LOTE 28','aaa@csgabriel.edu.ec','2482521',1,'P','0000-00-00','','0000-00-00','20050112.JPG','A','A','1','1','20050112'),(713,1,1,1,1,1013,1,'Hugo Santiago','MENA  PALACIOS','C','1719209742','0000-00-00','CUSUBAMBA 831 Y TNTE. ORTIZ','aaa@csgabriel.edu.ec','2679490',1,'P','0000-00-00','','0000-00-00','20050113.JPG','A','A','1','1','20050113'),(714,1,1,1,1,1013,1,'Wilber Isaac','MERA  RUIZ','C','1720544087','0000-00-00','CUERO Y CAICEDO OE6-128 Y UGARTE','aaa@csgabriel.edu.ec','2907604',1,'P','0000-00-00','','0000-00-00','20050114.JPG','A','A','1','1','20050114'),(715,1,1,1,1,1013,1,'Roberto Omar','MONCAYO  OLEAS','C','1715848105','0000-00-00','LOS CEDROS OE3-290 Y P. BOTTO. COND.SIERRA H. C-68','aaa@csgabriel.edu.ec','2598928',1,'P','0000-00-00','','0000-00-00','20050115.JPG','A','A','1','1','20050115'),(716,1,1,1,1,1013,1,'Carlos Andrés','MORÁN  GALARZA','C','1721795829','0000-00-00','COND. JOSÉ PERALTA L-4 B.7 DEP.743','aaa@csgabriel.edu.ec','2733468',1,'P','0000-00-00','','0000-00-00','20050118.JPG','A','A','1','1','20050118'),(717,1,1,1,1,1013,1,'David Francisco','MORENO  CADENA','C','1720995438','2034-10-08','MARIANO POZO N77-59 Y JUAN DE SELIS','aaa@csgabriel.edu.ec','2470989',1,'P','0000-00-00','','0000-00-00','20050119.JPG','A','A','1','1','20050119'),(718,1,1,1,1,1013,1,'Byron Esteban','CADENA  CAMPOS','C','1722245873','0000-00-00','AV.M.CÓRDOVA GALARZA KM 10 1/2 #2005','aaa@csgabriel.edu.ec','94113078',1,'P','0000-00-00','','0000-00-00','20050120.JPG','A','A','1','1','20050120'),(719,1,1,1,1,1013,1,'Cristian Javier','MOYANO  CABEZAS','C','1722194667','0000-00-00','COOP. UNEBA VILLA SOLIDARIDAD','aaa@csgabriel.edu.ec','2698830',1,'P','0000-00-00','','0000-00-00','20050121.JPG','A','A','1','1','20050121'),(720,1,1,1,1,1013,1,'Erik Andrés','MUSO  CACHUMBA','C','1718162116','0000-00-00','PANAMERICANA NORTE KM 14 1/2','aaa@csgabriel.edu.ec','2825013',1,'P','0000-00-00','','0000-00-00','20050122.JPG','A','A','1','1','20050122'),(721,1,1,1,1,1013,1,'Andrés Sebastián','NARANJO  HEREDIA','C','1719349365','2034-10-08','AV.FRAY A. AZKÚNAGA Y BRASIL. CONJ.ASKÚNAGA C-B.5','aaa@csgabriel.edu.ec','2442297',1,'P','0000-00-00','','0000-00-00','20050123.JPG','A','A','1','1','20050123'),(722,1,1,1,1,1013,1,'Daniel Alexander','NARANJO  LANDETA','C','1722345905','0000-00-00','JUAN TIRADO N84-171 Y HERNANDO DE LA PARRA','aaa@csgabriel.edu.ec','2478867',1,'P','0000-00-00','','0000-00-00','20050124.JPG','A','A','1','1','20050124'),(723,1,1,1,1,1013,1,'Agustín Elías','NARANJO  LARA','C','1721390415','0000-00-00','LA GRANJA ACCESO 21 D-42','aaa@csgabriel.edu.ec','2252612',1,'P','0000-00-00','','0000-00-00','20050125.JPG','A','A','1','1','20050125'),(724,1,1,1,1,1013,1,'Jhon Sebastián','NARVÁEZ  CAJAS','C','1722254628','0000-00-00','NUEVA YORK 319 Y GALÁPAGOS','aaa@csgabriel.edu.ec','2582292',1,'P','0000-00-00','','0000-00-00','20050126.JPG','A','A','1','1','20050126'),(725,1,1,1,1,1013,1,'Erik Andrés','NAULA  GARCÍA','C','1720963329','0000-00-00','AV.PABLO GUARDERAS. MACHACHI','aaa@csgabriel.edu.ec','2315599',1,'P','0000-00-00','','0000-00-00','20050127.JPG','A','A','1','1','20050127'),(726,1,1,1,1,1013,1,'Xavier Mauricio','ÑAUÑAY  PUENTE','C','1720942406','0000-00-00','BUENOS AIRES OE5-157','aaa@csgabriel.edu.ec','2228505',1,'P','0000-00-00','','0000-00-00','20050128.JPG','A','A','1','1','20050128'),(727,1,1,1,1,1013,1,'Francisco Javier','NAVARRO  CIFUENTES','C','1722480157','0000-00-00','ALEJANDRO PONCE OE3-143. CARCELÉN','aaa@csgabriel.edu.ec','2471459',1,'P','0000-00-00','','0000-00-00','20050129.JPG','A','A','1','1','20050129'),(728,1,1,1,1,1013,1,'Andrés Esteban','OBANDO  SANIPATÍN','C','1721073052','0000-00-00','ATACAMES N23-268','aaa@csgabriel.edu.ec','3200201',1,'P','0000-00-00','','0000-00-00','20050131.JPG','A','A','1','1','20050131'),(729,1,1,1,1,1013,1,'Nicolás Alejandro','OCAÑA  ERAZO','C','1720646841','0000-00-00','CALLE GUAYAQUIL S/N. ZAMBIZA','aaa@csgabriel.edu.ec','2886095',1,'P','0000-00-00','','0000-00-00','20050132.JPG','A','A','1','1','20050132'),(730,1,1,1,1,1013,1,'Jaime David','CAHUASQUI  SEGURA','C','1720626918','0000-00-00','DOMINGO ESPINAR 2435 Y LA GASCA','aaa@csgabriel.edu.ec','2568703',1,'P','0000-00-00','','0000-00-00','20050133.JPG','A','A','1','1','20050133'),(731,1,1,1,1,1013,1,'Henry Alexander','RENGIFO  PULLAS','C','1719088765','0000-00-00','HERNÁN CORTEZ 55-46 Y CARLOS V.','aaa@csgabriel.edu.ec','3400990',1,'P','0000-00-00','','0000-00-00','20050134.JPG','A','A','1','1','20050134'),(732,1,1,1,1,1013,1,'Andrés Patricio','ORDÓÑEZ  YUNDA','C','1716185838','0000-00-00','FRANCISCO RUIZ OE124','aaa@csgabriel.edu.ec','2662347',1,'P','0000-00-00','','0000-00-00','20050135.JPG','A','A','1','1','20050135'),(733,1,1,1,1,1013,1,'Nicolás','ORTEGA  ROCA','C','201622792','0000-00-00','BARTOLOMÉ RUIZ OE611 Y MACHALA','aaa@csgabriel.edu.ec','2534430',1,'P','0000-00-00','','0000-00-00','20050136.JPG','A','A','1','1','20050136'),(734,1,1,1,1,1013,1,'Jaime Luis','CADENA  SÁNCHEZ','C','1721547378','0000-00-00','JOSÉ ÁLVAREZ E14-27','aaa@csgabriel.edu.ec','2501099',1,'P','0000-00-00','','0000-00-00','20050138.JPG','A','A','1','1','20050138'),(735,1,1,1,1,1013,1,'Edison David','PACHECO  BUCHELI','C','1718161266','0000-00-00','URB.HERNANDO PARRA MZ-M C-14. CARAPUNGO','aaa@csgabriel.edu.ec','2420907',1,'P','0000-00-00','','0000-00-00','20050139.JPG','A','A','1','1','20050139'),(736,1,1,1,1,1013,1,'Felipe Alfonso','PALACIOS  CEVALLOS','C','1717150898','0000-00-00','HUMBERTO ALBORNOZ 506','aaa@csgabriel.edu.ec','2237037',1,'P','0000-00-00','','0000-00-00','20050140.JPG','A','A','1','1','20050140'),(737,1,1,1,1,1013,1,'José Miguel','ORTEGA  CALLE','C','1500815418','2034-11-07','COND.LOS LEÑOS C-14.B. LOS MASTODONTES','aaa@csgabriel.edu.ec','3443933',1,'P','0000-00-00','','0000-00-00','20050141.JPG','A','A','1','1','20050141'),(738,1,1,1,1,1013,1,'Felipe Sebastián','PANTOJA  ABARCA','C','1719929661','0000-00-00','AV.LA PRENSA N71-98 Y P. PICASSO','aaa@csgabriel.edu.ec','2494870',1,'P','0000-00-00','','0000-00-00','20050142.JPG','A','A','1','1','20050142'),(739,1,1,1,1,1013,1,'Carlos Alejandro','ENRÍQUEZ  DÍAZ','C','1714128228','0000-00-00','HERDOIZA CRESPO Y PAS.C.LOZA C-15. TUMBACO','aaa@csgabriel.edu.ec','2374555',1,'P','0000-00-00','','0000-00-00','20050143.JPG','A','A','1','1','20050143'),(740,1,1,1,1,1013,1,'Paúl Alejandro','PAZMIÑO  ALTAMIRANO','C','1722318662','2034-11-07','URB.FACULTAD DE MED. 2DA.ETAPA C-81. CAPELO','aaa@csgabriel.edu.ec','2867793',1,'P','0000-00-00','','0000-00-00','20050144.JPG','A','A','1','1','20050144'),(741,1,1,1,1,1013,1,'Ricardo Esteban','PAZMIÑO  REYES','C','1715829576','0000-00-00','RAFAEL CARVAJAL N80-328. CARCELÉN.','aaa@csgabriel.edu.ec','2803129',1,'P','0000-00-00','','0000-00-00','20050145.JPG','A','A','1','1','20050145'),(742,1,1,1,1,1013,1,'Felipe Antonio','PÉREZ  GUERRA','C','1719089136','0000-00-00','URB.SAN JOSÉ PORTAL S.SEBASTIÁN C-40','aaa@csgabriel.edu.ec','2824670',1,'P','0000-00-00','','0000-00-00','20050147.JPG','A','A','1','1','20050147'),(743,1,1,1,1,1013,1,'Wilson Andrés','PÉREZ  PINTADO','C','1720363587','0000-00-00','URB.LA PULIDA CALLE 2 OE9-300','aaa@csgabriel.edu.ec','2294165',1,'P','0000-00-00','','0000-00-00','20050148.JPG','A','A','1','1','20050148'),(744,1,1,1,1,1013,1,'Marcelo Alexander','PICO  ALDAS','C','1722316781','2034-00-00','RITER 86 Y BOLIVIA','aaa@csgabriel.edu.ec','2546369',1,'P','0000-00-00','','0000-00-00','20050150.JPG','A','A','1','1','20050150'),(745,1,1,1,1,1013,1,'Miguel Ángel','PONCE  ESPINEL','C','1714763321','0000-00-00','25 DE MAYO N66-29 Y LIZARDO RUIZ','aaa@csgabriel.edu.ec','2596071',1,'P','0000-00-00','','0000-00-00','20050151.JPG','A','A','1','1','20050151'),(746,1,1,1,1,1013,1,'Santiago Javier','PONCE  VINUEZA','C','1722447420','0000-00-00','CARLOS MONTÚFAR E13-333 Y MONITOR','aaa@csgabriel.edu.ec','2446088',1,'P','0000-00-00','','0000-00-00','20050152.JPG','A','A','1','1','20050152'),(747,1,1,1,1,1013,1,'Adrian Alexander','PROAÑO  ARTIEDA','C','1715922488','0000-00-00','POLIT LASSO Y ASCÁZUBI. CONOCOTO','aaa@csgabriel.edu.ec','2346024',1,'P','0000-00-00','','0000-00-00','20050153.JPG','A','A','1','1','20050153'),(748,1,1,1,1,1013,1,'Jonathan David','RECALDE  MONGE','C','1722015706','0000-00-00','BARRIO TERÁN CALLE D #65. CALDERÓN','aaa@csgabriel.edu.ec','2824518',1,'P','0000-00-00','','0000-00-00','20050154.JPG','A','A','1','1','20050154'),(749,1,1,1,1,1013,1,'David Alexey','RIOFRÍO  LUCERO','C','1715826291','0000-00-00','HOMERO SALAS 470 Y MANUEL SERRANO','aaa@csgabriel.edu.ec','2440194',1,'P','0000-00-00','','0000-00-00','20050155.JPG','A','A','1','1','20050155'),(750,1,1,1,1,1013,1,'Marco Iván','RIVERA  GALARZA','C','1722442769','0000-00-00','URB.LA PIEDRA CASA 3. CARAPUNGO','aaa@csgabriel.edu.ec','2428002',1,'P','0000-00-00','','0000-00-00','20050156.JPG','A','A','1','1','20050156'),(751,1,1,1,1,1013,1,'Mauricio Javier','RODRÍGUEZ  CESEN','C','1716867237','2034-09-05','URB.SAN SEBASTIÁN DE CALDERÓN C-8.A','aaa@csgabriel.edu.ec','3316853',1,'P','0000-00-00','','0000-00-00','20050157.JPG','A','A','1','1','20050157'),(752,1,1,1,1,1013,1,'Rafael','RODRÍGUEZ  RAZA','C','1718610361','2034-08-00','RIO PUCUNO N37-171 Y RIO BIGAL','aaa@csgabriel.edu.ec','2495165',1,'P','0000-00-00','','0000-00-00','20050158.JPG','A','A','1','1','20050158'),(753,1,1,1,1,1013,1,'Juan Sebastián','ROMERO  CORONEL','C','1717641458','0000-00-00','CASTRO E7-18 E IQUIQUE','aaa@csgabriel.edu.ec','2544379',1,'P','0000-00-00','','0000-00-00','20050159.JPG','A','A','1','1','20050159'),(754,1,1,1,1,1013,1,'Francisco Andrés','ROMERO  CORTEZ','C','1722228028','0000-00-00','CDLA. CASAS QUITO. M.CAZÁREZ 248','aaa@csgabriel.edu.ec','2673423',1,'P','0000-00-00','','0000-00-00','20050160.JPG','A','A','1','1','20050160'),(755,1,1,1,1,1013,1,'Pablo Andrés','ROMERO  TORRES','C','1720360047','0000-00-00','CDLA.LA FLORIDA. MANUEL JORDÁN N52-101','aaa@csgabriel.edu.ec','2245736',1,'P','0000-00-00','','0000-00-00','20050161.JPG','A','A','1','1','20050161'),(756,1,1,1,1,1013,1,'Carlos Patricio','ROSALES  GALLARDO','C','1714814934','2034-11-04','ISABEL DEL HIERRO N70-306','aaa@csgabriel.edu.ec','2492575',1,'P','0000-00-00','','0000-00-00','20050162.JPG','A','A','1','1','20050162'),(757,1,1,1,1,1013,1,'Bryan Alejandro','ROSERO  CAPELO','C','1722335427','0000-00-00','AV.LOS LIBERTADORES OE4-115','aaa@csgabriel.edu.ec','2664423',1,'P','0000-00-00','','0000-00-00','20050164.JPG','A','A','1','1','20050164'),(758,1,1,1,1,1013,1,'Carlos Andrés','RUIZ  AMANCHA','C','1717994949','2034-00-07','ZAMORA OE3-227 Y BRASIL','aaa@csgabriel.edu.ec','2446116',1,'P','0000-00-00','','0000-00-00','20050165.JPG','A','A','1','1','20050165'),(759,1,1,1,1,1013,1,'Jonathan Alexis','SALAS  CERVANTES','C','1717597437','0000-00-00','SAN ANTONIO DE PICHINCHA','aaa@csgabriel.edu.ec','2394892',1,'P','0000-00-00','','0000-00-00','20050166.JPG','A','A','1','1','20050166'),(760,1,1,1,1,1013,1,'Freddy Vinicio','SALTOS  ESTRELLA','C','1722314752','0000-00-00','PAS. CAMINO PÉREZ N31-44. LAS CASAS.','aaa@csgabriel.edu.ec','2552893',1,'P','0000-00-00','','0000-00-00','20050167.JPG','A','A','1','1','20050167'),(761,1,1,1,1,1013,1,'José Rubén','SALTOS  GRANIZO','C','1720750627','2034-12-03','LOS CEDROS Y R.AUDIENCIA CONJ.SIERRA H. C-3','aaa@csgabriel.edu.ec','2292195',1,'P','0000-00-00','','0000-00-00','20050168.JPG','A','A','1','1','20050168'),(762,1,1,1,1,1013,1,'Rogelio Alexander','SÁNCHEZ  TACO','C','1719664318','2034-02-07','ALFREDO ESCUDERO S21-66. LA GATAZO','aaa@csgabriel.edu.ec','2632867',1,'P','0000-00-00','','0000-00-00','20050170.JPG','A','A','1','1','20050170'),(763,1,1,1,1,1013,1,'Santiago Felipe','VILLACRESES  VALLE','C','1722389911','2034-08-06','RÍO DE JANIERO 748','aaa@csgabriel.edu.ec','2509924',1,'P','0000-00-00','','0000-00-00','20050171.JPG','A','A','1','1','20050171'),(764,1,1,1,1,1013,1,'Joao Jair','SANTOS  MORALES','C','1722463427','0000-00-00','RUMIPAMBA 3390 Y AMÉRICA','aaa@csgabriel.edu.ec','95033259',1,'P','0000-00-00','','0000-00-00','20050172.JPG','A','A','1','1','20050172'),(765,1,1,1,1,1013,1,'Oscar Sebastián','SARASTY  MIRANDA','C','1715425664','0000-00-00','ATLÁNTICA 2 CASA 4. PANAM. NORTE KM 9 1/2','aaa@csgabriel.edu.ec','2429022',1,'P','0000-00-00','','0000-00-00','20050173.JPG','A','A','1','1','20050173'),(766,1,1,1,1,1013,1,'Carlos Enrique','SHIVE  DELGADO','C','1722251434','2034-12-01','URB.JARDINES DE CARCELÉN CASA B-56','aaa@csgabriel.edu.ec','2428840',1,'P','0000-00-00','','0000-00-00','20050174.JPG','A','A','1','1','20050174'),(767,1,1,1,1,1013,1,'Juan Sebastián','SILVA  VEINTIMILLA','C','1722480140','0000-00-00','AV.LA PRENSA 268 Y M.ECHEVERRÍA','aaa@csgabriel.edu.ec','2433120',1,'P','0000-00-00','','0000-00-00','20050175.JPG','A','A','1','1','20050175'),(768,1,1,1,1,1013,1,'Andrés Paúl','LÓPEZ  CALLE','C','1722242771','0000-00-00','PIERRE HITTI BL-6 D-1.D','aaa@csgabriel.edu.ec','2654364',1,'P','0000-00-00','','0000-00-00','20050176.JPG','A','A','1','1','20050176'),(769,1,1,1,1,1013,1,'Marco David','SOTOMAYOR  CAMACHO','C','1722318001','0000-00-00','CONJ. SAN JAIME CASA 16','aaa@csgabriel.edu.ec','2531024',1,'P','0000-00-00','','0000-00-00','20050177.JPG','A','A','1','1','20050177'),(770,1,1,1,1,1013,1,'Drichelmo Alejandro','TAMAYO  LEÓN','C','1716534423','0000-00-00','D.DE VÁSQUEZ Y A.NÚÑEZ TORRES EINSTEIN D-202.A','aaa@csgabriel.edu.ec','2802181',1,'P','0000-00-00','','0000-00-00','20050178.JPG','A','A','1','1','20050178'),(771,1,1,1,1,1013,1,'Fausto Stalin','TAPIA  BENAVIDES','C','1718161365','2034-06-08','CONJ.LOS ÁLAMOS C-27. CARAPUNGO','aaa@csgabriel.edu.ec','2423432',1,'P','0000-00-00','','0000-00-00','20050179.JPG','A','A','1','1','20050179'),(772,1,1,1,1,1013,1,'Edwin Andrés','TERÁN  ACUÑA','C','1722389317','2034-06-01','PAS.ALBERTO COLOMA S10-57 Y EGUSQUIZA','aaa@csgabriel.edu.ec','2655350',1,'P','0000-00-00','','0000-00-00','20050181.JPG','A','A','1','1','20050181'),(773,1,1,1,1,1013,1,'Daniel Alejandro','TROYA  SHERDEK','C','1719125401','0000-00-00','CALLE N74-B CASA OE2-47 Y AV.REAL AUDIENCIA','aaa@csgabriel.edu.ec','2479279',1,'P','0000-00-00','','0000-00-00','20050182.JPG','A','A','1','1','20050182'),(774,1,1,1,1,1013,1,'Germán Francisco','ULLOA  ARTEAGA','C','1714557210','0000-00-00','JARDÍN DEL VALLE CALLE 2-4 #677','aaa@csgabriel.edu.ec','2606090',1,'P','0000-00-00','','0000-00-00','20050183.JPG','A','A','1','1','20050183'),(775,1,1,1,1,1013,1,'André Sebastián','VALENZUELA  TORRES','C','1718723578','0000-00-00','PAS. 1 #520 Y BOLÍVAR. POMASQUI.','aaa@csgabriel.edu.ec','2350889',1,'P','0000-00-00','','0000-00-00','20050184.JPG','A','A','1','1','20050184'),(776,1,1,1,1,1013,1,'Gabriel Alejandro','VEGA  ALBUJA','C','1722319314','0000-00-00','MARIANA DE JESÚS Y CALLE D','aaa@csgabriel.edu.ec','2909093',1,'P','0000-00-00','','0000-00-00','20050185.JPG','A','A','1','1','20050185'),(777,1,1,1,1,1013,1,'Alex Patricio','ESPÍN  VALENCIA','C','1718166448','0000-00-00','SELVA ALEGRE OE5-27 Y CARVAJAL','aaa@csgabriel.edu.ec','2569203',1,'P','0000-00-00','','0000-00-00','20050187.JPG','A','A','1','1','20050187'),(778,1,1,1,1,1013,1,'Fabricio Andrés','VELA  ORAMA','C','1722446182','0000-00-00','ELOY ALFARO Y CAPRI. CONJ.PORTAL DE CAPRI','aaa@csgabriel.edu.ec','2485512',1,'P','0000-00-00','','0000-00-00','20050188.JPG','A','A','1','1','20050188'),(779,1,1,1,1,1013,1,'Raúl Alejandro','REVELO  LUDEÑA','C','1721358867','0000-00-00','JOSÉ M. CARRIÓN 71-36 LOMA HERMOSA','aaa@csgabriel.edu.ec','2499159',1,'P','0000-00-00','','0000-00-00','20050189.JPG','A','A','1','1','20050189'),(780,1,1,1,1,1013,1,'Diego Esteban','FLORES  MORENO','C','1716389117','0000-00-00','URB.LAS ORQUIDEAS ROSSEAU 1244','aaa@csgabriel.edu.ec','2605148',1,'P','0000-00-00','','0000-00-00','20050190.JPG','A','A','1','1','20050190'),(781,1,1,1,1,1013,1,'Andrés Francisco','VILLACÍS  MIRANDA','C','1722240254','2034-12-03','RUMIPAMBA E2-230 ENTRE REPÚBLICA Y AMAZONAS','aaa@csgabriel.edu.ec','2244593',1,'P','0000-00-00','','0000-00-00','20050191.JPG','A','A','1','1','20050191'),(782,1,1,1,1,1013,1,'William Fernando','FONSECA  SARMIENTO','C','1722464227','0000-00-00','PASAJE D E1-30. TAMBO','aaa@csgabriel.edu.ec','2652085',1,'P','0000-00-00','','0000-00-00','20050192.JPG','A','A','1','1','20050192'),(783,1,1,1,1,1013,1,'Jorge Andrés','VILLARREAL  MARIÑO','C','1722460894','0000-00-00','EL CONDADO. CALLE LA SAGALITO 142','aaa@csgabriel.edu.ec','3383102',1,'P','0000-00-00','','0000-00-00','20050193.JPG','A','A','1','1','20050193'),(784,1,1,1,1,1013,1,'Jorge Stalin','VINOCUNA  LOGROÑO','C','1722382254','0000-00-00','PAS.RODRIGO JÁCOME 1326. URB.MOJAS LAS ORQUIDEAS','aaa@csgabriel.edu.ec','2607235',1,'P','0000-00-00','','0000-00-00','20050194.JPG','A','A','1','1','20050194'),(785,1,1,1,1,1013,1,'Hugo Alexander','GODOY  CAIZA','C','1718162132','2034-12-03','STA. TERESA N60-170','aaa@csgabriel.edu.ec','2498841',1,'P','0000-00-00','','0000-00-00','20050195.JPG','A','A','1','1','20050195'),(786,1,1,1,1,1013,1,'David Esteban','YÉPEZ  ALVEAR','C','1722462858','0000-00-00','CALLE 7 Y  DE LOS CIQUELOS','aaa@csgabriel.edu.ec','2808174',1,'P','0000-00-00','','0000-00-00','20050196.JPG','A','A','1','1','20050196'),(787,1,1,1,1,1013,1,'Edgar Gonzalo','BELTRÁN  RUIZ','C','1722018270','0000-00-00','BELLAVISTA OE4-501','aaa@csgabriel.edu.ec','2591147',1,'P','0000-00-00','','0000-00-00','20050197.JPG','A','A','1','1','20050197'),(788,1,1,1,1,1013,1,'Lenin Santiago','ALMEIDA  MORENO','C','1722441092','0000-00-00','LAS CASAS O336 Y CARVAJAL','aaa@csgabriel.edu.ec','2223192',1,'P','0000-00-00','','0000-00-00','20050198.JPG','A','A','1','1','20050198'),(789,1,1,1,1,1013,1,'Emilio José','YÉPEZ  HIDALGO','C','1721074969','0000-00-00','JUAN FIGUEROA 960 Y HUACHI','aaa@csgabriel.edu.ec','2297963',1,'P','0000-00-00','','0000-00-00','20050199.JPG','A','A','1','1','20050199'),(790,1,1,1,1,1013,1,'Fausto Iván','ZAMORA  ARIAS','C','1720895455','2034-10-02','ARMENIA 1. JOSÉ JONAVEN 393 C-1','aaa@csgabriel.edu.ec','2340822',1,'P','0000-00-00','','0000-00-00','20050200.JPG','A','A','1','1','20050200'),(791,1,1,1,1,1013,1,'José Julio','LARA  CABRERA','C','1720408762','2034-10-01','CONJ.CAZALES BUENA AVENTURA C-22 CARAPUNGO','aaa@csgabriel.edu.ec','2634773',1,'P','0000-00-00','','0000-00-00','20050201.JPG','A','A','1','1','20050201'),(792,1,1,1,1,1013,1,'John Jairo','MEDINA  GAVILANES','C','1716756505','0000-00-00','REAL AUDIENCIA 733','aaa@csgabriel.edu.ec','2417361',1,'P','0000-00-00','','0000-00-00','20050202.JPG','A','A','1','1','20050202'),(793,1,1,1,1,1013,1,'Kevin Steven','MIRANDA  SUÁREZ','C','1715036016','0000-00-00','ALEJANDRO DE VALDEZ 24-138','aaa@csgabriel.edu.ec','3203428',1,'P','0000-00-00','','0000-00-00','20050203.JPG','A','A','1','1','20050203'),(794,1,1,1,1,1013,1,'Ramiro Alejandro','PILATASIG  PÉREZ','C','1721863395','0000-00-00','JUAN DE ALCÁZAR Y ANDRÉS PÉREZ 1519','aaa@csgabriel.edu.ec','2644194',1,'P','0000-00-00','','0000-00-00','20050205.JPG','A','A','1','1','20050205'),(795,1,1,1,1,1013,1,'Jorge Eduardo','REGALADO  MANTILLA','C','1722316708','0000-00-00','FRANCISCO DALMAU OE3-D','aaa@csgabriel.edu.ec','2401683',1,'P','0000-00-00','','0000-00-00','20050206.JPG','A','A','1','1','20050206'),(796,1,1,1,1,1013,1,'Henry Xavier','RÍOS  HIDALGO','C','1716795107','2034-07-05','FERNÁNDEZ MADRID 221 Y ROCAFUERTE','aaa@csgabriel.edu.ec','2285335',1,'P','0000-00-00','','0000-00-00','20050207.JPG','A','A','1','1','20050207'),(797,1,1,1,1,1013,1,'Juan Sebastián','SOTOMAYOR  MUÑOZ','C','1714202932','0000-00-00','AV.COLOMBIA Y PAZMIÑO BL-4 D-507','aaa@csgabriel.edu.ec','2520023',1,'P','0000-00-00','','0000-00-00','20050208.JPG','A','A','1','1','20050208'),(798,1,1,1,1,1013,1,'Pedro José','ZÚÑIGA  CABRERA','C','1722314778','2034-01-06','URB.LA PAMPA II. L-11. POMASQUI.','aaa@csgabriel.edu.ec','2350344',1,'P','0000-00-00','','0000-00-00','20050210.JPG','A','A','1','1','20050210'),(799,1,1,1,1,1013,1,'Francisco Javier','GUERRA  BRANDT','C','1721946679','0000-00-00','COOP.UNIÓN NAVAL II. CASA E15-60. LA FLORESTA','aaa@csgabriel.edu.ec','3226868',1,'P','0000-00-00','','0000-00-00','20050230.JPG','A','A','1','1','20050230'),(800,1,1,1,1,1013,1,'Diego Vinicio','SALGADO  POVEDA','C','1722251467','0000-00-00','PAS.IGNACIO AYBAR 162 Y LA ISLA','aaa@csgabriel.edu.ec','2238294',1,'P','0000-00-00','','0000-00-00','20050232.JPG','A','A','1','1','20050232'),(801,1,1,1,1,1013,1,'Sebastián Ramiro','CEVALLOS  SEMANATE','C','1722440151','0000-00-00','AV.AMÉRICA 32-42','aaa@csgabriel.edu.ec','2528027',1,'P','0000-00-00','','0000-00-00','20050233.JPG','A','A','1','1','20050233'),(802,1,1,1,1,1013,1,'Juan Fernando','BAUS  DOBRONSKY','C','1714559349','0000-00-00','PEDRO DE ALVARADO N62-30','aaa@csgabriel.edu.ec','2592942',1,'P','0000-00-00','','0000-00-00','20060187.JPG','A','A','1','1','20060187'),(803,1,1,1,1,1013,1,'Héctor Israel','CEVALLOS  VELÁSQUEZ','C','1714980784','0000-00-00','PAS.CARLOS JARRÍN 247. PÍO XII','aaa@csgabriel.edu.ec','3131202',1,'P','0000-00-00','','0000-00-00','20060188.JPG','A','A','1','1','20060188'),(804,1,1,1,1,1013,1,'Jorge Arturo','MARTÍNEZ  RUEDA','C','1716266075','2034-05-06','CASTELLI 535 Y MONTALVO','aaa@csgabriel.edu.ec','2813201',1,'P','0000-00-00','','0000-00-00','20060189.JPG','A','A','1','1','20060189'),(805,1,1,1,1,1013,1,'Cristhian Rodrigo','TERÁN  MORENO','C','1720840543','0000-00-00','EE.UU N17-91 Y BOGOTÁ','aaa@csgabriel.edu.ec','2544730',1,'P','0000-00-00','','0000-00-00','20060191.JPG','A','A','1','1','20060191'),(806,1,1,1,1,1013,1,'Miguel Santiago','VELOZ  DÍAZ','C','604313585','0000-00-00','AV.OCCIDENTAL N70-455','aaa@csgabriel.edu.ec','2490890',1,'P','0000-00-00','','0000-00-00','20060192.JPG','A','A','1','1','20060192'),(807,1,1,1,1,1013,1,'Juan David','RANGEL  GÓMEZ','C','1723937262','0000-00-00','COND.LOS REYES C-30. AV.DE LA PRENSA Y SABANILLA','aaa@csgabriel.edu.ec','2533588',1,'P','0000-00-00','','0000-00-00','20060250.JPG','A','A','1','1','20060250'),(808,1,1,1,1,1013,1,'Freddy Mauricio','ALEMÁN  SILVA','C','1718162082','2034-11-02','COOP.PROFESORES MUNICIPALES. CALDERÓN','aaa@csgabriel.edu.ec','2025457',1,'P','0000-00-00','','0000-00-00','20070232.JPG','A','A','1','1','20070232'),(809,1,1,1,1,1013,1,'David Santiago','CHERRES  IMBAQUINGO','C','1722385752','2034-11-05','LIBORIO MADERA Y M.TINAJERO','aaa@csgabriel.edu.ec','2507560',1,'P','0000-00-00','','0000-00-00','20070233.JPG','A','A','1','1','20070233'),(810,1,1,1,1,1013,1,'Luis Andrés','SORIA  PEÑAFIEL','C','1722461827','0000-00-00','VALPARAIZO 322','aaa@csgabriel.edu.ec','2571738',1,'P','0000-00-00','','0000-00-00','20070235.JPG','A','A','1','1','20070235'),(811,1,1,1,1,1013,1,'Kevin Andrés','TAPIA  VILLARREAL','C','401302922','0000-00-00','MASTODONTES Y JAIME ROLDOS AGUILERA','aaa@csgabriel.edu.ec','3440333',1,'P','0000-00-00','','0000-00-00','20070236.JPG','A','A','1','1','20070236'),(812,1,1,1,1,1013,1,'Kevin Sebastián','ROMERO  CASTELLANOS','C','1718161852','0000-00-00','URB. LAS ALMENDRAS. CUMBAYÁ','aaa@csgabriel.edu.ec','2890197',1,'P','0000-00-00','','0000-00-00','20070237.JPG','A','A','1','1','20070237'),(813,1,1,1,1,1013,1,'Ángel Omar','GALLO  CRUZ','C','1723647044','0000-00-00','TOLA BAJA. ANGELA DE CAAMAÑO 248.','aaa@csgabriel.edu.ec','2581421',1,'P','0000-00-00','','0000-00-00','20070253.JPG','A','A','1','1','20070253'),(814,1,1,1,1,1013,1,'David Alejandro','BASANTES  FLORES','C','1719211102','0000-00-00','VIRGIL MATIRI E7-47','aaa@csgabriel.edu.ec','2810023',1,'P','0000-00-00','','0000-00-00','20032322.JPG','A','A','1','1','20032322'),(815,1,1,1,1,1013,1,'Luis Fernando','PROAÑO  BACA','C','1719593715','0000-00-00','RIOFRÍO N16-34 Y TEGUCIGALPA','aaa@csgabriel.edu.ec','2522657',1,'P','0000-00-00','','0000-00-00','20032434.JPG','A','A','1','1','20032434'),(816,1,1,1,1,1013,1,'Ángel Danilo','ROMÁN  GORDILLO','C','1721036943','0000-00-00','URB.LA INMACULADA PAS.BOLÍVAR E3-31','aaa@csgabriel.edu.ec','2615457',1,'P','0000-00-00','','0000-00-00','20032445.JPG','A','A','1','1','20032445'),(817,1,1,1,1,1013,1,'Henry Fabricio','FLOR  VITERI','C','1718129867','0000-00-00','MARIANA DE JESÚS Y VALDERRAMA BL-226 D-22','aaa@csgabriel.edu.ec','2265703',1,'P','0000-00-00','','0000-00-00','20032523.JPG','A','A','1','1','20032523'),(818,1,1,1,1,1013,1,'Diego Fernando','ABAD  AGUILAR','C','1721225397','0000-00-00','URB.JARDÍN DEL VALLE PAS.22 C-661','aaa@csgabriel.edu.ec','2606800',1,'P','0000-00-00','','0000-00-00','20040001.JPG','A','A','1','1','20040001'),(819,1,1,1,1,1013,1,'Sebastián Patricio','ACOSTA  IRIGOYEN','C','1721537221','0000-00-00','JUAN L. MERA N26-21 Y STA.MARIA','aaa@csgabriel.edu.ec','2568786',1,'P','0000-00-00','','0000-00-00','20040002.JPG','A','A','1','1','20040002'),(820,1,1,1,1,1013,1,'Juan Sebastián','ACOSTA  LÓPEZ','C','1717723025','0000-00-00','VERACRUZ N35-01 Y AMÉRICA','aaa@csgabriel.edu.ec','3316379',1,'P','0000-00-00','','0000-00-00','20040003.JPG','A','A','1','1','20040003'),(821,1,1,1,1,1013,1,'Andrés Esteban','AIZAGA  CHÁVEZ','C','1718163254','0000-00-00','URB.MIRADOR DEL BOSQUE C-16. SAN CARLOS','aaa@csgabriel.edu.ec','3400478',1,'P','0000-00-00','','0000-00-00','20040006.JPG','A','A','1','1','20040006'),(822,1,1,1,1,1013,1,'Andrés Sebastián','ALARCÓN  ANDRADE','C','1721226890','0000-00-00','LA ARMENIA L-92 CALLE 1-4 L-92','aaa@csgabriel.edu.ec','2346417',1,'P','0000-00-00','','0000-00-00','20040007.JPG','A','A','1','1','20040007'),(823,1,1,1,1,1013,1,'Nelson Alejandro','ALBÁN  BAJAÑA','C','1718291147','0000-00-00','SABANILLA Y F.PACHECO COND.OCCIDENT. C-32','aaa@csgabriel.edu.ec','2536599',1,'P','0000-00-00','','0000-00-00','20040008.JPG','A','A','1','1','20040008'),(824,1,1,1,1,1013,1,'Byron Andrés','ANCHALUISA  CAZA','C','1721529806','0000-00-00','GÓMEZ DE LA TORRE 303. SAN BARTOLO','aaa@csgabriel.edu.ec','2677685',1,'P','0000-00-00','','0000-00-00','20040010.JPG','A','A','1','1','20040010'),(825,1,1,1,1,1013,1,'Paúl Alexander','ANDRADE  MONTOYA','C','1719292805','0000-00-00','NAZACOLA PUENTO Y 10 DE AGOSTO. CONJ.SNT.MARIANITA','aaa@csgabriel.edu.ec','2481123',1,'P','0000-00-00','','0000-00-00','20040011.JPG','A','A','1','1','20040011'),(826,1,1,1,1,1013,1,'Gustavo Nicolás','ANDRADE  PELÁEZ','C','1716072358','2034-03-04','HERNÁN CORTEZ N56-174. SAN CARLOS','aaa@csgabriel.edu.ec','2594150',1,'P','0000-00-00','','0000-00-00','20040012.JPG','A','A','1','1','20040012'),(827,1,1,1,1,1013,1,'Bryan Isael','ANDRADE  SUÁREZ','C','1719700682','0000-00-00','CDLA.SANTIAGO. PUNTA ARENAS 1753 Y CORIG','aaa@csgabriel.edu.ec','2848200',1,'P','0000-00-00','','0000-00-00','20040013.JPG','A','A','1','1','20040013'),(828,1,1,1,1,1013,1,'Patricio Fernando','ARAUJO  CALDERÓN','C','1721349940','0000-00-00','VICENTE ANDRADE Y AV.MALDONADO CONJ.P.DE CHINBACAL','aaa@csgabriel.edu.ec','2648937',1,'P','0000-00-00','','0000-00-00','20040014.JPG','A','A','1','1','20040014'),(829,1,1,1,1,1013,1,'Diego Efrén','ARAUJO  ERAZO','C','1721468682','0000-00-00','JUAN DE ARGUELLO 334 Y P. DE ALFARO','aaa@csgabriel.edu.ec','2651552',1,'P','0000-00-00','','0000-00-00','20040015.JPG','A','A','1','1','20040015'),(830,1,1,1,1,1013,1,'Hugo Andrés','ARELLANO  ANDRADE','C','1721595070','0000-00-00','VASCO DE CONTRERAS 258 Y LALLEMENT','aaa@csgabriel.edu.ec','2462618',1,'P','0000-00-00','','0000-00-00','20040016.JPG','A','A','1','1','20040016'),(831,1,1,1,1,1013,1,'José Luis','ARELLANO  LÓPEZ','C','1720981818','0000-00-00','LALLEMENT 446','aaa@csgabriel.edu.ec','2924229',1,'P','0000-00-00','','0000-00-00','20040017.JPG','A','A','1','1','20040017'),(832,1,1,1,1,1013,1,'Juan Fernando','ARIAS  MACÍAS','C','1721619813','0000-00-00','AV.LA PRENSA . COND.LOYOLA BL-15 D-13','aaa@csgabriel.edu.ec','2535931',1,'P','0000-00-00','','0000-00-00','20040018.JPG','A','A','1','1','20040018'),(833,1,1,1,1,1013,1,'Jonathan Alejandro','ARMAS  COLLAHUAZO','C','1721532180','0000-00-00','BL-GUAYLLABAMBA.SAN CARLOS','aaa@csgabriel.edu.ec','3401237',1,'P','0000-00-00','','0000-00-00','20040019.JPG','A','A','1','1','20040019'),(834,1,1,1,1,1013,1,'Bryan Jefferson','ARMAS  HERRERA','C','1716166606','0000-00-00','SUCRE OE5-53','aaa@csgabriel.edu.ec','2284736',1,'P','0000-00-00','','0000-00-00','20040020.JPG','A','A','1','1','20040020'),(835,1,1,1,1,1013,1,'Mario Iván','ARMENDÁRIZ  YANCHAPAXI','C','1719417691','0000-00-00','RÍO DE JANEIRO OE3-192 Y URUGUAY','aaa@csgabriel.edu.ec','2559657',1,'P','0000-00-00','','0000-00-00','20040021.JPG','A','A','1','1','20040021'),(836,1,1,1,1,1013,1,'Alex Fabián','BÁEZ  AVILÉS','C','1717398232','0000-00-00','18 DE SEPTIEMBRE 1350 Y ARMERO','aaa@csgabriel.edu.ec','2552985',1,'P','0000-00-00','','0000-00-00','20040023.JPG','A','A','1','1','20040023'),(837,1,1,1,1,1013,1,'Marco Alexander','BASURI  FERNÁNDEZ','C','1718524976','0000-00-00','GENERAL ENRÍQUEZ S8-336 Y RODRIGO DE CHÁVEZ','aaa@csgabriel.edu.ec','2584213',1,'P','0000-00-00','','0000-00-00','20040024.JPG','A','A','1','1','20040024'),(838,1,1,1,1,1013,1,'Alejandro Wladimir','BERNYS  PÁEZ','C','1718336488','0000-00-00','10 DE AGOSTO Y P.ROMERO CASA 10','aaa@csgabriel.edu.ec','2409918',1,'P','0000-00-00','','0000-00-00','20040028.JPG','A','A','1','1','20040028'),(839,1,1,1,1,1013,1,'Mauricio Kevin','BETANCOURT  BACA','C','1721406773','0000-00-00','MARISCAL SUCRE 3663 Y HUANCAVILVA','aaa@csgabriel.edu.ec','2282466',1,'P','0000-00-00','','0000-00-00','20040029.JPG','A','A','1','1','20040029'),(840,1,1,1,1,1013,1,'Luis Alberto','BOLAÑOS  NARANJO','C','1721512422','0000-00-00','SANTA ANA 1100 Y DE LOS HEMISFERIOS','aaa@csgabriel.edu.ec','2397505',1,'P','0000-00-00','','0000-00-00','20040031.JPG','A','A','1','1','20040031'),(841,1,1,1,1,1013,1,'Hernán Renato','BURGOS  CALERO','C','1718160326','0000-00-00','TNTE.GARCÍA 447 Y M. SUCRE','aaa@csgabriel.edu.ec','2653181',1,'P','0000-00-00','','0000-00-00','20040032.JPG','A','A','1','1','20040032'),(842,1,1,1,1,1013,1,'John Steven','CABEZAS  JÁCOME','C','1713718128','0000-00-00','MURGUEON 536. ENTRE AMÉRICA Y ULLOA','aaa@csgabriel.edu.ec','2905284',1,'P','0000-00-00','','0000-00-00','20040034.JPG','A','A','1','1','20040034'),(843,1,1,1,1,1013,1,'José Andrés','CABRERA  IRIGOYA','C','1804000550','0000-00-00','SAN PEDRO 3354 Y RUMIPAMBA','aaa@csgabriel.edu.ec','2923126',1,'P','0000-00-00','','0000-00-00','20040035.JPG','A','A','1','1','20040035'),(844,1,1,1,1,1013,1,'Fabricio Andrés','CADENA  AYALA','C','1720439502','0000-00-00','CHIMBORAZO 1410 Y FCO. DE ORELLANA. CUMBAYÁ','aaa@csgabriel.edu.ec','2896871',1,'P','0000-00-00','','0000-00-00','20040036.JPG','A','A','1','1','20040036'),(845,1,1,1,1,1013,1,'Mario Paúl','CALLE  PIEDRA','C','1721537460','0000-00-00','MISIÓN GEODÉSICA 4 Y LULUBAMBA','aaa@csgabriel.edu.ec','2394558',1,'P','0000-00-00','','0000-00-00','20040040.JPG','A','A','1','1','20040040'),(846,1,1,1,1,1013,1,'Bryan Esteban','CAMACHO  JAYA','C','1721408415','0000-00-00','EL PROGRESO OE1-60. MAYORISTA','aaa@csgabriel.edu.ec','2671075',1,'P','0000-00-00','','0000-00-00','20040041.JPG','A','A','1','1','20040041'),(847,1,1,1,1,1013,1,'Germán Alejandro','CÁRDENAS  IZQUIERDO','C','1716993959','0000-00-00','AV. ATAHUALPA 219 Y ULLOA','aaa@csgabriel.edu.ec','2548463',1,'P','0000-00-00','','0000-00-00','20040042.JPG','A','A','1','1','20040042'),(848,1,1,1,1,1013,1,'Marco David','CARRILLO  ARTEAGA','C','1721604740','0000-00-00','AVELLANAS E6-03 Y ELOY ALFARO.','aaa@csgabriel.edu.ec','2470834',1,'P','0000-00-00','','0000-00-00','20040043.JPG','A','A','1','1','20040043'),(849,1,1,1,1,1013,1,'José Luis','CAZAR  LÓPEZ','C','1721484374','0000-00-00','FERNANDO DÁVALOS 431 Y MANUEL SERRANO','aaa@csgabriel.edu.ec','3303093',1,'P','0000-00-00','','0000-00-00','20040045.JPG','A','A','1','1','20040045'),(850,1,1,1,1,1013,1,'Ángel Israel','CEPEDA  AVEIGA','C','1718860818','0000-00-00','DÍAZ DE LA MADRID Y ACEVEDO BL-C D-403','aaa@csgabriel.edu.ec','3200869',1,'P','0000-00-00','','0000-00-00','20040047.JPG','A','A','1','1','20040047'),(851,1,1,1,1,1013,1,'Santiago Ricardo','CEPEDA  GARCÍA','C','1718160904','0000-00-00','VERSALLES 2457 Y L. CORDERO','aaa@csgabriel.edu.ec','2566894',1,'P','0000-00-00','','0000-00-00','20040048.JPG','A','A','1','1','20040048'),(852,1,1,1,1,1013,1,'Rodrigo Alejandro','CEVALLOS  HERRERA','C','1721509998','0000-00-00','LUGO Y LÉRIDA PAS.3 N22-109','aaa@csgabriel.edu.ec','2527170',1,'P','0000-00-00','','0000-00-00','20040049.JPG','A','A','1','1','20040049'),(853,1,1,1,1,1013,1,'Francisco Andrés','CHÁVEZ  VILLACRÉS','C','1721548608','0000-00-00','MANUELA SÁENZ 542 Y ABELARDO MONCAYO','aaa@csgabriel.edu.ec','2453506',1,'P','0000-00-00','','0000-00-00','20040050.JPG','A','A','1','1','20040050'),(854,1,1,1,1,1013,1,'Andrés Luis','CHILUIZA  BENÍTEZ','C','1716160070','0000-00-00','JOSÉ ORDÓÑEZ OE2-102 Y FCO. SANCHEZ','aaa@csgabriel.edu.ec','3441014',1,'P','0000-00-00','','0000-00-00','20040051.JPG','A','A','1','1','20040051'),(855,1,1,1,1,1013,1,'Gabriel Alejandro','CISNEROS  YÁNEZ','C','1721543070','0000-00-00','MATILDE HIDALGO N81-22 Y A. DE JEREZ','aaa@csgabriel.edu.ec','2473251',1,'P','0000-00-00','','0000-00-00','20040052.JPG','A','A','1','1','20040052'),(856,1,1,1,1,1013,1,'Jhonatan André','COBA  PALACIOS','C','1715313837','2034-00-07','PAS.CÉSAR FRANK E3-54 E ISAC ALBÉNIZ','aaa@csgabriel.edu.ec','2410939',1,'P','0000-00-00','','0000-00-00','20040053.JPG','A','A','1','1','20040053'),(857,1,1,1,1,1013,1,'Pablo David','CÓRDOVA  HEREDIA','C','1719652842','0000-00-00','PAS. CALLE 1 C-E.32 Y CHUQUISACA. OFELIA','aaa@csgabriel.edu.ec','2292186',1,'P','0000-00-00','','0000-00-00','20040054.JPG','A','A','1','1','20040054'),(858,1,1,1,1,1013,1,'Andrés Alonso','CORRAL  GONZÁLEZ','C','1721605457','0000-00-00','MAÑOSCA Y VERACRUZ 201','aaa@csgabriel.edu.ec','2450187',1,'P','0000-00-00','','0000-00-00','20040055.JPG','A','A','1','1','20040055'),(859,1,1,1,1,1013,1,'Gabriel Alexander','COSTALES  ACURIO','C','1719241927','0000-00-00','VELA 285 Y AV.MALDONADO','aaa@csgabriel.edu.ec','2957642',1,'P','0000-00-00','','0000-00-00','20040056.JPG','A','A','1','1','20040056'),(860,1,1,1,1,1013,1,'Herman Sebastián','COUSIN  ESPINOSA','C','1716169360','0000-00-00','PAS.WUAYCO 128 Y NICOLÁS CORTEZ','aaa@csgabriel.edu.ec','3227026',1,'P','0000-00-00','','0000-00-00','20040057.JPG','A','A','1','1','20040057'),(861,1,1,1,1,1013,1,'Alex Nicolai','CUESTA  GORDILLO','C','1718291634','0000-00-00','OB. DÍAZ DE LA MADRID 2E-06 Y VILLAVICENCIO','aaa@csgabriel.edu.ec','2233342',1,'P','0000-00-00','','0000-00-00','20040058.JPG','A','A','1','1','20040058'),(862,1,1,1,1,1013,1,'Steve Daniel','CUEVA  ARBOLEDA','C','1721524997','0000-00-00','CDLA.SANTA ANITA DOS MZ-3 C-10. PAS A.CARRANZA','aaa@csgabriel.edu.ec','2646105',1,'P','0000-00-00','','0000-00-00','20040059.JPG','A','A','1','1','20040059'),(863,1,1,1,1,1013,1,'Manuel Alejandro','DARQUEA  PONCE','C','1718165697','2034-00-08','GUALAQUIZA N62-149 Y SABANILLA','aaa@csgabriel.edu.ec','2290710',1,'P','0000-00-00','','0000-00-00','20040060.JPG','A','A','1','1','20040060'),(864,1,1,1,1,1013,1,'Pedro Daniel','DÁVILA  FIALLOS','C','1721514790','0000-00-00','AV.DIEGO DE VÁSQUEZ Y CALLE C','aaa@csgabriel.edu.ec','2479618',1,'P','0000-00-00','','0000-00-00','20040061.JPG','A','A','1','1','20040061'),(865,1,1,1,1,1013,1,'Miguel Antonio','DÍAZ  EGAS','C','1716609449','0000-00-00','PAS.PAYAMINO 180 Y 6 DE DICIEMBRE','aaa@csgabriel.edu.ec','2450808',1,'P','0000-00-00','','0000-00-00','20040063.JPG','A','A','1','1','20040063'),(866,1,1,1,1,1013,1,'Víctor Daniel','DÍAZ  ESCOBAR','C','1721298188','0000-00-00','AUCAS N50-240 Y H.SALAS','aaa@csgabriel.edu.ec','2438862',1,'P','0000-00-00','','0000-00-00','20040064.JPG','A','A','1','1','20040064'),(867,1,1,1,1,1013,1,'Felipe Alfonso','DÍAZ  RIVADENEIRA','C','1715365373','0000-00-00','JOSÉ GUERRERO 70-17 Y ALFONSO DEL HIERRO','aaa@csgabriel.edu.ec','2493943',1,'P','0000-00-00','','0000-00-00','20040065.JPG','A','A','1','1','20040065'),(868,1,1,1,1,1013,1,'Álvaro Ricardo','ECHEVERRÍA  CALDERÓN','C','1717968752','0000-00-00','JOSÉ PERALTA L-7 BL-2 D-251','aaa@csgabriel.edu.ec','3060431',1,'P','0000-00-00','','0000-00-00','20040066.JPG','A','A','1','1','20040066'),(869,1,1,1,1,1013,1,'Fabián Alejandro','ECHEVERRÍA  CAZAR','C','1721531802','0000-00-00','AV. DE LA PRENSA 956 Y TELÉGRAFO','aaa@csgabriel.edu.ec','2267206',1,'P','0000-00-00','','0000-00-00','20040067.JPG','A','A','1','1','20040067'),(870,1,1,1,1,1013,1,'Daniel Fernando','ENRÍQUEZ  MACAS','C','1718163205','0000-00-00','AV.C.GALARZA CONJ.LAGUNA AZUL CASA 45','aaa@csgabriel.edu.ec','2921104',1,'P','0000-00-00','','0000-00-00','20040068.JPG','A','A','1','1','20040068'),(871,1,1,1,1,1013,1,'Roberto Mauricio','ERAZO  PEÑAHERRERA','C','1713460663','0000-00-00','COND. SAN SEBASTIÁN DEL NORTE BL-34.','aaa@csgabriel.edu.ec','2811303',1,'P','0000-00-00','','0000-00-00','20040069.JPG','A','A','1','1','20040069'),(872,1,1,1,1,1013,1,'Kevin Geancarlos','ESPÍN  DELGADO','C','1720249497','0000-00-00','PINTAG 1114 Y HÚSARES','aaa@csgabriel.edu.ec','2661599',1,'P','0000-00-00','','0000-00-00','20040070.JPG','A','A','1','1','20040070'),(873,1,1,1,1,1013,1,'Alex Roberto','ESPINOSA  RAMOS','C','1717728636','0000-00-00','FÉLIX ORALABAL N45-165 Y ZAMORA','aaa@csgabriel.edu.ec','2247579',1,'P','0000-00-00','','0000-00-00','20040071.JPG','A','A','1','1','20040071'),(874,1,1,1,1,1013,1,'Ricardo David','GARCÍA  ORTEGA','C','1720875168','0000-00-00','ARMERO 492 Y AV.UNIVERSITARIA','aaa@csgabriel.edu.ec','2551491',1,'P','0000-00-00','','0000-00-00','20040076.JPG','A','A','1','1','20040076'),(875,1,1,1,1,1013,1,'Diego José','GARRIDO  ORTIZ','C','1721444428','0000-00-00','LA ISLA 423 Y JOSÉ VALENTÍN','aaa@csgabriel.edu.ec','2553338',1,'P','0000-00-00','','0000-00-00','20040077.JPG','A','A','1','1','20040077'),(876,1,1,1,1,1013,1,'David Alejandro','GARZÓN  FREIRE','C','1721031209','0000-00-00','INÉS GANGOTENA L-2 Y 22 DE ENERO. SANGOLQUÍ','aaa@csgabriel.edu.ec','2337115',1,'P','0000-00-00','','0000-00-00','20040078.JPG','A','A','1','1','20040078'),(877,1,1,1,1,1013,1,'Juan Francisco','GARZÓN  PINTO','C','1721230074','0000-00-00','YARUQUÍ. CALLE QUITO','aaa@csgabriel.edu.ec','2777842',1,'P','0000-00-00','','0000-00-00','20040079.JPG','A','A','1','1','20040079'),(878,1,1,1,1,1013,1,'Harold Andrés','GONZÁLEZ  MARCHÁN','C','1718161621','0000-00-00','DÍAZ DE LA MADRID Y JUAN ACEVEDO','aaa@csgabriel.edu.ec','3201128',1,'P','0000-00-00','','0000-00-00','20040081.JPG','A','A','1','1','20040081'),(879,1,1,1,1,1013,1,'Xavier Alejandro','GRANDA  SILVA','C','1715420558','0000-00-00','FCO. DE NATES 393 E HIDALGO DE PINTO','aaa@csgabriel.edu.ec','2450351',1,'P','0000-00-00','','0000-00-00','20040082.JPG','A','A','1','1','20040082'),(880,1,1,1,1,1013,1,'Iván Andrés','GRIJALVA  TERÁN','C','1719538603','0000-00-00','NAZACOTA PUENTO N64-25 Y CALLE A','aaa@csgabriel.edu.ec','2290550',1,'P','0000-00-00','','0000-00-00','20040083.JPG','A','A','1','1','20040083'),(881,1,1,1,1,1013,1,'Mario Steven','GUALAVISI  LIMAICO','C','1721617536','0000-00-00','CALLE TABIAZO Y MONTE OLIVOS MZ-D C-S.24-37','aaa@csgabriel.edu.ec','3027834',1,'P','0000-00-00','','0000-00-00','20040084.JPG','A','A','1','1','20040084'),(882,1,1,1,1,1013,1,'Alberto Xavier','GUAMÁN  AGUIRRE','C','1721480794','0000-00-00','AV.OCCIDENTAL Y LEGARDA. CONJ.EL FUNDADOR','aaa@csgabriel.edu.ec','2491906',1,'P','0000-00-00','','0000-00-00','20040085.JPG','A','A','1','1','20040085'),(883,1,1,1,1,1013,1,'David Ezequiel','GUAMÁN  AGUIRRE','C','1721480786','0000-00-00','AV.MARISCAL SUCRE N68-468 Y LEGARDA','aaa@csgabriel.edu.ec','2491906',1,'P','0000-00-00','','0000-00-00','20040086.JPG','A','A','1','1','20040086'),(884,1,1,1,1,1013,1,'Cristhian Alexander','GUERRA  QUIJIJE','C','1721602967','0000-00-00','IBERIA 691. LA FLORESTA','aaa@csgabriel.edu.ec','2543088',1,'P','0000-00-00','','0000-00-00','20040088.JPG','A','A','1','1','20040088'),(885,1,1,1,1,1013,1,'Jonathan Fernando','GUERRÓN  SALAZAR','C','401661152','0000-00-00','JUAN FIGUEROA 1566 Y LUIS VALLEJO','aaa@csgabriel.edu.ec','2599243',1,'P','0000-00-00','','0000-00-00','20040092.JPG','A','A','1','1','20040092'),(886,1,1,1,1,1013,1,'Kerby Renato','HARNISTH  MOSQUERA','C','1713646329','0000-00-00','CDLA.LA OFELIA MZ-B CASA OE2-16','aaa@csgabriel.edu.ec','2407075',1,'P','0000-00-00','','0000-00-00','20040093.JPG','A','A','1','1','20040093'),(887,1,1,1,1,1013,1,'Fernando Andrés','HERDOIZA  VIVAR','C','1717343840','0000-00-00','SHUARAS Y GONZALO BENÍTEZ ED.RIM PARK D-2 PISO 1','aaa@csgabriel.edu.ec','3302046',1,'P','0000-00-00','','0000-00-00','20040094.JPG','A','A','1','1','20040094'),(888,1,1,1,1,1013,1,'Jaime Marcelo','HERNÁNDEZ  SILVA','C','1718161654','0000-00-00','JOAQUÍN OROZCO S13-33 Y PALMIRA','aaa@csgabriel.edu.ec','3110328',1,'P','0000-00-00','','0000-00-00','20040095.JPG','A','A','1','1','20040095'),(889,1,1,1,1,1013,1,'José Ismael','HERRERA  ROMERO','C','1721487229','0000-00-00','PORTETE E10-259','aaa@csgabriel.edu.ec','3332118',1,'P','0000-00-00','','0000-00-00','20040096.JPG','A','A','1','1','20040096'),(890,1,1,1,1,1013,1,'José Luis','HIDALGO  QUEZADA','C','1718160300','0000-00-00','MONTEVIDEO OE9-438 Y TEGUCIGALPA','aaa@csgabriel.edu.ec','2529736',1,'P','0000-00-00','','0000-00-00','20040097.JPG','A','A','1','1','20040097'),(891,1,1,1,1,1013,1,'Cristhian Javier','HIDALGO  RUIZ','C','1720300308','0000-00-00','AV. NAPO S7-233 Y BOBONAZA','aaa@csgabriel.edu.ec','3130760',1,'P','0000-00-00','','0000-00-00','20040098.JPG','A','A','1','1','20040098'),(892,1,1,1,1,1013,1,'Pablo Daniel','JÁCOME  SÁNCHEZ','C','1719466573','0000-00-00','CALLE ATAHUALPA 19-89. SANGOLQUÍ','aaa@csgabriel.edu.ec','2332389',1,'P','0000-00-00','','0000-00-00','20040099.JPG','A','A','1','1','20040099'),(893,1,1,1,1,1013,1,'Daniel Fernando','JIMÉNEZ  MALDONADO','C','1721474516','0000-00-00','COND. PUERTAS DEL SOL CASA 59. LOS CHILLOS','aaa@csgabriel.edu.ec','2607500',1,'P','0000-00-00','','0000-00-00','20040100.JPG','A','A','1','1','20040100'),(894,1,1,1,1,1013,1,'Joseph Alexander','LEINES  ARTIEDA','C','1721543088','0000-00-00','CALLE SANTA TERESA N64-81.COTOCOLLAO','aaa@csgabriel.edu.ec','2591486',1,'P','0000-00-00','','0000-00-00','20040102.JPG','A','A','1','1','20040102'),(895,1,1,1,1,1013,1,'Pablo Andrés','LLERENA  RENGEL','C','1719873604','0000-00-00','OCCIDENTAL Y LEGARDA. CONJ.PALERMO B-9','aaa@csgabriel.edu.ec','2499323',1,'P','0000-00-00','','0000-00-00','20040103.JPG','A','A','1','1','20040103'),(896,1,1,1,1,1013,1,'Fabián Andrés','LLIVE  BASTIDAS','C','1721594347','0000-00-00','JUNÍN E3-139 Y JIJÓN','aaa@csgabriel.edu.ec','2952289',1,'P','0000-00-00','','0000-00-00','20040104.JPG','A','A','1','1','20040104'),(897,1,1,1,1,1013,1,'César Fabián','LÓPEZ  RODRÍGUEZ','C','1718452962','0000-00-00','6 DE DICIEMBRE 3229 Y JUAN SEVERINO','aaa@csgabriel.edu.ec','2239582',1,'P','0000-00-00','','0000-00-00','20040105.JPG','A','A','1','1','20040105'),(898,1,1,1,1,1013,1,'Diego Andrés','LOZANO  DELGADO','C','1721526802','0000-00-00','CONJ.BALCONES DEL RECREO CASA 21. EL RECREO','aaa@csgabriel.edu.ec','2648136',1,'P','0000-00-00','','0000-00-00','20040107.JPG','A','A','1','1','20040107'),(899,1,1,1,1,1013,1,'Marco Andrés','LUNA  AGUIRRE','C','1718321985','0000-00-00','EL DORADO. AV. COLOMBIA Y TELMO PAZ Y MIÑO D-505','aaa@csgabriel.edu.ec','2223368',1,'P','0000-00-00','','0000-00-00','20040108.JPG','A','A','1','1','20040108'),(900,1,1,1,1,1013,1,'Yoder Alexis','MACAS  GALARZA','C','1714833942','0000-00-00','CARCELÉN. BL-TOMEBAMBA D-102','aaa@csgabriel.edu.ec','2472323',1,'P','0000-00-00','','0000-00-00','20040109.JPG','A','A','1','1','20040109'),(901,1,1,1,1,1013,1,'José Israel','MANOSALVAS  CHÁVEZ','C','1721236501','0000-00-00','GONZALO PIZARRO 808. PIFO','aaa@csgabriel.edu.ec','2380714',1,'P','0000-00-00','','0000-00-00','20040110.JPG','A','A','1','1','20040110'),(902,1,1,1,1,1013,1,'Carlos Andrés','MANOSALVAS  ESPINOSA','C','1721401501','0000-00-00','CALLE A CASA 27. PUSUQUÍ','aaa@csgabriel.edu.ec','2352586',1,'P','0000-00-00','','0000-00-00','20040111.JPG','A','A','1','1','20040111'),(903,1,1,1,1,1013,1,'Juan Francisco','MANOSALVAS  LÓPEZ','C','1719147785','0000-00-00','BRASILIA DOS CASA 135','aaa@csgabriel.edu.ec','2412775',1,'P','0000-00-00','','0000-00-00','20040112.JPG','A','A','1','1','20040112'),(904,1,1,1,1,1013,1,'Andrés Sebastián','MERLO  LÓPEZ','C','1721603809','0000-00-00','SABANILLA OE3-312 Y CHUQUISACA','aaa@csgabriel.edu.ec','2292435',1,'P','0000-00-00','','0000-00-00','20040113.JPG','A','A','1','1','20040113'),(905,1,1,1,1,1013,1,'Daniel Simón','MESTANZA  GUEVARA','C','1715457824','0000-00-00','SERAPIO JAPERABI S13-248','aaa@csgabriel.edu.ec','2632723',1,'P','0000-00-00','','0000-00-00','20040114.JPG','A','A','1','1','20040114'),(906,1,1,1,1,1013,1,'Francisco Gabriel','MIRANDA  PAREDES','C','1721226932','0000-00-00','AV.ILALO Y 8TA.TRANSVERSAL 224. SAN RAFAEL','aaa@csgabriel.edu.ec','2346213',1,'P','0000-00-00','','0000-00-00','20040115.JPG','A','A','1','1','20040115'),(907,1,1,1,1,1013,1,'David Alejandro','MONAR  GAIBOR','C','1721359618','0000-00-00','DAVID LEDESMA N69-31','aaa@csgabriel.edu.ec','2596559',1,'P','0000-00-00','','0000-00-00','20040116.JPG','A','A','1','1','20040116'),(908,1,1,1,1,1013,1,'Fernando Sebastián','MONTALVO  ZUMÁRRAGA','C','1721602710','0000-00-00','SAN MIGUEL DE ANAGAES S/N. EL EDÉN','aaa@csgabriel.edu.ec','2416117',1,'P','0000-00-00','','0000-00-00','20040117.JPG','A','A','1','1','20040117'),(909,1,1,1,1,1013,1,'David Fernando','MOSCOSO  VÁSCONEZ','C','1719463612','0000-00-00','ARUPOS 534 Y GONZÁLEZ SUÁREZ','aaa@csgabriel.edu.ec','98636811',1,'P','0000-00-00','','0000-00-00','20040118.JPG','A','A','1','1','20040118'),(910,1,1,1,1,1013,1,'Daniel Steven','MUÑOZ  NEIRA','C','1721344701','0000-00-00','VARGAS 10-40 Y GALÁPAGOS','aaa@csgabriel.edu.ec','2570055',1,'P','0000-00-00','','0000-00-00','20040119.JPG','A','A','1','1','20040119'),(911,1,1,1,1,1013,1,'Adrian David','MUÑOZ  TRUJILLO','C','1717052979','0000-00-00','EL MORLÁN 838 Y RAMOS','aaa@csgabriel.edu.ec','2412598',1,'P','0000-00-00','','0000-00-00','20040120.JPG','A','A','1','1','20040120'),(912,1,1,1,1,1013,1,'Cristhian Sebastián','NARVÁEZ  AGUILAR','C','1721265088','0000-00-00','JARDINES DEL BOSQUE C-27','aaa@csgabriel.edu.ec','2290107',1,'P','0000-00-00','','0000-00-00','20040121.JPG','A','A','1','1','20040121'),(913,1,1,1,1,1013,1,'Jonathan Omar','NARVÁEZ  VALLE','C','1717723462','0000-00-00','AV.SUNA 350 Y MIGUEL ÁNGEL. CUMBAYÁ','aaa@csgabriel.edu.ec','2890819',1,'P','0000-00-00','','0000-00-00','20040122.JPG','A','A','1','1','20040122'),(914,1,1,1,1,1013,1,'Luis Miguel','NAVARRETE  MONGE','C','1719146902','0000-00-00','LA PAMPA II. PAS.3 #209 Y 2DA. AVENIDA','aaa@csgabriel.edu.ec','2351373',1,'P','0000-00-00','','0000-00-00','20040123.JPG','A','A','1','1','20040123'),(915,1,1,1,1,1013,1,'Juan Francisco','NICOLALDE  DE LA TORRE','C','1717929309','0000-00-00','MIGUEL Y SOLIER 270. LAS CASAS','aaa@csgabriel.edu.ec','2239294',1,'P','0000-00-00','','0000-00-00','20040124.JPG','A','A','1','1','20040124'),(916,1,1,1,1,1013,1,'Danilo Santiago','NOROÑA  VENEGAS','C','1721612578','0000-00-00','GUALBERTO PÉREZ E2-207. EL CAMAL','aaa@csgabriel.edu.ec','2642973',1,'P','0000-00-00','','0000-00-00','20040126.JPG','A','A','1','1','20040126'),(917,1,1,1,1,1013,1,'Andrés Esteban','NÚÑEZ  VACA','C','1721205639','0000-00-00','BENALCÁZAR 1121 Y GALÁPAGOS','aaa@csgabriel.edu.ec','2285223',1,'P','0000-00-00','','0000-00-00','20040128.JPG','A','A','1','1','20040128'),(918,1,1,1,1,1013,1,'David Rolando','ORBEA  JEREZ','C','1718788282','0000-00-00','LLANO CHICO. LAS AZUCENAS S/N','aaa@csgabriel.edu.ec','2830524',1,'P','0000-00-00','','0000-00-00','20040129.JPG','A','A','1','1','20040129'),(919,1,1,1,1,1013,1,'Felipe Andrés','PACHECO  GRANDA','C','1715232714','2034-08-03','CALLE MARIANO PAREDES N70-115 Y MOISÉS LUNA','aaa@csgabriel.edu.ec','2801471',1,'P','0000-00-00','','0000-00-00','20040131.JPG','A','A','1','1','20040131'),(920,1,1,1,1,1013,1,'Marco Santiago','PÁEZ  ANDRADE','C','1721408670','2034-03-02','CONJ.SANTA MARIANITAS 4 C-192 PAS.U. CALDERÓN','aaa@csgabriel.edu.ec','2065316',1,'P','0000-00-00','','0000-00-00','20040132.JPG','A','A','1','1','20040132'),(921,1,1,1,1,1013,1,'Julio Francisco','PAREDES  YÉPEZ','C','1716893209','0000-00-00','CARLOS V C.4-11 Y ANTONIO VILLAVICENCIO','aaa@csgabriel.edu.ec','2530594',1,'P','0000-00-00','','0000-00-00','20040133.JPG','A','A','1','1','20040133'),(922,1,1,1,1,1013,1,'Fausto Andrés','PAZMIÑO  DÁVILA','C','1714192901','0000-00-00','JORGE JUAN 439 Y MARIANA DE JESÚS','aaa@csgabriel.edu.ec','2520343',1,'P','0000-00-00','','0000-00-00','20040135.JPG','A','A','1','1','20040135'),(923,1,1,1,1,1013,1,'Fausto Andrés','PEÑA  JARRÍN','C','1714005640','0000-00-00','FICOA S15-116 Y BUENA U. SAN BARTOLO','aaa@csgabriel.edu.ec','2674561',1,'P','0000-00-00','','0000-00-00','20040136.JPG','A','A','1','1','20040136'),(924,1,1,1,1,1013,1,'Jorge Leonardo','PERALVO  ALULEMA','C','1719881003','0000-00-00','SOLANDA SECTOR 1 MZ-1 C-7','aaa@csgabriel.edu.ec','2730564',1,'P','0000-00-00','','0000-00-00','20040137.JPG','A','A','1','1','20040137'),(925,1,1,1,1,1013,1,'David Alejandro','PÉREZ  ESPINEL','C','1721595591','2034-05-07','CALLE LUCINDA TOLEDO S/N Y ALIANZA. ALOAG','aaa@csgabriel.edu.ec','2389673',1,'P','0000-00-00','','0000-00-00','20040138.JPG','A','A','1','1','20040138'),(926,1,1,1,1,1013,1,'José Carlos','PÉREZ  IPIALES','C','1714004858','0000-00-00','COND.JOYA DEL PICHINCHA C-B-8.COTOCOLLAO','aaa@csgabriel.edu.ec','2492710',1,'P','0000-00-00','','0000-00-00','20040139.JPG','A','A','1','1','20040139'),(927,1,1,1,1,1013,1,'Erick Andrés','PÉREZ  SALAZAR','C','1719347229','0000-00-00','RITTER Y BENJAMÍN CHÁVEZ 1434','aaa@csgabriel.edu.ec','2223424',1,'P','0000-00-00','','0000-00-00','20040140.JPG','A','A','1','1','20040140'),(928,1,1,1,1,1013,1,'Alex Adrian','PIEDRA  ABAD','C','1715209266','0000-00-00','AV. DEL MAESTRO OE2-182','aaa@csgabriel.edu.ec','2476009',1,'P','0000-00-00','','0000-00-00','20040141.JPG','A','A','1','1','20040141'),(929,1,1,1,1,1013,1,'Alejandro David','PIEDRA  TOLEDO','C','502554942','0000-00-00','CAYAMBE 316 Y QUILINDAÑA. VILLAFLORA','aaa@csgabriel.edu.ec','2650634',1,'P','0000-00-00','','0000-00-00','20040142.JPG','A','A','1','1','20040142'),(930,1,1,1,1,1013,1,'Ricardo Sebastián','PONCE  SÁNCHEZ','C','1719568899','0000-00-00','SAN PEDRO CLAVER PAS.3 OE5-233 Y MACHALA','aaa@csgabriel.edu.ec','2291810',1,'P','0000-00-00','','0000-00-00','20040144.JPG','A','A','1','1','20040144'),(931,1,1,1,1,1013,1,'David Sebastián','PORTILLA  CISNEROS','C','1718164153','0000-00-00','CAP.RAMÓN BORJA E7-205 Y EL MORLÁN','aaa@csgabriel.edu.ec','2404731',1,'P','0000-00-00','','0000-00-00','20040145.JPG','A','A','1','1','20040145'),(932,1,1,1,1,1013,1,'Rommel Alexander','POVEDA  OLMEDO','C','1721408282','0000-00-00','COLTA E686 Y GUALACEO. CHIRIACU ALTO','aaa@csgabriel.edu.ec','2641426',1,'P','0000-00-00','','0000-00-00','20040146.JPG','A','A','1','1','20040146'),(933,1,1,1,1,1013,1,'Galo Sebastián','PRÓCEL  MEDINA','C','1718163932','0000-00-00','CONJ.MOLINEROS C-48. ENTRE 6 DE DICIEMBRE Y E.ALFA','aaa@csgabriel.edu.ec','3463318',1,'P','0000-00-00','','0000-00-00','20040148.JPG','A','A','1','1','20040148'),(934,1,1,1,1,1013,1,'Carlos Julio','PUGA  DURÁN','C','1721407219','0000-00-00','MULALILLO S24-80 Y CHUMUNDE','aaa@csgabriel.edu.ec','2626395',1,'P','0000-00-00','','0000-00-00','20040149.JPG','A','A','1','1','20040149'),(935,1,1,1,1,1013,1,'Francisco Xavier','QUINTANILLA  RIBADENEIRA','C','1720419702','0000-00-00','URB.BILOXI. PAS.13 CASA 183','aaa@csgabriel.edu.ec','2634190',1,'P','0000-00-00','','0000-00-00','20040151.JPG','A','A','1','1','20040151'),(936,1,1,1,1,1013,1,'Rafael Francisco','RACINES  MERCHÁN','C','918659343','0000-00-00','SOLANO DE QUIÑÓNEZ 217 Y P. DE ALFARO','aaa@csgabriel.edu.ec','2663806',1,'P','0000-00-00','','0000-00-00','20040152.JPG','A','A','1','1','20040152'),(937,1,1,1,1,1013,1,'Christian Patricio','REDROVÁN  LANDETA','C','1718162579','0000-00-00','ILLESCAS 224 Y AV.MARISCAL SUCRE','aaa@csgabriel.edu.ec','2616982',1,'P','0000-00-00','','0000-00-00','20040153.JPG','A','A','1','1','20040153'),(938,1,1,1,1,1013,1,'Juan Fernando','RICAURTE  FIERRO','C','1714150149','0000-00-00','PEDRO BASÁN N35-45 Y MAÑOSCA','aaa@csgabriel.edu.ec','2255157',1,'P','0000-00-00','','0000-00-00','20040154.JPG','A','A','1','1','20040154'),(939,1,1,1,1,1013,1,'Andrés Fernando','RIERA  ESTÉVEZ','C','1718164369','0000-00-00','ANTONIO DE HERRERA 230','aaa@csgabriel.edu.ec','2614415',1,'P','0000-00-00','','0000-00-00','20040155.JPG','A','A','1','1','20040155'),(940,1,1,1,1,1013,1,'Andrés Santiago','RODRÍGUEZ  GARZÓN','C','1715580526','0000-00-00','A. SOBERÓN 62 Y J.PERALTA','aaa@csgabriel.edu.ec','2656763',1,'P','0000-00-00','','0000-00-00','20040156.JPG','A','A','1','1','20040156'),(941,1,1,1,1,1013,1,'Crhistian Iván','ROMÁN  PAREDES','C','1715905798','0000-00-00','MANUEL MATHEU N56-95 Y JOSÉ BORRERO','aaa@csgabriel.edu.ec','2410495',1,'P','0000-00-00','','0000-00-00','20040157.JPG','A','A','1','1','20040157'),(942,1,1,1,1,1013,1,'Jorge Alexis','ROSALES  AILLÓN','C','1720549524','0000-00-00','CONJ. BAVARIA CASA 6. SAN RAFAEL','aaa@csgabriel.edu.ec','2850077',1,'P','0000-00-00','','0000-00-00','20040158.JPG','A','A','1','1','20040158'),(943,1,1,1,1,1013,1,'Pablo Hernán','ROSERO  BASTIDAS','C','1718004250','0000-00-00','PURUHA 376 Y AUTACHI. LA MAGDALENA','aaa@csgabriel.edu.ec','2652963',1,'P','0000-00-00','','0000-00-00','20040159.JPG','A','A','1','1','20040159'),(944,1,1,1,1,1013,1,'Diego Roberto','RUIZ  CALERO','C','1721526307','0000-00-00','MULT.TURUBAMBA BAJO BL-J.LARREA 32 D-202','aaa@csgabriel.edu.ec','2671948',1,'P','0000-00-00','','0000-00-00','20040160.JPG','A','A','1','1','20040160'),(945,1,1,1,1,1013,1,'Ronal Alejandro','RUIZ  GRIJALVA','C','1719744664','0000-00-00','JUMANDÍ OE2-262. CDLA.ATAHUALPA','aaa@csgabriel.edu.ec','2658812',1,'P','0000-00-00','','0000-00-00','20040161.JPG','A','A','1','1','20040161'),(946,1,1,1,1,1013,1,'Jorge Enrique','SALAS  CERVANTES','C','1717597445','0000-00-00','SAN ANTONIO DE PICHINCHA','aaa@csgabriel.edu.ec','2394842',1,'P','0000-00-00','','0000-00-00','20040162.JPG','A','A','1','1','20040162'),(947,1,1,1,1,1013,1,'Santiago Andrés','SALINAS  DELGADO','C','1721534061','0000-00-00','DIEGO MÉNDEZ 310 Y AV.AMÉRICA','aaa@csgabriel.edu.ec','2506077',1,'P','0000-00-00','','0000-00-00','20040163.JPG','A','A','1','1','20040163'),(948,1,1,1,1,1013,1,'Roberto Andrés','SAMANIEGO  SANCHO','C','1716161551','0000-00-00','MANUELA SÁENZ N35-140 Y HERNÁNDEZ GIRÓN','aaa@csgabriel.edu.ec','2443180',1,'P','0000-00-00','','0000-00-00','20040164.JPG','A','A','1','1','20040164'),(949,1,1,1,1,1013,1,'Juan Francisco','SÁNCHEZ  IZURIETA','C','1718163437','0000-00-00','HERNÁN CORTEZ N57-181 Y VICENTE ANDA','aaa@csgabriel.edu.ec','3401316',1,'P','0000-00-00','','0000-00-00','20040165.JPG','A','A','1','1','20040165'),(950,1,1,1,1,1013,1,'Leonardo Xavier','SANDOVAL  ALMEIDA','C','1719364695','0000-00-00','MARIANO HURTADO N50-154 Y VICENTE HEREDIA','aaa@csgabriel.edu.ec','2922546',1,'P','0000-00-00','','0000-00-00','20040167.JPG','A','A','1','1','20040167'),(951,1,1,1,1,1013,1,'Esteban Eduardo','SANDOVAL  MOSCOSO','C','1721483608','0000-00-00','AV.OCCIDENTAL Y PAS.GUERRERO OE6-323','aaa@csgabriel.edu.ec','2493700',1,'P','0000-00-00','','0000-00-00','20040168.JPG','A','A','1','1','20040168'),(952,1,1,1,1,1013,1,'Max Andrés','SILVA  CUESTA','C','1717723660','0000-00-00','HERNANDO DE LA CRUZ 650 Y ULLOA','aaa@csgabriel.edu.ec','2250208',1,'P','0000-00-00','','0000-00-00','20040172.JPG','A','A','1','1','20040172'),(953,1,1,1,1,1013,1,'Alexander David','SILVA  GUACHAMÍN','C','1721532370','0000-00-00','AV.PEDRO V.MALDONADO 3895','aaa@csgabriel.edu.ec','2974255',1,'P','0000-00-00','','0000-00-00','20040173.JPG','A','A','1','1','20040173'),(954,1,1,1,1,1013,1,'Adrián Santiago','SILVA  GUERRERO','C','1718160151','0000-00-00','PEDRO FREILE N58-138 Y VACA DE CASTRO','aaa@csgabriel.edu.ec','2592798',1,'P','0000-00-00','','0000-00-00','20040174.JPG','A','A','1','1','20040174'),(955,1,1,1,1,1013,1,'Ángel Daniel','SUÁREZ  ALTAMIRANO','C','1721532628','0000-00-00','TEGUCIGALPA Y RIQUELME OE9-59','aaa@csgabriel.edu.ec','2237851',1,'P','0000-00-00','','0000-00-00','20040176.JPG','A','A','1','1','20040176'),(956,1,1,1,1,1013,1,'Luis Bolívar','TAMAYO  NIETO','C','1718160334','0000-00-00','MANUELA SÁENZ 198 Y RUMIPAMBA','aaa@csgabriel.edu.ec','2249759',1,'P','0000-00-00','','0000-00-00','20040178.JPG','A','A','1','1','20040178'),(957,1,1,1,1,1013,1,'Iván Marcelo','TAPIA  ALBÁN','C','1721437307','0000-00-00','CALLE F 140 Y LAS LAJAS CDLA.UNIÓN POPULAR','aaa@csgabriel.edu.ec','2678866',1,'P','0000-00-00','','0000-00-00','20040179.JPG','A','A','1','1','20040179'),(958,1,1,1,1,1013,1,'Cristian Pablo','TAPIA  CABEZAS','C','1721407821','0000-00-00','ARRIOLA 334 Y NARVÁEZ','aaa@csgabriel.edu.ec','2505855',1,'P','0000-00-00','','0000-00-00','20040180.JPG','A','A','1','1','20040180'),(959,1,1,1,1,1013,1,'Juan Carlos','TORRES  PILCO','C','1721253985','0000-00-00','AMÉRICA 987 Y BOLIVIA','aaa@csgabriel.edu.ec','3216627',1,'P','0000-00-00','','0000-00-00','20040182.JPG','A','A','1','1','20040182'),(960,1,1,1,1,1013,1,'Paúl Anthony','TORRES  TORRES','C','1718160276','2034-00-08','MULT.LULUNCOTO BL-ILINIZA C D-202','aaa@csgabriel.edu.ec','2604682',1,'P','0000-00-00','','0000-00-00','20040183.JPG','A','A','1','1','20040183'),(961,1,1,1,1,1013,1,'Andrés Alejandro','VACA  GRANJA','C','1718160193','0000-00-00','ROCAFUERTE E3-119','aaa@csgabriel.edu.ec','2287424',1,'P','0000-00-00','','0000-00-00','20040184.JPG','A','A','1','1','20040184'),(962,1,1,1,1,1013,1,'Santiago Gabriel','VÁSCONEZ  YEROVI','C','1720704863','0000-00-00','LOS GERANIOS 28 Y CARLOS M. ORTEGA','aaa@csgabriel.edu.ec','2823910',1,'P','0000-00-00','','0000-00-00','20040187.JPG','A','A','1','1','20040187'),(963,1,1,1,1,1013,1,'Francisco Xavier','VÁSQUEZ  CERVANTES','C','1713587432','0000-00-00','PABLO CASALS 111','aaa@csgabriel.edu.ec','2414102',1,'P','0000-00-00','','0000-00-00','20040188.JPG','A','A','1','1','20040188'),(964,1,1,1,1,1013,1,'William Andrés','VÁSQUEZ  ESPINOSA','C','1719087759','2034-04-07','CARAPUNGO. EL VERGEL CONJ.SAN MARTÍN 2','aaa@csgabriel.edu.ec','2422269',1,'P','0000-00-00','','0000-00-00','20040189.JPG','A','A','1','1','20040189'),(965,1,1,1,1,1013,1,'Santiago Alejandro','VILLACÍS  FLORES','C','1719708826','0000-00-00','GUALBERTO ARCOS 452 Y LAS CASAS','aaa@csgabriel.edu.ec','2556814',1,'P','0000-00-00','','0000-00-00','20040193.JPG','A','A','1','1','20040193'),(966,1,1,1,1,1013,1,'Marco Andrés','VILLACRÉS  PINZA','C','1720500022','2034-09-06','SANTA PRISCA OE3-27','aaa@csgabriel.edu.ec','2950390',1,'P','0000-00-00','','0000-00-00','20040194.JPG','A','A','1','1','20040194'),(967,1,1,1,1,1013,1,'Ricardo Sebastián','VILLOTA  VILLAFUERTE','C','1717260374','0000-00-00','URB.ARMENIA II. CALLE 8.2-A L-333 C-7','aaa@csgabriel.edu.ec','2342594',1,'P','0000-00-00','','0000-00-00','20040195.JPG','A','A','1','1','20040195'),(968,1,1,1,1,1013,1,'Roberto Alexander','YAJAMÍN  VILLAMARÍN','C','1720359536','0000-00-00','SANTA TERESA N65-110 Y LIBERTADOR','aaa@csgabriel.edu.ec','2592040',1,'P','0000-00-00','','0000-00-00','20040196.JPG','A','A','1','1','20040196'),(969,1,1,1,1,1013,1,'Juan Fernando','YÁNEZ  CACUANGO','C','1721535480','0000-00-00','CUMBAYÁ. VÍA A SAN PATRICIO','aaa@csgabriel.edu.ec','2894748',1,'P','0000-00-00','','0000-00-00','20040197.JPG','A','A','1','1','20040197'),(970,1,1,1,1,1013,1,'Wilson Jonathan','YÁNEZ  PARREÑO','C','1721334959','0000-00-00','RIO PRIETO S21-110 PICOAZA','aaa@csgabriel.edu.ec','2681420',1,'P','0000-00-00','','0000-00-00','20040198.JPG','A','A','1','1','20040198'),(971,1,1,1,1,1013,1,'Carlos Eduardo','YÁNEZ  TERÁN','C','1720409158','0000-00-00','COND.LUIS A.VALENCIA SECTOR 3 D-22. SOLANDA','aaa@csgabriel.edu.ec','2682809',1,'P','0000-00-00','','0000-00-00','20040199.JPG','A','A','1','1','20040199'),(972,1,1,1,1,1013,1,'Iván Alejandro','YÉPEZ  NARVÁEZ','C','1721546545','0000-00-00','CALLE F 49-110 Y CÉSAR FRANK. DAMMER II.','aaa@csgabriel.edu.ec','2416983',1,'P','0000-00-00','','0000-00-00','20040200.JPG','A','A','1','1','20040200'),(973,1,1,1,1,1013,1,'Nicolás Sebastián','ZAMBRANO  GUTIÉRREZ','C','1721513669','0000-00-00','BENALCÁZAR N3-67','aaa@csgabriel.edu.ec','2289848',1,'P','0000-00-00','','0000-00-00','20040202.JPG','A','A','1','1','20040202'),(974,1,1,1,1,1013,1,'Carlos Esteban','CASTILLO  CALVOPIÑA','C','1715610182','2034-02-07','PAS.TRIVIÑO 166 Y AV.12 DE OCTUBRE','aaa@csgabriel.edu.ec','2563450',1,'P','0000-00-00','','0000-00-00','20040257.JPG','A','A','1','1','20040257'),(975,1,1,1,1,1013,1,'Juan Alfredo','CHIRIBOGA  SÁNCHEZ','C','1721230900','0000-00-00','CONDADO OE4-403 Y SAGALITA','aaa@csgabriel.edu.ec','2490961',1,'P','0000-00-00','','0000-00-00','20040258.JPG','A','A','1','1','20040258'),(976,1,1,1,1,1013,1,'Félix Ronny','DURÁN  VERA','C','1720994985','0000-00-00','IGNACIO JARRÍN L-3 S/N. PIFO','aaa@csgabriel.edu.ec','2380127',1,'P','0000-00-00','','0000-00-00','20040259.JPG','A','A','1','1','20040259'),(977,1,1,1,1,1013,1,'Vicente Javier','GONZÁLEZ  POMA','C','1721547667','0000-00-00','MANUEL CORNEJO OE5-50 Y PREDRO FREYLE','aaa@csgabriel.edu.ec','2598352',1,'P','0000-00-00','','0000-00-00','20040260.JPG','A','A','1','1','20040260'),(978,1,1,1,1,1013,1,'Bryan Alexis','MEJÍA  JIJÓN','C','1721618625','0000-00-00','CALLE DE LOS ENCUENTROS 710 Y JAPERABI','aaa@csgabriel.edu.ec','2847606',1,'P','0000-00-00','','0000-00-00','20040262.JPG','A','A','1','1','20040262'),(979,1,1,1,1,1013,1,'Paúl','MORALES  ARCINIEGA','C','1721617387','0000-00-00','COND.JARDINES DE CARCELÉN','aaa@csgabriel.edu.ec','2428476',1,'P','0000-00-00','','0000-00-00','20040263.JPG','A','A','1','1','20040263'),(980,1,1,1,1,1013,1,'Gustavo Andrés','MOSQUERA  ESTRELLA','C','1721114138','0000-00-00','TOLOSA 115 Y BARCELONA','aaa@csgabriel.edu.ec','2503155',1,'P','0000-00-00','','0000-00-00','20040264.JPG','A','A','1','1','20040264'),(981,1,1,1,1,1013,1,'Gustavo Francisco','MOYA  QUITTO','C','1717702342','0000-00-00','ASUNCIÓN OE4-62 Y VENEZUELA','aaa@csgabriel.edu.ec','2225211',1,'P','0000-00-00','','0000-00-00','20040265.JPG','A','A','1','1','20040265'),(982,1,1,1,1,1013,1,'Juan Carlos','NÚÑEZ  GÁLVEZ','C','1720459310','0000-00-00','COND. HERNANDO PARRA BL-2 D-21','aaa@csgabriel.edu.ec','2429211',1,'P','0000-00-00','','0000-00-00','20040266.JPG','A','A','1','1','20040266'),(983,1,1,1,1,1013,1,'William Esteban','PUPIALES  VALDIVIESO','C','1719872572','0000-00-00','PEDRO DE ALVARADO N61-73 Y FLAVIO ALFARO','aaa@csgabriel.edu.ec','2299558',1,'P','0000-00-00','','0000-00-00','20040267.JPG','A','A','1','1','20040267'),(984,1,1,1,1,1013,1,'Leonardo David','PLASENCIA  MÉNDEZ','C','1721480653','0000-00-00','HIGUERAS N65-51 Y ELOY ALFARO','aaa@csgabriel.edu.ec','2807839',1,'P','0000-00-00','','0000-00-00','20040268.JPG','A','A','1','1','20040268'),(985,1,1,1,1,1013,1,'Diego Fernando','SAMANIEGO  BALSECA','C','1720736519','0000-00-00','MALTI 134 Y BOBONAZA','aaa@csgabriel.edu.ec','2648746',1,'P','0000-00-00','','0000-00-00','20040269.JPG','A','A','1','1','20040269'),(986,1,1,1,1,1013,1,'David Alexander','FLORES  TUFIÑO','C','1721546776','0000-00-00','CALDERÓN. B. LANDÁZURI. CALLE LANDÁZURI 924 Y AUQU','aaa@csgabriel.edu.ec','2821386',1,'P','0000-00-00','','0000-00-00','20040270.JPG','A','A','1','1','20040270'),(987,1,1,1,1,1013,1,'Darío Ernesto','TAPIA  GUIJARRO','C','1719142117','0000-00-00','JARDINES DE LA PAMPA 40','aaa@csgabriel.edu.ec','2352316',1,'P','0000-00-00','','0000-00-00','20040271.JPG','A','A','1','1','20040271'),(988,1,1,1,1,1013,1,'Juan Fernando','TERÁN  ABAD','C','1721443008','0000-00-00','CALLE LA PRIMAVERA OE211','aaa@csgabriel.edu.ec','2232872',1,'P','0000-00-00','','0000-00-00','20040272.JPG','A','A','1','1','20040272'),(989,1,1,1,1,1013,1,'Fernando Javier','VALENZUELA  LEÓN','C','1715811558','0000-00-00','AV.OCCIDENTAL N71-06 Y CARRIÓN','aaa@csgabriel.edu.ec','2492888',1,'P','0000-00-00','','0000-00-00','20040273.JPG','A','A','1','1','20040273'),(990,1,1,1,1,1013,1,'Mauricio Israel','ORTEGA  ROCA','C','201622818','0000-00-00','BARTOLOMÉ RUIZ OE6-11 Y MACHALA','aaa@csgabriel.edu.ec','2534430',1,'P','0000-00-00','','0000-00-00','20040274.JPG','A','A','1','1','20040274'),(991,1,1,1,1,1013,1,'José Gabriel','LÓPEZ  LARA','C','1720944840','0000-00-00','DIEGO MÉNDEZ 256 Y AMÉRICA','aaa@csgabriel.edu.ec','2542441',1,'P','0000-00-00','','0000-00-00','20040276.JPG','A','A','1','1','20040276'),(992,1,1,1,1,1013,1,'Enrique Josue','RAMÓN  VARGAS','C','1721405171','0000-00-00','DANIEL COMBONI 110-1 Y STA.LUCÍA','aaa@csgabriel.edu.ec','2805375',1,'P','0000-00-00','','0000-00-00','20040290.JPG','A','A','1','1','20040290'),(993,1,1,1,1,1013,1,'Fernando Xavier','ALMEIDA  MOLINA','C','1721531562','0000-00-00','RIO CURARAY Y LOS CANARIOS. CONJ.JARD.S.RAFAEL C-5','aaa@csgabriel.edu.ec','2861328',1,'P','0000-00-00','','0000-00-00','20040291.JPG','A','A','1','1','20040291'),(994,1,1,1,1,1013,1,'Pierre Alexander','MIRANDA  HERRERA','C','1716626146','0000-00-00','DE LAS ROCAS Y LOS MANANTIALES M-12 C-3. CUMBAYÁ','aaa@csgabriel.edu.ec','2893486',1,'P','0000-00-00','','0000-00-00','20040292.JPG','A','A','1','1','20040292'),(995,1,1,1,1,1013,1,'Edwin Gareth','ESPINOZA  PACHECO','C','1719981233','0000-00-00','LIBERTAD 172 Y PRIMERA TRANSVERSAL','aaa@csgabriel.edu.ec','3171404',1,'P','0000-00-00','','0000-00-00','20040297.JPG','A','A','1','1','20040297'),(996,1,1,1,1,1013,1,'Hernán Gustavo','BOLAÑOS  ZAMBRANO','C','1309939492','0000-00-00','BRASILIA II. PAS.E D.C-1','aaa@csgabriel.edu.ec','2463700',1,'P','0000-00-00','','0000-00-00','20040299.JPG','A','A','1','1','20040299'),(997,1,1,1,1,1013,1,'Francisco Fernando','MIRANDA  PROAÑO','C','1716072101','0000-00-00','PAMPA 2. CALLE J #141 Y CALLE C','aaa@csgabriel.edu.ec','2354490',1,'P','0000-00-00','','0000-00-00','20040312.JPG','A','A','1','1','20040312'),(998,1,1,1,1,1013,1,'Cristhian Daniel','MAYORGA  CARRASCO','C','1721444691','0000-00-00','RUIZ DE CASTILLA N2-880','aaa@csgabriel.edu.ec','2237979',1,'P','0000-00-00','','0000-00-00','20040314.JPG','A','A','1','1','20040314'),(999,1,1,1,1,1013,1,'Jean Pierre','NARVÁEZ  LARA','C','1715076210','0000-00-00','GARCÍA MORENO 1478 Y GENERAL ENRÍQUEZ. SANGOLQUÍ','aaa@csgabriel.edu.ec','2338113',1,'P','0000-00-00','','0000-00-00','20040316.JPG','A','A','1','1','20040316'),(1000,1,1,1,1,1013,1,'Patricio Fernando','ALBÁN  ARAUJO','C','1718165655','0000-00-00','INCA 2887','aaa@csgabriel.edu.ec','2444936',1,'P','0000-00-00','','0000-00-00','20050212.JPG','A','A','1','1','20050212'),(1001,1,1,1,1,1013,1,'Renato Alejandro','ENRÍQUEZ  MÁRMOL','C','1718305418','0000-00-00','PUETO RICO 141 Y SELVA ALEGRE','aaa@csgabriel.edu.ec','2500954',1,'P','0000-00-00','','0000-00-00','20050214.JPG','A','A','1','1','20050214'),(1002,1,1,1,1,1013,1,'Andrés Fernando','ITURRALDE  ITURRALDE','C','1718163155','0000-00-00','EUSTAQUIO BLANCO OE5-90 Y MACHALA','aaa@csgabriel.edu.ec','2434145',1,'P','0000-00-00','','0000-00-00','20050215.JPG','A','A','1','1','20050215'),(1003,1,1,1,1,1013,1,'Luis Marcelo','MORÁN  SILVA','C','1718164203','0000-00-00','LA ISLA N30-50','aaa@csgabriel.edu.ec','2522477',1,'P','0000-00-00','','0000-00-00','20050216.JPG','A','A','1','1','20050216'),(1004,1,1,1,1,1013,1,'Christian Nicolás','MIRANDA  JIMÉNEZ','C','1718171851','0000-00-00','CONJ.FONTANA DEL SOL C-16. BALCON DEL N.PONCIANO A','aaa@csgabriel.edu.ec','2473754',1,'P','0000-00-00','','0000-00-00','20050217.JPG','A','A','1','1','20050217'),(1005,1,1,1,1,1013,1,'Fernando Enrique','NARANJO  RIVERA','C','1718160128','0000-00-00','GARCÍA MORENO 1354 Y MANABÍ','aaa@csgabriel.edu.ec','2284766',1,'P','0000-00-00','','0000-00-00','20050218.JPG','A','A','1','1','20050218'),(1006,1,1,1,1,1013,1,'Gabriel Alejandro','URRESTA  JÁTIVA','C','1716601313','0000-00-00','LLANGARIMA 666 Y LUIS TUFIÑO N59-71','aaa@csgabriel.edu.ec','2482613',1,'P','0000-00-00','','0000-00-00','20050219.JPG','A','A','1','1','20050219'),(1007,1,1,1,1,1013,1,'Gabriel Esteban','LÓPEZ  CÓRDOVA','C','1716347990','0000-00-00','AV.AMAZONAS N49-177 Y HOLGUÍN','aaa@csgabriel.edu.ec','2452265',1,'P','0000-00-00','','0000-00-00','20050231.JPG','A','A','1','1','20050231'),(1008,1,1,1,1,1013,1,'Joshua Sebastián','PAZOS  BARAHONA','C','1718019860','0000-00-00','LUGO 611 Y VALLADOLIT. LA FLORESTA','aaa@csgabriel.edu.ec','2225194',1,'P','0000-00-00','','0000-00-00','20050236.JPG','A','A','1','1','20050236'),(1009,1,1,1,1,1013,1,'Galo David','ALMEIDA  VILLALBA','C','1719684290','2034-00-02','PASEO DEL SOL 245. PUSUQUÍ','aaa@csgabriel.edu.ec','2354896',1,'P','0000-00-00','','0000-00-00','20060194.JPG','A','A','1','1','20060194'),(1010,1,1,1,1,1013,1,'Gustavo Alejandro','CAMACHO  GUERRERO','C','201978293','0000-00-00','AZUAY 816 Y ANTIGUA COLOMBIA','aaa@csgabriel.edu.ec','2296540',1,'P','0000-00-00','','0000-00-00','20060195.JPG','A','A','1','1','20060195'),(1011,1,1,1,1,1013,1,'Sergio Francisco','CARRANZA  GAONA','C','1718130550','0000-00-00','AGUIRRE 421 Y VERSALLES','aaa@csgabriel.edu.ec','2900327',1,'P','0000-00-00','','0000-00-00','20060196.JPG','A','A','1','1','20060196'),(1012,1,1,1,1,1013,1,'Omar Paúl','PÁEZ  ALMEIDA','C','1723475537','0000-00-00','DOMINGO SEGURA 6526 Y BELLAVISTA','aaa@csgabriel.edu.ec','2535482',1,'P','0000-00-00','','0000-00-00','20060197.JPG','A','A','1','1','20060197'),(1013,1,1,1,1,1013,1,'José André','PÉREZ  ORELLANA','C','105272124','0000-00-00','SAN IGNACIO 11-52','aaa@csgabriel.edu.ec','2229718',1,'P','0000-00-00','','0000-00-00','20060198.JPG','A','A','1','1','20060198'),(1014,1,1,1,1,1013,1,'Germán Andrés','CARTAGENA  VARAS','C','1205698051','0000-00-00','MILLER OE6-280 Y OLEARY','aaa@csgabriel.edu.ec','3170698',1,'P','0000-00-00','','0000-00-00','20060247.JPG','A','A','1','1','20060247'),(1015,1,1,1,1,1013,1,'Carlos Alberto','LARREATEGUI  LARREATEGUI','C','','0000-00-00','HOMERO SALAS OE4-57','aaa@csgabriel.edu.ec','2244635',1,'P','0000-00-00','','0000-00-00','20070238.JPG','A','A','1','1','20070238'),(1016,1,1,1,1,1013,1,'Jaime Santiago','CONCHA  ESTRADA','C','1717938136','0000-00-00','URB. JARDÍN DEL VALLE 2 L-545','aaa@csgabriel.edu.ec','2600036',1,'P','0000-00-00','','0000-00-00','20070239.JPG','A','A','1','1','20070239'),(1017,1,1,1,1,1013,1,'Andrés Steven','CHÁVEZ  ARMIJOS','C','1715829246','0000-00-00','SAN GABRIEL OE 1-10','aaa@csgabriel.edu.ec','2542897',1,'P','0000-00-00','','0000-00-00','20070240.JPG','A','A','1','1','20070240'),(1018,1,1,1,1,1013,1,'Alan Mauricio','MEDINA  CARPIO','C','1718028648','0000-00-00','ANDA RUMICHACA S28-152','aaa@csgabriel.edu.ec','2629527',1,'P','0000-00-00','','0000-00-00','20070241.JPG','A','A','1','1','20070241'),(1019,1,1,1,1,1013,1,'Byron Alexander','MIÑO  VACA','C','1719504423','0000-00-00','MENA DEL HIERRO Y MACHALA OE 865','aaa@csgabriel.edu.ec','2494873',1,'P','0000-00-00','','0000-00-00','20070242.JPG','A','A','1','1','20070242'),(1020,1,1,1,1,1013,1,'Daniel Ignacio','ORTUÑO  CEVALLOS','C','1716912538','0000-00-00','MANUEL VALDIVIESO 359 Y BRASIL','aaa@csgabriel.edu.ec','2249348',1,'P','0000-00-00','','0000-00-00','20070243.JPG','A','A','1','1','20070243'),(1021,1,1,1,1,1013,1,'Esteban Alejandro','SOLIS  FRÍAS','C','1723646541','0000-00-00','CALLE SERAPIO JAPERAVI 807','aaa@csgabriel.edu.ec','2626544',1,'P','0000-00-00','','0000-00-00','20070244.JPG','A','A','1','1','20070244'),(1022,1,1,1,1,1013,1,'Juan Carlos','ZURITA  GRANJA','C','1718028523','0000-00-00','CONJ. CAROLINA II CASA 52','aaa@csgabriel.edu.ec','2320676',1,'P','0000-00-00','','0000-00-00','20070245.JPG','A','A','1','1','20070245'),(1023,1,1,1,1,1013,1,'José David','PAREDES  ORTIZ','C','604580431','0000-00-00','PAS. A C-17 Y ABASCAL. BATÁN','aaa@csgabriel.edu.ec','2459033',1,'P','0000-00-00','','0000-00-00','20070255.JPG','A','A','1','1','20070255'),(1024,1,1,1,1,1013,1,'Bryan Paúl','PANTOJA  ABARCA','C','1719926659','0000-00-00','AV DE LA PRENSA N71-98 Y PABLO PICASSO','aaa@csgabriel.edu.ec','2494870',1,'P','0000-00-00','','0000-00-00','20070257.JPG','A','A','1','1','20070257'),(1025,1,1,1,1,1013,1,'Jonathan Patricio','ACOSTA  GRANJA','C','1719651075','2033-07-06','EUSTAQUIO BLANCO 153 Y M.SERRANO.LA FLORIDA','aaa@csgabriel.edu.ec','3303803',1,'P','0000-00-00','','0000-00-00','20032102.JPG','A','A','1','1','20032102'),(1026,1,1,1,1,1013,1,'Germán Andrés','ALMEIDA  MOLINA','C','1719896324','0000-00-00','LOS CANARIOS 5','aaa@csgabriel.edu.ec','2861328',1,'P','0000-00-00','','0000-00-00','20032108.JPG','A','A','1','1','20032108'),(1027,1,1,1,1,1013,1,'Mario Augusto','ABRIL  GONZÁLEZ','C','1720941507','0000-00-00','YUGOSLAVIA N33-61 Y RUMIPAMBA','aaa@csgabriel.edu.ec','2264340',1,'P','0000-00-00','','0000-00-00','20032302.JPG','A','A','1','1','20032302'),(1028,1,1,1,1,1013,1,'Cristian Antonio','AGUIRRE  GUERRERO','C','1717661647','0000-00-00','LAS BREVAS E10-167 Y EL INCA.','aaa@csgabriel.edu.ec','2461776',1,'P','0000-00-00','','0000-00-00','20032303.JPG','A','A','1','1','20032303'),(1029,1,1,1,1,1013,1,'Michael Alexander','ALBORNOZ  CHICANGO','C','401436662','0000-00-00','MIGUEL GAVIRIA E8-51 Y 6 DE DICIEMBRE','aaa@csgabriel.edu.ec','2248613',1,'P','0000-00-00','','0000-00-00','20032304.JPG','A','A','1','1','20032304'),(1030,1,1,1,1,1013,1,'Miguel Andrés','ALBUJA  MESA','C','1722454947','0000-00-00','AV.EL INCA 1820 E ISLA SEYMUR CASA 14','aaa@csgabriel.edu.ec','2405744',1,'P','0000-00-00','','0000-00-00','20032305.JPG','A','A','1','1','20032305'),(1031,1,1,1,1,1013,1,'Mario Gabriel','ALEMÁN  PULLAS','C','1720934288','0000-00-00','PANAMERICANA NORTE KM 9 1/2 PASAJE 6-B CASA 7','aaa@csgabriel.edu.ec','2420677',1,'P','0000-00-00','','0000-00-00','20032307.JPG','A','A','1','1','20032307'),(1032,1,1,1,1,1013,1,'Felipe Antonio','ANDINO  MANZANO','C','1716968415','0000-00-00','CALLE QUINTA 41-A. SAN JOSÉ DE MORÁN','aaa@csgabriel.edu.ec','2823015',1,'P','0000-00-00','','0000-00-00','20032308.JPG','A','A','1','1','20032308'),(1033,1,1,1,1,1013,1,'Edwin Rubén','ANDRADE  FERNÁNDEZ','C','1716215890','0000-00-00','URB.EL PINAR CASA 66. CARAPUNGO','aaa@csgabriel.edu.ec','2423340',1,'P','0000-00-00','','0000-00-00','20032309.JPG','A','A','1','1','20032309'),(1034,1,1,1,1,1013,1,'Danny Javier','ANGUETA  VEINTIMILLA','C','1719851493','0000-00-00','MANUEL CORONADO 262 Y CARLOS FREILE','aaa@csgabriel.edu.ec','2620342',1,'P','0000-00-00','','0000-00-00','20032311.JPG','A','A','1','1','20032311'),(1035,1,1,1,1,1013,1,'Gerardo Sebastián','ANGOS  MEDIAVILLA','C','1720963808','0000-00-00','HUAYNALCÓN OE7-06 Y GENERAL PINTAG','aaa@csgabriel.edu.ec','2651821',1,'P','0000-00-00','','0000-00-00','20032312.JPG','A','A','1','1','20032312'),(1036,1,1,1,1,1013,1,'Andrés Sebastián','APUNTE  ROMERO','C','1720944659','0000-00-00','CARAPUNGO ETAPA E.  MZ-5 C-18','aaa@csgabriel.edu.ec','2427171',1,'P','0000-00-00','','0000-00-00','20032313.JPG','A','A','1','1','20032313'),(1037,1,1,1,1,1013,1,'Santiago Andrés','ARIAS  ARELLANO','C','1720942109','0000-00-00','MANUEL CASARES OE6-10 Y MARTÍN DE UTRERAS','aaa@csgabriel.edu.ec','3200229',1,'P','0000-00-00','','0000-00-00','20032314.JPG','A','A','1','1','20032314'),(1038,1,1,1,1,1013,1,'Leonardo Xavier','ARMAS  CARRERA','C','1719810184','0000-00-00','MIGUEL DE ANAGAES E15-120. EL EDÉN','aaa@csgabriel.edu.ec','3261313',1,'P','0000-00-00','','0000-00-00','20032316.JPG','A','A','1','1','20032316'),(1039,1,1,1,1,1013,1,'David Alejandro','ARMAS  RUIZ','C','1720927183','0000-00-00','CONJ.AMARANTA D-105.D. V.DE LOS CHILLOS PUENTE 2','aaa@csgabriel.edu.ec','99708545',1,'P','0000-00-00','','0000-00-00','20032317.JPG','A','A','1','1','20032317'),(1040,1,1,1,1,1013,1,'Efrén Alberto','ASTUDILLO  PÁRRAGA','C','1717152167','0000-00-00','JOSÉ M. GUERRERO Y MANTA','aaa@csgabriel.edu.ec','2294120',1,'P','0000-00-00','','0000-00-00','20032318.JPG','A','A','1','1','20032318'),(1041,1,1,1,1,1013,1,'Ricardo Gonzalo','AVILÉS  GUZMÁN','C','1717999054','0000-00-00','ALONSO DE ANGULO OE12-26','aaa@csgabriel.edu.ec','2613017',1,'P','0000-00-00','','0000-00-00','20032319.JPG','A','A','1','1','20032319'),(1042,1,1,1,1,1013,1,'Jonathan Rodrigo','BALLAGÁN  ROMERO','C','1720931078','0000-00-00','COVI 520 Y BALDEÓN','aaa@csgabriel.edu.ec','3195285',1,'P','0000-00-00','','0000-00-00','20032320.JPG','A','A','1','1','20032320'),(1043,1,1,1,1,1013,1,'Christian Andrés','BARCIA  VELÁSQUEZ','C','1718247230','0000-00-00','AV.MARIANA DE JESUS 799 ACCESO 41-42','aaa@csgabriel.edu.ec','2260468',1,'P','0000-00-00','','0000-00-00','20032321.JPG','A','A','1','1','20032321'),(1044,1,1,1,1,1013,1,'Francisco Javier','BASANTES  GINES','C','1720508587','0000-00-00','LOS CEDROS 1662 Y REAL AUDIENCIA','aaa@csgabriel.edu.ec','2595427',1,'P','0000-00-00','','0000-00-00','20032323.JPG','A','A','1','1','20032323'),(1045,1,1,1,1,1013,1,'Cristian Andrés','BENALCÁZAR  ALMEIDA','C','1719538652','0000-00-00','MELCHOR LORIEGA N36-133 Y MAÑOSCA','aaa@csgabriel.edu.ec','2246398',1,'P','0000-00-00','','0000-00-00','20032324.JPG','A','A','1','1','20032324'),(1046,1,1,1,1,1013,1,'Marcelo Fernando','BRAVO  CARRANCO','C','1716531890','0000-00-00','CEDROS Y ARRAYÁN URB.VALLE 1. CUMBAYÁ','aaa@csgabriel.edu.ec','2895897',1,'P','0000-00-00','','0000-00-00','20032326.JPG','A','A','1','1','20032326'),(1047,1,1,1,1,1013,1,'José Alejandro','BRIONES  ROMERO','C','301352274','0000-00-00','PEDRO LONDOÑO E2-32','aaa@csgabriel.edu.ec','2470784',1,'P','0000-00-00','','0000-00-00','20032327.JPG','A','A','1','1','20032327'),(1048,1,1,1,1,1013,1,'Francisco José','CADENA  CADENA','C','1718165895','0000-00-00','POLIT LASSO Y GASPAR SANGURIMA','aaa@csgabriel.edu.ec','2568917',1,'P','0000-00-00','','0000-00-00','20032328.JPG','A','A','1','1','20032328'),(1049,1,1,1,1,1013,1,'Jaime Rodrigo','CALDERÓN  FIGUEROA','C','1720334919','0000-00-00','SANGOLQUÍ. PORTÓN DE MÁLAGA # 1','aaa@csgabriel.edu.ec','2336385',1,'P','0000-00-00','','0000-00-00','20032329.JPG','A','A','1','1','20032329'),(1050,1,1,1,1,1013,1,'Andrés Fernando','CARRERA  MANCHENO','C','1714954250','0000-00-00','LAS LILAS 52 Y LOS CRISANTEMOS. CUMBAYÁ.','aaa@csgabriel.edu.ec','2896249',1,'P','0000-00-00','','0000-00-00','20032331.JPG','A','A','1','1','20032331'),(1051,1,1,1,1,1013,1,'Ricardo Xavier','CARRILLO  JÁTIVA','C','1716725732','0000-00-00','CALLE JUSTO ABRIL N64-38 Y JOSÉ AMESALVA','aaa@csgabriel.edu.ec','2485699',1,'P','0000-00-00','','0000-00-00','20032332.JPG','A','A','1','1','20032332'),(1052,1,1,1,1,1013,1,'Andrés Santiago','CARRIÓN  SUZA','C','1720933439','0000-00-00','LOS PINOS 283 Y PANAMERICANA NORTE','aaa@csgabriel.edu.ec','2820098',1,'P','0000-00-00','','0000-00-00','20032333.JPG','A','A','1','1','20032333'),(1053,1,1,1,1,1013,1,'William Alexander','CARVAJAL  MORALES','C','1720305596','0000-00-00','PASAJE SAN LUIS 1285 Y ANTE','aaa@csgabriel.edu.ec','2281176',1,'P','0000-00-00','','0000-00-00','20032334.JPG','A','A','1','1','20032334'),(1054,1,1,1,1,1013,1,'Ricardo Andrés','CASTAÑEDA  TERÁN','C','1720541554','0000-00-00','CALDAS 494 Y GUAYAQUIL','aaa@csgabriel.edu.ec','2959064',1,'P','0000-00-00','','0000-00-00','20032335.JPG','A','A','1','1','20032335'),(1055,1,1,1,1,1013,1,'Carlos Marcelo','CESPEDES  RIBADENEIRA','C','1714559968','0000-00-00','PASAJE DIEGO HERRERA 2069 Y SANTA ROSA','aaa@csgabriel.edu.ec','2229623',1,'P','0000-00-00','','0000-00-00','20032336.JPG','A','A','1','1','20032336'),(1056,1,1,1,1,1013,1,'Pablo Xavier','CEVALLOS  CISNEROS','C','1714321799','0000-00-00','COCHAPATA E11-129 C-19 Y ABASCAL','aaa@csgabriel.edu.ec','2277930',1,'P','0000-00-00','','0000-00-00','20032337.JPG','A','A','1','1','20032337'),(1057,1,1,1,1,1013,1,'César Andrés','CORRALES  MOYA','C','1719985838','0000-00-00','CONJ.RES.BALCÓN DE SAN ISIDRO C-4','aaa@csgabriel.edu.ec','3262794',1,'P','0000-00-00','','0000-00-00','20032338.JPG','A','A','1','1','20032338'),(1058,1,1,1,1,1013,1,'David Alejandro','CHÁVEZ  POVEDA','C','1715412001','0000-00-00','URB. CAMINOS DEL SUR CASA 168','aaa@csgabriel.edu.ec','2960991',1,'P','0000-00-00','','0000-00-00','20032339.JPG','A','A','1','1','20032339'),(1059,1,1,1,1,1013,1,'Miguel Ángel','DAVILA  VILLEGAS','C','1717870206','0000-00-00','LOS CARDENALES 100 Y GILGUEROS. SAN ANTONIO DE PIC','aaa@csgabriel.edu.ec','2397659',1,'P','0000-00-00','','0000-00-00','20032342.JPG','A','A','1','1','20032342'),(1060,1,1,1,1,1013,1,'Jaime Mauricio','DELGADO  INSUASTI','C','1720963758','0000-00-00','RAFAEL ARTETA GARCÍA S10-27 Y CALVAS','aaa@csgabriel.edu.ec','2654902',1,'P','0000-00-00','','0000-00-00','20032343.JPG','A','A','1','1','20032343'),(1061,1,1,1,1,1013,1,'Christian Rodrigo','EGAS  CARRANZA','C','1720940210','0000-00-00','VICENTE AGUIRRE 421 Y VERSALLES','aaa@csgabriel.edu.ec','2232210',1,'P','0000-00-00','','0000-00-00','20032345.JPG','A','A','1','1','20032345'),(1062,1,1,1,1,1013,1,'Galo Alberto','EGAS  GUAYAQUIL','C','1716820228','0000-00-00','DE LOS OLIVOS E16-373. EL INCA','aaa@csgabriel.edu.ec','2402799',1,'P','0000-00-00','','0000-00-00','20032346.JPG','A','A','1','1','20032346'),(1063,1,1,1,1,1013,1,'Julio Andrés','ENRÍQUEZ  FUSTILLOS','C','1715608962','0000-00-00','SGTO. TORRES OE2-705. CDLA.ATAHUALPA','aaa@csgabriel.edu.ec','2619381',1,'P','0000-00-00','','0000-00-00','20032347.JPG','A','A','1','1','20032347'),(1064,1,1,1,1,1013,1,'Jorge Antonio','ESCALANTE  DÁVALOS','C','1718166067','0000-00-00','URB.LA JOYA 23. POMASQUI.','aaa@csgabriel.edu.ec','2354047',1,'P','0000-00-00','','0000-00-00','20032348.JPG','A','A','1','1','20032348'),(1065,1,1,1,1,1013,1,'Erick Nicolás','ESCOBAR  VÁSQUEZ','C','1717430894','0000-00-00','BABAHOYO OE9-22 E IMBABURA','aaa@csgabriel.edu.ec','2581358',1,'P','0000-00-00','','0000-00-00','20032349.JPG','A','A','1','1','20032349'),(1066,1,1,1,1,1013,1,'Juan Pablo','ESTRELLA  PASPUEL','C','1720962602','0000-00-00','10 DE AGOSTO Y AMEZABA NUEVO AMANECER D.404','aaa@csgabriel.edu.ec','2486144',1,'P','0000-00-00','','0000-00-00','20032350.JPG','A','A','1','1','20032350'),(1067,1,1,1,1,1013,1,'Juan Francisco','FAJARDO  RIOFRÍO','C','1720934338','0000-00-00','PASAJE NOVO 138 Y CACHA.','aaa@csgabriel.edu.ec','2643284',1,'P','0000-00-00','','0000-00-00','20032351.JPG','A','A','1','1','20032351'),(1068,1,1,1,1,1013,1,'Luis Felipe','FLORES  GARZÓN','C','1720939816','0000-00-00','CARLOS V Y OCCIDENTAL BL-AZUAY D-301','aaa@csgabriel.edu.ec','2531761',1,'P','0000-00-00','','0000-00-00','20032352.JPG','A','A','1','1','20032352'),(1069,1,1,1,1,1013,1,'Juan Andrés','FREIRE  CEVALLOS','C','1715928865','0000-00-00','OVIEDO E51-23 Y ARAUCANA','aaa@csgabriel.edu.ec','2570774',1,'P','0000-00-00','','0000-00-00','20032353.JPG','A','A','1','1','20032353'),(1070,1,1,1,1,1013,1,'José Luis','GALARZA  HIDALGO','C','1718163650','0000-00-00','MAÑOSCA N36-09 Y PASAJE C.','aaa@csgabriel.edu.ec','2255134',1,'P','0000-00-00','','0000-00-00','20032354.JPG','A','A','1','1','20032354'),(1071,1,1,1,1,1013,1,'Carlos Omar','GANCHALA  TERÁN','C','1720945151','0000-00-00','URB. SAN JOSÉ DE MORÁN PORTAL 1 CASA 26','aaa@csgabriel.edu.ec','2826630',1,'P','0000-00-00','','0000-00-00','20032355.JPG','A','A','1','1','20032355'),(1072,1,1,1,1,1013,1,'Ronny Paúl','GARCÍA  BURBANO','C','1720932837','0000-00-00','URUGUAY 429 Y BOGOTÁ','aaa@csgabriel.edu.ec','2553864',1,'P','0000-00-00','','0000-00-00','20032356.JPG','A','A','1','1','20032356'),(1073,1,1,1,1,1013,1,'Erick Felipe','GARCÍA  ROMÁN','C','1714405550','0000-00-00','GUALBERTO ARCOS N2828 Y SELVA ALEGRE','aaa@csgabriel.edu.ec','2523616',1,'P','0000-00-00','','0000-00-00','20032357.JPG','A','A','1','1','20032357'),(1074,1,1,1,1,1013,1,'David Francisco','GARZÓN  ROMERO','C','1718242546','0000-00-00','HERNÁNDEZ DE GIRÓN Y PEDREGAL','aaa@csgabriel.edu.ec','2451490',1,'P','0000-00-00','','0000-00-00','20032358.JPG','A','A','1','1','20032358'),(1075,1,1,1,1,1013,1,'Carlos Eduardo','GÓMEZ  MALDONADO','C','1714486428','0000-00-00','WILSON 547 Y REINA VICTORIA','aaa@csgabriel.edu.ec','2520226',1,'P','0000-00-00','','0000-00-00','20032359.JPG','A','A','1','1','20032359'),(1076,1,1,1,1,1013,1,'Sebastián Alejandro','GRANJA  BUSTOS','C','1719596825','0000-00-00','CONJ. HAB. LAS ORQUIDEAS CASA 9. MONJAS ORQUIDEAS','aaa@csgabriel.edu.ec','2605135',1,'P','0000-00-00','','0000-00-00','20032360.JPG','A','A','1','1','20032360'),(1077,1,1,1,1,1013,1,'Andrés Sebastián','GUEVARA  MALDONADO','C','1718165945','0000-00-00','LA PRIMAVERA OE11-211. LAS CASAS','aaa@csgabriel.edu.ec','2568477',1,'P','0000-00-00','','0000-00-00','20032362.JPG','A','A','1','1','20032362'),(1078,1,1,1,1,1013,1,'Christian Emilio','GUILLÉN  PAVÓN','C','1719654855','0000-00-00','IMBABURA 1958 Y CARCHI','aaa@csgabriel.edu.ec','2567136',1,'P','0000-00-00','','0000-00-00','20032363.JPG','A','A','1','1','20032363'),(1079,1,1,1,1,1013,1,'Alex Gabriel','GUZMÁN  CAIZA','C','1716065543','0000-00-00','VILLAVICENCIO Y ROBALINO. T.PARQUE INGLÉS D-271','aaa@csgabriel.edu.ec','2592544',1,'P','0000-00-00','','0000-00-00','20032364.JPG','A','A','1','1','20032364'),(1080,1,1,1,1,1013,1,'Andrés Patricio','GUZMÁN  HERRERA','C','1716603186','0000-00-00','ANTONIO SIERRA 9 Y VERDE CRUZ','aaa@csgabriel.edu.ec','3228554',1,'P','0000-00-00','','0000-00-00','20032365.JPG','A','A','1','1','20032365'),(1081,1,1,1,1,1013,1,'Gonzalo Fabricio','GUZMÁN  RODRÍGUEZ','C','1715845820','0000-00-00','LAURO GUERRERO 350 E INTI.','aaa@csgabriel.edu.ec','2660609',1,'P','0000-00-00','','0000-00-00','20032366.JPG','A','A','1','1','20032366'),(1082,1,1,1,1,1013,1,'Santiago Xavier','HERRERA  MEDRANO','C','1719992370','0000-00-00','CONJ.ESTANCIA DE LA ARMENIA C-13. LA ARMENIA','aaa@csgabriel.edu.ec','2073061',1,'P','0000-00-00','','0000-00-00','20032369.JPG','A','A','1','1','20032369'),(1083,1,1,1,1,1013,1,'David Patricio','HIDALGO  ROMERO','C','1720933702','0000-00-00','JÍBAROS N52-102 E INGAPIRCA','aaa@csgabriel.edu.ec','2464686',1,'P','0000-00-00','','0000-00-00','20032371.JPG','A','A','1','1','20032371'),(1084,1,1,1,1,1013,1,'Gonzalo Paúl','HIDALGO  VILAÑA','C','1720039583','0000-00-00','RITHER 71 Y BOLIVIA','aaa@csgabriel.edu.ec','2286943',1,'P','0000-00-00','','0000-00-00','20032372.JPG','A','A','1','1','20032372'),(1085,1,1,1,1,1013,1,'Andrés Esteban','HINOJOSA  LARA','C','1718162900','0000-00-00','RUMIPAMBA OE4-14 Y AMÉRICA','aaa@csgabriel.edu.ec','2444840',1,'P','0000-00-00','','0000-00-00','20032373.JPG','A','A','1','1','20032373'),(1086,1,1,1,1,1013,1,'Esteban Xavier','IBARRA  JIMÉNEZ','C','1720671310','0000-00-00','PASAJE B Y RÍO PASTAZA. VÍA AL TINGO','aaa@csgabriel.edu.ec','2866345',1,'P','0000-00-00','','0000-00-00','20032374.JPG','A','A','1','1','20032374'),(1087,1,1,1,1,1013,1,'Pablo Alberto','JARA  MUÑOZ','C','1720941945','0000-00-00','MARIANO EGAS N38-123','aaa@csgabriel.edu.ec','2255352',1,'P','0000-00-00','','0000-00-00','20032376.JPG','A','A','1','1','20032376'),(1088,1,1,1,1,1013,1,'Adrian Fernando','JARRÍN  PEREIRA','C','1720963212','0000-00-00','MANUEL GUIZADO OE7-151 Y DOMINGO JUAN','aaa@csgabriel.edu.ec','2296018',1,'P','0000-00-00','','0000-00-00','20032377.JPG','A','A','1','1','20032377'),(1089,1,1,1,1,1013,1,'Israel Danilo','LAIME  CAZA','C','1720979366','0000-00-00','TEODORO GÓMEZ DE LA TORRE S14-166','aaa@csgabriel.edu.ec','2676065',1,'P','0000-00-00','','0000-00-00','20032379.JPG','A','A','1','1','20032379'),(1090,1,1,1,1,1013,1,'Rubén Antonio','LARREA  JARAMILLO','C','1720943875','0000-00-00','R. NAVARRO N23-69 Y LA GASCA.','aaa@csgabriel.edu.ec','3200777',1,'P','0000-00-00','','0000-00-00','20032380.JPG','A','A','1','1','20032380'),(1091,1,1,1,1,1013,1,'Juan Carlos','LATORRE  TORRES','C','1720943149','0000-00-00','BARTOLOMÉ CARBO N78-41 Y PEDRO DE AYALA','aaa@csgabriel.edu.ec','2470460',1,'P','0000-00-00','','0000-00-00','20032382.JPG','A','A','1','1','20032382'),(1092,1,1,1,1,1013,1,'Rodney Elicio','LEDESMA  NARVÁEZ','C','1720947777','0000-00-00','MAÑOSCA 317 Y REPÚBLICA','aaa@csgabriel.edu.ec','2240334',1,'P','0000-00-00','','0000-00-00','20032383.JPG','A','A','1','1','20032383'),(1093,1,1,1,1,1013,1,'Andrés Guillermo','LÓPEZ  SOLÍS','C','1718163189','0000-00-00','LOS TULIPANES. CONJ.SAN EDUARDO #2. AGUA CLARA','aaa@csgabriel.edu.ec','2483086',1,'P','0000-00-00','','0000-00-00','20032385.JPG','A','A','1','1','20032385'),(1094,1,1,1,1,1013,1,'Miguel Andrés','MALDONADO  ANDRADE','C','1715824262','0000-00-00','PEDRO CIEZA DE LEON N61-83 Y FLAVIO ALFARO','aaa@csgabriel.edu.ec','2296667',1,'P','0000-00-00','','0000-00-00','20032387.JPG','A','A','1','1','20032387'),(1095,1,1,1,1,1013,1,'Ronie Stalin','MARTÍNEZ  GORDÓN','C','1720937323','0000-00-00','CDLA. ALEGRÍA CALLE B-10 CASA 53.','aaa@csgabriel.edu.ec','2822736',1,'P','0000-00-00','','0000-00-00','20032389.JPG','A','A','1','1','20032389'),(1096,1,1,1,1,1013,1,'Jorge Esteban','MARTÍNEZ  GUANO','C','1718901265','0000-00-00','FCO.CRUZ MIRANDA N35-294 Y MAÑOSCA','aaa@csgabriel.edu.ec','2445157',1,'P','0000-00-00','','0000-00-00','20032390.JPG','A','A','1','1','20032390'),(1097,1,1,1,1,1013,1,'Rodrigo David','MARTÍNEZ  MURILLO','C','1720943388','0000-00-00','LAS MALVAS N45-135 E HIGUERAS C-3. MONTESERRÍN','aaa@csgabriel.edu.ec','2443379',1,'P','0000-00-00','','0000-00-00','20032391.JPG','A','A','1','1','20032391'),(1098,1,1,1,1,1013,1,'Gabriel Antonio','MARTÍNEZ  ZAMBRANO','C','1716874688','0000-00-00','CARANQUI 630 Y MARISCAL SUCRE','aaa@csgabriel.edu.ec','2613314',1,'P','0000-00-00','','0000-00-00','20032392.JPG','A','A','1','1','20032392'),(1099,1,1,1,1,1013,1,'Carlos Andrés','MEDINA  TERÁN','C','1717527129','0000-00-00','CAPITÁN RAFEL RAMOS E3-31. LA LUZ','aaa@csgabriel.edu.ec','2401284',1,'P','0000-00-00','','0000-00-00','20032393.JPG','A','A','1','1','20032393'),(1100,1,1,1,1,1013,1,'Leroy Andrés','MEJÍA  GONZÁLEZ','C','1716174238','0000-00-00','AV. 31 DE MAYO # 9 Y 24 DE ENERO. SANGOLQUÍ','aaa@csgabriel.edu.ec','2332267',1,'P','0000-00-00','','0000-00-00','20032394.JPG','A','A','1','1','20032394'),(1101,1,1,1,1,1013,1,'Carlos Andrés','MOLINA  ANDRADE','C','1717740995','0000-00-00','SAN ANTONIO DE PICHINCHA. 13 DE JUNIO 1392.','aaa@csgabriel.edu.ec','2394106',1,'P','0000-00-00','','0000-00-00','20032395.JPG','A','A','1','1','20032395'),(1102,1,1,1,1,1013,1,'David Antonio','MOLINA  SUBÍA','C','1720932605','0000-00-00','ATACAMES 204 Y LA GASCA','aaa@csgabriel.edu.ec','2500577',1,'P','0000-00-00','','0000-00-00','20032396.JPG','A','A','1','1','20032396'),(1103,1,1,1,1,1013,1,'Guillermo Israel','MONTES  GUERRERO','C','1718873993','0000-00-00','SODIRO 227 Y GRAN COLOMBIA','aaa@csgabriel.edu.ec','2556978',1,'P','0000-00-00','','0000-00-00','20032399.JPG','A','A','1','1','20032399'),(1104,1,1,1,1,1013,1,'Leonardo Daniel','MONTOYA  PÉREZ','C','1714110077','0000-00-00','PUNGALÁ OE1-393 Y MANGLAR ALTO','aaa@csgabriel.edu.ec','2670944',1,'P','0000-00-00','','0000-00-00','20032400.JPG','A','A','1','1','20032400'),(1105,1,1,1,1,1013,1,'Andrés Fernando','MOREANO  HERRERA','C','1720935681','0000-00-00','CUTUCHI 508 Y PAUTE','aaa@csgabriel.edu.ec','3131774',1,'P','0000-00-00','','0000-00-00','20032402.JPG','A','A','1','1','20032402'),(1106,1,1,1,1,1013,1,'David Sebastián','MOREJÓN  MALDONADO','C','1719007666','0000-00-00','PEDRO DE ALFARO 1204 Y MARIANO','aaa@csgabriel.edu.ec','2658265',1,'P','0000-00-00','','0000-00-00','20032403.JPG','A','A','1','1','20032403'),(1107,1,1,1,1,1013,1,'Erik Jeremy','MOZO  NARVÁEZ','C','1713069696','0000-00-00','CUENCA 15-14 Y CARCHI','aaa@csgabriel.edu.ec','2289258',1,'P','0000-00-00','','0000-00-00','20032408.JPG','A','A','1','1','20032408'),(1108,1,1,1,1,1013,1,'Fernando Andrés','MUÑOZ  MIÑO','C','1715746622','0000-00-00','FRANCISCO SALGADO 192 Y CAP. RAMOS','aaa@csgabriel.edu.ec','2405294',1,'P','0000-00-00','','0000-00-00','20032409.JPG','A','A','1','1','20032409'),(1109,1,1,1,1,1013,1,'Juan Sebastián','NARANJO  PAUCAR','C','1720943891','0000-00-00','VEINTIMILLA 656 Y R. VICTORIA','aaa@csgabriel.edu.ec','2563961',1,'P','0000-00-00','','0000-00-00','20032410.JPG','A','A','1','1','20032410'),(1110,1,1,1,1,1013,1,'Francisco Alejandro','NARVÁEZ  CAJAS','C','1720759727','0000-00-00','NUEVA YORK 319 Y GALÁPAGOS','aaa@csgabriel.edu.ec','2582292',1,'P','0000-00-00','','0000-00-00','20032411.JPG','A','A','1','1','20032411'),(1111,1,1,1,1,1013,1,'Jonathan David','NARVÁEZ  COTACACHI','C','1720962990','0000-00-00','EE.UU 17-154 Y ASUNCIÓN','aaa@csgabriel.edu.ec','2546700',1,'P','0000-00-00','','0000-00-00','20032412.JPG','A','A','1','1','20032412'),(1112,1,1,1,1,1013,1,'José Iván','NAULA  GARCÍA','C','1720963337','0000-00-00','MACHACHI. AV.PABLO GUARDERAS 118','aaa@csgabriel.edu.ec','2314627',1,'P','0000-00-00','','0000-00-00','20032413.JPG','A','A','1','1','20032413'),(1113,1,1,1,1,1013,1,'Juan José','NAVARRETE  MORENO','C','1717629982','0000-00-00','JORGE PIEDRA 1500 C-42','aaa@csgabriel.edu.ec','2290117',1,'P','0000-00-00','','0000-00-00','20032414.JPG','A','A','1','1','20032414'),(1114,1,1,1,1,1013,1,'Diego Fernando','ÑAUÑAY  PUENTE','C','1719702183','0000-00-00','BUENOS AIRES OE5-157','aaa@csgabriel.edu.ec','2228505',1,'P','0000-00-00','','0000-00-00','20032415.JPG','A','A','1','1','20032415'),(1115,1,1,1,1,1013,1,'Guillermo Arturo','OCHOA  VALAREZO','C','1718897661','0000-00-00','ROMUALDO NAVARRO 188 Y LA GASCA','aaa@csgabriel.edu.ec','2526424',1,'P','0000-00-00','','0000-00-00','20032416.JPG','A','A','1','1','20032416'),(1116,1,1,1,1,1013,1,'Alejandro','OLMEDO  VELARDE','C','1720943560','0000-00-00','HOMERO SALAS 410 Y MANUEL SERRANO','aaa@csgabriel.edu.ec','2453439',1,'P','0000-00-00','','0000-00-00','20032417.JPG','A','A','1','1','20032417'),(1117,1,1,1,1,1013,1,'Héctor Francisco','ORBE  PROAÑO','C','1720894599','0000-00-00','URB.SAN JOSÉ DEL VALLE','aaa@csgabriel.edu.ec','2347960',1,'P','0000-00-00','','0000-00-00','20032418.JPG','A','A','1','1','20032418'),(1118,1,1,1,1,1013,1,'Guillermo Andrés','ORTEGA  CALDERÓN','C','1720927779','0000-00-00','QUITUS 741 Y GENERAL QUISQUÍS','aaa@csgabriel.edu.ec','2665499',1,'P','0000-00-00','','0000-00-00','20032420.JPG','A','A','1','1','20032420'),(1119,1,1,1,1,1013,1,'Freddy Ricardo','ORTIZ  CAJAS','C','1720942141','0000-00-00','HUAYNAPALCÓN 577 Y CACHA. LA MAGDALENA','aaa@csgabriel.edu.ec','2653721',1,'P','0000-00-00','','0000-00-00','20032421.JPG','A','A','1','1','20032421'),(1120,1,1,1,1,1013,1,'Hugo Marcelo','OTAÑEZ  GÓMEZ','C','1718164641','0000-00-00','ANDAGOYA OE3-323 Y RUIZ DE CASTILLA','aaa@csgabriel.edu.ec','2226177',1,'P','0000-00-00','','0000-00-00','20032423.JPG','A','A','1','1','20032423'),(1121,1,1,1,1,1013,1,'Carlos Andrés','PÁEZ  VARGAS','C','1720932779','0000-00-00','PRIMAVERA OE11-295 Y PADRE DAMIAN','aaa@csgabriel.edu.ec','2569730',1,'P','0000-00-00','','0000-00-00','20032424.JPG','A','A','1','1','20032424'),(1122,1,1,1,1,1013,1,'Christian David','PALACIOS  YÁNEZ','C','1718163320','0000-00-00','JORGE TOBAR 845-A Y TORIBIO HIDALGO','aaa@csgabriel.edu.ec','2556989',1,'P','0000-00-00','','0000-00-00','20032425.JPG','A','A','1','1','20032425'),(1123,1,1,1,1,1013,1,'Luis Efraín','PALMA  REGALADO','C','1720941424','0000-00-00','URB. URABA CALLE C #34','aaa@csgabriel.edu.ec','2480586',1,'P','0000-00-00','','0000-00-00','20032426.JPG','A','A','1','1','20032426'),(1124,1,1,1,1,1013,1,'Emanuel Fernando','PALOMEQUE  ROMERO','C','1720729795','0000-00-00','ARTETA 16-A Y LEGARDA C-2','aaa@csgabriel.edu.ec','2294447',1,'P','0000-00-00','','0000-00-00','20032427.JPG','A','A','1','1','20032427'),(1125,1,1,1,1,1013,1,'Raúl Daniel','PAREDES  BERNAL','C','1713763918','0000-00-00','MURIALDO OE2-25 Y MATHEU','aaa@csgabriel.edu.ec','2405008',1,'P','0000-00-00','','0000-00-00','20032428.JPG','A','A','1','1','20032428'),(1126,1,1,1,1,1013,1,'Carlos Julio','PAREDES  MINANGO','C','1716856016','0000-00-00','ÁNGEL LUDEÑA 417 Y GUERRERO','aaa@csgabriel.edu.ec','2292878',1,'P','0000-00-00','','0000-00-00','20032429.JPG','A','A','1','1','20032429'),(1127,1,1,1,1,1013,1,'Jair Sebastián','PÉREZ  MORA','C','1717676082','0000-00-00','URB.SAN JOSÉ CALLE 11 CASA 66-B.X','aaa@csgabriel.edu.ec','2822842',1,'P','0000-00-00','','0000-00-00','20032430.JPG','A','A','1','1','20032430'),(1128,1,1,1,1,1013,1,'David Andrés','POLO  AGUAYO','C','1720629730','0000-00-00','REAL AUDIENCIA 2966 Y NAZARETH','aaa@csgabriel.edu.ec','2801822',1,'P','0000-00-00','','0000-00-00','20032432.JPG','A','A','1','1','20032432'),(1129,1,1,1,1,1013,1,'Luis Alexander','POZO  MOLINA','C','1720943495','0000-00-00','CALLE CARAPUNGO 2960 Y CARÁN. CALDERÓN','aaa@csgabriel.edu.ec','2822508',1,'P','0000-00-00','','0000-00-00','20032433.JPG','A','A','1','1','20032433'),(1130,1,1,1,1,1013,1,'Ricardo Mauricio','PROAÑO  CÁRDENAS','C','1713462123','0000-00-00','AV.PABLO GUARDERAS Y 3ERA. TRANSVERSAL','aaa@csgabriel.edu.ec','2314893',1,'P','0000-00-00','','0000-00-00','20032435.JPG','A','A','1','1','20032435'),(1131,1,1,1,1,1013,1,'Jorge Emilio','PUERTAS  SAMANIEGO','C','1720358918','0000-00-00','VALPARAISO N12-83 Y JULIO CASTRO','aaa@csgabriel.edu.ec','2525411',1,'P','0000-00-00','','0000-00-00','20032436.JPG','A','A','1','1','20032436'),(1132,1,1,1,1,1013,1,'Daniel Alejandro','QUIROLA  GUEVARA','C','1720945334','0000-00-00','CARCELÉN. SM-D M-13 CASA 9','aaa@csgabriel.edu.ec','3441908',1,'P','0000-00-00','','0000-00-00','20032438.JPG','A','A','1','1','20032438'),(1133,1,1,1,1,1013,1,'Christian David','REYES  LARCO','C','1718320805','0000-00-00','RÍO PUCUNA 181 Y JUAN PRÓCEL','aaa@csgabriel.edu.ec','2490540',1,'P','0000-00-00','','0000-00-00','20032440.JPG','A','A','1','1','20032440'),(1134,1,1,1,1,1013,1,'Jorge Santiago','RIVADENEIRA  APUNTE','C','1720944782','0000-00-00','MIGUEL ÁLVAREZ OE260. BAKKER II.','aaa@csgabriel.edu.ec','2404249',1,'P','0000-00-00','','0000-00-00','20032441.JPG','A','A','1','1','20032441'),(1135,1,1,1,1,1013,1,'Pedro Felipe','RIVADENEIRA  ORELLANA','C','1720932654','0000-00-00','HUACHI N64-138 Y JUAN FIGUEROA','aaa@csgabriel.edu.ec','2591075',1,'P','0000-00-00','','0000-00-00','20032442.JPG','A','A','1','1','20032442'),(1136,1,1,1,1,1013,1,'Carlos Andrés','RODAS  LEÓN','C','1713062592','0000-00-00',' MANUEL GUIZADO 133 Y HUACHI. COTOCOLLAO','aaa@csgabriel.edu.ec','2595312',1,'P','0000-00-00','','0000-00-00','20032443.JPG','A','A','1','1','20032443'),(1137,1,1,1,1,1013,1,'Diego Raúl','RODRÍGUEZ  TENORIO','C','1719950956','0000-00-00','DOMINGO ESPINAR 26 Y LIZARAZU','aaa@csgabriel.edu.ec','2507006',1,'P','0000-00-00','','0000-00-00','20032444.JPG','A','A','1','1','20032444'),(1138,1,1,1,1,1013,1,'Carlos Andrés','ROMERO  SALAZAR','C','1720931854','0000-00-00','AV. GRAL. RUMIÑAHUI KM 4,7. COND.PUERTA DEL SOL','aaa@csgabriel.edu.ec','2607476',1,'P','0000-00-00','','0000-00-00','20032446.JPG','A','A','1','1','20032446'),(1139,1,1,1,1,1013,1,'Edwin Nicolás','ROSERO  FABARA','C','1713566832','0000-00-00','AV.ILALO Y CALLE K L-D. URB.BANCO DEL PICHINCHA','aaa@csgabriel.edu.ec','2348510',1,'P','0000-00-00','','0000-00-00','20032447.JPG','A','A','1','1','20032447'),(1140,1,1,1,1,1013,1,'Guillermo Daniel','RUIZ  URGILÉS','C','1720967890','0000-00-00','GONZALO ESCUDERO 1735','aaa@csgabriel.edu.ec','2600548',1,'P','0000-00-00','','0000-00-00','20032448.JPG','A','A','1','1','20032448'),(1141,1,1,1,1,1013,1,'Jorge Alejandro','RUIZ  VILLACÍS','C','1720965399','0000-00-00','ADRIAN NAVARRO E2-122','aaa@csgabriel.edu.ec','3123088',1,'P','0000-00-00','','0000-00-00','20032449.JPG','A','A','1','1','20032449'),(1142,1,1,1,1,1013,1,'Alex Gustavo','RUIZ  ZAPATA','C','1720936747','0000-00-00','PANAMERICANA NORTE KM 10 1/2','aaa@csgabriel.edu.ec','2426105',1,'P','0000-00-00','','0000-00-00','20032450.JPG','A','A','1','1','20032450'),(1143,1,1,1,1,1013,1,'Danilo Eduardo','SALAZAR  CHIRIBOGA','C','1714022918','0000-00-00','OBISPO DÍAZ DE LA MADRID 1154 Y ESPINOSA','aaa@csgabriel.edu.ec','2500302',1,'P','0000-00-00','','0000-00-00','20032452.JPG','A','A','1','1','20032452'),(1144,1,1,1,1,1013,1,'Valentín','SALGADO  FUENTES','C','1712641388','0000-00-00','COND.EINSTEIN CASA 2. CARCELÉN','aaa@csgabriel.edu.ec','2485454',1,'P','0000-00-00','','0000-00-00','20032453.JPG','A','A','1','1','20032453'),(1145,1,1,1,1,1013,1,'Renato Alejandro','SANCHO  GUERRA','C','1712902053','0000-00-00','6 DE DICIEMBRE Y LOS ÁLAMOS','aaa@csgabriel.edu.ec','2410079',1,'P','0000-00-00','','0000-00-00','20032454.JPG','A','A','1','1','20032454'),(1146,1,1,1,1,1013,1,'Marco Vinicio','SANTAMARÍA  JARRÍN','C','1720962826','0000-00-00','RICARDO DESCALZI 886 Y CALLE W','aaa@csgabriel.edu.ec','2491039',1,'P','0000-00-00','','0000-00-00','20032455.JPG','A','A','1','1','20032455'),(1147,1,1,1,1,1013,1,'Rómulo Andrés','SANTILLÁN  BRITO','C','1720942463','0000-00-00','AV.MARISCAL SUCRE N70-146 Y MACHALA','aaa@csgabriel.edu.ec','2494076',1,'P','0000-00-00','','0000-00-00','20032456.JPG','A','A','1','1','20032456'),(1148,1,1,1,1,1013,1,'Erich Günther','SEIDL  ARÉVALO','C','1720495157','0000-00-00','LOS CEDROS OE3-290 Y PEDRO BOTTO','aaa@csgabriel.edu.ec','2591110',1,'P','0000-00-00','','0000-00-00','20032457.JPG','A','A','1','1','20032457'),(1149,1,1,1,1,1013,1,'Andrés Sebastián','SEGOVIA  KAROLYS','C','502588411','0000-00-00','CRISTÓBAL SANDOVAL 445 Y ALTAR','aaa@csgabriel.edu.ec','2272763',1,'P','0000-00-00','','0000-00-00','20032458.JPG','A','A','1','1','20032458'),(1150,1,1,1,1,1013,1,'Carlos Alberto','SOSA  TAMAYO','C','1720944600','0000-00-00','CALLE B E15-45 E IBERIA','aaa@csgabriel.edu.ec','2503281',1,'P','0000-00-00','','0000-00-00','20032459.JPG','A','A','1','1','20032459'),(1151,1,1,1,1,1013,1,'Diego Andrés','SUASNAVAS  VIZUETE','C','1720968476','0000-00-00','ÁNGEL LUDEÑA 830 Y PEDRO DE MENDOZA','aaa@csgabriel.edu.ec','3063512',1,'P','0000-00-00','','0000-00-00','20032460.JPG','A','A','1','1','20032460'),(1152,1,1,1,1,1013,1,'Jaime Andrés','SUBÍA  POTOSÍ','C','1720509973','0000-00-00','URB.EL CONDADO CALLE T Y PAS.3 OE6-467','aaa@csgabriel.edu.ec','2494366',1,'P','0000-00-00','','0000-00-00','20032461.JPG','A','A','1','1','20032461'),(1153,1,1,1,1,1013,1,'John Aníbal','TAPIA  BACA','C','1720231826','0000-00-00','URB.MONSERRAT L-10. VÍA ANTIGUO CONOCOTO','aaa@csgabriel.edu.ec','2070339',1,'P','0000-00-00','','0000-00-00','20032462.JPG','A','A','1','1','20032462'),(1154,1,1,1,1,1013,1,'Esteban Alejandro','TAPIA  RODRÍGUEZ','C','1717558876','0000-00-00','URB.ACOSTA SOBERÓN CALLE A #144. CONOCOTO','aaa@csgabriel.edu.ec','2347411',1,'P','0000-00-00','','0000-00-00','20032463.JPG','A','A','1','1','20032463'),(1155,1,1,1,1,1013,1,'Daniel Francisco','TORRES  MUÑOZ','C','1713904132','0000-00-00','CONJ. LA MAESTRANZA D.73-B.','aaa@csgabriel.edu.ec','2466096',1,'P','0000-00-00','','0000-00-00','20032464.JPG','A','A','1','1','20032464'),(1156,1,1,1,1,1013,1,'Martín Nicolás','TORRES  QUEZADA','C','1718360876','0000-00-00','PANAMERICANA NORTE KM 9 1/2 . ATLÁNTICA 2 CASA 7.','aaa@csgabriel.edu.ec','2804503',1,'P','0000-00-00','','0000-00-00','20032465.JPG','A','A','1','1','20032465'),(1157,1,1,1,1,1013,1,'César David','TROYA  SHERDEK','C','1719125419','0000-00-00','CASA OE2-47 CALLE N74.B Y REAL AUDIENCIA','aaa@csgabriel.edu.ec','2479279',1,'P','0000-00-00','','0000-00-00','20032466.JPG','A','A','1','1','20032466'),(1158,1,1,1,1,1013,1,'Ricardo Andrés','VACA  MOSQUERA','C','1720944378','0000-00-00','CAMILO CASARES N33-82 Y BOSMEDIANO','aaa@csgabriel.edu.ec','2248017',1,'P','0000-00-00','','0000-00-00','20032467.JPG','A','A','1','1','20032467'),(1159,1,1,1,1,1013,1,'Alejandro Patricio','VACA  VILLAVICENCIO','C','1720942588','0000-00-00','URB.MENA DEL HIERRO. CALLE RÍO BIGAL OE8A N71-18','aaa@csgabriel.edu.ec','2490914',1,'P','0000-00-00','','0000-00-00','20032468.JPG','A','A','1','1','20032468'),(1160,1,1,1,1,1013,1,'Carlos Paúl','VALENZUELA  ASTUDILLO','C','1715360507','0000-00-00','ASUNCIÓN 130 Y 10 DE AGOSTO','aaa@csgabriel.edu.ec','2527171',1,'P','0000-00-00','','0000-00-00','20032469.JPG','A','A','1','1','20032469'),(1161,1,1,1,1,1013,1,'Carlos Andrés','VALVERDE  ARIAS','C','1720961778','0000-00-00','BALCÓN DEL NORTE. ED.ESMERALDA 4TO.PISO D-401. PON','aaa@csgabriel.edu.ec','2478053',1,'P','0000-00-00','','0000-00-00','20032470.JPG','A','A','1','1','20032470'),(1162,1,1,1,1,1013,1,'Dennys Brayan','VALLEJO  ALBÁN','C','1713677837','0000-00-00','CRISTÓBAL DE ACUÑA 642 Y AMÉRICA','aaa@csgabriel.edu.ec','2906383',1,'P','0000-00-00','','0000-00-00','20032471.JPG','A','A','1','1','20032471'),(1163,1,1,1,1,1013,1,'Erik Fernando','VALLEJO  FREIRE','C','502954993','0000-00-00','VIZCAYA 431 Y AV.CORUÑA D-3','aaa@csgabriel.edu.ec','2548004',1,'P','0000-00-00','','0000-00-00','20032472.JPG','A','A','1','1','20032472'),(1164,1,1,1,1,1013,1,'Andrés Oswaldo','VASCONEZ  GODOY','C','1716386105','0000-00-00','SIGCHOS 102 A Y PASAJE S','aaa@csgabriel.edu.ec','2643125',1,'P','0000-00-00','','0000-00-00','20032474.JPG','A','A','1','1','20032474'),(1165,1,1,1,1,1013,1,'Marco Andrés','VASQUEZ  PLAZAS','C','1720943586','0000-00-00','MACHALA 22-30 Y VACA DE CASTRO','aaa@csgabriel.edu.ec','2592794',1,'P','0000-00-00','','0000-00-00','20032475.JPG','A','A','1','1','20032475'),(1166,1,1,1,1,1013,1,'Óscar Guillermo','VENEGAS  BACA','C','1719253856','0000-00-00','CAÑARIS OE 362 Y AUTACHI DUCHICELA','aaa@csgabriel.edu.ec','2642474',1,'P','0000-00-00','','0000-00-00','20032477.JPG','A','A','1','1','20032477'),(1167,1,1,1,1,1013,1,'David Israel','VIERA  CANGUI','C','1715038327','0000-00-00','CIUDADELA LOS ARRAYANES MZ-2 CASA-16','aaa@csgabriel.edu.ec','2613172',1,'P','0000-00-00','','0000-00-00','20032478.JPG','A','A','1','1','20032478'),(1168,1,1,1,1,1013,1,'Javier Sebastián','YANCHAPAXI  JACHO','C','1720112414','0000-00-00','URUGUAY 342 Y RÍO DE JANEIRO','aaa@csgabriel.edu.ec','3214331',1,'P','0000-00-00','','0000-00-00','20032479.JPG','A','A','1','1','20032479'),(1169,1,1,1,1,1013,1,'Carlos Eduardo','YANDÚN  GARZÓN','C','1714228226','0000-00-00','EL INCA E6-25 CASA 19','aaa@csgabriel.edu.ec','2405819',1,'P','0000-00-00','','0000-00-00','20032480.JPG','A','A','1','1','20032480'),(1170,1,1,1,1,1013,1,'Hugo Marcelo','YÁNEZ  AYALA','C','1719899799','0000-00-00','CRISTÓBAL ÁLVEZ N81-62 Y PEDRO DE FRUTOS','aaa@csgabriel.edu.ec','2472118',1,'P','0000-00-00','','0000-00-00','20032481.JPG','A','A','1','1','20032481'),(1171,1,1,1,1,1013,1,'Sebastián Fernando','YÁNEZ  CASCANTE','C','1719508473','0000-00-00','JARDÍN DEL VALLE PASAJE 2-S #486','aaa@csgabriel.edu.ec','2607370',1,'P','0000-00-00','','0000-00-00','20032482.JPG','A','A','1','1','20032482'),(1172,1,1,1,1,1013,1,'David Marcelo','YÉPEZ  JARAMILLO','C','1720945466','0000-00-00','GROGORIO BOBADILLA 285 Y VILLALENGUA','aaa@csgabriel.edu.ec','2922441',1,'P','0000-00-00','','0000-00-00','20032483.JPG','A','A','1','1','20032483'),(1173,1,1,1,1,1013,1,'Sebastián Patricio','ZUMÁRRAGA  GUEVARA','C','1716723273','0000-00-00','NAZARETH 1030 Y AV. REAL AUDIENCIA','aaa@csgabriel.edu.ec','2296901',1,'P','0000-00-00','','0000-00-00','20032484.JPG','A','A','1','1','20032484'),(1174,1,1,1,1,1013,1,'Raúl Andrés','REYES  ANDRADE','C','1720599115','0000-00-00','CUERO Y CAICEDO 1180 Y LA ISLA','aaa@csgabriel.edu.ec','2236077',1,'P','0000-00-00','','0000-00-00','20032485.JPG','A','A','1','1','20032485'),(1175,1,1,1,1,1013,1,'Cristian Andrés','YÁNEZ  HERMOZA','C','1718162918','0000-00-00','ANA P. DE ALFARO S9-465 Y FRANCISCO COBO','aaa@csgabriel.edu.ec','2641617',1,'P','0000-00-00','','0000-00-00','20032505.JPG','A','A','1','1','20032505'),(1176,1,1,1,1,1013,1,'Edwin Humberto','SERRANO  CISNEROS','C','2000046025','0000-00-00','SAN CRISTÓBAL 1327 Y GUEPI. JIPIJAPA','aaa@csgabriel.edu.ec','2448906',1,'P','0000-00-00','','0000-00-00','20032506.JPG','A','A','1','1','20032506'),(1177,1,1,1,1,1013,1,'Kevin Rafael','DE  PAULA MORALES','C','1713062832','0000-00-00','CALLE DE LOS CIPRESES 1516 Y HELECHOS','aaa@csgabriel.edu.ec','2483569',1,'P','0000-00-00','','0000-00-00','20032509.JPG','A','A','1','1','20032509'),(1178,1,1,1,1,1013,1,'Pedro Rafael','LARA  RUEDA','C','1721745584','0000-00-00','SAN CAMILO. CALDERON L-47','aaa@csgabriel.edu.ec','2823363',1,'P','0000-00-00','','0000-00-00','20032515.JPG','A','A','1','1','20032515'),(1179,1,1,1,1,1013,1,'Miguel Alonso','VILLAFUERTE  BANDERAS','C','1719474171','0000-00-00','LAS TORONJAS N45-327 Y AV. EL INCA','aaa@csgabriel.edu.ec','2402460',1,'P','0000-00-00','','0000-00-00','20032516.JPG','A','A','1','1','20032516'),(1180,1,1,1,1,1013,1,'Wladimir Andrés','ORTEGA  DÁVILA','C','1722319280','0000-00-00','ISLA SAN CRISTOBAL 546 Y T. DE BERLANGA','aaa@csgabriel.edu.ec','2443047',1,'P','0000-00-00','','0000-00-00','20032521.JPG','A','A','1','1','20032521'),(1181,1,1,1,1,1013,1,'Pablo David','ARCINIEGA  ARCINIEGA','C','1719897256','0000-00-00','SAN GREGORIO OE88 Y RAMÍREZ DÁVALOS','aaa@csgabriel.edu.ec','2232562',1,'P','0000-00-00','','0000-00-00','20032525.JPG','A','A','1','1','20032525'),(1182,1,1,1,1,1013,1,'Raúl Jefferson','OSORIO  MORILLO','C','1715880504','0000-00-00','LOS EUCALIPTOS 29 Y AUTOPISTA G.RUMIÑAHUI','aaa@csgabriel.edu.ec','2322492',1,'P','0000-00-00','','0000-00-00','20040278.JPG','A','A','1','1','20040278'),(1183,1,1,1,1,1013,1,'David Alexis','SALAZAR  CÁRDENAS','C','1721835195','0000-00-00','CALLE D OE3-71 Y NASACOTA PUENTO','aaa@csgabriel.edu.ec','2291320',1,'P','0000-00-00','','0000-00-00','20040279.JPG','A','A','1','1','20040279'),(1184,1,1,1,1,1013,1,'Michael Alonso','BERMEO  RAMÓN','C','1718080474','0000-00-00','CARCELÉN BAJO MZ-J PAS.31 CASA N90-44','aaa@csgabriel.edu.ec','2802639',1,'P','0000-00-00','','0000-00-00','20040280.JPG','A','A','1','1','20040280'),(1185,1,1,1,1,1013,1,'Henry Santiago','MORILLO  ROSERO','C','1721400628','0000-00-00','PAS.LAS MARGARITAS E10-63 Y AV.EL INCA','aaa@csgabriel.edu.ec','3341536',1,'P','0000-00-00','','0000-00-00','20040281.JPG','A','A','1','1','20040281'),(1186,1,1,1,1,1013,1,'José Luis','ESCOBAR  CÁRDENAS','C','1721783213','0000-00-00','CDLA.CHIMBORAZO PUNTA ARENAS S13-89','aaa@csgabriel.edu.ec','2635498',1,'P','0000-00-00','','0000-00-00','20040282.JPG','A','A','1','1','20040282'),(1187,1,1,1,1,1013,1,'Joan Francisco','PUEBLA  TORRES','C','1721768727','0000-00-00','SANTA TERESA L-1 CALLE PARAISO DE LAS ROSAS. POMAS','aaa@csgabriel.edu.ec','2351406',1,'P','0000-00-00','','0000-00-00','20040283.JPG','A','A','1','1','20040283'),(1188,1,1,1,1,1013,1,'Roberto Xavier','VINUEZA  CENTENO','C','1718244476','0000-00-00','CALLE 21 DE MARZO 608. SAN ANTONIO DE PICHINCHA','aaa@csgabriel.edu.ec','2395310',1,'P','0000-00-00','','0000-00-00','20040285.JPG','A','A','1','1','20040285'),(1189,1,1,1,1,1013,1,'Andrés Alejandro','CRUZ  MEDINA','C','1716753858','0000-00-00','VASCO DE CONTRERAS 408 Y ABELARDO MONCAYO','aaa@csgabriel.edu.ec','2450177',1,'P','0000-00-00','','0000-00-00','20040286.JPG','A','A','1','1','20040286'),(1190,1,1,1,1,1013,1,'Luis Andrés','ROSERO  VALLADARES','C','1717558074','0000-00-00','BELLAVISTA OE2-110 Y REAL AUDIENCIA','aaa@csgabriel.edu.ec','2807759',1,'P','0000-00-00','','0000-00-00','20040288.JPG','A','A','1','1','20040288'),(1191,1,1,1,1,1013,1,'Byron Miguel','QUEZADA  CÁCERES','C','1721867404','0000-00-00','ACUÑA OE3-284 Y AMÉRICA','aaa@csgabriel.edu.ec','2527797',1,'P','0000-00-00','','0000-00-00','20040301.JPG','A','A','1','1','20040301'),(1192,1,1,1,1,1013,1,'Wladymir Hernando','CAISAPANTA  TAPIA','C','1721942306','0000-00-00','ALGARROBOS E3-139 Y DIÓGENES PAREDES','aaa@csgabriel.edu.ec','2814328',1,'P','0000-00-00','','0000-00-00','20040302.JPG','A','A','1','1','20040302'),(1193,1,1,1,1,1013,1,'José Esteban','ÁLVAREZ  ÑAUTA','C','103833935','0000-00-00','HUACHI 868 Y FLAVIO ALFARO','aaa@csgabriel.edu.ec','2290346',1,'P','0000-00-00','','0000-00-00','20040307.JPG','A','A','1','1','20040307'),(1194,1,1,1,1,1013,1,'Felipe Marcelo','FLORES  BALAREZO','C','1718587759','0000-00-00','URB.RESIDENCIALES EL VALLE. CUMBAYÁ','aaa@csgabriel.edu.ec','2040338',1,'P','0000-00-00','','0000-00-00','20050221.JPG','A','A','1','1','20050221'),(1195,1,1,1,1,1013,1,'Juan Carlos','ORBE  CARVAJAL','C','1718163684','0000-00-00','J.MARÍA GUERRERO Y MANTA. COTOCOLLAO','aaa@csgabriel.edu.ec','2954073',1,'P','0000-00-00','','0000-00-00','20050222.JPG','A','A','1','1','20050222'),(1196,1,1,1,1,1013,1,'Félix Patricio','GALLO  CRUZ','C','1720448974','0000-00-00','ÁNGELA CAAMAÑO 248 Y C.T. TOLA BAJA','aaa@csgabriel.edu.ec','2581421',1,'P','0000-00-00','','0000-00-00','20050223.JPG','A','A','1','1','20050223'),(1197,1,1,1,1,1013,1,'Julio Santiago','GUERRERO  KESSELMAN','C','401226766','0000-00-00','','aaa@csgabriel.edu.ec','',1,'P','0000-00-00','','0000-00-00','20060186.JPG','A','A','1','1','20060186'),(1198,1,1,1,1,1013,1,'Oswaldo Andrés','GAON  VELÁSQUEZ','C','1722820279','0000-00-00','O.DÍAZ DE LA MADRID 947 Y N. DE VALDERRAMA','aaa@csgabriel.edu.ec','2505042',1,'P','0000-00-00','','0000-00-00','20070246.JPG','A','A','1','1','20070246'),(1199,1,1,1,1,1013,1,'Christian Andrés','BOADA  SANDOVAL','C','1719340554','0000-00-00','CONJ.BRASILIA II C-265','aaa@csgabriel.edu.ec','2410950',1,'P','0000-00-00','','0000-00-00','20070247.JPG','A','A','1','1','20070247'),(1200,1,1,1,1,1013,1,'José Martín','LANDIVAR  PÉREZ','C','1723544712','0000-00-00','FLORIDA Y RAFAEL CUERVO 209','aaa@csgabriel.edu.ec','3303696',1,'P','0000-00-00','','0000-00-00','20070248.JPG','A','A','1','1','20070248'),(1201,1,1,1,1,1013,1,'Paúl Sebastián','DAVALOS  CISNEROS','C','1724198708','0000-00-00','SABANILLA 228 Y PEDRO MUÑOZ','aaa@csgabriel.edu.ec','2295150',1,'P','0000-00-00','','0000-00-00','20070249.JPG','A','A','1','1','20070249'),(1202,1,1,1,1,1013,1,'Pablo Andrés','LARA  MOSCOLONI','C','1713144762','0000-00-00','MAÑOSCA 794 Y AMÉRICA','aaa@csgabriel.edu.ec','93853917',1,'P','0000-00-00','','0000-00-00','20070250.JPG','A','A','1','1','20070250'),(1203,1,1,1,1,1013,1,'Rodrigo Fabián','MALDONADO  BEDÓN','C','1716467566','0000-00-00','JAIME CEVALLOS 270 Y AGUSTÍN ZAMBRANO','aaa@csgabriel.edu.ec','2435067',1,'P','0000-00-00','','0000-00-00','20070256.JPG','A','A','1','1','20070256'),(1204,1,1,1,1,1013,1,'Luis Alan','VALVERDE  ORTIZ','C','','0000-00-00','LUIS TUFIÑO 159-734 Y RÍO PUTUMAYO','aaa@csgabriel.edu.ec','2590825',1,'P','0000-00-00','','0000-00-00','20070259.JPG','A','A','1','1','20070259');
UNLOCK TABLES;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;

--
-- Table structure for table `anticipos`
--

DROP TABLE IF EXISTS `anticipos`;
CREATE TABLE `anticipos` (
  `SERIAL_ANT` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `NOMBRE_ANT` char(255) collate latin1_spanish_ci NOT NULL default '',
  `VALOR_ANT` double NOT NULL default '0',
  `FECHA_ANT` date NOT NULL default '0000-00-00',
  `ESTADO_ANT` char(20) collate latin1_spanish_ci NOT NULL default '',
  `OBSERVACION_ANT` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ANT`),
  KEY `AK_FECHA_ANT_IDX` (`FECHA_ANT`),
  KEY `FK_EMPLEADOANTICPOS` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLANTICIPOS` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADOANTICPOS` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLANTICIPOS` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `anticipos`
--


/*!40000 ALTER TABLE `anticipos` DISABLE KEYS */;
LOCK TABLES `anticipos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `anticipos` ENABLE KEYS */;

--
-- Table structure for table `aprobacion`
--

DROP TABLE IF EXISTS `aprobacion`;
CREATE TABLE `aprobacion` (
  `SERIAL_APR` int(11) NOT NULL auto_increment,
  `SERIAL_PRC` int(11) default NULL,
  `SERIAL_PFL` int(11) default NULL,
  `NOMBRE_APR` char(50) collate latin1_spanish_ci NOT NULL default '',
  `CUPO_APR` decimal(16,2) default NULL,
  `PLAZO_APR` int(11) default NULL,
  `SECUENCIA_APR` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_APR`),
  KEY `FK_PERFILAPROBACION` (`SERIAL_PFL`),
  KEY `FK_PROCESOAPROBACION` (`SERIAL_PRC`),
  CONSTRAINT `FK_PERFILAPROBACION` FOREIGN KEY (`SERIAL_PFL`) REFERENCES `perfil` (`SERIAL_PFL`),
  CONSTRAINT `FK_PROCESOAPROBACION` FOREIGN KEY (`SERIAL_PRC`) REFERENCES `procesos` (`SERIAL_PRC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `aprobacion`
--


/*!40000 ALTER TABLE `aprobacion` DISABLE KEYS */;
LOCK TABLES `aprobacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `aprobacion` ENABLE KEYS */;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `SERIAL_ARE` int(11) NOT NULL auto_increment,
  `SERIAL_DESC` int(11) default NULL,
  `CODIGO_ARE` char(10) collate latin1_spanish_ci default NULL,
  `NOMBRE_ARE` char(45) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ARE`),
  KEY `FK_SUCURSALDEPARTAMENTOSAREA` (`SERIAL_DESC`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOSAREA` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `area`
--


/*!40000 ALTER TABLE `area` DISABLE KEYS */;
LOCK TABLES `area` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;

--
-- Table structure for table `asignacionactivosfijos`
--

DROP TABLE IF EXISTS `asignacionactivosfijos`;
CREATE TABLE `asignacionactivosfijos` (
  `SERIAL_ASAF` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `SERIAL_PVD` int(11) default NULL,
  `SERIAL_ACF` int(11) default NULL,
  `SERIAL_UBI` int(11) default NULL,
  `FECHA_ASAF` date default NULL,
  `ESTADO_ASAF` varchar(10) collate latin1_spanish_ci default NULL,
  `FECHARECEPCION_ASAF` date default NULL,
  `FECHAENTREGA_ASAF` date default NULL,
  `ELABORADOPOR_ASAF` int(11) default NULL,
  `MODIFICADOPOR_ASAF` int(11) default NULL,
  `FECHAMODIFICACION_ASAF` date default NULL,
  `APROBADOPOR_ASAF` int(11) default NULL,
  `FECHAAPROBACION_ASAF` date default NULL,
  `ENCUSTODIA_ASAF` char(2) collate latin1_spanish_ci default NULL,
  `OBSERVACION_ASAF` varchar(255) collate latin1_spanish_ci default NULL,
  `TIPO_ASAF` varchar(20) collate latin1_spanish_ci default NULL,
  `UBICACION_ASAF` varchar(100) collate latin1_spanish_ci default NULL,
  `CUSTODIOENTREGA_ASAF` int(11) default NULL,
  `TIPOGARANTIA_ASAF` varchar(25) collate latin1_spanish_ci default NULL,
  `NUMEROGARANTIA_ASAF` varchar(25) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ASAF`),
  KEY `FK_ACTIVOFIJOASIGNACIONACTIVOFIJO` (`SERIAL_ACF`),
  KEY `FK_ASIGNACIONACTIVOSFIJOSUBICACION` (`SERIAL_UBI`),
  KEY `FK_EMPLEADOASIGNACIONACTIVOFIJO` (`SERIAL_EPL`),
  KEY `FK_PROVEEDORASIGNACIONACTIVOSFIJOS` (`SERIAL_PVD`),
  CONSTRAINT `FK_ACTIVOFIJOASIGNACIONACTIVOFIJO` FOREIGN KEY (`SERIAL_ACF`) REFERENCES `activosfijos` (`SERIAL_ACF`),
  CONSTRAINT `FK_ASIGNACIONACTIVOSFIJOSUBICACION` FOREIGN KEY (`SERIAL_UBI`) REFERENCES `ubicacion` (`SERIAL_UBI`),
  CONSTRAINT `FK_EMPLEADOASIGNACIONACTIVOFIJO` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PROVEEDORASIGNACIONACTIVOSFIJOS` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `asignacionactivosfijos`
--


/*!40000 ALTER TABLE `asignacionactivosfijos` DISABLE KEYS */;
LOCK TABLES `asignacionactivosfijos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `asignacionactivosfijos` ENABLE KEYS */;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `SERIAL_ASI` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `FECHA_ASI` date NOT NULL default '0000-00-00',
  `ENTRADA_ASI` char(12) collate latin1_spanish_ci NOT NULL default '',
  `SALIDA_ASI` char(12) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_ASI` char(20) collate latin1_spanish_ci NOT NULL default '',
  `ATRASO_ASI` int(11) default NULL,
  `PERMISO_ASI` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_ASI`),
  KEY `AK_FECHA_ASI_IDX` (`FECHA_ASI`),
  KEY `FK_EMPLEADOASISTENCIA` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOASISTENCIA` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `asistencia`
--


/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
LOCK TABLES `asistencia` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;

--
-- Table structure for table `auditoria`
--

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE `auditoria` (
  `SERIAL_AUD` int(11) NOT NULL auto_increment,
  `SERIAL_USR` int(11) default NULL,
  `FECHA_AUD` date NOT NULL default '0000-00-00',
  `HORA_AUD` time NOT NULL default '00:00:00',
  `ACCION_AUD` char(25) collate latin1_spanish_ci NOT NULL default '',
  `INSTRUCCION_AUD` char(255) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCIONIP_AUD` char(20) collate latin1_spanish_ci NOT NULL default '',
  `PROCESO_AUD` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_AUD`),
  KEY `AK_FECHA_AUD_IDX` (`FECHA_AUD`),
  KEY `FK_USUARIOAUDITORIA` (`SERIAL_USR`),
  CONSTRAINT `FK_USUARIOAUDITORIA` FOREIGN KEY (`SERIAL_USR`) REFERENCES `usuario` (`SERIAL_USR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `auditoria`
--


/*!40000 ALTER TABLE `auditoria` DISABLE KEYS */;
LOCK TABLES `auditoria` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `auditoria` ENABLE KEYS */;

--
-- Table structure for table `autorizacion`
--

DROP TABLE IF EXISTS `autorizacion`;
CREATE TABLE `autorizacion` (
  `serial_aut` int(11) NOT NULL auto_increment,
  `serial_alu` int(11) default NULL,
  `serial_per` int(11) default NULL,
  `serial_niv` int(11) default NULL,
  `autorizado_aut` char(1) collate latin1_spanish_ci default NULL,
  `observacion_aut` char(80) collate latin1_spanish_ci default NULL,
  `serialUsuario_aut` int(11) default NULL,
  `nombreUsuario_aut` char(255) collate latin1_spanish_ci default NULL,
  `serialUsrCursoAut_aut` int(11) default NULL,
  `nombreUsrCursoAut_aut` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_aut`),
  KEY `Relationship_124_FK` (`serial_alu`),
  KEY `periodoAutorizacion_FK` (`serial_per`),
  KEY `nivelAutorizacion_FK` (`serial_niv`),
  CONSTRAINT `autorizacion_ibfk_1` FOREIGN KEY (`serial_alu`) REFERENCES `alumno` (`serial_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `autorizacion`
--


/*!40000 ALTER TABLE `autorizacion` DISABLE KEYS */;
LOCK TABLES `autorizacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `autorizacion` ENABLE KEYS */;

--
-- Table structure for table `banco`
--

DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `serial_ban` int(11) NOT NULL auto_increment,
  `codigo_ban` char(15) collate latin1_spanish_ci NOT NULL default '',
  `nombre_ban` char(255) collate latin1_spanish_ci NOT NULL default '',
  `generaArchivo_ban` char(1) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_ban`),
  UNIQUE KEY `codigo_ban_idx` (`codigo_ban`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `banco`
--


/*!40000 ALTER TABLE `banco` DISABLE KEYS */;
LOCK TABLES `banco` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `banco` ENABLE KEYS */;

--
-- Table structure for table `beneficioslegales`
--

DROP TABLE IF EXISTS `beneficioslegales`;
CREATE TABLE `beneficioslegales` (
  `SERIAL_BEL` int(11) NOT NULL auto_increment,
  `CODIGO_BEL` varchar(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_BEL` varchar(100) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_BEL` text collate latin1_spanish_ci,
  `TIPOVALOR_BEL` varchar(15) collate latin1_spanish_ci NOT NULL default '',
  `VALOR_BEL` decimal(16,2) NOT NULL default '0.00',
  `BASECALCULO_BEL` varchar(20) collate latin1_spanish_ci NOT NULL default '',
  `TIPOBENEFICIO_BEL` varchar(5) collate latin1_spanish_ci NOT NULL default '',
  `VIGENTEHASTA_BEL` date default NULL,
  `ESTADO_BEL` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_BEL`),
  KEY `AK_CODIGO_BEL_IDX` (`CODIGO_BEL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `beneficioslegales`
--


/*!40000 ALTER TABLE `beneficioslegales` DISABLE KEYS */;
LOCK TABLES `beneficioslegales` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `beneficioslegales` ENABLE KEYS */;

--
-- Table structure for table `bodega`
--

DROP TABLE IF EXISTS `bodega`;
CREATE TABLE `bodega` (
  `SERIAL_BOD` int(11) NOT NULL auto_increment,
  `SERIAL_DESC` int(11) default NULL,
  `SERIAL_TBO` int(11) default NULL,
  `CODIGO_BOD` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_BOD` char(30) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_BOD` char(255) collate latin1_spanish_ci NOT NULL default '',
  `UBICACION_BOD` char(64) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_BOD`),
  KEY `AK_CODIGO_BOD_IDX` (`CODIGO_BOD`),
  KEY `FK_SUCURSALDEPARTAMENTOSBODEGA` (`SERIAL_DESC`),
  KEY `FK_TIPOBODEGABODEGA` (`SERIAL_TBO`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOSBODEGA` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`),
  CONSTRAINT `FK_TIPOBODEGABODEGA` FOREIGN KEY (`SERIAL_TBO`) REFERENCES `tipobodega` (`SERIAL_TBO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `bodega`
--


/*!40000 ALTER TABLE `bodega` DISABLE KEYS */;
LOCK TABLES `bodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `bodega` ENABLE KEYS */;

--
-- Table structure for table `cajaventa`
--

DROP TABLE IF EXISTS `cajaventa`;
CREATE TABLE `cajaventa` (
  `SERIAL_CAJV` int(11) NOT NULL auto_increment,
  `SERIAL_DESC` int(11) default NULL,
  `CODIGO_CAJ` char(6) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CAJ` char(60) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_CAJ` char(75) collate latin1_spanish_ci NOT NULL default '',
  `CAJERO_CAJ` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_CAJV`),
  KEY `AK_CODIGO_CAJ_IDX` (`CODIGO_CAJ`),
  KEY `FK_CAJAVENTASUCURSALDEPARTAMENTOS` (`SERIAL_DESC`),
  CONSTRAINT `FK_CAJAVENTASUCURSALDEPARTAMENTOS` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `cajaventa`
--


/*!40000 ALTER TABLE `cajaventa` DISABLE KEYS */;
LOCK TABLES `cajaventa` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `cajaventa` ENABLE KEYS */;

--
-- Table structure for table `calificacioncliente`
--

DROP TABLE IF EXISTS `calificacioncliente`;
CREATE TABLE `calificacioncliente` (
  `SERIAL_CAL` int(11) NOT NULL auto_increment,
  `SERIAL_NIVC` int(11) default NULL,
  `SERIAL_PTO` int(11) default NULL,
  `SERIAL_CLI` int(11) default NULL,
  `CALIFICACION_CAL` int(11) default NULL,
  `FECHA_CAL` datetime default NULL,
  `DOCUMENTOGENERA_CAL` int(11) default NULL,
  `CREADOPOR_CAL` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_CAL`),
  KEY `FK_CLIENTECALIFICACION` (`SERIAL_CLI`),
  KEY `FK_NIVELCALIFICACIONCALIFICACION` (`SERIAL_NIVC`),
  KEY `FK_PUNTOSCLIENTECALIFICACIONCLIENTE` (`SERIAL_PTO`),
  CONSTRAINT `FK_CLIENTECALIFICACION` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`),
  CONSTRAINT `FK_NIVELCALIFICACIONCALIFICACION` FOREIGN KEY (`SERIAL_NIVC`) REFERENCES `nivelcalificacion` (`SERIAL_NIVC`),
  CONSTRAINT `FK_PUNTOSCLIENTECALIFICACIONCLIENTE` FOREIGN KEY (`SERIAL_PTO`) REFERENCES `puntoscliente` (`SERIAL_PTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `calificacioncliente`
--


/*!40000 ALTER TABLE `calificacioncliente` DISABLE KEYS */;
LOCK TABLES `calificacioncliente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `calificacioncliente` ENABLE KEYS */;

--
-- Table structure for table `calificacionproveedor`
--

DROP TABLE IF EXISTS `calificacionproveedor`;
CREATE TABLE `calificacionproveedor` (
  `SERIAL_CPVD` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `SERIAL_NIVCP` int(11) default NULL,
  `SERIAL_PTP` int(11) default NULL,
  `CALIFICACIONCREDITO_CPVD` int(11) NOT NULL default '0',
  `CALIFICACION_CPVD` int(11) default NULL,
  `FECHA_CPVD` datetime NOT NULL default '0000-00-00 00:00:00',
  `DOCUMENTOGENERA_CPVD` int(11) default NULL,
  `CREADOPOR_CPVD` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_CPVD`),
  KEY `FK_NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR` (`SERIAL_NIVCP`),
  KEY `FK_PROVEEDORCALIFICACIONPROVEEDOR` (`SERIAL_PVD`),
  KEY `FK_PUNTOSPROVEEDORCALIFICACIONPROVEEDOR` (`SERIAL_PTP`),
  CONSTRAINT `FK_NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR` FOREIGN KEY (`SERIAL_NIVCP`) REFERENCES `nivelcalificacionproveedor` (`SERIAL_NIVCP`),
  CONSTRAINT `FK_PROVEEDORCALIFICACIONPROVEEDOR` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`),
  CONSTRAINT `FK_PUNTOSPROVEEDORCALIFICACIONPROVEEDOR` FOREIGN KEY (`SERIAL_PTP`) REFERENCES `puntosproveedor` (`SERIAL_PTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `calificacionproveedor`
--


/*!40000 ALTER TABLE `calificacionproveedor` DISABLE KEYS */;
LOCK TABLES `calificacionproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `calificacionproveedor` ENABLE KEYS */;

--
-- Table structure for table `canal`
--

DROP TABLE IF EXISTS `canal`;
CREATE TABLE `canal` (
  `SERIAL_CAN` int(11) NOT NULL auto_increment,
  `CODIGO_CAN` char(6) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CAN` char(40) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_CAN`),
  KEY `AK_CODIGO_CAN_IDX` (`CODIGO_CAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `canal`
--


/*!40000 ALTER TABLE `canal` DISABLE KEYS */;
LOCK TABLES `canal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `canal` ENABLE KEYS */;

--
-- Table structure for table `capacitacionpersonal`
--

DROP TABLE IF EXISTS `capacitacionpersonal`;
CREATE TABLE `capacitacionpersonal` (
  `SERIAL_CAP` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `FECHAINICIO_CAP` date NOT NULL default '0000-00-00',
  `DESCRIPCION_CAP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `INSTRUCTOR_CAP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `INSTITUCION_CAP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRECERTIFICADO_CAP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DURACION_CAP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `COSTO_CAP` decimal(16,2) NOT NULL default '0.00',
  `TIPO_CAP` char(30) collate latin1_spanish_ci NOT NULL default '',
  `FECHAFIN_CAP` date default NULL,
  `CIUDAD_CAP` char(30) collate latin1_spanish_ci default NULL,
  `BECA_CAP` char(2) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CAP`),
  KEY `AK_FECHA_CAP_IDX` (`FECHAINICIO_CAP`),
  KEY `FK_EMPLEADOCAPACITACIONPROFESIONAL` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOCAPACITACIONPROFESIONAL` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `capacitacionpersonal`
--


/*!40000 ALTER TABLE `capacitacionpersonal` DISABLE KEYS */;
LOCK TABLES `capacitacionpersonal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `capacitacionpersonal` ENABLE KEYS */;

--
-- Table structure for table `cargasfamiliares`
--

DROP TABLE IF EXISTS `cargasfamiliares`;
CREATE TABLE `cargasfamiliares` (
  `SERIAL_CAF` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `NOMBRE_CAF` char(60) collate latin1_spanish_ci NOT NULL default '',
  `APELLIDO_CAF` char(60) collate latin1_spanish_ci NOT NULL default '',
  `FECHANACIMIENTO_CAF` date NOT NULL default '0000-00-00',
  `SEXO_CAF` char(10) collate latin1_spanish_ci NOT NULL default '',
  `BENEFICIARIO_CAF` char(2) collate latin1_spanish_ci NOT NULL default '',
  `PARENTESCO_CAF` char(25) collate latin1_spanish_ci default NULL,
  `EDAD_CAF` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_CAF`),
  KEY `FK_EMPLEADOCARGASFAMILIARES` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOCARGASFAMILIARES` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `cargasfamiliares`
--


/*!40000 ALTER TABLE `cargasfamiliares` DISABLE KEYS */;
LOCK TABLES `cargasfamiliares` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `cargasfamiliares` ENABLE KEYS */;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `SERIAL_CAR` int(11) NOT NULL auto_increment,
  `SERIAL_PEC` int(11) default NULL,
  `SERIAL_JER` int(11) default NULL,
  `CODIGO_CAR` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CAR` char(50) collate latin1_spanish_ci NOT NULL default '',
  `SUPERVISADOPOR_CAR` int(11) NOT NULL default '0',
  `CODIGOIESS_CAR` char(15) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CAR`),
  KEY `AK_CODIGO_CAR_IDX` (`CODIGO_CAR`),
  KEY `FK_JERARQUIACARGOS` (`SERIAL_JER`),
  KEY `FK_PERFILCOMPETENCIASCARGOS` (`SERIAL_PEC`),
  CONSTRAINT `FK_JERARQUIACARGOS` FOREIGN KEY (`SERIAL_JER`) REFERENCES `jerarquia` (`SERIAL_JER`),
  CONSTRAINT `FK_PERFILCOMPETENCIASCARGOS` FOREIGN KEY (`SERIAL_PEC`) REFERENCES `perfilcompetencias` (`SERIAL_PEC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `cargos`
--


/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
LOCK TABLES `cargos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;

--
-- Table structure for table `categoriaproducto`
--

DROP TABLE IF EXISTS `categoriaproducto`;
CREATE TABLE `categoriaproducto` (
  `SERIAL_CAP` int(11) NOT NULL auto_increment,
  `SERIAL_FAP` int(11) default NULL,
  `CODIGO_CAP` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CAP` char(50) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_CAP` char(200) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_CAP`),
  KEY `AK_CODIGO_CAP_IDX` (`CODIGO_CAP`),
  KEY `FK_FAMILIACATEGORIAPRODUCTO` (`SERIAL_FAP`),
  CONSTRAINT `FK_FAMILIACATEGORIAPRODUCTO` FOREIGN KEY (`SERIAL_FAP`) REFERENCES `familiaproducto` (`SERIAL_FAP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `categoriaproducto`
--


/*!40000 ALTER TABLE `categoriaproducto` DISABLE KEYS */;
LOCK TABLES `categoriaproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `categoriaproducto` ENABLE KEYS */;

--
-- Table structure for table `ciclo`
--

DROP TABLE IF EXISTS `ciclo`;
CREATE TABLE `ciclo` (
  `SERIAL_CIC` int(11) NOT NULL auto_increment,
  `CODIGO_CIC` char(15) NOT NULL default '',
  `NOMBRE_CIC` char(30) NOT NULL default '',
  `DESCRIPCION_CIC` char(255) default NULL,
  `SERIAL_SEC` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_CIC`),
  KEY `codigo_sec_idx` (`CODIGO_CIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciclo`
--


/*!40000 ALTER TABLE `ciclo` DISABLE KEYS */;
LOCK TABLES `ciclo` WRITE;
INSERT INTO `ciclo` VALUES (1,'FUN','FUNDAMENTACION','FUNDAMENTACION',3),(2,'PRO','PROPEDEUTICO','PROPEDEUTICO',3),(3,'ESP','ESPECIALIZACION','ESPECIALIZACION',3);
UNLOCK TABLES;
/*!40000 ALTER TABLE `ciclo` ENABLE KEYS */;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE `ciudad` (
  `SERIAL_CIU` int(11) NOT NULL auto_increment,
  `SERIAL_PRV` int(11) default NULL,
  `CODIGO_CIU` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CIU` char(60) collate latin1_spanish_ci NOT NULL default '',
  `POBLACION_CIU` int(11) default NULL,
  `OBSERVACIONES_CIU` char(255) collate latin1_spanish_ci default NULL,
  `LUNES_CIU` char(2) collate latin1_spanish_ci default NULL,
  `MARTES_CIU` char(2) collate latin1_spanish_ci default NULL,
  `MIERCOLES_CIU` char(2) collate latin1_spanish_ci default NULL,
  `JUEVES_CIU` char(2) collate latin1_spanish_ci default NULL,
  `VIERNES_CIU` char(2) collate latin1_spanish_ci default NULL,
  `SABADO_CIU` char(2) collate latin1_spanish_ci default NULL,
  `DOMINGO_CIU` char(2) collate latin1_spanish_ci default NULL,
  `FECHACANTONIZACION_CIU` date default NULL,
  `DIAFESTIVO_CIU` date default NULL,
  PRIMARY KEY  (`SERIAL_CIU`),
  KEY `AK_CODIGO_CIU_IDX` (`CODIGO_CIU`),
  KEY `FK_PROVINCIACIUDAD` (`SERIAL_PRV`),
  CONSTRAINT `FK_PROVINCIACIUDAD` FOREIGN KEY (`SERIAL_PRV`) REFERENCES `provincia` (`SERIAL_PRV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ciudad`
--


/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
LOCK TABLES `ciudad` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;

--
-- Table structure for table `claseactivofijo`
--

DROP TABLE IF EXISTS `claseactivofijo`;
CREATE TABLE `claseactivofijo` (
  `SERIAL_CLAF` int(11) NOT NULL auto_increment,
  `CODIGO_CLAF` char(10) collate latin1_spanish_ci default NULL,
  `NOMBRE_CLAF` char(40) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CLAF`),
  KEY `AK_CODIGO_CLAF_IDX` (`CODIGO_CLAF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `claseactivofijo`
--


/*!40000 ALTER TABLE `claseactivofijo` DISABLE KEYS */;
LOCK TABLES `claseactivofijo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `claseactivofijo` ENABLE KEYS */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `SERIAL_CLI` int(11) NOT NULL auto_increment,
  `SERIAL_FORC` int(11) default NULL,
  `SERIAL_CIU` int(11) default NULL,
  `SERIAL_CAN` int(11) default NULL,
  `SERIAL_TIP` int(11) default NULL,
  `SERIAL_TPR` int(11) default NULL,
  `CODIGO_CLI` char(20) collate latin1_spanish_ci NOT NULL default '',
  `CODIGOANTERIOR_CLI` char(20) collate latin1_spanish_ci default NULL,
  `PERSONAJURIDICA_CLI` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_CLI` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDO_CLI` char(60) collate latin1_spanish_ci default NULL,
  `RAZONSOCIAL_CLI` char(100) collate latin1_spanish_ci NOT NULL default '',
  `NOMBREREPRESENTANTE_CLI` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOREPRESENTANTE_CLI` char(60) collate latin1_spanish_ci default NULL,
  `DOCUMENTOIDENTIDAD_CLI` char(13) collate latin1_spanish_ci NOT NULL default '',
  `TIPODOCUMENTO_CLI` char(20) collate latin1_spanish_ci NOT NULL default '',
  `UBICACIONX_CLI` decimal(5,2) default NULL,
  `UBACACIONY_CLI` decimal(5,2) default NULL,
  `DIRECCION_CLI` char(255) collate latin1_spanish_ci NOT NULL default '',
  `NUMEROCASA_CLI` char(10) collate latin1_spanish_ci default NULL,
  `TELEFONOCOM1_CLI` char(12) collate latin1_spanish_ci default NULL,
  `TELEFONOCOM2_CLI` char(12) collate latin1_spanish_ci default NULL,
  `FAX_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CELULAR_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICOCLIENTE_CLI` char(100) collate latin1_spanish_ci default NULL,
  `DESCUENTO_CLI` decimal(5,2) default NULL,
  `NOMBRECONTACTOCOMPRAS_CLI` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOCONTACTOCOMPRAS_CLI` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONOCOMPRAS_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CELULARCOMPRAS_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICOCOMPRAS_CLI` char(100) collate latin1_spanish_ci default NULL,
  `NOMBRECONTACTOPAGOS_CLI` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOCONTACTOPAGOS_CLI` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONOPAGOS_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CELULARPAGOS_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICOPAGOS_CLI` char(100) collate latin1_spanish_ci default NULL,
  `COMISIONVENTA_CLI` char(2) collate latin1_spanish_ci default NULL,
  `COMISIONCOBRO_CLI` char(2) collate latin1_spanish_ci default NULL,
  `CUMPLEANOSPAGOS_CLI` date default NULL,
  `CLIENTEDESDE_CLI` date default NULL,
  `FECHAINICIOSRI_CLI` date default NULL,
  `ACTIVIDADECONOMICASRI_CLI` char(255) collate latin1_spanish_ci default NULL,
  `TIPOSRI_CLI` char(30) collate latin1_spanish_ci default NULL,
  `ESTADOSRI_CLI` char(30) collate latin1_spanish_ci default NULL,
  `ESTADO_CLI` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_CLI` int(11) default NULL,
  `MODIFICADOPOR_CLI` int(11) default NULL,
  `FECHAMODIFICACION_CLI` datetime default NULL,
  `APROBADOPOR_CLI` int(11) default NULL,
  `FECHAAPROBACION_CLI` datetime default NULL,
  `FECHANACIMIENTO_CLI` date default NULL,
  `ESTADOCIVIL_CLI` char(20) collate latin1_spanish_ci default NULL,
  `NOMBRECONYUGUE_CLI` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOCONYUGUE_CLI` char(60) collate latin1_spanish_ci default NULL,
  `DOCUMENTOIDENTIFICACIONCONYUGUE_CLI` char(13) collate latin1_spanish_ci default NULL,
  `FECHAPRIMERACOMPRA_CLI` date default NULL,
  `ESTADOPREDIOCOMERCIO_CLI` char(20) collate latin1_spanish_ci default NULL,
  `SECTOR_CLI` char(20) collate latin1_spanish_ci default NULL,
  `BARRIO_CLI` char(20) collate latin1_spanish_ci default NULL,
  `DIRECCIONDOMICILIO_CLI` char(100) collate latin1_spanish_ci default NULL,
  `ESTADOPREDIODOMICILIO_CLI` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONODOMICILIO_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CELULARCONYUGUE_CLI` char(12) collate latin1_spanish_ci default NULL,
  `OTROTELEFONO_CLI` char(12) collate latin1_spanish_ci default NULL,
  `CASILLAPOSTAL_CLI` char(10) collate latin1_spanish_ci default NULL,
  `NOMBREREFERENCIAFAMILIAR_CLI` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONOREFERENCIAFAMILIAR_CLI` char(12) collate latin1_spanish_ci default NULL,
  `NOMBRECOMERCIAL_CLI` char(60) collate latin1_spanish_ci default NULL,
  `TIPOGARANTIA_CLI` char(20) collate latin1_spanish_ci default NULL,
  `DESCRIPCIONGARANTIA_CLI` char(60) collate latin1_spanish_ci default NULL,
  `NUMEROGARANTIA_CLI` int(11) default NULL,
  `VALORGARANTIA_CLI` decimal(16,2) default NULL,
  `CUPOSUGERIDO_CLI` decimal(16,2) default NULL,
  `CUPOAPROBADO_CLI` decimal(16,2) default NULL,
  `PLAZOCREDITO_CLI` int(11) default NULL,
  `CALIFICACION_CLI` int(11) NOT NULL default '0',
  `CUPOUHT_CLI` char(21) collate latin1_spanish_ci default NULL,
  `PLAZOUHT_CLI` int(11) default NULL,
  `CODIGOPROVEEDOR_CLI` char(20) collate latin1_spanish_ci default NULL,
  `TIPOCONTROL_CLI` char(25) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CLI`),
  KEY `AK_CODIGO_CLI_IDX` (`CODIGO_CLI`),
  KEY `AK_DOCUMENTOIDENTIDAD_CLI_IDX` (`DOCUMENTOIDENTIDAD_CLI`),
  KEY `FK_CIUDADCLIENTE` (`SERIAL_CIU`),
  KEY `FK_CLIENTECANAL` (`SERIAL_CAN`),
  KEY `FK_FORMASCOBROCLIENTE` (`SERIAL_FORC`),
  KEY `FK_TIPOCLIENTECLIENTE` (`SERIAL_TIP`),
  KEY `FK_TIPOPRECIOSCLIENTE` (`SERIAL_TPR`),
  CONSTRAINT `FK_CIUDADCLIENTE` FOREIGN KEY (`SERIAL_CIU`) REFERENCES `ciudad` (`SERIAL_CIU`),
  CONSTRAINT `FK_CLIENTECANAL` FOREIGN KEY (`SERIAL_CAN`) REFERENCES `canal` (`SERIAL_CAN`),
  CONSTRAINT `FK_FORMASCOBROCLIENTE` FOREIGN KEY (`SERIAL_FORC`) REFERENCES `formacobro` (`SERIAL_FORC`),
  CONSTRAINT `FK_TIPOCLIENTECLIENTE` FOREIGN KEY (`SERIAL_TIP`) REFERENCES `tipocliente` (`SERIAL_TIP`),
  CONSTRAINT `FK_TIPOPRECIOSCLIENTE` FOREIGN KEY (`SERIAL_TPR`) REFERENCES `tiposprecios` (`SERIAL_TPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `cliente`
--


/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
LOCK TABLES `cliente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

--
-- Table structure for table `clientecontacto`
--

DROP TABLE IF EXISTS `clientecontacto`;
CREATE TABLE `clientecontacto` (
  `SERIAL_CCL` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `NOMBRE_CCL` char(20) collate latin1_spanish_ci NOT NULL default '',
  `APELLIDO_CCL` char(20) collate latin1_spanish_ci NOT NULL default '',
  `CARGO_CCL` char(25) collate latin1_spanish_ci default NULL,
  `TELEFONOCASA_CCL` char(15) collate latin1_spanish_ci default NULL,
  `TELEFONOOFICINA_CCL` char(15) collate latin1_spanish_ci default NULL,
  `FAX_CCL` char(15) collate latin1_spanish_ci default NULL,
  `CELULAR_CCL` char(15) collate latin1_spanish_ci default NULL,
  `EMAIL_CCL` char(64) collate latin1_spanish_ci default NULL,
  `CEDULA_CCL` char(13) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CCL`),
  KEY `AK_NOMBRE_CCL_IDX` (`NOMBRE_CCL`,`APELLIDO_CCL`),
  KEY `FK_CLIENTECLIENTECONTACTO` (`SERIAL_CLI`),
  CONSTRAINT `FK_CLIENTECLIENTECONTACTO` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `clientecontacto`
--


/*!40000 ALTER TABLE `clientecontacto` DISABLE KEYS */;
LOCK TABLES `clientecontacto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `clientecontacto` ENABLE KEYS */;

--
-- Table structure for table `clientereferencias`
--

DROP TABLE IF EXISTS `clientereferencias`;
CREATE TABLE `clientereferencias` (
  `SERIAL_CRE` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `NOMBRE_CRE` char(40) collate latin1_spanish_ci default NULL,
  `TIPO_CRE` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONO_CRE` char(15) collate latin1_spanish_ci default NULL,
  `RELACION_CRE` char(30) collate latin1_spanish_ci default NULL,
  `OBSERVACION_CRE` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CRE`),
  KEY `FK_CLIENTECLIENTEREFERENCIAS` (`SERIAL_CLI`),
  CONSTRAINT `FK_CLIENTECLIENTEREFERENCIAS` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `clientereferencias`
--


/*!40000 ALTER TABLE `clientereferencias` DISABLE KEYS */;
LOCK TABLES `clientereferencias` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `clientereferencias` ENABLE KEYS */;

--
-- Table structure for table `clienteruta`
--

DROP TABLE IF EXISTS `clienteruta`;
CREATE TABLE `clienteruta` (
  `SERIAL_CLIR` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `SERIAL_RUT` int(11) default NULL,
  `SECUENCIA_CLIR` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_CLIR`),
  KEY `FK_CLIENTECLIENTERUTA` (`SERIAL_CLI`),
  KEY `FK_RUTACLIENTE` (`SERIAL_RUT`),
  CONSTRAINT `FK_CLIENTECLIENTERUTA` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`),
  CONSTRAINT `FK_RUTACLIENTE` FOREIGN KEY (`SERIAL_RUT`) REFERENCES `ruta` (`SERIAL_RUT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `clienteruta`
--


/*!40000 ALTER TABLE `clienteruta` DISABLE KEYS */;
LOCK TABLES `clienteruta` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `clienteruta` ENABLE KEYS */;

--
-- Table structure for table `clientesucursal`
--

DROP TABLE IF EXISTS `clientesucursal`;
CREATE TABLE `clientesucursal` (
  `SERIAL_SCL` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `NOMBRE_SCL` char(30) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCION_SCL` char(100) collate latin1_spanish_ci default NULL,
  `NUMEROCASA_SCL` char(10) collate latin1_spanish_ci default NULL,
  `TELEFONO_SCL` char(15) collate latin1_spanish_ci default NULL,
  `JEFE_SCL` char(50) collate latin1_spanish_ci default NULL,
  `NOMBRE_CIU` char(30) collate latin1_spanish_ci default NULL,
  `NOMBRE_PRV` char(25) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_SCL`),
  KEY `FK_CLIENTECLIENTESUCURSAL` (`SERIAL_CLI`),
  CONSTRAINT `FK_CLIENTECLIENTESUCURSAL` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `clientesucursal`
--


/*!40000 ALTER TABLE `clientesucursal` DISABLE KEYS */;
LOCK TABLES `clientesucursal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `clientesucursal` ENABLE KEYS */;

--
-- Table structure for table `comboproducto`
--

DROP TABLE IF EXISTS `comboproducto`;
CREATE TABLE `comboproducto` (
  `SERIAL_CPRD` int(11) NOT NULL auto_increment,
  `PRODUCTO_CPRD` int(11) NOT NULL default '0',
  `CANTIDAD_CPRD` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_CPRD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `comboproducto`
--


/*!40000 ALTER TABLE `comboproducto` DISABLE KEYS */;
LOCK TABLES `comboproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `comboproducto` ENABLE KEYS */;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
CREATE TABLE `comisiones` (
  `SERIAL_CMS` int(11) NOT NULL auto_increment,
  `FECHA_CMS` date default NULL,
  `FECHAINICIO_CMS` date default NULL,
  `FECHAFIN_CMS` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CMS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `comisiones`
--


/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
LOCK TABLES `comisiones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;

--
-- Table structure for table `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE `comprobante` (
  `SERIAL_COM` int(11) NOT NULL auto_increment,
  `SERIAL_PCO` int(11) default NULL,
  `CODIGO_COM` char(25) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_COM` date NOT NULL default '0000-00-00',
  `CONCEPTO_COM` char(255) collate latin1_spanish_ci default NULL,
  `MONTO_COM` decimal(16,4) default NULL,
  `ESTADO_COM` char(25) collate latin1_spanish_ci default NULL,
  `GENERADO_COM` char(20) collate latin1_spanish_ci default NULL,
  `MODULO_COM` char(25) collate latin1_spanish_ci default NULL,
  `NUMERO_COM` int(11) default NULL,
  `SERIAL_USR` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_COM`),
  KEY `FK_PERIODOCONTABLECOMPROBANTE` (`SERIAL_PCO`),
  CONSTRAINT `FK_PERIODOCONTABLECOMPROBANTE` FOREIGN KEY (`SERIAL_PCO`) REFERENCES `periodocontable` (`SERIAL_PCO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `comprobante`
--


/*!40000 ALTER TABLE `comprobante` DISABLE KEYS */;
LOCK TABLES `comprobante` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `comprobante` ENABLE KEYS */;

--
-- Table structure for table `condicionesnegociacionproveedor`
--

DROP TABLE IF EXISTS `condicionesnegociacionproveedor`;
CREATE TABLE `condicionesnegociacionproveedor` (
  `SERIAL_CNP` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `NOMBRE_CNP` char(40) collate latin1_spanish_ci default NULL,
  `DIASCREDITO_CNP` int(11) default NULL,
  `DESCUENTOPAGOPUNTUAL_CNP` decimal(5,2) default NULL,
  `DESCUENTO3_CNP` decimal(5,2) default NULL,
  `DESCUENTO8_CNP` decimal(5,2) default NULL,
  `DESCUENTO15_CNP` decimal(5,2) default NULL,
  `REBATE_CNP` decimal(5,2) default NULL,
  `NEGOCIACIONPUNTUAL_CNP` decimal(5,2) default NULL,
  `OTROS_CNP` char(30) collate latin1_spanish_ci default NULL,
  `DESCUENTOFACTURA_CNP` char(30) collate latin1_spanish_ci default NULL,
  `DESCUENTOCUMPLIMIENTO_CNP` char(30) collate latin1_spanish_ci default NULL,
  `ADICIONAL_CNP` char(30) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CNP`),
  KEY `AK_NOMBRE_CNP` (`NOMBRE_CNP`),
  KEY `FK_PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `condicionesnegociacionproveedor`
--


/*!40000 ALTER TABLE `condicionesnegociacionproveedor` DISABLE KEYS */;
LOCK TABLES `condicionesnegociacionproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `condicionesnegociacionproveedor` ENABLE KEYS */;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos` (
  `serial_cot` int(11) NOT NULL auto_increment,
  `serial_exa` int(11) default NULL,
  `serial_alu` int(11) default NULL,
  `telefono_cot` char(50) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_cot`),
  KEY `alumnoContactos_FK` (`serial_alu`),
  KEY `exalumnosContactos_FK` (`serial_exa`),
  CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`serial_alu`) REFERENCES `alumno` (`serial_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `contactos`
--


/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
LOCK TABLES `contactos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;

--
-- Table structure for table `contactosproveedor`
--

DROP TABLE IF EXISTS `contactosproveedor`;
CREATE TABLE `contactosproveedor` (
  `SERIAL_CPV` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `NOMBRE_CPV` char(60) collate latin1_spanish_ci NOT NULL default '',
  `CARGO_CPV` char(30) collate latin1_spanish_ci default NULL,
  `EMAIL_CPV` char(64) collate latin1_spanish_ci default NULL,
  `CELULAR_CPV` char(15) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_CPV`),
  KEY `FK_PROVEEDORPROVEEDORCONTACTOS` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROVEEDORPROVEEDORCONTACTOS` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `contactosproveedor`
--


/*!40000 ALTER TABLE `contactosproveedor` DISABLE KEYS */;
LOCK TABLES `contactosproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `contactosproveedor` ENABLE KEYS */;

--
-- Table structure for table `criterio`
--

DROP TABLE IF EXISTS `criterio`;
CREATE TABLE `criterio` (
  `serial_cri` int(11) NOT NULL auto_increment,
  `serial_matniv` int(11) NOT NULL default '0',
  `nombre_cri` char(100) collate latin1_spanish_ci NOT NULL default '',
  `descripcion_cri` char(255) collate latin1_spanish_ci default NULL,
  `codigo_cri` char(1) collate latin1_spanish_ci NOT NULL default '',
  `porcentaje_cri` double default NULL,
  `activo_cri` char(1) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_cri`),
  KEY `FK_criterio_materia_nivel_FK` (`serial_matniv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `criterio`
--


/*!40000 ALTER TABLE `criterio` DISABLE KEYS */;
LOCK TABLES `criterio` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `criterio` ENABLE KEYS */;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `SERIAL_DEP` int(11) NOT NULL auto_increment,
  `CODIGO_DEP` char(8) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_DEP` char(25) collate latin1_spanish_ci NOT NULL default '',
  `CONSOLIDADO_DEP` char(2) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_DEP`),
  KEY `AK_CODIGO_DEP_IDX` (`CODIGO_DEP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `departamentos`
--


/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
LOCK TABLES `departamentos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;

--
-- Table structure for table `depreciaciones`
--

DROP TABLE IF EXISTS `depreciaciones`;
CREATE TABLE `depreciaciones` (
  `SERIAL_DEPR` int(11) NOT NULL auto_increment,
  `NUMERODOCUMENTO_DEPR` char(10) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_DEPR` date NOT NULL default '0000-00-00',
  `CONTABILIZAR_DEPR` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_DEPR` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_DEPR` int(11) default NULL,
  `MODIFICADOPOR_DEPR` int(11) default NULL,
  `FECHAMODIFICACION_DEPR` datetime default NULL,
  `APROBADOPOR_DEPR` int(11) default NULL,
  `FECHAAPROBACION_DEPR` datetime default NULL,
  PRIMARY KEY  (`SERIAL_DEPR`),
  KEY `AK_NUMERODOCUMENTO_DEP_IDX` (`NUMERODOCUMENTO_DEPR`),
  KEY `AK_FECHA_DEP_IDX` (`FECHA_DEPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `depreciaciones`
--


/*!40000 ALTER TABLE `depreciaciones` DISABLE KEYS */;
LOCK TABLES `depreciaciones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `depreciaciones` ENABLE KEYS */;

--
-- Table structure for table `descuentocanal`
--

DROP TABLE IF EXISTS `descuentocanal`;
CREATE TABLE `descuentocanal` (
  `SERIAL_DCA` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `SERIAL_CAN` int(11) default NULL,
  `SERIAL_TPR` int(11) NOT NULL default '0',
  `DESCUENTO_DCA` decimal(5,2) default NULL,
  `TOTALUNIDADES_DCA` int(11) default NULL,
  `DESCUENTOUNIDADES_DCA` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DCA`),
  KEY `FK_CANALDESCUENTOCANAL` (`SERIAL_CAN`),
  KEY `FK_PRODUCTODESCUENTOCANAL` (`SERIAL_PRD`),
  CONSTRAINT `FK_CANALDESCUENTOCANAL` FOREIGN KEY (`SERIAL_CAN`) REFERENCES `canal` (`SERIAL_CAN`),
  CONSTRAINT `FK_PRODUCTODESCUENTOCANAL` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `descuentocanal`
--


/*!40000 ALTER TABLE `descuentocanal` DISABLE KEYS */;
LOCK TABLES `descuentocanal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `descuentocanal` ENABLE KEYS */;

--
-- Table structure for table `descuentocantidad`
--

DROP TABLE IF EXISTS `descuentocantidad`;
CREATE TABLE `descuentocantidad` (
  `SERIAL_DSQ` int(11) NOT NULL auto_increment,
  `SERIAL_CAP` int(11) default NULL,
  `DESCUENTO_DSQ` decimal(5,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_DSQ`),
  KEY `FK_CATEGORIAPRODUCTODESCUENTOCANTIDAD` (`SERIAL_CAP`),
  CONSTRAINT `FK_CATEGORIAPRODUCTODESCUENTOCANTIDAD` FOREIGN KEY (`SERIAL_CAP`) REFERENCES `categoriaproducto` (`SERIAL_CAP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `descuentocantidad`
--


/*!40000 ALTER TABLE `descuentocantidad` DISABLE KEYS */;
LOCK TABLES `descuentocantidad` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `descuentocantidad` ENABLE KEYS */;

--
-- Table structure for table `detalleaprobaciones`
--

DROP TABLE IF EXISTS `detalleaprobaciones`;
CREATE TABLE `detalleaprobaciones` (
  `SERIAL_DAP` int(11) NOT NULL auto_increment,
  `SERIAL_APR` int(11) default NULL,
  `SERIAL_USR` int(11) default NULL,
  `FECHA_DAP` date NOT NULL default '0000-00-00',
  `HORA_DAP` time default NULL,
  `CUPO_DAP` decimal(16,2) default NULL,
  `ESTADO_DAP` char(15) collate latin1_spanish_ci NOT NULL default '',
  `OBSERVACIONES_DAP` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_DAP`),
  KEY `FK_APROBACIONDETALLEAPROBACION` (`SERIAL_APR`),
  KEY `FK_USUARIODETALLEAPROBACIONES` (`SERIAL_USR`),
  CONSTRAINT `FK_APROBACIONDETALLEAPROBACION` FOREIGN KEY (`SERIAL_APR`) REFERENCES `aprobacion` (`SERIAL_APR`),
  CONSTRAINT `FK_USUARIODETALLEAPROBACIONES` FOREIGN KEY (`SERIAL_USR`) REFERENCES `usuario` (`SERIAL_USR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleaprobaciones`
--


/*!40000 ALTER TABLE `detalleaprobaciones` DISABLE KEYS */;
LOCK TABLES `detalleaprobaciones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleaprobaciones` ENABLE KEYS */;

--
-- Table structure for table `detallecomisiones`
--

DROP TABLE IF EXISTS `detallecomisiones`;
CREATE TABLE `detallecomisiones` (
  `SERIAL_DCO` int(11) NOT NULL auto_increment,
  `SERIAL_CMS` int(11) default NULL,
  `COBRADOR_DCO` char(60) collate latin1_spanish_ci NOT NULL default '',
  `COMISION_DCO` decimal(4,0) default NULL,
  PRIMARY KEY  (`SERIAL_DCO`),
  KEY `FK_COMISIONESDETALLECOMISIONES` (`SERIAL_CMS`),
  CONSTRAINT `FK_COMISIONESDETALLECOMISIONES` FOREIGN KEY (`SERIAL_CMS`) REFERENCES `comisiones` (`SERIAL_CMS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detallecomisiones`
--


/*!40000 ALTER TABLE `detallecomisiones` DISABLE KEYS */;
LOCK TABLES `detallecomisiones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detallecomisiones` ENABLE KEYS */;

--
-- Table structure for table `detallecomprobante`
--

DROP TABLE IF EXISTS `detallecomprobante`;
CREATE TABLE `detallecomprobante` (
  `SERIAL_DCO` int(11) NOT NULL auto_increment,
  `SERIAL_COM` int(11) default NULL,
  `SERIAL_PLC` int(11) default NULL,
  `DEBE_DCO` decimal(16,4) default NULL,
  `HABER_DCO` decimal(16,4) default NULL,
  `DESCRIPCION_DCO` char(255) collate latin1_spanish_ci default NULL,
  `REFERENCIA_DCO` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_DCO`),
  KEY `FK_COMPROBANTEDETALLECOMPROBANTE` (`SERIAL_COM`),
  KEY `FK_PLANCONTABLEDETALLECOMPROBANTE` (`SERIAL_PLC`),
  CONSTRAINT `FK_COMPROBANTEDETALLECOMPROBANTE` FOREIGN KEY (`SERIAL_COM`) REFERENCES `comprobante` (`SERIAL_COM`),
  CONSTRAINT `FK_PLANCONTABLEDETALLECOMPROBANTE` FOREIGN KEY (`SERIAL_PLC`) REFERENCES `plancontable` (`SERIAL_PLC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detallecomprobante`
--


/*!40000 ALTER TABLE `detallecomprobante` DISABLE KEYS */;
LOCK TABLES `detallecomprobante` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detallecomprobante` ENABLE KEYS */;

--
-- Table structure for table `detalledepreciaciones`
--

DROP TABLE IF EXISTS `detalledepreciaciones`;
CREATE TABLE `detalledepreciaciones` (
  `SERIAL_DDP` int(11) NOT NULL auto_increment,
  `SERIAL_DEPR` int(11) default NULL,
  `SERIAL_ACF` int(11) default NULL,
  `VALOR_DDP` decimal(16,2) default NULL,
  `DEPRECIACIONMENSUAL_DDP` decimal(16,2) NOT NULL default '0.00',
  `ESTADO_DDP` char(10) collate latin1_spanish_ci default NULL,
  `DEPRECIACIONACUMULADA_DDP` decimal(16,2) default NULL,
  PRIMARY KEY  (`SERIAL_DDP`),
  KEY `FK_DEPRECIACIONESDETALLEDEPRECIACIONES` (`SERIAL_DEPR`),
  KEY `FK_DETALLEDEPRECIACIONESACTIVOSFIJOS` (`SERIAL_ACF`),
  CONSTRAINT `FK_DEPRECIACIONESDETALLEDEPRECIACIONES` FOREIGN KEY (`SERIAL_DEPR`) REFERENCES `depreciaciones` (`SERIAL_DEPR`),
  CONSTRAINT `FK_DETALLEDEPRECIACIONESACTIVOSFIJOS` FOREIGN KEY (`SERIAL_ACF`) REFERENCES `activosfijos` (`SERIAL_ACF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalledepreciaciones`
--


/*!40000 ALTER TABLE `detalledepreciaciones` DISABLE KEYS */;
LOCK TABLES `detalledepreciaciones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalledepreciaciones` ENABLE KEYS */;

--
-- Table structure for table `detallefactura`
--

DROP TABLE IF EXISTS `detallefactura`;
CREATE TABLE `detallefactura` (
  `SERIAL_DFAC` int(11) NOT NULL auto_increment,
  `SERIAL_FAC` int(11) default NULL,
  `CANTIDAD_DFAC` int(11) NOT NULL default '0',
  `PRECIOUNITARIO_DFAC` decimal(16,6) NOT NULL default '0.000000',
  `ICE_DFAC` decimal(16,6) default NULL,
  `DESCUENTODOLARES_DFAC` decimal(16,6) default NULL,
  `DESCUENTOPORCENTAJE_DFAC` decimal(5,2) default NULL,
  `VALORIVA12_DFAC` decimal(16,6) default NULL,
  `VALORIVA0_DFAC` decimal(16,6) default NULL,
  `TOTAL_DFAC` decimal(16,6) NOT NULL default '0.000000',
  `COMISION_DFAC` decimal(16,6) NOT NULL default '0.000000',
  `CANTIDADENTREGADA_DFAC` int(11) default NULL,
  `ESTADO_DFAC` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_DFAC`),
  KEY `FK_FACTURADETALLEFACTURA` (`SERIAL_FAC`),
  CONSTRAINT `FK_FACTURADETALLEFACTURA` FOREIGN KEY (`SERIAL_FAC`) REFERENCES `factura` (`SERIAL_FAC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detallefactura`
--


/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
LOCK TABLES `detallefactura` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;

--
-- Table structure for table `detalleguiaremision`
--

DROP TABLE IF EXISTS `detalleguiaremision`;
CREATE TABLE `detalleguiaremision` (
  `SERIAL_DGUIA` int(11) NOT NULL auto_increment,
  `PRODUCTO_DGUIA` char(20) collate latin1_spanish_ci NOT NULL default '',
  `CANTIDAD_DGUIA` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_DGUIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleguiaremision`
--


/*!40000 ALTER TABLE `detalleguiaremision` DISABLE KEYS */;
LOCK TABLES `detalleguiaremision` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleguiaremision` ENABLE KEYS */;

--
-- Table structure for table `detalleingresoegresodebodega`
--

DROP TABLE IF EXISTS `detalleingresoegresodebodega`;
CREATE TABLE `detalleingresoegresodebodega` (
  `SERIAL_DIEB` int(11) NOT NULL auto_increment,
  `SERIAL_IEB` int(11) default NULL,
  `PRODUCTO_DIEB` char(20) collate latin1_spanish_ci NOT NULL default '',
  `PRECIO_DIEB` decimal(16,6) NOT NULL default '0.000000',
  `CANTIDADSOLICITADA_DIEB` int(11) NOT NULL default '0',
  `CANTIDADRECIBIDAENTREGADA_DIEB` int(11) NOT NULL default '0',
  `ENTREGASPARCIALES_DIEB` int(11) default NULL,
  `LOTE_DIEB` char(30) collate latin1_spanish_ci default NULL,
  `FECHAELABORACION_DIEB` date default NULL,
  `FECHAVENCIEMIENTO_DIEB` date default NULL,
  `OBSERVACIONES_DIEB` char(200) collate latin1_spanish_ci default NULL,
  `SALDOUSD_DIEB` decimal(16,6) NOT NULL default '0.000000',
  `SALDOCANTIDAD_DIEB` int(11) NOT NULL default '0',
  `IVA_DIEB` decimal(16,6) NOT NULL default '0.000000',
  `IVA0_DIEB` decimal(16,6) NOT NULL default '0.000000',
  `DESCUENTOPORCENTAJE_DIEB` decimal(5,2) default NULL,
  `DESCUENTOUSD_DIEB` decimal(16,6) default NULL,
  `TOTAL_DIEB` decimal(16,6) NOT NULL default '0.000000',
  `ESTADO_DIEB` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_DIEB`),
  KEY `FK_INGRESOEGRESOBODEGADETALLEIEB` (`SERIAL_IEB`),
  CONSTRAINT `FK_INGRESOEGRESOBODEGADETALLEIEB` FOREIGN KEY (`SERIAL_IEB`) REFERENCES `ingresoegresodebodega` (`SERIAL_IEB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleingresoegresodebodega`
--


/*!40000 ALTER TABLE `detalleingresoegresodebodega` DISABLE KEYS */;
LOCK TABLES `detalleingresoegresodebodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleingresoegresodebodega` ENABLE KEYS */;

--
-- Table structure for table `detalleordendecompra`
--

DROP TABLE IF EXISTS `detalleordendecompra`;
CREATE TABLE `detalleordendecompra` (
  `SERIAL_DODC` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `SERIAL_ODC` int(11) default NULL,
  `OTROSPRODUCTOS_DODC` char(200) collate latin1_spanish_ci default NULL,
  `COSTO_DODC` decimal(16,6) NOT NULL default '0.000000',
  `CANTIDADRECIBIDA_DODC` int(11) default NULL,
  `CANTIDADREQUERIDA_DODC` int(11) NOT NULL default '0',
  `CANTIDADSUGERIDA_DODC` int(11) default NULL,
  `ESTADO_DODC` char(10) collate latin1_spanish_ci NOT NULL default '',
  `PROMEDIOVENTAS_DODC` int(11) default NULL,
  `STOCKACTUAL_DODC` int(11) default NULL,
  `DIASSTOCK_DODC` int(11) default NULL,
  `SUBTOTAL_DODC` decimal(16,6) NOT NULL default '0.000000',
  `DESCUENTODOLARES_DODC` decimal(16,6) default NULL,
  `DESCUENTOPORCENTAJE_DODC` decimal(5,2) default NULL,
  `IVA_DODC` decimal(16,6) NOT NULL default '0.000000',
  `IVA0_DODC` decimal(16,6) default NULL,
  `TOTAL_DODC` decimal(16,6) default NULL,
  `OBSERVACIONES_DODC` char(200) collate latin1_spanish_ci default NULL,
  `CANTIDADRECIBIDAUNIDADES_DODC` int(11) default NULL,
  `MARCA_DODC` char(64) collate latin1_spanish_ci default NULL,
  `CANTIDADDEVUELTAUNIDADES_DODC` int(11) default NULL,
  `CANTIDADDEVUELTACAJAS_DODC` int(11) default NULL,
  `CANTIDADDEVUELTAUNIDADESANTERIOR_DODC` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DODC`),
  KEY `FK_ORDENDECOMPRADETALLEORDENDECOMPRA` (`SERIAL_ODC`),
  KEY `FK_PRODUCTODETALLEORDENCOMPRA` (`SERIAL_PRD`),
  CONSTRAINT `FK_ORDENDECOMPRADETALLEORDENDECOMPRA` FOREIGN KEY (`SERIAL_ODC`) REFERENCES `ordendecompra` (`SERIAL_ODC`),
  CONSTRAINT `FK_PRODUCTODETALLEORDENCOMPRA` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleordendecompra`
--


/*!40000 ALTER TABLE `detalleordendecompra` DISABLE KEYS */;
LOCK TABLES `detalleordendecompra` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleordendecompra` ENABLE KEYS */;

--
-- Table structure for table `detalleordenderequerimiento`
--

DROP TABLE IF EXISTS `detalleordenderequerimiento`;
CREATE TABLE `detalleordenderequerimiento` (
  `SERIAL_DOR` int(11) NOT NULL auto_increment,
  `SERIAL_ORE` int(11) default NULL,
  `DESCRIPCION_DOR` char(255) collate latin1_spanish_ci default NULL,
  `CANTIDAD_DOR` int(11) default NULL,
  `UNIDADMEDIDA_DOR` char(20) collate latin1_spanish_ci default NULL,
  `STOCKMINIMO_DOR` int(11) default NULL,
  `PARA_DOR` char(255) collate latin1_spanish_ci default NULL,
  `SERIAL_PRD` int(11) default NULL,
  `PRIORIDAD_PRD` char(20) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_DOR`),
  KEY `FK_ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO` (`SERIAL_ORE`),
  CONSTRAINT `FK_ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO` FOREIGN KEY (`SERIAL_ORE`) REFERENCES `ordenderequerimiento` (`SERIAL_ORE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleordenderequerimiento`
--


/*!40000 ALTER TABLE `detalleordenderequerimiento` DISABLE KEYS */;
LOCK TABLES `detalleordenderequerimiento` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleordenderequerimiento` ENABLE KEYS */;

--
-- Table structure for table `detalleordenpedido`
--

DROP TABLE IF EXISTS `detalleordenpedido`;
CREATE TABLE `detalleordenpedido` (
  `SERIAL_DORP` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `SERIAL_ORP` int(11) default NULL,
  `CANTIDAD_DORP` int(11) NOT NULL default '0',
  `PRECIOUNITARIO_DORP` decimal(12,4) NOT NULL default '0.0000',
  `ICE_DORP` decimal(16,2) default NULL,
  `DESCUENTODOLARES_DORP` decimal(16,2) default NULL,
  `DESCUENTOPORCENTAJE_DORP` decimal(5,2) default NULL,
  `VALORIVA12_DORP` decimal(16,2) NOT NULL default '0.00',
  `VALORIVA0_DORP` decimal(16,2) NOT NULL default '0.00',
  `TOTAL_DORP` decimal(16,2) NOT NULL default '0.00',
  `COMISION_DORP` decimal(16,2) NOT NULL default '0.00',
  `CANTIDADUNIDADES_DORP` int(11) default NULL,
  `CANTIDADSOLICITADA_DORP` int(11) default NULL,
  `CANTIDADDESPACHAR_DORP` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DORP`),
  KEY `FK_ORDENPEDIDODETALLEORDENPEDIDO` (`SERIAL_ORP`),
  KEY `FK_PRODUCTODETALLEORDENPEDIDO` (`SERIAL_PRD`),
  CONSTRAINT `FK_ORDENPEDIDODETALLEORDENPEDIDO` FOREIGN KEY (`SERIAL_ORP`) REFERENCES `ordenpedido` (`SERIAL_ORP`),
  CONSTRAINT `FK_PRODUCTODETALLEORDENPEDIDO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalleordenpedido`
--


/*!40000 ALTER TABLE `detalleordenpedido` DISABLE KEYS */;
LOCK TABLES `detalleordenpedido` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalleordenpedido` ENABLE KEYS */;

--
-- Table structure for table `detallerolpagos`
--

DROP TABLE IF EXISTS `detallerolpagos`;
CREATE TABLE `detallerolpagos` (
  `SERIAL_DRP` int(11) NOT NULL auto_increment,
  `SERIAL_RGR` int(11) default NULL,
  `SERIAL_ERP` int(11) default NULL,
  `VALOR_DRP` decimal(10,2) NOT NULL default '0.00',
  `CUOTA_DRP` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DRP`),
  KEY `FK_EMPLEADOROLPAGOSDETALLEROL` (`SERIAL_ERP`),
  KEY `FK_RUBROGENERALROLPAGOSDETALLEROLPAGOS` (`SERIAL_RGR`),
  CONSTRAINT `FK_EMPLEADOROLPAGOSDETALLEROL` FOREIGN KEY (`SERIAL_ERP`) REFERENCES `empleadorolpagos` (`SERIAL_ERP`),
  CONSTRAINT `FK_RUBROGENERALROLPAGOSDETALLEROLPAGOS` FOREIGN KEY (`SERIAL_RGR`) REFERENCES `rubrogeneralrolpagos` (`SERIAL_RGR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detallerolpagos`
--


/*!40000 ALTER TABLE `detallerolpagos` DISABLE KEYS */;
LOCK TABLES `detallerolpagos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detallerolpagos` ENABLE KEYS */;

--
-- Table structure for table `detallesolicituddotacion`
--

DROP TABLE IF EXISTS `detallesolicituddotacion`;
CREATE TABLE `detallesolicituddotacion` (
  `SERIAL_DSD` int(11) NOT NULL auto_increment,
  `SERIAL_SDO` int(11) default NULL,
  `DESCRIPCION_DSD` char(64) collate latin1_spanish_ci NOT NULL default '',
  `PARA_DSD` char(255) collate latin1_spanish_ci default NULL,
  `CANTIDADREQUERIDA_DSD` int(11) default NULL,
  `CANTIDADENTREGADA_DSD` int(11) default NULL,
  `SERIAL_PRD` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DSD`),
  KEY `FK_SOLICITUDDOTACIONDETALLESOLICITUD` (`SERIAL_SDO`),
  CONSTRAINT `FK_SOLICITUDDOTACIONDETALLESOLICITUD` FOREIGN KEY (`SERIAL_SDO`) REFERENCES `solicituddotacion` (`SERIAL_SDO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detallesolicituddotacion`
--


/*!40000 ALTER TABLE `detallesolicituddotacion` DISABLE KEYS */;
LOCK TABLES `detallesolicituddotacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detallesolicituddotacion` ENABLE KEYS */;

--
-- Table structure for table `detalletransporte`
--

DROP TABLE IF EXISTS `detalletransporte`;
CREATE TABLE `detalletransporte` (
  `SERIAL_DTRA` int(11) NOT NULL auto_increment,
  `SERIAL_IEB` int(11) default NULL,
  `SERIAL_COT` int(11) default NULL,
  `SERIAL_FAC` int(11) default NULL,
  `CIUDADORIGEN_DTRA` int(11) NOT NULL default '0',
  `CIUDADDESTINO_DTRA` int(11) NOT NULL default '0',
  `FECHA_DTRA` datetime NOT NULL default '0000-00-00 00:00:00',
  `VALOR_DTRA` decimal(16,2) NOT NULL default '0.00',
  `PESONETO_DTRA` decimal(16,2) default NULL,
  `ESTADO_DTRA` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_DTRA`),
  KEY `AK_SERIAL_COT_IDX` (`SERIAL_COT`),
  KEY `FK_INGRESOEGRESOBODEGADETALLETRASNPORTE` (`SERIAL_IEB`),
  CONSTRAINT `FK_INGRESOEGRESOBODEGADETALLETRASNPORTE` FOREIGN KEY (`SERIAL_IEB`) REFERENCES `ingresoegresodebodega` (`SERIAL_IEB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `detalletransporte`
--


/*!40000 ALTER TABLE `detalletransporte` DISABLE KEYS */;
LOCK TABLES `detalletransporte` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `detalletransporte` ENABLE KEYS */;

--
-- Table structure for table `diasferiados`
--

DROP TABLE IF EXISTS `diasferiados`;
CREATE TABLE `diasferiados` (
  `SERIAL_DFE` int(11) NOT NULL auto_increment,
  `NOMBRE_DFE` char(64) collate latin1_spanish_ci default NULL,
  `FECHA_DFE` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`SERIAL_DFE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `diasferiados`
--


/*!40000 ALTER TABLE `diasferiados` DISABLE KEYS */;
LOCK TABLES `diasferiados` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `diasferiados` ENABLE KEYS */;

--
-- Table structure for table `diastrabajados`
--

DROP TABLE IF EXISTS `diastrabajados`;
CREATE TABLE `diastrabajados` (
  `SERIAL_DTR` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `DIASTRABAJADOS_DTR` int(11) default NULL,
  `DESCRIPCION_DTR` char(255) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_DTR`),
  KEY `FK_EMPLEADODIASTRABAJADOS` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLDIASTRABAJADOS` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADODIASTRABAJADOS` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLDIASTRABAJADOS` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `diastrabajados`
--


/*!40000 ALTER TABLE `diastrabajados` DISABLE KEYS */;
LOCK TABLES `diastrabajados` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `diastrabajados` ENABLE KEYS */;

--
-- Table structure for table `docparaleloalumo`
--

DROP TABLE IF EXISTS `docparaleloalumo`;
CREATE TABLE `docparaleloalumo` (
  `serial_dpa` int(11) NOT NULL auto_increment,
  `serial_doc` int(11) default NULL,
  `serial_alu` int(11) default NULL,
  `numeroEntregado_dpa` int(11) default NULL,
  `legalizado_dpa` char(1) collate latin1_spanish_ci default NULL,
  `observacion_dpa` char(255) collate latin1_spanish_ci default NULL,
  `entregado_dpa` char(1) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_dpa`),
  KEY `documentosDocParaleloAlumno_FK` (`serial_doc`),
  KEY `alumnoDocParaleloAlumno_FK` (`serial_alu`),
  CONSTRAINT `docParaleloAlumo_ibfk_2` FOREIGN KEY (`serial_alu`) REFERENCES `alumno` (`serial_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `docparaleloalumo`
--


/*!40000 ALTER TABLE `docparaleloalumo` DISABLE KEYS */;
LOCK TABLES `docparaleloalumo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `docparaleloalumo` ENABLE KEYS */;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `SERIAL_EPL` int(20) NOT NULL auto_increment,
  `SERIAL_TUR` int(11) default NULL,
  `SERIAL_IFI` int(11) default NULL,
  `SERIAL_ESC` int(11) default NULL,
  `SERIAL_DESC` int(11) default NULL,
  `SERIAL_TCT` int(11) default NULL,
  `SERIAL_TER` int(11) default NULL,
  `FECHA_EPL` datetime NOT NULL default '0000-00-00 00:00:00',
  `CODIGO_EPL` char(10) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_EPL` char(60) collate latin1_spanish_ci NOT NULL default '',
  `APELLIDO_EPL` char(60) collate latin1_spanish_ci NOT NULL default '',
  `TIPOEMPLEADO_EPL` char(20) collate latin1_spanish_ci NOT NULL default '',
  `FECHANACIMIENTO_EPL` date NOT NULL default '0000-00-00',
  `CIUDAD_EPL` int(11) NOT NULL default '0',
  `PARROQUIA_EPL` int(11) default NULL,
  `DOCUMENTOIDENTIDAD_EPL` char(15) collate latin1_spanish_ci NOT NULL default '',
  `TIPODOCUMENTO_EPL` char(20) collate latin1_spanish_ci NOT NULL default '',
  `SEXO_EPL` char(10) collate latin1_spanish_ci NOT NULL default '',
  `DOCUMENTOMILITAR_EPL` char(15) collate latin1_spanish_ci default NULL,
  `ESTADOCIVIL_EPL` char(15) collate latin1_spanish_ci NOT NULL default '',
  `CARNETIESS_EPL` char(15) collate latin1_spanish_ci default NULL,
  `TELEFONOPERSONAL_EPL` char(15) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONOTRABAJO_EPL` char(15) collate latin1_spanish_ci default NULL,
  `EXTENSION_EPL` char(4) collate latin1_spanish_ci default NULL,
  `CELULAR_EPL` char(15) collate latin1_spanish_ci default NULL,
  `EMAIL_EPL` char(65) collate latin1_spanish_ci default NULL,
  `FECHAINGRESO_EPL` date NOT NULL default '0000-00-00',
  `FECHASALIDA_EPL` date default NULL,
  `ESTADOEMPLEADO_EPL` char(10) collate latin1_spanish_ci default NULL,
  `FORMACONTRATO_EPL` char(30) collate latin1_spanish_ci NOT NULL default '',
  `FECHAVENCIMIENTOCONTRATO_EPL` date default NULL,
  `COMISIONES_EPL` char(30) collate latin1_spanish_ci default NULL,
  `FOTO_EPL` char(255) collate latin1_spanish_ci default NULL,
  `CONTRATO_EPL` char(255) collate latin1_spanish_ci default NULL,
  `COPIACEDULA_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `COPIAPAPELETA_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `COPIALIBRETA_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `COPIACARNET_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `COPIATITULO_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `COPIASREFERENCIAS_EPL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `TIPOCUENTABANCO_EPL` char(30) collate latin1_spanish_ci default NULL,
  `NUMEROCUENTABANCO_EPL` char(20) collate latin1_spanish_ci default NULL,
  `PORCENTAJECOSTOACUMULADO_EPL` decimal(5,2) default NULL,
  `PORCENTAJECENTROCOSTOACUMULADO_EPL` decimal(5,2) default NULL,
  `DIASVACACIONES_EPL` int(11) default NULL,
  `ESTADO_EPL` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_EPL` int(11) default NULL,
  `MODIFICADOPOR_EPL` int(11) default NULL,
  `FECHAMODIFICACION_EPL` datetime default NULL,
  `APROBADOPOR_EPL` int(11) default NULL,
  `FECHAAPROBACION_EPL` datetime default NULL,
  `SISTEMASALARIONETO_EPL` char(2) collate latin1_spanish_ci default NULL,
  `APORTAIESS_EPL` char(2) collate latin1_spanish_ci default NULL,
  `GENERAROL_EPL` char(2) collate latin1_spanish_ci default NULL,
  `HORASMES_EPL` int(11) default NULL,
  `ASISTENCIA_EPL` char(2) collate latin1_spanish_ci default NULL,
  `CODIGOANTERIOR_EPL` char(13) collate latin1_spanish_ci default NULL,
  `DIRECCION_EPL` char(64) collate latin1_spanish_ci default NULL,
  `NUMEROCASA_EPL` char(15) collate latin1_spanish_ci default NULL,
  `TIPOLICENCIA_EPL` char(25) collate latin1_spanish_ci default NULL,
  `SUELDO_EPL` decimal(10,2) default NULL,
  `PROSPECTO_EPL` char(2) collate latin1_spanish_ci default NULL,
  `HORASDIA_EPL` double default NULL,
  `DISCAPACITADO_EPL` char(2) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_EPL`),
  KEY `AK_FECHA_EPL_IDX` (`FECHA_EPL`),
  KEY `AK_CODIGO_EPL_IDX` (`CODIGO_EPL`),
  KEY `AK_DOCUMENTOIDENTIDAD_EPL_IDX` (`DOCUMENTOIDENTIDAD_EPL`),
  KEY `FK_ESCALAFONESEMPLEADO` (`SERIAL_ESC`),
  KEY `FK_INSTITUCIONESFINANCIERASEMPLEADO` (`SERIAL_IFI`),
  KEY `FK_SUCURSALDEPARTAMENTOSEMPLEADO` (`SERIAL_DESC`),
  KEY `FK_TIPOSCONTRATOSEMPLEADO` (`SERIAL_TCT`),
  KEY `FK_TURNOSEMPLEADO` (`SERIAL_TUR`),
  CONSTRAINT `FK_ESCALAFONESEMPLEADO` FOREIGN KEY (`SERIAL_ESC`) REFERENCES `escalafones` (`SERIAL_ESC`),
  CONSTRAINT `FK_INSTITUCIONESFINANCIERASEMPLEADO` FOREIGN KEY (`SERIAL_IFI`) REFERENCES `institucionesfinancieras` (`SERIAL_IFI`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOSEMPLEADO` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`),
  CONSTRAINT `FK_TIPOSCONTRATOSEMPLEADO` FOREIGN KEY (`SERIAL_TCT`) REFERENCES `tipocontratostrabajo` (`SERIAL_TCT`),
  CONSTRAINT `FK_TURNOSEMPLEADO` FOREIGN KEY (`SERIAL_TUR`) REFERENCES `turnos` (`SERIAL_TUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `empleado`
--


/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
LOCK TABLES `empleado` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

--
-- Table structure for table `empleadorolpagos`
--

DROP TABLE IF EXISTS `empleadorolpagos`;
CREATE TABLE `empleadorolpagos` (
  `SERIAL_ERP` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `SERIAL_PERROL` int(11) default NULL,
  `FECHA_ERP` date NOT NULL default '0000-00-00',
  `NOMBRE_ERP` char(60) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_ERP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `OBSERVACION_ERP` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ERP`),
  KEY `AK_FECHAREGISTRO_RUBEMP_IDX` (`FECHA_ERP`),
  KEY `FK_EMPLEADORUBROSEMPLEADO` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLEMPLEADOROL` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADORUBROSEMPLEADO` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLEMPLEADOROL` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `empleadorolpagos`
--


/*!40000 ALTER TABLE `empleadorolpagos` DISABLE KEYS */;
LOCK TABLES `empleadorolpagos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `empleadorolpagos` ENABLE KEYS */;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `SERIAL_EMP` int(11) NOT NULL auto_increment,
  `SERIAL_PAR` int(11) default NULL,
  `CODIGO_EMP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_EMP` char(60) collate latin1_spanish_ci NOT NULL default '',
  `RUC_EMP` char(13) collate latin1_spanish_ci NOT NULL default '',
  `EMAIL_EMP` char(64) collate latin1_spanish_ci default NULL,
  `WEB_EMP` char(50) collate latin1_spanish_ci default NULL,
  `DIRECCION_EMP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONO_EMP` char(15) collate latin1_spanish_ci NOT NULL default '',
  `FAX_EMP` char(15) collate latin1_spanish_ci default NULL,
  `REPRESENTANTELEGAL_EMP` char(64) collate latin1_spanish_ci NOT NULL default '',
  `RUCCOTADOR_EMP` char(13) collate latin1_spanish_ci NOT NULL default '',
  `CONTRIBUYENTEESPECIAL_EMP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `OBLIGADO_EMP` char(2) collate latin1_spanish_ci default NULL,
  `CATEGORIA_EMP` char(40) collate latin1_spanish_ci NOT NULL default '',
  `LOGOTIPO_EMP` char(255) collate latin1_spanish_ci default NULL,
  `AUTORIZACIONSRI_EMP` char(25) collate latin1_spanish_ci default NULL,
  `VALIDOHASTA_EMP` date default NULL,
  `RESOLUCION_EMP` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_EMP`),
  KEY `AK_CODIGO_EMP_IDX` (`CODIGO_EMP`),
  KEY `FK_PARROQUIAEMPRESA` (`SERIAL_PAR`),
  CONSTRAINT `FK_PARROQUIAEMPRESA` FOREIGN KEY (`SERIAL_PAR`) REFERENCES `parroquia` (`SERIAL_PAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `empresa`
--


/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
LOCK TABLES `empresa` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

--
-- Table structure for table `escalafones`
--

DROP TABLE IF EXISTS `escalafones`;
CREATE TABLE `escalafones` (
  `SERIAL_ESC` int(11) NOT NULL auto_increment,
  `SERIAL_TES` int(11) default NULL,
  `SERIAL_CAR` int(11) default NULL,
  `SUELDO_ESC` decimal(16,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_ESC`),
  KEY `FK_CARGOSESCALAFONES` (`SERIAL_CAR`),
  KEY `FK_TIPOESCALAFONESESCALAFONES` (`SERIAL_TES`),
  CONSTRAINT `FK_CARGOSESCALAFONES` FOREIGN KEY (`SERIAL_CAR`) REFERENCES `cargos` (`SERIAL_CAR`),
  CONSTRAINT `FK_TIPOESCALAFONESESCALAFONES` FOREIGN KEY (`SERIAL_TES`) REFERENCES `tipoescalafones` (`SERIAL_TES`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `escalafones`
--


/*!40000 ALTER TABLE `escalafones` DISABLE KEYS */;
LOCK TABLES `escalafones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `escalafones` ENABLE KEYS */;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE `especialidad` (
  `serial_esp` int(11) NOT NULL auto_increment,
  `serial_cic` int(11) NOT NULL default '0',
  `nombre_esp` char(50) collate latin1_spanish_ci NOT NULL default '',
  `codigo_esp` char(15) collate latin1_spanish_ci NOT NULL default '',
  `descripcion_esp` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`serial_esp`),
  KEY `codigo_esp_idx` (`codigo_esp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `especialidad`
--


/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
LOCK TABLES `especialidad` WRITE;
INSERT INTO `especialidad` VALUES (1,3,'FILOSOFICO-SOCIALES','FS','FILOSOFICO-SOCIALES'),(2,3,'QUIMICO-BIOLOGICO','QB','QUIMICO-BIOLOGICO'),(3,3,'FISICO-MATEMATICO','FM','FISICO-MATEMATICO'),(4,1,'SIN ESPECIALIDAD','SN','SIN ESPECIALIDAD'),(5,2,'SIN ESPECIALIDAD','SN','SIN ESPECIALIDAD');
UNLOCK TABLES;
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;

--
-- Table structure for table `experienciaprofesional`
--

DROP TABLE IF EXISTS `experienciaprofesional`;
CREATE TABLE `experienciaprofesional` (
  `SERIAL_EXP` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `EMPRESA_EXP` char(40) collate latin1_spanish_ci NOT NULL default '',
  `CARGO_EXP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONO_EXP` char(12) collate latin1_spanish_ci NOT NULL default '',
  `TIPOINSTITUCION_EXP` char(25) collate latin1_spanish_ci NOT NULL default '',
  `FECHAINGRESO_EXP` date NOT NULL default '0000-00-00',
  `FECHASALIDA_EXP` date NOT NULL default '0000-00-00',
  `DESCRIPCION_EXP` char(255) collate latin1_spanish_ci default NULL,
  `AFECTAROL_EXP` char(2) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_EXP`),
  KEY `FK_EMPLEADOEXPERIENCIAPROFESIONAL` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOEXPERIENCIAPROFESIONAL` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `experienciaprofesional`
--


/*!40000 ALTER TABLE `experienciaprofesional` DISABLE KEYS */;
LOCK TABLES `experienciaprofesional` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `experienciaprofesional` ENABLE KEYS */;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `SERIAL_FAC` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `SERIAL_SDO` int(11) default NULL,
  `TIPODOCUMENTO_FAC` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NUMERODOCUMENTO_FAC` char(25) collate latin1_spanish_ci NOT NULL default '',
  `NUMERO_ORP` char(25) collate latin1_spanish_ci default NULL,
  `FECHA_FAC` datetime NOT NULL default '0000-00-00 00:00:00',
  `CLIENTE_FAC` char(80) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCION_FAC` char(255) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCIONENTREGA_FAC` char(255) collate latin1_spanish_ci NOT NULL default '',
  `DOCUMENTOIDENTIFICACION_FAC` char(20) collate latin1_spanish_ci NOT NULL default '',
  `GUIAREMISION_FAC` char(20) collate latin1_spanish_ci default NULL,
  `FECHAVENCIMIENTO_FAC` date NOT NULL default '0000-00-00',
  `VENDEDOR_FAC` int(11) NOT NULL default '0',
  `COBRADOR_FAC` int(11) NOT NULL default '0',
  `VENDEDORTELEMARKETING_FAC` char(20) collate latin1_spanish_ci default NULL,
  `DESCUENTO_FAC` decimal(16,2) default NULL,
  `TASAMORA_FAC` decimal(5,2) default NULL,
  `TEXTOTELEMARKETING_FAC` char(200) collate latin1_spanish_ci default NULL,
  `OBSERVACIONES_FAC` char(200) collate latin1_spanish_ci default NULL,
  `ORDENEGRESO_FAC` int(11) default NULL,
  `SUBTOTAL_FAC` decimal(16,2) NOT NULL default '0.00',
  `TOTALCOMISION_FAC` decimal(16,2) NOT NULL default '0.00',
  `SUMAICE_FAC` decimal(16,2) default NULL,
  `SUMAIVA12_FAC` decimal(16,2) default NULL,
  `SUMAIVA0_FAC` decimal(16,2) default NULL,
  `TOTAL_FAC` decimal(16,2) NOT NULL default '0.00',
  `ABONOS_FAC` decimal(16,2) default NULL,
  `ESTADO_FAC` char(30) collate latin1_spanish_ci NOT NULL default '',
  `ESTADOIMPRESION_FAC` char(10) collate latin1_spanish_ci default NULL,
  `COPIASIMPRESAS_FAC` int(11) default NULL,
  `ELABORADOPOR_FAC` int(11) NOT NULL default '0',
  `MODIFICADOPOR_FAC` int(11) default NULL,
  `FECHAMODIFICACION_FAC` datetime default NULL,
  `APROBADOPOR_FAC` int(11) default NULL,
  `FECHAAPROBACION_FAC` datetime default NULL,
  `FECHADESPACHO_FAC` datetime default NULL,
  `SERIAL_TIP` int(11) default NULL,
  `FECHACANCELACION_FAC` datetime default NULL,
  PRIMARY KEY  (`SERIAL_FAC`),
  KEY `AK_NUMERODOCUMENTO_FAC_IDX` (`NUMERODOCUMENTO_FAC`),
  KEY `AK_FECHA_FAC_IDX` (`FECHA_FAC`),
  KEY `FK_CLIENTEFACTURA` (`SERIAL_CLI`),
  CONSTRAINT `FK_CLIENTEFACTURA` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `factura`
--


/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
LOCK TABLES `factura` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

--
-- Table structure for table `facturacompra`
--

DROP TABLE IF EXISTS `facturacompra`;
CREATE TABLE `facturacompra` (
  `SERIAL_FACC` int(11) NOT NULL auto_increment,
  `SERIAL_IEB` int(11) default NULL,
  `NUMERODOCUMENTO_FACC` char(25) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_FACC` date NOT NULL default '0000-00-00',
  `FECHACANCELACION_FACC` date NOT NULL default '0000-00-00',
  `TIPODOCUMENTO_FACC` char(20) collate latin1_spanish_ci NOT NULL default '',
  `AUTORIZACIONSRI_FACC` char(11) collate latin1_spanish_ci NOT NULL default '',
  `FECHAAUTORIZACIONSRI_FACC` date NOT NULL default '0000-00-00',
  `SUBTOTAL_FACC` decimal(16,2) NOT NULL default '0.00',
  `DESCUENTOUSD_FACC` decimal(5,2) default NULL,
  `DESCUENTOPORCENTAJE_FACC` decimal(5,2) default NULL,
  `SUMAIVA12_FACC` decimal(16,2) NOT NULL default '0.00',
  `SUMAIVA0_FACC` decimal(16,2) NOT NULL default '0.00',
  `TOTAL_FACC` decimal(16,2) NOT NULL default '0.00',
  `ABONOS_FACC` decimal(16,2) NOT NULL default '0.00',
  `ESTADO_FACC` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_FACC` int(11) default NULL,
  `MODIFICADOPOR_FACC` int(11) default NULL,
  `FECHAMODIFICACION_FACC` date default NULL,
  `APROBADOPOR_FACC` int(11) default NULL,
  `FECHAAPROBACION_FACC` date default NULL,
  `ESTADOIMPRESION_FACC` char(10) collate latin1_spanish_ci default NULL,
  `COPIASIMPRESAS_FACC` int(11) default NULL,
  `FECHACADUCIDAD_FACC` date default NULL,
  `NUMERO_FACC` char(20) collate latin1_spanish_ci default NULL,
  `CONCEPTO_FACC` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_FACC`),
  KEY `AK_NUMERODOCUMENTO_FAC_IDX` (`NUMERODOCUMENTO_FACC`),
  KEY `AK_FECHA_FAC_IDX` (`FECHA_FACC`),
  KEY `FK_INGRESOEGRESOFACTURACOMPRA` (`SERIAL_IEB`),
  CONSTRAINT `FK_INGRESOEGRESOFACTURACOMPRA` FOREIGN KEY (`SERIAL_IEB`) REFERENCES `ingresoegresodebodega` (`SERIAL_IEB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `facturacompra`
--


/*!40000 ALTER TABLE `facturacompra` DISABLE KEYS */;
LOCK TABLES `facturacompra` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `facturacompra` ENABLE KEYS */;

--
-- Table structure for table `familiaactivofijo`
--

DROP TABLE IF EXISTS `familiaactivofijo`;
CREATE TABLE `familiaactivofijo` (
  `SERIAL_FAF` int(11) NOT NULL auto_increment,
  `SERIAL_PLC` int(11) default NULL,
  `CODIGO_FAF` char(15) collate latin1_spanish_ci default NULL,
  `NOMBRE_FAF` char(80) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_FAF`),
  KEY `AK_CODIGO_FAF_IDX` (`CODIGO_FAF`),
  KEY `FK_FAMILIAACTIVOFIJOPLANCONTABLE` (`SERIAL_PLC`),
  CONSTRAINT `FK_FAMILIAACTIVOFIJOPLANCONTABLE` FOREIGN KEY (`SERIAL_PLC`) REFERENCES `plancontable` (`SERIAL_PLC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `familiaactivofijo`
--


/*!40000 ALTER TABLE `familiaactivofijo` DISABLE KEYS */;
LOCK TABLES `familiaactivofijo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `familiaactivofijo` ENABLE KEYS */;

--
-- Table structure for table `familiaproducto`
--

DROP TABLE IF EXISTS `familiaproducto`;
CREATE TABLE `familiaproducto` (
  `SERIAL_FAP` int(11) NOT NULL auto_increment,
  `CODIGO_FAP` char(10) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_FAP` char(40) collate latin1_spanish_ci default NULL,
  `DESCRIPCION_FAP` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_FAP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `familiaproducto`
--


/*!40000 ALTER TABLE `familiaproducto` DISABLE KEYS */;
LOCK TABLES `familiaproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `familiaproducto` ENABLE KEYS */;

--
-- Table structure for table `formacionacademica`
--

DROP TABLE IF EXISTS `formacionacademica`;
CREATE TABLE `formacionacademica` (
  `SERIAL_FOA` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `FECHAINICIO_FOA` date NOT NULL default '0000-00-00',
  `DESCRIPCION_FOA` char(80) collate latin1_spanish_ci NOT NULL default '',
  `INSTITUCION_FOA` char(40) collate latin1_spanish_ci NOT NULL default '',
  `TIPOTITULO_FOA` char(10) collate latin1_spanish_ci NOT NULL default '',
  `FECHAFIN_FOA` date default NULL,
  `NIVEL_FOA` char(30) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_FOA`),
  KEY `FK_EMPLEADOFORMACIONACADEMICA` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOFORMACIONACADEMICA` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `formacionacademica`
--


/*!40000 ALTER TABLE `formacionacademica` DISABLE KEYS */;
LOCK TABLES `formacionacademica` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `formacionacademica` ENABLE KEYS */;

--
-- Table structure for table `formacobro`
--

DROP TABLE IF EXISTS `formacobro`;
CREATE TABLE `formacobro` (
  `SERIAL_FORC` int(11) NOT NULL auto_increment,
  `CODIGO_FORC` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_FORC` char(60) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_FORC` char(100) collate latin1_spanish_ci NOT NULL default '',
  `CUOTAS_FORC` char(100) collate latin1_spanish_ci NOT NULL default '',
  `COMISIONTARJETACREDITO_FORC` decimal(4,2) default NULL,
  PRIMARY KEY  (`SERIAL_FORC`),
  KEY `AK_CODIGO_FORC_IDX` (`CODIGO_FORC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `formacobro`
--


/*!40000 ALTER TABLE `formacobro` DISABLE KEYS */;
LOCK TABLES `formacobro` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `formacobro` ENABLE KEYS */;

--
-- Table structure for table `formaspago`
--

DROP TABLE IF EXISTS `formaspago`;
CREATE TABLE `formaspago` (
  `SERIAL_FORP` int(11) NOT NULL auto_increment,
  `CODIGO_FORP` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_FORP` char(40) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_FORP` char(50) collate latin1_spanish_ci NOT NULL default '',
  `CUOTAS_FORP` int(11) NOT NULL default '0',
  `DESDEINGRESO_FORP` char(20) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_FORP`),
  KEY `AK_CODIGO_FORP_IDX` (`CODIGO_FORP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `formaspago`
--


/*!40000 ALTER TABLE `formaspago` DISABLE KEYS */;
LOCK TABLES `formaspago` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `formaspago` ENABLE KEYS */;

--
-- Table structure for table `formulas`
--

DROP TABLE IF EXISTS `formulas`;
CREATE TABLE `formulas` (
  `SERIAL_FRM` int(11) NOT NULL auto_increment,
  `NOMBRE_FRM` char(64) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_FRM` char(255) collate latin1_spanish_ci default NULL,
  `FORMULA_FRM` char(255) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_FRM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `formulas`
--


/*!40000 ALTER TABLE `formulas` DISABLE KEYS */;
LOCK TABLES `formulas` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `formulas` ENABLE KEYS */;

--
-- Table structure for table `garantiasactivosfijos`
--

DROP TABLE IF EXISTS `garantiasactivosfijos`;
CREATE TABLE `garantiasactivosfijos` (
  `SERIAL_GAF` int(11) NOT NULL auto_increment,
  `SERIAL_ACF` int(11) default NULL,
  `NOMBRE_GAF` char(50) collate latin1_spanish_ci default NULL,
  `UNIDADMEDIDA_GAF` char(25) collate latin1_spanish_ci default NULL,
  `VALOR_GAF` decimal(6,2) default NULL,
  `EMISOR_GAF` char(60) collate latin1_spanish_ci default NULL,
  `NOMBRECONTACTO_GAF` char(25) collate latin1_spanish_ci default NULL,
  `APELLIDOCONTACTO_GAF` char(25) collate latin1_spanish_ci default NULL,
  `EMAILCONTACTO_GAF` char(64) collate latin1_spanish_ci default NULL,
  `DIRECCION_GAF` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONO_GAF` char(15) collate latin1_spanish_ci default NULL,
  `DESDE_GAF` date default NULL,
  `HASTA_GAF` date default NULL,
  `CANTIDAD_GAF` decimal(5,2) default NULL,
  `UNIDADMEDIDA2_GAF` char(25) collate latin1_spanish_ci default NULL,
  `CANTIDAD2_GAF` decimal(5,2) default NULL,
  PRIMARY KEY  (`SERIAL_GAF`),
  KEY `FK_ACTIVOSFIJOSGARANTIASACTIVOSFIJOS` (`SERIAL_ACF`),
  CONSTRAINT `FK_ACTIVOSFIJOSGARANTIASACTIVOSFIJOS` FOREIGN KEY (`SERIAL_ACF`) REFERENCES `activosfijos` (`SERIAL_ACF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `garantiasactivosfijos`
--


/*!40000 ALTER TABLE `garantiasactivosfijos` DISABLE KEYS */;
LOCK TABLES `garantiasactivosfijos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `garantiasactivosfijos` ENABLE KEYS */;

--
-- Table structure for table `guiaremision`
--

DROP TABLE IF EXISTS `guiaremision`;
CREATE TABLE `guiaremision` (
  `SERIAL_GUIA` int(11) NOT NULL auto_increment,
  `SERIAL_SDO` int(11) default NULL,
  `TIPODOCUMENTO_GUIA` char(25) collate latin1_spanish_ci NOT NULL default '',
  `NUMERODOCUMENTO_GUIA` char(25) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_GUIA` datetime NOT NULL default '0000-00-00 00:00:00',
  `FECHATERMINACION_GUIA` date NOT NULL default '0000-00-00',
  `CLIENTE_GUIA` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCION_GUIA` char(255) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCIONDESTINO_GUIA` char(255) collate latin1_spanish_ci NOT NULL default '',
  `DOCUMENTOIDENTIFICACION_GUIA` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRETRANSPORTISTA_GUIA` int(11) default NULL,
  `IDENTIFICACIONREMITENTE_GUIA` char(80) collate latin1_spanish_ci default NULL,
  `OBSERVACIONES_GUIA` char(200) collate latin1_spanish_ci default NULL,
  `FECHADESPACHO_GUIA` datetime default NULL,
  `TEXTOTELEMARKETING_GUIA` char(200) collate latin1_spanish_ci default NULL,
  `ESTADOIMPRESION_GUIA` char(10) collate latin1_spanish_ci default NULL,
  `COPIASIMPRESAS_GUIA` char(20) collate latin1_spanish_ci default NULL,
  `ESTADO_GUIA` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_GUIA` int(11) NOT NULL default '0',
  `MODIFICADOPOR_GUIA` int(11) default NULL,
  `FECHAMODIFICACION_GUIA` datetime default NULL,
  `APROBADOPOR_GUIA` int(11) default NULL,
  `FECHAAPROBACION_GUIA` datetime default NULL,
  PRIMARY KEY  (`SERIAL_GUIA`),
  KEY `AK_NUMERODOCUMENTO_GUIA_IDX` (`NUMERODOCUMENTO_GUIA`),
  KEY `AK_FECHA_GUIA_IDX` (`FECHA_GUIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `guiaremision`
--


/*!40000 ALTER TABLE `guiaremision` DISABLE KEYS */;
LOCK TABLES `guiaremision` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `guiaremision` ENABLE KEYS */;

--
-- Table structure for table `historialcreditocliente`
--

DROP TABLE IF EXISTS `historialcreditocliente`;
CREATE TABLE `historialcreditocliente` (
  `SERIAL_HCC` int(11) NOT NULL auto_increment,
  `SERIAL_CLI` int(11) default NULL,
  `FECHA_HCC` date NOT NULL default '0000-00-00',
  `SALDOPORCOBRARNOVENCIDO_HCC` decimal(16,2) default NULL,
  `SALDOPORCOBRARVENCIDO_HCC` decimal(16,2) default NULL,
  `CARTERATOTAL_HCC` decimal(16,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_HCC`),
  KEY `FK_CLIENTEHISTORIALCREDITOCLIENTE` (`SERIAL_CLI`),
  CONSTRAINT `FK_CLIENTEHISTORIALCREDITOCLIENTE` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `historialcreditocliente`
--


/*!40000 ALTER TABLE `historialcreditocliente` DISABLE KEYS */;
LOCK TABLES `historialcreditocliente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `historialcreditocliente` ENABLE KEYS */;

--
-- Table structure for table `horasextra`
--

DROP TABLE IF EXISTS `horasextra`;
CREATE TABLE `horasextra` (
  `SERIAL_HEX` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `SERIAL_PERROL` int(11) default NULL,
  `HORA_HEX` decimal(16,2) default NULL,
  `PORCENTAJE_HEX` int(11) NOT NULL default '0',
  `FECHA_HEX` date default NULL,
  `OBSERVACION_HEX` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_HEX`),
  KEY `AK_FECHA_HEX_IDX` (`FECHA_HEX`),
  KEY `FK_EMPLEADOHORAEXTRA` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLHORAEXTRA` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADOHORAEXTRA` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLHORAEXTRA` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `horasextra`
--


/*!40000 ALTER TABLE `horasextra` DISABLE KEYS */;
LOCK TABLES `horasextra` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `horasextra` ENABLE KEYS */;

--
-- Table structure for table `impuestos`
--

DROP TABLE IF EXISTS `impuestos`;
CREATE TABLE `impuestos` (
  `SERIAL_IMP` int(11) NOT NULL auto_increment,
  `CODIGO_IMP` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_IMP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_IMP` char(6) collate latin1_spanish_ci NOT NULL default '',
  `IMPONIBLE_IMP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `SRI_IMP` char(4) collate latin1_spanish_ci NOT NULL default '',
  `VALOR_IMP` decimal(20,2) NOT NULL default '0.00',
  `PORCENTAJE_IMP` char(2) collate latin1_spanish_ci NOT NULL default '',
  `DESDE_IMP` date NOT NULL default '0000-00-00',
  `HASTA_IMP` date default NULL,
  `ESTADO_IMP` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_IMP`),
  KEY `AK_CODIGO_IMP_IDX` (`CODIGO_IMP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `impuestos`
--


/*!40000 ALTER TABLE `impuestos` DISABLE KEYS */;
LOCK TABLES `impuestos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `impuestos` ENABLE KEYS */;

--
-- Table structure for table `ingresoegresodebodega`
--

DROP TABLE IF EXISTS `ingresoegresodebodega`;
CREATE TABLE `ingresoegresodebodega` (
  `SERIAL_IEB` int(11) NOT NULL auto_increment,
  `SERIAL_TIB` int(11) default NULL,
  `NUMERODOCUMENTO_IEB` int(11) NOT NULL default '0',
  `FECHA_IEB` date NOT NULL default '0000-00-00',
  `TIPODOCUMENTOGENERA_IEB` char(20) collate latin1_spanish_ci default NULL,
  `NUMERODOCUMENTOGENERA_IEB` char(25) collate latin1_spanish_ci default NULL,
  `BODEGAORIGEN_IEB` int(11) default NULL,
  `BODEGADESTINO_IEB` int(11) default NULL,
  `NUMEROFACTURA_IEB` char(20) collate latin1_spanish_ci default NULL,
  `AUTORIZACIONSRI_IEB` char(20) collate latin1_spanish_ci default NULL,
  `FECHAAUTORIZACIONSRI_IEB` date default NULL,
  `PROVEEDORTRANSPORTE_IEB` int(11) default NULL,
  `ESTADO_IEB` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_IEB` int(11) default NULL,
  `MODIFICADOPOR_IEB` int(11) default NULL,
  `FECHAMODIFICACION_IEB` date default NULL,
  `APROBADOPOR_IEB` int(11) default NULL,
  `FECHAAPROBACION_IEB` date default NULL,
  `TRANSFERENCIA_IEB` int(11) default NULL,
  `SERIAL_ORP` int(11) default NULL,
  `FECHACADUCIDAD_IEB` date default NULL,
  `PROVEEDOR_IEB` int(11) default NULL,
  `OBSERVACIONES_IEB` char(255) collate latin1_spanish_ci default NULL,
  `LOTE_IEB` int(11) default NULL,
  `SERIAL_ODC` int(11) default NULL,
  `TOTAL_IEB` decimal(16,4) default NULL,
  `CLIENTE_IEB` int(11) default NULL,
  `SERIAL_FAC` int(11) default NULL,
  `SERIAL_FACC` int(11) default NULL,
  `MONTODEVUELTO_IEB` decimal(16,4) default NULL,
  PRIMARY KEY  (`SERIAL_IEB`),
  KEY `AK_NUMERODOCUMENTO_IEB_IDX` (`NUMERODOCUMENTO_IEB`),
  KEY `AK_FECHA_IEB_IDX` (`FECHA_IEB`),
  KEY `FK_TIPOINGRESOEGRESOINGRESOEGRESOBODEGA` (`SERIAL_TIB`),
  CONSTRAINT `FK_TIPOINGRESOEGRESOINGRESOEGRESOBODEGA` FOREIGN KEY (`SERIAL_TIB`) REFERENCES `tipoingresoegresobodega` (`SERIAL_TIB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ingresoegresodebodega`
--


/*!40000 ALTER TABLE `ingresoegresodebodega` DISABLE KEYS */;
LOCK TABLES `ingresoegresodebodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ingresoegresodebodega` ENABLE KEYS */;

--
-- Table structure for table `institucionesfinancieras`
--

DROP TABLE IF EXISTS `institucionesfinancieras`;
CREATE TABLE `institucionesfinancieras` (
  `SERIAL_IFI` int(11) NOT NULL auto_increment,
  `SERIAL_CIU` int(11) default NULL,
  `CODIGO_IFI` char(10) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_IFI` char(100) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_IFI` char(30) collate latin1_spanish_ci default NULL,
  `SUCURSAL_IFI` char(40) collate latin1_spanish_ci default NULL,
  `DIRECCION_IFI` char(64) collate latin1_spanish_ci default NULL,
  `TELEFONO1_IFI` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONO2_IFI` char(20) collate latin1_spanish_ci default NULL,
  `FAX_IFI` char(20) collate latin1_spanish_ci default NULL,
  `OFICIALCREDITO_IFI` char(40) collate latin1_spanish_ci default NULL,
  `OCTELEFONO_IFI` char(20) collate latin1_spanish_ci default NULL,
  `OCEMAIL_IFI` char(64) collate latin1_spanish_ci default NULL,
  `OCSOBRENOMBRE_IFI` char(30) collate latin1_spanish_ci default NULL,
  `OCANIVERSARIO_IFI` date default NULL,
  `GERENTE_IFI` char(40) collate latin1_spanish_ci default NULL,
  `GTELEFONO_IFI` char(20) collate latin1_spanish_ci default NULL,
  `GEMAIL_IFI` char(64) collate latin1_spanish_ci default NULL,
  `GSOBRENOMBRE_IFI` char(30) collate latin1_spanish_ci default NULL,
  `GANIVERSARIO_IFI` date default NULL,
  `ESTADO_IFI` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_IFI`),
  KEY `AK_CODIGO_IFI_IDX` (`CODIGO_IFI`),
  KEY `FK_CIUDADINSTITUCIONFINANCIERA` (`SERIAL_CIU`),
  CONSTRAINT `FK_CIUDADINSTITUCIONFINANCIERA` FOREIGN KEY (`SERIAL_CIU`) REFERENCES `ciudad` (`SERIAL_CIU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `institucionesfinancieras`
--


/*!40000 ALTER TABLE `institucionesfinancieras` DISABLE KEYS */;
LOCK TABLES `institucionesfinancieras` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `institucionesfinancieras` ENABLE KEYS */;

--
-- Table structure for table `jerarquia`
--

DROP TABLE IF EXISTS `jerarquia`;
CREATE TABLE `jerarquia` (
  `SERIAL_JER` int(11) NOT NULL auto_increment,
  `CODIGO_JER` char(3) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_JER` char(25) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_JER`),
  KEY `AK_CODIGO_JER_IDX` (`CODIGO_JER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `jerarquia`
--


/*!40000 ALTER TABLE `jerarquia` DISABLE KEYS */;
LOCK TABLES `jerarquia` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `jerarquia` ENABLE KEYS */;

--
-- Table structure for table `jubilacionpatronal`
--

DROP TABLE IF EXISTS `jubilacionpatronal`;
CREATE TABLE `jubilacionpatronal` (
  `SERIAL_JUB` int(11) NOT NULL auto_increment,
  `CODIGO_JUB` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRECOEFICIENTE_JUB` char(40) collate latin1_spanish_ci NOT NULL default '',
  `EDAD_JUB` int(11) NOT NULL default '0',
  `DESDEANIO_JUB` int(11) NOT NULL default '0',
  `HASTAANIO_JUB` int(11) NOT NULL default '0',
  `CANTIDADBENEFICIO_JUB` decimal(16,2) NOT NULL default '0.00',
  `COEFICIENTE_JUB` decimal(16,6) NOT NULL default '0.000000',
  `VIGENTEHASTA_JUB` date default NULL,
  `ESTADO_JUB` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_JUB`),
  KEY `AK_CODIGO_JUB_IDX` (`CODIGO_JUB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `jubilacionpatronal`
--


/*!40000 ALTER TABLE `jubilacionpatronal` DISABLE KEYS */;
LOCK TABLES `jubilacionpatronal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `jubilacionpatronal` ENABLE KEYS */;

--
-- Table structure for table `liberacionproducto`
--

DROP TABLE IF EXISTS `liberacionproducto`;
CREATE TABLE `liberacionproducto` (
  `SERIAL_LPR` int(11) NOT NULL auto_increment,
  `CODIGO_LPR` char(10) collate latin1_spanish_ci NOT NULL default '',
  `EVENTO_LPR` char(40) collate latin1_spanish_ci default NULL,
  `LECTURA1_LPR` char(10) collate latin1_spanish_ci default NULL,
  `LECTURA2_LPR` char(10) collate latin1_spanish_ci default NULL,
  `LECTURA3_LPR` char(10) collate latin1_spanish_ci default NULL,
  `PH_LPR` decimal(5,2) default NULL,
  `OBSERVACIONES_LPR` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_LPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `liberacionproducto`
--


/*!40000 ALTER TABLE `liberacionproducto` DISABLE KEYS */;
LOCK TABLES `liberacionproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `liberacionproducto` ENABLE KEYS */;

--
-- Table structure for table `listaprecios`
--

DROP TABLE IF EXISTS `listaprecios`;
CREATE TABLE `listaprecios` (
  `SERIAL_LPR` int(11) NOT NULL auto_increment,
  `SERIAL_TPR` int(11) default NULL,
  `SERIAL_PRD` int(11) default NULL,
  `VALOR_LPR` decimal(16,6) NOT NULL default '0.000000',
  PRIMARY KEY  (`SERIAL_LPR`),
  KEY `FK_LISTAPRECIOSPRODUCTO` (`SERIAL_PRD`),
  KEY `FK_TIPOSPRECIOSLISTAPRECIOS` (`SERIAL_TPR`),
  CONSTRAINT `FK_LISTAPRECIOSPRODUCTO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`),
  CONSTRAINT `FK_TIPOSPRECIOSLISTAPRECIOS` FOREIGN KEY (`SERIAL_TPR`) REFERENCES `tiposprecios` (`SERIAL_TPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `listaprecios`
--


/*!40000 ALTER TABLE `listaprecios` DISABLE KEYS */;
LOCK TABLES `listaprecios` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `listaprecios` ENABLE KEYS */;

--
-- Table structure for table `marcaproducto`
--

DROP TABLE IF EXISTS `marcaproducto`;
CREATE TABLE `marcaproducto` (
  `SERIAL_MPR` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `CODIGO_MPR` char(15) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_MPR` char(64) collate latin1_spanish_ci NOT NULL default '',
  `FABRICANTE_MPR` char(64) collate latin1_spanish_ci default NULL,
  `OBSERVACIONES_MPR` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_MPR`),
  KEY `FK_PRODUCTOMARCAPRODUCTO` (`SERIAL_PRD`),
  CONSTRAINT `FK_PRODUCTOMARCAPRODUCTO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `marcaproducto`
--


/*!40000 ALTER TABLE `marcaproducto` DISABLE KEYS */;
LOCK TABLES `marcaproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `marcaproducto` ENABLE KEYS */;

--
-- Table structure for table `materia_alumno`
--

DROP TABLE IF EXISTS `materia_alumno`;
CREATE TABLE `materia_alumno` (
  `serial_matalu` int(11) NOT NULL auto_increment,
  `serial_alu` int(11) NOT NULL default '0',
  `serial_matpro` int(11) default NULL,
  `total_matalu` double default NULL,
  `nmin_matalu` double default NULL,
  `aproba_matalu` char(1) collate latin1_spanish_ci default NULL,
  `disc_matalu` double default NULL,
  `supletorio_matalu` double default NULL,
  `nfinal_matalu` double default NULL,
  `examenGrado_matalu` double default NULL,
  `finjust_matalu` int(11) default NULL,
  `fjust_matalu` int(11) default NULL,
  `atraso_matalu` int(11) default NULL,
  PRIMARY KEY  (`serial_matalu`),
  KEY `FK_materia_alumno_alumno_FK` (`serial_alu`),
  KEY `FK_materia_alumno_materia_profesor_FK` (`serial_matpro`),
  CONSTRAINT `materia_alumno_ibfk_1` FOREIGN KEY (`serial_alu`) REFERENCES `alumno` (`serial_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `materia_alumno`
--


/*!40000 ALTER TABLE `materia_alumno` DISABLE KEYS */;
LOCK TABLES `materia_alumno` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `materia_alumno` ENABLE KEYS */;

--
-- Table structure for table `materia_criterio`
--

DROP TABLE IF EXISTS `materia_criterio`;
CREATE TABLE `materia_criterio` (
  `serial_matcri` int(11) NOT NULL auto_increment,
  `serial_cri` int(11) NOT NULL default '0',
  `serial_matalu` int(11) NOT NULL default '0',
  `nota_matcri` float default NULL,
  PRIMARY KEY  (`serial_matcri`),
  KEY `FK_materia_criterio_criterio_FK` (`serial_cri`),
  KEY `FK_materia_criterio_materia_alumno_FK` (`serial_matalu`),
  CONSTRAINT `materia_criterio_ibfk_1` FOREIGN KEY (`serial_cri`) REFERENCES `criterio` (`serial_cri`),
  CONSTRAINT `materia_criterio_ibfk_2` FOREIGN KEY (`serial_matalu`) REFERENCES `materia_alumno` (`serial_matalu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `materia_criterio`
--


/*!40000 ALTER TABLE `materia_criterio` DISABLE KEYS */;
LOCK TABLES `materia_criterio` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `materia_criterio` ENABLE KEYS */;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `SERIAL_MOD` int(11) NOT NULL auto_increment,
  `CODIGO_MOD` char(6) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_MOD` char(50) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_MOD`),
  KEY `AK_CODIGO_MOD_IDX` (`CODIGO_MOD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `modulos`
--


/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
LOCK TABLES `modulos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
CREATE TABLE `nivel` (
  `serial_niv` int(11) NOT NULL auto_increment,
  `serial_sec` int(11) NOT NULL default '0',
  `serial_esp` int(11) default NULL,
  `codigo_niv` char(15) collate latin1_spanish_ci default NULL,
  `nombre_niv` char(30) collate latin1_spanish_ci NOT NULL default '',
  `nivel_niv` char(50) collate latin1_spanish_ci default NULL,
  `ultimo_niv` char(1) collate latin1_spanish_ci default NULL,
  `ciclo_niv` char(255) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`serial_niv`),
  KEY `FK_nivel_seccion_FK` (`serial_sec`),
  KEY `ultimo_niv_idx` (`ultimo_niv`),
  KEY `FK_nivel_especialidad_FK` (`serial_esp`),
  KEY `codigo_niv_idx` (`codigo_niv`),
  CONSTRAINT `nivel_ibfk_1` FOREIGN KEY (`serial_esp`) REFERENCES `especialidad` (`serial_esp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `nivel`
--


/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
LOCK TABLES `nivel` WRITE;
INSERT INTO `nivel` VALUES (1,3,4,'OB','OCTAVO DE BASICA','BASICA','N','N'),(2,3,4,'NB','NOVENO DE BASICA','BASICA','N','N'),(3,3,5,'DB','DECIMO DE BASICA','BASICA','N','N'),(4,3,5,'PB','PRIMERO DE BACHILLERATO','BACHILLERATO','N','N'),(5,3,1,'SBFS','SEGUNDO DE BACHILLERATO SOCIAL','BACHILLERATO','N','N'),(6,3,2,'SBQB','SEGUNDO DE BACHILLERATO QUIMIC','BACHILLERATO','N','N'),(7,3,3,'SBFM','SEGUNDO DE BACJILLERATO FISICO','BACHILLERATO','N','N'),(8,3,1,'TBFS','TERCERO DE BACHILLERATO SOCIAL','BACHILLERATO','S','N'),(9,3,2,'TBQB','TERCERO DE BACHILLERATO QUIMIC','BACHILLERATO','S','N'),(10,3,3,'TBFM','TERCERO DE BACJILLERATO FISICO','BACHILLERATO','S','N');
UNLOCK TABLES;
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;

--
-- Table structure for table `nivelcalificacion`
--

DROP TABLE IF EXISTS `nivelcalificacion`;
CREATE TABLE `nivelcalificacion` (
  `SERIAL_NIVC` int(11) NOT NULL auto_increment,
  `CODIGONIVEL_NIVC` char(3) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_NIVC` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DESDE_NIVC` int(11) NOT NULL default '0',
  `HASTA_NIVC` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_NIVC`),
  KEY `AK_CODIGONIVEL_NIVC_IDX` (`CODIGONIVEL_NIVC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `nivelcalificacion`
--


/*!40000 ALTER TABLE `nivelcalificacion` DISABLE KEYS */;
LOCK TABLES `nivelcalificacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `nivelcalificacion` ENABLE KEYS */;

--
-- Table structure for table `nivelcalificacionproveedor`
--

DROP TABLE IF EXISTS `nivelcalificacionproveedor`;
CREATE TABLE `nivelcalificacionproveedor` (
  `SERIAL_NIVCP` int(11) NOT NULL auto_increment,
  `CODIGONIVEL_NIVCP` char(3) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_NIVCP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DESDE_NIVCP` int(11) NOT NULL default '0',
  `HASTA_NIVCP` int(11) NOT NULL default '0',
  PRIMARY KEY  (`SERIAL_NIVCP`),
  KEY `AK_CODIGONIVEL_NIVCP_IDX` (`CODIGONIVEL_NIVCP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `nivelcalificacionproveedor`
--


/*!40000 ALTER TABLE `nivelcalificacionproveedor` DISABLE KEYS */;
LOCK TABLES `nivelcalificacionproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `nivelcalificacionproveedor` ENABLE KEYS */;

--
-- Table structure for table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
CREATE TABLE `novedades` (
  `SERIAL_NOV` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `FECHA_NOV` date NOT NULL default '0000-00-00',
  `ESTADO_NOV` char(1) collate latin1_spanish_ci NOT NULL default '',
  `CODIGO_NOV` char(15) collate latin1_spanish_ci NOT NULL default '',
  `MOTIVO_NOV` char(255) collate latin1_spanish_ci default NULL,
  `DESCRIPCION_NOV` char(255) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_NOV`),
  KEY `AK_FECHA_NOV_IDX` (`FECHA_NOV`),
  KEY `AK_CODIGO_NOV_IDX` (`CODIGO_NOV`),
  KEY `FK_EMPLEADONOVEDADES` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLNOVEDADES` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADONOVEDADES` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLNOVEDADES` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `novedades`
--


/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
LOCK TABLES `novedades` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;

--
-- Table structure for table `ordendecompra`
--

DROP TABLE IF EXISTS `ordendecompra`;
CREATE TABLE `ordendecompra` (
  `SERIAL_ODC` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `SERIAL_FORP` int(11) default NULL,
  `NUMERODOCUMENTO_ODC` int(11) NOT NULL default '0',
  `TIPOORDENCOMPRA_ODC` char(20) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_ODC` date NOT NULL default '0000-00-00',
  `TOTAL_ODC` decimal(16,2) NOT NULL default '0.00',
  `FECHAENTREGA_ODC` date NOT NULL default '0000-00-00',
  `OBSERVACIONES_ODC` char(200) collate latin1_spanish_ci default NULL,
  `ESTADO_ODC` char(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_ODC` int(11) default NULL,
  `MODIFICADOPOR_ODC` int(11) default NULL,
  `FECHAMODIFICACION_ODC` date default NULL,
  `APROBADOPOR_ODC` int(11) default NULL,
  `FECHAAPROBACION_ODC` date default NULL,
  `PLAZODIAS_ODC` int(11) default NULL,
  `FECHAINICIO_ODC` date default NULL,
  `FECHAFIN_ODC` date default NULL,
  `DIASREPOSICION_ODC` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_ODC`),
  KEY `AK_NUMERODOCUMENTO_ODC_IDX` (`NUMERODOCUMENTO_ODC`),
  KEY `AK_FECHA_ODC_IDX` (`FECHA_ODC`),
  KEY `FK_FORMASPAGOORDENDECOMPRA` (`SERIAL_FORP`),
  KEY `FK_PROVEEDORORDENCOMPRA` (`SERIAL_PVD`),
  CONSTRAINT `FK_FORMASPAGOORDENDECOMPRA` FOREIGN KEY (`SERIAL_FORP`) REFERENCES `formaspago` (`SERIAL_FORP`),
  CONSTRAINT `FK_PROVEEDORORDENCOMPRA` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ordendecompra`
--


/*!40000 ALTER TABLE `ordendecompra` DISABLE KEYS */;
LOCK TABLES `ordendecompra` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ordendecompra` ENABLE KEYS */;

--
-- Table structure for table `ordenderequerimiento`
--

DROP TABLE IF EXISTS `ordenderequerimiento`;
CREATE TABLE `ordenderequerimiento` (
  `SERIAL_ORE` int(11) NOT NULL auto_increment,
  `SERIAL_ARE` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `FECHA_ORE` date NOT NULL default '0000-00-00',
  `CODIGO_ORE` char(12) collate latin1_spanish_ci NOT NULL default '',
  `NUMERO_ORE` char(10) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_ORE` char(15) collate latin1_spanish_ci default NULL,
  `NECESIDAD_ORE` char(20) collate latin1_spanish_ci default NULL,
  `PROVEEDOR1_ORE` int(11) default NULL,
  `PROVEEDOR2_ORE` int(11) default NULL,
  `PROVEEDOR3_ORE` int(11) default NULL,
  `APROBADOPOR_ORE` int(11) default NULL,
  `RECIBIDOPOR_ORE` int(11) default NULL,
  `ENTREGADOA_ORE` int(11) default NULL,
  `FECHAAPROBACION_ORE` date default NULL,
  `FECHARECEPCION_ORE` date default NULL,
  `FECHAENTREGA_ORE` date default NULL,
  `ESTADO_ORE` char(20) collate latin1_spanish_ci default NULL,
  `OBSERVACION_ORE` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ORE`),
  KEY `FK_AREAORDENDEREQUERIMIENTO` (`SERIAL_ARE`),
  KEY `FK_EMPLEADOORDENDEREQUERIMIENTO` (`SERIAL_EPL`),
  CONSTRAINT `FK_AREAORDENDEREQUERIMIENTO` FOREIGN KEY (`SERIAL_ARE`) REFERENCES `area` (`SERIAL_ARE`),
  CONSTRAINT `FK_EMPLEADOORDENDEREQUERIMIENTO` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ordenderequerimiento`
--


/*!40000 ALTER TABLE `ordenderequerimiento` DISABLE KEYS */;
LOCK TABLES `ordenderequerimiento` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ordenderequerimiento` ENABLE KEYS */;

--
-- Table structure for table `ordenesembarque`
--

DROP TABLE IF EXISTS `ordenesembarque`;
CREATE TABLE `ordenesembarque` (
  `SERIAL_ODE` int(11) NOT NULL auto_increment,
  `NUMERODOCUMENTO_ODE` char(15) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_ODE` date default NULL,
  `TIPODESPACHO_ODE` char(20) collate latin1_spanish_ci default NULL,
  `FECHAHORADESPACHO_ODE` datetime default NULL,
  `PROVEEDORTRANSPORTE_ODE` int(11) default NULL,
  `BODEGA_ODE` int(11) default NULL,
  `ESTADO_ODE` char(15) collate latin1_spanish_ci default NULL,
  `ELABORADOPOR_ODE` int(11) default NULL,
  `MODIFICADOPOR_ODE` int(11) default NULL,
  `FECHAMODIFICACION_ODE` date default NULL,
  `APROBADOPOR_ODE` int(11) default NULL,
  `FECHAAPROBACION_ODE` date default NULL,
  PRIMARY KEY  (`SERIAL_ODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ordenesembarque`
--


/*!40000 ALTER TABLE `ordenesembarque` DISABLE KEYS */;
LOCK TABLES `ordenesembarque` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ordenesembarque` ENABLE KEYS */;

--
-- Table structure for table `ordenpedido`
--

DROP TABLE IF EXISTS `ordenpedido`;
CREATE TABLE `ordenpedido` (
  `SERIAL_ORP` int(11) NOT NULL auto_increment,
  `SERIAL_FORC` int(11) default NULL,
  `SERIAL_CLI` int(11) default NULL,
  `NUMERO_ORP` char(25) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_ORP` date NOT NULL default '0000-00-00',
  `ORDENCLIENTE_ORP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCIONENTREGA_ORP` char(80) collate latin1_spanish_ci NOT NULL default '',
  `FECHAVENCIMIENTO_ORP` date NOT NULL default '0000-00-00',
  `VENDEDOR_ORP` int(11) NOT NULL default '0',
  `COBRADOR_ORP` int(11) NOT NULL default '0',
  `SUBTOTAL_ORP` decimal(16,2) default NULL,
  `SUMAICE_ORP` decimal(16,2) default NULL,
  `SUMAIVA12_ORP` decimal(16,2) default NULL,
  `SUMAIVA0_ORP` decimal(16,2) default NULL,
  `TOTAL_ORP` char(20) collate latin1_spanish_ci NOT NULL default '',
  `DESCUENTO_ORP` decimal(16,2) default NULL,
  `TOTALCOMISION_ORP` decimal(16,2) default NULL,
  `TASAMORA_ORP` decimal(5,2) default NULL,
  `ESTADO_ORP` char(10) collate latin1_spanish_ci NOT NULL default '',
  `OBSERVACIONES_ORP` char(200) collate latin1_spanish_ci default NULL,
  `ELABORADOPOR_ORP` int(11) default NULL,
  `MODIFICADOPOR_ORP` int(11) default NULL,
  `APROBADOPOR_ORP` int(11) default NULL,
  `FECHAMODIFICACION_ORP` date default NULL,
  `FECHAAPROBACION_ORP` date default NULL,
  `CEDULA_ORP` char(13) collate latin1_spanish_ci default NULL,
  `NOMBRE_ORP` char(64) collate latin1_spanish_ci default NULL,
  `NUMEROFACTURA_ORP` char(15) collate latin1_spanish_ci default NULL,
  `FECHAPAGO_ORP` date default NULL,
  PRIMARY KEY  (`SERIAL_ORP`),
  KEY `AK_NUMERODOCUMENTO_ORP_IDX` (`NUMERO_ORP`),
  KEY `AK_FECHA_ORP_IDX` (`FECHA_ORP`),
  KEY `FK_CLIENTEORDENPEDIDO` (`SERIAL_CLI`),
  KEY `FK_FORMACOBROORDENPEDIDO` (`SERIAL_FORC`),
  CONSTRAINT `FK_CLIENTEORDENPEDIDO` FOREIGN KEY (`SERIAL_CLI`) REFERENCES `cliente` (`SERIAL_CLI`),
  CONSTRAINT `FK_FORMACOBROORDENPEDIDO` FOREIGN KEY (`SERIAL_FORC`) REFERENCES `formacobro` (`SERIAL_FORC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ordenpedido`
--


/*!40000 ALTER TABLE `ordenpedido` DISABLE KEYS */;
LOCK TABLES `ordenpedido` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ordenpedido` ENABLE KEYS */;

--
-- Table structure for table `padres`
--

DROP TABLE IF EXISTS `padres`;
CREATE TABLE `padres` (
  `serial_pad` int(11) NOT NULL auto_increment,
  `serial_emp` int(11) default NULL,
  `serial_nac` int(11) default NULL,
  `serial_can` int(11) default NULL,
  `serial_pai` int(11) default NULL,
  `serial_eci` int(11) default NULL,
  `serial_cpr` int(11) default NULL,
  `nombre_pad` char(30) NOT NULL default '',
  `apellido_pad` char(30) NOT NULL default '',
  `tipoIdentificacion_pad` char(1) default NULL,
  `codigoIdentificacion_pad` char(50) default NULL,
  `fechaNacimiento_pad` date default NULL,
  `celular_pad` char(15) default NULL,
  `proveedor_pad` char(2) default NULL,
  `telefono_pad` char(15) default NULL,
  `cargo_pad` char(255) default NULL,
  `mail_pad` char(80) default NULL,
  `sueldo_pad` decimal(16,2) default NULL,
  `tipoVehiculo_pad` char(255) default NULL,
  `anioVehiculo_pad` int(11) default NULL,
  `avaluoVehiculo_pad` decimal(16,2) default NULL,
  `referenciaBan1_pad` char(255) default NULL,
  `referenciaBan2_pad` char(255) default NULL,
  `cuentaBan1_pad` char(50) default NULL,
  `cuentaBan2_pad` char(50) default NULL,
  `nTarjetaCredito1_pad` char(50) default NULL,
  `nTarjetaCredito2_pad` char(50) default NULL,
  `fallecido_pad` char(1) default NULL,
  `direccion_pad` char(255) default NULL,
  `id_padre` char(15) NOT NULL default '',
  `numeroDependientes_pad` char(15) default NULL,
  `antiguedad_pad` char(15) default NULL,
  `otrosIngresos_pad` decimal(16,2) default NULL,
  `totalIngresos_pad` decimal(16,2) default NULL,
  PRIMARY KEY  (`serial_pad`),
  KEY `codigoIdentificacion_pad` (`codigoIdentificacion_pad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `padres`
--


/*!40000 ALTER TABLE `padres` DISABLE KEYS */;
LOCK TABLES `padres` WRITE;
INSERT INTO `padres` VALUES (1,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','1','2','1','0.00','0.00'),(2,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','2','2','1','0.00','0.00'),(3,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','3','2','1','0.00','0.00'),(4,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','4','2','1','0.00','0.00'),(5,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','5','2','1','0.00','0.00'),(6,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','6','2','1','0.00','0.00'),(7,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','7','2','1','0.00','0.00'),(8,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','8','2','1','0.00','0.00'),(9,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','9','2','1','0.00','0.00'),(10,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','10','2','1','0.00','0.00'),(11,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','11','2','1','0.00','0.00'),(12,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','12','2','1','0.00','0.00'),(13,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','13','2','1','0.00','0.00'),(14,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','14','2','1','0.00','0.00'),(15,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','15','2','1','0.00','0.00'),(16,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','16','2','1','0.00','0.00'),(17,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','17','2','1','0.00','0.00'),(18,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','18','2','1','0.00','0.00'),(19,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','19','2','1','0.00','0.00'),(20,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','20','2','1','0.00','0.00'),(21,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','21','2','1','0.00','0.00'),(22,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','22','2','1','0.00','0.00'),(23,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','23','2','1','0.00','0.00'),(24,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','24','2','1','0.00','0.00'),(25,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','25','2','1','0.00','0.00'),(26,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','26','2','1','0.00','0.00'),(27,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','27','2','1','0.00','0.00'),(28,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','28','2','1','0.00','0.00'),(29,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','29','2','1','0.00','0.00'),(30,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','30','2','1','0.00','0.00'),(31,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','31','2','1','0.00','0.00'),(32,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','32','2','1','0.00','0.00'),(33,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','33','2','1','0.00','0.00'),(34,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','34','2','1','0.00','0.00'),(35,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','35','2','1','0.00','0.00'),(36,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','36','2','1','0.00','0.00'),(37,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','37','2','1','0.00','0.00'),(38,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','38','2','1','0.00','0.00'),(39,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','39','2','1','0.00','0.00'),(40,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','40','2','1','0.00','0.00'),(41,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','41','2','1','0.00','0.00'),(42,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','42','2','1','0.00','0.00'),(43,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','43','2','1','0.00','0.00'),(44,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','44','2','1','0.00','0.00'),(45,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','45','2','1','0.00','0.00'),(46,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','46','2','1','0.00','0.00'),(47,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','47','2','1','0.00','0.00'),(48,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','48','2','1','0.00','0.00'),(49,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','49','2','1','0.00','0.00'),(50,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','50','2','1','0.00','0.00'),(51,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','51','2','1','0.00','0.00'),(52,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','52','2','1','0.00','0.00'),(53,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','53','2','1','0.00','0.00'),(54,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','54','2','1','0.00','0.00'),(55,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','55','2','1','0.00','0.00'),(56,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','56','2','1','0.00','0.00'),(57,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','57','2','1','0.00','0.00'),(58,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','58','2','1','0.00','0.00'),(59,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','59','2','1','0.00','0.00'),(60,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','60','2','1','0.00','0.00'),(61,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','61','2','1','0.00','0.00'),(62,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','62','2','1','0.00','0.00'),(63,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','63','2','1','0.00','0.00'),(64,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','64','2','1','0.00','0.00'),(65,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','65','2','1','0.00','0.00'),(66,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','66','2','1','0.00','0.00'),(67,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','67','2','1','0.00','0.00'),(68,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','68','2','1','0.00','0.00'),(69,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','69','2','1','0.00','0.00'),(70,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','70','2','1','0.00','0.00'),(71,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','71','2','1','0.00','0.00'),(72,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','72','2','1','0.00','0.00'),(73,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','73','2','1','0.00','0.00'),(74,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','74','2','1','0.00','0.00'),(75,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','75','2','1','0.00','0.00'),(76,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','76','2','1','0.00','0.00'),(77,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','77','2','1','0.00','0.00'),(78,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','78','2','1','0.00','0.00'),(79,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','79','2','1','0.00','0.00'),(80,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','80','2','1','0.00','0.00'),(81,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','81','2','1','0.00','0.00'),(82,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','82','2','1','0.00','0.00'),(83,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','83','2','1','0.00','0.00'),(84,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','84','2','1','0.00','0.00'),(85,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','85','2','1','0.00','0.00'),(86,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','86','2','1','0.00','0.00'),(87,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','87','2','1','0.00','0.00'),(88,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','88','2','1','0.00','0.00'),(89,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','89','2','1','0.00','0.00'),(90,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','90','2','1','0.00','0.00'),(91,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','91','2','1','0.00','0.00'),(92,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','92','2','1','0.00','0.00'),(93,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','93','2','1','0.00','0.00'),(94,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','94','2','1','0.00','0.00'),(95,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','95','2','1','0.00','0.00'),(96,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','96','2','1','0.00','0.00'),(97,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','97','2','1','0.00','0.00'),(98,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','98','2','1','0.00','0.00'),(99,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','99','2','1','0.00','0.00'),(100,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','100','2','1','0.00','0.00'),(101,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','101','2','1','0.00','0.00'),(102,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','102','2','1','0.00','0.00'),(103,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','103','2','1','0.00','0.00'),(104,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','104','2','1','0.00','0.00'),(105,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','105','2','1','0.00','0.00'),(106,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','106','2','1','0.00','0.00'),(107,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','107','2','1','0.00','0.00'),(108,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','108','2','1','0.00','0.00'),(109,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','109','2','1','0.00','0.00'),(110,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','110','2','1','0.00','0.00'),(111,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','111','2','1','0.00','0.00'),(112,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','112','2','1','0.00','0.00'),(113,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','113','2','1','0.00','0.00'),(114,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','114','2','1','0.00','0.00'),(115,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','115','2','1','0.00','0.00'),(116,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','116','2','1','0.00','0.00'),(117,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','117','2','1','0.00','0.00'),(118,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','118','2','1','0.00','0.00'),(119,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','119','2','1','0.00','0.00'),(120,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','120','2','1','0.00','0.00'),(121,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','121','2','1','0.00','0.00'),(122,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','122','2','1','0.00','0.00'),(123,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','123','2','1','0.00','0.00'),(124,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','124','2','1','0.00','0.00'),(125,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','125','2','1','0.00','0.00'),(126,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','126','2','1','0.00','0.00'),(127,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','127','2','1','0.00','0.00'),(128,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','128','2','1','0.00','0.00'),(129,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','129','2','1','0.00','0.00'),(130,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','130','2','1','0.00','0.00'),(131,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','131','2','1','0.00','0.00'),(132,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','132','2','1','0.00','0.00'),(133,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','133','2','1','0.00','0.00'),(134,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','134','2','1','0.00','0.00'),(135,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','135','2','1','0.00','0.00'),(136,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','136','2','1','0.00','0.00'),(137,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','137','2','1','0.00','0.00'),(138,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','138','2','1','0.00','0.00'),(139,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','139','2','1','0.00','0.00'),(140,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','140','2','1','0.00','0.00'),(141,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','141','2','1','0.00','0.00'),(142,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','142','2','1','0.00','0.00'),(143,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','143','2','1','0.00','0.00'),(144,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','144','2','1','0.00','0.00'),(145,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','145','2','1','0.00','0.00'),(146,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','146','2','1','0.00','0.00'),(147,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','147','2','1','0.00','0.00'),(148,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','148','2','1','0.00','0.00'),(149,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','149','2','1','0.00','0.00'),(150,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','150','2','1','0.00','0.00'),(151,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','151','2','1','0.00','0.00'),(152,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','152','2','1','0.00','0.00'),(153,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','153','2','1','0.00','0.00'),(154,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','154','2','1','0.00','0.00'),(155,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','155','2','1','0.00','0.00'),(156,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','156','2','1','0.00','0.00'),(157,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','157','2','1','0.00','0.00'),(158,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','158','2','1','0.00','0.00'),(159,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','159','2','1','0.00','0.00'),(160,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','160','2','1','0.00','0.00'),(161,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','161','2','1','0.00','0.00'),(162,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','162','2','1','0.00','0.00'),(163,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','163','2','1','0.00','0.00'),(164,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','164','2','1','0.00','0.00'),(165,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','165','2','1','0.00','0.00'),(166,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','166','2','1','0.00','0.00'),(167,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','167','2','1','0.00','0.00'),(168,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','168','2','1','0.00','0.00'),(169,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','169','2','1','0.00','0.00'),(170,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','170','2','1','0.00','0.00'),(171,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','171','2','1','0.00','0.00'),(172,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','172','2','1','0.00','0.00'),(173,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','173','2','1','0.00','0.00'),(174,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','174','2','1','0.00','0.00'),(175,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','175','2','1','0.00','0.00'),(176,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','176','2','1','0.00','0.00'),(177,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','177','2','1','0.00','0.00'),(178,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','178','2','1','0.00','0.00'),(179,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','179','2','1','0.00','0.00'),(180,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','180','2','1','0.00','0.00'),(181,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','181','2','1','0.00','0.00'),(182,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','182','2','1','0.00','0.00'),(183,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','183','2','1','0.00','0.00'),(184,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','184','2','1','0.00','0.00'),(185,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','185','2','1','0.00','0.00'),(186,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','186','2','1','0.00','0.00'),(187,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','187','2','1','0.00','0.00'),(188,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','188','2','1','0.00','0.00'),(189,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','189','2','1','0.00','0.00'),(190,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','190','2','1','0.00','0.00'),(191,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','191','2','1','0.00','0.00'),(192,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','192','2','1','0.00','0.00'),(193,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','193','2','1','0.00','0.00'),(194,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','194','2','1','0.00','0.00'),(195,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','195','2','1','0.00','0.00'),(196,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','196','2','1','0.00','0.00'),(197,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','197','2','1','0.00','0.00'),(198,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','198','2','1','0.00','0.00'),(199,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','199','2','1','0.00','0.00'),(200,1,1,1013,1,2,17,'FAUSTO',' ACOSTA PINO','C','1720983467','0000-00-00','','M','2444893','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EMILIO ZOLA E8-32 Y SHYRIS','200','2','1','0.00','0.00'),(201,1,1,1013,1,2,17,'CARLOS',' AGUILAR AYALA','C','1720247368','0000-00-00','','M','3228565','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BENALCAZAR ORIENTAL C-8. A.SIERRA Y V.CRUZ','201','2','1','0.00','0.00'),(202,1,1,1013,1,2,17,'CÉSAR',' AGUIRRE CRUZ','C','1719088039','0000-00-00','','M','2420554','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.HERNANDO PARRA MZ-D.16 CARAPUNGO','202','2','1','0.00','0.00'),(203,1,1,1013,1,2,17,'ALEXANDER',' AILLÓN VALLEJO','C','1104554116','0000-00-00','','M','3319592','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. AMÉRICA N34-461 Y VERACRUZ','203','2','1','0.00','0.00'),(204,1,1,1013,1,2,17,'JAIME',' ALDAZ','C','1723790968','0000-00-00','','M','2130351','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SELVA ALEGRE OE 8107 Y NIETO POLO','204','2','1','0.00','0.00'),(205,1,1,1013,1,2,17,'IVÁN',' ANDRADE NARANJO','C','1722622584','0000-00-00','','M','2338756','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA COLINA LOJA 252. SAN RAFAEL','205','2','1','0.00','0.00'),(206,1,1,1013,1,2,17,'MIGUEL',' ARAUJO VILLALBA','C','1718171232','0000-00-00','','M','2411144','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. B. E13-52 Y GUAYACANES. EL EDÉN','206','2','1','0.00','0.00'),(207,1,1,1013,1,2,17,'JAIME',' ARTEAGA','C','1717224750','0000-00-00','','M','2599710','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUICOCHA 640 Y SANTA TERESA','207','2','1','0.00','0.00'),(208,1,1,1013,1,2,17,'CARLOS',' BASTIDAS','C','1722691209','0000-00-00','','M','2472490','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS ARUPOS 154 Y TULIPANES','208','2','1','0.00','0.00'),(209,1,1,1013,1,2,17,'MANUEL',' BAZANTE','C','0201577780','0000-00-00','','M','2402559','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN ALZURO N50-185 Y ÁLAMOS','209','2','1','0.00','0.00'),(210,1,1,1013,1,2,17,'OCTAVIO',' BENALCAZAR RIVERA','C','1719895896','0000-00-00','','M','2368142','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SIMÓN BOLÍVAR 857. GUAYLLABAMBA','210','2','1','0.00','0.00'),(211,1,1,1013,1,2,17,'JORGE',' BENAVIDES','C','1721350450','0000-00-00','','M','2558846','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANDAGOYA 126 Y MONTES','211','2','1','0.00','0.00'),(212,1,1,1013,1,2,17,'IGNACIO',' BENÍTEZ','C','1719183491','0000-00-00','','M','3443757','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARCELÉN. URB.MASTODONTES BL-14 D-3.B','212','2','1','0.00','0.00'),(213,1,1,1013,1,2,17,'DARWIN',' BENÍTEZ SALAZAR','C','1724051949','0000-00-00','','M','2485142','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS OE252 Y ORIANGA','213','2','1','0.00','0.00'),(214,1,1,1013,1,2,17,'ALFONSO',' BONIFAZ','C','1721597456','0000-00-00','','M','2531712','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUACHI N64-65 Y JUAN FIGUEROA','214','2','1','0.00','0.00'),(215,1,1,1013,1,2,17,'CARL',' BRANDT','C','1716647472','0000-00-00','','M','2560451','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LOS CONQUISTADORES E15-6. LA FLORESTA','215','2','1','0.00','0.00'),(216,1,1,1013,1,2,17,'ANÍBAL',' BRAZZERO','C','0502508799','0000-00-00','','M','2400682','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ATACAZO 424 Y OLMEDO. SANGOLQUÍ.','216','2','1','0.00','0.00'),(217,1,1,1013,1,2,17,'CÉSAR',' BURBANO MONTALVO','C','1723792741','0000-00-00','','M','2428920','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. ARCOS NORTE #36. PANA. NORTE','217','2','1','0.00','0.00'),(218,1,1,1013,1,2,17,'JOSÉ',' BUSTOS','C','1722525308','0000-00-00','','M','2400482','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA LUZ C-J D-26.FRANCISCO GUARDERAS Y BUSTAMANTE','218','2','1','0.00','0.00'),(219,1,1,1013,1,2,17,'LUIS',' CABRERA','C','1716825243','0000-00-00','','M','2537058','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHALA N67-87 Y CUICOCHA','219','2','1','0.00','0.00'),(220,1,1,1013,1,2,17,'EDDY',' CÁCERES PÉREZ','C','1723345847','0000-00-00','','M','2893230','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL ÁNGEL 237 Y LEONARDO DAVINCE','220','2','1','0.00','0.00'),(221,1,1,1013,1,2,17,'WASHINGTON',' CADENA','C','1716394323','0000-00-00','','M','2595484','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','25 DE MAYO 299 Y DANIEL GARZÓN','221','2','1','0.00','0.00'),(222,1,1,1013,1,2,17,'JAVIER',' CADENA','C','1724221781','0000-00-00','','M','2826607','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. EL PORTAL. SAN JOSÉ # 1','222','2','1','0.00','0.00'),(223,1,1,1013,1,2,17,'JAIME',' CALDERÓN CARVALLO','C','1715909220','0000-00-00','','M','2240255','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','J.GONZÁLEZ 3576. ED.KAROLINA PLAZA D-35','223','2','1','0.00','0.00'),(224,1,1,1013,1,2,17,'MARCO',' ANTONIO CÀRDENAS','C','1723906671','0000-00-00','','M','22542206','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AUTOP.RUMIÑAHUI PUENTE 6 CONJ.PANAM. C-11','224','2','1','0.00','0.00'),(225,1,1,1013,1,2,17,'FREDDY',' CÁRDENAS','C','1723836571','0000-00-00','','M','2649094','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.JIPIJAPA S 11-63 Y M.RODRÍGUEZ','225','2','1','0.00','0.00'),(226,1,1,1013,1,2,17,'JUAN',' CARRILLO','C','1717536682','0000-00-00','','M','2520267','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ENRIQUE RITTER Y BENJAMÍN CHÁVEZ OE9-128','226','2','1','0.00','0.00'),(227,1,1,1013,1,2,17,'FERNANDO',' CARVAJAL','C','1722069950','0000-00-00','','M','3227458','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS- 2 CASA N22-36 Y LUGO','227','2','1','0.00','0.00'),(228,1,1,1013,1,2,17,'VINICIO',' CARVAJAL','C','1723738413','0000-00-00','','M','2243089','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CRISTOBAL SANDOVAL OE 4-44 Y BRASIL','228','2','1','0.00','0.00'),(229,1,1,1013,1,2,17,'WASHINGTON',' CASAMEN','C','1723476832','0000-00-00','','M','2550324','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PORTOVIEJO OE1-29 Y 10 DE AGOSTO','229','2','1','0.00','0.00'),(230,1,1,1013,1,2,17,'ROBERTO',' CARTAGENOVA','C','1723925069','0000-00-00','','M','3280105','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.JARDINES DE AMAGASI C-33','230','2','1','0.00','0.00'),(231,1,1,1013,1,2,17,'EFRAÍN',' CAZCO','C','1716367410','0000-00-00','','M','2599000','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JORGE PIEDRA 1500 Y AV.OCCIDENTAL','231','2','1','0.00','0.00'),(232,1,1,1013,1,2,17,'LUIS',' CEDEÑO','C','1722440730','0000-00-00','','M','3342172','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS NARANJOS N44-88 Y GRANADOS. EL BATÁN','232','2','1','0.00','0.00'),(233,1,1,1013,1,2,17,'FAUSTO',' CERVANTES','C','1723961064','0000-00-00','','M','2541288','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.MIRADOR DEL BOSQUE. C-47. M.VALDEZ Y M.OCHOA','233','2','1','0.00','0.00'),(234,1,1,1013,1,2,17,'HERNANDO',' HERNÁNDEZ','C','1717317430','0000-00-00','','M','2842110','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARICA 313 Y ZAPOTAL','234','2','1','0.00','0.00'),(235,1,1,1013,1,2,17,'WILLIAM',' CEVALLOS','C','1717773541','0000-00-00','','M','2351862','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DOS HEMISFERIOS MZ-4 C-18. PUSUQUÍ.','235','2','1','0.00','0.00'),(236,1,1,1013,1,2,17,'CHRISTIAN',' CHÁVEZ BENALCAZAR','C','1722124177','0000-00-00','','M','2533251','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','QUITUMBE 6007 Y AV. DEL MAESTRO','236','2','1','0.00','0.00'),(237,1,1,1013,1,2,17,'FAUSTO',' CHÁVEZ TAPIA','C','1720759941','0000-00-00','','M','2665041','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MULTIF.SANTA ANITA BL.14 D-101','237','2','1','0.00','0.00'),(238,1,1,1013,1,2,17,'JULIO',' CHICO LÓPEZ','C','1724079361','0000-00-00','','M','2591946','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.REAL AUDIENCIA 2969 Y AV. DEL MAESTRO','238','2','1','0.00','0.00'),(239,1,1,1013,1,2,17,'EDWIN',' CHISAGUANO','C','1723300537','0000-00-00','','M','2599031','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN FIGUEROA 2515 Y VALLEJO','239','2','1','0.00','0.00'),(240,1,1,1013,1,2,17,'JULIO',' COLLAGUAZO','C','1724055213','0000-00-00','','M','2522763','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOEL MONROY 605 Y ONTANEDA','240','2','1','0.00','0.00'),(241,1,1,1013,1,2,17,'RODRIGO',' CONDE','C','1719993105','0000-00-00','','M','2334178','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LUIS CORDERO 697 Y L.MERCADO. SANGOLQUÍ','241','2','1','0.00','0.00'),(242,1,1,1013,1,2,17,'EDUARDO',' CORREA','C','1717270399','0000-00-00','','M','2437136','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GREGORIO MUNGA N39-66. EL BATÁN','242','2','1','0.00','0.00'),(243,1,1,1013,1,2,17,'NELSON',' DÍAZ','C','1721298170','0000-00-00','','M','2438862','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ZÁPAROS N 502-40 Y H.SALAS','243','2','1','0.00','0.00'),(244,1,1,1013,1,2,17,'JORGE',' DÍAZ','C','1722773254','0000-00-00','','M','2339908','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN FRANCISCO PERÓN 129 CALLE J #106','244','2','1','0.00','0.00'),(245,1,1,1013,1,2,17,'GONZALO',' DOMÍNGUEZ','C','1722557145','0000-00-00','','M','2403508','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BUSTAMANTE 450 Y MURIALDO','245','2','1','0.00','0.00'),(246,1,1,1013,1,2,17,'IGNACIO',' ENRÍQUEZ','C','1724186273','0000-00-00','','M','2232995','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS CASAS OE8-20 Y D.ESPINAR','246','2','1','0.00','0.00'),(247,1,1,1013,1,2,17,'LUIS',' ERAZO','C','1718027327','0000-00-00','','M','2236863','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS CASAS OE1-102 Y MONTES','247','2','1','0.00','0.00'),(248,1,1,1013,1,2,17,'LUIS',' ESPÍN ZABALA','C','1724106925','0000-00-00','','M','2672269','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TURUBAMBA BAJO OE 2H-S26 D# 145','248','2','1','0.00','0.00'),(249,1,1,1013,1,2,17,'MANUEL',' ESTRADA','C','1716362346','0000-00-00','','M','2825152','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','QUITUS 982. CALDERÓN','249','2','1','0.00','0.00'),(250,1,1,1013,1,2,17,'IDRIAN',' ESTRELLA SILVA','C','1724152051','0000-00-00','','M','242225','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. JARDINES DE CARCELÉN C-71','250','2','1','0.00','0.00'),(251,1,1,1013,1,2,17,'WILMER',' FABARA','C','0503058745','0000-00-00','','M','2272542','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IGNACIO ASÍN N5146 Y VICENTE HEREDIA','251','2','1','0.00','0.00'),(252,1,1,1013,1,2,17,'GUIDO',' FELIX','C','1724195902','0000-00-00','','M','3264239','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AVEJIRAS Y ANONAS. CONJ.COLINAS DEL EDEN C-13','252','2','1','0.00','0.00'),(253,1,1,1013,1,2,17,'JORGE',' FLORES','C','1723487813','0000-00-00','','M','2597871','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IZIDRO LOZA C-4 Y DAVID LEDESMA','253','2','1','0.00','0.00'),(254,1,1,1013,1,2,17,'DIMITRI',' FLORES JARAMILLO','C','1723476287','0000-00-00','','M','2276065','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. BRASIL Y ZAMORA PAS. C # 70','254','2','1','0.00','0.00'),(255,1,1,1013,1,2,17,'NORMAN',' FONSECA','C','1717357832','0000-00-00','','M','2662266','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LOS ARRAYANEZ MZ-21 CASA S13-93','255','2','1','0.00','0.00'),(256,1,1,1013,1,2,17,'JAVIER',' GARCÍA DEL POZO','C','1722346010','0000-00-00','','M','2678887','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SARAGURO 408 Y PIMAMPIRO. SAN BARTOLO','256','2','1','0.00','0.00'),(257,1,1,1013,1,2,17,'VÍCTOR',' GARZÓN','C','1721031191','0000-00-00','','M','2337115','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INÉS GANGOTENA L-2. VALLE DE LOS CHILLOS','257','2','1','0.00','0.00'),(258,1,1,1013,1,2,17,'MANUEL',' GÓMEZ','C','1717870644','0000-00-00','','M','2534116','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GONZALO PINTO N59-55','258','2','1','0.00','0.00'),(259,1,1,1013,1,2,17,'JUAN',' GRANJA MAYA','C','1722441787','0000-00-00','','M','2562130','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ED.ALMAGRO DORAL 2 D-75 Y BULGARIA','259','2','1','0.00','0.00'),(260,1,1,1013,1,2,17,'AMILCAR',' GUERRA','C','1719344796','0000-00-00','','M','3280021','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCELANA N58-57 Y LEONARDO MURIALDO','260','2','1','0.00','0.00'),(261,1,1,1013,1,2,17,'RAMIRO',' GUERRERO CÓRDOVA','C','1104888225','0000-00-00','','M','2435746','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MADROÑOS 570 Y DE LOS LAURELES','261','2','1','0.00','0.00'),(262,1,1,1013,1,2,17,'SEGUNDO',' HERRERA','C','1719181107','0000-00-00','','M','2664086','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO COLLAZO 163 Y BARTOLOMÉ ALBEZ','262','2','1','0.00','0.00'),(263,1,1,1013,1,2,17,'EDWIN',' HERRERA SORIA','C','1719992388','0000-00-00','','M','2073061','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.ESTANCIA DE LA ARMENIA C-13. GUANGOPOLO KM 12','263','2','1','0.00','0.00'),(264,1,1,1013,1,2,17,'WALTER',' HIDALGO','C','1724154263','0000-00-00','','M','2355809','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA PAMPA II. CALLE I C-72','264','2','1','0.00','0.00'),(265,1,1,1013,1,2,17,'EDUARDO',' JÁCOME','C','1717464992','0000-00-00','','M','3300600','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CIUDAD DEL SOL 188 Y M.CÓRDOVA GALARZA','265','2','1','0.00','0.00'),(266,1,1,1013,1,2,17,'CARLOS',' JAQUE','C','1715907109','0000-00-00','','M','2420203','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JULIO RAMOS 461 Y ALAMOR. URB. ELOISA','266','2','1','0.00','0.00'),(267,1,1,1013,1,2,17,'PABLO',' JARAMILLO','C','1722195102','0000-00-00','','M','2524183','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO SIERRA N17-25 Y JOSÉ TOBAR','267','2','1','0.00','0.00'),(268,1,1,1013,1,2,17,'CÉSAR',' LARREA','C','1720728623','0000-00-00','','M','3214089','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAGALLANES 195 Y EL ORO','268','2','1','0.00','0.00'),(269,1,1,1013,1,2,17,'PATRICIO',' LINCANGO','C','1721441077','0000-00-00','','M','2416387','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALIFORNIA S12 Y LOS DUQUES','269','2','1','0.00','0.00'),(270,1,1,1013,1,2,17,'FAUSTO',' LLERENA','C','1722637806','0000-00-00','','M','2449323','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL Y LEGARDA. URB.PALERMO C-B.9','270','2','1','0.00','0.00'),(271,1,1,1013,1,2,17,'MILTON',' LOGROÑO','C','1718042250','0000-00-00','','M','2397086','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.PULULAHUA C-56. SAN A. DE PICHINCHA','271','2','1','0.00','0.00'),(272,1,1,1013,1,2,17,'LUIS',' LÓPEZ HARO','C','1716638026','0000-00-00','','M','2619943','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL ALONSO S8-316 Y SIG SIG','272','2','1','0.00','0.00'),(273,1,1,1013,1,2,17,'CARLOS',' LÓPEZ ROSERO','C','1723768097','0000-00-00','','M','2661747','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS JARRÍN S7-182 Y ALAQUEZ.CDLA.J.ARTEAGA','273','2','1','0.00','0.00'),(274,1,1,1013,1,2,17,'DIEGO',' LÒPEZ','C','1718404302','0000-00-00','','M','2496842','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIO PUCUNA N74-165 Y RIO BIGAL','274','2','1','0.00','0.00'),(275,1,1,1013,1,2,17,'ANDRÉS',' LOZA','C','1716176664','0000-00-00','','M','2567049','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTIAGO 549 Y AV.AMÉRICA','275','2','1','0.00','0.00'),(276,1,1,1013,1,2,17,'MARCO',' LOZANO','C','1724056773','0000-00-00','','M','2648136','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BALCONES DEL RECREO C-21. EL RECREO','276','2','1','0.00','0.00'),(277,1,1,1013,1,2,17,'BYRON',' MALES ANDRADE','C','1723557821','0000-00-00','','M','2627042','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MATILDE HUERTA OE 963 Y J.ESTRELLA','277','2','1','0.00','0.00'),(278,1,1,1013,1,2,17,'SHIMON',' MALKA','C','1717546772','0000-00-00','','M','2862825','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GENERAL ENRIQUEZ S/N. ISLA RÁBIDA. URB.CAPELO','278','2','1','0.00','0.00'),(279,1,1,1013,1,2,17,'OSWALDO',' MANTILLA','C','1722696091','0000-00-00','','M','2450048','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISLA PINZÓN N43-194','279','2','1','0.00','0.00'),(280,1,1,1013,1,2,17,'JOSÉ',' MARROQUÍN','C','1723471387','0000-00-00','','M','2431588','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND. EL INCA BL-8 D-18','280','2','1','0.00','0.00'),(281,1,1,1013,1,2,17,'PATRICIO',' MASACHE','C','1722441738','0000-00-00','','M','2813192','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL CAÑOLA E10-32','281','2','1','0.00','0.00'),(282,1,1,1013,1,2,17,'SANTIAGO',' RUEDA','C','1724227192','0000-00-00','','M','92746369','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITTER N24-73 Y LA GASCA','282','2','1','0.00','0.00'),(283,1,1,1013,1,2,17,'ALEXCI',' MEDINA','C','0503072860','0000-00-00','','M','2481858','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. TERRAZAS EINSTEIN C-94. CARCELÉN','283','2','1','0.00','0.00'),(284,1,1,1013,1,2,17,'WILSON',' MELO','C','1723818611','0000-00-00','','M','2963736','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP. IESS-FUT SM-3 MZ-E CASA 12','284','2','1','0.00','0.00'),(285,1,1,1013,1,2,17,'EDWIN',' MIÑO','C','1724194772','0000-00-00','','M','2425329','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. EL PINAR','285','2','1','0.00','0.00'),(286,1,1,1013,1,2,17,'SAUL',' MONTENEGRO','C','1724077050','0000-00-00','','M','2247893','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARROYO DEL RÍO 337 Y MANUEL M. SÁNCHEZ','286','2','1','0.00','0.00'),(287,1,1,1013,1,2,17,'WILLIAM',' MONTOYA','C','1723921654','0000-00-00','','M','2243188','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BERNAL N51-84 Y AV.LA FLORIDA. CDLA. LA FLORIDA','287','2','1','0.00','0.00'),(288,1,1,1013,1,2,17,'PABLO',' MONTOYA','C','1721522710','0000-00-00','','M','2624582','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA MANÁ 376 Y GUANANDO','288','2','1','0.00','0.00'),(289,1,1,1013,1,2,17,'CARLOS',' MORALES','C','1718934159','0000-00-00','','M','2961301','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS FREILE 2117. CHILLOGALLO','289','2','1','0.00','0.00'),(290,1,1,1013,1,2,17,'MARCO',' MORALES','C','1721344958','0000-00-00','','M','2065574','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.MARIANAS C-3. VÍA MARIANAS','290','2','1','0.00','0.00'),(291,1,1,1013,1,2,17,'JUAN','NARANJO','C','1723980528','0000-00-00','','M','2614529','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.JUAN DEL SALTO OE1-70 Y PERO ALFARO. VILLAFLOR','291','2','1','0.00','0.00'),(292,1,1,1013,1,2,17,'ALFREDO',' NARANJO','C','1717999211','0000-00-00','','M','2599073','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL MORENO N67-94 Y RAMÓN CHIRIBOGA','292','2','1','0.00','0.00'),(293,1,1,1013,1,2,17,'GINO',' NAVARRETE','C','1723421960','0000-00-00','','M','2567760','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','POLIT LASSO 171 Y SELVA ALEGRE','293','2','1','0.00','0.00'),(294,1,1,1013,1,2,17,'RAÚL',' ORBE','C','1721399119','0000-00-00','','M','2958993','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ESMERALDAS OE61-48 Y COTOPAXI','294','2','1','0.00','0.00'),(295,1,1,1013,1,2,17,'RUBÉN',' ORTEGA','C','1723268460','0000-00-00','','M','2665499','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','QUITUS 741. LA MAGDALENA','295','2','1','0.00','0.00'),(296,1,1,1013,1,2,17,'DIEGO',' ORTIZ','C','1723300255','0000-00-00','','M','2478889','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MELCHOR TOAZA Y SABANILLA ED.JIMENA II D-402','296','2','1','0.00','0.00'),(297,1,1,1013,1,2,17,'FREDDY',' ORTIZ ORBE','C','1723841381','0000-00-00','','M','2022789','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.QUITUS 955 CONJ.LA FLORENCIA. CALDERÓN','297','2','1','0.00','0.00'),(298,1,1,1013,1,2,17,'BYRON',' ORTIZ','C','1720990280','0000-00-00','','M','2424144','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARAPUNGO SM-A.4 MZ-S CASA 97','298','2','1','0.00','0.00'),(299,1,1,1013,1,2,17,'RODRIGO',' ORTIZ','C','1717631517','0000-00-00','','M','92720448','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO DE VILLAVICENCIO N55-114 Y CARLOS V','299','2','1','0.00','0.00'),(300,1,1,1013,1,2,17,'JORGE',' OSCULLO','C','1720892148','0000-00-00','','M','2334510','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PICHINCHA 505. SANGOLQUÍ','300','2','1','0.00','0.00'),(301,1,1,1013,1,2,17,'JUAN','OSPINA','C','1719988014','0000-00-00','','M','2825325','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN MATEO L-11 Y SAN CAMILO','301','2','1','0.00','0.00'),(302,1,1,1013,1,2,17,'MAURICIO',' PADILLA','C','1724230675','0000-00-00','','M','2417447','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL ZAMBRANO N56-196','302','2','1','0.00','0.00'),(303,1,1,1013,1,2,17,'LUIS',' PAZMIÑO','C','1719033639','0000-00-00','','M','2080684','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA COLINA 112. SANGOLQUÍ.','303','2','1','0.00','0.00'),(304,1,1,1013,1,2,17,'GABRIEL',' PEÑA','C','1721708509','0000-00-00','','M','2659384','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.TNTE. HUGO ORTIZ OE5-76','304','2','1','0.00','0.00'),(305,1,1,1013,1,2,17,'FAUSTO',' PÉREZ','C','1723795132','0000-00-00','','M','3228023','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VERDE CRUZ Y ANTONIO SIERRA CASA 40','305','2','1','0.00','0.00'),(306,1,1,1013,1,2,17,'RAMIRO',' PILATASIG','C','1721863403','0000-00-00','','M','2644194','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN ALLAZAR Y ANDRÉS PÉREZ S028','306','2','1','0.00','0.00'),(307,1,1,1013,1,2,17,'GUSTAVO',' PONCE','C','1719568907','0000-00-00','','M','2291810','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHALA Y PAS. #3 OE5-233. SAN PEDRO KLAVER','307','2','1','0.00','0.00'),(308,1,1,1013,1,2,17,'OSCAR',' POZO','C','1724055106','0000-00-00','','M','2596473','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FERNANDO TINAJERO OE7-253','308','2','1','0.00','0.00'),(309,1,1,1013,1,2,17,'EDMUNDO',' PROAÑO','C','1721780862','0000-00-00','','M','2904968','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ACUÑA 770 Y AMÉRICA','309','2','1','0.00','0.00'),(310,1,1,1013,1,2,17,'GERMAN',' RACINES','C','1722116090','0000-00-00','','M','2651713','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RODRIGO DE CHÁVEZ 551 Y PEDRO DE ALFARO','310','2','1','0.00','0.00'),(311,1,1,1013,1,2,17,'EDWIN',' RAMOS','C','1719561225','0000-00-00','','M','2495321','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ ARTETA L-108 Y MACHALA','311','2','1','0.00','0.00'),(312,1,1,1013,1,2,17,'RAÚL',' REYES','C','1723115232','0000-00-00','','M','2236077','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUERO Y CAICEDO 1180','312','2','1','0.00','0.00'),(313,1,1,1013,1,2,17,'MARCELO',' REYES','C','1003483904','0000-00-00','','M','2235927','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ASUNCIÓN OE 916 Y BOMBONA','313','2','1','0.00','0.00'),(314,1,1,1013,1,2,17,'','','C','1716183627','0000-00-00','','M','2509761','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MADRID Y TOLEDO D-5.B. CASA MADRID','314','2','1','0.00','0.00'),(315,1,1,1013,1,2,17,'FABRICIO',' RIVERA','C','1717412280','0000-00-00','','M','2804659','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MODESTO CHÁVEZ Y A.EINSTEIN CONJ.SOLAQUA C-24','315','2','1','0.00','0.00'),(316,1,1,1013,1,2,17,'CARLOS',' ROBLES','C','1723926935','0000-00-00','','M','2582204','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INDEPENDENCIA 144 Y BOMBONÁ. SAN JUAN','316','2','1','0.00','0.00'),(317,1,1,1013,1,2,17,'VINICIO',' RODRIGUEZ','C','2100669130','0000-00-00','','M','2449737','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALCÍVAR Y AV.BRASIL. CONJ.CIUDAD REAL C-5','317','2','1','0.00','0.00'),(318,1,1,1013,1,2,17,'RENATO',' RODRÍGUEZ','C','1724193568','0000-00-00','','M','2244859','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ LUCUMA E6-175 Y PEDRO CORNELIO','318','2','1','0.00','0.00'),(319,1,1,1013,1,2,17,'JOSÉ',' ROJAS','C','1722652821','0000-00-00','','M','2483594','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE 2A Y AV.JAIME R.AGUILERA N86-326.URB.MASTODO','319','2','1','0.00','0.00'),(320,1,1,1013,1,2,17,'MARCO',' ROJAS','C','1723000830','0000-00-00','','M','3342948','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. 6 DE DICIEMBRE Y PALMERAS 44-59','320','2','1','0.00','0.00'),(321,1,1,1013,1,2,17,'RIGOBERTO',' ROJAS','C','1723927073','0000-00-00','','M','3202020','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MUNIVE 531 Y DOMINGO ESPINAR','321','2','1','0.00','0.00'),(322,1,1,1013,1,2,17,'MIGUEL',' ROMERO','C','1716825797','0000-00-00','','M','2591327','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ESPINOZA AD-67 Y CARLOS V','322','2','1','0.00','0.00'),(323,1,1,1013,1,2,17,'CARLOS',' ROMERO','C','1724070907','0000-00-00','','M','2607476','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OBRERO INDEPENDIENTE. KM. 4.5 AUTOP. LOS CHILLOS','323','2','1','0.00','0.00'),(324,1,1,1013,1,2,17,'JORGE',' ROSALES','C','1720549532','0000-00-00','','M','2850077','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BAVARIA C-6. SAN RAFAEL','324','2','1','0.00','0.00'),(325,1,1,1013,1,2,17,'MARCO',' ROSALES','C','1724018096','0000-00-00','','M','2540086','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.CASALES GABRIELA D-42 A.2 SOLANO Y LA CONDAMI','325','2','1','0.00','0.00'),(326,1,1,1013,1,2,17,'JORGE',' ROSERO','C','1717843526','0000-00-00','','M','3102506','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ZARUMA S10-286 Y JOSÉ EGUSQUIZA. LA MAGDALENA','326','2','1','0.00','0.00'),(327,1,1,1013,1,2,17,'JUAN','SALAZAR','C','1724191653','0000-00-00','','M','2595447','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ÁNGEL LUDEÑA 838','327','2','1','0.00','0.00'),(328,1,1,1013,1,2,17,'PATRICIO',' SÁNCHEZ','C','1719734939','0000-00-00','','M','2240052','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EDMUNDO CHIRIBOGA 753 Y SALAZAR','328','2','1','0.00','0.00'),(329,1,1,1013,1,2,17,'VINICIO',' SANTIANA','C','1718080078','0000-00-00','','M','2777744','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ROCAFUERTE Y PAS.E.ALFARO L-8. YARUQUÍ','329','2','1','0.00','0.00'),(330,1,1,1013,1,2,17,'GALO',' SILVA','C','1721239539','0000-00-00','','M','2496789','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ ARTETA N70-66 Y MACHALA','330','2','1','0.00','0.00'),(331,1,1,1013,1,2,17,'EDUARDO',' SILVA','C','1724192099','0000-00-00','','M','2428705','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.JARDINES DE CARCELÉN B-98','331','2','1','0.00','0.00'),(332,1,1,1013,1,2,17,'RIQUELME',' SOLÍS','C','1723828552','0000-00-00','','M','2626544','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SERAPIO JAPERAVI 1444 Y PAS. A-14','332','2','1','0.00','0.00'),(333,1,1,1013,1,2,17,'MARCELO',' SOLORZANO','C','1720160835','0000-00-00','','M','2613478','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAXIMILIANO RODRÍGUEZ 980 Y QUEVEDO','333','2','1','0.00','0.00'),(334,1,1,1013,1,2,17,'IVÁN',' SOLORZANO','C','1722103791','0000-00-00','','M','2810916','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VÍCTOR MIDEROS N53-83 Y PINOS','334','2','1','0.00','0.00'),(335,1,1,1013,1,2,17,'LUIS',' STACEY','C','1720622180','0000-00-00','','M','3342982','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GENERAL DUMA N47-72 Y MALVAS','335','2','1','0.00','0.00'),(336,1,1,1013,1,2,17,'CÉSAR',' TAPIA','C','1724222078','0000-00-00','','M','2649394','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ ALVES 289. CINCO ESQUINAS.','336','2','1','0.00','0.00'),(337,1,1,1013,1,2,17,'GUSTAVO',' TAPIA','C','1719819888','0000-00-00','','M','2435322','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO BASÁN 6 Y MAÑOSCA','337','2','1','0.00','0.00'),(338,1,1,1013,1,2,17,'FRANCISCO',' JAVIER','C','1715786750','0000-00-00','','M','2553773','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CASALES GABRIELA BL-7 APARTAMENTO A-3','338','2','1','0.00','0.00'),(339,1,1,1013,1,2,17,'NELSON',' TRONCOSO','C','1721679841','0000-00-00','','M','2321003','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JAVIER LOYOLA Y S.BOLÍVAR. CONJ.CAROLINA DOS','339','2','1','0.00','0.00'),(340,1,1,1013,1,2,17,'PAUL',' TUFIÑO','C','1716824576','0000-00-00','','M','2828544','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BOSQUES DE CALDERÒN 1 CASA 6','340','2','1','0.00','0.00'),(341,1,1,1013,1,2,17,'MILTON',' ULLOA','C','1724321293','0000-00-00','','M','2549252','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. 2 CASA N22-24 Y LUGO','341','2','1','0.00','0.00'),(342,1,1,1013,1,2,17,'VICENTE',' URBINA','C','1720944105','0000-00-00','','M','2501162','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.AMÉRICA 358 Y BOGOTÁ','342','2','1','0.00','0.00'),(343,1,1,1013,1,2,17,'MARCO',' UTRERAS','C','1720741048','0000-00-00','','M','2613326','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BENJAMÍN LASTRA S8-461 Y ANDRÉS PÉREZ','343','2','1','0.00','0.00'),(344,1,1,1013,1,2,17,'FAUSTO',' UTRERAS','C','1723086821','0000-00-00','','M','3042620','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IBARRA PAS OE 9B CASA S38-36','344','2','1','0.00','0.00'),(345,1,1,1013,1,2,17,'LUIS',' VALVERDE','C','1719088971','0000-00-00','','M','2410797','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. BRASILIA II CASA 75','345','2','1','0.00','0.00'),(346,1,1,1013,1,2,17,'MARIO',' VANEGAS','C','1724121965','0000-00-00','','M','2532290','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS DOSMAN 132 Y ANGEL LUDEÑA','346','2','1','0.00','0.00'),(347,1,1,1013,1,2,17,'EDUARDO',' VELASCO','C','1721102141','0000-00-00','','M','3303650','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUARANDA N54-541 Y JORGE PIEDRA','347','2','1','0.00','0.00'),(348,1,1,1013,1,2,17,'EDISON',' VERDESOTO','C','1724220627','0000-00-00','','M','2956254','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OLMEDO 738 Y GUAYAQUIL','348','2','1','0.00','0.00'),(349,1,1,1013,1,2,17,'HERMES',' VILLALBA','C','1724232259','0000-00-00','','M','2457193','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL UNIVERSO 360 Y AV.DE LOS SHYRIS','349','2','1','0.00','0.00'),(350,1,1,1013,1,2,17,'HÉCTOR',' VILLARREAL','C','1722213558','0000-00-00','','M','2434000','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. LA GRANJA BL-35 D-32','350','2','1','0.00','0.00'),(351,1,1,1013,1,2,17,'FRANCISCO',' VITERI','C','1723920789','0000-00-00','','M','3280329','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS ANONAS 53-330 Y PEDRO GUERRERO','351','2','1','0.00','0.00'),(352,1,1,1013,1,2,17,'OLMEDO',' VIZCAINO','C','1723539522','0000-00-00','','M','2428881','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GEOVANY CALLES Y LA PIEDRA 29','352','2','1','0.00','0.00'),(353,1,1,1013,1,2,17,'CARLOS',' ZULETA','C','1722784798','0000-00-00','','M','2905336','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAGALLANES 128 Y SANTA ROSA','353','2','1','0.00','0.00'),(354,1,1,1013,1,2,17,'SANTIAGO',' ZUMÁRRAGA','C','1717218729','0000-00-00','','M','3203337','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SELVA ALEGRE Y SOBRINO MINAYO. ED. CANAAN DOS','354','2','1','0.00','0.00'),(355,1,1,1013,1,2,17,'SEGUNDO',' ZUMÁRRAGA','C','1724013105','0000-00-00','','M','2296901','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NAZARETH OE2-262','355','2','1','0.00','0.00'),(356,1,1,1013,1,2,17,'GERMÁN',' ZUMÁRRAGA','C','1724017783','0000-00-00','','M','2292552','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ M.GUERRERO Y MANTA. CONJ.LA RECOLETA D-201','356','2','1','0.00','0.00'),(357,1,1,1013,1,2,17,'FAUSTO',' ACOSTA','C','1717723017','0000-00-00','','M','3316379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VERACRUZ N35-01 Y AMÉRICA','357','2','1','0.00','0.00'),(358,1,1,1013,1,2,17,'FRANCISCO',' AGUILAR','C','1723797971','0000-00-00','','M','2400495','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ABELARDO MONTALVO E2-45 Y FCO.GUARDERAS','358','2','1','0.00','0.00'),(359,1,1,1013,1,2,17,'DIEGO',' AUZ','C','1719534339','0000-00-00','','M','2276641','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO MONTALVO OE92-82 Y LORANTE','359','2','1','0.00','0.00'),(360,1,1,1013,1,2,17,'ABNER',' BRAVO','C','1720070513','0000-00-00','','M','2951114','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MONTEVIDEO OE 847 Y NICARAGUA','360','2','1','0.00','0.00'),(361,1,1,1013,1,2,17,'FAUSTO',' CANDO','C','1724222086','0000-00-00','','M','2629119','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. S17-125 Y HUIGRA','361','2','1','0.00','0.00'),(362,1,1,1013,1,2,17,'CHRISTIAN',' CAPITO','C','1721351508','0000-00-00','','M','3402092','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MELCHOR DE VALDEZ Y MARTÍN OCHOA. CONJ.ALTALOMA','362','2','1','0.00','0.00'),(363,1,1,1013,1,2,17,'FREDDY',' CARRERA','C','1720598984','0000-00-00','','M','2803830','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.ALTAMIRA PAS. 3 C-53','363','2','1','0.00','0.00'),(364,1,1,1013,1,2,17,'FRANCISCO',' CARRERA','C','1715482509','0000-00-00','','M','2439202','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GALINDEZ 111 Y 10 DE AGOSTO','364','2','1','0.00','0.00'),(365,1,1,1013,1,2,17,'CARLOS',' CARRILLO','C','1721644100','0000-00-00','','M','2419988','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DE LOS TRIGALES N532-22','365','2','1','0.00','0.00'),(366,1,1,1013,1,2,17,'ROBERT',' CHÁVEZ','C','1724193360','0000-00-00','','M','2672191','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.PRADOS DE QUITUMBE I. MZ-C C-90. AV.QUITUMBE','366','2','1','0.00','0.00'),(367,1,1,1013,1,2,17,'FAUSTO',' DÍAZ','C','1715365399','0000-00-00','','M','2491587','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ GUERRERO 70-13','367','2','1','0.00','0.00'),(368,1,1,1013,1,2,17,'MARIO',' DUQUE','C','1721345831','0000-00-00','','M','2676766','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE YARUQUIES 1695 Y SARAGURO. SAN BARTOLO','368','2','1','0.00','0.00'),(369,1,1,1013,1,2,17,'JORGE',' ELIZALDE','C','1724220619','0000-00-00','','M','2675018','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA. AYMESA CALLE A 252. GUAJALO','369','2','1','0.00','0.00'),(370,1,1,1013,1,2,17,'SERGIO',' ELMIR','C','1715113070','0000-00-00','','M','3319332','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARVAJAL OE6-24 Y CALLE A. ED. HORUS PLAZA','370','2','1','0.00','0.00'),(371,1,1,1013,1,2,17,'ROBERTO',' ESCANDÓN','C','1723796536','0000-00-00','','M','2428867','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PANAMERICANA NORTE KM 9 1/2','371','2','1','0.00','0.00'),(372,1,1,1013,1,2,17,'CARLOS',' FERNÁNDEZ','C','1724018237','0000-00-00','','M','2244176','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISLA ISABELA N41-21 E ISLA FLOREANA','372','2','1','0.00','0.00'),(373,1,1,1013,1,2,17,'JORGE',' GARCÍA','C','1723871479','0000-00-00','','M','6004813','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.MEDICOS DE PICHINCHA CALLE B L-7 CUMBAYA','373','2','1','0.00','0.00'),(374,1,1,1013,1,2,17,'BOLÍVAR',' GÓMEZ','C','1718802034','0000-00-00','','M','2686824','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANDA','374','2','1','0.00','0.00'),(375,1,1,1013,1,2,17,'CÉSAR',' GUEVARA','C','1719040006','0000-00-00','','M','2689650','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.VILLARREAL C-65.B. URB.SAN BARTOLO','375','2','1','0.00','0.00'),(376,1,1,1013,1,2,17,'DENNIS',' GUZMÁN','C','1718548058','0000-00-00','','M','2568104','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN SALVADOR E780 Y PRADERA','376','2','1','0.00','0.00'),(377,1,1,1013,1,2,17,'LUIS',' MAILA','C','1721538906','0000-00-00','','M','2604139','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN VIZUETE. PIO XII','377','2','1','0.00','0.00'),(378,1,1,1013,1,2,17,'ROMEO',' MARÍN','C','1720882383','0000-00-00','','M','2924056','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALEMANIA 1225 Y REPÚBLICA','378','2','1','0.00','0.00'),(379,1,1,1013,1,2,17,'ÁNGEL',' MARTÍNEZ','C','1722692165','0000-00-00','','M','2555731','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BOGOTA OE 5-110 Y EE.UU','379','2','1','0.00','0.00'),(380,1,1,1013,1,2,17,'HÉCTOR',' MERA','C','1724050479','0000-00-00','','M','2643872','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ ALVEZ S8-373 Y PEDRO CEPERO','380','2','1','0.00','0.00'),(381,1,1,1013,1,2,17,'GALO',' MONTENEGRO','C','1722374939','0000-00-00','','M','2813183','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FCO. NIETO N49-146. LA LUZ','381','2','1','0.00','0.00'),(382,1,1,1013,1,2,17,'JORGE',' MORALES','C','1722243084','0000-00-00','','M','2669877','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','UPANO Y PILAHUIN # 92','382','2','1','0.00','0.00'),(383,1,1,1013,1,2,17,'PATRICIO',' MUÑOZ','C','1724224140','0000-00-00','','M','2619721','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO DE ALFARO OE 225 Y DÍAZ DE PINEDA','383','2','1','0.00','0.00'),(384,1,1,1013,1,2,17,'MARCELO',' NAVAS','C','1720960804','0000-00-00','','M','3102346','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ EGUSQUIZA Y ANDRÉS SEGUROLA # 146','384','2','1','0.00','0.00'),(385,1,1,1013,1,2,17,'MARCELO',' NOBOA','C','1723826416','0000-00-00','','M','2443785','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. LA GRANJA C-257','385','2','1','0.00','0.00'),(386,1,1,1013,1,2,17,'MARCELO',' NOBOA','C','1723826408','0000-00-00','','M','2433785','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA GRANJA C-257','386','2','1','0.00','0.00'),(387,1,1,1013,1,2,17,'HÉCTOR',' ORBE','C','1724225022','0000-00-00','','M','2348948','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN JOSÉ DEL VALLE','387','2','1','0.00','0.00'),(388,1,1,1013,1,2,17,'FAUSTO',' RISUEÑO','C','1720692563','0000-00-00','','M','2531565','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL SEMBLANTES 354. SAN PEDRO CLAVERT','388','2','1','0.00','0.00'),(389,1,1,1013,1,2,17,'ALEX',' ROMERO','C','1719897801','0000-00-00','','M','2661608','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO LONDOÑO 247 Y FCO. GÓMEZ','389','2','1','0.00','0.00'),(390,1,1,1013,1,2,17,'DARWIN',' SALVADOR','C','1724066848','0000-00-00','','M','2634663','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE G Y 6 # 534. CHILLOGALLO','390','2','1','0.00','0.00'),(391,1,1,1013,1,2,17,'VÍCTOR',' TORO','C','1724231327','0000-00-00','','M','3202507','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. BORJA 265 Y ALDAMA','391','2','1','0.00','0.00'),(392,1,1,1013,1,2,17,'RONALD',' TORRES','C','1722772611','0000-00-00','','M','3300727','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JÍBAROS 381 E INGAPIRCA','392','2','1','0.00','0.00'),(393,1,1,1013,1,2,17,'','','C','1724196280','0000-00-00','','M','3202374','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. 2 L-265 Y CALLE 4. BARRIO EL TRIGAL','393','2','1','0.00','0.00'),(394,1,1,1013,1,2,17,'IVÁN',' VALENZUELA','C','1722251418','0000-00-00','','M','2485070','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.REAL AUDIENCIA 49 Y NASACOLA PUENTO','394','2','1','0.00','0.00'),(395,1,1,1013,1,2,17,'JOFFRE',' VÉLEZ','C','1716636566','0000-00-00','','M','2500898','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EE.UU N14-53 Y RIOFRÍO','395','2','1','0.00','0.00'),(396,1,1,1013,1,2,17,'PATRICIO',' ZAMBRANO','C','1722706965','0000-00-00','','M','3319597','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.JARDINES DEL BOSQUE C-4','396','2','1','0.00','0.00'),(397,1,1,1013,1,2,17,'PAULO',' ZUMÁRRAGA','C','1724232515','0000-00-00','','M','2411685','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MURIALDO 2332 Y AV. 10 DE AGOSTO','397','2','1','0.00','0.00'),(398,1,1,1013,1,2,17,'WILSON',' ZURITA','C','1715587653','0000-00-00','','M','2625497','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP. UNION Y JUSTICIA L-9','398','2','1','0.00','0.00'),(399,1,1,1013,1,2,17,'FABIAN',' ALMEIDA','C','1720133568','0000-00-00','','M','2435866','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GRANDA CANTENO OE 4-270 Y CARANDOLET','399','2','1','0.00','0.00'),(400,1,1,1013,1,2,17,'ANTONIO',' BÁEZ','C','1722251442','0000-00-00','','M','2565724','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','J.PINTO E4-342 Y AMAZONAS','400','2','1','0.00','0.00'),(401,1,1,1013,1,2,17,'JOSÉ',' GONZÁLEZ','C','1718211822','0000-00-00','','M','2640576','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO JÁTIVA 168','401','2','1','0.00','0.00'),(402,1,1,1013,1,2,17,'PATRICIO',' CAICEDO','C','1717205759','0000-00-00','','M','2415413','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ZOILA DE UGARTE N52-110 Y CAP.R. BORJA','402','2','1','0.00','0.00'),(403,1,1,1013,1,2,17,'RUBÉN',' DÍAZ','C','1721351474','0000-00-00','','M','2264186','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARCHENA N42-138 Y GRANADOS','403','2','1','0.00','0.00'),(404,1,1,1013,1,2,17,'CELSO',' GUARANGO','C','1722318878','0000-00-00','','M','2065645','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARRIO COLLAS. CALDERÓN','404','2','1','0.00','0.00'),(405,1,1,1013,1,2,17,'WILMER',' LEIVA','C','1722856059','0000-00-00','','M','2801386','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ASTURIAS OE4-304 Y ALBERTO EINSTEIN','405','2','1','0.00','0.00'),(406,1,1,1013,1,2,17,'CÉSAR',' RODRÍGUEZ','C','1715500656','0000-00-00','','M','2630912','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO CONFORTE 225 Y CARLOS FREILE','406','2','1','0.00','0.00'),(407,1,1,1013,1,2,17,'JAIME',' ROMERO','C','1724196322','0000-00-00','','M','2282238','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONCEPCIÓN E5-75','407','2','1','0.00','0.00'),(408,1,1,1013,1,2,17,'VICTOR','ORTIZ','C','1718367731','0000-00-00','','M','2272365','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA Y OCCIDENTAL. CONJ.SANTA CRUZ D-22.B','408','2','1','0.00','0.00'),(409,1,1,1013,1,2,17,'NELSON',' BENAVIDES','C','','0000-00-00','','M','2521014','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TOLEDO N24-243 Y LUIS CORDERO','409','2','1','0.00','0.00'),(410,1,1,1013,1,2,17,'JUAN','LUZURIAGA','C','0106500374','0000-00-00','','M','2437704','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE E Y SEGUNDA TRANSVERSAL 4821. PINAR ALTO','410','2','1','0.00','0.00'),(411,1,1,1013,1,2,17,'','','C','1721345344','0000-00-00','','M','2451065','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS PEPINOS N47-52 ENTRE MADROÑOS Y MORTIÑOS','411','2','1','0.00','0.00'),(412,1,1,1013,1,2,17,'HERNÁN',' PERNETT','C','1722460795','0000-00-00','','M','3317046','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.REPÚBLICA Y P.BEDÓN 1-60','412','2','1','0.00','0.00'),(413,1,1,1013,1,2,17,'FERNANDO',' ALBORNOZ','C','1721839616','0000-00-00','','M','2485938','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. MARISOL III N71-193. ESTADIO DE LIGA','413','2','1','0.00','0.00'),(414,1,1,1013,1,2,17,'RAMIRO',' ALMEIDA','C','1717127987','0000-00-00','','M','2485014','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO RUIZ OE3-289','414','2','1','0.00','0.00'),(415,1,1,1013,1,2,17,'EDISON',' ALTAMIRANO','C','1722317292','0000-00-00','','M','2417300','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.CÉSAR FRANK E359 E ISAAC ALBÉNIZ','415','2','1','0.00','0.00'),(416,1,1,1013,1,2,17,'PABLO',' ANDRADE','C','1722998695','0000-00-00','','M','2450796','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNANDO DE LA CRUZ 650','416','2','1','0.00','0.00'),(417,1,1,1013,1,2,17,'EDWIN',' ARAGÓN','C','1722384540','0000-00-00','','M','2322253','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP.14 DE DICIEMBRE L-36. VALLE DE LOS CHILLOS','417','2','1','0.00','0.00'),(418,1,1,1013,1,2,17,'BOLÍVAR',' ARCOS','C','1718166521','0000-00-00','','M','2264557','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TURREY 124 Y M. JOFRE','418','2','1','0.00','0.00'),(419,1,1,1013,1,2,17,'LUIS',' ARMAS','C','1720926938','0000-00-00','','M','2622667','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.AMARANTA D-105.D VIA A LOS CHILLOS.','419','2','1','0.00','0.00'),(420,1,1,1013,1,2,17,'ALBERTO',' ASTUDILLO','C','1720807120','0000-00-00','','M','2259720','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISLA MARCHENA N41-31 Y GRANADOS','420','2','1','0.00','0.00'),(421,1,1,1013,1,2,17,'WASHINGTON',' AYALA','C','1723068639','0000-00-00','','M','2545306','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TOLEDO 10-51 Y MADRID D-801','421','2','1','0.00','0.00'),(422,1,1,1013,1,2,17,'EDGAR',' BALDEÓN','C','1721155966','0000-00-00','','M','3283699','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS ANONAS 103.A Y CHOLANES','422','2','1','0.00','0.00'),(423,1,1,1013,1,2,17,'LUIS',' BARZALLO','C','1716632946','0000-00-00','','M','2410220','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','APARICIO RIVADENEIRA E6-86','423','2','1','0.00','0.00'),(424,1,1,1013,1,2,17,'RAMIRO',' BARROS','C','1722818927','0000-00-00','','M','2316135','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PABLO GUARDERAS 3RA. TRANS. S/N. MACHACHI','424','2','1','0.00','0.00'),(425,1,1,1013,1,2,17,'DIEGO',' BASTIDAS','C','1715463285','0000-00-00','','M','2491610','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','J.F.KENNEDY Y P. RUBENS OE4-33','425','2','1','0.00','0.00'),(426,1,1,1013,1,2,17,'MERVAN',' BEKTESEVIC','C','1723340269','0000-00-00','','M','2266634','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARTÍN UTRERAS 743','426','2','1','0.00','0.00'),(427,1,1,1013,1,2,17,'KLÉBER',' BONILLA','C','1722899430','0000-00-00','','M','2694225','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LA ECUATORIANA OE6-16','427','2','1','0.00','0.00'),(428,1,1,1013,1,2,17,'NORBERTO',' BRAVO','C','1718901562','0000-00-00','','M','2401618','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO GUARDERAS C-01','428','2','1','0.00','0.00'),(429,1,1,1013,1,2,17,'GALO',' BUITRÓN','C','1720504487','0000-00-00','','M','3300992','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HOMERO SALAS OE3-157 Y BRASIL','429','2','1','0.00','0.00'),(430,1,1,1013,1,2,17,'JOSÉ','BURNEO','C','1723297410','0000-00-00','','M','3228580','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VERDECRUZ 557 Y ANTONIO SIERRA','430','2','1','0.00','0.00'),(431,1,1,1013,1,2,17,'RAÚL',' CACHOTE','C','1723248199','0000-00-00','','M','3260691','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HORTENCIAS L-28 Y TORONJAS','431','2','1','0.00','0.00'),(432,1,1,1013,1,2,17,'LUIS',' CAICEDO','C','1723090328','0000-00-00','','M','2672379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE Y S28-130. TURUBAMBA','432','2','1','0.00','0.00'),(433,1,1,1013,1,2,17,'BYRON',' CAJAS','C','1723131619','0000-00-00','','M','98506991','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.BILOXI CALLE H MEIVER S17-61','433','2','1','0.00','0.00'),(434,1,1,1013,1,2,17,'GEOVANNY',' CALLE','C','1723060578','0000-00-00','','M','2412479','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MORLÁN 2239 Y CAPITÁN BORJA','434','2','1','0.00','0.00'),(435,1,1,1013,1,2,17,'MARCELO',' CARRILLO','C','1723306179','0000-00-00','','M','3215942','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. DIEGO HERRERA 253','435','2','1','0.00','0.00'),(436,1,1,1013,1,2,17,'MARCO','CASARES','C','1721673778','0000-00-00','','M','2660375','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO BAQUERIZO S8-62. LA MAGDALENA','436','2','1','0.00','0.00'),(437,1,1,1013,1,2,17,'SEGUNDO',' CASTILLO','C','1719754705','0000-00-00','','M','2484701','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. MARISOL CALLE 9 N68-82','437','2','1','0.00','0.00'),(438,1,1,1013,1,2,17,'DIEGO',' CEVALLOS','C','1718863978','0000-00-00','','M','2535096','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FLORENCIO ESPINOZA N56-71 Y CARLOS V.','438','2','1','0.00','0.00'),(439,1,1,1013,1,2,17,'JIMMY',' CHÁVEZ','C','1717318024','0000-00-00','','M','3411377','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LEGARDA Y 4TA.TRANVERSAL N64-94','439','2','1','0.00','0.00'),(440,1,1,1013,1,2,17,'MIGUEL',' CHÁVEZ','C','1716025471','0000-00-00','','M','2432970','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA FLORIDA OE3-74','440','2','1','0.00','0.00'),(441,1,1,1013,1,2,17,'NÉSTOR',' CHÁVEZ','C','1721402681','0000-00-00','','M','2292646','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','5TA.TRANS. Y LEGARDA C-13. COTOCOLLAO','441','2','1','0.00','0.00'),(442,1,1,1013,1,2,17,'JORGE',' CHERRES','C','1722385778','0000-00-00','','M','3443418','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LIBORIO MADERA L-8','442','2','1','0.00','0.00'),(443,1,1,1013,1,2,17,'MARCO','CHIRIBOGA','C','1718166596','0000-00-00','','M','2524989','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITTER N19-211 Y AV.UNIVERSITARIA','443','2','1','0.00','0.00'),(444,1,1,1013,1,2,17,'JUAN',' CHIRIBOGA','C','1721230843','0000-00-00','','M','2490961','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN JOSÉ DEL CONDADO O4-403','444','2','1','0.00','0.00'),(445,1,1,1013,1,2,17,'AUGUSTO',' CISNEROS','C','1717156697','0000-00-00','','M','2592737','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. DE LA PRENSA N63-262','445','2','1','0.00','0.00'),(446,1,1,1013,1,2,17,'HUGO',' CORREA','C','1722942743','0000-00-00','','M','2534344','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.ESTORIL D-B.22 BL.B. J.GARZÓN Y P.FREILE','446','2','1','0.00','0.00'),(447,1,1,1013,1,2,17,'JOSÉ',' DE LA TORRE','C','1718161548','0000-00-00','','M','2229134','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ULLOA N31-67 Y SAN GABRIEL','447','2','1','0.00','0.00'),(448,1,1,1013,1,2,17,'VÍCTOR',' DELGADO','C','1723152615','0000-00-00','','M','2081078','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. YAGUACHI L-23. SAN RAFAEL','448','2','1','0.00','0.00'),(449,1,1,1013,1,2,17,'JUAN','DÍAZ','C','1721824371','0000-00-00','','M','2223940','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAMÓN EGAS 250 E IQUIQUE','449','2','1','0.00','0.00'),(450,1,1,1013,1,2,17,'JUAN',' DONOSO','C','1721994554','0000-00-00','','M','2537941','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARÍA TIGSILEMA N60-106','450','2','1','0.00','0.00'),(451,1,1,1013,1,2,17,'PABLO',' ESPINOSA','C','1716306517','0000-00-00','','M','2297891','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ELISIO FLOR N62-31 Y RIGOBERTO HEREDIA','451','2','1','0.00','0.00'),(452,1,1,1013,1,2,17,'LEONARDO',' ESPINOZA','C','1720364429','0000-00-00','','M','2345242','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ABDÓN CALDERÓN Y STA. ROSA L-8. CONOCOTO','452','2','1','0.00','0.00'),(453,1,1,1013,1,2,17,'MANUEL',' ESPÍN','C','1718166141','0000-00-00','','M','2226212','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CHECA Y MANUEL LARREA OE2-82','453','2','1','0.00','0.00'),(454,1,1,1013,1,2,17,'WASHINGTON',' ERAZO','C','1721719266','0000-00-00','','M','2535162','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SABANILLA 419 Y GUALAQUIZA','454','2','1','0.00','0.00'),(455,1,1,1013,1,2,17,'PATRICIO',' ESTRELLA','C','1723301956','0000-00-00','','M','2486144','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.NUEVO AMANECER BL-12.D D-404.D','455','2','1','0.00','0.00'),(456,1,1,1013,1,2,17,'MARCELO',' FLORES','C','1718587791','0000-00-00','','M','2895968','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS GUABOS CALLE C L-87','456','2','1','0.00','0.00'),(457,1,1,1013,1,2,17,'JULIO',' FREIRE','C','1717438145','0000-00-00','','M','2256477','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.TORTUGA 725 Y AMAZONAS','457','2','1','0.00','0.00'),(458,1,1,1013,1,2,17,'PATRICIO',' GALARZA','C','1723301402','0000-00-00','','M','2479296','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN DE SELIS Y MARIANO POZO','458','2','1','0.00','0.00'),(459,1,1,1013,1,2,17,'EDUARDO',' GARCÉS','C','1718165291','0000-00-00','','M','2246541','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA 812 Y VASCO DE CONTRERAS. COND. PIZARRO','459','2','1','0.00','0.00'),(460,1,1,1013,1,2,17,'GALO',' GARCÉS','C','1723251599','0000-00-00','','M','2477035','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE D 49-129 Y MANUEL VALDIVIESO C-3. PINAR ALTO','460','2','1','0.00','0.00'),(461,1,1,1013,1,2,17,'JOSÉ','GÓMEZ DE LA TORRE','C','1714508759','0000-00-00','','M','2405353','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL ÁLVAREZ CORTEZ 343 Y JOSÉ GOLE','461','2','1','0.00','0.00'),(462,1,1,1013,1,2,17,'ALEJANDRO',' GONZÁLEZ','C','1718165481','0000-00-00','','M','3201128','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BALCÓN METROPOLITANO BL-C D-410. D.DE LA MADR','462','2','1','0.00','0.00'),(463,1,1,1013,1,2,17,'CHRISTIAN',' GORDILLO','C','1719536987','0000-00-00','','M','2811489','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RUDECINDO LESANA E7-55 Y LOS PINOS. KENNEDY','463','2','1','0.00','0.00'),(464,1,1,1013,1,2,17,'AUGUSTO',' GUADALUPE','C','1714554688','0000-00-00','','M','2597600','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LA CORDILLERA C-56. SAN CARLOS','464','2','1','0.00','0.00'),(465,1,1,1013,1,2,17,'JORGE',' GUERRERO','C','1723301618','0000-00-00','','M','2820225','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. SAN JOSÉ 153-B','465','2','1','0.00','0.00'),(466,1,1,1013,1,2,17,'RAMIRO',' GUIJARRO','C','1723305569','0000-00-00','','M','2587346','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TAPI 258  Y GUATEMALA','466','2','1','0.00','0.00'),(467,1,1,1013,1,2,17,'HARLINTON',' HIDALGO','C','1721391264','0000-00-00','','M','2251688','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. LA FLORIDA 843','467','2','1','0.00','0.00'),(468,1,1,1013,1,2,17,'IVÁN',' HINOJOSA','C','1717313132','0000-00-00','','M','3201173','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. 1 OE831 Y DOMINGO ESPINAR','468','2','1','0.00','0.00'),(469,1,1,1013,1,2,17,'EDISON',' LAGOS','C','1721202370','0000-00-00','','M','2647228','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO CAPIRO 646 Y LEXO BRUIS. URB.BARRIO NUEVO','469','2','1','0.00','0.00'),(470,1,1,1013,1,2,17,'JUAN','LATORRE','C','1722444062','0000-00-00','','M','2470460','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ CARBO N78-41','470','2','1','0.00','0.00'),(471,1,1,1013,1,2,17,'JACINTO',' LOAYZA','C','1720623147','0000-00-00','','M','2234784','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. AMÉRICA N31-30 Y SAN GABRIEL','471','2','1','0.00','0.00'),(472,1,1,1013,1,2,17,'ÁNGEL',' LOAYZA','C','1720858461','0000-00-00','','M','2652775','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ PERALTA S13-268','472','2','1','0.00','0.00'),(473,1,1,1013,1,2,17,'EDWIN',' LÓPEZ','C','0503384364','0000-00-00','','M','3112400','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL CALZADO MZ-47 C-16','473','2','1','0.00','0.00'),(474,1,1,1013,1,2,17,'GEOVANNY',' LÓPEZ','C','1722466677','0000-00-00','','M','2652811','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN DE ARGUELLO 509 Y P.DORADO','474','2','1','0.00','0.00'),(475,1,1,1013,1,2,17,'PEDRO',' LÓPEZ','C','1723297691','0000-00-00','','M','2603316','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. LUIS A.VALENCIA SEC.1 D-5011. SOLANDA','475','2','1','0.00','0.00'),(476,1,1,1013,1,2,17,'HERNÁN',' LÓPEZ','C','1718908757','0000-00-00','','M','3317100','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TERESA DE CEPEDA N34-246 Y REPÚBLICA','476','2','1','0.00','0.00'),(477,1,1,1013,1,2,17,'RAMIRO',' LUNA','C','1723114805','0000-00-00','','M','2643164','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CERRO HERMOSO E2-179. CHIMBACALLE','477','2','1','0.00','0.00'),(478,1,1,1013,1,2,17,'GUSTAVO',' MAFLA','C','1716384787','0000-00-00','','M','2860263','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.ROBLE ANTIGUO 37.A.  SAN RAFAEL','478','2','1','0.00','0.00'),(479,1,1,1013,1,2,17,'CARLOS',' MANZANO','C','1722703814','0000-00-00','','M','2297255','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. EL PINAR C-76','479','2','1','0.00','0.00'),(480,1,1,1013,1,2,17,'JORGE',' MARTÍNEZ','C','1722044409','0000-00-00','','M','2418755','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ BARREIRO E12-22 Y DE LOS ÁLAMOS','480','2','1','0.00','0.00'),(481,1,1,1013,1,2,17,'ROBERTO',' MARTÍNEZ','C','1722928114','0000-00-00','','M','3412634','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LA ALHAMBRA TORRE 3 D-504. MACHALA Y SABANILL','481','2','1','0.00','0.00'),(482,1,1,1013,1,2,17,'NELSON',' MEJÍA','C','1717460065','0000-00-00','','M','2604030','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAQUISILÍ 429. PÍO XII','482','2','1','0.00','0.00'),(483,1,1,1013,1,2,17,'CÉSAR',' MENA','C','1716849078','0000-00-00','','M','2630276','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JULIAN ESTRELLA OE9-77. CHILLOGALLO','483','2','1','0.00','0.00'),(484,1,1,1013,1,2,17,'EDISON',' MERLO','C','1721158655','0000-00-00','','M','2481956','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AMESABA Y 10 DE AGOSTO. COND.NUEVO AMANECER','484','2','1','0.00','0.00'),(485,1,1,1013,1,2,17,'MARCO',' MIRANDA','C','1721190369','0000-00-00','','M','2282625','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','POMASQUI 9141 Y PEDRO ANDRADE','485','2','1','0.00','0.00'),(486,1,1,1013,1,2,17,'FREDY',' MONTALVO','C','1723242499','0000-00-00','','M','3131103','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LULUNCOTO III ETAPA MZ-4 C-6','486','2','1','0.00','0.00'),(487,1,1,1013,1,2,17,'CARLOS',' MORALES','C','1718164682','0000-00-00','','M','2909646','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ACUÑA 439 Y VERSALLES','487','2','1','0.00','0.00'),(488,1,1,1013,1,2,17,'RENÉ',' MOREJÓN','C','1719007641','0000-00-00','','M','98125003','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VIÑEDOS Y VENEZUELA. TERRACOTA G. C-22','488','2','1','0.00','0.00'),(489,1,1,1013,1,2,17,'CARLOS',' MOSQUERA','C','1721730701','0000-00-00','','M','2336407','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SUCRE 268. SANGOLQUÍ','489','2','1','0.00','0.00'),(490,1,1,1013,1,2,17,'GUILLERMO',' MUÑOZ','C','0918043399','0000-00-00','','M','2271605','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BORGROIS 359 Y TERESA CEPEDA','490','2','1','0.00','0.00'),(491,1,1,1013,1,2,17,'TITO',' MONTERO','C','1722945282','0000-00-00','','M','2263287','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE A #41 Y SAN GABRIEL','491','2','1','0.00','0.00'),(492,1,1,1013,1,2,17,'+',' +','C','1717513780','0000-00-00','','M','2842103','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. MARISCAL SUCRE S12-52','492','2','1','0.00','0.00'),(493,1,1,1013,1,2,17,'JOSÉ',' NARVÁEZ','C','1723245237','0000-00-00','','M','2660248','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GONZALO DE PINEDA 309','493','2','1','0.00','0.00'),(494,1,1,1013,1,2,17,'OLEG',' TRAMSYUK','C','1719013672','0000-00-00','','M','2274419','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SHYRIS 41-151 E ISLA FLOREANA','494','2','1','0.00','0.00'),(495,1,1,1013,1,2,17,'FERNANDO',' NOLIVOS','C','1723128086','0000-00-00','','M','2529015','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA GASCA CALLE RITER 969','495','2','1','0.00','0.00'),(496,1,1,1013,1,2,17,'ÁNGEL',' ORELLANA','C','1719225300','0000-00-00','','M','3227988','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANO Y LA CONDAMINE TORRE 26 S-3. LA VICENTINA','496','2','1','0.00','0.00'),(497,1,1,1013,1,2,17,'EVERLI',' ORELLANA','C','1723352769','0000-00-00','','M','2893430','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GARCÍA MORENO 525. CUMBAYÁ','497','2','1','0.00','0.00'),(498,1,1,1013,1,2,17,'JULIO',' ORMAZA','C','1723285241','0000-00-00','','M','2649371','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUALCOPO S8-523 Y HUSARES','498','2','1','0.00','0.00'),(499,1,1,1013,1,2,17,'JORGE',' OROZCO','C','1716632409','0000-00-00','','M','2660376','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MULTI E5-62 Y JÁTIVA','499','2','1','0.00','0.00'),(500,1,1,1013,1,2,17,'LUIS',' OTERO','C','1718165408','0000-00-00','','M','2561861','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BOGOTÁ 720 Y VENEZUELA','500','2','1','0.00','0.00'),(501,1,1,1013,1,2,17,'MARCELO',' PADILLA','C','1722110523','0000-00-00','','M','2622517','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CANELOS S11-12','501','2','1','0.00','0.00'),(502,1,1,1013,1,2,17,'GONZALO',' PARRA','C','1104213358','0000-00-00','','M','2671582','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.ORANGINE PAS.B. S15-96. SAN BARTOLO','502','2','1','0.00','0.00'),(503,1,1,1013,1,2,17,'NELSON',' PAZMIÑO','C','1719320689','0000-00-00','','M','2653083','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GONZALO MARÍN E2-128','503','2','1','0.00','0.00'),(504,1,1,1013,1,2,17,'EDDY',' PÈREZ','C','1719347237','0000-00-00','','M','2223424','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITTER Y BENJAMÍN CHÁVEZ 1434','504','2','1','0.00','0.00'),(505,1,1,1013,1,2,17,'PEDRO',' PIEDRA','C','1719218784','0000-00-00','','M','2953220','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISLA GENOVESA N42-130','505','2','1','0.00','0.00'),(506,1,1,1013,1,2,17,'FÉLIX',' PIJAL','C','1717716839','0000-00-00','','M','2613272','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL DE TRUJILLO L-55 Y BOBONAZA','506','2','1','0.00','0.00'),(507,1,1,1013,1,2,17,'PATRICIO',' PIÑAS','C','1723118871','0000-00-00','','M','2602123','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS ORQUIDEAS CALLE 4-3  C-1916','507','2','1','0.00','0.00'),(508,1,1,1013,1,2,17,'JOSÉ',' PONCE','C','1723302988','0000-00-00','','M','2891780','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INTEROCEÁNICA 2705 Y MANABÍ. CUMBAYÁ','508','2','1','0.00','0.00'),(509,1,1,1013,1,2,17,'CAMILO',' PONCE','C','1720645835','0000-00-00','','M','2354970','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. PUSUQUÍ. CEL 2-53','509','2','1','0.00','0.00'),(510,1,1,1013,1,2,17,'SERGIO',' PORTUGAL','C','1718127960','0000-00-00','','M','2482476','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ELOY ALFARO N74-196','510','2','1','0.00','0.00'),(511,1,1,1013,1,2,17,'OSCAR',' POZO','C','1723122766','0000-00-00','','M','2596473','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FERNANDO TINAJERO OE7-253','511','2','1','0.00','0.00'),(512,1,1,1013,1,2,17,'LUIS',' PROAÑO','C','1720105038','0000-00-00','','M','2528307','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIOFRÍO N16-34','512','2','1','0.00','0.00'),(513,1,1,1013,1,2,17,'JHONNY',' PRÓCEL','C','1722216213','0000-00-00','','M','2498337','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. SHELTON. CARCELÉN','513','2','1','0.00','0.00'),(514,1,1,1013,1,2,17,'JORGE',' PUERTAS','C','1720358926','0000-00-00','','M','2525411','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VALPARAISO N12-83 Y CASTRO','514','2','1','0.00','0.00'),(515,1,1,1013,1,2,17,'PATRICIO',' QUEZADA','C','1721867123','0000-00-00','','M','2527797','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ACUÑA OE3-284 Y AMÉRICA','515','2','1','0.00','0.00'),(516,1,1,1013,1,2,17,'EDWIN',' RAMOS','C','1719561233','0000-00-00','','M','2495321','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ M. ARTETA L-108','516','2','1','0.00','0.00'),(517,1,1,1013,1,2,17,'JORGE',' RECALDE','C','1723262745','0000-00-00','','M','2952277','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CHIMBORAZO 170 Y AV.MARISCAL SUCRE','517','2','1','0.00','0.00'),(518,1,1,1013,1,2,17,'RODRIGO',' REYES','C','1723124184','0000-00-00','','M','2350061','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA PAMPA II # 193','518','2','1','0.00','0.00'),(519,1,1,1013,1,2,17,'YENÁN',' REYES','C','1722653431','0000-00-00','','M','3215346','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BOLIVIA 973 Y AV.UNIVERSITARIA','519','2','1','0.00','0.00'),(520,1,1,1013,1,2,17,'JUAN',' REYES','C','1723296602','0000-00-00','','M','2295440','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. DEL MAESTRO','520','2','1','0.00','0.00'),(521,1,1,1013,1,2,17,'CARLOS',' RIVADENEIRA','C','1718166190','0000-00-00','','M','2955103','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN FRANCISCO 525. SAN RAFAEL','521','2','1','0.00','0.00'),(522,1,1,1013,1,2,17,'PATRICIO',' ROMERO','C','1722228226','0000-00-00','','M','2974977','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL CONDE 3 C-116. SAN BARTOLO','522','2','1','0.00','0.00'),(523,1,1,1013,1,2,17,'JORGE',' ROMERO','C','1722314554','0000-00-00','','M','99908421','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN DE SELIS N76-176','523','2','1','0.00','0.00'),(524,1,1,1013,1,2,17,'EDISON',' ROMO','C','1718166489','0000-00-00','','M','3280045','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ BUSTOS E13-47 Y GUAYACANES','524','2','1','0.00','0.00'),(525,1,1,1013,1,2,17,'BOLÍVAR',' ROSERO','C','1720439742','0000-00-00','','M','2484790','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FCO. RUIZ OE3-19. CARCELÉN','525','2','1','0.00','0.00'),(526,1,1,1013,1,2,17,'MILTON',' RUIZ','C','1723203459','0000-00-00','','M','2272203','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. AMÉRICA 4285','526','2','1','0.00','0.00'),(527,1,1,1013,1,2,17,'PIER',' RUZZI','C','1723249403','0000-00-00','','M','2634156','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. BILOXI 116','527','2','1','0.00','0.00'),(528,1,1,1013,1,2,17,'PATRICIO',' SÁENZ','C','0502436934','0000-00-00','','M','2072285','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. PICHINCHA 23-60. CONOCOTO','528','2','1','0.00','0.00'),(529,1,1,1013,1,2,17,'MIGUEL','SALAZAR','C','1721447504','0000-00-00','','M','2537286','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','QUITUMBE 6048 Y AV. DEL MAESTRO','529','2','1','0.00','0.00'),(530,1,1,1013,1,2,17,'GIOVANNY',' SEGOVIA','C','1722252549','0000-00-00','','M','3215943','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EUSTORGIO SALGADO Y STA. ROSA','530','2','1','0.00','0.00'),(531,1,1,1013,1,2,17,'DIEGO',' SILVA','C','1718170473','0000-00-00','','M','3303083','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.SAN FELIPE DEL PINAR BL-6 D-104','531','2','1','0.00','0.00'),(532,1,1,1013,1,2,17,'CARLOS',' SILVA','C','1722622873','0000-00-00','','M','2664568','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAÑARIS OE5-68 Y DUCHICELA','532','2','1','0.00','0.00'),(533,1,1,1013,1,2,17,'EDISON',' SINGAÑA','C','1720599578','0000-00-00','','M','2958931','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ORIENTE OE3-77 Y GUAYAQUIL','533','2','1','0.00','0.00'),(534,1,1,1013,1,2,17,'IVÁN',' SOLÍS','C','1723301154','0000-00-00','','M','2429190','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JARDINES DE CARCELÉN D-18','534','2','1','0.00','0.00'),(535,1,1,1013,1,2,17,'FABIÁN',' SUBÍA','C','1718165077','0000-00-00','','M','2226337','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LORENZO ALDANA 157 Y AMÉRICA','535','2','1','0.00','0.00'),(536,1,1,1013,1,2,17,'ENRIQUE',' SUZA','C','1722214846','0000-00-00','','M','2822660','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CASALES BUENAVENTURA 2DA.ETAPA C-120','536','2','1','0.00','0.00'),(537,1,1,1013,1,2,17,'ENRIQUE',' TERÁN','C','1716392442','0000-00-00','','M','3200619','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BERRUTIETA OE9-98 Y RITTER','537','2','1','0.00','0.00'),(538,1,1,1013,1,2,17,'CARLOS',' TOBAR','C','1723296669','0000-00-00','','M','2471339','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO SÁNCHEZ N78-134 Y COSME OSORIO. CARCELÉN','538','2','1','0.00','0.00'),(539,1,1,1013,1,2,17,'ENRIQUE',' TORO','C','1722465356','0000-00-00','','M','2558898','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SENIERGUES 228 Y SOLANO','539','2','1','0.00','0.00'),(540,1,1,1013,1,2,17,'FERNANDO',' TORRES','C','1717639403','0000-00-00','','M','2597074','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SEBASTIÁN BUARA N60-51 Y AV.DEL MAESTRO','540','2','1','0.00','0.00'),(541,1,1,1013,1,2,17,'RENÉ',' TORRES','C','1719996942','0000-00-00','','M','3202174','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITHER N23-67. LA GASCA','541','2','1','0.00','0.00'),(542,1,1,1013,1,2,17,'JOSÉ',' TRUJILLO','C','1723244495','0000-00-00','','M','2961282','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAFAEL GARCÍA.CHILLOGALLO','542','2','1','0.00','0.00'),(543,1,1,1013,1,2,17,'PATRICIO',' TRUJILLO','C','1723258321','0000-00-00','','M','2471578','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ ENRIQUE GUERRERO 84','543','2','1','0.00','0.00'),(544,1,1,1013,1,2,17,'WASHINGTON',' URBANO','C','1722406863','0000-00-00','','M','2675031','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE OE2.B C-26. URB. QUITUMBE','544','2','1','0.00','0.00'),(545,1,1,1013,1,2,17,'GUIDO',' URQUIA','C','1722373063','0000-00-00','','M','3316178','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COCHAPAMBA SUR','545','2','1','0.00','0.00'),(546,1,1,1013,1,2,17,'ALEJANDRO',' URRESTA','C','1716601339','0000-00-00','','M','2482613','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LLANGARIMA 667 Y TUFIÑO','546','2','1','0.00','0.00'),(547,1,1,1013,1,2,17,'ISAAC',' VACA','C','1716623259','0000-00-00','','M','2499997','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','STA.TERESA N70-160 Y ALFONSO DEL HIERRO','547','2','1','0.00','0.00'),(548,1,1,1013,1,2,17,'CÉSAR',' VALENCIA','C','1721253274','0000-00-00','','M','2616669','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO COLLAZOS S7-166 Y ALPAHUASI','548','2','1','0.00','0.00'),(549,1,1,1013,1,2,17,'WILLIAM',' VALENCIA','C','1722956818','0000-00-00','','M','2893241','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.EX-CEPE CALLE BR 1 L-184. CUMBAYÁ','549','2','1','0.00','0.00'),(550,1,1,1013,1,2,17,'JAIME',' VALENCIA','C','1718862210','0000-00-00','','M','2354748','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. LA JOYA #39','550','2','1','0.00','0.00'),(551,1,1,1013,1,2,17,'NÉSTOR',' VALENZUELA','C','1723123491','0000-00-00','','M','2395984','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE PULULAHUA 870. MITAD DEL MUNDO','551','2','1','0.00','0.00'),(552,1,1,1013,1,2,17,'WILSON',' VALVERDE','C','1720097698','0000-00-00','','M','2655038','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN BORGOÑÓN S8-175 Y J. ALCÁZAR','552','2','1','0.00','0.00'),(553,1,1,1013,1,2,17,'MODESTO',' VASCO','C','1721593232','0000-00-00','','M','2341571','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA ARMENIA CALLE 1-10 #313','553','2','1','0.00','0.00'),(554,1,1,1013,1,2,17,'','','C','1723065338','0000-00-00','','M','2667804','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN LAGOS OE639 Y PEDRO CAPIRO','554','2','1','0.00','0.00'),(555,1,1,1013,1,2,17,'JUAN',' CARLOS VÁSCONEZ','C','0201905932','0000-00-00','','M','2439922','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN GALINDEZ 111 Y 10 DE AGOSTO','555','2','1','0.00','0.00'),(556,1,1,1013,1,2,17,'JUAN',' VILLAGÓMEZ','C','1722976212','0000-00-00','','M','2669712','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ MENDOZA OE5-53','556','2','1','0.00','0.00'),(557,1,1,1013,1,2,17,'ROBERTO',' YAJAMÍN','C','1721356978','0000-00-00','','M','2536707','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA TERESA N65-110 Y LIBERTADORES. COTOCOLLAO','557','2','1','0.00','0.00'),(558,1,1,1013,1,2,17,'PEDRO',' YÁNEZ','C','1718166562','0000-00-00','','M','2641617','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANA PAREDES DE ALFARO S9-465','558','2','1','0.00','0.00'),(559,1,1,1013,1,2,17,'MARIO',' YÁNEZ','C','1720409141','0000-00-00','','M','2682809','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANDA.','559','2','1','0.00','0.00'),(560,1,1,1013,1,2,17,'EDGAR',' YUNDA','C','1720350006','0000-00-00','','M','3194758','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAMPIÑAS DEL MADRIGAL L-4','560','2','1','0.00','0.00'),(561,1,1,1013,1,2,17,'KENEDY',' ZAMBRANO','C','1716028145','0000-00-00','','M','3571249','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE B L-25 C-5 Y CALLE A. PINAR ALTO','561','2','1','0.00','0.00'),(562,1,1,1013,1,2,17,'MARCO',' ZURITA','C','1721474680','0000-00-00','','M','2669451','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA. EL CALZADO MZ-9 C-20','562','2','1','0.00','0.00'),(563,1,1,1013,1,2,17,'CHRISTIAN',' MIRANDA','C','1718171844','0000-00-00','','M','2473754','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.FONTANA DEL SOL C-16. PONCIANO','563','2','1','0.00','0.00'),(564,1,1,1013,1,2,17,'PATRICIO',' LLERENA','C','1722002407','0000-00-00','','M','2821436','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE C Y PUNÍN S/N. CALDERÓN','564','2','1','0.00','0.00'),(565,1,1,1013,1,2,17,'MARCO',' LUNA','C','1718321993','0000-00-00','','M','2223368','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.TERRAZAS DEL DORADO BL-6 D-505. AV.COLOMBIA Y','565','2','1','0.00','0.00'),(566,1,1,1013,1,2,17,'RODRIGO',' MARTÍNEZ','C','1723253710','0000-00-00','','M','2443379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS MALVAS N45-135 E HIGUERAS','566','2','1','0.00','0.00'),(567,1,1,1013,1,2,17,'JOSÉ',' TRÁVEZ','C','1717201170','0000-00-00','','M','3227844','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANO E15-45 Y SÁENZ','567','2','1','0.00','0.00'),(568,1,1,1013,1,2,17,'FREDY',' PERALTA','C','1719271296','0000-00-00','','M','2314202','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PÉREZ PAREJA 511 Y LUIS CORDERO. MACHACHI','568','2','1','0.00','0.00'),(569,1,1,1013,1,2,17,'ÁNGEL',' SANTANA','C','1723114813','0000-00-00','','M','2665944','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARENILLAS 209 Y GRAL.PINTAG','569','2','1','0.00','0.00'),(570,1,1,1013,1,2,17,'ÁNGEL',' FREIRE','C','1723120539','0000-00-00','','M','2412871','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUAYACANES N55-29 Y LOS PINOS','570','2','1','0.00','0.00'),(571,1,1,1013,1,2,17,'EDDY',' SÁNCHEZ','C','1714599600','0000-00-00','','M','3300289','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JAIME CHIRIBOGA 261','571','2','1','0.00','0.00'),(572,1,1,1013,1,2,17,'LEÓN',' MERCHÁN','C','1719302331','0000-00-00','','M','3216790','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PORTOVIEJO OE3-367 Y AYACUCHO','572','2','1','0.00','0.00'),(573,1,1,1013,1,2,17,'GERMÁN',' BACA','C','1719253120','0000-00-00','','M','2548655','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TEGUCIGALPA 367 Y AGUILAR','573','2','1','0.00','0.00'),(574,1,1,1013,1,2,17,'RICARDO',' BASTIDAS','C','1713922969','0000-00-00','','M','2462997','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','YUMBOS N50-245 Y HOMERO SALAS','574','2','1','0.00','0.00'),(575,1,1,1013,1,2,17,'VICENTE',' CARRIÓN','C','1002772521','0000-00-00','','M','2956583','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VENEZUELA N13-111 Y ANTONIO ANTE','575','2','1','0.00','0.00'),(576,1,1,1013,1,2,17,'ELICIO',' LEDESMA','C','1718165358','0000-00-00','','M','2240334','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA 397 Y AV. REPÚBLICA','576','2','1','0.00','0.00'),(577,1,1,1013,1,2,17,'JOSÉ',' MARCILLO','C','1721491650','0000-00-00','','M','2334385','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SUCRE 118 Y BOLÍVAR. SANGOLQUÍ.','577','2','1','0.00','0.00'),(578,1,1,1013,1,2,17,'CARLOS',' MOLINA','C','1723245351','0000-00-00','','M','2639685','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JULIAN ESTRELLA 1766 Y LAUREANO DE LA CRUZ','578','2','1','0.00','0.00'),(579,1,1,1013,1,2,17,'EDGAR',' VILLAMIL','C','1722946629','0000-00-00','','M','2813415','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ROBERTO PÁEZ N49-59. LA LUZ','579','2','1','0.00','0.00'),(580,1,1,1013,1,2,17,'MANUEL',' VINUEZA','C','1723134662','0000-00-00','','M','3217021','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARACAS OE3-216 Y VENEZUELA','580','2','1','0.00','0.00'),(581,1,1,1013,1,2,17,'EDWIN',' VALVERDE','C','1718166471','0000-00-00','','M','3452203','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EUGENIO PEYRAMALE E12-14 Y A.ESPINOZA','581','2','1','0.00','0.00'),(582,1,1,1013,1,2,17,'ALEJANDRO',' PONCE','C','1803673548','0000-00-00','','M','2627852','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TNT. HUGO ORTIZ S15-79','582','2','1','0.00','0.00'),(583,1,1,1013,1,2,17,'VÍCTOR',' ACOSTA','C','1717344475','0000-00-00','','M','2292290','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. SAN PEDRO CLAVER BL. AD-66','583','2','1','0.00','0.00'),(584,1,1,1013,1,2,17,'FLAVIO',' CARPIO','C','1722017322','0000-00-00','','M','2320770','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EDÉN DEL VALLE PAS.P E18-260','584','2','1','0.00','0.00'),(585,1,1,1013,1,2,17,'JAIME',' CORONEL','C','1718165010','0000-00-00','','M','2425139','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL VERGEL Y A.PÉREZ CONJ.EL PIONERO BL.9 D-5B','585','2','1','0.00','0.00'),(586,1,1,1013,1,2,17,'JAIME',' MATA','C','1723297295','0000-00-00','','M','2282678','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ESPEJO Y JIMÉNEZ CONJ.IESS','586','2','1','0.00','0.00'),(587,1,1,1013,1,2,17,'PATRICIO',' MORENO','C','1721537668','0000-00-00','','M','2951321','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO ZUMÁRRAGA 221','587','2','1','0.00','0.00'),(588,1,1,1013,1,2,17,'HERNÁN',' PÉREZ','C','1722773684','0000-00-00','','M','2407785','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DIÓGENES PAREDES Y ALGARROBOS 543','588','2','1','0.00','0.00'),(589,1,1,1013,1,2,17,'SEGUNDO',' PILLA','C','1723254049','0000-00-00','','M','2351149','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. DOS HEMISFERIOS.','589','2','1','0.00','0.00'),(590,1,1,1013,1,2,17,'PABLO',' SOLIZ','C','1717397697','0000-00-00','','M','2907561','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARVAJAL 195 Y LA GASCA','590','2','1','0.00','0.00'),(591,1,1,1013,1,2,17,'NELSON',' TRONCOSO','C','1721679858','0000-00-00','','M','2321003','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JAVIER LOYOLA Y S.BOLÍVAR. URB.CAROLINA 2','591','2','1','0.00','0.00'),(592,1,1,1013,1,2,17,'MARIO',' VELOZ','C','0604313593','0000-00-00','','M','2490890','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL N70-455. EL CONDADO','592','2','1','0.00','0.00'),(593,1,1,1013,1,2,17,'SAMUEL',' VELOZ','C','1719507517','0000-00-00','','M','2553467','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FERNÁNDEZ DE RECALDE 2316','593','2','1','0.00','0.00'),(594,1,1,1013,1,2,17,'HOMERO',' YANCHAPAXI','C','1722905450','0000-00-00','','M','2506690','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RÍO DE JANEIRO 1048','594','2','1','0.00','0.00'),(595,1,1,1013,1,2,17,'RICHARD',' FLORES','C','1717484230','0000-00-00','','M','2241016','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NICOLÁS LÓPEZ N48-296 Y F.MIRANDA','595','2','1','0.00','0.00'),(596,1,1,1013,1,2,17,'MARIO',' GORDÓN','C','1716308455','0000-00-00','','M','2822411','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','9 DE AGOSTO 860 Y FUNIN.CALDERÓN','596','2','1','0.00','0.00'),(597,1,1,1013,1,2,17,'CARLOS',' MORENO','C','1723189161','0000-00-00','','M','2844428','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUIGRA L-10 Y AJAVÍ','597','2','1','0.00','0.00'),(598,1,1,1013,1,2,17,'RAÚL',' MUÑOZ','C','1717411746','0000-00-00','','M','2400704','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','10 DE AGOSTO 9602 Y LOS PINOS','598','2','1','0.00','0.00'),(599,1,1,1013,1,2,17,'+',' +','C','1719435891','0000-00-00','','M','2548206','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ODISPO D. DE LA MADRID S/N','599','2','1','0.00','0.00'),(600,1,1,1013,1,2,17,'WELLINGTON',' ALMACHE','C','1723268445','0000-00-00','','M','2663723','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO DE HERERA 334','600','2','1','0.00','0.00'),(601,1,1,1013,1,2,17,'GONZALO',' LLERENA','C','1717394397','0000-00-00','','M','2239044','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MOSQUERA NARVÁEZ 284 Y VERSALLES','601','2','1','0.00','0.00'),(602,1,1,1013,1,2,17,'JULIO',' MUÑOZ','C','1722241799','0000-00-00','','M','2633404','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LAS CUADRAS BL-13 D-402. CHILLOGALLO','602','2','1','0.00','0.00'),(603,1,1,1013,1,2,17,'FERNANDO',' PLAZARTE','C','1723076814','0000-00-00','','M','2661929','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MATHIAS BIGO C-A.5 Y ANDRÉS SEGURA. LA MAGDALENA','603','2','1','0.00','0.00'),(604,1,1,1013,1,2,17,'FREDDY',' MORENO','C','1718303090','0000-00-00','','M','2520123','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.GALES II C-2. LA ARMENIA','604','2','1','0.00','0.00'),(605,1,1,1013,1,2,17,'JORGE',' DE LA TORRE','C','1722946603','0000-00-00','','M','3342922','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DE LAS PALMERAS N47-65 Y MADROÑOS.','605','2','1','0.00','0.00'),(606,1,1,1013,1,2,17,'VÍCTOR',' BOHÓRQUEZ','C','1718166257','0000-00-00','','M','2654222','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PILAHUIN 350. CDLA. MÉXICO','606','2','1','0.00','0.00'),(607,1,1,1013,1,2,17,'JORGE',' PASPUEL','C','1718165168','0000-00-00','','M','2596186','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHALA 2871 Y FLAVIO ALFARO','607','2','1','0.00','0.00'),(608,1,1,1013,1,2,17,'MAURICIO',' ALMEIDA','C','1724232952','0000-00-00','','M','2480239','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MODESTO CHÁVEZ Y ALBERTO EINSTEIN','608','2','1','0.00','0.00'),(609,1,1,1013,1,2,17,'RAMIRO',' ALTAMIRANO','C','1723202790','0000-00-00','','M','2492647','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EMILIO BUSTAMANTE N70-99','609','2','1','0.00','0.00'),(610,1,1,1013,1,2,17,'ESTUARDO',' ARGUELLO','C','0603533456','0000-00-00','','M','2416940','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE DE LOS OLIVOS Y 7MA. TRANSVERSAL','610','2','1','0.00','0.00'),(611,1,1,1013,1,2,17,'PABLO',' BOADA','C','1719340547','0000-00-00','','M','2410950','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. BRASILIA II CASA 265','611','2','1','0.00','0.00'),(612,1,1,1013,1,2,17,'MARCELO',' ESPÍN','C','1723121131','0000-00-00','','M','3260454','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ULLOA N31-124 Y MARIANA DE JESÚS','612','2','1','0.00','0.00'),(613,1,1,1013,1,2,17,'JOSÉ',' LUIS TORRES','C','1721713483','0000-00-00','','M','2551474','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ATACAMES 205 Y AV. LA GASCA','613','2','1','0.00','0.00'),(614,1,1,1013,1,2,17,'JUAN',' CARLOS ZURITA','C','1720829843','0000-00-00','','M','2320676','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. CAROLINA II CASA 52','614','2','1','0.00','0.00'),(615,1,1,1013,1,2,17,'RAMIRO',' SEGOVIA','C','1723129811','0000-00-00','','M','2548519','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARMERO OE7-113','615','2','1','0.00','0.00'),(616,1,1,1013,1,2,17,'LUIS',' CAMACHO','C','1722260542','0000-00-00','','M','3032195','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.PALERMO MZ-61 C-11','616','2','1','0.00','0.00'),(617,1,1,1013,1,2,17,'MARIO',' YÉPEZ','C','1723509061','0000-00-00','','M','2267224','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BRACAMOROS 104','617','2','1','0.00','0.00'),(618,1,1,1013,1,2,17,'LUIS',' ACEVEDO PADILLA','C','1716592579','0000-00-00','','M','96257952','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.M.CÓRDOVA G. CONJ.LAGUNA AZUL C-59','618','2','1','0.00','0.00'),(619,1,1,1013,1,2,17,'CARLOS',' AGUILERA GRANJA','C','1719113845','0000-00-00','','M','2531080','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SIMÓN CÁRDENAS 710 Y VACA DE CASTRO','619','2','1','0.00','0.00'),(620,1,1,1013,1,2,17,'WELLINGTON',' RAMIRO AGUIRRE','C','1722480074','0000-00-00','','M','2811944','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL MORLAN N52-09 E ISAAC BARRERA','620','2','1','0.00','0.00'),(621,1,1,1013,1,2,17,'CÉSAR',' ALARCÓN','C','1722105176','0000-00-00','','M','2432994','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.MONTESERRÍN. AMAPOLAS 46-26 Y ALONDRAS','621','2','1','0.00','0.00'),(622,1,1,1013,1,2,17,'EDISON',' ALBÁN CÁRDENAS','C','1722313010','0000-00-00','','M','2827614','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BUENAVENTURA ETAPA II','622','2','1','0.00','0.00'),(623,1,1,1013,1,2,17,'PATRICIO',' ALBÁN','C','1714822390','0000-00-00','','M','2444936','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INCA 2887','623','2','1','0.00','0.00'),(624,1,1,1013,1,2,17,'OSCAR',' ALBÁN','C','1718291154','0000-00-00','','M','2536599','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SABANILLA C-32 Y HUACHI. QUITO NORTE. COND.OCCIDEN','624','2','1','0.00','0.00'),(625,1,1,1013,1,2,17,'CARLOS',' ALBARRACÍN DÍAZ','C','1722304514','0000-00-00','','M','2635467','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.BILOXI CALLE 6-A # 200','625','2','1','0.00','0.00'),(626,1,1,1013,1,2,17,'CARLOS',' ALMEIDA CRUZ','C','1719246025','0000-00-00','','M','2435735','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁNDEZ DE GIRÓN 765 Y PEDREGAL','626','2','1','0.00','0.00'),(627,1,1,1013,1,2,17,'JUAN',' ALMEIDA OCAMPO','C','1721402590','0000-00-00','','M','2828041','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GEOVANNY CALLES 520 Y DUCHICELA','627','2','1','0.00','0.00'),(628,1,1,1013,1,2,17,'LUIS',' AMAYA TERÁN','C','1722216148','0000-00-00','','M','2010157','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARAPUNGO. AV.QUITO MZ.A-11 E-25','628','2','1','0.00','0.00'),(629,1,1,1013,1,2,17,'RAMIRO',' ANDRADE','C','1721838876','0000-00-00','','M','2826146','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.SAN SEBASTIÁN DE CALDERÓN E1 C.B-16','629','2','1','0.00','0.00'),(630,1,1,1013,1,2,17,'OMAR',' ARGUELLO MAUTONG','C','1718167545','0000-00-00','','M','2594438','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.LOYOLA  BL-44 D-22','630','2','1','0.00','0.00'),(631,1,1,1013,1,2,17,'ROBINSON',' ARÉVALO ROMERO','C','1719836916','0000-00-00','','M','2809026','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VELASCO IBARRA S/N E ISIDRO AYORA C-13. CARCELÉN','631','2','1','0.00','0.00'),(632,1,1,1013,1,2,17,'JAIME',' ARIAS','C','1722242748','0000-00-00','','M','2294881','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAMÓN VALAREZO N58-17','632','2','1','0.00','0.00'),(633,1,1,1013,1,2,17,'JULIO',' ARMAS','C','1722463153','0000-00-00','','M','2586861','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ELIZALOE E6-52 E IQUIQUE','633','2','1','0.00','0.00'),(634,1,1,1013,1,2,17,'HERNÁN',' ARREGUI','C','1722212121','0000-00-00','','M','2352309','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA PAMPA CALLE C 111','634','2','1','0.00','0.00'),(635,1,1,1013,1,2,17,'FERNANDO',' ARTEAGA NORIEGA','C','1722379011','0000-00-00','','M','2471353','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CHANDUY N63-66 Y FÁTIMA','635','2','1','0.00','0.00'),(636,1,1,1013,1,2,17,'DANIEL',' ARTEAGA','C','1721936688','0000-00-00','','M','2459786','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE B #55 Y ZAMORA','636','2','1','0.00','0.00'),(637,1,1,1013,1,2,17,'VÍCTOR','AULESTIA','C','1722389390','0000-00-00','','M','2533640','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN SAMANO OE6-140','637','2','1','0.00','0.00'),(638,1,1,1013,1,2,17,'DIEGO',' AUZ SAAVEDRA','C','1718164773','0000-00-00','','M','2276641','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO MONTALVO OE9-282 Y LORANTE','638','2','1','0.00','0.00'),(639,1,1,1013,1,2,17,'CRISTÓBAL',' AYALA VARELA','C','1722251186','0000-00-00','','M','2599809','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IGNACIO LOYOLA BL-43  D-22','639','2','1','0.00','0.00'),(640,1,1,1013,1,2,17,'ANTONIO',' BÁEZ BÁEZ','C','1722219712','0000-00-00','','M','2565724','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOAQUÍN PINTO E4-342 Y AMAZONAS','640','2','1','0.00','0.00'),(641,1,1,1013,1,2,17,'RODRIGO',' BALLAGÁN COSTALES','C','1722305669','0000-00-00','','M','3195285','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COVI 520, MONJAS ALTO','641','2','1','0.00','0.00'),(642,1,1,1013,1,2,17,'ALDRIN',' BALLESTEROS','C','1722379219','0000-00-00','','M','2035767','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. SANTA MARIANITA C-123','642','2','1','0.00','0.00'),(643,1,1,1013,1,2,17,'LUIS',' BANDA SMITH','C','1718164658','0000-00-00','','M','2956654','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA TERESA N70-271 Y ALFONSO HIERRO','643','2','1','0.00','0.00'),(644,1,1,1013,1,2,17,'ENRIQUE',' BARAHONA','C','1721543302','0000-00-00','','M','2534738','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MURIALDO E7-93 Y 6 DE DICEMBRE C-42','644','2','1','0.00','0.00'),(645,1,1,1013,1,2,17,'WILLIAM',' BARRAGÁN BARRAGÁN','C','1717919367','0000-00-00','','M','2465236','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','10 DE AGOSTO N35-19','645','2','1','0.00','0.00'),(646,1,1,1013,1,2,17,'BOLÍVAR',' BASANTES RODRÍGUEZ','C','1715566244','0000-00-00','','M','2614600','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.BOLÍVAR E3-31 Y ZAPOTILLO','646','2','1','0.00','0.00'),(647,1,1,1013,1,2,17,'VLADYMIR',' BENAVIDES MONCAYO','C','1717320558','0000-00-00','','M','2811725','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL MORLÁN N50-82 Y LOS ÁLAMOS','647','2','1','0.00','0.00'),(648,1,1,1013,1,2,17,'HUGO',' BERNYS CHÁVEZ','C','1719672881','0000-00-00','','M','2409918','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PORFIRIO ROMERO OE163 Y 10 DE AGOSTO C-10','648','2','1','0.00','0.00'),(649,1,1,1013,1,2,17,'JAIME',' BRITO SANTACRUZ','C','1715920698','0000-00-00','','M','2291462','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOME DÁVILA 161 Y PEDRO VALVERDE','649','2','1','0.00','0.00'),(650,1,1,1013,1,2,17,'WASHINGTON',' BUNCES CANDO','C','1718160979','0000-00-00','','M','2653143','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CHAMBO 193 Y CERRO HERMOSO','650','2','1','0.00','0.00'),(651,1,1,1013,1,2,17,'FERNANDO',' RIVERA BURNEO','C','1718753310','0000-00-00','','M','2898191','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRA. ANGÉLICO 220 Y DEGOYA','651','2','1','0.00','0.00'),(652,1,1,1013,1,2,17,'WALTER',' CAISACHANA','C','1722258249','0000-00-00','','M','2240452','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','6 DE DICIEMBRE 6182 Y TOMAS DE BERLANGA D-85.B','652','2','1','0.00','0.00'),(653,1,1,1013,1,2,17,'EDWIN',' CAJAS CHAFAR','C','1718162108','0000-00-00','','M','2650654','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAUTE S7-70 Y UPANO','653','2','1','0.00','0.00'),(654,1,1,1013,1,2,17,'MARCELO',' CALDERÓN','C','1722305792','0000-00-00','','M','2474017','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNANDO PAREDES OE3-183','654','2','1','0.00','0.00'),(655,1,1,1013,1,2,17,'NORMAN',' CANDO GÓMEZ','C','1720930302','0000-00-00','','M','2404104','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS NEVEVADOS. WANDEMBERG E61-70','655','2','1','0.00','0.00'),(656,1,1,1013,1,2,17,'GUSTAVO',' CÁRDENAS CÁRDENAS','C','1722251095','0000-00-00','','M','2446887','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁNDEZ DE GIRÓN 510 Y PEDREGAL','656','2','1','0.00','0.00'),(657,1,1,1013,1,2,17,'FREDDY',' CARRERA','C','1715902092','0000-00-00','','M','2259859','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA Y PASAJE 3. CONJ. ALTAMIRA','657','2','1','0.00','0.00'),(658,1,1,1013,1,2,17,'MAURICIO',' CARRERA CABEZAS','C','1722219639','0000-00-00','','M','2467910','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL TIEMPO 627 Y EL TELÉGRAFO','658','2','1','0.00','0.00'),(659,1,1,1013,1,2,17,'ROBERTO',' CARTAGÉNOVA','C','1714025101','0000-00-00','','M','3280105','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUACAMAYOS Y CAP. RAMÓN BORJA','659','2','1','0.00','0.00'),(660,1,1,1013,1,2,17,'FREDDY',' CEVALLOS ROJAS','C','1714485677','0000-00-00','','M','2264167','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA GRANJA. ACCESO 66 BL-237 D-41','660','2','1','0.00','0.00'),(661,1,1,1013,1,2,17,'JOSÉ',' CEVALLOS TRUJILLO','C','1717527178','0000-00-00','','M','2953232','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HABANA OE6-42 Y CANADÁ','661','2','1','0.00','0.00'),(662,1,1,1013,1,2,17,'MARIO',' CHÁVEZ SALAZAR','C','1722240601','0000-00-00','','M','98356417','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PUEBLO BLANCO VALLE C-1 CASA 21. GUANGOPOLO','662','2','1','0.00','0.00'),(663,1,1,1013,1,2,17,'RAMIRO',' CHÁVEZ CUEVA','C','1722305149','0000-00-00','','M','2353068','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.C.GALARZA 2 HEMISFERIOS PREDIO 3 MZ-4 C-13','663','2','1','0.00','0.00'),(664,1,1,1013,1,2,17,'FRANCISCO',' CHECA BOLAÑOS','C','1721233359','0000-00-00','','M','2371789','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SIMÓN BOLÍVAR 151 Y PIZARRO. TUMBACO','664','2','1','0.00','0.00'),(665,1,1,1013,1,2,17,'FABIÁN',' CHIRIBOGA','C','1718161928','0000-00-00','','M','2599807','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LOYOLA BL-59 D-42. COTOCOLLAO','665','2','1','0.00','0.00'),(666,1,1,1013,1,2,17,'EDDY',' CISNEROS','C','1717431934','0000-00-00','','M','2609982','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. JUAN B. AGUIRRE 1155','666','2','1','0.00','0.00'),(667,1,1,1013,1,2,17,'JOSÉ',' COBA MORENO','C','1722040811','0000-00-00','','M','2246427','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA 812 Y VASCO DE CONTRERAS','667','2','1','0.00','0.00'),(668,1,1,1013,1,2,17,'RAMIRO',' CORONADO','C','1720983640','0000-00-00','','M','2270600','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BRASIL Y H.SALAS CONJ. NORTESOL','668','2','1','0.00','0.00'),(669,1,1,1013,1,2,17,'PABLO',' CORTEZ ALVEAR','C','1718162280','0000-00-00','','M','2599663','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN CARLOS BL-COTOPAXI D-502','669','2','1','0.00','0.00'),(670,1,1,1013,1,2,17,'CARLOS',' CRIOLLO','C','1720892155','0000-00-00','','M','2870030','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARRIO SELVA ALEGRE. SANGOLQUÍ.','670','2','1','0.00','0.00'),(671,1,1,1013,1,2,17,'MARCO',' CRUZ AMAYA','C','1721024279','0000-00-00','','M','2331122','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. LOS CACTUS CASA 6. SANGOLQUÍ.','671','2','1','0.00','0.00'),(672,1,1,1013,1,2,17,'RAÚL',' DÁVALOS ARGUELLO','C','0603096462','0000-00-00','','M','2432759','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. 132 OE5D CASA 31-33 Y SAN GABRIEL. LA GRANJA','672','2','1','0.00','0.00'),(673,1,1,1013,1,2,17,'HERNÁN',' DÁVILA','C','1718164625','0000-00-00','','M','2268485','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA OE 174 Y 10 DE AGOSTO','673','2','1','0.00','0.00'),(674,1,1,1013,1,2,17,'JORGE',' DUEÑAS MEJÍA','C','1720622552','0000-00-00','','M','2463254','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','H. GIROIX 765 Y PEDREGAL','674','2','1','0.00','0.00'),(675,1,1,1013,1,2,17,'ARTURO',' ERAZO','C','1720508686','0000-00-00','','M','2520181','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANA DE JESÚS 725 Y ELOY ALFARO','675','2','1','0.00','0.00'),(676,1,1,1013,1,2,17,'CARLOS',' ESPINOSA CHAUVÍN','C','1718382482','0000-00-00','','M','2534748','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS Y R.AUDIENCIA. CONJ.SIERRA HERMOSA C-47','676','2','1','0.00','0.00'),(677,1,1,1013,1,2,17,'HUGO',' FLORES BONILLA','C','1718164864','0000-00-00','','M','2415361','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.REAL A. DE QUITO PAS.G OE2-154','677','2','1','0.00','0.00'),(678,1,1,1013,1,2,17,'PABLO',' GALLEGOS MORÁN','C','1716751837','0000-00-00','','M','3401475','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JERÓNIMO BENZONI N58-142','678','2','1','0.00','0.00'),(679,1,1,1013,1,2,17,'ÁLVARO',' GRANDA','C','1719712588','0000-00-00','','M','2680025','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BENANCIO ESTANDOQUE Y CARDENAL ESPÍNOLA C.S18-31','679','2','1','0.00','0.00'),(680,1,1,1013,1,2,17,'FRANCO',' GRANDA','C','1716083694','0000-00-00','','M','2249032','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PERALES L-3 Y ELOY ALFARO','680','2','1','0.00','0.00'),(681,1,1,1013,1,2,17,'LUIS',' GUAMÁN MARTÍNEZ','C','1722128749','0000-00-00','','M','2426364','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARAPUNGO 2DA.ETAPA BL-014','681','2','1','0.00','0.00'),(682,1,1,1013,1,2,17,'CELSO',' GUARANGO','C','1718164633','0000-00-00','','M','2826356','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. CAPULIES 2 CASA 7. CALDERÓN','682','2','1','0.00','0.00'),(683,1,1,1013,1,2,17,'MARCELO',' GUERRA','C','1722318688','0000-00-00','','M','2903549','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANO E12-166 Y LA CONDAMINE','683','2','1','0.00','0.00'),(684,1,1,1013,1,2,17,'JUAN','GUERRA RENGIFO','C','1722440722','0000-00-00','','M','2649702','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ZARUMA S10-55 Y PASAJE','684','2','1','0.00','0.00'),(685,1,1,1013,1,2,17,'JORGE',' GUTIÉRREZ QUINTEROS','C','1720870862','0000-00-00','','M','3319056','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ABELARDO MONCAYO 346 Y M. SÁENZ','685','2','1','0.00','0.00'),(686,1,1,1013,1,2,17,'JAIME',' GUZMÁN GALARZA','C','1717436453','0000-00-00','','M','2225029','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','REINA VICTORIA Y ROCA. RESTAURANT CASA DE J.','686','2','1','0.00','0.00'),(687,1,1,1013,1,2,17,'JOSÉ',' HEREDIA HERNÁNDEZ','C','1717433542','0000-00-00','','M','2547115','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','10 DE AGOSTO 38-46 Y MARIANA DE JESÚS','687','2','1','0.00','0.00'),(688,1,1,1013,1,2,17,'LUIS',' HERRERA MOLINA','C','1720016961','0000-00-00','','M','2614854','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ ÁLVEZ E409 Y F.COBO','688','2','1','0.00','0.00'),(689,1,1,1013,1,2,17,'JOSÉ',' HERRERA MONTALVO','C','1722257803','0000-00-00','','M','2637797','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.BATALLÓN CHIMBORAZO CALLE H S13-408','689','2','1','0.00','0.00'),(690,1,1,1013,1,2,17,'DANIEL',' HERRERA ARAUZ','C','1722304597','0000-00-00','','M','2801667','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. 29 DE JULIO LOTE 38','690','2','1','0.00','0.00'),(691,1,1,1013,1,2,17,'JOFFRE',' HERRERA ORTIZ','C','1714154877','0000-00-00','','M','2236854','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INGLATERRA N30-152 Y VANCOUVER','691','2','1','0.00','0.00'),(692,1,1,1013,1,2,17,'MARCO',' IMBAGO CARRANCO','C','1721983433','0000-00-00','','M','2403544','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISAAC BARRERA E6-196','692','2','1','0.00','0.00'),(693,1,1,1013,1,2,17,'YANDRI',' INFANTE TINOCO','C','1722253091','0000-00-00','','M','2296937','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO FREILE 2236 Y JUAN GARZÓN','693','2','1','0.00','0.00'),(694,1,1,1013,1,2,17,'GILBERT',' FREIRE PAREDES','C','1721305603','0000-00-00','','M','2461904','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS AMAPOLAS N47-157','694','2','1','0.00','0.00'),(695,1,1,1013,1,2,17,'JAIME',' JARA LÓPEZ','C','0603947557','0000-00-00','','M','2414109','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE B Y VEINTIMILLA N56-25','695','2','1','0.00','0.00'),(696,1,1,1013,1,2,17,'LUIS',' JARA SAMANIEGO','C','1716169691','0000-00-00','','M','2337486','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. LA COLINA. EL ORO 371','696','2','1','0.00','0.00'),(697,1,1,1013,1,2,17,'CRISTÓBAL',' JARAMILLO MUÑOZ','C','1722213038','0000-00-00','','M','3227654','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DONOSO DE BARBA N15-10. LA VICENTINA','697','2','1','0.00','0.00'),(698,1,1,1013,1,2,17,'MARIO',' JARAMILLO CAMPAÑA','C','1713906442','0000-00-00','','M','2348563','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA ARMENIA 1-7 #162','698','2','1','0.00','0.00'),(699,1,1,1013,1,2,17,'DIEGO',' JARAMILLO MUÑOZ','C','1721988481','0000-00-00','','M','95028786','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO DALMAU Y CALLE 8. URB.MARISOL','699','2','1','0.00','0.00'),(700,1,1,1013,1,2,17,'MILTON',' JARRÍN','C','1721606208','0000-00-00','','M','2595668','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LA PRENSA N59-64 Y LUIS TUFIÑO','700','2','1','0.00','0.00'),(701,1,1,1013,1,2,17,'MANUEL',' JIMÉNEZ','C','1722307319','0000-00-00','','M','2584229','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAMÓN NAVA 740 Y NECOCHEA','701','2','1','0.00','0.00'),(702,1,1,1013,1,2,17,'JUAN',' CARLOS JIMÉNEZ LOAIZA','C','1722311865','0000-00-00','','M','2270410','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CÓNDOR 369 Y AV. BRASIL','702','2','1','0.00','0.00'),(703,1,1,1013,1,2,17,'LUIS',' LASCANO ARÉVALO','C','1714811880','0000-00-00','','M','2433463','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AUCAS N52-129 Y AV. LA FLORIDA','703','2','1','0.00','0.00'),(704,1,1,1013,1,2,17,'JUAN',' CARLOS LATORRE','C','1722444013','0000-00-00','','M','2470460','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ CARBO N78-41','704','2','1','0.00','0.00'),(705,1,1,1013,1,2,17,'GABRIEL',' GARCÍA AGUIRRE','C','1718161597','0000-00-00','','M','2522670','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GERÓNIMO LEITON N23-133 Y AV.LA GASCA','705','2','1','0.00','0.00'),(706,1,1,1013,1,2,17,'JORGE',' LÓPEZ','C','1721239240','0000-00-00','','M','2240529','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN FRANCISCO N42-93','706','2','1','0.00','0.00'),(707,1,1,1013,1,2,17,'JORGE',' LUNA NARVÁEZ','C','1600345936','0000-00-00','','M','2374781','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN JOSÉ DE LA VIÑA 14','707','2','1','0.00','0.00'),(708,1,1,1013,1,2,17,'MARIO',' MALDONADO ÁVILA','C','1722316013','0000-00-00','','M','2595203','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NICOLÁS ALBA N67-41 Y LEGARD','708','2','1','0.00','0.00'),(709,1,1,1013,1,2,17,'JOSÉ',' MALDONADO VILLACÍS','C','1721391165','0000-00-00','','M','2602001','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.COLÓN 1468 Y 9 DE OCTUBRE. EDIF.SOLAMAR OF.501','709','2','1','0.00','0.00'),(710,1,1,1013,1,2,17,'LUIS',' MANOSALVAS SAMPEDRO','C','1722255286','0000-00-00','','M','2591192','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHALA N64-105 Y J.GARZÓN','710','2','1','0.00','0.00'),(711,1,1,1013,1,2,17,'PATRICIO',' MASACHE PAREDES','C','1722441720','0000-00-00','','M','2813929','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL CAÑOLA E10-32 Y J.SUMAITA','711','2','1','0.00','0.00'),(712,1,1,1013,1,2,17,'ERNESTO',' MEDIAVILLA','C','1722317243','0000-00-00','','M','2482521','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LOS ROSALES PAS.A LOTE 28','712','2','1','0.00','0.00'),(713,1,1,1013,1,2,17,'VÍCTOR','MENA MALDONADO','C','1719209742','0000-00-00','','M','2679490','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUSUBAMBA 831 Y TNTE. ORTIZ','713','2','1','0.00','0.00'),(714,1,1,1013,1,2,17,'WILBER',' MERA PÉREZ','C','1720544087','0000-00-00','','M','2907604','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUERO Y CAICEDO OE6-128 Y UGARTE','714','2','1','0.00','0.00'),(715,1,1,1013,1,2,17,'IVÁN',' MONCAYO ALARCÓN','C','1715848105','0000-00-00','','M','2598928','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS OE3-290 Y P. BOTTO. COND.SIERRA H. C-68','715','2','1','0.00','0.00'),(716,1,1,1013,1,2,17,'EDGAR',' MORAN COELLO','C','1721795829','0000-00-00','','M','2733468','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND. JOSÉ PERALTA L-4 B.7 DEP.743','716','2','1','0.00','0.00'),(717,1,1,1013,1,2,17,'JORGE',' MORENO','C','1720995438','0000-00-00','','M','2470989','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANO POZO N77-59 Y JUAN DE SELIS','717','2','1','0.00','0.00'),(718,1,1,1013,1,2,17,'BYRON',' CADENA HUERTAS','C','1722245873','0000-00-00','','M','94113078','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.M.CÓRDOVA GALARZA KM 10 1/2 #2005','718','2','1','0.00','0.00'),(719,1,1,1013,1,2,17,'JUAN',' MOYANO','C','1722194667','0000-00-00','','M','2698830','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP. UNEBA VILLA SOLIDARIDAD','719','2','1','0.00','0.00'),(720,1,1,1013,1,2,17,'JORGE',' MUSO','C','1718162116','0000-00-00','','M','2825013','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PANAMERICANA NORTE KM 14 1/2','720','2','1','0.00','0.00'),(721,1,1,1013,1,2,17,'EDWIN',' NARANJO SALCEDO','C','1719349365','0000-00-00','','M','2442297','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.FRAY A. AZKÚNAGA Y BRASIL. CONJ.ASKÚNAGA C-B.5','721','2','1','0.00','0.00'),(722,1,1,1013,1,2,17,'ÁNGEL',' NARANJO JIMÉNEZ','C','1722345905','0000-00-00','','M','2478867','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN TIRADO N84-171 Y HERNANDO DE LA PARRA','722','2','1','0.00','0.00'),(723,1,1,1013,1,2,17,'ROLDÁN',' NARANJO SALVADOR','C','1721390415','0000-00-00','','M','2252612','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA GRANJA ACCESO 21 D-42','723','2','1','0.00','0.00'),(724,1,1,1013,1,2,17,'LUIS',' NARVÁEZ BAROJA','C','1722254628','0000-00-00','','M','2582292','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NUEVA YORK 319 Y GALÁPAGOS','724','2','1','0.00','0.00'),(725,1,1,1013,1,2,17,'JOSÉ',' NAULA VELOZ','C','1720963329','0000-00-00','','M','2315599','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.PABLO GUARDERAS. MACHACHI','725','2','1','0.00','0.00'),(726,1,1,1013,1,2,17,'JUAN',' ÑAUÑAY','C','1720942406','0000-00-00','','M','2228505','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BUENOS AIRES OE5-157','726','2','1','0.00','0.00'),(727,1,1,1013,1,2,17,'CARLOS',' NAVARRO','C','1722480157','0000-00-00','','M','2471459','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALEJANDRO PONCE OE3-143. CARCELÉN','727','2','1','0.00','0.00'),(728,1,1,1013,1,2,17,'CARLOS',' OBANDO REVELO','C','1721073052','0000-00-00','','M','3200201','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ATACAMES N23-268','728','2','1','0.00','0.00'),(729,1,1,1013,1,2,17,'WILLIAM',' OCAÑA OÑATE','C','1720646841','0000-00-00','','M','2886095','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE GUAYAQUIL S/N. ZAMBIZA','729','2','1','0.00','0.00'),(730,1,1,1013,1,2,17,'LUIS',' CAHUSQUÍ GUZMÁN','C','1720626918','0000-00-00','','M','2568703','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DOMINGO ESPINAR 2435 Y LA GASCA','730','2','1','0.00','0.00'),(731,1,1,1013,1,2,17,'RICARDO',' RENGIFO DÁVALOS','C','1719088765','0000-00-00','','M','3400990','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁN CORTEZ 55-46 Y CARLOS V.','731','2','1','0.00','0.00'),(732,1,1,1013,1,2,17,'SEGUNDO',' ORDÓÑEZ SOLANO','C','1716185838','0000-00-00','','M','2662347','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO RUIZ OE124','732','2','1','0.00','0.00'),(733,1,1,1013,1,2,17,'MAURICIO',' ORTEGA RODRÍGUEZ','C','0201622792','0000-00-00','','M','2534430','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ RUIZ OE611 Y MACHALA','733','2','1','0.00','0.00'),(734,1,1,1013,1,2,17,'JAIME',' CADENA ECHEVERRÍA','C','1721547378','0000-00-00','','M','2501099','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ ÁLVAREZ E14-27','734','2','1','0.00','0.00'),(735,1,1,1013,1,2,17,'EDISON',' PACHECO MORETA','C','1718161266','0000-00-00','','M','2420907','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.HERNANDO PARRA MZ-M C-14. CARAPUNGO','735','2','1','0.00','0.00'),(736,1,1,1013,1,2,17,'SEGUNDO',' PALACIOS','C','1717150898','0000-00-00','','M','2237037','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUMBERTO ALBORNOZ 506','736','2','1','0.00','0.00'),(737,1,1,1013,1,2,17,'JOSÉ',' ORTEGA VÁZQUEZ','C','1500815418','0000-00-00','','M','3443933','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LOS LEÑOS C-14.B. LOS MASTODONTES','737','2','1','0.00','0.00'),(738,1,1,1013,1,2,17,'YESID',' PANTOJA','C','1719929661','0000-00-00','','M','2494870','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LA PRENSA N71-98 Y P. PICASSO','738','2','1','0.00','0.00'),(739,1,1,1013,1,2,17,'CARLOS',' ENRÍQUEZ ALBÁN','C','1714128228','0000-00-00','','M','2374555','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERDOIZA CRESPO Y PAS.C.LOZA C-15. TUMBACO','739','2','1','0.00','0.00'),(740,1,1,1013,1,2,17,'JUAN',' PAZMIÑO MENÉNDEZ','C','1722318662','0000-00-00','','M','2867793','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.FACULTAD DE MED. 2DA.ETAPA C-81. CAPELO','740','2','1','0.00','0.00'),(741,1,1,1013,1,2,17,'JOHNNY',' PAZMIÑO','C','1715829576','0000-00-00','','M','2803129','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAFAEL CARVAJAL N80-328. CARCELÉN.','741','2','1','0.00','0.00'),(742,1,1,1013,1,2,17,'FREDDY',' PÉREZ TERÁN','C','1719089136','0000-00-00','','M','2824670','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN JOSÉ PORTAL S.SEBASTIÁN C-40','742','2','1','0.00','0.00'),(743,1,1,1013,1,2,17,'WILSON',' PÉREZ CAMPAÑA','C','1720363587','0000-00-00','','M','2294165','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA PULIDA CALLE 2 OE9-300','743','2','1','0.00','0.00'),(744,1,1,1013,1,2,17,'HÉCTOR',' PICO PICO','C','1722316781','0000-00-00','','M','2546369','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITER 86 Y BOLIVIA','744','2','1','0.00','0.00'),(745,1,1,1013,1,2,17,'MIGUEL',' PONCE MIRANDA','C','1714763321','0000-00-00','','M','2596071','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','25 DE MAYO N66-29 Y LIZARDO RUIZ','745','2','1','0.00','0.00'),(746,1,1,1013,1,2,17,'JHIMY',' PONCE JARRÍN','C','1722447420','0000-00-00','','M','2446088','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS MONTÚFAR E13-333 Y MONITOR','746','2','1','0.00','0.00'),(747,1,1,1013,1,2,17,'FERNANDO',' ARÉVALO ORTEGA','C','1715922488','0000-00-00','','M','2346024','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','POLIT LASSO Y ASCÁZUBI. CONOCOTO','747','2','1','0.00','0.00'),(748,1,1,1013,1,2,17,'CARLOS',' RECALDE','C','1722015706','0000-00-00','','M','2824518','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARRIO TERÁN CALLE D #65. CALDERÓN','748','2','1','0.00','0.00'),(749,1,1,1013,1,2,17,'ALEXEY',' RIOFRÍO','C','1715826291','0000-00-00','','M','2440194','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HOMERO SALAS 470 Y MANUEL SERRANO','749','2','1','0.00','0.00'),(750,1,1,1013,1,2,17,'MARCO',' RIVERA ORDÓÑEZ','C','1722442769','0000-00-00','','M','2428002','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA PIEDRA CASA 3. CARAPUNGO','750','2','1','0.00','0.00'),(751,1,1,1013,1,2,17,'JORGE',' RODRÍGUEZ POZO','C','1716867237','0000-00-00','','M','3316853','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN SEBASTIÁN DE CALDERÓN C-8.A','751','2','1','0.00','0.00'),(752,1,1,1013,1,2,17,'ALBERTO',' RODRÍGUEZ MOLINA','C','1718610361','0000-00-00','','M','2495165','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIO PUCUNO N37-171 Y RIO BIGAL','752','2','1','0.00','0.00'),(753,1,1,1013,1,2,17,'JAIME',' ROMERO','C','1717641458','0000-00-00','','M','2544379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CASTRO E7-18 E IQUIQUE','753','2','1','0.00','0.00'),(754,1,1,1013,1,2,17,'SANDRO',' ROMERO PROAÑO','C','1722228028','0000-00-00','','M','2673423','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA. CASAS QUITO. M.CAZÁREZ 248','754','2','1','0.00','0.00'),(755,1,1,1013,1,2,17,'VÍCTOR','ROMERO LOAIZA','C','1720360047','0000-00-00','','M','2245736','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.LA FLORIDA. MANUEL JORDÁN N52-101','755','2','1','0.00','0.00'),(756,1,1,1013,1,2,17,'ÁNGEL',' ROSALES RODRÍGUEZ','C','1714814934','0000-00-00','','M','2492575','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISABEL DEL HIERRO N70-306','756','2','1','0.00','0.00'),(757,1,1,1013,1,2,17,'VICENTE',' ROSERO CABRERA','C','1722335427','0000-00-00','','M','2664423','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LOS LIBERTADORES OE4-115','757','2','1','0.00','0.00'),(758,1,1,1013,1,2,17,'ARIEL',' RUIZ','C','1717994949','0000-00-00','','M','2446116','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ZAMORA OE3-227 Y BRASIL','758','2','1','0.00','0.00'),(759,1,1,1013,1,2,17,'JORGE',' SALAS BERMÚDEZ','C','1717597437','0000-00-00','','M','2394892','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN ANTONIO DE PICHINCHA','759','2','1','0.00','0.00'),(760,1,1,1013,1,2,17,'FREDDY',' SALTOS PÁEZ','C','1722314752','0000-00-00','','M','2552893','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. CAMINO PÉREZ N31-44. LAS CASAS.','760','2','1','0.00','0.00'),(761,1,1,1013,1,2,17,'RUBÉN',' SALTOS BOADA','C','1720750627','0000-00-00','','M','2292195','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS Y R.AUDIENCIA CONJ.SIERRA H. C-3','761','2','1','0.00','0.00'),(762,1,1,1013,1,2,17,'FREDDY',' SÁNCHEZ SÁNCHEZ','C','1719664318','0000-00-00','','M','2632867','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALFREDO ESCUDERO S21-66. LA GATAZO','762','2','1','0.00','0.00'),(763,1,1,1013,1,2,17,'JAIME',' VILLACRESES','C','1722389911','0000-00-00','','M','2509924','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RÍO DE JANIERO 748','763','2','1','0.00','0.00'),(764,1,1,1013,1,2,17,'JULIAN',' SANTOS CHERRES','C','1722463427','0000-00-00','','M','95033259','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RUMIPAMBA 3390 Y AMÉRICA','764','2','1','0.00','0.00'),(765,1,1,1013,1,2,17,'OSCAR',' SARASTY BENAVIDES','C','1715425664','0000-00-00','','M','2429022','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ATLÁNTICA 2 CASA 4. PANAM. NORTE KM 9 1/2','765','2','1','0.00','0.00'),(766,1,1,1013,1,2,17,'CARLOS',' SHIVE','C','1722251434','0000-00-00','','M','2428840','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.JARDINES DE CARCELÉN CASA B-56','766','2','1','0.00','0.00'),(767,1,1,1013,1,2,17,'JORGE',' SILVA','C','1722480140','0000-00-00','','M','2433120','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LA PRENSA 268 Y M.ECHEVERRÍA','767','2','1','0.00','0.00'),(768,1,1,1013,1,2,17,'RICARDO',' LÓPEZ MAYORGA','C','1722242771','0000-00-00','','M','2654364','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PIERRE HITTI BL-6 D-1.D','768','2','1','0.00','0.00'),(769,1,1,1013,1,2,17,'MARCO',' SOTOMAYOR BRAVO','C','1722318001','0000-00-00','','M','2531024','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. SAN JAIME CASA 16','769','2','1','0.00','0.00'),(770,1,1,1013,1,2,17,'EDWIN',' TAMAYO','C','1716534423','0000-00-00','','M','2802181','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','D.DE VÁSQUEZ Y A.NÚÑEZ TORRES EINSTEIN D-202.A','770','2','1','0.00','0.00'),(771,1,1,1013,1,2,17,'FAUSTO',' TAPIA VACA','C','1718161365','0000-00-00','','M','2423432','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.LOS ÁLAMOS C-27. CARAPUNGO','771','2','1','0.00','0.00'),(772,1,1,1013,1,2,17,'EDWIN',' TERÁN VISCAINO','C','1722389317','0000-00-00','','M','2655350','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.ALBERTO COLOMA S10-57 Y EGUSQUIZA','772','2','1','0.00','0.00'),(773,1,1,1013,1,2,17,'CÉSAR',' TROYA PASQUEL','C','1719125401','0000-00-00','','M','2479279','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE N74-B CASA OE2-47 Y AV.REAL AUDIENCIA','773','2','1','0.00','0.00'),(774,1,1,1013,1,2,17,'GILBERTO',' ULLOA VINUEZA','C','1714557210','0000-00-00','','M','2606090','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JARDÍN DEL VALLE CALLE 2-4 #677','774','2','1','0.00','0.00'),(775,1,1,1013,1,2,17,'PATRICIO',' VALENZUELA','C','1718723578','0000-00-00','','M','2350889','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. 1 #520 Y BOLÍVAR. POMASQUI.','775','2','1','0.00','0.00'),(776,1,1,1013,1,2,17,'LUIS',' VEGA','C','1722319314','0000-00-00','','M','2909093','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANA DE JESÚS Y CALLE D','776','2','1','0.00','0.00'),(777,1,1,1013,1,2,17,'PATRICIO',' ESPÍN','C','1718166448','0000-00-00','','M','2569203','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SELVA ALEGRE OE5-27 Y CARVAJAL','777','2','1','0.00','0.00'),(778,1,1,1013,1,2,17,'FABRICIO',' VELA','C','1722446182','0000-00-00','','M','2485512','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ELOY ALFARO Y CAPRI. CONJ.PORTAL DE CAPRI','778','2','1','0.00','0.00'),(779,1,1,1013,1,2,17,'MARCO',' REVELO GORDÓN','C','1721358867','0000-00-00','','M','2499159','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ M. CARRIÓN 71-36 LOMA HERMOSA','779','2','1','0.00','0.00'),(780,1,1,1013,1,2,17,'RAFAEL',' FLORES YÁNEZ','C','1716389117','0000-00-00','','M','2605148','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LAS ORQUIDEAS ROSSEAU 1244','780','2','1','0.00','0.00'),(781,1,1,1013,1,2,17,'PATRICIO',' VILLACÍS','C','1722240254','0000-00-00','','M','2244593','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RUMIPAMBA E2-230 ENTRE REPÚBLICA Y AMAZONAS','781','2','1','0.00','0.00'),(782,1,1,1013,1,2,17,'LUIS',' FONSECA','C','1722464227','0000-00-00','','M','2652085','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE D E1-30. TAMBO','782','2','1','0.00','0.00'),(783,1,1,1013,1,2,17,'JORGE',' VILLARREAL ERAZO','C','1722460894','0000-00-00','','M','3383102','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL CONDADO. CALLE LA SAGALITO 142','783','2','1','0.00','0.00'),(784,1,1,1013,1,2,17,'PERICLES',' VINOCUNA UREÑA','C','1722382254','0000-00-00','','M','2607235','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.RODRIGO JÁCOME 1326. URB.MOJAS LAS ORQUIDEAS','784','2','1','0.00','0.00'),(785,1,1,1013,1,2,17,'HUGO',' GODOY DÍAZ','C','1718162132','0000-00-00','','M','2498841','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','STA. TERESA N60-170','785','2','1','0.00','0.00'),(786,1,1,1013,1,2,17,'FERNANDO',' YÉPEZ DAZA','C','1722462858','0000-00-00','','M','2808174','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE 7 Y  DE LOS CIQUELOS','786','2','1','0.00','0.00'),(787,1,1,1013,1,2,17,'EDGAR',' BELTRÁN ZAPATA','C','1722018270','0000-00-00','','M','2591147','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BELLAVISTA OE4-501','787','2','1','0.00','0.00'),(788,1,1,1013,1,2,17,'PEDRO',' ALMEIDA MENA','C','1722441092','0000-00-00','','M','2223192','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS CASAS O336 Y CARVAJAL','788','2','1','0.00','0.00'),(789,1,1,1013,1,2,17,'MARCO',' YÉPEZ MERINO','C','1721074969','0000-00-00','','M','2297963','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN FIGUEROA 960 Y HUACHI','789','2','1','0.00','0.00'),(790,1,1,1013,1,2,17,'IVÁN',' ZAMORA AÍZAGA','C','1720895455','0000-00-00','','M','2340822','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARMENIA 1. JOSÉ JONAVEN 393 C-1','790','2','1','0.00','0.00'),(791,1,1,1013,1,2,17,'JORGE',' LARA JARAMILLO','C','1720408762','0000-00-00','','M','2634773','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.CAZALES BUENA AVENTURA C-22 CARAPUNGO','791','2','1','0.00','0.00'),(792,1,1,1013,1,2,17,'JUAN',' MEDINA MANZANO','C','1716756505','0000-00-00','','M','2417361','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','REAL AUDIENCIA 733','792','2','1','0.00','0.00'),(793,1,1,1013,1,2,17,'HÉCTOR',' MIRANDA ANDINO','C','1715036016','0000-00-00','','M','3203428','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALEJANDRO DE VALDEZ 24-138','793','2','1','0.00','0.00'),(794,1,1,1013,1,2,17,'RAMIRO',' PILATASIG LEMA','C','1721863395','0000-00-00','','M','2644194','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN DE ALCÁZAR Y ANDRÉS PÉREZ 1519','794','2','1','0.00','0.00'),(795,1,1,1013,1,2,17,'JORGE',' REGALADO DÁVILA','C','1722316708','0000-00-00','','M','2401683','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO DALMAU OE3-D','795','2','1','0.00','0.00'),(796,1,1,1013,1,2,17,'HENRY',' RÍOS PAZMIÑO','C','1716795107','0000-00-00','','M','2285335','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FERNÁNDEZ MADRID 221 Y ROCAFUERTE','796','2','1','0.00','0.00'),(797,1,1,1013,1,2,17,'LUIS',' SOTOMAYOR RENTERÍA','C','1714202932','0000-00-00','','M','2520023','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.COLOMBIA Y PAZMIÑO BL-4 D-507','797','2','1','0.00','0.00'),(798,1,1,1013,1,2,17,'ARTURO',' ZÚÑIGA ZÚÑIGA','C','1722314778','0000-00-00','','M','2350344','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA PAMPA II. L-11. POMASQUI.','798','2','1','0.00','0.00'),(799,1,1,1013,1,2,17,'EDISON',' RAMÍREZ CRUZ','C','1721946679','0000-00-00','','M','3226868','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP.UNIÓN NAVAL II. CASA E15-60. LA FLORESTA','799','2','1','0.00','0.00'),(800,1,1,1013,1,2,17,'JAIME',' SALGADO','C','1722251467','0000-00-00','','M','2238294','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.IGNACIO AYBAR 162 Y LA ISLA','800','2','1','0.00','0.00'),(801,1,1,1013,1,2,17,'FERNANDO',' CEVALLOS','C','1722440151','0000-00-00','','M','2528027','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.AMÉRICA 32-42','801','2','1','0.00','0.00'),(802,1,1,1013,1,2,17,'JOHNNY',' BAUS','C','1714559349','0000-00-00','','M','2592942','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO DE ALVARADO N62-30','802','2','1','0.00','0.00'),(803,1,1,1013,1,2,17,'HÉCTOR',' CEVALLOS','C','1714980784','0000-00-00','','M','3131202','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.CARLOS JARRÍN 247. PÍO XII','803','2','1','0.00','0.00'),(804,1,1,1013,1,2,17,'JORGE',' MARTÍNEZ','C','1716266075','0000-00-00','','M','2813201','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CASTELLI 535 Y MONTALVO','804','2','1','0.00','0.00'),(805,1,1,1013,1,2,17,'RODRIGO',' TERÁN','C','1720840543','0000-00-00','','M','2544730','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EE.UU N17-91 Y BOGOTÁ','805','2','1','0.00','0.00'),(806,1,1,1013,1,2,17,'MARIO',' VELOZ','C','0604313585','0000-00-00','','M','2490890','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL N70-455','806','2','1','0.00','0.00'),(807,1,1,1013,1,2,17,'RICARDO',' RANGEL','C','1723937262','0000-00-00','','M','2533588','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LOS REYES C-30. AV.DE LA PRENSA Y SABANILLA','807','2','1','0.00','0.00'),(808,1,1,1013,1,2,17,'FREDDY',' ALEMÁN','C','1718162082','0000-00-00','','M','2025457','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COOP.PROFESORES MUNICIPALES. CALDERÓN','808','2','1','0.00','0.00'),(809,1,1,1013,1,2,17,'JORGE',' CHERRES','C','1722385752','0000-00-00','','M','2507560','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LIBORIO MADERA Y M.TINAJERO','809','2','1','0.00','0.00'),(810,1,1,1013,1,2,17,'FREDDY',' SORIA','C','1722461827','0000-00-00','','M','2571738','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VALPARAIZO 322','810','2','1','0.00','0.00'),(811,1,1,1013,1,2,17,'HENRY',' TAPIA','C','0401302922','0000-00-00','','M','3440333','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MASTODONTES Y JAIME ROLDOS AGUILERA','811','2','1','0.00','0.00'),(812,1,1,1013,1,2,17,'JAIME',' ROMERO','C','1718161852','0000-00-00','','M','2890197','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. LAS ALMENDRAS. CUMBAYÁ','812','2','1','0.00','0.00'),(813,1,1,1013,1,2,17,'FÉLIX',' GALLO','C','1723647044','0000-00-00','','M','2581421','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TOLA BAJA. ANGELA DE CAAMAÑO 248.','813','2','1','0.00','0.00'),(814,1,1,1013,1,2,17,'TITO',' BASANTES','C','1719211102','0000-00-00','','M','2810023','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VIRGIL MATIRI E7-47','814','2','1','0.00','0.00'),(815,1,1,1013,1,2,17,'LUIS',' PROAÑO','C','1719593715','0000-00-00','','M','2522657','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIOFRÍO N16-34 Y TEGUCIGALPA','815','2','1','0.00','0.00'),(816,1,1,1013,1,2,17,'ANGEL',' ROMÁN','C','1721036943','0000-00-00','','M','2615457','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA INMACULADA PAS.BOLÍVAR E3-31','816','2','1','0.00','0.00'),(817,1,1,1013,1,2,17,'LENIN',' FLOR','C','1718129867','0000-00-00','','M','2265703','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANA DE JESÚS Y VALDERRAMA BL-226 D-22','817','2','1','0.00','0.00'),(818,1,1,1013,1,2,17,'DIEGO',' ABAD','C','1721225397','0000-00-00','','M','2606800','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.JARDÍN DEL VALLE PAS.22 C-661','818','2','1','0.00','0.00'),(819,1,1,1013,1,2,17,'PATRICIO',' ACOSTA','C','1721537221','0000-00-00','','M','2568786','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN L. MERA N26-21 Y STA.MARIA','819','2','1','0.00','0.00'),(820,1,1,1013,1,2,17,'FAUSTO',' ACOSTA','C','1717723025','0000-00-00','','M','3316379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VERACRUZ N35-01 Y AMÉRICA','820','2','1','0.00','0.00'),(821,1,1,1013,1,2,17,'RICARDO',' AIZAGA','C','1718163254','0000-00-00','','M','3400478','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.MIRADOR DEL BOSQUE C-16. SAN CARLOS','821','2','1','0.00','0.00'),(822,1,1,1013,1,2,17,'','','C','1721226890','0000-00-00','','M','2346417','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA ARMENIA L-92 CALLE 1-4 L-92','822','2','1','0.00','0.00'),(823,1,1,1013,1,2,17,'OSCAR',' ALBÁN','C','1718291147','0000-00-00','','M','2536599','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SABANILLA Y F.PACHECO COND.OCCIDENT. C-32','823','2','1','0.00','0.00'),(824,1,1,1013,1,2,17,'ÁNGEL',' ANCHALUISA','C','1721529806','0000-00-00','','M','2677685','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GÓMEZ DE LA TORRE 303. SAN BARTOLO','824','2','1','0.00','0.00'),(825,1,1,1013,1,2,17,'JAIME',' ANDRADE','C','1719292805','0000-00-00','','M','2481123','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NAZACOLA PUENTO Y 10 DE AGOSTO. CONJ.SNT.MARIANITA','825','2','1','0.00','0.00'),(826,1,1,1013,1,2,17,'ENRIQUEZ',' ANDRADE','C','1716072358','0000-00-00','','M','2594150','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁN CORTEZ N56-174. SAN CARLOS','826','2','1','0.00','0.00'),(827,1,1,1013,1,2,17,'FRANKLIN',' ANDRADE','C','1719700682','0000-00-00','','M','2848200','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.SANTIAGO. PUNTA ARENAS 1753 Y CORIG','827','2','1','0.00','0.00'),(828,1,1,1013,1,2,17,'PATRICIO',' ARAUJO','C','1721349940','0000-00-00','','M','2648937','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VICENTE ANDRADE Y AV.MALDONADO CONJ.P.DE CHINBACAL','828','2','1','0.00','0.00'),(829,1,1,1013,1,2,17,'JUAN',' ARAUJO','C','1721468682','0000-00-00','','M','2651552','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN DE ARGUELLO 334 Y P. DE ALFARO','829','2','1','0.00','0.00'),(830,1,1,1013,1,2,17,'HUGO',' ARELLANO','C','1721595070','0000-00-00','','M','2462618','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VASCO DE CONTRERAS 258 Y LALLEMENT','830','2','1','0.00','0.00'),(831,1,1,1013,1,2,17,'FERNANDO',' ARELLANO','C','1720981818','0000-00-00','','M','2924229','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LALLEMENT 446','831','2','1','0.00','0.00'),(832,1,1,1013,1,2,17,'JUAN','ARIAS','C','1721619813','0000-00-00','','M','2535931','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.LA PRENSA . COND.LOYOLA BL-15 D-13','832','2','1','0.00','0.00'),(833,1,1,1013,1,2,17,'LUIS',' ARMAS','C','1721532180','0000-00-00','','M','3401237','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BL-GUAYLLABAMBA.SAN CARLOS','833','2','1','0.00','0.00'),(834,1,1,1013,1,2,17,'SEGUNDO',' ARMAS','C','1716166606','0000-00-00','','M','2284736','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SUCRE OE5-53','834','2','1','0.00','0.00'),(835,1,1,1013,1,2,17,'MARIO',' ARMENDÁRIZ','C','1719417691','0000-00-00','','M','2559657','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RÍO DE JANEIRO OE3-192 Y URUGUAY','835','2','1','0.00','0.00'),(836,1,1,1013,1,2,17,'JOSÉ',' BÁEZ','C','1717398232','0000-00-00','','M','2552985','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','18 DE SEPTIEMBRE 1350 Y ARMERO','836','2','1','0.00','0.00'),(837,1,1,1013,1,2,17,'MARCO',' BASURI','C','1718524976','0000-00-00','','M','2584213','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GENERAL ENRÍQUEZ S8-336 Y RODRIGO DE CHÁVEZ','837','2','1','0.00','0.00'),(838,1,1,1013,1,2,17,'HUGO',' BERNYS','C','1718336488','0000-00-00','','M','2409918','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','10 DE AGOSTO Y P.ROMERO CASA 10','838','2','1','0.00','0.00'),(839,1,1,1013,1,2,17,'CARLOS',' BETANCOURT','C','1721406773','0000-00-00','','M','2282466','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARISCAL SUCRE 3663 Y HUANCAVILVA','839','2','1','0.00','0.00'),(840,1,1,1013,1,2,17,'YURI',' BOLAÑOS','C','1721512422','0000-00-00','','M','2397505','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA ANA 1100 Y DE LOS HEMISFERIOS','840','2','1','0.00','0.00'),(841,1,1,1013,1,2,17,'HERNÁN',' BURGOS','C','1718160326','0000-00-00','','M','2653181','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TNTE.GARCÍA 447 Y M. SUCRE','841','2','1','0.00','0.00'),(842,1,1,1013,1,2,17,'JOHN',' CABEZAS','C','1713718128','0000-00-00','','M','2905284','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MURGUEON 536. ENTRE AMÉRICA Y ULLOA','842','2','1','0.00','0.00'),(843,1,1,1013,1,2,17,'JAIME',' CABRERA','C','1804000550','0000-00-00','','M','2923126','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN PEDRO 3354 Y RUMIPAMBA','843','2','1','0.00','0.00'),(844,1,1,1013,1,2,17,'FABRICIO',' CADENA','C','1720439502','0000-00-00','','M','2896871','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CHIMBORAZO 1410 Y FCO. DE ORELLANA. CUMBAYÁ','844','2','1','0.00','0.00'),(845,1,1,1013,1,2,17,'MARIO',' CALLE','C','1721537460','0000-00-00','','M','2394558','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MISIÓN GEODÉSICA 4 Y LULUBAMBA','845','2','1','0.00','0.00'),(846,1,1,1013,1,2,17,'JOHN',' CAMACHO','C','1721408415','0000-00-00','','M','2671075','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL PROGRESO OE1-60. MAYORISTA','846','2','1','0.00','0.00'),(847,1,1,1013,1,2,17,'GERMÁN',' CÁRDENAS','C','1716993959','0000-00-00','','M','2548463','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. ATAHUALPA 219 Y ULLOA','847','2','1','0.00','0.00'),(848,1,1,1013,1,2,17,'DIEGO',' CARRILLO','C','1721604740','0000-00-00','','M','2470834','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AVELLANAS E6-03 Y ELOY ALFARO.','848','2','1','0.00','0.00'),(849,1,1,1013,1,2,17,'MARCO',' CAZAR','C','1721484374','0000-00-00','','M','3303093','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FERNANDO DÁVALOS 431 Y MANUEL SERRANO','849','2','1','0.00','0.00'),(850,1,1,1013,1,2,17,'ÁNGEL',' CEPEDA','C','1718860818','0000-00-00','','M','3200869','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DÍAZ DE LA MADRID Y ACEVEDO BL-C D-403','850','2','1','0.00','0.00'),(851,1,1,1013,1,2,17,'ÁNGEL',' CEPEDA','C','1718160904','0000-00-00','','M','2566894','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VERSALLES 2457 Y L. CORDERO','851','2','1','0.00','0.00'),(852,1,1,1013,1,2,17,'FREDDY',' CEVALLOS','C','1721509998','0000-00-00','','M','2527170','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LUGO Y LÉRIDA PAS.3 N22-109','852','2','1','0.00','0.00'),(853,1,1,1013,1,2,17,'CÉSAR',' CHÁVEZ','C','1721548608','0000-00-00','','M','2453506','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUELA SÁENZ 542 Y ABELARDO MONCAYO','853','2','1','0.00','0.00'),(854,1,1,1013,1,2,17,'LUIS',' CHILUIZA','C','1716160070','0000-00-00','','M','3441014','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ ORDÓÑEZ OE2-102 Y FCO. SANCHEZ','854','2','1','0.00','0.00'),(855,1,1,1013,1,2,17,'PABLO',' CISNEROS','C','1721543070','0000-00-00','','M','2473251','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MATILDE HIDALGO N81-22 Y A. DE JEREZ','855','2','1','0.00','0.00'),(856,1,1,1013,1,2,17,'LUIS',' COBA','C','1715313837','0000-00-00','','M','2410939','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.CÉSAR FRANK E3-54 E ISAC ALBÉNIZ','856','2','1','0.00','0.00'),(857,1,1,1013,1,2,17,'LUIS',' CÓRDOVA','C','1719652842','0000-00-00','','M','2292186','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. CALLE 1 C-E.32 Y CHUQUISACA. OFELIA','857','2','1','0.00','0.00'),(858,1,1,1013,1,2,17,'VÍCTOR',' CORRAL','C','1721605457','0000-00-00','','M','2450187','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA Y VERACRUZ 201','858','2','1','0.00','0.00'),(859,1,1,1013,1,2,17,'RAÚL',' COSTALES','C','1719241927','0000-00-00','','M','2957642','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VELA 285 Y AV.MALDONADO','859','2','1','0.00','0.00'),(860,1,1,1013,1,2,17,'HERMAN',' COUSIN','C','1716169360','0000-00-00','','M','3227026','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.WUAYCO 128 Y NICOLÁS CORTEZ','860','2','1','0.00','0.00'),(861,1,1,1013,1,2,17,'SAULO',' CUESTA','C','1718291634','0000-00-00','','M','2233342','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OB. DÍAZ DE LA MADRID 2E-06 Y VILLAVICENCIO','861','2','1','0.00','0.00'),(862,1,1,1013,1,2,17,'CARLOS',' CUEVA','C','1721524997','0000-00-00','','M','2646105','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.SANTA ANITA DOS MZ-3 C-10. PAS A.CARRANZA','862','2','1','0.00','0.00'),(863,1,1,1013,1,2,17,'LUIS',' DARQUEA','C','1718165697','0000-00-00','','M','2290710','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUALAQUIZA N62-149 Y SABANILLA','863','2','1','0.00','0.00'),(864,1,1,1013,1,2,17,'','','C','1721514790','0000-00-00','','M','2479618','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.DIEGO DE VÁSQUEZ Y CALLE C','864','2','1','0.00','0.00'),(865,1,1,1013,1,2,17,'MIGUEL',' DÍAZ','C','1716609449','0000-00-00','','M','2450808','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.PAYAMINO 180 Y 6 DE DICIEMBRE','865','2','1','0.00','0.00'),(866,1,1,1013,1,2,17,'NELSON',' DÍAZ','C','1721298188','0000-00-00','','M','2438862','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AUCAS N50-240 Y H.SALAS','866','2','1','0.00','0.00'),(867,1,1,1013,1,2,17,'FAUSTO',' DÍAZ','C','1715365373','0000-00-00','','M','2493943','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ GUERRERO 70-17 Y ALFONSO DEL HIERRO','867','2','1','0.00','0.00'),(868,1,1,1013,1,2,17,'EDISON',' ECHEVERRÍA','C','1717968752','0000-00-00','','M','3060431','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ PERALTA L-7 BL-2 D-251','868','2','1','0.00','0.00'),(869,1,1,1013,1,2,17,'NELSON',' ECHEVERRÍA','C','1721531802','0000-00-00','','M','2267206','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. DE LA PRENSA 956 Y TELÉGRAFO','869','2','1','0.00','0.00'),(870,1,1,1013,1,2,17,'JAIRO',' ENRÍQUEZ','C','1718163205','0000-00-00','','M','2921104','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.C.GALARZA CONJ.LAGUNA AZUL CASA 45','870','2','1','0.00','0.00'),(871,1,1,1013,1,2,17,'ROBERTO',' ERAZO','C','1713460663','0000-00-00','','M','2811303','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND. SAN SEBASTIÁN DEL NORTE BL-34.','871','2','1','0.00','0.00'),(872,1,1,1013,1,2,17,'MARCO',' ESPÍN','C','1720249497','0000-00-00','','M','2661599','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PINTAG 1114 Y HÚSARES','872','2','1','0.00','0.00'),(873,1,1,1013,1,2,17,'CÉSAR',' ESPINOSA','C','1717728636','0000-00-00','','M','2247579','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FÉLIX ORALABAL N45-165 Y ZAMORA','873','2','1','0.00','0.00'),(874,1,1,1013,1,2,17,'PATRICIO',' GARCÍA','C','1720875168','0000-00-00','','M','2551491','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARMERO 492 Y AV.UNIVERSITARIA','874','2','1','0.00','0.00'),(875,1,1,1013,1,2,17,'DIEGO',' GARRIDO','C','1721444428','0000-00-00','','M','2553338','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA ISLA 423 Y JOSÉ VALENTÍN','875','2','1','0.00','0.00'),(876,1,1,1013,1,2,17,'VÍCTOR',' GARZÓN','C','1721031209','0000-00-00','','M','2337115','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INÉS GANGOTENA L-2 Y 22 DE ENERO. SANGOLQUÍ','876','2','1','0.00','0.00'),(877,1,1,1013,1,2,17,'ROBIN',' GARZÓN','C','1721230074','0000-00-00','','M','2777842','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','YARUQUÍ. CALLE QUITO','877','2','1','0.00','0.00'),(878,1,1,1013,1,2,17,'GABRIEL',' GONZÁLEZ','C','1718161621','0000-00-00','','M','3201128','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DÍAZ DE LA MADRID Y JUAN ACEVEDO','878','2','1','0.00','0.00'),(879,1,1,1013,1,2,17,'XAVIER',' GRANDA','C','1715420558','0000-00-00','','M','2450351','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FCO. DE NATES 393 E HIDALGO DE PINTO','879','2','1','0.00','0.00'),(880,1,1,1013,1,2,17,'IVÁN',' GRIJALVA','C','1719538603','0000-00-00','','M','2290550','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NAZACOTA PUENTO N64-25 Y CALLE A','880','2','1','0.00','0.00'),(881,1,1,1013,1,2,17,'MARIO',' GUALAVISÍ','C','1721617536','0000-00-00','','M','3027834','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE TABIAZO Y MONTE OLIVOS MZ-D C-S.24-37','881','2','1','0.00','0.00'),(882,1,1,1013,1,2,17,'EZEQUIEL',' GUAMÁN','C','1721480794','0000-00-00','','M','2491906','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL Y LEGARDA. CONJ.EL FUNDADOR','882','2','1','0.00','0.00'),(883,1,1,1013,1,2,17,'EZEQUIEL',' GUAMÁN','C','1721480786','0000-00-00','','M','2491906','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.MARISCAL SUCRE N68-468 Y LEGARDA','883','2','1','0.00','0.00'),(884,1,1,1013,1,2,17,'RAFAEL',' GUERRA','C','1721602967','0000-00-00','','M','2543088','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IBERIA 691. LA FLORESTA','884','2','1','0.00','0.00'),(885,1,1,1013,1,2,17,'ANDRÉS',' GUERRÓN','C','0401661152','0000-00-00','','M','2599243','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUAN FIGUEROA 1566 Y LUIS VALLEJO','885','2','1','0.00','0.00'),(886,1,1,1013,1,2,17,'BYRON',' HARNISTH','C','1713646329','0000-00-00','','M','2407075','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.LA OFELIA MZ-B CASA OE2-16','886','2','1','0.00','0.00'),(887,1,1,1013,1,2,17,'FERNANDO',' HERDOIZA','C','1717343840','0000-00-00','','M','3302046','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SHUARAS Y GONZALO BENÍTEZ ED.RIM PARK D-2 PISO 1','887','2','1','0.00','0.00'),(888,1,1,1013,1,2,17,'MARCELO',' HERNÁNDEZ','C','1718161654','0000-00-00','','M','3110328','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOAQUÍN OROZCO S13-33 Y PALMIRA','888','2','1','0.00','0.00'),(889,1,1,1013,1,2,17,'EDUARDO',' HERRERA','C','1721487229','0000-00-00','','M','3332118','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PORTETE E10-259','889','2','1','0.00','0.00'),(890,1,1,1013,1,2,17,'JOSÉ',' LUIS HIDALGO','C','1718160300','0000-00-00','','M','2529736','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MONTEVIDEO OE9-438 Y TEGUCIGALPA','890','2','1','0.00','0.00'),(891,1,1,1013,1,2,17,'GUSTAVO',' HIDALGO','C','1720300308','0000-00-00','','M','3130760','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. NAPO S7-233 Y BOBONAZA','891','2','1','0.00','0.00'),(892,1,1,1013,1,2,17,'WASHINGTON',' JÁCOME','C','1719466573','0000-00-00','','M','2332389','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE ATAHUALPA 19-89. SANGOLQUÍ','892','2','1','0.00','0.00'),(893,1,1,1013,1,2,17,'VICENTE',' JIMÉNEZ','C','1721474516','0000-00-00','','M','2607500','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND. PUERTAS DEL SOL CASA 59. LOS CHILLOS','893','2','1','0.00','0.00'),(894,1,1,1013,1,2,17,'JOSÉ',' LEINES','C','1721543088','0000-00-00','','M','2591486','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE SANTA TERESA N64-81.COTOCOLLAO','894','2','1','0.00','0.00'),(895,1,1,1013,1,2,17,'FAUSTO',' LLERENA','C','1719873604','0000-00-00','','M','2499323','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OCCIDENTAL Y LEGARDA. CONJ.PALERMO B-9','895','2','1','0.00','0.00'),(896,1,1,1013,1,2,17,'FABIÁN',' LLIVE','C','1721594347','0000-00-00','','M','2952289','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUNÍN E3-139 Y JIJÓN','896','2','1','0.00','0.00'),(897,1,1,1013,1,2,17,'FABIÁN',' LÓPEZ','C','1718452962','0000-00-00','','M','2239582','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','6 DE DICIEMBRE 3229 Y JUAN SEVERINO','897','2','1','0.00','0.00'),(898,1,1,1013,1,2,17,'MARCO',' LOZANO','C','1721526802','0000-00-00','','M','2648136','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BALCONES DEL RECREO CASA 21. EL RECREO','898','2','1','0.00','0.00'),(899,1,1,1013,1,2,17,'PATRICIO',' LUNA','C','1718321985','0000-00-00','','M','2223368','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL DORADO. AV. COLOMBIA Y TELMO PAZ Y MIÑO D-505','899','2','1','0.00','0.00'),(900,1,1,1013,1,2,17,'YODER',' MACAS','C','1714833942','0000-00-00','','M','2472323','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARCELÉN. BL-TOMEBAMBA D-102','900','2','1','0.00','0.00'),(901,1,1,1013,1,2,17,'JOSÉ',' MANOSALVAS','C','1721236501','0000-00-00','','M','2380714','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GONZALO PIZARRO 808. PIFO','901','2','1','0.00','0.00'),(902,1,1,1013,1,2,17,'CARLOS',' MANOSALVAS','C','1721401501','0000-00-00','','M','2352586','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE A CASA 27. PUSUQUÍ','902','2','1','0.00','0.00'),(903,1,1,1013,1,2,17,'LUIS',' MANOSALVAS','C','1719147785','0000-00-00','','M','2412775','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BRASILIA DOS CASA 135','903','2','1','0.00','0.00'),(904,1,1,1013,1,2,17,'JORGE',' MERLO','C','1721603809','0000-00-00','','M','2292435','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SABANILLA OE3-312 Y CHUQUISACA','904','2','1','0.00','0.00'),(905,1,1,1013,1,2,17,'RENÉ',' MESTANZA','C','1715457824','0000-00-00','','M','2632723','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SERAPIO JAPERABI S13-248','905','2','1','0.00','0.00'),(906,1,1,1013,1,2,17,'JOSÉ',' MIRANDA','C','1721226932','0000-00-00','','M','2346213','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.ILALO Y 8TA.TRANSVERSAL 224. SAN RAFAEL','906','2','1','0.00','0.00'),(907,1,1,1013,1,2,17,'RODRIGO',' MONAR','C','1721359618','0000-00-00','','M','2596559','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DAVID LEDESMA N69-31','907','2','1','0.00','0.00'),(908,1,1,1013,1,2,17,'FERNANDO',' MONTALVO','C','1721602710','0000-00-00','','M','2416117','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN MIGUEL DE ANAGAES S/N. EL EDÉN','908','2','1','0.00','0.00'),(909,1,1,1013,1,2,17,'FERNANDO',' MOSCOSO','C','1719463612','0000-00-00','','M','98636811','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARUPOS 534 Y GONZÁLEZ SUÁREZ','909','2','1','0.00','0.00'),(910,1,1,1013,1,2,17,'DANIEL',' MUÑOZ','C','1721344701','0000-00-00','','M','2570055','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VARGAS 10-40 Y GALÁPAGOS','910','2','1','0.00','0.00'),(911,1,1,1013,1,2,17,'GERMÁN',' MUÑOZ','C','1717052979','0000-00-00','','M','2412598','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL MORLÁN 838 Y RAMOS','911','2','1','0.00','0.00'),(912,1,1,1013,1,2,17,'GEOVANNY',' NARVÁEZ','C','1721265088','0000-00-00','','M','2290107','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JARDINES DEL BOSQUE C-27','912','2','1','0.00','0.00'),(913,1,1,1013,1,2,17,'MARCO',' NARVÁEZ','C','1717723462','0000-00-00','','M','2890819','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.SUNA 350 Y MIGUEL ÁNGEL. CUMBAYÁ','913','2','1','0.00','0.00'),(914,1,1,1013,1,2,17,'ANDRÉS',' NAVARRETE','C','1719146902','0000-00-00','','M','2351373','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA PAMPA II. PAS.3 #209 Y 2DA. AVENIDA','914','2','1','0.00','0.00'),(915,1,1,1013,1,2,17,'ERNESTO',' NICOLALDE','C','1717929309','0000-00-00','','M','2239294','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL Y SOLIER 270. LAS CASAS','915','2','1','0.00','0.00'),(916,1,1,1013,1,2,17,'CARLOS',' NOROÑA','C','1721612578','0000-00-00','','M','2642973','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUALBERTO PÉREZ E2-207. EL CAMAL','916','2','1','0.00','0.00'),(917,1,1,1013,1,2,17,'IVÁN',' NÚÑEZ','C','1721205639','0000-00-00','','M','2285223','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BENALCÁZAR 1121 Y GALÁPAGOS','917','2','1','0.00','0.00'),(918,1,1,1013,1,2,17,'ROLANDO',' ORBEA','C','1718788282','0000-00-00','','M','2830524','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LLANO CHICO. LAS AZUCENAS S/N','918','2','1','0.00','0.00'),(919,1,1,1013,1,2,17,'FELIPE',' PACHECO','C','1715232714','0000-00-00','','M','2801471','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE MARIANO PAREDES N70-115 Y MOISÉS LUNA','919','2','1','0.00','0.00'),(920,1,1,1013,1,2,17,'MARCO',' PÁEZ','C','1721408670','0000-00-00','','M','2065316','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.SANTA MARIANITAS 4 C-192 PAS.U. CALDERÓN','920','2','1','0.00','0.00'),(921,1,1,1013,1,2,17,'LUIS',' PAREDES','C','1716893209','0000-00-00','','M','2530594','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS V C.4-11 Y ANTONIO VILLAVICENCIO','921','2','1','0.00','0.00'),(922,1,1,1013,1,2,17,'FAUSTO',' PAZMIÑO','C','1714192901','0000-00-00','','M','2520343','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JORGE JUAN 439 Y MARIANA DE JESÚS','922','2','1','0.00','0.00'),(923,1,1,1013,1,2,17,'FAUSTO',' PEÑA','C','1714005640','0000-00-00','','M','2674561','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FICOA S15-116 Y BUENA U. SAN BARTOLO','923','2','1','0.00','0.00'),(924,1,1,1013,1,2,17,'LUIS',' PERALVO','C','1719881003','0000-00-00','','M','2730564','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANDA SECTOR 1 MZ-1 C-7','924','2','1','0.00','0.00'),(925,1,1,1013,1,2,17,'WILSON',' PÉREZ','C','1721595591','0000-00-00','','M','2389673','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE LUCINDA TOLEDO S/N Y ALIANZA. ALOAG','925','2','1','0.00','0.00'),(926,1,1,1013,1,2,17,'JOSÉ',' PÉREZ','C','1714004858','0000-00-00','','M','2492710','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.JOYA DEL PICHINCHA C-B-8.COTOCOLLAO','926','2','1','0.00','0.00'),(927,1,1,1013,1,2,17,'EDDY',' PÉREZ','C','1719347229','0000-00-00','','M','2223424','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITTER Y BENJAMÍN CHÁVEZ 1434','927','2','1','0.00','0.00'),(928,1,1,1013,1,2,17,'ARTURO',' PIEDRA','C','1715209266','0000-00-00','','M','2476009','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. DEL MAESTRO OE2-182','928','2','1','0.00','0.00'),(929,1,1,1013,1,2,17,'EDWIN',' PIEDRA','C','0502554942','0000-00-00','','M','2650634','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAYAMBE 316 Y QUILINDAÑA. VILLAFLORA','929','2','1','0.00','0.00'),(930,1,1,1013,1,2,17,'GUSTAVO',' PONCE','C','1719568899','0000-00-00','','M','2291810','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN PEDRO CLAVER PAS.3 OE5-233 Y MACHALA','930','2','1','0.00','0.00'),(931,1,1,1013,1,2,17,'WASHINGTON',' PORTILLA','C','1718164153','0000-00-00','','M','2404731','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAP.RAMÓN BORJA E7-205 Y EL MORLÁN','931','2','1','0.00','0.00'),(932,1,1,1013,1,2,17,'JAIME',' POVEDA','C','1721408282','0000-00-00','','M','2641426','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COLTA E686 Y GUALACEO. CHIRIACU ALTO','932','2','1','0.00','0.00'),(933,1,1,1013,1,2,17,'GALO',' PRÓCEL','C','1718163932','0000-00-00','','M','3463318','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.MOLINEROS C-48. ENTRE 6 DE DICIEMBRE Y E.ALFA','933','2','1','0.00','0.00'),(934,1,1,1013,1,2,17,'CARLOS',' PUGA','C','1721407219','0000-00-00','','M','2626395','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MULALILLO S24-80 Y CHUMUNDE','934','2','1','0.00','0.00'),(935,1,1,1013,1,2,17,'ROMMEL',' QUINTANILLA','C','1720419702','0000-00-00','','M','2634190','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.BILOXI. PAS.13 CASA 183','935','2','1','0.00','0.00'),(936,1,1,1013,1,2,17,'FRANCISCO',' RACINES','C','0918659343','0000-00-00','','M','2663806','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SOLANO DE QUIÑÓNEZ 217 Y P. DE ALFARO','936','2','1','0.00','0.00'),(937,1,1,1013,1,2,17,'PATRICIO',' REDROVÁN','C','1718162579','0000-00-00','','M','2616982','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ILLESCAS 224 Y AV.MARISCAL SUCRE','937','2','1','0.00','0.00'),(938,1,1,1013,1,2,17,'MARCO',' RICAURTE','C','1714150149','0000-00-00','','M','2255157','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO BASÁN N35-45 Y MAÑOSCA','938','2','1','0.00','0.00'),(939,1,1,1013,1,2,17,'FERNANDO',' RIERA','C','1718164369','0000-00-00','','M','2614415','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO DE HERRERA 230','939','2','1','0.00','0.00'),(940,1,1,1013,1,2,17,'PATRICIO',' RODRÍGUEZ','C','1715580526','0000-00-00','','M','2656763','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','A. SOBERÓN 62 Y J.PERALTA','940','2','1','0.00','0.00'),(941,1,1,1013,1,2,17,'LUIS',' ROMÁN','C','1715905798','0000-00-00','','M','2410495','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL MATHEU N56-95 Y JOSÉ BORRERO','941','2','1','0.00','0.00'),(942,1,1,1013,1,2,17,'JORGE',' ROSALES','C','1720549524','0000-00-00','','M','2850077','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. BAVARIA CASA 6. SAN RAFAEL','942','2','1','0.00','0.00'),(943,1,1,1013,1,2,17,'HERNÁN',' ROSERO','C','1718004250','0000-00-00','','M','2652963','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PURUHA 376 Y AUTACHI. LA MAGDALENA','943','2','1','0.00','0.00'),(944,1,1,1013,1,2,17,'RUBÉN',' RUIZ','C','1721526307','0000-00-00','','M','2671948','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MULT.TURUBAMBA BAJO BL-J.LARREA 32 D-202','944','2','1','0.00','0.00'),(945,1,1,1013,1,2,17,'RONALD',' RUIZ','C','1719744664','0000-00-00','','M','2658812','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JUMANDÍ OE2-262. CDLA.ATAHUALPA','945','2','1','0.00','0.00'),(946,1,1,1013,1,2,17,'JORGE',' SALAS','C','1717597445','0000-00-00','','M','2394842','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN ANTONIO DE PICHINCHA','946','2','1','0.00','0.00'),(947,1,1,1013,1,2,17,'WILSON',' SALINAS','C','1721534061','0000-00-00','','M','2506077','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DIEGO MÉNDEZ 310 Y AV.AMÉRICA','947','2','1','0.00','0.00'),(948,1,1,1013,1,2,17,'JUAN',' SAMANIEGO','C','1716161551','0000-00-00','','M','2443180','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUELA SÁENZ N35-140 Y HERNÁNDEZ GIRÓN','948','2','1','0.00','0.00'),(949,1,1,1013,1,2,17,'VÍCTOR',' SÁNCHEZ','C','1718163437','0000-00-00','','M','3401316','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁN CORTEZ N57-181 Y VICENTE ANDA','949','2','1','0.00','0.00'),(950,1,1,1013,1,2,17,'LUIS',' SANDOVAL','C','1719364695','0000-00-00','','M','2922546','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANO HURTADO N50-154 Y VICENTE HEREDIA','950','2','1','0.00','0.00'),(951,1,1,1013,1,2,17,'JAIME',' SANDOVAL','C','1721483608','0000-00-00','','M','2493700','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL Y PAS.GUERRERO OE6-323','951','2','1','0.00','0.00'),(952,1,1,1013,1,2,17,'HUGO',' SILVA','C','1717723660','0000-00-00','','M','2250208','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNANDO DE LA CRUZ 650 Y ULLOA','952','2','1','0.00','0.00'),(953,1,1,1013,1,2,17,'ALEXANDER',' SILVA','C','1721532370','0000-00-00','','M','2974255','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.PEDRO V.MALDONADO 3895','953','2','1','0.00','0.00'),(954,1,1,1013,1,2,17,'PATRICIO',' SILVA','C','1718160151','0000-00-00','','M','2592798','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO FREILE N58-138 Y VACA DE CASTRO','954','2','1','0.00','0.00'),(955,1,1,1013,1,2,17,'FAUSTO',' SUÁREZ','C','1721532628','0000-00-00','','M','2237851','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TEGUCIGALPA Y RIQUELME OE9-59','955','2','1','0.00','0.00'),(956,1,1,1013,1,2,17,'RAÚL',' TAMAYO','C','1718160334','0000-00-00','','M','2249759','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUELA SÁENZ 198 Y RUMIPAMBA','956','2','1','0.00','0.00'),(957,1,1,1013,1,2,17,'WILLIAN',' TAPIA','C','1721437307','0000-00-00','','M','2678866','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE F 140 Y LAS LAJAS CDLA.UNIÓN POPULAR','957','2','1','0.00','0.00'),(958,1,1,1013,1,2,17,'PABLO',' TAPIA','C','1721407821','0000-00-00','','M','2505855','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARRIOLA 334 Y NARVÁEZ','958','2','1','0.00','0.00'),(959,1,1,1013,1,2,17,'MARCO',' TORRES','C','1721253985','0000-00-00','','M','3216627','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AMÉRICA 987 Y BOLIVIA','959','2','1','0.00','0.00'),(960,1,1,1013,1,2,17,'JORGE',' TORRES','C','1718160276','0000-00-00','','M','2604682','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MULT.LULUNCOTO BL-ILINIZA C D-202','960','2','1','0.00','0.00'),(961,1,1,1013,1,2,17,'','','C','1718160193','0000-00-00','','M','2287424','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ROCAFUERTE E3-119','961','2','1','0.00','0.00'),(962,1,1,1013,1,2,17,'HÉCTOR',' VÁSCONEZ','C','1720704863','0000-00-00','','M','2823910','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS GERANIOS 28 Y CARLOS M. ORTEGA','962','2','1','0.00','0.00'),(963,1,1,1013,1,2,17,'XAVIER',' VÁSQUEZ','C','1713587432','0000-00-00','','M','2414102','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PABLO CASALS 111','963','2','1','0.00','0.00'),(964,1,1,1013,1,2,17,'WILLIAM',' VÁSQUEZ','C','1719087759','0000-00-00','','M','2422269','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARAPUNGO. EL VERGEL CONJ.SAN MARTÍN 2','964','2','1','0.00','0.00'),(965,1,1,1013,1,2,17,'REMIGIO',' VILLACÍS','C','1719708826','0000-00-00','','M','2556814','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUALBERTO ARCOS 452 Y LAS CASAS','965','2','1','0.00','0.00'),(966,1,1,1013,1,2,17,'EDUARDO',' VILLACÍS','C','1720500022','0000-00-00','','M','2950390','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA PRISCA OE3-27','966','2','1','0.00','0.00'),(967,1,1,1013,1,2,17,'JORGE',' VILLOTA','C','1717260374','0000-00-00','','M','2342594','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.ARMENIA II. CALLE 8.2-A L-333 C-7','967','2','1','0.00','0.00'),(968,1,1,1013,1,2,17,'ROBERTO',' YAJAMÍN','C','1720359536','0000-00-00','','M','2592040','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA TERESA N65-110 Y LIBERTADOR','968','2','1','0.00','0.00'),(969,1,1,1013,1,2,17,'JORGE',' YÁNEZ','C','1721535480','0000-00-00','','M','2894748','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUMBAYÁ. VÍA A SAN PATRICIO','969','2','1','0.00','0.00'),(970,1,1,1013,1,2,17,'WILSON',' YÁNEZ','C','1721334959','0000-00-00','','M','2681420','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIO PRIETO S21-110 PICOAZA','970','2','1','0.00','0.00'),(971,1,1,1013,1,2,17,'MARIO',' YÁNEZ','C','1720409158','0000-00-00','','M','2682809','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.LUIS A.VALENCIA SECTOR 3 D-22. SOLANDA','971','2','1','0.00','0.00'),(972,1,1,1013,1,2,17,'IVÁN',' YÉPEZ','C','1721546545','0000-00-00','','M','2416983','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE F 49-110 Y CÉSAR FRANK. DAMMER II.','972','2','1','0.00','0.00'),(973,1,1,1013,1,2,17,'JULIO',' ZAMBRANO','C','1721513669','0000-00-00','','M','2289848','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BENALCÁZAR N3-67','973','2','1','0.00','0.00'),(974,1,1,1013,1,2,17,'CARLOS',' CASTILLO','C','1715610182','0000-00-00','','M','2563450','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.TRIVIÑO 166 Y AV.12 DE OCTUBRE','974','2','1','0.00','0.00'),(975,1,1,1013,1,2,17,'JUAN',' CHIRIBOGA','C','1721230900','0000-00-00','','M','2490961','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONDADO OE4-403 Y SAGALITA','975','2','1','0.00','0.00'),(976,1,1,1013,1,2,17,'RÓMULO',' DURÁN','C','1720994985','0000-00-00','','M','2380127','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IGNACIO JARRÍN L-3 S/N. PIFO','976','2','1','0.00','0.00'),(977,1,1,1013,1,2,17,'VICENTE',' GONZÁLEZ','C','1721547667','0000-00-00','','M','2598352','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL CORNEJO OE5-50 Y PREDRO FREYLE','977','2','1','0.00','0.00'),(978,1,1,1013,1,2,17,'PATRICIO',' MEJÍA','C','1721618625','0000-00-00','','M','2847606','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE DE LOS ENCUENTROS 710 Y JAPERABI','978','2','1','0.00','0.00'),(979,1,1,1013,1,2,17,'CÉSAR',' MORALES','C','1721617387','0000-00-00','','M','2428476','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.JARDINES DE CARCELÉN','979','2','1','0.00','0.00'),(980,1,1,1013,1,2,17,'GUSTAVO',' MOSQUERA','C','1721114138','0000-00-00','','M','2503155','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TOLOSA 115 Y BARCELONA','980','2','1','0.00','0.00'),(981,1,1,1013,1,2,17,'ROMEL',' MOYA','C','1717702342','0000-00-00','','M','2225211','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ASUNCIÓN OE4-62 Y VENEZUELA','981','2','1','0.00','0.00'),(982,1,1,1013,1,2,17,'ISAAC',' NÚÑEZ','C','1720459310','0000-00-00','','M','2429211','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND. HERNANDO PARRA BL-2 D-21','982','2','1','0.00','0.00'),(983,1,1,1013,1,2,17,'MANUEL',' PUPIALES','C','1719872572','0000-00-00','','M','2299558','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO DE ALVARADO N61-73 Y FLAVIO ALFARO','983','2','1','0.00','0.00'),(984,1,1,1013,1,2,17,'MANUEL',' PLASENCIA','C','1721480653','0000-00-00','','M','2807839','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HIGUERAS N65-51 Y ELOY ALFARO','984','2','1','0.00','0.00'),(985,1,1,1013,1,2,17,'WASHINGTON',' SAMANIEGO','C','1720736519','0000-00-00','','M','2648746','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MALTI 134 Y BOBONAZA','985','2','1','0.00','0.00'),(986,1,1,1013,1,2,17,'EDUARDO',' FLORES','C','1721546776','0000-00-00','','M','2821386','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALDERÓN. B. LANDÁZURI. CALLE LANDÁZURI 924 Y AUQU','986','2','1','0.00','0.00'),(987,1,1,1013,1,2,17,'ROMMEL',' TAPIA','C','1719142117','0000-00-00','','M','2352316','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JARDINES DE LA PAMPA 40','987','2','1','0.00','0.00'),(988,1,1,1013,1,2,17,'FERNANDO',' TERÁN','C','1721443008','0000-00-00','','M','2232872','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE LA PRIMAVERA OE211','988','2','1','0.00','0.00'),(989,1,1,1013,1,2,17,'GEOVANNY',' VALENZUELA','C','1715811558','0000-00-00','','M','2492888','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.OCCIDENTAL N71-06 Y CARRIÓN','989','2','1','0.00','0.00'),(990,1,1,1013,1,2,17,'MAURICIO',' ORTEGA','C','0201622818','0000-00-00','','M','2534430','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ RUIZ OE6-11 Y MACHALA','990','2','1','0.00','0.00'),(991,1,1,1013,1,2,17,'JAIME',' LÓPEZ','C','1720944840','0000-00-00','','M','2542441','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DIEGO MÉNDEZ 256 Y AMÉRICA','991','2','1','0.00','0.00'),(992,1,1,1013,1,2,17,'ENRIQUE',' RAMÓN','C','1721405171','0000-00-00','','M','2805375','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DANIEL COMBONI 110-1 Y STA.LUCÍA','992','2','1','0.00','0.00'),(993,1,1,1013,1,2,17,'GERMÁN',' ALMEIDA','C','1721531562','0000-00-00','','M','2861328','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RIO CURARAY Y LOS CANARIOS. CONJ.JARD.S.RAFAEL C-5','993','2','1','0.00','0.00'),(994,1,1,1013,1,2,17,'CARLOS',' MIRANDA','C','1716626146','0000-00-00','','M','2893486','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DE LAS ROCAS Y LOS MANANTIALES M-12 C-3. CUMBAYÁ','994','2','1','0.00','0.00'),(995,1,1,1013,1,2,17,'EDWIN',' ESPINOZA','C','1719981233','0000-00-00','','M','3171404','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LIBERTAD 172 Y PRIMERA TRANSVERSAL','995','2','1','0.00','0.00'),(996,1,1,1013,1,2,17,'GUSTAVO',' BOLAÑOS','C','1309939492','0000-00-00','','M','2463700','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BRASILIA II. PAS.E D.C-1','996','2','1','0.00','0.00'),(997,1,1,1013,1,2,17,'MAURICIO',' MIRANDA','C','1716072101','0000-00-00','','M','2354490','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAMPA 2. CALLE J #141 Y CALLE C','997','2','1','0.00','0.00'),(998,1,1,1013,1,2,17,'VÍCTOR',' MAYORGA','C','1721444691','0000-00-00','','M','2237979','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RUIZ DE CASTILLA N2-880','998','2','1','0.00','0.00'),(999,1,1,1013,1,2,17,'YEAN',' NARVÁEZ','C','1715076210','0000-00-00','','M','2338113','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GARCÍA MORENO 1478 Y GENERAL ENRÍQUEZ. SANGOLQUÍ','999','2','1','0.00','0.00'),(1000,1,1,1013,1,2,17,'PATRICIO',' ALBÁN','C','1718165655','0000-00-00','','M','2444936','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','INCA 2887','1000','2','1','0.00','0.00'),(1001,1,1,1013,1,2,17,'BAYARDO',' ENRÍQUEZ MARTÍNEZ','C','1718305418','0000-00-00','','M','2500954','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PUETO RICO 141 Y SELVA ALEGRE','1001','2','1','0.00','0.00'),(1002,1,1,1013,1,2,17,'FERNANDO',' ITURRALDE CÓRDOVA','C','1718163155','0000-00-00','','M','2434145','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EUSTAQUIO BLANCO OE5-90 Y MACHALA','1002','2','1','0.00','0.00'),(1003,1,1,1013,1,2,17,'LUIS',' MORÁN SILVA','C','1718164203','0000-00-00','','M','2522477','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA ISLA N30-50','1003','2','1','0.00','0.00'),(1004,1,1,1013,1,2,17,'CHRISTIAN',' MIRANDA ZABALA','C','1718171851','0000-00-00','','M','2473754','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.FONTANA DEL SOL C-16. BALCON DEL N.PONCIANO A','1004','2','1','0.00','0.00'),(1005,1,1,1013,1,2,17,'JORGE',' NARANJO SERRANO','C','1718160128','0000-00-00','','M','2284766','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GARCÍA MORENO 1354 Y MANABÍ','1005','2','1','0.00','0.00'),(1006,1,1,1013,1,2,17,'ALEJANDRO',' URRESTA BURBANO','C','1716601313','0000-00-00','','M','2482613','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LLANGARIMA 666 Y LUIS TUFIÑO N59-71','1006','2','1','0.00','0.00'),(1007,1,1,1013,1,2,17,'OSWALDO',' LÓPEZ','C','1716347990','0000-00-00','','M','2452265','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.AMAZONAS N49-177 Y HOLGUÍN','1007','2','1','0.00','0.00'),(1008,1,1,1013,1,2,17,'ALEXIS',' PAZOS','C','1718019860','0000-00-00','','M','2225194','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LUGO 611 Y VALLADOLIT. LA FLORESTA','1008','2','1','0.00','0.00'),(1009,1,1,1013,1,2,17,'GALO',' ALMEIDA','C','1719684290','0000-00-00','','M','2354896','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASEO DEL SOL 245. PUSUQUÍ','1009','2','1','0.00','0.00'),(1010,1,1,1013,1,2,17,'GUSTAVO',' CAMACHO','C','0201978293','0000-00-00','','M','2296540','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AZUAY 816 Y ANTIGUA COLOMBIA','1010','2','1','0.00','0.00'),(1011,1,1,1013,1,2,17,'SERGIO',' CARRANZA','C','1718130550','0000-00-00','','M','2900327','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AGUIRRE 421 Y VERSALLES','1011','2','1','0.00','0.00'),(1012,1,1,1013,1,2,17,'OMAR',' PÁEZ','C','1723475537','0000-00-00','','M','2535482','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DOMINGO SEGURA 6526 Y BELLAVISTA','1012','2','1','0.00','0.00'),(1013,1,1,1013,1,2,17,'ESTEBAN',' PÉREZ','C','0105272124','0000-00-00','','M','2229718','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN IGNACIO 11-52','1013','2','1','0.00','0.00'),(1014,1,1,1013,1,2,17,'GERMAN',' CARTAGENA','C','1205698051','0000-00-00','','M','3170698','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MILLER OE6-280 Y OLEARY','1014','2','1','0.00','0.00'),(1015,1,1,1013,1,2,17,'','','C','','0000-00-00','','M','2244635','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HOMERO SALAS OE4-57','1015','2','1','0.00','0.00'),(1016,1,1,1013,1,2,17,'JAIME',' CONCHA','C','1717938136','0000-00-00','','M','2600036','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. JARDÍN DEL VALLE 2 L-545','1016','2','1','0.00','0.00'),(1017,1,1,1013,1,2,17,'MAURICIO',' CHÁVEZ','C','1715829246','0000-00-00','','M','2542897','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN GABRIEL OE 1-10','1017','2','1','0.00','0.00'),(1018,1,1,1013,1,2,17,'HÉCTOR',' MEDINA','C','1718028648','0000-00-00','','M','2629527','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANDA RUMICHACA S28-152','1018','2','1','0.00','0.00'),(1019,1,1,1013,1,2,17,'BIRON',' MIÑO','C','1719504423','0000-00-00','','M','2494873','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MENA DEL HIERRO Y MACHALA OE 865','1019','2','1','0.00','0.00'),(1020,1,1,1013,1,2,17,'CARLOS',' ORTUÑO','C','1716912538','0000-00-00','','M','2249348','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL VALDIVIESO 359 Y BRASIL','1020','2','1','0.00','0.00'),(1021,1,1,1013,1,2,17,'RIQUELME',' SOLÍS','C','1723646541','0000-00-00','','M','2626544','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE SERAPIO JAPERAVI 807','1021','2','1','0.00','0.00'),(1022,1,1,1013,1,2,17,'JUAN','ZURITA','C','1718028523','0000-00-00','','M','2320676','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. CAROLINA II CASA 52','1022','2','1','0.00','0.00'),(1023,1,1,1013,1,2,17,'JOSÉ',' PAREDES','C','0604580431','0000-00-00','','M','2459033','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS. A C-17 Y ABASCAL. BATÁN','1023','2','1','0.00','0.00'),(1024,1,1,1013,1,2,17,'YEZID',' PANTOJA','C','1719926659','0000-00-00','','M','2494870','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV DE LA PRENSA N71-98 Y PABLO PICASSO','1024','2','1','0.00','0.00'),(1025,1,1,1013,1,2,17,'PATRICIO',' ACOSTA','C','1719651075','0000-00-00','','M','3303803','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EUSTAQUIO BLANCO 153 Y M.SERRANO.LA FLORIDA','1025','2','1','0.00','0.00'),(1026,1,1,1013,1,2,17,'GERMAN',' ALMEIDA RODRIGUEZ','C','1719896324','0000-00-00','','M','2861328','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CANARIOS 5','1026','2','1','0.00','0.00'),(1027,1,1,1013,1,2,17,'MARIO',' ABRIL','C','1720941507','0000-00-00','','M','2264340','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','YUGOSLAVIA N33-61 Y RUMIPAMBA','1027','2','1','0.00','0.00'),(1028,1,1,1013,1,2,17,'CARLOS',' AGUIRRE','C','1717661647','0000-00-00','','M','2461776','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS BREVAS E10-167 Y EL INCA.','1028','2','1','0.00','0.00'),(1029,1,1,1013,1,2,17,'HENRY',' ALBORNOZ','C','0401436662','0000-00-00','','M','2248613','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL GAVIRIA E8-51 Y 6 DE DICIEMBRE','1029','2','1','0.00','0.00'),(1030,1,1,1013,1,2,17,'ROMMEL',' ALBUJA','C','1722454947','0000-00-00','','M','2405744','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.EL INCA 1820 E ISLA SEYMUR CASA 14','1030','2','1','0.00','0.00'),(1031,1,1,1013,1,2,17,'MARIO',' ALEMÁN','C','1720934288','0000-00-00','','M','2420677','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PANAMERICANA NORTE KM 9 1/2 PASAJE 6-B CASA 7','1031','2','1','0.00','0.00'),(1032,1,1,1013,1,2,17,'MARCO',' ANDINO','C','1716968415','0000-00-00','','M','2823015','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE QUINTA 41-A. SAN JOSÉ DE MORÁN','1032','2','1','0.00','0.00'),(1033,1,1,1013,1,2,17,'EDWIN',' ANDRADE','C','1716215890','0000-00-00','','M','2423340','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.EL PINAR CASA 66. CARAPUNGO','1033','2','1','0.00','0.00'),(1034,1,1,1013,1,2,17,'WILSON',' ANGUETA','C','1719851493','0000-00-00','','M','2620342','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL CORONADO 262 Y CARLOS FREILE','1034','2','1','0.00','0.00'),(1035,1,1,1013,1,2,17,'MARIO',' ANGOS','C','1720963808','0000-00-00','','M','2651821','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUAYNALCÓN OE7-06 Y GENERAL PINTAG','1035','2','1','0.00','0.00'),(1036,1,1,1013,1,2,17,'EDGAR',' APUNTE','C','1720944659','0000-00-00','','M','2427171','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARAPUNGO ETAPA E.  MZ-5 C-18','1036','2','1','0.00','0.00'),(1037,1,1,1013,1,2,17,'SANTIAGO',' ARIAS','C','1720942109','0000-00-00','','M','3200229','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL CASARES OE6-10 Y MARTÍN DE UTRERAS','1037','2','1','0.00','0.00'),(1038,1,1,1013,1,2,17,'FERNANDO',' ARMAS','C','1719810184','0000-00-00','','M','3261313','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL DE ANAGAES E15-120. EL EDÉN','1038','2','1','0.00','0.00'),(1039,1,1,1013,1,2,17,'ARMANDO',' ARMAS','C','1720927183','0000-00-00','','M','99708545','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.AMARANTA D-105.D. V.DE LOS CHILLOS PUENTE 2','1039','2','1','0.00','0.00'),(1040,1,1,1013,1,2,17,'LUIS',' ASTUDILLO','C','1717152167','0000-00-00','','M','2294120','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JOSÉ M. GUERRERO Y MANTA','1040','2','1','0.00','0.00'),(1041,1,1,1013,1,2,17,'GONZALO',' AVILÉS','C','1717999054','0000-00-00','','M','2613017','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALONSO DE ANGULO OE12-26','1041','2','1','0.00','0.00'),(1042,1,1,1013,1,2,17,'RODRIGO',' BALLAGÁN','C','1720931078','0000-00-00','','M','3195285','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COVI 520 Y BALDEÓN','1042','2','1','0.00','0.00'),(1043,1,1,1013,1,2,17,'ORLEY',' BARCIA','C','1718247230','0000-00-00','','M','2260468','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.MARIANA DE JESUS 799 ACCESO 41-42','1043','2','1','0.00','0.00'),(1044,1,1,1013,1,2,17,'ALONSO',' BASANTES','C','1720508587','0000-00-00','','M','2595427','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS 1662 Y REAL AUDIENCIA','1044','2','1','0.00','0.00'),(1045,1,1,1013,1,2,17,'JAIME',' BENALCÁZAR','C','1719538652','0000-00-00','','M','2246398','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MELCHOR LORIEGA N36-133 Y MAÑOSCA','1045','2','1','0.00','0.00'),(1046,1,1,1013,1,2,17,'MARCELO',' BRAVO','C','1716531890','0000-00-00','','M','2895897','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CEDROS Y ARRAYÁN URB.VALLE 1. CUMBAYÁ','1046','2','1','0.00','0.00'),(1047,1,1,1013,1,2,17,'SAUL',' BRIONES','C','0301352274','0000-00-00','','M','2470784','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO LONDOÑO E2-32','1047','2','1','0.00','0.00'),(1048,1,1,1013,1,2,17,'HUGO',' CADENA','C','1718165895','0000-00-00','','M','2568917','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','POLIT LASSO Y GASPAR SANGURIMA','1048','2','1','0.00','0.00'),(1049,1,1,1013,1,2,17,'JAIME',' CALDERÓN','C','1720334919','0000-00-00','','M','2336385','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANGOLQUÍ. PORTÓN DE MÁLAGA # 1','1049','2','1','0.00','0.00'),(1050,1,1,1013,1,2,17,'FERNANDO',' CARRERA','C','1714954250','0000-00-00','','M','2896249','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS LILAS 52 Y LOS CRISANTEMOS. CUMBAYÁ.','1050','2','1','0.00','0.00'),(1051,1,1,1013,1,2,17,'RAMIRO',' CARRILLO','C','1716725732','0000-00-00','','M','2485699','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE JUSTO ABRIL N64-38 Y JOSÉ AMESALVA','1051','2','1','0.00','0.00'),(1052,1,1,1013,1,2,17,'JORGE',' CARRIÓN','C','1720933439','0000-00-00','','M','2820098','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS PINOS 283 Y PANAMERICANA NORTE','1052','2','1','0.00','0.00'),(1053,1,1,1013,1,2,17,'SEGUNDO',' CARVAJAL','C','1720305596','0000-00-00','','M','2281176','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE SAN LUIS 1285 Y ANTE','1053','2','1','0.00','0.00'),(1054,1,1,1013,1,2,17,'ADOLFO',' CASTAÑEDA','C','1720541554','0000-00-00','','M','2959064','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALDAS 494 Y GUAYAQUIL','1054','2','1','0.00','0.00'),(1055,1,1,1013,1,2,17,'CARLOS',' CÉSPEDES','C','1714559968','0000-00-00','','M','2229623','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE DIEGO HERRERA 2069 Y SANTA ROSA','1055','2','1','0.00','0.00'),(1056,1,1,1013,1,2,17,'PABLO',' CEVALLOS','C','1714321799','0000-00-00','','M','2277930','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COCHAPATA E11-129 C-19 Y ABASCAL','1056','2','1','0.00','0.00'),(1057,1,1,1013,1,2,17,'JULIO',' CORRALES','C','1719985838','0000-00-00','','M','3262794','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.RES.BALCÓN DE SAN ISIDRO C-4','1057','2','1','0.00','0.00'),(1058,1,1,1013,1,2,17,'LUIS',' CHÁVEZ','C','1715412001','0000-00-00','','M','2960991','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. CAMINOS DEL SUR CASA 168','1058','2','1','0.00','0.00'),(1059,1,1,1013,1,2,17,'MIGUEL',' DÁVILA','C','1717870206','0000-00-00','','M','2397659','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CARDENALES 100 Y GILGUEROS. SAN ANTONIO DE PIC','1059','2','1','0.00','0.00'),(1060,1,1,1013,1,2,17,'JAIME',' DELGADO','C','1720963758','0000-00-00','','M','2654902','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RAFAEL ARTETA GARCÍA S10-27 Y CALVAS','1060','2','1','0.00','0.00'),(1061,1,1,1013,1,2,17,'RODRIGO',' EGAS','C','1720940210','0000-00-00','','M','2232210','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VICENTE AGUIRRE 421 Y VERSALLES','1061','2','1','0.00','0.00'),(1062,1,1,1013,1,2,17,'GALO',' EGAS','C','1716820228','0000-00-00','','M','2402799','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DE LOS OLIVOS E16-373. EL INCA','1062','2','1','0.00','0.00'),(1063,1,1,1013,1,2,17,'JULIO',' ENRÍQUEZ','C','1715608962','0000-00-00','','M','2619381','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SGTO. TORRES OE2-705. CDLA.ATAHUALPA','1063','2','1','0.00','0.00'),(1064,1,1,1013,1,2,17,'JORGE',' ESCALANTE','C','1718166067','0000-00-00','','M','2354047','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.LA JOYA 23. POMASQUI.','1064','2','1','0.00','0.00'),(1065,1,1,1013,1,2,17,'GERMAN',' ESCOBAR','C','1717430894','0000-00-00','','M','2581358','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BABAHOYO OE9-22 E IMBABURA','1065','2','1','0.00','0.00'),(1066,1,1,1013,1,2,17,'PATRICIO',' ESTRELLA','C','1720962602','0000-00-00','','M','2486144','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','10 DE AGOSTO Y AMEZABA NUEVO AMANECER D.404','1066','2','1','0.00','0.00'),(1067,1,1,1013,1,2,17,'MILTON',' FAJARDO','C','1720934338','0000-00-00','','M','2643284','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE NOVO 138 Y CACHA.','1067','2','1','0.00','0.00'),(1068,1,1,1013,1,2,17,'LUIS',' FLORES','C','1720939816','0000-00-00','','M','2531761','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARLOS V Y OCCIDENTAL BL-AZUAY D-301','1068','2','1','0.00','0.00'),(1069,1,1,1013,1,2,17,'JUAN',' FREIRE','C','1715928865','0000-00-00','','M','2570774','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OVIEDO E51-23 Y ARAUCANA','1069','2','1','0.00','0.00'),(1070,1,1,1013,1,2,17,'JOSE',' GALARZA','C','1718163650','0000-00-00','','M','2255134','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA N36-09 Y PASAJE C.','1070','2','1','0.00','0.00'),(1071,1,1,1013,1,2,17,'OMAR',' GANCHALA','C','1720945151','0000-00-00','','M','2826630','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. SAN JOSÉ DE MORÁN PORTAL 1 CASA 26','1071','2','1','0.00','0.00'),(1072,1,1,1013,1,2,17,'AUDELIO',' GARCÍA','C','1720932837','0000-00-00','','M','2553864','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URUGUAY 429 Y BOGOTÁ','1072','2','1','0.00','0.00'),(1073,1,1,1013,1,2,17,'EDISON',' GARCÍA','C','1714405550','0000-00-00','','M','2523616','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GUALBERTO ARCOS N2828 Y SELVA ALEGRE','1073','2','1','0.00','0.00'),(1074,1,1,1013,1,2,17,'SANTIAGO',' GARZÓN','C','1718242546','0000-00-00','','M','2451490','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HERNÁNDEZ DE GIRÓN Y PEDREGAL','1074','2','1','0.00','0.00'),(1075,1,1,1013,1,2,17,'GUSTAVO',' GÓMEZ','C','1714486428','0000-00-00','','M','2520226','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','WILSON 547 Y REINA VICTORIA','1075','2','1','0.00','0.00'),(1076,1,1,1013,1,2,17,'CARLOS',' GRANJA','C','1719596825','0000-00-00','','M','2605135','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. HAB. LAS ORQUIDEAS CASA 9. MONJAS ORQUIDEAS','1076','2','1','0.00','0.00'),(1077,1,1,1013,1,2,17,'JOSE',' GUEVARA','C','1718165945','0000-00-00','','M','2568477','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LA PRIMAVERA OE11-211. LAS CASAS','1077','2','1','0.00','0.00'),(1078,1,1,1013,1,2,17,'VICTOR',' GUILLÉN','C','1719654855','0000-00-00','','M','2567136','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','IMBABURA 1958 Y CARCHI','1078','2','1','0.00','0.00'),(1079,1,1,1013,1,2,17,'ALEX',' GUZMÁN','C','1716065543','0000-00-00','','M','2592544','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VILLAVICENCIO Y ROBALINO. T.PARQUE INGLÉS D-271','1079','2','1','0.00','0.00'),(1080,1,1,1013,1,2,17,'JAIME',' GUZMÁN','C','1716603186','0000-00-00','','M','3228554','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANTONIO SIERRA 9 Y VERDE CRUZ','1080','2','1','0.00','0.00'),(1081,1,1,1013,1,2,17,'GONZALO',' GUZMÁN','C','1715845820','0000-00-00','','M','2660609','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAURO GUERRERO 350 E INTI.','1081','2','1','0.00','0.00'),(1082,1,1,1013,1,2,17,'PATRICIO',' HERRERA','C','1719992370','0000-00-00','','M','2073061','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.ESTANCIA DE LA ARMENIA C-13. LA ARMENIA','1082','2','1','0.00','0.00'),(1083,1,1,1013,1,2,17,'RUBEN',' HIDALGO','C','1720933702','0000-00-00','','M','2464686','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JÍBAROS N52-102 E INGAPIRCA','1083','2','1','0.00','0.00'),(1084,1,1,1013,1,2,17,'GONZALO',' HIDALGO','C','1720039583','0000-00-00','','M','2286943','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RITHER 71 Y BOLIVIA','1084','2','1','0.00','0.00'),(1085,1,1,1013,1,2,17,'GUIDO',' HINOJOSA','C','1718162900','0000-00-00','','M','2444840','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RUMIPAMBA OE4-14 Y AMÉRICA','1085','2','1','0.00','0.00'),(1086,1,1,1013,1,2,17,'JAIME',' IBARRA','C','1720671310','0000-00-00','','M','2866345','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PASAJE B Y RÍO PASTAZA. VÍA AL TINGO','1086','2','1','0.00','0.00'),(1087,1,1,1013,1,2,17,'DAVID',' JARA','C','1720941945','0000-00-00','','M','2255352','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MARIANO EGAS N38-123','1087','2','1','0.00','0.00'),(1088,1,1,1013,1,2,17,'JUAN',' JARRÍN','C','1720963212','0000-00-00','','M','2296018','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MANUEL GUIZADO OE7-151 Y DOMINGO JUAN','1088','2','1','0.00','0.00'),(1089,1,1,1013,1,2,17,'WILBER',' LAIME','C','1720979366','0000-00-00','','M','2676065','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','TEODORO GÓMEZ DE LA TORRE S14-166','1089','2','1','0.00','0.00'),(1090,1,1,1013,1,2,17,'RUBEN',' LARREA','C','1720943875','0000-00-00','','M','3200777','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','R. NAVARRO N23-69 Y LA GASCA.','1090','2','1','0.00','0.00'),(1091,1,1,1013,1,2,17,'JUAN','LATORRE','C','1720943149','0000-00-00','','M','2470460','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BARTOLOMÉ CARBO N78-41 Y PEDRO DE AYALA','1091','2','1','0.00','0.00'),(1092,1,1,1013,1,2,17,'ELICIO',' LEDESMA','C','1720947777','0000-00-00','','M','2240334','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA 317 Y REPÚBLICA','1092','2','1','0.00','0.00'),(1093,1,1,1013,1,2,17,'JORGE',' LÓPEZ','C','1718163189','0000-00-00','','M','2483086','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS TULIPANES. CONJ.SAN EDUARDO #2. AGUA CLARA','1093','2','1','0.00','0.00'),(1094,1,1,1013,1,2,17,'MIGUEL',' MALDONADO','C','1715824262','0000-00-00','','M','2296667','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO CIEZA DE LEON N61-83 Y FLAVIO ALFARO','1094','2','1','0.00','0.00'),(1095,1,1,1013,1,2,17,'LUIS',' MARTÍNEZ','C','1720937323','0000-00-00','','M','2822736','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA. ALEGRÍA CALLE B-10 CASA 53.','1095','2','1','0.00','0.00'),(1096,1,1,1013,1,2,17,'JORGE',' MARTÍNEZ','C','1718901265','0000-00-00','','M','2445157','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FCO.CRUZ MIRANDA N35-294 Y MAÑOSCA','1096','2','1','0.00','0.00'),(1097,1,1,1013,1,2,17,'SEGUNDO',' MARTÍNEZ','C','1720943388','0000-00-00','','M','2443379','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS MALVAS N45-135 E HIGUERAS C-3. MONTESERRÍN','1097','2','1','0.00','0.00'),(1098,1,1,1013,1,2,17,'JULIO',' MARTÍNEZ','C','1716874688','0000-00-00','','M','2613314','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARANQUI 630 Y MARISCAL SUCRE','1098','2','1','0.00','0.00'),(1099,1,1,1013,1,2,17,'OSWALDO',' MEDINA','C','1717527129','0000-00-00','','M','2401284','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAPITÁN RAFEL RAMOS E3-31. LA LUZ','1099','2','1','0.00','0.00'),(1100,1,1,1013,1,2,17,'LEROY',' MEJÍA','C','1716174238','0000-00-00','','M','2332267','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. 31 DE MAYO # 9 Y 24 DE ENERO. SANGOLQUÍ','1100','2','1','0.00','0.00'),(1101,1,1,1013,1,2,17,'EDGARDO',' MOLINA','C','1717740995','0000-00-00','','M','2394106','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN ANTONIO DE PICHINCHA. 13 DE JUNIO 1392.','1101','2','1','0.00','0.00'),(1102,1,1,1013,1,2,17,'OSWALDO',' MOLINA','C','1720932605','0000-00-00','','M','2500577','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ATACAMES 204 Y LA GASCA','1102','2','1','0.00','0.00'),(1103,1,1,1013,1,2,17,'GUILLERMO',' MONTES','C','1718873993','0000-00-00','','M','2556978','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SODIRO 227 Y GRAN COLOMBIA','1103','2','1','0.00','0.00'),(1104,1,1,1013,1,2,17,'GILBERTO',' MONTOYA','C','1714110077','0000-00-00','','M','2670944','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PUNGALÁ OE1-393 Y MANGLAR ALTO','1104','2','1','0.00','0.00'),(1105,1,1,1013,1,2,17,'FERNANDO',' MOREANO','C','1720935681','0000-00-00','','M','3131774','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUTUCHI 508 Y PAUTE','1105','2','1','0.00','0.00'),(1106,1,1,1013,1,2,17,'RENE',' MOREJÓN','C','1719007666','0000-00-00','','M','2658265','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PEDRO DE ALFARO 1204 Y MARIANO','1106','2','1','0.00','0.00'),(1107,1,1,1013,1,2,17,'JERRY',' MOZO','C','1713069696','0000-00-00','','M','2289258','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUENCA 15-14 Y CARCHI','1107','2','1','0.00','0.00'),(1108,1,1,1013,1,2,17,'FERNANDO',' MUÑOZ','C','1715746622','0000-00-00','','M','2405294','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FRANCISCO SALGADO 192 Y CAP. RAMOS','1108','2','1','0.00','0.00'),(1109,1,1,1013,1,2,17,'FREDY',' NARANJO','C','1720943891','0000-00-00','','M','2563961','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VEINTIMILLA 656 Y R. VICTORIA','1109','2','1','0.00','0.00'),(1110,1,1,1013,1,2,17,'LUIS',' NARVÁEZ','C','1720759727','0000-00-00','','M','2582292','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NUEVA YORK 319 Y GALÁPAGOS','1110','2','1','0.00','0.00'),(1111,1,1,1013,1,2,17,'ULISES',' NARVÁEZ','C','1720962990','0000-00-00','','M','2546700','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EE.UU 17-154 Y ASUNCIÓN','1111','2','1','0.00','0.00'),(1112,1,1,1013,1,2,17,'JOSE',' NAULA','C','1720963337','0000-00-00','','M','2314627','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHACHI. AV.PABLO GUARDERAS 118','1112','2','1','0.00','0.00'),(1113,1,1,1013,1,2,17,'JUAN','NAVARRETE','C','1717629982','0000-00-00','','M','2290117','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JORGE PIEDRA 1500 C-42','1113','2','1','0.00','0.00'),(1114,1,1,1013,1,2,17,'JUAN',' ÑAUÑAY','C','1719702183','0000-00-00','','M','2228505','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BUENOS AIRES OE5-157','1114','2','1','0.00','0.00'),(1115,1,1,1013,1,2,17,'GUILLERMO',' OCHOA','C','1718897661','0000-00-00','','M','2526424','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ROMUALDO NAVARRO 188 Y LA GASCA','1115','2','1','0.00','0.00'),(1116,1,1,1013,1,2,17,'PABLO',' OLMEDO','C','1720943560','0000-00-00','','M','2453439','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HOMERO SALAS 410 Y MANUEL SERRANO','1116','2','1','0.00','0.00'),(1117,1,1,1013,1,2,17,'HECTOR',' ORBE','C','1720894599','0000-00-00','','M','2347960','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN JOSÉ DEL VALLE','1117','2','1','0.00','0.00'),(1118,1,1,1013,1,2,17,'GUILLERMO',' ORTEGA','C','1720927779','0000-00-00','','M','2665499','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','QUITUS 741 Y GENERAL QUISQUÍS','1118','2','1','0.00','0.00'),(1119,1,1,1013,1,2,17,'FREDY',' ORTIZ','C','1720942141','0000-00-00','','M','2653721','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUAYNAPALCÓN 577 Y CACHA. LA MAGDALENA','1119','2','1','0.00','0.00'),(1120,1,1,1013,1,2,17,'MARCELO',' OTAÑEZ','C','1718164641','0000-00-00','','M','2226177','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANDAGOYA OE3-323 Y RUIZ DE CASTILLA','1120','2','1','0.00','0.00'),(1121,1,1,1013,1,2,17,'ESTUARDO',' PÁEZ','C','1720932779','0000-00-00','','M','2569730','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PRIMAVERA OE11-295 Y PADRE DAMIAN','1121','2','1','0.00','0.00'),(1122,1,1,1013,1,2,17,'HERNÁN',' PALACIOS','C','1718163320','0000-00-00','','M','2556989','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JORGE TOBAR 845-A Y TORIBIO HIDALGO','1122','2','1','0.00','0.00'),(1123,1,1,1013,1,2,17,'LUIS',' PALMA','C','1720941424','0000-00-00','','M','2480586','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB. URABA CALLE C #34','1123','2','1','0.00','0.00'),(1124,1,1,1013,1,2,17,'FERNANDO',' PALOMEQUE','C','1720729795','0000-00-00','','M','2294447','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ARTETA 16-A Y LEGARDA C-2','1124','2','1','0.00','0.00'),(1125,1,1,1013,1,2,17,'FREDDY',' PAREDES','C','1713763918','0000-00-00','','M','2405008','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MURIALDO OE2-25 Y MATHEU','1125','2','1','0.00','0.00'),(1126,1,1,1013,1,2,17,'CARLOS',' PAREDES','C','1716856016','0000-00-00','','M','2292878','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ÁNGEL LUDEÑA 417 Y GUERRERO','1126','2','1','0.00','0.00'),(1127,1,1,1013,1,2,17,'RENE',' PÉREZ','C','1717676082','0000-00-00','','M','2822842','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.SAN JOSÉ CALLE 11 CASA 66-B.X','1127','2','1','0.00','0.00'),(1128,1,1,1013,1,2,17,'JOSE',' POLO','C','1720629730','0000-00-00','','M','2801822','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','REAL AUDIENCIA 2966 Y NAZARETH','1128','2','1','0.00','0.00'),(1129,1,1,1013,1,2,17,'LUIS',' POZO','C','1720943495','0000-00-00','','M','2822508','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE CARAPUNGO 2960 Y CARÁN. CALDERÓN','1129','2','1','0.00','0.00'),(1130,1,1,1013,1,2,17,'MAURICIO',' PROAÑO','C','1713462123','0000-00-00','','M','2314893','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.PABLO GUARDERAS Y 3ERA. TRANSVERSAL','1130','2','1','0.00','0.00'),(1131,1,1,1013,1,2,17,'JORGE',' PUERTAS','C','1720358918','0000-00-00','','M','2525411','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VALPARAISO N12-83 Y JULIO CASTRO','1131','2','1','0.00','0.00'),(1132,1,1,1013,1,2,17,'PATRICIO',' QUIROLA','C','1720945334','0000-00-00','','M','3441908','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARCELÉN. SM-D M-13 CASA 9','1132','2','1','0.00','0.00'),(1133,1,1,1013,1,2,17,'JAIME',' REYES','C','1718320805','0000-00-00','','M','2490540','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RÍO PUCUNA 181 Y JUAN PRÓCEL','1133','2','1','0.00','0.00'),(1134,1,1,1013,1,2,17,'JORGE',' RIVADENEIRA','C','1720944782','0000-00-00','','M','2404249','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MIGUEL ÁLVAREZ OE260. BAKKER II.','1134','2','1','0.00','0.00'),(1135,1,1,1013,1,2,17,'PEDRO',' RIVADENEIRA','C','1720932654','0000-00-00','','M','2591075','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUACHI N64-138 Y JUAN FIGUEROA','1135','2','1','0.00','0.00'),(1136,1,1,1013,1,2,17,'CARLOS',' RODAS','C','1713062592','0000-00-00','','M','2595312','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N',' MANUEL GUIZADO 133 Y HUACHI. COTOCOLLAO','1136','2','1','0.00','0.00'),(1137,1,1,1013,1,2,17,'RAUL',' RODRÍGUEZ','C','1719950956','0000-00-00','','M','2507006','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','DOMINGO ESPINAR 26 Y LIZARAZU','1137','2','1','0.00','0.00'),(1138,1,1,1013,1,2,17,'CARLOS',' ROMERO','C','1720931854','0000-00-00','','M','2607476','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV. GRAL. RUMIÑAHUI KM 4,7. COND.PUERTA DEL SOL','1138','2','1','0.00','0.00'),(1139,1,1,1013,1,2,17,'EDWIN',' ROSERO','C','1713566832','0000-00-00','','M','2348510','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.ILALO Y CALLE K L-D. URB.BANCO DEL PICHINCHA','1139','2','1','0.00','0.00'),(1140,1,1,1013,1,2,17,'GUILLERMO',' RUIZ','C','1720967890','0000-00-00','','M','2600548','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GONZALO ESCUDERO 1735','1140','2','1','0.00','0.00'),(1141,1,1,1013,1,2,17,'JORGE',' RUIZ','C','1720965399','0000-00-00','','M','3123088','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ADRIAN NAVARRO E2-122','1141','2','1','0.00','0.00'),(1142,1,1,1013,1,2,17,'BOLIVAR',' RUIZ','C','1720936747','0000-00-00','','M','2426105','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PANAMERICANA NORTE KM 10 1/2','1142','2','1','0.00','0.00'),(1143,1,1,1013,1,2,17,'DANILO',' SALAZAR','C','1714022918','0000-00-00','','M','2500302','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','OBISPO DÍAZ DE LA MADRID 1154 Y ESPINOSA','1143','2','1','0.00','0.00'),(1144,1,1,1013,1,2,17,'LARRY',' SALGADO','C','1712641388','0000-00-00','','M','2485454','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','COND.EINSTEIN CASA 2. CARCELÉN','1144','2','1','0.00','0.00'),(1145,1,1,1013,1,2,17,'EDMUNDO',' SANCHO','C','1712902053','0000-00-00','','M','2410079','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','6 DE DICIEMBRE Y LOS ÁLAMOS','1145','2','1','0.00','0.00'),(1146,1,1,1013,1,2,17,'MARCO',' SANTAMARÍA','C','1720962826','0000-00-00','','M','2491039','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','RICARDO DESCALZI 886 Y CALLE W','1146','2','1','0.00','0.00'),(1147,1,1,1013,1,2,17,'ROMULO',' SANTILLÁN','C','1720942463','0000-00-00','','M','2494076','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','AV.MARISCAL SUCRE N70-146 Y MACHALA','1147','2','1','0.00','0.00'),(1148,1,1,1013,1,2,17,'GUNTHER',' SEIDL','C','1720495157','0000-00-00','','M','2591110','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS CEDROS OE3-290 Y PEDRO BOTTO','1148','2','1','0.00','0.00'),(1149,1,1,1013,1,2,17,'MARCO',' SEGOVIA','C','0502588411','0000-00-00','','M','2272763','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CRISTÓBAL SANDOVAL 445 Y ALTAR','1149','2','1','0.00','0.00'),(1150,1,1,1013,1,2,17,'MILTON',' SOSA','C','1720944600','0000-00-00','','M','2503281','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE B E15-45 E IBERIA','1150','2','1','0.00','0.00'),(1151,1,1,1013,1,2,17,'WASHINGTON',' SUASNAVAS','C','1720968476','0000-00-00','','M','3063512','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ÁNGEL LUDEÑA 830 Y PEDRO DE MENDOZA','1151','2','1','0.00','0.00'),(1152,1,1,1013,1,2,17,'JAIME',' SUBÍA','C','1720509973','0000-00-00','','M','2494366','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.EL CONDADO CALLE T Y PAS.3 OE6-467','1152','2','1','0.00','0.00'),(1153,1,1,1013,1,2,17,'JHON',' TAPIA','C','1720231826','0000-00-00','','M','2070339','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.MONSERRAT L-10. VÍA ANTIGUO CONOCOTO','1153','2','1','0.00','0.00'),(1154,1,1,1013,1,2,17,'SILVIO',' TAPIA','C','1717558876','0000-00-00','','M','2347411','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.ACOSTA SOBERÓN CALLE A #144. CONOCOTO','1154','2','1','0.00','0.00'),(1155,1,1,1013,1,2,17,'EDUARDO',' TORRES','C','1713904132','0000-00-00','','M','2466096','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ. LA MAESTRANZA D.73-B.','1155','2','1','0.00','0.00'),(1156,1,1,1013,1,2,17,'OSWALDO',' TORRES','C','1718360876','0000-00-00','','M','2804503','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PANAMERICANA NORTE KM 9 1/2 . ATLÁNTICA 2 CASA 7.','1156','2','1','0.00','0.00'),(1157,1,1,1013,1,2,17,'CÉSAR',' TROYA','C','1719125419','0000-00-00','','M','2479279','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CASA OE2-47 CALLE N74.B Y REAL AUDIENCIA','1157','2','1','0.00','0.00'),(1158,1,1,1013,1,2,17,'LUIS',' VACA','C','1720944378','0000-00-00','','M','2248017','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAMILO CASARES N33-82 Y BOSMEDIANO','1158','2','1','0.00','0.00'),(1159,1,1,1013,1,2,17,'ANGEL',' VACA','C','1720942588','0000-00-00','','M','2490914','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.MENA DEL HIERRO. CALLE RÍO BIGAL OE8A N71-18','1159','2','1','0.00','0.00'),(1160,1,1,1013,1,2,17,'CARLOS',' VALENZUELA','C','1715360507','0000-00-00','','M','2527171','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ASUNCIÓN 130 Y 10 DE AGOSTO','1160','2','1','0.00','0.00'),(1161,1,1,1013,1,2,17,'FRANKLIN',' VALVERDE','C','1720961778','0000-00-00','','M','2478053','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BALCÓN DEL NORTE. ED.ESMERALDA 4TO.PISO D-401. PON','1161','2','1','0.00','0.00'),(1162,1,1,1013,1,2,17,'JOSE',' VALLEJO','C','1713677837','0000-00-00','','M','2906383','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CRISTÓBAL DE ACUÑA 642 Y AMÉRICA','1162','2','1','0.00','0.00'),(1163,1,1,1013,1,2,17,'EDISON',' VALLEJO','C','0502954993','0000-00-00','','M','2548004','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VIZCAYA 431 Y AV.CORUÑA D-3','1163','2','1','0.00','0.00'),(1164,1,1,1013,1,2,17,'JORGE',' VÁSCONEZ','C','1716386105','0000-00-00','','M','2643125','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SIGCHOS 102 A Y PASAJE S','1164','2','1','0.00','0.00'),(1165,1,1,1013,1,2,17,'MARCO',' VÁSQUEZ','C','1720943586','0000-00-00','','M','2592794','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MACHALA 22-30 Y VACA DE CASTRO','1165','2','1','0.00','0.00'),(1166,1,1,1013,1,2,17,'LUIS',' VENEGAS','C','1719253856','0000-00-00','','M','2642474','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CAÑARIS OE 362 Y AUTACHI DUCHICELA','1166','2','1','0.00','0.00'),(1167,1,1,1013,1,2,17,'LUIS',' VIERA','C','1715038327','0000-00-00','','M','2613172','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CIUDADELA LOS ARRAYANES MZ-2 CASA-16','1167','2','1','0.00','0.00'),(1168,1,1,1013,1,2,17,'FREDY',' YANCHAPAXI','C','1720112414','0000-00-00','','M','3214331','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URUGUAY 342 Y RÍO DE JANEIRO','1168','2','1','0.00','0.00'),(1169,1,1,1013,1,2,17,'GERMAN',' YANDÚN','C','1714228226','0000-00-00','','M','2405819','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','EL INCA E6-25 CASA 19','1169','2','1','0.00','0.00'),(1170,1,1,1013,1,2,17,'HUGO',' YÁNEZ','C','1719899799','0000-00-00','','M','2472118','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CRISTÓBAL ÁLVEZ N81-62 Y PEDRO DE FRUTOS','1170','2','1','0.00','0.00'),(1171,1,1,1013,1,2,17,'FERNANDO',' YÁNEZ','C','1719508473','0000-00-00','','M','2607370','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JARDÍN DEL VALLE PASAJE 2-S #486','1171','2','1','0.00','0.00'),(1172,1,1,1013,1,2,17,'MARCELO',' YÉPEZ','C','1720945466','0000-00-00','','M','2922441','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','GROGORIO BOBADILLA 285 Y VILLALENGUA','1172','2','1','0.00','0.00'),(1173,1,1,1013,1,2,17,'SEGUNDO',' ZUMÁRRAGA','C','1716723273','0000-00-00','','M','2296901','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','NAZARETH 1030 Y AV. REAL AUDIENCIA','1173','2','1','0.00','0.00'),(1174,1,1,1013,1,2,17,'RAUL',' REYES','C','1720599115','0000-00-00','','M','2236077','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CUERO Y CAICEDO 1180 Y LA ISLA','1174','2','1','0.00','0.00'),(1175,1,1,1013,1,2,17,'PEDRO',' YÁNEZ','C','1718162918','0000-00-00','','M','2641617','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ANA P. DE ALFARO S9-465 Y FRANCISCO COBO','1175','2','1','0.00','0.00'),(1176,1,1,1013,1,2,17,'HUMBERTO',' SERRANO','C','2000046025','0000-00-00','','M','2448906','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN CRISTÓBAL 1327 Y GUEPI. JIPIJAPA','1176','2','1','0.00','0.00'),(1177,1,1,1013,1,2,17,'DANIZETE',' DE PAULA','C','1713062832','0000-00-00','','M','2483569','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE DE LOS CIPRESES 1516 Y HELECHOS','1177','2','1','0.00','0.00'),(1178,1,1,1013,1,2,17,'ABELARDO',' LARA','C','1721745584','0000-00-00','','M','2823363','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN CAMILO. CALDERON L-47','1178','2','1','0.00','0.00'),(1179,1,1,1013,1,2,17,'MIGUEL',' VILLAFUERTE','C','1719474171','0000-00-00','','M','2402460','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LAS TORONJAS N45-327 Y AV. EL INCA','1179','2','1','0.00','0.00'),(1180,1,1,1013,1,2,17,'WLADIMIR',' ORTEGA','C','1722319280','0000-00-00','','M','2443047','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ISLA SAN CRISTOBAL 546 Y T. DE BERLANGA','1180','2','1','0.00','0.00'),(1181,1,1,1013,1,2,17,'PABLO','ARCINIEGA MONTESDEOCA','C','1719897256','0000-00-00','','M','2232562','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SAN GREGORIO OE88 Y RAMÍREZ DÁVALOS','1181','2','1','0.00','0.00'),(1182,1,1,1013,1,2,17,'EUSEVIO',' OSORIO','C','1715880504','0000-00-00','','M','2322492','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LOS EUCALIPTOS 29 Y AUTOPISTA G.RUMIÑAHUI','1182','2','1','0.00','0.00'),(1183,1,1,1013,1,2,17,'SERGIO',' SALAZAR','C','1721835195','0000-00-00','','M','2291320','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE D OE3-71 Y NASACOTA PUENTO','1183','2','1','0.00','0.00'),(1184,1,1,1013,1,2,17,'ALONSO',' BERMEO','C','1718080474','0000-00-00','','M','2802639','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CARCELÉN BAJO MZ-J PAS.31 CASA N90-44','1184','2','1','0.00','0.00'),(1185,1,1,1013,1,2,17,'RICARDO',' MORILLO','C','1721400628','0000-00-00','','M','3341536','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','PAS.LAS MARGARITAS E10-63 Y AV.EL INCA','1185','2','1','0.00','0.00'),(1186,1,1,1013,1,2,17,'LUIS',' ESCOBAR','C','1721783213','0000-00-00','','M','2635498','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CDLA.CHIMBORAZO PUNTA ARENAS S13-89','1186','2','1','0.00','0.00'),(1187,1,1,1013,1,2,17,'FRANCISCO',' PUEBLA','C','1721768727','0000-00-00','','M','2351406','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SANTA TERESA L-1 CALLE PARAISO DE LAS ROSAS. POMAS','1187','2','1','0.00','0.00'),(1188,1,1,1013,1,2,17,'JAIME',' VINUEZA','C','1718244476','0000-00-00','','M','2395310','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CALLE 21 DE MARZO 608. SAN ANTONIO DE PICHINCHA','1188','2','1','0.00','0.00'),(1189,1,1,1013,1,2,17,'AUGUSTO',' CRUZ','C','1716753858','0000-00-00','','M','2450177','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','VASCO DE CONTRERAS 408 Y ABELARDO MONCAYO','1189','2','1','0.00','0.00'),(1190,1,1,1013,1,2,17,'LUIS',' ROSERO','C','1717558074','0000-00-00','','M','2807759','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','BELLAVISTA OE2-110 Y REAL AUDIENCIA','1190','2','1','0.00','0.00'),(1191,1,1,1013,1,2,17,'PATRICIO',' QUEZADA','C','1721867404','0000-00-00','','M','2527797','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ACUÑA OE3-284 Y AMÉRICA','1191','2','1','0.00','0.00'),(1192,1,1,1013,1,2,17,'HERNANDO',' CAISAPANTA','C','1721942306','0000-00-00','','M','2814328','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ALGARROBOS E3-139 Y DIÓGENES PAREDES','1192','2','1','0.00','0.00'),(1193,1,1,1013,1,2,17,'ESTEBAN',' ÁLVAREZ','C','0103833935','0000-00-00','','M','2290346','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','HUACHI 868 Y FLAVIO ALFARO','1193','2','1','0.00','0.00'),(1194,1,1,1013,1,2,17,'MARCELO',' FLORES','C','1718587759','0000-00-00','','M','2040338','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','URB.RESIDENCIALES EL VALLE. CUMBAYÁ','1194','2','1','0.00','0.00'),(1195,1,1,1013,1,2,17,'CARLOS',' ORBE','C','1718163684','0000-00-00','','M','2954073','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','J.MARÍA GUERRERO Y MANTA. COTOCOLLAO','1195','2','1','0.00','0.00'),(1196,1,1,1013,1,2,17,'FÉLIX',' GALLO HIDALGO','C','1720448974','0000-00-00','','M','2581421','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','ÁNGELA CAAMAÑO 248 Y C.T. TOLA BAJA','1196','2','1','0.00','0.00'),(1197,1,1,1013,1,2,17,'SILVIO',' GUERRERO','C','0401226766','0000-00-00','','M','','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','','1197','2','1','0.00','0.00'),(1198,1,1,1013,1,2,17,'OSWALDO',' GAON','C','1722820279','0000-00-00','','M','2505042','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','O.DÍAZ DE LA MADRID 947 Y N. DE VALDERRAMA','1198','2','1','0.00','0.00'),(1199,1,1,1013,1,2,17,'PABLO',' BOADA','C','1719340554','0000-00-00','','M','2410950','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','CONJ.BRASILIA II C-265','1199','2','1','0.00','0.00'),(1200,1,1,1013,1,2,17,'JOSÉ',' LANDÍVAR','C','1723544712','0000-00-00','','M','3303696','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','FLORIDA Y RAFAEL CUERVO 209','1200','2','1','0.00','0.00'),(1201,1,1,1013,1,2,17,'FABIÁN',' DAVALOS','C','1724198708','0000-00-00','','M','2295150','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','SABANILLA 228 Y PEDRO MUÑOZ','1201','2','1','0.00','0.00'),(1202,1,1,1013,1,2,17,'LUIS',' LARA','C','1713144762','0000-00-00','','M','93853917','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','MAÑOSCA 794 Y AMÉRICA','1202','2','1','0.00','0.00'),(1203,1,1,1013,1,2,17,'FABIÁN',' MALDONADO','C','1716467566','0000-00-00','','M','2435067','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','JAIME CEVALLOS 270 Y AGUSTÍN ZAMBRANO','1203','2','1','0.00','0.00'),(1204,1,1,1013,1,2,17,'LUIS',' VALVERDE','C','','0000-00-00','','M','2590825','EMPLEADO','','0.00','AUTO',2008,'0.00','BANCO','BANCO','CUENTA','CUENTA','TARJETA','TARJETA','N','LUIS TUFIÑO 159-734 Y RÍO PUTUMAYO','1204','2','1','0.00','0.00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `padres` ENABLE KEYS */;

--
-- Table structure for table `padres_alumno`
--

DROP TABLE IF EXISTS `padres_alumno`;
CREATE TABLE `padres_alumno` (
  `serial_palu` int(11) NOT NULL auto_increment,
  `serial_alu` int(11) default NULL,
  `serial_pad` int(11) default NULL,
  `serial_par` int(11) default NULL,
  `representante_palu` char(1) default NULL,
  `repreEconomico_palu` char(1) default NULL,
  PRIMARY KEY  (`serial_palu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `padres_alumno`
--


/*!40000 ALTER TABLE `padres_alumno` DISABLE KEYS */;
LOCK TABLES `padres_alumno` WRITE;
INSERT INTO `padres_alumno` VALUES (1,1,1,1,'S','S'),(2,2,2,1,'S','S'),(3,3,3,1,'S','S'),(4,4,4,1,'S','S'),(5,5,5,1,'S','S'),(6,6,6,1,'S','S'),(7,7,7,1,'S','S'),(8,8,8,1,'S','S'),(9,9,9,1,'S','S'),(10,10,10,1,'S','S'),(11,11,11,1,'S','S'),(12,12,12,1,'S','S'),(13,13,13,1,'S','S'),(14,14,14,1,'S','S'),(15,15,15,1,'S','S'),(16,16,16,1,'S','S'),(17,17,17,1,'S','S'),(18,18,18,1,'S','S'),(19,19,19,1,'S','S'),(20,20,20,1,'S','S'),(21,21,21,1,'S','S'),(22,22,22,1,'S','S'),(23,23,23,1,'S','S'),(24,24,24,1,'S','S'),(25,25,25,1,'S','S'),(26,26,26,1,'S','S'),(27,27,27,1,'S','S'),(28,28,28,1,'S','S'),(29,29,29,1,'S','S'),(30,30,30,1,'S','S'),(31,31,31,1,'S','S'),(32,32,32,1,'S','S'),(33,33,33,1,'S','S'),(34,34,34,1,'S','S'),(35,35,35,1,'S','S'),(36,36,36,1,'S','S'),(37,37,37,1,'S','S'),(38,38,38,1,'S','S'),(39,39,39,1,'S','S'),(40,40,40,1,'S','S'),(41,41,41,1,'S','S'),(42,42,42,1,'S','S'),(43,43,43,1,'S','S'),(44,44,44,1,'S','S'),(45,45,45,1,'S','S'),(46,46,46,1,'S','S'),(47,47,47,1,'S','S'),(48,48,48,1,'S','S'),(49,49,49,1,'S','S'),(50,50,50,1,'S','S'),(51,51,51,1,'S','S'),(52,52,52,1,'S','S'),(53,53,53,1,'S','S'),(54,54,54,1,'S','S'),(55,55,55,1,'S','S'),(56,56,56,1,'S','S'),(57,57,57,1,'S','S'),(58,58,58,1,'S','S'),(59,59,59,1,'S','S'),(60,60,60,1,'S','S'),(61,61,61,1,'S','S'),(62,62,62,1,'S','S'),(63,63,63,1,'S','S'),(64,64,64,1,'S','S'),(65,65,65,1,'S','S'),(66,66,66,1,'S','S'),(67,67,67,1,'S','S'),(68,68,68,1,'S','S'),(69,69,69,1,'S','S'),(70,70,70,1,'S','S'),(71,71,71,1,'S','S'),(72,72,72,1,'S','S'),(73,73,73,1,'S','S'),(74,74,74,1,'S','S'),(75,75,75,1,'S','S'),(76,76,76,1,'S','S'),(77,77,77,1,'S','S'),(78,78,78,1,'S','S'),(79,79,79,1,'S','S'),(80,80,80,1,'S','S'),(81,81,81,1,'S','S'),(82,82,82,1,'S','S'),(83,83,83,1,'S','S'),(84,84,84,1,'S','S'),(85,85,85,1,'S','S'),(86,86,86,1,'S','S'),(87,87,87,1,'S','S'),(88,88,88,1,'S','S'),(89,89,89,1,'S','S'),(90,90,90,1,'S','S'),(91,91,91,1,'S','S'),(92,92,92,1,'S','S'),(93,93,93,1,'S','S'),(94,94,94,1,'S','S'),(95,95,95,1,'S','S'),(96,96,96,1,'S','S'),(97,97,97,1,'S','S'),(98,98,98,1,'S','S'),(99,99,99,1,'S','S'),(100,100,100,1,'S','S'),(101,101,101,1,'S','S'),(102,102,102,1,'S','S'),(103,103,103,1,'S','S'),(104,104,104,1,'S','S'),(105,105,105,1,'S','S'),(106,106,106,1,'S','S'),(107,107,107,1,'S','S'),(108,108,108,1,'S','S'),(109,109,109,1,'S','S'),(110,110,110,1,'S','S'),(111,111,111,1,'S','S'),(112,112,112,1,'S','S'),(113,113,113,1,'S','S'),(114,114,114,1,'S','S'),(115,115,115,1,'S','S'),(116,116,116,1,'S','S'),(117,117,117,1,'S','S'),(118,118,118,1,'S','S'),(119,119,119,1,'S','S'),(120,120,120,1,'S','S'),(121,121,121,1,'S','S'),(122,122,122,1,'S','S'),(123,123,123,1,'S','S'),(124,124,124,1,'S','S'),(125,125,125,1,'S','S'),(126,126,126,1,'S','S'),(127,127,127,1,'S','S'),(128,128,128,1,'S','S'),(129,129,129,1,'S','S'),(130,130,130,1,'S','S'),(131,131,131,1,'S','S'),(132,132,132,1,'S','S'),(133,133,133,1,'S','S'),(134,134,134,1,'S','S'),(135,135,135,1,'S','S'),(136,136,136,1,'S','S'),(137,137,137,1,'S','S'),(138,138,138,1,'S','S'),(139,139,139,1,'S','S'),(140,140,140,1,'S','S'),(141,141,141,1,'S','S'),(142,142,142,1,'S','S'),(143,143,143,1,'S','S'),(144,144,144,1,'S','S'),(145,145,145,1,'S','S'),(146,146,146,1,'S','S'),(147,147,147,1,'S','S'),(148,148,148,1,'S','S'),(149,149,149,1,'S','S'),(150,150,150,1,'S','S'),(151,151,151,1,'S','S'),(152,152,152,1,'S','S'),(153,153,153,1,'S','S'),(154,154,154,1,'S','S'),(155,155,155,1,'S','S'),(156,156,156,1,'S','S'),(157,157,157,1,'S','S'),(158,158,158,1,'S','S'),(159,159,159,1,'S','S'),(160,160,160,1,'S','S'),(161,161,161,1,'S','S'),(162,162,162,1,'S','S'),(163,163,163,1,'S','S'),(164,164,164,1,'S','S'),(165,165,165,1,'S','S'),(166,166,166,1,'S','S'),(167,167,167,1,'S','S'),(168,168,168,1,'S','S'),(169,169,169,1,'S','S'),(170,170,170,1,'S','S'),(171,171,171,1,'S','S'),(172,172,172,1,'S','S'),(173,173,173,1,'S','S'),(174,174,174,1,'S','S'),(175,175,175,1,'S','S'),(176,176,176,1,'S','S'),(177,177,177,1,'S','S'),(178,178,178,1,'S','S'),(179,179,179,1,'S','S'),(180,180,180,1,'S','S'),(181,181,181,1,'S','S'),(182,182,182,1,'S','S'),(183,183,183,1,'S','S'),(184,184,184,1,'S','S'),(185,185,185,1,'S','S'),(186,186,186,1,'S','S'),(187,187,187,1,'S','S'),(188,188,188,1,'S','S'),(189,189,189,1,'S','S'),(190,190,190,1,'S','S'),(191,191,191,1,'S','S'),(192,192,192,1,'S','S'),(193,193,193,1,'S','S'),(194,194,194,1,'S','S'),(195,195,195,1,'S','S'),(196,196,196,1,'S','S'),(197,197,197,1,'S','S'),(198,198,198,1,'S','S'),(199,199,199,1,'S','S'),(200,200,200,6,'S','S'),(201,201,201,6,'S','S'),(202,202,202,6,'S','S'),(203,203,203,6,'S','S'),(204,204,204,6,'S','S'),(205,205,205,6,'S','S'),(206,206,206,6,'S','S'),(207,207,207,6,'S','S'),(208,208,208,6,'S','S'),(209,209,209,6,'S','S'),(210,210,210,6,'S','S'),(211,211,211,6,'S','S'),(212,212,212,6,'S','S'),(213,213,213,6,'S','S'),(214,214,214,6,'S','S'),(215,215,215,6,'S','S'),(216,216,216,6,'S','S'),(217,217,217,6,'S','S'),(218,218,218,6,'S','S'),(219,219,219,6,'S','S'),(220,220,220,6,'S','S'),(221,221,221,6,'S','S'),(222,222,222,6,'S','S'),(223,223,223,6,'S','S'),(224,224,224,6,'S','S'),(225,225,225,6,'S','S'),(226,226,226,6,'S','S'),(227,227,227,6,'S','S'),(228,228,228,6,'S','S'),(229,229,229,6,'S','S'),(230,230,230,6,'S','S'),(231,231,231,6,'S','S'),(232,232,232,6,'S','S'),(233,233,233,6,'S','S'),(234,234,234,6,'S','S'),(235,235,235,6,'S','S'),(236,236,236,6,'S','S'),(237,237,237,6,'S','S'),(238,238,238,6,'S','S'),(239,239,239,6,'S','S'),(240,240,240,6,'S','S'),(241,241,241,6,'S','S'),(242,242,242,6,'S','S'),(243,243,243,6,'S','S'),(244,244,244,6,'S','S'),(245,245,245,6,'S','S'),(246,246,246,6,'S','S'),(247,247,247,6,'S','S'),(248,248,248,6,'S','S'),(249,249,249,6,'S','S'),(250,250,250,6,'S','S'),(251,251,251,6,'S','S'),(252,252,252,6,'S','S'),(253,253,253,6,'S','S'),(254,254,254,6,'S','S'),(255,255,255,6,'S','S'),(256,256,256,6,'S','S'),(257,257,257,6,'S','S'),(258,258,258,6,'S','S'),(259,259,259,6,'S','S'),(260,260,260,6,'S','S'),(261,261,261,6,'S','S'),(262,262,262,6,'S','S'),(263,263,263,6,'S','S'),(264,264,264,6,'S','S'),(265,265,265,6,'S','S'),(266,266,266,6,'S','S'),(267,267,267,6,'S','S'),(268,268,268,6,'S','S'),(269,269,269,6,'S','S'),(270,270,270,6,'S','S'),(271,271,271,6,'S','S'),(272,272,272,6,'S','S'),(273,273,273,6,'S','S'),(274,274,274,6,'S','S'),(275,275,275,6,'S','S'),(276,276,276,6,'S','S'),(277,277,277,6,'S','S'),(278,278,278,6,'S','S'),(279,279,279,6,'S','S'),(280,280,280,6,'S','S'),(281,281,281,6,'S','S'),(282,282,282,6,'S','S'),(283,283,283,6,'S','S'),(284,284,284,6,'S','S'),(285,285,285,6,'S','S'),(286,286,286,6,'S','S'),(287,287,287,6,'S','S'),(288,288,288,6,'S','S'),(289,289,289,6,'S','S'),(290,290,290,6,'S','S'),(291,291,291,6,'S','S'),(292,292,292,6,'S','S'),(293,293,293,6,'S','S'),(294,294,294,6,'S','S'),(295,295,295,6,'S','S'),(296,296,296,6,'S','S'),(297,297,297,6,'S','S'),(298,298,298,6,'S','S'),(299,299,299,6,'S','S'),(300,300,300,6,'S','S'),(301,301,301,6,'S','S'),(302,302,302,6,'S','S'),(303,303,303,6,'S','S'),(304,304,304,6,'S','S'),(305,305,305,6,'S','S'),(306,306,306,6,'S','S'),(307,307,307,6,'S','S'),(308,308,308,6,'S','S'),(309,309,309,6,'S','S'),(310,310,310,6,'S','S'),(311,311,311,6,'S','S'),(312,312,312,6,'S','S'),(313,313,313,6,'S','S'),(314,314,314,6,'S','S'),(315,315,315,6,'S','S'),(316,316,316,6,'S','S'),(317,317,317,6,'S','S'),(318,318,318,6,'S','S'),(319,319,319,6,'S','S'),(320,320,320,6,'S','S'),(321,321,321,6,'S','S'),(322,322,322,6,'S','S'),(323,323,323,6,'S','S'),(324,324,324,6,'S','S'),(325,325,325,6,'S','S'),(326,326,326,6,'S','S'),(327,327,327,6,'S','S'),(328,328,328,6,'S','S'),(329,329,329,6,'S','S'),(330,330,330,6,'S','S'),(331,331,331,6,'S','S'),(332,332,332,6,'S','S'),(333,333,333,6,'S','S'),(334,334,334,6,'S','S'),(335,335,335,6,'S','S'),(336,336,336,6,'S','S'),(337,337,337,6,'S','S'),(338,338,338,6,'S','S'),(339,339,339,6,'S','S'),(340,340,340,6,'S','S'),(341,341,341,6,'S','S'),(342,342,342,6,'S','S'),(343,343,343,6,'S','S'),(344,344,344,6,'S','S'),(345,345,345,6,'S','S'),(346,346,346,6,'S','S'),(347,347,347,6,'S','S'),(348,348,348,6,'S','S'),(349,349,349,6,'S','S'),(350,350,350,6,'S','S'),(351,351,351,6,'S','S'),(352,352,352,6,'S','S'),(353,353,353,6,'S','S'),(354,354,354,6,'S','S'),(355,355,355,6,'S','S'),(356,356,356,6,'S','S'),(357,357,357,6,'S','S'),(358,358,358,6,'S','S'),(359,359,359,6,'S','S'),(360,360,360,6,'S','S'),(361,361,361,6,'S','S'),(362,362,362,6,'S','S'),(363,363,363,6,'S','S'),(364,364,364,6,'S','S'),(365,365,365,6,'S','S'),(366,366,366,6,'S','S'),(367,367,367,6,'S','S'),(368,368,368,6,'S','S'),(369,369,369,6,'S','S'),(370,370,370,6,'S','S'),(371,371,371,6,'S','S'),(372,372,372,6,'S','S'),(373,373,373,6,'S','S'),(374,374,374,6,'S','S'),(375,375,375,6,'S','S'),(376,376,376,6,'S','S'),(377,377,377,6,'S','S'),(378,378,378,6,'S','S'),(379,379,379,6,'S','S'),(380,380,380,6,'S','S'),(381,381,381,6,'S','S'),(382,382,382,6,'S','S'),(383,383,383,6,'S','S'),(384,384,384,6,'S','S'),(385,385,385,6,'S','S'),(386,386,386,6,'S','S'),(387,387,387,6,'S','S'),(388,388,388,6,'S','S'),(389,389,389,6,'S','S'),(390,390,390,6,'S','S'),(391,391,391,6,'S','S'),(392,392,392,6,'S','S'),(393,393,393,6,'S','S'),(394,394,394,6,'S','S'),(395,395,395,6,'S','S'),(396,396,396,6,'S','S'),(397,397,397,6,'S','S'),(398,398,398,6,'S','S'),(399,399,399,6,'S','S'),(400,400,400,6,'S','S'),(401,401,401,6,'S','S'),(402,402,402,6,'S','S'),(403,403,403,6,'S','S'),(404,404,404,6,'S','S'),(405,405,405,6,'S','S'),(406,406,406,6,'S','S'),(407,407,407,6,'S','S'),(408,408,408,6,'S','S'),(409,409,409,6,'S','S'),(410,410,410,6,'S','S'),(411,411,411,11,'S','S'),(412,412,412,11,'S','S'),(413,413,413,11,'S','S'),(414,414,414,11,'S','S'),(415,415,415,11,'S','S'),(416,416,416,11,'S','S'),(417,417,417,11,'S','S'),(418,418,418,11,'S','S'),(419,419,419,11,'S','S'),(420,420,420,11,'S','S'),(421,421,421,11,'S','S'),(422,422,422,11,'S','S'),(423,423,423,11,'S','S'),(424,424,424,11,'S','S'),(425,425,425,11,'S','S'),(426,426,426,11,'S','S'),(427,427,427,11,'S','S'),(428,428,428,11,'S','S'),(429,429,429,11,'S','S'),(430,430,430,11,'S','S'),(431,431,431,11,'S','S'),(432,432,432,11,'S','S'),(433,433,433,11,'S','S'),(434,434,434,11,'S','S'),(435,435,435,11,'S','S'),(436,436,436,11,'S','S'),(437,437,437,11,'S','S'),(438,438,438,11,'S','S'),(439,439,439,11,'S','S'),(440,440,440,11,'S','S'),(441,441,441,11,'S','S'),(442,442,442,11,'S','S'),(443,443,443,11,'S','S'),(444,444,444,11,'S','S'),(445,445,445,11,'S','S'),(446,446,446,11,'S','S'),(447,447,447,11,'S','S'),(448,448,448,11,'S','S'),(449,449,449,11,'S','S'),(450,450,450,11,'S','S'),(451,451,451,11,'S','S'),(452,452,452,11,'S','S'),(453,453,453,11,'S','S'),(454,454,454,11,'S','S'),(455,455,455,11,'S','S'),(456,456,456,11,'S','S'),(457,457,457,11,'S','S'),(458,458,458,11,'S','S'),(459,459,459,11,'S','S'),(460,460,460,11,'S','S'),(461,461,461,11,'S','S'),(462,462,462,11,'S','S'),(463,463,463,11,'S','S'),(464,464,464,11,'S','S'),(465,465,465,11,'S','S'),(466,466,466,11,'S','S'),(467,467,467,11,'S','S'),(468,468,468,11,'S','S'),(469,469,469,11,'S','S'),(470,470,470,11,'S','S'),(471,471,471,11,'S','S'),(472,472,472,11,'S','S'),(473,473,473,11,'S','S'),(474,474,474,11,'S','S'),(475,475,475,11,'S','S'),(476,476,476,11,'S','S'),(477,477,477,11,'S','S'),(478,478,478,11,'S','S'),(479,479,479,11,'S','S'),(480,480,480,11,'S','S'),(481,481,481,11,'S','S'),(482,482,482,11,'S','S'),(483,483,483,11,'S','S'),(484,484,484,11,'S','S'),(485,485,485,11,'S','S'),(486,486,486,11,'S','S'),(487,487,487,11,'S','S'),(488,488,488,11,'S','S'),(489,489,489,11,'S','S'),(490,490,490,11,'S','S'),(491,491,491,11,'S','S'),(492,492,492,11,'S','S'),(493,493,493,11,'S','S'),(494,494,494,11,'S','S'),(495,495,495,11,'S','S'),(496,496,496,11,'S','S'),(497,497,497,11,'S','S'),(498,498,498,11,'S','S'),(499,499,499,11,'S','S'),(500,500,500,11,'S','S'),(501,501,501,11,'S','S'),(502,502,502,11,'S','S'),(503,503,503,11,'S','S'),(504,504,504,11,'S','S'),(505,505,505,11,'S','S'),(506,506,506,11,'S','S'),(507,507,507,11,'S','S'),(508,508,508,11,'S','S'),(509,509,509,11,'S','S'),(510,510,510,11,'S','S'),(511,511,511,11,'S','S'),(512,512,512,11,'S','S'),(513,513,513,11,'S','S'),(514,514,514,11,'S','S'),(515,515,515,11,'S','S'),(516,516,516,11,'S','S'),(517,517,517,11,'S','S'),(518,518,518,11,'S','S'),(519,519,519,11,'S','S'),(520,520,520,11,'S','S'),(521,521,521,11,'S','S'),(522,522,522,11,'S','S'),(523,523,523,11,'S','S'),(524,524,524,11,'S','S'),(525,525,525,11,'S','S'),(526,526,526,11,'S','S'),(527,527,527,11,'S','S'),(528,528,528,11,'S','S'),(529,529,529,11,'S','S'),(530,530,530,11,'S','S'),(531,531,531,11,'S','S'),(532,532,532,11,'S','S'),(533,533,533,11,'S','S'),(534,534,534,11,'S','S'),(535,535,535,11,'S','S'),(536,536,536,11,'S','S'),(537,537,537,11,'S','S'),(538,538,538,11,'S','S'),(539,539,539,11,'S','S'),(540,540,540,11,'S','S'),(541,541,541,11,'S','S'),(542,542,542,11,'S','S'),(543,543,543,11,'S','S'),(544,544,544,11,'S','S'),(545,545,545,11,'S','S'),(546,546,546,11,'S','S'),(547,547,547,11,'S','S'),(548,548,548,11,'S','S'),(549,549,549,11,'S','S'),(550,550,550,11,'S','S'),(551,551,551,11,'S','S'),(552,552,552,11,'S','S'),(553,553,553,11,'S','S'),(554,554,554,11,'S','S'),(555,555,555,11,'S','S'),(556,556,556,11,'S','S'),(557,557,557,11,'S','S'),(558,558,558,11,'S','S'),(559,559,559,11,'S','S'),(560,560,560,11,'S','S'),(561,561,561,11,'S','S'),(562,562,562,11,'S','S'),(563,563,563,11,'S','S'),(564,564,564,11,'S','S'),(565,565,565,11,'S','S'),(566,566,566,11,'S','S'),(567,567,567,11,'S','S'),(568,568,568,11,'S','S'),(569,569,569,11,'S','S'),(570,570,570,11,'S','S'),(571,571,571,11,'S','S'),(572,572,572,11,'S','S'),(573,573,573,11,'S','S'),(574,574,574,11,'S','S'),(575,575,575,11,'S','S'),(576,576,576,11,'S','S'),(577,577,577,11,'S','S'),(578,578,578,11,'S','S'),(579,579,579,11,'S','S'),(580,580,580,11,'S','S'),(581,581,581,11,'S','S'),(582,582,582,11,'S','S'),(583,583,583,11,'S','S'),(584,584,584,11,'S','S'),(585,585,585,11,'S','S'),(586,586,586,11,'S','S'),(587,587,587,11,'S','S'),(588,588,588,11,'S','S'),(589,589,589,11,'S','S'),(590,590,590,11,'S','S'),(591,591,591,11,'S','S'),(592,592,592,11,'S','S'),(593,593,593,11,'S','S'),(594,594,594,11,'S','S'),(595,595,595,11,'S','S'),(596,596,596,11,'S','S'),(597,597,597,11,'S','S'),(598,598,598,11,'S','S'),(599,599,599,11,'S','S'),(600,600,600,11,'S','S'),(601,601,601,11,'S','S'),(602,602,602,11,'S','S'),(603,603,603,11,'S','S'),(604,604,604,11,'S','S'),(605,605,605,11,'S','S'),(606,606,606,11,'S','S'),(607,607,607,11,'S','S'),(608,608,608,11,'S','S'),(609,609,609,11,'S','S'),(610,610,610,11,'S','S'),(611,611,611,11,'S','S'),(612,612,612,11,'S','S'),(613,613,613,11,'S','S'),(614,614,614,11,'S','S'),(615,615,615,11,'S','S'),(616,616,616,11,'S','S'),(617,617,617,11,'S','S'),(618,618,618,16,'S','S'),(619,619,619,16,'S','S'),(620,620,620,16,'S','S'),(621,621,621,16,'S','S'),(622,622,622,16,'S','S'),(623,623,623,16,'S','S'),(624,624,624,16,'S','S'),(625,625,625,16,'S','S'),(626,626,626,16,'S','S'),(627,627,627,16,'S','S'),(628,628,628,16,'S','S'),(629,629,629,16,'S','S'),(630,630,630,16,'S','S'),(631,631,631,16,'S','S'),(632,632,632,16,'S','S'),(633,633,633,16,'S','S'),(634,634,634,16,'S','S'),(635,635,635,16,'S','S'),(636,636,636,16,'S','S'),(637,637,637,16,'S','S'),(638,638,638,16,'S','S'),(639,639,639,16,'S','S'),(640,640,640,16,'S','S'),(641,641,641,16,'S','S'),(642,642,642,16,'S','S'),(643,643,643,16,'S','S'),(644,644,644,16,'S','S'),(645,645,645,16,'S','S'),(646,646,646,16,'S','S'),(647,647,647,16,'S','S'),(648,648,648,16,'S','S'),(649,649,649,16,'S','S'),(650,650,650,16,'S','S'),(651,651,651,16,'S','S'),(652,652,652,16,'S','S'),(653,653,653,16,'S','S'),(654,654,654,16,'S','S'),(655,655,655,16,'S','S'),(656,656,656,16,'S','S'),(657,657,657,16,'S','S'),(658,658,658,16,'S','S'),(659,659,659,16,'S','S'),(660,660,660,16,'S','S'),(661,661,661,16,'S','S'),(662,662,662,16,'S','S'),(663,663,663,16,'S','S'),(664,664,664,16,'S','S'),(665,665,665,16,'S','S'),(666,666,666,16,'S','S'),(667,667,667,16,'S','S'),(668,668,668,16,'S','S'),(669,669,669,16,'S','S'),(670,670,670,16,'S','S'),(671,671,671,16,'S','S'),(672,672,672,16,'S','S'),(673,673,673,16,'S','S'),(674,674,674,16,'S','S'),(675,675,675,16,'S','S'),(676,676,676,16,'S','S'),(677,677,677,16,'S','S'),(678,678,678,16,'S','S'),(679,679,679,16,'S','S'),(680,680,680,16,'S','S'),(681,681,681,16,'S','S'),(682,682,682,16,'S','S'),(683,683,683,16,'S','S'),(684,684,684,16,'S','S'),(685,685,685,16,'S','S'),(686,686,686,16,'S','S'),(687,687,687,16,'S','S'),(688,688,688,16,'S','S'),(689,689,689,16,'S','S'),(690,690,690,16,'S','S'),(691,691,691,16,'S','S'),(692,692,692,16,'S','S'),(693,693,693,16,'S','S'),(694,694,694,16,'S','S'),(695,695,695,16,'S','S'),(696,696,696,16,'S','S'),(697,697,697,16,'S','S'),(698,698,698,16,'S','S'),(699,699,699,16,'S','S'),(700,700,700,16,'S','S'),(701,701,701,16,'S','S'),(702,702,702,16,'S','S'),(703,703,703,16,'S','S'),(704,704,704,16,'S','S'),(705,705,705,16,'S','S'),(706,706,706,16,'S','S'),(707,707,707,16,'S','S'),(708,708,708,16,'S','S'),(709,709,709,16,'S','S'),(710,710,710,16,'S','S'),(711,711,711,16,'S','S'),(712,712,712,16,'S','S'),(713,713,713,16,'S','S'),(714,714,714,16,'S','S'),(715,715,715,16,'S','S'),(716,716,716,16,'S','S'),(717,717,717,16,'S','S'),(718,718,718,16,'S','S'),(719,719,719,16,'S','S'),(720,720,720,16,'S','S'),(721,721,721,16,'S','S'),(722,722,722,16,'S','S'),(723,723,723,16,'S','S'),(724,724,724,16,'S','S'),(725,725,725,16,'S','S'),(726,726,726,16,'S','S'),(727,727,727,16,'S','S'),(728,728,728,16,'S','S'),(729,729,729,16,'S','S'),(730,730,730,16,'S','S'),(731,731,731,16,'S','S'),(732,732,732,16,'S','S'),(733,733,733,16,'S','S'),(734,734,734,16,'S','S'),(735,735,735,16,'S','S'),(736,736,736,16,'S','S'),(737,737,737,16,'S','S'),(738,738,738,16,'S','S'),(739,739,739,16,'S','S'),(740,740,740,16,'S','S'),(741,741,741,16,'S','S'),(742,742,742,16,'S','S'),(743,743,743,16,'S','S'),(744,744,744,16,'S','S'),(745,745,745,16,'S','S'),(746,746,746,16,'S','S'),(747,747,747,16,'S','S'),(748,748,748,16,'S','S'),(749,749,749,16,'S','S'),(750,750,750,16,'S','S'),(751,751,751,16,'S','S'),(752,752,752,16,'S','S'),(753,753,753,16,'S','S'),(754,754,754,16,'S','S'),(755,755,755,16,'S','S'),(756,756,756,16,'S','S'),(757,757,757,16,'S','S'),(758,758,758,16,'S','S'),(759,759,759,16,'S','S'),(760,760,760,16,'S','S'),(761,761,761,16,'S','S'),(762,762,762,16,'S','S'),(763,763,763,16,'S','S'),(764,764,764,16,'S','S'),(765,765,765,16,'S','S'),(766,766,766,16,'S','S'),(767,767,767,16,'S','S'),(768,768,768,16,'S','S'),(769,769,769,16,'S','S'),(770,770,770,16,'S','S'),(771,771,771,16,'S','S'),(772,772,772,16,'S','S'),(773,773,773,16,'S','S'),(774,774,774,16,'S','S'),(775,775,775,16,'S','S'),(776,776,776,16,'S','S'),(777,777,777,16,'S','S'),(778,778,778,16,'S','S'),(779,779,779,16,'S','S'),(780,780,780,16,'S','S'),(781,781,781,16,'S','S'),(782,782,782,16,'S','S'),(783,783,783,16,'S','S'),(784,784,784,16,'S','S'),(785,785,785,16,'S','S'),(786,786,786,16,'S','S'),(787,787,787,16,'S','S'),(788,788,788,16,'S','S'),(789,789,789,16,'S','S'),(790,790,790,16,'S','S'),(791,791,791,16,'S','S'),(792,792,792,16,'S','S'),(793,793,793,16,'S','S'),(794,794,794,16,'S','S'),(795,795,795,16,'S','S'),(796,796,796,16,'S','S'),(797,797,797,16,'S','S'),(798,798,798,16,'S','S'),(799,799,799,16,'S','S'),(800,800,800,16,'S','S'),(801,801,801,16,'S','S'),(802,802,802,16,'S','S'),(803,803,803,16,'S','S'),(804,804,804,16,'S','S'),(805,805,805,16,'S','S'),(806,806,806,16,'S','S'),(807,807,807,16,'S','S'),(808,808,808,16,'S','S'),(809,809,809,16,'S','S'),(810,810,810,16,'S','S'),(811,811,811,16,'S','S'),(812,812,812,16,'S','S'),(813,813,813,16,'S','S'),(814,814,814,21,'S','S'),(815,815,815,21,'S','S'),(816,816,816,21,'S','S'),(817,817,817,21,'S','S'),(818,818,818,21,'S','S'),(819,819,819,21,'S','S'),(820,820,820,21,'S','S'),(821,821,821,21,'S','S'),(822,822,822,21,'S','S'),(823,823,823,21,'S','S'),(824,824,824,21,'S','S'),(825,825,825,21,'S','S'),(826,826,826,21,'S','S'),(827,827,827,21,'S','S'),(828,828,828,21,'S','S'),(829,829,829,21,'S','S'),(830,830,830,21,'S','S'),(831,831,831,21,'S','S'),(832,832,832,21,'S','S'),(833,833,833,21,'S','S'),(834,834,834,21,'S','S'),(835,835,835,21,'S','S'),(836,836,836,21,'S','S'),(837,837,837,21,'S','S'),(838,838,838,21,'S','S'),(839,839,839,21,'S','S'),(840,840,840,21,'S','S'),(841,841,841,21,'S','S'),(842,842,842,21,'S','S'),(843,843,843,21,'S','S'),(844,844,844,21,'S','S'),(845,845,845,21,'S','S'),(846,846,846,21,'S','S'),(847,847,847,21,'S','S'),(848,848,848,21,'S','S'),(849,849,849,21,'S','S'),(850,850,850,21,'S','S'),(851,851,851,21,'S','S'),(852,852,852,21,'S','S'),(853,853,853,21,'S','S'),(854,854,854,21,'S','S'),(855,855,855,21,'S','S'),(856,856,856,21,'S','S'),(857,857,857,21,'S','S'),(858,858,858,21,'S','S'),(859,859,859,21,'S','S'),(860,860,860,21,'S','S'),(861,861,861,21,'S','S'),(862,862,862,21,'S','S'),(863,863,863,21,'S','S'),(864,864,864,21,'S','S'),(865,865,865,21,'S','S'),(866,866,866,21,'S','S'),(867,867,867,21,'S','S'),(868,868,868,21,'S','S'),(869,869,869,21,'S','S'),(870,870,870,21,'S','S'),(871,871,871,21,'S','S'),(872,872,872,21,'S','S'),(873,873,873,21,'S','S'),(874,874,874,21,'S','S'),(875,875,875,21,'S','S'),(876,876,876,21,'S','S'),(877,877,877,21,'S','S'),(878,878,878,21,'S','S'),(879,879,879,21,'S','S'),(880,880,880,21,'S','S'),(881,881,881,21,'S','S'),(882,882,882,21,'S','S'),(883,883,883,21,'S','S'),(884,884,884,21,'S','S'),(885,885,885,21,'S','S'),(886,886,886,21,'S','S'),(887,887,887,21,'S','S'),(888,888,888,21,'S','S'),(889,889,889,21,'S','S'),(890,890,890,21,'S','S'),(891,891,891,21,'S','S'),(892,892,892,21,'S','S'),(893,893,893,21,'S','S'),(894,894,894,21,'S','S'),(895,895,895,21,'S','S'),(896,896,896,21,'S','S'),(897,897,897,21,'S','S'),(898,898,898,21,'S','S'),(899,899,899,21,'S','S'),(900,900,900,21,'S','S'),(901,901,901,21,'S','S'),(902,902,902,21,'S','S'),(903,903,903,21,'S','S'),(904,904,904,21,'S','S'),(905,905,905,21,'S','S'),(906,906,906,21,'S','S'),(907,907,907,21,'S','S'),(908,908,908,21,'S','S'),(909,909,909,21,'S','S'),(910,910,910,21,'S','S'),(911,911,911,21,'S','S'),(912,912,912,21,'S','S'),(913,913,913,21,'S','S'),(914,914,914,21,'S','S'),(915,915,915,21,'S','S'),(916,916,916,21,'S','S'),(917,917,917,21,'S','S'),(918,918,918,21,'S','S'),(919,919,919,21,'S','S'),(920,920,920,21,'S','S'),(921,921,921,21,'S','S'),(922,922,922,21,'S','S'),(923,923,923,21,'S','S'),(924,924,924,21,'S','S'),(925,925,925,21,'S','S'),(926,926,926,21,'S','S'),(927,927,927,21,'S','S'),(928,928,928,21,'S','S'),(929,929,929,21,'S','S'),(930,930,930,21,'S','S'),(931,931,931,21,'S','S'),(932,932,932,21,'S','S'),(933,933,933,21,'S','S'),(934,934,934,21,'S','S'),(935,935,935,21,'S','S'),(936,936,936,21,'S','S'),(937,937,937,21,'S','S'),(938,938,938,21,'S','S'),(939,939,939,21,'S','S'),(940,940,940,21,'S','S'),(941,941,941,21,'S','S'),(942,942,942,21,'S','S'),(943,943,943,21,'S','S'),(944,944,944,21,'S','S'),(945,945,945,21,'S','S'),(946,946,946,21,'S','S'),(947,947,947,21,'S','S'),(948,948,948,21,'S','S'),(949,949,949,21,'S','S'),(950,950,950,21,'S','S'),(951,951,951,21,'S','S'),(952,952,952,21,'S','S'),(953,953,953,21,'S','S'),(954,954,954,21,'S','S'),(955,955,955,21,'S','S'),(956,956,956,21,'S','S'),(957,957,957,21,'S','S'),(958,958,958,21,'S','S'),(959,959,959,21,'S','S'),(960,960,960,21,'S','S'),(961,961,961,21,'S','S'),(962,962,962,21,'S','S'),(963,963,963,21,'S','S'),(964,964,964,21,'S','S'),(965,965,965,21,'S','S'),(966,966,966,21,'S','S'),(967,967,967,21,'S','S'),(968,968,968,21,'S','S'),(969,969,969,21,'S','S'),(970,970,970,21,'S','S'),(971,971,971,21,'S','S'),(972,972,972,21,'S','S'),(973,973,973,21,'S','S'),(974,974,974,21,'S','S'),(975,975,975,21,'S','S'),(976,976,976,21,'S','S'),(977,977,977,21,'S','S'),(978,978,978,21,'S','S'),(979,979,979,21,'S','S'),(980,980,980,21,'S','S'),(981,981,981,21,'S','S'),(982,982,982,21,'S','S'),(983,983,983,21,'S','S'),(984,984,984,21,'S','S'),(985,985,985,21,'S','S'),(986,986,986,21,'S','S'),(987,987,987,21,'S','S'),(988,988,988,21,'S','S'),(989,989,989,21,'S','S'),(990,990,990,21,'S','S'),(991,991,991,21,'S','S'),(992,992,992,21,'S','S'),(993,993,993,21,'S','S'),(994,994,994,21,'S','S'),(995,995,995,21,'S','S'),(996,996,996,21,'S','S'),(997,997,997,21,'S','S'),(998,998,998,21,'S','S'),(999,999,999,21,'S','S'),(1000,1000,1000,21,'S','S'),(1001,1001,1001,21,'S','S'),(1002,1002,1002,21,'S','S'),(1003,1003,1003,21,'S','S'),(1004,1004,1004,21,'S','S'),(1005,1005,1005,21,'S','S'),(1006,1006,1006,21,'S','S'),(1007,1007,1007,21,'S','S'),(1008,1008,1008,21,'S','S'),(1009,1009,1009,21,'S','S'),(1010,1010,1010,21,'S','S'),(1011,1011,1011,21,'S','S'),(1012,1012,1012,21,'S','S'),(1013,1013,1013,21,'S','S'),(1014,1014,1014,21,'S','S'),(1015,1015,1015,21,'S','S'),(1016,1016,1016,21,'S','S'),(1017,1017,1017,21,'S','S'),(1018,1018,1018,21,'S','S'),(1019,1019,1019,21,'S','S'),(1020,1020,1020,21,'S','S'),(1021,1021,1021,21,'S','S'),(1022,1022,1022,21,'S','S'),(1023,1023,1023,21,'S','S'),(1024,1024,1024,21,'S','S'),(1025,1025,1025,26,'S','S'),(1026,1026,1026,26,'S','S'),(1027,1027,1027,26,'S','S'),(1028,1028,1028,26,'S','S'),(1029,1029,1029,26,'S','S'),(1030,1030,1030,26,'S','S'),(1031,1031,1031,26,'S','S'),(1032,1032,1032,26,'S','S'),(1033,1033,1033,26,'S','S'),(1034,1034,1034,26,'S','S'),(1035,1035,1035,26,'S','S'),(1036,1036,1036,26,'S','S'),(1037,1037,1037,26,'S','S'),(1038,1038,1038,26,'S','S'),(1039,1039,1039,26,'S','S'),(1040,1040,1040,26,'S','S'),(1041,1041,1041,26,'S','S'),(1042,1042,1042,26,'S','S'),(1043,1043,1043,26,'S','S'),(1044,1044,1044,26,'S','S'),(1045,1045,1045,26,'S','S'),(1046,1046,1046,26,'S','S'),(1047,1047,1047,26,'S','S'),(1048,1048,1048,26,'S','S'),(1049,1049,1049,26,'S','S'),(1050,1050,1050,26,'S','S'),(1051,1051,1051,26,'S','S'),(1052,1052,1052,26,'S','S'),(1053,1053,1053,26,'S','S'),(1054,1054,1054,26,'S','S'),(1055,1055,1055,26,'S','S'),(1056,1056,1056,26,'S','S'),(1057,1057,1057,26,'S','S'),(1058,1058,1058,26,'S','S'),(1059,1059,1059,26,'S','S'),(1060,1060,1060,26,'S','S'),(1061,1061,1061,26,'S','S'),(1062,1062,1062,26,'S','S'),(1063,1063,1063,26,'S','S'),(1064,1064,1064,26,'S','S'),(1065,1065,1065,26,'S','S'),(1066,1066,1066,26,'S','S'),(1067,1067,1067,26,'S','S'),(1068,1068,1068,26,'S','S'),(1069,1069,1069,26,'S','S'),(1070,1070,1070,26,'S','S'),(1071,1071,1071,26,'S','S'),(1072,1072,1072,26,'S','S'),(1073,1073,1073,26,'S','S'),(1074,1074,1074,26,'S','S'),(1075,1075,1075,26,'S','S'),(1076,1076,1076,26,'S','S'),(1077,1077,1077,26,'S','S'),(1078,1078,1078,26,'S','S'),(1079,1079,1079,26,'S','S'),(1080,1080,1080,26,'S','S'),(1081,1081,1081,26,'S','S'),(1082,1082,1082,26,'S','S'),(1083,1083,1083,26,'S','S'),(1084,1084,1084,26,'S','S'),(1085,1085,1085,26,'S','S'),(1086,1086,1086,26,'S','S'),(1087,1087,1087,26,'S','S'),(1088,1088,1088,26,'S','S'),(1089,1089,1089,26,'S','S'),(1090,1090,1090,26,'S','S'),(1091,1091,1091,26,'S','S'),(1092,1092,1092,26,'S','S'),(1093,1093,1093,26,'S','S'),(1094,1094,1094,26,'S','S'),(1095,1095,1095,26,'S','S'),(1096,1096,1096,26,'S','S'),(1097,1097,1097,26,'S','S'),(1098,1098,1098,26,'S','S'),(1099,1099,1099,26,'S','S'),(1100,1100,1100,26,'S','S'),(1101,1101,1101,26,'S','S'),(1102,1102,1102,26,'S','S'),(1103,1103,1103,26,'S','S'),(1104,1104,1104,26,'S','S'),(1105,1105,1105,26,'S','S'),(1106,1106,1106,26,'S','S'),(1107,1107,1107,26,'S','S'),(1108,1108,1108,26,'S','S'),(1109,1109,1109,26,'S','S'),(1110,1110,1110,26,'S','S'),(1111,1111,1111,26,'S','S'),(1112,1112,1112,26,'S','S'),(1113,1113,1113,26,'S','S'),(1114,1114,1114,26,'S','S'),(1115,1115,1115,26,'S','S'),(1116,1116,1116,26,'S','S'),(1117,1117,1117,26,'S','S'),(1118,1118,1118,26,'S','S'),(1119,1119,1119,26,'S','S'),(1120,1120,1120,26,'S','S'),(1121,1121,1121,26,'S','S'),(1122,1122,1122,26,'S','S'),(1123,1123,1123,26,'S','S'),(1124,1124,1124,26,'S','S'),(1125,1125,1125,26,'S','S'),(1126,1126,1126,26,'S','S'),(1127,1127,1127,26,'S','S'),(1128,1128,1128,26,'S','S'),(1129,1129,1129,26,'S','S'),(1130,1130,1130,26,'S','S'),(1131,1131,1131,26,'S','S'),(1132,1132,1132,26,'S','S'),(1133,1133,1133,26,'S','S'),(1134,1134,1134,26,'S','S'),(1135,1135,1135,26,'S','S'),(1136,1136,1136,26,'S','S'),(1137,1137,1137,26,'S','S'),(1138,1138,1138,26,'S','S'),(1139,1139,1139,26,'S','S'),(1140,1140,1140,26,'S','S'),(1141,1141,1141,26,'S','S'),(1142,1142,1142,26,'S','S'),(1143,1143,1143,26,'S','S'),(1144,1144,1144,26,'S','S'),(1145,1145,1145,26,'S','S'),(1146,1146,1146,26,'S','S'),(1147,1147,1147,26,'S','S'),(1148,1148,1148,26,'S','S'),(1149,1149,1149,26,'S','S'),(1150,1150,1150,26,'S','S'),(1151,1151,1151,26,'S','S'),(1152,1152,1152,26,'S','S'),(1153,1153,1153,26,'S','S'),(1154,1154,1154,26,'S','S'),(1155,1155,1155,26,'S','S'),(1156,1156,1156,26,'S','S'),(1157,1157,1157,26,'S','S'),(1158,1158,1158,26,'S','S'),(1159,1159,1159,26,'S','S'),(1160,1160,1160,26,'S','S'),(1161,1161,1161,26,'S','S'),(1162,1162,1162,26,'S','S'),(1163,1163,1163,26,'S','S'),(1164,1164,1164,26,'S','S'),(1165,1165,1165,26,'S','S'),(1166,1166,1166,26,'S','S'),(1167,1167,1167,26,'S','S'),(1168,1168,1168,26,'S','S'),(1169,1169,1169,26,'S','S'),(1170,1170,1170,26,'S','S'),(1171,1171,1171,26,'S','S'),(1172,1172,1172,26,'S','S'),(1173,1173,1173,26,'S','S'),(1174,1174,1174,26,'S','S'),(1175,1175,1175,26,'S','S'),(1176,1176,1176,26,'S','S'),(1177,1177,1177,26,'S','S'),(1178,1178,1178,26,'S','S'),(1179,1179,1179,26,'S','S'),(1180,1180,1180,26,'S','S'),(1181,1181,1181,26,'S','S'),(1182,1182,1182,26,'S','S'),(1183,1183,1183,26,'S','S'),(1184,1184,1184,26,'S','S'),(1185,1185,1185,26,'S','S'),(1186,1186,1186,26,'S','S'),(1187,1187,1187,26,'S','S'),(1188,1188,1188,26,'S','S'),(1189,1189,1189,26,'S','S'),(1190,1190,1190,26,'S','S'),(1191,1191,1191,26,'S','S'),(1192,1192,1192,26,'S','S'),(1193,1193,1193,26,'S','S'),(1194,1194,1194,26,'S','S'),(1195,1195,1195,26,'S','S'),(1196,1196,1196,26,'S','S'),(1197,1197,1197,26,'S','S'),(1198,1198,1198,26,'S','S'),(1199,1199,1199,26,'S','S'),(1200,1200,1200,26,'S','S'),(1201,1201,1201,26,'S','S'),(1202,1202,1202,26,'S','S'),(1203,1203,1203,26,'S','S'),(1204,1204,1204,26,'S','S');
UNLOCK TABLES;
/*!40000 ALTER TABLE `padres_alumno` ENABLE KEYS */;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `SERIAL_PAI` int(11) NOT NULL auto_increment,
  `CODIGO_PAI` char(6) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PAI` char(60) collate latin1_spanish_ci NOT NULL default '',
  `CONTINENTE_PAI` char(20) collate latin1_spanish_ci NOT NULL default '',
  `UBICACION_PAI` char(60) collate latin1_spanish_ci NOT NULL default '',
  `MONEDA_PAI` char(50) collate latin1_spanish_ci default NULL,
  `LENGUA_PAI` char(50) collate latin1_spanish_ci default NULL,
  `PREFIJOTELEFONICO_PAI` char(5) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_PAI`),
  KEY `AK_CODIGO_PAI_IDX` (`CODIGO_PAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pais`
--


/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
LOCK TABLES `pais` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;

--
-- Table structure for table `paralelo`
--

DROP TABLE IF EXISTS `paralelo`;
CREATE TABLE `paralelo` (
  `serial_par` int(11) NOT NULL auto_increment,
  `serial_per` int(11) NOT NULL default '0',
  `serial_niv` int(11) NOT NULL default '0',
  `nombre_par` char(2) collate latin1_spanish_ci NOT NULL default '',
  `dirigente_par` int(11) default NULL,
  PRIMARY KEY  (`serial_par`),
  KEY `FK_paralelo_nivel_FK` (`serial_niv`),
  KEY `FK_paralelo_periodo_FK` (`serial_per`),
  KEY `nombre_par_idx` (`nombre_par`),
  CONSTRAINT `paralelo_ibfk_1` FOREIGN KEY (`serial_niv`) REFERENCES `nivel` (`serial_niv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `paralelo`
--


/*!40000 ALTER TABLE `paralelo` DISABLE KEYS */;
LOCK TABLES `paralelo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `paralelo` ENABLE KEYS */;

--
-- Table structure for table `paralelo_alumno`
--

DROP TABLE IF EXISTS `paralelo_alumno`;
CREATE TABLE `paralelo_alumno` (
  `serial_paralu` int(11) NOT NULL auto_increment,
  `serial_alu` int(11) NOT NULL default '0',
  `serial_ban` int(11) default NULL,
  `serial_par` int(11) NOT NULL default '0',
  `activo_paralu` char(1) collate latin1_spanish_ci default NULL,
  `aproba_paralu` char(1) collate latin1_spanish_ci default NULL,
  `promedio_paralu` decimal(16,2) default NULL,
  `disc_paralu` decimal(16,2) default NULL,
  `numeromatricula_paralu` int(11) NOT NULL default '0',
  `fechamatricula_paralu` date NOT NULL default '0000-00-00',
  `observacion_paralu` varchar(255) collate latin1_spanish_ci default NULL,
  `serialppe_paralu` int(11) default NULL,
  `examenesGrado_paralu` decimal(16,2) default NULL,
  `nota1a5Curso_paralu` decimal(16,2) default NULL,
  `participacionEstudiantil_paralu` decimal(16,2) default NULL,
  `seccion_paralu` char(1) collate latin1_spanish_ci NOT NULL default '',
  `actaGrado_paralu` int(11) default NULL,
  `estadoAlumno_paralu` char(1) collate latin1_spanish_ci default NULL,
  `formaPago_paralu` varchar(30) collate latin1_spanish_ci default NULL,
  `tipoCuenta_paralu` varchar(30) collate latin1_spanish_ci default NULL,
  `numeroCuenta_paralu` varchar(30) collate latin1_spanish_ci default NULL,
  `quienRetira_paralu` varchar(50) collate latin1_spanish_ci default NULL,
  `cedulaQuien_paralu` varchar(15) collate latin1_spanish_ci default NULL,
  `serial_des` int(11) default NULL,
  `pago_paralu` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  `nomtarjeta_paralu` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  `numtarjeta_paralu` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`serial_paralu`),
  UNIQUE KEY `serialppe_paralu_idx` (`serialppe_paralu`),
  KEY `FK_paralelo_alumno_alumno_FK` (`serial_alu`),
  KEY `FK_paralelo_alumno_paralelo_FK` (`serial_par`),
  KEY `bancoParaleloAlumno_FK` (`serial_ban`),
  KEY `numeromatricula_paralu_idx` (`numeromatricula_paralu`),
  KEY `fechamatricula_paralu_idx` (`fechamatricula_paralu`),
  KEY `seccion_paralu_idx` (`seccion_paralu`),
  KEY `aproba_paralu_idx` (`aproba_paralu`),
  KEY `descuentoParAlu_FK` (`serial_des`),
  CONSTRAINT `paralelo_alumno_ibfk_1` FOREIGN KEY (`serial_ban`) REFERENCES `banco` (`serial_ban`),
  CONSTRAINT `paralelo_alumno_ibfk_2` FOREIGN KEY (`serial_alu`) REFERENCES `alumno` (`serial_alu`),
  CONSTRAINT `paralelo_alumno_ibfk_3` FOREIGN KEY (`serial_par`) REFERENCES `paralelo` (`serial_par`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `paralelo_alumno`
--


/*!40000 ALTER TABLE `paralelo_alumno` DISABLE KEYS */;
LOCK TABLES `paralelo_alumno` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `paralelo_alumno` ENABLE KEYS */;

--
-- Table structure for table `parentesco`
--

DROP TABLE IF EXISTS `parentesco`;
CREATE TABLE `parentesco` (
  `SERIAL_PRT` int(11) NOT NULL auto_increment,
  `CODIGO_PRT` char(15) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PRT` char(255) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PRT`),
  UNIQUE KEY `AK_CODIGO_PAR_IDX` (`CODIGO_PRT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `parentesco`
--


/*!40000 ALTER TABLE `parentesco` DISABLE KEYS */;
LOCK TABLES `parentesco` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `parentesco` ENABLE KEYS */;

--
-- Table structure for table `parentescoempleado`
--

DROP TABLE IF EXISTS `parentescoempleado`;
CREATE TABLE `parentescoempleado` (
  `SERIAL_PAREMP` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `SERIAL_PRT` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_PAREMP`),
  KEY `FK_EMPLEADOPARENTESCOEMPLEADO` (`SERIAL_EPL`),
  KEY `FK_PARENTESCOPARENTESCOEMPLEADO` (`SERIAL_PRT`),
  CONSTRAINT `FK_EMPLEADOPARENTESCOEMPLEADO` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PARENTESCOPARENTESCOEMPLEADO` FOREIGN KEY (`SERIAL_PRT`) REFERENCES `parentesco` (`SERIAL_PRT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `parentescoempleado`
--


/*!40000 ALTER TABLE `parentescoempleado` DISABLE KEYS */;
LOCK TABLES `parentescoempleado` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `parentescoempleado` ENABLE KEYS */;

--
-- Table structure for table `parroquia`
--

DROP TABLE IF EXISTS `parroquia`;
CREATE TABLE `parroquia` (
  `SERIAL_PAR` int(11) NOT NULL auto_increment,
  `SERIAL_CIU` int(11) default NULL,
  `NOMBRE_PAR` char(60) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PAR`),
  KEY `FK_CIUDADPARROQUIA` (`SERIAL_CIU`),
  CONSTRAINT `FK_CIUDADPARROQUIA` FOREIGN KEY (`SERIAL_CIU`) REFERENCES `ciudad` (`SERIAL_CIU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `parroquia`
--


/*!40000 ALTER TABLE `parroquia` DISABLE KEYS */;
LOCK TABLES `parroquia` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `parroquia` ENABLE KEYS */;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `SERIAL_PFL` int(11) NOT NULL auto_increment,
  `CODIGO_PFL` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PFL` char(40) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PFL` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_PFL`),
  KEY `AK_CODIGO_PFL_IDX` (`CODIGO_PFL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `perfil`
--


/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
LOCK TABLES `perfil` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;

--
-- Table structure for table `perfilcompetencias`
--

DROP TABLE IF EXISTS `perfilcompetencias`;
CREATE TABLE `perfilcompetencias` (
  `SERIAL_PEC` int(11) NOT NULL auto_increment,
  `CODIGO_PEC` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NIVELEDUCATIVO_PEC` char(50) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PEC` char(100) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PEC`),
  KEY `AK_CODIGO_PEC_IDX` (`CODIGO_PEC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `perfilcompetencias`
--


/*!40000 ALTER TABLE `perfilcompetencias` DISABLE KEYS */;
LOCK TABLES `perfilcompetencias` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `perfilcompetencias` ENABLE KEYS */;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE `periodo` (
  `serial_per` int(11) NOT NULL auto_increment,
  `codigo_per` char(15) default NULL,
  `fecini_per` date default NULL,
  `fecfin_per` date default NULL,
  `activo_per` char(1) NOT NULL default '',
  `nombre_per` char(30) NOT NULL default '',
  `inicio_per` char(1) NOT NULL default '',
  `fechaActa_per` date default NULL,
  PRIMARY KEY  (`serial_per`),
  KEY `codigo_per_idx` (`codigo_per`),
  KEY `fecini_per_idx` (`fecini_per`),
  KEY `fecfin_per_idx` (`fecfin_per`),
  KEY `activo_per_idx` (`activo_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periodo`
--


/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
LOCK TABLES `periodo` WRITE;
INSERT INTO `periodo` VALUES (1,'2008-2009','2008-09-01','2009-07-31','S','AÑO LECTIVO 2008-2009','N','2009-07-31');
UNLOCK TABLES;
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;

--
-- Table structure for table `periodocontable`
--

DROP TABLE IF EXISTS `periodocontable`;
CREATE TABLE `periodocontable` (
  `SERIAL_PCO` int(11) NOT NULL auto_increment,
  `INICIO_PCO` date NOT NULL default '0000-00-00',
  `FIN_PCO` date NOT NULL default '0000-00-00',
  `ESTADO_PCO` char(15) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PCO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `periodocontable`
--


/*!40000 ALTER TABLE `periodocontable` DISABLE KEYS */;
LOCK TABLES `periodocontable` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `periodocontable` ENABLE KEYS */;

--
-- Table structure for table `periodorol`
--

DROP TABLE IF EXISTS `periodorol`;
CREATE TABLE `periodorol` (
  `SERIAL_PERROL` int(11) NOT NULL auto_increment,
  `FECHAINICIO_PERROL` date NOT NULL default '0000-00-00',
  `FECHAFIN_PERROL` date NOT NULL default '0000-00-00',
  `DESCRIPCION_PERROL` char(255) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_PERROL` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CERRADO_PERROL` char(2) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PERROL`),
  KEY `AK_FECHAINICIO_PERROL_IDX` (`FECHAINICIO_PERROL`),
  KEY `AK_FECHAFIN_PERROL_IDX` (`FECHAFIN_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `periodorol`
--


/*!40000 ALTER TABLE `periodorol` DISABLE KEYS */;
LOCK TABLES `periodorol` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `periodorol` ENABLE KEYS */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `SERIAL_PER` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `MOTIVO_PER` char(50) collate latin1_spanish_ci NOT NULL default '',
  `DURACION_PER` int(11) default NULL,
  `HORASINICIO_PER` char(12) collate latin1_spanish_ci default NULL,
  `HORASFIN_PER` char(12) collate latin1_spanish_ci default NULL,
  `PAGOSUELDO_PER` char(1) collate latin1_spanish_ci NOT NULL default '',
  `FECHAINICIO_PER` date NOT NULL default '0000-00-00',
  `FECHAFIN_PER` date NOT NULL default '0000-00-00',
  `OBSERVACION_PER` char(255) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_PER` char(1) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PER`),
  KEY `AK_FECHAINICIO_PER_IDX` (`FECHAINICIO_PER`),
  KEY `AK_FECHAFIN_PER_IDX` (`FECHAFIN_PER`),
  KEY `FK_EMPLEADOPERMISOS` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOPERMISOS` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `permisos`
--


/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
LOCK TABLES `permisos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;

--
-- Table structure for table `plancontable`
--

DROP TABLE IF EXISTS `plancontable`;
CREATE TABLE `plancontable` (
  `SERIAL_PLC` int(11) NOT NULL auto_increment,
  `SERIAL_PLP` int(11) default '0',
  `NOMBRE_PLC` varchar(100) collate latin1_spanish_ci NOT NULL default '',
  `CODIGO_PLC` varchar(18) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_PLC` varchar(15) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PLC` varchar(255) collate latin1_spanish_ci default NULL,
  `ESTADO_PLC` varchar(12) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PLC`),
  UNIQUE KEY `AK_CODIGO_PLC` (`CODIGO_PLC`),
  KEY `FK_PLANPRESUPUESTOPLANCONTABLE` (`SERIAL_PLP`),
  CONSTRAINT `FK_PLANPRESUPUESTOPLANCONTABLE` FOREIGN KEY (`SERIAL_PLP`) REFERENCES `planpresupuesto` (`SERIAL_PLP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `plancontable`
--


/*!40000 ALTER TABLE `plancontable` DISABLE KEYS */;
LOCK TABLES `plancontable` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `plancontable` ENABLE KEYS */;

--
-- Table structure for table `planpresupuesto`
--

DROP TABLE IF EXISTS `planpresupuesto`;
CREATE TABLE `planpresupuesto` (
  `SERIAL_PLP` int(11) NOT NULL auto_increment,
  `NOMBRE_PLP` varchar(100) collate latin1_spanish_ci default NULL,
  `CODIGO_PLP` varchar(50) collate latin1_spanish_ci default NULL,
  `TIPO_PLP` varchar(15) collate latin1_spanish_ci default NULL,
  `DESCRIPCION_PLP` varchar(255) collate latin1_spanish_ci default NULL,
  `ESTADO_PLP` varchar(12) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_PLP`),
  UNIQUE KEY `AK_CODIGO_PLP` (`CODIGO_PLP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `planpresupuesto`
--


/*!40000 ALTER TABLE `planpresupuesto` DISABLE KEYS */;
LOCK TABLES `planpresupuesto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `planpresupuesto` ENABLE KEYS */;

--
-- Table structure for table `planretencion`
--

DROP TABLE IF EXISTS `planretencion`;
CREATE TABLE `planretencion` (
  `SERIAL_PLR` int(11) NOT NULL auto_increment,
  `SERIAL_PLC` int(11) default NULL,
  `NOMBRE_PLR` varchar(150) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PLR` varchar(100) collate latin1_spanish_ci NOT NULL default '',
  `PORCENTAJE_PLR` double NOT NULL default '0',
  `CODIGOSRI_PLR` varchar(20) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_PLR` varchar(20) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PLR`),
  KEY `AK_CODIGO_PLR` (`NOMBRE_PLR`),
  KEY `FK_PLANCONTABLEPLANRETENCION` (`SERIAL_PLC`),
  CONSTRAINT `FK_PLANCONTABLEPLANRETENCION` FOREIGN KEY (`SERIAL_PLC`) REFERENCES `plancontable` (`SERIAL_PLC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `planretencion`
--


/*!40000 ALTER TABLE `planretencion` DISABLE KEYS */;
LOCK TABLES `planretencion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `planretencion` ENABLE KEYS */;

--
-- Table structure for table `prestamosempleado`
--

DROP TABLE IF EXISTS `prestamosempleado`;
CREATE TABLE `prestamosempleado` (
  `SERIAL_ANT` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `NOMBRE_ANT` char(255) collate latin1_spanish_ci NOT NULL default '',
  `VALOR_ANT` double NOT NULL default '0',
  `FECHA_ANT` date NOT NULL default '0000-00-00',
  `ESTADO_ANT` char(20) collate latin1_spanish_ci NOT NULL default '',
  `OBSERVACION_ANT` char(255) collate latin1_spanish_ci default NULL,
  `NUMEROPAGOS_ANT` char(1) collate latin1_spanish_ci NOT NULL default '',
  `FECHAINICIO_PEM` date default NULL,
  `MOTIVO_PEM` char(255) collate latin1_spanish_ci default NULL,
  `CODIGO_PEM` char(20) collate latin1_spanish_ci default NULL,
  `PAGOSCANCELADOS_PEM` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ANT`),
  KEY `AK_FECHA_ANT_IDX` (`FECHA_ANT`),
  KEY `FK_EMPLEADOPRESTAMOSEMPLEADOS` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLPRESTAMOSEMPLEADOS` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADOPRESTAMOSEMPLEADOS` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLPRESTAMOSEMPLEADOS` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `prestamosempleado`
--


/*!40000 ALTER TABLE `prestamosempleado` DISABLE KEYS */;
LOCK TABLES `prestamosempleado` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `prestamosempleado` ENABLE KEYS */;

--
-- Table structure for table `procesos`
--

DROP TABLE IF EXISTS `procesos`;
CREATE TABLE `procesos` (
  `SERIAL_PRC` int(11) NOT NULL auto_increment,
  `SERIAL_MOD` int(11) default NULL,
  `CODIGO_PRC` char(15) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PRC` char(150) collate latin1_spanish_ci NOT NULL default '',
  `URL_PRC` char(255) collate latin1_spanish_ci NOT NULL default '',
  `AUTORIZACION_PRC` char(2) collate latin1_spanish_ci NOT NULL default '',
  `ICONO_PRC` char(100) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_PRC`),
  KEY `AK_CODIGO_PRC_IDX` (`CODIGO_PRC`),
  KEY `FK_MODULOSPROCESOS` (`SERIAL_MOD`),
  CONSTRAINT `FK_MODULOSPROCESOS` FOREIGN KEY (`SERIAL_MOD`) REFERENCES `modulos` (`SERIAL_MOD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `procesos`
--


/*!40000 ALTER TABLE `procesos` DISABLE KEYS */;
LOCK TABLES `procesos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `procesos` ENABLE KEYS */;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `SERIAL_PRD` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `SERIAL_TPO` int(11) default NULL,
  `SERIAL_LOP` int(11) default NULL,
  `CODIGO_PRD` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PRD` char(80) collate latin1_spanish_ci NOT NULL default '',
  `COMBO_PRD` char(2) collate latin1_spanish_ci default NULL,
  `UBICACION_PRD` char(60) collate latin1_spanish_ci default NULL,
  `BARRASUNITARIOEAN13_PRD` char(13) collate latin1_spanish_ci default NULL,
  `BARRASCAJASEAN14_PRD` char(14) collate latin1_spanish_ci default NULL,
  `BIENSERVICIO_PRD` char(8) collate latin1_spanish_ci NOT NULL default '',
  `MARCA_PRD` char(60) collate latin1_spanish_ci default NULL,
  `UNIDADMEDIDA_PRD` char(20) collate latin1_spanish_ci default NULL,
  `DIMENSIONES_PRD` char(40) collate latin1_spanish_ci default NULL,
  `PESO_PRD` decimal(10,4) default NULL,
  `STOCKMINIMO_PRD` int(11) NOT NULL default '0',
  `STOCKMAXIMO_PRD` int(11) NOT NULL default '0',
  `DESCUENTO_PRD` decimal(5,2) default NULL,
  `ICE_PRD` char(10) collate latin1_spanish_ci default NULL,
  `FIJOICE_PRD` decimal(16,6) default NULL,
  `FOTO_PRD` char(60) collate latin1_spanish_ci default NULL,
  `METODOCOSTEO_PRD` char(10) collate latin1_spanish_ci default NULL,
  `ESTADO_PRD` char(10) collate latin1_spanish_ci NOT NULL default '',
  `UNIDADESEMBALAJE_PRD` int(11) default NULL,
  `FECHACOSTEO_PRD` date default NULL,
  `COSTOUNITARIO_PRD` decimal(16,2) default NULL,
  `COSTOPROMEDIO_PRD` decimal(16,2) default NULL,
  `COSTOLOTE_PRD` decimal(16,2) default NULL,
  `CODIGOALTERNO_PRD` char(15) collate latin1_spanish_ci default NULL,
  `PRECIO1_PRD` decimal(16,2) default NULL,
  `PRECIO2_PRD` decimal(16,2) default NULL,
  `PRECIO3_PRD` decimal(16,2) default NULL,
  `PRECIO4_PRD` decimal(16,2) default NULL,
  `PRECIO5_PRD` decimal(16,2) default NULL,
  `FACTURABLE_PRD` char(2) collate latin1_spanish_ci default NULL,
  `GRABAIVA_PRD` char(2) collate latin1_spanish_ci default NULL,
  `GRABAICE_PRD` char(2) collate latin1_spanish_ci default NULL,
  `RENTABILIDAD_PRD` decimal(10,4) default NULL,
  `UNIDADMEDIDAEMBALAJE_PRD` char(30) collate latin1_spanish_ci default NULL,
  `RENTABILIDADMIN_PRD` decimal(10,4) default NULL,
  `STOCKACTUAL_PRD` int(11) default NULL,
  `BARRASUNITARIOCAJAEAN13_PRD` char(13) collate latin1_spanish_ci default NULL,
  `COSTOCOMPRA_PRD` decimal(10,2) default NULL,
  `COSTOALMACENAMIENTO_PRD` decimal(10,2) default NULL,
  `COSTOORDENAR_PRD` decimal(10,2) default NULL,
  `LOTEACTUAL_PRD` int(11) default NULL,
  `FECHAEXPIRACION_PRD` date default NULL,
  PRIMARY KEY  (`SERIAL_PRD`),
  KEY `AK_CODIGO_PRD_IDX` (`CODIGO_PRD`),
  KEY `AK_NOMBRE_PRD_IDX` (`NOMBRE_PRD`),
  KEY `FK_PROVEEDORPRODUCTO` (`SERIAL_PVD`),
  KEY `FK_TIPOPRODUCTOPRODUCTO` (`SERIAL_TPO`),
  CONSTRAINT `FK_PROVEEDORPRODUCTO` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`),
  CONSTRAINT `FK_TIPOPRODUCTOPRODUCTO` FOREIGN KEY (`SERIAL_TPO`) REFERENCES `tipoproducto` (`SERIAL_TPO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `producto`
--


/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
LOCK TABLES `producto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

--
-- Table structure for table `productobodega`
--

DROP TABLE IF EXISTS `productobodega`;
CREATE TABLE `productobodega` (
  `SERIAL_PBO` int(11) NOT NULL auto_increment,
  `CANTIDAD_PBO` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_PBO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `productobodega`
--


/*!40000 ALTER TABLE `productobodega` DISABLE KEYS */;
LOCK TABLES `productobodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `productobodega` ENABLE KEYS */;

--
-- Table structure for table `promocionesproveedor`
--

DROP TABLE IF EXISTS `promocionesproveedor`;
CREATE TABLE `promocionesproveedor` (
  `SERIAL_PPV` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `SERIAL_PVD` int(11) default NULL,
  `CONDICIONES_PPV` char(255) collate latin1_spanish_ci default NULL,
  `INICIO_PPV` date default NULL,
  `FIN_PPV` date default NULL,
  `DESCUENTO_PPV` decimal(10,2) default NULL,
  PRIMARY KEY  (`SERIAL_PPV`),
  KEY `FK_PROMOCIONESPROVEEDORPRODUCTO` (`SERIAL_PRD`),
  KEY `FK_PROVEEDORPROMOCIONESPROVEEDOR` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROMOCIONESPROVEEDORPRODUCTO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`),
  CONSTRAINT `FK_PROVEEDORPROMOCIONESPROVEEDOR` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `promocionesproveedor`
--


/*!40000 ALTER TABLE `promocionesproveedor` DISABLE KEYS */;
LOCK TABLES `promocionesproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `promocionesproveedor` ENABLE KEYS */;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `SERIAL_PVD` int(11) NOT NULL auto_increment,
  `SERIAL_CIU` int(11) default NULL,
  `SERIAL_TPD` int(11) default NULL,
  `CODIGO_PVD` char(20) collate latin1_spanish_ci NOT NULL default '',
  `PERSONERIAJURIDICA_PVD` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PVD` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDO_PVD` char(60) collate latin1_spanish_ci default NULL,
  `RAZONSOCIAL_PVD` char(150) collate latin1_spanish_ci NOT NULL default '',
  `RUCCEDULA_PVD` char(15) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCION_PVD` char(255) collate latin1_spanish_ci NOT NULL default '',
  `NOMBREREPRESENTANTE_PVD` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOREPRESENTANTE_PVD` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONO1_PVD` char(15) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONO2_PVD` char(15) collate latin1_spanish_ci default NULL,
  `FAX_PVD` char(15) collate latin1_spanish_ci default NULL,
  `CELULAR_PVD` char(15) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICO_PVD` char(65) collate latin1_spanish_ci default NULL,
  `DESCUENTO_PVD` decimal(5,2) default NULL,
  `NOMBREVENTAS_PVD` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOVENTAS_PVD` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONOVENTAS_PVD` char(15) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICOVENTAS_PVD` char(65) collate latin1_spanish_ci default NULL,
  `NOMBRECOBROS_PVD` char(60) collate latin1_spanish_ci default NULL,
  `APELLIDOCOBROS_PVD` char(60) collate latin1_spanish_ci default NULL,
  `TELEFONOCOBROS_PVD` char(15) collate latin1_spanish_ci default NULL,
  `CORREOELECTRONICOCOBROS_PVD` char(65) collate latin1_spanish_ci default NULL,
  `PROVEEDORDESDE_PVD` date default NULL,
  `ACTIVIDADECONOMICASRI_PVD` char(255) collate latin1_spanish_ci default NULL,
  `IMPRENTA_PVD` char(80) collate latin1_spanish_ci default NULL,
  `RUCIMPRENTA_PVD` char(13) collate latin1_spanish_ci default NULL,
  `NUMEROAUTORIZACION_PVD` char(11) collate latin1_spanish_ci default NULL,
  `FECHAAUTORIZACION_PVD` date default NULL,
  `ESTADO_PVD` char(10) collate latin1_spanish_ci NOT NULL default '',
  `CALIFICACION_PVD` int(11) default NULL,
  `CONTRIBUYENTEESPECIAL_PVD` char(2) collate latin1_spanish_ci default NULL,
  `NUMEROCASA_PVD` char(10) collate latin1_spanish_ci default NULL,
  `NOMBRECOMERCIAL_PVD` char(100) collate latin1_spanish_ci default NULL,
  `TIPOPROVISION_PVD` char(20) collate latin1_spanish_ci default NULL,
  `TIPODOCUMENTO_PVD` char(25) collate latin1_spanish_ci default NULL,
  `FECHACADUCIDAD_PVD` date default NULL,
  `PLAZOCREDITO_PVD` int(11) default NULL,
  `TIPO_PVD` char(20) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_PVD`),
  KEY `AK_CODIGO_PVD_IDX` (`CODIGO_PVD`),
  KEY `AK_RAZONSOCIAL_PVD_IDX` (`RAZONSOCIAL_PVD`),
  KEY `AK_RUCCEDULA_PVD_IDX` (`RUCCEDULA_PVD`),
  KEY `FK_CIUDADPROVEEDOR` (`SERIAL_CIU`),
  KEY `FK_TIPOPROVEEDORPROVEEDOR` (`SERIAL_TPD`),
  CONSTRAINT `FK_CIUDADPROVEEDOR` FOREIGN KEY (`SERIAL_CIU`) REFERENCES `ciudad` (`SERIAL_CIU`),
  CONSTRAINT `FK_TIPOPROVEEDORPROVEEDOR` FOREIGN KEY (`SERIAL_TPD`) REFERENCES `tipoproveedor` (`SERIAL_TPD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `proveedor`
--


/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
LOCK TABLES `proveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

--
-- Table structure for table `proveedoresproducto`
--

DROP TABLE IF EXISTS `proveedoresproducto`;
CREATE TABLE `proveedoresproducto` (
  `SERIAL_PRP` int(11) NOT NULL auto_increment,
  `SERIAL_PRD` int(11) default NULL,
  `SERIAL_PVD` int(11) default NULL,
  `PRECIOAPROBADO_PRP` decimal(16,6) NOT NULL default '0.000000',
  `DESCUENTOPROVEEDOR_PRP` decimal(5,2) default NULL,
  `TIEMPODEENTREGA_PRP` int(11) NOT NULL default '0',
  `ATRAZOS_PRP` int(11) NOT NULL default '0',
  `DEVOLUCIONES_PRP` int(11) default NULL,
  `OBSERVACIONESCONTROLCALIDAD_PRP` char(255) collate latin1_spanish_ci default NULL,
  `ESTADOPROVEEDOR_PRP` char(15) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PRP`),
  KEY `FK_PROVEEDORESPRODUCTOPRODUCTO` (`SERIAL_PRD`),
  KEY `FK_PROVEEDORPROVEEDORESPRODUCTO` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROVEEDORESPRODUCTOPRODUCTO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`),
  CONSTRAINT `FK_PROVEEDORPROVEEDORESPRODUCTO` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `proveedoresproducto`
--


/*!40000 ALTER TABLE `proveedoresproducto` DISABLE KEYS */;
LOCK TABLES `proveedoresproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `proveedoresproducto` ENABLE KEYS */;

--
-- Table structure for table `proveedorrebates`
--

DROP TABLE IF EXISTS `proveedorrebates`;
CREATE TABLE `proveedorrebates` (
  `SERIAL_REB` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `DESCRIPCION_REB` char(255) collate latin1_spanish_ci NOT NULL default '',
  `NOTACREDITO_REB` char(15) collate latin1_spanish_ci default NULL,
  `ENTREGADO_REB` char(2) collate latin1_spanish_ci default NULL,
  `OBSERVACION_REB` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_REB`),
  KEY `FK_PROVEEDORPROVEEDORREBATES` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROVEEDORPROVEEDORREBATES` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `proveedorrebates`
--


/*!40000 ALTER TABLE `proveedorrebates` DISABLE KEYS */;
LOCK TABLES `proveedorrebates` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `proveedorrebates` ENABLE KEYS */;

--
-- Table structure for table `proveedortipoactivofijo`
--

DROP TABLE IF EXISTS `proveedortipoactivofijo`;
CREATE TABLE `proveedortipoactivofijo` (
  `SERIAL_PAF` int(11) NOT NULL auto_increment,
  `SERIAL_TAF` int(11) default NULL,
  `SERIAL_PVD` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_PAF`),
  KEY `FK_PROVEEDORPROVEEDORTIPOACTIVOFIJO` (`SERIAL_PVD`),
  KEY `FK_TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO` (`SERIAL_TAF`),
  CONSTRAINT `FK_PROVEEDORPROVEEDORTIPOACTIVOFIJO` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`),
  CONSTRAINT `FK_TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO` FOREIGN KEY (`SERIAL_TAF`) REFERENCES `tipoactivofijo` (`SERIAL_TAF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `proveedortipoactivofijo`
--


/*!40000 ALTER TABLE `proveedortipoactivofijo` DISABLE KEYS */;
LOCK TABLES `proveedortipoactivofijo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `proveedortipoactivofijo` ENABLE KEYS */;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE `provincia` (
  `SERIAL_PRV` int(11) NOT NULL auto_increment,
  `SERIAL_PAI` int(11) default NULL,
  `CODIGO_PRV` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_PRV` char(60) collate latin1_spanish_ci NOT NULL default '',
  `PREFIJOTELEFONICO_PRV` char(3) collate latin1_spanish_ci default NULL,
  `POBLACION_PRV` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_PRV`),
  KEY `AK_CODIGO_PRV_IDX` (`CODIGO_PRV`),
  KEY `FK_PAISPROVINCIA` (`SERIAL_PAI`),
  CONSTRAINT `FK_PAISPROVINCIA` FOREIGN KEY (`SERIAL_PAI`) REFERENCES `pais` (`SERIAL_PAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `provincia`
--


/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
LOCK TABLES `provincia` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;

--
-- Table structure for table `puntoscliente`
--

DROP TABLE IF EXISTS `puntoscliente`;
CREATE TABLE `puntoscliente` (
  `SERIAL_PTO` int(11) NOT NULL auto_increment,
  `CODIGO_PTO` char(5) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PTO` char(100) collate latin1_spanish_ci NOT NULL default '',
  `PUNTOS_PTO` int(11) NOT NULL default '0',
  `TIPOACCION_PTO` char(20) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PTO`),
  KEY `AK_CODIGO_PTO_IDX` (`CODIGO_PTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `puntoscliente`
--


/*!40000 ALTER TABLE `puntoscliente` DISABLE KEYS */;
LOCK TABLES `puntoscliente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `puntoscliente` ENABLE KEYS */;

--
-- Table structure for table `puntosproveedor`
--

DROP TABLE IF EXISTS `puntosproveedor`;
CREATE TABLE `puntosproveedor` (
  `SERIAL_PTP` int(11) NOT NULL auto_increment,
  `CODIGO_PTP` char(5) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_PTP` char(100) collate latin1_spanish_ci NOT NULL default '',
  `PUNTOS_PTP` int(11) NOT NULL default '0',
  `TIPOACCION_PTP` char(20) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_PTP`),
  KEY `AK_CODIGO_PTP_IDX` (`CODIGO_PTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `puntosproveedor`
--


/*!40000 ALTER TABLE `puntosproveedor` DISABLE KEYS */;
LOCK TABLES `puntosproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `puntosproveedor` ENABLE KEYS */;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `SERIAL_REG` int(11) NOT NULL auto_increment,
  `CODIGO_REG` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_REG` char(60) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_REG`),
  KEY `AK_CODIGO_REG_IDX` (`CODIGO_REG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `region`
--


/*!40000 ALTER TABLE `region` DISABLE KEYS */;
LOCK TABLES `region` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;

--
-- Table structure for table `registroaccidentes`
--

DROP TABLE IF EXISTS `registroaccidentes`;
CREATE TABLE `registroaccidentes` (
  `SERIAL_RAC` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `CODIGO_RAC` char(20) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_RAC` date default NULL,
  `DESCRIPCION_RAC` char(255) collate latin1_spanish_ci default NULL,
  `LUGAR_RAC` char(40) collate latin1_spanish_ci default NULL,
  `CAUSA_RAC` char(50) collate latin1_spanish_ci default NULL,
  `CLASIFICACION_RAC` char(30) collate latin1_spanish_ci default NULL,
  `CONSECUENCIA_RAC` char(50) collate latin1_spanish_ci default NULL,
  `ACCIONES_RAC` char(30) collate latin1_spanish_ci default NULL,
  `OBSERVACIONES_RAC` char(255) collate latin1_spanish_ci default NULL,
  `BAJA_RAC` char(2) collate latin1_spanish_ci default NULL,
  `TIEMPO_RAC` char(20) collate latin1_spanish_ci default NULL,
  `COSTO_RAC` decimal(16,2) default NULL,
  PRIMARY KEY  (`SERIAL_RAC`),
  KEY `FK_EMPLEADOREGISTROACCIDENTES` (`SERIAL_EPL`),
  CONSTRAINT `FK_EMPLEADOREGISTROACCIDENTES` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `registroaccidentes`
--


/*!40000 ALTER TABLE `registroaccidentes` DISABLE KEYS */;
LOCK TABLES `registroaccidentes` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `registroaccidentes` ENABLE KEYS */;

--
-- Table structure for table `registroquejassugerencias`
--

DROP TABLE IF EXISTS `registroquejassugerencias`;
CREATE TABLE `registroquejassugerencias` (
  `SERIAL_RQS` int(11) NOT NULL auto_increment,
  `SERIAL_QUE` int(11) default NULL,
  `NUMERODOCUMENTO_RQS` int(11) NOT NULL default '0',
  `FECHA_RQS` datetime NOT NULL default '0000-00-00 00:00:00',
  `OBSERVACIONES_RQS` varchar(200) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_RQS` varchar(10) collate latin1_spanish_ci NOT NULL default '',
  `ELABORADOPOR_RQS` int(11) default NULL,
  `MODIFICADOPOR_RQS` int(11) default NULL,
  `FECHAMODIFICACION_RQS` datetime default NULL,
  `AUTORIZADOPOR_RQS` int(11) default NULL,
  `FECHAAUTORIZACION_RQS` datetime default NULL,
  `TIPOEMISOR_RQS` varchar(10) collate latin1_spanish_ci default NULL,
  `TIPODESTINATARIO_RQS` varchar(10) collate latin1_spanish_ci default NULL,
  `EMISOR_RQS` int(11) default NULL,
  `DESTINATARIO_RQS` int(11) default NULL,
  `INVESTIGACION_RQS` text collate latin1_spanish_ci,
  `SEGUIMIENTO_RQS` text collate latin1_spanish_ci,
  PRIMARY KEY  (`SERIAL_RQS`),
  KEY `AK_NUMERODOCUMENTO_RQS_IDX` (`NUMERODOCUMENTO_RQS`),
  KEY `AK_FECHA_RQS_IDX` (`FECHA_RQS`),
  KEY `FK_TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS` (`SERIAL_QUE`),
  CONSTRAINT `FK_TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS` FOREIGN KEY (`SERIAL_QUE`) REFERENCES `tiposquejassugerencias` (`SERIAL_QUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `registroquejassugerencias`
--


/*!40000 ALTER TABLE `registroquejassugerencias` DISABLE KEYS */;
LOCK TABLES `registroquejassugerencias` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `registroquejassugerencias` ENABLE KEYS */;

--
-- Table structure for table `rolpagosgeneral`
--

DROP TABLE IF EXISTS `rolpagosgeneral`;
CREATE TABLE `rolpagosgeneral` (
  `SERIAL_ROP` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `OBSERVACIONES_ROP` char(255) collate latin1_spanish_ci default NULL,
  `FECHA_ROP` date default NULL,
  `ESTADO_ROP` char(20) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_ROP`),
  KEY `FK_PERIODOROLROLPAGOSGENERAL` (`SERIAL_PERROL`),
  CONSTRAINT `FK_PERIODOROLROLPAGOSGENERAL` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `rolpagosgeneral`
--


/*!40000 ALTER TABLE `rolpagosgeneral` DISABLE KEYS */;
LOCK TABLES `rolpagosgeneral` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `rolpagosgeneral` ENABLE KEYS */;

--
-- Table structure for table `rubrogeneralrolpagos`
--

DROP TABLE IF EXISTS `rubrogeneralrolpagos`;
CREATE TABLE `rubrogeneralrolpagos` (
  `SERIAL_RGR` int(11) NOT NULL auto_increment,
  `SERIAL_PLC` int(11) default NULL,
  `SERIAL_TCT` int(11) default NULL,
  `CODIGO_RGR` char(20) collate latin1_spanish_ci default NULL,
  `TIPO_RGR` char(15) collate latin1_spanish_ci NOT NULL default '',
  `FECHAREGISTRO_RGR` date NOT NULL default '0000-00-00',
  `NOMBRE_RGR` char(255) collate latin1_spanish_ci NOT NULL default '',
  `FRECUENCIA_RGR` int(11) NOT NULL default '0',
  `FORMULA_RGR` char(255) collate latin1_spanish_ci NOT NULL default '',
  `FECHAINICIO_RGR` date NOT NULL default '0000-00-00',
  `ESTADO_RGR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `ACEPTAANTICIPOS_RGR` char(2) collate latin1_spanish_ci default NULL,
  `DESPLEGARROL_RGR` char(2) collate latin1_spanish_ci NOT NULL default '',
  `AFECTAIESS_RGR` char(2) collate latin1_spanish_ci NOT NULL default '',
  `QUINCENAL_RGR` char(2) collate latin1_spanish_ci default NULL,
  `AFECTAIMPUESTO_RGR` char(2) collate latin1_spanish_ci default NULL,
  `PROYECCIONIMPUESTO_RGR` char(2) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_RGR`),
  KEY `AK_FECHAINICIO_RUBROL_IDX` (`FECHAINICIO_RGR`),
  KEY `FK_PLANCONTABLERUBROGENERALROLPAGOS` (`SERIAL_PLC`),
  KEY `FK_TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS` (`SERIAL_TCT`),
  CONSTRAINT `FK_PLANCONTABLERUBROGENERALROLPAGOS` FOREIGN KEY (`SERIAL_PLC`) REFERENCES `plancontable` (`SERIAL_PLC`),
  CONSTRAINT `FK_TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS` FOREIGN KEY (`SERIAL_TCT`) REFERENCES `tipocontratostrabajo` (`SERIAL_TCT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `rubrogeneralrolpagos`
--


/*!40000 ALTER TABLE `rubrogeneralrolpagos` DISABLE KEYS */;
LOCK TABLES `rubrogeneralrolpagos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `rubrogeneralrolpagos` ENABLE KEYS */;

--
-- Table structure for table `ruta`
--

DROP TABLE IF EXISTS `ruta`;
CREATE TABLE `ruta` (
  `SERIAL_RUT` int(11) NOT NULL auto_increment,
  `SERIAL_ZON` int(11) default NULL,
  `CODIGO_RUT` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_RUT` char(60) collate latin1_spanish_ci NOT NULL default '',
  `GERENTEVENTAS_RUT` int(11) default NULL,
  `JEFEVENTAS_RUT` int(11) default NULL,
  `SUPERVISOR_RUT` int(11) default NULL,
  `VENDEDOR_RUT` int(11) default NULL,
  `COBRADOR_RUT` int(11) default NULL,
  `FRECUENCIA_RUT` char(40) collate latin1_spanish_ci default NULL,
  `LUNES_RUT` char(2) collate latin1_spanish_ci default NULL,
  `MARTES_RUT` char(2) collate latin1_spanish_ci default NULL,
  `MIERCOLES_RUT` char(2) collate latin1_spanish_ci default NULL,
  `JUEVES_RUT` char(2) collate latin1_spanish_ci default NULL,
  `VIERNES_RUT` char(2) collate latin1_spanish_ci default NULL,
  `SABADO_RUT` char(2) collate latin1_spanish_ci default NULL,
  `DOMINGO_RUT` char(2) collate latin1_spanish_ci default NULL,
  `LIMITENORTE_RUT` char(100) collate latin1_spanish_ci default NULL,
  `LIMITESUR_RUT` char(100) collate latin1_spanish_ci default NULL,
  `LIMITEESTE_RUT` char(100) collate latin1_spanish_ci default NULL,
  `LIMITEOESTE_RUT` char(100) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_RUT`),
  KEY `AK_CODIGO_RUT_IDX` (`CODIGO_RUT`),
  KEY `FK_ZONARUTA` (`SERIAL_ZON`),
  CONSTRAINT `FK_ZONARUTA` FOREIGN KEY (`SERIAL_ZON`) REFERENCES `zona` (`SERIAL_ZON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ruta`
--


/*!40000 ALTER TABLE `ruta` DISABLE KEYS */;
LOCK TABLES `ruta` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ruta` ENABLE KEYS */;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `serial_sec` int(11) NOT NULL auto_increment,
  `codigo_sec` char(15) NOT NULL default '',
  `nombre_sec` char(30) NOT NULL default '',
  `descripcion_sec` char(255) default NULL,
  PRIMARY KEY  (`serial_sec`),
  KEY `codigo_sec_idx` (`codigo_sec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seccion`
--


/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
LOCK TABLES `seccion` WRITE;
INSERT INTO `seccion` VALUES (1,'PRE','PRE ESCOLAR','SECCION PRE ESCOLAR'),(2,'PRI','PRIMARIA','SECCION PRIMARIA'),(3,'SEC','SECUNDARIA','SECCION SECUNDARIA');
UNLOCK TABLES;
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;

--
-- Table structure for table `solicituddotacion`
--

DROP TABLE IF EXISTS `solicituddotacion`;
CREATE TABLE `solicituddotacion` (
  `SERIAL_SDO` int(11) NOT NULL auto_increment,
  `SERIAL_ARE` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `CODIGO_SDO` char(10) collate latin1_spanish_ci NOT NULL default '',
  `NUMERO_SDO` char(10) collate latin1_spanish_ci NOT NULL default '',
  `FECHA_SDO` date default NULL,
  `APROBADOPOR_SDO` int(11) default NULL,
  `ENTREGADOPOR_SDO` int(11) default NULL,
  `RECIBIDOPOR_SDO` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_SDO`),
  KEY `FK_AREASOLICITUDDOTACION` (`SERIAL_ARE`),
  KEY `FK_EMPLEADOSOLICITUDDOTACION` (`SERIAL_EPL`),
  CONSTRAINT `FK_AREASOLICITUDDOTACION` FOREIGN KEY (`SERIAL_ARE`) REFERENCES `area` (`SERIAL_ARE`),
  CONSTRAINT `FK_EMPLEADOSOLICITUDDOTACION` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `solicituddotacion`
--


/*!40000 ALTER TABLE `solicituddotacion` DISABLE KEYS */;
LOCK TABLES `solicituddotacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `solicituddotacion` ENABLE KEYS */;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
CREATE TABLE `sucursal` (
  `SERIAL_SUC` int(11) NOT NULL auto_increment,
  `SERIAL_CIU` int(11) default NULL,
  `SERIAL_EMP` int(11) default NULL,
  `CODIGO_SUC` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_SUC` char(50) collate latin1_spanish_ci NOT NULL default '',
  `DIRECCION_SUC` char(100) collate latin1_spanish_ci NOT NULL default '',
  `MATRIZ_SUC` char(2) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONO_SUC` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONO2_SUC` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONO3_SUC` char(20) collate latin1_spanish_ci default NULL,
  `TELEFONO4_SUC` char(20) collate latin1_spanish_ci default NULL,
  `FAX_SUC` char(20) collate latin1_spanish_ci default NULL,
  `EMAIL_SUC` char(60) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_SUC`),
  KEY `AK_CODIGO_SUC_IDX` (`CODIGO_SUC`),
  KEY `FK_CIUDADSUCURSAL` (`SERIAL_CIU`),
  KEY `FK_EMPRESASUCURSAL` (`SERIAL_EMP`),
  CONSTRAINT `FK_CIUDADSUCURSAL` FOREIGN KEY (`SERIAL_CIU`) REFERENCES `ciudad` (`SERIAL_CIU`),
  CONSTRAINT `FK_EMPRESASUCURSAL` FOREIGN KEY (`SERIAL_EMP`) REFERENCES `empresa` (`SERIAL_EMP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `sucursal`
--


/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
LOCK TABLES `sucursal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;

--
-- Table structure for table `sucursaldepartamentos`
--

DROP TABLE IF EXISTS `sucursaldepartamentos`;
CREATE TABLE `sucursaldepartamentos` (
  `SERIAL_DESC` int(11) NOT NULL auto_increment,
  `SERIAL_SUC` int(11) default NULL,
  `SERIAL_DEP` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_DESC`),
  KEY `FK_DEPARTAMENTOSUCURSALDEPARTAMENTO` (`SERIAL_DEP`),
  KEY `FK_SUCURSALSUCURSALDEPARTAMENTO` (`SERIAL_SUC`),
  CONSTRAINT `FK_DEPARTAMENTOSUCURSALDEPARTAMENTO` FOREIGN KEY (`SERIAL_DEP`) REFERENCES `departamentos` (`SERIAL_DEP`),
  CONSTRAINT `FK_SUCURSALSUCURSALDEPARTAMENTO` FOREIGN KEY (`SERIAL_SUC`) REFERENCES `sucursal` (`SERIAL_SUC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `sucursaldepartamentos`
--


/*!40000 ALTER TABLE `sucursaldepartamentos` DISABLE KEYS */;
LOCK TABLES `sucursaldepartamentos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `sucursaldepartamentos` ENABLE KEYS */;

--
-- Table structure for table `tablacastigocomisiones`
--

DROP TABLE IF EXISTS `tablacastigocomisiones`;
CREATE TABLE `tablacastigocomisiones` (
  `SERIAL_CASC` int(11) NOT NULL auto_increment,
  `DESDE_CASC` int(11) NOT NULL default '0',
  `HASTA_CASC` int(11) NOT NULL default '0',
  `CASTIGO_CASC` decimal(5,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_CASC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablacastigocomisiones`
--


/*!40000 ALTER TABLE `tablacastigocomisiones` DISABLE KEYS */;
LOCK TABLES `tablacastigocomisiones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablacastigocomisiones` ENABLE KEYS */;

--
-- Table structure for table `tablacomisionescargo`
--

DROP TABLE IF EXISTS `tablacomisionescargo`;
CREATE TABLE `tablacomisionescargo` (
  `SERIAL_COC` int(11) NOT NULL auto_increment,
  `SERIAL_CAR` int(11) default NULL,
  `COMISIONVENTA_COC` decimal(5,2) NOT NULL default '0.00',
  `COMISIONCOBRO_COC` decimal(5,2) default NULL,
  `COMISIONTELEMARKETING_COC` decimal(5,2) default NULL,
  PRIMARY KEY  (`SERIAL_COC`),
  KEY `FK_CARGOSTABLACOMISIONESCARGO` (`SERIAL_CAR`),
  CONSTRAINT `FK_CARGOSTABLACOMISIONESCARGO` FOREIGN KEY (`SERIAL_CAR`) REFERENCES `cargos` (`SERIAL_CAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablacomisionescargo`
--


/*!40000 ALTER TABLE `tablacomisionescargo` DISABLE KEYS */;
LOCK TABLES `tablacomisionescargo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablacomisionescargo` ENABLE KEYS */;

--
-- Table structure for table `tablacomisionesproducto`
--

DROP TABLE IF EXISTS `tablacomisionesproducto`;
CREATE TABLE `tablacomisionesproducto` (
  `SERIAL_COP` int(11) NOT NULL auto_increment,
  `SERIAL_TIP` int(11) default NULL,
  `SERIAL_PRD` int(11) default NULL,
  `COMISION_COP` decimal(5,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_COP`),
  KEY `FK_PRODUCTOTABLACOMISIONESPRODUCTO` (`SERIAL_PRD`),
  KEY `FK_TIPOCLIENTETABLACOMISIONPRODUCTO` (`SERIAL_TIP`),
  CONSTRAINT `FK_PRODUCTOTABLACOMISIONESPRODUCTO` FOREIGN KEY (`SERIAL_PRD`) REFERENCES `producto` (`SERIAL_PRD`),
  CONSTRAINT `FK_TIPOCLIENTETABLACOMISIONPRODUCTO` FOREIGN KEY (`SERIAL_TIP`) REFERENCES `tipocliente` (`SERIAL_TIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablacomisionesproducto`
--


/*!40000 ALTER TABLE `tablacomisionesproducto` DISABLE KEYS */;
LOCK TABLES `tablacomisionesproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablacomisionesproducto` ENABLE KEYS */;

--
-- Table structure for table `tablaimpuestorenta`
--

DROP TABLE IF EXISTS `tablaimpuestorenta`;
CREATE TABLE `tablaimpuestorenta` (
  `SERIAL_TIR` int(11) NOT NULL auto_increment,
  `BASICA_TIR` double NOT NULL default '0',
  `EXCEDENTE_TIR` double NOT NULL default '0',
  `FRACCIONBASICA_TIR` float NOT NULL default '0',
  `FRACCIONEXCEDENTE_TIR` float NOT NULL default '0',
  `ANIO_TIR` int(11) default NULL,
  `ESTADO_TIR` char(20) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TIR`),
  KEY `AK_BASICA_TIR_IDX` (`BASICA_TIR`),
  KEY `AK_EXCEDENTE_TIR` (`EXCEDENTE_TIR`),
  KEY `AK_FRACCIONBASICA_TIR` (`FRACCIONBASICA_TIR`),
  KEY `AK_FRACCIONEXCEDENTE_TIR` (`FRACCIONEXCEDENTE_TIR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablaimpuestorenta`
--


/*!40000 ALTER TABLE `tablaimpuestorenta` DISABLE KEYS */;
LOCK TABLES `tablaimpuestorenta` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablaimpuestorenta` ENABLE KEYS */;

--
-- Table structure for table `tablaliquidacion`
--

DROP TABLE IF EXISTS `tablaliquidacion`;
CREATE TABLE `tablaliquidacion` (
  `SERIAL_TAL` int(11) NOT NULL auto_increment,
  `CODIGO_TAL` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TAL` char(40) collate latin1_spanish_ci NOT NULL default '',
  `DESDEANIO_TAL` int(11) NOT NULL default '0',
  `HASTAANIO_TAL` int(11) NOT NULL default '0',
  `CANTIDADBENEFICIO_TAL` int(11) NOT NULL default '0',
  `VIGENTEHASTA_TAL` date default NULL,
  `ESTADO_TAL` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TAL`),
  KEY `AK_CODIGO_TAL_IDX` (`CODIGO_TAL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablaliquidacion`
--


/*!40000 ALTER TABLE `tablaliquidacion` DISABLE KEYS */;
LOCK TABLES `tablaliquidacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablaliquidacion` ENABLE KEYS */;

--
-- Table structure for table `tablasri`
--

DROP TABLE IF EXISTS `tablasri`;
CREATE TABLE `tablasri` (
  `SERIAL_TSR` int(11) NOT NULL auto_increment,
  `SERIAL_PERROL` int(11) default NULL,
  `SERIAL_EPL` int(20) default NULL,
  `ANIO_TSR` char(4) collate latin1_spanish_ci NOT NULL default '',
  `INGRESOS_TSR` double default NULL,
  `INGRESOSLIQUIDOS_TSR` double default NULL,
  `IESSMES_TSR` double default NULL,
  `BASICA_TSR` double default '0',
  `EXCEDENTE_TSR` double default '0',
  `FRACCIONBASICA_TSR` double default '0',
  `FRACCIONEXCEDENTE_TSR` double default '0',
  `INGRESODESDE_TSR` double default NULL,
  `INGRESOHASTA_TSR` double default NULL,
  `IMPUESTOBASICA_TSR` double default NULL,
  `IMPUESTOEXCEDENTE_TSR` double default NULL,
  `BASEIMPONIBLE_TSR` double default NULL,
  `VALORRETENIDO_TSR` double default NULL,
  `ESTADO_TSR` char(1) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TSR`),
  KEY `FK_EMPLEADOTABLASRI` (`SERIAL_EPL`),
  KEY `FK_PERIODOROLTABLASRI` (`SERIAL_PERROL`),
  CONSTRAINT `FK_EMPLEADOTABLASRI` FOREIGN KEY (`SERIAL_EPL`) REFERENCES `empleado` (`SERIAL_EPL`),
  CONSTRAINT `FK_PERIODOROLTABLASRI` FOREIGN KEY (`SERIAL_PERROL`) REFERENCES `periodorol` (`SERIAL_PERROL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tablasri`
--


/*!40000 ALTER TABLE `tablasri` DISABLE KEYS */;
LOCK TABLES `tablasri` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tablasri` ENABLE KEYS */;

--
-- Table structure for table `tasas`
--

DROP TABLE IF EXISTS `tasas`;
CREATE TABLE `tasas` (
  `SERIAL_TAS` int(11) NOT NULL auto_increment,
  `SERIAL_PAI` int(11) default NULL,
  `SERIAL_TTA` int(11) default NULL,
  `FECHA_TAS` date NOT NULL default '0000-00-00',
  `VALOR_TAS` decimal(16,2) NOT NULL default '0.00',
  PRIMARY KEY  (`SERIAL_TAS`),
  KEY `AK_FECHA_TAS_IDX` (`FECHA_TAS`),
  KEY `FK_PAISTASAS` (`SERIAL_PAI`),
  KEY `FK_TIPOTASASTASAS` (`SERIAL_TTA`),
  CONSTRAINT `FK_PAISTASAS` FOREIGN KEY (`SERIAL_PAI`) REFERENCES `pais` (`SERIAL_PAI`),
  CONSTRAINT `FK_TIPOTASASTASAS` FOREIGN KEY (`SERIAL_TTA`) REFERENCES `tipotasas` (`SERIAL_TTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tasas`
--


/*!40000 ALTER TABLE `tasas` DISABLE KEYS */;
LOCK TABLES `tasas` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tasas` ENABLE KEYS */;

--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `SERIAL_TEM` int(11) NOT NULL auto_increment,
  `NOMBRE_TEM` char(30) collate latin1_spanish_ci default NULL,
  `DIRECTORIO_TEM` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TEM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `template`
--


/*!40000 ALTER TABLE `template` DISABLE KEYS */;
LOCK TABLES `template` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `template` ENABLE KEYS */;

--
-- Table structure for table `terciarizadora`
--

DROP TABLE IF EXISTS `terciarizadora`;
CREATE TABLE `terciarizadora` (
  `SERIAL_TEZ` int(11) NOT NULL auto_increment,
  `SERIAL_PVD` int(11) default NULL,
  `COMISION_TEZ` decimal(5,2) NOT NULL default '0.00',
  `FECHARENOVACION_TEZ` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`SERIAL_TEZ`),
  KEY `FK_PROVEEDORTERCIARIZADORA` (`SERIAL_PVD`),
  CONSTRAINT `FK_PROVEEDORTERCIARIZADORA` FOREIGN KEY (`SERIAL_PVD`) REFERENCES `proveedor` (`SERIAL_PVD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `terciarizadora`
--


/*!40000 ALTER TABLE `terciarizadora` DISABLE KEYS */;
LOCK TABLES `terciarizadora` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `terciarizadora` ENABLE KEYS */;

--
-- Table structure for table `tipoactivofijo`
--

DROP TABLE IF EXISTS `tipoactivofijo`;
CREATE TABLE `tipoactivofijo` (
  `SERIAL_TAF` int(11) NOT NULL auto_increment,
  `SERIAL_CLAF` int(11) default NULL,
  `SERIAL_FAF` int(11) default NULL,
  `CODIGO_TAF` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TAF` char(50) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_TAF` char(20) collate latin1_spanish_ci NOT NULL default '',
  `TANGIBLE_TAF` char(2) collate latin1_spanish_ci NOT NULL default '',
  `TIPODEPRECIACION_TAF` char(20) collate latin1_spanish_ci default NULL,
  `VIDAUTIL_TAF` int(11) default NULL,
  `ATRIBUTO1_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO2_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO3_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO4_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO5_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO6_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO7_TAF` char(50) collate latin1_spanish_ci default NULL,
  `ATRIBUTO8_TAF` char(50) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TAF`),
  KEY `AK_CODIGO_TAF_IDX` (`CODIGO_TAF`),
  KEY `FK_CLASEACTIVOFIJOTIPOACTIVOFIJO` (`SERIAL_CLAF`),
  KEY `FK_FAMILIAACTIVOFIJOTIPOACTIVOFIJO` (`SERIAL_FAF`),
  CONSTRAINT `FK_CLASEACTIVOFIJOTIPOACTIVOFIJO` FOREIGN KEY (`SERIAL_CLAF`) REFERENCES `claseactivofijo` (`SERIAL_CLAF`),
  CONSTRAINT `FK_FAMILIAACTIVOFIJOTIPOACTIVOFIJO` FOREIGN KEY (`SERIAL_FAF`) REFERENCES `familiaactivofijo` (`SERIAL_FAF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipoactivofijo`
--


/*!40000 ALTER TABLE `tipoactivofijo` DISABLE KEYS */;
LOCK TABLES `tipoactivofijo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipoactivofijo` ENABLE KEYS */;

--
-- Table structure for table `tipobodega`
--

DROP TABLE IF EXISTS `tipobodega`;
CREATE TABLE `tipobodega` (
  `SERIAL_TBO` int(11) NOT NULL auto_increment,
  `CODIGO_TBO` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TBO` char(30) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TBO`),
  KEY `AK_CODIGO_TBO_IDX` (`CODIGO_TBO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipobodega`
--


/*!40000 ALTER TABLE `tipobodega` DISABLE KEYS */;
LOCK TABLES `tipobodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipobodega` ENABLE KEYS */;

--
-- Table structure for table `tipocliente`
--

DROP TABLE IF EXISTS `tipocliente`;
CREATE TABLE `tipocliente` (
  `SERIAL_TIP` int(11) NOT NULL auto_increment,
  `CODIGO_TIP` char(5) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TIP` char(40) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_TIP` char(60) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TIP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipocliente`
--


/*!40000 ALTER TABLE `tipocliente` DISABLE KEYS */;
LOCK TABLES `tipocliente` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipocliente` ENABLE KEYS */;

--
-- Table structure for table `tipocompra`
--

DROP TABLE IF EXISTS `tipocompra`;
CREATE TABLE `tipocompra` (
  `SERIAL_TCM` int(11) NOT NULL auto_increment,
  `CODIGO_TCM` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TCM` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DEVOLUCIONIVA_TCM` char(2) collate latin1_spanish_ci NOT NULL default '',
  `CLASE_TCM` char(20) collate latin1_spanish_ci NOT NULL default '',
  `KARDEX_TCM` char(2) collate latin1_spanish_ci default NULL,
  `DEDUCIBLE_TCM` char(2) collate latin1_spanish_ci default NULL,
  `ESTADO_TCM` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TCM`),
  KEY `AK_CODIGO_TCM_IDX` (`CODIGO_TCM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipocompra`
--


/*!40000 ALTER TABLE `tipocompra` DISABLE KEYS */;
LOCK TABLES `tipocompra` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipocompra` ENABLE KEYS */;

--
-- Table structure for table `tipocomprobante`
--

DROP TABLE IF EXISTS `tipocomprobante`;
CREATE TABLE `tipocomprobante` (
  `SERIAL_TIC` int(11) NOT NULL auto_increment,
  `CODIGO_TIC` char(10) collate latin1_spanish_ci default NULL,
  `NUMERO_TIC` int(11) NOT NULL default '0',
  `DESCRIPCION_TIC` char(250) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TIC`),
  UNIQUE KEY `AK_CODIGO_TIC` (`CODIGO_TIC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipocomprobante`
--


/*!40000 ALTER TABLE `tipocomprobante` DISABLE KEYS */;
LOCK TABLES `tipocomprobante` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipocomprobante` ENABLE KEYS */;

--
-- Table structure for table `tipocontratostrabajo`
--

DROP TABLE IF EXISTS `tipocontratostrabajo`;
CREATE TABLE `tipocontratostrabajo` (
  `SERIAL_TCT` int(11) NOT NULL auto_increment,
  `CODIGO_TCT` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TCT` char(60) collate latin1_spanish_ci NOT NULL default '',
  `DECIMOTERCERO_TCT` char(2) collate latin1_spanish_ci default NULL,
  `DECIMOCUARTO_TCT` int(11) default NULL,
  `VACACIONES_TCT` int(11) default NULL,
  `FONDORESERVA_TCT` int(11) default NULL,
  `HORAEXTRA_TCT` int(11) default NULL,
  `HORASUPLEMENTARIA_TCT` int(11) default NULL,
  `LIQUIDACION_TCT` char(2) collate latin1_spanish_ci default NULL,
  `DESAHUCIO_TCT` char(2) collate latin1_spanish_ci default NULL,
  `JUBILACION_TCT` char(2) collate latin1_spanish_ci default NULL,
  `APORTEPATRONAL_TCT` int(11) default NULL,
  `APORTEPERSONAL_TCT` int(11) default NULL,
  `UTILIDADES_TCT` char(2) collate latin1_spanish_ci default NULL,
  `CONTRATOMODELO_TCT` char(255) collate latin1_spanish_ci NOT NULL default '',
  `ESTADO_TCT` char(10) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_TCT`),
  KEY `AK_CODIGO_TCT_IDX` (`CODIGO_TCT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipocontratostrabajo`
--


/*!40000 ALTER TABLE `tipocontratostrabajo` DISABLE KEYS */;
LOCK TABLES `tipocontratostrabajo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipocontratostrabajo` ENABLE KEYS */;

--
-- Table structure for table `tipoescalafones`
--

DROP TABLE IF EXISTS `tipoescalafones`;
CREATE TABLE `tipoescalafones` (
  `SERIAL_TES` int(11) NOT NULL auto_increment,
  `CODIGO_TES` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TES` char(30) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TES`),
  KEY `AK_CODIGO_TES_IDX` (`CODIGO_TES`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipoescalafones`
--


/*!40000 ALTER TABLE `tipoescalafones` DISABLE KEYS */;
LOCK TABLES `tipoescalafones` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipoescalafones` ENABLE KEYS */;

--
-- Table structure for table `tipoingresoegresobodega`
--

DROP TABLE IF EXISTS `tipoingresoegresobodega`;
CREATE TABLE `tipoingresoegresobodega` (
  `SERIAL_TIB` int(11) NOT NULL auto_increment,
  `CODIGO_TIB` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TIB` char(40) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_TIB` char(7) collate latin1_spanish_ci NOT NULL default '',
  `TIPODOCUMENTO_TIB` char(21) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TIB`),
  KEY `AK_CODIGO_TIB_IDX` (`CODIGO_TIB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipoingresoegresobodega`
--


/*!40000 ALTER TABLE `tipoingresoegresobodega` DISABLE KEYS */;
LOCK TABLES `tipoingresoegresobodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipoingresoegresobodega` ENABLE KEYS */;

--
-- Table structure for table `tipoproducto`
--

DROP TABLE IF EXISTS `tipoproducto`;
CREATE TABLE `tipoproducto` (
  `SERIAL_TPO` int(11) NOT NULL auto_increment,
  `SERIAL_CAP` int(11) default NULL,
  `CODIGO_TPO` char(7) collate latin1_spanish_ci NOT NULL default '',
  `TIPOSRI_TPO` char(3) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TPO` char(64) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_TPO` char(200) collate latin1_spanish_ci NOT NULL default '',
  `DIASCADUCIDAD_TPO` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_TPO`),
  KEY `AK_CODIGO_TPO_IDX` (`CODIGO_TPO`),
  KEY `FK_CATEGORIAPRODUCTOTIPOPRODUCTO` (`SERIAL_CAP`),
  CONSTRAINT `FK_CATEGORIAPRODUCTOTIPOPRODUCTO` FOREIGN KEY (`SERIAL_CAP`) REFERENCES `categoriaproducto` (`SERIAL_CAP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipoproducto`
--


/*!40000 ALTER TABLE `tipoproducto` DISABLE KEYS */;
LOCK TABLES `tipoproducto` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipoproducto` ENABLE KEYS */;

--
-- Table structure for table `tipoproveedor`
--

DROP TABLE IF EXISTS `tipoproveedor`;
CREATE TABLE `tipoproveedor` (
  `SERIAL_TPD` int(11) NOT NULL auto_increment,
  `SERIAL_PLC` int(11) default NULL,
  `CODIGO_TPD` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TPD` char(60) collate latin1_spanish_ci NOT NULL default '',
  `RETENCIONIVA_TPD` int(11) default NULL,
  `RETENCIONIRF_TPD` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_TPD`),
  KEY `AK_CODIGO_TPD_IDX` (`CODIGO_TPD`),
  KEY `FK_PLANCONTABLETIPOPROVEEDOR` (`SERIAL_PLC`),
  CONSTRAINT `FK_PLANCONTABLETIPOPROVEEDOR` FOREIGN KEY (`SERIAL_PLC`) REFERENCES `plancontable` (`SERIAL_PLC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipoproveedor`
--


/*!40000 ALTER TABLE `tipoproveedor` DISABLE KEYS */;
LOCK TABLES `tipoproveedor` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipoproveedor` ENABLE KEYS */;

--
-- Table structure for table `tiposprecios`
--

DROP TABLE IF EXISTS `tiposprecios`;
CREATE TABLE `tiposprecios` (
  `SERIAL_TPR` int(11) NOT NULL auto_increment,
  `CODIGO_TPR` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TPR` char(40) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TPR`),
  KEY `AK_CODIGO_TPR_IDX` (`CODIGO_TPR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tiposprecios`
--


/*!40000 ALTER TABLE `tiposprecios` DISABLE KEYS */;
LOCK TABLES `tiposprecios` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tiposprecios` ENABLE KEYS */;

--
-- Table structure for table `tiposquejassugerencias`
--

DROP TABLE IF EXISTS `tiposquejassugerencias`;
CREATE TABLE `tiposquejassugerencias` (
  `SERIAL_QUE` int(11) NOT NULL auto_increment,
  `CODIGO_QUE` char(7) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_QUS` char(100) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_QUS` char(10) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_QUE`),
  KEY `AK_CODIGO_QUE_IDX` (`CODIGO_QUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tiposquejassugerencias`
--


/*!40000 ALTER TABLE `tiposquejassugerencias` DISABLE KEYS */;
LOCK TABLES `tiposquejassugerencias` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tiposquejassugerencias` ENABLE KEYS */;

--
-- Table structure for table `tipotasas`
--

DROP TABLE IF EXISTS `tipotasas`;
CREATE TABLE `tipotasas` (
  `SERIAL_TTA` int(11) NOT NULL auto_increment,
  `CODIGO_TTA` char(6) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TTA` char(60) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_TTA`),
  KEY `AK_CODIGO_TTA_IDX` (`CODIGO_TTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `tipotasas`
--


/*!40000 ALTER TABLE `tipotasas` DISABLE KEYS */;
LOCK TABLES `tipotasas` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tipotasas` ENABLE KEYS */;

--
-- Table structure for table `trimestre`
--

DROP TABLE IF EXISTS `trimestre`;
CREATE TABLE `trimestre` (
  `serial_tri` int(11) NOT NULL auto_increment,
  `serial_per` int(11) default NULL,
  `codigo_tri` char(10) NOT NULL default '',
  `nombre_tri` char(50) NOT NULL default '',
  `fecini_tri` date default NULL,
  `fecfin_tri` date default NULL,
  PRIMARY KEY  (`serial_tri`),
  KEY `FK_trimestre_periodo_FK` (`serial_per`),
  KEY `codigo_tri_idx` (`codigo_tri`),
  CONSTRAINT `trimestre_ibfk_1` FOREIGN KEY (`serial_per`) REFERENCES `periodo` (`serial_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trimestre`
--


/*!40000 ALTER TABLE `trimestre` DISABLE KEYS */;
LOCK TABLES `trimestre` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `trimestre` ENABLE KEYS */;

--
-- Table structure for table `turnos`
--

DROP TABLE IF EXISTS `turnos`;
CREATE TABLE `turnos` (
  `SERIAL_TUR` int(11) NOT NULL auto_increment,
  `CODIGO_TUR` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_TUR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `FECHAINICIO_TUR` date NOT NULL default '0000-00-00',
  `FECHAFIN_TUR` date NOT NULL default '0000-00-00',
  `LUNESENTRADA_TUR` time default NULL,
  `LUNESSALIDALUNCH_TUR` time default NULL,
  `LUNESENTRADALUNCH_TUR` time default NULL,
  `LUNESSALIDA_TUR` time default NULL,
  `MARTESENTRADA_TUR` time default NULL,
  `MARTESSALIDALUNCH_TUR` time default NULL,
  `MARTESENTRADALUNCH_TUR` time default NULL,
  `MARTESSALIDA_TUR` time default NULL,
  `MIERCOLESENTRADA_TUR` time default NULL,
  `MIERCOLESSALIDALUNCH_TUR` time default NULL,
  `MIERCOLESENTRADALUNCH_TUR` time default NULL,
  `MIERCOLESSALIDA_TUR` time default NULL,
  `JUEVESENTRADA_TUR` time default NULL,
  `JUEVESSALIDALUNCH_TUR` time default NULL,
  `JUEVESENTRADALUNCH_TUR` time default NULL,
  `JUEVESSALIDA_TUR` time default NULL,
  `VIERNESENTRADA_TUR` time default NULL,
  `VIERNESSALIDALUNCH_TUR` time default NULL,
  `VIERNESENTRADALUNCH_TUR` time default NULL,
  `VIERNESSALIDA_TUR` time default NULL,
  `SABADOENTRADA_TUR` time default NULL,
  `SABADOSALIDALUNCH_TUR` time default NULL,
  `SABADOENTRADALUNCH_TUR` time default NULL,
  `SABADOSALIDA_TUR` time default NULL,
  `DOMINGOENTRADA_TUR` time default NULL,
  `DOMINGOSALIDALUNCH_TUR` time default NULL,
  `DOMINGOENTRADALUNCH_TUR` time default NULL,
  `DOMINGOSALIDA_TUR` time default NULL,
  PRIMARY KEY  (`SERIAL_TUR`),
  KEY `AK_CODIGO_TUR_IDX` (`CODIGO_TUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `turnos`
--


/*!40000 ALTER TABLE `turnos` DISABLE KEYS */;
LOCK TABLES `turnos` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `turnos` ENABLE KEYS */;

--
-- Table structure for table `ubicacion`
--

DROP TABLE IF EXISTS `ubicacion`;
CREATE TABLE `ubicacion` (
  `SERIAL_UBI` int(11) NOT NULL auto_increment,
  `SERIAL_DESC` int(11) default NULL,
  `CODIGO_UBI` char(50) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_UBI` char(100) collate latin1_spanish_ci NOT NULL default '',
  `DESCRIPCION_UBI` char(200) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_UBI`),
  UNIQUE KEY `AK_CODIGO_UBI` (`CODIGO_UBI`),
  KEY `FK_SUCURSALDEPARTAMENTOSUBICACION` (`SERIAL_DESC`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOSUBICACION` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ubicacion`
--


/*!40000 ALTER TABLE `ubicacion` DISABLE KEYS */;
LOCK TABLES `ubicacion` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ubicacion` ENABLE KEYS */;

--
-- Table structure for table `ubicacionbodega`
--

DROP TABLE IF EXISTS `ubicacionbodega`;
CREATE TABLE `ubicacionbodega` (
  `SERIAL_UBO` int(11) NOT NULL auto_increment,
  `SERIAL_BOD` int(11) default NULL,
  `ESTANTE_UBO` char(60) collate latin1_spanish_ci default NULL,
  `FILA_UBO` char(60) collate latin1_spanish_ci default NULL,
  `NIVEL_UBO` char(60) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_UBO`),
  KEY `FK_BODEGAUBICACIONBODEGA` (`SERIAL_BOD`),
  CONSTRAINT `FK_BODEGAUBICACIONBODEGA` FOREIGN KEY (`SERIAL_BOD`) REFERENCES `bodega` (`SERIAL_BOD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `ubicacionbodega`
--


/*!40000 ALTER TABLE `ubicacionbodega` DISABLE KEYS */;
LOCK TABLES `ubicacionbodega` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `ubicacionbodega` ENABLE KEYS */;

--
-- Table structure for table `unidadmedida`
--

DROP TABLE IF EXISTS `unidadmedida`;
CREATE TABLE `unidadmedida` (
  `SERIAL_UME` int(11) NOT NULL auto_increment,
  `NOMBRE_UME` char(25) collate latin1_spanish_ci NOT NULL default '',
  `TIPO_UME` char(15) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_UME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `unidadmedida`
--


/*!40000 ALTER TABLE `unidadmedida` DISABLE KEYS */;
LOCK TABLES `unidadmedida` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `unidadmedida` ENABLE KEYS */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `SERIAL_USR` int(11) NOT NULL auto_increment,
  `SERIAL_PFL` int(11) default NULL,
  `CODIGO_USR` char(10) collate latin1_spanish_ci NOT NULL default '',
  `CLAVE_USR` char(32) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_USR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `APELLIDO_USR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE2_USR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `APELLIDO2_USR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `TELEFONO_USR` char(10) collate latin1_spanish_ci default NULL,
  `EXTENSION_USR` char(5) collate latin1_spanish_ci default NULL,
  `CELULAR_USR` char(10) collate latin1_spanish_ci default NULL,
  `EMAIL_USR` char(64) collate latin1_spanish_ci default NULL,
  `FECHA_USR` date default NULL,
  `FOTO_USR` char(250) collate latin1_spanish_ci default NULL,
  `ESTADO_USR` char(20) collate latin1_spanish_ci NOT NULL default '',
  `CAMBIO_USR` char(2) collate latin1_spanish_ci NOT NULL default '',
  `IPACCESO_USR` char(16) collate latin1_spanish_ci default NULL,
  `ENELSISTEMA_USR` char(2) collate latin1_spanish_ci default NULL,
  `MODOACCESO_USR` char(10) collate latin1_spanish_ci default NULL,
  `SERIAL_EPL` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_USR`),
  UNIQUE KEY `AK_CODIGO_USR_IDX` (`CODIGO_USR`),
  KEY `AK_APELLIDO_USR_IDX` (`APELLIDO_USR`,`APELLIDO2_USR`,`NOMBRE_USR`,`NOMBRE2_USR`),
  KEY `FK_PERFILUSUARIO` (`SERIAL_PFL`),
  CONSTRAINT `FK_PERFILUSUARIO` FOREIGN KEY (`SERIAL_PFL`) REFERENCES `perfil` (`SERIAL_PFL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuario`
--


/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
LOCK TABLES `usuario` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

--
-- Table structure for table `usuariosucursal`
--

DROP TABLE IF EXISTS `usuariosucursal`;
CREATE TABLE `usuariosucursal` (
  `SERIAL_USU` int(11) NOT NULL auto_increment,
  `SERIAL_DESC` int(11) default NULL,
  `SERIAL_USR` int(11) default NULL,
  PRIMARY KEY  (`SERIAL_USU`),
  KEY `FK_SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL` (`SERIAL_DESC`),
  KEY `FK_USUARIOUSUARIOSUCURSAL` (`SERIAL_USR`),
  CONSTRAINT `FK_SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL` FOREIGN KEY (`SERIAL_DESC`) REFERENCES `sucursaldepartamentos` (`SERIAL_DESC`),
  CONSTRAINT `FK_USUARIOUSUARIOSUCURSAL` FOREIGN KEY (`SERIAL_USR`) REFERENCES `usuario` (`SERIAL_USR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuariosucursal`
--


/*!40000 ALTER TABLE `usuariosucursal` DISABLE KEYS */;
LOCK TABLES `usuariosucursal` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `usuariosucursal` ENABLE KEYS */;

--
-- Table structure for table `variablesmodulo`
--

DROP TABLE IF EXISTS `variablesmodulo`;
CREATE TABLE `variablesmodulo` (
  `SERIAL_VAM` int(11) NOT NULL auto_increment,
  `SERIAL_MOD` int(11) default NULL,
  `NOMBRELOGICO_VAM` char(25) collate latin1_spanish_ci NOT NULL default '',
  `TABLA_VAM` char(25) collate latin1_spanish_ci NOT NULL default '',
  `NOMBREFISICO_VAM` char(25) collate latin1_spanish_ci NOT NULL default '',
  `PRIMARYKEY_VAM` char(25) collate latin1_spanish_ci default NULL,
  `DESCRIPCION_VAM` char(255) collate latin1_spanish_ci default NULL,
  PRIMARY KEY  (`SERIAL_VAM`),
  KEY `FK_MODULOSVARIABLESMODULO` (`SERIAL_MOD`),
  CONSTRAINT `FK_MODULOSVARIABLESMODULO` FOREIGN KEY (`SERIAL_MOD`) REFERENCES `modulos` (`SERIAL_MOD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `variablesmodulo`
--


/*!40000 ALTER TABLE `variablesmodulo` DISABLE KEYS */;
LOCK TABLES `variablesmodulo` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `variablesmodulo` ENABLE KEYS */;

--
-- Table structure for table `zona`
--

DROP TABLE IF EXISTS `zona`;
CREATE TABLE `zona` (
  `SERIAL_ZON` int(11) NOT NULL auto_increment,
  `SERIAL_REG` int(11) default NULL,
  `CODIGO_ZON` char(7) collate latin1_spanish_ci NOT NULL default '',
  `NOMBRE_ZON` char(60) collate latin1_spanish_ci NOT NULL default '',
  PRIMARY KEY  (`SERIAL_ZON`),
  KEY `AK_CODIGO_ZON_IDX` (`CODIGO_ZON`),
  KEY `FK_REGIONZONA` (`SERIAL_REG`),
  CONSTRAINT `FK_REGIONZONA` FOREIGN KEY (`SERIAL_REG`) REFERENCES `region` (`SERIAL_REG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `zona`
--


/*!40000 ALTER TABLE `zona` DISABLE KEYS */;
LOCK TABLES `zona` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `zona` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

