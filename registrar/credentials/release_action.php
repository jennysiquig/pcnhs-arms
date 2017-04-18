<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES); 
	$req_id = htmlspecialchars($_GET['req_id'], ENT_QUOTES);
	$cred_id = htmlspecialchars($_GET['cred_id'], ENT_QUOTES);
	$request_type = htmlspecialchars($_GET['request_type'], ENT_QUOTES);
	$or_no = htmlspecialchars($_GET['or_no'], ENT_QUOTES);
	
	$insertstm1 = "";
	if(!$conn) {
		die();
	}
	$_SESSION['user_activity'] = "Released Credential of $stud_id";
	
	$selectstm1 = "SELECT * from credentials where cred_id = $cred_id";

	$result = $conn->query($selectstm1);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$cred_id = $row['cred_id'];
			$cred_name = $row['cred_name'];
			$price = $row['price'];
		}
	}

 	$updatestm1 = "UPDATE `pcnhsdb`.`requests` SET `status`='r', `date_released`= current_date() WHERE `req_id`= '$req_id';";

 	if($request_type == "individual") {
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `pay_amt`, `stud_id`, remarks) VALUES (current_date(), '$price', '$stud_id','Regular');";
 	}else {
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `pay_amt`, `stud_id`, remarks) VALUES (current_date(), 0, 0, '$stud_id', 'Regular');";
 	}

 	mysqli_query($conn, $updatestm1);
 	mysqli_query($conn, $insertstm1);

 	$selectstm2 = "SELECT * from payment where stud_id = '$stud_id';";
 	$result = $conn->query($selectstm2);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$pay_id = $row['pay_id'];
			$pay_amt =$row['pay_amt'];
		}
	}

	$insertstm2 = "INSERT INTO `pcnhsdb`.`transaction` (`trans_date`, `total_trans_amt`, `stud_id`, `pay_id`, `req_id`, `or_no`) VALUES (current_date(), '$pay_amt', '$stud_id', '$pay_id', '$req_id', '$or_no');";

	mysqli_query($conn, $insertstm2);

 	//header("location: released.php");

?>