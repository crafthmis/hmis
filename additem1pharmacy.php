<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$colorloopcount = "";

//to redirect if there is no entry in masters category or item.
$query90 = "select count(auto_number) as masterscount from master_categorypharmacy";
$exec90 = mysql_query($query90) or die ("Error in Query90".mysql_error());
$res90 = mysql_fetch_array($exec90);
$res90count = $res90["masterscount"];
if ($res90count == 0)
{
	header ("location:addcategory1pharmacy.php?svccount=firstentry");
}


if (isset($_POST["frmflag1"])) { $frmflag1 = $_POST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{

	$itemcode = $_REQUEST["itemcode"];
	$itemcode = strtoupper($itemcode);
	$itemcode = trim($itemcode);
	$itemname = $_REQUEST["itemname"];
	$molecularname = $_REQUEST["molecularname"];
	//$itemname = strtoupper($itemname);
	$itemname = trim($itemname);
	$molecularname = trim($molecularname);
	//echo "simple";
	$length1=strlen($itemcode);
	$length2=strlen($itemname);
	$length3=strlen($molecularname);
	//! ^ + = [ ] ; , { } | \ < > ? ~
	//if (preg_match ('/[+,|,=,{,},(,)]/', $itemname))
	if (preg_match ('/[!,^,+,=,[,],;,,,{,},|,\,<,>,?,~]/', $itemname))
	{  
		//echo "inside if";
		$bgcolorcode = 'fail';
		$errmsg="Sorry. Pharmacy Item Not Added";
		
		header("location:additem1pharmacy.php?st=1");
		exit();
	}
	$itemname = addslashes($itemname);
	
	if (preg_match ('/[!,^,+,=,[,],;,,,{,},|,\,<,>,?,~]/', $molecularname))
	{  
		//echo "inside if";
		$bgcolorcode = 'fail';
		$errmsg="Sorry. Pharmacy Item Not Added";
		
		header("location:additem1pharmacy.php?st=1");
		exit();
	}
	$molecularname = addslashes($molecularname);
	
	$categoryname = $_REQUEST["categoryname"];
	$purchaseprice  = $_REQUEST["purchaseprice"];
	$rateperunit  = $_REQUEST["rateperunit"];
	$expiryperiod = '';
	$description=$_REQUEST["description"];
	$unitname_abbreviation = $_REQUEST["unitname_abbreviation"];
	$packageanum = $_REQUEST["packageanum"];
	$manufactureranum = $_REQUEST["manufactureranum"];
	$taxanum = $_REQUEST["taxanum"];
	if ($length1<25 && $length2<255)
	{
		$query4 = "select * from master_tax where auto_number = '$taxanum'";// and cstid='$custid' and cstname='$custname'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		$res4 = mysql_fetch_array($exec4);
		$res4taxname = $res4["taxname"];

		$query4 = "select * from master_packagepharmacy where auto_number = '$packageanum'";// and cstid='$custid' and cstname='$custname'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		$res4 = mysql_fetch_array($exec4);
		$packagename = $res4["packagename"];
		$packagename = addslashes($packagename);
		
		$query4 = "select * from master_manufacturerpharmacy where auto_number = '$manufactureranum'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		$res4 = mysql_fetch_array($exec4);
		$manufacturername = $res4['manufacturername'];
		
		$query2 = "select * from master_itempharmacy where itemcode = '$itemcode'";// or itemname = '$itemname'";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_num_rows($exec2);
		if ($res2 == 0)
		{
			$query1 = "insert into master_itempharmacy (itemcode, itemname, categoryname, unitname_abbreviation, rateperunit, expiryperiod, taxanum, taxname, 
			ipaddress, updatetime, description, purchaseprice, packageanum, packagename, manufactureranum, manufacturername, molecularname) 
			values ('$itemcode', '$itemname', '$categoryname', '$unitname_abbreviation', '$rateperunit', '$expiryperiod', '$taxanum', '$res4taxname', 
			'$ipaddress', '$updatedatetime','$description', '$purchaseprice', '$packageanum', '$packagename', '$manufactureranum', '$manufacturername', '$molecularname')";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
			//$query1 = "insert into master_renewal (itemcode, itemname, renewalmonths, ipaddress, updatetime) 
			//values ('$itemcode', '$itemname', '0', '$ipaddress', '$updatedatetime')";
			//$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
			$errmsg = "Success. New Pharmacy Item Updated.";
			$bgcolorcode = 'success';
			$itemcode = '';
			$itemname = '';
			$molecularname = '';
			$rateperunit  = '0.00';
			$purchaseprice  = '0.00';
			$description='';
			
			
			//$itemcode = '';
			$query1 = "select * from master_itempharmacy order by auto_number desc limit 0, 1";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			$rowcount1 = mysql_num_rows($exec1);
			if ($rowcount1 == 0)
			{
				$itemcode = 'PH001';
			}
			else
			{
				$res1 = mysql_fetch_array($exec1);
				$res1itemcode = $res1['itemcode'];
				$res1itemcode = substr($res1itemcode, 2, 8);
				$res1itemcode = intval($res1itemcode);
				$res1itemcode = $res1itemcode + 1;
				
				$res1itemcode = $res1itemcode;
				if (strlen($res1itemcode) == 2)
				{
					$res1itemcode = '0'.$res1itemcode;
				}
				if (strlen($res1itemcode) == 1)
				{
					$res1itemcode = '00'.$res1itemcode;
				}
				$itemcode = 'PH'.$res1itemcode;
			
			}
			
		}
		else
		{
			$errmsg = "Failed. Pharmacy Item Code Already Exists.";
			$bgcolorcode = 'failed';
		}
	}
	else
	{
		$errmsg = "Failed. Pharmacy Item Code Should Be 25 Characters And Name Should Be 255 Characters.";
		$bgcolorcode = 'failed';
	}
	

}
else
{
	$itemcode = '';
	$itemname = '';
	$molecularname = '';
	$rateperunit  = '0.00';
	$purchaseprice  = '0.00';
	$description='';
	
	//$itemcode = '';
	$query1 = "select * from master_itempharmacy order by auto_number desc limit 0, 1";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$rowcount1 = mysql_num_rows($exec1);
	if ($rowcount1 == 0)
	{
		$employeecode = 'PH001';
	}
	else
	{
		$res1 = mysql_fetch_array($exec1);
		$res1itemcode = $res1['itemcode'];
		$res1itemcode = substr($res1itemcode, 2, 8);
		$res1itemcode = intval($res1itemcode);
		$res1itemcode = $res1itemcode + 1;
	
		/*
		$maxanum = $res1itemcode;
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
		*/
		
		$res1itemcode = $res1itemcode;
		if (strlen($res1itemcode) == 2)
		{
			$res1itemcode = '0'.$res1itemcode;
		}
		if (strlen($res1itemcode) == 1)
		{
			$res1itemcode = '00'.$res1itemcode;
		}
		$itemcode = 'PH'.$res1itemcode;
	
		//echo $employeecode;
	}
	
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'del')
{
	$delanum = $_REQUEST["anum"];
	$query3 = "update master_itempharmacy set status = 'deleted' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}
if ($st == 'activate')
{
	$delanum = $_REQUEST["anum"];
	$query3 = "update master_itempharmacy set status = '' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}


if (isset($_REQUEST["svccount"])) { $svccount = $_REQUEST["svccount"]; } else { $svccount = ""; }
if ($svccount == 'firstentry')
{
	$errmsg = "Please Add Pharmacy Item To Proceed For Billing.";
	$bgcolorcode = 'failed';
}

if (isset($_REQUEST["searchflag1"])) { $searchflag1 = $_REQUEST["searchflag1"]; } else { $searchflag1 = ""; }
if (isset($_REQUEST["searchflag2"])) { $searchflag2 = $_REQUEST["searchflag2"]; } else { $searchflag2 = ""; }
if (isset($_REQUEST["search1"])) { $search1 = $_REQUEST["search1"]; } else { $search1 = ""; }
if (isset($_REQUEST["search2"])) { $search2 = $_REQUEST["search2"]; } else { $search2 = ""; }

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
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function additem1process1()
{
	//alert ("Inside Funtion");
	if (document.form1.categoryname.value == "")
	{	
		alert ("Please Select Category Name.");
		document.form1.categoryname.focus();
		return false;
	}
	if (document.form1.itemcode.value == "")
	{	
		alert ("Please Enter Pharmacy Item Code or ID.");
		document.form1.itemcode.focus();
		return false;
	}
	if (document.form1.itemcode.value != "")
	{	
		var data = document.form1.itemcode.value;
		//alert(data);
		// var iChars = "!%^&*()+=[];,.{}|\:<>?~"; //All special characters.*
		var iChars = "!^+=[];,{}|\<>?~$'\"@#%&*()-_`. "; 
		for (var i = 0; i < data.length; i++) 
		{
			if (iChars.indexOf(data.charAt(i)) != -1) 
			{
				//alert ("Your Pharmacy Item Name Has Blank White Spaces Or Special Characters. Like ! ^ + = [ ] ; , { } | \ < > ? ~ $ ' \" These are not allowed.");
				alert ("Your Pharmacy Item Code Has Blank White Spaces Or Special Characters. These Are Not Allowed.");
				return false;
			}
		}
	}
	if (document.form1.itemname.value == "")
	{
		alert ("Pleae Enter Pharmacy Item Name.");
		document.form1.itemname.focus();
		return false;
	}
	if (document.form1.molecularname.value == "")
	{
		alert ("Pleae Enter Pharmacy Molecular Name.");
		document.form1.molecularname.focus();
		return false;
	}
	if (document.form1.manufactureranum.value == "")
	{
		alert ("Pleae Select Manufacturer Name.");
		document.form1.manufactureranum.focus();
		return false;
	}
	if (document.form1.unitname_abbreviation.value == "")
	{
		alert ("Pleae Select Unit Name.");
		document.form1.unitname_abbreviation.focus();
		return false;
	}
	if (document.form1.packageanum.value == "")
	{
		alert ("Pleae Select Package Name.");
		document.form1.packageanum.focus();
		return false;
	}
	if (document.form1.purchaseprice.value == "")
	{	
		alert ("Please Enter Purchase Price Per Unit.");
		document.form1.purchaseprice.focus();
		return false;
	}
	if (document.form1.rateperunit.value == "")
	{	
		alert ("Please Enter Selling Price Per Unit.");
		document.form1.rateperunit.focus();
		return false;
	}
	if (document.form1.taxanum.value == "")
	{	
		alert ("Please Select Applicable Tax.");
		document.form1.taxanum.focus();
		return false;
	}
	if (isNaN(document.form1.rateperunit.value) == true)
	{	
		alert ("Please Enter Rate Per Unit In Numbers.");
		document.form1.rateperunit.focus();
		return false;
	}
	if (document.form1.rateperunit.value == "0.00")
	{
		/*
		var fRet; 
		fRet = confirm('Rate Per Unit Is 0.00, Are You Sure You Want To Continue To Save?'); 
		//alert(fRet);  // true = ok , false = cancel
		if (fRet == false)
		{
			return false;
		}
		*/
/*		else if (document.form1.unitname_abbreviation.value == "SR")
		{
			if (document.form1.expiryperiod.value == "")
			{	
				alert ("Please Select Expiry Period.");
				document.form1.expiryperiod.focus();
				return false;
			}
		}
*/	}
/*	else if (document.form1.unitname_abbreviation.value == "SR")
	{
		if (document.form1.expiryperiod.value == "")
		{	
			alert ("Please Select Expiry Period.");
			document.form1.expiryperiod.focus();
			return false;
		}
	}
*/}

/*
function process1()
{
	//alert (document.form1.unitname.value);
	if (document.form1.unitname_abbreviation.value == "SR")
	{
		document.getElementById('expiryperiod').style.visibility = '';
	}
	else
	{
		document.getElementById('expiryperiod').style.visibility = 'hidden';
	}
}
*/
function spl()
{
	var data=document.form1.itemname.value ;
	//alert(data);
	// var iChars = "!%^&*()+=[];,.{}|\:<>?~"; //All special characters.
	var iChars = "!^+=[];,{}|\<>?~"; 
	for (var i = 0; i < data.length; i++) 
	{
		if (iChars.indexOf(data.charAt(i)) != -1) 
		{
			alert ("Your Pharmacy Item Name Has Special Characters. Like ! ^ + = [ ] ; , { } | \ < > ? ~ These are not allowed.");
			return false;
		}
	}
}

function sp2()
{
	var data=document.form1.molecularname.value ;
	//alert(data);
	// var iChars = "!%^&*()+=[];,.{}|\:<>?~"; //All special characters.
	var iChars = "!^+=[];,{}|\<>?~"; 
	for (var i = 0; i < data.length; i++) 
	{
		if (iChars.indexOf(data.charAt(i)) != -1) 
		{
			alert ("Your Pharmacy Molecular Name Has Special Characters. Like ! ^ + = [ ] ; , { } | \ < > ? ~ These are not allowed.");
			return false;
		}
	}
}
 
 
function process2()
{
	//document.getElementById('expiryperiod').style.visibility = 'hidden';
}


</script>
<body onLoad="return process2()">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?>
	
	</td>
<!--	<td colspan="10" bgcolor="#8CAAE6"><p>PHARMACY ITEM</p></td>
-->  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
            <tr>
              <td><form name="form1" id="form1" method="post" action="additem1pharmacy.php" onSubmit="return additem1process1()">
                  <table width="900" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Pharmacy Item Master - Add New </strong></td>
                      </tr>
					  <?php if ($st==1)
					  {?>
					  <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="#AAFF00"><font size="2">Sorry Special Characters Are Not Allowed</font></div></td>
                      </tr>
					  <?php }?>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   
						bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; }else if ($bgcolorcode == 'fail') { echo '#AAFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?>&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Select Category Name  </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<select id="categoryname" name="categoryname" >
						<option value="">Select Category</option>
						<?php
						$query1 = "select * from master_categorypharmacy where status <> 'deleted' order by categoryname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1categoryname = $res1["categoryname"];
						?>
						<option value="<?php echo $res1categoryname; ?>"><?php echo $res1categoryname; ?></option>
						<?php
						}
						?>
						</select> <a href="addcategory1pharmacy.php"><font  class="bodytext3" color="#000000">(Click Here To Add New Category)</font></a>						</td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"> <div align="left">New Pharmacy Item Code </div></td><td align="left" valign="top"  bgcolor="#E0E0E0">
						<input name="itemcode" value="<?php echo $itemcode; ?>" readonly="readonly" id="itemcode" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="20" maxlength="100" />
						<span class="bodytext3">( Example : PRD1234567890 ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Add New Pharmacy Item Name </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<input value="<?php echo $itemname; ?>" name="itemname" id="itemname" style="border: 1px solid #001E6A" size="60" onChange="return spl()"/></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Molecular Name </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<input value="<?php echo $molecularname; ?>" name="molecularname" id="molecularname" style="border: 1px solid #001E6A" size="60" onChange="return spl()"/></td>
                      </tr>
					  
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Select Manufacturer </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<select id="manufactureranum" name="manufactureranum">
                          <option value="">Select Manufacturer</option>
                          <?php
						$query1 = "select * from master_manufacturerpharmacy where status <> 'deleted' order by manufacturername";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$manufactureranum = $res1["auto_number"];
						$manufacturername = $res1["manufacturername"];
						?>
                          <option value="<?php echo $manufactureranum; ?>"><?php echo $manufacturername; ?></option>
                          <?php
						}
						?>
                        </select></td>
                      </tr>
					  
					  
						<!--						
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Select Pharmacy Item Unit  </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<select id="unitname_abbreviation" name="unitname_abbreviation">
                          <option value="">Select Unit</option>
                          <?php
						$query1 = "select * from master_unitspharmacy where status <> 'deleted' order by unitname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1unitname = $res1["unitname"];
						$unitname_abbreviation = $res1["unitname_abbreviation"];
						?>
                          <option value="<?php echo $unitname_abbreviation; ?>"><?php echo $res1unitname.' ( '.$unitname_abbreviation.' ) '; ?></option>
                          <?php
						}
						?>
                        </select>
					</td>
                      </tr>
-->						
					  
					  
					  
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Select Pharmacy Package </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<select id="packageanum" name="packageanum">
                          <option value="">Select Pack</option>
                          <?php
						$query1 = "select * from master_packagepharmacy where status <> 'deleted' order by packagename";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1anum = $res1['auto_number'];
						$res1packagename = $res1["packagename"];
						$res1packagename = stripslashes($res1packagename);
						$quantityperpackage = $res1["quantityperpackage"];
						$quantityperpackage = round($quantityperpackage);
						?>
                          <option value="<?php echo $res1anum; ?>"><?php echo $res1packagename.' ( '.$quantityperpackage.' ) '; ?></option>
                          <?php
						}
						?>
                        </select>
						<a href="addpackage1pharmacy.php"></a></td>
                      </tr>
					  
<!--					  
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Selling Price  Per Unit </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Purchase  Price  Per Unit </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Pharmacy Item Description </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">&nbsp;</td>
                      </tr>
-->					  
					  
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><div align="left">Select Applicable Tax </div></td>
                        <td align="left" valign="top"  bgcolor="#E0E0E0">
						<select id="taxanum" name="taxanum">
                            <option value="">Select Tax</option>
                            <?php
						$query1 = "select * from master_tax where status <> 'deleted' order by taxname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1taxname = $res1["taxname"];
						$res1taxpercent = $res1["taxpercent"];
						$res1anum = $res1["auto_number"];
						?>
                            <option value="<?php echo $res1anum; ?>"><?php echo $res1taxname.' ( '.$res1taxpercent.'% ) '; ?></option>
                            <?php
						}
						?>
                        </select>
						<input name="rateperunit" type="hidden" id="rateperunit" style="border: 1px solid #001E6A" value="<?php echo $rateperunit; ?>" size="20" />
						<input type="hidden" name="purchaseprice" id="purchaseprice" style="border: 1px solid #001E6A" value="<?php echo $purchaseprice; ?>" size="20" />
						<input name="description" type="hidden" id="description" style="border: 1px solid #001E6A" value="<?php echo $description; ?>" size="50">
						<input type="hidden" name="unitname_abbreviation" id="unitname_abbreviation" value="NOS"></td>
                      </tr>
				  
					  
<!--                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<div align="right">Pharmacy Item Period </div></td>
                        <td valign="top" align="left" >
						<select class="box" id="expiryperiod" 
                  style="BORDER-RIGHT: #001e6a 1px solid; BORDER-TOP: #001e6a 1px solid; BORDER-LEFT: #001e6a 1px solid; BORDER-BOTTOM: #001e6a 1px solid" 
                  name="expiryperiod">
                            <option value="0" selected="selected">No Renewal</option>
							<?php
							for ($i=1;$i<=60;$i++)
							{
							?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
							<?php
							}
							?>
                        </select></td>
                      </tr>
-->					  
					  
                      <tr>
                        <td width="28%" align="left" valign="top"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                        <td width="72%" align="left" valign="top"  bgcolor="#E0E0E0"><input type="hidden" name="frmflag" value="addnew" />
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                          <input type="submit" name="Submit" value="Save Pharmacy Item" style="border: 1px solid #001E6A" />                        </td>
                      </tr>
                    </tbody>
                  </table>
				  </form>
				  <form>
                <table width="900" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="9" bgcolor="#CCCCCC" class="bodytext3"><span class="bodytext32"><strong>Pharmacy Item Master - Existing List - Latest 100 Pharmacy Items </strong></span></td>
                        <td bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
						
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td colspan="10" bgcolor="#FFFFFF" class="bodytext3">
						<input name="search1" type="text" id="search1" size="40" value="<?php echo $search1; ?>">
						<input type="hidden" name="searchflag1" id="searchflag1" value="searchflag1">
                          <input type="submit" name="Submit2" value="Search" style="border: 1px solid #001E6A" /></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td width="3%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Delete</strong></div></td>
                        <td width="13%" bgcolor="#CCCCCC" class="bodytext3"><strong>ID / Code </strong></td>
                        <td width="20%" bgcolor="#CCCCCC" class="bodytext3"><strong>Category</strong></td>
                        <td width="35%" bgcolor="#CCCCCC" class="bodytext3"><strong>Pharmacy Item</strong></td>
						<td width="20%" bgcolor="#CCCCCC" class="bodytext3"><div align="justify"><strong>Molecular Name</strong></div></td>
                        <td width="7%" bgcolor="#CCCCCC" class="bodytext3"><div align="justify"><strong>Pack</strong></div></td>
                        <td width="7%" bgcolor="#CCCCCC" class="bodytext3"><div align="justify"><strong>Tax%</strong></div></td>
                        <td width="12%" bgcolor="#CCCCCC" class="bodytext3"><div align="right"><strong>Purchase</strong></div></td>
                        <td width="12%" bgcolor="#CCCCCC" class="bodytext3"><div align="right"><strong>Selling</strong></div></td>
                        <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Edit</strong></div></td>
                      </tr>
                      <?php
	  if ($searchflag1 == 'searchflag1')
	  {
					  
		$search1 = $_REQUEST["search1"];			  
	    $query1 = "select * from master_itempharmacy where itemname like '%$search1%' or categoryname like '%$search1%' and status <> 'deleted' order by auto_number desc LIMIT 100";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$itemcode = $res1["itemcode"];
		$itemname = $res1["itemname"];
		$molecularname = $res1["molecularname"];
		$categoryname = $res1["categoryname"];
		$purchaseprice = $res1["purchaseprice"];
		$rateperunit = $res1["rateperunit"];
		$expiryperiod = $res1["expiryperiod"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		$taxname = $res1["taxname"];
		$taxanum = $res1["taxanum"];
		$packagename = $res1["packagename"];
		$packagename = stripslashes($packagename);
		$packageanum = $res1["packageanum"];
		if ($expiryperiod != '0') 
		{ 
			$expiryperiod = $expiryperiod.' Months'; 
		}
		else
		{
			$expiryperiod = ''; 
		}
		
		$query6 = "select * from master_tax where auto_number = '$taxanum'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$res6 = mysql_fetch_array($exec6);
		$res6taxpercent = $res6["taxpercent"];
		
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
                        <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center"><a href="additem1pharmacy.php?st=del&amp;&amp;anum=<?php echo $auto_number; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemcode; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $categoryname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemname; ?> </td>
						<td align="left" valign="top"  class="bodytext3"><?php echo $molecularname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $packagename; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $res6taxpercent; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><?php echo $purchaseprice; ?></div></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><?php echo $rateperunit; ?></div></td>
                        <td align="left" valign="top"  class="bodytext3">
						  <div align="center">
						  <a href="edititem1pharmacy.php?sanum=<?php echo $auto_number; ?>" class="bodytext3">Edit</a></div></td>
                      </tr>
                      <?php
		}
	}
	else
	{
	$query1 = "select * from master_itempharmacy where status <> 'deleted' order by auto_number desc LIMIT 100";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$itemcode = $res1["itemcode"];
		$itemname = $res1["itemname"];
		$molecularname = $res1["molecularname"];
		$categoryname = $res1["categoryname"];
		$purchaseprice = $res1["purchaseprice"];
		$rateperunit = $res1["rateperunit"];
		$expiryperiod = $res1["expiryperiod"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		$taxname = $res1["taxname"];
		$taxanum = $res1["taxanum"];
		$packagename = $res1["packagename"];
		$packagename = stripslashes($packagename);
		$packageanum = $res1["packageanum"];
		if ($expiryperiod != '0') 
		{ 
			$expiryperiod = $expiryperiod.' Months'; 
		}
		else
		{
			$expiryperiod = ''; 
		}
		
		$query6 = "select * from master_tax where auto_number = '$taxanum'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$res6 = mysql_fetch_array($exec6);
		$res6taxpercent = $res6["taxpercent"];
		
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
                        <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center"><a href="additem1pharmacy.php?st=del&amp;&amp;anum=<?php echo $auto_number; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemcode; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $categoryname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemname; ?> </td>
						<td align="left" valign="top"  class="bodytext3"><?php echo $molecularname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $packagename; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $res6taxpercent; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><?php echo $purchaseprice; ?></div></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><?php echo $rateperunit; ?></div></td>
                        <td align="left" valign="top"  class="bodytext3">
						  <div align="center">
						  <a href="edititem1pharmacy.php?sanum=<?php echo $auto_number; ?>" class="bodytext3">Edit</a></div></td>
                      </tr>
                      <?php
		}
	}
		?>
                    </tbody>
                  </table>
				  </form>
				  <br>
				  
 				  <form>
                <table width="900" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="10" bgcolor="#CCCCCC" class="bodytext3"><strong>Pharmacy Item Master - Deleted </strong></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td colspan="10" bgcolor="#FFFFFF" class="bodytext3"><span class="bodytext32">
                          <input name="search2" type="text" id="search2" size="40" value="<?php echo $search2; ?>">
                          <input type="hidden" name="searchflag2" id="searchflag2" value="searchflag2">
                          <input type="submit" name="Submit22" value="Search" style="border: 1px solid #001E6A" />
                        </span></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td width="8%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Activate</strong></div></td>
                        <td width="13%" bgcolor="#CCCCCC" class="bodytext3"><strong>ID / Code </strong></td>
                        <td width="16%" bgcolor="#CCCCCC" class="bodytext3"><strong>Category</strong></td>
                        <td width="23%" bgcolor="#CCCCCC" class="bodytext3"><strong>Pharmacy Item</strong></td>
						<td width="23%" bgcolor="#CCCCCC" class="bodytext3"><strong>Molecular Name</strong></td>
                        <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="justify"><strong>Pack</strong></div></td>
                        <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="justify"><strong>Tax%</strong></div></td>
                        <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="right"><strong>Purchase</strong></div></td>
                        <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="right"><strong>Selling</strong></div></td>
                      </tr>
                      <?php
		if (isset($_REQUEST["searchflag2"])) { $searchflag2 = $_REQUEST["searchflag2"]; } else { $searchflag2 = ""; }
	  if ($searchflag2 == 'searchflag2')
	  {
					  
		$search2 = $_REQUEST["search2"];			  
	    $query1 = "select * from master_itempharmacy where itemname like '%$search2%' or categoryname like '%$search1%' and status = 'deleted' order by auto_number desc LIMIT 100";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$itemcode = $res1["itemcode"];
		$itemname = $res1["itemname"];
		$molecularname = $res1["molecularname"];
		$categoryname = $res1["categoryname"];
		$purchaseprice = $res1["purchaseprice"];
		$rateperunit = $res1["rateperunit"];
		$expiryperiod = $res1["expiryperiod"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		$taxname = $res1["taxname"];
		$taxanum = $res1["taxanum"];
		$packagename = $res1["packagename"];
		$packagename = stripslashes($packagename);
		$packageanum = $res1["packageanum"];
		if ($expiryperiod != '0') 
		{ 
			$expiryperiod = $expiryperiod.' Months'; 
		}
		else
		{
			$expiryperiod = ''; 
		}
		
		$query6 = "select * from master_tax where auto_number = '$taxanum'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$res6 = mysql_fetch_array($exec6);
		$res6taxpercent = $res6["taxpercent"];
		
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
                        <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
						<a href="additem1pharmacy.php?st=activate&amp;&amp;anum=<?php echo $auto_number; ?>" class="bodytext3">
                          <div align="center" class="bodytext3">Activate</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemcode; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $categoryname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemname; ?></td>
						<td align="left" valign="top"  class="bodytext3"><?php echo $molecularname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $packagename; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $res6taxpercent; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $purchaseprice; ?></span></div></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $rateperunit; ?></span></div></td>
                      </tr>
                      <?php
		}
	}
	else
	{
		
	    $query1 = "select * from master_itempharmacy where status = 'deleted' order by auto_number desc LIMIT 100";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$itemcode = $res1["itemcode"];
		$itemname = $res1["itemname"];
		$molecularname = $res1["molecularname"];
		$categoryname = $res1["categoryname"];
		$purchaseprice = $res1["purchaseprice"];
		$rateperunit = $res1["rateperunit"];
		$expiryperiod = $res1["expiryperiod"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		$taxname = $res1["taxname"];
		$taxanum = $res1["taxanum"];
		$packagename = $res1["packagename"];
		$packagename = stripslashes($packagename);
		$packageanum = $res1["packageanum"];
		if ($expiryperiod != '0') 
		{ 
			$expiryperiod = $expiryperiod.' Months'; 
		}
		else
		{
			$expiryperiod = ''; 
		}
		
		$query6 = "select * from master_tax where auto_number = '$taxanum'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$res6 = mysql_fetch_array($exec6);
		$res6taxpercent = $res6["taxpercent"];
		
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
                        <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
						<a href="additem1pharmacy.php?st=activate&amp;&amp;anum=<?php echo $auto_number; ?>" class="bodytext3">
                          <div align="center" class="bodytext3">Activate</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemcode; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $categoryname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemname; ?></td>
						<td align="left" valign="top"  class="bodytext3"><?php echo $molecularname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $packagename; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $res6taxpercent; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $purchaseprice; ?></span></div></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $rateperunit; ?></span></div></td>
                      </tr>
                      <?php
		}
	}
		?>
                      <tr>
                        <td colspan="8" align="middle" >&nbsp;</td>
                        </tr>
                    </tbody>
                  </table>
              </form>
                </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

