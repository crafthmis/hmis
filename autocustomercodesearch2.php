<?php

include ("db/db_connect.php");
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];

if (isset($_REQUEST["customersearch"])) { $customersearch = $_REQUEST["customersearch"]; } else { $customersearch = ""; }
//$customersearch = $_REQUEST["customersearch"];
//$customersearch = strtoupper($customersearch);
$searchresult = "";
$cashamount2 = "";
$creditamount2 = "";
$cardamount2 = "";
$onlineamount2 = "";
$chequeamount2 = "";
$tdsamount2 = "";
$writeoffamount2 = "";
$totalsales = "";
$openingbalance = "";
$totalbalance = "";

$query2 = "select * from master_customer where customercode = '$customersearch' order by customername";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
	$res2anum = $res2['auto_number'];
	$customercode = $res2["customercode"];
	$customername = $res2["customername"];
	$address1 = $res2["address1"];
	$area = $res2["area"];
	$city = $res2["city"];
	$pincode = $res2["pincode"];
	$tinnumber = $res2["tinnumber"];
	$cstnumber = $res2["cstnumber"];
	$gender = $res2["gender"];
	$age = $res2["age"];
	$registrationdate = $res2["registrationdate"];
	$consultationfees = $res2["consultationfees"];
	$insurancecompany = $res2["insurancecompany"];
	$tpa = $res2["tpa"];
	
	//Code from collectionpending1hospital.php
	//Collection of advance amounts paid and unused in invoices.
	//$query3 = "select * from master_transactionhospital where transactiontype = 'COLLECTION' and customeranum = '$res2anum' and advancestatus = '' and supplieranum = '0' and suppliername = '' and recordstatus = '' and companyanum = '$companyanum'";
	$query3 = "select * from master_transactionhospital where transactiontype = 'COLLECTION' and customeranum = '$res2anum' and advancestatus = 'ADVANCE PAYMENT' and advanceremarks = '' and supplieranum = '0' and suppliername = '' and recordstatus = '' and companyanum = '$companyanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	while ($res3 = mysql_fetch_array($exec3))
	{
		$cashamount1 = $res3['cashamount'];
		$creditamount1 = $res3['creditamount'];
		$cardamount1 = $res3['cardamount'];
		$onlineamount1 = $res3['onlineamount'];
		$chequeamount1 = $res3['chequeamount'];
		$tdsamount1 = $res3['tdsamount'];
		$writeoffamount1 = $res3['writeoffamount'];
		
		$cashamount2 = $cashamount2 + $cashamount1;
		$creditamount2 = $creditamount2 + $creditamount1;
		$cardamount2 = $cardamount2 + $cardamount1;
		$onlineamount2 = $onlineamount2 + $onlineamount1;
		$chequeamount2 = $chequeamount2 + $chequeamount1;
		$tdsamount2 = $tdsamount2 + $tdsamount1;
		$writeoffamount2 = $writeoffamount2 + $writeoffamount1;
	}
	
	$totalpayments = $cashamount2 + $chequeamount2 + $onlineamount2 + $cardamount2;
	//$netpayments = $totalpayments + $tdsamount2 + $writeoffamount2;
	//$balanceamount = $totalsales - $netpayments;
	//$balanceamount = $balanceamount + $openingbalance;
	//$totalbalance=$totalbalance+$balanceamount;
	
	
	if ($searchresult == '')
	{
		$searchresult = ''.$customercode.'||'.$customername.'||'.$registrationdate.'||'.$address1.'||'.$area.'||'.$city.'||'.$pincode.'||'.$tinnumber.'||'.$cstnumber.'||'.$gender.'||'.$age.'||'.$totalpayments.'||'.$consultationfees.'||'.$insurancecompany.'||'.$tpa.'';
	}
	else
	{
		$searchresult = $searchresult.'||^||'.$customercode.'||'.$customername.'||'.$registrationdate.'||'.$address1.'||'.$area.'||'.$city.'||'.$pincode.'||'.$tinnumber.'||'.$cstnumber.'||'.$gender.'||'.$age.'||'.$totalpayments.'||'.$consultationfees.'||'.$insurancecompany.'||'.$tpa.'';
	}
	
}

if ($searchresult != '')
{
	echo $searchresult;
}

?>