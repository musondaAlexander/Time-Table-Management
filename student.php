<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		* {
			padding: 0;
			margin: 0px;
		}


		td {
			background: rgba(0, 0, 0, 0.6);
		}

		table,
		tr,
		th,
		td {
			border: 2px outset white;
			border-collapse: collapse;
			text-align: center;

			color: white;
			font-size: 18px;

		}

		tr,
		th {
			padding: 15px;


		}

		#ttt {
			padding-left: 80px;
			text-align: center;
			padding-right: 50px;
		}

		#tab::-webkit-scrollbar {
			display: none;
		}

		#tab {
			width: 1100px;
			height: 400px;
			order: scroll;
			overflow-x: auto;
			overflow-y: auto;
			margin-left: -1%;

		}

		.dy {
			padding-right: 50px;
		}

		#dy {
			padding-right: 25px;
			padding-left: 25px;
		}

		th {
			position: sticky;
			top: 0;
			background: rgba(0, 0, 0, 0.7);
		}
	</style>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>TimeTable</title>
	<link rel="icon" type="image/x-icon" href="assets/img/topLogo1.png" />
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/styless.css" rel="stylesheet" />
</head>

<body id="page-top">
	<!-- Navigation-->
	<?php
	/*			session_start();
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
			}
			*/
	?>

	<?php include 'View\\view.php'; ?>
	<?php include 'ArraysFunctions\\arraysfunctions.php'; ?>
	<?php include 'Course\course.php'; ?>

	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars ml-1"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ml-auto">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="student.php" id='back1'>Home</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
					<script>
						var position = "<?php echo $_SESSION['position'] ?>";
						if (position == 'Student') {
							var s1 = document.getElementById('back1');
							s1.style.visibility = "hidden";
						}
					</script>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Masthead-->
	<header class="masthead" style="color: #000">
		<div class="container">
			<h2 align="center" style="margin-top: -15%; color: yello; ">
				Time table
			</h2>
			<br>
			<script>
				function f() {
					alert('hj')
				};
			</script>
			<form method="POST">
				<input type="radio" name='searchWith' value='department' style=" margin-left: 0%;margin-right: 8%; " checked>
				<b style=" margin-left: -8%;margin-right: 75%; ">Department: </b>
				<select id="departV" name="deptnameV" style=" margin-left: -75%; margin-top: -30%; " onchange="getSemesterSection(this.id,'semesterV','sectionV')">
					<script>
						var depart = document.getElementById('departV');
						for (var i = 0; i < arraydepartment.length; i++) {
							var newOption = document.createElement('option');
							newOption.innerHTML = arraydepartment[i][0];
							newOption.selected = true;
							depart.options.add(newOption);
						}
					</script>
				</select>
				<select id="semesterV" name="semesterV" onchange="getSection('departV',this.id,'sectionV')">
					<script>
						var semester = document.getElementById('semesterV');
						var depart = document.getElementById('departV');
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
				<select id="sectionV" name="sectionV">
					<script>
						var semester = document.getElementById('semesterV');
						var depart = document.getElementById('departV');
						var section = document.getElementById('sectionV');
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
				<input type="radio" name='searchWith' value='instructor'>
				<b style=" margin-left: 0%;margin-right: 0%; ">Instructor: </b>
				<select name="InstructorV">
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
				<br><br>
				<input type='submit' id='search' name='submitSearch' onsubmit='f()' value="Go" style="padding-right:10px;padding-left:10px">
			</form>
			<div class="tab" id="tab">
				<table id='viewtable' style="margin-left: 11%; margin-top: 6%; ">
					<tr id="headings" class="text-uppercase">
						<th id="dy">
							Day
						</th>
						<th id="ttt">
							Time
						</th>
						<th>
							Department
						</th>

						<th>
							Subject
						</th>
						<th>
							Instructor
						</th>
						<th>
							Room#
						</th>
						<th>
							Duration
						</th>
					</tr>
					<?php
					if (isset($_POST['submitSearch'])) {
						if ($_POST['searchWith'] == 'department') {
							getDataDepart($_POST['deptnameV'], $_POST['semesterV'], $_POST['sectionV']);
						}
						if ($_POST['searchWith'] == 'instructor') {
							getDataInst($_POST['InstructorV']);
						}
					}
					?>
				</table>
			</div>
	</header>
	<!-- Services-->

	<!-- Clients-->

	<!-- Contact-->
	<section class="page-section" id="contact">
		<div class="container">
			<div class="text-center">
				<h2 class="section-heading text-uppercase">Contact Us</h2>
				<h3 class="section-subheading text-muted">For Feedback.</h3>
			</div>
			<form id="contactForm" name="sentMessage" novalidate="novalidate">
				<div class="row align-items-stretch mb-5">
					<div class="col-md-6">
						<div class="form-group">
							<input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name." />
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group">
							<input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address." />
							<p class="help-block text-danger"></p>
						</div>
						<div class="form-group mb-md-0">
							<input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number." />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-textarea mb-md-0">
							<textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
							<p class="help-block text-danger"></p>
						</div>
					</div>
				</div>
				<div class="text-center">
					<div id="success"></div>
					<button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit" style="background: #000;">Send Message</button>
				</div>
			</form>
		</div>
	</section>
	<br><br><br>
	<!-- Footer-->
	<footer class="footer py-4">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-4 text-lg-left">Copyright © Your Website 2020</div>
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