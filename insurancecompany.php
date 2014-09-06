<?php
session_start();
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$pagename ='';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$insurancecompanycode=$_REQUEST["insurancecompanycode"];
	$insurancecompanyname = $_REQUEST["insurancecompanyname"];
	//$suppliername = strtoupper($suppliername);
	$insurancecompanyname = trim($insurancecompanyname);
	$insurancecompanyname = addslashes($insurancecompanyname);
	$openingbalance=$_REQUEST["openingbalance"];
		
	$query2 = "select * from master_insurancecompany where insurancecompanycode = 'insurancecompanycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_insurancecompany (insurancecompanycode,insurancecompanyname,openingbalance) 
		values('$insurancecompanycode','$insurancecompanyname','$openingbalance')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			
		$insurancecompanyname = '';
		$insurancecompanycode = '';
		$openingbalance = '0.00';
		$dateposted = $updatedatetime;
		header("location:insurancecompany.php?st=success");
		//header ("location:addcompany1.php?st=success&&cpynum=1");
	}
	else
	{
		header ("location:insurancecompany.php?st=failed");
	}

}
else
{
	$insurancecompanyname = "";
	//$companyname = strtoupper($companyname);
    $insurancecompanycode = '';
	$dateposted = $updatedatetime;
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
		$errmsg = "Success. New Insurance Company Updated.";
		if (isset($_REQUEST["cpynum"])) { $cpynum = $_REQUEST["cpynum"]; } else { $cpynum = ""; }
		if ($cpynum == 1) //for first company.
		{
			$errmsg = "Success. New Insurance Company Updated.";
		}
}
if ($st == 'failed')
{
		$errmsg = "Failed. Insurance Company Already Exists.";
}

$query2 = "select * from master_insurancecompany order by auto_number desc limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2insurancecompanycode = $res2["insurancecompanycode"];
if ($res2insurancecompanycode == '')
{
	$insurancecompanycode = 'INS00000001';
	$openingbalance = '0.00';
}
else
{
	$res2insurancecompanycode = $res2["insurancecompanycode"];
	$insurancecompanycode = substr($res2insurancecompanycode, 3, 8);
	$insurancecompanycode = intval($insurancecompanycode);
	$insurancecompanycode = $insurancecompanycode + 1;

	$maxanum = $insurancecompanycode;
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
	
	$insurancecompanycode = 'INS'.$maxanum1;
	$openingbalance = '0.00';

	//echo $companycode;
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
	document.form1.insurancecompanyname.focus();	
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

function processflowitem1()
{
	<?php
	$query11 = "select * from master_state group by state order by state";
	$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
	while ($res11 = mysql_fetch_array($exec11))
	{
	$statename = $res11["state"];
	?>
		if(document.form1.state.value=="<?php echo $statename; ?>")
		{
		document.getElementById("city").options.length=null; 
		var combo = document.getElementById('city'); 
		<?php 
		$loopcount=0;
		?>
		combo.options[<?php echo $loopcount;?>] = new Option ("Select City", ""); 
		<?php
		$query10="select * from master_city where state = '$statename' group by city order by city asc";
		$exec10=mysql_query($query10) or die ("error in query10".mysql_error());
		while ($res10=mysql_fetch_array($exec10))
		{
		$loopcount=$loopcount+1;
		$city1=$res10["city"];
		?>
		combo.options[<?php echo $loopcount;?>] = new Option ("<?php echo $city;?>", "<?php echo $city;?>"); 
		<?php 
		}
		?>
		}
	<?php
	}
	?>
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

function from1submit1()
{
	//alert ("Inside Function");
	if (document.form1.insurancecompanycode.value == "")
	{
		alert ("Insurance Company Code Cannot Be Empty.");
		document.form1.insurancecompanycode.focus();
		return false;
	}
	else if (document.form1.insurancecompanyname.value == "")
	{
		alert ("Insurance Company Name Cannot Be Empty.");
		document.form1.insurancecompanyname.focus();
		return false;
	}

}

</script>
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


      	  <form name="form1" id="form1" method="post" onKeyDown="return disableEnterKey()" action="insurancecompany.php" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="600" height="100" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Insurance Company - New </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
			  <?php
			  if ($errmsg != '')
			  {
			  ?>
             <tr>
                <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
			  <?php
			  }
			  ?>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
				<tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Insurance Company Name   *</span></td>
                <td width="38%" align="left" valign="middle"  bgcolor="#E0E0E0"><input name="insurancecompanyname" id="insurancecompanyname" value="<?php echo $insurancecompanyname; ?>" style="border: 1px solid #001E6A;" size="40"></td>
                
				</tr>
			  <tr>
			   <td width="21%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Insurance Company Code   *</td>
                <td width="22%" align="left" valign="middle"  bgcolor="#E0E0E0"><input name="insurancecompanycode" id="insurancecompanycode" value="<?php echo $insurancecompanycode; ?>" readonly="readonly" style="border: 1px solid #001E6A;text-transform: uppercase; background-color:#CCCCCC" size="20"></td>
			  </tr>
				
               <tr>
                <td colspan="4" align="middle"  bgcolor="#E0E0E0"><div align="right"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input type="hidden" name="frmflag1" value="frmflag1" />
                  <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                  <input name="Submit222" type="submit"  value="Save Company" class="button" style="border: 1px solid #001E6A"/>
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

