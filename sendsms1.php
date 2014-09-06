<?php
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
$route="0";// 0-Normal,1-Priority
$method="POST";

//---------------------------------

if(isset($_REQUEST['send']))
{

	$mobile=$_REQUEST['mobile'];

	$message=$_REQUEST['message'];

	$uid=urlencode($uid);
	$pin=urlencode($pin);
	$sender=urlencode($sender);
	$message=urlencode($message);
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&mobile=$mobile&message=$message ";

	if($method=="POST")
	{
		$opts = array(
		  'http'=>array(
			'method'=>"$method",
			'content' => "$parameters",
			'header'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
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


	if($response=="")
	echo "Process Failed, Please check your connecting domain, username or password.";
	else
	echo "Message Id : $response"; 
	//Returning the message id  :  Whenever you are sending an SMS our system will give a message id for each numbers, 
	//which can be saved into your database and in future by calling these message id's using correct API's you can 
	//update the delivery status.

}


echo "<form name='f1' method='post'>";

echo "<p> Mobile: <input name='mobile' value='9840430906' > </p>";

echo "<p> Message: <textarea name='message' >Airtel.</textarea> </p>";

echo "<p> <input type='submit' value='Send' name='send'></p>";

echo "</form>";

?>