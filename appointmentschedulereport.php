<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 

$data = '';
$status = '';
$searchcustomer = '';
$mobilenumber1 = '';
$location = '';
$customercode = '';

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["ADate1"])) { $ADate1 = $_REQUEST["ADate1"]; } else { $ADate1 = ""; }
if (isset($_REQUEST["ADate2"])) { $ADate2 = $_REQUEST["ADate2"]; } else { $ADate2 = ""; }

if ($ADate1 != '' && $ADate2 != '')
{
	$transactiondatefrom = $_REQUEST['ADate1'];
	$transactiondateto = $_REQUEST['ADate2'];
}
else
{
	$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
	$transactiondateto = date('Y-m-d');
}

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$searchcustomer = $_REQUEST['searchcustomer'];	
}

$indiatimecheck = date('d-M-Y-H-i-s');
$foldername = "dbexcelfiles";

$tab = "\t";
$cr = "\n";

$data .= "Patient".$tab."Doctor" . $tab . "App Date" . $tab . "App Time" . $tab . $cr;
$i=0;

$query31 = "select * from appointmentschedule_entry where patientname = '$searchcustomer'";
$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
while ($res31 = mysql_fetch_array($exec31))
{
$res31patientname = $res31['patientname'];
$res31appointmentdate = $res31['appointmentdate'];
$res31appointmenttime = $res31['appointmenttime'];
$res31consultingdoctor = $res31['consultingdoctor'];

$data .= $res31patientname. $tab . $res31appointmentdate . $tab . $res31appointmenttime . $tab . $res31consultingdoctor;		

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
<script src="js/datetimepicker_css.js"></script>
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
		
		<form name="form1" id="form1" method="get" action="appointmentschedulereport.php" onSubmit="return process1()">
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="566" align="left" 
            border="0">
            <tbody>
              <tr bgcolor="#011e6a">
                <td class="bodytext31" bgcolor="#cccccc" 
                  colspan="2"><strong>Appointment Schedule Report</strong></td>
              </tr>
              <!--<tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Search Patient ID </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF"><input name="customercode" value="<?php echo $customercode; ?>" type="text" id="customercode" style="border: 1px solid #001E6A"></td>
              </tr>-->
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Search Patient Name </td>
                <td width="79%" align="left" valign="center"  bgcolor="#FFFFFF">
				<input name="searchcustomer" value="<?php echo $searchcustomer; ?>" type="text" size="50" style="border: 1px solid #001E6A" /></td>
              </tr>
			  <tr>
		  <td width="76" align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"> Date From </td>
          <td width="123" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php //echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/></td>
			</tr>
			<tr>
          <td width="51" align="left" valign="center"  bgcolor="#FFFFFF" class="style1"><span class="bodytext31"> Date To </span></td>
          <td width="129" align="left" valign="center"  bgcolor="#ffffff"><span class="bodytext31"><input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php //echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
		  </span></td>
			    </tr>
			  <!--<tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Mobile Number </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF">
				<input name="mobilenumber1" value="<?php echo $mobilenumber1;?>" type="text" id="mobilenumber1" style="border: 1px solid #001E6A"></td>
              </tr>-->
			 <!-- <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">location </td>
                <td align="left" valign="center"  bgcolor="#FFFFFF"><input name="location" value="<?php echo $location;?>" type="text" id="location" style="border: 1px solid #001E6A"></td>
              </tr>-->
              <!--<tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">Status</td>
                <td align="left" valign="center"  bgcolor="#FFFFFF">
				<select name="status" id="status" style="width: 130px;">
                  <option value="">Search All</option>
                  <option value="" selected="selected">Active</option>
                  <option value="Deleted">Deleted</option>
                </select></td>
              </tr>-->
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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="566" 
            align="left" border="0">
            <tbody>
              <tr>
                <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" bgcolor="#cccccc">&nbsp;</td>
                <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
				<td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<!--<input onClick="javascript:excelexport1();" type="button" value="Export To Excel" name="Submit2" class="button" style="border: 1px solid #001E6A" />--></td>
                <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                
              </tr>
              <tr>
                <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
				<td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient </strong></div></td>
				<td width="7%" align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Doctor </strong></div></td>
				<td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Mobile Number </strong></div></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> App Date </strong></div></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> App Time </strong></div></td>
              </tr>
			  <?php
			  $colorloopcount = '';
			  $loopcount = '';
			  
			  if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
			  if (isset($_REQUEST["searchcustomer"])) { $searchcustomer = $_REQUEST["searchcustomer"]; } else { $searchcustomer = ""; }
			  if (isset($_REQUEST["status"])) { $status = $_REQUEST["status"]; } else { $status = ""; }
			  
			  $query2 = "select * from appointmentschedule_entry where patientname like '%$searchcustomer%' and appointmentdate between '$transactiondatefrom' and '$transactiondateto' order by auto_number desc limit 0, 500";
			  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			  while ($res2 = mysql_fetch_array($exec2))
			  {
			  $res2patientname = $res2['patientname'];
			  $res2appointmentdate = $res2['appointmentdate'];
			  $res2appointmenttime = $res2['appointmenttime'];
			  $res2consultingdoctor = $res2['consultingdoctor'];
			  $res2mobilenumber = $res2['mobilenumber'];
			 
			  $query201 = "select * from master_doctor where auto_number = '$res2consultingdoctor'";
			  $exec201 = mysql_query($query201) or die ("Error in Query201".mysql_error());
			  $res201 = mysql_fetch_array($exec201);
			  $res2consultingdoctor1 = $res201['doctorname'];
			 	 
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
                <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31">
                  <div align="left">
				  <span class="bodytext3">
				  <?php echo $res2patientname; //.' ('.$res2customercode.')'; ?>				  </span>				  </div>
                </div>				</td>
				<td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"><?php echo $res2consultingdoctor1; ?></div>
                </div></td>
				<td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"><?php echo $res2mobilenumber; ?></div>
                </div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"> <span class="bodytext3"> <?php echo $res2appointmentdate; ?> </span> </div>
                </div></td>
                <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                    <div align="left"> <span class="bodytext3"> <?php echo $res2appointmenttime; ?> </span> </div>
                </div></td> 
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
                </tr>
            </tbody>
        </table></td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

