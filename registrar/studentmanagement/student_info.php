<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<?php require_once "../../resources/config.php";
	
	$stud_id = $_GET['stud_id'];
	
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
	$statement = "SELECT * FROM pcnhsdb.students left join parent on students.stud_id = parent.stud_id left join primaryschool on students.stud_id = primaryschool.stud_id left join programs on students.prog_id = programs.prog_id left join curriculum on students.curr_id = curriculum.curr_id where students.stud_id = '$stud_id';";
	$result = $conn->query($statement);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
			$curriculum = $row['curr_name'];
			$first_name = $row['first_name'];
			$mid_name = $row['mid_name'];
			$last_name = $row['last_name'];
			$gender = $row['gender'];
			$birth_date = $row['birth_date'];
			$birth_place = $row['birth_place'];
			//$last_schyear_attended = $row['last_schyear_attended'];
			$program = $row['prog_name'];
			$pname = $row['pname'];
			$parent_occupation = $row['occupation'];
			$parent_address = $row['address'];
			$primary_schl_name = $row['psname'];
			$primary_schl_year = $row['pschool_year'];
			$total_elem_years = $row['total_elem_years'];
			$gpa = $row['gen_average'];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "$base_url/resources/templates/registrar/header.php"; ?>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "$base_url/resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "$base_url/resources/templates/registrar/top-nav.php"; ?>
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<form class="form-horizontal form-label-left">
				<div class="x_panel">
					<div class="x_title">
						<h2>Student Personal Information</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Student</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php echo "'$curriculum'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php echo "'$stud_id'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php echo "'$last_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="firstName" disabled="" value=<?php echo "'$first_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="middleName" disabled="" value=<?php echo "'$mid_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php echo "'$gender'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthdate" data-inputmask="'mask': '9999-99-99'" disabled="" value=<?php echo "'$birth_date'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthplace</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthplace" disabled="" value=<?php echo "'$birth_place'"; ?>>
										</div>
									</div>
									<!--  -->
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Program</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php echo "'$program'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last School Year Attended</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" disabled="" value=<?php //echo "'$last_schyear_attended'"; ?>>
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
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$pname'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$parent_occupation'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address" disabled="" value=<?php echo "'$parent_address'"; ?>>
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
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$primary_schl_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$primary_schl_year'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Elementary Years</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$total_elem_years'"; ?>>
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
										<table class="table table-striped">
											<thead>
												<tr class="headings">
													<th class="column-title">Credential Name</th>
													<th class="column-title">Number of Copies</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
									<!--  -->
								</div>
							</div>
						</div>
						
						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6">
								<a class="btn btn-default" href=<?php echo "$base_url/registrar/studentmanagement/student_edit.php" ?>><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
								<a class="btn btn-default" href=<?php echo "$base_url/registrar/studentmanagement/grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Grades</a>
								<a class="btn btn-default" href=<?php echo "$base_url/registrar/studentmanagement/attendance.php?stud_id=$stud_id" ?>><i class="fa fa-calendar m-right-xs"></i> Attendance</a>
							</div>
							<div class="col-md-3 pull-right">
								<a class="btn btn-primary" href=<?php echo "$base_url/registrar/credentials/generate_cred.php" ?>><i class="fa fa-print m-right-xs"></i> Preview Credentials</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		
		
		<!-- Content End -->
		<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
		<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
		<!-- validator -->
		<!-- /jquery.inputmask -->
	</body>
</html>