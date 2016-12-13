<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<!-- Bootstrap -->
		<link href="../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Datatables -->
		<link href="../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../css/custom.min.css" rel="stylesheet">
		<link href="../css/tstheme/style.css" rel="stylesheet">
		
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
		<?php include "../resources/templates/admin/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../resources/templates/admin/top-nav.php"; ?>
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
		<?php include "../resources/templates/admin/footer.php"; ?>
		<!-- Scripts -->
		<!-- jQuery -->
		<script src="../resources/libraries/jquery/dist/jquery.min.js" ></script>
		<!-- Bootstrap -->
		<script src="../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src= "../resources/libraries/fastclick/lib/fastclick.js"></script>
		<!-- input mask -->
		<script src= "../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<script src= "../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../js/custom.min.js"></script>
	<!-- Scripts -->

	</body>
</html>