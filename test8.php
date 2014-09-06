<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_itemlab_newvalues where auto_number > '352'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$query2 = "select * from master_itemlab order by auto_number desc limit 0, 1";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$employeecode = 'LT001';
	}
	else
	{
		$res2 = mysql_fetch_array($exec2);
		$res2itemcode = $res2['itemcode'];
		$res2itemcode = substr($res2itemcode, 2, 8);
		$res2itemcode = intval($res2itemcode);
		$res2itemcode = $res2itemcode + 1;
		
		$res2itemcode = $res2itemcode;
		if (strlen($res2itemcode) == 2)
		{
		$res2itemcode = '0'.$res2itemcode;
		}
		if (strlen($res2itemcode) == 1)
		{
		$res2itemcode = '00'.$res2itemcode;
		}
		$res2itemcode = 'LT'.$res2itemcode;
	}
	//echo ' - '.$res2itemcode;
	
	$res1itemcode = $res1['itemcode'];
	$res1itemname = $res1['itemname'];
	$res1categoryname = $res1['categoryname'];
	$res1unitname = $res1['unitname_abbreviation'];
	$res1rateperunit = $res1['rateperunit'];
	$res1expiryperiod = $res1['expiryperiod'];
	$res1taxanum = $res1['taxanum'];
	$res1taxname = $res1['taxname'];
	$res1status = $res1['status'];
	$res1description = $res1['description'];
	$referencevalue = $res1['referencevalue'];
	
	/*
	echo '<br><br>'.$query3 = "insert into master_itemlab (itemcode, itemname, categoryname, unitname_abbreviation, rateperunit, 
	expiryperiod, taxanum, taxname, status, description, referencevalue) 
	values ('$res2itemcode', '$res1itemname', '$res1categoryname', '$res1unitname', '$res1rateperunit', 
	'$res1expiryperiod', '$res1taxanum', '$res1taxname', '$res1status', '$res1description', '$referencevalue')";
	//$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	*/
}



?>