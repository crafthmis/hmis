<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$companycode = $_SESSION['companycode'];

	//Financial year gets reset in this page. To avoid reset, it is again set in session.
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

$cbpatientname = '';
$cbsummarynumber = '';
$cbbillstatus = '';
$patientname = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';

$totalsumtotalamount1 = '0.00';
$totalsumcashamount1 = '0.00';
$totalsumchequeamount1 = '0.00';
$totalsumonlineamount1 = '0.00';
$totalsumcardamount1 = '0.00';
$totalsumcreditamount1 = '0.00';
$totalsumbalancebillamount1 = '0.00';
$totalsumsubtotal1 = '0.00';
$totalsumtotaltax1 = '0.00';
$totalpackaging1 = '0.00';
$totaldelivery1 = '0.00';

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
//$transactiondatefrom = date('Y-m-d', strtotime('-1 week'));
//$transactiondatefrom = date('Y-m-d');//, strtotime('-1 day'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$cbpatientname = $_REQUEST['cbpatientname'];
	$patientname = $_REQUEST['cbpatientname'];
	
	if (isset($_REQUEST["cbsummarynumber"])) { $cbsummarynumber = $_REQUEST["cbsummarynumber"]; } else { $cbsummarynumber = ""; }
	//$cbsummarynumber = $_REQUEST['cbsummarynumber'];
	if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
	//$cbbillstatus = $_REQUEST['cbbillstatus'];
	
	$transactiondatefrom = $_REQUEST['ADate1'];
	$transactiondateto = $_REQUEST['ADate2'];
	
	if (isset($_REQUEST["paymenttype"])) { $paymenttype = $_REQUEST["paymenttype"]; } else { $paymenttype = ""; }
	//$paymenttype = $_REQUEST['paymenttype'];
	if (isset($_REQUEST["billstatus"])) { $billstatus = $_REQUEST["billstatus"]; } else { $billstatus = ""; }
	//$billstatus = $_REQUEST['billstatus'];

}
/*			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
*/


?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function loadprintpage1(summarynumber)
{
	var summarynumber = summarynumber;
	//alert (varqanum);
	window.open("print_bill1dischargesummary.php?summarynumber="+summarynumber+"","Window"+summarynumber+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}
/*
function loadprintpage2(banum)
{
	var varbanum = banum;
	var varbanum1 = "O";
	var varbanum2 = "D";
	
	//alert (varqanum);
			
	window.open("print_bill1.php?copy1=INVOICE && title1=ORIGINAL && banum="+varbanum+"","Window1"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("print_bill1.php?banum="+varbanum+"","Window2"Original"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	
	window.open("print_bill1.php?copy1=INVOICE && title1=DUPLICATE && banum="+varbanum+"","Window2"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	window.open("print_bill1.php?copy1=INVOICE && title1=TRIPLICATE && banum="+varbanum+"","Window3"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}

function loadpdfpage1(banum)
{
	//alert ("Please Wait Few Seconds. The PDF File is being created. Do Not Close Popup Window.");
	var varbanum = banum;
	//alert (varqanum);
	window.open("mailbill1.php?banum="+varbanum+"","Window1","menubar=no,width=450,height=450,toolbar=no,scrollbars=yes,status=yes,left=100,top=100");
	//window.open("print_bill1.php?banum="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}
*/
function funcRedirectWindow1()
{
	window.location = "invoicereport1dischargesummary.php.php";
}


function funcDeleteRecord1(varsummarynumberNumber)
{
	var varsummarynumberNumber = varsummarynumberNumber;
	var fRet;
	fRet = confirm('Are You Sure Want To Delete This Sales Bill Number '+varsummarynumberNumber+'?');
	//alert(fRet);
	if (fRet == true)
	{
		var fRet2;
		fRet2 = confirm('All Payment Details Saved Will Also Be Deleted. Are Sure Your Want To Delete This Sales Bill Number '+varsummarynumberNumber+'?');
		//alert(fRet);
		if (fRet2 == true)
		{
			alert ("Success. Sales Entry Delete Completed.");
			//return false;
		}
		if (fRet2 == false)
		{
			alert ("Failed. Sales Entry Delete Not Completed.");
			return false;
		}
	}
	if (fRet == false)
	{
		alert ("Failed. Sales Entry Delete Not Completed.");
		return false;
	}
	//return false;
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1535" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10"></td>
  </tr>
  <tr>
    <td width="0%">&nbsp;</td>
    <td width="1%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="99%" valign="top"><table width="1498" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1424">
		
              <form name="cbform1" method="get" action="invoicereport1dischargesummary.php.php">
		<table width="916" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Report - Discharge Summary </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td width="10%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Patient  * </td>
                <td width="19%" align="left" valign="top" >
				<input value="<?php echo $cbpatientname; ?>" name="cbpatientname" type="text" id="cbpatientname" size="20" style="border: 1px solid #001E6A"></td>
                <td width="9%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Bill Number</td>
                <td width="18%" align="left" valign="top" ><input value="<?php echo $cbsummarynumber; ?>" name="cbsummarynumber" type="text" id="cbsummarynumber" size="10" style="border: 1px solid #001E6A"></td>
                <td width="8%" align="left" valign="center" bgcolor="#FFFFFF"  class="bodytext31"> Date From </td>
                <td width="15%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>
				</span></td>
                <td width="7%" align="left" valign="center"  class="bodytext31"> Date To </td>
                <td width="14%" align="left" valign="center"  bgcolor="#ffffff"><span class="bodytext31">
                  <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
				</span></td>
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><!--Payment Type --></td>
              <td align="left" valign="top" >
			  <input type="hidden" name="paymenttype" id="paymenttype" value="">
<!--			  
			  <select name="paymenttype" id="paymenttype">
				<?php
				if ($paymenttype != '')
				{
				?>
				<option value="<?php echo $paymenttype; ?>" selected="selected"><?php echo $paymenttype; ?></option>
				<?php
				}
				else
				{
				?>
                <option value="">ALL</option>
				<?php
				}
				?>
                <option value="CASH">CASH</option>
                <option value="CHEQUE">CHEQUE</option>
                <option value="CREDIT">CREDIT</option>
                <option value="CARD">CREDIT CARD</option>
                <option value="ONLINE">ONLINE</option>
                <option value="SPLIT">SPLIT</option>
              </select>			  
-->			  
			  </td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><!--Financial Year --></td>
              <td align="left" valign="top" >
<!--			  
			  <select name="approvalstatus" id="approvalstatus">
                  <option value="ALL">ALL</option>
                  <option value="APPROVED" selected="selected">APPROVED</option>
                  <option value="PENDING">PENDING</option>
                  <option value="DENIED">DENIED</option>
              </select>
-->			  
			  <input value="APPROVED" type="hidden" name="approvalstatus" id="approvalstatus">
			  <input value="" type="hidden" name="financialyear" id="financialyear">
			  
<!--			  
				<select name="financialyear" id="financialyear">
				<?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'CURRENT_FINANCIAL_YEAR' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
				<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
				<?php
				}
				?>
				<option value="Show All">Show All</option>
				<option value="2012">2012</option>
				<option value="2013">2013</option>
				<option value="2014">2014</option>
				<option value="2015">2015</option>
				<option value="2016">2016</option>
				<option value="2017">2017</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				</select>			  
-->				
				</td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF"><span class="bodytext3">Bill Status </span></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">
				<select name="billstatus" id="billstatus">
				<?php
				if ($billstatus == 'CONFIRMED')
				{
				?>
				<option value="CONFIRMED" selected="selected">SHOW CONFIRMED</option>
				<?php
				}
				else if ($billstatus == 'DELETED')
				{
				?>
				<option value="DELETED" selected="selected">SHOW DELETED</option>
				<?php
				}
				?>
				<option value="CONFIRMED">SHOW CONFIRMED</option>
				<option value="DELETED">SHOW DELETED</option>
				</select>
              </td>
              <td colspan="2" align="left" valign="top" ><div align="right">
                  <input type="hidden" name="cbfrmflag12" value="cbfrmflag1">
                  <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                  <input onClick="return funcRedirectWindow1()" name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" />
              </div></td>
              </tr>
          </tbody>
        </table>
          </form>		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1485" 
            align="left" border="0">
          <tbody>
		  <?php
		  	$errmsg1 = '';
		  	if (isset($_REQUEST["task"])) { $task = $_REQUEST["task"]; } else { $task = ""; }
			if ($task == 'deleted')
			{
			$errmsg1 =  'Success. Selected Bill Number Delete Completed.';
		  ?>
            <tr>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;<?php echo $errmsg1; ?></td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFFF00" class="bodytext31">&nbsp;</td>
            </tr>
			<?php
			}
			?>	
            <tr>
              <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="15%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="9%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="19%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
			  <?php
				if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
				//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					$cbpatientname = $_REQUEST['cbpatientname'];
					$patientname = $_REQUEST['cbpatientname'];
					
					if (isset($_REQUEST["cbsummarynumber"])) { $cbsummarynumber = $_REQUEST["cbsummarynumber"]; } else { $cbsummarynumber = ""; }
					//$cbsummarynumber = $_REQUEST['cbsummarynumber'];
					if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
					//$cbbillstatus = $_REQUEST['cbbillstatus'];

					$approvalstatus = $_REQUEST['approvalstatus'];
					
					$transactiondatefrom = $_REQUEST['ADate1'];
					$transactiondateto = $_REQUEST['ADate2'];
					
					$paymenttype = $_REQUEST['paymenttype'];
					
					$urlpath = "cbpatientname=$cbpatientname&&cbsummarynumber=$cbsummarynumber&&approvalstatus=$approvalstatus&&paymenttype=$paymenttype&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				else
				{
					$urlpath = "cbpatientname=$cbpatientname&&cbsummarynumber=$cbsummarynumber&&approvalstatus=APPROVED&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				?>
 				<?php
				//For excel file creation.
				
				$applocation1 = $applocation1; //Value from db_connect.php file giving application path.
				$filename1 = "print_salesreport1lab.php?$urlpath";
				$fileurl = $applocation1."/".$filename1;
				$filecontent1 = @file_get_contents($fileurl);
				
				$indiatimecheck = date('d-M-Y-H-i-s');
				$foldername = "dbexcelfiles";
				$fp = fopen($foldername.'/SalesReportLab.xls', 'w+');
				fwrite($fp, $filecontent1);
				fclose($fp);

				?>
                <script language="javascript">
				function printinvoicereport1dischargesummary.php()
				{
					window.open("print_salesreport1lab.php?<?php echo $urlpath; ?>","Window1",'width=900,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				function printbillreport2()
				{
					window.location = "dbexcelfiles/SalesReportLab.xls"
				}
				</script>
				<?php
				if ($billstatus != 'DELETED')
				{
				?>
<!--				
<input value="Print Report" onClick="javascript:printinvoicereport1dischargesummary.php()" name="resetbutton2" type="submit" id="resetbutton2"  style="border: 1px solid #001E6A" />
&nbsp;				
<input value="Export Excel" onClick="javascript:printbillreport2()" name="resetbutton22" type="button" id="resetbutton22"  style="border: 1px solid #001E6A" />
--></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <?php
			  }
			  ?>
			  <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Print</strong></td>
              <!--<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>PDF</strong></td>-->
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bill</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Date </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong> Patient </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Admission</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Discharge</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>SummaryDate</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Doctor</strong></div></td>
              <!--<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Delivery</strong></td>-->
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="center"><strong>Edit </strong></div></td>
              <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong><!--Delete--></strong></div></td>
              <td width="19%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Remarks</strong></div></td>
              </tr>
            <?php
			
			if (isset($_REQUEST["approvalstatus"])) { $approvalstatus = $_REQUEST["approvalstatus"]; } else { $approvalstatus = ""; }
			//$approvalstatus = $_REQUEST['approvalstatus'];
			if (isset($_REQUEST["financialyear"])) { $financialyear = $_REQUEST["financialyear"]; } else { $financialyear = ""; }
			//$financialyear = $_REQUEST['financialyear'];
			
			if ($financialyear == '') $financialyear = $_SESSION['financialyear'];
			if ($financialyear == 'Show All') $financialyear = '';
			
			if ($billstatus == 'CONFIRMED')
			{
				$billstatusquery1 = " status <> 'deleted' ";
			}
			else if ($billstatus == '')
			{
				$billstatusquery1 = " status <> 'deleted' ";
			}
			else
			{
				$billstatusquery1 = " status = 'deleted' ";
			}

			/*
			if ($approvalstatus == '')
			{
				$approvalstatusquery1 = "and approvalstatus =  'APPROVED'";
			}
			if ($approvalstatus == 'ALL')
			{
				$approvalstatusquery1 = "";
			}
			else if ($approvalstatus == 'APPROVED')
			{
				$approvalstatusquery1 = "and approvalstatus =  'APPROVED'";
			}
			else if ($approvalstatus == 'PENDING')
			{
				$approvalstatusquery1 = "and approvalstatus =  'PENDING'";
			}
			else if ($approvalstatus == 'DENIED')
			{
				$approvalstatusquery1 = "and approvalstatus =  'DENIED'";
			}
			*/

			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));

			$billnumarray = explode('-', $cbsummarynumber);
			//print_r($billnumarray);
			if (count($billnumarray) == 0)
			{
				$summarynumberprefix = $billnumarray[0];
				$cbsummarynumber = $billnumarray[1];
			}
			else
			{
				$summarynumberprefix = '';
				$cbsummarynumber = '';
			}
			if ($cbsummarynumber == '') $cbsummarynumber = $summarynumberprefix;
			//echo $summarynumber;
			//$cbsummarynumber = $cbsummarynumber;


			//$query2 = "select * from master_sales where patientname like '%$patientname%' and summarynumber like '%$cbsummarynumber%' and status = '$billstatus' and billtype like '%$paymenttype%' and companyanum = '$companyanum' and lastupdate between '$transactiondatefrom' and '$transactiondateto' order by lastupdate desc";
			$query2 = "select * from master_dischargesummary where patientname like '%$patientname%' and summarynumber like '%$cbsummarynumber%' and 
			$billstatusquery1 and  summarydate between '$transactiondatefrom' and '$transactiondateto' and status <> 'deleted' order by summarynumber desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['auto_number'];
			$billautonumber = $res2['auto_number'];
			$patientname = $res2['patientname'];
			$summarynumber = $res2['summarynumber'];
			$summarydate = $res2['summarydate'];
			$admissiondate = $res2['admissiondate'];
			$dischargedate = $res2['dischargedate'];
			$doctorname = $res2['doctorname'];
			$res2anum = $res2['auto_number'];
			$res2loopcount = $res2loopcount + 1;
			
	
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
			if ($showcolor == 0)
			{
				$colorcode = 'bgcolor="#CBDBFA"';
			}
			else
			{
				$colorcode = 'bgcolor="#D3EEB7"';
			}
		  
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left">
			  <?php echo $res2loopcount; ?></td>
              <td class="bodytext31" valign="center"  align="left">
			  <a href="javascript:loadprintpage1(<?php echo $summarynumber; ?>)" class="bodytext3"><span class="bodytext3">Print</span></a></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php echo $summarynumber; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left">
                  <?php 
				//echo $summarydate; 
				/*
				$dotarray = explode("-", $summarydate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$summarydate2 = $dbdateday;
				echo $summarydate2;
				*/
				$billtime = substr($summarydate, 11, 8);
				$summarydateonly = substr($summarydate, 0, 10);
				$dotarray = explode("-", $summarydateonly);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$summarydate2 = $dbdateday;
				echo $summarydate2;

				
			?>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
			  <?php echo $patientname; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			    <div align="left"><?php echo $admissiondate; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"> 
			    <div align="left"><?php echo $dischargedate; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"> 
			    <div align="left"><?php echo $summarydate; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"> 
			    <div align="left"><?php echo $doctorname; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
              <?php
			  //if ($billstatus == 'OPEN' || $billstatus == 'CLOSED')
			  /*
			  if ($billstatus != 'DELETED')
			  {
			  if ($res2financialyear == $_SESSION['financialyear'])
			  {
				$query1editdelete = "select * from master_employee where username = '$username'";
				$exec1editdelete = mysql_query($query1editdelete) or die ("Error in Query1editdelete".mysql_error());
				$res1editdelete = mysql_fetch_array($exec1editdelete);
				$option_edit_delete = $res1editdelete["option_edit_delete"];
				if ($option_edit_delete == 'Edit Delete Option Available' || $option_edit_delete == '')
				{
				*/
			  ?>
                  <a href="sales1dischargesummary.php?delbillst=billedit&&delbillsummarynumber=<?php echo $summarynumber; ?>&&delsummarynumber=<?php echo $summarynumber; ?>" class="bodytext3"><span class="bodytext3">Edit</span></a>
              <?php
			  /*
			  	}
			  }
			  }
			  */
			  ?>
              </div></td>
              <td  align="left" valign="center" class="bodytext31">
             <?php
			 /*
				$query1editdelete = "select * from master_employee where username = '$username'";
				$exec1editdelete = mysql_query($query1editdelete) or die ("Error in Query1editdelete".mysql_error());
				$res1editdelete = mysql_fetch_array($exec1editdelete);
				$option_edit_delete = $res1editdelete["option_edit_delete"];
				if ($option_edit_delete == 'Edit Delete Option Available' || $option_edit_delete == '')
				{
			  if ($billstatus != 'DELETED')
			  {
			  */
			  ?>
			  <div align="center"> 
			  <a href="sales1dischargesummary.php?task=delete&&anum=<?php echo $billautonumber; ?>" 
			  class="bodytext3" onClick="return funcDeleteRecord1(<?php echo $summarynumber;?>)"> 
			  <!--<img src="images/b_drop.png" width="16" height="16" border="0">-->			  </a>			  </div>			  
				<?php
				/*
					}
				}
				*/
				?>			  </td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php //echo $remarks; ?></div></td>
              </tr>
				<?php
				}
				?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

