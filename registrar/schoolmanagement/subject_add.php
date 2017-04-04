<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Student Subject</title>
		<link rel="shortcut icon" href="../../images/pines.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- iCheck -->
		<link href=".../../../../resources/libraries/iCheck/skins/flat/green.css" rel="stylesheet">

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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">

			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">School Management</a></li>
				  <li><a href="student_subjects.php">Student Subjects</a></li>
				  <li class="active">Add Subject</li>
				</ol>
			</div>
			<div class="">
				<div class="row top_tiles">
					
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
            <div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "student_subjects.php"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Add Subject</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="subject-val" class="form-horizontal form-label-left" action="phpinsert/subject_insert.php" method="POST" novalidate>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="subj_name">
								</div>
							</div>
							<div class="form-group">
		                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Level</label>
		                        <div class="col-md-6 col-sm-6 col-xs-12">
		                          <select class="form-control" name="subj_level" required="">
		                            <option value="">-- No Selected --</option>
		                            <optgroup label="Year">
		                              <option value="1">1</option>
		                              <option value="2">2</option>
		                              <option value="3">3</option>
		                              <option value="4">4</option>
		                            </optgroup>
		                            <optgroup label="Grade">
		                              <option value="7">7</option>
		                              <option value="8">8</option>
		                              <option value="9">9</option>
		                              <option value="10">10</option>
		                              
		                            </optgroup>
		                          </select>
		                        </div>
		                      </div>
							<div class="form-group">
		                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Student Level Needed</label>
		                        <div class="col-md-6 col-sm-6 col-xs-12">
		                          <select class="form-control" name="yr_level_needed" required="">
		                            <option value="">-- No Selected --</option>
		                            <optgroup label="Year">
		                              <option value="1">1</option>
		                              <option value="2">2</option>
		                              <option value="3">3</option>
		                              <option value="4">4</option>
		                            </optgroup>
		                            <optgroup label="Grade">
		                              <option value="7">7</option>
		                              <option value="8">8</option>
		                              <option value="9">9</option>
		                              <option value="10">10</option>
		                              
		                            </optgroup>
		                          </select>
		                        </div>
		                    </div>
		                    <div class="form-group">
		                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Order</label>
		                        <div class="col-md-6 col-sm-6 col-xs-12">
		                          <input class="form-control" name="subj_order" pattern="\d+" required="">
		                        </div>
		                    </div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
				                        <div class="col-md-9 col-sm-9 col-xs-12">
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
												echo <<<OPTION2
													<div class="checkbox">
							                            <label>
							                              <input type="checkbox" name="curr_id[]" class="flat" value="$curr_id"> $curr_name
							                            </label>
							                         </div>

																	
OPTION2;
																}
															}
											?>
				                          
				                        </div>
				                      </div>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Program</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
					                        <div class="col-md-9 col-sm-9 col-xs-12">
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
													echo <<<OPTION3
														<div class="checkbox">
								                            <label>
								                              <input type="checkbox" name="prog_id[]" class="flat" value="$prog_id"> $prog_name
								                            </label>
								                         </div>
OPTION3;
																	}
																}
												?>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-5 col-md-offset-3 pull-right">
										<button type="submit" class="btn btn-success">Add Subject</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /page content -->
		<!-- Content Here -->
		<!-- Footer -->
		<?php include "../../resources/templates/registrar/footer.php"; ?>
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
		<!-- iCheck -->
		<script src="../../resources/libraries/iCheck/icheck.min.js"></script>
		<!-- Scripts -->
		<!-- Parsley -->
		<script>
			$(document).ready(function() {
			$.listen('parsley:field:validate', function() {
			validateFront();
			});
			$('#subject-val .btn').on('click', function() {
			$('#subject-val').parsley().validate();
			validateFront();
			});
			var validateFront = function() {
			if (true === $('#subject-val').parsley().isValid()) {
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