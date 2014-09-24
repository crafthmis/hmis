<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_itemlab where itemcode = 'LT124'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);

	$itemcode = $res1['itemcode'];
	$itemname = $res1['itemname'];
	$categoryname = $res1['categoryname'];
	echo $unitname_abbreviation = $res1['unitname_abbreviation'];
	$referencevalue = $res1['referencevalue'];


?>