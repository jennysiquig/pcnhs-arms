<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<html>
	<head>
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
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Filter Curriculum</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="curriculum" class="form-control col-md-7 col-xs-12" name="curriculum">

											<!-- <option value="1">Regular</option>
											-->
											<option value="all">All</option>
											<?php
												if(!$conn) {
													die("Connection failed: " . mysqli_connect_error());
												}

												$statement = "SELECT * FROM pcnhsdb.curriculum";

												$result = $conn->query($statement);
												if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													$curr_id = $row['curr_id'];
													$curr_name = $row['curr_name'];
													echo <<<OPTION2
																		<option value="$curr_id">$curr_name</option>
OPTION2;
																}
															}
											?>
											</select>
										</div>
										
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Filter Program</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="curriculum" class="form-control col-md-7 col-xs-12" name="program">

											<!-- <option value="1">Regular</option>
											-->
											<option value="all">All</option>
											<?php
												if(!$conn) {
													die("Connection failed: " . mysqli_connect_error());
												}

												$statement = "SELECT * FROM pcnhsdb.programs";

												$result = $conn->query($statement);
												if ($result->num_rows > 0) {
												// output data of each row
												while($row = $result->fetch_assoc()) {
													$prog_id = $row['prog_id'];
													$prog_name = $row['prog_name'];
													echo <<<OPTION2
																		<option value="$prog_id">$prog_name</option>
OPTION2;
																}
															}
											?>
											</select>
										</div>
										
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<button class="btn btn-primary pull-right">Go</button>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">Showing:</label>
									<?php
												if(!$conn) {
													die("Connection failed: " . mysqli_connect_error());
												}
												if(isset($_GET['curriculum']) && isset($_GET['program']) ) {
													$curr_id = $_GET['curriculum'];
													$prog_id = $_GET['curriculum'];
								                	if($curr_id === "all" && $prog_id === "all") {
														$statement = "SELECT * FROM pcnhsdb.curriculum";
													}else {
														$statement = "SELECT * FROM pcnhsdb.curriculum where curr_id = $curr_id";
													}
												}
												$result = $conn->query($statement);
												if ($result->num_rows > 0) {
													// output data of each row
													while($row = $result->fetch_assoc()) {
														$curr_id = $row['curr_id'];
														$curr_name = $row['curr_name'];
													}
												}
										?>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<input class="form-control col-md-7 col-xs-12" required="required" type="text" value=<?php $curr_id = $_GET['curriculum']; if($curr_id==="all") {echo "All";}else {echo "'$curr_name'";}  ?> readonly="">
										</div>
								</div>
							
							<div class="clearfix"></div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="headings">
											<th class="column-title">Subject ID</th>
											<th class="column-title">Subject Name</th>
											<th class="column-title">Subject Level</th>
											<th class="column-title">Curriculum</th>
											<th class="column-title">Program</th>
										</th>
									</tr>
								</thead>
								<tbody id="subjlist">
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
							                if(isset($_GET['curriculum'])) {
							                	$curr_id = $_GET['curriculum']; 
							                	if($curr_id === "all") {
							                		$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id limit $start, $limit;";

							                	}else{
							                		$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $curr_id limit $start, $limit;";
							                	}
							                	
							                }else {
							                	$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id limit $start, $limit;";
							                }
											
											$result = $conn->query($statement);

											if($result->num_rows>0) {
												while ($row = $result->fetch_assoc()) {
													# code...
													$subj_id = $row['subj_id'];
													$subj_name = $row['subj_name'];
													$subj_level = $row['subj_level'];
													$curr_name = $row['curr_name'];
													$prog_name = $row['prog_name'];
													echo <<<SUBJS
														<tr>
																<td>$subj_id</td>
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
			                  	if(isset($_GET['curriculum'])) {
								    $curr_id = $_GET['curriculum']; 
								    if($curr_id === "all") {
								    	$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id;";
								    }else{
								    	$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id where curriculum.curr_id = $curr_id;";
								    }           	
								}else {
							        $statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id left join subjectprogram on subjects.subj_id = subjectprogram.subj_id left join programs on programs.prog_id = subjectprogram.prog_id;";
							    }
							    $result = $conn->query($statement);
			                    $rows = mysqli_num_rows($result);
			                    $total = ceil($rows/$limit);

			                    echo '<div class="pull-right">
			                      <div class="col s12">
			                      <ul class="pagination center-align">';
			                      if($page > 1) {
			                        echo "<li class=''><a href='student_subjects.php?curriculum=$curr_id&page=".($page-1)."'>Previous</a></li>";
			                      }else if($total <= 0) {
			                        echo '<li class="disabled"><a>Previous</a></li>';
			                      }else {
			                        echo '<li class="disabled"><a>Previous</a></li>';
			                      }
			                      for($i = 1;$i <= $total; $i++) {
			                        if($i==$page) {
			                          echo "<li class='active'><a href='student_subjects.php?curriculum=$curr_id&page=$i'>$i</a></li>";
			                      } else {
			                          echo "<li class=''><a href='student_subjects.php?curriculum=$curr_id&page=$i'>$i</a></li>";
			                        }
			                      }
			                      if($total == 0) {
			                        echo "<li class='disabled'><a>Next</a></li>";
			                      }else if($page!=$total) {
			                        echo "<li class=''><a href='student_subjects.php?curriculum=$curr_id&page=".($page+1)."'>Next</a></li>";
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
</body>
</html>