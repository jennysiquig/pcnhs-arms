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
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "accomplishment.php"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Accomplishment Reports</h2>
					<ul class="nav navbar-right panel_toolbox">
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<form class="form-vertical" action="preview_accomp.php" method="POST">
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<p>
										<label>Records and File Management</label>
										<textarea id="r_fm" class="form-control" name="r_fm" style="height:110px;"></textarea>
									</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<p>
									<div class="col-md-9 center-margin">
									<label>Registrar's Services</label>
										<?php
											$accomplishment_date = $_GET['accomplishment_date'];
											echo "<input class='form-control' value='$accomplishment_date' name='accomplishment_date'>";

										?>
									</div>
								</p>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<p>
										<label>Financial Management</label>
										
										<textarea class="form-control" name="fm" style="height:110px;"></textarea>
										
									</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<label>Other Tasks</label>
									<textarea class="form-control" name="ot" style="height:110px;"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<label>Choose Signatory 1<span class="required">*</span></label>
									<select id="credential" class="form-control" required="" name="signatory_1">
										<option value="">No Selected</option>
										<optgroup label="HEAD TEACHER"></optgroup>
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
										<optgroup label="PRINCIPAL"></optgroup>
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
						</div>
						<div class="row">
							<div class="form-group">
								<div class="col-md-9 center-margin">
									<label>Choose Signatory 2<span class="required">*</span></label>
									<select id="credential" class="form-control" name="signatory_2">
										<option value="">No Selected</option>
										<optgroup label="HEAD TEACHER"></optgroup>
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
										<optgroup label="PRINCIPAL"></optgroup>
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
						</div>						
						<br>
						<button id="generatebutton" class="btn btn-primary pull-right" type="submit">
							<i class="fa fa-print m-right-xs"></i> Generate Credential</button>
					</form>
				</div>
				<div class="row">
					
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