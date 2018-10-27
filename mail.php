<?php

include_once('PHPMailer-5.2.25/PHPMailerAutoload.php');

$mailTo = $_POST['email'];
$subject = "Request resource from jobber.vn";
$message = $_POST['message'];
$contactNname = $_POST['name']; 
$phone = $_POST['phone']; 


// Configuring SMTP server settings
$email = "jobber.vn@gmail.com";
$password = "Kyanh@010";
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $email;
$mail->Password = $password;
$mail->CharSet = 'UTF-8';

//Send mail to jobber.vn@gmail.com
// Email Sending Details
$mail->setFrom($mailTo, $contactNname);
$mail->addAddress($email, 'Jobber');

$mail->addReplyTo($mailTo, $contactNname);
//$mail->addAddress($mailTo);
$mail->Subject = $subject;
$mail->msgHTML($message);
// Success or Failure
if (!$mail->send()) {
	$error = "Mailer Error: " . $mail->ErrorInfo;
	echo '<p id="para">'.$error.'</p>';
}
else {
	//sent to jobber.vn@gmail.com
	//send mail to user request resource
	$mail1 = new PHPMailer();
	$mail1->isSMTP();
	$mail1->Host = 'smtp.gmail.com';
	$mail1->Port = 587;
	$mail1->SMTPSecure = 'tls';
	$mail1->SMTPAuth = true;
	$mail1->Username = $email;
	$mail1->Password = $password;
	$mail1->CharSet = 'UTF-8';
	$mail1->setFrom($email, "Jobber");
	$mail1->addAddress($mailTo, $contactNname);

	$mail1->addReplyTo($mail, "Jobber");
	//$mail->addAddress($mailTo);
	$mail1->Subject = $subject;
	$mail1->msgHTML("Cảm ơn bạn đã tin tưởng Jobber, Chúng tôi đã nhận được yêu cầu của bạn. Nhân viên tư vấn sẽ liên lạc với bạn qua số điện thoại đã cung cấp.");
	$mail1->send();

	echo 'Cảm ơn bạn đã tin tưởng Jobber, Chúng tôi đã nhận được yêu cầu của bạn. Nhân viên tư vấn sẽ liên lạc với bạn qua số điện thoại đã cung cấp.';


}

/**/
?>