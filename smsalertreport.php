<?php

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$sno = '';
$data = '';
$status = '';
$searchdoctor = '';
$colorloopcount = '';
$agefrom="";
$ageto="";
$mobilenumber = "";

//Code using fopen

//API stands for Application Programming Integration which is widely used to integrate and 
//enable interaction with other software, much in the same way as a user interface facilitates interaction 
//between humans and computers. Our API codes can be easily integrated to any web or software application. 

//Change your configurations here.
//---------------------------------
$uid=""; //your uid
$pin=""; //your api pin
$sender="sender"; // approved sender id
$domain="smsalertbox.com"; // connecting url 
$route="1";// 0-Normal,1-Priority
$method="POST";

//---------------------------------

if(isset($_REQUEST['send']))
{
foreach($_POST['mobile'] as $key=>$value){	
			//echo '<br>'.
	$autonumber = $_REQUEST['autonumber'][$key];
	 $mobile=$_POST['mobile'][$key];
	 $customercode = $_REQUEST['customercode'][$key];
	 $customername = $_REQUEST['customername'][$key];
	 $age = $_REQUEST['age'][$key];
	 $gender = $_REQUEST['gender'][$key];
	 $message=$_REQUEST['message'];

	$uid=urlencode($uid);
	$pin=urlencode($pin);
	$sender=urlencode($sender);
	$message=urlencode($message);
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&mobile=$mobile&message=$message ";

	if($method=="POST")
	{
		$opts = array(
		'http'=>array('method'=>"$method", 'content' => "$parameters",'header'=>"Accept-language: en\r\n" ."Cookie: foo=bar\r\n")
	);
		$context = stream_context_create($opts);

		$fp = @fopen("http://$domain/api/sms.php", "r", false, $context);
	}
	else
	{
		$fp = fopen("http://$domain/api/sms.php?$parameters", "r");
	}

		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);

	if(is_numeric($response))
 	 {		
	 
		$query4 = "insert into smsdetails(autonumber,customercode,customername,gender,age,message,mobilenumber,messageid,username,companyanum,ipaddress,lastupdatetime) 
		values('$autonumber','$customercode','$customername','$gender','$age','$message','$mobile','$response','$username','$companyanum','$ipaddress','$updatedatetime')";
		$exec4 = mysql_query($query4) or die("Error in Query4".mysql_error());
		
	}
	else
	{
		header("location:smsalertreport.php?st=failed");			 
		exit;
	}

	
?>


<?php
			

/*	if($response=="")
	echo "Process Failed, Please check your connecting domain, username or password.";
	else
	echo "Message Id : $response"; 
	Returning the message id  :  Whenever you are sending an SMS our system will give a message id for each numbers, 
	which can be saved into your database and in future by calling these message id's using correct API's you can 
	update the delivery status.
*/
}
		header("location:smsalertreport.php?st=success");			 
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
<script language="javascript" type="text/javascript"> 
var maxAmount = 160;
function textCounter(textField, showCountField) {
    if (textField.value.length > maxAmount) {
        textField.value = textField.value.substring(0, maxAmount);
	} else { 
        showCountField.value = maxAmount - textField.value.length;
	}
}
</script>
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration: none; }
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
    <td width="0%">&nbsp;</td>
    <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td>
	 <form name='f1' method='post'>
	 <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse"bordercolor="#666666" cellspacing="0" cellpadding="4" width="568" 
     align="left" border="0">
     <tbody>
	 
  <tr bgcolor="#011E6A">
     <td colspan="6" bgcolor="#CCCCCC" class="bodytext3"><strong>Sms Alert Report </strong></td>
  </tr>
  
			 <?php
			for ($i=1;$i<=1000;$i++)
			{
		    if (isset($_REQUEST["auto_number".$i]))
		    {
			$auto_number = $_REQUEST["auto_number".$i];
		    }
			else
		    {
			$auto_number = "";
		    }
			if ($auto_number != '')
	     	{
			$customercode = $_REQUEST["customercode".$i];
			$query31 = "select * from master_customer where customercode = '$customercode'"; 
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$res31customercode = $res31["customercode"];
			$res31auto_number = $res31["auto_number"];
			}
			}
			?>
			
   <tr>
	   <td width="26" align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
       <td width="118" align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Patient Id</strong></div>       </td>
	  <td width="149" align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong> Patient Name </strong></div></td>
       <td width="86"  align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Gender </strong></div></td>
       <td width="46"  align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Age</strong></div></td>
      <td width="78"  align="left" valign="center" bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Mobile </strong></div></td>
   </tr>
   
			  <?php

			  if(isset($_POST['check']) && $_POST['check'])
	          {
	          foreach($_POST['check'] as $value)
	          {
			  $query2 = "select * from master_customer where auto_number='$value'";
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
          <td class="bodytext31" valign="center"  align="left"><input name='autonumber[]' type="hidden" value='<?php echo $colorloopcount; ?> ' >
		  <?php echo $colorloopcount; ?></td>
          <td  align="left" valign="center" class="bodytext31"><input name='customercode[]' type="hidden" value='<?php echo $res2customercode; ?> ' ><div align="center"><?php echo $res2customercode; ?></div></td> 
		  <td  align="left" valign="center" class="bodytext31"><input name='customername[]' type="hidden" value='<?php echo $res2customername; ?> ' > <div align="center"><?php echo $res2customername; ?></div></td>
          <td  align="left" valign="center" class="bodytext31"><input name='gender[]' type="hidden" value='<?php echo $res2gender; ?> ' > <div align="center"><?php echo $res2gender; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><input name='age[]' type="hidden" value='<?php echo $res2age; ?> ' ><div align="left"><?php echo $res2age; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><input name='mobile[]' type="hidden" value='<?php echo $res2mobilenumber1; ?> ' ><div class="bodytext31"><div align="left"><?php echo $res2mobilenumber1; ?></div></div>		  </td>

       </tr>
			  <?php
			  }
			  }
			  }
			  ?>
		  		    
	  <tr>
		 <td colspan="6">
		 <!--<form name='f1' method='post'>-->
 		 <form>
	
<textarea name="message" rows="6" style="width:340px;" onKeyDown="textCounter(this.form.message,this.form.countDisplay);" onKeyUp="textCounter(this.form.message,this.form.countDisplay);" placeholder="Type Your SMS Message Here."></textarea>
<br>
<input readonly type="text" name="countDisplay" size="3" maxlength="3" value="160"> Characters Remaining
</form>
		 <input type='submit' value='Send' name='send'></td>
	    </tr>
		 <tr>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
     <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
     <td width="9"></td>
	 </tr></tbody>
     </table>
	 </form>
	 <?php 
	 if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
		if($st == 'success')
		{
		?>
<table width="64%" border="0" cellspacing="0" cellpadding="4">
  <tr bgcolor="#FFFFFF">
    <td width="4%" align="left" valign="center" class="bodytext31"><strong>S.No</strong></td>
    <td width="19%" align="left" valign="center" class="style1">Patient Name</td>
    <td width="7%" align="left" valign="center" class="style1">Gender</td>
    <td width="5%" align="left" valign="center" class="style1">Age</td>
    <td width="14%" align="left" valign="center" class="style1">Mobile</td>
    <td width="12%" align="left" valign="center" class="style1">Message Id</td>
	<td width="21%" align="left" valign="center" class="style1">Message</td>
	<td width="18%" align="left" valign="center" class="style1">Response</td>
  </tr>
  <?php
  
  $query1 = "select * from smsdetails where messageid <> '' order by lastupdatetime desc limit 0 ,50";
  $exec1 = mysql_query($query1) or die("Error in Query1".mysql_error());
  while($res1 = mysql_fetch_array($exec1))
  {
			  $age = $res1['age'];
			  $gender = $res1['gender'];
			  $customername = $res1['customername'];
			  $messageid = $res1['messageid'];
			  $mobilenumber = $res1['mobilenumber'];
			  $message = $res1['message'];
  				$sno = $sno + 1;
				
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
    <td align="left" valign="center" class="bodytext31"><?php echo $sno;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31"><?php echo $customername;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31"><?php echo $gender;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31"><?php echo $age;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31"><?php echo $mobilenumber;?>&nbsp;</td>
	 <td align="left" valign="center" class="bodytext31"><?php echo $messageid;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31"><?php echo $message;?>&nbsp;</td>
    <td align="left" valign="center" class="bodytext31">
	 <?php
	if(is_numeric($messageid))
 	 {		
		echo 'Message Sent Successfully'; 
   	}
  ?></td>
  </tr>
  <?php
}
?> 

    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> 
<?php
}
?>
    </td>
     </tr>
     </table>
     <?php include ("includes/footer1.php"); ?>
     </body>
     </html>

