<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<?php require_once "../../resources/config.php"; ?>
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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="">
				<div class="row top_tiles">
					
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
						<form class="form-horizontal form-label-left" action=<?php echo "$base_url/registrar/studentmanagement/subject_insert.php"; ?> method="POST" novalidate>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="number" name="subj_id">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="subj_name">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Level</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="number" name="subj_level" min="1">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select id="curriculum" class="form-control col-md-7 col-xs-12" name="curr_id">
										<!-- <option value="1">Regular</option>
										-->
										<option value="all">No Selected</option>
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
																	<option value="$curr_id">$curr_name</option>
OPTION2;
															}
														}
											?>
										</select>
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
		<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
		<!-- Scripts -->
		<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
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
	</body>
</html>