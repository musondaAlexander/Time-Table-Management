<?php
    /** for local development of the site */
	// $servername = "localhost";
	// $username = "alex";
	// $password = "alEx@2022@zuct";
	// $dbname = "timetabledata";

         /* From heroku to the server  */
	  //Get Heroku ClearDB connection information

// Connect to DB
//$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);v



/** for local development */
        $servername = "us-cdbr-east-06.cleardb.net";
		$username = "beb5e1d2cd0e49";
		$password = "a60fad52";
		$dbname = "heroku_3ca43a23c94a4d6";

	$conn = new mysqli($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['submitDepartment'])){
		$department = $_POST["department_name"] ;
		$semester = $_POST["semester"] ;
		$section = $_POST["section"] ;            
		insertDataInDepartment($dbname,$department,$semester,$section);
	} 	
			
	FUNCTION insertDataInDepartment($databasename,$name,$semester,$section){
		$sql = "INSERT INTO department (dept_name, semester,section) VALUES ('{$name}','{$semester}','{$section}')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>
