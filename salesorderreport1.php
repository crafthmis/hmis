<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

$cbcustomername = '';
$cbbillnumber = '';
$cbbillstatus = '';
$customername = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';

$totalsumtotalamount1  = '0.00';
$totalsumcashamount1  = '0.00';
$totalsumchequeamount1  = '0.00';
$totalsumonlineamount1  = '0.00';
$totalsumcardamount1 = '0.00';
$totalsumcreditamount1 = '0.00';
$totalsumbalancebillamount1 = '0.00';
$totalsumsubtotal1 = '0.00';
$totalsumtotaltax1 = '0.00';
$totalpackaging1 = '0.00';
$totaldelivery1 = '0.00';

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
//$transactiondatefrom = date('Y-m-d');//, strtotime('-1 day'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$cbcustomername = $_REQUEST['cbcustomername'];
	$customername = $_REQUEST['cbcustomername'];
	
	if (isset($_REQUEST["cbbillnumber"])) { $cbbillnumber = $_REQUEST["cbbillnumber"]; } else { $cbbillnumber = ""; }
	//$cbbillnumber = $_REQUEST['cbbillnumber'];
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

					
if (isset($_REQUEST["paymenttype"])) { $paymenttype = $_REQUEST["paymenttype"]; } else { $paymenttype = ""; }
//$billstatus = $_REQUEST['billstatus'];
					
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

function loadprintpage1(banum)
{
	var varbanum = banum;
	//alert (varqanum);
	window.open("print_salesorder1.php?billautonumber="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
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
	window.location = "billreport1.php";
}

function funcDeleteRecord1(varBillNumberNumber)
{
	var varBillNumberNumber = varBillNumberNumber;
	var fRet;
	fRet = confirm('Are You Sure Want To Delete This Sales Order Bill Number '+varBillNumberNumber+'?');
	//alert(fRet);
	if (fRet == true)
	{
		var fRet2;
		fRet2 = confirm('All Payment Details Saved Will Also Be Deleted. Are Sure Your Want To Delete This Sales Order Bill Number '+varBillNumberNumber+'?');
		//alert(fRet);
		if (fRet2 == true)
		{
			alert ("Success. Sales Order Entry Delete Completed.");
			//return false;
		}
		if (fRet2 == false)
		{
			alert ("Failed. Sales Order Entry Delete Not Completed.");
			return false;
		}
	}
	if (fRet == false)
	{
		alert ("Failed. Sales Order Entry Delete Not Completed.");
		return false;
	}
	//return false;
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1501" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="99%" valign="top"><table width="1450" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
              <form name="cbform1" method="get" action="salesorderreport1.php">
		<table width="953" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Order Report</strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td width="10%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Customer  * </td>
                <td width="19%" align="left" valign="top"  bgcolor="#FFFFFF">
				<input value="<?php echo $cbcustomername; ?>" name="cbcustomername" type="text" id="cbcustomername" size="20" style="border: 1px solid #001E6A"></td>
                <td width="9%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Bill Number</td>
                <td width="18%" align="left" valign="top"  bgcolor="#FFFFFF"><input value="<?php echo $cbbillnumber; ?>" name="cbbillnumber" type="text" id="cbbillnumber" size="10" style="border: 1px solid #001E6A"></td>
                <td width="8%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date From </td>
                <td width="15%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>
				</span></td>
                <td width="7%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
                <td width="14%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                  <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
				</span></td>
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF"><span class="bodytext3">Bill Status </span></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="billstatus" id="billstatus">
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
              </select></td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
              <td colspan="4" align="left" valign="top"  bgcolor="#FFFFFF"><div align="right">
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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1400" 
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
              <td colspan="24" bgcolor="#FFFF00" class="bodytext31">&nbsp;<?php echo $errmsg1; ?></td>
              </tr>
			<?php
			}
			?>	
            <tr>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="10%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="19%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="19%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td colspan="3" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
			  <?php
				if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
				//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					$cbcustomername = $_REQUEST['cbcustomername'];
					$customername = $_REQUEST['cbcustomername'];
					
					if (isset($_REQUEST["cbbillnumber"])) { $cbbillnumber = $_REQUEST["cbbillnumber"]; } else { $cbbillnumber = ""; }
					//$cbbillnumber = $_REQUEST['cbbillnumber'];
					if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
					//$cbbillstatus = $_REQUEST['cbbillstatus'];
					
					$transactiondatefrom = $_REQUEST['ADate1'];
					$transactiondateto = $_REQUEST['ADate2'];
					
					if (isset($_REQUEST["paymenttype"])) { $paymenttype = $_REQUEST["paymenttype"]; } else { $paymenttype = ""; }
					//$billstatus = $_REQUEST['billstatus'];
					
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				else
				{
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				?>
 				<?php
				//For excel file creation.
				
				$applocation1 = $applocation1; //Value from db_connect.php file giving application path.
				$filename1 = "print_salesorderreport1.php?$urlpath";
				$fileurl = $applocation1."/".$filename1;
				$filecontent1 = @file_get_contents($fileurl);
				
				$indiatimecheck = date('d-M-Y-H-i-s');
				$foldername = "dbexcelfiles";
				$fp = fopen($foldername.'/SalesOrderReport.xls', 'w+');
				fwrite($fp, $filecontent1);
				fclose($fp);

				?>
                <script language="javascript">
				function printbillreport1()
				{
					window.open("print_salesorderreport1.php?<?php echo $urlpath; ?>","Window1",'width=900,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				function printbillreport2()
				{
					window.location = "dbexcelfiles/SalesOrderReport.xls"
				}
				</script>
                <input value="Print Report" onClick="javascript:printbillreport1()" name="resetbutton2" type="submit" id="resetbutton2"  style="border: 1px solid #001E6A" />
&nbsp;				<input value="Export Excel" onClick="javascript:printbillreport2()" name="resetbutton22" type="button" id="resetbutton22"  style="border: 1px solid #001E6A" />
				
				</td>
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
                bgcolor="#ffffff"><div align="left"><strong>Bill Date </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Nett</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Cash</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Cheque</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Online</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Card</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Credit</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Pending</strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>SubTotal</strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Tax</strong></span></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Packing</strong></span></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Delivery</strong></span></td>
              <!--<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Delivery</strong></td>-->
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Nett</strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="center"><strong>Edit </strong></div></td>
              <td width="4%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Import </strong></div></td>
              <td width="4%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Import</strong></div></td>
              <td width="4%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Import</strong></div></td>
              <td width="4%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Import</strong></div></td>
              <td width="19%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Remarks</strong></div></td>
              <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Delete</strong></div></td>
            </tr>
            <?php
			
			if ($billstatus == 'CONFIRMED')
			{
				$billstatusquery1 = " recordstatus <> 'deleted' ";
			}
			else if ($billstatus == '')
			{
				$billstatusquery1 = " recordstatus <> 'deleted' ";
			}
			else
			{
				$billstatusquery1 = " recordstatus = 'deleted' ";
			}
			
			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));

			$billnumarray = explode('-', $cbbillnumber);
			//print_r($billnumarray);
			if (count($billnumarray) == 0)
			{
				$billnumberprefix = $billnumarray[0];
				$cbbillnumber = $billnumarray[1];
			}
			else
			{
				$billnumberprefix = '';
				$cbbillnumber = '';
			}
			if ($cbbillnumber == '') $cbbillnumber = $billnumberprefix;
			//echo $billnumber;
			//$cbbillnumber = $cbbillnumber;

			//$query2 = "select * from master_salesorder where customername like '%$customername%' and billnumber like '%$cbbillnumber%' and recordstatus = '$billstatus' and billtype like '%$paymenttype%' and companyanum = '$companyanum' and lastupdate between '$transactiondatefrom' and '$transactiondateto' order by lastupdate desc";
			$query2 = "select * from master_salesorder where customername like '%$customername%' and billnumber like '%$cbbillnumber%' 
			and $billstatusquery1 and billtype like '%$paymenttype%' and companyanum = '$companyanum' and 
			billdate between '$transactiondatefrom' and '$transactiondateto' order by billnumber desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['auto_number'];
			$billautonumber = $res2['auto_number'];
			$customername = $res2['customername'];
			$city = $res2['city'];
			//$contact = $res2['contactperson'];
			$totalamount = $res2['totalamount'];
			$billnumberprefix = $res2['billnumberprefix'];
			$billnumber = $res2['billnumber'];
			$billnumberpostfix = $res2['billnumberpostfix'];
			//if ($billnumber1 != '') $billnumber2 = $billnumber1.'-'.$billnumber2;
			//$billdate = $res2['lastupdate'];
			$billdate = $res2['billdate'];
			//$billdate = substr($billdate, 0, 11);
			$res2anum = $res2['auto_number'];
			//$paymentdate = $res2['paymententrydate'];
			//$paymentdate = substr($paymentdate, 0, 11);
			//$paymentmode = $res2['paymentmode'];
			//$chequenumber = $res2['chequenumber'];
			$remarks = $res2['remarks'];
			$packaging = $res2['packaging'];
			$delivery = $res2['delivery'];
			
			//$billstatus = $res2['status'];
			//$billstatus = strtoupper($billstatus);
			//if ($billstatus == '') $billstatus = 'pending';
			//if ($billstatus == 'CLOSED') $changestatus = 'Open This Bill';
			if ($billstatus == 'CLOSED') $closebill = '';
			if ($billstatus == 'OPEN') $closebill = 'Close Bill';
			
			$res2loopcount = $res2loopcount + 1;
			
			$subtotal = $res2['subtotal'];
			//$totaldiscountpercent = $res2['totaldiscountpercent'];
			//$totaldiscountamount = $res2['totaldiscountamount'];
			//$totalafterdiscount = $res2['totalafterdiscount'];
			//$totaltax = $res2['totaltax'];
			//$totalaftertax = $res2['totalaftertax'];
			//$transportation = $res2['transportation'];
			//$delivery=$res2['delivery'];
			
			$query21 = "select sum(taxamount) as sumtaxamount from salesorder_tax where bill_autonumber = '$res2anum' and 
			$billstatusquery1 and companyanum = '$companyanum' and 
			updatedate between '$transactiondatefrom' and '$transactiondateto' order by updatedate desc";
			$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
			$res21 = mysql_fetch_array($exec21);
			$sumtaxamount = $res21['sumtaxamount'];
			$totaltax = $sumtaxamount;
			
			
			$res2billnumber = $res2['billnumber'];
			$query3 = "select sum(cashamount) as sumcashamount, sum(chequeamount) as sumchequeamount, 
			sum(tdsamount) as sumtdsamount, sum(writeoffamount) as sumwriteoff, sum(onlineamount) as sumonlineamount,  
			sum(creditamount) as sumcreditamount, sum(cardamount) as sumcardamount  
			from master_transaction where billnumber = '$res2billnumber' and 
			transactiontype = 'COLLECTION' and companyanum = '$companyanum' and 
			transactionmodule = 'salesorder' and $billstatusquery1 
			and supplieranum = '0' and 
			suppliername = '' and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			$res3 = mysql_fetch_array($exec3);
			
			$sumcashamount = $res3['sumcashamount'];
			$sumonlineamount = $res3['sumonlineamount'];
			$sumonlineamount = $res3['sumonlineamount'];
			$sumchequeamount = $res3['sumchequeamount'];
			$sumcreditamount = $res3['sumcreditamount'];
			$sumcardamount = $res3['sumcardamount'];
			$sumtdsamount = $res3['sumtdsamount'];
			$sumwriteoff = $res3['sumwriteoff'];

			$totalsumamount = $sumcashamount + $sumonlineamount + $sumchequeamount + $sumcardamount + $sumtdsamount + $sumwriteoff;
			
			$balancebillamount = $totalamount - $totalsumamount;
			$balancebillamount = number_format($balancebillamount, 2, '.', '');
			$totalsumamount = number_format($totalsumamount, 2, '.', '');
			
			  if ($billstatus == 'OPEN')
			  {
			  	//$colorcode = 'bgcolor="#66CC66"';
			  	$colorcode = 'bgcolor="#CBDBFA"';
			  }
			  if ($billstatus == 'CLOSED')
			  {
			  	//$colorcode = 'bgcolor="#FFCC99"';
			  	$colorcode = 'bgcolor="#D3EEB7"';
			  }
			  if ($billstatus == 'DELETED')
			  {
			  	//$colorcode = 'bgcolor="#FFCC99"';
			  }
			  
			  
	
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
			  <a href="javascript:loadprintpage1(<?php echo $res2anum; ?>)" class="bodytext3"><span class="bodytext3">Print</span></a></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php echo $billnumber; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left">
                  <?php 
				//echo $billdate; 
				/*
				$dotarray = explode("-", $billdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$billdate2 = $dbdateday;
				echo $billdate2;
				*/
				$billtime = substr($billdate, 11, 8);
				$billdateonly = substr($billdate, 0, 10);
				$dotarray = explode("-", $billdateonly);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$billdate2 = $dbdateday;
				echo $billdate2;

				if ($billstatus == 'DELETED') { $balancebillamount = ''; }
				
				$totalsumtotalamount1  = $totalsumtotalamount1 + $totalamount;
				$totalsumcashamount1  = $totalsumcashamount1 + $sumcashamount;
				$totalsumchequeamount1  = $totalsumchequeamount1 + $sumchequeamount;
				$totalsumonlineamount1  = $totalsumonlineamount1 + $sumonlineamount;
				$totalsumcardamount1  = $totalsumcardamount1 + $sumcardamount;
				$totalsumcreditamount1  = $totalsumcreditamount1 + $sumcreditamount;
				$totalsumbalancebillamount1  = $totalsumbalancebillamount1 + $balancebillamount;
				$totalsumsubtotal1  = $totalsumsubtotal1 + $subtotal;
				$totalsumtotaltax1  = $totalsumtotaltax1 + $totaltax;
				$totalpackaging1 = $totalpackaging1 + $packaging;
				$totaldelivery1 = $totaldelivery1 + $delivery;
				
			?>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
			  <?php echo $customername; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right">
			  <?php echo $totalamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $sumcashamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $sumchequeamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $sumonlineamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $sumcardamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $sumcreditamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $balancebillamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right">
			  <?php echo $subtotal; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right">
			  <?php echo $totaltax; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $packaging; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php echo $delivery; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right">
			  <?php echo $totalamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
              <?php
			  if ($billstatus != 'DELETED')
			  {
			  ?>
                  <a href="salesorder1.php?delbillst=billedit&&delbillautonumber=<?php echo $billautonumber; ?>&&delbillnumber=<?php echo $billnumber; ?>" class="bodytext3" target="_blank">
				  <span class="bodytext3">Edit</span></a>
              <?php
			  }
			  ?>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
			  <a href="quotation1.php?delbillst=importsalesorder&&delbillautonumber=<?php echo $billautonumber; ?>&&delbillnumber=<?php echo $billnumber; ?>" class="bodytext3" target="_blank"><span class="bodytext3">Quote</span></a></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
			  <a href="proformainvoice1.php?delbillst=importsalesorder&&delbillautonumber=<?php echo $billautonumber; ?>&&delbillnumber=<?php echo $billnumber; ?>" class="bodytext3" target="_blank"><span class="bodytext3">Proforma</span></a></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
			  <a href="sales1.php?delbillst=importsalesorder&&delbillautonumber=<?php echo $billautonumber; ?>&&delbillnumber=<?php echo $billnumber; ?>" class="bodytext3" target="_blank"><span class="bodytext3">Sales</span></a></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
			  <a href="deliverychallancustomer1.php?delbillst=importsalesorder&&delbillautonumber=<?php echo $billautonumber; ?>&&delbillnumber=<?php echo $billnumber; ?>" class="bodytext3" target="_blank"><span class="bodytext3">DC</span></a></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php echo $remarks; ?></div></td>
              <td  align="left" valign="center" class="bodytext31">
              <?php
			  if ($billstatus != 'DELETED')
			  {
			  ?>
			  <div align="center"> 
			  <a href="salesorderdelete1.php?task=delete&&anum=<?php echo $billautonumber; ?>" 
			  class="bodytext3" onClick="return funcDeleteRecord1(<?php echo $billnumber;?>)"> 
			  <img src="images/b_drop.png" width="16" height="16" border="0"> </a> </div>
				<?php
				}
				?>
			  </td>
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
                bgcolor="#cccccc"><div align="right"><strong>Total : </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumtotalamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumcashamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumchequeamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumonlineamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumcardamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumcreditamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumbalancebillamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumsubtotal1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumtotaltax1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalpackaging1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totaldelivery1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsumtotalamount1, 2, '.', '');; ?></strong></div></td>
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

