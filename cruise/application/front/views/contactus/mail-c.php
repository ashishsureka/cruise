<?php
pre($_POST);
exit;

$to = "aanganexpress@gmail.com";
//$to = "ankit@winspirewebsolution.com";
$subject = "CONTACT INFORMATION FOR AANGAN EXPRESS";

if(isset($_POST['submit']))
{
	
	$name = $_POST['name-c'];
	$email = $_POST['email-c'];
	$contact = $_POST['phone-c'];
	$comment = nl2br($_POST['message-c']);
	//get todays date
	$todayis = date("l, F j, Y, g:i a") ;


$message = "<b style='font-size:24px;'>CONTACT INFORMATION</b> <br><br> <b style='font-size:20px;'>Name :</b> <span style='font-size:18px;'> $name </span> <br> <b style='font-size:20px;'>Email :</b> <span style='font-size:18px;'> $email </span>  <br> <b style='font-size:20px;'>Contact :</b> <span style='font-size:18px;'> $contact </span> <br> <b style='font-size:20px;'>Comment :</b> <span style='font-size:20px;'> $comment </span>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$email.'>' . "\r\n";
// $headers .= 'Cc: '.$email.'' . "\r\n";




mail($to,$subject,$message,$headers);

echo '<script>';
		echo 'alert("Thanks for Contact Us,Our executive contact you soon!");';
		echo 'location.href="index.html"';
		echo '</script>';

}
?> 