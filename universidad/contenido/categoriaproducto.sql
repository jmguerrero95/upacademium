# phpMyAdmin SQL Dump
# version 2.5.5
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Tiempo de generación: 12-03-2008 a las 23:41:40
# Versión del servidor: 5.0.41
# Versión de PHP: 5.1.2
# 
# Base de datos : `jdc`
# 

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `categoriaproducto`
#

CREATE TABLE `categoriaproducto` (
  `serial_cap` int(11) NOT NULL auto_increment,
  `codigo_cap` char(7) NOT NULL default '',
  `nombre_cap` char(50) NOT NULL default '',
  `descripcion_cap` char(200) NOT NULL default '',
  PRIMARY KEY  (`serial_cap`),
  KEY `AK_codigo_cap_idx` (`codigo_cap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

#
# Volcar la base de datos para la tabla `categoriaproducto`
#

INSERT INTO `categoriaproducto` VALUES (8, 'F-01', 'ACEITES Y MANTECAS', 'ACEITES Y MANTECAS');
INSERT INTO `categoriaproducto` VALUES (9, 'F-02', 'ADEREZOS Y VARIOS', 'ADEREZOS Y VARIOS');
INSERT INTO `categoriaproducto` VALUES (10, 'F-03', 'ABSOVENTES', 'ABSOVENTES');
INSERT INTO `categoriaproducto` VALUES (11, 'F-04', 'CUIDADO PERSONAL', 'CUIDADO PERSONAL');
INSERT INTO `categoriaproducto` VALUES (12, 'F-05', 'BEBIDAS ALCOHOLICAS', 'BEBIDAS ALCOHOLICAS');
INSERT INTO `categoriaproducto` VALUES (13, 'F-06', 'CONFITERIA', 'CONFITERIA');
INSERT INTO `categoriaproducto` VALUES (14, 'F-07', 'MATERIALES DE ASEO', 'MATERIALES DE ASEO');
INSERT INTO `categoriaproducto` VALUES (15, 'GBKJ', 'JOBL', 'JBNOKJ');
