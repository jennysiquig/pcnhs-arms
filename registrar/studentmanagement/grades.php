<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php 
	unset($_SESSION['grade']);
	unset($_SESSION['credits']);
	unset($_SESSION['save-type']);
 ?>
<!DOCTYPE html>
<?php 
	if(isset($_GET['stud_id'])) {
		$stud_id = $_GET['stud_id'];
	}else {
		header("location: student_list.php");
	}
	
?>
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
				  <li><a href="#">Student Personal Information</a></li>
				  <li class="active">Grades</li>
				</ol>
			</div>
			<div class="clearfix"></div>
			<?php
				if(isset($_SESSION['hasgrades'])) {
					echo $_SESSION['hasgrades'];
					unset($_SESSION['hasgrades']);
				}
			?>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php echo "../studentmanagement/student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="col-md-12 col-sm-6 col-xs-12">
					<div class="table-list">
					<table class="tablesorter-bootstrap">
		                <thead>
		                <tr>
		                	<th data-sorter="false">School Name</th>
		                    <th data-sorter="false">Year Level</th>
		                    <th data-sorter="false">School Year</th>
		                    <th data-sorter="false">Average Grade</th>
		                    <th data-sorter="false">Total Credits Earned</th>
		                    <th data-sorter="false">Action</th>
		                </tr>
		                </thead>
		                <tbody>
							<?php
								if(!$conn) {
									die();
								}else {
									$already_generated =  false;
									$statement = "SELECT * FROM pcnhsdb.requests WHERE stud_id = '$stud_id';";
									$result = $conn->query($statement);
									if($result->num_rows > 0) {
										$already_generated =  true;
									}

									$statement = "SELECT * FROM pcnhsdb.grades WHERE stud_id = '$stud_id' order by yr_level asc;";
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
											echo <<<GRADES
												<tr>
						                          <th scope="row">$schl_name</th>
						                          <td>$yr_level</td>
						                          <td>$schl_year</td>
						                          <td>$average_grade</td>
						                          <td>$total_credit</td>
						                          <td>
													<center>
													<a class="btn btn-primary btn-xs" href="subject_grades.php?stud_id=$stud_id&yr_level=$yr_level">View Grades</a>
													<a href="edit_grade.php?stud_id=$stud_id&yr_level=$yr_level"><button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button></a>
GRADES;
											if($result->num_rows == $yr_level && !$already_generated) {
												echo <<<REMOVE
													
													<button class="btn btn-danger btn-xs" onclick="removeGrade($yr_level,'$stud_id');"><i class="fa fa-trash"></i></button>

REMOVE;
												}else {
													if($yr_level < 4 && $result->num_rows == $yr_level) {
														echo <<<REMOVE
															<button class="btn btn-danger btn-xs" onclick="removeGrade($yr_level,'$stud_id');"><i class="fa fa-trash"></i></button>
REMOVE;
													}else {
														echo <<<REMOVE
															<button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash"></i></button>
REMOVE;
													}
												}
											
											echo "</center>
						                          </td>
						                        </tr>";
										}
									}

								}
							?>
						</tbody>
					</table>
					</div>
					</div>
					<?php
						$next_grade = $grade_count+1;
						if($grade_count < 4) {
							echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=$next_grade'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}else {
							echo "<a class='btn btn-success pull-right disabled' href='#'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}
					?>
				</div>
			</div>
			<div class="clearfix"></div>
		    <!-- Other Subjects -->
		    <div class="row">
			<div class="col-md-12 col-sm-6 col-xs-12">
			<div class="x_panel">
				<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
				<div class="x_title">
					<h2>Other Subjects</h2>
					<div class="clearfix"></div>
				</div>

			<div class="x_content">
				<div class="table-list">
				<table class="tablesorter-bootstrap">
					<thead>
						<tr>
							<th data-sorter="false">School Name</th>
							<th data-sorter="false">School Year</th>
							<th data-sorter="false">Year Level</th>
							<th data-sorter="false">Subject</th>
							<th data-sorter="false">Subject Level</th>
							<th data-sorter="false">Subject Type</th>
							<th data-sorter="false">Final Grade</th>
							<th data-sorter="false">Credit Earned</th>
							<th data-sorter="false">Remarks</th>
							<th data-sorter="false">Action</th>
						</tr>
					</thead>
					<tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT * FROM pcnhsdb.othersubjects where stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$osubj_id = $row['osubj_id'];
											$schl_name = $row['schl_name'];
											$schl_year = $row['schl_year'];
											$yr_level = $row['yr_level'];
											$subj_name = $row['subj_name'];
											$subj_level = $row['subj_level'];
											$subj_type = $row['subj_type'];
											$fin_grade = $row['fin_grade'];
											$credit_earned = $row['credit_earned'];
											$comment = $row['comment'];
													
											echo <<<YR1
												<tr>
						                          <th scope="row">$schl_name</th>
						                          <td>$schl_year</td>
						                          <td>$yr_level</td>
						                          <td>$subj_name</td>
						                          <td>$subj_level</td>
						                          <td>$subj_type</td>
						                          <td>$fin_grade</td>
						                          <td>$credit_earned</td>
						                          <td>$comment</td>
						                          <td>
													<a class="btn btn-danger btn-xs" href=phpupdate/removeothersubjects.php?stud_id=$stud_id&osubj_id=$osubj_id>Remove Record</a>
						                          </td>

						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>
		                    </div>
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
								<a class="btn btn-success pull-right" href=<?php echo "../../registrar/studentmanagement/add_othersubject_grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Add Other Subject</a>
						</div>
					</div>
				</div>
				</div>
				</div>
		    </div>
		    <!-- Failed Subjects -->
		    <div class="row">
			<div class="col-md-12 col-sm-6 col-xs-12">
			<div class="x_panel">
				<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
				<div class="x_title">
					<h2>Failed Subjects</h2>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
					<!--  -->
				<div class="table-list">
				<table class="tablesorter-bootstrap">
					<thead>
						<tr>
							<th data-sorter="false">Subject</th>
							<th data-sorter="false">Subject Level</th>
							<th data-sorter="false">Year Level</th>
							<th data-sorter="false">Status</th>
							<th data-sorter="false">Action</th>
						</tr>
					</thead>
					<tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}

									$query = "SELECT * FROM pcnhsdb.studentsubjects inner join subjects on studentsubjects.subj_id = subjects.subj_id natural join grades where stud_id = '$stud_id' AND comment = 'FAILED' ;";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$status = "";
											$subj_id = $row['subj_id'];
											$subj_order = $row['subj_order'];
											$schl_name = $row['schl_name'];
											$yr_level = $row['yr_level'];
											$subj_name = $row['subj_name'];
											$subj_level = $row['subj_level'];

											$action = "<a class='btn btn-primary btn-xs' href='add_othersubject_grades.php?stud_id=$stud_id&schl_name=$schl_name&yr_level=$yr_level&subj_name=$subj_name&subj_level=$subj_level&subj_id=$subj_id&subj_order=$subj_order'>Add to Other Subjects</a>";

											// href=phpupdate/removeothersubjects.php?stud_id=$stud_id&yr_level=$yr_level
											// will check if this subject is existing in the other subjects
											$query_othersubj = "SELECT * FROM pcnhsdb.othersubjects where stud_id = '$stud_id' AND subj_id = '$subj_id' and comment = 'PASSED';";

											$result_othersubj = $conn->query($query_othersubj);
											if ($result_othersubj->num_rows > 0) {
												$status = "PASSED";
												$action = "<a class='btn btn-primary btn-xs disabled'>Add to Other Subjects</a>";
											}else {
												$status = "FAILED";
											}

											echo <<<YR1
												<tr>
						                          <td>$subj_name</td>
						                          <td>$subj_level</td>
						                          <td>$yr_level</td>
						                          <td>$status</td>
						                          <td>
						                          	<center>
						                          		$action
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
		            </div>
		       </div>
             <!-- END -->
			<!-- Other Subjects -->

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
		// initialize the validator function
		validator.message.date = 'not a real date';
		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
		$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);
		$('.multi.required').on('keyup blur', 'input', function() {
		validator.checkField.apply($(this).siblings().last()[0]);
		});
		$('form').submit(function(e) {
		e.preventDefault();
		var submit = true;
		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
		submit = false;
		}
		if (submit)
		this.submit();
		return false;
		});
		</script>
		<!-- /validator -->
		<!-- jquery.inputmask -->
		<script>
		$(document).ready(function() {
		$(":input").inputmask();
		});
		</script>
		<!-- /jquery.inputmask -->
		<!-- <script type="text/javascript">
			// function showSubjects(base_url) {
								// 	var curriculum = document.getElementById("curriculum").value;
								// 	alert(base_url+"?curr_id="+curriculum);
								// 	document.getElementById("subj1").innerHTML = "";
			// }
		</script> -->
		<script>
		function showSubjects() {
		var xhttp = new XMLHttpRequest();
		var curriculum = document.getElementById("curriculum").value;
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById("subj1").innerHTML =
		this.responseText;
		}
		};
		xhttp.open("GET", "showsubjects.php?curr_id="+curriculum, true);
		xhttp.send();
		}
		</script>
		<!-- Remove Record -->
		<script type="text/javascript">
			function removeGrade(yr_level, stud_id) {
				var remove = confirm("Are you sure to remove this record?");

				if(remove) {
					//console.log(stud_id);
					window.location.assign("phpupdate/removegrades.php?stud_id="+stud_id+"&yr_level="+yr_level);
				}


			}

		</script>

		<!-- Remove Other Subjects -->
		<script type="text/javascript">
			function removeOtherSubjects(stud_id) {
				var remove = confirm("Are you sure to remove this record?");

				if(remove) {
					//console.log(stud_id);
					window.location.assign("phpupdate/removeothersubjects.php?stud_id="+stud_id);
				}	
			}
		</script>
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
	</body>
</html>