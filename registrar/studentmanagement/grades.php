<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<?php $stud_id = $_GET['stud_id'] ?>
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
		<div class="right_col" role="main">
			<div class="clearfix"></div>
			<div class="x_panel">
				<div class="x_title">
					<h2>Grades</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
				<!-- First Year -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$stud_id = $_GET['stud_id'];
							$query = "SELECT yr_level, schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 1 and stud_id = $stud_id;";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$yr_level1 = $row['yr_level'];
									$schl_year1 = $row['schl_year'];
								}
							}
							

						?>
		                <div class="x_panel">
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
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, unit, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 1 and stud_id = $stud_id;";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name1 = $row['subj_name'];
											$subj_level1 = $row['subj_level'];
											$fin_grade1 = $row['fin_grade'];
											$unit1 = $row['unit'];
											$comment1 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name1</th>
						                          <td>$subj_level1</td>
						                          <td>$fin_grade1</td>
						                          <td>$unit1</td>
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
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 1 and stud_id = $stud_id;";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade1 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade1)){
		                    						echo $average_grade1;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                  </div>
		                </div>
		              </div>
				<!-- First Year -->
				<!-- Second Year -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$stud_id = $_GET['stud_id'];
							$query = "SELECT yr_level, schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 2 and stud_id = $stud_id;";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$yr_level2 = $row['yr_level'];
									$schl_year2 = $row['schl_year'];
								}
							}
							

						?>
		                <div class="x_panel">
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
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, unit, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 2 and stud_id = $stud_id;";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name2 = $row['subj_name'];
											$subj_level2 = $row['subj_level'];
											$fin_grade2 = $row['fin_grade'];
											$unit2 = $row['unit'];
											$comment2 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name2</th>
						                          <td>$subj_level2</td>
						                          <td>$fin_grade2</td>
						                          <td>$unit2</td>
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
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 2 and stud_id = $stud_id;";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade2 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade2)){
		                    						echo $average_grade2;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                  </div>
		                </div>
		              </div>
				<!-- Second Year -->
				<!-- Third Year -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$stud_id = $_GET['stud_id'];
							$query = "SELECT yr_level, schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 3 and stud_id = $stud_id;";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$yr_level3 = $row['yr_level'];
									$schl_year3 = $row['schl_year'];
								}
							}
							

						?>
		                <div class="x_panel">
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
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT yr_level, schl_year, subj_name, subj_level, fin_grade, unit, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 3 and stud_id = $stud_id;";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$yr_level3 = $row['yr_level'];
											$schl_year3 = $row['schl_year'];
											$subj_name3 = $row['subj_name'];
											$subj_level3 = $row['subj_level'];
											$fin_grade3 = $row['fin_grade'];
											$unit3 = $row['unit'];
											$comment3 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name3</th>
						                          <td>$subj_level3</td>
						                          <td>$fin_grade3</td>
						                          <td>$unit3</td>
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
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 3 and stud_id = $stud_id;";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade3 = $row['average_grade'];
									}
								}
							?>
		                   <h2>Average Grade: <?php if(!empty($average_grade3)){
		                    						echo $average_grade3;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                  </div>
		                </div>
		              </div>
				<!-- Third Year -->
				<!-- Fourth Year -->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php

							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$stud_id = $_GET['stud_id'];
							$query = "SELECT yr_level, schl_year FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 4 and stud_id = $stud_id;";
							$result = $conn->query($query);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$yr_level4 = $row['yr_level'];
									$schl_year4 = $row['schl_year'];
								}
							}
							

						?>
		                <div class="x_panel">
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
		                  </div>
		                  <div class="x_content">
		                  	
		                    <table class="table table-bordered">
		                      <thead>
		                        <tr>
		                          <th>Subject</th>
		                          <th>Subject Level</th>
		                          <th>Final Grade</th>
		                          <th>Unit</th>
		                          <th>Remarks</th>
		                        </tr>
		                      </thead>
		                      <tbody>
		                      	<?php

									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$query = "SELECT subj_name, subj_level, fin_grade, unit, comment FROM pcnhsdb.studentsubjects left join subjects on studentsubjects.subj_id = subjects.subj_id where yr_level = 4 and stud_id = $stud_id;";
									$result = $conn->query($query);
									if ($result->num_rows > 0) {
										// output data of each row
										while($row = $result->fetch_assoc()) {
											$subj_name4 = $row['subj_name'];
											$subj_level4 = $row['subj_level'];
											$fin_grade4 = $row['fin_grade'];
											$unit4 = $row['unit'];
											$comment4 = $row['comment'];

											echo <<<YR1
												<tr>
						                          <th scope="row">$subj_name4</th>
						                          <td>$subj_level4</td>
						                          <td>$fin_grade4</td>
						                          <td>$unit4</td>
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
								$statement = "SELECT average_grade FROM pcnhsdb.grades where yr_level = 4 and stud_id = $stud_id;";
								$result = $conn->query($statement);
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										$average_grade4 = $row['average_grade'];
									}
								}
							?>
		                    <h2>Average Grade: <?php if(!empty($average_grade4)){
		                    						echo $average_grade4;
		                    						}else {
		                    							echo "None";
		                    						} ?></h2>
		                  </div>
		                </div>
		              </div>
				<!-- Fourth Year -->
              		<div class="clearfix"></div>
              		<a class="btn btn-success pull-right" href=<?php echo "../../registrar/studentmanagement/add_grades.php?stud_id=$stud_id" ?>><i class="fa fa-plus m-right-xs"></i> Add Grades</a>
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
	</body>
</html>