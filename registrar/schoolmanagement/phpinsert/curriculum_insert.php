<?php
	session_start();
	require_once "../../../resources/config.php";
	include '../../../resources/classes/Popover.php';
	
	$curr_id = intval(htmlspecialchars($_POST['curr_id']));
	$curr_code = htmlspecialchars(strtoupper($_POST['curr_code']), ENT_QUOTES, 'UTF-8');
	//$curr_name = htmlspecialchars($_POST['curr_name'], ENT_QUOTES, 'UTF-8');
	$year_started = htmlspecialchars($_POST['year_started'], ENT_QUOTES, 'UTF-8');
	$year_ended = htmlspecialchars($_POST['year_ended'], ENT_QUOTES, 'UTF-8');
	$willInsert = true;
	$curr_name = filter_var($curr_name, FILTER_SANITIZE_STRING);
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if($year_started >= $year_ended) {
		$willInsert = false;
		$message = "Year Started is Invalid.";
		$alert = "danger";
		$popover = new Popover();
		$popover->set_popover($alert, $message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("location: ".$_SERVER['HTTP_REFERER']);

	}
	if($curr_id < 1 || !is_int($curr_id)) {
		$willInsert = false;
		$popover = new Popover();
		$popover->set_popover("danger", "Invalid Curriculum ID.");
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: ".$_SERVER['HTTP_REFERER']);
		
	}



	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`curriculum` (`curr_id`, `curr_code`, `curr_name`, `year_started`, `year_ended`) VALUES (?, ?, ?, ?,?)");

		$statement->bind_param("issii", $curr_id, $curr_code, $curr_name, $year_started,$year_ended);

		$statement->execute();

		header('location: ../curriculum.php');

		$statement->close();
		$conn->close();
	}

	
?>