<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<!-- Update Database -->
<?php
	if(!$conn) {
		die();
	}
?>
<html>
	<head>

		<!-- Bootstrap -->
		<link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		<link rel="stylesheet" href="../../assets/css/paymentprint.css">

	</head>

	<body>
	<div class="main">
	<h4 class="top">PINES CITY NATIONAL HIGH SCHOOL</h4>
	<h4 class="top">PAYMENT REMITTANCE</h4>
	<h4 class="top"><?php // date ex. March 1-17, 2017 
			?></h4>

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

				if(!conn) {
					die("Connection failed: ". mysqli_connect_error());
				}

				$query = "SELECT * FROM pcnhsdb.payment NATURAL JOIN pcnhsdb.students;";
				$result = $conn->query($query);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$pay_date = $row['pay_date'];
						$or_no = $row['or_no'];
						$credential = $row['credential'];
						$pay_amt = $row['pay_amt'];
						$no_of_copies = $row['no_of_copies'];
						$student = $row['student'];

						echo "

							<tr class='t-row'>
								<td class='t-cell'>$pay_date</td>
								<td class='t-cell'>$or_no</td>
								<td class='t-cell'>$student</td>
								<td class='t-cell'>$credential</td>
								<td class='t-cell'>$pay_amt</td>	
								<td class='t-cell'>$no_of_copies</td>
							</tr> ";		
				

					}
				}


				?>


		</tbody>
	</table>
             <?php

             $statement = "SELECT * FROM personnel WHERE per_id='$personnel_id'";
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
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
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
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
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
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
             $result = $conn->query($statement);
             if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $sign_id = $row['sign_id'];
                        $sign_name = $row['first_name'].' '.substr($row['mname'], 0, 1).'. '.$row['last_name'];
                        $sign_name = strtoupper($sign_name);
                        $position = $row['position'];
                        $position = strtolower($position);
                        $position = ucfirst($position);
                    }
             }
             ?>


                            <div id="box-1">
                            <p id="b1-r1-p1">Prepared by:</p>
                            <div id="b1-r2-name"> <?php echo $registrar_name; ?></div>
                            <div id="b1-r3-pos"> <p> <?php echo $position_reg; ?> </p></div>
                            </div>

                            <div id="box-2">
                            <p id="b2-r1-p1">Checked &amp; Verified by:</p>
                            <div id="b2-r2-name"> <?php echo $sign_name; ?> </div>
                            <div id="b2-r3-pos"> <p> <?php echo $position; ?></p> </div>
                            </div>

	</div>

				<div class="row no-print">
				<div class="col-xs-12">
					<button class="btn btn-success pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
          <a href="../../registrar" class="btn btn-success pull-right"><i class="fa fa-home"></i>Back to Home</a>
				</div>
			</div>

	</body>
</html>