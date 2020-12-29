<html>
<body>
<script>
	var ab1 = [101,102,103,104,105,106,107,108,109,110] ;
	var ab2 = [201,202,203,204,205,206,207,208,209,210] ;
	var ab3 = [301,302,303,304,305,306,307,308,309,310] ;
	var blocks = ["AB-I","AB-II","AB-III"] ;
			

	var arraysubject =
	"<?php	
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
	$conn = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT CONCAT(firstname,' ',lastname) AS name , subject FROM course JOIN instructor USING(instructor_id) ORDER BY name";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()) { 
			echo $row['subject']."|";
		}
	} else {
		echo "0 results";
	}
	?>";

	var arrayinstructor =
	"<?php	
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
	$conn = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT CONCAT(firstname,' ',lastname) AS name ,subject FROM course JOIN instructor USING(instructor_id) ORDER BY name";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		while($row = $result->fetch_assoc()) { 
			echo $row['name']."|";
		}
	} else {
		echo "0 results";
	}
	?>";	
	
	arraysubject = arraysubject.slice(0,arraysubject.length-1) ;
	arrayinstructor = arrayinstructor.slice(0,arrayinstructor.length-1) ;			
	arraysubject = arraysubject.split('|');
	arrayinstructor = arrayinstructor.split('|');
</script>


	<?php
		$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
		$username = "xjjquyygxekumw";
		$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
		$dbname = "dc2d4prt0alnr0";
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
			} else {
			  echo "0 results";
			}	
			$sql = "UPDATE ".$tablename." SET course_id=$courseid ,block= '{$block}', room=$room WHERE time_id=$timeid AND dept_id=$deptid ";
			if ($GLOBALS['conn']->query($sql) === TRUE) {
				
			}
		}
?>
