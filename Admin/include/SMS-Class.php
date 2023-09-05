<?php
  
// Update the path below to your autoload.php, 
// see https://getcomposer.org/doc/01-basic-usage.md 
require_once '../SMS/vendor/autoload.php'; 
 
use Twilio\Rest\Client; 
 

function Send_SMS($number, $txt) {
	
	$sid    = "AC1dbb7afc7fa1e9ecd2c131314cbd478b"; 
	$token  = "c6lql0hoQzD7v4DtKLug7zn4pNXTdR9OWYFhTnWv"; 
	$twilio = new Client($sid, $token); 

	$message = $twilio->messages 
					  ->create($number, // to 
							   array(  
								   "messagingServiceSid" => "MGa37248bdf48783bfb6ccc796adfa7341",      
								   "body" =>  $txt
							   ) 
					  ); 
	return "Success";
	//print($message->sid);
}
