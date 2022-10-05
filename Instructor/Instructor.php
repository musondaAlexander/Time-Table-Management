<?php
/** For The local Development of the server */
// $servername = "localhost";
// $username = "alex";
// $password = "alEx@2022@zuct";
// $dbname = "timetabledata";
      /* From heroku to the server  */
	  //Get Heroku ClearDB connection information
	  $servername = "us-cdbr-east-06.cleardb.net";
	  $username = "beb5e1d2cd0e49";
	  $password = "a60fad52";
	  $dbname = "heroku_3ca43a23c94a4d6";

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
