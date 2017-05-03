<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$req_id = htmlspecialchars($_GET['req_id'], ENT_QUOTES);
	$cred_id = htmlspecialchars($_GET['cred_id'], ENT_QUOTES);
	$request_type = htmlspecialchars($_GET['request_type'], ENT_QUOTES);
	$or_no = htmlspecialchars($_GET['or_no'], ENT_QUOTES);

	$insertstm1 = "";

	$_SESSION['user_activity'] = "Released Credential of $stud_id";

	$selectstm1 = "SELECT * from credentials where cred_id = $cred_id";

	$result = DB::query($selectstm1);
	if (count($result) > 0) {
		foreach ($result as $row) {
			$cred_id = $row['cred_id'];
			$cred_name = $row['cred_name'];
			$price = $row['price'];
		}
	}
	$date = date("Y-m-d");
	DB::update('requests', array(
		'status' => 'r',
		'date_released' => $date
	), "req_id=%i", $req_id);

 	if($request_type == "individual") {
		DB::insert('payment', array(
			'pay_date' => $date,
			'pay_amt' => $price,
			'stud_id' => $stud_id,
			'remarks' => 'Regular'
		));
 	}else {
 		DB::insert('payment', array(
			'pay_date' => $date,
			'pay_amt' => 0,
			'stud_id' => $stud_id,
			'remarks' => 'Regular'
		));
 	}
 	$selectstm2 = "SELECT * from payment where stud_id = '$stud_id';";
 	$result = DB::query($selectstm2);
	if (count($result) > 0) {
		foreach ($result as $row) {
			$pay_id = $row['pay_id'];
			$pay_amt =$row['pay_amt'];
		}
	}

	DB::insert('transaction', array(
		'trans_date' => $date,
		'total_trans_amt' => $pay_amt,
		'stud_id' => $stud_id,
		'pay_id' => $pay_id,
		'req_id' => $req_id,
		'or_no' => $or_no
	));

 	//header("location: released.php");

?>
