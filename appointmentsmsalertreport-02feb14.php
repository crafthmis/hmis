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

//Code using fopen

//API stands for Application Programming Integration which is widely used to integrate and 
//enable interaction with other software, much in the same way as a user interface facilitates interaction 
//between humans and computers. Our API codes can be easily integrated to any web or software application. 

//Change your configurations here.
//---------------------------------
$uid="7072656d6b756d61726376"; //your uid
$pin="4f2a36c521079"; //your api pin
$sender="sender"; // approved sender id
$domain="smsalertbox.com"; // connecting url 
$route="0";// 0-Normal,1-Priority
$method="POST";

//---------------------------------

if(isset($_REQUEST['send']))
{
foreach($_POST['mobile'] as $key=>$value){	
			//echo '<br>'.
	 $mobile=$_POST['mobile'][$key];
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


	/*if($response=="")
	echo "Process Failed, Please check your connecting domain, username or password.";
	else
	echo "Message Id : $response"; */
	//Returning the message id  :  Whenever you are sending an SMS our system will give a message id for each numbers, 
	//which can be saved into your database and in future by calling these message id's using correct API's you can 
	//update the delivery status.

}
header("location:appointmentsmsalertreport.php?st=success");			 
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
    <td width="0%">&nbsp;</td>
    <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td>
	 <form name='f1' method='post'>
	 <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse"bordercolor="#666666" cellspacing="0" cellpadding="4" width="568" 
     align="left" border="0">
     <tbody>
	 
  <tr bgcolor="#011E6A">
     <td colspan="6" bgcolor="#CCCCCC" class="bodytext3"><strong>Appointment Sms Alert Report </strong></td>
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
			$patientname = $_REQUEST["patientname".$i];
			$query31 = "select * from appointschedule_entry where patientname = '$patientname'"; 
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$res31patientname = $res31["patientname"];
			$res31auto_number = $res31["auto_number"];
			$res31consultingdoctor = $res31["consultingdoctor"];
			}
			}
			?>
	         <tr>
                <td width="43"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
				<td width="113" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Patient </strong></div></td>
				<td width="122" align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Doctor </strong></div></td>
				<td width="122" align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Mobile Number </strong></div></td>
                <td width="105" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> App Date </strong></div></td>
                <td width="111" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> App Time </strong></div></td>
              </tr>
			  
			  <?php
			  if(isset($_POST['check']) && $_POST['check'])
	          {
	          foreach($_POST['check'] as $value)
	          {
			  $query2 = "select * from appointmentschedule_entry where auto_number='$value'";
			  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			  while ($res2 = mysql_fetch_array($exec2))
			  {
			  $res2patientname = $res2['patientname'];
			  $res2consultingdoctor = $res2['consultingdoctor'];
			  $res2appointmentdate = $res2['appointmentdate'];
			  $res2appointmenttime = $res2['appointmenttime'];
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
          <td class="bodytext31" valign="center"  align="left">
		  <?php echo $colorloopcount; ?></td>
          <td  align="left" valign="center" class="bodytext31"><div align="left"><?php echo $res2patientname; ?></div></td> 
		  <td  align="left" valign="center" class="bodytext31"> <div align="left"><?php echo $res2consultingdoctor1; ?></div></td>
		  <td class="bodytext31" valign="center"  align="left"><input name='mobile[]' type="hidden" value='<?php echo $res2mobilenumber; ?> ' ><div class="bodytext31"><div align="left"><?php echo $res2mobilenumber; ?></div></div>		  </td>
          <td  align="left" valign="center" class="bodytext31"> <div align="left"><?php echo $res2appointmentdate; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $res2appointmenttime ; ?></div></td>
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
		 <input type='submit' value='Send' name='send'>
 		 
         <!--</form>-->		 </td>	 
		 </tr>
	  
		<?php
         if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
         if ($st == 'success')
         {
         ?>
		 
      <tr>
         <td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">* Message Sent successfully</td>
      </tr>
	  
      <?php
		}
       ?>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
     <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
	 <td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">&nbsp;</td>
     <td width="26"></tbody>
     </table>
	 </form>
	 </td>
     </tr>
     </table>
     </table>
     <?php include ("includes/footer1.php"); ?>
     </body>
     </html>