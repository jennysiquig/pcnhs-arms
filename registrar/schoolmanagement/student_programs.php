<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<html>
	<head>
	<title>Student Programs</title>
	<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">School Management</a></li>
				  <li class="active">Student Programs</li>
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
							<h2>Student Programs</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-hover jambo_table">
								<thead>
									<tr class="headings">
										<th class="column-title">Program ID</th>
										<th class="column-title">Program Name</th>
									
									</th>		
								</tr>
							</thead>
							<tbody>
								
								
								<?php
									require_once "../../resources/config.php";
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}

									$start=0;
                   					$limit=20;
									if(isset($_GET['page'])){
				                      $page=$_GET['page'];
				                      $start=($page-1)*$limit;
				                    }else{
				                      $page=1;
				                    }

									$statement = "SELECT * FROM pcnhsdb.programs limit $start, $limit";
									$result = $conn->query($statement);
									if($result->num_rows>0) {
										while($row=$result->fetch_assoc()) {
											$prog_id = $row['prog_id'];
											$prog_name = $row['prog_name'];
											
											echo <<<CURR
											<tr class="odd pointer">
													<td class=" ">$prog_id</td>
													<td class=" ">$prog_name</td>
													
													
											</tr>
CURR;
										}
									}
								?>
								
							</tbody>
						</table>
						<?php
		                  $statement = "SELECT * FROM pcnhsdb.programs;";
		                    $rows = mysqli_num_rows(mysqli_query($conn, $statement));
		                    $total = ceil($rows/$limit);
		                    
		                    echo '<div class="pull-right">
		                      <div class="col s12">
		                      <ul class="pagination center-align">';
		                      if($page > 1) {
		                        echo "<li class=''><a href='student_programs.php?page=".($page-1)."'>Previous</a></li>";
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
		                          echo "<li class='active'><a href='student_programs.php?page=$i'>$i</a></li>";
		                        } else {
		                            echo "<li class=''><a href='student_programs.php?page=$i'>$i</a></li>";
		                          }
		                      }


		                      if($total == 0) {
		                        echo "<li class='disabled'><a>Next</a></li>";
		                      }else if($page!=$total) {
		                        echo "<li class=''><a href='student_programs.php?page=".($page+1)."'>Next</a></li>";
		                      }else {
		                        echo "<li class='disabled'><a>Next</a></li>";
		                      }
		                        echo "</ul></div></div>";
		                      

		                ?>
					</div>
					<a href="programs_add.php">Add Program</a>
					
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
		<script src= "../../assets/js/custom.min.js"></script>
	<!-- Scripts -->
</body>
</html>