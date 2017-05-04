<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<html>
	<head>
		<title>Payment Remittance</title>
		<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		<link rel="stylesheet" href="../../assets/css/paymentprint.css">
		<style type="text/css" media="print">
		   .no-print { display: none; }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="main">
				<div class="row">

					<center><h4 class="top">PINES CITY NATIONAL HIGH SCHOOL</h4></center>
					<center><h4 class="top">PAYMENT REMITTANCE</h4></center>
					<center><h4 class="top"><?php
						// date ex. March 1-17, 2017
						echo $_POST['payment_date'];
					?></h4></center>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 center-align">
						<table>
							<thead>
								<th>DATE</th>
								<th>OR NUMBER</th>
								<th>NAME</th>
								<th>ITEM</th>
								<th>AMOUNT</th>
								<th>NO. OF COPIES</th>
								<th>REMARKS</th>
							</thead>
							<tbody>
								<?php
									if(isset($_POST['payment_date'])) {
									$payment_date = $_POST['payment_date'];
									$from_and_to_date = explode("-", $payment_date);
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
									$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join payment natural join credentials natural join transaction where pay_date between '$from' and '$to';";
									}else {
									$pay_date = date('m/d/y').'-'.date('m/d/y');
										$statement = "SELECT * FROM pcnhsdb.students natural join requests natural join payment natural join credentials natural join transaction;";
									}
									$result = DB::query($statement);
									if (count($result) > 0) {
										foreach ($result as $row) {
											$pay_date = $row['pay_date'];
											$or_no = $row['or_no'];
											$student = $row['first_name']." ".$row['last_name'];
											$credential = $row['cred_name'];
											$pay_amt = $row['pay_amt'];
											$remarks = $row['remarks'];

												//remarks
											echo <<<PAYMENT
													<tr class="odd pointer">
															<td class=" ">$pay_date</td>
															<td class=" ">$or_no</td>
															<td class=" ">$student</td>
															<td class=" ">$credential</td>
															<td class=" ">$pay_amt</td>
															<td class=" ">1</td>
															<td class=" ">$remarks</td>


													</tr>
PAYMENT;

											}
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<br>
					<?php
					$personnel_id = $_SESSION['per_id'];
					$statement = "SELECT * FROM personnel WHERE per_id='$personnel_id'";
					$result = DB::query($statement);
					if (count($result) > 0) {
						foreach ($result as $row) {
					$registrar_id = $row['per_id'];
					$registrar_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
					$registrar_name = strtoupper($registrar_name);
					$position_reg = $row['position'];
					$position_reg = strtolower($position_reg);
					$position_reg = ucfirst($position_reg);
					}
					}
					?>
					<?php
					$signatory = $_POST['signatory'];
					$statement = "SELECT * FROM signatories WHERE sign_id='$signatory'";
					$result = DB::query($statement);
					if (count($result) > 0) {
						foreach ($result as $row) {
					$sign_id = $row['sign_id'];
					$sign_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
					$sign_name = strtoupper($sign_name);
					$position = $row['position'];
					$position = strtolower($position);
					$position = ucfirst($position);
					}
					}
					?>

					<?php
					$statement = "SELECT * FROM personnel WHERE per_id='$personnel_id'";
					$result = DB::query($statement);
					if (count($result) > 0) {
						foreach ($result as $row) {
					$registrar_id = $row['per_id'];
					$registrar_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
					$registrar_name = strtoupper($registrar_name);
					$position_reg = $row['position'];
					$position_reg = strtolower($position_reg);
					$position_reg = ucfirst($position_reg);
					}
					}
					?>
					<?php
					$statement = "SELECT * FROM signatories WHERE sign_id='$signatory'";
					$result = DB::query($statement);
					if (count($result) > 0) {
						foreach ($result as $row) {
					$sign_id = $row['sign_id'];
					$sign_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
					$sign_name = strtoupper($sign_name);
					$position = $row['position'];
					$position = strtolower($position);
					$position = ucfirst($position);
					}
					}
					?>
					<div class="row">
						<div class="col-md-12">
							<div id="box-1">
								<p id="b1-r1-p1">Prepared by:</p>
								<div id="b1-r2-name"> <?php echo $registrar_name; ?></div>
								<div id="b1-r3-pos"> <p> <?php echo $position_reg; ?> </p></div>
							</div>
							<br>
							<div id="box-2">
								<p id="b2-r1-p1">Checked &amp; Verified by:</p>
								<div id="b2-r2-name"> <?php echo $sign_name; ?> </div>
								<div id="b2-r3-pos"> <p> <?php echo $position; ?></p> </div>
							</div>
						</div>
					</div>
				</div>
				<br>

				<div class="no-print">

				<div class="col-md-8">
					<a href="../../registrar" class="btn btn-success pull-right"><i class="fa fa-home"></i> Back to Home</a>
					<button class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
				</div>
			</div>
			</div>
			<!-- NProgress -->
			<script src="../../resources/libraries/nprogress/nprogress.js"></script>
		</body>
	</html>
