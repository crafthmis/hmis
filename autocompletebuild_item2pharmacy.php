<?php
//session_start();
set_time_limit(0);
include ("db/db_connect.php");

if (isset($_REQUEST["itemname"])) { $itemname = $_REQUEST["itemname"]; } else { $itemname = ""; }
//$previousbillnumber = $_REQUEST["billnumber"];

$stringbuild2 = '';
$query1 = "select * from master_itempharmacy where itemname like '%$itemname%' and status <> 'deleted' order by itemcode limit 0, 20";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$citemcode = $res1["itemcode"];
	$citemcode = strtoupper($citemcode);
	$citemname = $res1["itemname"];
	$citemname = strtoupper($citemname);

	$ccategoryname = $res1["categoryname"];
	$citemname = stripslashes($citemname);
	$citemname = preg_replace('/,/', ' ', $citemname);
	$citemname = preg_replace ('/["]/i','\"', $citemname);
	$citemname = preg_replace ("/[']/i","\'", $citemname);

	if ($stringbuild2 == '')
	{
		//$stringbuild2 = '"'.$citemcode.' || '.$citemname.' || '.$citemstock.'"';
		//$stringbuild2 = '"'.$citemcode.' || '.$citemname. '"'; //.' || '.$citemstock.'"';
		$stringbuild2 = ''.$citemcode.' || '.$citemname. ''; //.' || '.$citemstock.'"';
	}
	else
	{
		//$stringbuild2 = $stringbuild2.'^^^^"'.$citemcode.' || '.$citemname.'"';
		$stringbuild2 = $stringbuild2.'^^^^'.$citemcode.' || '.$citemname.'';
	}
}
echo $stringbuild2;




?>