<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 



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
        <td width="860"><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1068" 
            align="left" border="0">
          <tbody>
            <tr>
              <td colspan="12" bgcolor="#cccccc" class="bodytext31"><div align="left"><strong>Patients Discharge List - In Patients</strong></div>                </td>
                </tr>
            <tr>
              <td width="2%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="7%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="12%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="12%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="12%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="9%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  <td width="9%" align="left" valign="center"  
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
                  <td width="8%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
                  <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Discharge Date </strong></div></td>
                  <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Discharge Time </strong></div></td>
                  <td width="15%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient </strong></div></td>
                  <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Patient ID </strong></div></td>
                  <td  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>IP Number </strong></div></td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Gender</strong></div></td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong> Age </strong></div></td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Admitted Ward </strong></div></td>
                  <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Print</strong></div></td>
                  <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Summary</strong></div></td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Discharge Status </strong></div></td>
                </tr>
            <?php
			  $colorloopcount = '';
			  $loopcount = '';
			  
			  
			  //$query2 = "select * from master_customer where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' order by customername limit 0, 500";
			  $query2 = "select * from master_patientadmission where dischargecompleted <> '' order by dischargedate desc";// where customername like '%$searchcustomer%' and customercode like '%$customercode%' and status like '%$status%' order by customername limit 0, 500";
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
			  $dischargedate = $res2['dischargedate'];
			  $dischargetime = $res2['dischargetime'];
			  $ipnumber = $res2['ipnumber'];
			  
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
                  <td  align="left" valign="center" class="bodytext31"><div align="left"><?php echo $dischargedate; ?></div></td>
                  <td  align="left" valign="center" class="bodytext31"><div align="left"><?php echo $dischargetime; ?></div></td>
                  <td class="bodytext31" valign="center"  align="left">
                    <div class="bodytext31">
                      <div align="left">
                        <span class="bodytext3">
                      <?php echo $patientname;//.' ('.$patientcode.')'; ?>				  </span>				  </div>
                  </div>				</td>
                  <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $patientcode; ?></div></td>
                  <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $ipnumber; ?></div></td>
                  <td class="bodytext31" valign="center"  align="left"><div align="left">
                  <?php echo $gender; ?></div></td>
                  <td class="bodytext31" valign="center"  align="left">
                    <div class="bodytext31">
                      <div align="left"><?php echo $age; ?></div>
				  </div></td>
                  <td class="bodytext31" valign="center"  align="left">
                  <div align="left"><?php echo $admittedward; ?></div></td>
                  <td  align="left" valign="center" class="bodytext31"><div align="center"> <a href="javascript:loadprintpage1('<?php echo $patientcode; ?>')" class="bodytext3"> <span class="bodytext3"> Print </span> </a> </div></td>
                  <td  align="left" valign="center" class="bodytext31"><div align="center"> <a href="sales1dischargesummary.php?customercode=<?php echo $patientcode; ?>" class="bodytext3"> <span class="bodytext3">Summary</span> </a> </div></td>
                  <td class="bodytext31" valign="center"  align="left">
                  <div align="left"><?php echo strtoupper($dischargecompleted); ?></div></td>
                </tr>
            <?php
			  }
			  //}
			  ?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td  align="left" valign="center" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                  <td  align="left" valign="center" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
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
                  <td  align="left" valign="center" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                  <td  align="left" valign="center" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                </tr>
            </tbody>
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

