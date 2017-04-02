<?php
	$cred_id = htmlspecialchars($_POST['cred_id'],ENT_QUOTES);
	$cred_name = htmlspecialchars($_POST['cred_name'],ENT_QUOTES);
	$price = htmlspecialchars($_POST['price'],ENT_QUOTES);

	require_once "../../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`credentials` (`cred_id`, `cred_name`, `price`) VALUES (?, ?, ?)");

	$statement->bind_param("isi", $cred_id, $cred_name, $price);

	$statement->execute();

	header('location: ../credentials.php');

	$statement->close();
	$conn->close();
?>