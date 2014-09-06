<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$errmsg = "";
$bgcolorcode = "";

$data = '';
$status = '';
$searchcustomer = '';

if (isset($_REQUEST["status"])) { $status = $_REQUEST["status"]; } else { $status = ""; }
//$frmflag1 = $_REQUEST[frmflag1];
if ($status == 'failed')
{
	$errmsg = "Failed. Patient ID Is Not Available In Database.";
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
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
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
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>

<body>
<table width="1500" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
		<form name="form1" id="form1" method="get" action="sales1dischargesummary.php" onSubmit="return process1()">
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="566" align="left" 
            border="0">
            <tbody>
              <tr bgcolor="#011e6a">
                <td class="bodytext31" bgcolor="#cccccc" 
                  colspan="2"><strong>Patient Discharge</strong></td>
              </tr>
              <tr>
                <td colspan="2"  align="left" valign="center" 
                bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; }else if ($bgcolorcode == 'fail') { echo '#AAFF00'; } ?>" class="bodytext31">&nbsp;</td>
                </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Enter  Patient ID </td>
                <td width="79%" align="left" valign="center"  bgcolor="#FFFFFF">
				<input name="customercode" type="text" id="customercode" style="border: 1px solid #001E6A"></td>
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                width="21%" bgcolor="#FFFFFF">&nbsp;</td>
                <td valign="center"  align="left" bgcolor="#FFFFFF"><div align="right">
                    <input type="hidden" name="frmflag1search" value="frmflag1search">
					<input type="submit" value="Search" name="Submit" class="button" style="border: 1px solid #001E6A" />
                    <input type="reset" value="Reset" name="Submit" class="button" style="border: 1px solid #001E6A" />
                </div></td>
              </tr>
            </tbody>
        </table>
		</form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1068" 
            align="left" border="0">
          <tbody>
            <tr>
              <td colspan="10" bgcolor="#cccccc" class="bodytext31"><div align="left"><strong>Patients Admitted List - In Patients </strong></div>
                <a 
                  href="#"></a></td>
              <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td width="2%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><script language="javascript">
				function excelexport1()
				{
					//window.location = "http://www.google.com/"
					window.location = "dbexcelfiles/PatientList.xls"
				}
				</script>
                &nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="12%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Print</strong></div></td>
              <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Edit</strong></div></td>
              <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Dishcarge </strong></div></td>
              <td width="15%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Gender</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong> Age </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Admission Date </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Admission Time </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Admitted Ward </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Discharge Status </strong></div></td>
            </tr>
            <?php
			  $colorloopcount = '';
			  $loopcount = '';
			  
			  
			  //$query2 = "select * from master_customer where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' order by customername limit 0, 500";
			  $query2 = "select * from master_patientadmission where dischargecompleted = ''";// where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' order by customername limit 0, 500";
			  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			  while ($res2 = mysql_fetch_array($exec2))
			  {
			  $res2customeranum = $res2['auto_number'];
			  $patientcode = $res2['patientcode'];
			  $patientname = $res2['patientname'];
			  $gender = $res2['gender'];
			  $age = $res2['age'];
			  $admissiondate = $res2['admissiondate'];
			  $admissiontime = $res2['admissiontime'];
			  $admittedward = $res2['admittedward'];
			  $dischargecompleted = $res2['dischargecompleted'];
			  
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
              <td  align="left" valign="center" class="bodytext31"><div align="center"> <a href="javascript:loadprintpage1('<?php echo $patientcode; ?>')" class="bodytext32"> Print </a> </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center"> <a href="editpatient1.php?customercode=<?php echo $patientcode; ?>" target="_blank" class="bodytext32"> Edit </a> </div></td>
              <td  align="left" valign="center" class="bodytext31"><div align="center"> <a href="patientdischarge2.php?customercode=<?php echo $patientcode; ?>" target="_blank" class="bodytext32"> Discharge </a> </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="left"> <span class="bodytext32"> <?php echo $patientname.' ('.$patientcode.')'; ?> </span> </div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> <?php echo $gender; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="left"><?php echo $age; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $admissiondate; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $admissiontime; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $admittedward; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $dischargecompleted; ?></div></td>
            </tr>
            <?php
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
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

