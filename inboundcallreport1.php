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

$itemcode = '';
$itemname = '';
$destroy_quantity = '';
$batch_number = '';
$date_of_destroy = '';
$destroyed_by_username = '';
$date_of_update = '';

$searchsuppliername = '';

$cbsuppliername = '';
$cbbillnumber = '';
$cbbillstatus = '';
$suppliername = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';
$sno = '';

/*$totalsalesamount = '0.00';
$totalsalesreturnamount = '0.00';
$totalpurchaseamount = '0.00';
$totalpurchasereturnamount = '0.00';
$netcollectionamount = '0.00';
$netpaymentamount = '0.00';*/

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
$transactiondateto = date('Y-m-d');

/*if (isset($_REQUEST["canum"])) { $getcanum = $_REQUEST["canum"]; } else { $getcanum = ""; }
//$getcanum = $_GET['canum'];
if ($getcanum != '')
{
	$query4 = "select * from master_supplier where auto_number = '$getcanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$cbsuppliername = $res4['suppliername'];
	$suppliername = $res4['suppliername'];
}*/

/*if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$searchsuppliername = $_POST['searchsuppliername'];
	if ($searchsuppliername != '')
	{
		$arraysupplier = explode("#", $searchsuppliername);
		$arraysuppliername = $arraysupplier[0];
		$arraysuppliername = trim($arraysuppliername);
		$arraysuppliercode = $arraysupplier[1];

		$cbsuppliername = $arraysuppliername;
		$suppliername = $arraysuppliername;
	}
	else
	{
		$cbsuppliername = $_REQUEST['cbsuppliername'];
		$suppliername = $_REQUEST['cbsuppliername'];
	}*/
	
	if (isset($_REQUEST["ADate1"])) { $ADate1 = $_REQUEST["ADate1"]; } else { $ADate1 = ""; }
	if (isset($_REQUEST["ADate2"])) { $ADate2 = $_REQUEST["ADate2"]; } else { $ADate2 = ""; }

	if ($ADate1 != '' && $ADate2 != '')
	{
		$transactiondatefrom = $ADate1;
		$transactiondateto = $ADate2;
	}
	else
	{
		$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
		$transactiondateto = date('Y-m-d');
	}
	if (isset($_REQUEST["entryperson"])) { $entryperson = $_REQUEST["entryperson"]; } else { $entryperson = ""; }
	
//}


?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
-->
</style>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<?php
/*session_start();
$auto_number=$_SESSION['session_auto_number_post_job'];//post job auto number
*/
?>
<script language="javascript">

function cbsuppliername1()
{
	document.cbform1.submit();
}

</script>
<script type="text/javascript" src="js/autocomplete_supplier1.js"></script>
<script type="text/javascript" src="js/autosuggest2supplier1.js"></script>
<script type="text/javascript">
window.onload = function () 
{
	var oTextbox = new AutoSuggestControl(document.getElementById("searchsuppliername"), new StateSuggestions());        
}


function disableEnterKey(varPassed)
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
	
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}

	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		return false;
	}
	else
	{
		return true;
	}
}




</script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
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
<table width="1150" border="0" cellspacing="0" cellpadding="2">
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
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="116%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
		
              <form name="cbform1" method="post" action="inboundcallreport1.php">
		
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
                <table width="791" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="4" bgcolor="#CCCCCC" class="bodytext3"><strong> Call  Report -By Date</strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <!--<td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Supplier </td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="searchsuppliername" type="text" id="searchsuppliername" style="border: 1px solid #001E6A;" value="<?php //echo $searchsuppliername; ?>" size="50" autocomplete="off">
              </span><span class="bodytext3">
                <input type="hidden" name="searchsuppliercode" onBlur="return suppliercodesearch1()" onKeyDown="return suppliercodesearch2()" id="searchsuppliercode" style="border: 1px solid #001E6A; text-transform:uppercase" value="<?php echo $searchsuppliercode; ?>" size="20" />
              </span></td>
              </tr>
            <tr>
              <td width="17%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Select Supplier </td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF">
			  <input value="<?php //echo $cbsuppliername; ?>" name="cbsuppliername" type="text" id="cbsuppliername" readonly="readonly" onKeyDown="return disableEnterKey()" size="50" style="border: 1px solid #001E6A"></td>
              </tr>-->
            <tr>
              <td width="11%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31">Entry Person </td>
              <td width="14%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><label>
                <input name="entryperson" style="border: 1px solid #001E6A" type="text" id="entryperson">
              </label></td>
              <td width="9%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"> Date From </td>
              <td width="18%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>				</td>
              <td width="11%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
              <td width="37%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
			  </span></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
            </tr>
          </tbody>
        </table>
		</form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1028" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td colspan="6" bgcolor="#cccccc" class="bodytext31">
                <?php
				/*if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
				//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					$cbsuppliername = $_REQUEST['cbsuppliername'];
					$suppliername = $_REQUEST['cbsuppliername'];
					
					if (isset($_REQUEST["cbbillnumber"])) { $cbbillnumber = $_REQUEST["cbbillnumber"]; } else { $cbbillnumber = ""; }
					//$cbbillnumber = $_REQUEST['cbbillnumber'];
					if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
					//$cbbillstatus = $_REQUEST['cbbillstatus'];
					
					$transactiondatefrom = $_REQUEST['ADate1'];
					$transactiondateto = $_REQUEST['ADate2'];
					
					$urlpath = "cbsuppliername=$cbsuppliername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				else
				{
					$urlpath = "cbsuppliername=$cbsuppliername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$transactiondatefrom&&ADate2=$transactiondateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}*/
				?>
 				<?php
				//For excel file creation.
				
				//$applocation1 = $applocation1; //Value from db_connect.php file giving application path.
				//$filename1 = "print_test.php?$urlpath";
				//$fileurl = $applocation1."/".$filename1;
				//$filecontent1 = @file_get_contents($fileurl);
				
				/*$indiatimecheck = date('d-M-Y-H-i-s');
				$foldername = "dbexcelfiles";
				$fp = fopen($foldername.'/StatementBySupplier.xls', 'w+');
				fwrite($fp, $filecontent1);
				fclose($fp);*/

				?>
                <script language="javascript">
				function printbillreport1()
				{
					window.open("print_test.php?<?php echo $urlpath; ?>","Window1",'width=1000,height=600,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				function printbillreport2()
				{
					window.location = "dbexcelfiles/StatementBySupplier.xls"
				}
				</script>
                <!--<input onClick="javascript:printbillreport1()" name="resetbutton2" type="submit" id="resetbutton2"  style="border: 1px solid #001E6A" value="Print Report" />
&nbsp;				<input value="Export Excel" onClick="javascript:printbillreport2()" name="resetbutton22" type="button" id="resetbutton22"  style="border: 1px solid #001E6A" />--></td>
              <td width="18%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#ffffff" class="style1">Call Date </td>
              <td width="8%" align="left" valign="center"  
                bgcolor="#ffffff" class="style1">Call Time </td>
              <td width="15%"  align="left" valign="center" 
                bgcolor="#ffffff" class="style1">Calling Person Name </td>
              <td width="23%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Call Description </strong></div></td>
              <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Mobile Number </strong></div></td>
              <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Entry Person </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Remarks</strong></div></td>
            </tr>
			<?php
			
			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));

			$query2 = "select * from inboundcall where entryperson like '%$entryperson%' and  calldate between '$transactiondatefrom' and '$transactiondateto'  order by calldate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$calldate = $res2['calldate'];
			$calltime = $res2['calltime'];
			$timefield = $res2['timefield'];
			$callperson = $res2['callperson'];
			$calldescription = $res2['calldescription'];
			$mobilenumber  = $res2['mobilenumber'];
			$entryperson = $res2['entryperson'];
			$remarks = $res2["remarks"];
			
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
			if ($showcolor == 0)
			{
				//echo "if";
				$colorcode = 'bgcolor="#CBDBFA"';
			}
			else
			{
				//echo "else";
				$colorcode = 'bgcolor="#D3EEB7"';
			}

			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $calldate; ?></div> </td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $calltime; ?><?php echo $timefield;?></div></td>
              <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $callperson; ?></div> </td>
             <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $calldescription; ?></div> </td>
             <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $mobilenumber; ?></div> </td>
             <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $entryperson ; ?></div> </td>
             <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31"><?php echo $remarks ; ?></div> </td>
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
            </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

