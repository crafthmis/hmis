<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];

$query1 = "select * from master_company";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_query($query1));
$res1 = mysql_fetch_array($exec1);
$companyname = $res1['companyname'];
$res1address1 = $res1['address1'];
$res1area = $res1['area'];
$res1city = $res1['city'];
$res1pincode = $res1['pincode'];
$res1phonenumber1 = $res1['phonenumber1'];
$res1emailid1 = $res1['emailid1'];

if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }

$query2 = "select * from master_customer where customercode = '$customercode'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$patientid = $res2['customercode'];
$patientname = $res2['customername'];
$address1 = $res2['address1'];
$area = $res2['area'];
$city = $res2['city'];
$pincode = $res2['pincode'];
$phonenumber1 = $res2['phonenumber1'];
$photoavailable = $res2['photoavailable'];

?>
<style type="text/css">
<!--
.style6 {<?php echo 'font-size: '.$fontsize4.'px'; ?>;}


/*
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 24px;
}

.style2 {font-size: 10px}
.style5 {font-family: "Times New Roman", Times, serif; font-weight: bold; font-size: 18px; }
.style6 {font-size: 14px}
.style8 {font-size: 14px; font-weight: bold; }
*/

table.sample {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
.style12 {font-size: 18px; font-weight: bold; }
.style27 {font-size: 14px; }
.style29 {font-family: Neuropol}
.style30 {
	font-size: 14px;
	font-style: italic;
}

-->
</style>
<script language="javascript">

function escapekeypressed()
{
	//alert(event.keyCode);
	if(event.keyCode=='27'){ window.close(); }
}

</script>
<body onkeydown="escapekeypressed()">
<table width="660" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center">
      <table width="99%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td width="17%" rowspan="4">
			<?php
			$query2showlogo = "select * from settings_billhospital where companyanum = '$companyanum'";
			$exec2showlogo = mysql_query($query2showlogo) or die ("Error in Query2showlogo".mysql_error());
			$res2showlogo = mysql_fetch_array($exec2showlogo);
			$showlogo = $res2showlogo['showlogo'];
			if ($showlogo == 'SHOW LOGO')
			{
			?>	
			<img src="logofiles/<?php echo $companyanum;?>.jpg" width="75" height="75" />
			<?php
			}
			?>		</td>
          <td width="83%" valign="top"><strong><?php echo $companyname; ?></strong>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><?php echo $res1address1; ?></td>
        </tr>
        <tr>
          <td valign="top"><?php echo $res1area.' '.$res1city.' '.$res1pincode; ?></td>
        </tr>
        <tr>
          <td valign="top"><?php echo 'Phone: '.$res1phonenumber1.' Email: '.$res1emailid1; ?></td>
        </tr>
      </table>
    </div></td>
  </tr>

  <tr>
    <td colspan="3"><div align="center">&nbsp;</div></td>
  </tr>

  <tr>
    <td colspan="3"  valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0" class="sample">
      <tr>
        <td valign="top" width="16%">Patient ID: </td>
        <td width="47%" valign="top"><?php echo $patientid; ?></td>
        <td width="37%" rowspan="5" valign="top">
		<?php 
		if ($photoavailable == 'YES')
		{
		?>
		<img src="patientphoto/<?php echo $customercode;?>.jpg" width="100" height="100" /> 
		<?php
		}
		?>
		&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">Patient Name: </td>
        <td width="47%" valign="top"><?php echo $patientname; ?></td>
        </tr>
      <tr>
        <td valign="top">Address:</td>
        <td width="47%" valign="top"><?php echo $address1; ?></td>
        </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td width="47%" valign="top"><?php echo $area.' '.$city.' '.$pincode; ?></td>
        </tr>
      <tr>
        <td valign="top">Phone:</td>
        <td width="47%" valign="top"><?php echo $phonenumber1; ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="350" valign="top">
	  <span class="style30">Terms &amp; Conditions: <br>
	1.Please bring this registration card on all hospital visits. 
	<br>
	2.If registration card is lost, please ask for duplicate copy.
	<br>
	3.Make sure your details mentioned here is correct and updated.    </span>
	</td>
    <td width="310" colspan="2" valign="top">
	<table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <div align="right"><span class="style27"><b><?php echo 'For '.$companyname; ?></b></span></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div align="right"><span class="style27"><?php echo 'Authorized Signatory'; ?></span></div></td>
        </tr>
    </table>	
	</td>
  </tr>
  
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><span class="style27">
      <?php 
	$query7 = "select * from master_edition where status = 'ACTIVE'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$res7edition = $res7["edition"];
	if ($res7edition == 'FREE' or $res7edition == 'SPONSORED')
	{
		echo "Free Software By: WWW.SIMPLEINDIA.COM"; 
	}
	?>
    </span></td>
  </tr>
</table>
</body>