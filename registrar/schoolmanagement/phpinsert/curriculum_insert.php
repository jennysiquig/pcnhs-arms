<?php
	session_start();
	require_once "../../../resources/config.php";
	include '../../../resources/classes/Popover.php';
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$curr_id = 1;
	$statement = "SELECT * FROM pcnhsdb.curriculum order by curr_id desc limit 1;";
	$result = $conn->query($statement);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
		$curr_id = $row['curr_id'];
		$curr_id = $curr_id+1;

		}
	}else {
		$curr_id = 1;

	}

	$curr_code = htmlspecialchars(filter_var(strtoupper($_POST['curr_code']), FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
	$curr_name = htmlspecialchars(filter_var($_POST['curr_name'], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
	$year_started = htmlspecialchars($_POST['year_started'], ENT_QUOTES, 'UTF-8');
	$year_ended = htmlspecialchars($_POST['year_ended'], ENT_QUOTES, 'UTF-8');
	$willInsert = true;
	


	if($year_started >= $year_ended) {
		$willInsert = false;
		$message = "Year Started is Invalid.";
		$alert = "danger";
		$popover = new Popover();
		$popover->set_popover($alert, $message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("location: ".$_SERVER['HTTP_REFERER']);

	}

	if(empty($curr_code) || empty($curr_name)) {
		$willInsert = false;
		$message = "Invalid Input in Curriculum Code or Curriculum Name.";
		$alert = "danger";
		$popover = new Popover();
		$popover->set_popover($alert, $message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("location: ".$_SERVER['HTTP_REFERER']);
	}

	if($willInsert) {
		$statement = $conn->prepare("INSERT INTO `pcnhsdb`.`curriculum` (`curr_id`, `curr_code`, `curr_name`, `year_started`, `year_ended`) VALUES (?, ?, ?, ?,?)");

		$statement->bind_param("issii", $curr_id, $curr_code, $curr_name, $year_started,$year_ended);

		$statement->execute();
		$_SESSION['user_activity'][] = "ADDED NEW CURRICULUM: $curr_name";
		header('location: ../curriculum.php');

		$statement->close();
		$conn->close();
	}

	
?>