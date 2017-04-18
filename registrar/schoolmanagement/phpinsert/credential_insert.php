<?php
	session_start();
	require_once "../../../resources/config.php";
	include '../../../resources/classes/Popover.php';
// get the latest credential ID

	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$cred_id = 1;
	$statement = "SELECT * FROM pcnhsdb.credentials order by cred_id desc limit 1;";
	$result = $conn->query($statement);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$cred_id = $row['cred_id'];
			$cred_id = $cred_id+1;
		}
	}else {
			$cred_id = 1;
	}

	$cred_name = htmlspecialchars(filter_var($_POST['cred_name'], FILTER_SANITIZE_STRING),ENT_QUOTES);
	$price = htmlspecialchars(filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),ENT_QUOTES);
	$willInsert = true;
	
	

	if($price < 1 || !is_numeric($price)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Input Price.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	if(empty($cred_name)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Credential Name Input.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	
	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`credentials` (`cred_id`, `cred_name`, `price`) VALUES (?, ?, ?)");

		$statement->bind_param("isi", $cred_id, $cred_name, $price);
	
		$statement->execute();

		echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";
		$_SESSION['user_activity'][] = "ADDED NEW CREDENTIAL: $cred_name";
		header('location: ../credentials.php');

	}
	

	$statement->close();
	$conn->close();
?>