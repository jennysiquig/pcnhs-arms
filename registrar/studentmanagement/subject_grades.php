<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<? unset($_SESSION['grade']); ?>
<?php 
	if(isset($_GET['stud_id']) && isset($_GET['yr_level'])) {
		$stud_id = $_GET['stud_id'];
		$yr_level = $_GET['yr_level'];
	}else {
		header("location: student_list.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Student Grades</title>
		<link rel="shortcut icon" href="../../assets/images/pines.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		
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
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
					<li><a href="../index.php">Home</a></li>
					<li><a href="#">Student Management</a></li>
					<li><a href="student_list.php">Student List</a></li>
					<li><a href="#">Student Personal Information</a></li>
					<li><a href="#">Grades</a></li>
					<li class="active">Subject Grades</li>
				</ol>
			</div>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "../studentmanagement/grades.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="clearfix"></div>
						<div class="x_panel">
				<div class="x_title">
					<h2>Subject Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table class="table table-bordered">
		            	<thead>
		                	<tr>
		                    	<th>Subject</th>
		                        <th>Subject Level</th>
		                        <th>Final Grade</th>
		                        <th>Credits Earned</th>
		                        <th>Remarks</th>
		                    </tr>
		                </thead>
		                <tbody>
		                      	<?php
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = '$yr_level' and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name = $row['subj_name'];
											$subj_level = $row['subj_level'];
											$fin_grade = $row['fin_grade'];
											$credit_earned = $row['credit_earned'];
											$comment = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name</th>
						                          <td>$subj_level</td>
						                          <td>$fin_grade</td>
						                          <td>$credit_earned</td>
						                          <td>$comment</td>
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		            	</tbody>
		        	</table>
				</div>
			</div>
		</div>
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
		<!-- NProgress -->
		<script src="../../resources/libraries/nprogress/nprogress.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../assets/js/custom.min.js"></script>
	</body>
</html>