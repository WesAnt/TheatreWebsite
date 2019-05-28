
<?php

// This function was provided by Laura Bocchi, in class of week 8, semester 1, 2018.

function myConnect(){
	$host = 'dragon.ukc.ac.uk';
	$dbname = 'waw5';
	$user = 'waw5';
	$pwd = 'unia&li';
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if ($conn) {	
			
            return $conn;
			
		} else {
			echo 'Failed to connect';
		}
	} catch (PDOException $e) {
		echo "PDOException: ".$e->getMessage();
	}
    
}

?>







