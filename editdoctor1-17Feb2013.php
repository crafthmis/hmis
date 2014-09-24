<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = '';

//$codeup=$_REQUEST['str'];
if (isset($_REQUEST["str"])) { $codeup = $_REQUEST["str"]; } else { $codeup = ""; }

//$frmflag1 = $_POST['frmflag1'];
if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$doctorcode = $_REQUEST['doctorcode'];
	$doctorname = $_REQUEST['doctorname'];
	$doctorname = strtoupper($doctorname);
	$doctorname = trim($doctorname);
	$phonenumber = $_REQUEST['phonenumber'];
	$mobilenumber = $_REQUEST['mobilenumber'];
	$address = $_REQUEST['address'];
	$location = $_REQUEST['location'];
	$city  = $_REQUEST['city'];
	$state  = $_REQUEST['state'];
	$pincode = $_REQUEST['pincode'];
	$country = $_REQUEST['country'];
	$rate1=$_REQUEST['rate1'];
	$doctorcode = $_REQUEST['doctorcode'];
	$dateposted = $updatedatetime;
	
	$query2 = "select * from master_doctor where doctorcode = '$doctorcode'"; //customername = '$customername'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 != 0)
	{
		$query1 = "update master_doctor set doctorname='$doctorname', 
		phonenumber='$phonenumber',mobilenumber='$mobilenumber',address='$address', 
		location='$location', city='$city', state='$state', pincode='$pincode', country='$country',dateposted='$dateposted',rate1 ='$rate1' where doctorcode='$doctorcode'";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		
		//$query10 = "update master_hospitalitems set servicename='$doctorname', rateperunit='$rate1',  ipaddress='$ipaddress', updatetime='$updatedatetime' where serviceid='$doctorcode'";
		//$exec10 = mysql_query($query10) or die ("Error in Query10".mysql_error());
		
		$doctorname = $_REQUEST['doctorname'];
		$doctorname = strtoupper($doctorname);
		$doctorname = trim($doctorname);
		$phonenumber = $_REQUEST['phonenumber'];
		$mobilenumber = $_REQUEST['mobilenumber'];
		$address = $_REQUEST['address'];
		$location = $_REQUEST['location'];
		$city  = $_REQUEST['city'];
		$state  = $_REQUEST['state'];
		$pincode = $_REQUEST['pincode'];
		$country = $_REQUEST['country'];
		$doctorcode = $_REQUEST['doctorcode'];
		$dateposted = $updatedatetime;
		
		$errmsg = "Success. Doctor Updated.";
	}
	else
	{
		$doctorname = $_REQUEST['doctorname'];
		$doctorname = strtoupper($doctorname);
		$doctorname = trim($doctorname);
		$phonenumber = $_REQUEST['phonenumber'];
		$mobilenumber = $_REQUEST['mobilenumber'];
		$address = $_REQUEST['address'];
		$location = $_REQUEST['location'];
		$city  = $_REQUEST['city'];
		$state  = $_REQUEST['state'];
		$pincode = $_REQUEST['pincode'];
		$country = $_REQUEST['country'];
		$doctorcode = $_REQUEST['doctorcode'];
		$dateposted = $updatedatetime;
		
		$errmsg = "Failed. Doctor Not Updated.";
	}
}


$doctorcode = $_REQUEST['doctorcode'];
$queryup = "select * from master_doctor where doctorcode='$doctorcode'";
$execup = mysql_query($queryup) or die("Error in queryup".mysql_error());
$resup = mysql_fetch_array($execup);
$doctorname = $resup['doctorname'];
$phonenumber = $resup['phonenumber'];
$mobilenumber = $resup['mobilenumber'];
$address = $resup['address'];
$location = $resup['location'];
$city  = $resup['city'];
$state  = $resup['state'];
$pincode = $resup['pincode'];
$country = $resup['country'];
$rate1=$resup['rate1'];
$doctorcode = $doctorcode;
$dateposted = $updatedatetime;

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
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<?php
/*
$auto_number=$_SESSION['session_auto_number_post_job'];//post job auto number
*/
?>
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

</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function from1submit1()
{

	if (document.form1.doctorname.value == "")
	{
		alert ("Doctor Name Cannot Be Empty.");
		document.form1.doctorname.focus();
		return false;
	}
	else if (document.form1.city.value == "")
	{
		alert ("City Cannot Be Empty.");
		document.form1.city.focus();
		return false;
	}
	else if (document.form1.state.value == "")
	{
		alert ("State Cannot Be Empty.");
		document.form1.state.focus();
		return false;
	}
	else if (document.form1.doctorcode.value == "")
	{
		alert ("Doctor Code Cannot Be Empty.");
		document.form1.doctorcode.focus();
		return false;
	}

}

</script>
<body>
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" action="editdoctor1.php" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="95%" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Doctor - New </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
              <tr>
                <td width="19%" align="left" valign="middle"   class="bodytext3">Doctor  Name   *</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="doctorname" id="doctorname" value="<?php echo $doctorname; ?>" style="border: 1px solid #001E6A" size="60"></td>
              </tr>
              <tr>
                <td align="left" valign="middle"   class="bodytext3">Address</td>
                <td colspan="3" align="left" valign="middle" ><input name="address" id="address" value="<?php echo $address; ?>" style="border: 1px solid #001E6A"  size="60" /></td>
                </tr>
				<tr>
				<td align="left" valign="middle"   class="bodytext3">Location</td>
                <td valign="middle" align="left" >
				<input name="location" id="location" value="<?php echo $location; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
                <td align="left" valign="middle"   class="bodytext3">City * </td>
                <td valign="middle" align="left" ><input name="city" id="city" value="<?php echo $city; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
				</tr>
				<tr>
                <td align="left" valign="middle"   class="bodytext3">State * </td>
                <td valign="middle" align="left" ><input name="state" id="state" value="<?php echo $state; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
              
                <td align="left" valign="middle"   class="bodytext3">Country </td>
                <td valign="middle" align="left" ><input name="country" id="country" value="<?php echo $country; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
				</tr>
				  <tr>
                              
                <td align="left" valign="middle"   class="bodytext3">Pincode</td>
                <td valign="middle" align="left" >
				<input name="pincode" id="pincode" value="<?php echo $pincode; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
				 <td width="22%" align="left" valign="middle"   class="bodytext3"> Mobile Number </td>
				<td width="27%" align="left" valign="middle" >
				<input name="mobilenumber" id="mobilenumber" value="<?php echo $mobilenumber; ?>" style="border: 1px solid #001E6A"  size="20"></td>

              </tr>
              <tr>
                <td align="left" valign="middle"   class="bodytext3">Phone Number  </td>
                <td width="35%" align="left" valign="middle" >
				<input name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>" style="border: 1px solid #001E6A" size="20" />                </td>
				 <td align="left" valign="middle"   class="bodytext3">Doctor  Code * </td>
                 <td valign="middle" align="left" >
				 <input name="doctorcode" id="doctorcode" value="<?php echo $doctorcode; ?>" readonly="readonly" style="border: 1px solid #001E6A"  size="20" /></td>
               
                  </tr>
                         
              
              <tr>
                <td align="left" valign="middle"   class="bodytext3">Date Posted</td>
                <td valign="middle" align="left" ><input name="dateposted" id="dateposted" value="<?php echo $dateposted; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="20"  readonly="readonly" />                </td>
               <td align="left" valign="middle"   class="bodytext3">Professional Charges </td>
                <td valign="middle" align="left" ><input name="rate1" id="rate1" value="<?php echo $rate1; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="20" />                </td>
                </tr>

             
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="95%" 
            align="left" border="0">
            <tbody>
              <tr>
                <td width="3%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="41%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31"><div align="right">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="hidden" name="frmflag1" value="frmflag1" />
                    <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                    <input name="Submit222" type="submit"  value="Save Doctor" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
                </tr>
            </tbody>
          </table></td>
        </tr>
    </table>
	</form>
<script language="javascript">


</script>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

