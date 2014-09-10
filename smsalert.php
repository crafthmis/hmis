<?php
	session_start();
	include ("includes/loginverify.php");
	include ("db/db_connect.php");
	date_default_timezone_set('Asia/Calcutta');
	$data = '';
	$status = '';
	$searchdoctor = '';
	$colorloopcount = '';
	$agefrom="";
	$ageto="";
	$mobilenumber = "";
	$value="";
	$check="";
	
	/*if(isset($_POST['check']) && $_POST['check'])
    {
    foreach ($_POST['check'] as $check)
    {
    echo mysql_query("update master_customer set checkbox=1 where auto_number = '" .mysql_real_escape_string($check)."'");
    }
    header("location:smsalertreport.php");
    }*/
	
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});

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
    <td colspan="9" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?></td>
  </tr>
  
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td width="860">
     <form name="form1" id="form1" method="get" action="smsalert.php" onSubmit="return process1()">
	 <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse"bordercolor="#666666" cellspacing="0" cellpadding="4" width="566"     align="left" border="0">
     <tbody>
     <tr bgcolor="#011e6a">
     <td class="bodytext31" bgcolor="#cccccc" colspan="6"><strong>Patient   List </strong></td>
   </tr>
   
    <tr>
	   <td width="15%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Age From </strong></td>
	   <td width="24%" align="left" valign="middle"  bgcolor="#FFFFFF"><input name="agefrom" id="agefrom" value="" style="border: 1px solid #001E6A;" size="20" /></td>
       <td width="8%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Age To</strong> </td>
       <td width="20%" align="left" valign="middle"  bgcolor="#FFFFFF"><input name="ageto" id="ageto" value="" style="border: 1px solid #001E6A;" size="20" /></td>
    </tr>
			  
     <tr>
	    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Gender</strong></td>
	    <td align="left" valign="middle"  bgcolor="#FFFFFF" colspan="6"><select name="gender">
        <option value="">Select Gender</option>
        <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
        </select>
		</td>
	 </tr>   
	   
      <tr>
         <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">
		 <!--  <input type="hidden" name="search" onBlur="return customercodesearch1()" onKeyDown="return customercodesearch2()" id="search" style="border: 1px solid #001E6A; text-transform:uppercase" value="<?php// echo $search ?>" size="20" />--></td>
         <td align="left" valign="top" bordercolor="#F3F3F3" bgcolor="#FFFFFF" colspan="6">
	     <input type="hidden" name="frmflag1" value="frmflag1" />
         <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
         <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
      </tr> 
    </tbody>
  </table>
</form>	
         </td>
         </tr>
	  
<form action="smsalertreport.php" method="post">
      <tr>
         <td>
	  <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" bordercolor="#666666" cellspacing="0" cellpadding="4" width="805" 
      align="left" border="0">
      <tbody>
      <tr>
         <td width="11%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
         <td width="4%" bgcolor="#cccccc" class="bodytext31"><a href="#"></a></td>
         <td width="18%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
         <td width="25%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
         <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
         <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
         <td width="20%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
       </tr>
	   
       <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
          <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
		  <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
          <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
          <td width="14%" align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
          <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
		  <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
        </tr>
		
        <tr>
		   <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><strong>Select all</strong>
             <input type="checkbox" id="selectall"/></td>
           <td class="bodytext31" valign="center" align="left" bgcolor="#ffffff"><strong>No.</strong></td>
           <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Patient Id</strong>
		   </div></td>
           <td align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient Name </strong>           </div></td>
           <td  align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Gender </strong>
		   </div></td>
           <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><div align="left"><strong>Age</strong>
		   </div></td>
           <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><div align="left"><strong> Mobile </strong>
		   </div></td>
        </tr>
		
	    <?php
		    
			if (isset($_REQUEST["gender"])) { $gender = $_REQUEST["gender"]; } else { $gender = ""; }
			if (isset($_REQUEST["age"])) { $age = $_REQUEST["age"]; } else { $age = ""; }
			if (isset($_REQUEST["status"])) { $status = $_REQUEST["status"]; } else { $status = ""; }
			if (isset($_REQUEST["send"])) { $send = $_REQUEST["send"]; } else { $send = ""; }
			if ($send == 'send')
			{
			$value=$_REQUEST["value"];
			}
			if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
			if ($frmflag1 == 'frmflag1')
			{
			$agefrom=$_REQUEST["agefrom"];
			$ageto = $_REQUEST["ageto"];	
			if($gender !="" && $agefrom == "" && $ageto == "")
			{	
			$query2 = "select * from master_customer where gender like '$gender%' and mobilenumber <> '' and mobilenumber REGEXP '^..........$'";
			}
			else
			{
			$query2 = "select * from master_customer where gender like '$gender%' and age between '$agefrom' and '$ageto' and mobilenumber <> '' and mobilenumber REGEXP '^..........$'";
		    }
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2customercode = $res2['customercode'];
			$res2customeranum = $res2['auto_number'];
			$res2customername = $res2['customername'];
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
			
			
			  
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
			$colorcode = '';
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
			<td>
			<?php $checkbox1=mysql_query("select * from master_customer where auto_number = '$res2customeranum'");
			while($row = mysql_fetch_assoc($checkbox1))
			{
			echo '<input type="checkbox" name="check[]" class="case" value="'.$row['auto_number'].'"></td>';
			}
			?></td>
            <td class="bodytext31" valign="center"  align="left"><?php echo $colorloopcount; ?></td>
            <td  align="left" valign="center" class="bodytext31"><div align="center"><?php echo $res2customercode; ?></div></td> 
		    <td  align="left" valign="center" class="bodytext31"> <div align="left"><?php echo $res2customername; ?></div></td>
            <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $res2gender; ?></div></td>
            <td class="bodytext31" valign="center"  align="left"><div align="left">
		    <?php echo $res2age; ?></div>			</td>
            <td class="bodytext31" valign="center"  align="left">
		    <div class="bodytext31">
		    <div align="left"><?php echo $res2mobilenumber1; ?></div>
		    </div></td>
          </tr>
			 <?php
			 }
			 }
			 ?>
			  
              <tr>
			    <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
                <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
              </tr>
				
		      <tr>
                 <td colspan="7" align="middle" valign="top" >
                   
                    <div align="center">
                      <input value="Send" type="submit"/>
                    </div></td>
                </tr>
	    </tbody>
        </table>
		</form>
    </table>

<?php include ("includes/footer1.php"); ?>
</body>
</html>

