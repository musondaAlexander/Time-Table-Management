<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "timetabledata";
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
