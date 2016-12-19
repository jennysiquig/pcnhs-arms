<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../css/custom.min.css" rel="stylesheet">
		<link href="../../css/tstheme/style.css" rel="stylesheet">
		<!-- iCheck -->
		<link href=".../../../../resources/libraries/iCheck/skins/flat/green.css" rel="stylesheet">
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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<form id="validate-add" class="form-horizontal form-label-left" data-parsley-validate action = "" method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Generate Credential</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<label>Date:</label>
					<?php
						echo date("Y-m-d");
					?>
					<br>
					<br>
					<label for="credential">Choose Credential:</label>
					<select id="credential" class="form-control" required>
						<option value="">Choose..</option>
					</select>
					<br>
					<label>Type of Request:</label>
					<p>
						<input type="radio" class="flat" name="type_of_request" id="tor-individual" value="individual" checked="" required /> Individual Request:
						<input type="radio" class="flat" name="type_of_request" id="tor-bulk" value="bulk" />
						Bulk Request:
						
					</p>
				</div>
			</div>
			<div class="row no-print">
				<div class="col-xs-12">
					<a href="generate_cred.php" class="btn btn-success pull-right">Submit</a>
					<button class="btn btn-primary pull-right">Back</button>
				</div>
			</div>
		</form>
		
	</div>
	<!-- Contents Here -->
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
	<!-- Custom Theme Scripts -->
	<script src= "../../js/custom.min.js"></script>
	<!-- iCheck -->
	<script src="../../resources/libraries/iCheck/icheck.min.js"></script>
	<!-- Scripts -->
</body>
</html>