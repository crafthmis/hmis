<?php

include ("db/db_connect.php");
$customersearch = $_REQUEST["customersearch"];
$breakcode = explode('-',$customersearch);
$insurancecompany= $breakcode[0];
//$customersearch = strtoupper($customersearch);
$searchresult = "";
/*$query2 = "select * from master_customer where customername = '$customersearch' order by customername";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
	$customercode = $res2["customercode"];
	$customername = $res2["customername"];*/
	
	
	$query3 = "select * from master_tap where insurancecompany = '$insurancecompany' and status <> 'deleted' order by tpaname";
	$exec2 = mysql_query($query3) or die ("Error in Query3".mysql_error()) ;
	while($res3 = mysql_fetch_array($exec2))
	{
		echo '||'. $tpaname = $res3["tpaname"];}
	/*if ($searchresult == '')
	{
		$searchresult = $stylename;//||'.$customername.'||'.$address1.'||'.$area.'||'.$city.'||'.$pincode.'||'.$stylename.'||'.$partydcno.'';'||'.$cstnumber.'||'
	}
	
	
//}

if ($searchresult != '')
{
	echo $searchresult;
}*/
?>
