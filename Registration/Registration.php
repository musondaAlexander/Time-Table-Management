<?php
    /** for the development of the local server */
	// $servername = "localhost";
	// $username = "alex";
	// $password = "alEx@2022@zuct";
    
	      /* From heroku to the server  */
	  //Get Heroku ClearDB connection information

/** for local development */
$servername = "us-cdbr-east-06.cleardb.net";
$username = "beb5e1d2cd0e49";
$password = "a60fad52";
$dbname = "heroku_3ca43a23c94a4d6";
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
		$conn1 = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'], $dbname);
		if ($conn1->connect_error) {
		  die("Connection failed: " . $conn1->connect_error);
		}
		
		$sql = "INSERT INTO data(firstname, lastname, email,id,password,position) VALUES ('{$fname}','{$lname}','{$email}','{$cmsid}','{$password}','{$position}')";
		if ($conn1->query($sql) === TRUE) {
		}
		$conn1->close();
	}
?>