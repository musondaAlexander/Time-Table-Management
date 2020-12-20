<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "logindata";
	session_start() ;
	if(isset($_POST["login"])){
		$_SESSION["id"] = $_POST["id"] ;
		$_SESSION["password"] = $_POST["password"] ;
		$_SESSION["last_time"] = time() ;
		if(!empty($_POST['id']&&!empty($_POST['password']))){
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
					$userid = $row['id'] ;	
					$userpas =	$row['password'] ;
					$userpos =	$row['position'] ;
				}
				
				if($id==$userid && $pas==$userpas){
					if($userpos=="Admin"){
						header('Location:admin.php');
					}
				}
			$conn->close() ;	
			} else {
				echo "Invalid username and password";
			}
		}else{
			echo "Require all fields" ;	
		}
	}	
?>
