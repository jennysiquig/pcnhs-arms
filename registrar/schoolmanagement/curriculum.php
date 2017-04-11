<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<html>
	<head>
		<title>Curriculum</title>
		<link rel="shortcut icon" href="../../assets/images/pines.png" type="image/x-icon" />
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
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">School Management</a></li>
				  <li class="active">Curriculum</li>
				</ol>
			</div>
			<div class="">
				<div class="row top_tiles">
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Curriculum</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-striped jambo_table">
								<thead>
									<tr class="headings">
										<th class="column-title">Curriculum ID</th>
										<th class="column-title">Curriculum Code</th>
										<th class="column-title">Curriculum Name</th>
										<th class="column-title">Year Started</th>
										<th class="column-title">Year Ended</th>
										<th class="column-title">Action</th>
									</th>
									
								</tr>
							</thead>
							<tbody>
								
								
								<?php
									require_once "../../resources/config.php";
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT * FROM pcnhsdb.curriculum";
									$result = $conn->query($statement);
									if($result->num_rows>0) {
										while($row=$result->fetch_assoc()) {
											$curr_id = $row['curr_id'];
											$curr_code = $row['curr_code'];
											$curr_name = $row['curr_name'];
											$year_started = $row['year_started'];
											$year_ended = $row['year_ended'];
											echo <<<CURR
											<tr class="odd pointer">
													<td class=" ">$curr_id</td>
													<td class=" ">$curr_code</td>
													<td class=" ">$curr_name</td>
													<td class=" ">$year_started</td>
													<td class=" ">$year_ended</td>
													<td class=" "><a href="curriculum_edit.php?curr_id=$curr_id" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a></td>
											</tr>
CURR;
										}
									}
									$conn->close();
								?>
								
							</tbody>
						</table>
					</div>
					<a href=<?php echo "../../registrar/schoolmanagement/curriculum_add.php" ?>>Add Curriculum</a>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
<!-- Content Here -->
<!-- Footer -->
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
		<script src= "../../assets/js/custom.min.js"></script>
	<!-- Scripts -->
</body>
</html>