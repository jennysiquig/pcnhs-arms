<?php require_once "../../../resources/config.php"; ?>
<?php
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$osubj_id = htmlspecialchars($_GET['osubj_id'], ENT_QUOTES);


	$statement1 = "DELETE FROM `pcnhsdb`.`othersubjects` WHERE `stud_id`='$stud_id' and osubj_id = '$osubj_id';";
	
	
	mysqli_query($conn, $statement1);
	try {
		$_SESSION['user_activity'][] = "REMOVED OTHER SUBJECTS OF:<br> $stud_id";
	}catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
			echo 'Logging out...';
	}finally {
			header("refresh: 3; url='../../../logout.php'");
			die();
	}

	header("location: ../grades.php?stud_id=$stud_id");




?>