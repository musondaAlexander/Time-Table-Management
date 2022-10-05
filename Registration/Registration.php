<?php
	$servername = "localhost";
	$username = "alex";
	$password = "alEx@2022@zuct";
	if(isset($_POST['submitMember'])){
		$firstname = $_POST["fname"] ;
		$lastname = $_POST["lname"] ;
		$lpassword = $_POST["password"] ;
		$cmsid = $_POST["cms_id"] ;
		$email = $_POST["email"] ;
		$position = $_POST["position"] ;		
		insertData($firstname,$lastname,$email,$lpassword,$cmsid,$position);
	}
	
	FUNCTION insertData($fname,$lname,$email,$password,$cmsid,$position){
		$conn1 = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'], 'timetabledata');
		if ($conn1->connect_error) {
		  die("Connection failed: " . $conn1->connect_error);
		}
		
		$sql = "INSERT INTO data(firstname, lastname, email,id,password,position) VALUES ('{$fname}','{$lname}','{$email}','{$cmsid}','{$password}','{$position}')";
		if ($conn1->query($sql) === TRUE) {
		}
		$conn1->close();
	}
?>