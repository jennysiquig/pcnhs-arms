<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php
	if(!isset($_GET['curriculum']) && !isset($_GET['program']) ) {
		header("location: student_subjects.php?curriculum=all&program=all");
	}
	if(isset($_GET['curriculum']) && isset($_GET['program']) ) {
		//header("location: student_subjects.php?curriculum=all&program=all");
		if($_GET['curriculum'] != "all" && !is_numeric($_GET['curriculum'])) {
			header("location: student_subjects.php?curriculum=all&program=all");
		}
		if($_GET['program'] != "all" && !is_numeric($_GET['program'])) {
			header("location: student_subjects.php?curriculum=all&program=all");
		}
	}

?>
<html>
	<head>
	<title>Student Subjects</title>
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
		<?php
			include "../../resources/templates/registrar/sidebar.php";
		?>
		<!-- Top Navigation -->
		<?php
			include "../../resources/templates/registrar/top-nav.php";
		?>

		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">School Management</a></li>
				  <li class="active">Student Subjects</li>
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
							<h2>Student Subjects</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left" action="student_subjects.php" method="get">
								<div class="row">
									<div class="item form-group">
										<label class="control-label col-md-9 col-sm-3 col-xs-12">Filter Curriculum</label>
										<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="curriculum" class="form-control col-md-7 col-xs-12" name="curriculum">
											<option value="all">All</option>
											<?php

												$statement = "SELECT * FROM pcnhsdb.curriculum";

												$result = DB::query($statement);
												if (count($result) > 0) {
													foreach ($result as $row) {
														$curr_id = $row['curr_id'];
														$curr_name = $row['curr_name'];
														if(isset($_GET['curriculum'])) {
															if($_GET['curriculum'] == $curr_id) {
																echo "<option value='$curr_id' selected>$curr_name</option>";
															}else {
																echo "<option value='$curr_id'>$curr_name</option>";
															}
														}

													}
												}
											?>
											</select>
										</div>
									</div>

								<div class="item form-group">
									<label class="control-label col-md-9 col-sm-3 col-xs-12">Filter Program</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="curriculum" class="form-control col-md-7 col-xs-12" name="program">
											<option value="all">All</option>
											<?php
												$statement = "SELECT * FROM pcnhsdb.programs";
												$result = DB::query($statement);
												if (count($result) > 0) {
													foreach ($result as $row) {
														$prog_id = $row['prog_id'];
														$prog_name = $row['prog_name'];
														if(isset($_GET['program'])) {
															if($_GET['program'] == $prog_id) {
																echo "<option value='$prog_id' selected>$prog_name</option>";
															}else {
																echo "<option value='$prog_id'>$prog_name</option>";
															}
														}
													}
												}
											?>
											</select>
										</div>

								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-primary pull-right">Filter</button>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="table-responsive subj-list">
								<table class="tablesorter-bootstrap">
									<thead>
										<tr class="headings">
											<th class="column-title">Subject Name</th>
											<th class="column-title">Subject Level</th>
											<th class="column-title">Curriculum</th>
											<th class="column-title">Program</th>
										</th>
									</tr>
								</thead>
								<tbody id="subjlist">
									<?php
										if(isset($_GET['curriculum']) && isset($_GET['program']) ) {
										$get_curr_id = $_GET['curriculum'];
										$get_prog_id = $_GET['curriculum'];
										if($get_curr_id === "all" && $get_prog_id === "all") {
										$statement = "SELECT * FROM pcnhsdb.curriculum";
										}else {
										$statement = "SELECT * FROM pcnhsdb.curriculum where curr_id = $get_curr_id";
										}
										}else {
										$statement = "SELECT * FROM pcnhsdb.curriculum";
										}
										$result = DB::query($statement);
										if (count($result) > 0) {
											foreach ($result as $row) {
										$curr_id = $row['curr_id'];
										$curr_name = $row['curr_name'];
										}
										}
									?>
									<?php
											$statement = "";
							                    $start=0;
							                    $limit=20;
							                    if(isset($_GET['page'])){
							                      $page=$_GET['page'];
							                      $start=($page-1)*$limit;
							                    }else{
							                      $page=1;
							                    }

							                if(isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] <> "all" && $_GET['program'] <> "all") {
												$get_curr_id = $_GET['curriculum'];
												$get_prog_id = $_GET['program'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $get_curr_id and programs.prog_id = $get_prog_id limit $start, $limit;";
											}elseif (isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] == "all" && $_GET['program'] <> "all") {
												$get_curr_id = "all";
												$get_prog_id = $_GET['program'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where programs.prog_id = $get_prog_id limit $start, $limit;";
											}elseif (isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] <> "all" && $_GET['program'] == "all") {
												$get_prog_id = "all";
												$get_curr_id = $_GET['curriculum'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $get_curr_id limit $start, $limit;";
											}
											else {
											        $statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id limit $start, $limit;";
											}

											$result = DB::query($statement);
											if (count($result) > 0) {
												foreach ($result as $row) {
													# code...
													$subj_id = $row['subj_id'];
													$subj_name = $row['subj_name'];
													$subj_level = $row['subj_level'];
													$curr_name = $row['curr_name'];
													$prog_name = $row['prog_name'];

													echo <<<SUBJS
														<tr>
																<td>$subj_name</td>
																<td>$subj_level</td>
																<td>$curr_name</td>
																<td>$prog_name</td>
														</tr>
SUBJS;
												}
											}
									?>
								</tbody>
							</table>
							<?php
			                  	if(isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] <> "all" && $_GET['program'] <> "all") {
												$get_curr_id = $_GET['curriculum'];
												$get_prog_id = $_GET['program'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $get_curr_id and programs.prog_id = $get_prog_id;";
											}elseif (isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] == "all" && $_GET['program'] <> "all") {
												$get_curr_id = "all";
												$get_prog_id = $_GET['program'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where programs.prog_id = $get_prog_id;";
											}elseif (isset($_GET['curriculum']) && $_GET['program'] && $_GET['curriculum'] <> "all" && $_GET['program'] == "all") {
												$get_prog_id = "all";
												$get_curr_id = $_GET['curriculum'];
												$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $get_curr_id;";
											}
											else {
											        $statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id;";
											}
													$result = DB::query($statement);
													$rows = count($result);
			                    $total = ceil($rows/$limit);

			                    echo '<div class="pull-right">
			                      <div class="col s12">
			                      <ul class="pagination center-align">';
			                      if($page > 1) {
			                        echo "<li class=''><a href='student_subjects.php?curriculum=$get_curr_id&program=$get_prog_id&page=".($page-1)."'>Previous</a></li>";
			                      }else if($total <= 0) {
			                        echo '<li class="disabled"><a>Previous</a></li>';
			                      }else {
			                        echo '<li class="disabled"><a>Previous</a></li>';
			                      }
								// Google Like Pagination
			                      $x = 0;
			                      $y = 0;
			                      if(($page+5) <= $total) {
			                        if($page >= 3) {
			                          $x = $page + 2;

			                        }else {
			                          $x = 5;
			                        }

			                        $y = $page;
			                        if($y <= $total) {
			                          $y -= 2;
			                          if($y < 1) {
			                            $y = 1;
			                          }
			                        }
			                      }else {
			                        $x = $total;
			                        $y = $total - 5;
			                        if($y < 1) {
			                          $y = 1;
			                        }
			                      }
			                      // Google Like Pagination
			                      for($i = $y;$i <= $x; $i++) {
			                        if($i==$page) {
			                          echo "<li class='active'><a href='student_subjects.php?curriculum=$get_curr_id&program=$get_prog_id&page=$i'>$i</a></li>";
			                      	} else {
			                          	echo "<li class=''><a href='student_subjects.php?curriculum=$get_curr_id&program=$get_prog_id&page=$i'>$i</a></li>";
			                        }
			                      }
			                      if($total == 0) {
			                        echo "<li class='disabled'><a>Next</a></li>";
			                      }else if($page!=$total) {
			                        echo "<li class=''><a href='student_subjects.php?curriculum=$get_curr_id&program=$get_prog_id&page=".($page+1)."'>Next</a></li>";
			                      }else {
			                        echo "<li class='disabled'><a>Next</a></li>";
			                      }
			                        echo "</ul></div></div>";


			                ?>
							<a href="subject_add.php">Add Subject</a>
						</div>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<!-- /page content -->
	<!-- Content Here -->
	<!-- Footer -->
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
	<script>
	function showSubjects() {
	var xhttp = new XMLHttpRequest();
	var curriculum = document.getElementById("curriculum").value;
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	document.getElementById("subjlist").innerHTML =
	this.responseText;
	}
	};
	if(curriculum == "all") {
		xhttp.open("GET", "phpscripts/showallsubjects.php", true);
	}else {
		xhttp.open("GET", "phpscripts/showsubjectlist.php?curr_id="+curriculum, true);
	}

	xhttp.send();
	}
	</script>
	<script type="text/javascript">

    $(function() {

      $('.subj-list').tablesorter();

      $('.tablesorter-bootstrap').tablesorter({
        theme : 'bootstrap',
        headerTemplate: '{content} {icon}',
        widgets    : ['zebra','columns', 'uitheme']
      });

    });

    </script>
</body>
</html>
