<?php
    /** for the development of the local server */
	// $servername = "localhost";
	// $username = "alex";
	// $password = "alEx@2022@zuct";
    
	      /* From heroku to the server  */
	  //Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
//$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);v



/** for local development */
		$servername = $cleardb_server;
		$username = $cleardb_username;
		$password = $cleardb_password;
		$dbname = $cleardb_db;

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