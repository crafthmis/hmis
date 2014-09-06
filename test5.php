<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$dateonly = date("Y-m-d");


$query1 = "select * from master_itemlab";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$res1anum = $res1['auto_number'];
	$referencevalue1 = $res1['referencevalue'];
	//$referencevalue2 = ereg_replace(' - ', ' - ', $referencevalue1);
	$referencevalue2 = preg_replace('/ - /', ' - ', $referencevalue1);
	//echo '<br><br>'.$query2 = "update master_itemlab set referencevalue = '$referencevalue2' where auto_number = '$res1anum'";
	//$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
}



?>