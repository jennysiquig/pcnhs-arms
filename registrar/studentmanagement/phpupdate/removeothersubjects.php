<?php require_once "../../../resources/config.php"; ?>
<?php
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	//$yr_level = $_GET['yr_level'];


	$statement1 = "DELETE FROM `pcnhsdb`.`othersubjects` WHERE `stud_id`='$stud_id';";
	
	
	mysqli_query($conn, $statement1);
	

	header("location: ../grades.php?stud_id=$stud_id");




?>