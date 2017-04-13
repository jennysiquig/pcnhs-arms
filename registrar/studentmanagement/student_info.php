<?php require_once "../../resources/config.php";?>
<?php include('include_files/session_check.php'); ?>
<?php include('../../resources/classes/Popover.php'); ?>
<!DOCTYPE html>
<?php
	if (isset($_GET['stud_id'])) {
	$stud_id = $_GET['stud_id'];
	}else {
	$stud_id = "";
	}

	$first_name;
	$mid_name;
	$last_name;
	$gender;
	$birth_date;
	$birth_place;
	$schl_location;
	$yr_grad;
	$program;
	$curriculum;
	$pname;
	$parent_occupation;
	$parent_address;
	$primary_schl_name;
	$primary_schl_year;
	$total_elem_years;
	$gpa;
	$statement = "SELECT * FROM pcnhsdb.students left join parent on students.stud_id = parent.stud_id left join primaryschool on students.stud_id = primaryschool.stud_id left join programs on students.prog_id = programs.prog_id left join curriculum on students.curr_id = curriculum.curr_id left join grades on students.stud_id = grades.stud_id where students.stud_id = '$stud_id' order by schl_year desc limit 1";
	$result = $conn->query($statement);
	if(!$result) {
	//echo "<p>Record Not Found. <a href='../../index.php'>Back to Home</a></p>";
	header("location: student_list.php");
	die();
	}
	if($result->num_rows>0) {
	while($row=$result->fetch_assoc()) {
	$curriculum = $row['curr_name'];
	$first_name = $row['first_name'];
	$mid_name = $row['mid_name'];
	$last_name = $row['last_name'];
	$gender = $row['gender'];
	$birth_date = $row['birth_date'];
	$province = $row['province'];
	$towncity = $row['towncity'];
	$barangay = $row['barangay'];
	$last_schyear_attended = $row['schl_year'];
	$second_school_name = $row['second_school_name'];
	$program = $row['prog_name'];
	$pname = $row['pname'];
	$parent_occupation = $row['occupation'];
	$parent_address = $row['address'];
	$primary_schl_name = $row['psname'];
	$primary_schl_year = $row['pschool_year'];
	$total_elem_years = $row['total_elem_years'];
	$gpa = $row['gen_average'];
	}
	}else {
	header("location: student_list.php");
	die();
	}
?>
<html>
	<head>
		<title>Student Info</title>
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
		<script src="../../js/ie8-responsive-file-warning.js"></script>
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
				  <li class="active">Student Personal Information</li>
				</ol>
			</div>
			<div class="clearfix"></div>
			<?php
				if(isset($_SESSION['success'])) {
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				}
			?>
			<form class="form-horizontal form-label-left">
				<div class="x_panel">
					<div class="x_title">
						<h2>Student Personal Information</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Student</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$curriculum'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary School Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$second_school_name'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$stud_id'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$last_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="firstName" readonly value=<?php echo "'$first_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="middleName" readonly value=<?php echo "'$mid_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$gender'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthdate" readonly value=<?php echo "'$birth_date'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Place: </label>
										
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Province</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="province" readonly value=<?php echo "'$province'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Town</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="towncity" readonly value=<?php echo "'$towncity'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Barangay</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="barangay" readonly value=<?php echo "'$barangay'"; ?>>
										</div>
									</div>
									<!--  -->
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Program</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$program'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last School Year Attended</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" readonly value=<?php echo "'$last_schyear_attended'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Parent</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$pname'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$parent_occupation'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address" readonly value=<?php echo "'$parent_address'"; ?>>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Primary School</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$primary_schl_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$primary_schl_year'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Elementary Years</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$total_elem_years'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Average Grade</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$gpa'"; ?>>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Requested Credentials</h2>
									<div class="clearfix"></div>
									
								</div>
								<div class="x_content">
									<!--  -->
									
									<div class="table-responsive">
										<table class="table table-striped jambo_table">
											<thead>
												<tr class="headings">
													<th class="column-title">Credential Name</th>
													<th class="column-title">Date Processed</th>
													<th class="column-title">Credential Status</th>
													<th class="column-title">Date Released</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(!$conn) {
														die("Connection failed: " . mysqli_connect_error());
													}
													$statement = "SELECT date_processed, date_released, status, cred_name FROM pcnhsdb.requests natural join students natural join credentials where stud_id = '$stud_id';";
													$result = $conn->query($statement);
													if ($result->num_rows > 0) {
														// output data of each row
														while($row = $result->fetch_assoc()) {
															$cred_name = $row['cred_name'];
															$date_processed = $row['date_processed'];
															$date_released = $row['date_released'];
															if(is_null($date_released)) {
																$date_released = "N/A";
															}
															$status = $row['status'];
															if($status == 'r') {
																$status = "Released";
															}else {
																$status = "Unclaimed";
															}
															echo <<<CREDC
																<tr>
																	<td>$cred_name</td>
																	<td>$date_processed</td>
																	<td>$status</td>
																	<td>$date_released</td>
																</tr>
CREDC;
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<!--  -->
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<div class="ln_solid"></div>

						<!-- Check Attendance and Grades to Generate Credentials -->
							<?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$stud_id = $_GET['stud_id'];
								$attendancecount = "";
								$gradecount = "";
								$attquery = "SELECT count(*) as 'attendancecount' FROM pcnhsdb.attendance where stud_id = '$stud_id';";
								$result1 = $conn->query($attquery);
								if ($result1->num_rows > 0) {
									// output data of each row
									while($row = $result1->fetch_assoc()) {
										$attendancecount = $row['attendancecount'];

									}
								}

								$gradequery = "SELECT count(*) as 'gradecount' FROM pcnhsdb.grades where stud_id = '$stud_id';";
								$result2 = $conn->query($gradequery);
								if ($result2->num_rows > 0) {
									// output data of each row
									while($row = $result2->fetch_assoc()) {
										$gradecount = $row['gradecount'];

									}
								}
							?>
						<!--  -->
						<div class="row">
							<div class="col-md-5">
								<?php 
									if($attendancecount < 1 && $gradecount < 1) {
										$popover = new Popover();
										$popover->set_popover("warning", "No records found in grades and attendance.");
										echo $popover->get_popover();
									}
									if($attendancecount != $gradecount) {
										$popover = new Popover();
										if($gradecount > $attendancecount) {
											$popover->set_popover("warning", "No records found in attendance in a certain year.");
										}else {
											$popover->set_popover("warning", "No records found in grades in a certain year.");
										}
										
										echo $popover->get_popover();
									}
									
								?>
							</div>
						</div>
						<!-- Check Attendance and Grades to Generate Credentials -->
							<?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$attendancecount = "";
								$gradecount = "";
								$attquery = "SELECT count(*) as 'attendancecount' FROM pcnhsdb.attendance where stud_id = '$stud_id';";
								$result1 = $conn->query($attquery);
								if ($result1->num_rows > 0) {
									// output data of each row
									while($row = $result1->fetch_assoc()) {
										$attendancecount = $row['attendancecount'];

									}
								}

								$gradequery = "SELECT count(*) as 'gradecount' FROM pcnhsdb.grades where stud_id = '$stud_id';";
								$result2 = $conn->query($gradequery);
								if ($result2->num_rows > 0) {
									// output data of each row
									while($row = $result2->fetch_assoc()) {
										$gradecount = $row['gradecount'];

									}
								}
							?>
						<!--  -->

						<div class="form-group">
							<div class="col-md-6">
								<a class="btn btn-default" href=<?php echo "../../registrar/studentmanagement/student_edit.php?stud_id=$stud_id" ?>><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
								<a class="btn btn-default" href=<?php echo "../../registrar/studentmanagement/grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Grades</a>
								<a class="btn btn-default" href=<?php echo "../../registrar/studentmanagement/attendance.php?stud_id=$stud_id" ?>><i class="fa fa-calendar m-right-xs"></i> Attendance</a>
							</div>
							<div class="col-md-3 pull-right">
								<?php
									
								echo <<<GEN
									<a href="../../registrar/credentials/choose_credential.php?stud_id=$stud_id"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Please verify first if the grades and attendance are complete."><i class="fa fa-print m-right-xs"></i> Generate Credentials</button></a>
GEN;
								?>
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		
		
		<!-- Content End -->
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
		<!-- /jquery.inputmask -->
	</body>
</html>