
	<?php

	  /** The following is for local development  */
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
// edited code for to set up the connection
		$conn = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "select * from timetable" ;
		$result = $GLOBALS["conn"]->query($sql);
		$numrows = $result->num_rows ;
	for($i=0 ; $i<$numrows ;$i++){
		
		if(isset($_POST['Update'.$i])){
			$day = $_POST["day"] ;
			
			$time = $_POST["time"] ;            
			$department = $_POST["deptname"] ;            
			$semester = $_POST["semester"] ;            
			$section = $_POST["section"] ;            
			$subject = $_POST["subject"] ;            
			$instructor = $_POST["instructor"] ;            
			$block = $_POST["block"] ;            
			$room = $_POST["room"] ;			
			updateData("timetabledata","timetable",$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room);
		} 	
		if(isset($_POST['Delete'.$i])){
			$day = $_POST["day"] ;
			$time = $_POST["time"] ;            
			$department = $_POST["deptname"] ;            
			$semester = $_POST["semester"] ;            
			$section = $_POST["section"] ;            
			$subject = $_POST["subject"] ;            
			$instructor = $_POST["instructor"] ;            
			$block = $_POST["block"] ;            
			$room = $_POST["room"] ;			
			deleteData("timetabledata","timetable",$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room);
		} 	
	}

		FUNCTION updateData($dbname,$tablename,$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room){

			$sql = "SELECT time_id FROM time WHERE day='{$day}' AND time='{$time}'";
			$result = $GLOBALS["conn"]->query($sql);
			if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$timeid = $row["time_id"] ;
					}
			}			$sql = "SELECT dept_id FROM department WHERE dept_name='{$department}' AND semester= $semester AND section='{$section}'";
			$result1 = $GLOBALS["conn"]->query($sql);
			if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
						$deptid = $row1["dept_id"] ;
					}
			}	
			$sql = "SELECT cid.course_id AS course FROM course AS cid JOIN instructor AS inst USING(instructor_id) WHERE cid.subject='{$subject}' AND CONCAT(inst.firstname,' ',inst.lastname)='{$instructor}'";
			$result2 = $GLOBALS["conn"]->query($sql);
			if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {
						$courseid = $row2["course"] ;
					}
			}
			$sql = "UPDATE ".$tablename." SET course_id=$courseid ,block= '{$block}', room=$room WHERE time_id=$timeid AND dept_id=$deptid ";
			if ($GLOBALS['conn']->query($sql) === TRUE) {
				
			}
		}
		FUNCTION deleteData($dbname,$tablename,$day,$time,$department,$semester,$section,$subject,$instructor,$block,$room){
			$sql = "SELECT time_id FROM time WHERE day='{$day}' AND time='{$time}'";
			$result = $GLOBALS["conn"]->query($sql);
			if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$timeid = $row["time_id"] ;
					}
			}			$sql = "SELECT dept_id FROM department WHERE dept_name='{$department}' AND semester= $semester AND section='{$section}'";
			$result1 = $GLOBALS["conn"]->query($sql);
			if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {
						$deptid = $row1["dept_id"] ;
					}
			}	
			$sql = "SELECT cid.course_id AS course FROM course AS cid JOIN instructor AS inst USING(instructor_id) WHERE cid.subject='{$subject}' AND CONCAT(inst.firstname,' ',inst.lastname)='{$instructor}'";
			$result2 = $GLOBALS["conn"]->query($sql);
			if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {
						$courseid = $row2["course"] ;
					}
			}
			$sql= "DELETE FROM ".$tablename. " WHERE time_id=$timeid AND dept_id=$deptid ";
			$result3 = $GLOBALS["conn"]->query($sql) ; 
			
		}
?>
