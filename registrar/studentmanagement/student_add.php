<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Student</title>
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
		<!-- Date Range Picker -->
		<link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
		<div class="row">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li class="disabled">Student Management</li>
				  <li class="active">Add Student Record</li>
				</ol>
			</div>
			 </div>
			 <!-- Generate Error Message Here  -->
	            <?php
	                if(isset($_SESSION['error_pop'])) {
	                    echo $_SESSION['error_pop'];
	                    unset($_SESSION['error_pop']);
	                }
	            ?>
           
            <!--  -->
			<div class="clearfix"></div>
			
			<form id="validate-add" class="form-horizontal form-label-left" name="validate-add" data-parsley-validate action= "phpinsert/student_info_insert.php" method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Student Personal Information </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2>Student <small style="color: red;"><i class="fa fa-info-circle"></i> If the information is not available, please enter "NONE"</small></h2>
									<div class="clearfix"></div>
								</div>
								<div class="item form-group">

									<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum of Student *</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select id="curr-select" class="form-control col-md-7 col-xs-12" name="curriculum" required="">
											<option value="">-- No Selected --</option>
											<?php
												
																									
												if(!$conn) {
													die("Connection failed: " . mysqli_connect_error());
												}
												$statement = "SELECT * FROM pcnhsdb.curriculum";
												$result = $conn->query($statement);
												if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													$curr_id = $row['curr_id'];
													$curr_name = $row['curr_name'];
													echo <<<OPTION1
																<option value="$curr_id">$curr_name</option>
OPTION1;
														}
													}
														
												?>
											</select>
											<p style="color: red"><i class="fa fa-info-circle"></i> Refer to the curriculum that is indicated on the Form 137.</p>
										</div>
									</div>
									<div class="x_content">
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary School *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="second_school_name" value="PINES CITY NATIONAL HIGH SCHOOL" placeholder="Full Name of Current School or School Graduated">
											</div>
											<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID or LRN *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="stud_id" maxlength="20">
											</div>
											<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" type="text" name="mid_name" required>
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<div id="gender" class="btn-group" data-toggle="buttons">
													<label>
														<input type="radio" name="gender" value="male" required=""> &nbsp; Male &nbsp;
													</label>
													<label>
														<input type="radio" name="gender" value="female" required=""> Female
													</label>
												</div>
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input class="form-control has-feedback-left" type="text" name="birthdate" onblur="validateBday(this.value)" value="01/01/2000" placeholder="Birthday" required="" />
												 <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthplace *</label>
											<div class="col-md-3 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" type="text" name="birth_place_province" required="" placeholder="Province">
											</div>
											<div class="col-md-3 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" type="text" name="birth_place_towncity" required="" placeholder="Town">
											</div>
											
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
											<div class="col-md-3 col-sm-6 col-xs-12">
												<input class="form-control col-md-7 col-xs-12" type="text" name="birth_place_barangay" placeholder="Barangay">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Student Program *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<select class="form-control col-md-7 col-xs-12" name="program" required="">
												<option value="">-- No Selected --</option>
													<?php
														
																											
														if(!$conn) {
															die("Connection failed: " . mysqli_connect_error());
														}
														$statement = "SELECT * FROM pcnhsdb.programs";
														$result = $conn->query($statement);
														if ($result->num_rows > 0) {
														// output data of each row
														while($row = $result->fetch_assoc()) {
															$prog_id = $row['prog_id'];
															$prog_name = $row['prog_name'];
															echo <<<OPTION1
																		<option value="$prog_id">$prog_name</option>
OPTION1;
																}
														}
																
														?>
													</select>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="x_panel">
										<div class="x_title">
											<h2>Parent or Guardian</h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="pname" required="">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="occupation" required="">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Address *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address" required="">
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
												<label class="control-label col-md-4 col-sm-4 col-xs-12">School Name *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="schl_name" required="">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12">Last School Year Attended *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="schl_year" placeholder="YYYY - YYYY" data-inputmask="'mask': '9999 - 9999'" required="">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12">Total Elementary Years *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="total_elem_years" pattern="[6-9]" maxlength="1" required="">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-4 col-sm-4 col-xs-12">Average Grade *</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input class="form-control  col-md-7 col-xs-12" type="text" name="gpa" placeholder="" pattern="\d+(\.\d{2})?" onkeypress="return isNumberKey(event)"">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-3 col-md-offset-3 pull-right">
										<button type="reset" onclick="releaseData();" class="btn btn-default">Clear Fields</button>
										<button type="submit" class="btn btn-success"><i class="fa fa-save m-right-xs"></i> Add Student</button>
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
				<!-- Local Storage -->
				<script src= "../../resources/libraries/sisyphus/sisyphus.js"></script>
				<!-- NProgress -->
    			<script src="../../resources/libraries/nprogress/nprogress.js"></script>
				<!-- Custom Theme Scripts -->
				<script src= "../../assets/js/custom.min.js"></script>
				<!-- Scripts -->
				<!-- Date Range Picker -->
				<script src="../../resources/libraries/moment/min/moment.min.js"></script>
				<script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
				
				<!-- /jquery.inputmask -->
				<script>
				$(document).ready(function() {
				$(":input").inputmask();
				});
				</script>
				<!-- Parsley -->
				<script>
				$(document).ready(function() {
				$.listen('parsley:field:validate', function() {
				validateFront();
				});
				$('#validate-add submit').on('click', function() {
				$('#validate-add').parsley().validate();
				validateFront();
				});
				var validateFront = function() {
				if (true === $('#validate-add').parsley().isValid()) {
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
				 <!-- jquery.inputmask -->
	            <script>
	                $(document).ready(function() {
	                    $(":input").inputmask();
	                });
	            </script>
                <!-- /jquery.inputmask -->

                <!-- Sisyphus -->
                
                <script type="text/javascript">
				$(function() {
				    $('input[name="birthdate"]').daterangepicker({
				    	autoUpdateInput: true,
				        singleDatePicker: true,
				        showDropdowns: true,

				    });

				});
				</script>
				<!-- Limit to numbers only -->
		        <script type="text/javascript">
		            function isNumberKey(evt, n){
		            console.log(n);
		              var charCode = (evt.which) ? evt.which : evt.keyCode;
		              if (charCode != 46 && charCode > 31 
		                && (charCode < 48 || charCode > 57))
		                 return false;

		              return true;
		           }
		        </script>
		       	<script type="text/javascript">
		       		$( function() {
						$( "#validate-add" ).sisyphus({
							autoRelease: false
						});
					});
				</script>
				<script type="text/javascript">
					function releaseData() {
						$('#validate-add').sisyphus().manuallyReleaseData();
					}
				</script>
			</body>
		</html>