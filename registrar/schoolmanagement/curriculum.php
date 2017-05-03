<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<html>
	<head>
		<title>Curriculum</title>
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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">School Management</a></li>
				  <li class="active">Curriculum</li>
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
							<h2>Curriculum</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="curriculum-list">
							<table class="tablesorter-bootstrap">
								<thead>
									<tr class="headings">
										<th class="column-title" data-sorter="false">Curriculum ID</th>
										<th class="column-title" data-sorter="false">Curriculum Code</th>
										<th class="column-title" data-sorter="false">Curriculum Name</th>
										<th class="column-title" data-sorter="false">Year Started</th>
										<th class="column-title" data-sorter="false">Year Ended</th>
										<th class="column-title" data-sorter="false">Action</th>
									</th>

								</tr>
							</thead>
							<tbody>


								<?php
									require_once "../../resources/config.php";
									$start=0;
                   					$limit=20;
									if(isset($_GET['page'])){
				                      $page=$_GET['page'];
				                      $start=($page-1)*$limit;
				                    }else{
				                      $page=1;
				                    }
									$statement = "SELECT * FROM pcnhsdb.curriculum limit $start, $limit";
									$result = DB::query($statement);
									if (count($result) > 0) {
										foreach ($result as $row) {
											$curr_id = $row['curr_id'];
											$curr_code = $row['curr_code'];
											$curr_name = $row['curr_name'];
											$year_started = $row['year_started'];
											$year_ended = $row['year_ended'];
											echo <<<CURR
											<tr class="odd pointer">
													<td class=" ">$curr_id</td>
													<td class=" ">$curr_code</td>
													<td class=" ">$curr_name</td>
													<td class=" ">$year_started</td>
													<td class=" ">$year_ended</td>
													<td class=" ">
														<center>
															<a href="curriculum_edit.php?curr_id=$curr_id" class="btn btn-default"><i class="fa fa-edit"></i> Edit </a>
														</center>
													</td>
											</tr>
CURR;
										}
									}
								?>

							</tbody>
						</table>
						 <?php
		                  $statement = "SELECT * FROM pcnhsdb.curriculum;";
		                    $rows = DB::count($statement);
		                    $total = ceil($rows/$limit);

		                    echo '<div class="pull-right">
		                      <div class="col s12">
		                      <ul class="pagination center-align">';
		                      if($page > 1) {
		                        echo "<li class=''><a href='curriculum.php?page=".($page-1)."'>Previous</a></li>";
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
		                          echo "<li class='active'><a href='curriculum.php?page=$i'>$i</a></li>";
		                        } else {
		                            echo "<li class=''><a href='curriculum.php?page=$i'>$i</a></li>";
		                          }
		                      }


		                      if($total == 0) {
		                        echo "<li class='disabled'><a>Next</a></li>";
		                      }else if($page!=$total) {
		                        echo "<li class=''><a href='curriculum.php?page=".($page+1)."'>Next</a></li>";
		                      }else {
		                        echo "<li class='disabled'><a>Next</a></li>";
		                      }
		                        echo "</ul></div></div>";


		                ?>
					</div>
					<a href=<?php echo "../../registrar/schoolmanagement/curriculum_add.php" ?>>Add Curriculum</a>

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
		<script type="text/javascript">
		$(function() {
		$('.curriculum-list').tablesorter();
		$('.tablesorter-bootstrap').tablesorter({
		theme : 'bootstrap',
		headerTemplate: '{content} {icon}',
		widgets    : ['zebra','columns', 'uitheme']
		});
		});
		</script>
</body>
</html>
