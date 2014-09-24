<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$count = 0;
$query1 = "select * from purchase_details where packagename <> '' and packageanum = '0'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$count = $count + 1;
	$purchasedetailsanum = $res1['auto_number'];
	$packagename = $res1['packagename'];
	$itemtotalquantity = $res1['itemtotalquantity'];
	
	$query2 = "select * from master_packagepharmacy where packagename = '$packagename'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$packageanum = $res2['auto_number'];
	$quantityperpackage = $res2['quantityperpackage'];
	$allpackagetotalquantity = $quantityperpackage * $itemtotalquantity;
	
	echo '<br><br>'.$query3 = "update purchase_details set packageanum = '$packageanum', quantityperpackage = '$quantityperpackage', 
	allpackagetotalquantity = '$allpackagetotalquantity' where auto_number = '$purchasedetailsanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query2".mysql_error());
}

echo '<br><br>'.$count.' Records Udpated.';

?>