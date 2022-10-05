<?php
/** For The local Development of the server */
// $servername = "localhost";
// $username = "alex";
// $password = "alEx@2022@zuct";
// $dbname = "timetabledata";
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
			  
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submitInstructor'])) {
	$firstname = $_POST["fname"];
	$lastname = $_POST["lname"];
	$email = $_POST["email"];
	insertDataInInstructor($dbname, $firstname, $lastname, $email, $conn);
}

function insertDataInInstructor($databasename, $fname, $lname, $email, $conn)
{
	$sql = "INSERT INTO instructor(firstname, lastname,email) VALUES ('{$fname}','{$lname}','{$email}')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
