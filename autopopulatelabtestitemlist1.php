<?php
session_start();
include ("db/db_connect.php");
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];

if (isset($_REQUEST["categoryname"])) { $categoryname = $_REQUEST["categoryname"]; } else { $categoryname = ""; }
//$customersearch = $_REQUEST["customersearch"];
//$customersearch = strtoupper($customersearch);
$searchresult = '';

$query2 = "select * from master_itemlab where categoryname = '$categoryname' order by auto_number";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
	$res2anum = $res2['auto_number'];
	$itemcode = $res2["itemcode"];
	$itemname = $res2["itemname"];
	$unitname = $res2["unitname_abbreviation"];
	$referencevalue = $res2["referencevalue"];
	
	if ($searchresult == '')
	{
		$searchresult = ''.$itemcode.'||'.$itemname.'||'.$unitname.'||'.$referencevalue.'';
	}
	else
	{
		$searchresult = $searchresult.'||^||'.$itemcode.'||'.$itemname.'||'.$unitname.'||'.$referencevalue.'';
	}
	
}

if ($searchresult != '')
{
	echo $searchresult;
}

?>