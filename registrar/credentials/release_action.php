<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

  ?>
<?php
	$stud_id = $_GET['stud_id']; 
	$req_id = $_GET['req_id'];
	$cred_id = $_GET['cred_id'];
	$request_type = $_GET['request_type'];
	$insertstm1 = "";
	if(!$conn) {
		die();
	}

	$selectstm1 = "SELECT * from credentials where cred_id = $cred_id";

	$result = $conn->query($selectstm1);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$cred_id = $row['curr_id'];
			$cred_name = $row['curr_name'];
			$price = $row['price'];
		}
	}

 	$updatestm1 = "UPDATE `pcnhsdb`.`requests` SET `status`='r', `date_released`= current_date() WHERE `req_id`= '$req_id';";

 	if($request_type == "individual") {
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `pay_amt`, `stud_id`) VALUES (current_date(), $price, '$stud_id');";
 	}else {
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `pay_amt`, `stud_id`) VALUES (current_date(), 0, '$stud_id');";
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

	$insertstm2 = "INSERT INTO `pcnhsdb`.`transaction` (`trans_date`, `total_trans_amt`, `stud_id`, `pay_id`, `req_id`) VALUES (current_date(), $pay_amt, '$stud_id', $pay_id, $req_id);";

	mysqli_query($conn, $insertstm2);

 	header("location: released.php");

?>