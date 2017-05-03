<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php" ?>
<?php $stud_id = $_GET['stud_id']; ?>
<?php ob_start(); ?>
<html>
	<head>
		<title>Edit Student</title>
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
					  <li class="active">Edit Personal Information</li>
					</ol>
				</div>
			<div class="clearfix"></div>
			<?php
				if(isset($_SESSION['error_pop'])) {
					echo $_SESSION['error_pop'];
					unset($_SESSION['error_pop']);
				}

			?>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<form id="stud-edit" class="form-horizontal form-label-left" action="phpupdate/update_student_info.php" method="POST" novalidate>
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
									<!--  -->
										<?php


											$first_name;
											$mid_name;
											$last_name;
											$gender;
											$birth_date;
											$barangay;
											$towncity;
											$province;
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

											$statement = "SELECT * FROM pcnhsdb.students left join parent on students.stud_id = parent.stud_id left join primaryschool on students.stud_id = primaryschool.stud_id left join programs on students.prog_id = programs.prog_id left join curriculum on students.curr_id = curriculum.curr_id left join grades on students.stud_id = grades.stud_id where students.stud_id = '$stud_id'";
											$result = DB::query($statement);
											foreach ($result as $row) {
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
												$program = $row['prog_name'];
												$pname = $row['pname'];
												$parent_occupation = $row['occupation'];
												$parent_address = $row['address'];
												$primary_schl_name = $row['psname'];
												$primary_schl_year = $row['pschool_year'];
												$total_elem_years = $row['total_elem_years'];
												$gpa = $row['gen_average'];
											}
										?>
									<!--  -->
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
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="stud_id" readonly="" value=<?php echo "'$stud_id'"; ?>>
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="lastName" value=<?php echo "'$last_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="firstName"  value=<?php echo "'$first_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="middleName"  value=<?php echo "'$mid_name'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="gender" value=<?php echo "'$gender'"; ?> readonly>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthdate" data-inputmask="'mask': '99/99/9999'"  value=<?php echo "'$birth_date'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Place: </label>

									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Province</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="province" value=<?php echo "'$province'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Town</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="towncity" value=<?php echo "'$towncity'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Barangay</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-12 col-xs-12" type="text" name="barangay" value=<?php echo "'$barangay'"; ?>>
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
											<input id="name" class="form-control col-md-7 col-xs-12" type="text" disabled="" value=<?php echo "'$last_schyear_attended'"; ?>>
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
											<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_name" required="" value=<?php echo "'$pname'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="occupation" value=<?php echo "'$parent_occupation'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address"  value=<?php echo "'$parent_address'"; ?>>
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
											<input class="form-control  col-md-7 col-xs-12" name="total_elem_years" type="number" value=<?php echo "'$total_elem_years'"; ?>>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Average Grade</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="gpa" value=<?php echo "'$gpa'"; ?>>
										</div>
									</div>
								</div>
							</div>
						</div>




						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class=" pull-right">
								<button class="btn btn-default" onclick="history.go(-1);return true;">Cancel</button>
								<button type="submit" class="btn btn-primary">Save Changes</button>
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
			<!-- jquery.inputmask -->
	            <script>
	                $(document).ready(function() {
	                    $(":input").inputmask();
	                });
	            </script>
                <!-- /jquery.inputmask -->
                <!-- Parsley -->
				<script>
				$(document).ready(function() {
				$.listen('parsley:field:validate', function() {
				validateFront();
				});
				$('#stud-edit .btn').on('click', function() {
				$('#stud-edit').parsley().validate();
				validateFront();
				});
				var validateFront = function() {
				if (true === $('#stud-edit').parsley().isValid()) {
				$('.bs-callout-info').removeClass('hidden');
				$('.bs-callout-warning').addClass('hidden');
				} else {
				$('.bs-callout-info').addClass('hidden');
				$('.bs-callout-warning').removeClass('hidden');
				}
				};
				});
				try {
				hljs.initHighlightingOnLoad();
				} catch (err) {}
				</script>
				<!-- /Parsley -->
		</body>
	</html>
