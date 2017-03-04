<?php 
	require_once "../../../resources/config.php"; 

	$curr_id = $_POST['curr_id'];
	$curr_name = $_POST['curr_name'];
	$year_ended = $_POST['year_ended'];

	$updatestm = "UPDATE `pcnhsdb`.`curriculum` SET `curr_name`='$curr_name', `year_ended`='$year_ended' WHERE `curr_id`='$curr_id';";

	mysqli_query($conn, $updatestm);
	header("location: ../curriculum.php");
?>