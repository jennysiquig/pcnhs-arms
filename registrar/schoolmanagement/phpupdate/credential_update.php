<?php 
	require_once "../../../resources/config.php"; 

	$cred_id = htmlspecialchars($_POST['cred_id'], ENT_QUOTES);
	$cred_name = htmlspecialchars($_POST['cred_name'], ENT_QUOTES);
	$price = htmlspecialchars($_POST['price'], ENT_QUOTES);

	$updatestm = "UPDATE `pcnhsdb`.`credentials` SET `cred_name`='$cred_name', `price`='$price' WHERE `cred_id`='$cred_id';";

	mysqli_query($conn, $updatestm);
	$_SESSION['user_activity'][] = "Edited Credential: $cred_name";
	header("location: ../credentials.php");
?>