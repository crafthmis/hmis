<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 

$data = '';
$status = '';
$searchcustomer = '';
$mobilenumber1 = '';
$location = '';
$customercode = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST[frmflag1];
if ($frmflag1 == 'frmflag1')
{
	$searchcustomer = $_REQUEST['searchcustomer'];
	$status = $_REQUEST['status'];
	$location = $_REQUEST['location'];
	$mobilenumber1 = $_REQUEST['mobilenumber1'];
	$customercode = $_REQUEST['customercode'];
	$variable = $_REQUEST['i'];
	
	
}
//$location = $_REQUEST['location'];

$indiatimecheck = date('d-M-Y-H-i-s');
$foldername = "dbexcelfiles";
//$checkfile = $foldername.'/PatientList.xls';
//if(!is_file($checkfile))
//{
$tab = "\t";
$cr = "\n";

//$data = "BILL Number: " . $tab .$billnumber. $tab . $tab . $tab ."BILL PARTICULARS". $tab. $cr. $cr;

$data .= "Patient".$tab."Location" . $tab . "City" . $tab . "Phone1" . $tab . "Phone2" . $tab."Email1". $tab . "Email2" . $tab . "Fax1" . $tab . "Fax2" . $tab . "Address1". $tab . "Address2". $tab . $cr;

$i=0;


$query2 = "select * from master_customer where status like '%$status%'  order by customername";// desc limit 0, 100";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
$res2customeranum = $res2['auto_number'];
$res2customername = $res2['customername'];
//$res2contactperson1 = $res2['contactperson1'];
$res2location = $res2['area'];
$res2phonenumber1 = $res2['phonenumber1'];
$res2phonenumber2 = $res2['phonenumber2'];
$res2emailid1 = $res2['emailid1'];
$res2emailid2 = $res2['emailid2'];
$res2faxnumber1 = $res2['faxnumber'];
$res2faxnumber2 = '';
$res2anum = $res2['auto_number'];
$res2address1 = $res2['address1'];
$res2address2 = $res2['address2'];
$res2city1 = $res2['city'];
$res2customercode = $res2['customercode'];
$res2insurancecompany = $res2['insurancecompany'];

$data .= $res2customername. $tab . $res2location . $tab . $res2city1 . $tab . $res2phonenumber1 . $tab . $res2phonenumber2 . $tab . $res2emailid1 . $tab . $res2emailid2 . $tab . $res2faxnumber1 . $tab . $res2faxnumber2 . $tab . $res2address1 . $tab . $res2address2 . $tab. $cr;		

}			

$data=preg_replace( '/\r\n/', ' ', trim($data) ); //to trim line breaks and enter key strokes.

$fp = fopen($foldername.'/PatientList.xls', 'w+');
fwrite($fp, $data);
fclose($fp);



					


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
<script type="text/javascript">
var i=0;
function increase()
{
	i++;
	alert(i);
	return false;
	
}</script>

<script language="javascript">
function process1()
{
	if (document.form1.searchcustomer.value == "")
	{
		//alert("Please Enter Any Starting Letter Or Search Key Words In Patient Name To Search.");
		//document.form1.searchcustomer.focus();
		//return false;
	}
}

function loadprintpage1(canum)
{
	var varcanum = canum;
	//alert (varqanum);
	window.open("print_renewal1.php?canum="+varcanum+"","Window"+varcanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}

function loadprintpage1(varPatientCode)
{
	var varPatientCode = varPatientCode;
	//alert (varqanum);
	window.open("print_registrationcard1.php?customercode="+varPatientCode+"","Window"+varPatientCode+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}

</script>
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>

<body>
<table width="1800" border="0" cellspacing="0" cellpadding="2">
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
    <td width="99%" valign="top"><table width="1775" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
		<form name="form1" id="form1" method="get" action="searchpatient1hospital.php" onSubmit="return process1()">
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="566" align="left" 
            border="0">
            <tbody>
              <tr bgcolor="#011e6a">
                <td class="bodytext31" bgcolor="#cccccc" 
                  colspan="2"><strong>Patient   List </strong></td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Search Patient ID </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF"><input name="customercode" value="<?php echo $customercode; ?>" type="text" id="customercode" style="border: 1px solid #001E6A"></td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Search Patient Name </td>
                <td width="79%" align="left" valign="center"  bgcolor="#FFFFFF">
				<input name="searchcustomer" value="<?php echo $searchcustomer; ?>" type="text" size="50" style="border: 1px solid #001E6A" /></td>
              </tr>
			  <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Mobile Number </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF">
				<input name="mobilenumber1" value="<?php echo $mobilenumber1;?>" type="text" id="mobilenumber1" style="border: 1px solid #001E6A"></td>
              </tr>
			  <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">location </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF"><input name="location" value="<?php echo $location;?>" type="text" id="location" style="border: 1px solid #001E6A"></td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Status</td>
                <td align="left" valign="center"  bgcolor="#FFFFFF">
				<select name="status" id="status" style="width: 130px;">
                  <option value="">Search All</option>
                  <option value="" selected="selected">Active</option>
                  <option value="Deleted">Deleted</option>
                </select></td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                width="21%" bgcolor="#FFFFFF">&nbsp;</td>
                <td valign="center"  align="left" bgcolor="#FFFFFF"><div align="right">
                    <input type="hidden" name="frmflag1" value="frmflag1">
					<input type="submit" value="Search" name="Submit" class="button" style="border: 1px solid #001E6A" />
                    <input type="reset" value="Reset" name="Submit" class="button" style="border: 1px solid #001E6A" />
                </div></td>
              </tr>
            </tbody>
        </table>
		</form>		</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1750" 
            align="left" border="0">
            <tbody>
              <tr>
                <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc"><a 
                  href="#"></a></td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
				<td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
				<td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
				<td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
				<td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<script language="javascript">
				function excelexport1()
				{
					//window.location = "http://www.google.com/"
					window.location = "dbexcelfiles/PatientList.xls"
				}
				</script>&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
				<td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<!--<input onClick="javascript:excelexport1();" type="button" value="Export To Excel" name="Submit2" class="button" style="border: 1px solid #001E6A" />-->				</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
				<td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
				<td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
				<td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
                <td width="2%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Print</strong></div></td>
                <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Edit</strong></div></td>
				<td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Token</strong></div></td>
                <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>History</strong></div></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Reg Date </strong></div></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Reg Time </strong></div></td>
                <td width="11%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient </strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Patient ID </strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>IPNumber</strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Age</strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Gender </strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Doctor </strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Address</strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong> Location </strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>City</strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Mobile</strong></div></td>
                <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Phone1</strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Email 1 </strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Email 2 </strong></div></td>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Insurance ID </strong></div></td>
				<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Insurance Company </strong></div></td>
				<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>TPA Name </strong></div></td>
				<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Patient Category </strong></div></td>
              </tr>
			  <?php
			  $colorloopcount = '';
			  $loopcount = '';
			  
			  if (isset($_REQUEST["location"])) { $location = $_REQUEST["location"]; } else { $location = ""; }
			  if (isset($_REQUEST["mobilenumber1"])) { $mobilenumber1 = $_REQUEST["mobilenumber1"]; } else { $mobilenumber1 = ""; }
			 	{
				$query2 = "select * from master_customer where area like '%$location%' and mobilenumber like '%$mobilenumber1%' and status like '%$status%' order by auto_number desc limit 0, 500";
			  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			  while ($res2 = mysql_fetch_array($exec2))
			  {
			  $res2customercode = $res2['customercode'];
			  $res2customeranum = $res2['auto_number'];
			  $res2customername = $res2['customername'];
			  //$res2contactperson1 = $res2['contactperson1'];
			  $res2location = $res2['area'];
			  $res2mobilenumber1 = $res2['mobilenumber'];
			  $res2phonenumber1 = $res2['phonenumber1'];
			  $res2phonenumber2 = $res2['phonenumber2'];
			  $res2emailid1 = $res2['emailid1'];
			  $res2emailid2 = $res2['emailid2'];
			  $res2faxnumber1 = $res2['faxnumber'];
			  $res2faxnumber2 = '';
			  $res2anum = $res2['auto_number'];
			  $res2address1 = $res2['address1'];
			  $res2city1 = $res2['city'];
			  $res2openingbalance1 = $res2['openingbalance'];
			  $res2insuranceid = $res2['insuranceid'];
			  $res2registrationdate = $res2['registrationdate'];
			  if ($res2registrationdate == '0000-00-00') $res2registrationdate = '';
			  $res2registrationtime = $res2['registrationtime'];
			  $res2age = $res2['age'];
			  $res2gender = $res2['gender'];
			  $res2consultingdoctor = $res2['consultingdoctor'];
			  $query201 = "select * from master_doctor where doctorcode = '$res2consultingdoctor'";
			  $exec201 = mysql_query($query201) or die ("Error in Query201".mysql_error());
			  $res201 = mysql_fetch_array($exec201);
			  $res2consultingdoctor = $res201['doctorname'];
			  
			  $query3 = "select * from master_patientadmission where patientcode = '$res2customercode' order by auto_number desc limit 0, 1";
			  $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			  $res3 = mysql_fetch_array($exec3);
			  $res3ipnumber = $res3['ipnumber'];
			  
				if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
				if (isset($_REQUEST["searchcustomer"])) { $searchcustomer = $_REQUEST["searchcustomer"]; } else { $searchcustomer = ""; }
				
				if (isset($_REQUEST["status"])) { $status = $_REQUEST["status"]; } else { $status = ""; }

				/*
				if ($frmflag1 == 'frmflag1')
				{
	
				  //$searchcustomer = $_REQUEST[searchcustomer];
				  //$status = $_REQUEST[status];
				  
				  $query2 = "select * from master_customer where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' limit 0, 500";
				}
				else
				{
				  $query2 = "select * from master_customer where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' order by customername limit 0, 500";// desc limit 0, 100";
				}
				*/
			  
			  $query2 = "select * from master_customer where customername like '%$searchcustomer%' and customercode like '%$customercode%' and area like '%$location%' and mobilenumber like '%$mobilenumber1%' and status like '%$status%' order by auto_number desc limit 0, 500";
			  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			  while ($res2 = mysql_fetch_array($exec2))
			  {
			  $res2customercode = $res2['customercode'];
			  $res2customeranum = $res2['auto_number'];
			  $res2customername = $res2['customername'];
			  //$res2contactperson1 = $res2['contactperson1'];
			  $res2location = $res2['area'];
			  $res2mobilenumber1 = $res2['mobilenumber'];
			  $res2phonenumber1 = $res2['phonenumber1'];
			  $res2phonenumber2 = $res2['phonenumber2'];
			  $res2emailid1 = $res2['emailid1'];
			  $res2emailid2 = $res2['emailid2'];
			  $res2faxnumber1 = $res2['faxnumber'];
			  $res2faxnumber2 = '';
			  $res2anum = $res2['auto_number'];
			  $res2address1 = $res2['address1'];
			  $res2city1 = $res2['city'];
			  $res2openingbalance1 = $res2['openingbalance'];
			  $res2insuranceid = $res2['insuranceid'];
			  $res2registrationdate = $res2['registrationdate'];
			  $res2insurancecompanyname = $res2['insurancecompany'];
			  if ($res2registrationdate == '0000-00-00') $res2registrationdate = '';
			  $res2registrationtime = $res2['registrationtime'];
			  $res2age = $res2['age'];
			  $res2gender = $res2['gender'];
			  $res2consultingdoctor = $res2['consultingdoctor'];
			  $res2insurancecompany = $res2['insurancecompany'];
			  $res2tpaname = $res2['tpa'];
			  $res2patientcategory = $res2['patientcategory'];
			  
			  $query201 = "select * from master_doctor where doctorcode = '$res2consultingdoctor'";
			  $exec201 = mysql_query($query201) or die ("Error in Query201".mysql_error());
			  $res201 = mysql_fetch_array($exec201);
			  $res2consultingdoctor = $res201['doctorname'];
			  $res2insurancecompanyname = 
			  
			  $query3 = "select * from master_patientadmission where patientcode = '$res2customercode' order by auto_number desc limit 0, 1";
			  $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			  $res3 = mysql_fetch_array($exec3);
			  $res3ipnumber = $res3['ipnumber'];
			  
			  $colorloopcount = $colorloopcount + 1;
			  $showcolor = ($colorloopcount & 1); 
			  $colorcode = '';
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
                <td class="bodytext31" valign="center"  align="left"><?php echo $colorloopcount; ?></td>
                <td  align="left" valign="center" class="bodytext31">
				<div align="center">
				<a href="javascript:loadprintpage1('<?php echo $res2customercode; ?>')" class="bodytext3">
				<span class="bodytext3">
				Print				</span>				</a>				</div>				</td>
                <td class="bodytext31" valign="center"  align="left">
				<div align="center">
				<a href="editpatient1.php?customercode=<?php echo $res2customercode; ?>" class="bodytext3">
				<span class="bodytext3">Edit</span>				</a>				</div>				</td>
				<td  align="left" valign="center" class="bodytext31"><div align="center">
				<span class="bodytext3" onClick="increase();">Token</span>
				 </td>
                <td  align="left" valign="center" class="bodytext31"><div align="center">
				 <a href="patienthistory1.php?customercode=<?php echo $res2customercode; ?>" class="bodytext3"> 
				 <span class="bodytext3">History</span> </a> </div>
				 </td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"> <span class="bodytext3"> <?php echo $res2registrationdate; ?> </span> </div>
                </div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"> <span class="bodytext3"> <?php echo $res2registrationtime; ?> </span> </div>
                </div></td>
                <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31">
                  <div align="left">
				  <span class="bodytext3">
				  <?php echo $res2customername; //.' ('.$res2customercode.')'; ?>				  </span>				  </div>
                </div>				</td>
                <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $res2customercode; ?></div></td>
                <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $res3ipnumber; ?></div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"><?php echo round($res2age, 2); ?></div>
                </div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"><?php echo $res2gender; ?></div>
                </div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"><?php echo $res2consultingdoctor; ?></div>
                </div></td>
                <td class="bodytext31" valign="center"  align="left"><div align="left">
				<?php echo $res2address1; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				<div class="bodytext31">
				  <div align="left"><?php echo $res2location; ?></div>
				</div></td>
                <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2city1; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2mobilenumber1; ?></div></td>
                <td  align="left" valign="center" class="bodytext31"><div align="left"><?php echo $res2phonenumber1; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2emailid1; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2emailid2; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2insuranceid; ?></div></td>
				<td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2insurancecompany; ?></div></td>
				<td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2tpaname; ?></div></td>
				  <td class="bodytext31" valign="center"  align="left">
				  <div align="left"><?php echo $res2patientcategory; ?></div></td>
              </tr>
			  <?php
			  }
			  }
			  }
			  //}
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

