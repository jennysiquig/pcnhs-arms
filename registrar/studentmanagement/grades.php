<?php require_once "../../resources/config.php"; ?>
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
      header('Location: ../../login.php');
    }
   
  ?>
<!DOCTYPE html>
<?php $stud_id = $_GET['stud_id'] ?>
<html>
	<head>
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
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
				<!-- First Year -->
					<div class="col-md-12 col-sm-6 col-xs-12">
					

						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name1 = "";
							$yr_level1 = "";
							$schl_year1 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 1 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name1 = $row['schl_name'];
									$yr_level1 = $row['yr_level'];
									$schl_year1 = $row['schl_year'];
								}
							}
							
						if(empty($schl_year1) || $schl_year1 == "" || is_null($schl_year1)) {
							echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=1'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}else {
							echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=1'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}

						?>
		                <div class="x_panel">
		                	<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
		                  <div class="x_title">
		                    <h2>Year Level: <?php if(!empty($yr_level1)){
		                    						echo $yr_level1;
		                    						}else {
		                    							echo "None";
		                    						} 
											?><small>School Year: 
													<?php if(!empty($schl_year1)){
			                    						echo $schl_year1;
			                    						}else {
			                    							echo "None";
			                    						} 
													?></small></h2>
		                    <div class="clearfix"></div>
		                    <h2>School: <?php if(!empty($schl_name1)){
		                    						echo $schl_name1;
		                    						}else {
		                    							echo "None";
		                    						} 
											?></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Credit Earned</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 1 and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name1 = $row['subj_name'];
											$subj_level1 = $row['subj_level'];
											$fin_grade1 = $row['fin_grade'];
											$credit_earned1 = $row['credit_earned'];
											$comment1 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name1</th>
						                          <td>$subj_level1</td>
						                          <td>$fin_grade1</td>
						                          <td>$credit_earned1</td>
						                          <td>$comment1</td>
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>
		                    <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 1 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade1 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade1)){
		                    						echo substr($average_grade1, 0,5);
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                    						 <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT total_unit FROM pcnhsdb.grades where yr_level = 1 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$total_unit1 = $row['total_unit'];
									}
								}
							?>
		                    <h2>Total Units: <?php if(!empty($total_unit1)){
		                    						echo $total_unit1;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>	
		                  </div>
		                  <?php 
		                  // Check if year 2 has record, if true, previous record cannot be deleted.
							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name2 = "";
							$yr_level2 = "";
							$schl_year2 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 2 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name2 = $row['schl_name'];
									$yr_level2 = $row['yr_level'];
									$schl_year2 = $row['schl_year'];
								}
							}

		                  	if(!empty($average_grade1) && !empty($schl_year1) && !empty($yr_level1) && empty($schl_year2) && empty($yr_level2)) {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(1,'$stud_id');">Remove Record</button>
REMBUT;
		                  	}else {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(1,'$stud_id';);" disabled="">Remove Record</button>
REMBUT;
		                  	}
		                  ?>
		                    
		                </div>
		              </div>
				<!-- First Year -->
				<!-- Second Year -->
					<div class="col-md-12 col-sm-6 col-xs-12">
					

						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name2 = "";
							$yr_level2 = "";
							$schl_year2 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 2 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name2 = $row['schl_name'];
									$yr_level2 = $row['yr_level'];
									$schl_year2 = $row['schl_year'];
								}
							}
							
						if(empty($schl_year1) || $schl_year1 == "" || is_null($schl_year1)) {
							echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=2'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}else {
							if(empty($schl_year2) || $schl_year2 == "" || is_null($schl_year2)) {
								echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=2'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}else {
								echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=2'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}
							
						}

						?>
		                <div class="x_panel">
		                	<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
		                  <div class="x_title">
		                    <h2>Year Level: <?php if(!empty($yr_level2)){
		                    						echo $yr_level2;
		                    						}else {
		                    							echo "None";
		                    						} 
											?><small>School Year: 
													<?php if(!empty($schl_year2)){
			                    						echo $schl_year2;
			                    						}else {
			                    							echo "None";
			                    						} 
													?></small></h2>
		                    <div class="clearfix"></div>
		                    <h2>School: <?php if(!empty($schl_name2)){
		                    						echo $schl_name2;
		                    						}else {
		                    							echo "None";
		                    						} 
											?></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Credit Earned</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 2 and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name2 = $row['subj_name'];
											$subj_level2 = $row['subj_level'];
											$fin_grade2 = $row['fin_grade'];
											$credit_earned2 = $row['credit_earned'];
											$comment2 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name2</th>
						                          <td>$subj_level2</td>
						                          <td>$fin_grade2</td>
						                          <td>$credit_earned2</td>
						                          <td>$comment2</td>
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>
		                    <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 2 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade2 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade2)){
		                    						echo substr($average_grade2, 0,5);
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                    						 <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT total_unit FROM pcnhsdb.grades where yr_level = 2 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$total_unit2 = $row['total_unit'];
									}
								}
							?>
		                    <h2>Total Units: <?php if(!empty($total_unit2)){
		                    						echo $total_unit2;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>	
		                  </div>
		                  <?php 
		                  	if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name3 = "";
							$yr_level3 = "";
							$schl_year3 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 3 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name3 = $row['schl_name'];
									$yr_level3 = $row['yr_level'];
									$schl_year3 = $row['schl_year'];
								}
							}

		                  	if(!empty($average_grade2) && !empty($schl_year2) && !empty($yr_level2) && empty($schl_year3) && empty($yr_level3)) {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(2,'$stud_id');">Remove Record</button>
REMBUT;
		                  	}else {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(2,'$stud_id';);" disabled="">Remove Record</button>
REMBUT;
		                  	}
		                  ?>
		                    
		                </div>
		              </div>
				<!-- Second Year -->
				<!-- Third Year -->
					<div class="col-md-12 col-sm-6 col-xs-12">
					

						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name3 = "";
							$yr_level3 = "";
							$schl_year3 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 3 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name3 = $row['schl_name'];
									$yr_level3 = $row['yr_level'];
									$schl_year3 = $row['schl_year'];
								}
							}
							
						if(empty($schl_year2) || $schl_year2 == "" || is_null($schl_year2)) {
							echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=3'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}else {
							if(empty($schl_year3) || $schl_year3 == "" || is_null($schl_year3)) {
								echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=3'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}else {
								echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=3'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}
							
						}

						?>
		                <div class="x_panel">
		                	<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
		                  <div class="x_title">
		                    <h2>Year Level: <?php if(!empty($yr_level3)){
		                    						echo $yr_level3;
		                    						}else {
		                    							echo "None";
		                    						} 
											?><small>School Year: 
													<?php if(!empty($schl_year3)){
			                    						echo $schl_year3;
			                    						}else {
			                    							echo "None";
			                    						} 
													?></small></h2>
		                    <div class="clearfix"></div>
		                    <h2>School: <?php if(!empty($schl_name3)){
		                    						echo $schl_name3;
		                    						}else {
		                    							echo "None";
		                    						} 
											?></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Credit Earned</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 3 and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name3 = $row['subj_name'];
											$subj_level3 = $row['subj_level'];
											$fin_grade3 = $row['fin_grade'];
											$credit_earned3 = $row['credit_earned'];
											$comment3 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name3</th>
						                          <td>$subj_level3</td>
						                          <td>$fin_grade3</td>
						                          <td>$credit_earned3</td>
						                          <td>$comment3</td>
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>
		                    <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 3 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade3 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade3)){
		                    						echo substr($average_grade3, 0,5);
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                    						 <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT total_unit FROM pcnhsdb.grades where yr_level = 3 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$total_unit3 = $row['total_unit'];
									}
								}
							?>
		                    <h2>Total Units: <?php if(!empty($total_unit3)){
		                    						echo $total_unit3;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>	
		                  </div>
		                  <?php
		                  	if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name4 = "";
							$yr_level4 = "";
							$schl_year4 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 4 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name4 = $row['schl_name'];
									$yr_level4 = $row['yr_level'];
									$schl_year4 = $row['schl_year'];
								}
							}

		                  	if(!empty($average_grade3) && !empty($schl_year3) && !empty($yr_level3) && empty($schl_year4) && empty($yr_level4)) {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(3,'$stud_id');">Remove Record</button>
REMBUT;
		                  	}else {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(3,'$stud_id';);" disabled="">Remove Record</button>
REMBUT;
		                  	}
		                  ?>
		                    
		                </div>
		              </div>
				<!-- Third Year -->
				<!-- Fourth Year -->
					<div class="col-md-12 col-sm-6 col-xs-12">
					

						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$schl_name4 = "";
							$yr_level4 = "";
							$schl_year4 = "";
							$stud_id = $_GET['stud_id'];
							$query = "SELECT distinct(schl_name) as 'schl_name', studentsubjects.yr_level, studentsubjects.schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id left join pcnhsdb.grades on studentsubjects.stud_id = grades.stud_id where studentsubjects.yr_level = 4 and studentsubjects.stud_id = '$stud_id';";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$schl_name4 = $row['schl_name'];
									$yr_level4 = $row['yr_level'];
									$schl_year4 = $row['schl_year'];
								}
							}
							
						if(empty($schl_year3) || $schl_year3 == "" || is_null($schl_year3)) {
							echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=4'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
						}else {
							if(empty($schl_year4) || $schl_year4 == "" || is_null($schl_year4)) {
								echo "<a class='btn btn-success pull-right' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=4'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}else {
								echo "<a class='btn btn-success pull-right disabled' href='../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id&yr_level=4'><i class='fa fa-plus m-right-xs'></i> Add Grades</a>";
							}
							
						}

						?>
		                <div class="x_panel">
		                	<ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i> Toggle</a>
		                      </li>
		                    </ul>
		                  <div class="x_title">
		                    <h2>Year Level: <?php if(!empty($yr_level4)){
		                    						echo $yr_level4;
		                    						}else {
		                    							echo "None";
		                    						} 
											?><small>School Year: 
													<?php if(!empty($schl_year4)){
			                    						echo $schl_year4;
			                    						}else {
			                    							echo "None";
			                    						} 
													?></small></h2>
		                    <div class="clearfix"></div>
		                    <h2>School: <?php if(!empty($schl_name4)){
		                    						echo $schl_name4;
		                    						}else {
		                    							echo "None";
		                    						} 
											?></h2>
		                    <div class="clearfix"></div>
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Credit Earned</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, credit_earned, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 4 and stud_id = '$stud_id';";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name4 = $row['subj_name'];
											$subj_level4 = $row['subj_level'];
											$fin_grade4 = $row['fin_grade'];
											$credit_earned4 = $row['credit_earned'];
											$comment4 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name4</th>
						                          <td>$subj_level4</td>
						                          <td>$fin_grade4</td>
						                          <td>$credit_earned4</td>
						                          <td>$comment4</td>
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>
		                    <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 4 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade4 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade4)){
		                    						echo substr($average_grade4, 0,5);
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                    						 <?php

								if(!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								$statement = "SELECT total_unit FROM pcnhsdb.grades where yr_level = 4 and stud_id = '$stud_id';";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$total_unit4 = $row['total_unit'];
									}
								}
							?>
		                    <h2>Total Units: <?php if(!empty($total_unit4)){
		                    						echo $total_unit4;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>	
		                  </div>
		                  <?php 
		                  	if(!empty($average_grade4) || !empty($schl_year4) || !empty($yr_level4)) {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(4,'$stud_id');">Remove Record</button>
REMBUT;
		                  	}else {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeGrade(4,'$stud_id';);" disabled="">Remove Record</button>
REMBUT;
		                  	}
		                  ?>
		                    
		                </div>
		              </div>
				<!-- Fourth Year -->
			
			<!-- Other Subjects -->
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
					<!--  -->
					<div class="col-md-12 col-sm-6 col-xs-12">
					<a class="btn btn-success pull-right" href=<?php echo "../../registrar/studentmanagement/add_othersubject_grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Add Other Subject</a>
		                
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>School Name</th>
		                          <th>School Year</th>
		                          <th>Year Level</th>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Subject Type</th>
		                          <th>Final Grade</th>
		                          <th>Credit Earned</th>
		                          <th>Remarks</th>
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
						                        </tr>

YR1;
										}
									}
									

								?>
		                        
		                      </tbody>
		                    </table>	
		                  
		                  <?php 
		                  	if(!empty($schl_name)) {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeOtherSubjects('$stud_id');">Remove Record</button>
REMBUT;
		                  	}else {
		                  		echo <<<REMBUT
		                  			<button class="btn btn-danger btn-xs" onclick="removeOtherSubjects('$stud_id';);" disabled="">Remove Record</button>
REMBUT;
		                  	}
		                  ?>
		                </div>
		              </div>
		            </div>
		           </div>
		          </div>
				<!-- -->
				<div class="clearfix"></div>
              		
				</div>
			</div>
			<!-- Other Subjects -->
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
		<script src= "../../js/custom.min.js"></script>
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
	</body>
</html>