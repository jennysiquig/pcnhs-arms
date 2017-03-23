<!DOCTYPE html>
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
    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../login.php');
    }
    
    
  ?>
<?php require_once '../resources/config.php' ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- NProgress -->
    	<link href="../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
		
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
		<?php include "../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../resources/templates/registrar/top-nav.php"; ?>
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Search Student Record</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form action="studentmanagement/student_list.php" method="GET">
								<div class="input-group input-group-lg">
									<span class="input-group-addon"><i class="fa fa-search"></i></span>
									<input type="text" class="form-control" name="search_key" placeholder="Name of Student or ID Number">
								</div>
								<br>
								<button class="btn btn-lg btn-primary btn-block">Search</button>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="">
				<div class="row top_tiles">
				<a href="studentmanagement/student_list.php">
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="tile-stats">
							<div class="icon"><i class="fa fa-user"></i></div>
							<?php
								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT count(*) as students FROM pcnhsdb.students";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$students = $row["students"];
										echo "<div class='count'>$students</div>";
									}
								}
							?>
							<p>&nbsp</p>
							<h3>Total Students</h3>
							<p>&nbsp</p>
						</div>
					</div>
					</a>
					<a href="credentials/unclaimed.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="glyphicon glyphicon-hourglass"></i></div>
								<?php
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT count(*) as unclaimed FROM pcnhsdb.requests where status = 'u'";
									$result = $conn->query($statement);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$unclaimed = $row["unclaimed"];
											echo "<div class='count'>$unclaimed</div>";
										}
									}
								?>
								<p>&nbsp</p>
								<h3>Unclaimed Credentials</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
					<a href="credentials/released.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-paper-plane"></i></div>
								<?php
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT count(*) as released FROM pcnhsdb.requests where status = 'r'";
									$result = $conn->query($statement);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$released = $row["released"];
											echo "<div class='count'>$released</div>";
										}
									}
								?>
								<p>&nbsp</p>
								<h3>Released Credentials</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
					<a href="reports/transaction.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="glyphicon glyphicon-check"></i></div>
								<?php
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT count(*) as totaltrans FROM pcnhsdb.transaction";
									$result = $conn->query($statement);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$totaltrans = $row["totaltrans"];
											echo "<div class='count'>$totaltrans</div>";
										}
									}
								?>
								<p>&nbsp</p>
								<h3>Total Transactions</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
				</div>
			</div>
			
			
		<div class="clearfix"></div>
	</div>
	<!-- /page content -->
	<!-- Content Here -->
	<!-- Footer -->
	<?php include "../resources/templates/registrar/footer.php"; ?>
	
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
	<!-- NProgress -->
    <script src="../resources/libraries/nprogress/nprogress.js"></script>
	<!-- Custom Theme Scripts -->
	<script src= "../js/custom.min.js"></script>
	<!-- Scripts -->
</body>
</html>