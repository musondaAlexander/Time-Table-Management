
<script>
	var ab1 = [101,102,103,104,105,106,107,108,109,110] ;
	var ab2 = [201,202,203,204,205,206,207,208,209,210] ;
	var ab3 = [301,302,303,304,305,306,307,308,309,310] ;
	var blocks = ["AB-I","AB-II","AB-III"] ;
			
	function getRooms(s1,s2){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = '' ;
		if(s1.value=="AB-I"){
			var ab=ab1 ;
		}else if(s1.value=="AB-II"){
			var ab=ab2 ;
		}else{
			var ab=ab3 ;	
		}
		for(var index in ab){
			var newOption = document.createElement('option');
			newOption.innerHTML = ab[index];
			s2.options.add(newOption);
		}					
	}	
			
	var arraysubject =
	"<?php	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "timetabledata";
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
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name ,subject FROM course JOIN instructor USING(instructor_id) ORDER BY name";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['name'].'|';
			}
		} else {
			echo "0 results";
		}
	?>";	
						
	var arraydepartment =
	"<?php	
		$sql = "SELECT dept_name , semester , section FROM department";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['dept_name'].','.$row['semester'].','.$row['section'].'|';
			}
		} else {
			echo "0 results";
		}
	?>";	
			
	arraydepartment = arraydepartment.slice(0,arraydepartment.length-1) ;
	arraydepartment = arraydepartment.split('|') ;
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		arraydepartment[i] = arraydepartment[i].split(',');
	}

	for(var i = 0 ; i<arraydepartment.length ; i++){
		for(var k = i ; k<arraydepartment.length ; k++){
			if(arraydepartment[i][0]==arraydepartment[k][0] & i!=k){			 
				arraydepartment[i][1] = arraydepartment[i][1]+","+arraydepartment[k][1] ;
				arraydepartment[i][2] = arraydepartment[i][2]+","+arraydepartment[k][2] ;
				arraydepartment.splice(k,1);
				k-- ;
			}
		}
	}
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		arraydepartment[i][1] = arraydepartment[i][1].split(",") ;
		arraydepartment[i][2] = arraydepartment[i][2].split(",") ;
	}
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		for(var j=0 ; j<arraydepartment[i][1].length ; j++){
			for(var k=j ; k<arraydepartment[i][1].length ; k++){
				if(arraydepartment[i][1][j]==arraydepartment[i][1][k] & j!=k){
					arraydepartment[i][2][j] = arraydepartment[i][2][j]+","+arraydepartment[i][2][k] ;
					arraydepartment[i][1].splice(k,1) ;
					arraydepartment[i][2].splice(k,1) ;
				}
			}
		}
	}
			
	for(var i=0 ; i<arraydepartment.length ; i++){
		for(var j=0 ; j<arraydepartment[i][1].length ; j++){
			arraydepartment[i][2][j] = arraydepartment[i][2][j].split(",") ;
		}
	}			

			
	arraysubject = arraysubject.slice(0,arraysubject.length-1) ;
	arrayinstructor = arrayinstructor.slice(0,arrayinstructor.length-1) ;
	arraysubject = arraysubject.split("|");
	arrayinstructor = arrayinstructor.split("|");
</script>
		
<?php			
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
