<?php 

class Mail {
	public static function send($to, $subject, $message) {
		$message = ' 
		<html> 
		<head> 
			<title>'.$subject.'</title> 
		</head> 
		<body> 
			<p>'.$message.'</p> 
		</body> 
		</html>';  

		mail($to, $subject, $message); 
	}
}