<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_itempharmacy where packagename <> '' and packageanum = '0'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$itemanum = $res1['auto_number'];
	$packagename = $res1['packagename'];
	
	$query2 = "select * from master_packagepharmacy where packagename = '$packagename'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$packageanum = $res2['auto_number'];

	echo '<br><br>'.$query3 = "update master_itempharmacy set packageanum = '$packageanum' where auto_number = '$itemanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query2".mysql_error());
}


?>