<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$dateonly = date("Y-m-d");
$username = $_SESSION["username"];
$ipaddress = $_SERVER["REMOTE_ADDR"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];

$titlestr = 'SALES BILL';

//include ("login1salesdataredirect1.php");

//to redirect if there is no entry in masters category or item.
$query90 = "select count(auto_number) as masterscount from master_categorylabtest";
$exec90 = mysql_query($query90) or die ("Error in Query90".mysql_error());
$res90 = mysql_fetch_array($exec90);
$res90count = $res90["masterscount"];
if ($res90count == 0)
{
	header ("location:addcategory1labtest.php?svccount=firstentry");
}


//to redirect if there is no entry in masters category or item or customer.
$query90 = "select count(auto_number) as masterscount from master_itemlabtest";
$exec90 = mysql_query($query90) or die ("Error in Query90".mysql_error());
$res90 = mysql_fetch_array($exec90);
$res90count = $res90["masterscount"];
if ($res90count == 0)
{
	header ("location:additem1labtest.php?svccount=firstentry");
	exit;
}

//to redirect if there is no entry in masters category or item or customer.
$query91 = "select count(auto_number) as masterscount from master_customer";
$exec91 = mysql_query($query91) or die ("Error in Query91".mysql_error());
$res91 = mysql_fetch_array($exec91);
$res91count = $res91["masterscount"];
if ($res91count == 0)
{
	header ("location:addpatient1.php?svccount=firstentry");
	exit;
}

/*
//to redirect if there is no entry in masters category or item or customer or settings
$query91 = "select count(auto_number) as masterscount from settings_billhospital where companyanum = '$companyanum'";
$exec91 = mysql_query($query91) or die ("Error in Query91".mysql_error());
$res91 = mysql_fetch_array($exec91);
$res91count = $res91["masterscount"];
if ($res91count == 0)
{
	header ("location:settingsbill1.php?svccount=firstentry");
	exit;
}
*/

//to redirect if there is no entry in masters category or item or customer or settings
$query91 = "select count(auto_number) as masterscount from settings_billlab where companyanum = '$companyanum'";
$exec91 = mysql_query($query91) or die ("Error in Query91".mysql_error());
$res91 = mysql_fetch_array($exec91);
$res91count = $res91["masterscount"];
if ($res91count == 0)
{
	header ("location:settingsbill1lab.php?svccount=firstentry");
	exit;
}


//To get default tax from autoitemsearch1.php and autoitemsearch2.php - for CST tax override.
if (isset($_REQUEST["defaulttax"])) { $defaulttax = $_REQUEST["defaulttax"]; } else { $defaulttax = ""; }
//$defaulttax = $_REQUEST["defaulttax"];
if ($defaulttax == '')
{
	$_SESSION["defaulttax"] = '';
}
else
{
	$_SESSION["defaulttax"] = $defaulttax;
}

//This include updatation takes too long to load for hunge items database.
include ("autocompletebuild_customer1.php");
//To populate the autocompetelist_services1.js
include ("autocompletebuild_item1labtest.php");

//To verify the edition and manage the count of bills.
$thismonth = date('Y-m-');
$query77 = "select * from master_edition where status = 'ACTIVE'";
$exec77 =  mysql_query($query77) or die ("Error in Query77".mysql_error());
$res77 = mysql_fetch_array($exec77);
$res77allowed = $res77["allowed"];

$query88 = "select count(auto_number) as cntanum from master_saleslabtest";// where lastupdate like '$thismonth%'";
$exec88 = mysql_query($query88) or die ("Error in Query88".mysql_error());
$res88 = mysql_fetch_array($exec88);
$res88cntanum = $res88["cntanum"];

/*
$query99 = "select count(auto_number) as cntanum from master_quotation where quotationdate like '$thismonth%'";
$exec99 = mysql_query($query99) or die ("Error in Query99".mysql_error());
$res99 = mysql_fetch_array($exec99);
$res99cntanum = $res99["cntanum"];
$totalbillandquote = $res88cntanum + $res99cntanum; //total of bill and quote in current month.
if ($totalbillandquote > $res77allowed)
{
	//header ("location:usagelimit1.php"); // redirecting.
	//exit;
}
*/

//To Edit Bill
if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
//$delbillst = $_REQUEST["delbillst"];
if (isset($_REQUEST["delbillautonumber"])) { $delbillautonumber = $_REQUEST["delbillautonumber"]; } else { $delbillautonumber = ""; }
//$delbillautonumber = $_REQUEST["delbillautonumber"];
if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
//$delbillnumber = $_REQUEST["delbillnumber"];

if (isset($_REQUEST["frm1submit1"])) { $frm1submit1 = $_REQUEST["frm1submit1"]; } else { $frm1submit1 = ""; }
//$frm1submit1 = $_REQUEST["frm1submit1"];
if ($frm1submit1 == 'frm1submit1')
{
	$delbillst = $_REQUEST["delbillst"];
	$delbillstanum = $_REQUEST["delbillautonumber"];
	$delbillnumber = $_REQUEST["delbillnumber"];
	//if ($delbillst == 'billedit' && $delbillstanum != '' && $delbillnumber != '')
	if ($delbillst == 'billedit' && $delbillnumber != '')
	{
		//$query19 = "select auto_number,lastupdate from master_saleslabtest where auto_number = '$delbillautonumber' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";
		$query19 = "select auto_number,lastupdate from master_saleslabtest where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
		while ($res19 = mysql_fetch_array($exec19))
		{
			$res19anum = $res19["auto_number"];
			$billdatetime=$res19["updatedate"];
			
			//$query15 = "update master_saleslabtest set recordstatus = 'DELETED' where auto_number = '$res19anum' and companyanum = '$companyanum'";
			$query15 = "update master_saleslabtest set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		
			//$query16 = "update labtestsales_details set recordstatus = 'DELETED' where bill_autonumber = '$res19anum' and companyanum = '$companyanum'";
			$query16 = "update labtestsales_details set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		
			//$query17 = "update labtestsales_tax set recordstatus = 'DELETED' where bill_autonumber = '$res19anum' and companyanum = '$companyanum'";
			$query17 = "update labtestsales_tax set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
		
			//$query18 = "update master_transaction set recordstatus = 'DELETED' where billanum = '$res19anum' and companyanum = '$companyanum'";
			//$query18 = "update master_transaction set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			//$exec18 = mysql_query($query18) or die ("Error in Query18".mysql_error());
			
			//$query20="update master_stock set recordstatus='DELETED' where transactionmodule = 'SALES' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			//$exec20=mysql_query($query20) or die("Error in Query19".mysql_error());
	
		}
	}
}

include ("sales1include1labtest.php"); //handles all the sales insert operations


if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST["st"];
if (isset($_REQUEST["banum"])) { $banum = $_REQUEST["banum"]; } else { $banum = ""; }
//$banum = $_REQUEST["banum"];
if ($st == '1')
{
	$errmsg = "Success. New Bill Updated. You May Continue To Add Another Bill.";
	$bgcolorcode = 'success';
}
if ($st == '2')
{
	$errmsg = "Failed. New Bill Cannot Be Completed.";
	$bgcolorcode = 'failed';
}
if ($st == '1' && $banum != '')
{
	$loadprintpage = 'onLoad="javascript:loadprintpage1()"';
}

if ($delbillst == "" && $delbillnumber == "")
{
	$res41customername = "";
	$res41customercode = "";
	$res41tinnumber = "";
	$res41cstnumber = "";
	$res41address1 = "";
	$res41deliveryaddress = "";
	$res41area = "";
	$res41city = "";
	$res41pincode = "";
	$res41billdate = "";
	$billnumberprefix = "";
	$billnumberpostfix = "";
}
if ($delbillst == 'billedit' && $delbillnumber != '')
{
	$query41 = "select * from master_saleslabtest where billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear' and recordstatus <> 'deleted'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
	$res41customername = $res41["customername"];
	$res41customercode = $res41["customercode"];
	$res41tinnumber = $res41["tinnumber"];
	$res41cstnumber = $res41["cstnumber"];
	$res41address1 = $res41["address"];
	$res41area = $res41["location"];
	$res41city = $res41["city"];
	$res41pincode = $res41["pincode"];
	$res41billdate = $res41["billdate"];
	$res41billdate = substr($res41billdate, 0, 10);
	$dateonly = $res41billdate;
	$billnumberprefix = $res41["billnumberprefix"];
	$billnumberpostfix = $res41["billnumberpostfix"];
	$res41deliveryaddress = $res41["deliveryaddress"];
}

if ($delbillst == 'importsalesorder' && $delbillnumber != '')
{
	$query41 = "select * from master_salesorder where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
	$res41customername = $res41["customername"];
	$res41customercode = $res41["customercode"];
	$res41tinnumber = $res41["tinnumber"];
	$res41cstnumber = $res41["cstnumber"];
	$res41address1 = $res41["address"];
	$res41area = $res41["location"];
	$res41city = $res41["city"];
	$res41pincode = $res41["pincode"];
	//$res41billdate = $res41["billdate"];
	//$res41billdate = substr($res41billdate, 0, 10);
	//$dateonly = $res41billdate;
	//$billnumberprefix = $res41["billnumberprefix"];
	//$billnumberpostfix = $res41["billnumberpostfix"];
	$res41deliveryaddress = $res41["deliveryaddress"];
}

?>
<?php include ("includes/pagetitle1.php"); ?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>

<?php include ("js/sales1scripting1labtest.php"); ?>
<?php include ("js/dropdownlist1scripting1.php"); ?>

<script type="text/javascript" src="js/salesinsertitem1labtest.js"></script>
<script type="text/javascript" src="js/autoitemsearch2labtest.js"></script>
<script type="text/javascript" src="js/autosuggest1.js"></script> <!-- For searching customer -->
<script type="text/javascript" src="js/autocomplete_customer1.js"></script>
<script type="text/javascript" src="js/autocustomercodesearch2.js"></script>
<script type="text/javascript" src="js/autosuggest2labtest.js"></script>
<script type="text/javascript" src="js/autocomplete_item1labtest.js"></script> <!-- Drop Down List Holding File -->
<!--<script type="text/javascript" src="js/autocomplete_itemsearch1labtest.js"></script>-->
<script type="text/javascript" src="js/autocomplete_itemsearch3labtest.js"></script> <!-- For mouse click event of item name drop down list. -->
<script type="text/javascript" src="js/autoitemsearch3labtest.js"></script> <!-- For enter key selection and mouse click event of item name drop down list. -->
<script type="text/javascript" src="js/billnovalidation1.js"></script>
<!--<script type="text/javascript" src="js/billnumberlatest1.js"></script>-->
<!-- Item rate from previous bill entry is called from autoitemsearch3.js -->
<script language="javascript">

<?php
if ($delbillst != 'billedit') // Not in edit mode or other mode.
{
?>
	//Function call from billnumber onBlur and Save button click.
	function billvalidation()
	{
		billnovalidation1();
	}
<?php
}
?>


function funcOnLoadBodyFunctionCall()
{
	funcBodyOnLoad(); //To reset any previous values in text boxes. source .js - sales1scripting1.php
	
	funcCustomerDropDownSearch1(); //To handle ajax dropdown list.
	
}

function funcPopupPrintFunctionCall()
{

	//alert ("Auto Print Function Runs Here.");
	<?php
	if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
	//$src = $_REQUEST["src"];
	if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
	//$st = $_REQUEST["st"];
	if (isset($_REQUEST["billnumber"])) { $previousbillnumber = $_REQUEST["billnumber"]; } else { $previousbillnumber = ""; }
	//$previousbillnumber = $_REQUEST["billnumber"];
	if (isset($_REQUEST["billautonumber"])) { $previousbillautonumber = $_REQUEST["billautonumber"]; } else { $previousbillautonumber = ""; }
	//$previousbillautonumber = $_REQUEST["billautonumber"];
	if (isset($_REQUEST["companyanum"])) { $previouscompanyanum = $_REQUEST["companyanum"]; } else { $previouscompanyanum = ""; }
	//$previouscompanyanum = $_REQUEST["companyanum"];
	if ($src == 'frm1submit1' && $st == 'success')
	{
	$query1print = "select * from master_printer where defaultstatus = 'default' and status <> 'deleted'";
	$exec1print = mysql_query($query1print) or die ("Error in Query1print.".mysql_error());
	$res1print = mysql_fetch_array($exec1print);
	$papersize = $res1print["papersize"];
	$paperanum = $res1print["auto_number"];
	$printdefaultstatus = $res1print["defaultstatus"];
	if ($paperanum == '1') //For 40 Column paper
	{
	?>
		//quickprintbill1();
		quickprintbill1sales();
	<?php
	}
	else if ($paperanum == '2') //For A4 Size paper
	{
	?>
		loadprintpage1('A4');
	<?php
	}
	else if ($paperanum == '3') //For A4 Size paper
	{
	?>
		loadprintpage1('A5');
	<?php
	}
	}
	?>
}

//Print() is at bottom of this page.

</script>
<script type="text/javascript">

function loadprintpage1(varPaperSizeCatch)
{
	//var varBillNumber = document.getElementById("billnumber").value;
	var varPaperSize = varPaperSizeCatch;
	//alert (varPaperSize);
	//return false;
	<?php
	//To previous js error if empty. 
	if ($previousbillnumber == '') 
	{ 
		$previousbillnumber = 1; 
		$previousbillautonumber = 1; 
		$previouscompanyanum = 1; 
	} 
	?>
	var varBillNumber = document.getElementById("quickprintbill").value;
	var varBillAutoNumber = "<?php //echo $previousbillautonumber; ?>";
	var varBillCompanyAnum = "<?php echo $_SESSION["companyanum"]; ?>";
	if (varBillNumber == "")
	{
		alert ("Bill Number Cannot Be Empty.");//quickprintbill
		document.getElementById("quickprintbill").focus();
		return false;
	}
	
	var varPrintHeader = "INVOICE";
	var varTitleHeader = "ORIGINAL";
	if (varTitleHeader == "")
	{
		alert ("Please Select Print Title.");
		document.getElementById("titleheader").focus();
		return false;
	}
	
	//alert (varBillNumber);
	//alert (varPrintHeader);
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');

	if (varPaperSize == "A4")
	{
		window.open("print_bill1labtest.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&billnumber="+varBillNumber+"","OriginalWindowA4<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	}
	if (varPaperSize == "A5")
	{
		window.open("print_bill1labtest_a5.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&billnumber="+varBillNumber+"","OriginalWindowA5<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	}
}

function cashentryonfocus1()
{
	if (document.getElementById("cashgivenbycustomer").value == "0.00")
	{
		document.getElementById("cashgivenbycustomer").value = "";
		document.getElementById("cashgivenbycustomer").focus();
	}
}

function funcDefaultTax1() //Function to CST Taxes if required.
{
	//alert ("Default Tax");
	<?php
	//delbillst=billedit&&delbillautonumber=13&&delbillnumber=1
	//To avoid change of bill number on edit option after selecting default tax.
	if (isset($_REQUEST["delbillst"])) { $delBillSt = $_REQUEST["delbillst"]; } else { $delBillSt = ""; }
	//$delBillSt = $_REQUEST["delbillst"];
	if (isset($_REQUEST["delbillautonumber"])) { $delBillAutonumber = $_REQUEST["delbillautonumber"]; } else { $delBillAutonumber = ""; }
	//$delBillAutonumber = $_REQUEST["delbillautonumber"];
	if (isset($_REQUEST["delbillnumber"])) { $delBillNumber = $_REQUEST["delbillnumber"]; } else { $delBillNumber = ""; }
	//$delBillNumber = $_REQUEST["delbillnumber"];
	
	?>
	var varDefaultTax = document.getElementById("defaulttax").value;
	if (varDefaultTax != "")
	{
		<?php
		if ($delBillSt == 'billedit')
		{
		?>
		window.location="sales1labtest.php?defaulttax="+varDefaultTax+"&&delbillst=<?php echo $delBillSt; ?>&&delbillautonumber="+<?php echo $delBillAutonumber; ?>+"&&delbillnumber="+<?php echo $delBillNumber; ?>+"";
		<?php
		}
		else
		{
		?>
		window.location="sales1labtest.php?defaulttax="+varDefaultTax+"";
		<?php
		}
		?>
	}
	else
	{
		window.location="sales1labtest.php";
	}
	//return false;
}



</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext312 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {
	font-size: 36px;
	font-weight: bold;
}
.style2 {
	font-size: 18px;
	font-weight: bold;
}
.style4 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; }
.style6 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration: none; }
-->
</style>

<script src="js/datetimepicker_css.js"></script>

</head>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<body onLoad="return funcOnLoadBodyFunctionCall();">
<form name="frmsales" id="frmsales" method="post" action="sales1labtest.php" onKeyDown="return disableEnterKey(event)">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
<!--  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
-->
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="99%" border="0" align="left" cellpadding="2" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3"><strong>Lab Test Entry </strong></td>
                <td bgcolor="#CCCCCC" class="bodytext3"><strong>
                  <input type="hidden" name="billnumberprefix" id="billnumberprefix" value="<?php echo $billnumberprefix; ?>" style="border: 1px solid #001E6A"  size="5" /> 
                  Bill No. 
				  <?php
				  if ($delbillst == 'billedit' && $delbillnumber != '')
				  {
					$billnumber = $delbillnumber; 
					$billnumbertextboxvalidation = 'readonly="readonly"';
				  }
				  else if ($delbillst == 'importsalesorder' && $delbillnumber != '')
				  {
					//$billnumber = $delbillnumber; 
					$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
				  }
				  else
				  {
					$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
				  }
				  ?>
                  <input name="billnumber" id="billnumber" value="<?php echo $billnumber; ?>" <?php echo $billnumbertextboxvalidation; ?> style="border: 1px solid #001E6A; text-align:right" size="8" /> 
                  <input name="latestbillnumber" id="latestbillnumber" value="<?php echo $billnumber; ?>" type="hidden" size="5">
                  <input type="hidden" name="billnumberpostfix" id="billnumberpostfix" value="<?php echo $billnumberpostfix; ?>" style="border: 1px solid #001E6A"  size="5" />
                </strong></td>
                <td width="12%" bgcolor="#CCCCCC" class="bodytext3"><strong> Date </strong></td>
                <td width="12%" bgcolor="#CCCCCC" class="bodytext3"><span class="bodytext312">
                  <input name="ADate" id="ADate" style="border: 1px solid #001E6A" value="<?php echo $dateonly; ?>"  size="8"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                  <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate')" style="cursor:pointer"/>
				  </span></td>
                <td width="10%" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
                <td bgcolor="#CCCCCC" class="bodytext3">
<!--				
				<select name="defaulttax" id="defaulttax" onChange="return funcDefaultTax1()">
				<?php
				if ($defaulttax == '')
				{
					echo '<option value="" selected="selected">Select Default Tax</option>';
				}
				else
				{
					$query51 = "select * from master_tax where auto_number = '$defaulttax'";
					$exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
					$res51 = mysql_fetch_array($exec51);
					$res51taxname = $res51["taxname"];
					$res51anum = $res51["auto_number"];
					echo '<option value="">Select Normal Tax</option>';
					echo '<option value="'.$res51anum.'" selected="selected">'.$res51taxname.'</option>';
				}
				
				$query5 = "select * from master_tax where status = '' order by taxname desc";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5taxname = $res5["taxname"];
				$res5taxpercent = $res5["taxpercent"];
				?>
				<option value="<?php echo $res5anum; ?>"><?php echo $res5taxname; ?></option>
                <?php
				}
				?>
				</select> 
-->				</td>
              </tr>
			  <?php
				if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
				//$src = $_REQUEST["src"];
				if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
				//$st = $_REQUEST["st"];
				
     		  if (isset($_REQUEST["billnumber"])) { $previousbillnumber = $_REQUEST["billnumber"]; } else { $previousbillnumber = ""; }
			  //$previousbillnumber = $_REQUEST["billnumber"];
			  if ($src == 'frm1submit1' && $st == 'success')
			  {
			  ?>
              <tr>
                <td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">
				* Success. Bill Saved. Click  Print Button To Print or View Previous Bill	
				<input name="billprint" type="button" onClick="return funcPopupPrintFunctionCall()" value="Click Here To Print Invoice" class="button" style="border: 1px solid #001E6A"/>
				* Please Check Your POPUP Settings & Unblock Popups.</td>
              </tr>
              <?php
			  //include ("zprintdmp1test2.php"); 
			  }
	if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
	//$delBillNumber = $_REQUEST["delbillnumber"];
	if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
	//$delBillSt = $_REQUEST["delbillst"];

			  //$delbillnumber = $_REQUEST["delbillnumber"];
			  //$delbillst = $_REQUEST["delbillst"];
			  
			  if ($delbillst == 'billedit' && $delbillnumber != '')
			  {
			  ?>
              <tr>
                <td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">
				* WARNING : Please Note You Are Editing Bill No. <?php echo $delbillnumber; ?> . All The Data For This Bill Will Be Over Written Including Payments. You May Need To Re-Enter Again Everything For This Bill.				</td>
              </tr>
              <?php
			  //include ("zprintdmp1test2.php"); 
			  }
			  ?>
			  <tr>
                <td width="8%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><strong>Patient  * </strong></td>
                <td width="37%" align="left" valign="top" >
				<input name="customer" id="customer" value="<?php echo $res41customername; ?>" style="border: 1px solid #001E6A;" size="40" autocomplete="off"/>
                  <input type="button" name="customersearch" onClick="javascript:customersearch1('sales')" value="Alt+M" accesskey="m" style="border: 1px solid #001E6A"></td>
                <td align="left" valign="middle" ><div align="left"><span class="style4">PT. Code</span></div></td>
                <td colspan="3" align="left" valign="top" >
				<input name="customercode" id="customercode" value="<?php echo $res41customercode; ?>" style="border: 1px solid #001E6A" size="12" rsize="20" />				
				<!--<textarea name="deliveryaddress" cols="25" rows="3" id="deliveryaddress" style="border: 1px solid #001E6A"><?php //echo $res41deliveryaddress; ?></textarea>-->
				<input type="button" name="customercodesearch" onClick="funcCustomerSearch2()" value="Search" style="border: 1px solid #001E6A"></td>
                </tr>
			  <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="style4"><!--Address 1 -->
			      <!--Address 1 -->
			      <strong>Age &amp; Sex </strong></span></td>
			    <td align="left" valign="top" >
				  <input type="text" name="patientage" id="patientage" value="" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="5">
&
<input type="text" name="patientgender" id="patientgender" value="" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="5">
<input type="hidden" name="address1" id="address1" value="<?php echo $res41address1; ?>" style="border: 1px solid #001E6A;text-transform: uppercase;" size="30" />
			      <span class="style4"><!--Area--> </span>
			      <input type="hidden" name="area" id="area" value="<?php echo $res41area; ?>" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="10" /></td>
			    <td align="left" valign="middle" ><span class="bodytext3"><strong>Referred By </strong></span></td>
			    <td colspan="3" align="left" valign="top" ><span class="bodytext3"><strong>
			      <strong>
			      <input type="text" name="referredby" id="referredby" value="" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="40">
			      </strong>
			      <input type="hidden" name="customertin" id="customertin" value="<?php echo $res41tinnumber; ?>" style="border: 1px solid #001E6A"  size="12" />
			    </strong></span></td>
			    </tr>
			  <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			    <td align="left" valign="top" >
			      <input type="hidden" name="city1" id="city1" value="<?php echo $res41city; ?>" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="10" /> 
			    <span class="bodytext3"><strong><!--Pincode--></strong></span>
			      <input type="hidden" name="pincode" id="pincode" value="<?php echo $res41pincode; ?>" style="border: 1px solid #001E6A;text-transform: uppercase;" size="10" /></td>
				  <td align="left" valign="top" >&nbsp;</td>
				  <td align="left" valign="top" ><span class="bodytext3"><strong>
			      <input type="hidden" name="customercst" id="customercst" value="<?php echo $res41cstnumber; ?>" style="border: 1px solid #001E6A"  size="12" />
			    </strong></span></td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td width="21%" align="left" valign="top" >&nbsp;</td>
			  </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td><table id="newtable" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
          <tbody id="tblrowinsert">
            <tr>
              <td width="4%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong>No.</strong></td>
              <td width="7%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong> Code </strong></td>
              <td width="37%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong>Item Name </strong></td>
              <td width="10%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong>Result Value </strong></td>
              <td width="3%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311">&nbsp;</td>
              <td width="12%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong>Test Unit</strong></td>
              <td width="8%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311">&nbsp;</td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311"><strong>Normal Value </strong></td>
              <td width="1%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311">&nbsp;</td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext311">&nbsp;</td>
            </tr>
            <?php
				$itemcount = "";
				//To populate items already in the bill if in edit mode.
				include ('sales_edit1listing1hospital.php');
				//value to initiate serial number if in edit mode.
				$itemcount = $itemcount;
				?>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
          <tbody id="foo">
            <tr>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311"><strong>No.</strong></span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><strong>Code</strong></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311"><strong>Item Name </strong></span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311"><strong>Result Value </strong></span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311"><strong>Test Unit</strong></span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311"><strong>Normal Value </strong></span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td width="3%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input type="hidden" name="dummy1" id="dummy1" style="border: 0px solid #001E6A; background-color:#66CC00; text-align:left" value="" size="1" readonly="readonly" />
			  <input type="text" value="<?php echo $itemcount + 1; ?>" name="itemserialnumber" id="itemserialnumber" style="border: 1px solid #001E6A; text-align:right" size="1" readonly="readonly" /></td>
              <td width="8%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input onKeyDown="itemcodekeypress1(event);" onBlur="itemcodekeypress1();" name="itemcode" id="itemcode" onFocus="javascript:this.select()" style="border: 1px solid #001E6A; text-align:left;text-transform: uppercase;" value="" size="8" /></td>
              <td width="37%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input name="itemname" id="itemname" onFocus="javascript:this.select()" autocomplete="off" style="border: 1px solid #001E6A; text-align:left" value="" size="40" />
			  <span class="bodytext311">
			  <input type="button" name="itemsearch2" onClick="javascript:itemsearch1('sales')" value="Alt+S" accesskey="s" style="border: 1px solid #001E6A">
			  </span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <input name="resultvalue" id="resultvalue" value="" style="border: 1px solid #001E6A; text-align:left;" size="8"  />
              </span>
                <input type="hidden" onKeyDown="return itemquantitykeypress1(event)" onBlur="return itemtotalamountupdate1()" name="itemmrp" onFocus="javascript:this.select()" value="0.00" id="itemmrp" style="border: 1px solid #001E6A; text-align:right" size="6" /></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <input type="hidden" onKeyDown="return itemquantitykeypress1(event)" onBlur="return itemtotalamountupdate1()" name="itemquantity" onFocus="javascript:this.select()" value="1" id="itemquantity" autocomplete="off" style="border: 1px solid #001E6A; text-align:right" size="4" />
              </span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <input name="testunit" id="testunit" value="" style="border: 1px solid #001E6A; text-align:left;" size="8"  />
                <input type="hidden" onKeyDown="return itemquantitykeypress1(event)" onBlur="return itemtotalamountupdate1()" name="itemdiscountrupees" onFocus="javascript:this.select()" value="0.00" id="itemdiscountrupees" style="border: 1px solid #001E6A; text-align:right" size="3" />
                <input type="hidden" onKeyDown="return itemquantitykeypress1(event)" onBlur="return itemtotalamountupdate1()" name="itemdiscountpercent" onFocus="javascript:this.select()" value="0.00" id="itemdiscountpercent" style="border: 1px solid #001E6A; text-align:right" size="2" />
              </span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <input type="hidden" id="itemtaxname" name="itemtaxname" value="">
                <input type="hidden" id="itemtaxautonumber" name="itemtaxautonumber" value="">
                <input type="hidden" onKeyDown="return itemquantitykeypress1(event)" onBlur="return itemtotalamountupdate1()" name="itemtaxpercent" onFocus="javascript:this.select()" value="0.00" id="itemtaxpercent" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="3" />
              </span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <input name="normalvalue" id="normalvalue" value="" style="border: 1px solid #001E6A; text-align:left;" size="8"  />
                <input type="hidden" name="itemtotalamount" value="0.00" id="itemtotalamount" onFocus="javascript:this.select()" onBlur="return funcTaxReverseCalc1()" style="border: 1px solid #001E6A; text-align:right" size="8" />
              </span></td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                
                <input name="Submit22222" type="button" value="Add" onClick="return insertitem1()" class="button" style="border: 1px solid #001E6A"/>
                <input type="hidden" name="itemreversetax" value="0.00" id="itemreversetax" onFocus="javascript:this.select()" onBlur="return funcTaxReverseCalc2()" style="border: 1px solid #001E6A; text-align:right" size="5" />
              </span></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><div align="right"><strong>Description</strong></div></td>
              <td colspan="8" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><strong>
                <textarea name="itemdescription" cols="60" rows="2" id="itemdescription" style="border: 1px solid #001E6A; text-align:left"></textarea>
              <!--Current Stock : --><span class="bodytext311">
              <input type="hidden" onKeyDown="return disableEnterKey()" name="showcurrentstock1" id="showcurrentstock1" onFocus="javascript:this.select()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left;text-transform: uppercase; background:#CDCDCD" autocomplete="off" value="" size="10" />
              </span></strong></td>
              </tr>
          </tbody>
        </table>		</td>
      </tr>
      <tr>
        <td class="bodytext31" valign="middle">
		<strong><div align="left">&nbsp;</div>
		</strong></td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
            <tbody id="foo">

              <tr>
                <td width="6%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td colspan="4" rowspan="8" align="left" valign="top"  
                bgcolor="#F3F3F3" class="bodytext31">
				<table width="99%" border="0" align="right" cellpadding="2" cellspacing="0"  style="BORDER-COLLAPSE: collapse">
				<tr>
				  <td width="61%" align="left" valign="center"  
				bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
				  <td><span class="bodytext311"><strong>
				    <input type="hidden" name="allitemdiscountpercent" id="allitemdiscountpercent" onBlur="return funcAllItemDiscountApply1()" 
				style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="6" />
				    <input name="subtotaldiscountpercent" id="subtotaldiscountpercent" onKeyDown="return funcResetPaymentInfo1()" 
					 type="hidden" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" />
				    <input name="totaldiscountamount" id="totaldiscountamount" value="0.00" type="hidden" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
				    <input type="hidden" name="subtotaldiscountrupees" id="subtotaldiscountrupees" onKeyDown="return funcResetPaymentInfo1()" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" />
				    <input type="hidden" name="afterdiscountamount" id="afterdiscountamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
				  </strong></span></td>
				  </tr>
				  <tr>
                    <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
				    <td><span class="bodytext311"><strong>
                      
				      <input type="hidden" name="subtotaldiscountpercentapply1" id="subtotaldiscountpercentapply1" onBlur="return funcSubTotalDiscountApply1()"
				style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="4" />
                      <strong>
                      <input type="hidden" name="subtotaldiscountamountapply1" id="subtotaldiscountamountapply1" onBlur="return funcSubTotalDiscountApply1()" readonly="readonly" 
				style="border: 1px solid #001E6A; text-align:right; background-color:#CCCCCC" value="0.00" size="4" />
                      </strong></span></td>
				    </tr>
				  <tr bordercolor="#f3f3f3">
                    <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
				    <td><span class="bodytext311"><strong>
                      <input name="subtotaldiscountamountonlyapply1" id="subtotaldiscountamountonlyapply1" onBlur="return funcSubTotalDiscountApply1()" 
				 type="hidden" style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="4" />
                      <input name="subtotaldiscountamountonlyapply2" id="subtotaldiscountamountonlyapply2" onBlur="return funcSubTotalDiscountApply1()" readonly="readonly"  
				 type="hidden" style="border: 1px solid #001E6A; text-align:right; background-color:#CCCCCC" value="0.00" size="4" />
                    </strong></span></td>
				    </tr>
				<?php
				if (isset($_REQUEST["defaulttax"])) { $defaulttax = $_REQUEST["defaulttax"]; } else { $defaulttax = ""; }
				//$defaulttax = $_SESSION["defaulttax"];
				
				if ($defaulttax == '')
				{
					$query5 = "select * from master_tax where status = '' order by taxname desc";
				}
				else
				{
					$query5 = "select * from master_tax where status = '' and auto_number = '$defaulttax' order by taxname desc";
				}
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5taxname = $res5["taxname"];
				$res5taxpercent = $res5["taxpercent"];
				?>
				  <tr>
                    <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><span class="bodytext311">
                      <input type="hidden" name="totaltax_autonumber<?php echo $res5anum; ?>" value="<?php echo $res5anum; ?>">
                      <input type="hidden" name="totaltaxname<?php echo $res5anum; ?>" value="<?php echo $res5taxname; ?>">
                      <input type="hidden" name="totaltaxpercent<?php echo $res5anum; ?>" value="<?php echo $res5taxpercent; ?>">
                    </span>
                      <div align="right"><strong><?php //echo strtoupper($res5taxname); //.' '.$res5taxpercent.'%'; ?></strong></div></td>
                    <td width="39%"><span class="bodytext312">
                      <input type="hidden" name="totaltaxamount<?php echo $res5anum; ?>" id="totaltaxamount<?php echo $res5anum; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" />
                    </span></td>
                  </tr>
 				<?php
				$res6loopcount = '';
				$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
				$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
				while ($res6 = mysql_fetch_array($exec6))
				{
				$res6anum = $res6["auto_number"];
				$res6taxname = $res6["taxsubname"];
				$res6taxpercent = $res6["taxsubpercent"];
				$res6loopcount = $res6loopcount + 1;
				//echo $res6loopcount;
				?>
				  <tr>
                    <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><span class="bodytext311">
                      <input type="hidden" name="totaltaxsub_autonumber<?php echo $res6loopcount; ?>" value="<?php echo $res6anum; ?>">
                      <input type="hidden" name="totaltaxsubname<?php echo $res6loopcount; ?>" value="<?php echo $res6taxname; ?>">
                      <input type="hidden" name="totaltaxsubpercent<?php echo $res6loopcount; ?>" value="<?php echo $res6taxpercent; ?>">
                    </span>
                      <div align="right"><strong><?php echo strtoupper($res6taxname);//.' '.$res6taxpercent.'%'; ?></strong></div></td>
                    <td width="39%"><span class="bodytext312">
                      <input type="hidden" name="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" id="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" />
                    </span></td>
                  </tr>
				<?php
				}
				}
				?>
                </table>				</td>
                <td width="20%" rowspan="3" align="right" valign="center"  
                bgcolor="#F3F3F3" class="style1" id="tdShowTotalAmount1"></td>
                <td width="16%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input type="hidden" name="subtotal" id="subtotal" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext311">
                  <input type="hidden" name="subtotalaftercombinediscount" id="subtotalaftercombinediscount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext312">
                  <input type="hidden" name="totalaftertax" id="totalaftertax" value="0.00"  onKeyDown="return disableEnterKey()" onBlur="return funcSubTotalCalc()" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly"/>
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="right" valign="center"  class="bodytext31" 
                bgcolor="#F3F3F3">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right">
				<strong><?php //echo $f29; ?></strong></div></td>
                <td align="left" valign="top" >
				<input  type="hidden" name="packaging" id="packaging" value="0.00" onKeyDown="return disableEnterKey()" onBlur="return funcbillamountcalc1()" style="border: 1px solid #001E6A; text-align:right" size="8"/></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="right" valign="center"  class="style2" 
                bgcolor="#F3F3F3" id="tdShowCustomerBalanceAmount1"></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong><?php //echo $f30; ?></strong></div></td>
                <td align="left" valign="top" ><span class="bodytext312"><span class="bodytext311">
                  <input  type="hidden" name="delivery" id="delivery" value="0.00" onKeyDown="return disableEnterKey()" onBlur="return funcbillamountcalc1()" style="border: 1px solid #001E6A; text-align:right" size="8"/>
                </span></span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="right" valign="center"  class="style2" 
                bgcolor="#F3F3F3">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext311">
                  <input type="hidden" name="roundoff" id="roundoff" value="0.00" style="border: 1px solid #001E6A; text-align:right"  readonly="readonly" size="8"/>
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td colspan="2" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext311">
                  <input type="hidden" name="totalamount" id="totalamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="middle" >
				<!--<select name="billtype" id="billtype" onChange="return paymentinfo()" onFocus="return funcbillamountcalc1()">-->
				<select name="billtype" id="billtype" onChange="return paymentinfo()">
                    <option value="">SELECT BILL TYPE</option>
                    <option value="LAB TEST">LAB TEST</option>
					<?php
					//$query1billtype = "select * from master_billtype order by listorder";
					//$exec1billtype = mysql_query($query1billtype) or die ("Error in Query1billtype".mysql_error());
					//while ($res1billtype = mysql_fetch_array($exec1billtype))
					//{
					//$billtype = $res1billtype["billtype"];
					?>
                    <!--<option value="<?php echo $billtype; ?>"><?php echo $billtype; ?></option>-->
					<?php
					//}
					?>
<!--					
                    <option value="CASH">CASH</option>
                    <option value="CREDIT">CREDIT</option>
                    <option value="CHEQUE">CHEQUE</option>
                    <option value="CREDIT CARD">CREDIT CARD</option>
                    <option value="ONLINE">ONLINE</option>
                    <option value="SPLIT">SPLIT</option>
-->					
                  </select>				  </td>
              </tr>
              <tr id="cashamounttr">
                <td colspan="7" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Cash Amount </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="cashamount" id="cashamount" onBlur="return funcbillamountcalc1()" tabindex="1" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
			  
              <tr id="cashamounttr2">
                <td colspan="7" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Cash Given By Patient </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="cashgivenbycustomer" id="cashgivenbycustomer" onBlur="return funcbillamountcalc1()" onFocus="return cashentryonfocus1()" tabindex="2" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" autocomplete="off"  />
                </span></td>
              </tr>
              <tr id="cashamounttr3">
                <td colspan="7" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Cash To Be Returned To Patient </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="cashgiventocustomer" id="cashgiventocustomer" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" readonly="readonly"  />
                </span></td>
              </tr>
			  
              <tr id="creditamounttr">
                <td colspan="7" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Credit Amount </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="creditamount" id="creditamount" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
              <tr id="chequeamounttr">
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Chq Date  </strong></div></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><span class="bodytext311">
                  <input name="chequedate" id="chequedate" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase" size="8"  />
                </span></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong> Chq No. </strong></div></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><input name="chequenumber" id="chequenumber" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase" size="8"  /></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong> Bank  </strong></div></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><!--				<input name="bankname" id="bankname" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase"  size="8"  />
-->
                  <span class="bodytext311">
                  <input name="chequebank" id="chequebank" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase" size="8"  />
                  </span></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Cheque Amount </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="chequeamount" id="chequeamount" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>
              <tr id="cardamounttr">
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Card  </strong></div></td>
                <td width="13%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">
				<select name="cardname" id="cardname">
				<option value="">SELECT CARD</option>
                  <?php
				$querycom="select * from master_creditcard where status <> 'deleted'";
				$execcom=mysql_query($querycom) or die("Error in querycom".mysql_error());
				while($rescom=mysql_fetch_array($execcom))
				{
				$creditcardname=$rescom["creditcardname"];
				?>
                  <option value="<?php echo $creditcardname;?>"><?php echo $creditcardname;?></option>
                  <?php
				}
				?>
                </select></td>
                <td width="6%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong> Number </strong></div></td>
                <td width="6%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><input name="cardnumber" id="cardnumber" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase" size="8"  /></td>
                <td width="17%" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong> Bank  </strong></div></td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">
                <input name="bankname" id="bankname" value="" style="border: 1px solid #001E6A; text-align:left; text-transform:uppercase"  size="8"  />
				<!--
				<select name="bankname" id="bankname">
                    <option value="" selected="selected">SELECT</option>
                    <?php
				$query1 = "select * from master_bank where bankstatus <> 'DELETED'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$bankanum = $res1["auto_number"];
				$bankname = $res1["bankname"];
				?>
                    <option value="<?php echo $bankname; ?>"><?php echo $bankname; ?></option>
                    <?php
				}
				?>
-->				
                      </select>				</td>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Card Amount </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="cardamount" id="cardamount" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                </span></td>
              </tr>



              <tr id="onlineamounttr">
                <td colspan="7" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"><strong>Online Amount </strong></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input name="onlineamount" id="onlineamount" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" readonly="readonly" />
                </span></td>
              </tr>
              <tr id="nettamounttr">
                <td colspan="5" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><span class="bodytext32"><strong><?php //echo $f18;?></strong></span>
                  <input type="hidden" name="footerline1" id="footerline1" style="border: 1px solid #001E6A"  size="10" />                  
                  <span class="bodytext32"><strong><?php //echo $f19;?></strong></span>                  
				  <input type="hidden" name="footerline2" id="footerline2" style="border: 1px solid #001E6A"  size="10" /></td>
                <td colspan="2" align="left" valign="center"  
bgcolor="#F3F3F3" class="bodytext31"><div align="right"></div></td>
                <td align="left" valign="top" ><span class="bodytext31">
                  <input type="hidden" name="nettamount" id="nettamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" readonly="readonly" />
                </span></td>
              </tr>
              <tr>
                <td colspan="7" align="left" valign="center"  
                bgcolor="#CCCCCC" class="bodytext31"><div align="left"><span class="bodytext32"><strong><?php //echo $f21;?></strong></span>
                  <input type="hidden" name="footerline3" id="footerline3" style="border: 1px solid #001E6A"  size="10" />
                  <span class="bodytext32"><strong><?php //echo $f22;?></strong></span><span class="bodytext311">
                  <input type="hidden" name="footerline4" id="footerline4" style="border: 1px solid #001E6A"  size="10" />
                  </span><strong>Remarks</strong><span class="bodytext311">
                  <input name="remarks" id="remarks" style="border: 1px solid #001E6A;" size="30" />
                  </span></div>                  <div align="left"></div></td>
                <td width="16%" align="left" valign="center"  
                bgcolor="#CCCCCC" class="bodytext31"><div align="right"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input name="frm1submit1" id="frm1submit1" type="hidden" value="frm1submit1">
                  <input name="delbillst" id="delbillst" type="hidden" value="billedit">
                  <input name="delbillautonumber" id="delbillautonumber" type="hidden" value="<?php echo $delbillautonumber;?>">
                  <input name="delbillnumber" id="delbillnumber" type="hidden" value="<?php echo $delbillnumber;?>">

				  <input name="Submit2223" type="button" onClick="return funcSaveBill1()" value="Save Lab Test" accesskey="b" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
              </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="left" cellpadding="2" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr>
              <td width="54%" align="left" valign="top" ><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                <input name="Button1" type="button" class="button" id="Button1" accesskey="c" style="border: 1px solid #001E6A" onClick="return funcRedirectWindow1()" value="Clear All"/>
                <input type="button" name="customersearch2" onClick="javascript:customersearch1('sales')" value="Patient Alt+M" accesskey="m" style="border: 1px solid #001E6A">
                <span class="bodytext31">
                <input type="button" name="itemsearch22" onClick="javascript:itemsearch1('sales')" value="Item Alt+S" accesskey="s" style="border: 1px solid #001E6A">
                <span class="bodytext3">
				<?php
				if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
				//$src = $_REQUEST["src"];
				if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
				//$st = $_REQUEST["st"];
				if (isset($_REQUEST["billnumber"])) { $previousbillnumber = $_REQUEST["billnumber"]; } else { $previousbillnumber = ""; }
				//$previousbillnumber = $_REQUEST["billnumber"];
				
				if ($src == 'frm1submit1' && $st == 'success')
				{
				?>
				<!--
                <input onClick="return loadprintpage1('<?php echo $previousbillnumber; ?>')" value="A4 View Bill <?php echo $previousbillnumber; ?>" name="Button12" type="button" class="button" id="Button12" style="border: 1px solid #001E6A"/>
				-->
				<?php
				}
				?>
                </span></span></font></font></font></font></font></td>
              <td width="46%" align="left" valign="top" ><div align="right"><span class="bodytext31">
                <strong>Print Lab Test No: </strong>
                <input name="quickprintbill" id="quickprintbill" value="<?php echo $previousbillnumber; ?>" style="border: 1px solid #001E6A; text-align:right; text-transform:uppercase"  size="7"  />
                <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                <!--<input name="print4inch2" type="button" class="button" id="print4inch2" style="border: 1px solid #001E6A" 
				  onClick="return quickprintbill1sales()" value="Print 40" accesskey="p"/>-->
                </font></font></font></font></font></font></font></font></font>                <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <!--<input name="print4inch" type="button" class="button" id="print4inch" style="border: 1px solid #001E6A" 
				  onClick="return quickprintbill2sales()" value="View 40" accesskey="p"/>-->
                  <input onClick="return loadprintpage1('A4<?php //echo $previousbillnumber; ?>')" value="View A4" 
				  name="printA4" type="button" class="button" id="printA4" style="border: 1px solid #001E6A"/>
                  <input onClick="return loadprintpage1('A5<?php //echo $previousbillnumber; ?>')" value="View A5" 
				  name="printA5" type="button" class="button" id="printA5" style="border: 1px solid #001E6A"/>

                </font></font></font></font></font></font></font></font></font></span></div></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
  </table>
</form>
<?php include ("includes/footer1.php"); ?>
<?php //include ("print_bill_dmp4inch1.php"); ?>
</body>
</html>