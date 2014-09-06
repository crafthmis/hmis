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
$registrationtime = date('H:i:s');

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$customercode=$_REQUEST["customercode"];
	$customername = $_REQUEST["customername"];
	//$customername = strtoupper($customername);
	$customername = trim($customername);
	$customername = addslashes($customername);
	$gender = $_REQUEST["gender"];
	$age = $_REQUEST["age"];
	$typeofcustomer='';
	$address1=$_REQUEST["address1"];
	$address2=$_REQUEST["address2"];
	$area = $_REQUEST["area"];
	$city  = $_REQUEST["city"];
	$state  = $_REQUEST["state"];
	$pincode = $_REQUEST["pincode"];
	$country = $_REQUEST["country"];
	$phonenumber1 = $_REQUEST["phonenumber1"];
	$phonenumber2 = $_REQUEST["phonenumber2"];
	$emailid1  = $_REQUEST["emailid1"];
	$emailid2 = $_REQUEST["emailid2"];
	$faxnumber = '';
	$mobilenumber  = $_REQUEST["mobilenumber"];
	$remarks='';
	$status='';
	$tinnumber=$_REQUEST["tinnumber"];
	$cstnumber=$_REQUEST["cstnumber"];
	$openingbalance=$_REQUEST["openingbalance"];
	$insuranceid=$_REQUEST["insuranceid"];
	$nameofrelative = $_REQUEST['nameofrelative'];
	$dateofbirth = $_REQUEST['dateofbirth'];
	$maritalstatus = $_REQUEST['maritalstatus'];
	$consultingdoctor = $_REQUEST['consultingdoctor'];
	$bloodgroup = $_REQUEST['bloodgroup'];
	$registrationdate = $_REQUEST['registrationdate'];
	$registrationtime = $_REQUEST['registrationtime'];
	$consultationfees = $_REQUEST['consultationfees'];
	$insurancecompany = $_REQUEST['insurancecompany'];
	$insurancecompanyname = $_REQUEST['insurancecompanyname'];
	$insurancecompanycode = $_REQUEST['insurancecompanycode'];
	$patientcategory = $_REQUEST['patientcategory'];
	$tpa = $_REQUEST['tpaname'];
	//$auto_number = $_REQUEST['auto_number'];
	
	
		
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
				$query1 = "insert into master_customer (customercode,customername,typeofcustomer,address1,address2,
				area,city,state,country,pincode,phonenumber1,phonenumber2,faxnumber,mobilenumber,emailid1, emailid2,
				remarks, status, tinnumber, cstnumber, openingbalance, insuranceid, 
				gender, age, nameofrelative, dateofbirth, maritalstatus, consultingdoctor, bloodgroup, registrationdate, registrationtime, consultationfees, insurancecompany, patientcategory, tpa) 
				values('$customercode','$customername','$typeofcustomer','$address1','$address2','$area','$city',
				'$state','$country','$pincode','$phonenumber1','$phonenumber2','$faxnumber','$mobilenumber','$emailid1',
				'$emailid2','$remarks','$status', '$tinnumber', '$cstnumber', '$openingbalance', '$insuranceid', 
				'$gender', '$age', '$nameofrelative', '$dateofbirth', '$maritalstatus', '$consultingdoctor', '$bloodgroup', '$registrationdate', '$registrationtime', '$consultationfees', '$insurancecompany', '$patientcategory', '$tpa')";
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
				$query1 = "insert into master_customer (customercode,customername,typeofcustomer,address1,address2,
				area,city,state,country,pincode,phonenumber1,phonenumber2,faxnumber,mobilenumber,emailid1, emailid2,
				remarks, status, tinnumber, cstnumber, openingbalance, insuranceid, 
				gender, age, nameofrelative, dateofbirth, maritalstatus, consultingdoctor, bloodgroup, registrationdate, registrationtime, consultationfees, insurancecompany, patientcategory, tpa) 
				values('$customercode','$customername','$typeofcustomer','$address1','$address2','$area','$city',
				'$state','$country','$pincode','$phonenumber1','$phonenumber2','$faxnumber','$mobilenumber','$emailid1',
				'$emailid2','$remarks','$status', '$tinnumber', '$cstnumber', '$openingbalance', '$insuranceid', 
				'$gender', '$age', '$nameofrelative', '$dateofbirth', '$maritalstatus', '$consultingdoctor', '$bloodgroup', '$registrationdate', '$registrationtime', '$consultationfees', '$insurancecompany', '$patientcategory', '$tpa')";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				
				$status = 'success';
		}
		
			
			
		$companyname = '';
		$gender = '';
		$age = '';
		$title1  = '';
		$title2  = '';
		$contactperson1  = '';
		$contactperson2 = '';
		$designation1 = '';
		$designation2  = '';
		$phonenumber1 = '';
		$phonenumber2 = '';
		$emailid1  = '';
		$emailid2 = '';
		$faxnumber1 = '';
		$faxnumber2  = '';
		$address = '';
		$location = '';
		$city  = '';
		$state = '';
		$pincode = '';
		$country = '';
		$tinnumber = '';
		$cstnumber = '';
		$companystatus  = '';
		$openingbalance = '0.00';
		$insuranceid = '';
		$nameofrelative = '';
		$dateposted = $updatedatetime;
		$dateofbirth = '';
		$maritalstatus = '';
		$consultingdoctor = '';
		$bloodgroup = '';
		$consultationfees = '';
		$insurancecompany = '';
		$patientcategory = ''; 
		$tpa = '';
		
		header("location:addpatient1.php?st=$status");
		//exit;
	}
	else
	{
		header ("location:addpatient1.php?st=$status");
	}

}
else
{
	$companyname = "";
	$gender = '';
	$age = '';
	$title1  = "";
	$title2  = "";
	$contactperson1  = "";
	$contactperson2 = "";
	$designation1 = "";
	$designation2  = "";
	$phonenumber1 = "";
	$phonenumber2 = "";
	$emailid1  = "";
	$emailid2 = "";
	$faxnumber1 = "";
	$faxnumber2  = "";
	$address1 = "";
	$address2 = "";
	$location = "";
	$city  = "";
	$pincode = "";
	$country = "";
	$state = "";
	$tinnumber = "";
	$cstnumber = "";
	$companystatus  = "";
	$openingbalance = "";
	$insuranceid = "";
	$nameofrelative = '';
	$dateposted = $updatedatetime;
	$dateofbirth = '';
	$maritalstatus = '';
	$consultingdoctor = '';
	$bloodgroup = '';
	$consultationfees = '';
	$insurancecompany = '';
	$patientcategory = '';
	$tpa = '';
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
function funcInsuranceTypeChange()
{
	<?php
	$query11 = "select * from master_insurancecompany group by insurancecompanyname order by insurancecompanyname";
	$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
	while ($res11 = mysql_fetch_array($exec11))
	{
	$statename = $res11["insurancecompanyname"];
	?>
	
		if(document.form1.insurancecompany.value=="<?php echo $statename; ?>")
		{
		
		document.getElementById("tpaname").options.length=null; 
		var combo = document.getElementById('tpaname'); 
		<?php 
		$loopcount=0;
		?>
		combo.options[<?php echo $loopcount;?>] = new Option ("Select TPA", ""); 
		<?php
		$query10="select * from master_tpa where insurancecompany = '$statename' group by tpaname order by tpaname asc";
		$exec10=mysql_query($query10) or die ("error in query10".mysql_error());
		while ($res10=mysql_fetch_array($exec10))
		{
		$loopcount=$loopcount+1;
		$city1=$res10["tpaname"];
		?>
		var a ="<?php echo $city1; ?>";
		combo.options[<?php echo $loopcount;?>] = new Option (a, a); 
		<?php 
		}
		?>
		}
	<?php
	}
	?>
}


	/*var a ="<?php //echo $res12paymenttypeanum; ?>";
	alert(a);*/
	//alert(document.getElementById("insurancecompany").value);
	
	

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
.bodytext312 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function process1()
{

	if (document.form1.customercode.value == "")
	{
		alert ("Patient Code Cannot Be Empty.");
		document.form1.customercode.focus();
		return false;
	}
	if (document.form1.customername.value == "")
	{
		alert ("Patient Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	
	if (document.form1.patientcategory.value == "INSURANCE")
	{
		if (document.form1.insurancecompany.value == "")
	{
		alert ("Insurance Company Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	if (document.form1.tpaname.value == "")
	{
		alert ("TPA Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	}
	
/*	else if (document.form1.address1.value == "")
	{
		alert ("Address1  Cannot Be Empty.");
		document.form1.address1.focus();
		return false;
	}
	else if (document.form1.state.value == "")
	{
		alert ("State Cannot Be Empty.");
		document.form1.state.focus();
		return false;
	}
	else if (document.form1.city.value == "")
	{
		alert ("City Cannot Be Empty.");
		document.form1.city.focus();
		return false;
	}
*/
	else if (document.form1.gender.value == "")
	{
		alert ("Please Select Gender.");
		document.form1.gender.focus();
		return false;
	}
	else if (document.form1.age.value == "")
	{
		alert ("Please Select Age.");
		document.form1.age.focus();
		return false;
	}
	if (isNaN(document.form1.age.value))
	{
		alert ("Age Can Only Be Numbers.");
		document.form1.age.focus();
		return false;
	}
/*
	else if (isNaN(document.getElementById("pincode").value))
	{
		alert ("Pincode Can Only Be Numbers");
		return false;
	}
	else if (document.form1.emailid1.value != "")
	{
		if (document.form1.emailid1.value.indexOf('@')<= 0 || document.form1.emailid1.value.indexOf('.')<= 0)
		{
			window.alert ("Please Enter valid Mail Id");
			document.form1.emailid1.value = "";
			document.form1.emailid1.focus();
			return false;
		}
	}
	else if (document.form1.emailid2.value != "")
	{
		if (document.form1.emailid2.value.indexOf('@')<= 0 || document.form1.emailid2.value.indexOf('.')<= 0)
		{
			window.alert ("Please Enter valid Mail Id");
			document.form1.emailid2.value = "";
			document.form1.emailid2.focus();
			return false;
		}
	}
*/
	if (document.form1.openingbalance.value == "")
	{
		alert ("Opening Balance Cannot Be Empty.");
		document.form1.openingbalance.value = "0.00";
		document.form1.openingbalance.focus();
		return false;
	}
	if (isNaN(document.form1.openingbalance.value))
	{
		alert ("Opening Balance Can Only Be Numbers.");
		document.form1.openingbalance.focus();
		return false;
	}
	//return false;
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


      	  <form name="form1" id="form1" method="post" onKeyDown="return disableEnterKey()" enctype="multipart/form-data" action="addpatient1.php" onSubmit="return process1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="800" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong> New Patient Registration </strong></td>
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
				<input name="customername" id="customername" value="<?php echo $companyname; ?>" style="border: 1px solid #001E6A;" size="45"></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Registration Date </td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input type="text" name="registrationdate" id="registrationdate" value="<?php echo $registrationdate; ?>" readonly="readonly" style="border: 1px solid #001E6A;">
                  <strong><span class="bodytext312"> 
				  <img src="images2/cal.gif" onClick="javascript:NewCssCal('registrationdate')" style="cursor:pointer"/> 
				  </span></strong
				  ></td>
				</tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Name of Relative </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0">
				  <input name="nameofrelative" id="nameofrelative" value="<?php echo $nameofrelative; ?>" style="border: 1px solid #001E6A;" size="45"></td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Registration Time </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><input type="text" name="registrationtime" id="registrationtime" value="<?php echo $registrationtime; ?>" style="border: 1px solid #001E6A;"></td>
			    </tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Age</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><input type="text" name="age" id="age" value="" style="border: 1px solid #001E6A;">
                      <!--				  
				  <select name="age">
                    <option value="">Select Age</option>
					<?php
					for ($i=0;$i<=125;$i++)
					{
					?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
                  </select>				  
-->                  </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Date Of Birth </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><input type="text" name="dateofbirth" id="dateofbirth" value="" style="border: 1px solid #001E6A;"></td>
			      </tr>
			    <tr>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Gender</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><select name="gender">
                      <option value="" selected="selected">Select Gender</option>
                      <option value="MALE">MALE</option>
                      <option value="FEMALE">FEMALE</option>
                    </select>                  </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Marital Status </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><select name="maritalstatus">
                      <option value="" selected="selected">Select Marital Status</option>
                      <option value="SINGLE">SINGLE</option>
                      <option value="MARRIED">MARRIED</option>
                    </select>                  </td>
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
			      <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Blood Group </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><input type="text" name="bloodgroup" id="bloodgroup" value="" style="border: 1px solid #001E6A;"></td>
			    </tr>
			    <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address 1 </td>
			    <td width="39%" align="left" valign="middle"  bgcolor="#E0E0E0"><input name="address1" id="address1" value="<?php echo $address1; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
                <td width="17%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address 2 </td>
                <td width="29%" align="left" valign="middle"  bgcolor="#E0E0E0"><input name="address2" id="address2" value="<?php echo $address2; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
			  </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext31"><span class="bodytext32">State </span></span></td>
                <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="state" id="state" value="<?php echo $state; ?>" style="border: 1px solid #001E6A"  size="20" />
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
				<input name="city" id="city" value="<?php echo $city; ?>" style="border: 1px solid #001E6A"  size="20" />
<!--				
				<select name="city" id="city" >
                  <option value="">Select City</option>
                </select>
-->				   </td>
              </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Area</span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
				     <input name="area" id="area" value="<?php echo $location; ?>" style="border: 1px solid #001E6A;"  size="20" />
				   </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Country </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="country" id="country" value="<?php echo $country; ?>" style="border: 1px solid #001E6A"  size="20" />
<!--				
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
-->				   </td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Pincode</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="pincode" id="pincode" value="<?php echo $pincode; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Mobile Number </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="mobilenumber" id="mobilenumber" value="<?php echo $faxnumber2; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
				 </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Phone Number 1  </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="phonenumber1" id="phonenumber1" value="<?php echo $phonenumber1; ?>" style="border: 1px solid #001E6A;" size="20" /></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Phone Number 2 </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="phonenumber2" id="phonenumber2" value="<?php echo $phonenumber2; ?>" style="border: 1px solid #001E6A;"  size="20"></td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Email Id 1 </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="emailid1" id="emailid1" value="<?php echo $emailid1; ?>" style="border: 1px solid #001E6A"  size="20">
			        <input type="hidden" name="tinnumber" id="tinnumber" value="<?php echo $tinnumber; ?>" style="border: 1px solid #001E6A;text-transform: uppercase;"  size="20" /></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Email Id 2 </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="emailid2" id="emailid2" value="<?php echo $emailid2; ?>" style="border: 1px solid #001E6A"  size="20">
			        <input type="hidden" name="cstnumber" id="cstnumber" value="<?php echo $cstnumber; ?>" style="border: 1px solid #001E6A; text-transform: uppercase;"  size="20" /></td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Insurance ID </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="insuranceid" id="insuranceid" value="<?php echo $insuranceid; ?>" style="border: 1px solid #001E6A;"  size="20"></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Patient Code </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><input name="customercode" id="customercode" value="<?php echo $customercode; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="20">
                       <input type="hidden" name="openingbalance" id="openingbalance" value="<?php echo $openingbalance; ?>" style="border: 1px solid #001E6A; text-align:right" size="20"></td>
				 </tr>
				 
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Consultation Fees </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="consultationfees" id="consultationfees" value=""  style="border: 1px solid #001E6A;"  size="20" readonly="readonly" /></td>
				    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Insurance Company </td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><strong>
                    <select name="insurancecompany" id="insurancecompany" onChange="return funcInsuranceTypeChange()" >
					 <option value="" selected="selected">Select Company</option>
                      <?php 
				        $query52="select * from master_insurancecompany";
				        $exec52=mysql_query($query52) or die(mysql_error());
				        while($res52=mysql_fetch_array($exec52))
				        {
				        //$res52anum=$res52["auto_number"];
				        $res52insurancecompanyname=$res52["insurancecompanyname"];
				      ?>
 				  <option value="<?php echo $res52insurancecompanyname; ?>" ><?php echo $res52insurancecompanyname; ?></option>
				      <?php
				       }
				      ?>
                    </select>
                  </strong></td>
				   </tr>
				   
				   <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Patient Category</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><select name="patientcategory">
                      <option value="" selected="selected">Select Category</option>
                      <option value="CASE">CASH</option>
                      <option value="INSURANCE">INSURANCE</option>
                    </select>                  </td>
					<td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">TPA</td>
			      <td align="left" valign="middle"  bgcolor="#E0E0E0"><strong>
                    <select name="tpaname" id="tpaname" >
					 <option value="" selected="selected">Select TPA</option>
                    </select>
                  </strong></td>
				   </tr>
				   
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Upload Photo </td>
				   <td colspan="3" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">
                     <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                     <input type="file" name="browse1" value="" size="20" style="border: 1px solid #001E6A"/>
                     <strong>Only JPG or JPEG Files Allowed. </strong>
				   &nbsp;</td>
			      </tr>
				 <tr>
				   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			      </tr>
                 <tr>
                <td colspan="4" align="middle"  bgcolor="#E0E0E0"><div align="right"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input type="hidden" name="frmflag1" value="frmflag1" />
                  <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                  <input name="Submit222" type="submit"  value="Save Patient" class="button" style="border: 1px solid #001E6A"/>
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

