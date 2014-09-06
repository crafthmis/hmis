<?php
session_start();
include ("db/db_connect.php");
$errmsg1 = '';
$errmsg2 = '';
$errmsg3 = '';


if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{
	$query1 = "truncate table dccustomer_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dccustomer_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dcsupplier_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dcsupplier_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table details_login";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table expensesub_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table expense_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table hospitalsales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table hospitalsales_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table hospitalsales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table labsales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table labsales_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table labsales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table labtestsales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table labtestsales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table login_restriction";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_backupdatabase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_backupsoftware";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_categoryhospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_contact";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_company";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_contact_supplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_customer";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_dccustomer";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_dcsupplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_dischargesummary";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_doctor";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expense";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expensemain";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expensesub";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_itemhospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_packagehospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_patientadmission";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_production";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_proformainvoice";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchaserequest";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchasereturn";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_quotation";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_renewal";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_saleshospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_saleslab";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_saleslabtest";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salesorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salespharmacy";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salesprescription";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salesreturnpharmacy";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_settings";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_stock";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_supplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_transactionhospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_transactionlab";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_transactionpharmacy";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table pharmacysalesreturn_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table pharmacysalesreturn_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table pharmacysales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table pharmacysales_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table pharmacysales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table prescriptionsales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table prescriptionsales_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table prescriptionsales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table production_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table production_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaserequest_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaserequest_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchasereturn_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchasereturn_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchase_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchase_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchase_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table quotation_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table quotation_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_approval";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_billhospital";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_billlab";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_billlabtest";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_billpharmacy";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_billprescription";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_deliverychallan";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_proformainvoice";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_quotation";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_salesorder";
	$exec1 = mysql_query($query1);
	
	
	$query1 = "insert into master_customer(customercode,customername) values('AMF00000001','CASH CUSTOMER')";
	$exec1 = mysql_query($query1) or die("Error in Query1" . mysql_error());


	$errmsg1 = "Table First Batch Truncate Completed.";
}





?>
<script language="javascript">
function btnClick1()
{
	var fRet3; 
	fRet3 = confirm('Are You Sure Want To Delete All Data In DB And Reset To Original State?'); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		alert ("Data In Table First Batch Not Deleted.");
		return false;
	}
}



</script>
<form id="form1" name="form1" method="post" action="" onsubmit="return btnClick1()">
  <p>Batch One : Will Delete All Data And Restore To Original State. </p>
  <p>
    <input type="submit" name="Submit" value="Truncate All Data" />
    <input type="hidden" name="frmflag1" id="frmflag1" value="frmflag1" />
  </p>
</form>
<?php echo $errmsg1; ?>
