<?php
session_start();
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$registrationdate = date('Y-m-d');
$appointmentdate = date('Y-m-d');
$registrationtime = date('H:i:s');

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$patientname=$_REQUEST["patientname"];
	$appointmentdate = $_REQUEST["appointmentdate"];
	$appointmenttime = $_REQUEST["appointmenttime"];
	$consultingdoctor = $_REQUEST["consultingdoctor"];
	$mobilenumber = $_REQUEST["mobilenumber"];
		
	$query2 = "select * from master_customer where customercode = '$customercode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		
		$date = date('Y-m-d-H-i-s');
		$uploaddir = "patientphoto";
		//$final_filename="$companyname.jpg";
		$final_filename = "$customercode.jpg";
		$uploadfile123 = $uploaddir . "/" . $final_filename;
		$target_path = $uploadfile123;
		$imagepath = $target_path;
		
		//echo $_FILES['browse1']['name'];
		if ($_FILES['browse1']['name'] != '')
		{
			if(move_uploaded_file($_FILES['browse1']['tmp_name'], $target_path)) 
			{
				$query1 = "insert into appointmentschedule_entry (patientname,appointmentdate,appointmenttime,consultingdoctor,mobilenumber) 
				values('$patientname','$appointmentdate','$appointmenttime','$consultingdoctor','$mobilenumber')";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		
				//echo $errmsg = "Success. Photo Upload Completed.";
				$query1 = "update master_customer set photoavailable = 'YES' where customercode = '$customercode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				
				$status = 'success';
			}
			else
			{
				//echo $errmsg = "Failed. Photo Upload Not Completed. File Size More Than 100 KB Not Accepted.";
				$status = 'failed';
			}
		}
		else
		{
				$query1 = "insert into appointmentschedule_entry (patientname,appointmentdate,appointmenttime,consultingdoctor,mobilenumber) 
				values('$patientname','$appointmentdate','$appointmenttime','$consultingdoctor','$mobilenumber')";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				
				$status = 'success';
		}
	    $patientname = '';
		$appointmentdate = '';
		$appointmenttime = '';
		$consultingdoctor  = '';
		
		header("location:appointmentscheduleentry.php?st=$status");
		//exit;
	}
	else
	{
		header ("location:appointmentscheduleentry.php?st=$status");
	}

}
else
{
		
		$patientname = '';
		$appointmentdate = '';
		$appointmenttime = '';
		$consultingdoctor  = '';
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
		$errmsg = "Success. New Patient Updated.";
		if (isset($_REQUEST["cpynum"])) { $cpynum = $_REQUEST["cpynum"]; } else { $cpynum = ""; }
		if ($cpynum == 1) //for first company.
		{
			$errmsg = "Success. New Patient Updated.";
		}
		$bgcolorcode = 'success';
}
else if ($st == 'failed')
{
		$errmsg = "Failed. Photo Upload Failed Or Patient Already Exists.";
		$bgcolorcode = 'failed';
}

if (isset($_REQUEST["cpycount"])) { $cpycount = $_REQUEST["cpycount"]; } else { $cpycount = ""; }
if ($cpycount == 'firstcompany')
{
	$errmsg = "Welcome. You Need To Add Your Company Details Before Proceeding.";
}


$query2 = "select * from master_customer order by auto_number desc limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2customercode = $res2["customercode"];
if ($res2customercode == '')
{
	$customercode = 'AMF00000001';
	$openingbalance = '0.00';
}
else
{
	$res2customercode = $res2["customercode"];
	$customercode = substr($res2customercode, 3, 8);
	$customercode = intval($customercode);
	$customercode = $customercode + 1;

	$maxanum = $customercode;
	if (strlen($maxanum) == 1)
	{
		$maxanum1 = '0000000'.$maxanum;
	}
	else if (strlen($maxanum) == 2)
	{
		$maxanum1 = '000000'.$maxanum;
	}
	else if (strlen($maxanum) == 3)
	{
		$maxanum1 = '00000'.$maxanum;
	}
	else if (strlen($maxanum) == 4)
	{
		$maxanum1 = '0000'.$maxanum;
	}
	else if (strlen($maxanum) == 5)
	{
		$maxanum1 = '000'.$maxanum;
	}
	else if (strlen($maxanum) == 6)
	{
		$maxanum1 = '00'.$maxanum;
	}
	else if (strlen($maxanum) == 7)
	{
		$maxanum1 = '0'.$maxanum;
	}
	else if (strlen($maxanum) == 8)
	{
		$maxanum1 = $maxanum;
	}
	
	$customercode = 'AMF'.$maxanum1;
	$openingbalance = '0.00';
	//echo $companycode;
}

if (isset($_REQUEST["svccount"])) { $svccount = $_REQUEST["svccount"]; } else { $svccount = ""; }
if ($svccount == 'firstentry')
{
	$errmsg = "Please Add Patient To Proceed For Billing.";
	$bgcolorcode = 'failed';
}



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
	document.form1.patientname.focus();	
}

function onloadfunction1()
{
	document.form1.mobilnumber.focus();	
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
.bodytext312 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function process1()
{

	if (document.form1.patientname.value == "")
	{
		alert ("Patient Name Cannot Be Empty.");
		document.form1.patientname.focus();
		return false;
	}
	if (document.form1.mobilenumber.value == "")
	{
		alert ("Mobile Number Cannot Be Empty.");
		document.form1.mobilenumber.focus();
		return false;
	}
	
	
}

function funcConsultationTypeChange()
{
	<?php
	$query11 = "select * from master_doctor where status = ''";
    $exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
	$num=mysql_num_rows($exec11);
	while ($res11 = mysql_fetch_array($exec11))
	{
	$res11consultationanum = $res11["auto_number"];
	$res11consultationtype = $res11["doctorname"];
	$res11consultationfees = $res11["consultationfees"];
	?>
		if(document.getElementById("consultingdoctor").value == "<?php echo $res11consultationanum; ?>")
		{
			document.getElementById("consultationfees").value = <?php echo $res11consultationfees; ?>;
			document.getElementById("consultationfees").focus();
		}
	<?php
	}
	?>
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
	
		include ("includes/menu1.php"); 
	
	//	include ("includes/menu2.php"); 
	
	?>	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">
      	  <form name="form1" id="form1" method="post" onKeyDown="return disableEnterKey()" enctype="multipart/form-data" action="appointmentscheduleentry.php" onSubmit="return process1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="800" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong> Appointment schedule Entry </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  
				bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; }else if ($bgcolorcode == 'fail') { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
				<tr>
                <td width="15%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Patient Name   *</span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="patientname" id="patientname" value="<?php //echo $companyname; ?>" style="border: 1px solid #001E6A;" size="45"></td>
				</tr>
				<tr>
				<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Appointment Date </td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input type="text" name="appointmentdate" id="appointmentdate" value="<?php //echo $registrationdate; ?>" readonly="readonly" style="border: 1px solid #001E6A;">
                  <strong><span class="bodytext312"> 
				  <img src="images2/cal.gif" onClick="javascript:NewCssCal('appointmentdate')" style="cursor:pointer"/> 
				  </span></strong></td>
			    </tr>
				<tr>
				<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Appointment Time </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><input type="text" name="appointmenttime" id="appointmenttime" value="<?php //echo $registrationtime; ?>" style="border: 1px solid #001E6A;"></td>
				</tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Consulting Doctor </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><strong>
                    <select name="consultingdoctor" id="consultingdoctor" onChange="return funcConsultationTypeChange()">
					 <option value="" selected="selected">Select Doctor</option>
                      <?php 
				        $query52="select * from master_doctor";
				        $exec52=mysql_query($query52) or die(mysql_error());
				        while($res52=mysql_fetch_array($exec52))
				        {
				        $res52anum=$res52["auto_number"];
				        $res52consultationtype=$res52["doctorname"];
				      ?>
 				  <option value="<?php echo $res52anum; ?>" ><?php echo $res52consultationtype; ?></option>
				      <?php
				       }
				      ?>
                    </select>
                  </strong></td>
			    </tr>
				<tr>
                <td width="15%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Mobile Number *</span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="mobilenumber" id="mobilenumber" value="<?php //echo $companyname; ?>" style="border: 1px solid #001E6A;" size="45"></td>
				</tr>
				 <tr>
				   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			      </tr>
                 <tr>
                <td colspan="4" align="middle"  bgcolor="#E0E0E0"><div align="left"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input type="hidden" name="frmflag1" value="frmflag1" />
                  <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                  <input name="Submit222" type="submit"  value="Save Appointment" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
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

