<?php
/** The for For local development  */
	// $servername = "localhost";
	// $username = "alex";
	// $password = "alEx@2022@zuct";
	// $dbname = "timetabledata";
	         /* From heroku to the server  */
	  //Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
//$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);v



/** for local development */
		$servername = $cleardb_server;
		$username = $cleardb_username;
		$password = $cleardb_password;
		$dbname = $cleardb_db;
// edited code for to set up the connection

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
