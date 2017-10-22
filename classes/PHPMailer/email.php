<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class email
{
	public function sendEmail($to, $name, $subject, $message, $attachment, $file, $link)
	{
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "supprt.inproject@gmail.com";
		//Password to use for SMTP authentication
		$mail->Password = "inproject2017";
		//Set who the message is to be sent from
		$mail->setFrom('supprt.inproject@gmail.com', 'Inproject Support');
		//Set an alternative reply-to address
		$mail->addReplyTo('supprt.inproject@gmail.com', 'Inproject Support');
		//Set who the message is to be sent to
		$mail->addAddress($to, $name);
		//Set the subject line
		$mail->Subject = $subject;
		//Replace the plain text body with one created manually
		$mail->Body = $message;
		$mail->IsHTML(true); 
		$mail->AltBody = $message;
		if($attachment)
		{
			//Attach an image file
			$mail->addAttachment($file);
		}
		//send the message, check for errors
		if (!$mail->send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			echo '<script>alert("Projeto inserido com sucesso!"); window.location.href = "'.$link.'"</script>';
			
			//Section 2: IMAP
			//Uncomment these to save your message in the 'Sent Mail' folder.
			#if (save_mail($mail)) {
			#    echo "Message saved!";
			#}
		}
	}
}
?>