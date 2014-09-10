<?php
session_start();
$pagename = '';
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$errmsg = "";
$bgcolorcode = "";

$admissiondate = date('Y-m-d');
$admissiontime = '';
$admittedby = '';
$admittedward = '';
$chiefcomplaint = '';
$dischargeremarks = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$customercode=$_REQUEST["customercode"];
	$customername = $_REQUEST["customername"];
	//$customername = strtoupper($customername);
	$customername = trim($customername);
	$gender = $_REQUEST["gender"];
	$age = $_REQUEST["age"];
	
	$admissiondate = $_REQUEST["admissiondate"];
	$admissiontime = $_REQUEST["admissiontime"];
	$admittedby = $_REQUEST["admittedby"];
	$admittedward = $_REQUEST["admittedward"];
	$chiefcomplaint = $_REQUEST["chiefcomplaint"];
	$consultingdoctor = $_REQUEST["consultingdoctor"];
	$remarks = $_REQUEST["remarks"];
	$dischargedate = $_REQUEST["dischargedate"];
	$dischargetime = $_REQUEST["dischargetime"];
	$dischargedoctor = $_REQUEST["dischargedoctor"];
	$dischargeremarks = $_REQUEST["dischargeremarks"];
		
	$query2 = "select * from master_patientadmission where patientcode = '$customercode' and dischargecompleted = ''";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 != 0)
	{
		/*
		$query3 = "insert into master_patientadmission (patientcode, patientname, gender, age, admissiondate, 
		admissiontime, admittedby, admittedward, chiefcomplaint, username, ipaddress, recordstatus, consultingdoctor, remarks, 
		dischargedate, dischargetime, dischargedoctor) 
		values ('$customercode', '$customername', '$gender', '$age', '$admissiondate', 
		'$admissiontime', '$admittedby', '$admittedward', '$chiefcomplaint', '$username', '$ipaddress', '$recordstatus', '$consultingdoctor', '$remarks', 
		'$dischargedate', '$dischargetime', '$dischargedoctor')";
		*/
		$query3 = "update master_patientadmission set dischargedate = '$dischargedate', dischargetime = '$dischargetime', dischargedoctor = '$dischargedoctor', 
		dischargeremarks = '$dischargeremarks', dischargecompleted = 'completed' where patientcode = '$customercode' and dischargecompleted = ''";
		$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		$status = 'success';
	}
	else
	{
		$status = 'failed';
	}
	header ("location:patientdischarge2.php?customercode=$customercode&&st=$status");

}
else
{
	if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
	//$customercode=$_REQUEST["customercode"];
	if ($customercode != '')
	{
		$query2 = "select * from master_customer where customercode = '$customercode' order by auto_number desc limit 0, 1";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_fetch_array($exec2);
		
		$customercode = $res2["customercode"];
		$customername = $res2["customername"];
		//$customername = strtoupper($customername);
		$customername = trim($customername);
		$gender = $res2["gender"];
		$age = $res2["age"];
		$address1 = $res2["address1"];
		$address2 = $res2["address2"];
		$area = $res2["area"];
		$city  = $res2["city"];
		$state  = $res2["state"];
		$pincode = $res2["pincode"];
		$country = $res2["country"];
		$photoavailable = $res2["photoavailable"];
		
		$dateposted=$res2["dateposted"];
	}
	else
	{
		header ("location:patientadmission1.php?status=failed");
	}
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
		$errmsg = "Success. Patient Discharge Completed.";
		$bgcolorcode = 'success';
}
else if ($st == 'failed')
{
		$errmsg = "Failed. Discharge Not Completed.";
		$bgcolorcode = 'failed';
}


$query4 = "select * from master_patientadmission where patientcode = '$customercode' and dischargecompleted = ''";// and dischargecompleted <> ''";
$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
$res4 = mysql_fetch_array($exec4);
$admissiondate = $res4['admissiondate'];
$admissiontime = $res4['admissiontime'];
$consultingdoctor = $res4['consultingdoctor'];

$query5 = "select * from master_doctor where doctorcode = '$consultingdoctor'";
$exec5 = mysql_query($query5) or die ("Erro in Query5".mysql_error());
$res5 = mysql_fetch_array($exec5);
$consultingdoctor = $res5['doctorname'];

$admittedward = $res4['admittedward'];
$chiefcomplaint = $res4['chiefcomplaint'];
$remarks = $res4['remarks'];
$ipnumber = $res4['ipnumber'];


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
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script language="javascript">


function process1backkeypress1()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
}

function onloadfunction1()
{
	document.form1.customername.focus();	
}


function processflowitem(varstate)
{
	//alert ("Hello World.");
	var varProcessID = varstate;
	//alert (varProcessID);
	var varItemNameSelected = document.getElementById("state").value;
	//alert (varItemNameSelected);
	ajaxprocess5(varProcessID);
	//totalcalculation();
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function process1()
{

	if (document.form1.customername.value == "")
	{
		alert ("Patient Code Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	if (document.form1.customername.value == "")
	{
		alert ("Patient Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	else if (document.form1.admissiondate.value == "")
	{
		alert ("Please Enter Admission Date.");
		document.form1.admissiondate.focus();
		return false;
	}
	else if (document.form1.admissiontime.value == "")
	{
		alert ("Please Enter Admission Time.");
		document.form1.admissiontime.focus();
		return false;
	}
	/*
	else if (document.form1.admittedby.value == "")
	{
		alert ("Please Enter Admitted By Name.");
		document.form1.admittedby.focus();
		return false;
	}
	*/
	else if (document.form1.admittedward.value == "")
	{
		alert ("Please Select Admitted Ward.");
		document.form1.admittedward.focus();
		return false;
	}
	else if (document.form1.chiefcomplaint.value == "")
	{
		alert ("Please Enter Chief Complaint.");
		document.form1.chiefcomplaint.focus();
		return false;
	}
	//return false;
}

</script>

<script src="js/datetimepicker_css.js"></script>

<body onLoad="return onloadfunction1()">
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399">
	<?php 
	
		//include ("includes/menu1.php"); //	include ("includes/menu2.php"); 
	
	?>	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" onKeyDown="return disableEnterKey()" enctype="multipart/form-data" action="patientdischarge2.php" onSubmit="return process1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="800" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Patient - Discharge Entry </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  
				bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; }else if ($bgcolorcode == 'fail') { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
				<tr>
                <td width="15%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Patient Name   *</span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="customername" id="customername" value="<?php echo $customername; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="40"></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Patient ID   *</td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="customercode" id="customercode" value="<?php echo $customercode; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="20">
                    <input type="hidden" name="openingbalance" id="openingbalance" value="<?php echo $openingbalance; ?>" style="border: 1px solid #001E6A; text-align:right" size="20"></td>
				</tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Gender</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0">
				  <input type="text" name="gender" id="gender" value="<?php echo $gender; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC">					</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Age</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0">
				  <input type="text" name="age" id="age" value="<?php echo $age; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC">					</td>
			      </tr>
			    <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address 1 </td>
			    <td width="39%" align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="address1" id="address1" value="<?php echo $address1; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" /></td>
                <td width="17%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address 2 </td>
                <td width="29%" align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="address2" id="address2" value="<?php echo $address2; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" /></td>
			  </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext31"><span class="bodytext32">State</span></span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="state" id="state" value="<?php echo $state; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
<!--				
				<select name="state" id="state" onChange="return processflowitem1()">
                  <?php
		 			 	if ($state != '') 
		  	{
			  echo '<option value="'.$state.'" selected="selected">'.$state.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
		
			$query1 = "select * from master_state where status <> 'deleted' order by state";
			$exec1 = mysql_query($query1) or die ("Error in Query1.state".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$state = $res1["state"];
			?>
                  <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                  <?php
			  }
			  ?>
                </select>
-->				</td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">City </td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="city" id="city" value="<?php echo $city; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
<!--				
				<select name="city" id="city" >
                  <option value="">Select City</option>
                </select>
-->				   </td>
              </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Area</span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
				     <input name="area" id="area" value="<?php echo $area; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
				   </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Pincode</span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><!--				
				<select name="country" id="select">
                    <?php
		 	if ($country != '') 
		  	{
			  echo '<option value="'.$country.'" selected="selected">'.$country.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
		
			$query1 = "select * from master_country where status <> 'deleted' order by country";
			$exec1 = mysql_query($query1) or die ("Error in Query1.country".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$country = $res1["country"];
			if ($country == 'India') { $selectedcountry = 'selected="selected"'; }
			?>
                    <option <?php echo $selectedcountry; ?> value="<?php echo $country; ?>"><?php echo $country; ?></option>
                    <?php
			  $selectedcountry = '';
				  
			  }
			  ?>
                  </select>                
-->				   <span class="bodytext32">
				     <input name="pincode" id="pincode" value="<?php echo $pincode; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
				   </span></td>
			      </tr>
                 <tr>
                <td align="middle"  bgcolor="#CCCCCC">&nbsp;</td>
                <td align="middle"  bgcolor="#CCCCCC">&nbsp;</td>
                <td colspan="2" align="middle"  bgcolor="#CCCCCC"><span class="bodytext32"><strong>Patient - Admission Entry </strong></span></td>
                </tr>
                 
                 <tr>
                   <td colspan="2" rowspan="6" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">
                     <?php 
					if ($photoavailable == 'YES')
					{
					?>
                     <img src="patientphoto/<?php echo $customercode;?>.jpg" width="200" height="200" /> 
                    <?php
					}
					?>					</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">In Patient Number </span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="ipnumber" id="ipnumber" value="<?php echo $ipnumber; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
                       <span class="bodytext32">(IPN)</span></td>
                 </tr>
                 <tr>
					<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Admission Date </span></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                      <input name="admissiondate" id="admissiondate" value="<?php echo $admissiondate; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
                    <!--<img src="images2/cal.gif" onClick="javascript:NewCssCal('admissiondate')" style="cursor:pointer"/>-->
					</span></td>
                 </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Admission Time </span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input name="admissiontime" id="admissiontime" value="<?php echo $admissiontime; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
                   </span></td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Consultant</span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input type="hidden" name="admittedby" id="admittedby" value="<?php echo $admittedby; ?>" style="border: 1px solid #001E6A;"  size="20" />
                     <input name="consultingdoctor" id="consultingdoctor" value="<?php echo $consultingdoctor; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
                   </span></td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Admission Ward Select </span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input name="admittedward" id="admittedward" value="<?php echo $admittedward; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC"  size="20" />
                   </span></td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Chief Complaint </span></td>
                   <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <textarea name="chiefcomplaint" cols="30" rows="5" id="chiefcomplaint" style="border: 1px solid #001E6A;"><?php echo $chiefcomplaint; ?></textarea>
                   </span></td>
                  </tr>
                 <tr>
                   <td colspan="2" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Admission Remarks</td>
                   <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input name="remarks" id="remarks" value="<?php echo $remarks; ?>" readonly="readonly" style="border: 1px solid #001E6A;"  size="20" />
                   </span></td>
                 </tr>
                 
                 <tr>
                   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
                 <tr>
                   <td colspan="4" align="middle"  bgcolor="#CCCCCC"><span class="bodytext32"><strong>Patient - Discharge Entry </strong></span></td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Discharge Date </td>
                   <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input name="dischargedate" id="dischargedate" value="<?php echo date('Y-m-d'); ?>" style="border: 1px solid #001E6A;"  size="20" />
                   (YYYY-MM-DD)</span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Discharge Time </td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext31">
                     <input name="dischargetime" id="dischargetime" value="<?php echo date('H:i'); ?>" style="border: 1px solid #001E6A;"  size="20" />
                   (HH:MM:SS)(24Hrs)</span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Discharge Doctor </td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><strong>
                     <select name="dischargedoctor" id="dischargedoctor">
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
                   </strong></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Discharge Remarks </td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext31">
                     <input name="dischargeremarks" id="dischargeremarks" value="<?php echo $dischargeremarks; ?>" style="border: 1px solid #001E6A;"  size="20" />
                   </span></td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
                 <tr>
                   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="right"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                     <input type="hidden" name="frmflag1" value="frmflag1" />
                     <input name="Submit222" type="submit"  value="Save Patient Discharge" class="button" style="border: 1px solid #001E6A"/>
                   </font></font></font></font></font></div></td>
                  </tr>
                 <tr>
                   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                 </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table>
	</form>
<script language="javascript">


</script>
    </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

