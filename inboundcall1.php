<?php

//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$dateonly = date('Y-m-d');
$appointmentdate = date('Y-m-d');
$registrationtime = date('H:i:s');

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$calldate=$_REQUEST["ADate"];
	$calltime = $_REQUEST["calltime"];
	$timefield = $_REQUEST["timefield"];
	$callperson = $_REQUEST["callperson"];
	$calldescription = $_REQUEST["calldescription"];
	$mobilenumber = $_REQUEST["mobilenumber"];
	$remarks = $_REQUEST["remarks"];
	$entryperson = $_REQUEST["entryperson"];
	
	$query1 = "insert into inboundcall(calldate,calltime,timefield,callperson,calldescription,mobilenumber,
	remarks,entryperson,ipaddress,updatetime)values('$calldate','$calltime','$timefield','$callperson',
	'$calldescription','$mobilenumber','$remarks','$entryperson','$ipaddress','$updatedatetime')";
	$exec1 = mysql_query($query1) or die("Error in Query1".mysql_error());
	
	header("location:inboundcall1.php?st=success");
	exit;
	
		
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
		$errmsg = "Success. Call Information  Updated.";
		$bgcolorcode = 'success';
}
else if ($st == 'failed')
{
		$errmsg = " Update Failed.";
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
	document.form1.callperson.focus();	
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
	//alert("HI");
	if (document.form1.callperson.value == "")
	{
		alert ("Calling Person Name Cannot Be Empty.");
		document.form1.callperson.focus();
		return false;
	}
	if (document.form1.mobilenumber.value == "")
	{
		alert ("Mobile Number Cannot Be Empty.");
		document.form1.mobilenumber.focus();
		return false;
	}
	
	if(isNaN(document.form1.mobilenumber.value))
	{
		alert ("Mobile Number Must Be in Numeric Numbers.");
		document.form1.mobilenumber.focus();
		return false;
	}	
	
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
      	  <form name="form1" id="form1" method="post" onKeyDown="return disableEnterKey()" action="inboundcall1.php" onSubmit="return process1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="800" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Inbound Call Entry </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  
				bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; }else if ($bgcolorcode == 'fail') { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
				<tr>
                <td width="15%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Call Date </span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="ADate" type="text" id="ADate" style="border: 1px solid #001E6A;" value="<?php echo $dateonly; ?>" size="10" readonly="readonly">
                  <strong><span class="bodytext312"> <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate')" style="cursor:pointer"/></span></strong></td>
				</tr>
				<tr>
				<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Call Time </span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="calltime" type="text" id="calltime" style="border: 1px solid #001E6A;" value="<?php //echo $registrationtime; ?>" size="8">
                /<select name="timefield" id="timefield">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
				</select></td>
			    </tr>
				<tr>
				<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Calling Person Name </span></td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext32">
			        <input name="callperson" type="text" style="border: 1px solid #001E6A;" id="callperson">
			      </span></td>
				</tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Call Description </span></td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext32">
			        <label></label>
			        <textarea name="calldescription" style="border: 1px solid #001E6A;" cols="30" rows="3" id="calldescription"></textarea>
			      </span></td>
			      </tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Mobile Number *</span></td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><label>
			        <input name="mobilenumber" id="mobilenumber" value="<?php //echo $companyname; ?>" style="border: 1px solid #001E6A;">
			      </label></td>
			    </tr>
				<tr>
				  <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Entry Person Name </span></td>
				  <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="entryperson" style="border: 1px solid #001E6A;" type="text" id="entryperson"></td>
				  </tr>
				<tr>
                <td width="15%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Remarks</td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0"><label>
                  <textarea name="remarks" cols="30" rows="3" style="border: 1px solid #001E6A;" id="remarks"></textarea>
                </label></td>
				</tr>
				 <tr>
				   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			      </tr>
                 <tr bgcolor="#CCCCCC">
                <td align="middle">&nbsp;</td>
                <td align="middle"><div align="left"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><span class="bodytext32"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input name="Submit222" type="submit"  value="Save Call" class="button" style="border: 1px solid #001E6A"/>
                  </font></font></font></font></font></span>
                        <input type="hidden" name="frmflag1" value="frmflag1" />
                        <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                </font></font></font></font></font></div></td>
                <td align="middle">&nbsp;</td>
                <td align="middle">&nbsp;</td>
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

