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
							<h2>Add Signatory</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="credential-val" class="form-horizontal form-label-left" action=<?php echo "$base_url/registrar/schoolmanagement/signatory_insert.php"; ?> method="POST" novalidate>
						<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Signatory ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="sign_id">
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="mname">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Started</label>
								<div class="col-md-2 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12" name="yr_started">
												<option value="">-- Year --</option>
												<?php 
														$present = date("Y");
													for ($year=1920; $year <= $present; $year++) { 
														echo "<option value='$year'>$year</option>";
												} ?>
											</select>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Ended</label>
								<div class="col-md-2 col-sm-6 col-xs-12">
											<select class="form-control col-md-7 col-xs-12" name="yr_ended">
												<option value="">-- Year --</option>
												<option value="present">Present</option>
												<?php 
														$present = date("Y");
													for ($year=$present; $year >= 1920; $year--) { 
														echo "<option value='$year'>$year</option>";
												} ?>
											</select>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position">
								</div>
							</div>
							<div class="form-group">
							<div class="col-md-5 col-md-offset-3 pull-right">
								<button type="submit" class="btn btn-success">Add Signatory</button>
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

	<!-- Parsley -->
			    <script>
			      $(document).ready(function() {
			        $.listen('parsley:field:validate', function() {
			          validateFront();
			        });
			        $('#credential-val .btn').on('click', function() {
			          $('#credential-val').parsley().validate();
			          validateFront();
			        });
			        var validateFront = function() {
			          if (true === $('#credential-val').parsley().isValid()) {
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