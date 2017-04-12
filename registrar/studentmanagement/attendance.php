<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<?php $stud_id = $_GET['stud_id'] ?>
<html>
	<head>
		<title>Student Attendance</title>
        <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		<!-- NProgress -->
    	<link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		
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
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">Student Management</a></li>
				  <li><a href="student_list.php">Student List</a></li>
				  <li><a href="#">Student Personal Information</a></li>
				  <li class="active">Attendance</li>
				</ol>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Attendance</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="col-md-12 col-sm-6 col-xs-12">
					<table class="table table-bordered">
		                <thead>
		                <tr>
		                    <th>Year Level</th>
		                    <th>School Year</th>
		                    <th>School Days</th>
		                    <th>Days Attended</th>
		                    <th>Total Years in School</th>
		                    <th>Action</th>
		                </tr>
		                </thead>
		                <tbody>
							<?php
								if(!$conn) {
									die();
								}else {
									$already_generated =  false;
									$statement = "SELECT * FROM pcnhsdb.requests WHERE stud_id = '$stud_id';";
									$result = $conn->query($statement);
									if($result->num_rows > 0) {
										$already_generated =  true;
									}

									$statement = "SELECT * FROM pcnhsdb.attendance WHERE stud_id = '$stud_id' order by yr_lvl asc;";
									$result = $conn->query($statement);
									$attendance_count = 0;
									if($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$attendance_count += 1;
											$schl_yr = $row['schl_yr'];
											$yr_lvl = $row['yr_lvl'];
											$days_attended = $row['days_attended'];
											$school_days = $row['school_days'];
											$total_years_in_school = $row['total_years_in_school'];
											echo <<<GRADES
												<tr>
						                          <th scope="row">$yr_lvl</th>
						                          <td>$schl_yr</td>
						                          <td>$school_days</td>
						                          <td>$days_attended</td>
						                          <td>$total_years_in_school</td>
						                          <td>
													<center>
GRADES;
											if($result->num_rows == $yr_lvl && !$already_generated) {
												echo <<<REMOVE
													<button class="btn btn-danger btn-xs" onclick="removeAttendance($yr_lvl,'$stud_id');">Remove Record</button>
REMOVE;
												}else {
													echo <<<REMOVE
													<button class="btn btn-danger btn-xs" disabled>Remove Record</button>
REMOVE;
												}
											
											echo "</center>
						                          </td>
						                        </tr>";
										}
									}

								}
							?>
						</tbody>
					</table>
					</div>
					<?php
						$next_attendance = $attendance_count+1;
						if($attendance_count < 4) {
							echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_attendance.php?stud_id=$stud_id&yr_lvl=$next_attendance'><i class='fa fa-plus m-right-xs'></i> Add Attendance</a>";
						}else {
							echo "<a class='btn btn-success pull-right disabled'><i class='fa fa-plus m-right-xs'></i> Add Attendance</a>";
						}
					?>
					</div>
			
				<!--  -->
              	<div class="clearfix"></div>
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
		<!-- NProgress -->
    	<script src="../../resources/libraries/nprogress/nprogress.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../assets/js/custom.min.js"></script>
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
			function removeAttendance(yr_lvl, stud_id) {
				var remove = confirm("Are you sure to remove this record?");

				if(remove) {
					//console.log(stud_id);
					window.location.assign("phpupdate/removeattendance.php?stud_id="+stud_id+"&yr_lvl="+yr_lvl);
				}	
			}
		</script>
	</body>
</html>