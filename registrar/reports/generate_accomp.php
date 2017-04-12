<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include "include_files/session_check.php"; ?>
<html>
	<head>
		<title>Accomplishment Report</title>
		<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- Date Range Picker -->
		<link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		
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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">Reports</a></li>
				  <li class="active">Accomplishment Reports</li>
				</ol>
			</div>



			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Accomplishment Reports</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<form action="preview_accomp.php" method="POST">
						<div>

								<div>
							 	<div class="form-group">

									<label for="r_fm" class="col-md-3">Records and File Management</label>
									<br>
	                    			<div class="col-md-12 pull-right">
	                      				<textarea class="resizable_textarea form-control" name="r_fm" style="height:150px;"></textarea>
	                    			</div>
                    			</div>
                    			</div>

                  				<div>
                    			<div class="form-group">

                  					<label for=
                  					"fm" class="col-md-2">Registrar's Services</label>
                  					<br>
                    				<div class="col-md-12">
                    					
                    				</div>

                    				<div id="date">
                    				<?php $accomplishment_date = $_SESSION['accomplishment_date'];

	             						$accomplishment_date = explode("/", $accomplishment_date);

	             						$a_month = $accomplishment_date[0];
	             						$a_year = substr($accomplishment_date[2], 0, 4);
	            
	             						if($a_month < 10) {
	                						$a_month = substr($a_month, 1, 1);
	             						}

	              						$month_array = array('January','February','March','April','May','June','July','August','September','October','November','December');
	                					$monthstr = $month_array[$a_month-1]; ?>

                    					<!-- <?php // echo $accomplishment_date; ?> -->
                    					<?php echo $monthstr; ?>
                    					<?php echo $a_year; ?>
                    				</div>
                    			</div>
                    			</div>

                  				<div>
                    			<div class="form-group">
                  					<label for=
                  					"fm" class="col-md-2">Financial Management</label>
                  					<br>
                    				<div class="col-md-12 pull-right">
                      				<textarea class="resizable_textarea form-control" name="fm" style="height:150px;"></textarea>
                    				</div>
                    			</div>
                    			</div>
                    		
                    			<br>
                    			<br>
                    			<div class="form-group">
                    				<label id="ot" class="col-md-2">Other Tasks</label>		
                    				<div class="col-md-12 pull-right">
                      				<textarea class="resizable_textarea form-control" name="ot" style="height:150px;"></textarea>
                    				</div>
                    			</div>
                  		</div>

                  		<button id="generatebutton" class="btn btn-primary pull-right" type="submit"><i class="fa fa-print m-right-xs"></i> Generate Credentials</button>
                  		</form>

                  		<!-- <?php // $accomplishment_date = $_GET['accomplishment_date'];?>
                  		<?php // echo $accomplishment_date;?> -->

        


					</div>
			

						</div>
					</div>
				</div>
			</div>
		</div>
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
	<!-- Date Range Picker -->
	<script src="../../resources/libraries/moment/min/moment.min.js"></script>
	<script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
	<!-- Custom Theme Scripts -->
	<script src= "../../assets/js/custom.js"></script>
	
	
</body>
</html>