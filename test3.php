<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_transactionhospital";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$billanum = $res1['billanum'];
	$transactionanum = $res1['auto_number'];
	
	$query2 = "select * from master_saleshospital where auto_number = '$billanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$billdate = $res2['billdate'];
	
	echo '<br><br>'.$query3 = "update master_transactionhospital set transactiondate = '$billdate' where auto_number = '$transactionanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}



?>