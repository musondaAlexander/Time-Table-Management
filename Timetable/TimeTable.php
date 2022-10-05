<?php	
    /** The followinmg is for local development */		
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
// edited code for to set up the connection

	$conn = new mysqli($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if(isset($_POST['submitTimetable'])){
		$day = $_POST["day"] ;
		$time = $_POST["time"] ;            
		$department = $_POST["depart"] ;            
		$semester = $_POST["semester"] ;            
		$section = $_POST["section"] ;            
		$subject = $_POST["subject"] ;            
		$instructor = $_POST["instructor"] ;            
		$block = $_POST["block"] ;            
		$room = $_POST["room"] ;         
		insertDataInTimeTable($dbname,$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room);
	}
	
 	
	FUNCTION insertDataInTimeTable($dbname,$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room){			
		$sql = "SELECT time_id FROM time WHERE day='{$day}' AND time='{$time}'";
		$result = $GLOBALS["conn"]->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$timeid = $row["time_id"] ;
			}
		} else {
			echo "0 results";
		}	
				
		$sql = "SELECT dept_id FROM department WHERE dept_name='{$department}' AND semester= $semester AND section='{$section}'";
		$result = $GLOBALS["conn"]->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$deptid = $row["dept_id"] ;
			}
		} else {
			echo "0 results";
		}	
				
		$sql = "SELECT cid.course_id AS course FROM course AS cid JOIN instructor AS inst USING(instructor_id) WHERE cid.subject='{$subject}' AND CONCAT(inst.firstname,' ',inst.lastname)='{$instructor}'";
		$result = $GLOBALS["conn"]->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$courseid = $row["course"] ;
			}
		} else {
			echo "0 results";
		}			
		$sql = "INSERT INTO timetable (time_id, dept_id,course_id,block,room) VALUES ($timeid,$deptid,$courseid,'{$block}','{$room}')";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
		}
	}
?>