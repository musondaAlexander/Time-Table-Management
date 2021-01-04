<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Update</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
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
		<?php include 'Update/Update.php';?>
		<?php include 'Instructor\\Instructor.php';?>
		<?php include 'Department\\Department.php';?>
		<?php include 'TimeTable\\TimeTable.php';?>
		<?php include 'Course\\Course.php';?>
		<?php include 'ArraysFunctions\\arraysfunctions.php';?>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
						<li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin.php" id='back1'>Home</a></li>                        
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>
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
				<form method="POST">
        					<b style=" margin-left: -8%;margin-right: 75%; ">Department: </b>
							<select id="deptnameU" name="deptnameU" style=" margin-left: -75%; margin-top: -30%; " onchange="getSemesterSection(this.id,'semesterU','sectionU')">
							<script>	
								var depart = document.getElementById('deptnameU');
								for(var i=0 ; i<arraydepartment.length ; i++){
									var newOption = document.createElement('option');
									newOption.innerHTML = arraydepartment[i][0];
									newOption.selected = true ;
									depart.options.add(newOption);
								}
							</script>
							</select>
							<select id="semesterU" name="semesterU" onchange="getSection('deptnameU',this.id,'sectionU')">
							<script>
								var semester = document.getElementById('semesterU');
								var depart = document.getElementById('deptnameU') ;
								for(var i=0 ; i<arraydepartment.length ; i++){
									for(var j=0 ; j<arraydepartment[i][1].length;j++){
										if(arraydepartment[i][0]==depart.value){
											var newOption = document.createElement('option');
											newOption.innerHTML = arraydepartment[i][1][j];
											newOption.selected = true ;
											semester.options.add(newOption);
										}
									}
								}
							</script>	
							</select>
							<select id="sectionU" name="sectionU">
							<script>
								var semester = document.getElementById('semesterU');
								var depart = document.getElementById('deptnameU') ;
								var section = document.getElementById('sectionU') ;
								for(var i=0 ; i<arraydepartment.length ; i++){
									for(var j=0 ; j<arraydepartment[i][1].length;j++){
										if(arraydepartment[i][0]==depart.value & arraydepartment[i][1][j]==semester.value){
											for(var m=0; m<arraydepartment[i][2][j].length ; m++ ){
												var newOption = document.createElement('option');
												newOption.innerHTML = arraydepartment[i][2][j][m];
												newOption.selected = true ;
												section.options.add(newOption);
											}
										}
									}
								}
							</script>	
							</select><br><br>
	               			<input type="submit" name="submitSearch" value="Search">
        </form>
        <br><br>
       
		<div class="tab"  id="tab" >
					 
			<?php
			if(isset($_POST['submitSearch'])){
					$searchDepart = $_POST['deptnameU'] ;
					$searchSemester = $_POST['semesterU'] ;
					$searchSection = $_POST['sectionU'] ;
				$sql = "SELECT day , time , subject , CONCAT(firstname,' ',lastname) AS name, block , room ,tb.dept_id as deptid,dept_name,semester,section FROM timetable as tb JOIN time USING(time_id) JOIN department USING(dept_id) JOIN course USING(course_id) JOIN instructor USING(instructor_id) WHERE dept_name='{$searchDepart}' AND semester='{$searchSemester}' AND section='{$searchSection}'";
				$result = $GLOBALS["conn"]->query($sql);
				if ($result->num_rows > 0) {
				$i =0 ;
				while($row = $result->fetch_assoc()) {
					echo "<form method='POST'>
					<input type='hidden' value=$searchDepart name='deptname'>
					<input type='hidden' value=$searchSemester name='semester'>
					<input type='hidden' value=$searchSection name='section'>
					<input type='text' value='{$row['day']}' name='day'  readonly='true'>
					<input type='text' value='{$row['time']}' name='time'  readonly='true'>";
					echo "<select id='subject$i' name='subject'>
							<script>
				getSubjectInstructorUpdate1('{$row['dept_name']}','{$row['semester']}','{$row['section']}','subject$i','{$row['subject']}');
								document.getElementById('subject$i').onchange = function(){	
									getInstructorsU(this.id,'instructor$i','{$row['deptid']}') ;
								}			
							</script>			
							</select>";
					echo "
					<select id='instructor$i' name='instructor'>
							<script>
								getInstructorsU('subject$i','instructor$i','{$row['deptid']}') ;
							</script>";
							
					echo"</select> 
							<select id='block$i' name='block'>
							<script>	
								var blck = document.getElementById('block$i') ;
								for(var index in blocks){
									var newOption = document.createElement('option');
									newOption.innerHTML = blocks[index];
									if(newOption.innerHTML=='{$row['block']}'){
										newOption.selected= true ;
									}
									blck.options.add(newOption);
								}
								document.getElementById('block$i').onchange = function(){	
									getRooms(this.id,'room$i') ;
								}								
							</script>";
					echo"</select>
							<select id='room$i' name='room'>
							<script>	
								var rom = document.getElementById('room$i') ;
								var newOption = document.createElement('option');
								newOption.innerHTML = '{$row['room']}';
								rom.options.add(newOption);
							</script>";
					echo"</select>
						<input type='submit' value='Update' name='Update$i'>
						<input type='submit' value='Delete' name='Delete$i'>
					</form><br>" ;
					$i++ ;
				}
			}
			}
			?>	

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
