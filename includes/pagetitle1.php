<title>
<?php 
if (isset($_REQUEST["titlestr"])) { $titlestr = $_REQUEST["titlestr"]; } else { $titlestr = ""; }
if ($titlestr == '')
{
	echo 'SIMACLE HOSPITAL SOFTWARE 7.0';
}
else
{
	echo $titlestr.' - SIMACLE HOSPITAL SOFTWARE 7.0';
}
?>
</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">