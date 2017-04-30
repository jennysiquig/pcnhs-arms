<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php 
	unset($_SESSION['grade']);
	unset($_SESSION['credits']);
	unset($_SESSION['save-type']);
 ?>
<!DOCTYPE html>
<?php 
	if(isset($_GET['stud_id']) && isset($_GET['yr_level'])) {
		$stud_id = $_GET['stud_id'];
		$yr_level = $_GET['yr_level'];
	}else {
		echo "Why";
		//header("location: student_list.php");
	}
	
?>
<html>
	<head>
		<title>Edit Grade</title>
        <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		 <!-- jQuery -->
	    <script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>

	    <!-- Tablesorter themes -->
	    <!-- bootstrap -->
	    <link href="../../resources/libraries/tablesorter/css/bootstrap-v3.min.css" rel="stylesheet">
	    <link href="../../resources/libraries/tablesorter/css/theme.bootstrap.css" rel="stylesheet">

	    <!-- Tablesorter: required -->
	    <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.js"></script>
	    <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.widgets.js"></script>

	    <!-- NProgress -->
	    <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
	    <!-- Bootstrap -->
	    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	    
	    <!-- Datatables -->
	    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	    
	    <!-- Custom Theme Style -->
	    <link href="../../assets/css/custom.min.css" rel="stylesheet">
	     <!-- Custom Theme Style -->
	    <link href="../../assets/css/customstyle.css" rel="stylesheet">
		
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
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">Student Management</a></li>
				  <li><a href="student_list.php">Student List</a></li>
				  <li><a href="#">Student Personal Information</a></li>
				  <li class="active">Edit Grade</li>
				</ol>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "../studentmanagement/student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Edit Grade</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

							<?php
								if(!$conn) {
									die();
								}

									$statement = "SELECT * FROM pcnhsdb.grades WHERE stud_id = '$stud_id' and yr_level = '$yr_level' order by yr_level asc;";
									$result = $conn->query($statement);
									$grade_count = 0;
									if($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$grade_count += 1;
											$schl_name = $row['schl_name'];
											$yr_level = $row['yr_level'];
											$schl_year = $row['schl_year'];
											$average_grade = $row['average_grade'];
											$average_grade = number_format($average_grade, 2);
											$total_credit = $row['total_credit'];
										}

								}
							?>

							<form id="grade-val" class="form-horizontal form-label-left" action="phpupdate/grade_update.php" method="GET" data-parsley-validate>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="stud_id" value=<?php echo "'$stud_id'" ?> readonly="">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">School Name</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="schl_name" value=<?php echo "'$schl_name'" ?> readonly="">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Level</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="yr_level" value=<?php echo "$yr_level" ?> readonly="">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="schl_year" value=<?php echo "'$schl_year'" ?> readonly="">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Average Grade</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="average_grade" value=<?php echo "$average_grade" ?>>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Credits Earned</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="total_credit" value=<?php echo "$total_credit" ?>>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-5 col-md-offset-3 pull-right">
										<button type="submit" class="btn btn-success">Save Changes</button>
									</div>
								</div>
						</form>
					</div>
				</div>

		</div>
		<?php include "../../resources/templates/registrar/footer.php"; ?>
		<!-- Scripts -->
		<!-- Bootstrap -->
		<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
		<!-- input mask -->
		<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- NProgress -->
    	<script src="../../resources/libraries/nprogress/nprogress.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../assets/js/custom.min.js"></script>
		<!-- Scripts -->
		<!-- validator -->
		<script>
		$(document).ready(function() {
		$.listen('parsley:field:validate', function() {
		validateFront();
		});
		$('#grade-val submit').on('click', function() {
		$('#grade-val').parsley().validate();
		validateFront();
		});
		var validateFront = function() {
		if (true === $('#grade-val').parsley().isValid()) {
		$('.bs-callout-info').removeClass('hidden');
		$('.bs-callout-warning').addClass('hidden');
		} else {
		$('.bs-callout-info').addClass('hidden');
		$('.bs-callout-warning').removeClass('hidden');
		}
		};
		});
		try {
		hljs.initHighlightingOnLoad();
		} catch (err) {}
		</script>
		<!-- /validator -->
		<!-- jquery.inputmask -->
		<script>
		$(document).ready(function() {
		$(":input").inputmask();
		});
		</script>
	</body>
</html>