<?php
    // for local development
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

	if(isset($_POST['submitCourse'])){
		$subject = $_POST["subjectC"] ;
		$deptname = $_POST["deptnameC"] ;
		$semester = $_POST["semesterC"] ;
		$section = $_POST["sectionC"] ;
		$duration = $_POST["durationC"] ;
		$instructor = $_POST["instructorC"] ;            
		if($deptname!="Null" && $semester!="Null" && $section!="Null"){
			insertDataInCourse(getDepartmentID($deptname,$semester,$section),$subject,$duration,getInstructorsID($instructor));
		}
		else{
			echo "First insert departments" ;
		}
	} 	
				
	FUNCTION getInstructorsID($instructorname){
		$sql = "SELECT instructor_id FROM instructor WHERE CONCAT(firstname,' ',lastname)='{$instructorname}'";
		$result = $GLOBALS['conn']->query($sql) ;
		$instructorid = 0 ;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$instructorid = $row["instructor_id"] ;
			}
		} else {
			echo "0 results";
		}
		return $instructorid ;
	}

	FUNCTION getDepartmentID($deptname,$semester,$section){
		$sql = "SELECT dept_id FROM department WHERE dept_name='{$deptname}' AND semester='{$semester}' AND section='{$section}'";
		$result = $GLOBALS['conn']->query($sql) ;
		$departmentid = 0 ;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$departmentid = $row["dept_id"] ;
			}
		} else {
			echo "0 results";
		}
		return $departmentid ;
	}

			
	FUNCTION insertDataInCourse($deptid,$subject,$duration,$instructorid){
		$sql = "INSERT INTO course(dept_id ,subject, duration,instructor_id) VALUES ('{$deptid}','{$subject}',$duration,$instructorid)";
		if ($GLOBALS['conn']->query($sql) === TRUE) {
		} else {
			echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
		}
	}
	FUNCTION getInstructors(){
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name FROM instructor";
		$result = $GLOBALS['conn']->query($sql);
		return $result ;
	}
	FUNCTION getDepartment(){
		$sql = "SELECT dept_name AS name FROM department";
		$result = $GLOBALS['conn']->query($sql);
		return $result ;
	}

?>
