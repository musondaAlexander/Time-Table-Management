<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Admin Panel</title>
	<!-- Font Awesome icons (free version)-->
	<link rel="icon" type="image/x-icon" href="assets/img/topLogo1.png" />
	<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
	<?php
	/*	session_start();
			if(isset($_SESSION["id"])){
				if((time()-$_SESSION['last_time'])>60){
					header('Location:logout.php');
				}
				else{
					$_SESSION['last_time'] = time() ;
				}
			}
			else{
				header('location:index.php') ;
			}*/
	?>
	<!-- Navigation-->
	<?php include "Create Table\\CreateTable.php"; ?>
	<?php include 'Instructor\\Instructor.php'; ?>
	<?php include 'Department\\Department.php'; ?>
	<?php include 'TimeTable\\TimeTable.php'; ?>
	<?php include 'Course\\Course.php'; ?>
	<?php include 'Registration\\Registration.php'; ?>
	<?php include 'ArraysFunctions\\arraysfunctions.php'; ?>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars ml-1"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ml-auto">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Register">Member</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Instructors">Teachers</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#course">Subjects</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#department">Department</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#timetable">Timetable</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Masthead-->
	<header class="masthead">
		<div class="container">
			<div class="masthead-subheading" style="color: #000;">Academic Timetable!</div>
			<div class="masthead-heading text-uppercase" style="color: #000;">Secondary Schools</div>
			<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" onclick="changeheaderview()" style="background: #000;">View TimeTable</a>
			<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" onclick="changeheaderview1()" style="background: #000;">Update TimeTable</a>
			<script>
				function changeheaderview() {
					window.location = 'student.php';
				}

				function changeheaderview1() {
					window.location = 'adminupdate.php';
				}
			</script>
		</div>
	</header>

	<!-- Services-->
	<section class="page-section" id="Register">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">Pupils</h2>
				<h3 class="section-subheading text-muted">Please Fill The Following Form for Registering Pupils.</h3>
			</div>
			<center>
				<div class="Register_form">
					<form action="#Register" method="POST">
						<input type="text" name="fname" placeholder="FirstName" required><br><br>
						<input type="text" name="lname" placeholder="LastName" required><br><br>
						<input type="text" name="email" placeholder="Email" required><br><br>
						<input type="text" name="cms_id" placeholder="Id" required><br><br>
						<input type="text" name="password" placeholder="Password" required><br><br>
						Department:
						<select name="position">
							<option value="Admin">Admin</option>
							<option value="Instructor">Teacher</option>
							<option value="Student" selected>Pupil</option>
						</select>
						<br><br>
						<input type="submit" name="submitMember" value="Add"><br><br>
					</form>
				</div>
			</center>


		</div>
	</section>



	<!-- Services-->
	<section class="page-section" id="Instructors">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">Teachers</h2>
				<h3 class="section-subheading text-muted">Please Fill The Following Form for Teachers.</h3>
			</div>



			<center>
				<div class="Instructor_form">
					<form action="#Instructors" method="POST">
						<input type="text" name="fname" placeholder="Teacher FirstName" required><br><br>
						<input type="text" name="lname" placeholder="Teacher LastName" required><br><br>
						<input type="text" name="email" placeholder="Teacher Email" required><br><br>
						<input type="submit" name="submitInstructor" value="Add"><br><br>
					</form>
				</div>
			</center>





		</div>
	</section>


	<!-- About-->
	<section class="page-section" id="department">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">Department</h2>
				<h3 class="section-subheading text-muted">Please Fill The Following Form for Department.</h3>
			</div>

			<center>
				<div class="department_form">
					<form action="#department" method="POST">
						<input type="text" name="department_name" placeholder="Department Name" required><br><br>
						<input type="text" name="semester" placeholder="Term" required><br><br>
						<input type="text" name="section" placeholder="section" required><br><br>
						<input type="submit" name="submitDepartment" value="Add"><br><br>
					</form>
				</div>
			</center>



	</section>

	<?php include 'ArraysFunctions\\arraysfunctions.php'; ?>
	<!-- Portfolio Grid-->
	<section class="page-section bg-light" id="course">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">Subjects</h2>
				<h3 class="section-subheading text-muted">Please Fill The Following Form for Subjects.</h3>
			</div>

			<center>
				<div class="course_form">
					<form action="#course" method="POST">
						<input type="text" name="subjectC" placeholder="Subject Name" required><br><br>
						<input type="text" name="durationC" placeholder="Study Duration" required><br><br>
						Department:
						<select id="departC" name="deptnameC" onchange="getSemesterSection(this.id,'semesterC','sectionC')" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var depart = document.getElementById('departC');
								for (var i = 0; i < arraydepartment.length; i++) {
									var newOption = document.createElement('option');
									newOption.innerHTML = arraydepartment[i][0];
									newOption.selected = true;
									depart.options.add(newOption);
								}
							</script>
						</select>
						<select id="semesterC" name="semesterC" onchange="getSection('departC',this.id,'sectionC')" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var semester = document.getElementById('semesterC');
								var depart = document.getElementById('departC');
								for (var i = 0; i < arraydepartment.length; i++) {
									for (var j = 0; j < arraydepartment[i][1].length; j++) {
										if (arraydepartment[i][0] == depart.value) {
											var newOption = document.createElement('option');
											newOption.innerHTML = arraydepartment[i][1][j];
											newOption.selected = true;
											semester.options.add(newOption);
										}
									}
								}
							</script>
						</select>
						<select id="sectionC" name="sectionC" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var semester = document.getElementById('semesterC');
								var depart = document.getElementById('departC');
								var section = document.getElementById('sectionC');
								for (var i = 0; i < arraydepartment.length; i++) {
									for (var j = 0; j < arraydepartment[i][1].length; j++) {
										if (arraydepartment[i][0] == depart.value & arraydepartment[i][1][j] == semester.value) {
											for (var m = 0; m < arraydepartment[i][1][j].length; m++) {
												var newOption = document.createElement('option');
												newOption.innerHTML = arraydepartment[i][2][j][m];
												newOption.selected = true;
												section.options.add(newOption);
											}
										}
									}
								}
							</script>
						</select><br><br>
						<div>
							Teacher: <select name="instructorC" required oninvalid="this.setCustomValidity('First fill teacher form!')">
								<?php
								$result = getInstructors();
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<option>" . $row["name"] . "</option>";
									}
								} else {
									echo "0 results";
								}
								?>
							</select>
						</div>
						<br><br>
						<input type="submit" name="submitCourse" placeholder="Add"><br>
					</form>
				</div>
			</center>
	</section>

	<?php include 'ArraysFunctions\\arraysfunctions.php'; ?>
	<!-- Team-->
	<section class="page-section bg-light" id="timetable">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">TimeTable</h2>
				<h3 class="section-subheading text-muted">Please Fill The Following Form for TimeTable</h3>
			</div>

			<center>
				<div class="timetable_form">
					<form action="#timetable" method="POST">
						Time:
						<select id="day" name="day" required>
							<?php
							$days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
							for ($inn = 0; $inn < 7; $inn++) {
								echo "<option>$days[$inn]</option>";
							}
							?>
						</select>
						<select id="time" name="time" required>
							<?php
							$time = array("01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30", "06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30", "24:00", "24:30");

							for ($inn = 0; $inn < 48; $inn++) {
								echo "<option>$time[$inn]</option>";
							}
							?>
						</select><br><br>

						Department:
						<select id="depart" name="depart" onchange="getSemesterSection(this.id,'semester','section')" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var depart = document.getElementById('depart');
								for (var i = 0; i < arraydepartment.length; i++) {
									var newOption = document.createElement('option');
									newOption.innerHTML = arraydepartment[i][0];
									newOption.selected = true;
									depart.options.add(newOption);
								}
							</script>
						</select>
						<select id="semester" name="semester" onchange="getSection('depart',this.id,'section')" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var semester = document.getElementById('semester');
								var depart = document.getElementById('depart');
								for (var i = 0; i < arraydepartment.length; i++) {
									for (var j = 0; j < arraydepartment[i][1].length; j++) {
										if (arraydepartment[i][0] == depart.value) {
											var newOption = document.createElement('option');
											newOption.innerHTML = arraydepartment[i][1][j];
											newOption.selected = true;
											semester.options.add(newOption);
										}
									}
								}
							</script>
						</select>
						<select id="section" name="section" onchange="getSubjectInstructor('depart','semester',this.id,'subject','instructor')" required oninvalid="this.setCustomValidity('First fill departments form!')">
							<script>
								var semester = document.getElementById('semester');
								var depart = document.getElementById('depart');
								var section = document.getElementById('section');
								for (var i = 0; i < arraydepartment.length; i++) {
									for (var j = 0; j < arraydepartment[i][1].length; j++) {
										if (arraydepartment[i][0] == depart.value & arraydepartment[i][1][j] == semester.value) {
											for (var m = 0; m < arraydepartment[i][2][j].length; m++) {
												var newOption = document.createElement('option');
												newOption.innerHTML = arraydepartment[i][2][j][m];
												newOption.selected = true;
												section.options.add(newOption);
											}
										}
									}
								}
							</script>
						</select><br><br>
						Subject:
						<select id="subject" name="subject" required oninvalid="this.setCustomValidity('First fill subjects form!')">
							<script>
								var s1o = document.getElementById('depart');
								var s2o = document.getElementById('semester');
								var s3o = document.getElementById('section');
								var s4o = document.getElementById('subject');
								s4o.innerHTML = '';
								var subjectArrays = new Array();
								var bool = true;
								for (var i = 0; i < arraysubject.length; i++) {
									for (var j = i; j < arraysubject.length; j++) {
										if (arraysubject[i] == arraysubject[j] & i != j) {
											bool = false;
											break;
										}
									}
									if (bool == true) {
										subjectArrays.push(arraysubject[i]);
									}
									bool = true;
								}
								var departmentid = s1o.value + s2o.value + s3o.value;
								for (var index in arrayDeptSubject) {
									if (arrayDeptSubject[index].search(departmentid) != -1) {
										var sub = arrayDeptSubject[index].replace(departmentid, "");
										for (var index in subjectArrays) {
											if (sub == subjectArrays[index]) {
												var newOption = document.createElement('option');
												newOption.innerHTML = subjectArrays[index];
												newOption.selected = true;
												s4o.options.add(newOption);
											}
										}
									}
								}

								document.getElementById('subject').onchange = function() {
									getInstructorsA('subject', 'instructor', s1.value + s2.value + s3.value);
								}
							</script>
						</select><br><br>
						Teacher:
						<select id="instructor" name="instructor" required oninvalid="this.setCustomValidity('First fill instructors form!')">
							<script>
								var s1 = document.getElementById('depart');
								var s2 = document.getElementById('semester');
								var s3 = document.getElementById('section');
								getInstructorsA('subject', 'instructor', s1.value + s2.value + s3.value);
							</script>

						</select><br><br>

						Room:
						<select id="block" name="block" onchange="getRooms(this.id,'room')">
							<script>
								var blck = document.getElementById('block');
								for (var index in blocks) {
									var newOption = document.createElement('option');
									newOption.innerHTML = blocks[index];
									blck.options.add(newOption);
								}
							</script>
						</select>
						<select id="room" name="room">
							<script>
								var rom = document.getElementById('room');
								for (var index in ab1) {
									var newOption = document.createElement('option');
									newOption.innerHTML = ab1[index];
									rom.options.add(newOption);
								}
							</script>
						</select><br><br>
						<input type="submit" name="submitTimetable" value="Add">
					</form>
				</div>
			</center>

	</section>
	<!-- Clients-->

	<!-- Contact-->

	<!-- Footer-->
	<footer class="footer py-4">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-4 text-lg-left"><a class="mr-3"> Copyright © Your Website 2022</a> </div>
				<div class="col-lg-4 my-3 my-lg-0">
					<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
					<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
					<a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<div class="col-lg-4 text-lg-right">
					<a class="mr-3" href="#!">Privacy Policy</a>
					<a href="#!">Terms of Use</a>
				</div>
			</div>
		</div>
	</footer>
	<!-- Portfolio Modals-->
	<!-- Modal 1-->



	<!-- Bootstrap core JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Third party plugin JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<!-- Contact form JS-->
	<script src="assets/mail/jqBootstrapValidation.js"></script>
	<script src="assets/mail/contact_me.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
</body>

</html>