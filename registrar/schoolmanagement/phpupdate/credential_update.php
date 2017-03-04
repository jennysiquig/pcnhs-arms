<?php 
	require_once "../../../resources/config.php"; 

	$cred_id = $_POST['cred_id'];
	$cred_name = $_POST['cred_name'];
	$price = $_POST['price'];

	$updatestm = "UPDATE `pcnhsdb`.`credentials` SET `cred_name`='$cred_name', `price`='$price' WHERE `cred_id`='$cred_id';";

	mysqli_query($conn, $updatestm);
	header("location: ../credentials.php");
?>