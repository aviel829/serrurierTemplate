	<?php

	require('../recaptcha-master/src/autoload.php');

	$error = null;
	$success = true;
	$recaptchaSecret = '6Ld2tkcUAAAAABxXTQGMQTxkVWlA66NKEVUzi8O4';
	
		$data = json_decode(file_get_contents('php://input'), true);	
		$captcha=$data['g-recaptcha-response'];
		  if(!$captcha){
			echo '<h2>Please check the the captcha form.</h2>';
			exit;
		  }
		  
		  $ip = $_SERVER['REMOTE_ADDR'];
		  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptchaSecret."&response=".$captcha."&remoteip=".$ip);
		  $responseKeys = json_decode($response,true);
		  if(intval($responseKeys["success"]) !== 1) {
			echo '<h2>You are spammer ! Get the @$%K out</h2>';
		  } else {
			$data = json_decode(file_get_contents('php://input'), true);
			
					$from = 'aviel829@gmail.com';
					$to = 'aviel829@gmail.com';
					$subject = $data["subject"];
					$body = $data["body"];
					
			
					if (!$body){
						throw new Exception('Invalid body');
					}
					
					if (!$subject){
						throw new Exception('Invalid subject');
					}
			
					$headers = array(
						'From' => $from,
						'To' => $to,
						'Subject' => $subject
					);
				
					mail($to, $subject, $body);
			
					echo json_encode(file_get_contents('php://input'));
		  }


	?>