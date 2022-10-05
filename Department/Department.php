<?php
    /** for local development of the site */
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
