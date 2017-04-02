<?php
	session_start();
	require_once "../../../resources/config.php";
	include '../../../resources/classes/Popover.php';
	
	$cred_id = intval(htmlspecialchars(filter_var($_POST['cred_id'], FILTER_SANITIZE_NUMBER_INT),ENT_QUOTES));
	$cred_name = htmlspecialchars(filter_var($_POST['cred_name'], FILTER_SANITIZE_STRING),ENT_QUOTES);
	$price = htmlspecialchars(filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),ENT_QUOTES);
	$willInsert = true;
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	if($cred_id < 1 || !is_int($cred_id)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Credential ID.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	if($price < 1 || !is_numeric($price)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Input Price.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`credentials` (`cred_id`, `cred_name`, `price`) VALUES (?, ?, ?)");

		$statement->bind_param("isi", $cred_id, $cred_name, $price);
	
		$statement->execute();
	
		header('location: ../credentials.php');
	}
	

	$statement->close();
	$conn->close();
?>