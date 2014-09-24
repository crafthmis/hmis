<?php

date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$username = $_SESSION["username"];
$ipaddress = $_SERVER["REMOTE_ADDR"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];
$dateonly = date("Y-m-d");
$summarydate = date("Y-m-d");
$dischargedate = date("Y-m-d");

$titlestr = 'SALES BILL';

include ("sales1include1dischargesummary.php"); //handles all the sales insert operations


//To declare variables.
	//$summarynumber = '';
	//$summarydate = '';
	$patientname = '';
	$patientcode = '';
	$patientage = '';
	$patientgender = '';
	$address1 = '';
	$address2 = '';
	$area = '';
	$city = '';
	$pincode = '';
	$dateofadmission = '';
	$dischargedate = '';
	$admissiontime = '';
	$dischargetime = '';
	$doctorcode = '';
	$doctorname = '';
	$drugallergies = '';
	$finaldiagnosis = '';
	$chiefcomplaints = '';
	$temparature = '';
	$pulse = '';
	$bloodpressure = '';
	$investigationdetails = '';
	$treatmentgiven = '';
	$diet = '';
	$physicalactivity = '';
	$status = '';
	$username = '';
	$updatetime = '';
	$ipaddress = '';
	$wardname = '';
	$bednumber = '';
	$surgerydate = '';
	$patienthistory = '';
	$consultationreferral = '';
	$conditionatdischarge = '';
	$medication = '';
	$followup = '';
	$clinicalexamination = '';
	
	$medicalofficer = '';
	$consultantofficer = '';


if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST["st"];
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
/*
if ($st == '1' && $banum != '')
{
	$loadprintpage = 'onLoad="javascript:loadprintpage1()"';
}
*/
if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
//$st = $_REQUEST["st"];

$query1 = "select * from master_patientadmission where patientcode = '$customercode'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$patientname = $res1["patientname"];
$patientcode = $res1["patientcode"];
$patientage = $res1["age"];
$patientgender = $res1["gender"];
$dateofadmission = $res1["admissiondate"];
$admissiontime = $res1["admissiontime"];
$dischargedate = $res1['dischargedate'];
$dischargetime = $res1['dischargetime'];
$ipnumber = $res1['ipnumber'];

$query2 = "select * from master_customer where customercode = '$customercode'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$address1 = $res2['address1'];
$address2 = $res2['address2'];
$area = $res2['area'];
$city = $res2['city'];
$state = $res2['state'];
$pincode = $res2['pincode'];

if (isset($_REQUEST["summarynumber"])) { $previoussummarynumber = $_REQUEST["summarynumber"]; } else { $previoussummarynumber = ""; }


if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
if (isset($_REQUEST["delbillsummarynumber"])) { $delbillsummarynumber = $_REQUEST["delbillsummarynumber"]; } else { $delbillsummarynumber = ""; }
if ($delbillst == 'billedit')
{

	$query3 = "select * from master_dischargesummary where summarynumber = '$delbillsummarynumber' and status <> 'deleted'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);

	$summarynumber = $res3["summarynumber"];
	$summarydate = $res3["summarydate"];
	$dateonly = substr($summarydate, 0, 10);
	$patientname = $res3["patientname"];
	$patientcode = $res3["patientcode"];
	$patientage = $res3["patientage"];
	$patientgender = $res3["patientgender"];
	$address1 = $res3["address1"];
	$address2 = $res3["address2"];
	$area = $res3["area"];
	$city = $res3["city"];
	$pincode = $res3["pincode"];
	$dateofadmission = $res3["admissiondate"];
	$dischargedate = $res3["dischargedate"];
	$admissiontime = $res3["admissiontime"];
	$dischargetime = $res3["dischargetime"];
	
	$doctorcode = $res3["doctorcode"];
	$query4 = "select * from master_doctor where doctorcode = '$doctorcode'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$doctorname = $res4["doctorname"];
	
	$drugallergies = $res3["drugallergies"];
	$finaldiagnosis = $res3["finaldiagnosis"];
	$chiefcomplaints = $res3["chiefcomplaints"];
	$temparature = $res3["temparature"];
	$pulse = $res3["pulse"];
	$bloodpressure = $res3["bloodpressure"];
	$investigationdetails = $res3["investigationdetails"];
	$treatmentgiven = $res3["treatmentgiven"];
	$diet = $res3["diet"];
	$physicalactivity = $res3["physicalactivity"];
	$status = $res3["status"];
	$username = $res3["username"];
	$updatetime = $res3["updatetime"];
	$ipaddress = $res3["ipaddress"];
	$wardname = $res3["wardname"];
	$bednumber = $res3["bednumber"];
	$surgerydate = $res3["surgerydate"];
	$patienthistory =$res3["patienthistory"];
	$consultationreferral = $res3["consultationreferral"];
	$conditionatdischarge = $res3["conditionatdischarge"];
	$medication = $res3["medication"];
	$followup = $res3["followup"];
	$clinicalexamination = $res3["clinicalexamination"];
	
	$medicalofficer = $res3['medicalofficer'];
	$consultantofficer = $res3['consultantofficer'];
	
	$query1 = "select * from master_patientadmission where patientcode = '$patientcode'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$ipnumber = $res1['ipnumber'];

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

<?php include ("js/sales1scripting1dischargesummary.php"); ?>
<?php include ("js/dropdownlist1scripting1dischargesummary.php"); ?>

<!--<script type="text/javascript" src="js/salesinsertitem1dischargesummary.js"></script>-->
<!--<script type="text/javascript" src="js/autoitemsearch2dischargesummary.js"></script>-->
<script type="text/javascript" src="js/autosuggest1dischargesummary.js"></script> <!-- For searching customer -->
<script type="text/javascript" src="js/autocomplete_customer1.js"></script>
<script type="text/javascript" src="js/autocustomercodesearch2dischargesummary.js"></script>
<!--<script type="text/javascript" src="js/autosuggest2dischargesummary.js"></script>-->
<!--<script type="text/javascript" src="js/autocomplete_item1dischargesummary.js"></script>--> <!-- Drop Down List Holding File -->
<!--<script type="text/javascript" src="js/autocomplete_itemsearch3dischargesummary.js"></script>--> <!-- For mouse click event of item name drop down list. -->
<!--<script type="text/javascript" src="js/autoitemsearch3dischargesummary.js"></script>--> <!-- For enter key selection and mouse click event of item name drop down list. -->
<!--<script type="text/javascript" src="js/billnovalidation1.js"></script>-->
<script language="javascript">



function funcOnLoadBodyFunctionCall()
{
	funcBodyOnLoad(); //To reset any previous values in text boxes. source .js - sales1scripting1.php
	
	funcCustomerDropDownSearch1(); //To handle ajax dropdown list.
	
}


//Print() is at bottom of this page.

function funcPrintDischargeSummary()
{
	var varsummarynumber = "<?php echo $previoussummarynumber; ?>";
	var varBillAutoNumber = "";
	var varBillCompanyAnum = "";
	var varTitleHeader = "";
	window.open("print_bill1dischargesummary.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&summarynumber="+varsummarynumber+"","OriginalWindowA4<?php //echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
}

</script>
<script type="text/javascript">


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
.style4 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; }
.style7 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>

<script src="js/datetimepicker_css.js"></script>

</head>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<body>
<form name="frmsales" id="frmsales" method="post" action="sales1dischargesummary.php" onKeyDown="return disableEnterKey(event)">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?></td>
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
                <td bgcolor="#CCCCCC" class="bodytext3"><strong>Discharge Summary  </strong></td>
                <td bgcolor="#CCCCCC" class="bodytext3"><strong>
                   
                  Bill No. 
                  <input name="summarynumber" id="summarynumber" value="<?php echo $summarynumber; ?>" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="8" /> 
                  
                </strong></td>
                <td width="7%" bgcolor="#CCCCCC" class="bodytext3"><strong> Date </strong></td>
                <td width="11%" bgcolor="#CCCCCC" class="bodytext3"><span class="bodytext312">
                  <input name="ADate" id="ADate" style="border: 1px solid #001E6A" value="<?php echo $summarydate; ?>"  size="8"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                  <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate')" style="cursor:pointer"/>
				  </span></td>
                <td width="11%" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
                <td bgcolor="#CCCCCC" class="bodytext3">			</td>
              </tr>
			  <?php
				if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
				//$src = $_REQUEST["src"];
				if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
				//$st = $_REQUEST["st"];
				
     		  if (isset($_REQUEST["summarynumber"])) { $previoussummarynumber = $_REQUEST["summarynumber"]; } else { $previoussummarynumber = ""; }
			  //$previoussummarynumber = $_REQUEST["summarynumber"];
			  //if ($src == 'frm1submit1' && $st == 'success')
			  if ($st == '1')
			  {
			  ?>
              <tr>
                <td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">
				* Success. Dischare Summary Saved. Click  Print Button To Print or View	
				<input name="billprint" type="button" onClick="return funcPrintDischargeSummary()" value="Print Discharge Summary" class="button" style="border: 1px solid #001E6A"/>
				* Please Check Your POPUP Settings & Unblock Popups.</td>
              </tr>
              <?php
			  //include ("zprintdmp1test2.php"); 
			  }
	if (isset($_REQUEST["delsummarynumber"])) { $delsummarynumber = $_REQUEST["delsummarynumber"]; } else { $delsummarynumber = ""; }
	//$delsummarynumber = $_REQUEST["delsummarynumber"];
	if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
	//$delBillSt = $_REQUEST["delbillst"];

			  //$delsummarynumber = $_REQUEST["delsummarynumber"];
			  //$delbillst = $_REQUEST["delbillst"];
			  
			  ?>
			  <tr>
                <td width="12%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><strong>Patient  * </strong></td>
                <td width="33%" align="left" valign="top" >
				<input name="patientname" id="patientname" value="<?php echo $patientname; ?>" style="border: 1px solid #001E6A;" size="40" autocomplete="off"/>				  </td>
                <td align="left" valign="middle" ><div align="left"><span class="style4">PT. ID </span></div></td>
                <td align="left" valign="top" >
				<input name="patientcode" id="patientcode" value="<?php echo $patientcode; ?>" style="border: 1px solid #001E6A" readonly="readonly" size="12" rsize="20" /></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3"><strong>Age &amp; Gender </strong></td>
                <td align="left" valign="top" ><!--<textarea name="deliveryaddress" cols="25" rows="3" id="deliveryaddress" style="border: 1px solid #001E6A"><?php //echo $res41deliveryaddress; ?></textarea>-->
                  <input name="patientage" type="text" id="patientage"  value="<?php echo $patientage; ?>"size="10">
&amp;
<input name="patientgender" type="text" value="<?php echo $patientgender; ?>" id="patientgender" size="10"></td>
			  </tr>
			  <tr>
			    <td align="left" valign="middle" ><div align="left"><span class="style4">Address 1 </span></div></td>
			    <td align="left" valign="top" ><input name="address1" type="text" id="address1" style="border: 1px solid #001E6A;" value="<?php echo $address1; ?>" size="40" autocomplete="off"></td>
			    <td align="left" valign="middle" ><div align="left"><span class="style4">IPN</span></div></td>
			    <td align="left" valign="top" ><input name="ipnumber" id="ipnumber" value="<?php echo $ipnumber; ?>" style="border: 1px solid #001E6A" readonly="readonly" size="12" rsize="20" /></td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3"><strong>Ward &amp; Bed </strong></td>
			    <td align="left" valign="middle" ><!--<textarea name="deliveryaddress" cols="25" rows="3" id="deliveryaddress" style="border: 1px solid #001E6A"><?php //echo $res41deliveryaddress; ?></textarea>-->
                    <input name="wardname" type="text" id="wardname"  value="<?php echo $wardname; ?>"size="10">
  &amp;
  <input name="bednumber" type="text" value="<?php echo $bednumber; ?>" id="bednumber" size="10"></td>
			  </tr>
			  <tr>
			    <td align="left" valign="middle" ><div align="left"><span class="style4">Address 2 </span></div></td>
			    <td align="left" valign="top" ><input name="address2" type="text" id="address2" style="border: 1px solid #001E6A;" value="<?php echo $address2; ?>" size="40" autocomplete="off"></td>
			    <td colspan="2" align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td align="left" valign="middle" >&nbsp;</td>
			    </tr>
			  <tr>
			    <td align="left" valign="middle" ><div align="left"><span class="style4">Area &amp; City </span></div></td>
			    <td align="left" valign="top" ><input name="area" type="text" id="area" style="border: 1px solid #001E6A;" value="<?php echo $area; ?>" size="15" autocomplete="off">
			    &amp;
			      <input name="city" type="text" id="city" style="border: 1px solid #001E6A;" value="<?php echo $city; ?>" size="15" autocomplete="off"></td>
			    <td colspan="2" align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td align="left" valign="middle" >&nbsp;</td>
			  </tr>
			  <tr>
			    <td align="left" valign="top" ><span class="bodytext3"><strong>Admission Date </strong></span></td>
			    <td align="left" valign="top" ><span class="bodytext3"><strong>
                  <input type="hidden" name="customertin" id="customertin" value="<?php echo $res41tinnumber; ?>" style="border: 1px solid #001E6A"  size="12" />
                  <span class="bodytext312">
                  <input name="dateofadmission" id="dateofadmission" style="border: 1px solid #001E6A" value="<?php echo $dateofadmission; ?>"  size="8"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                  <img src="images2/cal.gif" onClick="javascript:NewCssCal('dateofadmission')" style="cursor:pointer"/>				  </span></strong></span></td>
			    <td colspan="2" align="left" valign="top" ><span class="bodytext3"><strong>Admission Time </strong></span></td>
			    <td align="left" valign="top" >
				<input name="admissiontime" type="text" id="admissiontime" value="<?php echo $admissiontime; ?>" size="10"></td>
			    <td align="left" valign="top" >&nbsp;</td>
			  </tr>
			  <tr>
			    <td align="left" valign="top" ><span class="bodytext3"><strong>Discharge Date </strong></span></td>
			    <td align="left" valign="top" ><span class="bodytext3"><strong>
                  <input type="hidden" name="customercst" id="customercst" value="<?php echo $res41cstnumber; ?>" style="border: 1px solid #001E6A"  size="12" />
                  <span class="bodytext312">
                  <input name="dateofdischarge" id="dateofdischarge" style="border: 1px solid #001E6A" value="<?php echo $dischargedate; ?>"  size="8"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                 <img src="images2/cal.gif" onClick="javascript:NewCssCal('dateofdischarge')" style="cursor:pointer"/>				  </span></strong></span></td>
			    <td colspan="2" align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3"><strong>Discharge Time </strong></td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">
				<input name="dischargetime" type="text" id="dischargetime" value="<?php echo $dischargetime; ?>" size="10"></td>
			    <td width="26%" align="left" valign="top" >&nbsp;</td>
			  </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
          <tbody id="foo">
            <tr>
              <td width="143" align="left" valign="center"  bgcolor="#66CC00" class="style7">Consultant  </td>
              <td colspan="9" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext3"><strong>
			  
                <select name="doctorcode" id="doctorcode">
                  <?php
				if ($doctorcode == '')
				{
					echo '<option value="" selected="selected">Select Doctor Name</option>';
				}
				else
				{
					$query51 = "select * from master_doctor where doctorcode = '$doctorcode'";
					$exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
					$res51 = mysql_fetch_array($exec51);
					$res51doctorcode = $res51["doctorcode"];
					$res51doctorname = $res51["doctorname"];
					//echo '<option value="">Select Normal Tax</option>';
					echo '<option value="'.$res51doctorcode.'" selected="selected">'.$res51doctorname.'</option>';
				}
				
				$query5 = "select * from master_doctor where status = '' order by doctorname";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5doctorname = $res5["doctorname"];
				$res5doctorcode = $res5["doctorcode"];
				?>
                  <option value="<?php echo $res5doctorcode; ?>"><?php echo $res5doctorname; ?></option>
                  <?php
				}
				?>
                </select>
              </strong></span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Surgery Date </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext312">
                <input name="surgerydate" id="surgerydate" style="border: 1px solid #001E6A" value="<?php echo $surgerydate; ?>"  size="8"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                <img src="images2/cal.gif" onClick="javascript:NewCssCal('surgerydate')" style="cursor:pointer"/> </span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Drug Allergies </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">
			  <input name="drugallergies" type="text" id="drugallergies" value="<?php echo $drugallergies; ?>" size="50"></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><strong>Final Diagnosis </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
                <textarea name="finaldiagnosis" cols="75" rows="5" id="finaldiagnosis"><?php echo $finaldiagnosis; ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Chief Complaints </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="chiefcomplaints" cols="75" rows="5" id="chiefcomplaints"><?php echo $chiefcomplaints; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Patient History </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="patienthistory" cols="75" rows="5" id="patienthistory"><?php echo $patienthistory; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Clinical Examiniation </strong></td>
              <td width="100" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Temparature</strong></td>
              <td width="77" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">
			  <input name="temparature" value="<?php echo $temparature; ?>" type="text" id="temparature" size="10"></td>
              <td width="62" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311"><strong>Pulse</strong></span></td>
              <td width="80" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">
			  <input name="pulse" value="<?php echo $pulse; ?>" type="text" id="pulse" size="10"></td>
              <td width="36" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311"><strong>B.P.</strong></span></td>
              <td width="388" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">
			  <input name="bloodpressure" value="<?php echo $bloodpressure; ?>" type="text" id="bloodpressure" size="10"></td>
              <td width="13" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">&nbsp;</td>
              <td width="13" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">&nbsp;</td>
              <td width="18" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Clinical Examiniation </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311">
                <textarea name="clinicalexamination" cols="75" rows="5" id="clinicalexamination"><?php echo $clinicalexamination; ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Investigation Details </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="investigationdetails" cols="75" rows="5" id="investigationdetails"><?php echo $investigationdetails; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Consultation Referral </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311">
                <input name="consultationreferral" type="text" id="consultationreferral" value="<?php echo $consultationreferral; ?>" size="50">
              </span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Treatment Given </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="treatmentgiven" cols="75" rows="5" id="treatmentgiven"><?php echo $treatmentgiven; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Condition At Discharge </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="conditionatdischarge" cols="75" rows="5" id="conditionatdischarge"><?php echo $conditionatdischarge; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Discharge Advice </strong></td>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Diet</strong></td>
              <td colspan="8" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">
			  <input name="diet" value="<?php echo $diet; ?>" type="text" id="diet" size="50"></td>
              </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311"><strong>Physical Activity </strong></span></td>
              <td colspan="8" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311">
                <input name="physicalactivity" value="<?php echo $physicalactivity; ?>" type="text" id="physicalactivity" size="50">
              </span></td>
              </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><span class="bodytext311"><strong>Medication </strong></span></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <textarea name="medication" cols="75" rows="5" id="medication"><?php echo $medication; ?></textarea></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Follow Up </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><span class="bodytext311">
                <textarea name="followup" cols="75" rows="5" id="followup"><?php echo $followup; ?></textarea>
              </span></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Medical Officer </strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>
                <select name="medicalofficer" id="medicalofficer">
                  <?php
				if ($medicalofficer == '')
				{
					echo '<option value="" selected="selected">Select Medical Officer Name</option>';
				}
				else
				{
					$query51 = "select * from master_doctor where doctorcode = '$medicalofficer'";
					$exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
					$res51 = mysql_fetch_array($exec51);
					$res51doctorcode = $res51["doctorcode"];
					$res51doctorname = $res51["doctorname"];
					//echo '<option value="">Select Normal Tax</option>';
					echo '<option value="'.$res51doctorcode.'" selected="selected">'.$res51doctorname.'</option>';
				}
				
				$query5 = "select * from master_doctor where status = '' order by doctorname";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5doctorname = $res5["doctorname"];
				$res5doctorcode = $res5["doctorcode"];
				?>
                  <option value="<?php echo $res5doctorcode; ?>"><?php echo $res5doctorname; ?></option>
                  <?php
				}
				?>
                </select>
                (Signature)</strong></td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>Consultant</strong></td>
              <td colspan="9" align="left" valign="center"  bgcolor="#CCCCCC" class="bodytext31"><strong>
                <select name="consultantofficer" id="consultantofficer">
                  <?php
				if ($consultantofficer == '')
				{
					echo '<option value="" selected="selected">Select Doctor Name</option>';
				}
				else
				{
					$query51 = "select * from master_doctor where doctorcode = '$consultantofficer'";
					$exec51 = mysql_query($query51) or die ("Error in Query51".mysql_error());
					$res51 = mysql_fetch_array($exec51);
					$res51doctorcode = $res51["doctorcode"];
					$res51doctorname = $res51["doctorname"];
					//echo '<option value="">Select Normal Tax</option>';
					echo '<option value="'.$res51doctorcode.'" selected="selected">'.$res51doctorname.'</option>';
				}
				
				$query5 = "select * from master_doctor where status = '' order by doctorname";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5doctorname = $res5["doctorname"];
				$res5doctorcode = $res5["doctorcode"];
				?>
                  <option value="<?php echo $res5doctorcode; ?>"><?php echo $res5doctorname; ?></option>
                  <?php
				}
				?>
                </select>
                (Signature)</strong></td>
            </tr>
            
            <tr>
              <td align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td colspan="9" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
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
        <td><div align="right"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
          <input name="frm1submit1" id="frm1submit1" type="hidden" value="frm1submit1">
          <input name="delbillst" id="delbillst" type="hidden" value="<?php echo $delbillst;?>">
          <input name="delbillsummarynumber" id="delbillsummarynumber" type="hidden" value="<?php echo $delbillsummarynumber;?>">
          <input name="delsummarynumber" id="delsummarynumber" type="hidden" value="<?php echo $delsummarynumber;?>">
          <input name="Submit2223" type="button" onClick="return funcSaveBill1()" value="Save Discharge Summary" accesskey="b" class="button" style="border: 1px solid #001E6A"/>
        </font></font></font></font></font></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </table>
</form>
<?php include ("includes/footer1.php"); ?>
<?php //include ("print_bill_dmp4inch1.php"); ?>
</body>
</html>