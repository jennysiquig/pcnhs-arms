<?php 
	require_once "../../../resources/config.php"; 

	$curr_id = htmlspecialchars($_POST['curr_id'], ENT_QUOTES);
	$curr_name = htmlspecialchars($_POST['curr_name'], ENT_QUOTES);
	$year_ended = htmlspecialchars($_POST['year_ended'], ENT_QUOTES);

	$updatestm = "UPDATE `pcnhsdb`.`curriculum` SET `curr_name`='$curr_name', `year_ended`='$year_ended' WHERE `curr_id`='$curr_id';";

	mysqli_query($conn, $updatestm);
	$_SESSION['user_activity'][] = "EDITED CURRICULUM: $curr_name";
	header("location: ../curriculum.php");
?>