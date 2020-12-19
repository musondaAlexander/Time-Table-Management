<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "timetabledata";
	$conn = new mysqli($servername,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_POST['submitCourse'])){
		$subject = $_POST["subject"] ;
		$duration = $_POST["duration"] ;
		$instructor = $_POST["instructor"] ;            
		insertDataInCourse($subject,$duration,getInstructorsID($instructor));
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
			
	FUNCTION insertDataInCourse($subject,$duration,$instructorid){
		$sql = "INSERT INTO course(subject, duration,instructor_id) VALUES ('{$subject}',$duration,$instructorid)";
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
?>
