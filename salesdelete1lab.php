<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

	$query6 = "select * from master_company where auto_number = '$companyanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$res6companycode = $res6["companycode"];
	
	$query7 = "select * from master_settings where companycode = '$res6companycode' and modulename = 'SETTINGS' and 
	settingsname = 'CURRENT_FINANCIAL_YEAR'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$financialyear = $res7["settingsvalue"];
	$_SESSION["financialyear"] = $financialyear;
	//echo $_SESSION['financialyear'];

$task = $_REQUEST['task'];
$anum = $_REQUEST['anum'];

if ($task == 'delete' && $anum != '')
{
	$query19 = "select * from master_saleslab where auto_number = '$anum' and companyanum = '$companyanum' and financialyear = '$financialyear'";
	$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
	while ($res19 = mysql_fetch_array($exec19))
	{
		$res19anum = $res19["auto_number"];
		$delbillnumber = $res19['billnumber'];
		
		$query15 = "update master_saleslab set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
	
		$query16 = "update labsales_details set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
	
		$query17 = "update labsales_tax set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
	
		$query18 = "update master_transactionlab set recordstatus = 'DELETED' where transactionmodule = 'SALES' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
		
		//$query20 = "update master_stock set recordstatus='DELETED' where transactionmodule = 'SALES' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		//$exec20=mysql_query($query20) or die("Error in Query19".mysql_error());

	}
}

header ("location:invoicereport1lab.php?task=deleted");
//exit;

?>