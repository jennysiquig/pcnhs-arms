<?php require_once "../../../resources/config.php"; ?>
<?php
	session_start();
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$osubj_id = htmlspecialchars($_GET['osubj_id'], ENT_QUOTES);
	$schl_year = htmlspecialchars($_GET['schl_year'], ENT_QUOTES);
	$credit_earned = htmlspecialchars($_GET['credit_earned'], ENT_QUOTES);

	$statement1 = "DELETE FROM `pcnhsdb`.`othersubjects` WHERE `stud_id`='$stud_id' and osubj_id = '$osubj_id';";

	$student_grade = "SELECT * FROM pcnhsdb.grades where stud_id = '$stud_id' and schl_year='$schl_year';";
	$result_1 = $conn->query($student_grade);

	if($result_1->num_rows>0) {
		while ($row = $result_1->fetch_assoc()) {
			$total_credit = $row['total_credit'];
			$total_credit = doubleval($total_credit) - doubleval($credit_earned);

			$totalcreditupdate = "UPDATE `pcnhsdb`.`grades` SET `total_credit`='$total_credit' WHERE stud_id = '$stud_id' and schl_year = '$schl_year';";
			echo $totalcreditupdate;
			mysqli_query($conn, $totalcreditupdate);
		}
	}
	
	mysqli_query($conn, $statement1);
	
	echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";
	$_SESSION['user_activity'][] = "REMOVED OTHER SUBJECTS OF:<br> $stud_id";
	header("location: ../student_info.php?stud_id=$stud_id");




?>