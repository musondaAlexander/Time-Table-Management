<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Page</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
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
			session_start();
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
		?>
        <!-- Navigation-->
		<?php include "Create Table\\CreateTable.php"; ?>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#Instructors" >Instructor</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#course">Course</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#department">Department</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#timetable">Timetable</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php" >Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading" style="color: #000;">Academic Timetable!</div>
                <div class="masthead-heading text-uppercase" style="color: #000;">Sukkur IBA University</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#Instructors" style="background: #000;">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="Instructors">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Instructors</h2>
                    <h3 class="section-subheading text-muted">Please Fill The Following Form for Instructor.</h3>
                </div>
                
                   

					<?php include 'Instructor\\Instructor.php';?>
                	<center>
                    <div class="Instructor_form">
                    	<form action="#Instructors" method="POST"> 
                    		<input type="text" name="fname" placeholder="Instructor FirstName"><br><br>
                    		<input type="text" name="lname" placeholder="Instructor LastName"><br><br>
                    		<input type="text" name="email" placeholder="Instructor Email"><br><br>
                    		<input type="submit" name="submitInstructor" value="Add" ><br><br>
                    	</form>
                    </div>
                </center>





            </div>
        </section>


        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="course">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Course</h2>
                    <h3 class="section-subheading text-muted">Please Fill The Following Form for Course.</h3>
                </div>
                
				
				<?php include 'Course\\Course.php';?>
                <center>
                <div class="course_form">
                    	<form action="#course" method="POST"> 
                    		<input type="text" name="subject" placeholder="Subject Name"><br><br>
                    		<input type="text" name="duration" placeholder="Study Duration"><br><br>
                    		<div>
                    			Instructor: <select name="instructor">
								<?php			
									$result = getInstructors() ;
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo "<option>" . $row["name"] . "</option>";
										}
									} else {
										echo "0 results";
									}
									$conn->close();
								?>
								</select>
                    		</div>
                    		<br><br>
                    		<input type="submit" name="submitCourse" placeholder="Add"><br>
                    	</form>
                    </div>
                </center>




        </section>
        <!-- About-->
        <section class="page-section" id="department">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Department</h2>
                    <h3 class="section-subheading text-muted">Please Fill The Following Form for Department.</h3>
                </div>
               
				<?php include 'Department\\Department.php';?>
               	<center><div class="department_form">
                    	<form action="#department" method="POST"> 
                    		<input type="text" name="department_name" placeholder="Department Name"><br><br>
                    		<input type="text" name="semester" placeholder="semester"><br><br>
                    		<input type="text" name="section" placeholder="section"><br><br>
                    		<input type="submit" name="submitDepartment" value="Add"><br><br>
                    	</form> 
                    </div></center>



        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="timetable">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">TimeTable</h2>
                    <h3 class="section-subheading text-muted">Please Fill The Following Form for TimeTable</h3>
                </div>
               
				<?php include 'TimeTable\\TimeTable.php';?>
                <center>
                <div class="timetable_form">	
						<form action="#timetable" method="POST">      
							Time:
							<select id="day" name="day">
								<?php
									$days = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun") ;
									for($inn=0 ; $inn<7 ; $inn++){
										echo "<option>$days[$inn]</option>" ;
									}
								?>
							</select>
							<select id="time" name="time">
								<?php	
									$time = array("01:00","01:30","02:00","02:30","03:00","03:30","04:00","04:30","05:00","05:30","06:00","06:30","07:00","07:30","08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00","21:30","22:00","22:30","23:00","23:30","24:00","24:30") ;
									
									for($inn=0 ; $inn<48 ; $inn++){
										echo "<option>$time[$inn]</option>" ;
									}
								?>
							</select><br><br>
							Department:
							<select id="depart" name="depart" onchange="getSemesterSection(this.id,'semester','section')">
							<script>	
								var depart = document.getElementById('depart');
								for(var i=0 ; i<arraydepartment.length ; i++){
									var newOption = document.createElement('option');
									newOption.innerHTML = arraydepartment[i][0];
									depart.options.add(newOption);
								}
							</script>
							<script>
								function getSemesterSection(s1,s2,s3){
									var s1 = document.getElementById(s1);
									var s2 = document.getElementById(s2);
									var s3 = document.getElementById(s3);
									s2.innerHTML = '' ;
									s3.innerHTML = '' ;
									for(var i=0 ; i<arraydepartment.length ; i++){
										for(var j=0 ; j<arraydepartment[i][1].length;j++){
											if(arraydepartment[i][0]==s1.value){
												var newOption = document.createElement('option');
												newOption.innerHTML = arraydepartment[i][1][j];
												s2.options.add(newOption);
											}
										}
									}
									for(var i=0 ; i<arraydepartment.length ; i++){
										for(var j=0 ; j<arraydepartment[i][1].length;j++){
											if(arraydepartment[i][0]==s1.value & arraydepartment[i][1][j]==s2.value){
												for(var m=0; m<arraydepartment[i][1][j].length ; m++ ){
													var newOption = document.createElement('option');
													newOption.innerHTML = arraydepartment[i][2][j][m];
													s3.options.add(newOption);
												}
											}
										}
									}
								}
							</script>							
							</select>
							<select id="semester" name="semester" onchange="getSection('depart',this.id,'section')">
							<script>
								var semester = document.getElementById('semester');
								var depart = document.getElementById('depart') ;
								for(var i=0 ; i<arraydepartment.length ; i++){
									for(var j=0 ; j<arraydepartment[i][1].length;j++){
										if(arraydepartment[i][0]==depart.value){
											var newOption = document.createElement('option');
											newOption.innerHTML = arraydepartment[i][1][j];
											semester.options.add(newOption);
										}
									}
								}
							</script>	
							</select>
							<script>
								function getSection(s1,s2,s3){
									var s1 = document.getElementById(s1);
									var s2 = document.getElementById(s2);
									var s3 = document.getElementById(s3);
									s3.innerHTML = '' ;
									for(var i=0 ; i<arraydepartment.length ; i++){
										for(var j=0 ; j<arraydepartment[i][1].length;j++){
											if(arraydepartment[i][0]==s1.value & arraydepartment[i][1][j]==s2.value){
												for(var m=0; m<arraydepartment[i][1][j].length ; m++ ){
													var newOption = document.createElement('option');
													newOption.innerHTML = arraydepartment[i][2][j][m];
													s3.options.add(newOption);
												}
											}
										}
									}
								}
							</script>
							<select id="section" name="section">
							<script>
								var semester = document.getElementById('semester');
								var depart = document.getElementById('depart') ;
								var section = document.getElementById('section') ;
								for(var i=0 ; i<arraydepartment.length ; i++){
									for(var j=0 ; j<arraydepartment[i][1].length;j++){
										if(arraydepartment[i][0]==depart.value & arraydepartment[i][1][j]==semester.value){
											for(var m=0; m<arraydepartment[i][1][j].length ; m++ ){
												var newOption = document.createElement('option');
												newOption.innerHTML = arraydepartment[i][2][j][m];
												section.options.add(newOption);
											}
										}
									}
								}
							</script>	
							</select><br><br>
							Subject:
							<select id="subject" name="subject" onchange="getInstructors(this.id,'instructor')">
							<script>
								var subj = document.getElementById('subject') ;
								for(var index in arraysubject){
									var newOption = document.createElement('option');
									newOption.innerHTML = arraysubject[index];
									subj.options.add(newOption);
								}
							</script>	
							</select><br><br>
							<script>
								function getInstructors(s1,s2){
									var s1 = document.getElementById(s1);
									var s2 = document.getElementById(s2);
									s2.innerHTML = '' ;
									for(var index in arrayinstructor){
										if(arraysubject[index]==s1.value){
											var newOption = document.createElement('option');
											newOption.innerHTML = arrayinstructor[index];
											s2.options.add(newOption);
										}
									}
								}
							</script>
							Instructor:
							<select id="instructor" name="instructor">
							
							<script>
								var inst = document.getElementById('instructor');
								for(var index in arrayinstructor){
									var newOption = document.createElement('option');
									newOption.innerHTML = arrayinstructor[index];
									inst.options.add(newOption);
								}
							</script>
							
							</select><br><br>

							Room: 
							<select id="block" name="block" onchange="getRooms(this.id,'room')">
							<script>	
								var blck = document.getElementById('block') ;
								for(var index in blocks){
									var newOption = document.createElement('option');
									newOption.innerHTML = blocks[index];
									blck.options.add(newOption);
								}					
							</script>
							</select>
							<select id="room" name="room">
							<script>	
								var rom = document.getElementById('room') ;
								for(var index in ab1){
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
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
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
