<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');
global $DBConnection,$dblink;
$dblink = NewADOConnection($DBConnection);
$sql='SELECT
   serial_alu, codigoIdentificacion_alu, apellidopaterno_alu, nombre1_alu
FROM
    alumno 
WHERE
    codigoIdentificacion_alu in("1717425944",
"0104477583",
"0105183313",
"0106550882",
"0104477567",
"0920569571",
"0103242368",
"0104996913",
"0104968730",
"0103861258",
"0104018478",
"0103821435",
"0104359831",
"1400485189",
"0105996169",
"0103805354",
"0103917159",
"0104094834",
"0104200134",
"0302000146",
"0104745013",
"0105079057",
"0301787529",
"0602945818",
"0711060847",
"0105015481",
"0104598677",
"0105297303",
"0104598677",
"0104281977",
"0103872743",
"0104198593",
"0104831136",
"0301569992",
"0105094577",
"0103547162",
"1104522667",
"0105266423",
"0104319850",
"0105244529",
"0106043938",
"0105169668",
"0503143224",
"1309947263",
"0104238522",
"0104281670",
"0104058623",
"1103691737",
"0104017538",
"1400677389",
"0301397311",
"0105213094",
"0302156831",
"1712686037",
"0705299584",
"0302040779",
"0103941357",
"0302205265",
"0103374997",
"0706369071",
"0105247852",
"0705189413",
"0103595583",
"0104183611",
"0106021488",
"0103873188",
"0106857220",
"1103691729",
"0105003255",
"0104158365",
"0302477567",
"0103758330",
"0104817069",
"0502554926",
"0104581566",
"1104452048",
"0106411515",
"0104828710",
"0301680245",
"0705040186",
"0103873170",
"0104720891",
"0301751202",
"0105677801",
"0302025317",
"0103881454",
"0104759287",
"0105334510",
"0106451198",
"0105111439",
"0106522469",
"1104567621",
"0104853270",
"0105670236",
"0105812655",
"0105001317",
"0105490064",
"0302093539",
"1719253906",
"0104671029",
"0105500284",
"0302185335",
"0105804975",
"0104944707",
"0301923900",
"0105543862",
"0104779806",
"0105080964",
"0105528525",
"1900757616",
"0103566568"
)';
//echo $sql;
$resultNotaNueva=$dblink->Execute($sql);
?>
<table>
<?

while(!$resultNotaNueva->EOF){
	$sql1="SELECT
    periodo.* 
FROM
    periodo,  materiamatriculada mmat, detallemateriamatriculada dmat
WHERE
    fecini_per=(SELECT
                    MAX(fecini_per) 
                FROM
                    materiamatriculada mmat,
                    periodo 
                WHERE
                    mmat.SERIAL_ALU=".$resultNotaNueva->fields['serial_alu']." 
                    AND periodo.serial_per= mmat.SERIAL_PER
    )
    AND mmat.SERIAL_ALU=".$resultNotaNueva->fields['serial_alu']." and dmat.serial_mmat=mmat.SERIAL_MMAT
    AND periodo.serial_per= mmat.SERIAL_PER group by dmat.SERIAL_MMAT";
	$resultNotaNueva1=$dblink->Execute($sql1);
	?>
	<tr><td>
	<?
echo "</br>".$resultNotaNueva->fields['codigoIdentificacion_alu']."</td>  <td> ".$resultNotaNueva1->fields['nombre_per']."</td>";
	?>
	</tr>
	<?
$resultNotaNueva->MoveNext();
			}			

?>
</table>

