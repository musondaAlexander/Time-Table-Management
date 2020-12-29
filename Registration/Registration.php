<?php
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
	$firstname = $_POST["fname"] ;
	$lastname = $_POST["lname"] ;
	$lpassword = $_POST["password"] ;
	$cmsid = $_POST["cms_id"] ;
	$email = $_POST["email"] ;
	$position = $_POST["position"] ;

	$conn = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'], $databasename);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	insertData($dbname,$firstname,$lastname,$email,$lpassword,$cmsid);]
	
	FUNCTION insertData($databasename,$fname,$lname,$email,$password,$cmsid,$position){
		$sql = "INSERT INTO Data(firstname, lastname, email,cms_id,password,position) VALUES ('{$fname}','{$lname}','{$email}','{$cmsid}','{$password}','{position}')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();
?>