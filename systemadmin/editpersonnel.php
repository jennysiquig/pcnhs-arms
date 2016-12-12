<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "$base_url/resources/templates/admin/header.php"; ?>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "$base_url/resources/templates/admin/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "$base_url/resources/templates/admin/top-nav.php"; ?>
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<div class="x_panel">
				<div class="x_title">
					<h2>Edit Personnel Account</h2>
					<div class="clearfix"></div>
					<br/>
					
				</div>
				<div class="x_content">
					<form class="form-horizontal form-label-left">
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" value="elvi">
							</div>
							
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="password" value="elvi">
							</div>
							
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" value="Elvira Cudli">
							</div>
							
						</div>
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" value="Registrar">
							</div>
							
						</div>
						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-3 col-md-offset-3 pull-right">
								<button type="submit" class="btn btn-success">Save Changes</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			
		</div>
		<!-- Contents Here -->
		<?php include "$base_url/resources/templates/admin/footer.php"; ?>
		<?php include "$base_url/resources/templates/admin/scripts.php"; ?>
	</body>
</html>