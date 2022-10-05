<?php
/** The for For local development  */
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

	session_start() ;
	if(isset($_POST["login"])){
		$_SESSION["id"] = $_POST["id"] ;
		$_SESSION["password"] = $_POST["password"] ;
		$_SESSION["last_time"] = time() ;
		if(!empty($_POST['id']&&!empty($_POST['password']))){
			$id = $_POST["id"] ;
			$pas = $_POST["password"];
			
			if($id == "Admin" && $pas == "Admin"){
				if(!empty($_POST["remember"])) {
					setcookie ("member_login",$_POST["id"],time()+ (10 * 365 * 24 * 60 * 60));
				} else {
					if(isset($_COOKIE["member_login"])) {
						setcookie ("member_login","");
					}
				}
				$_SESSION['position'] = 'Admin' ;
				header('Location:admin.php');
			}
			
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
					else if($userpos=="Instructor"){
						$_SESSION['position'] = 'Instructor' ;
						header('Location:instructorView.php');
					}
				}
				}
			$conn->close() ;	
			} else {
				echo "Invalid username and password";
			}
		}else{
			echo "Require all fields" ;	
		}	
?>
