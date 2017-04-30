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

	$first_name;
	$last_name;
	$curriculum;
	$statement = "SELECT * FROM pcnhsdb.students left join curriculum on students.curr_id = curriculum.curr_id where students.stud_id = '$stud_id' limit 1";
	$result = $conn->query($statement);
	if (!$result) {
	//echo "<p>Record Not Found. <a href='../../index.php'>Back to Home</a></p>";
	header("location: student_list.php");
	die();
	}
	if ($result->num_rows>0) {
	while ($row=$result->fetch_assoc()) {
	$curriculum = $row['curr_name'];
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	}
	} else {
	header("location: student_list.php");
	die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Student Grades</title>
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
					<li><a href="#">Student Record</a></li>
					<li class="active">Subject Grades</li>
				</ol>
			</div>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "../studentmanagement/student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="clearfix"></div>
						<div class="x_panel">
				<div class="x_title">
					<h2>Subject Grades
					</h2>
					<div class="clearfix"></div>
					<h5><b>Student ID: </b><?php echo "$stud_id"; ?></h5>
					<h5><b>Student Name: </b><?php echo "$last_name".', '."$first_name"; ?></h5>
					<h5><b>Curriculum: </b><?php echo "$curriculum"; ?></h5>
				</div>
				<div class="x_content">
					<table class="tablesorter-bootstrap">
		            	<thead>
		                	<tr>
		                    	<th data-sorter="false">Subject</th>
		                        <th data-sorter="false">Subject Level</th>
		                        <th data-sorter="false">Final Grade</th>
		                        <th data-sorter="false">Special Grade</th>
		                        <th data-sorter="false">Credits Earned</th>
		                        <th data-sorter="false">Remarks</th>
		                        <th data-sorter="false">Action</th>
		                    </tr>
		                </thead>
		                <tbody>
		                      	<?php
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT studsubj_id, special_grade, subj_name, subj_level, fin_grade, studentsubjects.credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = '$yr_level' and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$studsubj_id = $row['studsubj_id'];
											$subj_name = $row['subj_name'];
											$subj_level = $row['subj_level'];
											$fin_grade = $row['fin_grade'];
											$credit_earned = $row['credit_earned'];
											$comment = $row['comment'];
											$special_grade = $row['special_grade'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name</th>
						                          <td>$subj_level</td>
						                          <td>$fin_grade</td>
						                          <td>$special_grade</td>
						                          <td>$credit_earned</td>
						                          <td>$comment</td>
						                          <td>
													<center>
														<button class='btn btn-danger btn-xs' onclick="deleteGrade('$stud_id', '$studsubj_id', '$yr_level');"><i class="fa fa-trash"></i> Delete</a></button>
													</center>
						                          </td>
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
		<script type="text/javascript">
	      $(function() {
	      $('.table-list').tablesorter();
	      $('.tablesorter-bootstrap').tablesorter({
	      theme : 'bootstrap',
	      headerTemplate: '{content} {icon}',
	      widgets    : ['zebra','columns', 'uitheme']
	      });
	      });
	    </script>
	    <script type="text/javascript">
		    function deleteGrade(stud_id, studsubj_id, yr_level) {
		    	console.log(stud_id);
		    	console.log(studsubj_id);
		    	console.log(yr_level);
		    	if(confirm("Are you sure?")) {
		    		//<a href='phpupdate/removesubjectgrade.php?stud_id=$stud_id&studsubj_id=$studsubj_id&yr_level=$yr_level'>
		    		window.location.assign("phpupdate/removesubjectgrade.php?stud_id="+stud_id+"&studsubj_id="+studsubj_id+"&yr_level="+yr_level);
		    	}
		    }
	    </script>
	</body>
</html>
