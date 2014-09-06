<?php
session_start();
//Called from purchase1.php - autoitemsearch2.js
//Item rate called from previous bill entry is done here.

include ("db/db_connect.php");
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$companycode = $_SESSION['companycode'];

$packagename = "1\'S";
$packagename = stripslashes($packagename);
$packagename = addslashes($packagename);

			echo $query32 = "select * from master_packagepharmacy where  itemcode = 'ph003'"; //packagename = '$packagename'";
			$exec32 = mysql_query($query32) or die ("Error in Query32".mysql_error());
			$res32 = mysql_fetch_array($exec32);
			echo $packageanum = $res32['auto_number'];
			echo $quantityperpackage = $res32['quantityperpackage'];
			//$allpackagetotalquantity = $quantityperpackage * $itemtotalquantity;
			
?>