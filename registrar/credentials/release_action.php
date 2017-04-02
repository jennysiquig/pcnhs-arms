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
    		die();
    	}
	}else {
	    	header('Location: ../../login.php');
	}
	
   $_SESSION['last_activity'] = $time;

    
  ?>
<?php
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES); 
	$req_id = htmlspecialchars($_GET['req_id'], ENT_QUOTES);
	$cred_id = htmlspecialchars($_GET['cred_id'], ENT_QUOTES);
	$request_type = htmlspecialchars($_GET['request_type'], ENT_QUOTES);
	$or_no = htmlspecialchars(intval($_GET['or_no']), ENT_QUOTES);

	$insertstm1 = "";
	if(!$conn) {
		die();
	}

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
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `or_no`, `pay_amt`, `stud_id`, `cred_id`) VALUES (current_date(), '$or_no', '$price', '$stud_id', '$cred_id');";
 	}else {
 		$insertstm1 = "INSERT INTO `pcnhsdb`.`payment` (`pay_date`, `pay_amt`, `or_no`, `stud_id`) VALUES (current_date(), 0, 0, '$stud_id', '$cred_id');";
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

 	//header("location: released.php");

?>