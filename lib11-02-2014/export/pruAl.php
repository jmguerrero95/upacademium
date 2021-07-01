<?php 
require('../adodb/adodb.inc.php');
require('../../config/config.inc.php');
global $DBConnection;
$dblink = NewADOConnection($DBConnection);
//Parametrizacion

$arr[0]['cedula'] ='0923560098';
$arr[1]['cedula'] ='0925919078';
$arr[2]['cedula'] ='0915425664';
$arr[3]['cedula'] ='0603925397';
$arr[4]['cedula'] ='1307604759';
$arr[5]['cedula'] ='0925912263';
$arr[6]['cedula'] ='0927268318';
$arr[7]['cedula'] ='0924685662';
$arr[8]['cedula'] ='0927264705';
$arr[9]['cedula'] ='1714952916';
$arr[10]['cedula'] ='1600541757';
$arr[11]['cedula'] ='1400735716';
$arr[12]['cedula'] ='1400350896';
$arr[13]['cedula'] ='1400490064';
$arr[14]['cedula'] ='1400247175';
$arr[15]['cedula'] ='1400626311';
$arr[16]['cedula'] ='2100656418';
$arr[17]['cedula'] ='2100206859';
$arr[18]['cedula'] ='2100490545';
$arr[19]['cedula'] ='1600544199';
$arr[20]['cedula'] ='1716301252';
$arr[21]['cedula'] ='0103349163';
$arr[22]['cedula'] ='1713175824';
$arr[23]['cedula'] ='0917262149';
$arr[24]['cedula'] ='0105633614';
$arr[25]['cedula'] ='0105353346';
$arr[26]['cedula'] ='0104736806';
$arr[27]['cedula'] ='0104060462';
$arr[28]['cedula'] ='0103177143';
$arr[29]['cedula'] ='1722778246';
$arr[30]['cedula'] ='103829073';
$arr[31]['cedula'] ='1717544074';
$arr[32]['cedula'] ='1711006021';
$arr[33]['cedula'] ='1720721339';
$arr[34]['cedula'] ='1714207980';
$arr[35]['cedula'] ='1719928127';
$arr[36]['cedula'] ='0916504129';
$arr[37]['cedula'] ='1721715645';
$arr[38]['cedula'] ='1104818065';
$arr[39]['cedula'] ='1718895145';
$arr[40]['cedula'] ='1719415547';
$arr[41]['cedula'] ='1803312105';
$arr[42]['cedula'] ='0502357437';
$arr[43]['cedula'] ='0503251035';
$arr[44]['cedula'] ='0503506644';
$arr[45]['cedula'] ='1803676350';
$arr[46]['cedula'] ='1708012248';
$arr[47]['cedula'] ='1500629769';
$arr[48]['cedula'] ='1804145645';
$arr[49]['cedula'] ='1715636211';
$arr[50]['cedula'] ='1716863665';
$arr[51]['cedula'] ='1720242963';
$arr[52]['cedula'] ='1719430686';
$arr[53]['cedula'] ='1712632320';
$arr[54]['cedula'] ='1713125969';
$arr[55]['cedula'] ='1714586680';
$arr[56]['cedula'] ='1714247697';
$arr[57]['cedula'] ='1719413617';
$arr[58]['cedula'] ='1716396898';
$arr[59]['cedula'] ='0401457338';
$arr[60]['cedula'] ='0803150952';
$arr[61]['cedula'] ='1713376257';
$arr[62]['cedula'] ='1713304044';
$arr[63]['cedula'] ='1709559601';
$arr[64]['cedula'] ='1718559600';
$arr[65]['cedula'] ='1713987459';
$arr[66]['cedula'] ='1712691284';
$arr[67]['cedula'] ='0924619950';
$arr[68]['cedula'] ='0918677790';
$arr[69]['cedula'] ='0917666307';
$arr[70]['cedula'] ='0916591969';
$arr[71]['cedula'] ='1717575490';
$arr[72]['cedula'] ='1716762107';
$arr[73]['cedula'] ='1712190964';
$arr[74]['cedula'] ='0604238667';
$arr[75]['cedula'] ='1719270579';
$arr[76]['cedula'] ='1002447082';
$arr[77]['cedula'] ='1715040851';
$arr[78]['cedula'] ='0301729729';
$arr[79]['cedula'] ='0703706655';
$arr[80]['cedula'] ='1723765093';
$arr[81]['cedula'] ='0704155498';
$arr[82]['cedula'] ='0705366888';
$arr[83]['cedula'] ='0703955823';
$arr[84]['cedula'] ='0703819250';
$arr[85]['cedula'] ='0705828960';
$arr[86]['cedula'] ='0704824085';
$arr[87]['cedula'] ='0705277762';
$arr[88]['cedula'] ='1716182769';
$arr[89]['cedula'] ='1717093676';
$arr[90]['cedula'] ='1712905650';
$arr[91]['cedula'] ='1711365849';
$arr[92]['cedula'] ='1720213402';
$arr[93]['cedula'] ='1718816976';
$arr[94]['cedula'] ='1720584208';
$arr[95]['cedula'] ='0130902575';
$arr[96]['cedula'] ='0-80288274';
$arr[97]['cedula'] ='1725857203';
$arr[98]['cedula'] ='1713807970';
$arr[99]['cedula'] ='0131136032';
$arr[100]['cedula'] ='0131075250';
$arr[101]['cedula'] ='0131133919';
$arr[102]['cedula'] ='1717913253';
$arr[103]['cedula'] ='1712075884';
$arr[104]['cedula'] ='1722916721';
$arr[105]['cedula'] ='0104542659';
$arr[106]['cedula'] ='0103915237';
$arr[107]['cedula'] ='0105552129';
$arr[108]['cedula'] ='0104975974';
$arr[109]['cedula'] ='1712162773';
$arr[110]['cedula'] ='1718329731';
$arr[111]['cedula'] ='1721671111';
$arr[112]['cedula'] ='0926009812';
$arr[113]['cedula'] ='0919895615';
$arr[114]['cedula'] ='1711759520';
$arr[115]['cedula'] ='0501564017';
$arr[116]['cedula'] ='0701763781';
$arr[117]['cedula'] ='0910463819';
$arr[118]['cedula'] ='1003442736';
$arr[119]['cedula'] ='1003697214';
$arr[120]['cedula'] ='1312352097';
$arr[121]['cedula'] ='1310179484';
$arr[122]['cedula'] ='1311639973';
$arr[123]['cedula'] ='1311012130';
$arr[124]['cedula'] ='1311833790';
$arr[125]['cedula'] ='1313234708';
$arr[126]['cedula'] ='1312892670';
$arr[127]['cedula'] ='0302008040';
$arr[128]['cedula'] ='0301748380';
$arr[129]['cedula'] ='1103481287';
$arr[130]['cedula'] ='1716265291';
$arr[131]['cedula'] ='0703864454';
$arr[132]['cedula'] ='0104083639';
$arr[133]['cedula'] ='1721110532';
$arr[134]['cedula'] ='1715045025';
$arr[135]['cedula'] ='1718018102';
$arr[136]['cedula'] ='0401431853';
$arr[137]['cedula'] ='0602411340';
$arr[138]['cedula'] ='1723230635';




$totAll = count($arr);
echo "<table width='200' border='1'>";
for($i=0;$i<$totAll;$i++){	
	$sqlMain = "
		SELECT
			concat_ws(' ',apellidopaterno_alu,apellidomaterno_alu,nombre1_alu,nombre2_alu) AS nombre,
			serial_suc 
		FROM
			alumno 
		WHERE
			codigoIdentificacion_alu ='".$arr[$i]['cedula']."'; 			
			
	";	
	if($arrOther = $dblink->GetAll($sqlMain)){				
		$nombre = $arrOther[$i]['nombre'];		
		$sucursal = $arrOther[$i]['serial_suc'];
		echo "
	
	  <tr>
		<td>".$sqlMain."</td>
		<td>".$arrOther[$i]['nombre']."</td>
	  </tr>
	
		";
	
		
	}

}
echo "</table>";





function getCar($serial_alu,$serial_sec,$dblink){
	$sqlGetOther = "
		SELECT
			ama.serial_ama,
			nombre_maa,
			serial_car
		FROM
			malla        AS maa,
			alumnomalla  AS ama,
			sucursal     AS suc,
			alumno       AS alu,
			detallemalla AS dma,
			materia      AS mat 
		WHERE
			maa.serial_maa = ama.serial_maa 
			AND dma.serial_maa = maa.serial_maa 
			AND mat.serial_mat = dma.serial_mat 
			AND alu.serial_alu = ama.serial_alu 
			AND alu.serial_suc = suc.serial_suc 
			AND maa.serial_maa_p = 0 
			AND ama.serial_alu = ".$serial_alu." 
			AND maa.serial_sec = ".$serial_sec."    
		GROUP BY
			serial_ama	
	";


	if($arrOther = $dblink->GetAll($sqlGetOther)){				
		$arrOther[0]['serial_car'] = $arrOther[0]['serial_car'];					
		return $arrOther;
		
	}else{
		return false;

	}

}




?>