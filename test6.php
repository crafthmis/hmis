<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_itemlab_old";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$itemcode = $res1['itemcode'];
	$itemname = $res1['itemname'];
	$categoryname = $res1['categoryname'];
	$unitname_abbreviation = $res1['unitname_abbreviation'];
	$referencevalue = $res1['referencevalue'];
	
	echo '<br><br>'.$query2 = "update master_itemlab set itemname = '$itemname', categoryname = '$categoryname', 
	unitname_abbreviation = '$unitname_abbreviation', referencevalue = '$referencevalue' 
	where itemcode = '$itemcode'";
	//$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
}




?>