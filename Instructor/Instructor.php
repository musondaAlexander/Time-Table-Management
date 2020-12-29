<?php
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
	$conn = new mysqli($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		
	if(isset($_POST['submitInstructor'])){
		$firstname = $_POST["fname"] ;
		$lastname = $_POST["lname"] ;
		$email = $_POST["email"] ;        
		insertDataInInstructor($dbname,$firstname,$lastname,$email);
	} 	
			
	FUNCTION insertDataInInstructor($databasename,$fname,$lname,$email){		
		$sql = "INSERT INTO instructor(firstname, lastname,email) VALUES ('{$fname}','{$lname}','{$email}')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

?>
