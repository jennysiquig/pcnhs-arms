<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php

	$stud_id = "";
	$credential = "";
	$request_type = "";
	$request_purpose = "";

	if(isset($_GET['stud_id']) && isset($_GET['credential'])) {
		$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
		$credential = htmlspecialchars($_GET['credential'], ENT_QUOTES);
		
	}else {
		header("location: ../index.php");
	}

	if(isset($_GET['purpose'])) {
		$request_purpose = strtoupper(htmlspecialchars($_GET['purpose'], ENT_QUOTES));
	}else {
		$request_purpose = "";
	}


	
?>
<html>
	<head>
		<title>Other Credential Request</title>
		<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
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
		<!-- iCheck -->
		<link href=".../../../../resources/libraries/iCheck/skins/flat/green.css" rel="stylesheet">
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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<form id="choose_cred" class="form-horizontal form-label-left" data-parsley-validate action=<?php echo "phpinsert/other_credential_insert.php?stud_id=$stud_id"; ?> method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Other Credential Request <small>Other credential requests will be processed here.</small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					
					<div class="clearfix"></div>
					<br>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Request <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p>
							<input type="radio" class="flat" name="request_type" id="tor-individual" value="individual" checked="" required /> Individual Request:
							
						</p>
                        </div>
                      </div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Today</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="date" readonly="" value=<?php echo date("Y-m-d"); ?>>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential ID</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="credential" readonly="" value=<?php echo "'$credential'"; ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Request Purpose/Remarks: </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input required="required" class="form-control" name="request_purpose" placeholder="" value=<?php echo "'$request_purpose'"; ?>>
						</div>
					</div>
			<!--  -->
		</div>
	</div>
	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-xs-12">
			<button class="btn btn-success pull-right"><i class="fa fa-paper-plane"></i> Submit</button>
			<a class="btn btn-default pull-right" href=<?php echo "choose_credential.php?stud_id=$stud_id"; ?>>Cancel</a>
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
<!-- iCheck -->
	<script src="../../resources/libraries/iCheck/icheck.min.js"></script>
<!-- Custom Theme Scripts -->
<script src= "../../assets/js/custom.min.js"></script>
<!-- Scripts -->
</body>
</html>