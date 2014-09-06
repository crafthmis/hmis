<?php
include ("db/db_connect.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$loopcount = 0;
$query1 = "select * from master_unitspharmacy";// limit 0, 100";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$res1anum = $res1['auto_number'];
	//$itemcode = $res1['itemcode'];
	//$itemname = $res1['itemname'];
	echo $unitname = $res1['unitname'];
	
	$unitname = preg_replace('/[^a-zA-Z0-9\']/', '', $unitname);
	$unitname = str_replace("'", '', $unitname);

	echo ' - '.$unitname;
	echo '<br>';
	
	$query2 = "update master_unitspharmacy set unitname = '$unitname' where auto_number = '$res1anum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$loopcount = $loopcount + 1;
}

echo $loopcount;

?>