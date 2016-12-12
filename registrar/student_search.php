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
			<div class="row">
				<form class="form-horizontal form-label-left">
					<div class="divider-dashed"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Search Student</label>
						<div class="col-sm-7">
							<div class="input-group">
								<input type="text" class="form-control">
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary">Go!</button>
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Contents Here -->
	<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
	<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
</body>
</html>