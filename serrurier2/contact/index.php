	<?php
	$error = null;
	$success = true;

	
// Pear Mail Library
require_once "Mail.php";


		$data = json_decode(file_get_contents('php://input'), true);

		$from = 'devis@serrurier-direct.com';
		$to = 'devis@serrurier-direct.com';
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

	?>