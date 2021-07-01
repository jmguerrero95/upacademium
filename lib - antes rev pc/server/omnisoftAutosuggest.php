<?php
include('../adodb/adodb.inc.php');
include('../../config/config.inc.php');

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


	$input = trim(strtolower( $_GET['input'] ));

	$len = strlen($input);
        $table = strtolower( $_GET['table'] );
        $fieldname = strtolower( $_GET['fieldname'] );
        $fieldid = strtolower( $_GET['fieldid'] );
        $fieldinfo = strtolower( $_GET['fieldinfo'] );
        $filter = strtolower( $_GET['filter'] );
        if (strlen($filter)>0 )
           if ($len)
            $filter=$filter." and ";
            else $filter=" where ".$filter;

           $dblink=omnisoftConnectDB();
           $dblink->SetFetchMode(ADODB_FETCH_NUM);

           if ($len)
           $query="select ".$fieldid.",".$fieldname.",".$fieldinfo." from ".$table." where ".$filter ." ( (".$fieldname." like '".$input."%') or (".$fieldinfo." like '".$input."%')) order by ".$fieldname ;
           else
           $query="select ".$fieldid.",".$fieldname.",".$fieldinfo." from ".$table .$filter." order by ". $fieldname;

           $RecordSet=$dblink->Execute($query);
            $item=0;
            while (!$RecordSet->EOF && $item++< $MAX_AUTOSUGGEST_ITEMS) {

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