<?php
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
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
			echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
		}
	}
?>
