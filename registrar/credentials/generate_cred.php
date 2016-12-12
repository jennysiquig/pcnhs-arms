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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<div class="x_panel">
				<div class="x_title">
					<h2>Form 137</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				*Form 137 Template Here*
			</div>
		</div>
		<!-- this row will not appear when printing -->
		<div class="row no-print">
			<div class="col-xs-12">
				<button class="btn btn-default pull-right"><i class="fa fa-eye"></i> Preview</button>
			</div>
		</div>
	</div>
	<!-- Contents Here -->
	<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
	<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
</body>
</html>