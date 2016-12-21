<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    
    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../../css/custom.min.css" rel="stylesheet">
    <link href="../../css/tstheme/style.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="../js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "../../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../../resources/templates/registrar/top-nav.php"; ?>
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<form class="form-horizontal form-label-left" action=<?php echo "../../registrar/studentmanagement/student_list.php"; ?> method="POST" novalidate>
						

						<div class="">
							<div class="x_panel">
			                  <div class="x_title">
			                    <h2>First Year</h2>
			                    
			                    <div class="clearfix"></div>
			                  </div>
			                  <div class="x_content">
			                  	<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Student Curriculum</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select id="curriculum" class="form-control col-md-7 col-xs-12" name="curriculum">
												<!-- <option value="1">Regular</option>
												<option value="2">Special Science</option>
												<option value="3">Special Journalism</option> -->
												<?php
													
													   													
													if(!$conn) {
														die("Connection failed: " . mysqli_connect_error());
													}

													$stud_id = $_GET['stud_id'];

													$statement = "SELECT curr_name FROM pcnhsdb.students left join pcnhsdb.curriculum on students.curr_id = curriculum.curr_id where stud_id = '$stud_id'";
													$result = $conn->query($statement);
													if ($result->num_rows > 0) {
													    // output data of each row
													    while($row = $result->fetch_assoc()) {
													    	$curr_id = $row['curr_id'];
													    	$curr_name = $row['curr_name'];
													    	echo <<<OPTION2
													    		<option value="$curr_id">$curr_name</option>
OPTION2;
													  }
													}
												?>
											</select>
										</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">School Name</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<?php
											if(!$conn) {
														die("Connection failed: " . mysqli_connect_error());
											}

											$stud_id = $_GET['stud_id'];
											$statement = "SELECT * from students where stud_id = '$stud_id'";

											$result = $conn->query($statement);
											if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													$second_school_name = $row['second_school_name'];
													echo <<<OPTION2
														<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="schl_name" value="$second_school_name" placeholder="School Name">
OPTION2;
												}
											}
										?>
									</div>
								</div>
			                    <table class="table table-hover">
			                      <thead>
			                        <tr>
			                          <th>Subject</th>
			                          <th>Subject Level</th>
			                          <th>Final Grade</th>
			                          <th>Unit</th>
			                          <th>Remarks</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                      <?php
			                      	$stud_id = $_GET['stud_id'];
			                      	$statement = "SELECT subjects.subj_name, subjects.subj_level from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id where subjectcurriculum.curr_id = (SELECT students.curr_id FROM pcnhsdb.students left join pcnhsdb.curriculum on students.curr_id = curriculum.curr_id where stud_id = '$stud_id')";

			                      		$result = $conn->query($statement);
										if ($result->num_rows > 0) {
											// output data of each row
											while($row = $result->fetch_assoc()) {
												$subj_name = $row['subj_name'];
												$subj_level = $row['subj_level'];
												echo <<<SUBJ
													<td>$subj_name</td>
													<td>$subj_level</td>
SUBJ;
											}
										}
			                      ?>
			                      		<td></td>
			                      		<td></td>
			                      		<td></td>
			                      </tbody>
			                    </table>
			                  </div>
							</div>
							
						</div>
						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<!-- <div class="col-md-6"></div> -->
							<div class="col-md-3 col-md-offset-3 pull-right">
								<button id="send" type="submit" class="btn btn-success">Save Changes</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php include "../../resources/templates/registrar/footer.php"; ?>
		
		<!-- Scripts -->
				<!-- jQuery -->
				<script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>
				<!-- Bootstrap -->
				<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
				<!-- FastClick -->
				<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
				<!-- input mask -->
				<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
				<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
				<!-- Custom Theme Scripts -->
				<script src= "../../js/custom.min.js"></script>
				<!-- Scripts -->
		<!-- validator -->
		<script>
		// initialize the validator function
		validator.message.date = 'not a real date';
		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
		$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);
		$('.multi.required').on('keyup blur', 'input', function() {
		validator.checkField.apply($(this).siblings().last()[0]);
		});
		$('form').submit(function(e) {
		e.preventDefault();
		var submit = true;
		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
		submit = false;
		}
		if (submit)
		this.submit();
		return false;
		});
		</script>
		<!-- /validator -->
		<!-- jquery.inputmask -->
		<script>
		$(document).ready(function() {
		$(":input").inputmask();
		});
		</script>
		<!-- /jquery.inputmask -->
		<!-- <script type="text/javascript">
			// function showSubjects(base_url) {
			// 	var curriculum = document.getElementById("curriculum").value;
			// 	alert(base_url+"?curr_id="+curriculum);

			// 	document.getElementById("subj1").innerHTML = "";
			// }


		</script> -->
		<script>
		function showSubjects() {
		  var xhttp = new XMLHttpRequest();
		  var curriculum = document.getElementById("curriculum").value;
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      document.getElementById("subj1").innerHTML =
		      this.responseText;
		    }
		  };
		  xhttp.open("GET", "../schoolmanagement/phpscripts/showsubjects.php?curr_id="+curriculum, true);
		  xhttp.send();
		}
		</script>
	</body>
</html>