			 <?php

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
?>
 <?php
		if(isset($_POST['checkbox_name'])) echo 'checked';
				if (isset($_REQUEST["gender"])) { $gender = $_REQUEST["gender"]; } else { $gender = ""; }
				if (isset($_REQUEST["age"])) { $age = $_REQUEST["age"]; } else { $age = ""; }
				if (isset($_REQUEST["status"])) { $status = $_REQUEST["status"]; } else { $status = ""; }
				if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
				if ($frmflag1 == 'frmflag1')
				{
					$agefrom=$_REQUEST["agefrom"];
					$ageto = $_REQUEST["ageto"];
					$mobilenumber = $_REQUEST["mobilenumber"];
				if($gender !="" && $agefrom == "" && $ageto == "")
				{	
			 	$query2 = "select * from master_customer where gender like '$gender%' and checkbox='1'";
			    }
			    else
			    {
			  	 $query2 = "select * from master_customer where gender like '$gender%' and checkbox='1' and age between '$agefrom' and '$ageto'";
				}
			    }
			    else
			   {
			   $query2 = "select * from master_customer where checkbox='1'";
			   }
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
			  

    $query32 = "select * from master_customer where auto_number = '$res2customeranum'"; 
	$exec32 = mysql_query($query32) or die ("Error in Query32".mysql_error());
	$res32 = mysql_fetch_array($exec32);
	$res32mobilenumber = $res32['mobilenumber'];
				
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
                <td  align="left" valign="center" class="bodytext31"><div align="left"><?php echo $res2customercode; ?></div></td> 
				<td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $res2customername; ?></div></td>
                <td  align="left" valign="center" class="bodytext31"><div align="left"> <?php echo $res2gender; ?></div></td>
                <td class="bodytext31" valign="center"  align="left"><div align="left">
				<?php echo $res2age; ?></div></td>
                <td class="bodytext31" valign="center"  align="left">
				<input name='mobile' type="hidden" value='<?php echo $res2mobilenumber1; ?> ' > 
				<div class="bodytext31">
				  <div align="left"><?php echo $res2mobilenumber1; ?></div>
				</div></td>
              </tr>
			 
			 			 <?php
			  }
			  ?>
			 
<?php include ("includes/footer1.php"); ?>
