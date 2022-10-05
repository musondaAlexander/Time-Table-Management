<?php
	$servername = "localhost";
	$username = "alex";
	$password = "alEx@2022@zuct";
	$dbname = "timetabledata";
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
