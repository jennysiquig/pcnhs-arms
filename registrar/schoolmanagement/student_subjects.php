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
						<div class="item form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Student Curriculum</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="curriculum" class="form-control col-md-7 col-xs-12" name="curriculum" onchange="showSubjects()">
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
											$statement = "select * from subjects left join subjectcurriculum on subjects.subj_id = subjectcurriculum.subj_id left join curriculum on curriculum.curr_id = subjectcurriculum.curr_id";
											$result = $conn->query($statement);
											if($result->num_rows>0) {
												while ($row = $result->fetch_assoc()) {
													# code...
													$subj_id = $row['subj_id'];
													$subj_name = $row['subj_name'];
													$subj_level = $row['subj_level'];
													$curr_name = $row['curr_name'];
													echo <<<SUBJS
														<tr>
																<td>$subj_id</td>
																<td>$subj_name</td>
																<td>$subj_level</td>
																<td>$curr_name</td>
																<td> </td>
														</tr>
SUBJS;
												}
											}
									?>
								</tbody>
							</table>
							<a href="subject_add.php">Add Subject</a>
						</div>
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