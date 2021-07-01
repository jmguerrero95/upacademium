<?php


  require_once('../adodb/adodb.inc.php');
  require('../../config/config.inc.php');

 $aResults = array();


function omnisoftConnectDB() {

  global $DBConnection;
  $dblink = NewADOConnection($DBConnection);

  return $dblink;

}



function omnisoftExecuteQuery() {
  global  $_GET;
  global $aResults;
  global  $MAX_AUTOSUGGEST_ITEMS;
   $fieldname = $_GET['fieldname'];
   $fieldname= explode(',',$fieldname);

   $query = $_GET['query'];
   $query=str_replace("\"", "",$query);
   $query=str_replace("\'", "'",$query);

   $query=str_replace("\x5C", " ",$query);

   $dblink=omnisoftConnectDB();
   $dblink->SetFetchMode(ADODB_FETCH_NUM);

   $query=strtolower( $query);

   $input = trim(strtolower( $_GET['input'] ));
   $len = strlen($input);

   if ($len) {
      $swhere = explode('where',$query);

   $query= (count($swhere)>1)?$query ." and (".$fieldname[0]." like '".$input."%'": $query ." where (".$fieldname[0]." like '".$input."%'  ";
   if (count($fieldname)>1)
   for ($i=1; $i<count($fieldname); $i++)
   $query.=" or ".$fieldname[$i]." like '".$input."%'";
   $query.=")";
   }
   $query.=" order by ".$fieldname[0];
   $RecordSet=$dblink->Execute($query);

  $items=0;
      while (!$RecordSet->EOF && $items++ < $MAX_AUTOSUGGEST_ITEMS)
		{
				$aResults[] = array( "id"=>($RecordSet->fields[0]) ,"value"=>htmlspecialchars($RecordSet->fields[1]), "info"=>htmlspecialchars($RecordSet->fields[2]) );


                $RecordSet->MoveNext();

		}

}



	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0


        omnisoftExecuteQuery();

	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");

		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}
		echo implode(", ", $arr);
		echo "]}";
	}
	else
	{
		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
		for ($i=0;$i<count($aResults);$i++)
		{
			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";
		}
		echo "</results>";
	}
?>