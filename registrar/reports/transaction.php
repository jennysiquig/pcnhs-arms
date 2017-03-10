<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

  ?>
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
		<!-- Date Range Picker -->
		<link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../css/custom.css" rel="stylesheet">
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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Transaction Reports</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<!-- Date Picker -->
	                      <div class="col-md-4">
	                        Select Date of Transaction
	                        <form class="form-horizontal" action="transaction.php" method="get">
	                          <fieldset>
	                            <div class="control-group">
	                              <div class="controls">
	                                <div class="input-prepend input-group">
	                                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
	                                  <input type="text" style="width: 200px" name="transaction_date" id="reservation" class="form-control" value="03/11/2017 - 03/11/2017" />
	                                </div>

	                              </div>
	                              <button>Go</button>
	                            </div>
	                          </fieldset>
	                        </form>
	                      </div>
	                      <!-- Date Picker -->
						<div class="x_content">
							<div class="table-responsive">
								<table class="table table-striped jambo_table">
									<thead>
										<tr class="headings">
											<th class="column-title">Transaction Date</th>
											<th class="column-title">Student Name</th>
											<th class="column-title">Requested Credential/s</th>
											<th class="column-title">Date Processed</th>
											<th class="column-title">Date Released</th>
											<th class="column-title">Total Amount</th>
											
										</th>
										
									</tr>
								</thead>
								<tbody>
								<?php
									$statement = "";
				                    $start=0;
				                    $limit=20;

				                    if(!$conn) {
				                    die("Connection failed: " . mysqli_connect_error());
				                    }

				                    if(isset($_GET['page'])){
				                      $page=$_GET['page'];
				                      $start=($page-1)*$limit;
				                    }else{
				                      $page=1;
				                    }

				                    if(isset($_GET['transaction_date'])) {
				                    	$transaction_date = $_GET['transaction_date'];
				                    	$from_and_to_date = explode("-", $transaction_date);
				                    	$sqldate_format_from = explode("/", $from_and_to_date[0]);
										$m = $sqldate_format_from[0];
										$d = $sqldate_format_from[1];
										$y = $sqldate_format_from[2];
										$m = preg_replace('/\s+/', '', $m);
										$d = preg_replace('/\s+/', '', $d);
										$y = preg_replace('/\s+/', '', $y);

										$from = $y."-".$m."-".$d;

										$sqldate_format_to = explode("/", $from_and_to_date[1]);
										$m = $sqldate_format_to[0];
										$d = $sqldate_format_to[1];
										$y = $sqldate_format_to[2];
										$m = preg_replace('/\s+/', '', $m);
										$d = preg_replace('/\s+/', '', $d);
										$y = preg_replace('/\s+/', '', $y);

										$to = $y."-".$m."-".$d;



				                    	$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join transaction natural join credentials where trans_date between '$from' and '$to' limit $start, $limit;";
				                    }else {
				                    	$transaction_date = date('m/d/y').'-'.date('m/d/y');
				                    	$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join transaction natural join credentials limit $start, $limit";
				                    }


				                    $result = $conn->query($statement);
					                if ($result->num_rows > 0) {
					                    // output data of each row
					                    while($row = $result->fetch_assoc()) {
					                    	$transaction_date = $row['trans_date'];
					                    	$student = $row['first_name']." ".$row['last_name'];
					                    	$credential = $row['cred_name'];
					                    	$date_processed = $row['date_processed'];
					                    	$date_released = $row['date_released'];
					                    	$total_trans_amt = $row['total_trans_amt'];
					                    echo <<<TRANS
					                    	<tr class="odd pointer">
												<td class=" ">$transaction_date</td>
												<td class=" ">$student</td>
												<td class=" ">$credential</td>
												<td class=" ">$date_processed</td>
												<td class=" ">$date_released</td>
												<td class=" ">$total_trans_amt</td>
											</tr>
TRANS;
					                    	

					                    }
					                }

				                    

								?>
									
								</tbody>
							</table>
							<?php
								if(isset($_GET['transaction_date'])) {
				                    	$transaction_date = $_GET['transaction_date'];
				                    	$from_and_to_date = explode("-", $transaction_date);
				                    	$sqldate_format_from = explode("/", $from_and_to_date[0]);
										$m = $sqldate_format_from[0];
										$d = $sqldate_format_from[1];
										$y = $sqldate_format_from[2];
										$m = preg_replace('/\s+/', '', $m);
										$d = preg_replace('/\s+/', '', $d);
										$y = preg_replace('/\s+/', '', $y);

										$from = $y."-".$m."-".$d;

										$sqldate_format_to = explode("/", $from_and_to_date[1]);
										$m = $sqldate_format_to[0];
										$d = $sqldate_format_to[1];
										$y = $sqldate_format_to[2];
										$m = preg_replace('/\s+/', '', $m);
										$d = preg_replace('/\s+/', '', $d);
										$y = preg_replace('/\s+/', '', $y);

										$to = $y."-".$m."-".$d;

				                    	$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join transaction natural join credentials where trans_date between '$from' and '$to';";
				                    }else {
				                    	$transaction_date = date('m/d/y').'-'.date('m/d/y');
				                    	$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join transaction natural join credentials";
				                    }
							
							$rows = mysqli_num_rows(mysqli_query($conn, $statement));
							$total = ceil($rows/$limit);
							echo '<div class="pull-right">
									<div class="col s12">
											<ul class="pagination center-align">';
													if($page > 1) {
													echo "<li class=''><a href='transaction.php?page=".($page-1)."&transaction_date=$transaction_date'>Previous</a></li>";
													}else if($total <= 0) {
													echo '<li class="disabled"><a>Previous</a></li>';
													}else {
													echo '<li class="disabled"><a>Previous</a></li>';
													}
													for($i = 1;$i <= $total; $i++) {
													if($i==$page) {
													echo "<li class='active'><a href='transaction.php?page=$i&transaction_date=$transaction_date'>$i</a></li>";
													} else {
													echo "<li class=''><a href='transaction.php?page=$i&transaction_date=$transaction_date'>$i</a></li>";
													}
													}
													if($total == 0) {
													echo "<li class='disabled'><a>Next</a></li>";
													}else if($page!=$total) {
													echo "<li class=''><a href='transaction.php?page=".($page+1)."&transaction_date=$transaction_date'>Next</a></li>";
													}else {
													echo "<li class='disabled'><a>Next</a></li>";
													}
											echo "</ul></div></div>";
											
									?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Contents Here -->
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
		<!-- Date Range Picker -->
		<script src="../../resources/libraries/moment/min/moment.min.js"></script>
		<script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../js/custom.js"></script>
		
	<!-- Scripts -->
</body>
</html>