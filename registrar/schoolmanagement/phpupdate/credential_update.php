<?php
	require_once "../../../resources/config.php";
	session_start();
	$cred_id = htmlspecialchars($_POST['cred_id'], ENT_QUOTES);
	$cred_name = htmlspecialchars($_POST['cred_name'], ENT_QUOTES);
	$price = htmlspecialchars($_POST['price'], ENT_QUOTES);

	$updatestm = "UPDATE `pcnhsdb`.`credentials` SET `cred_name`='$cred_name', `price`='$price' WHERE `cred_id`='$cred_id';";

	DB::query($updatestm);

	echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
	echo "<br>";
	$_SESSION['user_activity'][] = "EDITED CREDENTIAL: $cred_name";
	header("location: ../credentials.php");
?>
