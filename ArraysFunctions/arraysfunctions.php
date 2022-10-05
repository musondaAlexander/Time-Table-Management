<script>
	var ab1 = [101,102,103,104,105,106,107,108,109,110] ;
	var ab2 = [201,202,203,204,205,206,207,208,209,210] ;
	var ab3 = [301,302,303,304,305,306,307,308,309,310] ;
	var blocks = ["AB-I","AB-II","AB-III"] ;

	function getSection(s1,s2,s3){
		var s1o = document.getElementById(s1);
		var s2o = document.getElementById(s2);
		var s3o = document.getElementById(s3);
		s3o.innerHTML = '' ;
		for(var i=0 ; i<arraydepartment.length ; i++){
			for(var j=0 ; j<arraydepartment[i][1].length;j++){
				if(arraydepartment[i][0]==s1o.value & arraydepartment[i][1][j]==s2o.value){
					for(var m=0; m<arraydepartment[i][2][j].length ; m++ ){
						var newOption = document.createElement('option');
						newOption.innerHTML = arraydepartment[i][2][j][m];
						newOption.selected = true ;
						s3o.options.add(newOption);
					}
				}
			}
		}
		getSubjectInstructor(s1,s2,s3,'subject','instructor') ;
	}

	function getSemesterSection(s1,s2,s3){
		var s1o = document.getElementById(s1);
		var s2o = document.getElementById(s2);
		var s3o = document.getElementById(s3);
		s2o.innerHTML = '' ;
		s3o.innerHTML = '' ;
		for(var i=0 ; i<arraydepartment.length ; i++){
			for(var j=0 ; j<arraydepartment[i][1].length;j++){
				if(arraydepartment[i][0]==s1o.value){
					var newOption = document.createElement('option');
					newOption.innerHTML = arraydepartment[i][1][j];
					newOption.selected = true ;
					s2o.options.add(newOption);
				}
			}
		}
		getSection(s1,s2,s3) ;
		getSubjectInstructor(s1,s2,s3,'subject','instructor') ;
	}
							
	function getRooms(s1,s2){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = '' ;
		if(s1.value=="AB-I"){
			var ab=ab1 ;
		}else if(s1.value=="AB-II"){
			var ab=ab2 ;
		}else{
			var ab=ab3 ;	
		}
		for(var index in ab){
			var newOption = document.createElement('option');
			newOption.innerHTML = ab[index];
			newOption.selected = true ;
			s2.options.add(newOption);
		}					
	}	

	function getInstructors(s1,s2){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = '' ;
		for(var index in arrayinstructor){
			if(arraysubject[index]==s1.value){
				var newOption = document.createElement('option');
				newOption.innerHTML = arrayinstructor[index];
				newOption.selected = true ;
				s2.options.add(newOption);
			}
		}
	}
	function getInstructorsU(s1,s2,s3){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = '' ;
		for(var index in arrayinstructor){
			if(arraysubject[index]==s1.value && deptforsubject[index]==s3){
				var newOption = document.createElement('option');
				newOption.innerHTML = arrayinstructor[index];
				newOption.selected = true ;
				s2.options.add(newOption);
			}
		}
	}

	function getInstructorsA(s1,s2,s3){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = '' ;
		for(var index in arrayinstructor){
			if(arraysubject[index]==s1.value && deptforAdmin[index]==s3){
				var newOption = document.createElement('option');
				newOption.innerHTML = arrayinstructor[index];
				newOption.selected = true ;
				s2.options.add(newOption);
			}
		}
	}

	function getSubjectInstructorUpdate(s1,s2,s3,s4){
		var s4o = document.getElementById(s4);
		s4o.innerHTML = '' ;
		var subjectArrays1 = new Array();
		var bool = true ; 
		for(var i=0 ; i<arraysubject.length ; i++){
			for(var j=i ; j<arraysubject.length ; j++){
				if(arraysubject[i]==arraysubject[j] & i!=j){
					bool = false ;
					break ;
				}
			}	
			if(bool==true){
				subjectArrays1.push(arraysubject[i]) ;
			}
			bool = true ;
		}
		var departmentid = s1+s2+s3 ;
		for(var index in arrayDeptSubject){
			if(arrayDeptSubject[index].search(departmentid) != -1 ){
				var sub = arrayDeptSubject[index].replace(departmentid,"") ;
				for(var index in subjectArrays1){
					if(sub==subjectArrays1[index]){
						var newOption = document.createElement('option');
						newOption.innerHTML = subjectArrays1[index];
						newOption.selected = true ;
						s4o.options.add(newOption);					
					}
				}					
			}
		}
	}
	
	function getSubjectInstructorUpdate1(s1,s2,s3,s4,s5){
		var s4o = document.getElementById(s4);
		s4o.innerHTML = '' ;
		var subjectArrays1 = new Array();
		var bool = true ; 
		for(var i=0 ; i<arraysubject.length ; i++){
			for(var j=i ; j<arraysubject.length ; j++){
				if(arraysubject[i]==arraysubject[j] & i!=j){
					bool = false ;
					break ;
				}
			}	
			if(bool==true){
				subjectArrays1.push(arraysubject[i]) ;
			}
			bool = true ;
		}
		var departmentid = s1+s2+s3 ;
		for(var index in arrayDeptSubject){
			if(arrayDeptSubject[index].search(departmentid) != -1 ){
				var sub = arrayDeptSubject[index].replace(departmentid,"") ;
				for(var index in subjectArrays1){
					if(sub==subjectArrays1[index]){
						var newOption = document.createElement('option');
						newOption.innerHTML = subjectArrays1[index];
						if(newOption.innerHTML==s5){
							newOption.selected=true ;
						}
						s4o.options.add(newOption);					
					}
				}					
			}
		}
	}

	function getSubjectInstructor(s1,s2,s3,s4,s5){
		var s1o = document.getElementById(s1);
		var s2o = document.getElementById(s2);
		var s3o = document.getElementById(s3);
		var s4o = document.getElementById(s4);
		var s5o = document.getElementById(s5);
		s4o.innerHTML = '' ;
		s5o.innerHTML = '' ;
		var subjectArrays = new Array();
		var bool = true ; 
		for(var i=0 ; i<arraysubject.length ; i++){
			for(var j=i ; j<arraysubject.length ; j++){
				if(arraysubject[i]==arraysubject[j] & i!=j){
					bool = false ;
					break ;
				}
			}	
			if(bool==true){
				subjectArrays.push(arraysubject[i]) ;
			}
			bool = true ;
		}
		var departmentid = s1o.value+s2o.value+s3o.value ;
		for(var index in arrayDeptSubject){
			if(arrayDeptSubject[index].search(departmentid) != -1 ){
				var sub = arrayDeptSubject[index].replace(departmentid,"") ;
				for(var index in subjectArrays){
					if(sub==subjectArrays[index]){
						var newOption = document.createElement('option');
						newOption.innerHTML = subjectArrays[index];
						newOption.selected = true ;
						s4o.options.add(newOption);					
					}
				}					
			}
		}
		getInstructorsA(s4,s5,s1o.value+s2o.value+s3o.value);
	}
			
	var arraysubject =
	"<?php	
		$servername = "localhost";
		$username = "alex";
		$password = "alEx@2022@zuct";
		$dbname = "timetabledata";
		$conn = new mysqli($GLOBALS['servername'],$GLOBALS['username'],$GLOBALS['password'],$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name , subject FROM course JOIN instructor USING(instructor_id) ORDER BY name,subject";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['subject']."|";
			}
		}
		?>";

	var arrayDeptSubject = 
	"<?php	
		$sql = "SELECT dept_name,semester,section, subject FROM course JOIN department USING(dept_id)";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['dept_name'].$row['semester'].$row['section'].$row['subject']."|";
			}
		}
		?>";

	var arrayinstructor =
	"<?php	
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name ,subject FROM course JOIN instructor USING(instructor_id) ORDER BY name,subject";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['name'].'|';
			}
		}
		?>";	

	var deptforsubject =
	"<?php	
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name ,subject,dept_id FROM course JOIN instructor USING(instructor_id) JOIN department using(dept_id) ORDER BY name,subject";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['dept_id'].'|';
			}
		}
		?>";	
	var deptforAdmin =
	"<?php	
		$sql = "SELECT CONCAT(firstname,' ',lastname) AS name ,subject,dept_name,semester,section FROM course JOIN instructor USING(instructor_id) JOIN department using(dept_id) ORDER BY name,subject";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['dept_name'].$row['semester'].$row['section'].'|';
			}
		}
		?>";
						
	var arraydepartment =
	"<?php	
		$sql = "SELECT dept_name , semester , section FROM department";
		$result = $conn->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) { 
				echo $row['dept_name'].','.$row['semester'].','.$row['section'].'|';
			}
		}
		?>";	
			
	arraydepartment = arraydepartment.slice(0,arraydepartment.length-1) ;
	arraydepartment = arraydepartment.split('|') ;
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		arraydepartment[i] = arraydepartment[i].split(',');
	}

	for(var i = 0 ; i<arraydepartment.length ; i++){
		for(var k = i ; k<arraydepartment.length ; k++){
			if(arraydepartment[i][0]==arraydepartment[k][0] & i!=k){			 
				arraydepartment[i][1] = arraydepartment[i][1]+","+arraydepartment[k][1] ;
				arraydepartment[i][2] = arraydepartment[i][2]+","+arraydepartment[k][2] ;
				arraydepartment.splice(k,1);
				k-- ;
			}
		}
	}
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		arraydepartment[i][1] = arraydepartment[i][1].split(",") ;
		arraydepartment[i][2] = arraydepartment[i][2].split(",") ;
	}
			
	for(var i = 0 ; i<arraydepartment.length ; i++){
		for(var j=0 ; j<arraydepartment[i][1].length ; j++){
			for(var k=j ; k<arraydepartment[i][1].length ; k++){
				if(arraydepartment[i][1][j]==arraydepartment[i][1][k] & j!=k){
					arraydepartment[i][2][j] = arraydepartment[i][2][j]+","+arraydepartment[i][2][k] ;
					arraydepartment[i][1].splice(k,1) ;
					arraydepartment[i][2].splice(k,1) ;
				}
			}
		}
	}
			
	for(var i=0 ; i<arraydepartment.length ; i++){
		for(var j=0 ; j<arraydepartment[i][1].length ; j++){
			arraydepartment[i][2][j] = arraydepartment[i][2][j].split(",") ;
		}
	}			

	arrayDeptSubject = arrayDeptSubject.slice(0,arrayDeptSubject.length-1) ;			
	arraysubject = arraysubject.slice(0,arraysubject.length-1) ;
	deptforsubject = deptforsubject.slice(0,deptforsubject.length-1) ;
	deptforAdmin = deptforAdmin.slice(0,deptforAdmin.length-1) ;
	arrayinstructor = arrayinstructor.slice(0,arrayinstructor.length-1) ;
	arraysubject = arraysubject.split("|");
	deptforsubject = deptforsubject.split("|");
	deptforAdmin = deptforAdmin.split("|");
	arrayinstructor = arrayinstructor.split("|");
	arrayDeptSubject = arrayDeptSubject.split("|") ;

</script>
