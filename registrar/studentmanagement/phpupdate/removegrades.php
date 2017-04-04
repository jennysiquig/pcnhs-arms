<?php require_once "../../../resources/config.php"; ?>
<?php
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$yr_level = htmlspecialchars($_GET['yr_level'], ENT_QUOTES);


	$statement1 = "DELETE FROM `pcnhsdb`.`grades` WHERE `stud_id`='$stud_id' and yr_level = $yr_level;";
	$statement2 = "DELETE FROM `pcnhsdb`.`studentsubjects` WHERE `stud_id`='$stud_id' and yr_level = $yr_level;";
	
	mysqli_query($conn, $statement1);
	mysqli_query($conn, $statement2);
	$_SESSION['user_activity'][] = "Removed Grades of: $stud_id";
	header("location: ../grades.php?stud_id=$stud_id");




?>