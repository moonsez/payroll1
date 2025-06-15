<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_sent{

	function mail_sent($file_path,$email_id) 
    {
    	
		date_default_timezone_set('Etc/UTC');

		require_once 'email/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp.mandrillapp.com';

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "test4moonveda@gmail.com";

		//Password to use for SMTP authentication
		$mail->Password = "MPbD9kDjpKAJBQcAUThZzg";

		//Set who the message is to be sent from
		$mail->setFrom('test4moonveda@gmail.com', 'Moon Group');

		//Set an alternative reply-to address
		$mail->addReplyTo('test4moonveda@gmail.com', 'moonveda.com');

		//Set who the message is to be sent to
		// for($i=0;$i<count($email_id);$i++)
		// {
			$mail->addAddress($email_id);
		// }
		//Set the subject line
		$mail->Subject = "Regarding Salary slip copy";

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		
		$mail->MsgHTML("please PFA salary slip");
		
		//Replace the plain text body with one created manually
		$mail->AltBody = "please PFA salary slip2";

		
		// $mail->addAttachment('./images/phpmailer_mini.png');
		// $mail->addAttachment('./images/freak-logo.png');
		
		//Attach an image file
		$full_file_path = './pdf-mail-sent/'.$file_path;
		$mail->addAttachment($full_file_path);
		// for($i=0;$i<count($attachement);$i++)
		// {
		// 	$mail->addAttachment($attachement[$i]['attachement_file']);
		// }

		//send the message, check for errors
		if (!$mail->send()) 
		{
			//echo 0;
		    return false;
		} 
		else 
		{
			//echo 1;
		    return true;
		}
	}

}
