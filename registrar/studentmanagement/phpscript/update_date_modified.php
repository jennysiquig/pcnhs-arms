<?php
	require_once "../../../resources/config.php";
	$date_modified = $_GET['date_modified'];
	$stud_id = $_GET['stud_id'];
	if(!$conn) {
		die();
	}

	$statement = "UPDATE `pcnhsdb`.`students` SET `date_modified`='$date_modified' WHERE `stud_id`='$stud_id';";

	mysqli_query($conn, $statement);



?>