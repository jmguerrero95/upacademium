<?php
		session_start();
?>
<?php
        
		//require_once 'Aco_DataGrid.php'; 
		require('../adodb/adodb.inc.php');
        require('../../config/config.inc.php');
	    require('../../config2/config.inc.php');

		global $DBConnection;
      	$dblink = NewADOConnection($DBConnection);
?>

<?php 	class Trabajo
{
   //atributo usuarios
   private $usuarios;
   public function __construct()
   {
      //creamos un arreglo llamado usuarios qen el cual se guardara informacion de la tabla usuario
      $this->usuarios=array();
   }
   //metodo que listara los usuarios 
   public function get_usuarios()
   {
      $sql= "SELECT a.serial_alu, nombre1_alu,,  pren.nombrePregunta_pren, alupre.respuesta_encuasta,  pren.multiple_pren , alupre.serial_ape, pren.serial_pren  
								FROM alumno AS a,  alumno_preguntencuesta as alupre, preguntas_encuesta2 as pren LEFT JOIN alumnomalla ON alumnomalla.serial_alu=a.serial_alu LEFT JOIN malla ON malla.serial_maa=alumnomalla.serial_maa 
        						AND serial_maa_p=0 LEFT JOIN carrera ON carrera.serial_car=malla.serial_car LEFT JOIN carreraprincipal ON carreraprincipal.serial_crp=carrera.serial_crp LEFT JOIN facultad ON facultad.serial_fac=carrera.serial_fac 
       							LEFT JOIN seccion AS sec ON sec.serial_sec = a.serial_sec LEFT JOIN pais AS p  ON a.serial_pai=p.serial_pai LEFT JOIN periodo    ON periodo.serial_per=a.serial_per LEFT JOIN colegios AS col ON col.serial_col=a.serial_col 
							WHERE  (intercambio_alu<>'VIENE INTERCAMBIO'   AND intercambio_alu<>'COMUNIDAD') AND fectitulacion_ama <> '0000-00-00'  AND a.serial_alu=alupre.serial_alu AND alupre.serial_pren=pren.serial_pren" ;
	  
	  // $res=mysql_query($sql, Conectar::Con());
	   $res=$gConexionDB->Execute($sql);
      //mysql_fetch_assoc se utiliza para trabajar con array multidimensional
      while($reg=mysql_fetch_assoc($res))
      {
         //usuarios recibe cada uno de los registros que tiene la tabla usuarios
         $this->usuarios[]=$reg;
         
      }   
      return $this->usuarios; 
   }
 
   public function add_usuarios($rut,$contrasena,$nombres,$apellidop,$apellidom,$direccion,$fono,$celular)
      {
   $sql="insert into usuario (USU_RUT, USU_PASS, USU_NOMBRES, USU_APELLIDO_PATERNO, USU_APELLIDO_MATERNO, USU_DIRECCION, USU_FONO, USU_CELULAR)  values('$rut','$contrasena','$nombres','$apellidop','$apellidom','$direccion','$fono','$celular')";
      
      $res=mysql_query($sql,Conectar::Con());   
      echo "<script type='text/javascript'>
      alert('Usuario Ingresado Correctamente');
      document.location.href = 'listar_usuarios.php';
      </script>";
               
   }
   
   
    public function get_usuarios_rut($rut)
    {
      $sql="select *from usuario where USU_RUT='$rut'";    
       $res=mysql_query($sql,Conectar::Con());   
      while($reg=mysql_fetch_assoc($res))
      {
         $this->usuarios[]=$reg;
      }
      
         return $this->usuarios;
    }
    
    
    public function edit_usuarios($nombres,$apellidop,$apellidom,$direccion,$fono,$celular,$rut)
    {
       $sql="update usuario set USU_NOMBRES='$nombres',USU_APELLIDO_PATERNO='$apellidop', USU_APELLIDO_MATERNO='$apellidom', USU_DIRECCION='$direccion', USU_FONO='$fono', USU_CELULAR='$celular' where USU_RUT='$rut'";
      
      //$sql="update usuario"
      //." set "
      //."USU_NOMBRES='$nombres',"
      //."USU_APELLIDO_PATERNO='$apellidop',"
      //."USU_APELLIDO_MATERNO='$apellidom', "
      //."USU_DIRECCION='$direccion',"
      //."USU_FONO='$fono',"
      //."USU_CELULAR='$celular'"
      //."where"
      //."USU_RUT='$rut'";
      
      $res=mysql_query($sql,Conectar::Con());
      echo "<script type='text/javascript'>
      alert ('El registro Ha Sido Actualizado Correctamente');
      document.location.href ='listar_usuarios.php';
      </script>";
      
      
      //header("location: listar_usuarios.php");
      
      
    
    }
    
    public function eliminar_usuarios($rut)
    {
       $sql="delete from usuario where USU_RUT='$rut'";
      $res=mysql_query($sql,Conectar::Con());
      echo "<script type='text/javascript'>
      alert ('El registro Ha Sido Eliminado Correctamente');
      document.location.href ='listar_usuarios.php';
      </script>";
    
    }
    
}
 
 
?>