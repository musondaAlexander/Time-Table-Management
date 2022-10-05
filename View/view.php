
	
<?php
/** The Following is for Local  development  */
// $servername = "localhost";
// $username = "root";
// $password = "";
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
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
function getDataDepart($depart,$semester,$section){
	$sql = "SELECT tm.day as day ,tm.time as time,dpt.dept_name as dptname ,dpt.semester as semester,dpt.section as section,sb.subject as subject,sb.duration as duration,CONCAT(ins.firstname,' ',ins.lastname) as name,tb.block as block,tb.room as room FROM timetable as tb JOIN time as tm USING(time_id) JOIN department as dpt USING(dept_id) JOIN course as sb USING(course_id) JOIN instructor as ins USING(instructor_id) WHERE dpt.dept_name='{$depart}' AND dpt.semester=$semester AND dpt.section='{$section}'";
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["day"]."</td><td>".$row["time"]."</td><td>".$row["dptname"]." ".$row["semester"]." ".$row["section"]."</td><td>".$row["subject"]."</td><td>".$row["name"]."</td><td>".$row["block"]." ".$row["room"]."</td><td>".$row["duration"]."</td></tr>";
		}
	} else {
				echo "<tr><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td></tr>";

	}
}
function getDataInst($instructor){
$sql = "SELECT tm.day as day ,tm.time as time,dpt.dept_name as dptname ,dpt.semester as semester,dpt.section as section,sb.subject as subject,sb.duration as duration,CONCAT(ins.firstname,' ',ins.lastname) as name,tb.block as block,tb.room as room FROM timetable as tb JOIN time as tm USING(time_id) JOIN department as dpt USING(dept_id) JOIN course as sb USING(course_id) JOIN instructor as ins USING(instructor_id) WHERE CONCAT(ins.firstname,' ',ins.lastname)='{$instructor}'";
	$result = $GLOBALS['conn']->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["day"]."</td><td>".$row["time"]."</td><td>".$row["dptname"]." ".$row["semester"]." ".$row["section"]."</td><td>".$row["subject"]."</td><td>".$row["name"]."</td><td>".$row["block"]." ".$row["room"]."</td><td>".$row["duration"]."</td></tr>";
		}
	} else {
				echo "<tr><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td><td>NULL</td></tr>";

	}
}


?>
