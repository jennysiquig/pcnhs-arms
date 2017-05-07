<?php
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	session_start();

	$willInsert = true;
	$curr_id = htmlspecialchars($_POST['curr_id'], ENT_QUOTES);
	$curr_name = htmlspecialchars($_POST['curr_name'], ENT_QUOTES);
	$year_started = htmlspecialchars($_POST['year_started']);
	$year_ended = htmlspecialchars($_POST['year_ended'], ENT_QUOTES);

	if(is_numeric($year_ended)) {
		if($year_ended < $year_started) {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			die();
		}
	}else {
		if(strtoupper($year_ended) != "PRESENT") {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			die();
		}else {
			$year_ended = strtolower($year_ended);
			$year_ended = ucfirst($year_ended);
		}
	}

	$updatestm = "UPDATE `pcnhsdb`.`curriculum` SET `curr_name`='$curr_name', `year_ended`='$year_ended' WHERE `curr_id`='$curr_id';";

	if($willInsert) {
		DB::query($updatestm);

		echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";
		$_SESSION['user_activity'][] = "EDITED CURRICULUM: $curr_name";
		header("location: ../curriculum.php");

	}


?>
