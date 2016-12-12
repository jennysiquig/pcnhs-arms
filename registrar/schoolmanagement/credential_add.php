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
							<h2>Add Curriculum</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="credential-val" class="form-horizontal form-label-left" action=<?php echo "$base_url/registrar/schoolmanagement/credential_insert.php"; ?> method="POST" novalidate>
						<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="cred_id">
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="cred_name">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="price">
								</div>
							</div>
							
							<div class="form-group">
							<div class="col-md-5 col-md-offset-3 pull-right">
								<button type="submit" class="btn btn-success">Add Curriculum</button>
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