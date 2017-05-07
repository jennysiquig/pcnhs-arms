<?php require_once "../../resources/config.php";?>
<?php include('include_files/session_check.php'); ?>
<?php include('../../resources/classes/Popover.php'); ?>
<!DOCTYPE html>
<?php
if (isset($_GET['stud_id'])) {
$stud_id = $_GET['stud_id'];
} else {
$stud_id = "";
}
$first_name;
$mid_name;
$last_name;
$gender;
$birth_date;
$birth_place;
$schl_location;
$yr_grad;
$program;
$curriculum;
$pname;
$parent_occupation;
$parent_address;
$primary_schl_name;
$primary_schl_year;
$total_elem_years;
$gpa;

$statement = "SELECT * FROM pcnhsdb.students left join parent on students.stud_id = parent.stud_id left join primaryschool on students.stud_id = primaryschool.stud_id left join programs on students.prog_id = programs.prog_id left join curriculum on students.curr_id = curriculum.curr_id left join grades on students.stud_id = grades.stud_id where students.stud_id = '$stud_id' order by schl_year desc limit 1";
$result = DB::query($statement);
if (!$result) {
	//echo "<p>Record Not Found. <a href='../../index.php'>Back to Home</a></p>";
	header("location: student_list.php");
	die();
}
foreach ($result as $row) {
	$curriculum = $row['curr_name'];
	$first_name = $row['first_name'];
	$mid_name = $row['mid_name'];
	$last_name = $row['last_name'];
	$gender = $row['gender'];
	$birth_date = $row['birth_date'];
	$province = $row['province'];
	$towncity = $row['towncity'];
	$barangay = $row['barangay'];
	$last_schyear_attended = $row['schl_year'];
	$second_school_name = $row['second_school_name'];
	$program = $row['prog_name'];
	$pname = $row['pname'];
	$parent_occupation = $row['occupation'];
	$parent_address = $row['address'];
	$primary_schl_name = $row['psname'];
	$primary_schl_year = $row['pschool_year'];
	$total_elem_years = $row['total_elem_years'];
	$gpa = $row['gen_average'];
}
?>
<html>
	<head>
		<title>Student Info</title>
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
		<link href="../../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">
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
		<div class="right_col" role="main">
			<div class="row">
				<div class="col-md-9">
					<ol class="breadcrumb">
						<li><a href="../index.php">Home</a></li>
						<li><a href="#">Student Management</a></li>
						<li><a href="student_list.php">Student List</a></li>
						<li class="active">Student Record</li>
					</ol>
				</div>
			</div>
			<?php
			if (isset($_SESSION['success'])) {
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			}
			?>
			<div class="row">
				<div class="col-md-9">
					<a class="btn btn-default" href=<?php //echo $_SERVER['HTTP_REFERER']; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
				</div>
			</div>
			<div class="clearfix"></div>
			<form class="form-horizontal form-label-left">
				<div class="x_panel">
					<div class="x_title">
						<h2>Student Record
						</h2>
						<div class="clearfix"></div>
						<h5><b>Student ID: </b><?php echo "$stud_id"; ?></h5>
						<h5><b>Student Name: </b><?php echo "$last_name".', '."$first_name"; ?></h5>
						<h5><b>Curriculum: </b><?php echo "$curriculum"; ?></h5>
					</div>
					<div class="x_content">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<!-- <div class="x_panel">
									<div class="x_title">
											<h2><i class="fa fa-align-left"></i> Collapsible / Accordion
											<small>Sessions</small>
											</h2>
											<div class="clearfix"></div>
									</div>
								<div class="x_content"> -->
									<!-- start accordion -->
									<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel">
											<a class="panel-heading collapsed" role="tab" id="headingThree"
												data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
												aria-expanded="false" aria-controls="collapseThree">
												<h4 class="panel-title">Student Information <small class="pull-right">Click to Expand</small></h4>
											</a>
											<div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
												aria-labelledby="headingThree">
												<div class="panel-body">
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$curriculum'"; ?>>
														</div>
														<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Secondary
														School Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$second_school_name'"; ?>>
														</div>
														<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Student
														ID</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$stud_id'"; ?>>
														</div>
														<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Last
														Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$last_name'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">First
														Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-7 col-xs-12"
															required="required" type="text" name="firstName"
															readonly value=<?php echo "'$first_name'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle
														Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-7 col-xs-12"
															required="required" type="text" name="middleName"
															readonly value=<?php echo "'$mid_name'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$gender'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-7 col-xs-12" type="text"
															name="birthdate" readonly
															value=<?php echo "'$birth_date'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth
														Place: </label>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Province</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-12 col-xs-12" type="text"
															name="province" readonly
															value=<?php echo "'$province'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Town</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-12 col-xs-12" type="text"
															name="towncity" readonly
															value=<?php echo "'$towncity'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Barangay</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control col-md-12 col-xs-12" type="text"
															name="barangay" readonly
															value=<?php echo "'$barangay'"; ?>>
														</div>
													</div>
													<!--  -->
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Program</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$program'"; ?>>
														</div>
														<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Last
														School Year Attended</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="name" class="form-control col-md-7 col-xs-12"
															required="required" type="text" readonly
															value=<?php echo "'$last_schyear_attended'"; ?>>
														</div>
														<!-- <input class="form-control" type="text" name="stud_id" required="required"> -->
													</div>
													<center>
													<h3>Parent/Guardian Information</h3>
													</center>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$pname'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Occupation</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$parent_occupation'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" name="parent_address" readonly value=<?php echo "'$parent_address'"; ?>>
														</div>
													</div>
													<center>
													<h3>Primary School Information</h3>
													</center>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">School Name</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$primary_schl_name'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$primary_schl_year'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Elementary Years</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$total_elem_years'"; ?>>
														</div>
													</div>
													<div class="item form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Average Grade</label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input class="form-control  col-md-7 col-xs-12" type="text" readonly value=<?php echo "'$gpa'"; ?>>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel">
											<a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse"
												data-parent="#accordion" href="#collapseOne" aria-controls="collapseOne">
												<h4 class="panel-title">Grades Record <small class="pull-right">Click to Expand</small></h4>
											</a>
											<div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
												aria-labelledby="headingOne">
												<div class="panel-body">
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
																			<!-- Grades Record -->
																			<?php

																			$already_generated =  false;
																			$statement = "SELECT * FROM pcnhsdb.requests WHERE stud_id = '$stud_id';";
																			$count = DB::count($statement);
																			if($count > 0) {
																			  $already_generated =  true;
																			}
																			$statement = "SELECT * FROM pcnhsdb.grades WHERE stud_id = '$stud_id' order by yr_level asc;";
																			$result = DB::query($statement);
																			$result_count = DB::count($statement);
																			$grade_count = 0;
																			foreach ($result as $row) {
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
																			        <a href="edit_grade.php?stud_id=$stud_id&yr_level=$yr_level"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button></a>
GRADES;
																			        if($result_count == $yr_level && !$already_generated) {
																			        echo <<<REMOVE

																			        <button type="button" class="btn btn-danger btn-xs" onclick="removeGrade($yr_level,'$stud_id');"><i class="fa fa-trash"></i></button>
REMOVE;
																			        }else {
																			        if($yr_level < 4 && $result_count == $yr_level) {
																			        echo <<<REMOVE
																			        <button type="button" class="btn btn-danger btn-xs" onclick="removeGrade($yr_level,'$stud_id');"><i class="fa fa-trash"></i></button>
REMOVE;
																			        }else {
																			        echo <<<REMOVE
																			        <button type="button" class="btn btn-danger btn-xs" disabled><i class="fa fa-trash"></i></button>
REMOVE;
																			        }
																			        }

																			        echo "</center>
																			      </td>
																			    </tr>";
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
																	<!-- Other Subjects -->
																	<?php
																	$query = "SELECT * FROM pcnhsdb.othersubjects where stud_id = '$stud_id';";
																	$result = DB::query($query);
																	foreach ($result as $row) {
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
																	      <a class="btn btn-danger btn-xs" href="phpupdate/removeothersubjects.php?stud_id=$stud_id&osubj_id=$osubj_id&schl_year=$schl_year&credit_earned=$credit_earned">Remove Record</a>
																	    </td>
																	  </tr>
YR1;
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
																	<!-- Failed Subjects -->
																	<?php
																	$query = "SELECT * FROM pcnhsdb.studentsubjects inner join subjects on studentsubjects.subj_id = subjects.subj_id natural join grades where stud_id = '$stud_id' AND comment = 'FAILED';";
																	$result = DB::query($query);
																	foreach ($result as $row) {
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
																		$count_othersubj = DB::count($query_othersubj);
																		if ($count_othersubj > 0) {
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

																	?>
																</tbody>
															</table>
														</div>
													</div>
												</div>
												<!-- Panel 1 End -->
											</div>
										</div>
									</div>
									<div class="panel">
										<a class="panel-heading collapsed" role="tab" id="headingTwo"
											data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
											aria-expanded="false" aria-controls="collapseTwo">
											<h4 class="panel-title">Attendance Record <small class="pull-right">Click to Expand</small></h4>
										</a>
										<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
											aria-labelledby="headingTwo">
											<div class="panel-body">
												<div class="table-list">
													<table class="tablesorter-bootstrap">
														<thead>
															<tr>
																<th data-sorter="false">Year Level</th>
																<th data-sorter="false">School Year</th>
																<th data-sorter="false">School Days</th>
																<th data-sorter="false">Days Attended</th>
																<th data-sorter="false">Total Years in School</th>
																<th data-sorter="false">Action</th>
															</tr>
														</thead>
														<tbody>
															<!-- Attendance -->
															<?php
																$attendance_count = 0;
																$already_generated =  false;
																$statement = "SELECT * FROM pcnhsdb.requests WHERE stud_id = '$stud_id';";
																$count = DB::count($statement);
																if($count > 0) {
																		$already_generated =  true;
																}
																$statement = "SELECT * FROM pcnhsdb.attendance WHERE stud_id = '$stud_id' order by yr_lvl asc;";
																$result = DB::query($statement);
																$result_count = DB::count($statement);
																	foreach ($result as $row) {
																		$attendance_count += 1;
																		$schl_yr = $row['schl_yr'];
																		$yr_lvl = $row['yr_lvl'];
																		$days_attended = $row['days_attended'];
																		$school_days = $row['school_days'];
																		$total_years_in_school = $row['total_years_in_school'];
																		echo <<<GRADES
																				<tr>
																					<th scope="row">$yr_lvl</th>
																					<td>$schl_yr</td>
																					<td>$school_days</td>
																					<td>$days_attended</td>
																					<td>$total_years_in_school</td>
																					<td>
																							<center>
GRADES;
																					if($result_count == $yr_lvl && !$already_generated) {
																						echo <<<REMOVE
																							<button type="button" class="btn btn-danger btn-xs" onclick="removeAttendance($yr_lvl,'$stud_id');">Remove Record</button>
REMOVE;
																						}else {
																							echo <<<REMOVE
																							<button type="button" class="btn btn-danger btn-xs" disabled>Remove Record</button>
REMOVE;
																						}

																					echo "</center>
																</td>
															</tr>";
																	}
																?>
															</tbody>
														</table>
													</div>
													<!-- Attendance Check -->
													<?php
														if($attendance_count < 1) {
															$year_check = $attendance_count+1;
														}else {
															$year_check = $attendance_count+1;
														}

														$checkgrade = "SELECT * FROM pcnhsdb.grades where stud_id = '$stud_id' and yr_level = $year_check;";
														$result = DB::query($checkgrade);
														$result_checkgrade = count($result);
														if($result_checkgrade > 0) {
															$next_attendance = $attendance_count+1;
															if($attendance_count < 4 && $next_attendance == $result_checkgrade) {
																echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_attendance.php?stud_id=$stud_id&yr_lvl=$next_attendance'><i class='fa fa-plus m-right-xs'></i> Add Attendance</a>";
															}else {
																echo "<a class='btn btn-success pull-right disabled'><i class='fa fa-plus m-right-xs'></i> Add Attendance</a>";
															}
														}else {
																echo "<a class='btn btn-success pull-right disabled'><i class='fa fa-plus m-right-xs'></i> Add Attendance</a>";
														}

													?>
												</div>
											</div>
										</div>
										<div class="panel">
											<a class="panel-heading collapsed" role="tab" id="headingFour"
												data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
												aria-expanded="false" aria-controls="collapseFour">
												<h4 class="panel-title">Requested Credential History <small class="pull-right">Click to Expand</small></h4>
											</a>
											<div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
												aria-labelledby="headingFour">
												<div class="panel-body">
													<div class="table-list">
														<table class="tablesorter-bootstrap">
															<thead>
																<tr class="headings">
																	<th class="column-title">Credential Name</th>
																	<th class="column-title">Purpose</th>
																	<th class="column-title">Date Processed</th>
																	<th class="column-title">Credential Status</th>
																	<th class="column-title">Date Released</th>
																</tr>
															</thead>
															<tbody>
																<!-- Credentials History  -->
																<?php
																	$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join credentials where stud_id = '$stud_id';";
																	$result = DB::query($statement);
																	if(count($result) > 0) {
																		foreach ($result as $row) {
																			$cred_name = $row['cred_name'];
																			$request_purpose = $row['request_purpose'];
																			$date_processed = $row['date_processed'];
																			$status = $row['status'];
																			switch ($status) {
																				case 'r':
																					$status = "Released";
																					break;
																				case 'u':
																					$status = "Unclaimed";
																					break;
																				case 'p':
																					$status = "Pending";
																					break;
																			}
																			$date_released = $row['date_released'];
																			echo <<<CH
																				<tr>
																					<td>$cred_name</td>
																					<td>$request_purpose</td>
																					<td>$date_processed</td>
																					<td>$status</td>
																					<td>$date_released</td>
																				</tr>
CH;
																		}
																	}
																?>
																;
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- end of accordion -->
								</div>
							<!-- 	</div>
						</div> -->
						<div class="clearfix"></div>
						<div class="ln_solid"></div>
						<!-- Check Attendance and Grades to Generate Credentials -->
						<?php

						$stud_id = $_GET['stud_id'];
						$attendancecount = "";
						$gradecount = "";
						$attquery = "SELECT * as 'attendancecount' FROM pcnhsdb.attendance where stud_id = '$stud_id';";
						$count1 = DB::count($attquery);
						$attendancecount = $count1;

						$gradequery = "SELECT count(*) as 'gradecount' FROM pcnhsdb.grades where stud_id = '$stud_id';";
						$count2 = DB::count($gradequery);

						$gradecount = $count2;

						?>
						<!--  -->
						<div class="form-group">
							<div class="col-md-9">
								<a class="btn btn-default" href=<?php echo "../../registrar/studentmanagement/student_edit.php?stud_id=$stud_id" ?>><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
							</div>
							<?php

                 echo <<<GEN
									<a class="pull-right" href="../../registrar/credentials/choose_credential.php?stud_id=$stud_id"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Please verify first if the grades and attendance are complete."><i class="fa fa-print m-right-xs"></i> Generate Credentials</button></a>
GEN;
              ?>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- Content End -->
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
		<script src= "../../assets/js/jquery.easy-autocomplete.js"></script>
				<script type="text/javascript">
			      $(function() {
			      $('.recent-request').tablesorter();
			      $('.tablesorter-bootstrap').tablesorter({
			      theme : 'bootstrap',
			      headerTemplate: '{content} {icon}',
			      widgets    : ['zebra','columns', 'uitheme']
			      });
			      });
			    </script>
				<!-- Scripts -->
				<script type="text/javascript">
				var options = {
				url: function(phrase) {
				return "phpscript/student_search.php?query="+phrase;
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
		<script src= "../../assets/js/custom.min.js"></script>
		<!-- Scripts -->
		<!-- validator -->
		<!-- /jquery.inputmask -->
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
		<script>
			function removeAttendance(yr_lvl, stud_id) {
				var remove = confirm("Are you sure to remove this record?");

				if(remove) {
					//console.log(stud_id);
					window.location.assign("phpupdate/removeattendance.php?stud_id="+stud_id+"&yr_lvl="+yr_lvl);
				}
			}
		</script>
	</body>
</html>
