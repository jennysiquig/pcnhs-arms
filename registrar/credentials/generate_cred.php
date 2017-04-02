<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php

	$stud_id = "";
	$credential = "";
	$request_type = "";
	
	if(isset($_GET['stud_id']) && isset($_GET['credential']) && isset($_GET['request_type'])) {
		$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
		$credential = htmlspecialchars($_GET['credential'], ENT_QUOTES);
		$request_type = htmlspecialchars($_GET['request_type'], ENT_QUOTES);
	}else {
		header("location: ../index.php");
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Generate Credential</title>
		<link rel="shortcut icon" href="../../images/pines.png" type="image/x-icon" />
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
			<form id="choose_cred" class="form-horizontal form-label-left" data-parsley-validate action=<?php echo "preview_cred.php?stud_id=$stud_id" ?> method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Form 137 <small></small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					*Form 137 Template Here*
					<div class="clearfix"></div>
					<br>
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
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Request</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="request_type" readonly="" value=<?php echo "'$request_type'"; ?>>
						</div>
					</div>
					<!-- <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Accomplished:</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
									<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="dateaccomplished" value="">
							</div>
					</div> -->
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Accomplished *</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" name="month" required="">
								<option value="">Month</option>
								<?php
									$month=array('January','February','March','April','May','June','July','August','September','October','November','December');
									for ($i=0; $i < count($month) ; $i++) {
										$dayVal = $i+1;
										$monthName = $month[$i];
										echo "<option value='$monthName'>$monthName</option>";
									}
								?>
							</select>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<select class="form-control col-md-7 col-xs-12" name="day" required="">
								<option value="">Day</option>
								<?php for ($day=1; $day <= 31 ; $day++) {
									echo "<option value='$day'>$day</option>";
								} ?>
							</select>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<input class="form-control  col-md-7 col-xs-12" type="text" name="year" placeholder="Year" data-inputmask="'mask': '9999'" required="">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Issued To:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input class="form-control col-md-7 col-xs-12" required="required" type="text" name="issuedto" value="" placeholder="ex: Grade 11">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks: </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea id="message" required="required" class="form-control" name="remarks" placeholder="ex: ISSUED FOR..."></textarea>
						</div>
					</div>
				<!--  -->
				<!--  -->
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Signatory <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="credential" class="form-control" name="signatory">
						<option value="">-- Choose Signatory --</option>
						<option value="" disabled="">-- Head Teacher --</option>
						<?php
							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$statement = "SELECT * FROM signatories WHERE position='HEAD TEACHER'";
							$result = $conn->query($statement);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$sign_id = $row['sign_id'];
									$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'];
									echo "<option value='$sign_id'>$sign_name</option>";
								}
							}
						?>
						<option value="" disabled="">-- Principal --</option>
						<?php
								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT * FROM signatories WHERE position='PRINCIPAL'";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$sign_id = $row['sign_id'];
										$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'];
										echo "<option value='$sign_id'>$sign_name</option>";
									}
								}
							?>
					</select>
				</div>
			</div>
			<!--  -->
		</div>
	</div>
	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-xs-12">
			<button class="btn btn-success pull-right"><i class="fa fa-paper-plane"></i> Submit</button>
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
<!-- Scripts -->
</body>
</html>