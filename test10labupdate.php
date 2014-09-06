<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_itemlabdummy2 where rateperunit <> '0.00'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$itemanum = $res1['auto_number'];
	$rateperunit = $res1['rateperunit'];

	echo '<br><br>'.$query2 = "update master_itemlab set rateperunit = '$rateperunit' where auto_number = '$itemanum'";
	//$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
}


?>