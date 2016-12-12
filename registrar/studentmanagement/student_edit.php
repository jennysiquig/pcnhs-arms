<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
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
			<form class="form-horizontal form-label-left" action=<?php echo "$base_url/registrar/studentmanagement/add_grades.php"; ?> method="POST" novalidate>
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
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" disabled value="129">
										</div>
										<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="lastName" value="Migu">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="firstName" value="Drake">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="middleName" value="Escobar">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div id="gender" class="btn-group" data-toggle="buttons">
												<label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													<input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
												</label>
												<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
													<input type="radio" name="gender" value="female"> Female
												</label>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthdate" data-inputmask="'mask': '99/99/9999'" value="10/19/1998">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthplace</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" type="text" name="birthplace" value="Rosario">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Home Address</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="home_add" value="Poblacion">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">School Location</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" disabled="" value="Main">
										</div>
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
											<input class="form-control  col-md-7 col-xs-12" type="text" name="pname" value="Emilia Rose">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="occupation" value="Flight Attendance">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address" value="Honeymoon Baguio City">
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
											<input class="form-control  col-md-7 col-xs-12" type="text" name="psname" value="Mabini Elementary School">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="pschool_year" value="2009">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Elementary Years</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input class="form-control  col-md-7 col-xs-12" type="text" name="total_elem_years" value="6">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						<!-- <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Religion</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control col-md-7 col-xs-12" type="text" name="religion">
											</div>
						</div>
						
						
						<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Citizenship</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control col-md-7 col-xs-12" type="text" name="citizenship">
											</div>
						</div>
						<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control col-md-7 col-xs-12" type="text" name="contactno">
											</div>
						</div>
						<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Level</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
																<input class="form-control col-md-7 col-xs-12" type="number" name="yearLevel">
											</div>
						</div>
						
						
						<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Civil Status</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="radio">
																					
																					<label>
																										<input type="radio" name="civil_status" value="single">Single
																					</label>
																					<label>
																										<input type="radio" name="civil_status" value="married">Married
																					</label>
																</div>
											</div>
						</div> -->
						
						
						
						
						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-5 col-md-offset-3 pull-right">
								<button type="submit" class="btn btn-primary">Cancel</button>
								<a class="btn btn-success" href=<?php echo "$base_url/registrar/studentmanagement/student_info.php" ?>> Save Changes</a>
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