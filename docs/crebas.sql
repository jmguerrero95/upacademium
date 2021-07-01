/*==============================================================*/
/* DBMS name:      MySQL 4.0                                    */
/* Created on:     08/07/2008 15:59:31                          */
/*==============================================================*/


drop index PERFILACCIONPROCESO_FK on ACCIONPROCESO;

drop index PROCESOSACCIONPROCESO_FK on ACCIONPROCESO;

drop table if exists ACCIONPROCESO;

drop index PROVEEDORACTIVOFIJO_FK on ACTIVOSFIJOS;

drop index TIPOACTIVOFIJOACTIVOFIJO_FK on ACTIVOSFIJOS;

drop index SUCURSALDEPARTAMENTOACTIVOFIJO_FK on ACTIVOSFIJOS;

drop table if exists ACTIVOSFIJOS;

drop table if exists ALUMNO;

drop index EMPLEADOANTICPOS_FK on ANTICIPOS;

drop index PERIODOROLANTICIPOS_FK on ANTICIPOS;

drop table if exists ANTICIPOS;

drop index PERFILAPROBACION_FK on APROBACION;

drop index PROCESOAPROBACION_FK on APROBACION;

drop table if exists APROBACION;

drop index SUCURSALDEPARTAMENTOSAREA_FK on AREA;

drop table if exists AREA;

drop index PROVEEDORASIGNACIONACTIVOSFIJOS_FK on ASIGNACIONACTIVOSFIJOS;

drop index ASIGNACIONACTIVOSFIJOSUBICACION_FK on ASIGNACIONACTIVOSFIJOS;

drop index EMPLEADOASIGNACIONACTIVOFIJO_FK on ASIGNACIONACTIVOSFIJOS;

drop index ACTIVOFIJOASIGNACIONACTIVOFIJO_FK on ASIGNACIONACTIVOSFIJOS;

drop table if exists ASIGNACIONACTIVOSFIJOS;

drop index EMPLEADOASISTENCIA_FK on ASISTENCIA;

drop table if exists ASISTENCIA;

drop index USUARIOAUDITORIA_FK on AUDITORIA;

drop table if exists AUDITORIA;

drop table if exists AUTORIZACION;

drop table if exists BANCO;

drop table if exists BENEFICIOSLEGALES;

drop index SUCURSALDEPARTAMENTOSBODEGA_FK on BODEGA;

drop index TIPOBODEGABODEGA_FK on BODEGA;

drop table if exists BODEGA;

drop index CAJAVENTASUCURSALDEPARTAMENTOS_FK on CAJAVENTA;

drop table if exists CAJAVENTA;

drop index PUNTOSCLIENTECALIFICACIONCLIENTE_FK on CALIFICACIONCLIENTE;

drop index CLIENTECALIFICACION_FK on CALIFICACIONCLIENTE;

drop index NIVELCALIFICACIONCALIFICACION_FK on CALIFICACIONCLIENTE;

drop table if exists CALIFICACIONCLIENTE;

drop index PROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR;

drop index PUNTOSPROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR;

drop index NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR;

drop table if exists CALIFICACIONPROVEEDOR;

drop table if exists CANAL;

drop index EMPLEADOCAPACITACIONPROFESIONAL_FK on CAPACITACIONPERSONAL;

drop table if exists CAPACITACIONPERSONAL;

drop index EMPLEADOCARGASFAMILIARES_FK on CARGASFAMILIARES;

drop table if exists CARGASFAMILIARES;

drop index JERARQUIACARGOS_FK on CARGOS;

drop index PERFILCOMPETENCIASCARGOS_FK on CARGOS;

drop table if exists CARGOS;

drop index FAMILIACATEGORIAPRODUCTO_FK on CATEGORIAPRODUCTO;

drop table if exists CATEGORIAPRODUCTO;

drop index PROVINCIACIUDAD_FK on CIUDAD;

drop table if exists CIUDAD;

drop table if exists CLASEACTIVOFIJO;

drop index FORMASCOBROCLIENTE_FK on CLIENTE;

drop index CLIENTECANAL_FK on CLIENTE;

drop index CIUDADCLIENTE_FK on CLIENTE;

drop index TIPOCLIENTECLIENTE_FK on CLIENTE;

drop index TIPOPRECIOSCLIENTE_FK on CLIENTE;

drop table if exists CLIENTE;

drop index CLIENTECLIENTECONTACTO_FK on CLIENTECONTACTO;

drop table if exists CLIENTECONTACTO;

drop index CLIENTECLIENTEREFERENCIAS_FK on CLIENTEREFERENCIAS;

drop table if exists CLIENTEREFERENCIAS;

drop index CLIENTECLIENTERUTA_FK on CLIENTERUTA;

drop index RUTACLIENTE_FK on CLIENTERUTA;

drop table if exists CLIENTERUTA;

drop index CLIENTECLIENTESUCURSAL_FK on CLIENTESUCURSAL;

drop table if exists CLIENTESUCURSAL;

drop table if exists COMBOPRODUCTO;

drop table if exists COMISIONES;

drop index PERIODOCONTABLECOMPROBANTE_FK on COMPROBANTE;

drop table if exists COMPROBANTE;

drop index PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR_FK on CONDICIONESNEGOCIACIONPROVEEDOR;

drop table if exists CONDICIONESNEGOCIACIONPROVEEDOR;

drop table if exists CONTACTOS;

drop index PROVEEDORPROVEEDORCONTACTOS_FK on CONTACTOSPROVEEDOR;

drop table if exists CONTACTOSPROVEEDOR;

drop table if exists CRITERIO;

drop table if exists DEPARTAMENTOS;

drop table if exists DEPRECIACIONES;

drop index CANALDESCUENTOCANAL_FK on DESCUENTOCANAL;

drop index PRODUCTODESCUENTOCANAL_FK on DESCUENTOCANAL;

drop table if exists DESCUENTOCANAL;

drop index CATEGORIAPRODUCTODESCUENTOCANTIDAD_FK on DESCUENTOCANTIDAD;

drop table if exists DESCUENTOCANTIDAD;

drop index USUARIODETALLEAPROBACIONES_FK on DETALLEAPROBACIONES;

drop index APROBACIONDETALLEAPROBACION_FK on DETALLEAPROBACIONES;

drop table if exists DETALLEAPROBACIONES;

drop index COMISIONESDETALLECOMISIONES_FK on DETALLECOMISIONES;

drop table if exists DETALLECOMISIONES;

drop index PLANCONTABLEDETALLECOMPROBANTE_FK on DETALLECOMPROBANTE;

drop index COMPROBANTEDETALLECOMPROBANTE_FK on DETALLECOMPROBANTE;

drop table if exists DETALLECOMPROBANTE;

drop index DETALLEDEPRECIACIONESACTIVOSFIJOS_FK on DETALLEDEPRECIACIONES;

drop index DEPRECIACIONESDETALLEDEPRECIACIONES_FK on DETALLEDEPRECIACIONES;

drop table if exists DETALLEDEPRECIACIONES;

drop index FACTURADETALLEFACTURA_FK on DETALLEFACTURA;

drop table if exists DETALLEFACTURA;

drop table if exists DETALLEGUIAREMISION;

drop index INGRESOEGRESOBODEGADETALLEIEB_FK on DETALLEINGRESOEGRESODEBODEGA;

drop table if exists DETALLEINGRESOEGRESODEBODEGA;

drop index PRODUCTODETALLEORDENCOMPRA_FK on DETALLEORDENDECOMPRA;

drop index ORDENDECOMPRADETALLEORDENDECOMPRA_FK on DETALLEORDENDECOMPRA;

drop table if exists DETALLEORDENDECOMPRA;

drop index ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO_FK on DETALLEORDENDEREQUERIMIENTO;

drop table if exists DETALLEORDENDEREQUERIMIENTO;

drop index PRODUCTODETALLEORDENPEDIDO_FK on DETALLEORDENPEDIDO;

drop index ORDENPEDIDODETALLEORDENPEDIDO_FK on DETALLEORDENPEDIDO;

drop table if exists DETALLEORDENPEDIDO;

drop index RUBROGENERALROLPAGOSDETALLEROLPAGOS_FK on DETALLEROLPAGOS;

drop index EMPLEADOROLPAGOSDETALLEROL_FK on DETALLEROLPAGOS;

drop table if exists DETALLEROLPAGOS;

drop index SOLICITUDDOTACIONDETALLESOLICITUD_FK on DETALLESOLICITUDDOTACION;

drop table if exists DETALLESOLICITUDDOTACION;

drop index INGRESOEGRESOBODEGADETALLETRASNPORTE_FK on DETALLETRANSPORTE;

drop table if exists DETALLETRANSPORTE;

drop table if exists DIASFERIADOS;

drop index EMPLEADODIASTRABAJADOS_FK on DIASTRABAJADOS;

drop index PERIODOROLDIASTRABAJADOS_FK on DIASTRABAJADOS;

drop table if exists DIASTRABAJADOS;

drop table if exists DOCPARALELOALUMO;

drop index INSTITUCIONESFINANCIERASEMPLEADO_FK on EMPLEADO;

drop index TURNOSEMPLEADO_FK on EMPLEADO;

drop index TIPOSCONTRATOSEMPLEADO_FK on EMPLEADO;

drop index ESCALAFONESEMPLEADO_FK on EMPLEADO;

drop index SUCURSALDEPARTAMENTOSEMPLEADO_FK on EMPLEADO;

drop table if exists EMPLEADO;

drop index PERIODOROLEMPLEADOROL_FK on EMPLEADOROLPAGOS;

drop index EMPLEADORUBROSEMPLEADO_FK on EMPLEADOROLPAGOS;

drop table if exists EMPLEADOROLPAGOS;

drop index PARROQUIAEMPRESA_FK on EMPRESA;

drop table if exists EMPRESA;

drop index TIPOESCALAFONESESCALAFONES_FK on ESCALAFONES;

drop index CARGOSESCALAFONES_FK on ESCALAFONES;

drop table if exists ESCALAFONES;

drop table if exists ESPECIALIDAD;

drop index EMPLEADOEXPERIENCIAPROFESIONAL_FK on EXPERIENCIAPROFESIONAL;

drop table if exists EXPERIENCIAPROFESIONAL;

drop index CLIENTEFACTURA_FK on FACTURA;

drop table if exists FACTURA;

drop index INGRESOEGRESOFACTURACOMPRA_FK on FACTURACOMPRA;

drop table if exists FACTURACOMPRA;

drop index FAMILIAACTIVOFIJOPLANCONTABLE_FK on FAMILIAACTIVOFIJO;

drop table if exists FAMILIAACTIVOFIJO;

drop table if exists FAMILIAPRODUCTO;

drop index EMPLEADOFORMACIONACADEMICA_FK on FORMACIONACADEMICA;

drop table if exists FORMACIONACADEMICA;

drop table if exists FORMACOBRO;

drop table if exists FORMASPAGO;

drop table if exists FORMULAS;

drop index ACTIVOSFIJOSGARANTIASACTIVOSFIJOS_FK on GARANTIASACTIVOSFIJOS;

drop table if exists GARANTIASACTIVOSFIJOS;

drop table if exists GUIAREMISION;

drop index CLIENTEHISTORIALCREDITOCLIENTE_FK on HISTORIALCREDITOCLIENTE;

drop table if exists HISTORIALCREDITOCLIENTE;

drop index EMPLEADOHORAEXTRA_FK on HORASEXTRA;

drop index PERIODOROLHORAEXTRA_FK on HORASEXTRA;

drop table if exists HORASEXTRA;

drop table if exists IMPUESTOS;

drop index TIPOINGRESOEGRESOINGRESOEGRESOBODEGA_FK on INGRESOEGRESODEBODEGA;

drop table if exists INGRESOEGRESODEBODEGA;

drop index CIUDADINSTITUCIONFINANCIERA_FK on INSTITUCIONESFINANCIERAS;

drop table if exists INSTITUCIONESFINANCIERAS;

drop table if exists JERARQUIA;

drop table if exists JUBILACIONPATRONAL;

drop table if exists LIBERACIONPRODUCTO;

drop index TIPOSPRECIOSLISTAPRECIOS_FK on LISTAPRECIOS;

drop index LISTAPRECIOSPRODUCTO_FK on LISTAPRECIOS;

drop table if exists LISTAPRECIOS;

drop index PRODUCTOMARCAPRODUCTO_FK on MARCAPRODUCTO;

drop table if exists MARCAPRODUCTO;

drop table if exists MATERIA_ALUMNO;

drop table if exists MATERIA_CRITERIO;

drop table if exists MODULOS;

drop table if exists NIVEL;

drop table if exists NIVELCALIFICACION;

drop table if exists NIVELCALIFICACIONPROVEEDOR;

drop index PERIODOROLNOVEDADES_FK on NOVEDADES;

drop index EMPLEADONOVEDADES_FK on NOVEDADES;

drop table if exists NOVEDADES;

drop index PROVEEDORORDENCOMPRA_FK on ORDENDECOMPRA;

drop index FORMASPAGOORDENDECOMPRA_FK on ORDENDECOMPRA;

drop table if exists ORDENDECOMPRA;

drop index AREAORDENDEREQUERIMIENTO_FK on ORDENDEREQUERIMIENTO;

drop index EMPLEADOORDENDEREQUERIMIENTO_FK on ORDENDEREQUERIMIENTO;

drop table if exists ORDENDEREQUERIMIENTO;

drop table if exists ORDENESEMBARQUE;

drop index FORMACOBROORDENPEDIDO_FK on ORDENPEDIDO;

drop index CLIENTEORDENPEDIDO_FK on ORDENPEDIDO;

drop table if exists ORDENPEDIDO;

drop table if exists PAIS;

drop table if exists PARALELO;

drop table if exists PARALELO_ALUMNO;

drop table if exists PARENTESCO;

drop index EMPLEADOPARENTESCOEMPLEADO_FK on PARENTESCOEMPLEADO;

drop index PARENTESCOPARENTESCOEMPLEADO_FK on PARENTESCOEMPLEADO;

drop table if exists PARENTESCOEMPLEADO;

drop index CIUDADPARROQUIA_FK on PARROQUIA;

drop table if exists PARROQUIA;

drop table if exists PERFIL;

drop table if exists PERFILCOMPETENCIAS;

drop table if exists PERIODOCONTABLE;

drop table if exists PERIODOROL;

drop index EMPLEADOPERMISOS_FK on PERMISOS;

drop table if exists PERMISOS;

drop index PLANPRESUPUESTOPLANCONTABLE_FK on PLANCONTABLE;

drop table if exists PLANCONTABLE;

drop table if exists PLANPRESUPUESTO;

drop index PLANCONTABLEPLANRETENCION_FK on PLANRETENCION;

drop table if exists PLANRETENCION;

drop index EMPLEADOPRESTAMOSEMPLEADOS_FK on PRESTAMOSEMPLEADO;

drop index PERIODOROLPRESTAMOSEMPLEADOS_FK on PRESTAMOSEMPLEADO;

drop table if exists PRESTAMOSEMPLEADO;

drop index MODULOSPROCESOS_FK on PROCESOS;

drop table if exists PROCESOS;

drop index PROVEEDORPRODUCTO_FK on PRODUCTO;

drop index TIPOPRODUCTOPRODUCTO_FK on PRODUCTO;

drop table if exists PRODUCTO;

drop table if exists PRODUCTOBODEGA;

drop index PROMOCIONESPROVEEDORPRODUCTO_FK on PROMOCIONESPROVEEDOR;

drop index PROVEEDORPROMOCIONESPROVEEDOR_FK on PROMOCIONESPROVEEDOR;

drop table if exists PROMOCIONESPROVEEDOR;

drop index CIUDADPROVEEDOR_FK on PROVEEDOR;

drop index TIPOPROVEEDORPROVEEDOR_FK on PROVEEDOR;

drop table if exists PROVEEDOR;

drop index PROVEEDORPROVEEDORESPRODUCTO_FK on PROVEEDORESPRODUCTO;

drop index PROVEEDORESPRODUCTOPRODUCTO_FK on PROVEEDORESPRODUCTO;

drop table if exists PROVEEDORESPRODUCTO;

drop index PROVEEDORPROVEEDORREBATES_FK on PROVEEDORREBATES;

drop table if exists PROVEEDORREBATES;

drop index TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO_FK on PROVEEDORTIPOACTIVOFIJO;

drop index PROVEEDORPROVEEDORTIPOACTIVOFIJO_FK on PROVEEDORTIPOACTIVOFIJO;

drop table if exists PROVEEDORTIPOACTIVOFIJO;

drop index PAISPROVINCIA_FK on PROVINCIA;

drop table if exists PROVINCIA;

drop table if exists PUNTOSCLIENTE;

drop table if exists PUNTOSPROVEEDOR;

drop table if exists REGION;

drop index EMPLEADOREGISTROACCIDENTES_FK on REGISTROACCIDENTES;

drop table if exists REGISTROACCIDENTES;

drop index TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS_FK on REGISTROQUEJASSUGERENCIAS;

drop table if exists REGISTROQUEJASSUGERENCIAS;

drop index PERIODOROLROLPAGOSGENERAL_FK on ROLPAGOSGENERAL;

drop table if exists ROLPAGOSGENERAL;

drop index PLANCONTABLERUBROGENERALROLPAGOS_FK on RUBROGENERALROLPAGOS;

drop index TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS_FK on RUBROGENERALROLPAGOS;

drop table if exists RUBROGENERALROLPAGOS;

drop index ZONARUTA_FK on RUTA;

drop table if exists RUTA;

drop index AREASOLICITUDDOTACION_FK on SOLICITUDDOTACION;

drop index EMPLEADOSOLICITUDDOTACION_FK on SOLICITUDDOTACION;

drop table if exists SOLICITUDDOTACION;

drop index EMPRESASUCURSAL_FK on SUCURSAL;

drop index CIUDADSUCURSAL_FK on SUCURSAL;

drop table if exists SUCURSAL;

drop index DEPARTAMENTOSUCURSALDEPARTAMENTO_FK on SUCURSALDEPARTAMENTOS;

drop index SUCURSALSUCURSALDEPARTAMENTO_FK on SUCURSALDEPARTAMENTOS;

drop table if exists SUCURSALDEPARTAMENTOS;

drop table if exists TABLACASTIGOCOMISIONES;

drop index CARGOSTABLACOMISIONESCARGO_FK on TABLACOMISIONESCARGO;

drop table if exists TABLACOMISIONESCARGO;

drop index TIPOCLIENTETABLACOMISIONPRODUCTO_FK on TABLACOMISIONESPRODUCTO;

drop index PRODUCTOTABLACOMISIONESPRODUCTO_FK on TABLACOMISIONESPRODUCTO;

drop table if exists TABLACOMISIONESPRODUCTO;

drop table if exists TABLAIMPUESTORENTA;

drop table if exists TABLALIQUIDACION;

drop index EMPLEADOTABLASRI_FK on TABLASRI;

drop index PERIODOROLTABLASRI_FK on TABLASRI;

drop table if exists TABLASRI;

drop index PAISTASAS_FK on TASAS;

drop index TIPOTASASTASAS_FK on TASAS;

drop table if exists TASAS;

drop table if exists TEMPLATE;

drop index PROVEEDORTERCIARIZADORA_FK on TERCIARIZADORA;

drop table if exists TERCIARIZADORA;

drop index CLASEACTIVOFIJOTIPOACTIVOFIJO_FK on TIPOACTIVOFIJO;

drop index FAMILIAACTIVOFIJOTIPOACTIVOFIJO_FK on TIPOACTIVOFIJO;

drop table if exists TIPOACTIVOFIJO;

drop table if exists TIPOBODEGA;

drop table if exists TIPOCLIENTE;

drop table if exists TIPOCOMPRA;

drop table if exists TIPOCOMPROBANTE;

drop table if exists TIPOCONTRATOSTRABAJO;

drop table if exists TIPOESCALAFONES;

drop table if exists TIPOINGRESOEGRESOBODEGA;

drop index CATEGORIAPRODUCTOTIPOPRODUCTO_FK on TIPOPRODUCTO;

drop table if exists TIPOPRODUCTO;

drop index PLANCONTABLETIPOPROVEEDOR_FK on TIPOPROVEEDOR;

drop table if exists TIPOPROVEEDOR;

drop table if exists TIPOSPRECIOS;

drop table if exists TIPOSQUEJASSUGERENCIAS;

drop table if exists TIPOTASAS;

drop table if exists TURNOS;

drop index SUCURSALDEPARTAMENTOSUBICACION_FK on UBICACION;

drop table if exists UBICACION;

drop index BODEGAUBICACIONBODEGA_FK on UBICACIONBODEGA;

drop table if exists UBICACIONBODEGA;

drop table if exists UNIDADMEDIDA;

drop index PERFILUSUARIO_FK on USUARIO;

drop table if exists USUARIO;

drop index SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL_FK on USUARIOSUCURSAL;

drop index USUARIOUSUARIOSUCURSAL_FK on USUARIOSUCURSAL;

drop table if exists USUARIOSUCURSAL;

drop index MODULOSVARIABLESMODULO_FK on VARIABLESMODULO;

drop table if exists VARIABLESMODULO;

drop index REGIONZONA_FK on ZONA;

drop table if exists ZONA;

/*==============================================================*/
/* Table: ACCIONPROCESO                                         */
/*==============================================================*/
create table ACCIONPROCESO
(
   SERIAL_ACP                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PFL                     int(11),
   SERIAL_PRC                     int,
   INSERTAR_ACP                   char(2)                        not null,
   EDITAR_ACP                     char(2)                        not null,
   BUSCAR_ACP                     char(2)                        not null,
   ELIMINAR_ACP                   char(2)                        not null,
   ENVIOCORREO_ACP                char(2)                        not null,
   GRAFICAR_ACP                   char(2)                        not null,
   IMPRIMIR_ACP                   char(2)                        not null,
   AYUDA_ACP                      char(2)                        not null,
   ACERCADE_ACP                   char(2)                        not null,
   SALIR_ACP                      char(2)                        not null,
   INICIO_ACP                     char(2)                        not null,
   PRINCIPIO_ACP                  char(2)                        not null,
   ANTERIOR_ACP                   char(2)                        not null,
   SIGUIENTE_ACP                  char(2)                        not null,
   ULTIMO_ACP                     char(2)                        not null,
   ENVIOEXCEL_ACP                 char(2)                        not null,
   ENVIOXML_ACP                   char(2)                        not null,
   FILTRAR_ACP                    char(2)                        not null,
   GUARDAR_ACP                    char(2)                        not null,
   CANCELAR_ACP                   char(2)                        not null,
   NAVEGAR_ACP                    char(2)                        not null,
   APROBARDOCUMENTO_ACP           char(2)                        not null,
   APROBARCUPOPLAZO_ACP           char(2)                        not null,
   ANULAR_ACP                     char(2)                        not null,
   REVERSARCOMPROBANTES_ACP       char(2)                        not null,
   CONSOLIDARCIERREPERIODO_ACP    char(2)                        not null,
   MAYORIZARPRESUPUESTO_ACP       char(2)                        not null,
   ABRIRPRESUPUESTO_ACP           char(2)                        not null,
   PRESUPUESTOANUAL_ACP           char(2)                        not null,
   PRESUPUESTOPERIODO_ACP         char(2)                        not null,
   CERRARPRESUPUESTO_ACP          char(2)                        not null,
   BAJAREXCEL_ACP                 char(2)                        not null,
   SUBIREXCEL_ACP                 char(2)                        not null,
   FICHAPERSONAL_ACP              char(2)                        not null,
   DEPOSITAR_ACP                  char(2),
   EFECTIVIZAR_ACP                char(2),
   PROTESTAR_ACP                  char(2),
   DEPOSITOEFECTIVO_ACP           char(2),
   ANULARDOCUMENTO_ACP            char(2),
   CLIENTEMOROSO_ACP              char(2),
   IMPRIMIRCOMPROBANTE_ACP        char(2),
   IMPRIMIRCHEQUE_ACP             char(2),
   ANULARCHEQUE_ACP               char(2),
   ACCION11_ACP                   char(2),
   ACCION12_ACP                   char(2),
   ACCION13_ACP                   char(2),
   ACCION14_ACP                   char(2),
   ACCION15_ACP                   char(2),
   primary key (SERIAL_ACP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROCESOSACCIONPROCESO_FK                              */
/*==============================================================*/
create index PROCESOSACCIONPROCESO_FK on ACCIONPROCESO
(
   SERIAL_PRC
);

/*==============================================================*/
/* Index: PERFILACCIONPROCESO_FK                                */
/*==============================================================*/
create index PERFILACCIONPROCESO_FK on ACCIONPROCESO
(
   SERIAL_PFL
);

/*==============================================================*/
/* Table: ACTIVOSFIJOS                                          */
/*==============================================================*/
create table ACTIVOSFIJOS
(
   SERIAL_ACF                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   SERIAL_DESC                    int(11),
   SERIAL_TAF                     int,
   CODIGO_ACF                     char(10)                       not null,
   CODIGOBARRAS_ACF               char(13),
   NOMBRE_ACF                     char(80)                       not null,
   DESCRIPCION_ACF                char(200)                      not null,
   VALOR_ACF                      decimal(16,2)                  not null,
   FECHA_ACF                      date                           not null,
   NUMEROFACTURACOMPRA_ACF        char(15),
   MARCA_ACF                      char(40)                       not null,
   MODELO_ACF                     char(40)                       not null,
   SERIE_ACF                      char(40)                       not null,
   FECHADEPRECIACION_ACF          date,
   TANGIBLE_ACF                   char(2)                        not null,
   CONTROL_ACF                    char(2),
   FECHABAJAINVENTARIO_ACF        date,
   VALORREEXPRESION_ACF           decimal(16,2),
   VALORREPOSICION_ACF            decimal(16,2),
   METROLOGIA_ACF                 char(20),
   DEPRECIACIONACUMULADA_ACF      decimal(16,2),
   FECHADEPRECIACIONACUMULADA_ACF date,
   ESTADO_ACF                     char(10)                       not null,
   VIDAUTIL_ACF                   int,
   TIPODEPRECIACION_ACF           char(20),
   TIPO_ACF                       char(20),
   ATRIBUTO1_ACF                  char(50),
   ATRIBUTO2_ACF                  char(50),
   ATRIBUTO3_ACF                  char(50),
   ATRIBUTO4_ACF                  char(50),
   ATRIBUTO5_ACF                  char(50),
   ATRIBUTO6_ACF                  char(50),
   ATRIBUTO7_ACF                  char(50),
   ATRIBUTO8_ACF                  char(50),
   FECHAREGISTRO_ACF              date,
   DEPRECIACIONINICIAL_ACF        decimal(16,2),
   MOTIVOBAJA_ACF                 char(30),
   OBSERVACIONES_ACF              varchar(255),
   TIEMPOUSO_ACF                  int,
   TIEMPORESTANTE_ACF             int,
   SERIAL_COM                     int,
   SERIAL_UBI                     int,
   SERIAL_EPL                     int,
   primary key (SERIAL_ACF),
   key AK_CODIGO_ACF_IDX (CODIGO_ACF),
   key AK_NOMBRE_ACF_IDX (NOMBRE_ACF, SERIE_ACF),
   key AK_CODIGOBARRAS_ACF_IDX (CODIGOBARRAS_ACF)
)
type = InnoDB;

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOACTIVOFIJO_FK                     */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOACTIVOFIJO_FK on ACTIVOSFIJOS
(
   SERIAL_DESC
);

/*==============================================================*/
/* Index: TIPOACTIVOFIJOACTIVOFIJO_FK                           */
/*==============================================================*/
create index TIPOACTIVOFIJOACTIVOFIJO_FK on ACTIVOSFIJOS
(
   SERIAL_TAF
);

/*==============================================================*/
/* Index: PROVEEDORACTIVOFIJO_FK                                */
/*==============================================================*/
create index PROVEEDORACTIVOFIJO_FK on ACTIVOSFIJOS
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: ALUMNO                                                */
/*==============================================================*/
create table ALUMNO
(
   serial_alu                     int(11)                        not null AUTO_INCREMENT,
   serial_nac                     int(11)                        default NULL,
   serial_col                     int(11)                        default NULL,
   serial_sex                     int(11)                        default NULL,
   serial_tra                     int(11)                        default NULL,
   serial_can                     int(11)                        default NULL,
   serial_pai                     int(11)                        default NULL,
   nombre_alu                     char(30)                       not null default '',
   apellido_alu                   char(40)                       not null default '',
   tipoIdentificacion_alu         char(1)                        default NULL,
   codigoIdentificacion_alu       char(50)                       default NULL,
   fecnac_alu                     date                           default NULL,
   direcc_alu                     char(80)                       default NULL,
   mail_alu                       char(50)                       default NULL,
   telefo_alu                     char(50)                       default NULL,
   busRetorno_alu                 int(11)                        default NULL,
   conQuienVive_alu               char(1)                        default NULL,
   fechaIngreso_alu               date                           default NULL,
   observacion_alu                char(255)                      default NULL,
   fechaObs_alu                   date                           default NULL,
   foto_alu                       char(255)                      default NULL,
   estado_alu                     char(1)                        default NULL,
   paseObs_alu                    char(255)                      default NULL,
   cursoAprobado_alu              char(50)                       default NULL,
   seccionAprobado_alu            char(50)                       default NULL,
   id_alumno                      char(15)                       not null default '',
   primary key (serial_alu),
   key codigoIdentificacion_alu_idx (codigoIdentificacion_alu)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Table: ANTICIPOS                                             */
/*==============================================================*/
create table ANTICIPOS
(
   SERIAL_ANT                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   SERIAL_EPL                     int(20),
   NOMBRE_ANT                     char(255)                      not null default '',
   VALOR_ANT                      double                         not null default 0.00,
   FECHA_ANT                      date                           not null default '0000-00-00',
   ESTADO_ANT                     char(20)                       not null default '',
   OBSERVACION_ANT                char(255)                      default NULL,
   primary key (SERIAL_ANT),
   key AK_FECHA_ANT_IDX (FECHA_ANT)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLANTICIPOS_FK                                */
/*==============================================================*/
create index PERIODOROLANTICIPOS_FK on ANTICIPOS
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Index: EMPLEADOANTICPOS_FK                                   */
/*==============================================================*/
create index EMPLEADOANTICPOS_FK on ANTICIPOS
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: APROBACION                                            */
/*==============================================================*/
create table APROBACION
(
   SERIAL_APR                     int                            not null AUTO_INCREMENT,
   SERIAL_PRC                     int,
   SERIAL_PFL                     int(11),
   NOMBRE_APR                     char(50)                       not null,
   CUPO_APR                       decimal(16,2),
   PLAZO_APR                      int,
   SECUENCIA_APR                  int,
   primary key (SERIAL_APR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROCESOAPROBACION_FK                                  */
/*==============================================================*/
create index PROCESOAPROBACION_FK on APROBACION
(
   SERIAL_PRC
);

/*==============================================================*/
/* Index: PERFILAPROBACION_FK                                   */
/*==============================================================*/
create index PERFILAPROBACION_FK on APROBACION
(
   SERIAL_PFL
);

/*==============================================================*/
/* Table: AREA                                                  */
/*==============================================================*/
create table AREA
(
   SERIAL_ARE                     int                            not null AUTO_INCREMENT,
   SERIAL_DESC                    int(11),
   CODIGO_ARE                     char(10),
   NOMBRE_ARE                     char(45),
   primary key (SERIAL_ARE)
)
type = InnoDB;

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOSAREA_FK                          */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOSAREA_FK on AREA
(
   SERIAL_DESC
);

/*==============================================================*/
/* Table: ASIGNACIONACTIVOSFIJOS                                */
/*==============================================================*/
create table ASIGNACIONACTIVOSFIJOS
(
   SERIAL_ASAF                    int                            not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   SERIAL_PVD                     int,
   SERIAL_ACF                     int,
   SERIAL_UBI                     int(11),
   FECHA_ASAF                     date,
   ESTADO_ASAF                    char(10),
   FECHARECEPCION_ASAF            date,
   FECHAENTREGA_ASAF              date,
   ELABORADOPOR_ASAF              int,
   MODIFICADOPOR_ASAF             int,
   FECHAMODIFICACION_ASAF         date,
   APROBADOPOR_ASAF               int,
   FECHAAPROBACION_ASAF           date,
   ENCUSTODIA_ASAF                char(2),
   OBSERVACION_ASAF               varchar(255),
   TIPO_ASAF                      char(20),
   UBICACION_ASAF                 char(100),
   CUSTODIOENTREGA_ASAF           int,
   TIPOGARANTIA_ASAF              char(25),
   NUMEROGARANTIA_ASAF            char(25),
   primary key (SERIAL_ASAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: ACTIVOFIJOASIGNACIONACTIVOFIJO_FK                     */
/*==============================================================*/
create index ACTIVOFIJOASIGNACIONACTIVOFIJO_FK on ASIGNACIONACTIVOSFIJOS
(
   SERIAL_ACF
);

/*==============================================================*/
/* Index: EMPLEADOASIGNACIONACTIVOFIJO_FK                       */
/*==============================================================*/
create index EMPLEADOASIGNACIONACTIVOFIJO_FK on ASIGNACIONACTIVOSFIJOS
(
   SERIAL_EPL
);

/*==============================================================*/
/* Index: ASIGNACIONACTIVOSFIJOSUBICACION_FK                    */
/*==============================================================*/
create index ASIGNACIONACTIVOSFIJOSUBICACION_FK on ASIGNACIONACTIVOSFIJOS
(
   SERIAL_UBI
);

/*==============================================================*/
/* Index: PROVEEDORASIGNACIONACTIVOSFIJOS_FK                    */
/*==============================================================*/
create index PROVEEDORASIGNACIONACTIVOSFIJOS_FK on ASIGNACIONACTIVOSFIJOS
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: ASISTENCIA                                            */
/*==============================================================*/
create table ASISTENCIA
(
   SERIAL_ASI                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   FECHA_ASI                      date                           not null default '0000-00-00',
   ENTRADA_ASI                    char(12)                       not null default '',
   SALIDA_ASI                     char(12)                       not null default '',
   ESTADO_ASI                     char(20)                       not null default '',
   ATRASO_ASI                     int,
   PERMISO_ASI                    int,
   primary key (SERIAL_ASI),
   key AK_FECHA_ASI_IDX (FECHA_ASI)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOASISTENCIA_FK                                 */
/*==============================================================*/
create index EMPLEADOASISTENCIA_FK on ASISTENCIA
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: AUDITORIA                                             */
/*==============================================================*/
create table AUDITORIA
(
   SERIAL_AUD                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_USR                     int(11),
   FECHA_AUD                      date                           not null default '0000-00-00',
   HORA_AUD                       time                           not null default '00:00:00',
   ACCION_AUD                     char(25)                       not null default '',
   INSTRUCCION_AUD                char(255)                      not null default '',
   DIRECCIONIP_AUD                char(20)                       not null default '',
   PROCESO_AUD                    int,
   primary key (SERIAL_AUD),
   key AK_FECHA_AUD_IDX (FECHA_AUD)
)
type = InnoDB;

/*==============================================================*/
/* Index: USUARIOAUDITORIA_FK                                   */
/*==============================================================*/
create index USUARIOAUDITORIA_FK on AUDITORIA
(
   SERIAL_USR
);

/*==============================================================*/
/* Table: AUTORIZACION                                          */
/*==============================================================*/
create table AUTORIZACION
(
   serial_aut                     int(11)                        not null AUTO_INCREMENT,
   serial_alu                     int(11)                        default NULL,
   serial_per                     int(11)                        default NULL,
   serial_niv                     int(11)                        default NULL,
   autorizado_aut                 char(1)                        default NULL,
   observacion_aut                char(80)                       default NULL,
   serialUsuario_aut              int(11)                        default NULL,
   nombreUsuario_aut              char(255)                      default NULL,
   serialUsrCursoAut_aut          int(11)                        default NULL,
   nombreUsrCursoAut_aut          char(255)                      default NULL,
   primary key (serial_aut),
   key Relationship_124_FK (serial_alu),
   key periodoAutorizacion_FK (serial_per),
   key nivelAutorizacion_FK (serial_niv)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "AUTORIZACION_IBFK_1_FK"                                            */
/*==============================================================*/
create index AUTORIZACION_IBFK_1_FK
(
   serial_alu
);

/*==============================================================*/
/* Table: BANCO                                                 */
/*==============================================================*/
create table BANCO
(
   serial_ban                     int(11)                        not null AUTO_INCREMENT,
   codigo_ban                     char(15)                       not null default '',
   nombre_ban                     char(255)                      not null default '',
   generaArchivo_ban              char(1)                        default NULL,
   primary key (serial_ban),
   unique key codigo_ban_idx (codigo_ban)
)
ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Table: BENEFICIOSLEGALES                                     */
/*==============================================================*/
create table BENEFICIOSLEGALES
(
   SERIAL_BEL                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_BEL                     char(7)                        not null,
   NOMBRE_BEL                     char(100)                      not null,
   DESCRIPCION_BEL                text,
   TIPOVALOR_BEL                  char(15)                       not null,
   VALOR_BEL                      decimal(16,2)                  not null,
   BASECALCULO_BEL                char(20)                       not null,
   TIPOBENEFICIO_BEL              char(5)                        not null,
   VIGENTEHASTA_BEL               date,
   ESTADO_BEL                     char(10)                       not null,
   primary key (SERIAL_BEL),
   key AK_CODIGO_BEL_IDX (CODIGO_BEL)
)
type = InnoDB;

/*==============================================================*/
/* Table: BODEGA                                                */
/*==============================================================*/
create table BODEGA
(
   SERIAL_BOD                     int                            not null AUTO_INCREMENT,
   SERIAL_DESC                    int(11),
   SERIAL_TBO                     int,
   CODIGO_BOD                     char(7)                        not null,
   NOMBRE_BOD                     char(30)                       not null,
   DESCRIPCION_BOD                char(255)                      not null,
   UBICACION_BOD                  char(64)                       not null,
   primary key (SERIAL_BOD),
   key AK_CODIGO_BOD_IDX (CODIGO_BOD)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOBODEGABODEGA_FK                                   */
/*==============================================================*/
create index TIPOBODEGABODEGA_FK on BODEGA
(
   SERIAL_TBO
);

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOSBODEGA_FK                        */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOSBODEGA_FK on BODEGA
(
   SERIAL_DESC
);

/*==============================================================*/
/* Table: CAJAVENTA                                             */
/*==============================================================*/
create table CAJAVENTA
(
   SERIAL_CAJV                    int                            not null AUTO_INCREMENT,
   SERIAL_DESC                    int(11),
   CODIGO_CAJ                     char(6)                        not null,
   NOMBRE_CAJ                     char(60)                       not null,
   DESCRIPCION_CAJ                char(75)                       not null,
   CAJERO_CAJ                     int                            not null,
   primary key (SERIAL_CAJV),
   key AK_CODIGO_CAJ_IDX (CODIGO_CAJ)
)
type = InnoDB;

/*==============================================================*/
/* Index: CAJAVENTASUCURSALDEPARTAMENTOS_FK                     */
/*==============================================================*/
create index CAJAVENTASUCURSALDEPARTAMENTOS_FK on CAJAVENTA
(
   SERIAL_DESC
);

/*==============================================================*/
/* Table: CALIFICACIONCLIENTE                                   */
/*==============================================================*/
create table CALIFICACIONCLIENTE
(
   SERIAL_CAL                     int                            not null AUTO_INCREMENT,
   SERIAL_NIVC                    int,
   SERIAL_PTO                     int,
   SERIAL_CLI                     int,
   CALIFICACION_CAL               int,
   FECHA_CAL                      datetime,
   DOCUMENTOGENERA_CAL            int,
   CREADOPOR_CAL                  int,
   primary key (SERIAL_CAL)
)
type = InnoDB;

/*==============================================================*/
/* Index: NIVELCALIFICACIONCALIFICACION_FK                      */
/*==============================================================*/
create index NIVELCALIFICACIONCALIFICACION_FK on CALIFICACIONCLIENTE
(
   SERIAL_NIVC
);

/*==============================================================*/
/* Index: CLIENTECALIFICACION_FK                                */
/*==============================================================*/
create index CLIENTECALIFICACION_FK on CALIFICACIONCLIENTE
(
   SERIAL_CLI
);

/*==============================================================*/
/* Index: PUNTOSCLIENTECALIFICACIONCLIENTE_FK                   */
/*==============================================================*/
create index PUNTOSCLIENTECALIFICACIONCLIENTE_FK on CALIFICACIONCLIENTE
(
   SERIAL_PTO
);

/*==============================================================*/
/* Table: CALIFICACIONPROVEEDOR                                 */
/*==============================================================*/
create table CALIFICACIONPROVEEDOR
(
   SERIAL_CPVD                    int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   SERIAL_NIVCP                   int,
   SERIAL_PTP                     int,
   CALIFICACIONCREDITO_CPVD       int                            not null,
   CALIFICACION_CPVD              int,
   FECHA_CPVD                     datetime                       not null,
   DOCUMENTOGENERA_CPVD           int,
   CREADOPOR_CPVD                 int                            not null,
   primary key (SERIAL_CPVD)
)
type = InnoDB;

/*==============================================================*/
/* Index: NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR_FK    */
/*==============================================================*/
create index NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR
(
   SERIAL_NIVCP
);

/*==============================================================*/
/* Index: PUNTOSPROVEEDORCALIFICACIONPROVEEDOR_FK               */
/*==============================================================*/
create index PUNTOSPROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR
(
   SERIAL_PTP
);

/*==============================================================*/
/* Index: PROVEEDORCALIFICACIONPROVEEDOR_FK                     */
/*==============================================================*/
create index PROVEEDORCALIFICACIONPROVEEDOR_FK on CALIFICACIONPROVEEDOR
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: CANAL                                                 */
/*==============================================================*/
create table CANAL
(
   SERIAL_CAN                     int                            not null AUTO_INCREMENT,
   CODIGO_CAN                     char(6)                        not null,
   NOMBRE_CAN                     char(40)                       not null,
   primary key (SERIAL_CAN),
   key AK_CODIGO_CAN_IDX (CODIGO_CAN)
)
type = InnoDB;

/*==============================================================*/
/* Table: CAPACITACIONPERSONAL                                  */
/*==============================================================*/
create table CAPACITACIONPERSONAL
(
   SERIAL_CAP                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   FECHAINICIO_CAP                date                           not null,
   DESCRIPCION_CAP                char(100)                      not null,
   INSTRUCTOR_CAP                 char(100)                      not null,
   INSTITUCION_CAP                char(100)                      not null,
   NOMBRECERTIFICADO_CAP          char(100)                      not null,
   DURACION_CAP                   char(20)                       not null,
   COSTO_CAP                      decimal(16,2)                  not null,
   TIPO_CAP                       char(30)                       not null,
   FECHAFIN_CAP                   date,
   CIUDAD_CAP                     char(30),
   BECA_CAP                       char(2),
   primary key (SERIAL_CAP),
   key AK_FECHA_CAP_IDX (FECHAINICIO_CAP)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOCAPACITACIONPROFESIONAL_FK                    */
/*==============================================================*/
create index EMPLEADOCAPACITACIONPROFESIONAL_FK on CAPACITACIONPERSONAL
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: CARGASFAMILIARES                                      */
/*==============================================================*/
create table CARGASFAMILIARES
(
   SERIAL_CAF                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   NOMBRE_CAF                     char(60)                       not null,
   APELLIDO_CAF                   char(60)                       not null,
   FECHANACIMIENTO_CAF            date                           not null,
   SEXO_CAF                       char(10)                       not null,
   BENEFICIARIO_CAF               char(2)                        not null,
   PARENTESCO_CAF                 char(25),
   EDAD_CAF                       int,
   primary key (SERIAL_CAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOCARGASFAMILIARES_FK                           */
/*==============================================================*/
create index EMPLEADOCARGASFAMILIARES_FK on CARGASFAMILIARES
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: CARGOS                                                */
/*==============================================================*/
create table CARGOS
(
   SERIAL_CAR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PEC                     int(11),
   SERIAL_JER                     int(11),
   CODIGO_CAR                     char(7)                        not null,
   NOMBRE_CAR                     char(50)                       not null,
   SUPERVISADOPOR_CAR             int                            not null,
   CODIGOIESS_CAR                 char(15),
   primary key (SERIAL_CAR),
   key AK_CODIGO_CAR_IDX (CODIGO_CAR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERFILCOMPETENCIASCARGOS_FK                           */
/*==============================================================*/
create index PERFILCOMPETENCIASCARGOS_FK on CARGOS
(
   SERIAL_PEC
);

/*==============================================================*/
/* Index: JERARQUIACARGOS_FK                                    */
/*==============================================================*/
create index JERARQUIACARGOS_FK on CARGOS
(
   SERIAL_JER
);

/*==============================================================*/
/* Table: CATEGORIAPRODUCTO                                     */
/*==============================================================*/
create table CATEGORIAPRODUCTO
(
   SERIAL_CAP                     int                            not null AUTO_INCREMENT,
   SERIAL_FAP                     int,
   CODIGO_CAP                     char(7)                        not null,
   NOMBRE_CAP                     char(50)                       not null,
   DESCRIPCION_CAP                char(200)                      not null,
   primary key (SERIAL_CAP),
   key AK_CODIGO_CAP_IDX (CODIGO_CAP)
)
type = InnoDB;

/*==============================================================*/
/* Index: FAMILIACATEGORIAPRODUCTO_FK                           */
/*==============================================================*/
create index FAMILIACATEGORIAPRODUCTO_FK on CATEGORIAPRODUCTO
(
   SERIAL_FAP
);

/*==============================================================*/
/* Table: CIUDAD                                                */
/*==============================================================*/
create table CIUDAD
(
   SERIAL_CIU                     int                            not null AUTO_INCREMENT,
   SERIAL_PRV                     int,
   CODIGO_CIU                     char(20)                       not null,
   NOMBRE_CIU                     char(60)                       not null,
   POBLACION_CIU                  int,
   OBSERVACIONES_CIU              char(255),
   LUNES_CIU                      char(2),
   MARTES_CIU                     char(2),
   MIERCOLES_CIU                  char(2),
   JUEVES_CIU                     char(2),
   VIERNES_CIU                    char(2),
   SABADO_CIU                     char(2),
   DOMINGO_CIU                    char(2),
   FECHACANTONIZACION_CIU         date,
   DIAFESTIVO_CIU                 date,
   primary key (SERIAL_CIU),
   key AK_CODIGO_CIU_IDX (CODIGO_CIU)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVINCIACIUDAD_FK                                    */
/*==============================================================*/
create index PROVINCIACIUDAD_FK on CIUDAD
(
   SERIAL_PRV
);

/*==============================================================*/
/* Table: CLASEACTIVOFIJO                                       */
/*==============================================================*/
create table CLASEACTIVOFIJO
(
   SERIAL_CLAF                    int                            not null AUTO_INCREMENT,
   CODIGO_CLAF                    char(10),
   NOMBRE_CLAF                    char(40),
   primary key (SERIAL_CLAF),
   key AK_CODIGO_CLAF_IDX (CODIGO_CLAF)
)
type = InnoDB;

/*==============================================================*/
/* Table: CLIENTE                                               */
/*==============================================================*/
create table CLIENTE
(
   SERIAL_CLI                     int                            not null AUTO_INCREMENT,
   SERIAL_FORC                    int,
   SERIAL_CIU                     int,
   SERIAL_CAN                     int,
   SERIAL_TIP                     int,
   SERIAL_TPR                     int,
   CODIGO_CLI                     char(20)                       not null,
   CODIGOANTERIOR_CLI             char(20),
   PERSONAJURIDICA_CLI            char(20)                       not null,
   NOMBRE_CLI                     char(60),
   APELLIDO_CLI                   char(60),
   RAZONSOCIAL_CLI                char(100)                      not null,
   NOMBREREPRESENTANTE_CLI        char(60),
   APELLIDOREPRESENTANTE_CLI      char(60),
   DOCUMENTOIDENTIDAD_CLI         char(13)                       not null,
   TIPODOCUMENTO_CLI              char(20)                       not null,
   UBICACIONX_CLI                 decimal(5,2),
   UBACACIONY_CLI                 decimal(5,2),
   DIRECCION_CLI                  char(255)                      not null,
   NUMEROCASA_CLI                 char(10),
   TELEFONOCOM1_CLI               char(12),
   TELEFONOCOM2_CLI               char(12),
   FAX_CLI                        char(12),
   CELULAR_CLI                    char(12),
   CORREOELECTRONICOCLIENTE_CLI   char(100),
   DESCUENTO_CLI                  decimal(5,2),
   NOMBRECONTACTOCOMPRAS_CLI      char(60),
   APELLIDOCONTACTOCOMPRAS_CLI    char(60),
   TELEFONOCOMPRAS_CLI            char(12),
   CELULARCOMPRAS_CLI             char(12),
   CORREOELECTRONICOCOMPRAS_CLI   char(100),
   NOMBRECONTACTOPAGOS_CLI        char(60),
   APELLIDOCONTACTOPAGOS_CLI      char(60),
   TELEFONOPAGOS_CLI              char(12),
   CELULARPAGOS_CLI               char(12),
   CORREOELECTRONICOPAGOS_CLI     char(100),
   COMISIONVENTA_CLI              char(2),
   COMISIONCOBRO_CLI              char(2),
   CUMPLEANOSPAGOS_CLI            date,
   CLIENTEDESDE_CLI               date,
   FECHAINICIOSRI_CLI             date,
   ACTIVIDADECONOMICASRI_CLI      char(255),
   TIPOSRI_CLI                    char(30),
   ESTADOSRI_CLI                  char(30),
   ESTADO_CLI                     char(10)                       not null,
   ELABORADOPOR_CLI               int,
   MODIFICADOPOR_CLI              int,
   FECHAMODIFICACION_CLI          datetime,
   APROBADOPOR_CLI                int,
   FECHAAPROBACION_CLI            datetime,
   FECHANACIMIENTO_CLI            date,
   ESTADOCIVIL_CLI                char(20),
   NOMBRECONYUGUE_CLI             char(60),
   APELLIDOCONYUGUE_CLI           char(60),
   DOCUMENTOIDENTIFICACIONCONYUGUE_CLI char(13),
   FECHAPRIMERACOMPRA_CLI         date,
   ESTADOPREDIOCOMERCIO_CLI       char(20),
   SECTOR_CLI                     char(20),
   BARRIO_CLI                     char(20),
   DIRECCIONDOMICILIO_CLI         char(100),
   ESTADOPREDIODOMICILIO_CLI      char(20),
   TELEFONODOMICILIO_CLI          char(12),
   CELULARCONYUGUE_CLI            char(12),
   OTROTELEFONO_CLI               char(12),
   CASILLAPOSTAL_CLI              char(10),
   NOMBREREFERENCIAFAMILIAR_CLI   char(60),
   TELEFONOREFERENCIAFAMILIAR_CLI char(12),
   NOMBRECOMERCIAL_CLI            char(60),
   TIPOGARANTIA_CLI               char(20),
   DESCRIPCIONGARANTIA_CLI        char(60),
   NUMEROGARANTIA_CLI             int,
   VALORGARANTIA_CLI              decimal(16,2),
   CUPOSUGERIDO_CLI               decimal(16,2),
   CUPOAPROBADO_CLI               decimal(16,2),
   PLAZOCREDITO_CLI               int,
   CALIFICACION_CLI               int                            not null,
   CUPOUHT_CLI                    char(21),
   PLAZOUHT_CLI                   int,
   CODIGOPROVEEDOR_CLI            char(20),
   TIPOCONTROL_CLI                char(25),
   primary key (SERIAL_CLI),
   key AK_CODIGO_CLI_IDX (CODIGO_CLI),
   key AK_DOCUMENTOIDENTIDAD_CLI_IDX (DOCUMENTOIDENTIDAD_CLI)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOPRECIOSCLIENTE_FK                                 */
/*==============================================================*/
create index TIPOPRECIOSCLIENTE_FK on CLIENTE
(
   SERIAL_TPR
);

/*==============================================================*/
/* Index: TIPOCLIENTECLIENTE_FK                                 */
/*==============================================================*/
create index TIPOCLIENTECLIENTE_FK on CLIENTE
(
   SERIAL_TIP
);

/*==============================================================*/
/* Index: CIUDADCLIENTE_FK                                      */
/*==============================================================*/
create index CIUDADCLIENTE_FK on CLIENTE
(
   SERIAL_CIU
);

/*==============================================================*/
/* Index: CLIENTECANAL_FK                                       */
/*==============================================================*/
create index CLIENTECANAL_FK on CLIENTE
(
   SERIAL_CAN
);

/*==============================================================*/
/* Index: FORMASCOBROCLIENTE_FK                                 */
/*==============================================================*/
create index FORMASCOBROCLIENTE_FK on CLIENTE
(
   SERIAL_FORC
);

/*==============================================================*/
/* Table: CLIENTECONTACTO                                       */
/*==============================================================*/
create table CLIENTECONTACTO
(
   SERIAL_CCL                     int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   NOMBRE_CCL                     char(20)                       not null,
   APELLIDO_CCL                   char(20)                       not null,
   CARGO_CCL                      char(25),
   TELEFONOCASA_CCL               char(15),
   TELEFONOOFICINA_CCL            char(15),
   FAX_CCL                        char(15),
   CELULAR_CCL                    char(15),
   EMAIL_CCL                      char(64),
   CEDULA_CCL                     char(13),
   primary key (SERIAL_CCL),
   key AK_NOMBRE_CCL_IDX (NOMBRE_CCL, APELLIDO_CCL)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTECLIENTECONTACTO_FK                             */
/*==============================================================*/
create index CLIENTECLIENTECONTACTO_FK on CLIENTECONTACTO
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: CLIENTEREFERENCIAS                                    */
/*==============================================================*/
create table CLIENTEREFERENCIAS
(
   SERIAL_CRE                     int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   NOMBRE_CRE                     char(40),
   TIPO_CRE                       char(20),
   TELEFONO_CRE                   char(15),
   RELACION_CRE                   char(30),
   OBSERVACION_CRE                char(255),
   primary key (SERIAL_CRE)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTECLIENTEREFERENCIAS_FK                          */
/*==============================================================*/
create index CLIENTECLIENTEREFERENCIAS_FK on CLIENTEREFERENCIAS
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: CLIENTERUTA                                           */
/*==============================================================*/
create table CLIENTERUTA
(
   SERIAL_CLIR                    int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   SERIAL_RUT                     int,
   SECUENCIA_CLIR                 int                            not null,
   primary key (SERIAL_CLIR)
)
type = InnoDB;

/*==============================================================*/
/* Index: RUTACLIENTE_FK                                        */
/*==============================================================*/
create index RUTACLIENTE_FK on CLIENTERUTA
(
   SERIAL_RUT
);

/*==============================================================*/
/* Index: CLIENTECLIENTERUTA_FK                                 */
/*==============================================================*/
create index CLIENTECLIENTERUTA_FK on CLIENTERUTA
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: CLIENTESUCURSAL                                       */
/*==============================================================*/
create table CLIENTESUCURSAL
(
   SERIAL_SCL                     int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   NOMBRE_SCL                     char(30)                       not null,
   DIRECCION_SCL                  char(100),
   NUMEROCASA_SCL                 char(10),
   TELEFONO_SCL                   char(15),
   JEFE_SCL                       char(50),
   NOMBRE_CIU                     char(30),
   NOMBRE_PRV                     char(25),
   primary key (SERIAL_SCL)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTECLIENTESUCURSAL_FK                             */
/*==============================================================*/
create index CLIENTECLIENTESUCURSAL_FK on CLIENTESUCURSAL
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: COMBOPRODUCTO                                         */
/*==============================================================*/
create table COMBOPRODUCTO
(
   SERIAL_CPRD                    int                            not null AUTO_INCREMENT,
   PRODUCTO_CPRD                  int                            not null,
   CANTIDAD_CPRD                  int                            not null,
   primary key (SERIAL_CPRD)
)
type = InnoDB;

/*==============================================================*/
/* Table: COMISIONES                                            */
/*==============================================================*/
create table COMISIONES
(
   SERIAL_CMS                     int                            not null AUTO_INCREMENT,
   FECHA_CMS                      date,
   FECHAINICIO_CMS                date,
   FECHAFIN_CMS                   char(10),
   primary key (SERIAL_CMS)
)
type = InnoDB;

/*==============================================================*/
/* Table: COMPROBANTE                                           */
/*==============================================================*/
create table COMPROBANTE
(
   SERIAL_COM                     int                            not null AUTO_INCREMENT,
   SERIAL_PCO                     int(11),
   CODIGO_COM                     char(25)                       not null,
   FECHA_COM                      date                           not null,
   CONCEPTO_COM                   char(255),
   MONTO_COM                      decimal(16,4),
   ESTADO_COM                     char(25),
   GENERADO_COM                   char(20),
   MODULO_COM                     char(25),
   NUMERO_COM                     int,
   SERIAL_USR                     int,
   primary key (SERIAL_COM)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOCONTABLECOMPROBANTE_FK                         */
/*==============================================================*/
create index PERIODOCONTABLECOMPROBANTE_FK on COMPROBANTE
(
   SERIAL_PCO
);

/*==============================================================*/
/* Table: CONDICIONESNEGOCIACIONPROVEEDOR                       */
/*==============================================================*/
create table CONDICIONESNEGOCIACIONPROVEEDOR
(
   SERIAL_CNP                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   NOMBRE_CNP                     char(40),
   DIASCREDITO_CNP                int,
   DESCUENTOPAGOPUNTUAL_CNP       decimal(5,2),
   DESCUENTO3_CNP                 decimal(5,2),
   DESCUENTO8_CNP                 decimal(5,2),
   DESCUENTO15_CNP                decimal(5,2),
   REBATE_CNP                     decimal(5,2),
   NEGOCIACIONPUNTUAL_CNP         decimal(5,2),
   OTROS_CNP                      char(30),
   DESCUENTOFACTURA_CNP           char(30),
   DESCUENTOCUMPLIMIENTO_CNP      char(30),
   ADICIONAL_CNP                  char(30),
   primary key (SERIAL_CNP),
   key AK_NOMBRE_CNP (NOMBRE_CNP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR_FK           */
/*==============================================================*/
create index PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR_FK on CONDICIONESNEGOCIACIONPROVEEDOR
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: CONTACTOS                                             */
/*==============================================================*/
create table CONTACTOS
(
   serial_cot                     int(11)                        not null AUTO_INCREMENT,
   serial_exa                     int(11)                        default NULL,
   serial_alu                     int(11)                        default NULL,
   telefono_cot                   char(50)                       default NULL,
   primary key (serial_cot),
   key alumnoContactos_FK (serial_alu),
   key exalumnosContactos_FK (serial_exa)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "CONTACTOS_IBFK_1_FK"                                            */
/*==============================================================*/
create index CONTACTOS_IBFK_1_FK
(
   serial_alu
);

/*==============================================================*/
/* Table: CONTACTOSPROVEEDOR                                    */
/*==============================================================*/
create table CONTACTOSPROVEEDOR
(
   SERIAL_CPV                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   NOMBRE_CPV                     char(60)                       not null,
   CARGO_CPV                      char(30),
   EMAIL_CPV                      char(64),
   CELULAR_CPV                    char(15),
   primary key (SERIAL_CPV)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORPROVEEDORCONTACTOS_FK                        */
/*==============================================================*/
create index PROVEEDORPROVEEDORCONTACTOS_FK on CONTACTOSPROVEEDOR
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: CRITERIO                                              */
/*==============================================================*/
create table CRITERIO
(
   serial_cri                     int(11)                        not null AUTO_INCREMENT,
   serial_matniv                  int(11)                        not null default 0,
   nombre_cri                     char(100)                      not null default '',
   descripcion_cri                char(255)                      default NULL,
   codigo_cri                     char(1)                        not null default '',
   porcentaje_cri                 double                         default NULL,
   activo_cri                     char(1)                        default NULL,
   primary key (serial_cri),
   key FK_criterio_materia_nivel_FK (serial_matniv)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Table: DEPARTAMENTOS                                         */
/*==============================================================*/
create table DEPARTAMENTOS
(
   SERIAL_DEP                     int                            not null default NULL AUTO_INCREMENT,
   CODIGO_DEP                     char(8)                        not null,
   DESCRIPCION_DEP                char(25)                       not null,
   CONSOLIDADO_DEP                char(2)                        not null,
   primary key (SERIAL_DEP),
   key AK_CODIGO_DEP_IDX (CODIGO_DEP)
)
type = InnoDB;

/*==============================================================*/
/* Table: DEPRECIACIONES                                        */
/*==============================================================*/
create table DEPRECIACIONES
(
   SERIAL_DEPR                    int                            not null AUTO_INCREMENT,
   NUMERODOCUMENTO_DEPR           char(10)                       not null,
   FECHA_DEPR                     date                           not null,
   CONTABILIZAR_DEPR              char(2)                        not null,
   ESTADO_DEPR                    char(10)                       not null,
   ELABORADOPOR_DEPR              int,
   MODIFICADOPOR_DEPR             int,
   FECHAMODIFICACION_DEPR         datetime,
   APROBADOPOR_DEPR               int,
   FECHAAPROBACION_DEPR           datetime,
   primary key (SERIAL_DEPR),
   key AK_NUMERODOCUMENTO_DEP_IDX (NUMERODOCUMENTO_DEPR),
   key AK_FECHA_DEP_IDX (FECHA_DEPR)
)
type = InnoDB;

/*==============================================================*/
/* Table: DESCUENTOCANAL                                        */
/*==============================================================*/
create table DESCUENTOCANAL
(
   SERIAL_DCA                     int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   SERIAL_CAN                     int,
   SERIAL_TPR                     int                            not null,
   DESCUENTO_DCA                  decimal(5,2),
   TOTALUNIDADES_DCA              int,
   DESCUENTOUNIDADES_DCA          int,
   primary key (SERIAL_DCA)
)
type = InnoDB;

/*==============================================================*/
/* Index: PRODUCTODESCUENTOCANAL_FK                             */
/*==============================================================*/
create index PRODUCTODESCUENTOCANAL_FK on DESCUENTOCANAL
(
   SERIAL_PRD
);

/*==============================================================*/
/* Index: CANALDESCUENTOCANAL_FK                                */
/*==============================================================*/
create index CANALDESCUENTOCANAL_FK on DESCUENTOCANAL
(
   SERIAL_CAN
);

/*==============================================================*/
/* Table: DESCUENTOCANTIDAD                                     */
/*==============================================================*/
create table DESCUENTOCANTIDAD
(
   SERIAL_DSQ                     int                            not null AUTO_INCREMENT,
   SERIAL_CAP                     int,
   DESCUENTO_DSQ                  decimal(5,2)                   not null,
   primary key (SERIAL_DSQ)
)
type = InnoDB;

/*==============================================================*/
/* Index: CATEGORIAPRODUCTODESCUENTOCANTIDAD_FK                 */
/*==============================================================*/
create index CATEGORIAPRODUCTODESCUENTOCANTIDAD_FK on DESCUENTOCANTIDAD
(
   SERIAL_CAP
);

/*==============================================================*/
/* Table: DETALLEAPROBACIONES                                   */
/*==============================================================*/
create table DETALLEAPROBACIONES
(
   SERIAL_DAP                     int                            not null AUTO_INCREMENT,
   SERIAL_APR                     int,
   SERIAL_USR                     int(11),
   FECHA_DAP                      date                           not null,
   HORA_DAP                       time,
   CUPO_DAP                       decimal(16,2),
   ESTADO_DAP                     char(15)                       not null,
   OBSERVACIONES_DAP              char(255),
   primary key (SERIAL_DAP)
)
type = InnoDB;

/*==============================================================*/
/* Index: APROBACIONDETALLEAPROBACION_FK                        */
/*==============================================================*/
create index APROBACIONDETALLEAPROBACION_FK on DETALLEAPROBACIONES
(
   SERIAL_APR
);

/*==============================================================*/
/* Index: USUARIODETALLEAPROBACIONES_FK                         */
/*==============================================================*/
create index USUARIODETALLEAPROBACIONES_FK on DETALLEAPROBACIONES
(
   SERIAL_USR
);

/*==============================================================*/
/* Table: DETALLECOMISIONES                                     */
/*==============================================================*/
create table DETALLECOMISIONES
(
   SERIAL_DCO                     int                            not null AUTO_INCREMENT,
   SERIAL_CMS                     int,
   COBRADOR_DCO                   char(60)                       not null,
   COMISION_DCO                   decimal(4),
   primary key (SERIAL_DCO)
)
type = InnoDB;

/*==============================================================*/
/* Index: COMISIONESDETALLECOMISIONES_FK                        */
/*==============================================================*/
create index COMISIONESDETALLECOMISIONES_FK on DETALLECOMISIONES
(
   SERIAL_CMS
);

/*==============================================================*/
/* Table: DETALLECOMPROBANTE                                    */
/*==============================================================*/
create table DETALLECOMPROBANTE
(
   SERIAL_DCO                     int                            not null AUTO_INCREMENT,
   SERIAL_COM                     int,
   SERIAL_PLC                     int                            default NULL,
   DEBE_DCO                       decimal(16,4),
   HABER_DCO                      decimal(16,4),
   DESCRIPCION_DCO                char(255),
   REFERENCIA_DCO                 char(255),
   primary key (SERIAL_DCO)
)
type = InnoDB;

/*==============================================================*/
/* Index: COMPROBANTEDETALLECOMPROBANTE_FK                      */
/*==============================================================*/
create index COMPROBANTEDETALLECOMPROBANTE_FK on DETALLECOMPROBANTE
(
   SERIAL_COM
);

/*==============================================================*/
/* Index: PLANCONTABLEDETALLECOMPROBANTE_FK                     */
/*==============================================================*/
create index PLANCONTABLEDETALLECOMPROBANTE_FK on DETALLECOMPROBANTE
(
   SERIAL_PLC
);

/*==============================================================*/
/* Table: DETALLEDEPRECIACIONES                                 */
/*==============================================================*/
create table DETALLEDEPRECIACIONES
(
   SERIAL_DDP                     int                            not null AUTO_INCREMENT,
   SERIAL_DEPR                    int,
   SERIAL_ACF                     int,
   VALOR_DDP                      decimal(16,2),
   DEPRECIACIONMENSUAL_DDP        decimal(16,2)                  not null,
   ESTADO_DDP                     char(10),
   DEPRECIACIONACUMULADA_DDP      decimal(16,2),
   primary key (SERIAL_DDP)
)
type = InnoDB;

/*==============================================================*/
/* Index: DEPRECIACIONESDETALLEDEPRECIACIONES_FK                */
/*==============================================================*/
create index DEPRECIACIONESDETALLEDEPRECIACIONES_FK on DETALLEDEPRECIACIONES
(
   SERIAL_DEPR
);

/*==============================================================*/
/* Index: DETALLEDEPRECIACIONESACTIVOSFIJOS_FK                  */
/*==============================================================*/
create index DETALLEDEPRECIACIONESACTIVOSFIJOS_FK on DETALLEDEPRECIACIONES
(
   SERIAL_ACF
);

/*==============================================================*/
/* Table: DETALLEFACTURA                                        */
/*==============================================================*/
create table DETALLEFACTURA
(
   SERIAL_DFAC                    int                            not null AUTO_INCREMENT,
   SERIAL_FAC                     int,
   CANTIDAD_DFAC                  int                            not null,
   PRECIOUNITARIO_DFAC            decimal(16,6)                  not null,
   ICE_DFAC                       decimal(16,6),
   DESCUENTODOLARES_DFAC          decimal(16,6),
   DESCUENTOPORCENTAJE_DFAC       decimal(5,2),
   VALORIVA12_DFAC                decimal(16,6),
   VALORIVA0_DFAC                 decimal(16,6),
   TOTAL_DFAC                     decimal(16,6)                  not null,
   COMISION_DFAC                  decimal(16,6)                  not null,
   CANTIDADENTREGADA_DFAC         int,
   ESTADO_DFAC                    char(10)                       not null,
   primary key (SERIAL_DFAC)
)
type = InnoDB;

/*==============================================================*/
/* Index: FACTURADETALLEFACTURA_FK                              */
/*==============================================================*/
create index FACTURADETALLEFACTURA_FK on DETALLEFACTURA
(
   SERIAL_FAC
);

/*==============================================================*/
/* Table: DETALLEGUIAREMISION                                   */
/*==============================================================*/
create table DETALLEGUIAREMISION
(
   SERIAL_DGUIA                   int                            not null AUTO_INCREMENT,
   PRODUCTO_DGUIA                 char(20)                       not null,
   CANTIDAD_DGUIA                 int                            not null,
   primary key (SERIAL_DGUIA)
)
type = InnoDB;

/*==============================================================*/
/* Table: DETALLEINGRESOEGRESODEBODEGA                          */
/*==============================================================*/
create table DETALLEINGRESOEGRESODEBODEGA
(
   SERIAL_DIEB                    int                            not null AUTO_INCREMENT,
   SERIAL_IEB                     int,
   PRODUCTO_DIEB                  char(20)                       not null,
   PRECIO_DIEB                    decimal(16,6)                  not null,
   CANTIDADSOLICITADA_DIEB        int                            not null,
   CANTIDADRECIBIDAENTREGADA_DIEB int                            not null,
   ENTREGASPARCIALES_DIEB         int,
   LOTE_DIEB                      char(30),
   FECHAELABORACION_DIEB          date,
   FECHAVENCIEMIENTO_DIEB         date,
   OBSERVACIONES_DIEB             char(200),
   SALDOUSD_DIEB                  decimal(16,6)                  not null,
   SALDOCANTIDAD_DIEB             int                            not null,
   IVA_DIEB                       decimal(16,6)                  not null,
   IVA0_DIEB                      decimal(16,6)                  not null,
   DESCUENTOPORCENTAJE_DIEB       decimal(5,2),
   DESCUENTOUSD_DIEB              decimal(16,6),
   TOTAL_DIEB                     decimal(16,6)                  not null,
   ESTADO_DIEB                    char(10)                       not null,
   primary key (SERIAL_DIEB)
)
type = InnoDB;

/*==============================================================*/
/* Index: INGRESOEGRESOBODEGADETALLEIEB_FK                      */
/*==============================================================*/
create index INGRESOEGRESOBODEGADETALLEIEB_FK on DETALLEINGRESOEGRESODEBODEGA
(
   SERIAL_IEB
);

/*==============================================================*/
/* Table: DETALLEORDENDECOMPRA                                  */
/*==============================================================*/
create table DETALLEORDENDECOMPRA
(
   SERIAL_DODC                    int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   SERIAL_ODC                     int,
   OTROSPRODUCTOS_DODC            char(200),
   COSTO_DODC                     decimal(16,6)                  not null,
   CANTIDADRECIBIDA_DODC          int,
   CANTIDADREQUERIDA_DODC         int                            not null,
   CANTIDADSUGERIDA_DODC          int,
   ESTADO_DODC                    char(10)                       not null,
   PROMEDIOVENTAS_DODC            int,
   STOCKACTUAL_DODC               int,
   DIASSTOCK_DODC                 int,
   SUBTOTAL_DODC                  decimal(16,6)                  not null,
   DESCUENTODOLARES_DODC          decimal(16,6),
   DESCUENTOPORCENTAJE_DODC       decimal(5,2),
   IVA_DODC                       decimal(16,6)                  not null,
   IVA0_DODC                      decimal(16,6),
   TOTAL_DODC                     decimal(16,6),
   OBSERVACIONES_DODC             char(200),
   CANTIDADRECIBIDAUNIDADES_DODC  int,
   MARCA_DODC                     char(64),
   CANTIDADDEVUELTAUNIDADES_DODC  int,
   CANTIDADDEVUELTACAJAS_DODC     int,
   CANTIDADDEVUELTAUNIDADESANTERIOR_DODC int,
   primary key (SERIAL_DODC)
)
type = InnoDB;

/*==============================================================*/
/* Index: ORDENDECOMPRADETALLEORDENDECOMPRA_FK                  */
/*==============================================================*/
create index ORDENDECOMPRADETALLEORDENDECOMPRA_FK on DETALLEORDENDECOMPRA
(
   SERIAL_ODC
);

/*==============================================================*/
/* Index: PRODUCTODETALLEORDENCOMPRA_FK                         */
/*==============================================================*/
create index PRODUCTODETALLEORDENCOMPRA_FK on DETALLEORDENDECOMPRA
(
   SERIAL_PRD
);

/*==============================================================*/
/* Table: DETALLEORDENDEREQUERIMIENTO                           */
/*==============================================================*/
create table DETALLEORDENDEREQUERIMIENTO
(
   SERIAL_DOR                     int                            not null AUTO_INCREMENT,
   SERIAL_ORE                     int,
   DESCRIPCION_DOR                char(255),
   CANTIDAD_DOR                   int,
   UNIDADMEDIDA_DOR               char(20),
   STOCKMINIMO_DOR                int,
   PARA_DOR                       char(255),
   SERIAL_PRD                     int,
   PRIORIDAD_PRD                  char(20),
   primary key (SERIAL_DOR)
)
type = InnoDB;

/*==============================================================*/
/* Index: ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO_FK      */
/*==============================================================*/
create index ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO_FK on DETALLEORDENDEREQUERIMIENTO
(
   SERIAL_ORE
);

/*==============================================================*/
/* Table: DETALLEORDENPEDIDO                                    */
/*==============================================================*/
create table DETALLEORDENPEDIDO
(
   SERIAL_DORP                    int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   SERIAL_ORP                     int,
   CANTIDAD_DORP                  int                            not null,
   PRECIOUNITARIO_DORP            decimal(12,4)                  not null,
   ICE_DORP                       decimal(16,2),
   DESCUENTODOLARES_DORP          decimal(16,2),
   DESCUENTOPORCENTAJE_DORP       decimal(5,2),
   VALORIVA12_DORP                decimal(16,2)                  not null,
   VALORIVA0_DORP                 decimal(16,2)                  not null,
   TOTAL_DORP                     decimal(16,2)                  not null,
   COMISION_DORP                  decimal(16,2)                  not null,
   CANTIDADUNIDADES_DORP          int,
   CANTIDADSOLICITADA_DORP        int,
   CANTIDADDESPACHAR_DORP         int,
   primary key (SERIAL_DORP)
)
type = InnoDB;

/*==============================================================*/
/* Index: ORDENPEDIDODETALLEORDENPEDIDO_FK                      */
/*==============================================================*/
create index ORDENPEDIDODETALLEORDENPEDIDO_FK on DETALLEORDENPEDIDO
(
   SERIAL_ORP
);

/*==============================================================*/
/* Index: PRODUCTODETALLEORDENPEDIDO_FK                         */
/*==============================================================*/
create index PRODUCTODETALLEORDENPEDIDO_FK on DETALLEORDENPEDIDO
(
   SERIAL_PRD
);

/*==============================================================*/
/* Table: DETALLEROLPAGOS                                       */
/*==============================================================*/
create table DETALLEROLPAGOS
(
   SERIAL_DRP                     int                            not null AUTO_INCREMENT,
   SERIAL_RGR                     int(11),
   SERIAL_ERP                     int(11),
   VALOR_DRP                      decimal(10,2)                  not null,
   CUOTA_DRP                      int,
   primary key (SERIAL_DRP)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOROLPAGOSDETALLEROL_FK                         */
/*==============================================================*/
create index EMPLEADOROLPAGOSDETALLEROL_FK on DETALLEROLPAGOS
(
   SERIAL_ERP
);

/*==============================================================*/
/* Index: RUBROGENERALROLPAGOSDETALLEROLPAGOS_FK                */
/*==============================================================*/
create index RUBROGENERALROLPAGOSDETALLEROLPAGOS_FK on DETALLEROLPAGOS
(
   SERIAL_RGR
);

/*==============================================================*/
/* Table: DETALLESOLICITUDDOTACION                              */
/*==============================================================*/
create table DETALLESOLICITUDDOTACION
(
   SERIAL_DSD                     int                            not null AUTO_INCREMENT,
   SERIAL_SDO                     int,
   DESCRIPCION_DSD                char(64)                       not null,
   PARA_DSD                       char(255),
   CANTIDADREQUERIDA_DSD          int,
   CANTIDADENTREGADA_DSD          int,
   SERIAL_PRD                     int,
   primary key (SERIAL_DSD)
)
type = InnoDB;

/*==============================================================*/
/* Index: SOLICITUDDOTACIONDETALLESOLICITUD_FK                  */
/*==============================================================*/
create index SOLICITUDDOTACIONDETALLESOLICITUD_FK on DETALLESOLICITUDDOTACION
(
   SERIAL_SDO
);

/*==============================================================*/
/* Table: DETALLETRANSPORTE                                     */
/*==============================================================*/
create table DETALLETRANSPORTE
(
   SERIAL_DTRA                    int                            not null AUTO_INCREMENT,
   SERIAL_IEB                     int,
   SERIAL_COT                     int,
   SERIAL_FAC                     int,
   CIUDADORIGEN_DTRA              int                            not null,
   CIUDADDESTINO_DTRA             int                            not null,
   FECHA_DTRA                     datetime                       not null,
   VALOR_DTRA                     decimal(16,2)                  not null,
   PESONETO_DTRA                  decimal(16,2),
   ESTADO_DTRA                    char(10),
   primary key (SERIAL_DTRA),
   key AK_SERIAL_COT_IDX (SERIAL_COT)
)
type = InnoDB;

/*==============================================================*/
/* Index: INGRESOEGRESOBODEGADETALLETRASNPORTE_FK               */
/*==============================================================*/
create index INGRESOEGRESOBODEGADETALLETRASNPORTE_FK on DETALLETRANSPORTE
(
   SERIAL_IEB
);

/*==============================================================*/
/* Table: DIASFERIADOS                                          */
/*==============================================================*/
create table DIASFERIADOS
(
   SERIAL_DFE                     int                            not null AUTO_INCREMENT,
   NOMBRE_DFE                     char(64),
   FECHA_DFE                      date                           not null,
   primary key (SERIAL_DFE)
)
type = InnoDB;

/*==============================================================*/
/* Table: DIASTRABAJADOS                                        */
/*==============================================================*/
create table DIASTRABAJADOS
(
   SERIAL_DTR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   SERIAL_EPL                     int(20),
   DIASTRABAJADOS_DTR             int                            default NULL,
   DESCRIPCION_DTR                char(255)                      not null default '',
   primary key (SERIAL_DTR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLDIASTRABAJADOS_FK                           */
/*==============================================================*/
create index PERIODOROLDIASTRABAJADOS_FK on DIASTRABAJADOS
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Index: EMPLEADODIASTRABAJADOS_FK                             */
/*==============================================================*/
create index EMPLEADODIASTRABAJADOS_FK on DIASTRABAJADOS
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: DOCPARALELOALUMO                                      */
/*==============================================================*/
create table DOCPARALELOALUMO
(
   serial_dpa                     int(11)                        not null AUTO_INCREMENT,
   serial_doc                     int(11)                        default NULL,
   serial_alu                     int(11)                        default NULL,
   numeroEntregado_dpa            int(11)                        default NULL,
   legalizado_dpa                 char(1)                        default NULL,
   observacion_dpa                char(255)                      default NULL,
   entregado_dpa                  char(1)                        default NULL,
   primary key (serial_dpa),
   key documentosDocParaleloAlumno_FK (serial_doc),
   key alumnoDocParaleloAlumno_FK (serial_alu)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "DOCPARALELOALUMO_IBFK_2_FK"                                            */
/*==============================================================*/
create index DOCPARALELOALUMO_IBFK_2_FK
(
   serial_alu
);

/*==============================================================*/
/* Table: EMPLEADO                                              */
/*==============================================================*/
create table EMPLEADO
(
   SERIAL_EPL                     int(20)                        not null AUTO_INCREMENT,
   SERIAL_TUR                     int(11),
   SERIAL_IFI                     int,
   SERIAL_ESC                     int(11),
   SERIAL_DESC                    int(11),
   SERIAL_TCT                     int(11),
   SERIAL_TER                     int,
   FECHA_EPL                      datetime                       not null,
   CODIGO_EPL                     char(10)                       not null,
   NOMBRE_EPL                     char(60)                       not null,
   APELLIDO_EPL                   char(60)                       not null,
   TIPOEMPLEADO_EPL               char(20)                       not null,
   FECHANACIMIENTO_EPL            date                           not null,
   CIUDAD_EPL                     int                            not null,
   PARROQUIA_EPL                  int,
   DOCUMENTOIDENTIDAD_EPL         char(15)                       not null,
   TIPODOCUMENTO_EPL              char(20)                       not null,
   SEXO_EPL                       char(10)                       not null,
   DOCUMENTOMILITAR_EPL           char(15),
   ESTADOCIVIL_EPL                char(15)                       not null,
   CARNETIESS_EPL                 char(15),
   TELEFONOPERSONAL_EPL           char(15)                       not null,
   TELEFONOTRABAJO_EPL            char(15),
   EXTENSION_EPL                  char(4),
   CELULAR_EPL                    char(15),
   EMAIL_EPL                      char(65),
   FECHAINGRESO_EPL               date                           not null,
   FECHASALIDA_EPL                date,
   ESTADOEMPLEADO_EPL             char(10),
   FORMACONTRATO_EPL              char(30)                       not null,
   FECHAVENCIMIENTOCONTRATO_EPL   date,
   COMISIONES_EPL                 char(30),
   FOTO_EPL                       char(255),
   CONTRATO_EPL                   char(255),
   COPIACEDULA_EPL                char(2)                        not null,
   COPIAPAPELETA_EPL              char(2)                        not null,
   COPIALIBRETA_EPL               char(2)                        not null,
   COPIACARNET_EPL                char(2)                        not null,
   COPIATITULO_EPL                char(2)                        not null,
   COPIASREFERENCIAS_EPL          char(2)                        not null,
   TIPOCUENTABANCO_EPL            char(30),
   NUMEROCUENTABANCO_EPL          char(20),
   PORCENTAJECOSTOACUMULADO_EPL   decimal(5,2),
   PORCENTAJECENTROCOSTOACUMULADO_EPL decimal(5,2),
   DIASVACACIONES_EPL             int,
   ESTADO_EPL                     char(10)                       not null,
   ELABORADOPOR_EPL               int,
   MODIFICADOPOR_EPL              int,
   FECHAMODIFICACION_EPL          datetime,
   APROBADOPOR_EPL                int,
   FECHAAPROBACION_EPL            datetime,
   SISTEMASALARIONETO_EPL         char(2),
   APORTAIESS_EPL                 char(2),
   GENERAROL_EPL                  char(2),
   HORASMES_EPL                   int,
   ASISTENCIA_EPL                 char(2),
   CODIGOANTERIOR_EPL             char(13),
   DIRECCION_EPL                  char(64),
   NUMEROCASA_EPL                 char(15),
   TIPOLICENCIA_EPL               char(25),
   SUELDO_EPL                     decimal(10,2),
   PROSPECTO_EPL                  char(2),
   HORASDIA_EPL                   double,
   DISCAPACITADO_EPL              char(2),
   primary key (SERIAL_EPL),
   key AK_FECHA_EPL_IDX (FECHA_EPL),
   key AK_CODIGO_EPL_IDX (CODIGO_EPL),
   key AK_DOCUMENTOIDENTIDAD_EPL_IDX (DOCUMENTOIDENTIDAD_EPL)
)
type = InnoDB;

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOSEMPLEADO_FK                      */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOSEMPLEADO_FK on EMPLEADO
(
   SERIAL_DESC
);

/*==============================================================*/
/* Index: ESCALAFONESEMPLEADO_FK                                */
/*==============================================================*/
create index ESCALAFONESEMPLEADO_FK on EMPLEADO
(
   SERIAL_ESC
);

/*==============================================================*/
/* Index: TIPOSCONTRATOSEMPLEADO_FK                             */
/*==============================================================*/
create index TIPOSCONTRATOSEMPLEADO_FK on EMPLEADO
(
   SERIAL_TCT
);

/*==============================================================*/
/* Index: TURNOSEMPLEADO_FK                                     */
/*==============================================================*/
create index TURNOSEMPLEADO_FK on EMPLEADO
(
   SERIAL_TUR
);

/*==============================================================*/
/* Index: INSTITUCIONESFINANCIERASEMPLEADO_FK                   */
/*==============================================================*/
create index INSTITUCIONESFINANCIERASEMPLEADO_FK on EMPLEADO
(
   SERIAL_IFI
);

/*==============================================================*/
/* Table: EMPLEADOROLPAGOS                                      */
/*==============================================================*/
create table EMPLEADOROLPAGOS
(
   SERIAL_ERP                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   SERIAL_PERROL                  int                            default NULL,
   FECHA_ERP                      date                           not null default '0000-00-00',
   NOMBRE_ERP                     char(60)                       not null default '',
   ESTADO_ERP                     char(20)                       not null default '',
   OBSERVACION_ERP                char(255),
   primary key (SERIAL_ERP),
   key AK_FECHAREGISTRO_RUBEMP_IDX (FECHA_ERP)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADORUBROSEMPLEADO_FK                             */
/*==============================================================*/
create index EMPLEADORUBROSEMPLEADO_FK on EMPLEADOROLPAGOS
(
   SERIAL_EPL
);

/*==============================================================*/
/* Index: PERIODOROLEMPLEADOROL_FK                              */
/*==============================================================*/
create index PERIODOROLEMPLEADOROL_FK on EMPLEADOROLPAGOS
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Table: EMPRESA                                               */
/*==============================================================*/
create table EMPRESA
(
   SERIAL_EMP                     int                            not null AUTO_INCREMENT,
   SERIAL_PAR                     int,
   CODIGO_EMP                     char(20)                       not null,
   NOMBRE_EMP                     char(60)                       not null,
   RUC_EMP                        char(13)                       not null,
   EMAIL_EMP                      char(64),
   WEB_EMP                        char(50),
   DIRECCION_EMP                  char(100)                      not null,
   TELEFONO_EMP                   char(15)                       not null,
   FAX_EMP                        char(15),
   REPRESENTANTELEGAL_EMP         char(64)                       not null,
   RUCCOTADOR_EMP                 char(13)                       not null,
   CONTRIBUYENTEESPECIAL_EMP      char(2)                        not null,
   OBLIGADO_EMP                   char(2),
   CATEGORIA_EMP                  char(40)                       not null,
   LOGOTIPO_EMP                   char(255),
   AUTORIZACIONSRI_EMP            char(25),
   VALIDOHASTA_EMP                date,
   RESOLUCION_EMP                 char(255),
   primary key (SERIAL_EMP),
   key AK_CODIGO_EMP_IDX (CODIGO_EMP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PARROQUIAEMPRESA_FK                                   */
/*==============================================================*/
create index PARROQUIAEMPRESA_FK on EMPRESA
(
   SERIAL_PAR
);

/*==============================================================*/
/* Table: ESCALAFONES                                           */
/*==============================================================*/
create table ESCALAFONES
(
   SERIAL_ESC                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_TES                     int(11),
   SERIAL_CAR                     int(11),
   SUELDO_ESC                     decimal(16,2)                  not null,
   primary key (SERIAL_ESC)
)
type = InnoDB;

/*==============================================================*/
/* Index: CARGOSESCALAFONES_FK                                  */
/*==============================================================*/
create index CARGOSESCALAFONES_FK on ESCALAFONES
(
   SERIAL_CAR
);

/*==============================================================*/
/* Index: TIPOESCALAFONESESCALAFONES_FK                         */
/*==============================================================*/
create index TIPOESCALAFONESESCALAFONES_FK on ESCALAFONES
(
   SERIAL_TES
);

/*==============================================================*/
/* Table: ESPECIALIDAD                                          */
/*==============================================================*/
create table ESPECIALIDAD
(
   serial_esp                     int(11)                        not null AUTO_INCREMENT,
   nombre_esp                     char(50)                       not null default '',
   codigo_esp                     char(15)                       not null default '',
   descripcion_esp                char(255)                      default NULL,
   primary key (serial_esp),
   key codigo_esp_idx (codigo_esp)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Table: EXPERIENCIAPROFESIONAL                                */
/*==============================================================*/
create table EXPERIENCIAPROFESIONAL
(
   SERIAL_EXP                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   EMPRESA_EXP                    char(40)                       not null,
   CARGO_EXP                      char(20)                       not null,
   TELEFONO_EXP                   char(12)                       not null,
   TIPOINSTITUCION_EXP            char(25)                       not null,
   FECHAINGRESO_EXP               date                           not null,
   FECHASALIDA_EXP                date                           not null,
   DESCRIPCION_EXP                char(255),
   AFECTAROL_EXP                  char(2)                        not null,
   primary key (SERIAL_EXP)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOEXPERIENCIAPROFESIONAL_FK                     */
/*==============================================================*/
create index EMPLEADOEXPERIENCIAPROFESIONAL_FK on EXPERIENCIAPROFESIONAL
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: FACTURA                                               */
/*==============================================================*/
create table FACTURA
(
   SERIAL_FAC                     int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   SERIAL_SDO                     int,
   TIPODOCUMENTO_FAC              char(20)                       not null,
   NUMERODOCUMENTO_FAC            char(25)                       not null,
   NUMERO_ORP                     char(25),
   FECHA_FAC                      datetime                       not null,
   CLIENTE_FAC                    char(80)                       not null,
   DIRECCION_FAC                  char(255)                      not null,
   DIRECCIONENTREGA_FAC           char(255)                      not null,
   DOCUMENTOIDENTIFICACION_FAC    char(20)                       not null,
   GUIAREMISION_FAC               char(20),
   FECHAVENCIMIENTO_FAC           date                           not null,
   VENDEDOR_FAC                   int                            not null,
   COBRADOR_FAC                   int                            not null,
   VENDEDORTELEMARKETING_FAC      char(20),
   DESCUENTO_FAC                  decimal(16,2),
   TASAMORA_FAC                   decimal(5,2),
   TEXTOTELEMARKETING_FAC         char(200),
   OBSERVACIONES_FAC              char(200),
   ORDENEGRESO_FAC                int,
   SUBTOTAL_FAC                   decimal(16,2)                  not null,
   TOTALCOMISION_FAC              decimal(16,2)                  not null,
   SUMAICE_FAC                    decimal(16,2),
   SUMAIVA12_FAC                  decimal(16,2),
   SUMAIVA0_FAC                   decimal(16,2),
   TOTAL_FAC                      decimal(16,2)                  not null,
   ABONOS_FAC                     decimal(16,2),
   ESTADO_FAC                     char(30)                       not null,
   ESTADOIMPRESION_FAC            char(10),
   COPIASIMPRESAS_FAC             int,
   ELABORADOPOR_FAC               int                            not null,
   MODIFICADOPOR_FAC              int,
   FECHAMODIFICACION_FAC          datetime,
   APROBADOPOR_FAC                int,
   FECHAAPROBACION_FAC            datetime,
   FECHADESPACHO_FAC              datetime,
   SERIAL_TIP                     int,
   FECHACANCELACION_FAC           datetime,
   primary key (SERIAL_FAC),
   key AK_NUMERODOCUMENTO_FAC_IDX (NUMERODOCUMENTO_FAC),
   key AK_FECHA_FAC_IDX (FECHA_FAC)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTEFACTURA_FK                                     */
/*==============================================================*/
create index CLIENTEFACTURA_FK on FACTURA
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: FACTURACOMPRA                                         */
/*==============================================================*/
create table FACTURACOMPRA
(
   SERIAL_FACC                    int                            not null AUTO_INCREMENT,
   SERIAL_IEB                     int,
   NUMERODOCUMENTO_FACC           char(25)                       not null,
   FECHA_FACC                     date                           not null,
   FECHACANCELACION_FACC          date                           not null,
   TIPODOCUMENTO_FACC             char(20)                       not null,
   AUTORIZACIONSRI_FACC           char(11)                       not null,
   FECHAAUTORIZACIONSRI_FACC      date                           not null,
   SUBTOTAL_FACC                  decimal(16,2)                  not null,
   DESCUENTOUSD_FACC              decimal(5,2),
   DESCUENTOPORCENTAJE_FACC       decimal(5,2),
   SUMAIVA12_FACC                 decimal(16,2)                  not null,
   SUMAIVA0_FACC                  decimal(16,2)                  not null,
   TOTAL_FACC                     decimal(16,2)                  not null,
   ABONOS_FACC                    decimal(16,2)                  not null,
   ESTADO_FACC                    char(10)                       not null,
   ELABORADOPOR_FACC              int,
   MODIFICADOPOR_FACC             int,
   FECHAMODIFICACION_FACC         date,
   APROBADOPOR_FACC               int,
   FECHAAPROBACION_FACC           date,
   ESTADOIMPRESION_FACC           char(10),
   COPIASIMPRESAS_FACC            int,
   FECHACADUCIDAD_FACC            date,
   NUMERO_FACC                    char(20),
   CONCEPTO_FACC                  char(255),
   primary key (SERIAL_FACC),
   key AK_NUMERODOCUMENTO_FAC_IDX (NUMERODOCUMENTO_FACC),
   key AK_FECHA_FAC_IDX (FECHA_FACC)
)
type = InnoDB;

/*==============================================================*/
/* Index: INGRESOEGRESOFACTURACOMPRA_FK                         */
/*==============================================================*/
create index INGRESOEGRESOFACTURACOMPRA_FK on FACTURACOMPRA
(
   SERIAL_IEB
);

/*==============================================================*/
/* Table: FAMILIAACTIVOFIJO                                     */
/*==============================================================*/
create table FAMILIAACTIVOFIJO
(
   SERIAL_FAF                     int                            not null AUTO_INCREMENT,
   SERIAL_PLC                     int                            default NULL,
   CODIGO_FAF                     char(15),
   NOMBRE_FAF                     char(80),
   primary key (SERIAL_FAF),
   key AK_CODIGO_FAF_IDX (CODIGO_FAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: FAMILIAACTIVOFIJOPLANCONTABLE_FK                      */
/*==============================================================*/
create index FAMILIAACTIVOFIJOPLANCONTABLE_FK on FAMILIAACTIVOFIJO
(
   SERIAL_PLC
);

/*==============================================================*/
/* Table: FAMILIAPRODUCTO                                       */
/*==============================================================*/
create table FAMILIAPRODUCTO
(
   SERIAL_FAP                     int                            not null AUTO_INCREMENT,
   CODIGO_FAP                     char(10)                       not null,
   NOMBRE_FAP                     char(40),
   DESCRIPCION_FAP                char(255),
   primary key (SERIAL_FAP)
)
type = InnoDB;

/*==============================================================*/
/* Table: FORMACIONACADEMICA                                    */
/*==============================================================*/
create table FORMACIONACADEMICA
(
   SERIAL_FOA                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   FECHAINICIO_FOA                date                           not null,
   DESCRIPCION_FOA                char(80)                       not null,
   INSTITUCION_FOA                char(40)                       not null,
   TIPOTITULO_FOA                 char(10)                       not null,
   FECHAFIN_FOA                   date,
   NIVEL_FOA                      char(30),
   primary key (SERIAL_FOA)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOFORMACIONACADEMICA_FK                         */
/*==============================================================*/
create index EMPLEADOFORMACIONACADEMICA_FK on FORMACIONACADEMICA
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: FORMACOBRO                                            */
/*==============================================================*/
create table FORMACOBRO
(
   SERIAL_FORC                    int                            not null AUTO_INCREMENT,
   CODIGO_FORC                    char(7)                        not null,
   NOMBRE_FORC                    char(60)                       not null,
   DESCRIPCION_FORC               char(100)                      not null,
   CUOTAS_FORC                    char(100)                      not null,
   COMISIONTARJETACREDITO_FORC    decimal(4,2),
   primary key (SERIAL_FORC),
   key AK_CODIGO_FORC_IDX (CODIGO_FORC)
)
type = InnoDB;

/*==============================================================*/
/* Table: FORMASPAGO                                            */
/*==============================================================*/
create table FORMASPAGO
(
   SERIAL_FORP                    int                            not null AUTO_INCREMENT,
   CODIGO_FORP                    char(7)                        not null,
   NOMBRE_FORP                    char(40)                       not null,
   DESCRIPCION_FORP               char(50)                       not null,
   CUOTAS_FORP                    int                            not null,
   DESDEINGRESO_FORP              char(20)                       not null,
   primary key (SERIAL_FORP),
   key AK_CODIGO_FORP_IDX (CODIGO_FORP)
)
type = InnoDB;

/*==============================================================*/
/* Table: FORMULAS                                              */
/*==============================================================*/
create table FORMULAS
(
   SERIAL_FRM                     int                            not null AUTO_INCREMENT,
   NOMBRE_FRM                     char(64)                       not null,
   DESCRIPCION_FRM                char(255),
   FORMULA_FRM                    char(255)                      not null,
   primary key (SERIAL_FRM)
)
type = InnoDB;

/*==============================================================*/
/* Table: GARANTIASACTIVOSFIJOS                                 */
/*==============================================================*/
create table GARANTIASACTIVOSFIJOS
(
   SERIAL_GAF                     int                            not null AUTO_INCREMENT,
   SERIAL_ACF                     int,
   NOMBRE_GAF                     char(50),
   UNIDADMEDIDA_GAF               char(25),
   VALOR_GAF                      decimal(6,2),
   EMISOR_GAF                     char(60),
   NOMBRECONTACTO_GAF             char(25),
   APELLIDOCONTACTO_GAF           char(25),
   EMAILCONTACTO_GAF              char(64),
   DIRECCION_GAF                  char(60),
   TELEFONO_GAF                   char(15),
   DESDE_GAF                      date,
   HASTA_GAF                      date,
   CANTIDAD_GAF                   decimal(5,2),
   UNIDADMEDIDA2_GAF              char(25),
   CANTIDAD2_GAF                  decimal(5,2),
   primary key (SERIAL_GAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: ACTIVOSFIJOSGARANTIASACTIVOSFIJOS_FK                  */
/*==============================================================*/
create index ACTIVOSFIJOSGARANTIASACTIVOSFIJOS_FK on GARANTIASACTIVOSFIJOS
(
   SERIAL_ACF
);

/*==============================================================*/
/* Table: GUIAREMISION                                          */
/*==============================================================*/
create table GUIAREMISION
(
   SERIAL_GUIA                    int                            not null AUTO_INCREMENT,
   SERIAL_SDO                     int,
   TIPODOCUMENTO_GUIA             char(25)                       not null,
   NUMERODOCUMENTO_GUIA           char(25)                       not null,
   FECHA_GUIA                     datetime                       not null,
   FECHATERMINACION_GUIA          date                           not null,
   CLIENTE_GUIA                   char(100)                      not null,
   DIRECCION_GUIA                 char(255)                      not null,
   DIRECCIONDESTINO_GUIA          char(255)                      not null,
   DOCUMENTOIDENTIFICACION_GUIA   char(20)                       not null,
   NOMBRETRANSPORTISTA_GUIA       int,
   IDENTIFICACIONREMITENTE_GUIA   char(80),
   OBSERVACIONES_GUIA             char(200),
   FECHADESPACHO_GUIA             datetime,
   TEXTOTELEMARKETING_GUIA        char(200),
   ESTADOIMPRESION_GUIA           char(10),
   COPIASIMPRESAS_GUIA            char(20),
   ESTADO_GUIA                    char(10)                       not null,
   ELABORADOPOR_GUIA              int                            not null,
   MODIFICADOPOR_GUIA             int,
   FECHAMODIFICACION_GUIA         datetime,
   APROBADOPOR_GUIA               int,
   FECHAAPROBACION_GUIA           datetime,
   primary key (SERIAL_GUIA),
   key AK_NUMERODOCUMENTO_GUIA_IDX (NUMERODOCUMENTO_GUIA),
   key AK_FECHA_GUIA_IDX (FECHA_GUIA)
)
type = InnoDB;

/*==============================================================*/
/* Table: HISTORIALCREDITOCLIENTE                               */
/*==============================================================*/
create table HISTORIALCREDITOCLIENTE
(
   SERIAL_HCC                     int                            not null AUTO_INCREMENT,
   SERIAL_CLI                     int,
   FECHA_HCC                      date                           not null,
   SALDOPORCOBRARNOVENCIDO_HCC    numeric(16,2),
   SALDOPORCOBRARVENCIDO_HCC      numeric(16,2),
   CARTERATOTAL_HCC               numeric(16,2)                  not null,
   primary key (SERIAL_HCC)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTEHISTORIALCREDITOCLIENTE_FK                     */
/*==============================================================*/
create index CLIENTEHISTORIALCREDITOCLIENTE_FK on HISTORIALCREDITOCLIENTE
(
   SERIAL_CLI
);

/*==============================================================*/
/* Table: HORASEXTRA                                            */
/*==============================================================*/
create table HORASEXTRA
(
   SERIAL_HEX                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   SERIAL_PERROL                  int                            default NULL,
   HORA_HEX                       decimal(16,2)                  default NULL,
   PORCENTAJE_HEX                 int                            not null default 0,
   FECHA_HEX                      date                           default NULL,
   OBSERVACION_HEX                char(255)                      default NULL,
   primary key (SERIAL_HEX),
   key AK_FECHA_HEX_IDX (FECHA_HEX)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLHORAEXTRA_FK                                */
/*==============================================================*/
create index PERIODOROLHORAEXTRA_FK on HORASEXTRA
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Index: EMPLEADOHORAEXTRA_FK                                  */
/*==============================================================*/
create index EMPLEADOHORAEXTRA_FK on HORASEXTRA
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: IMPUESTOS                                             */
/*==============================================================*/
create table IMPUESTOS
(
   SERIAL_IMP                     int                            not null AUTO_INCREMENT,
   CODIGO_IMP                     char(7)                        not null,
   NOMBRE_IMP                     char(100)                      not null,
   TIPO_IMP                       char(6)                        not null,
   IMPONIBLE_IMP                  char(20)                       not null,
   SRI_IMP                        char(4)                        not null,
   VALOR_IMP                      decimal(20,2)                  not null,
   PORCENTAJE_IMP                 char(2)                        not null,
   DESDE_IMP                      date                           not null,
   HASTA_IMP                      date,
   ESTADO_IMP                     char(10)                       not null,
   primary key (SERIAL_IMP),
   key AK_CODIGO_IMP_IDX (CODIGO_IMP)
)
type = InnoDB;

/*==============================================================*/
/* Table: INGRESOEGRESODEBODEGA                                 */
/*==============================================================*/
create table INGRESOEGRESODEBODEGA
(
   SERIAL_IEB                     int                            not null AUTO_INCREMENT,
   SERIAL_TIB                     int,
   NUMERODOCUMENTO_IEB            int                            not null,
   FECHA_IEB                      date                           not null,
   TIPODOCUMENTOGENERA_IEB        char(20),
   NUMERODOCUMENTOGENERA_IEB      char(25),
   BODEGAORIGEN_IEB               int,
   BODEGADESTINO_IEB              int,
   NUMEROFACTURA_IEB              char(20),
   AUTORIZACIONSRI_IEB            char(20),
   FECHAAUTORIZACIONSRI_IEB       date,
   PROVEEDORTRANSPORTE_IEB        int,
   ESTADO_IEB                     char(10)                       not null,
   ELABORADOPOR_IEB               int,
   MODIFICADOPOR_IEB              int,
   FECHAMODIFICACION_IEB          date,
   APROBADOPOR_IEB                int,
   FECHAAPROBACION_IEB            date,
   TRANSFERENCIA_IEB              int,
   SERIAL_ORP                     int,
   FECHACADUCIDAD_IEB             date,
   PROVEEDOR_IEB                  int,
   OBSERVACIONES_IEB              char(255),
   LOTE_IEB                       int,
   SERIAL_ODC                     int,
   TOTAL_IEB                      decimal(16,4),
   CLIENTE_IEB                    int,
   SERIAL_FAC                     int,
   SERIAL_FACC                    int,
   MONTODEVUELTO_IEB              decimal(16,4),
   primary key (SERIAL_IEB),
   key AK_NUMERODOCUMENTO_IEB_IDX (NUMERODOCUMENTO_IEB),
   key AK_FECHA_IEB_IDX (FECHA_IEB)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOINGRESOEGRESOINGRESOEGRESOBODEGA_FK               */
/*==============================================================*/
create index TIPOINGRESOEGRESOINGRESOEGRESOBODEGA_FK on INGRESOEGRESODEBODEGA
(
   SERIAL_TIB
);

/*==============================================================*/
/* Table: INSTITUCIONESFINANCIERAS                              */
/*==============================================================*/
create table INSTITUCIONESFINANCIERAS
(
   SERIAL_IFI                     int                            not null AUTO_INCREMENT,
   SERIAL_CIU                     int,
   CODIGO_IFI                     char(10)                       not null,
   NOMBRE_IFI                     char(100)                      not null,
   TIPO_IFI                       char(30),
   SUCURSAL_IFI                   char(40),
   DIRECCION_IFI                  char(64),
   TELEFONO1_IFI                  char(20),
   TELEFONO2_IFI                  char(20),
   FAX_IFI                        char(20),
   OFICIALCREDITO_IFI             char(40),
   OCTELEFONO_IFI                 char(20),
   OCEMAIL_IFI                    char(64),
   OCSOBRENOMBRE_IFI              char(30),
   OCANIVERSARIO_IFI              date,
   GERENTE_IFI                    char(40),
   GTELEFONO_IFI                  char(20),
   GEMAIL_IFI                     char(64),
   GSOBRENOMBRE_IFI               char(30),
   GANIVERSARIO_IFI               date,
   ESTADO_IFI                     char(10),
   primary key (SERIAL_IFI),
   key AK_CODIGO_IFI_IDX (CODIGO_IFI)
)
type = InnoDB;

/*==============================================================*/
/* Index: CIUDADINSTITUCIONFINANCIERA_FK                        */
/*==============================================================*/
create index CIUDADINSTITUCIONFINANCIERA_FK on INSTITUCIONESFINANCIERAS
(
   SERIAL_CIU
);

/*==============================================================*/
/* Table: JERARQUIA                                             */
/*==============================================================*/
create table JERARQUIA
(
   SERIAL_JER                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_JER                     char(3)                        not null,
   NOMBRE_JER                     char(25)                       not null,
   primary key (SERIAL_JER),
   key AK_CODIGO_JER_IDX (CODIGO_JER)
)
type = InnoDB;

/*==============================================================*/
/* Table: JUBILACIONPATRONAL                                    */
/*==============================================================*/
create table JUBILACIONPATRONAL
(
   SERIAL_JUB                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_JUB                     char(7)                        not null,
   NOMBRECOEFICIENTE_JUB          char(40)                       not null,
   EDAD_JUB                       int                            not null,
   DESDEANIO_JUB                  int                            not null,
   HASTAANIO_JUB                  int                            not null,
   CANTIDADBENEFICIO_JUB          decimal(16,2)                  not null,
   COEFICIENTE_JUB                decimal(16,6)                  not null,
   VIGENTEHASTA_JUB               date,
   ESTADO_JUB                     char(10)                       not null,
   primary key (SERIAL_JUB),
   key AK_CODIGO_JUB_IDX (CODIGO_JUB)
)
type = InnoDB;

/*==============================================================*/
/* Table: LIBERACIONPRODUCTO                                    */
/*==============================================================*/
create table LIBERACIONPRODUCTO
(
   SERIAL_LPR                     int                            not null AUTO_INCREMENT,
   CODIGO_LPR                     char(10)                       not null,
   EVENTO_LPR                     char(40),
   LECTURA1_LPR                   char(10),
   LECTURA2_LPR                   char(10),
   LECTURA3_LPR                   char(10),
   PH_LPR                         decimal(5,2),
   OBSERVACIONES_LPR              char(255),
   primary key (SERIAL_LPR)
)
type = InnoDB;

/*==============================================================*/
/* Table: LISTAPRECIOS                                          */
/*==============================================================*/
create table LISTAPRECIOS
(
   SERIAL_LPR                     int                            not null AUTO_INCREMENT,
   SERIAL_TPR                     int,
   SERIAL_PRD                     int,
   VALOR_LPR                      decimal(16,6)                  not null,
   primary key (SERIAL_LPR)
)
type = InnoDB;

/*==============================================================*/
/* Index: LISTAPRECIOSPRODUCTO_FK                               */
/*==============================================================*/
create index LISTAPRECIOSPRODUCTO_FK on LISTAPRECIOS
(
   SERIAL_PRD
);

/*==============================================================*/
/* Index: TIPOSPRECIOSLISTAPRECIOS_FK                           */
/*==============================================================*/
create index TIPOSPRECIOSLISTAPRECIOS_FK on LISTAPRECIOS
(
   SERIAL_TPR
);

/*==============================================================*/
/* Table: MARCAPRODUCTO                                         */
/*==============================================================*/
create table MARCAPRODUCTO
(
   SERIAL_MPR                     int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   CODIGO_MPR                     char(15)                       not null,
   NOMBRE_MPR                     char(64)                       not null,
   FABRICANTE_MPR                 char(64),
   OBSERVACIONES_MPR              char(255),
   primary key (SERIAL_MPR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PRODUCTOMARCAPRODUCTO_FK                              */
/*==============================================================*/
create index PRODUCTOMARCAPRODUCTO_FK on MARCAPRODUCTO
(
   SERIAL_PRD
);

/*==============================================================*/
/* Table: MATERIA_ALUMNO                                        */
/*==============================================================*/
create table MATERIA_ALUMNO
(
   serial_matalu                  int(11)                        not null AUTO_INCREMENT,
   serial_alu                     int(11)                        not null default 0,
   serial_matpro                  int(11)                        default NULL,
   total_matalu                   double                         default NULL,
   nmin_matalu                    double                         default NULL,
   aproba_matalu                  char(1)                        default NULL,
   disc_matalu                    double                         default NULL,
   supletorio_matalu              double                         default NULL,
   nfinal_matalu                  double                         default NULL,
   examenGrado_matalu             double                         default NULL,
   finjust_matalu                 int(11)                        default NULL,
   fjust_matalu                   int(11)                        default NULL,
   atraso_matalu                  int(11)                        default NULL,
   primary key (serial_matalu),
   key FK_materia_alumno_alumno_FK (serial_alu),
   key FK_materia_alumno_materia_profesor_FK (serial_matpro)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "MATERIA_ALUMNO_IBFK_1_FK"                                            */
/*==============================================================*/
create index MATERIA_ALUMNO_IBFK_1_FK
(
   serial_alu
);

/*==============================================================*/
/* Table: MATERIA_CRITERIO                                      */
/*==============================================================*/
create table MATERIA_CRITERIO
(
   serial_matcri                  int(11)                        not null AUTO_INCREMENT,
   serial_cri                     int(11)                        not null default 0,
   serial_matalu                  int(11)                        not null default 0,
   nota_matcri                    float                          default NULL,
   primary key (serial_matcri),
   key FK_materia_criterio_criterio_FK (serial_cri),
   key FK_materia_criterio_materia_alumno_FK (serial_matalu)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "MATERIA_CRITERIO_IBFK_1_FK"                                            */
/*==============================================================*/
create index MATERIA_CRITERIO_IBFK_1_FK
(
   serial_cri
);
/*==============================================================*/
/* Index: "MATERIA_CRITERIO_IBFK_2_FK"                                            */
/*==============================================================*/
create index MATERIA_CRITERIO_IBFK_2_FK
(
   serial_matalu
);

/*==============================================================*/
/* Table: MODULOS                                               */
/*==============================================================*/
create table MODULOS
(
   SERIAL_MOD                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_MOD                     char(6)                        not null,
   NOMBRE_MOD                     char(50)                       not null,
   primary key (SERIAL_MOD),
   key AK_CODIGO_MOD_IDX (CODIGO_MOD)
)
type = InnoDB;

/*==============================================================*/
/* Table: NIVEL                                                 */
/*==============================================================*/
create table NIVEL
(
   serial_niv                     int(11)                        not null AUTO_INCREMENT,
   serial_sec                     int(11)                        not null default 0,
   serial_esp                     int(11)                        default NULL,
   codigo_niv                     char(15)                       default NULL,
   nombre_niv                     char(30)                       not null default '',
   nivel_niv                      char(50)                       default NULL,
   ultimo_niv                     char(1)                        default NULL,
   ciclo_niv                      char(255)                      not null default '',
   primary key (serial_niv),
   key FK_nivel_seccion_FK (serial_sec),
   key ultimo_niv_idx (ultimo_niv),
   key FK_nivel_especialidad_FK (serial_esp),
   key codigo_niv_idx (codigo_niv)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "NIVEL_IBFK_1_FK"                                            */
/*==============================================================*/
create index NIVEL_IBFK_1_FK
(
   serial_esp
);

/*==============================================================*/
/* Table: NIVELCALIFICACION                                     */
/*==============================================================*/
create table NIVELCALIFICACION
(
   SERIAL_NIVC                    int                            not null AUTO_INCREMENT,
   CODIGONIVEL_NIVC               char(3)                        not null,
   DESCRIPCION_NIVC               char(100)                      not null,
   DESDE_NIVC                     int                            not null,
   HASTA_NIVC                     int                            not null,
   primary key (SERIAL_NIVC),
   key AK_CODIGONIVEL_NIVC_IDX (CODIGONIVEL_NIVC)
)
type = InnoDB;

/*==============================================================*/
/* Table: NIVELCALIFICACIONPROVEEDOR                            */
/*==============================================================*/
create table NIVELCALIFICACIONPROVEEDOR
(
   SERIAL_NIVCP                   int                            not null AUTO_INCREMENT,
   CODIGONIVEL_NIVCP              char(3)                        not null,
   DESCRIPCION_NIVCP              char(100)                      not null,
   DESDE_NIVCP                    int                            not null,
   HASTA_NIVCP                    int                            not null,
   primary key (SERIAL_NIVCP),
   key AK_CODIGONIVEL_NIVCP_IDX (CODIGONIVEL_NIVCP)
)
type = InnoDB;

/*==============================================================*/
/* Table: NOVEDADES                                             */
/*==============================================================*/
create table NOVEDADES
(
   SERIAL_NOV                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   SERIAL_EPL                     int(20),
   FECHA_NOV                      date                           not null default '0000-00-00',
   ESTADO_NOV                     char(1)                        not null default '',
   CODIGO_NOV                     char(15)                       not null default '',
   MOTIVO_NOV                     char(255)                      default NULL,
   DESCRIPCION_NOV                char(255)                      not null default '',
   primary key (SERIAL_NOV),
   key AK_FECHA_NOV_IDX (FECHA_NOV),
   key AK_CODIGO_NOV_IDX (CODIGO_NOV)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADONOVEDADES_FK                                  */
/*==============================================================*/
create index EMPLEADONOVEDADES_FK on NOVEDADES
(
   SERIAL_EPL
);

/*==============================================================*/
/* Index: PERIODOROLNOVEDADES_FK                                */
/*==============================================================*/
create index PERIODOROLNOVEDADES_FK on NOVEDADES
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Table: ORDENDECOMPRA                                         */
/*==============================================================*/
create table ORDENDECOMPRA
(
   SERIAL_ODC                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   SERIAL_FORP                    int,
   NUMERODOCUMENTO_ODC            int                            not null,
   TIPOORDENCOMPRA_ODC            char(20)                       not null,
   FECHA_ODC                      date                           not null,
   TOTAL_ODC                      decimal(16,2)                  not null,
   FECHAENTREGA_ODC               date                           not null,
   OBSERVACIONES_ODC              char(200),
   ESTADO_ODC                     char(10)                       not null,
   ELABORADOPOR_ODC               int,
   MODIFICADOPOR_ODC              int,
   FECHAMODIFICACION_ODC          date,
   APROBADOPOR_ODC                int,
   FECHAAPROBACION_ODC            date,
   PLAZODIAS_ODC                  int,
   FECHAINICIO_ODC                date,
   FECHAFIN_ODC                   date,
   DIASREPOSICION_ODC             int,
   primary key (SERIAL_ODC),
   key AK_NUMERODOCUMENTO_ODC_IDX (NUMERODOCUMENTO_ODC),
   key AK_FECHA_ODC_IDX (FECHA_ODC)
)
type = InnoDB;

/*==============================================================*/
/* Index: FORMASPAGOORDENDECOMPRA_FK                            */
/*==============================================================*/
create index FORMASPAGOORDENDECOMPRA_FK on ORDENDECOMPRA
(
   SERIAL_FORP
);

/*==============================================================*/
/* Index: PROVEEDORORDENCOMPRA_FK                               */
/*==============================================================*/
create index PROVEEDORORDENCOMPRA_FK on ORDENDECOMPRA
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: ORDENDEREQUERIMIENTO                                  */
/*==============================================================*/
create table ORDENDEREQUERIMIENTO
(
   SERIAL_ORE                     int                            not null AUTO_INCREMENT,
   SERIAL_ARE                     int,
   SERIAL_EPL                     int(20),
   FECHA_ORE                      date                           not null,
   CODIGO_ORE                     char(12)                       not null,
   NUMERO_ORE                     char(10)                       not null,
   TIPO_ORE                       char(15),
   NECESIDAD_ORE                  char(20),
   PROVEEDOR1_ORE                 int,
   PROVEEDOR2_ORE                 int,
   PROVEEDOR3_ORE                 int,
   APROBADOPOR_ORE                int,
   RECIBIDOPOR_ORE                int,
   ENTREGADOA_ORE                 int,
   FECHAAPROBACION_ORE            date,
   FECHARECEPCION_ORE             date,
   FECHAENTREGA_ORE               date,
   ESTADO_ORE                     char(20),
   OBSERVACION_ORE                char(255),
   primary key (SERIAL_ORE)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOORDENDEREQUERIMIENTO_FK                       */
/*==============================================================*/
create index EMPLEADOORDENDEREQUERIMIENTO_FK on ORDENDEREQUERIMIENTO
(
   SERIAL_EPL
);

/*==============================================================*/
/* Index: AREAORDENDEREQUERIMIENTO_FK                           */
/*==============================================================*/
create index AREAORDENDEREQUERIMIENTO_FK on ORDENDEREQUERIMIENTO
(
   SERIAL_ARE
);

/*==============================================================*/
/* Table: ORDENESEMBARQUE                                       */
/*==============================================================*/
create table ORDENESEMBARQUE
(
   SERIAL_ODE                     int                            not null AUTO_INCREMENT,
   NUMERODOCUMENTO_ODE            char(15)                       not null,
   FECHA_ODE                      date,
   TIPODESPACHO_ODE               char(20),
   FECHAHORADESPACHO_ODE          datetime,
   PROVEEDORTRANSPORTE_ODE        int,
   BODEGA_ODE                     int,
   ESTADO_ODE                     char(15),
   ELABORADOPOR_ODE               int,
   MODIFICADOPOR_ODE              int,
   FECHAMODIFICACION_ODE          date,
   APROBADOPOR_ODE                int,
   FECHAAPROBACION_ODE            date,
   primary key (SERIAL_ODE)
)
type = InnoDB;

/*==============================================================*/
/* Table: ORDENPEDIDO                                           */
/*==============================================================*/
create table ORDENPEDIDO
(
   SERIAL_ORP                     int                            not null AUTO_INCREMENT,
   SERIAL_FORC                    int,
   SERIAL_CLI                     int,
   NUMERO_ORP                     char(25)                       not null,
   FECHA_ORP                      date                           not null,
   ORDENCLIENTE_ORP               char(20)                       not null,
   DIRECCIONENTREGA_ORP           char(80)                       not null,
   FECHAVENCIMIENTO_ORP           date                           not null,
   VENDEDOR_ORP                   int                            not null,
   COBRADOR_ORP                   int                            not null,
   SUBTOTAL_ORP                   decimal(16,2),
   SUMAICE_ORP                    decimal(16,2),
   SUMAIVA12_ORP                  decimal(16,2),
   SUMAIVA0_ORP                   decimal(16,2),
   TOTAL_ORP                      char(20)                       not null,
   DESCUENTO_ORP                  decimal(16,2),
   TOTALCOMISION_ORP              decimal(16,2),
   TASAMORA_ORP                   decimal(5,2),
   ESTADO_ORP                     char(10)                       not null,
   OBSERVACIONES_ORP              char(200),
   ELABORADOPOR_ORP               int,
   MODIFICADOPOR_ORP              int,
   APROBADOPOR_ORP                int,
   FECHAMODIFICACION_ORP          date,
   FECHAAPROBACION_ORP            date,
   CEDULA_ORP                     char(13),
   NOMBRE_ORP                     char(64),
   NUMEROFACTURA_ORP              char(15),
   FECHAPAGO_ORP                  date,
   primary key (SERIAL_ORP),
   key AK_NUMERODOCUMENTO_ORP_IDX (NUMERO_ORP),
   key AK_FECHA_ORP_IDX (FECHA_ORP)
)
type = InnoDB;

/*==============================================================*/
/* Index: CLIENTEORDENPEDIDO_FK                                 */
/*==============================================================*/
create index CLIENTEORDENPEDIDO_FK on ORDENPEDIDO
(
   SERIAL_CLI
);

/*==============================================================*/
/* Index: FORMACOBROORDENPEDIDO_FK                              */
/*==============================================================*/
create index FORMACOBROORDENPEDIDO_FK on ORDENPEDIDO
(
   SERIAL_FORC
);

/*==============================================================*/
/* Table: PAIS                                                  */
/*==============================================================*/
create table PAIS
(
   SERIAL_PAI                     int                            not null default NULL AUTO_INCREMENT,
   CODIGO_PAI                     char(6)                        not null,
   NOMBRE_PAI                     char(60)                       not null,
   CONTINENTE_PAI                 char(20)                       not null,
   UBICACION_PAI                  char(60)                       not null,
   MONEDA_PAI                     char(50),
   LENGUA_PAI                     char(50),
   PREFIJOTELEFONICO_PAI          char(5),
   primary key (SERIAL_PAI),
   key AK_CODIGO_PAI_IDX (CODIGO_PAI)
)
type = InnoDB;

/*==============================================================*/
/* Table: PARALELO                                              */
/*==============================================================*/
create table PARALELO
(
   serial_par                     int(11)                        not null AUTO_INCREMENT,
   serial_per                     int(11)                        not null default 0,
   serial_niv                     int(11)                        not null default 0,
   nombre_par                     char(2)                        not null default '',
   dirigente_par                  int(11)                        default NULL,
   primary key (serial_par),
   key FK_paralelo_nivel_FK (serial_niv),
   key FK_paralelo_periodo_FK (serial_per),
   key nombre_par_idx (nombre_par)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "PARALELO_IBFK_1_FK"                                            */
/*==============================================================*/
create index PARALELO_IBFK_1_FK
(
   serial_niv
);

/*==============================================================*/
/* Table: PARALELO_ALUMNO                                       */
/*==============================================================*/
create table PARALELO_ALUMNO
(
   serial_paralu                  int(11)                        not null AUTO_INCREMENT,
   serial_alu                     int(11)                        not null default 0,
   serial_ban                     int(11)                        default NULL,
   serial_par                     int(11)                        not null default 0,
   activo_paralu                  char(1)                        default NULL,
   aproba_paralu                  char(1)                        default NULL,
   promedio_paralu                decimal(16,2)                  default NULL,
   disc_paralu                    decimal(16,2)                  default NULL,
   numeromatricula_paralu         int(11)                        not null default 0,
   fechamatricula_paralu          date                           not null default '0000-00-00',
   observacion_paralu             varchar(255)                   default NULL,
   serialppe_paralu               int(11)                        default NULL,
   examenesGrado_paralu           decimal(16,2)                  default NULL,
   nota1a5Curso_paralu            decimal(16,2)                  default NULL,
   participacionEstudiantil_paralu decimal(16,2)                  default NULL,
   seccion_paralu                 char(1)                        not null default '',
   actaGrado_paralu               int(11)                        default NULL,
   estadoAlumno_paralu            char(1)                        default NULL,
   formaPago_paralu               varchar(30)                    default NULL,
   tipoCuenta_paralu              varchar(30)                    default NULL,
   numeroCuenta_paralu            varchar(30)                    default NULL,
   quienRetira_paralu             varchar(50)                    default NULL,
   cedulaQuien_paralu             varchar(15)                    default NULL,
   serial_des                     int(11)                        default NULL,
   pago_paralu                    varchar(10)                    not null default '',
   nomtarjeta_paralu              varchar(10)                    not null default '',
   numtarjeta_paralu              varchar(10)                    not null default '',
   primary key (serial_paralu),
   unique key serialppe_paralu_idx (serialppe_paralu),
   key FK_paralelo_alumno_alumno_FK (serial_alu),
   key FK_paralelo_alumno_paralelo_FK (serial_par),
   key bancoParaleloAlumno_FK (serial_ban),
   key numeromatricula_paralu_idx (numeromatricula_paralu),
   key fechamatricula_paralu_idx (fechamatricula_paralu),
   key seccion_paralu_idx (seccion_paralu),
   key aproba_paralu_idx (aproba_paralu),
   key descuentoParAlu_FK (serial_des)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*==============================================================*/
/* Index: "PARALELO_ALUMNO_IBFK_1_FK"                                            */
/*==============================================================*/
create index PARALELO_ALUMNO_IBFK_1_FK
(
   serial_ban
);
/*==============================================================*/
/* Index: "PARALELO_ALUMNO_IBFK_2_FK"                                            */
/*==============================================================*/
create index PARALELO_ALUMNO_IBFK_2_FK
(
   serial_alu
);
/*==============================================================*/
/* Index: "PARALELO_ALUMNO_IBFK_3_FK"                                            */
/*==============================================================*/
create index PARALELO_ALUMNO_IBFK_3_FK
(
   serial_par
);

/*==============================================================*/
/* Table: PARENTESCO                                            */
/*==============================================================*/
create table PARENTESCO
(
   SERIAL_PRT                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_PRT                     char(15)                       not null default '',
   DESCRIPCION_PRT                char(255)                      not null default '',
   primary key (SERIAL_PRT),
   unique key AK_CODIGO_PAR_IDX (CODIGO_PRT)
)
type = InnoDB;

/*==============================================================*/
/* Table: PARENTESCOEMPLEADO                                    */
/*==============================================================*/
create table PARENTESCOEMPLEADO
(
   SERIAL_PAREMP                  int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   SERIAL_PRT                     int(11),
   primary key (SERIAL_PAREMP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PARENTESCOPARENTESCOEMPLEADO_FK                       */
/*==============================================================*/
create index PARENTESCOPARENTESCOEMPLEADO_FK on PARENTESCOEMPLEADO
(
   SERIAL_PRT
);

/*==============================================================*/
/* Index: EMPLEADOPARENTESCOEMPLEADO_FK                         */
/*==============================================================*/
create index EMPLEADOPARENTESCOEMPLEADO_FK on PARENTESCOEMPLEADO
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: PARROQUIA                                             */
/*==============================================================*/
create table PARROQUIA
(
   SERIAL_PAR                     int                            not null AUTO_INCREMENT,
   SERIAL_CIU                     int,
   NOMBRE_PAR                     char(60)                       not null,
   primary key (SERIAL_PAR)
)
type = InnoDB;

/*==============================================================*/
/* Index: CIUDADPARROQUIA_FK                                    */
/*==============================================================*/
create index CIUDADPARROQUIA_FK on PARROQUIA
(
   SERIAL_CIU
);

/*==============================================================*/
/* Table: PERFIL                                                */
/*==============================================================*/
create table PERFIL
(
   SERIAL_PFL                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_PFL                     char(7)                        not null,
   NOMBRE_PFL                     char(40)                       not null,
   DESCRIPCION_PFL                char(255),
   primary key (SERIAL_PFL),
   key AK_CODIGO_PFL_IDX (CODIGO_PFL)
)
type = InnoDB;

/*==============================================================*/
/* Table: PERFILCOMPETENCIAS                                    */
/*==============================================================*/
create table PERFILCOMPETENCIAS
(
   SERIAL_PEC                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_PEC                     char(7)                        not null,
   NIVELEDUCATIVO_PEC             char(50)                       not null,
   NOMBRE_PEC                     char(100)                      not null,
   primary key (SERIAL_PEC),
   key AK_CODIGO_PEC_IDX (CODIGO_PEC)
)
type = InnoDB;

/*==============================================================*/
/* Table: PERIODOCONTABLE                                       */
/*==============================================================*/
create table PERIODOCONTABLE
(
   SERIAL_PCO                     int(11)                        not null AUTO_INCREMENT,
   INICIO_PCO                     date                           not null default '',
   FIN_PCO                        date                           not null default '',
   ESTADO_PCO                     char(15)                       not null default '',
   primary key (SERIAL_PCO)
)
type = InnoDB;

/*==============================================================*/
/* Table: PERIODOROL                                            */
/*==============================================================*/
create table PERIODOROL
(
   SERIAL_PERROL                  int                            not null default NULL AUTO_INCREMENT,
   FECHAINICIO_PERROL             date                           not null default '0000-00-00',
   FECHAFIN_PERROL                date                           not null default '0000-00-00',
   DESCRIPCION_PERROL             char(255)                      not null default '',
   ESTADO_PERROL                  char(2)                        not null default '',
   CERRADO_PERROL                 char(2)                        not null default '',
   primary key (SERIAL_PERROL),
   key AK_FECHAINICIO_PERROL_IDX (FECHAINICIO_PERROL),
   key AK_FECHAFIN_PERROL_IDX (FECHAFIN_PERROL)
)
type = InnoDB;

/*==============================================================*/
/* Table: PERMISOS                                              */
/*==============================================================*/
create table PERMISOS
(
   SERIAL_PER                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   MOTIVO_PER                     char(50)                       not null default '',
   DURACION_PER                   int                            default NULL,
   HORASINICIO_PER                char(12)                       default NULL,
   HORASFIN_PER                   char(12)                       default NULL,
   PAGOSUELDO_PER                 char(1)                        not null default '',
   FECHAINICIO_PER                date                           not null default '0000-00-00',
   FECHAFIN_PER                   date                           not null default '0000-00-00',
   OBSERVACION_PER                char(255)                      not null default '',
   ESTADO_PER                     char(1)                        not null default '',
   primary key (SERIAL_PER),
   key AK_FECHAINICIO_PER_IDX (FECHAINICIO_PER),
   key AK_FECHAFIN_PER_IDX (FECHAFIN_PER)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOPERMISOS_FK                                   */
/*==============================================================*/
create index EMPLEADOPERMISOS_FK on PERMISOS
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: PLANCONTABLE                                          */
/*==============================================================*/
create table PLANCONTABLE
(
   SERIAL_PLC                     int                            not null default NULL AUTO_INCREMENT,
   SERIAL_PLP                     int                            default 0,
   NOMBRE_PLC                     varchar(100)                   not null default '',
   CODIGO_PLC                     varchar(18)                    not null default '',
   TIPO_PLC                       char(15)                       not null default '',
   DESCRIPCION_PLC                varchar(255),
   ESTADO_PLC                     char(12)                       not null default '',
   primary key (SERIAL_PLC),
   unique key AK_CODIGO_PLC (CODIGO_PLC)
)
type = InnoDB;

/*==============================================================*/
/* Index: PLANPRESUPUESTOPLANCONTABLE_FK                        */
/*==============================================================*/
create index PLANPRESUPUESTOPLANCONTABLE_FK on PLANCONTABLE
(
   SERIAL_PLP
);

/*==============================================================*/
/* Table: PLANPRESUPUESTO                                       */
/*==============================================================*/
create table PLANPRESUPUESTO
(
   SERIAL_PLP                     int                            not null default 0 AUTO_INCREMENT,
   NOMBRE_PLP                     char(100)                      default NULL,
   CODIGO_PLP                     char(50)                       default NULL,
   TIPO_PLP                       char(15)                       default NULL,
   DESCRIPCION_PLP                varchar(255)                   default NULL,
   ESTADO_PLP                     char(12)                       default NULL,
   primary key (SERIAL_PLP),
   unique key AK_CODIGO_PLP (CODIGO_PLP)
)
type = InnoDB;

/*==============================================================*/
/* Table: PLANRETENCION                                         */
/*==============================================================*/
create table PLANRETENCION
(
   SERIAL_PLR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PLC                     int                            default NULL,
   NOMBRE_PLR                     varchar(150)                   not null default '',
   DESCRIPCION_PLR                varchar(100)                   not null default '',
   PORCENTAJE_PLR                 double                         not null default 0,
   CODIGOSRI_PLR                  varchar(20)                    not null default '',
   ESTADO_PLR                     varchar(20)                    not null default '',
   primary key (SERIAL_PLR),
   key AK_CODIGO_PLR (NOMBRE_PLR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PLANCONTABLEPLANRETENCION_FK                          */
/*==============================================================*/
create index PLANCONTABLEPLANRETENCION_FK on PLANRETENCION
(
   SERIAL_PLC
);

/*==============================================================*/
/* Table: PRESTAMOSEMPLEADO                                     */
/*==============================================================*/
create table PRESTAMOSEMPLEADO
(
   SERIAL_ANT                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   SERIAL_EPL                     int(20),
   NOMBRE_ANT                     char(255)                      not null default '',
   VALOR_ANT                      double                         not null default 0.00,
   FECHA_ANT                      date                           not null default '0000-00-00',
   ESTADO_ANT                     char(20)                       not null default '',
   OBSERVACION_ANT                char(255)                      default NULL,
   NUMEROPAGOS_ANT                char(1)                        not null default '',
   FECHAINICIO_PEM                date,
   MOTIVO_PEM                     char(255),
   CODIGO_PEM                     char(20),
   PAGOSCANCELADOS_PEM            char(10),
   primary key (SERIAL_ANT),
   key AK_FECHA_ANT_IDX (FECHA_ANT)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLPRESTAMOSEMPLEADOS_FK                       */
/*==============================================================*/
create index PERIODOROLPRESTAMOSEMPLEADOS_FK on PRESTAMOSEMPLEADO
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Index: EMPLEADOPRESTAMOSEMPLEADOS_FK                         */
/*==============================================================*/
create index EMPLEADOPRESTAMOSEMPLEADOS_FK on PRESTAMOSEMPLEADO
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: PROCESOS                                              */
/*==============================================================*/
create table PROCESOS
(
   SERIAL_PRC                     int                            not null AUTO_INCREMENT,
   SERIAL_MOD                     int(11),
   CODIGO_PRC                     char(15)                       not null,
   NOMBRE_PRC                     char(150)                      not null,
   URL_PRC                        char(255)                      not null,
   AUTORIZACION_PRC               char(2)                        not null,
   ICONO_PRC                      char(100),
   primary key (SERIAL_PRC),
   key AK_CODIGO_PRC_IDX (CODIGO_PRC)
)
type = InnoDB;

/*==============================================================*/
/* Index: MODULOSPROCESOS_FK                                    */
/*==============================================================*/
create index MODULOSPROCESOS_FK on PROCESOS
(
   SERIAL_MOD
);

/*==============================================================*/
/* Table: PRODUCTO                                              */
/*==============================================================*/
create table PRODUCTO
(
   SERIAL_PRD                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   SERIAL_TPO                     int,
   SERIAL_LOP                     int,
   CODIGO_PRD                     char(20)                       not null,
   NOMBRE_PRD                     char(80)                       not null,
   COMBO_PRD                      char(2),
   UBICACION_PRD                  char(60),
   BARRASUNITARIOEAN13_PRD        char(13),
   BARRASCAJASEAN14_PRD           char(14),
   BIENSERVICIO_PRD               char(8)                        not null,
   MARCA_PRD                      char(60),
   UNIDADMEDIDA_PRD               char(20),
   DIMENSIONES_PRD                char(40),
   PESO_PRD                       decimal(10,4),
   STOCKMINIMO_PRD                int                            not null,
   STOCKMAXIMO_PRD                int                            not null,
   DESCUENTO_PRD                  decimal(5,2),
   ICE_PRD                        char(10),
   FIJOICE_PRD                    decimal(16,6),
   FOTO_PRD                       char(60),
   METODOCOSTEO_PRD               char(10),
   ESTADO_PRD                     char(10)                       not null,
   UNIDADESEMBALAJE_PRD           int,
   FECHACOSTEO_PRD                date,
   COSTOUNITARIO_PRD              decimal(16,2),
   COSTOPROMEDIO_PRD              decimal(16,2),
   COSTOLOTE_PRD                  decimal(16,2),
   CODIGOALTERNO_PRD              char(15),
   PRECIO1_PRD                    decimal(16,2),
   PRECIO2_PRD                    decimal(16,2),
   PRECIO3_PRD                    decimal(16,2),
   PRECIO4_PRD                    decimal(16,2),
   PRECIO5_PRD                    decimal(16,2),
   FACTURABLE_PRD                 char(2),
   GRABAIVA_PRD                   char(2),
   GRABAICE_PRD                   char(2),
   RENTABILIDAD_PRD               decimal(10,4),
   UNIDADMEDIDAEMBALAJE_PRD       char(30),
   RENTABILIDADMIN_PRD            decimal(10,4),
   STOCKACTUAL_PRD                int,
   BARRASUNITARIOCAJAEAN13_PRD    char(13),
   COSTOCOMPRA_PRD                decimal(10,2),
   COSTOALMACENAMIENTO_PRD        decimal(10,2),
   COSTOORDENAR_PRD               decimal(10,2),
   LOTEACTUAL_PRD                 int,
   FECHAEXPIRACION_PRD            date,
   primary key (SERIAL_PRD),
   key AK_CODIGO_PRD_IDX (CODIGO_PRD),
   key AK_NOMBRE_PRD_IDX (NOMBRE_PRD)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOPRODUCTOPRODUCTO_FK                               */
/*==============================================================*/
create index TIPOPRODUCTOPRODUCTO_FK on PRODUCTO
(
   SERIAL_TPO
);

/*==============================================================*/
/* Index: PROVEEDORPRODUCTO_FK                                  */
/*==============================================================*/
create index PROVEEDORPRODUCTO_FK on PRODUCTO
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: PRODUCTOBODEGA                                        */
/*==============================================================*/
create table PRODUCTOBODEGA
(
   SERIAL_PBO                     int                            not null AUTO_INCREMENT,
   CANTIDAD_PBO                   int,
   primary key (SERIAL_PBO)
)
type = InnoDB;

/*==============================================================*/
/* Table: PROMOCIONESPROVEEDOR                                  */
/*==============================================================*/
create table PROMOCIONESPROVEEDOR
(
   SERIAL_PPV                     int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   SERIAL_PVD                     int,
   CONDICIONES_PPV                char(255),
   INICIO_PPV                     date,
   FIN_PPV                        date,
   DESCUENTO_PPV                  decimal(10,2),
   primary key (SERIAL_PPV)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORPROMOCIONESPROVEEDOR_FK                      */
/*==============================================================*/
create index PROVEEDORPROMOCIONESPROVEEDOR_FK on PROMOCIONESPROVEEDOR
(
   SERIAL_PVD
);

/*==============================================================*/
/* Index: PROMOCIONESPROVEEDORPRODUCTO_FK                       */
/*==============================================================*/
create index PROMOCIONESPROVEEDORPRODUCTO_FK on PROMOCIONESPROVEEDOR
(
   SERIAL_PRD
);

/*==============================================================*/
/* Table: PROVEEDOR                                             */
/*==============================================================*/
create table PROVEEDOR
(
   SERIAL_PVD                     int                            not null AUTO_INCREMENT,
   SERIAL_CIU                     int,
   SERIAL_TPD                     int,
   CODIGO_PVD                     char(20)                       not null,
   PERSONERIAJURIDICA_PVD         char(20)                       not null,
   NOMBRE_PVD                     char(60),
   APELLIDO_PVD                   char(60),
   RAZONSOCIAL_PVD                char(150)                      not null,
   RUCCEDULA_PVD                  char(15)                       not null,
   DIRECCION_PVD                  char(255)                      not null,
   NOMBREREPRESENTANTE_PVD        char(60),
   APELLIDOREPRESENTANTE_PVD      char(60),
   TELEFONO1_PVD                  char(15)                       not null,
   TELEFONO2_PVD                  char(15),
   FAX_PVD                        char(15),
   CELULAR_PVD                    char(15),
   CORREOELECTRONICO_PVD          char(65),
   DESCUENTO_PVD                  decimal(5,2),
   NOMBREVENTAS_PVD               char(60),
   APELLIDOVENTAS_PVD             char(60),
   TELEFONOVENTAS_PVD             char(15),
   CORREOELECTRONICOVENTAS_PVD    char(65),
   NOMBRECOBROS_PVD               char(60),
   APELLIDOCOBROS_PVD             char(60),
   TELEFONOCOBROS_PVD             char(15),
   CORREOELECTRONICOCOBROS_PVD    char(65),
   PROVEEDORDESDE_PVD             date,
   ACTIVIDADECONOMICASRI_PVD      char(255),
   IMPRENTA_PVD                   char(80),
   RUCIMPRENTA_PVD                char(13),
   NUMEROAUTORIZACION_PVD         char(11),
   FECHAAUTORIZACION_PVD          date,
   ESTADO_PVD                     char(10)                       not null,
   CALIFICACION_PVD               int,
   CONTRIBUYENTEESPECIAL_PVD      char(2),
   NUMEROCASA_PVD                 char(10),
   NOMBRECOMERCIAL_PVD            char(100),
   TIPOPROVISION_PVD              char(20),
   TIPODOCUMENTO_PVD              char(25),
   FECHACADUCIDAD_PVD             date,
   PLAZOCREDITO_PVD               int,
   TIPO_PVD                       char(20),
   primary key (SERIAL_PVD),
   key AK_CODIGO_PVD_IDX (CODIGO_PVD),
   key AK_RAZONSOCIAL_PVD_IDX (RAZONSOCIAL_PVD),
   key AK_RUCCEDULA_PVD_IDX (RUCCEDULA_PVD)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOPROVEEDORPROVEEDOR_FK                             */
/*==============================================================*/
create index TIPOPROVEEDORPROVEEDOR_FK on PROVEEDOR
(
   SERIAL_TPD
);

/*==============================================================*/
/* Index: CIUDADPROVEEDOR_FK                                    */
/*==============================================================*/
create index CIUDADPROVEEDOR_FK on PROVEEDOR
(
   SERIAL_CIU
);

/*==============================================================*/
/* Table: PROVEEDORESPRODUCTO                                   */
/*==============================================================*/
create table PROVEEDORESPRODUCTO
(
   SERIAL_PRP                     int                            not null AUTO_INCREMENT,
   SERIAL_PRD                     int,
   SERIAL_PVD                     int,
   PRECIOAPROBADO_PRP             decimal(16,6)                  not null,
   DESCUENTOPROVEEDOR_PRP         decimal(5,2),
   TIEMPODEENTREGA_PRP            int                            not null,
   ATRAZOS_PRP                    int                            not null,
   DEVOLUCIONES_PRP               int,
   OBSERVACIONESCONTROLCALIDAD_PRP char(255),
   ESTADOPROVEEDOR_PRP            char(15)                       not null,
   primary key (SERIAL_PRP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORESPRODUCTOPRODUCTO_FK                        */
/*==============================================================*/
create index PROVEEDORESPRODUCTOPRODUCTO_FK on PROVEEDORESPRODUCTO
(
   SERIAL_PRD
);

/*==============================================================*/
/* Index: PROVEEDORPROVEEDORESPRODUCTO_FK                       */
/*==============================================================*/
create index PROVEEDORPROVEEDORESPRODUCTO_FK on PROVEEDORESPRODUCTO
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: PROVEEDORREBATES                                      */
/*==============================================================*/
create table PROVEEDORREBATES
(
   SERIAL_REB                     int                            not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   DESCRIPCION_REB                char(255)                      not null,
   NOTACREDITO_REB                char(15),
   ENTREGADO_REB                  char(2),
   OBSERVACION_REB                char(255),
   primary key (SERIAL_REB)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORPROVEEDORREBATES_FK                          */
/*==============================================================*/
create index PROVEEDORPROVEEDORREBATES_FK on PROVEEDORREBATES
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: PROVEEDORTIPOACTIVOFIJO                               */
/*==============================================================*/
create table PROVEEDORTIPOACTIVOFIJO
(
   SERIAL_PAF                     int                            not null AUTO_INCREMENT,
   SERIAL_TAF                     int,
   SERIAL_PVD                     int,
   primary key (SERIAL_PAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORPROVEEDORTIPOACTIVOFIJO_FK                   */
/*==============================================================*/
create index PROVEEDORPROVEEDORTIPOACTIVOFIJO_FK on PROVEEDORTIPOACTIVOFIJO
(
   SERIAL_PVD
);

/*==============================================================*/
/* Index: TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO_FK              */
/*==============================================================*/
create index TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO_FK on PROVEEDORTIPOACTIVOFIJO
(
   SERIAL_TAF
);

/*==============================================================*/
/* Table: PROVINCIA                                             */
/*==============================================================*/
create table PROVINCIA
(
   SERIAL_PRV                     int                            not null AUTO_INCREMENT,
   SERIAL_PAI                     int                            default NULL,
   CODIGO_PRV                     char(7)                        not null,
   NOMBRE_PRV                     char(60)                       not null,
   PREFIJOTELEFONICO_PRV          char(3),
   POBLACION_PRV                  int,
   primary key (SERIAL_PRV),
   key AK_CODIGO_PRV_IDX (CODIGO_PRV)
)
type = InnoDB;

/*==============================================================*/
/* Index: PAISPROVINCIA_FK                                      */
/*==============================================================*/
create index PAISPROVINCIA_FK on PROVINCIA
(
   SERIAL_PAI
);

/*==============================================================*/
/* Table: PUNTOSCLIENTE                                         */
/*==============================================================*/
create table PUNTOSCLIENTE
(
   SERIAL_PTO                     int                            not null AUTO_INCREMENT,
   CODIGO_PTO                     char(5)                        not null,
   DESCRIPCION_PTO                char(100)                      not null,
   PUNTOS_PTO                     int                            not null,
   TIPOACCION_PTO                 char(20)                       not null,
   primary key (SERIAL_PTO),
   key AK_CODIGO_PTO_IDX (CODIGO_PTO)
)
type = InnoDB;

/*==============================================================*/
/* Table: PUNTOSPROVEEDOR                                       */
/*==============================================================*/
create table PUNTOSPROVEEDOR
(
   SERIAL_PTP                     int                            not null AUTO_INCREMENT,
   CODIGO_PTP                     char(5)                        not null,
   DESCRIPCION_PTP                char(100)                      not null,
   PUNTOS_PTP                     int                            not null,
   TIPOACCION_PTP                 char(20)                       not null,
   primary key (SERIAL_PTP),
   key AK_CODIGO_PTP_IDX (CODIGO_PTP)
)
type = InnoDB;

/*==============================================================*/
/* Table: REGION                                                */
/*==============================================================*/
create table REGION
(
   SERIAL_REG                     int                            not null AUTO_INCREMENT,
   CODIGO_REG                     char(7)                        not null,
   NOMBRE_REG                     char(60)                       not null,
   primary key (SERIAL_REG),
   key AK_CODIGO_REG_IDX (CODIGO_REG)
)
type = InnoDB;

/*==============================================================*/
/* Table: REGISTROACCIDENTES                                    */
/*==============================================================*/
create table REGISTROACCIDENTES
(
   SERIAL_RAC                     int                            not null AUTO_INCREMENT,
   SERIAL_EPL                     int(20),
   CODIGO_RAC                     char(20)                       not null,
   FECHA_RAC                      date,
   DESCRIPCION_RAC                char(255),
   LUGAR_RAC                      char(40),
   CAUSA_RAC                      char(50),
   CLASIFICACION_RAC              char(30),
   CONSECUENCIA_RAC               char(50),
   ACCIONES_RAC                   char(30),
   OBSERVACIONES_RAC              char(255),
   BAJA_RAC                       char(2),
   TIEMPO_RAC                     char(20),
   COSTO_RAC                      decimal(16,2),
   primary key (SERIAL_RAC)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOREGISTROACCIDENTES_FK                         */
/*==============================================================*/
create index EMPLEADOREGISTROACCIDENTES_FK on REGISTROACCIDENTES
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: REGISTROQUEJASSUGERENCIAS                             */
/*==============================================================*/
create table REGISTROQUEJASSUGERENCIAS
(
   SERIAL_RQS                     int                            not null AUTO_INCREMENT,
   SERIAL_QUE                     int,
   NUMERODOCUMENTO_RQS            int                            not null,
   FECHA_RQS                      datetime                       not null,
   OBSERVACIONES_RQS              char(200)                      not null,
   ESTADO_RQS                     char(10)                       not null,
   ELABORADOPOR_RQS               int,
   MODIFICADOPOR_RQS              int,
   FECHAMODIFICACION_RQS          datetime,
   AUTORIZADOPOR_RQS              int,
   FECHAAUTORIZACION_RQS          datetime,
   TIPOEMISOR_RQS                 char(10),
   TIPODESTINATARIO_RQS           char(10),
   EMISOR_RQS                     int,
   DESTINATARIO_RQS               int,
   INVESTIGACION_RQS              text,
   SEGUIMIENTO_RQS                text,
   primary key (SERIAL_RQS),
   key AK_NUMERODOCUMENTO_RQS_IDX (NUMERODOCUMENTO_RQS),
   key AK_FECHA_RQS_IDX (FECHA_RQS)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS_FK    */
/*==============================================================*/
create index TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS_FK on REGISTROQUEJASSUGERENCIAS
(
   SERIAL_QUE
);

/*==============================================================*/
/* Table: ROLPAGOSGENERAL                                       */
/*==============================================================*/
create table ROLPAGOSGENERAL
(
   SERIAL_ROP                     int                            not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   OBSERVACIONES_ROP              char(255),
   FECHA_ROP                      date,
   ESTADO_ROP                     char(20),
   primary key (SERIAL_ROP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLROLPAGOSGENERAL_FK                          */
/*==============================================================*/
create index PERIODOROLROLPAGOSGENERAL_FK on ROLPAGOSGENERAL
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Table: RUBROGENERALROLPAGOS                                  */
/*==============================================================*/
create table RUBROGENERALROLPAGOS
(
   SERIAL_RGR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PLC                     int                            default NULL,
   SERIAL_TCT                     int(11),
   CODIGO_RGR                     char(20),
   TIPO_RGR                       char(15)                       not null default '',
   FECHAREGISTRO_RGR              date                           not null default '0000-00-00',
   NOMBRE_RGR                     char(255)                      not null default '',
   FRECUENCIA_RGR                 int                            not null default 0,
   FORMULA_RGR                    char(255)                      not null default '',
   FECHAINICIO_RGR                date                           not null default '0000-00-00',
   ESTADO_RGR                     char(20)                       not null default '',
   ACEPTAANTICIPOS_RGR            char(2)                        default NULL,
   DESPLEGARROL_RGR               char(2)                        not null default '',
   AFECTAIESS_RGR                 char(2)                        not null default '',
   QUINCENAL_RGR                  char(2)                        default NULL,
   AFECTAIMPUESTO_RGR             char(2)                        default NULL,
   PROYECCIONIMPUESTO_RGR         char(2)                        default NULL,
   primary key (SERIAL_RGR),
   key AK_FECHAINICIO_RUBROL_IDX (FECHAINICIO_RGR)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS_FK           */
/*==============================================================*/
create index TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS_FK on RUBROGENERALROLPAGOS
(
   SERIAL_TCT
);

/*==============================================================*/
/* Index: PLANCONTABLERUBROGENERALROLPAGOS_FK                   */
/*==============================================================*/
create index PLANCONTABLERUBROGENERALROLPAGOS_FK on RUBROGENERALROLPAGOS
(
   SERIAL_PLC
);

/*==============================================================*/
/* Table: RUTA                                                  */
/*==============================================================*/
create table RUTA
(
   SERIAL_RUT                     int                            not null AUTO_INCREMENT,
   SERIAL_ZON                     int,
   CODIGO_RUT                     char(7)                        not null,
   NOMBRE_RUT                     char(60)                       not null,
   GERENTEVENTAS_RUT              int,
   JEFEVENTAS_RUT                 int,
   SUPERVISOR_RUT                 int,
   VENDEDOR_RUT                   int,
   COBRADOR_RUT                   int,
   FRECUENCIA_RUT                 char(40),
   LUNES_RUT                      char(2),
   MARTES_RUT                     char(2),
   MIERCOLES_RUT                  char(2),
   JUEVES_RUT                     char(2),
   VIERNES_RUT                    char(2),
   SABADO_RUT                     char(2),
   DOMINGO_RUT                    char(2),
   LIMITENORTE_RUT                char(100),
   LIMITESUR_RUT                  char(100),
   LIMITEESTE_RUT                 char(100),
   LIMITEOESTE_RUT                char(100),
   primary key (SERIAL_RUT),
   key AK_CODIGO_RUT_IDX (CODIGO_RUT)
)
type = InnoDB;

/*==============================================================*/
/* Index: ZONARUTA_FK                                           */
/*==============================================================*/
create index ZONARUTA_FK on RUTA
(
   SERIAL_ZON
);

/*==============================================================*/
/* Table: SOLICITUDDOTACION                                     */
/*==============================================================*/
create table SOLICITUDDOTACION
(
   SERIAL_SDO                     int                            not null AUTO_INCREMENT,
   SERIAL_ARE                     int,
   SERIAL_EPL                     int(20),
   CODIGO_SDO                     char(10)                       not null,
   NUMERO_SDO                     char(10)                       not null,
   FECHA_SDO                      date,
   APROBADOPOR_SDO                int,
   ENTREGADOPOR_SDO               int,
   RECIBIDOPOR_SDO                int,
   primary key (SERIAL_SDO)
)
type = InnoDB;

/*==============================================================*/
/* Index: EMPLEADOSOLICITUDDOTACION_FK                          */
/*==============================================================*/
create index EMPLEADOSOLICITUDDOTACION_FK on SOLICITUDDOTACION
(
   SERIAL_EPL
);

/*==============================================================*/
/* Index: AREASOLICITUDDOTACION_FK                              */
/*==============================================================*/
create index AREASOLICITUDDOTACION_FK on SOLICITUDDOTACION
(
   SERIAL_ARE
);

/*==============================================================*/
/* Table: SUCURSAL                                              */
/*==============================================================*/
create table SUCURSAL
(
   SERIAL_SUC                     int                            not null AUTO_INCREMENT,
   SERIAL_CIU                     int,
   SERIAL_EMP                     int,
   CODIGO_SUC                     char(7)                        not null,
   NOMBRE_SUC                     char(50)                       not null,
   DIRECCION_SUC                  char(100)                      not null,
   MATRIZ_SUC                     char(2)                        not null,
   TELEFONO_SUC                   char(20),
   TELEFONO2_SUC                  char(20),
   TELEFONO3_SUC                  char(20),
   TELEFONO4_SUC                  char(20),
   FAX_SUC                        char(20),
   EMAIL_SUC                      char(60),
   primary key (SERIAL_SUC),
   key AK_CODIGO_SUC_IDX (CODIGO_SUC)
)
type = InnoDB;

/*==============================================================*/
/* Index: CIUDADSUCURSAL_FK                                     */
/*==============================================================*/
create index CIUDADSUCURSAL_FK on SUCURSAL
(
   SERIAL_CIU
);

/*==============================================================*/
/* Index: EMPRESASUCURSAL_FK                                    */
/*==============================================================*/
create index EMPRESASUCURSAL_FK on SUCURSAL
(
   SERIAL_EMP
);

/*==============================================================*/
/* Table: SUCURSALDEPARTAMENTOS                                 */
/*==============================================================*/
create table SUCURSALDEPARTAMENTOS
(
   SERIAL_DESC                    int(11)                        not null AUTO_INCREMENT,
   SERIAL_SUC                     int,
   SERIAL_DEP                     int                            default NULL,
   primary key (SERIAL_DESC)
)
type = InnoDB;

/*==============================================================*/
/* Index: SUCURSALSUCURSALDEPARTAMENTO_FK                       */
/*==============================================================*/
create index SUCURSALSUCURSALDEPARTAMENTO_FK on SUCURSALDEPARTAMENTOS
(
   SERIAL_SUC
);

/*==============================================================*/
/* Index: DEPARTAMENTOSUCURSALDEPARTAMENTO_FK                   */
/*==============================================================*/
create index DEPARTAMENTOSUCURSALDEPARTAMENTO_FK on SUCURSALDEPARTAMENTOS
(
   SERIAL_DEP
);

/*==============================================================*/
/* Table: TABLACASTIGOCOMISIONES                                */
/*==============================================================*/
create table TABLACASTIGOCOMISIONES
(
   SERIAL_CASC                    int                            not null AUTO_INCREMENT,
   DESDE_CASC                     int                            not null,
   HASTA_CASC                     int                            not null,
   CASTIGO_CASC                   decimal(5,2)                   not null,
   primary key (SERIAL_CASC)
)
type = InnoDB;

/*==============================================================*/
/* Table: TABLACOMISIONESCARGO                                  */
/*==============================================================*/
create table TABLACOMISIONESCARGO
(
   SERIAL_COC                     int                            not null AUTO_INCREMENT,
   SERIAL_CAR                     int(11),
   COMISIONVENTA_COC              decimal(5,2)                   not null,
   COMISIONCOBRO_COC              decimal(5,2),
   COMISIONTELEMARKETING_COC      decimal(5,2),
   primary key (SERIAL_COC)
)
type = InnoDB;

/*==============================================================*/
/* Index: CARGOSTABLACOMISIONESCARGO_FK                         */
/*==============================================================*/
create index CARGOSTABLACOMISIONESCARGO_FK on TABLACOMISIONESCARGO
(
   SERIAL_CAR
);

/*==============================================================*/
/* Table: TABLACOMISIONESPRODUCTO                               */
/*==============================================================*/
create table TABLACOMISIONESPRODUCTO
(
   SERIAL_COP                     int                            not null AUTO_INCREMENT,
   SERIAL_TIP                     int,
   SERIAL_PRD                     int,
   COMISION_COP                   decimal(5,2)                   not null,
   primary key (SERIAL_COP)
)
type = InnoDB;

/*==============================================================*/
/* Index: PRODUCTOTABLACOMISIONESPRODUCTO_FK                    */
/*==============================================================*/
create index PRODUCTOTABLACOMISIONESPRODUCTO_FK on TABLACOMISIONESPRODUCTO
(
   SERIAL_PRD
);

/*==============================================================*/
/* Index: TIPOCLIENTETABLACOMISIONPRODUCTO_FK                   */
/*==============================================================*/
create index TIPOCLIENTETABLACOMISIONPRODUCTO_FK on TABLACOMISIONESPRODUCTO
(
   SERIAL_TIP
);

/*==============================================================*/
/* Table: TABLAIMPUESTORENTA                                    */
/*==============================================================*/
create table TABLAIMPUESTORENTA
(
   SERIAL_TIR                     int(11)                        not null AUTO_INCREMENT,
   BASICA_TIR                     double                         not null default 0,
   EXCEDENTE_TIR                  double                         not null default 0,
   FRACCIONBASICA_TIR             float                          not null default 0,
   FRACCIONEXCEDENTE_TIR          float                          not null default 0,
   ANIO_TIR                       int,
   ESTADO_TIR                     char(20),
   primary key (SERIAL_TIR),
   key AK_BASICA_TIR_IDX (BASICA_TIR),
   key AK_EXCEDENTE_TIR (EXCEDENTE_TIR),
   key AK_FRACCIONBASICA_TIR (FRACCIONBASICA_TIR),
   key AK_FRACCIONEXCEDENTE_TIR (FRACCIONEXCEDENTE_TIR)
)
type = InnoDB;

/*==============================================================*/
/* Table: TABLALIQUIDACION                                      */
/*==============================================================*/
create table TABLALIQUIDACION
(
   SERIAL_TAL                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_TAL                     char(7)                        not null,
   NOMBRE_TAL                     char(40)                       not null,
   DESDEANIO_TAL                  int                            not null,
   HASTAANIO_TAL                  int                            not null,
   CANTIDADBENEFICIO_TAL          int                            not null,
   VIGENTEHASTA_TAL               date,
   ESTADO_TAL                     char(10)                       not null,
   primary key (SERIAL_TAL),
   key AK_CODIGO_TAL_IDX (CODIGO_TAL)
)
type = InnoDB;

/*==============================================================*/
/* Table: TABLASRI                                              */
/*==============================================================*/
create table TABLASRI
(
   SERIAL_TSR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PERROL                  int                            default NULL,
   SERIAL_EPL                     int(20),
   ANIO_TSR                       char(4)                        not null default '',
   INGRESOS_TSR                   double                         default NULL,
   INGRESOSLIQUIDOS_TSR           double                         default NULL,
   IESSMES_TSR                    double                         default NULL,
   BASICA_TSR                     double                         default 0.00,
   EXCEDENTE_TSR                  double                         default 0.00,
   FRACCIONBASICA_TSR             double                         default 0.00,
   FRACCIONEXCEDENTE_TSR          double                         default 0.00,
   INGRESODESDE_TSR               double                         default NULL,
   INGRESOHASTA_TSR               double                         default NULL,
   IMPUESTOBASICA_TSR             double                         default NULL,
   IMPUESTOEXCEDENTE_TSR          double                         default NULL,
   BASEIMPONIBLE_TSR              double                         default NULL,
   VALORRETENIDO_TSR              double                         default NULL,
   ESTADO_TSR                     char(1)                        not null default '',
   primary key (SERIAL_TSR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERIODOROLTABLASRI_FK                                 */
/*==============================================================*/
create index PERIODOROLTABLASRI_FK on TABLASRI
(
   SERIAL_PERROL
);

/*==============================================================*/
/* Index: EMPLEADOTABLASRI_FK                                   */
/*==============================================================*/
create index EMPLEADOTABLASRI_FK on TABLASRI
(
   SERIAL_EPL
);

/*==============================================================*/
/* Table: TASAS                                                 */
/*==============================================================*/
create table TASAS
(
   SERIAL_TAS                     int                            not null AUTO_INCREMENT,
   SERIAL_PAI                     int                            default NULL,
   SERIAL_TTA                     int,
   FECHA_TAS                      date                           not null,
   VALOR_TAS                      decimal(16,2)                  not null,
   primary key (SERIAL_TAS),
   key AK_FECHA_TAS_IDX (FECHA_TAS)
)
type = InnoDB;

/*==============================================================*/
/* Index: TIPOTASASTASAS_FK                                     */
/*==============================================================*/
create index TIPOTASASTASAS_FK on TASAS
(
   SERIAL_TTA
);

/*==============================================================*/
/* Index: PAISTASAS_FK                                          */
/*==============================================================*/
create index PAISTASAS_FK on TASAS
(
   SERIAL_PAI
);

/*==============================================================*/
/* Table: TEMPLATE                                              */
/*==============================================================*/
create table TEMPLATE
(
   SERIAL_TEM                     int                            not null AUTO_INCREMENT,
   NOMBRE_TEM                     char(30),
   DIRECTORIO_TEM                 char(255),
   primary key (SERIAL_TEM)
)
type = InnoDB;

/*==============================================================*/
/* Table: TERCIARIZADORA                                        */
/*==============================================================*/
create table TERCIARIZADORA
(
   SERIAL_TEZ                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PVD                     int,
   COMISION_TEZ                   decimal(5,2)                   not null,
   FECHARENOVACION_TEZ            date                           not null,
   primary key (SERIAL_TEZ)
)
type = InnoDB;

/*==============================================================*/
/* Index: PROVEEDORTERCIARIZADORA_FK                            */
/*==============================================================*/
create index PROVEEDORTERCIARIZADORA_FK on TERCIARIZADORA
(
   SERIAL_PVD
);

/*==============================================================*/
/* Table: TIPOACTIVOFIJO                                        */
/*==============================================================*/
create table TIPOACTIVOFIJO
(
   SERIAL_TAF                     int                            not null AUTO_INCREMENT,
   SERIAL_CLAF                    int,
   SERIAL_FAF                     int,
   CODIGO_TAF                     char(7)                        not null,
   NOMBRE_TAF                     char(50)                       not null,
   TIPO_TAF                       char(20)                       not null,
   TANGIBLE_TAF                   char(2)                        not null,
   TIPODEPRECIACION_TAF           char(20),
   VIDAUTIL_TAF                   int,
   ATRIBUTO1_TAF                  char(50),
   ATRIBUTO2_TAF                  char(50),
   ATRIBUTO3_TAF                  char(50),
   ATRIBUTO4_TAF                  char(50),
   ATRIBUTO5_TAF                  char(50),
   ATRIBUTO6_TAF                  char(50),
   ATRIBUTO7_TAF                  char(50),
   ATRIBUTO8_TAF                  char(50),
   primary key (SERIAL_TAF),
   key AK_CODIGO_TAF_IDX (CODIGO_TAF)
)
type = InnoDB;

/*==============================================================*/
/* Index: FAMILIAACTIVOFIJOTIPOACTIVOFIJO_FK                    */
/*==============================================================*/
create index FAMILIAACTIVOFIJOTIPOACTIVOFIJO_FK on TIPOACTIVOFIJO
(
   SERIAL_FAF
);

/*==============================================================*/
/* Index: CLASEACTIVOFIJOTIPOACTIVOFIJO_FK                      */
/*==============================================================*/
create index CLASEACTIVOFIJOTIPOACTIVOFIJO_FK on TIPOACTIVOFIJO
(
   SERIAL_CLAF
);

/*==============================================================*/
/* Table: TIPOBODEGA                                            */
/*==============================================================*/
create table TIPOBODEGA
(
   SERIAL_TBO                     int                            not null AUTO_INCREMENT,
   CODIGO_TBO                     char(7)                        not null,
   NOMBRE_TBO                     char(30)                       not null,
   primary key (SERIAL_TBO),
   key AK_CODIGO_TBO_IDX (CODIGO_TBO)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOCLIENTE                                           */
/*==============================================================*/
create table TIPOCLIENTE
(
   SERIAL_TIP                     int                            not null AUTO_INCREMENT,
   CODIGO_TIP                     char(5)                        not null,
   NOMBRE_TIP                     char(40)                       not null,
   DESCRIPCION_TIP                char(60)                       not null,
   primary key (SERIAL_TIP)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOCOMPRA                                            */
/*==============================================================*/
create table TIPOCOMPRA
(
   SERIAL_TCM                     int                            not null AUTO_INCREMENT,
   CODIGO_TCM                     char(7)                        not null,
   NOMBRE_TCM                     char(100)                      not null,
   DEVOLUCIONIVA_TCM              char(2)                        not null,
   CLASE_TCM                      char(20)                       not null,
   KARDEX_TCM                     char(2),
   DEDUCIBLE_TCM                  char(2),
   ESTADO_TCM                     char(10),
   primary key (SERIAL_TCM),
   key AK_CODIGO_TCM_IDX (CODIGO_TCM)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOCOMPROBANTE                                       */
/*==============================================================*/
create table TIPOCOMPROBANTE
(
   SERIAL_TIC                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_TIC                     char(10)                       default NULL,
   NUMERO_TIC                     int                            not null default 0,
   DESCRIPCION_TIC                char(250)                      default NULL,
   primary key (SERIAL_TIC),
   unique key AK_CODIGO_TIC (CODIGO_TIC)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOCONTRATOSTRABAJO                                  */
/*==============================================================*/
create table TIPOCONTRATOSTRABAJO
(
   SERIAL_TCT                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_TCT                     char(7)                        not null,
   NOMBRE_TCT                     char(60)                       not null,
   DECIMOTERCERO_TCT              char(2),
   DECIMOCUARTO_TCT               int,
   VACACIONES_TCT                 int,
   FONDORESERVA_TCT               int,
   HORAEXTRA_TCT                  int,
   HORASUPLEMENTARIA_TCT          int,
   LIQUIDACION_TCT                char(2),
   DESAHUCIO_TCT                  char(2),
   JUBILACION_TCT                 char(2),
   APORTEPATRONAL_TCT             int,
   APORTEPERSONAL_TCT             int,
   UTILIDADES_TCT                 char(2),
   CONTRATOMODELO_TCT             char(255)                      not null,
   ESTADO_TCT                     char(10),
   primary key (SERIAL_TCT),
   key AK_CODIGO_TCT_IDX (CODIGO_TCT)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOESCALAFONES                                       */
/*==============================================================*/
create table TIPOESCALAFONES
(
   SERIAL_TES                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_TES                     char(7)                        not null,
   NOMBRE_TES                     char(30)                       not null,
   primary key (SERIAL_TES),
   key AK_CODIGO_TES_IDX (CODIGO_TES)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOINGRESOEGRESOBODEGA                               */
/*==============================================================*/
create table TIPOINGRESOEGRESOBODEGA
(
   SERIAL_TIB                     int                            not null AUTO_INCREMENT,
   CODIGO_TIB                     char(7)                        not null,
   NOMBRE_TIB                     char(40)                       not null,
   TIPO_TIB                       char(7)                        not null,
   TIPODOCUMENTO_TIB              char(21)                       not null,
   primary key (SERIAL_TIB),
   key AK_CODIGO_TIB_IDX (CODIGO_TIB)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOPRODUCTO                                          */
/*==============================================================*/
create table TIPOPRODUCTO
(
   SERIAL_TPO                     int                            not null AUTO_INCREMENT,
   SERIAL_CAP                     int,
   CODIGO_TPO                     char(7)                        not null,
   TIPOSRI_TPO                    char(3)                        not null,
   NOMBRE_TPO                     char(64)                       not null,
   DESCRIPCION_TPO                char(200)                      not null,
   DIASCADUCIDAD_TPO              int,
   primary key (SERIAL_TPO),
   key AK_CODIGO_TPO_IDX (CODIGO_TPO)
)
type = InnoDB;

/*==============================================================*/
/* Index: CATEGORIAPRODUCTOTIPOPRODUCTO_FK                      */
/*==============================================================*/
create index CATEGORIAPRODUCTOTIPOPRODUCTO_FK on TIPOPRODUCTO
(
   SERIAL_CAP
);

/*==============================================================*/
/* Table: TIPOPROVEEDOR                                         */
/*==============================================================*/
create table TIPOPROVEEDOR
(
   SERIAL_TPD                     int                            not null AUTO_INCREMENT,
   SERIAL_PLC                     int                            default NULL,
   CODIGO_TPD                     char(7)                        not null,
   NOMBRE_TPD                     char(60)                       not null,
   RETENCIONIVA_TPD               int,
   RETENCIONIRF_TPD               int,
   primary key (SERIAL_TPD),
   key AK_CODIGO_TPD_IDX (CODIGO_TPD)
)
type = InnoDB;

/*==============================================================*/
/* Index: PLANCONTABLETIPOPROVEEDOR_FK                          */
/*==============================================================*/
create index PLANCONTABLETIPOPROVEEDOR_FK on TIPOPROVEEDOR
(
   SERIAL_PLC
);

/*==============================================================*/
/* Table: TIPOSPRECIOS                                          */
/*==============================================================*/
create table TIPOSPRECIOS
(
   SERIAL_TPR                     int                            not null AUTO_INCREMENT,
   CODIGO_TPR                     char(7)                        not null,
   NOMBRE_TPR                     char(40)                       not null,
   primary key (SERIAL_TPR),
   key AK_CODIGO_TPR_IDX (CODIGO_TPR)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOSQUEJASSUGERENCIAS                                */
/*==============================================================*/
create table TIPOSQUEJASSUGERENCIAS
(
   SERIAL_QUE                     int                            not null AUTO_INCREMENT,
   CODIGO_QUE                     char(7)                        not null,
   DESCRIPCION_QUS                char(100)                      not null,
   TIPO_QUS                       char(10)                       not null,
   primary key (SERIAL_QUE),
   key AK_CODIGO_QUE_IDX (CODIGO_QUE)
)
type = InnoDB;

/*==============================================================*/
/* Table: TIPOTASAS                                             */
/*==============================================================*/
create table TIPOTASAS
(
   SERIAL_TTA                     int                            not null AUTO_INCREMENT,
   CODIGO_TTA                     char(6)                        not null,
   NOMBRE_TTA                     char(60)                       not null,
   primary key (SERIAL_TTA),
   key AK_CODIGO_TTA_IDX (CODIGO_TTA)
)
type = InnoDB;

/*==============================================================*/
/* Table: TURNOS                                                */
/*==============================================================*/
create table TURNOS
(
   SERIAL_TUR                     int(11)                        not null AUTO_INCREMENT,
   CODIGO_TUR                     char(7)                        not null,
   NOMBRE_TUR                     char(20)                       not null,
   FECHAINICIO_TUR                date                           not null,
   FECHAFIN_TUR                   date                           not null,
   LUNESENTRADA_TUR               time,
   LUNESSALIDALUNCH_TUR           time,
   LUNESENTRADALUNCH_TUR          time,
   LUNESSALIDA_TUR                time,
   MARTESENTRADA_TUR              time,
   MARTESSALIDALUNCH_TUR          time,
   MARTESENTRADALUNCH_TUR         time,
   MARTESSALIDA_TUR               time,
   MIERCOLESENTRADA_TUR           time,
   MIERCOLESSALIDALUNCH_TUR       time,
   MIERCOLESENTRADALUNCH_TUR      time,
   MIERCOLESSALIDA_TUR            time,
   JUEVESENTRADA_TUR              time,
   JUEVESSALIDALUNCH_TUR          time,
   JUEVESENTRADALUNCH_TUR         time,
   JUEVESSALIDA_TUR               time,
   VIERNESENTRADA_TUR             time,
   VIERNESSALIDALUNCH_TUR         time,
   VIERNESENTRADALUNCH_TUR        time,
   VIERNESSALIDA_TUR              time,
   SABADOENTRADA_TUR              time,
   SABADOSALIDALUNCH_TUR          time,
   SABADOENTRADALUNCH_TUR         time,
   SABADOSALIDA_TUR               time,
   DOMINGOENTRADA_TUR             time,
   DOMINGOSALIDALUNCH_TUR         time,
   DOMINGOENTRADALUNCH_TUR        time,
   DOMINGOSALIDA_TUR              time,
   primary key (SERIAL_TUR),
   key AK_CODIGO_TUR_IDX (CODIGO_TUR)
)
type = InnoDB;

/*==============================================================*/
/* Table: UBICACION                                             */
/*==============================================================*/
create table UBICACION
(
   SERIAL_UBI                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_DESC                    int(11),
   CODIGO_UBI                     char(50)                       not null default '',
   NOMBRE_UBI                     char(100)                      not null default '',
   DESCRIPCION_UBI                char(200)                      default NULL,
   primary key (SERIAL_UBI),
   unique key AK_CODIGO_UBI (CODIGO_UBI)
)
type = InnoDB;

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOSUBICACION_FK                     */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOSUBICACION_FK on UBICACION
(
   SERIAL_DESC
);

/*==============================================================*/
/* Table: UBICACIONBODEGA                                       */
/*==============================================================*/
create table UBICACIONBODEGA
(
   SERIAL_UBO                     int                            not null AUTO_INCREMENT,
   SERIAL_BOD                     int,
   ESTANTE_UBO                    char(60),
   FILA_UBO                       char(60),
   NIVEL_UBO                      char(60),
   primary key (SERIAL_UBO)
)
type = InnoDB;

/*==============================================================*/
/* Index: BODEGAUBICACIONBODEGA_FK                              */
/*==============================================================*/
create index BODEGAUBICACIONBODEGA_FK on UBICACIONBODEGA
(
   SERIAL_BOD
);

/*==============================================================*/
/* Table: UNIDADMEDIDA                                          */
/*==============================================================*/
create table UNIDADMEDIDA
(
   SERIAL_UME                     int                            not null AUTO_INCREMENT,
   NOMBRE_UME                     char(25)                       not null,
   TIPO_UME                       char(15),
   primary key (SERIAL_UME)
)
type = InnoDB;

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table USUARIO
(
   SERIAL_USR                     int(11)                        not null AUTO_INCREMENT,
   SERIAL_PFL                     int(11),
   CODIGO_USR                     char(10)                       not null default '',
   CLAVE_USR                      char(32)                       not null default '',
   NOMBRE_USR                     char(20)                       not null default '',
   APELLIDO_USR                   char(20)                       not null default '',
   NOMBRE2_USR                    char(20)                       not null default '',
   APELLIDO2_USR                  char(20)                       not null default '',
   TELEFONO_USR                   char(10)                       default NULL,
   EXTENSION_USR                  char(5)                        default NULL,
   CELULAR_USR                    char(10)                       default NULL,
   EMAIL_USR                      char(64)                       default NULL,
   FECHA_USR                      date                           default NULL,
   FOTO_USR                       char(250),
   ESTADO_USR                     char(20)                       not null default '',
   CAMBIO_USR                     char(2)                        not null default '',
   IPACCESO_USR                   char(16),
   ENELSISTEMA_USR                char(2),
   MODOACCESO_USR                 char(10),
   SERIAL_EPL                     int,
   primary key (SERIAL_USR),
   unique key AK_CODIGO_USR_IDX (CODIGO_USR),
   key AK_APELLIDO_USR_IDX (APELLIDO_USR, APELLIDO2_USR, NOMBRE_USR, NOMBRE2_USR)
)
type = InnoDB;

/*==============================================================*/
/* Index: PERFILUSUARIO_FK                                      */
/*==============================================================*/
create index PERFILUSUARIO_FK on USUARIO
(
   SERIAL_PFL
);

/*==============================================================*/
/* Table: USUARIOSUCURSAL                                       */
/*==============================================================*/
create table USUARIOSUCURSAL
(
   SERIAL_USU                     int                            not null AUTO_INCREMENT,
   SERIAL_DESC                    int(11),
   SERIAL_USR                     int(11),
   primary key (SERIAL_USU)
)
type = InnoDB;

/*==============================================================*/
/* Index: USUARIOUSUARIOSUCURSAL_FK                             */
/*==============================================================*/
create index USUARIOUSUARIOSUCURSAL_FK on USUARIOSUCURSAL
(
   SERIAL_USR
);

/*==============================================================*/
/* Index: SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL_FK               */
/*==============================================================*/
create index SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL_FK on USUARIOSUCURSAL
(
   SERIAL_DESC
);

/*==============================================================*/
/* Table: VARIABLESMODULO                                       */
/*==============================================================*/
create table VARIABLESMODULO
(
   SERIAL_VAM                     int                            not null AUTO_INCREMENT,
   SERIAL_MOD                     int(11),
   NOMBRELOGICO_VAM               char(25)                       not null,
   TABLA_VAM                      char(25)                       not null,
   NOMBREFISICO_VAM               char(25)                       not null,
   PRIMARYKEY_VAM                 char(25),
   DESCRIPCION_VAM                char(255),
   primary key (SERIAL_VAM)
)
type = InnoDB;

/*==============================================================*/
/* Index: MODULOSVARIABLESMODULO_FK                             */
/*==============================================================*/
create index MODULOSVARIABLESMODULO_FK on VARIABLESMODULO
(
   SERIAL_MOD
);

/*==============================================================*/
/* Table: ZONA                                                  */
/*==============================================================*/
create table ZONA
(
   SERIAL_ZON                     int                            not null AUTO_INCREMENT,
   SERIAL_REG                     int,
   CODIGO_ZON                     char(7)                        not null,
   NOMBRE_ZON                     char(60)                       not null,
   primary key (SERIAL_ZON),
   key AK_CODIGO_ZON_IDX (CODIGO_ZON)
)
type = InnoDB;

/*==============================================================*/
/* Index: REGIONZONA_FK                                         */
/*==============================================================*/
create index REGIONZONA_FK on ZONA
(
   SERIAL_REG
);

alter table ACCIONPROCESO add constraint FK_PERFILACCIONPROCESO foreign key (SERIAL_PFL)
      references PERFIL (SERIAL_PFL) on delete restrict on update restrict;

alter table ACCIONPROCESO add constraint FK_PROCESOSACCIONPROCESO foreign key (SERIAL_PRC)
      references PROCESOS (SERIAL_PRC) on delete restrict on update restrict;

alter table ACTIVOSFIJOS add constraint FK_PROVEEDORACTIVOFIJO foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table ACTIVOSFIJOS add constraint FK_SUCURSALDEPARTAMENTOACTIVOFIJO foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table ACTIVOSFIJOS add constraint FK_TIPOACTIVOFIJOACTIVOFIJO foreign key (SERIAL_TAF)
      references TIPOACTIVOFIJO (SERIAL_TAF) on delete restrict on update restrict;

alter table ANTICIPOS add constraint FK_EMPLEADOANTICPOS foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table ANTICIPOS add constraint FK_PERIODOROLANTICIPOS foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table APROBACION add constraint FK_PERFILAPROBACION foreign key (SERIAL_PFL)
      references PERFIL (SERIAL_PFL) on delete restrict on update restrict;

alter table APROBACION add constraint FK_PROCESOAPROBACION foreign key (SERIAL_PRC)
      references PROCESOS (SERIAL_PRC) on delete restrict on update restrict;

alter table AREA add constraint FK_SUCURSALDEPARTAMENTOSAREA foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table ASIGNACIONACTIVOSFIJOS add constraint FK_ACTIVOFIJOASIGNACIONACTIVOFIJO foreign key (SERIAL_ACF)
      references ACTIVOSFIJOS (SERIAL_ACF) on delete restrict on update restrict;

alter table ASIGNACIONACTIVOSFIJOS add constraint FK_ASIGNACIONACTIVOSFIJOSUBICACION foreign key (SERIAL_UBI)
      references UBICACION (SERIAL_UBI) on delete restrict on update restrict;

alter table ASIGNACIONACTIVOSFIJOS add constraint FK_EMPLEADOASIGNACIONACTIVOFIJO foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table ASIGNACIONACTIVOSFIJOS add constraint FK_PROVEEDORASIGNACIONACTIVOSFIJOS foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table ASISTENCIA add constraint FK_EMPLEADOASISTENCIA foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table AUDITORIA add constraint FK_USUARIOAUDITORIA foreign key (SERIAL_USR)
      references USUARIO (SERIAL_USR) on delete restrict on update restrict;

alter table AUTORIZACION add constraint autorizacion_ibfk_1 foreign key (serial_alu)
      references ALUMNO (serial_alu) on delete restrict on update restrict;

alter table BODEGA add constraint FK_SUCURSALDEPARTAMENTOSBODEGA foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table BODEGA add constraint FK_TIPOBODEGABODEGA foreign key (SERIAL_TBO)
      references TIPOBODEGA (SERIAL_TBO) on delete restrict on update restrict;

alter table CAJAVENTA add constraint FK_CAJAVENTASUCURSALDEPARTAMENTOS foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table CALIFICACIONCLIENTE add constraint FK_CLIENTECALIFICACION foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table CALIFICACIONCLIENTE add constraint FK_NIVELCALIFICACIONCALIFICACION foreign key (SERIAL_NIVC)
      references NIVELCALIFICACION (SERIAL_NIVC) on delete restrict on update restrict;

alter table CALIFICACIONCLIENTE add constraint FK_PUNTOSCLIENTECALIFICACIONCLIENTE foreign key (SERIAL_PTO)
      references PUNTOSCLIENTE (SERIAL_PTO) on delete restrict on update restrict;

alter table CALIFICACIONPROVEEDOR add constraint FK_NIVELCALIFICACIONPROVEEDORCALIFICACIONPROVEEDOR foreign key (SERIAL_NIVCP)
      references NIVELCALIFICACIONPROVEEDOR (SERIAL_NIVCP) on delete restrict on update restrict;

alter table CALIFICACIONPROVEEDOR add constraint FK_PROVEEDORCALIFICACIONPROVEEDOR foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table CALIFICACIONPROVEEDOR add constraint FK_PUNTOSPROVEEDORCALIFICACIONPROVEEDOR foreign key (SERIAL_PTP)
      references PUNTOSPROVEEDOR (SERIAL_PTP) on delete restrict on update restrict;

alter table CAPACITACIONPERSONAL add constraint FK_EMPLEADOCAPACITACIONPROFESIONAL foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table CARGASFAMILIARES add constraint FK_EMPLEADOCARGASFAMILIARES foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table CARGOS add constraint FK_JERARQUIACARGOS foreign key (SERIAL_JER)
      references JERARQUIA (SERIAL_JER) on delete restrict on update restrict;

alter table CARGOS add constraint FK_PERFILCOMPETENCIASCARGOS foreign key (SERIAL_PEC)
      references PERFILCOMPETENCIAS (SERIAL_PEC) on delete restrict on update restrict;

alter table CATEGORIAPRODUCTO add constraint FK_FAMILIACATEGORIAPRODUCTO foreign key (SERIAL_FAP)
      references FAMILIAPRODUCTO (SERIAL_FAP) on delete restrict on update restrict;

alter table CIUDAD add constraint FK_PROVINCIACIUDAD foreign key (SERIAL_PRV)
      references PROVINCIA (SERIAL_PRV) on delete restrict on update restrict;

alter table CLIENTE add constraint FK_CIUDADCLIENTE foreign key (SERIAL_CIU)
      references CIUDAD (SERIAL_CIU) on delete restrict on update restrict;

alter table CLIENTE add constraint FK_CLIENTECANAL foreign key (SERIAL_CAN)
      references CANAL (SERIAL_CAN) on delete restrict on update restrict;

alter table CLIENTE add constraint FK_FORMASCOBROCLIENTE foreign key (SERIAL_FORC)
      references FORMACOBRO (SERIAL_FORC) on delete restrict on update restrict;

alter table CLIENTE add constraint FK_TIPOCLIENTECLIENTE foreign key (SERIAL_TIP)
      references TIPOCLIENTE (SERIAL_TIP) on delete restrict on update restrict;

alter table CLIENTE add constraint FK_TIPOPRECIOSCLIENTE foreign key (SERIAL_TPR)
      references TIPOSPRECIOS (SERIAL_TPR) on delete restrict on update restrict;

alter table CLIENTECONTACTO add constraint FK_CLIENTECLIENTECONTACTO foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table CLIENTEREFERENCIAS add constraint FK_CLIENTECLIENTEREFERENCIAS foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table CLIENTERUTA add constraint FK_CLIENTECLIENTERUTA foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table CLIENTERUTA add constraint FK_RUTACLIENTE foreign key (SERIAL_RUT)
      references RUTA (SERIAL_RUT) on delete restrict on update restrict;

alter table CLIENTESUCURSAL add constraint FK_CLIENTECLIENTESUCURSAL foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table COMPROBANTE add constraint FK_PERIODOCONTABLECOMPROBANTE foreign key (SERIAL_PCO)
      references PERIODOCONTABLE (SERIAL_PCO) on delete restrict on update restrict;

alter table CONDICIONESNEGOCIACIONPROVEEDOR add constraint FK_PROVEEDORCONDICIONESNEGOCIACIONPROVEEDOR foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table CONTACTOS add constraint contactos_ibfk_1 foreign key (serial_alu)
      references ALUMNO (serial_alu) on delete restrict on update restrict;

alter table CONTACTOSPROVEEDOR add constraint FK_PROVEEDORPROVEEDORCONTACTOS foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table DESCUENTOCANAL add constraint FK_CANALDESCUENTOCANAL foreign key (SERIAL_CAN)
      references CANAL (SERIAL_CAN) on delete restrict on update restrict;

alter table DESCUENTOCANAL add constraint FK_PRODUCTODESCUENTOCANAL foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table DESCUENTOCANTIDAD add constraint FK_CATEGORIAPRODUCTODESCUENTOCANTIDAD foreign key (SERIAL_CAP)
      references CATEGORIAPRODUCTO (SERIAL_CAP) on delete restrict on update restrict;

alter table DETALLEAPROBACIONES add constraint FK_APROBACIONDETALLEAPROBACION foreign key (SERIAL_APR)
      references APROBACION (SERIAL_APR) on delete restrict on update restrict;

alter table DETALLEAPROBACIONES add constraint FK_USUARIODETALLEAPROBACIONES foreign key (SERIAL_USR)
      references USUARIO (SERIAL_USR) on delete restrict on update restrict;

alter table DETALLECOMISIONES add constraint FK_COMISIONESDETALLECOMISIONES foreign key (SERIAL_CMS)
      references COMISIONES (SERIAL_CMS) on delete restrict on update restrict;

alter table DETALLECOMPROBANTE add constraint FK_COMPROBANTEDETALLECOMPROBANTE foreign key (SERIAL_COM)
      references COMPROBANTE (SERIAL_COM) on delete restrict on update restrict;

alter table DETALLECOMPROBANTE add constraint FK_PLANCONTABLEDETALLECOMPROBANTE foreign key (SERIAL_PLC)
      references PLANCONTABLE (SERIAL_PLC) on delete restrict on update restrict;

alter table DETALLEDEPRECIACIONES add constraint FK_DEPRECIACIONESDETALLEDEPRECIACIONES foreign key (SERIAL_DEPR)
      references DEPRECIACIONES (SERIAL_DEPR) on delete restrict on update restrict;

alter table DETALLEDEPRECIACIONES add constraint FK_DETALLEDEPRECIACIONESACTIVOSFIJOS foreign key (SERIAL_ACF)
      references ACTIVOSFIJOS (SERIAL_ACF) on delete restrict on update restrict;

alter table DETALLEFACTURA add constraint FK_FACTURADETALLEFACTURA foreign key (SERIAL_FAC)
      references FACTURA (SERIAL_FAC) on delete restrict on update restrict;

alter table DETALLEINGRESOEGRESODEBODEGA add constraint FK_INGRESOEGRESOBODEGADETALLEIEB foreign key (SERIAL_IEB)
      references INGRESOEGRESODEBODEGA (SERIAL_IEB) on delete restrict on update restrict;

alter table DETALLEORDENDECOMPRA add constraint FK_ORDENDECOMPRADETALLEORDENDECOMPRA foreign key (SERIAL_ODC)
      references ORDENDECOMPRA (SERIAL_ODC) on delete restrict on update restrict;

alter table DETALLEORDENDECOMPRA add constraint FK_PRODUCTODETALLEORDENCOMPRA foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table DETALLEORDENDEREQUERIMIENTO add constraint FK_ORDENDEREQUIRIMIENTODETALLEORDENREQUERIMIENTO foreign key (SERIAL_ORE)
      references ORDENDEREQUERIMIENTO (SERIAL_ORE) on delete restrict on update restrict;

alter table DETALLEORDENPEDIDO add constraint FK_ORDENPEDIDODETALLEORDENPEDIDO foreign key (SERIAL_ORP)
      references ORDENPEDIDO (SERIAL_ORP) on delete restrict on update restrict;

alter table DETALLEORDENPEDIDO add constraint FK_PRODUCTODETALLEORDENPEDIDO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table DETALLEROLPAGOS add constraint FK_EMPLEADOROLPAGOSDETALLEROL foreign key (SERIAL_ERP)
      references EMPLEADOROLPAGOS (SERIAL_ERP) on delete restrict on update restrict;

alter table DETALLEROLPAGOS add constraint FK_RUBROGENERALROLPAGOSDETALLEROLPAGOS foreign key (SERIAL_RGR)
      references RUBROGENERALROLPAGOS (SERIAL_RGR) on delete restrict on update restrict;

alter table DETALLESOLICITUDDOTACION add constraint FK_SOLICITUDDOTACIONDETALLESOLICITUD foreign key (SERIAL_SDO)
      references SOLICITUDDOTACION (SERIAL_SDO) on delete restrict on update restrict;

alter table DETALLETRANSPORTE add constraint FK_INGRESOEGRESOBODEGADETALLETRASNPORTE foreign key (SERIAL_IEB)
      references INGRESOEGRESODEBODEGA (SERIAL_IEB) on delete restrict on update restrict;

alter table DIASTRABAJADOS add constraint FK_EMPLEADODIASTRABAJADOS foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table DIASTRABAJADOS add constraint FK_PERIODOROLDIASTRABAJADOS foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table DOCPARALELOALUMO add constraint docParaleloAlumo_ibfk_2 foreign key (serial_alu)
      references ALUMNO (serial_alu) on delete restrict on update restrict;

alter table EMPLEADO add constraint FK_ESCALAFONESEMPLEADO foreign key (SERIAL_ESC)
      references ESCALAFONES (SERIAL_ESC) on delete restrict on update restrict;

alter table EMPLEADO add constraint FK_INSTITUCIONESFINANCIERASEMPLEADO foreign key (SERIAL_IFI)
      references INSTITUCIONESFINANCIERAS (SERIAL_IFI) on delete restrict on update restrict;

alter table EMPLEADO add constraint FK_SUCURSALDEPARTAMENTOSEMPLEADO foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table EMPLEADO add constraint FK_TIPOSCONTRATOSEMPLEADO foreign key (SERIAL_TCT)
      references TIPOCONTRATOSTRABAJO (SERIAL_TCT) on delete restrict on update restrict;

alter table EMPLEADO add constraint FK_TURNOSEMPLEADO foreign key (SERIAL_TUR)
      references TURNOS (SERIAL_TUR) on delete restrict on update restrict;

alter table EMPLEADOROLPAGOS add constraint FK_EMPLEADORUBROSEMPLEADO foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table EMPLEADOROLPAGOS add constraint FK_PERIODOROLEMPLEADOROL foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table EMPRESA add constraint FK_PARROQUIAEMPRESA foreign key (SERIAL_PAR)
      references PARROQUIA (SERIAL_PAR) on delete restrict on update restrict;

alter table ESCALAFONES add constraint FK_CARGOSESCALAFONES foreign key (SERIAL_CAR)
      references CARGOS (SERIAL_CAR) on delete restrict on update restrict;

alter table ESCALAFONES add constraint FK_TIPOESCALAFONESESCALAFONES foreign key (SERIAL_TES)
      references TIPOESCALAFONES (SERIAL_TES) on delete restrict on update restrict;

alter table EXPERIENCIAPROFESIONAL add constraint FK_EMPLEADOEXPERIENCIAPROFESIONAL foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table FACTURA add constraint FK_CLIENTEFACTURA foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table FACTURACOMPRA add constraint FK_INGRESOEGRESOFACTURACOMPRA foreign key (SERIAL_IEB)
      references INGRESOEGRESODEBODEGA (SERIAL_IEB) on delete restrict on update restrict;

alter table FAMILIAACTIVOFIJO add constraint FK_FAMILIAACTIVOFIJOPLANCONTABLE foreign key (SERIAL_PLC)
      references PLANCONTABLE (SERIAL_PLC) on delete restrict on update restrict;

alter table FORMACIONACADEMICA add constraint FK_EMPLEADOFORMACIONACADEMICA foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table GARANTIASACTIVOSFIJOS add constraint FK_ACTIVOSFIJOSGARANTIASACTIVOSFIJOS foreign key (SERIAL_ACF)
      references ACTIVOSFIJOS (SERIAL_ACF) on delete restrict on update restrict;

alter table HISTORIALCREDITOCLIENTE add constraint FK_CLIENTEHISTORIALCREDITOCLIENTE foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table HORASEXTRA add constraint FK_EMPLEADOHORAEXTRA foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table HORASEXTRA add constraint FK_PERIODOROLHORAEXTRA foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table INGRESOEGRESODEBODEGA add constraint FK_TIPOINGRESOEGRESOINGRESOEGRESOBODEGA foreign key (SERIAL_TIB)
      references TIPOINGRESOEGRESOBODEGA (SERIAL_TIB) on delete restrict on update restrict;

alter table INSTITUCIONESFINANCIERAS add constraint FK_CIUDADINSTITUCIONFINANCIERA foreign key (SERIAL_CIU)
      references CIUDAD (SERIAL_CIU) on delete restrict on update restrict;

alter table LISTAPRECIOS add constraint FK_LISTAPRECIOSPRODUCTO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table LISTAPRECIOS add constraint FK_TIPOSPRECIOSLISTAPRECIOS foreign key (SERIAL_TPR)
      references TIPOSPRECIOS (SERIAL_TPR) on delete restrict on update restrict;

alter table MARCAPRODUCTO add constraint FK_PRODUCTOMARCAPRODUCTO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table MATERIA_ALUMNO add constraint materia_alumno_ibfk_1 foreign key (serial_alu)
      references ALUMNO (serial_alu) on delete restrict on update restrict;

alter table MATERIA_CRITERIO add constraint materia_criterio_ibfk_1 foreign key (serial_cri)
      references CRITERIO (serial_cri) on delete restrict on update restrict;

alter table MATERIA_CRITERIO add constraint materia_criterio_ibfk_2 foreign key (serial_matalu)
      references MATERIA_ALUMNO (serial_matalu) on delete restrict on update restrict;

alter table NIVEL add constraint nivel_ibfk_1 foreign key (serial_esp)
      references ESPECIALIDAD (serial_esp) on delete restrict on update restrict;

alter table NOVEDADES add constraint FK_EMPLEADONOVEDADES foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table NOVEDADES add constraint FK_PERIODOROLNOVEDADES foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table ORDENDECOMPRA add constraint FK_FORMASPAGOORDENDECOMPRA foreign key (SERIAL_FORP)
      references FORMASPAGO (SERIAL_FORP) on delete restrict on update restrict;

alter table ORDENDECOMPRA add constraint FK_PROVEEDORORDENCOMPRA foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table ORDENDEREQUERIMIENTO add constraint FK_AREAORDENDEREQUERIMIENTO foreign key (SERIAL_ARE)
      references AREA (SERIAL_ARE) on delete restrict on update restrict;

alter table ORDENDEREQUERIMIENTO add constraint FK_EMPLEADOORDENDEREQUERIMIENTO foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table ORDENPEDIDO add constraint FK_CLIENTEORDENPEDIDO foreign key (SERIAL_CLI)
      references CLIENTE (SERIAL_CLI) on delete restrict on update restrict;

alter table ORDENPEDIDO add constraint FK_FORMACOBROORDENPEDIDO foreign key (SERIAL_FORC)
      references FORMACOBRO (SERIAL_FORC) on delete restrict on update restrict;

alter table PARALELO add constraint paralelo_ibfk_1 foreign key (serial_niv)
      references NIVEL (serial_niv) on delete restrict on update restrict;

alter table PARALELO_ALUMNO add constraint paralelo_alumno_ibfk_1 foreign key (serial_ban)
      references BANCO (serial_ban) on delete restrict on update restrict;

alter table PARALELO_ALUMNO add constraint paralelo_alumno_ibfk_2 foreign key (serial_alu)
      references ALUMNO (serial_alu) on delete restrict on update restrict;

alter table PARALELO_ALUMNO add constraint paralelo_alumno_ibfk_3 foreign key (serial_par)
      references PARALELO (serial_par) on delete restrict on update restrict;

alter table PARENTESCOEMPLEADO add constraint FK_EMPLEADOPARENTESCOEMPLEADO foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table PARENTESCOEMPLEADO add constraint FK_PARENTESCOPARENTESCOEMPLEADO foreign key (SERIAL_PRT)
      references PARENTESCO (SERIAL_PRT) on delete restrict on update restrict;

alter table PARROQUIA add constraint FK_CIUDADPARROQUIA foreign key (SERIAL_CIU)
      references CIUDAD (SERIAL_CIU) on delete restrict on update restrict;

alter table PERMISOS add constraint FK_EMPLEADOPERMISOS foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table PLANCONTABLE add constraint FK_PLANPRESUPUESTOPLANCONTABLE foreign key (SERIAL_PLP)
      references PLANPRESUPUESTO (SERIAL_PLP) on delete restrict on update restrict;

alter table PLANRETENCION add constraint FK_PLANCONTABLEPLANRETENCION foreign key (SERIAL_PLC)
      references PLANCONTABLE (SERIAL_PLC) on delete restrict on update restrict;

alter table PRESTAMOSEMPLEADO add constraint FK_EMPLEADOPRESTAMOSEMPLEADOS foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table PRESTAMOSEMPLEADO add constraint FK_PERIODOROLPRESTAMOSEMPLEADOS foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table PROCESOS add constraint FK_MODULOSPROCESOS foreign key (SERIAL_MOD)
      references MODULOS (SERIAL_MOD) on delete restrict on update restrict;

alter table PRODUCTO add constraint FK_PROVEEDORPRODUCTO foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table PRODUCTO add constraint FK_TIPOPRODUCTOPRODUCTO foreign key (SERIAL_TPO)
      references TIPOPRODUCTO (SERIAL_TPO) on delete restrict on update restrict;

alter table PROMOCIONESPROVEEDOR add constraint FK_PROMOCIONESPROVEEDORPRODUCTO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table PROMOCIONESPROVEEDOR add constraint FK_PROVEEDORPROMOCIONESPROVEEDOR foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table PROVEEDOR add constraint FK_CIUDADPROVEEDOR foreign key (SERIAL_CIU)
      references CIUDAD (SERIAL_CIU) on delete restrict on update restrict;

alter table PROVEEDOR add constraint FK_TIPOPROVEEDORPROVEEDOR foreign key (SERIAL_TPD)
      references TIPOPROVEEDOR (SERIAL_TPD) on delete restrict on update restrict;

alter table PROVEEDORESPRODUCTO add constraint FK_PROVEEDORESPRODUCTOPRODUCTO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table PROVEEDORESPRODUCTO add constraint FK_PROVEEDORPROVEEDORESPRODUCTO foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table PROVEEDORREBATES add constraint FK_PROVEEDORPROVEEDORREBATES foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table PROVEEDORTIPOACTIVOFIJO add constraint FK_PROVEEDORPROVEEDORTIPOACTIVOFIJO foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table PROVEEDORTIPOACTIVOFIJO add constraint FK_TIPOACTIVOFIJOPROVEEDORTIPOACTIVOFIJO foreign key (SERIAL_TAF)
      references TIPOACTIVOFIJO (SERIAL_TAF) on delete restrict on update restrict;

alter table PROVINCIA add constraint FK_PAISPROVINCIA foreign key (SERIAL_PAI)
      references PAIS (SERIAL_PAI) on delete restrict on update restrict;

alter table REGISTROACCIDENTES add constraint FK_EMPLEADOREGISTROACCIDENTES foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table REGISTROQUEJASSUGERENCIAS add constraint FK_TIPOSQUEJASSUGERENCIASREGISTROQUEJASSUGERENCIAS foreign key (SERIAL_QUE)
      references TIPOSQUEJASSUGERENCIAS (SERIAL_QUE) on delete restrict on update restrict;

alter table ROLPAGOSGENERAL add constraint FK_PERIODOROLROLPAGOSGENERAL foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table RUBROGENERALROLPAGOS add constraint FK_PLANCONTABLERUBROGENERALROLPAGOS foreign key (SERIAL_PLC)
      references PLANCONTABLE (SERIAL_PLC) on delete restrict on update restrict;

alter table RUBROGENERALROLPAGOS add constraint FK_TIPOCONTRATOSTRABAJORUBROGENERALROLPAGOS foreign key (SERIAL_TCT)
      references TIPOCONTRATOSTRABAJO (SERIAL_TCT) on delete restrict on update restrict;

alter table RUTA add constraint FK_ZONARUTA foreign key (SERIAL_ZON)
      references ZONA (SERIAL_ZON) on delete restrict on update restrict;

alter table SOLICITUDDOTACION add constraint FK_AREASOLICITUDDOTACION foreign key (SERIAL_ARE)
      references AREA (SERIAL_ARE) on delete restrict on update restrict;

alter table SOLICITUDDOTACION add constraint FK_EMPLEADOSOLICITUDDOTACION foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table SUCURSAL add constraint FK_CIUDADSUCURSAL foreign key (SERIAL_CIU)
      references CIUDAD (SERIAL_CIU) on delete restrict on update restrict;

alter table SUCURSAL add constraint FK_EMPRESASUCURSAL foreign key (SERIAL_EMP)
      references EMPRESA (SERIAL_EMP) on delete restrict on update restrict;

alter table SUCURSALDEPARTAMENTOS add constraint FK_DEPARTAMENTOSUCURSALDEPARTAMENTO foreign key (SERIAL_DEP)
      references DEPARTAMENTOS (SERIAL_DEP) on delete restrict on update restrict;

alter table SUCURSALDEPARTAMENTOS add constraint FK_SUCURSALSUCURSALDEPARTAMENTO foreign key (SERIAL_SUC)
      references SUCURSAL (SERIAL_SUC) on delete restrict on update restrict;

alter table TABLACOMISIONESCARGO add constraint FK_CARGOSTABLACOMISIONESCARGO foreign key (SERIAL_CAR)
      references CARGOS (SERIAL_CAR) on delete restrict on update restrict;

alter table TABLACOMISIONESPRODUCTO add constraint FK_PRODUCTOTABLACOMISIONESPRODUCTO foreign key (SERIAL_PRD)
      references PRODUCTO (SERIAL_PRD) on delete restrict on update restrict;

alter table TABLACOMISIONESPRODUCTO add constraint FK_TIPOCLIENTETABLACOMISIONPRODUCTO foreign key (SERIAL_TIP)
      references TIPOCLIENTE (SERIAL_TIP) on delete restrict on update restrict;

alter table TABLASRI add constraint FK_EMPLEADOTABLASRI foreign key (SERIAL_EPL)
      references EMPLEADO (SERIAL_EPL) on delete restrict on update restrict;

alter table TABLASRI add constraint FK_PERIODOROLTABLASRI foreign key (SERIAL_PERROL)
      references PERIODOROL (SERIAL_PERROL) on delete restrict on update restrict;

alter table TASAS add constraint FK_PAISTASAS foreign key (SERIAL_PAI)
      references PAIS (SERIAL_PAI) on delete restrict on update restrict;

alter table TASAS add constraint FK_TIPOTASASTASAS foreign key (SERIAL_TTA)
      references TIPOTASAS (SERIAL_TTA) on delete restrict on update restrict;

alter table TERCIARIZADORA add constraint FK_PROVEEDORTERCIARIZADORA foreign key (SERIAL_PVD)
      references PROVEEDOR (SERIAL_PVD) on delete restrict on update restrict;

alter table TIPOACTIVOFIJO add constraint FK_CLASEACTIVOFIJOTIPOACTIVOFIJO foreign key (SERIAL_CLAF)
      references CLASEACTIVOFIJO (SERIAL_CLAF) on delete restrict on update restrict;

alter table TIPOACTIVOFIJO add constraint FK_FAMILIAACTIVOFIJOTIPOACTIVOFIJO foreign key (SERIAL_FAF)
      references FAMILIAACTIVOFIJO (SERIAL_FAF) on delete restrict on update restrict;

alter table TIPOPRODUCTO add constraint FK_CATEGORIAPRODUCTOTIPOPRODUCTO foreign key (SERIAL_CAP)
      references CATEGORIAPRODUCTO (SERIAL_CAP) on delete restrict on update restrict;

alter table TIPOPROVEEDOR add constraint FK_PLANCONTABLETIPOPROVEEDOR foreign key (SERIAL_PLC)
      references PLANCONTABLE (SERIAL_PLC) on delete restrict on update restrict;

alter table UBICACION add constraint FK_SUCURSALDEPARTAMENTOSUBICACION foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table UBICACIONBODEGA add constraint FK_BODEGAUBICACIONBODEGA foreign key (SERIAL_BOD)
      references BODEGA (SERIAL_BOD) on delete restrict on update restrict;

alter table USUARIO add constraint FK_PERFILUSUARIO foreign key (SERIAL_PFL)
      references PERFIL (SERIAL_PFL) on delete restrict on update restrict;

alter table USUARIOSUCURSAL add constraint FK_SUCURSALDEPARTAMENTOSUSUARIOSUCURSAL foreign key (SERIAL_DESC)
      references SUCURSALDEPARTAMENTOS (SERIAL_DESC) on delete restrict on update restrict;

alter table USUARIOSUCURSAL add constraint FK_USUARIOUSUARIOSUCURSAL foreign key (SERIAL_USR)
      references USUARIO (SERIAL_USR) on delete restrict on update restrict;

alter table VARIABLESMODULO add constraint FK_MODULOSVARIABLESMODULO foreign key (SERIAL_MOD)
      references MODULOS (SERIAL_MOD) on delete restrict on update restrict;

alter table ZONA add constraint FK_REGIONZONA foreign key (SERIAL_REG)
      references REGION (SERIAL_REG) on delete restrict on update restrict;

