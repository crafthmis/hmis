<?

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$totalnumberofservices = 25; // the number service listed in loop.

$btnclear = $_REQUEST[btnclear];
if ($btnclear == 'Clear') header ("location:addcustomer1.php?anum=$customeranum");

$frmflag1 = $_POST[frmflag1];
if ($frmflag1 == 'frmflag1')
{

	$insurancename = $_REQUEST[insurancename];
	$insurancename = strtoupper($insurancename);
	$insurancename = trim($insurancename);
	$phonenumber = $_REQUEST[phonenumber];
	$mobilenumber = $_REQUEST[mobilenumber];
	$emailid1  = $_REQUEST[emailid];
	$faxnumber1 = $_REQUEST[faxnumber];
	$address = $_REQUEST[address];
	$location = $_REQUEST[location];
	$city  = $_REQUEST[city];
	$state  = $_REQUEST[state];
	$pincode = $_REQUEST[pincode];
	$country = $_REQUEST[country];
	$insurancecode = $_REQUEST[insurancecode];
	$dateposted = $updatedatetime;
	
	$query2 = "select * from master_insurance where insurancecode = '$insurancecode'"; //customername = '$customername'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_insurance (insurancename, 
		phonenumber, mobilenumber, emailid,faxnumber,address, 
		location, city, state, pincode, country, dateposted,insurancecode) 
		values ('$insurancename', 
		'$phonenumber', '$mobilenumber', '$emailid1','$faxnumber1','$address', 
		'$location', '$city', '$state', '$pincode', '$country','$dateposted', 
		'$insurancecode')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		
		$errmsg = "Success. New Insurance Company Added.";
			
		$insurancename = '';
		$phonenumber = '';
		$mobilenumber = '';
		$emailid1  = '';
		$faxnumber1 = '';
		$address = '';
		$location = '';
		$city  = '';
		$state = '';
		$pincode = '';
		$country = '';
    	$insurancecode = '';
		$dateposted = $updatedatetime;
	}
	else
	{
	
	$insurancename = $_REQUEST[insurancename];
	$insurancename = strtoupper($insurancename);
	$insurancename = trim($insurancename);
	$phonenumber = $_REQUEST[phonenumber];
	$mobilenumber = $_REQUEST[mobilenumber];
	$emailid1  = $_REQUEST[emailid];
	$faxnumber1 = $_REQUEST[faxnumber];
	$address = $_REQUEST[address];
	$location = $_REQUEST[location];
	$city  = $_REQUEST[city];
	$state  = $_REQUEST[state];
	$pincode = $_REQUEST[pincode];
	$country = $_REQUEST[country];
	$insurancecode = $_REQUEST[insurancecode];
	$dateposted = $updatedatetime;
	
	$query1 = "update master_insurance set insurancename='$insurancename', 
	phonenumber='$phonenumber',mobilenumber='$mobilenumber',address='$address', 
	location='$location', city='$city', state='$state', pincode='$pincode', country='$country',dateposted='$dateposted',emailid='$emailid1',faxnumber='$faxnumber1' where insurancecode='$insurancecode'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
	$errmsg = "Success. Insurance Updated.";
	}

}
else
{
}

$codeup=$_REQUEST[str];
$queryup="select * from master_insurance where insurancecode='$codeup'";
$execup=mysql_query($queryup) or die("Error in queryup".mysql_error());
$resup=mysql_fetch_array($execup);
$customername = $resup['insurancename'];
$email=$resup['emailid'];
$phonenumber = $resup[phonenumber];
$phonenumber1 = $resup[faxnumber];
$mobilenumber = $resup[mobilenumber];
$address = $resup[address];
$location = $resup[location];
$city  = $resup[city];
$state  = $resup[state];
$pincode = $resup[pincode];
$country = $resup[country];
$rate1=$resup[rate1];
$customercode = $codeup;
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
<script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_nbGroup(event, grpName) { //v6.0
  var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])? args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) {
      img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr)
      for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}
//-->
</script>
<?
/*
$auto_number=$_SESSION[session_auto_number_post_job];//post job auto number
*/
?>
<script language="javascript">

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

</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function from1submit1()
{

	if (document.form1.customername.value == "")
	{
		alert ("Customer Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	else if (document.form1.city.value == "")
	{
		alert ("City Cannot Be Empty.");
		document.form1.city.focus();
		return false;
	}
	else if (document.form1.state.value == "")
	{
		alert ("State Cannot Be Empty.");
		document.form1.state.focus();
		return false;
	}
	else if (document.form1.customercode.value == "")
	{
		alert ("Customer Code Cannot Be Empty.");
		document.form1.customercode.focus();
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
}

</script>
<body>
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><? include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><? include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><? //include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><? //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" action="addinsurance1.php" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="95%" height="282" border="1" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Insurance  - New </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><? echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="<? if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext3"><? echo $errmsg;?>&nbsp;</td>
              </tr>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
              <tr>
                <td width="19%" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Insurance Company   Name   *</td>
                <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3">
				<input name="insurancename" id="insurancename" value="<? //echo $customername; ?>" style="border: 1px solid #001E6A" size="60"></td>
              </tr>
              <tr>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Address</td>
                <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3"><input name="address" id="address" value="<? echo $address; ?>" style="border: 1px solid #001E6A"  size="60" /></td>
                </tr>
				<tr>
				<td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Location</td>
                <td valign="middle" align="left" bordercolor="#F3F3F3">
				<input name="location" id="location" value="<? echo $location; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">City * </td>
                <td valign="middle" align="left" bordercolor="#F3F3F3"><select name="city" >
                    <?
		 			 	if ($city != '') 
		  	{
			  echo '<option value="'.$city.'" selected="selected">'.$city.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}

			$query1 = "select * from master_city where status <> 'deleted' order by city";
			$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$city = $res1['city'];
			?>
                    <option value="<? echo $city; ?>"><? echo $city; ?></option>
                    <?
			  }
			  ?>
                </select></td></tr>
				<tr>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">State * </td>
                <td valign="middle" align="left" bordercolor="#F3F3F3">
				<select name="state" id="state" >
                    <?
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
			$state = $res1['state'];
			?>
                    <option value="<? echo $state; ?>"><? echo $state; ?></option>
                    <?
			  }
			  ?>
                </select></td>
              
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Country </td>
                <td valign="middle" align="left" bordercolor="#F3F3F3"><select name="country" id="select">
                    <?
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
			$country = $res1['country'];
			if ($country == 'India') { $selectedcountry = 'selected="selected"'; }
			?>
                    <option <? echo $selectedcountry; ?> value="<? echo $country; ?>"><? echo $country; ?></option>
                    <?
			  $selectedcountry = '';
				  
			  }
			  ?>
                  </select>                </td></tr>
				  <tr>
                              
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Pincode</td>
                <td valign="middle" align="left" bordercolor="#F3F3F3">
				<input name="pincode" id="pincode" value="<? echo $pincode; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
				 <td width="22%" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Email Id </td>
				 <td width="27%" align="left" valign="middle" bordercolor="#F3F3F3">
				<input name="emailid" id="emailid" value="<? echo $email; ?>" style="border: 1px solid #001E6A"  size="20"></td>

              </tr>
              <tr>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Phone Number  </td>
                <td width="35%" align="left" valign="middle" bordercolor="#F3F3F3">
				<input name="phonenumber" id="phonenumber" value="<? echo $phonenumber; ?>" style="border: 1px solid #001E6A" size="20" />                </td>
				 <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Mobile Number </td>
                 <td valign="middle" align="left" bordercolor="#F3F3F3"><input name="mobilenumber" id="mobilenumber" value="<? echo $mobilenumber; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
               
                  </tr>
                         
               <tr>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Fax  Number  </td>
                <td width="35%" align="left" valign="middle" bordercolor="#F3F3F3">
				<input name="faxnumber" id="faxnumber" value="<? echo $phonenumber1; ?>" style="border: 1px solid #001E6A" size="20" />                </td>
				 <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Insurance Company   Code * </td>
                 <td valign="middle" align="left" bordercolor="#F3F3F3"><input name="insurancecode" id="insurancecode" value="<? echo $customercode; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
               
                  </tr>
              <tr>
                <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">Date Posted</td>
                <td valign="middle" align="left" bordercolor="#F3F3F3"><input name="dateposted" id="dateposted" value="<? echo $dateposted; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="20"  readonly="readonly" />                </td>
               
                </tr>

             
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="95%" 
            align="left" border="1">
            <tbody>
              <tr>
                <td width="3%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="41%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#cccccc" class="bodytext31"><div align="right">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="hidden" name="frmflag1" value="frmflag1" />
                    <input type="hidden" name="loopcount" value="<? echo $i - 1; ?>" />
                    <input name="Submit222" type="submit"  value="Save Insurance" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
                </tr>
            </tbody>
          </table></td>
        </tr>
    </table>
	</form>
<script language="javascript">


</script>
</table>
<? include ("includes/footer1.php"); ?>
</body>
</html>

