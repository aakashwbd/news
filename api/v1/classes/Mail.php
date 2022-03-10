<?php
	include_once __DIR__.'/../libs/php-mail/PHPMailer.php';
	include_once __DIR__.'/../libs/php-mail/SMTP.php';
	include_once __DIR__.'/../libs/php-mail/Exception.php';
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	class Mail {
		public function mailerFunction ($host, $post, $username, $password, $encryption, $setFrom, $addAddress, $subject, $body){
			$mail = new PHPMailer();
			
			try {
				$mail->isSMTP();
				$mail->Host = $host;
				$mail->SMTPAuth = true;
				$mail->Port = $post;
				$mail->Username = $username;
				$mail->Password =  $password;
				$mail->SMTPSecure =  $encryption;
				
				$mail->setFrom($setFrom);
				$mail->addAddress($addAddress);
				
				//				$mail->IsHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $body;
				
				$mail->send();
				
			} catch (Exception $e) {
				echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
			}
			
			return true;
			
		}
	}
