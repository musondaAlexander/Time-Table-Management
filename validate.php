<?php
	$servername = "ec2-54-165-164-38.compute-1.amazonaws.com";
	$username = "xjjquyygxekumw";
	$password = "6bdcc4ece64cad8352f077702c5d070e37c902d8945f102ec1ce40385e5042d4";
	$dbname = "dc2d4prt0alnr0";
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
				$row = $result->fetch_assoc(); 
					$userid = $row['id'] ;	
					$userpas =	$row['password'] ;
					$userpos =	$row['position'] ;
				
				if($id==$userid && $pas==$userpas){
					
					if(!empty($_POST["remember"])) {
						setcookie ("member_login",$_POST["id"],time()+ (10 * 365 * 24 * 60 * 60));
					} else {
						if(isset($_COOKIE["member_login"])) {
							setcookie ("member_login","");
						}
					}
					
					if($userpos=="Admin"){
						$_SESSION['position'] = 'Admin' ;
						header('Location:admin.php');
					}
					else if($userpos=="Student"){
						$_SESSION['position'] = 'Student' ;
						header('Location:student.php');
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
