<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds

    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      session_unset();
      session_destroy();
      session_start();
    }

    $_SESSION['last_activity'] = $time;
    if(isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])){
    	if($_SESSION['account_type'] != "registrar") {
    		echo "<p>Access Failed <a href='../index.php'>Back to Home</a></p>";
    	}
    }else {
    	header('Location: ../../login.php');
    }
    date_default_timezone_set('Asia/Manila');

  ?>
<html>
	<head>
		<title>Payment Remittance</title>
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
    <!-- NProgress -->
		<link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		<link href="../../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">

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
							<h2>Payment Remittance Report</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>

						<div class="x-content">
						<form class="form-vertical" action="paymentprint.php" method="POST">
						<div class="row">
							<div class="form-group">
								<p>
									<div class="col-md-9 center-margin">
									<label>Payment Date</label>
										<?php
											$payment_date = $_GET['payment_date'];
											echo "<input class='form-control' value='$payment_date' name='payment_date'>";

										?>
									</div>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<label>Choose Signatory <span class="required">*</span></label>
									<select id="credential" class="form-control" name="signatory" required="">
										<option value="">No Selected</option>
										<optgroup label="HEAD TEACHER"></optgroup>
										<?php
											$statement = "SELECT * FROM signatories WHERE position='HEAD TEACHER'";
											$result = DB::query($statement);
                      if (count($result) > 0) {
                    		foreach ($result as $row) {
													$sign_id = $row['sign_id'];
													$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'];
													echo "<option value='$sign_id'>$sign_name</option>";
												}
											}
										?>
										<optgroup label="PRINCIPAL"></optgroup>
										<?php
												$statement = "SELECT * FROM signatories WHERE position='PRINCIPAL'";
												$result = DB::query($statement);
                        if (count($result) > 0) {
                      		foreach ($result as $row) {
														$sign_id = $row['sign_id'];
														$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'];
														echo "<option value='$sign_id'>$sign_name</option>";
													}
												}
											?>
									</select>
								</div>
							</div>
						</div>
						<br>
						<button id="generatebutton" class="btn btn-primary pull-right" type="submit">
							<i class="fa fa-print m-right-xs"></i> Generate</button>
					</form>


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
  <!-- NProgress -->
  <script src="../../resources/libraries/nprogress/nprogress.js"></script>
	<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
	<!-- Custom Theme Scripts -->
	<script src= "../../assets/js/jquery.easy-autocomplete.js"></script>
	<script type="text/javascript">
	      var options = {
	        url: function(phrase) {
	          return "../../registrar/studentmanagement/phpscript/student_search.php?query="+phrase;
	        },

	        getValue: function(element) {
	          return element.name;
	        },

	        ajaxSettings: {
	          dataType: "json",
	          method: "POST",
	          data: {
	            dataType: "json"
	          }
	        },

	        preparePostData: function(data) {
	          data.phrase = $("#search_key").val();
	          return data;
	        },

	        requestDelay: 200
	      };

	      $("#search_key").easyAutocomplete(options);
	</script>
	<script src= "../../assets/js/custom.js"></script>


</body>
</html>
