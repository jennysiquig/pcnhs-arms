<?php require_once "../../../resources/config.php"; ?>
<?php
	if(!$conn) {
		die();
	}	
	$stud_id = $_GET['stud_id'];
	$yr_level = $_GET['yr_level'];


	$statement1 = "DELETE FROM `pcnhsdb`.`grades` WHERE `stud_id`='$stud_id' and yr_level = $yr_level;";
	$statement2 = "DELETE FROM `pcnhsdb`.`studentsubjects` WHERE `stud_id`='$stud_id' and yr_level = $yr_level;";
	
	mysqli_query($conn, $statement1);
	mysqli_query($conn, $statement2);

	header("location: ../grades.php?stud_id=$stud_id");




?>