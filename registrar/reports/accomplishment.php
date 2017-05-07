<!DOCTYPE html>
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
    if(isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])){
    	if($_SESSION['account_type'] != "registrar") {
    		echo "<p>Access Failed <a href='../index.php'>Back to Home</a></p>";
    	}
    }else {
    	header('Location: ../../login.php');
    }
    date_default_timezone_set('Asia/Manila');

  ?>
<html>
	<head>
		<title>Accomplishment Report</title>
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
	    <!-- Date Range Picker -->
		  <link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	    <!-- Datatables -->
	    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

	    <!-- Custom Theme Style -->
	    <link href="../../assets/css/custom.min.css" rel="stylesheet">
	     <!-- Custom Theme Style -->
	    <link href="../../assets/css/customstyle.css" rel="stylesheet">
	    <link href="../../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">

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
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">Reports</a></li>
				  <li class="active">Accomplishment Reports</li>
				</ol>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Accomplishment Reports</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<!-- Date Picker -->
						<div class="row">
							<div class="col-md-4">
								Select Date of Accomplishment
								<form class="form-horizontal" action="accomplishment.php" method="get" value="accomplishment_date">
									<fieldset>

										<div class="control-group">
											<div class="controls">
												<div class="input-prepend input-group">
													<span class="add-on input-group-addon">
														<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
													</span>
													<input type="text" name="accomplishment_date" id="accomplishment_date" class="form-control" value="accomplishment_date" />
													<span class="input-group-btn">
														<button type="submit" class="btn btn-primary">Go</button>
													</span>
												</div>
											</div>
										</div>

									</fieldset>
								</form>
							</div>
								<br>
								<div class="col-md-8">
								<?php
									$accomplishment_date_get = "";
									if(isset($_GET['accomplishment_date'])) {
										$accomplishment_date_get = $_GET['accomplishment_date'];
										$accomplishment_date_get = preg_replace('/\s+/', '', $accomplishment_date_get);

									}else {
										$date_from = date("m/01/Y");
										$date_to = date("m/d/Y");
										$accomplishment_date_get = $date_from.' - '.$date_to;
										$accomplishment_date_get = preg_replace('/\s+/', '', $accomplishment_date_get);
									}


								?>
								<a href= <?php echo "generate_accomp.php?accomplishment_date=$accomplishment_date_get"; ?>><button type="button" class="btn btn-success pull-right">Generate Report</button></a>

								</div>


						</div>
	                      <!-- Date Picker -->
						<div class="x_content">
							<div class="accomplishment-list">
								<table class="tablesorter-bootstrap">
									<thead>
										<tr class="headings">
											<th class="column-title" data-sorter="false">Item</th>
											<th class="column-title" data-sorter="false">Processed</th>
											<th class="column-title" data-sorter="false">Released</th>

										</th>

									</tr>
								</thead>
								<tbody>

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

				                    $statement = "SELECT * FROM pcnhsdb.credentials;";
				                    $result = DB::query($statement);
                            if (count($result) > 0) {
                          		foreach ($result as $row) {
				                    		$cred_id = $row['cred_id'];
				                    	    $cred_name = $row['cred_name'];

				                    	    echo 	'<tr class="odd pointer">';
				                    	    echo 		"<td class=''>$cred_name</td>";

				                    	     if(isset($_GET['accomplishment_date'])) {
					                    		$accomplishment_date = $_GET['accomplishment_date'];
						                    	//echo $accomplishment_date;
						                    	$from_and_to_date = explode("-", $accomplishment_date);
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
												//echo $accomplishment_date;

							                    $statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where (date_released is null or date_released is not null) and date_processed between '$from' and '$to' and credentials.cred_id = $cred_id";
							                    }else {
							                    	$accomplishment_date = date('m/d/y').'-'.date('m/d/y');

							                    	$statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where (date_released is null or date_released is not null) and credentials.cred_id = $cred_id";
							                    }


							                    $result_1 = DB::query($statement);
                                  if (count($result_1) > 0) {
                                		foreach ($result_1 as $row_1) {

								                   		$date_processed_count = $row_1['date_processed_count'];
								                    	$date_released_count = $row_1['date_released_count'];
								                    echo <<<REQ

															<td class=" ">$date_processed_count</td>
															<td class=" ">$date_released_count</td>

REQ;


								                    }
								                }
    										echo 	"</tr>";
				                    		}
				                    	}

									?>
								</tbody>
							</table>
							<?php
								if(isset($_GET['accomplishment_date'])) {
									$accomplishment_date = $_GET['accomplishment_date'];
									//echo $accomplishment_date;
									$from_and_to_date = explode("-", $accomplishment_date);
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
											//echo $accomplishment_date;

					                $statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where (date_released is null or date_released is not null) and date_processed between '$from' and '$to';";
					            }else {
					                    	$accomplishment_date = date('m/d/y').'-'.date('m/d/y');
					                    	$statement = "SELECT count(date_processed) as 'date_processed_count', count(date_released) as 'date_released_count' FROM pcnhsdb.requests natural join credentials where date_released is null or date_released is not null;";
					            }
					        $rows = DB::count($statement);
							    $total = ceil($rows/$limit);
							echo '<div class="pull-right">
									<div class="col s12">
											<ul class="pagination center-align">';
													if($page > 1) {
													echo "<li class=''><a href='accomplishment.php?page=".($page-1)."&accomplishment_date=$accomplishment_date'>Previous</a></li>";
													}else if($total <= 0) {
													echo '<li class="disabled"><a>Previous</a></li>';
													}else {
													echo '<li class="disabled"><a>Previous</a></li>';
													}
													for($i = 1;$i <= $total; $i++) {
													if($i==$page) {
													echo "<li class='active'><a href='accomplishment.php?page=$i&accomplishment_date=$accomplishment_date'>$i</a></li>";
													} else {
													echo "<li class=''><a href='accomplishment.php?page=$i&accomplishment_date=$accomplishment_date'>$i</a></li>";
													}
													}
													if($total == 0) {
													echo "<li class='disabled'><a>Next</a></li>";
													}else if($page!=$total) {
													echo "<li class=''><a href='accomplishment.php?page=".($page+1)."&accomplishment_date=$accomplishment_date'>Next</a></li>";
													}else {
													echo "<li class='disabled'><a>Next</a></li>";
													}
											echo "</ul></div></div>";

											// $_SESSION['accomplishment_date'] = $accomplishment_date;
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
	<!-- Bootstrap -->
	<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
	<!-- input mask -->
	<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
	<!-- Date Range Picker -->
	<script src="../../resources/libraries/moment/min/moment.min.js"></script>
	<script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
  	<!-- NProgress -->
  	<script src="../../resources/libraries/nprogress/nprogress.js"></script>
	<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
	<!-- Custom Theme Scripts -->
	
	<script src= "../../assets/js/jquery.easy-autocomplete.js"></script>
	<script src= "../../assets/js/custom.js"></script>
	    
	<script type="text/javascript">
			$('#accomplishment_date').daterangepicker({
			    ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), ],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				  },
			    startDate: moment().startOf('month'),
				endDate: moment().endOf('month')
			}, function(start, end, label) {
			  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
			});
		</script>
		<script type="text/javascript">
		$(function() {
		$('.accomplishment-list').tablesorter();
		$('.tablesorter-bootstrap').tablesorter({
		theme : 'bootstrap',
		headerTemplate: '{content} {icon}',
		widgets    : ['zebra','columns', 'uitheme']
		});
		});
		</script>
		<script type="text/javascript">
           $(function(){
                 $("#date").datepicker();
           });
   		</script>
   		<script type="text/javascript">
	      var options = {
	        url: function(phrase) {
	          return "../../registrar/studentmanagement/phpscript/student_search.php?query="+phrase;
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

</body>
</html>
