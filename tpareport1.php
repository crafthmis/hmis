<?

include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION[username];
$companyanum = $_SESSION[companyanum];
$companyname = $_SESSION[companyname];

$quotedatefrom = date('Y-m-d', strtotime('-1 month'));
$quotedateto = date('Y-m-d');

$cbfrmflag1 = $_REQUEST[cbfrmflag1];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$quotedatefrom = $_REQUEST[ADate1];
	$quotedateto = $_REQUEST[ADate2];

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
$auto_number=$_SESSION[session_auto_number_REQUEST_job];//post job auto number
*/
?>
<script language="javascript">

function loadprintpage1(banum)
{
	var varbanum = banum;
	//alert (varqanum);
	window.open("print_bill1.php?banum="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}
function loadprintpage2(banum)
{
	var varbanum = banum;
	var varbanum1 = "O";
	var varbanum2 = "D";
	
	//alert (varqanum);
			
	window.open("print_bill1.php?str=Original && banum="+varbanum+"","Window1"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("print_bill1.php?banum="+varbanum+"","Window2"Original"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	
	window.open("print_bill1.php?str=Duplicate && banum="+varbanum+"","Window2"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	window.open("print_bill1.php?str=Triplicate && banum="+varbanum+"","Window3"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}

function loadpdfpage1(banum)
{
	//alert ("Please Wait Few Seconds. The PDF File is being created. Do Not Close Popup Window.");
	var varbanum = banum;
	//alert (varqanum);
	window.open("emailbill1.php?banum="+varbanum+"","Window1","menubar=no,width=450,height=450,toolbar=no,scrollbars=yes,status=yes,left=100,top=100");
	//window.open("print_bill1.php?banum="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}



</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>
</head>

<body>
<table width="1900" border="0" cellspacing="0" cellpadding="2">
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
    <td width="0%">&nbsp;</td>
    <td width="1%" valign="top"><? //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="99%" valign="top"><table width="1700" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
              <form name="cbform1" method="get" action="patientreport1.php">
		<table width="600" border="1" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Patient Report     - Select Date </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><? echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="8" align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3">&nbsp;</td>
            </tr>
            <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
            <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="top" bordercolor="#F3F3F3" class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
            <tr>
              <td width="22%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"> Date From </td>
              <td width="26%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<? echo $quotedatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                <a href="javascript:displayDatePicker('ADate1', false, 'ymd', '-');"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp" /></a></td>
              <td width="17%" align="left" valign="center" bordercolor="#f3f3f3" class="bodytext31"> Date To </td>
              <td width="35%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff"><span class="bodytext31">
                <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<? echo $quotedateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
              <a href="javascript:displayDatePicker('ADate2', false, 'ymd', '-');"><img src="images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the timestamp" /></a></span></td>
              </tr>
            <tr>
              <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top" bordercolor="#F3F3F3"><input type="hidden" name="cbfrmflag12" value="cbfrmflag1">
                <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
              </tr>
          </tbody>
        </table>
              </form>
		
		
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="939" 
            align="left" border="1">
          <tbody>
            <tr>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="23%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="19%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="15%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="11%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="12%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="16%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
			   <td width="16%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff">&nbsp;</td>
              <td colspan="6" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><?
				$cbfrmflag1 = $_REQUEST[cbfrmflag1];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					$cbcustomername = $_REQUEST[cbcustomername];
					$customername = $_REQUEST[cbcustomername];
					$cbbillnumber = $_REQUEST[cbbillnumber];
					$cbbillstatus = $_REQUEST[cbbillstatus];
					
					$quotedatefrom = $_REQUEST[ADate1];
					$quotedateto = $_REQUEST[ADate2];
					
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$quotedatefrom&&ADate2=$quotedateto";
				}
				else
				{
					
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$quotedatefrom&&ADate2=$quotedateto";
				}
				?>
                <script language="javascript">
				function printbillreport1()
				{
					
					window.open("print_billreport1.php?<? echo $urlpath; ?>","Window1",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				</script>
                <!--<input onClick="javascript:printbillreport1()" name="resetbutton2" type="submit" id="resetbutton2"  style="border: 1px solid #001E6A" value="Print Bill Report" />--></td>
				<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>Name</strong></td>
			  <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Address</strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Location</strong></div></td>
             <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>City</strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong> State </strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Date Of Admitted </strong></div></td>
				<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>EDIT </strong></div></td>
            </tr>
			<?
			
			$dotarray = explode("-", $quotedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));

			$billnumarray = explode('-', $cbbillnumber);
			//print_r($billnumarray);
			$billnumberprefix = $billnumarray[0];
			$cbbillnumber = $billnumarray[1];
			if ($cbbillnumber == '') $cbbillnumber = $billnumberprefix;
			//echo $billnumber;
			//$cbbillnumber = $cbbillnumber;

			$query2 = "select * from master_tpa where dateposted between '$quotedatefrom' and '$quotedateto'  order by dateposted desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$code=$res2['tpacode'];
			$customername = $res2['tpaname'];
			$city = $res2['city'];
			$address=$res2['address'];
			$location=$res2['location'];
			$state=$res2['state'];
			$date1=$res2['dateposted'];
		
			$billstatus = $res2['status'];
			$billstatus = strtoupper($billstatus);
			//if ($billstatus == '') $billstatus = 'pending';
			//if ($billstatus == 'CLOSED') $changestatus = 'Open This Bill';
			if ($billstatus == 'CLOSED') $closebill = '';
			if ($billstatus == 'OPEN') $closebill = 'Close Bill';
			
			$res2loopcount = $res2loopcount + 1;
			
			$subtotal = $res2['subtotal'];
			$totaldiscountpercent = $res2['totaldiscountpercent'];
			$totaldiscountamount = $res2['totaldiscountamount'];
			$totalafterdiscount = $res2['totalafterdiscount'];
			$totaltax = $res2['totaltax'];
			$totalaftertax = $res2['totalaftertax'];
			$transportation = $res2['transportation'];
			
			$res2billnumber = $res2['billnumber'];
			
	
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
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
           <tr <? echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><? echo $res2loopcount; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><span class="bodytext3"><? echo $customername;?></span></a></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><? echo $address;?></td>
			 
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><div align="left"> <? echo $location; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><div align="left"> 
			  <? 
				echo $city; 
				

			?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  
                <div class="bodytext31"><? echo $state; ?></div>              </td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <? echo $date1; ?></td>
			  <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			 <a href="edittpa1.php?tpacode=<? echo $code;?>"><font class="bodytext3">Edit</font></a></td>
            </tr>
			<?
			}
			?>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
				 <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
             </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
  </table>
<? include ("includes/footer1.php"); ?>
</body>
</html>

