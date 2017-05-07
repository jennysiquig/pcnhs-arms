<!DOCTYPE html>
<?php
session_start();
// Session Timeout
$time = time();
$session_timeout = 1800; //seconds

if (isset($_SESSION['generated_form137'])) {
    unset($_SESSION['generated_form137']);
    header("location: index.php");
    die();
}
if (isset($_SESSION['generated_diploma'])) {
    unset($_SESSION['generated_diploma']);
    header("location: index.php");
    die();
}

if (isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
    $_SESSION['timeout_message'] = "You have been logged out due to inactivity. Please Login Again.";
    header("location: ../logout.php");
}
$_SESSION['last_activity'] = $time;
if (isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] != "registrar") {
        echo "<p>Access Failed <a href='../index.php'>Back to Home</a></p>";
        die();
    }
} else {
    header('Location: ../login.php');
}
?>
<?php require_once '../resources/config.php' ?>
<html>
	<head>
		<title>Home</title>
		<link rel="shortcut icon" href="../assets/images/ico/fav.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		 <!-- jQuery -->
	    <script src="../resources/libraries/jquery/dist/jquery.min.js" ></script>

	    <!-- Tablesorter themes -->
	    <!-- bootstrap -->
	    <link href="../resources/libraries/tablesorter/css/bootstrap-v3.min.css" rel="stylesheet">
	    <link href="../resources/libraries/tablesorter/css/theme.bootstrap.css" rel="stylesheet">

	    <!-- Tablesorter: required -->
	    <script src="../resources/libraries/tablesorter/js/jquery.tablesorter.js"></script>
	    <script src="../resources/libraries/tablesorter/js/jquery.tablesorter.widgets.js"></script>
		<!-- NProgress -->
		<link href="../resources/libraries/nprogress/nprogress.css" rel="stylesheet">

		<!-- Bootstrap -->
		<link href="../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">

		<!-- Datatables -->
		<link href="../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="../assets/css/custom.min.css" rel="stylesheet">
		<!-- Custom Theme Style -->
	    <link href="../assets/css/customstyle.css" rel="stylesheet">
	    <link href="../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">

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
		<?php include "../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../resources/templates/registrar/top-nav.php"; ?>
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="row top_tiles">
				<a href="studentmanagement/student_list.php">
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="tile-stats">
							<div class="icon"><i class="fa fa-user"></i></div>
							<?php
                $result = DB::query("SELECT count(*) as students FROM pcnhsdb.students");
                foreach ($result as $row) {
                  $students = $row["students"];
                  echo "<div class='count'>$students</div>";
                }
              ?>
							<p>&nbsp</p>
							<h3>Total Students</h3>
							<p>&nbsp</p>
						</div>
					</div>
					</a>
					<a href="credentials/unclaimed.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="glyphicon glyphicon-hourglass"></i></div>
								<?php
                    $result = DB::query("SELECT count(*) as unclaimed FROM pcnhsdb.requests where status = 'u';");
                    foreach ($result as $row) {
                      $unclaimed = $row["unclaimed"];
                      echo "<div class='count'>$unclaimed</div>";
                    }
                ?>
								<p>&nbsp</p>
								<h3>Unclaimed Credentials</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
					<a href="credentials/released.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-paper-plane"></i></div>
								<?php
                    $result = DB::query("SELECT count(*) as released FROM pcnhsdb.requests where status = 'r';");
                    foreach ($result as $row) {
                      $released = $row["released"];
                      echo "<div class='count'>$released</div>";
                    }
                ?>
								<p>&nbsp</p>
								<h3>Released Credentials</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
					<a href="reports/transaction.php">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="glyphicon glyphicon-check"></i></div>
								<?php
                  $result = DB::query("SELECT count(*) as totaltrans FROM pcnhsdb.transaction;");
                  foreach ($result as $row) {
                    $totaltrans = $row["totaltrans"];
                    echo "<div class='count'>$totaltrans</div>";
                  }
                ?>
								<p>&nbsp</p>
								<h3>Transactions</h3>
								<p>&nbsp</p>
							</div>
						</div>
					</a>
				</div>
				<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Recent Credential Requests</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<a href="credentials/request_credential.php" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New Request</a>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="recent-request table-list">
								<table class="tablesorter-bootstrap">
									<thead>
										<tr class="headings">
											<th class="column-title" data-sorter="false">Date of Request</th>
											<th class="column-title" data-sorter="false">Student Name</th>
											<th class="column-title" data-sorter="false">Requested Credential</th>
											<th class="column-title" data-sorter="false">Purpose</th>
											<th class="column-title no-link last" data-sorter="false"><span class="nobr">Action</span>
										</th>

									</tr>
								</thead>
								<tbody>
									<?php
                  $statement = "SELECT stud_id, req_id, cred_id, request_purpose, date_processed as 'date processed', concat(first_name, ' ', last_name) as 'stud_name', cred_id, cred_name, request_type FROM pcnhsdb.requests natural join students natural join credentials where status='p' order by req_id asc limit 5;";

                  $result = DB::query($statement);
                  foreach ($result as $row) {
                    $date_processed = $row['date processed'];
                    $stud_name = $row['stud_name'];
                    $cred_name = $row['cred_name'];
                    $request_purpose = $row['request_purpose'];
                    $request_purpose = strtoupper($request_purpose);
                    $cred_id = $row['cred_id'];
                    $stud_id = $row['stud_id'];

                    echo <<<UNCLAIMED
                      <tr class="odd pointer">
                          <td class=" ">$date_processed</td>
                          <td class=" ">$stud_name</td>
                          <td class=" ">$cred_name</td>
                          <td class=" ">$request_purpose</td>
                          <td class=" ">
                            <center>
                              <a href="../registrar/credentials/generate_cred.php?stud_id=$stud_id&credential=$cred_id&purpose=$request_purpose" class="btn btn-default"> Process Request</a>
                            </center>
                          </td>
                      </tr>
UNCLAIMED;
                  }

                  ?>
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
				</div>
		<div class="clear-fix"></div>
		</div>
		<!-- /page content -->
		<!-- Content Here -->
		<!-- Footer -->
		<?php include "../resources/templates/registrar/footer.php"; ?>

		<!-- Scripts -->
		<!-- Bootstrap -->
		<script src="../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src= "../resources/libraries/fastclick/lib/fastclick.js"></script>
		<!-- input mask -->
		<script src= "../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
		<script src= "../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- NProgress -->
		<script src="../resources/libraries/nprogress/nprogress.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../assets/js/jquery.easy-autocomplete.js"></script>
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
		return "studentmanagement/phpscript/student_search.php?query="+phrase;
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
		<script src= "../assets/js/custom.min.js"></script>
		
	</body>
</html>
