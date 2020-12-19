<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "logindata";
	if(isset($_POST["login"])){
		$id = $_POST["id"] ;
		$pas = $_POST["password"];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	$sql = "SELECT id, password, position FROM data WHERE id='{$id}' AND password='{$pas}';";
		$result = $conn->query($sql);

		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				if($row['position']=="Admin"){
					echo "<script>location.href='admin.php';</script>";
				}
			}
		} else {
			echo "<script>location.href='index.php';</script>";
		}
		$conn->close() ;
	}
?>
