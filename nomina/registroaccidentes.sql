-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-04-2008 a las 10:04:15
-- Versión del servidor: 4.1.18
-- Versión de PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de datos: `nutrileche`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroaccidentes`
--

CREATE TABLE IF NOT EXISTS `registroaccidentes` (
  `SERIAL_RAC` int(11) NOT NULL auto_increment,
  `SERIAL_EPL` int(20) default NULL,
  `CODIGO_RAC` char(20) NOT NULL default '',
  `FECHA_RAC` date NOT NULL default '0000-00-00',
  `DESCRIPCION_RAC` char(255) NOT NULL default '',
  `LUGAR_RAC` char(40) NOT NULL default '',
  `CAUSA_RAC` char(50) NOT NULL default '',
  `CLASIFICACION_RAC` char(30) default NULL,
  `CONSECUENCIA_RAC` char(50) NOT NULL default '',
  `ACCIONES_RAC` char(30) default NULL,
  `OBSERVACIONES_RAC` char(255) default NULL,
  `BAJA_RAC` char(2) NOT NULL default '',
  `TIEMPO_RAC` char(20) default NULL,
  `COSTO_RAC` decimal(16,2) default NULL,
  PRIMARY KEY  (`SERIAL_RAC`),
  KEY `FK_EMPLEADOFORMACIONACADEMICA` (`SERIAL_EPL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `registroaccidentes`
--

INSERT INTO `registroaccidentes` (`SERIAL_RAC`, `SERIAL_EPL`, `CODIGO_RAC`, `FECHA_RAC`, `DESCRIPCION_RAC`, `LUGAR_RAC`, `CAUSA_RAC`, `CLASIFICACION_RAC`, `CONSECUENCIA_RAC`, `ACCIONES_RAC`, `OBSERVACIONES_RAC`, `BAJA_RAC`, `TIEMPO_RAC`, `COSTO_RAC`) VALUES
(1, 8, 'RAC-01', '2008-04-25', 'ACCIDENTE MANEJANDO EQUIPO DE MEDICION', 'PASTEURIZACION', 'USO ANORMAL DE MAQUINA E INSTALACIONES', 'POR ATRAPAMIENTO', 'HERIDA', 'BOTIQUIN PRIMEROS AUXILIOS', 'NO', 'SI', '6 DIAS', 0.00),
(2, 45, 'RAC-2', '2008-04-25', 'ACCIDENTE EN COMPUTADOR, MALAS CONEXIONES ELECTRICAS', 'OFICINAS ADMINISTRATIVAS', 'ACTO INSEGURO - NO SABER', 'POR CONTACTO CON', 'QUEMADURA', 'BOTIQUIN PRIMEROS AUXILIOS', '', 'NO', '0 DIAS', 0.00);
