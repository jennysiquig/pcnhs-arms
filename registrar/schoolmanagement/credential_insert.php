<?php
	$cred_id = $_POST['cred_id'];
	$cred_name = $_POST['cred_name'];
	$price = $_POST['price'];

	require_once "../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`credentials` (`cred_id`, `cred_name`, `price`) VALUES (?, ?, ?)");

	$statement->bind_param("isi", $cred_id, $cred_name, $price);

	$statement->execute();

	header('location: credentials.php');

	$statement->close();
	$conn->close();
?>