<?php
session_start();
include ("db/db_connect.php");

if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }

$query2 = "select * from master_customer where customercode = '$customercode'";// and customerstatus = 'Active'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2anum = $res2["auto_number"];
$customername = $res2["customername"];
$address = $res2["address1"];
$location = $res2["area"];
//$location = $res2["location"];
$city = $res2["city"];
$state = $res2["state"];
$pincode = $res2["pincode"];
$tinnumber = $res2["tinnumber"];
$cstnumber = $res2["cstnumber"];

$query3 = "select * from master_contact where customercode = '$customercode'";// and customerstatus = 'Active'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
$res3 = mysql_fetch_array($exec3);
$res3anum = $res3["auto_number"];
$title1 = $res3["title1"];
$contactperson1 = $res3["contactperson1"];
$designation1 = $res3["designation1"];
$department1 = $res3["department1"];

if ($res2anum != '')
{
	echo $customercode.'||'.$customername.'||'.$address.'||'.$location.'||'.$city.'||'.$state.'||'.$pincode.'||'.$title1.'||'.$contactperson1.'||'.$designation1.'||'.$department1.'||'.$res2anum.'||'.$tinnumber.'||'.$cstnumber;
}


?>